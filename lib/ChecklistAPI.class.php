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
        
            
        $sql = "insert into checklist_meta (Item, ItemDesc, ItemCode) values ('{$name}','{$desc}','{$desc}')";
        $this->query($sql);
        return $this->getLastInsertID();        
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

    function getItems($tpl_id) {
        if (!$tpl_id)
            return false;

        $sql = "SELECT a.ID, b.Item, b.ItemDesc, b.IsDeleted, a.ItemCode, a.TplID FROM checklist_item a, checklist_meta b where a.ItemCode = b.ItemCode ";
        $sql .= " and a.TplID = {$tpl_id} ";
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

    function getTpls($tpl_id=0) {
        $rtn = array();

        $sql = "SELECT ID, Subject, Status from checklist_tpl ";
        if ($tpl_id > 0) {
            $sql .= " WHERE ID = {$tpl_id} ";
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

    function createList() {

    }

    function updateList() {

    }

    function updateReceived() {

    }
}