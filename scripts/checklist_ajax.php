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


$app_arr = $o_c->getApp($cl_typ, $cl_appid);
if (count($app_arr) == 0 && $cl_act == '') {
    $o_tpl->assign('section', 'show_select');
    $o_tpl->assign('cl_typ', $cl_typ);
    $o_tpl->assign('cl_appid', $cl_appid);
    $o_tpl->assign('tpl_arr', $o_c->getTpls());
    $output = $o_tpl->fetch('checklist_ajax.tpl');
}
elseif ($cl_act == 'change_tpl') {
    if(!$cl_tplid) {
        $output = 'Incorrect parameters';
    }
    else {
        $o_tpl->assign('section', 'confirm_select');
        $o_tpl->assign('cl_typ', $cl_typ);
        $o_tpl->assign('cl_appid', $cl_appid);
        $o_tpl->assign('cl_tplid', $cl_tplid);
        $o_tpl->assign('item_arr', $o_c->getItems($cl_tplid, true));
        $output = $o_tpl->fetch('checklist_ajax.tpl');
    }
}
elseif ($cl_act == 'apply_tpl') {
    if(!$cl_tplid) {
        $output = 'Incorrect parameters';
    }
    else {
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

echo iconv('GB2312', 'UTF-8', $output);
exit;
?>
