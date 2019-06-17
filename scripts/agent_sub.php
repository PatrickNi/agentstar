<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'AgentAPI.class.php');
require_once(__LIB_PATH.'SchoolAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'ExportAPI.class.php');

$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
 

$cates['student'] = array('n'=>'Global Ambassador', 's'=>0, 'o'=>0, 'c'=>0, 'rc'=>0, 'pc'=>0, 'aid'=>array());
$t_cate = 'student';
$form = 'sub';



if (!($user_id > 0)) {
    echo "<script language='javascript'>parent.location.href='login.php';</script>";
}

$o_a = new AgentAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_s = new SchoolAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

$ugs = array();
$user_grants = $o_g->get_user_grants($user_id);
foreach ($g_user_grants as $item){
    if (array_key_exists($item, $user_grants)) {
        foreach ($g_user_ops as $key=>$op){
            $ugs[$item][$key] = $o_g->check_user_grant($user_grants[$item], $op);   
        }       
    }
}

# get user position
$view_all = 0;
$isCeo = 1;
if ($ugs['seeall']['v'] == 0){
    $view_all = $user_id;
    $isCeo = 0;
}

# get group
$agent_arr = array();
$country = $o_c->getCountry();
$status  = $o_s->getAgentStatus();
if($form != ""){
    $agent_arr = $o_a->getAgentList(0, $form, $t_cate);
    $stats = $o_a->countAgent($form, $view_all, $fromDay, $toDay);

    foreach ($agent_arr as $aid => $v) {
        $k = isset($cates[$v['cate']])? $v['cate'] : 'other';

        array_push($cates[$k]['aid'], $aid);    
        if (!isset($stats[$aid]))
            continue;
    

        $cates[$k]['s' ] += $stats[$aid]['stdcnt'];         
        $cates[$k]['o' ] += $stats[$aid]['offer'];
        $cates[$k]['c' ] += $stats[$aid]['coe'];
        $cates[$k]['rc'] += $stats[$aid]['rcomm'];
        $cates[$k]['pc'] += $stats[$aid]['pcomm'];      

        $agent_arr[$aid]['cn'] = isset($country[$v['country']])? $country[$v['country']] : '';
        $agent_arr[$aid]['sn'] = isset($status[$v['stid']])? $status[$v['stid']] : '';      
    }
}



# output
$o_tpl = new Template;
$o_tpl->assign('isCeo', $isCeo);
//$o_tpl->assign('country_arr', $o_c->getCountry());
//$o_tpl->assign('status_arr', $o_s->getAgentStatus());
$o_tpl->assign("agent_arr", $agent_arr);
if(isset($stats)){
    $o_tpl->assign("stats", $stats);
}
$o_tpl->assign("totals", $cates);
$o_tpl->assign("form", $form);
$o_tpl->assign("ugs", $ugs);

$o_tpl->display("agent_sub.tpl");

?>

