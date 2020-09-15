<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'MysqlDB.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');

$db = new MysqlDB(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, true);

set_time_limit(0);

$sql = "SELECT SEM, CCID, StartDate FROM client_course_sem WHERE startDate >= NOW() + INTERVAL 21 DAY and SEM > 1 and isactive = 1";
$db->query($sql);
$semesters = array();
while($db->fetch()) {
    array_push($semesters, array('chase_due'=>date('Y-m-d', strtotime('-21 day', strtotime($db->StartDate))), 'item'=>"Chase tuition on SEM *{$db->SEM}", 'course_id'=>$db->CCID));
}
echo "Total: ".count($semesters)."\n";


foreach ($semesters as $v) {
    $course_process['subject'] = 0;
    $course_process['detail'] = '';
    $course_process['done'] = 0;
    $course_process['date'] = '0000-00-00';
    $course_process['due']  = $v['chase_due'];
    $course_process['add']  = $v['item'];
    
    $chase = $o_c->checkCourseProcessByItem($v['course_id'], $course_process['add']);   

    //var_dump($chase, $course_process, $v);exit; 
    if (!$chase) {
        $course_process['order'] = $o_c->getCourseProcessOrder(0, $v['course_id']);
        $o_c->resetCourseProcessOrder($v['course_id'], $course_process['order']);
        $course_process['order'] = $course_process['order'] + 1; 
        $course_process['isAuto'] = 0;
        $o_c->addCourseProcess($v['course_id'], $course_process);
    }
    elseif (isset($chase['id']) && $chase['id'] > 0) {
        $o_c->setCourseProcessDue($chase['id'], $chase_due);
    }
    else {
        $course_process = array();
    }
}
                        