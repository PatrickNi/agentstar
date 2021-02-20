<?php
require_once('MysqlDB.class.php');

class CoachAPI extends MysqlDB{

    function __construct($host, $user, $pswd, $database, $debug) {
         $this->MysqlDB($host, $user, $pswd, $database, $debug);
    }

    function addItem($title, $root_id=0) {
        if (!$title)
            return false;

        $title = addslashes($title);
        $sql = "insert into coach_item (title, parentid) values ('{$tilte}', '{$root_id}')";
        $this->query($sql);

        return $this->getLastInsertID();
    }

    function setItem($id, $title) {
        if (!$id || !$title)
            return false;

        $titile = addslashes($title);
        $sql = "update coach_item SET title = '{$title}' where id = {$id}";
        return $this->query($sql);
    }

    function delItem($id) {
        if (!$id)
            return false;
        $sql = "delete from coach_item where id = {$id}";
        return $this->query($sql);
    }

    function getItems($parentid=0) {
        $sql = "select ID, Title, Fee, ParentID from coach_item";
        if ($parentid) {
            $sql .= "where parentid = {$id} ";
        }
        $this->query($sql);
        $arr = array();
        while ($this->fetch()) {
            $arr[$this->ID]['tit'] = $this->Title;
            $arr[$this->ID]['fee'] = $this->Fee;
            $arr[$this->ID]['pid'] = $this->ParentID;
        }

        return $arr;
    }

    function getRootItems() {
        return $this->getItems(0);
    }

    function getSubItems($id) {
        if (!$id)
            return false;
        return $this->getItems($id);
    }

    function getAssocItems() {
        $items = array();
        $tmp = $this->getItems();
        foreach ($tmp as $k => $v) {
            if ($v['pid'] == 0)
                continue;

            $items[$tmp[$v['pid']]['tit']][$k] = $v['tit'];
        }
        return $items; 
    }


    function addCoach($user_id, $cid, $sets) {
        $sets['note'] = addslashes($sets['note']);
        $deliver_hour = $this->calDeliverHour($sets['startdate'], $sets['enddate'], $sets['freqw'], $sets['duehour']);

        $sql = "insert into client_coach (CID, StaffID, AddUserId, ItemID, StartDate, EndDate, StartTime, DueHour, FreqWeek, Fee, AddTime, Note, SaleID, DeliverHours) values ('{$cid}','{$sets['staff']}', '{$user_id}', '{$sets['itemid']}', '{$sets['startdate']}','{$sets['enddate']}','{$sets['starttime']}','{$sets['duehour']}','{$sets['freqw']}','{$sets['fee']}', NOW(), '{$sets['note']}', '{$sets['sales']}', '{$deliver_hour}')";
        //var_dump($sql);exit;
        $this->query($sql);
        return $this->getLastInsertID();
    }

    function setCoach($user_id, $coach_id, $sets) {
        if (!$user_id || !$coach_id || !$sets)
            return false;

        $sets['note'] = addslashes($sets['note']);
        $deliver_hour = $this->calDeliverHour($sets['startdate'], $sets['enddate'], $sets['freqw'], $sets['duehour']);

        $sql = "update client_coach SET AddUserID = '{$user_id}', ItemID = '{$sets['itemid']}', StartDate = '{$sets['startdate']}', EndDate = '{$sets['enddate']}', StaffId = '{$sets['staff']}', StartTime = '{$sets['starttime']}', DueHour = '{$sets['duehour']}', FreqWeek = '{$sets['freqw']}', Fee = '{$sets['fee']}', Note='{$sets['note']}', SaleID = '{$sets['sales']}', DeliverHours = '{$deliver_hour}' where id = {$coach_id}";
        //var_dump($sql);
        return $this->query($sql);
    }

    function delCoach($coach_id) {
        if (!$coach_id)
            return false;

        $sql = "DELETE FROM client_coach where id = {$coach_id}";
        return $this->query($sql);
    }

    function getCoach($cid, $coach_id=0, $date='', $staff=0) {
        $sql = "SELECT ID, CID, StaffID, AddUserID, ItemID, StartDate, EndDate, StartTime, DueHour, FreqWeek, Fee, AddTime, Note, SaleID, DeliverHours FROM client_coach WHERE 1 ";
        if ($cid)
            $sql .= " AND CID = {$cid} ";

        if ($coach_id > 0) 
            $sql .= " AND ID = {$coach_id} ";
        
        if ($date != '') 
            $sql .= " AND StartDate >= '{$date}' AND EndDate <= '{$date}' ";

        if ($staff > 0)
            $sql .= " AND StaffID = {$staff} ";
        //echo $sql."<br/>";
        $this->query($sql);
        $arr = array();
        while($this->fetch()) {
            $arr[$this->ID]['cid'] = $this->CID;
            $arr[$this->ID]['staff'] = $this->StaffID;
            $arr[$this->ID]['adduser'] = $this->AddUserID;
            $arr[$this->ID]['itemid'] = $this->ItemID;
            $arr[$this->ID]['startdate'] = $this->StartDate;
            $arr[$this->ID]['enddate'] = $this->EndDate;
            $arr[$this->ID]['starttime'] = $this->StartTime;
            $arr[$this->ID]['duehour'] = $this->DueHour;
            $arr[$this->ID]['freqw'] = $this->FreqWeek;
            $arr[$this->ID]['freqw_l'] = explode(',', $this->FreqWeek);
            $arr[$this->ID]['fee'] = $this->Fee;
            $arr[$this->ID]['created'] = $this->AddTime;
            $arr[$this->ID]['note'] = $this->Note;
            $arr[$this->ID]['sales'] = $this->SaleID;
            $arr[$this->ID]['deliverhour'] = $this->DeliverHours;
        }
        return $arr;
    }

    function calDeliverHour($startdate, $enddate, $freq_weeks, $duehour) {
        if (!$startdate || $startdate == '0000-00-00' || !$enddate || $enddate == '0000-00-00' || !$freq_weeks || !$duehour)
            return 0;

        $freq_weeks = explode(',', $freq_weeks);
        $count = 0;
        do {
            if(in_array(date('D', strtotime($startdate)), $freq_weeks))
                $count++;

            $startdate = date("Y-m-d", strtotime('+1 day', strtotime($startdate)));
        }while($startdate <= $enddate);
        
        return $duehour*$count;
    }
}
?>
