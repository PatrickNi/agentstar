<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'SchoolAPI.class.php');


# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
    echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

$o_s = new SchoolAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$isNone = "none";
$cat_id = isset($_REQUEST['catid'])? trim($_REQUEST['catid']) : 0;


# get action
$action = isset($_REQUEST["at_{$cat_id}"])? trim($_REQUEST["at_{$cat_id}"]) : "";
switch (strtoupper($action)){
    case __ACT_SUBCLASS:
        header("Location: institute_subcate.php?catid={$cat_id}");
        exit;
        break;
    case __ACT_DEL:
        $o_s->delCategory($cat_id); 
        break;
    case __ACT_EDIT:
        $isNone = "block";
        break;      
    default:
        break;                  
}

if (isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "SAVE"){
    $cat_name = isset($_REQUEST['t_name'])? trim($_REQUEST['t_name']) : "";
    $cat_rank = isset($_REQUEST['t_rank'])? trim($_REQUEST['t_rank']) : 0;
    
    if($cat_id > 0){
        $o_s->setCategory($cat_id, $cat_name, $cat_rank);
    }else{
        $o_s->addCategory($cat_name, $cat_rank);
    }
    $cat_id = 0;
    $isNone = "none";
}elseif (isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "NEW"){
    $isNone = "block";
}


# get action
$action_arr = array(__ACT_EDIT => "Edit",  __ACT_SUBCLASS => "SubCategory", __ACT_DEL => "Delete");//,

# format array
$cat_arr = $o_s->getCategoryWithRank();



# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('act_arr', $action_arr);
$o_tpl->assign('category_arr', $cat_arr);

if($cat_id > 0 && array_key_exists($cat_id, $cat_arr)){
    $o_tpl->assign('dt_name', $cat_arr[$cat_id]['name']);
    $o_tpl->assign('dt_rank', $cat_arr[$cat_id]['rank']);
}

$o_tpl->assign('catid', $cat_id);
$o_tpl->assign('isNone', $isNone);
$o_tpl->display('institute_category.tpl');
?>
