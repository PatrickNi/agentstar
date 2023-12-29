<?php
require_once('MysqlDB.class.php');

class ChecklistAPI extends MysqlDB{
  
    function __construct($host, $user, $pswd, $database, $debug) {
        $this->setDBconf($host, $user, $pswd, $database, $debug);
   }

    function addMeta($name, $desc='') {
        if ($name == '')
            return false;

        $name = str_replace(array("\r\n", "\r"), "\n", $name);    
        $idx = md5($name);
        $sql = "select count(*) as CNT from checklist_meta where ItemCode = '{$idx}' ";
        //die($sql);
        $this->query($sql);
        if ($this->fetch() && $this->CNT > 0)
            return $idx;
        
        $desc = str_replace(array("\r\n", "\r"), "\n", $desc);
        $name = addslashes($name);
        $desc = addslashes($desc);     
        $sql = "insert into checklist_meta (Item, ItemDesc, ItemCode) values ('{$name}','{$desc}','{$idx}')";
        $this->query($sql);
        return $idx;        
    }

    function setMeta($code, $name='', $desc='', $remove_desc=false) {
        if ($code == '')
            return false;

        $upd = array();
        if ($name != '') {
            array_push($upd, "Item = '".addslashes($name)."'");
        }
        if ($desc != '') {
            array_push($upd, "ItemDesc = '".addslashes($desc)."'");
        }
        elseif($desc == '' && $remove_desc) {
            array_push($upd, "ItemDesc = ''");
        }

        if (count($upd) == 0)
            return false;

        $sql = "update checklist_meta SET ".implode(',', $upd)." where ItemCode = '{$code}'";
        return $this->query($sql);
    }

    function delMeta($code) {
        if ($code == '')
            return false;       

        $sql = "update checklist_meta SET IsDeleted = 1 where ItemCode = '{$code}' ";
        return $this->query($sql);        
    }

    function getMetas($tpl_id = 0) {
        if ($tpl_id > 0) {
            $sql = "select a.ID, Item, ItemDesc, a.ItemCode,IsDeleted from checklist_meta a where IsDeleted = 0 and not exists (select 'x' from checklist_item b where b.TplID = {$tpl_id} and a.ItemCode = b.ItemCode) order by Item asc";
        }
        else {
            $sql = "select a.ID, Item, ItemDesc, ItemCode,IsDeleted from checklist_meta where IsDeleted = 0 order by Item asc";
            $tpl_id = 0;
        }
        $this->query($sql);
        $rtn = array();
        while($this->fetch()) {
            $rtn[$this->ID]['tit'] = $this->Item;
            $rtn[$this->ID]['tip'] = $this->ItemDesc;
            $rtn[$this->ID]['idx'] = $this->ItemCode;
            $rtn[$this->ID]['tpl'] = $tpl_id;
            $rtn[$this->ID]['del'] = $this->IsDeleted;
        }
        return $rtn;        
    }


    function addItem($tpl_id, $code) {
        if (!$tpl_id || !$code)
            return false;

        $sql = "select count(*) as CNT from checklist_item where TplID =  {$tpl_id}  and ItemCode = '{$code}' ";
        $this->query($sql);
        if ($this->fetch() && $this->CNT > 0)
            return false;       

        $sql = "select max(ItemRank) as Rank from checklist_item where TplID =  {$tpl_id} ";
        $this->query($sql);
        if ($this->fetch()) {
            $rank = $this->Rank+1;
        }
        else {
            $rank = 0;
        }

        $sql = "insert into checklist_item (TplID, ItemCode, ItemRank) values ({$tpl_id}, '{$code}', {$rank})";
        $this->query($sql);
        return $this->getLastInsertID();
    }

    function setItemCode($item_id, $code) {
        if (!$item_id || !$code)
            return false;
            
        $sql = "update checklist_item SET ItemCode = '{$code}' where id = {$item_id}";
        return $this->query($sql);
    }



    function delItem($item_id) {
        if (!$item_id)
            return false;

        $sql = "delete from checklist_item where id = {$item_id}";
        return $this->query($sql);
    }
 
    function getItems($tpl_id, $is_active=false) {
        if (!$tpl_id)
            return false;
        /*
        $sql = "select item, itemcode from checklist_meta where itemcode in ('750f30562bf6b1160071ef38d072eb4a', '9c0c122f9f60bc22e102c6d4de0b03bc')";
        $this->query($sql);
        while ($row = $this->fetch_array()) {
            var_dump($row, stripos($row['item'], "\n"), stripos($row['item'], "\r\n"), stripos($row['item'],"\r"));
        }
        exit;
        */
        $sql = "SELECT a.ID, b.Item, b.ItemDesc, b.IsDeleted, a.ItemCode, a.TplID FROM checklist_item a, checklist_meta b, checklist_tpl c where a.ItemCode = b.ItemCode and a.TplID = {$tpl_id} and a.tplid = c.id ";
        if ($is_active) {
            $sql .= " and IsDeleted = 0 and c.status = 'active' ";
        }
        
        $sql .= "order by IsDeleted asc, ItemRank asc ";
        $this->query($sql);
        $rtn = array();
        while($this->fetch()) {
            $rtn[$this->ID]['tit'] = str_replace(array("\n"),"<br/>",$this->Item);
            $rtn[$this->ID]['tip'] = str_replace(array("\n"),"<br/>",$this->ItemDesc);
            $rtn[$this->ID]['idx'] = $this->ItemCode;
            $rtn[$this->ID]['tpl'] = $this->TplID;
            $rtn[$this->ID]['del'] = $this->IsDeleted;
        }
        //var_dump($rtn);
        return $rtn;
    }

    function rankItems($tpl_id, $ranks) {
        if (!$tpl_id || count($ranks) == 0)
            return false;        
        
        $rk = 1;
        foreach ($ranks as $item_id) {
            if (!$item_id)
                continue;

            $sql = "update checklist_item SET ItemRank = {$rk} where id = {$item_id} and tplid = {$tpl_id}  ";
            $this->query($sql);
            $rk++;
        }
        return true;
    }

    function getItemById($id) {
        if (!$id)
            return false;

        $sql = "SELECT a.ID, b.Item, b.ItemDesc, b.IsDeleted, a.ItemCode, a.TplID FROM checklist_item a, checklist_meta b where a.ItemCode = b.ItemCode and a.ID = {$id}";
        $this->query($sql);
        $rtn = array();
        while($this->fetch()) {
            $rtn['tit'] = str_replace(array("\n"),"<br/>",$this->Item);
            $rtn['tip'] = $this->ItemDesc;
            $rtn['idx'] = $this->ItemCode;
            $rtn['tpl'] = $this->TplID;
            $rtn['del'] = $this->IsDeleted;
        }
        return $rtn;
    }

    function addTpl($subject) {
        if ($subject == '')
            return false;

        $subject = addslashes($subject);
        $sql = "select count(*) as CNT from checklist_tpl where subject = '{$subject}' ";
        $this->query($sql);
        if ($this->fetch() && $this->CNT > 0)
            return false;
        
        $sql = "insert into checklist_tpl (subject) values ('{$subject}')";
        $this->query($sql);
        return $this->getLastInsertID();
    }

    function cloneTpl($to_tpl_id, $from_tpl_id) {
        if (!$to_tpl_id || !$from_tpl_id)
            return false;

        $sql = "insert into checklist_item (TplID, ItemCode, ItemRank) select {$to_tpl_id} as TplID, ItemCode, ItemRank from checklist_item where tplid = {$from_tpl_id}";
        return $this->query($sql);
    }


    function setTpl($id, $subject, $status, $visa_cate_id=0, $visa_class_id=0) {
        if (!$id)
            return false;

        $upd = array();
        if ($subject != '') {
            array_push($upd, " Subject = '".addslashes($subject)."' ");
        }
        if ($status != '') {
            array_push($upd, " Status = '".addslashes($status)."' ");
        }

        if ($visa_cate_id > 0) {
            array_push($upd, " VisaCateID = '".addslashes($visa_cate_id)."' ");
        }
        if ($visa_class_id > 0) {
            array_push($upd, " VisaClassID = '".addslashes($visa_class_id)."' ");
        }

        if (count($upd) > 0) {
            $sql = "Update checklist_tpl SET " .implode(',', $upd). " where id = {$id}";
            return $this->query($sql);
        }
        return false;
    }

    function delTpl($id) {
        if (!$id)
            return false;

        $sql = "delete from checklist_item where tplid = {$id}";
        $this->query($sql); 

        $sql = "delete from checklist_tpl where id = {$id} ";
        return $this->query($sql);
    }

    function getTpls($tpl_id=0,$active=false,$tplids=array()) {
        $rtn = array();

        $sql = "SELECT ID, Subject, Status, VisaClassID, VisaCateID, vc.VisaName, vs.ClassName from checklist_tpl a left join visa_category vc on (vc.cateid = a.VisaCateID) left join visa_subclass vs on (a.VisaClassID = vs.SubClassID) WHERE 1 ";
        if ($tpl_id > 0) {
            $sql .= " AND ID = {$tpl_id} ";
        }
        if ($active) {
            $sql .= " AND status = 'Active' ";
        }
        if (count($tplids) > 0){
            $sql .= " AND ID in (".implode(',', $tplids).") ";
        }

        $sql .= " order by VisaName, Subject";
        //echo $sql;
        $this->query($sql);
        while($this->fetch()){
            $rtn[$this->ID]['name'] =  $this->Subject;
            $rtn[$this->ID]['status'] =  $this->Status;   
            $rtn[$this->ID]['visacate'] =  $this->VisaCateID;
            $rtn[$this->ID]['visaclass'] =  $this->VisaClassID;
            $rtn[$this->ID]['catename'] =  $this->VisaName;
            $rtn[$this->ID]['classname'] =  $this->ClassName;
        }

        if ($tpl_id > 0 && isset($rtn[$tpl_id])) 
            return $rtn[$tpl_id];
        else 
            return $rtn;
    }

    function getApp($type, $appid, $html_break=true) {
        $rtn = array();
        if (!$type || !$appid)
            return $rtn;

        $sql = "select a.ID, a.Received, if(a.ExItem <> '', ExItem, b.Item) as Title, if(a.ItemCode = '', '', b.ItemDesc) as Remark  from checklist_app a left join checklist_meta b on (a.ItemCode = b.ItemCode) where a.type = '{$type}' and a.Appid = {$appid} order by a.Rank, a.ID";
        
        $this->query($sql);
        while ($this->fetch()) {
            $rtn[$this->ID]['tit'] = $html_break? str_replace(array("\n"),"<br/>",$this->Title) : $this->Title;
            $rtn[$this->ID]['rmk'] = $this->Remark;
            $rtn[$this->ID]['rcd'] = $this->Received;
        }
        return $rtn;
    }

    function createApp($tpl_id, $type, $appid) {
        if (!$tpl_id || !$type || !$appid)
            return false;
        
        $sql = "insert into checklist_app (Type, AppID, ItemCode) Select '{$type}', '{$appid}', ItemCode FROM checklist_item where TplID = {$tpl_id} order by ItemRank ";
        //echo $sql;
        return $this->query($sql);        
    }

    function updateReceived($dates) {
        if (!$dates)
            return false;

        foreach ($dates as $id => $d) {
            if (!$d)
                continue;

            $sql = "update checklist_app SET Received = '{$d}' where id = {$id}";
            $this->query($sql);
        }

        return true;
    }

    function addAppItems($type, $appid, $item, $received=''){
        if (!$type || !$appid)
            return false;

        if ($item != '') {
            if (!$received)
                $received = '0000-00-00';

            $item = addslashes($item);
            $sql = "insert into checklist_app (Type, AppID, ExItem, Received) values ('{$type}','{$appid}','{$item}','{$received}')";        
            return $this->query($sql);
        }
        return false;
    }

    function delAppItems($app_item_id){
        if (!$app_item_id)
            return false;

        $sql = "delete from checklist_app where id = {$app_item_id}";
        return $this->query($sql);
    }

    function editAppItemTit($app_item_id, $app_item_tit) {
        if (!$app_item_id || !$app_item_tit)
            return false;
        
        $sql = 'update checklist_app set ExItem = "'.addslashes($app_item_tit).'" where id = '.$app_item_id;
        return $this->query($sql);
    }

    function rankAppItems($type, $appid, $ranks) {
        if (!$type || !$appid || count($ranks) == 0)
            return false;        
        
        $rk = 1;
        foreach ($ranks as $app_item_id) {
            if (!$app_item_id)
                continue;

            $sql = "update checklist_app SET Rank = {$rk} where id = {$app_item_id} and type = '{$type}' and Appid = {$appid} ";
            $this->query($sql);
            $rk++;
        }
        return true;
    }
    
    function findAppTpls($type, $appid) {
        $rtn = array();
        if ($type == 'visa') {
            $sql = "select CateID, SubClassID from client_visa where id = {$appid}";
            $this->query($sql);
            if ($this->fetch()){
                $visa_cate = $this->CateID;
                $visa_class = $this->SubClassID;

                $sql = "select ID from checklist_tpl where status = 'Active' and VisaCateID = {$visa_cate} and VisaClassID = {$visa_class}";
                $this->query($sql);
                while ($row = $this->fetch_array()) {
                    array_push($rtn, $row['ID']);
                }

                if (count($rtn) == 0) {
                    $sql = "select ID from checklist_tpl where status = 'Active' and VisaCateID = {$visa_cate}";
                    $this->query($sql);
                    while ($row = $this->fetch_array()) {
                        array_push($rtn, $row['ID']);
                    }                 
                }
            }
        }
        elseif ($type == 'course') {
            $sql = "select ID from checklist_tpl where status = 'Active' and Subject like 'Course Base Check'";
            $this->query($sql);
            while ($row = $this->fetch_array()) {
                array_push($rtn, $row['ID']);
            } 
        }
        return $rtn;
    }
}

