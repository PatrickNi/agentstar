<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'AgentAPI.class.php');
require_once(__LIB_PATH.'SchoolAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'ExportAPI.class.php');

set_time_limit(-1);
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
 

$cates['student'] = array('n'=>'Ambassador', 's'=>0, 'o'=>0, 'c'=>0, 'rc'=>0, 'pc'=>0, 'aid'=>array());
$t_cate = 'student';
$form = 'sub';



if (!($user_id > 0)) {
    echo "<script language='javascript'>parent.location.href='login.php';</script>";
}

$o_a = new AgentAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_s = new SchoolAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);


if(isset($_POST['qflag']) && strtoupper($_POST['qflag']) == "REMOVE" && isset($_POST['agentId'])){
    $o_a->delAgentByArr($_POST['agentId']);
}

$ugs = array();
$user_grants = $o_g->get_user_grants($user_id);

include_once dirname(__FILE__).'/init_grants.php';
foreach ($g_user_grants as $item){
    if (array_key_exists($item, $user_grants)) {
        foreach ($g_user_ops as $key=>$op){
            $ugs[$item][$key] = $o_g->check_user_grant($user_grants[$item], $op);   
        }       
    }
}

$staff_id = $user_id;
if (isset($_REQUEST['t_staff']) && $_REQUEST['t_staff'] > 0) {
    $staff_id = $_REQUEST['t_staff'];
}

# get group
$agent_arr = array();
$country = $o_c->getCountry();
$status  = $o_s->getAgentStatus();
if($form != ""){
    $agent_arr = $o_a->getAgentList(0, $form, $t_cate, $staff_id);
    $stats = $o_a->countAgent($form, $staff_id, $fromDay, $toDay);

    foreach ($agent_arr as $aid => $v) {
        $k = isset($cates[$v['cate']])? $v['cate'] : 'other';

        /*   
        if (!isset($stats[$aid]) || $stats[$aid]['stdcnt'] == 0) {
            unset($agent_arr[$aid]);
            continue;
        }
        */
        array_push($cates[$k]['aid'], $aid);
    

        @$cates[$k]['s' ] += $stats[$aid]['stdcnt'];         
        @$cates[$k]['o' ] += $stats[$aid]['offer'];
        @$cates[$k]['c' ] += $stats[$aid]['coe'];
        @$cates[$k]['rc'] += $stats[$aid]['rcomm'];
        @$cates[$k]['pc'] += $stats[$aid]['pcomm'];      

        $agent_arr[$aid]['cn'] = isset($country[$v['country']])? $country[$v['country']] : '';
        $agent_arr[$aid]['sn'] = $v['verify'] == 1 ? 'Approved' : 'New';      
    }

    if (isset($_REQUEST['bt_export']) && strtoupper($_REQUEST['bt_export']) == strtoupper("Export Emails")){
        $o_ept = new ExportAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, true);
        $mailArr = array();
        foreach ($agent_arr as $id => $v){
            if ($v['cate'] != $t_cate)
                continue;
            
            array_push($mailArr, $v['email']);
        }
        $o_ept->exportAgentEmail($mailArr, $form);
    }
}


# output
$o_tpl = new Template;
$o_tpl->assign("agent_arr", $agent_arr);
if(isset($stats)){
    $o_tpl->assign("stats", $stats);
}
$o_tpl->assign("totals", $cates);
$o_tpl->assign("form", $form);
$o_tpl->assign("ugs", $ugs);
$o_tpl->assign('staffid', $staff_id);
# get user position
if (isset($ugs['rpt_staff']) && $ugs['rpt_staff']['v'] == 1){
    $o_tpl->assign('slUsers', $o_g->getUserNameArr());
}else {
    $o_tpl->assign('slUsers', $o_g->getUserNameArr($staff_id));
}

$o_tpl->display("agent_sub.tpl");

?>

