<?php
require_once('../etc/const.php');

require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ChecklistAPI.class.php');
require_once(__LIB_PATH.'VisaAPI.class.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

$o_c = new ChecklistAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_v = new VisaAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

if (isset($_REQUEST['tpl_id']) && $_REQUEST['tpl_id'] > 0)
    $tpl_id = $_REQUEST['tpl_id'];
else 
    die('No template id');

$visa_cate_id = isset($_REQUEST['t_visa'])? (string)trim($_REQUEST['t_visa']) : 0;
$visa_class_id = isset($_REQUEST['t_class'])? (string)trim($_REQUEST['t_class']) : 0; 


$alert_msg = "";
if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "ADDEXIST"){
    if (isset($_POST['t_idx_existed']) && $_POST['t_idx_existed'] != '' && $o_c->addItem($tpl_id, $_POST['t_idx_existed'])) {
        $alert_msg = "<script>alert('Add from an existed item success');</script>";
    }
    else {
        $alert_msg = "<script>alert('Add from an existed item failed');</script>";
    }
}
elseif (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "CREATENEW"){
    $new_code = $o_c->addMeta(isset($_POST['t_name'])? $_POST['t_name'] : '', isset($_POST['t_tip'])? $_POST['t_tip'] : '');
    if ($o_c->addItem($tpl_id, $new_code)) {
        $alert_msg = "";//"<script>alert('Create a new item success');</script>";
    }
    else {
        $alert_msg = "";//"<script>alert('Create a new item failed');</script>";
    }
}
elseif (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "SETVISACATE"){
    if ($o_c->setTpl($tpl_id,'','',$visa_cate_id)) {
        $alert_msg = "<script>alert('Set visa category success');</script>";
    }
    else {
        $alert_msg = "<script>alert('Set visa category  failed');</script>";
    }
}
elseif (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "SETVISACLASS"){
    if ($o_c->setTpl($tpl_id,'','', 0, $visa_class_id)) {
        $alert_msg = "<script>alert('Set visa subclass success');</script>";
    }
    else {
        $alert_msg = "<script>alert('Set visa subclass failed');</script>";
    }
}
elseif (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "DELETEITEM"){
    $item_id = isset($_POST['del_item_id'])? $_POST['del_item_id'] : 0;
    $res = $o_c->delItem($item_id);
    echo json_encode(array('succ'=>$res? 1 : 0));
    exit; 

}
elseif (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "MODIFY_TIT"){
    $item_id = isset($_POST['item_id'])? $_POST['item_id'] : 0;
    $item = $o_c->getItemById($item_id);  

    $item_tit = isset($_POST['item_tit'])? $_POST['item_tit'] : '';
    $item_tit = iconv('utf-8', 'GBK', (string)trim($item_tit));
    $new_code = $o_c->addMeta($item_tit,$item['tip']); 
    $res = false;
    if ($item['idx'] != $new_code) {
        $res = $o_c->setItemCode($item_id, $new_code);
    }
    else {
        $res = true;
    }
    echo json_encode(array('succ'=>$res? 1 : 0));
    exit;
}
elseif (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "MODIFY_TIP"){
    $item_id = isset($_POST['item_id'])? $_POST['item_id'] : 0;
    $item = $o_c->getItemById($item_id);  
    
    $item_tip = isset($_POST['item_tip'])? $_POST['item_tip'] : '';
    $item_tip = iconv('utf-8', 'GBK', (string)trim($item_tip));

    $res = $o_c->setMeta($item['idx'], '', $item_tip, true);
    echo json_encode(array('succ'=>$res? 1 : 0));
    exit;    
}
elseif (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "RANK_ITEM"){
    $res = $o_c->rankItems($tpl_id, isset($_POST['ord_item'])? explode('|',$_POST['ord_item']) : array());
    echo json_encode(array('succ'=>$res? 1 : 0));
    exit;    
}


$tpl_arr  = $o_c->getTpls($tpl_id);
$item_arr = $o_c->getItems($tpl_id);
$meta_arr = $o_c->getMetas($tpl_id);

$visa_cate_id = $tpl_arr['visacate'];
$visa_class_id = $tpl_arr['visaclass'];

$visa_arr = array();
$visa_arr = $o_v->getVisaNameArr();
$class_arr = array();
if ($visa_cate_id > 0) {
    $class_arr = $o_v->getVisaClassArr($visa_cate_id, 'Active');
}

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('visa_arr', $visa_arr);
$o_tpl->assign('visaclass_arr', $class_arr);
$o_tpl->assign('tpl_arr', $tpl_arr);
$o_tpl->assign('item_arr', $item_arr);
$o_tpl->assign('meta_arr', $meta_arr);
$o_tpl->assign('alert_msg', $alert_msg);
$o_tpl->assign('visa_cate_id', $visa_cate_id);
$o_tpl->assign('visa_class_id', $visa_class_id);
$o_tpl->assign('tpl_id', $tpl_id);
$o_tpl->display('checklist_detail.tpl');

?>
