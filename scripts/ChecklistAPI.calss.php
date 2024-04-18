<?php
require_once('MysqlDB.class.php');

class ChecklistAPI extends MysqlDB{
  
    function __construct($host, $user, $pswd, $database, $debug) {
         $this->MysqlDB($host, $user, $pswd, $database, $debug);
    }

    function addItem() {

    }

    function setItem() {

    }

    function delItem() {

    }

    function addTpl($subject) {
        if ($subject == '')
            return false;

        $subject = addslashes($subject);
        $sql = "select count(*) as CNT from checklist_tpl where subject = '{$subject}' ";
        $this->query($sql);
        if ($this->fetch() && $this->CNT > 0)
            return false;
        
        $sql = "insert into checklist_tpl (subject) values ('{$sujbect}')";
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

    function getTpls() {
        $rtn = array();
        $sql = "SELECT ID, Subject, Status from checklist_tpl order by Subject";
        $this->query($sql);
        while($this->fetch()){
            $rtn[$this->ID]['name'] =  $this->Subject;
            $rtn[$this->ID]['status'] =  $this->Status;   
        }
        return $rtn;
    }

    function createList() {

    }

    function updateList() {

    }

    function updateReceived() {

    }
}