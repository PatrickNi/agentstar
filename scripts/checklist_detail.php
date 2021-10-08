<?php
require_once('../etc/const.php');

require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ChecklistAPI.class.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

$o_c = new ChecklistAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
if (isset($_REQUEST['tpl_id']) && $_REQUEST['tpl_id'] > 0)
    $tpl_id = $_REQUEST['tpl_id'];
else 
    die('No template id');

$alert_msg = "";
if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "ADDEXIST"){

}
elseif (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "CREATENEW"){
    $new_code = $o_c->addMeta(isset($_POST['t_name'])? $_POST['t_name'] : '', isset($_POST['t_idx'])? $_POST['t_idx'] : '', isset($_POST['t_tip'])? $_POST['t_tip'] : '');
    if ($o_c->addItem($tpl_id, $new_code)) {
        $alert_msg = "<script>alert('CreateNew success');</script>";
    }
    else {
        $alert_msg = "<script>alert('CreateNew failed');</script>";
    }
}




$tpl_arr  = $o_c->getTpls($tpl_id);
$item_arr = $o_c->getItems($tpl_id);

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('tpl_arr', $tpl_arr);
$o_tpl->assign('item_arr', $item_arr);
$o_tpl->assign('alert_msg', $alert_msg);
$o_tpl->display('checklist_detail.tpl');

?>
