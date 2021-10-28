<?php
require_once('MysqlDB.class.php');

class ChecklistAPI extends MysqlDB{
  
    function __construct($host, $user, $pswd, $database, $debug) {
         $this->MysqlDB($host, $user, $pswd, $database, $debug);
    }

    function addMeta($name, $idx, $desc='') {
        if ($name == '' || $idx== '')
            return false;

        $idx = addslashes($idx);
        $sql = "select count(*) as CNT from checklist_meta where ItemCode = '{$idx}' ";
        //die($sql);
        $this->query($sql);
        if ($this->fetch() && $this->CNT > 0)
            return $idx;
        
            
        $sql = "insert into checklist_meta (Item, ItemDesc, ItemCode) values ('{$name}','{$desc}','{$idx}')";
        $this->query($sql);
        return $idx;        
    }

    function setMeta($item_id, $name='', $desc='') {
        if ($item_id == '')
            return false;

        $upd = array();
        if ($name != '') {
            array_push($upd, "Item = '".addslashes($name)."'");
        }
        if ($desc != '') {
            array_push($upd, "Item = '".addslashes($desc)."'");
        }

        if (count($upd) == 0)
            return false;

        $sql = "update checklist_meta SET ".implode(',', $upd)." where id = {$item_id}";
        return $this->query($sql);
    }

    function delMeta($code) {
        if ($code == '')
            return false;       

        $sql = "update checklist_meta SET IsDeleted = 1 where ItemCode = {$code}";
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

    function getItems($tpl_id, $is_active=false) {
        if (!$tpl_id)
            return false;

        $sql = "SELECT a.ID, b.Item, b.ItemDesc, b.IsDeleted, a.ItemCode, a.TplID FROM checklist_item a, checklist_meta b where a.ItemCode = b.ItemCode and a.TplID = {$tpl_id} ";
        if ($is_active) {
            $sql .= " and IsDeleted = 0 ";
        }
        
        $sql .= "order by IsDeleted asc, ItemRank asc ";
        $this->query($sql);
        $rtn = array();
        while($this->fetch()) {
            $rtn[$this->ID]['tit'] = $this->Item;
            $rtn[$this->ID]['tip'] = $this->ItemDesc;
            $rtn[$this->ID]['idx'] = $this->ItemCode;
            $rtn[$this->ID]['tpl'] = $this->TplID;
            $rtn[$this->ID]['del'] = $this->IsDeleted;
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

    function setTpl($id, $subject, $status) {
        if (!$id)
            return false;

        $upd = array();
        if ($subject != '') {
            array_push($upd, " Subject = '".addslashes($subject)."' ");
        }
        if ($status != '') {
            array_push($upd, " Status = '".addslashes($status)."' ");
        }

        if (count($upd) > 0) {
            $sql = "Update checklist_tpl SET " .implode(',', $upd). " where id = {$id}";
            return $this->query($sql);
        }
        return false;
    }

    function delTpl() {

    }

    function getTpls($tpl_id=0,$active=false) {
        $rtn = array();

        $sql = "SELECT ID, Subject, Status from checklist_tpl WHERE 1 ";
        if ($tpl_id > 0) {
            $sql .= " AND ID = {$tpl_id} ";
        }
        if ($active) {
            $sql .= " AND status = 'Active' ";
        }
        $sql .= " order by Subject";
        $this->query($sql);
        while($this->fetch()){
            $rtn[$this->ID]['name'] =  $this->Subject;
            $rtn[$this->ID]['status'] =  $this->Status;   
        }

        if ($tpl_id > 0 && isset($rtn[$tpl_id])) 
            return $rtn[$tpl_id];
        else 
            return $rtn;
    }

    function getApp($type, $appid) {
        $rtn = array();
        if (!$type || !$appid)
            return $rtn;

        $sql = "select a.ID, a.Received, if(a.ItemCode = '', ExItem, b.Item) as Titile, if(a.ItemCode = '', '', b.ItemDesc) as Remark  from checklist_app a left join checklist_meta b on (a.ItemCode = b.ItemCode) where a.type = '{$type}' and a.Appid = {$appid} order by a.ID";
        
        $this->query($sql);
        while ($this->fetch()) {
            $rtn[$this->ID]['tit'] = $this->Titile;
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

        return false;
    }

    function addAppItems($type, $appid, $item, $received=''){
        if (!$type || !$appid)
            return false;

        if ($item != '') {
            if (!$received)
                $received = '0000-00-00';
            $sql = "insert into checklist_app (Type, AppID, ExItem, Received) values ('{$type}','{$appid}','{$item}','{$received}')";        
            return $this->query($sql);
        }
        return false;
    }
}

