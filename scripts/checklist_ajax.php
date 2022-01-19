<?php
require_once('../etc/const.php');

require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ChecklistAPI.class.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

$cl_act = isset($_REQUEST['cl_act'])? $_REQUEST['cl_act'] : '';
$cl_typ = isset($_REQUEST['cl_typ'])? $_REQUEST['cl_typ'] : '';
$cl_appid = isset($_REQUEST['cl_appid'])? $_REQUEST['cl_appid'] : 0;
$cl_tplid = isset($_REQUEST['cl_tplid'])? $_REQUEST['cl_tplid'] : 0;

if (!$cl_typ || !$cl_appid)
    die('Incorrect parameters');

$o_c = new ChecklistAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_tpl = new Template;


if ($cl_act == 'app_add') {
    $cl_new_item = isset($_REQUEST['cl_new_item'])? $_REQUEST['cl_new_item'] : '';
    if ($cl_new_item != '') {
        $cl_new_item = iconv('utf-8', 'GBK', (string)trim($cl_new_item));
        $o_c->addAppItems($cl_typ, $cl_appid, $cl_new_item);
    }
}
elseif ($cl_act == 'del_app') {
    $res = $o_c->delAppItems(isset($_REQUEST['cl_app_item'])? $_REQUEST['cl_app_item'] : 0);
    echo json_encode(array('succ'=>$res? 1 : 0));
    exit;
}
elseif ($cl_act == 'rcd_app') {
    $app_item_id = isset($_REQUEST['cl_app_item'])? $_REQUEST['cl_app_item'] : 0;
    $app_item_rcd = isset($_REQUEST['cl_app_rcd']) && $_REQUEST['cl_app_rcd'] == 1? date('Y-m-d') : '0000-00-00';
    $res = $o_c->updateReceived(array($app_item_id=>$app_item_rcd));
    echo json_encode(array('succ'=>$res? $app_item_rcd : 0));
    exit;    
}
elseif ($cl_act == 'rank_app') {
    $app_item_rank = isset($_REQUEST['cl_ord'])? $_REQUEST['cl_ord'] : '';
    $res = $o_c->rankAppItems($cl_typ, $cl_appid, explode('|', $app_item_rank));
    echo json_encode(array('succ'=>$res? 1 : 0));
    exit; 
}
elseif ($cl_act == 'edit_app') {
    $app_item_id = isset($_REQUEST['cl_app_item'])? $_REQUEST['cl_app_item'] : 0;
    $app_item_tit = isset($_REQUEST['cl_app_tit'])? $_REQUEST['cl_app_tit'] : '';
    $app_item_tit = iconv('utf-8', 'GBK', (string)trim($app_item_tit));
    $res = $o_c->editAppItemTit($app_item_id, $app_item_tit);
    echo json_encode(array('succ'=>$res? 1 : 0));
    exit;    
}
       

$app_arr = $o_c->getApp($cl_typ, $cl_appid);
$alltpl_arr = $o_c->getTpls(0,true);
if (count($app_arr) == 0 && $cl_act == '') {
    $tpl_ids = $o_c->findAppTpls($cl_typ, $cl_appid);
    $tpl_arr = array();
    $cl_tplid  = 0;
    foreach ($tpl_ids as $_id) {
        if (isset($alltpl_arr[$_id])){
            $tpl_arr[$_id] = $alltpl_arr[$_id];
            $cl_tplid = $_id;
        }
    }

    $o_tpl->assign('section', 'confirm_select');
    $o_tpl->assign('tpl_arr', $tpl_arr);
    $o_tpl->assign('cl_typ', $cl_typ);
    $o_tpl->assign('cl_appid', $cl_appid);
    $o_tpl->assign('cl_tplid', $cl_tplid);
    $o_tpl->assign('item_arr', $cl_tplid > 0? $o_c->getItems($cl_tplid, true) : array());
    $output = $o_tpl->fetch('checklist_ajax.tpl');
}
elseif ($cl_act == 'change_tpl' && count($app_arr) == 0) {
    if(!$cl_tplid) {
        $output = 'Incorrect parameters';
    }
    else {
        $o_tpl->assign('section', 'confirm_select');
        $o_tpl->assign('tpl_arr', $alltpl_arr);
        $o_tpl->assign('cl_typ', $cl_typ);
        $o_tpl->assign('cl_appid', $cl_appid);
        $o_tpl->assign('cl_tplid', $cl_tplid);
        $o_tpl->assign('item_arr', $o_c->getItems($cl_tplid, true));
        $output = $o_tpl->fetch('checklist_ajax.tpl');
    }
}
elseif ($cl_act == 'apply_tpl' || $cl_act == 'apply_new') {
    if(!$cl_tplid && $cl_act == 'apply_tpl') {
        $output = 'Incorrect parameters';
    }
    else {
        if ($cl_act == 'apply_new') {
            $cl_tplid = 0;
        }
        $o_c->createApp($cl_tplid, $cl_typ, $cl_appid);
        $o_tpl->assign('section', 'show_detail');
        $o_tpl->assign('cl_typ', $cl_typ);
        $o_tpl->assign('cl_appid', $cl_appid);
        $o_tpl->assign('app_arr', $o_c->getApp($cl_typ, $cl_appid));
        $output = $o_tpl->fetch('checklist_ajax.tpl');
    }
}
elseif ($cl_act == 'save_app') {
    $cl_item_new = isset($_REQUEST['cl_item_new'])? $_REQUEST['cl_item_new'] : '';
    $cl_rd_new = isset($_REQUEST['cl_rd_new'])? $_REQUEST['cl_rd_new'] : '';

    $app_rds = array();
    foreach ($_POST as $k => $v) {
        if ($v != '' && preg_match('/^cl_rd_([\d]+)$/', $k, $m)) {
            $app_rds[$m[1]] = $v;
        }
    }

    if (count($app_rds) > 0) {
        $o_c->updateReceived($app_rds);
    }

    if ($cl_item_new != '') {
        $cl_item_new = iconv('utf-8', 'GBK', (string)$cl_item_new);
        $o_c->addAppItems($cl_typ, $cl_appid, $cl_item_new, $cl_rd_new);
    }

    $o_tpl->assign('section', 'show_detail');
    $o_tpl->assign('cl_typ', $cl_typ);
    $o_tpl->assign('cl_appid', $cl_appid);
    $o_tpl->assign('app_arr', $o_c->getApp($cl_typ, $cl_appid));
    $output = $o_tpl->fetch('checklist_ajax.tpl');
}
elseif(count($app_arr) > 0) {
    $o_tpl->assign('section', 'show_detail');
    $o_tpl->assign('cl_typ', $cl_typ);
    $o_tpl->assign('cl_appid', $cl_appid);
    $o_tpl->assign('app_arr', $o_c->getApp($cl_typ, $cl_appid));
    $output = $o_tpl->fetch('checklist_ajax.tpl');
}

echo iconv('GBK', 'utf-8', $output);
exit;
?>
