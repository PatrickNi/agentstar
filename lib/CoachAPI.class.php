<?php
require_once('MysqlDB.class.php');

class CoachAPI extends MysqlDB{
    private $LOCK_CODE = 'cu$7*s';

    public $GRADE_LIST = array(1=>'Year1',2=>'Year2',3=>'Year3',4=>'Year4',5=>'Year5',6=>'Year6',7=>'Year7',8=>'Year8',9=>'Year9',10=>'Year10',11=>'Year11',12=>'Year12');

    function __construct($host, $user, $pswd, $database, $debug) {
         $this->MysqlDB($host, $user, $pswd, $database, $debug);
    }

    function addItem($title, $root_id=0) {
        if (!$title)
            return false;

        $title = addslashes($title);
        $sql = "insert into coach_item (title, parentid) values ('{$title}', '{$root_id}')";
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
            $sql .= "where parentid = {$parentid} ";
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
        $sets['school'] = addslashes($sets['school']);
        $sets['grade'] = addslashes($sets['grade']);
        $deliver_hour = $this->calDeliverHour($sets['startdate'], $sets['enddate'], $sets['freqw'], $sets['duehour']);
        $deliver_hour = $deliver_hour['totalhours'];

        $sql = "insert into client_coach (CID, StaffID, AddUserId, ItemID, StartDate, EndDate, StartTime, DueHour, FreqWeek, Fee, AddTime, Note, SaleID, DeliverHours, School, Grade) values ('{$cid}','{$sets['staff']}', '{$user_id}', '{$sets['itemid']}', '{$sets['startdate']}','{$sets['enddate']}','{$sets['starttime']}','{$sets['duehour']}','{$sets['freqw']}','{$sets['fee']}', NOW(), '{$sets['note']}', '{$sets['sales']}', '{$deliver_hour}', '{$sets['school']}', '{$sets['grade']}')";
        //var_dump($sql);exit;
        $this->query($sql);
        return $this->getLastInsertID();
    }

    function setCoach($user_id, $coach_id, $sets) {
        if (!$user_id || !$coach_id || !$sets)
            return false;

        $sets['note'] = addslashes($sets['note']);
        $sets['school'] = addslashes($sets['school']);
        $sets['grade'] = addslashes($sets['grade']);
        $deliver_hour = $this->calDeliverHour($sets['startdate'], $sets['enddate'], $sets['freqw'], $sets['duehour']);
        $deliver_hour = $deliver_hour['totalhours'];

        $sql = "update client_coach SET AddUserID = '{$user_id}', ItemID = '{$sets['itemid']}', StartDate = '{$sets['startdate']}', EndDate = '{$sets['enddate']}', StaffId = '{$sets['staff']}', StartTime = '{$sets['starttime']}', DueHour = '{$sets['duehour']}', FreqWeek = '{$sets['freqw']}', Fee = '{$sets['fee']}', Note='{$sets['note']}', SaleID = '{$sets['sales']}', DeliverHours = '{$deliver_hour}', School = '{$sets['school']}', Grade = '{$sets['grade']}' where id = {$coach_id}";
        //var_dump($sql);
        return $this->query($sql);
    }

    function delCoach($coach_id) {
        if (!$coach_id)
            return false;

        $this->delLesson($coach_id);
        
        $sql = "DELETE FROM client_coach where id = {$coach_id}";
        return $this->query($sql);
    }

    function getCoach($cid, $coach_id=0, $date='', $staff=0) {
        $sql = "SELECT ID, CID, StaffID, AddUserID, ItemID, StartDate, EndDate, StartTime, DueHour, FreqWeek, Fee, AddTime, Note, SaleID, DeliverHours, School, Grade FROM client_coach WHERE 1 ";
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
            $arr[$this->ID]['school'] = $this->School;
            $arr[$this->ID]['grade'] = $this->Grade;
        }
        return $arr;
    }

    function calDeliverHour($startdate, $enddate, $freq_weeks, $duehour) {
        if (!$startdate || $startdate == '0000-00-00' || !$enddate || $enddate == '0000-00-00' || !$freq_weeks || !$duehour)
            return 0;

        $freq_weeks = explode(',', $freq_weeks);
        $count = 0;
        $dates = array();
        do {
            $week = date('D', strtotime($startdate));
            if(in_array($week, $freq_weeks)) {
                $dates[$startdate] = $week;
            }

            $startdate = date("Y-m-d", strtotime('+1 day', strtotime($startdate)));
        }while($startdate <= $enddate);
        
        return array('totalhours'=> $duehour * count($dates) ,'dates'=>$dates);
    }


    function buildLessons($coach_id) {
        if (!$coach_id)
            return false;

        $coach = $this->getCoach(0, $coach_id);
        if (!$coach)
            return false;

        $coach = $coach[$coach_id];
        $lessons = $this->calDeliverHour($coach['startdate'], $coach['enddate'], $coach['freqw'], $coach['duehour']);
        $lessons = $lessons['dates'];

        $sql = "SELECT ID, StartDate FROM client_coach_lessons WHERE CoachID = {$coach_id} ";
        $this->query($sql);
        $del = array();
        while($this->fetch()) {
            if (isset($lessons[$this->StartDate])){
                array_push($del, $this->ID);
            }
        }

        if (count($del) > 0) {
            $sql = "DELETE from client_coach_lessons where id in (".implode(',', $del).")";
            $this->query($sql);
        }

        foreach ($lessons as $startdate => $week) {
            $sql = "insert into client_coach_lessons (CID, CoachID, StartDate, EndDate, StartTime, DueHour, WeekName, Fee, AddTime, StaffID) values ('{$coach['cid']}', '{$coach_id}', '{$startdate}', '{$startdate}', '{$coach['starttime']}', '{$coach['duehour']}', '{$week}', '{$coach['fee']}', NOW(), '{$coach['staff']}')";
            $this->query($sql);
        }
        return true;
    }
    
    function updateLessonFees($coach_id) {
        if (!$coach_id)
            return false;

        $coach = $this->getCoach(0, $coach_id);
        if (!$coach)
            return false;

        $coach = $coach[$coach_id];
        
        $sql = "SELECT count(*) as lock_lesson FROM client_coach_lessons WHERE CoachID = {$coach_id} and isLocked = 1 ";
        $this->query($sql);
        if ($this->fetch() && $this->lock_lesson > 0) {
            return false;
        }

        if ($coach['fee'] == 0)
            return false;
            
        $sql = "update client_coach_lessons SET Fee = '{$coach['fee']}' where CoachID = {$coach_id}";
        $this->query($sql);

        return true;
    }


    function getLessons($cid, $coach_id=0, $lesson_id=0) {
        if (!$cid)
            return false;

        $sql = "SELECT * from client_coach_lessons WHERE CID = {$cid} ";
        if ($coach_id > 0) {
            $sql .= " AND CoachID = {$coach_id} ";
        }

        if ($lesson_id > 0) {
            $sql .= " AND ID = {$lesson_id} ";
        }

        //echo $sql."\n";
        $this->query($sql);
        $rtn = array();
        while($this->fetch()) {
            $rtn[$this->CoachID][$this->ID]['startdate'] = $this->StartDate;
            $rtn[$this->CoachID][$this->ID]['enddate'] = $this->EndDate;
            $rtn[$this->CoachID][$this->ID]['starttime'] = $this->StartTime;
            $rtn[$this->CoachID][$this->ID]['duehour'] = $this->DueHour;
            $rtn[$this->CoachID][$this->ID]['week'] = $this->WeekName;
            $rtn[$this->CoachID][$this->ID]['fee'] = $this->Fee;
            $rtn[$this->CoachID][$this->ID]['coachid'] = $this->CoachID;
            $rtn[$this->CoachID][$this->ID]['cid'] = $this->CID;
            $rtn[$this->CoachID][$this->ID]['status'] = $this->Status;
            $rtn[$this->CoachID][$this->ID]['staff'] = $this->StaffID;
            $rtn[$this->CoachID][$this->ID]['adjust'] = $this->isAdjust;
            $rtn[$this->CoachID][$this->ID]['locked'] = $this->isLocked;
        }
        //var_dump($rtn);
        return $rtn;
    }


    function completeLesson($coach_id, $lesson_id) {
        if (!$coach_id || !$lesson_id)
            return false;

        $sql = "Update client_coach_lessons SET isCompleted = 'YES' where coachid = {$coach_id} and id = {$lesson_id} ";
        return $this->query($sql);
    }

    function delLesson($coach_id) {
        if (!$coach_id)
            return false;
        $sql = "DELETE FROM client_coach_lessons where coachid = {$coach_id}";
        return $this->query($sql);
    }

    function setLesson($lesson_id, $sets, $lock_code="") {
        if (!$lesson_id || !$sets)
            return false;
        
        if ($this->isLockedLesson($lesson_id)) {
            if (!$this->checkLockCode($lock_code))
                return false;
        }

        $week = date('D', strtotime($sets['startdate']));
        $sql = "Update client_coach_lessons SET Fee = '{$sets['fee']}', Status = '{$sets['status']}', StartDate = '{$sets['startdate']}', EndDate = '{$sets['startdate']}', isAdjust = '{$sets['adjust']}', StaffID = '{$sets['staff']}' , StartTime = '{$sets['starttime']}', WeekName = '{$week}' where id = {$lesson_id}";

        return $this->query($sql);
    }

    function countStudentInLesson($lesson) {
        $sql = "select count(*) as cnt from client_coach_lessons where startdate = '{$lesson['startdate']}' and starttime = '{$lesson['starttime']}' and staffID = '{$lesson['staff']}'";
        $this->query($sql);
        if ($this->fetch()) {
            return $this->cnt;
        }
        else 
            return 0;
    }

    function isLockedLesson($lesson_id) {
        if (!$lesson_id)
            return false;
        $sql = "select count(*) as CNT from client_coach_lessons where id = {$lesson_id} and isLocked = 1";
        $this->query($sql);
        if ($this->fetch()) {
            if ($this->CNT > 0)
                return true;
        }
        return false;
    }

    function checkLockCode($token) {
        return $token == $this->LOCK_CODE; 
    }

    function lockCompletedLesson($fromDay, $toDay, $userid){
        if (!$fromDay || !$toDay || !$userid)
            return false;

        $sql = "update client_coach cc, client_coach_lessons as ccl SET ccl.isLocked = 1 where cc.id = ccl.coachid and  ccl.StartDate between '{$fromDay}' AND '{$toDay}' AND (cc.staffid = {$userid} OR cc.saleid = {$userid}) AND ccl.Status = 'Completed' and ccl.isLocked = 0";
        //die($sql);
        return $this->query($sql);
    }

    function releaseCompletedLesson() {

    }

}
?>
