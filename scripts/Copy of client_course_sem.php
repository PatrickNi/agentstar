<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'SchoolAPI.class.php');
ini_set("display_errors", 1);
error_reporting(2047);
# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;


# get course id
$course_id = isset($_REQUEST['courseid'])? trim($_REQUEST['courseid']) : 0;
$client_id = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;
$sem_id = isset($_REQUEST['semid'])? trim($_REQUEST['semid']) : 0;

$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

//user grants
$ugs = array();
$user_grants = $o_g->get_user_grants($user_id);
foreach ($g_user_grants as $item){
	if (array_key_exists($item, $user_grants)) {
		foreach ($g_user_ops as $key=>$op){
			$ugs[$item][$key] = $o_g->check_user_grant($user_grants[$item], $op); 	
		}		
	}
}



# add new semenster
if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "ADD NEW SEMESTER"){
	$sem_id = $o_c->addCourseSem($course_id);
}


# delete semenster
if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "DELETE"){
	$sem_id = $o_c->delCourseSem($sem_id);
	echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
	exit;
}

if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "SAVE"){
	if ($sem_id > 0){
		$semOrder = $o_c->getCourseSemOrder($sem_id);
	    $sems['fee'] = isset($_POST['t_fee'])? trim($_POST['t_fee']) : "";
	    $sems['fee'] = $sems['fee'] == ""? 0 : $sems['fee'];
	    
	    $sems['fdate'] = isset($_POST['t_fdate'])? trim($_POST['t_fdate']) : "";
	    $sems['fdate'] = $sems['fdate'] == ""? "0000-00-00" : $sems['fdate'];
	    
	    $sems['tdate'] = isset($_POST['t_tdate'])? trim($_POST['t_tdate']) : "";
		$sems['tdate'] = $sems['tdate'] == ""? "0000-00-00" : $sems['tdate'];
		
		$sems['due'] = isset($_POST['t_due'])? trim($_POST['t_due']) : "";	    
	    $sems['due'] = $sems['due'] == ""? "0" : $sems['due'];
	    
	    $sems['due'] = isset($_POST['t_due'])? trim($_POST['t_due']) : "";	
	    $sems['done'] = isset($_POST['done'])? trim($_POST['done']) : 1;
	    
	    $sems['refuse']  = isset($_POST['t_rf'])? (string)trim($_POST['t_rf']) : "";
		$sems['refuse']  = $sems['refuse'] != ""? $sems['refuse'] : "";	
	    
	    if ($ugs['i_rev']['v'] == 1){
		    $sems['rcomm'] = isset($_POST['t_rcomm'])? trim($_POST['t_rcomm']) : "";
		    $sems['rcomm'] = $sems['rcomm'] == ""? "0" : $sems['rcomm'];
		    
		    $sems['ivdate'] = isset($_POST['t_ivdate'])? trim($_POST['t_ivdate']) : "";
		    $sems['ivdate'] = $sems['ivdate'] == ""? "0000-00-00" : $sems['ivdate'];
		    
		    $sems['reddate']= isset($_POST['t_reddate'])? trim($_POST['t_reddate']) : "";
		    $sems['reddate']= $sems['reddate'] == ""? "0000-00-00" : $sems['reddate'];
		    
		    $sems['redcomm'] = isset($_POST['t_redcomm'])? trim($_POST['t_redcomm']) : "";
		    $sems['redcomm'] = $sems['redcomm'] == ""? "0" : $sems['redcomm'];
		    
		    $sems['ccomm'] = isset($_POST['t_ccomm'])? trim($_POST['t_ccomm']) : "";
		    $sems['ccomm'] = $sems['ccomm'] == ""? "0" : $sems['ccomm'];
		    
		    $sems['cdate'] = isset($_POST['t_cdate'])? trim($_POST['t_cdate']) : "";
		    $sems['cdate'] = $sems['cdate'] == ""? "0000-00-00" : $sems['cdate'];

		    $sems['nfdate'] = isset($_POST['t_nfdate'])? trim($_POST['t_nfdate']) : "";
		    $sems['nfdate'] = $sems['nfdate'] == ""? "0000-00-00" : $sems['nfdate'];
		    
		    $sems['discount'] = isset($_POST['t_discount'])? trim($_POST['t_discount']) : "";
            $sems['discount'] = $sems['discount'] == ""? "0" : $sems['discount'];		    

   		    $sems['discountdate'] = isset($_POST['t_discountdate'])? trim($_POST['t_discountdate']) : "";
		    $sems['discountdate'] = $sems['discountdate'] == ""? "0000-00-00" : $sems['discountdate'];		    
	    }
        
        if (!$o_c->auditSemStartDate($course_id, $sem_id, $sems['fdate'])){
            echo "<script language='javascript'>alert('Error sem start date!');</script>";       	
        }else{
         	$sets['done'] = 0;
	        $sets['due']  = "0000-00-00";	        		       	
	        
	        #set process of course start
	        if ($sems['fdate'] != "" && $sems['fdate'] != "0000-00-00") {		
					$step_1 = $o_c->checkSemProcess($sem_id, __SEM_START);
					if($step_1 == 0){
			        	$cate_id = $o_c->getCateIDbyCourse($course_id);
			        	$courses = $o_c->getCourseByUser($course_id);
		        		$sets['subject'] = "AUTO: Course Started - Send Invoice";
			        	$sets['date']    = $sems['fdate'];
		        		$sets['detail']  = "SEM *{$semOrder}: in {$courses[$cate_id][$course_id]['school']}. \n";  		
						$sets['order'] = $o_c->getSemProcessOrder(0, $sem_id);
						$o_c->resetSemProcessOrder($sem_id, $sets['order']);
						$sets['order'] = $sets['order'] + 1; 
						$sets['key'] = __SEM_START;
						$step_1 = $o_c->addSemProcess($sem_id, $sets);	
					}
			        #set process of invoice sent
			        if ($step_1 > 0 && $sems['ivdate'] != "" && $sems['ivdate'] != "0000-00-00") {		
			        		#get course category
			        		$sets['detail']  = "Invoice sent on {$sems['ivdate']}. \n";  									
							$step_2 = $o_c->checkSemProcess($sem_id, __SEM_START.__SEM_INVOICE);
			        		if($step_2 == 0){
				        		$o_c->changeSemProcess($step_1, __SEM_START.__SEM_INVOICE, $sets['detail']);
							}

							#set process of invoice sent
					        if ($step_1 > 0 && $sems['reddate'] != "" && $sems['reddate'] != "0000-00-00") {		
								$sets['done'] = 1;							
								$o_c->doneSemProcess($step_1, __SEM_START.__SEM_INVOICE.__SEM_COMM, $sets['done']);							
					        }					        
			        }	 
	        }
	        $o_c->setCourseSem($sem_id, $ugs['i_rev']['v'], $sems);
	        if ($o_c->getCourseSemOrder($sem_id) == 1) {
	        	$o_c->setSem1Date($course_id,  $sems['fdate']);
	        }
           echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
           exit;
        }		
	}	
}


# get cource
$course_arr = array();
$course_arr = array();
$cateid = $o_c->getCateIDbyCourse($course_id);
$course_arr = $o_c->getCourseByUser($course_id);

# get course sem
$sem_arr = array();
$sem_arr = $o_c->getCourseSem($course_id);


# set smarty tpl
$o_tpl = new Template;
if($sem_id > 0 && array_key_exists($sem_id, $sem_arr)){
	$o_tpl->assign('sem_arr', $sem_arr[$sem_id]);
}

# check has sub agents
$chk_arr = $o_c->getOneClientInfo($client_id);
if (is_array($chk_arr) && isset($chk_arr['agent']) && $chk_arr['agent'] > 0){
	$o_tpl->assign('has_sub_agent', 1);
}

$o_tpl->assign('sem_all', $sem_arr);

if($course_id > 0 && array_key_exists($cateid, $course_arr)&& array_key_exists($course_id, $course_arr[$cateid])){
	$o_tpl->assign('dt_arr', $course_arr[$cateid][$course_id]);
}

if($sem_id > 0){
	$o_tpl->assign('process_arr', $o_c->getSemProcess($sem_id));
}
$o_tpl->assign('qual_name', $course_arr[$cateid][$course_id]['qualname']);
$o_tpl->assign('major_name', $course_arr[$cateid][$course_id]['majorname']);
$o_tpl->assign('semid', $sem_id);
$o_tpl->assign('courseid', $course_id);
$o_tpl->assign('cid', $client_id);
$o_tpl->assign('ugs', $ugs);
$o_tpl->assign('isapprove', ($o_c->getCourseConsult($client_id) == $user_id) || ($ugs['i_rev']['v'] == 1) || (isset($ugs['c_track']['v']) && $ugs['c_track']['v'] == 1)? 1 :  0);
$o_tpl->display('client_course_sem.tpl');
?>
