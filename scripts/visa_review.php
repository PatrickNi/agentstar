<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'VisaAPI.class.php');
require_once(__LIB_PATH.'pagedivide.class.php');


# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;
if (!($user_id > 0)) {
    echo "<script language='javascript'>parent.location.href='index.php';</script>";
}

# inital variable
$cat_id = isset($_REQUEST['catid'])? trim($_REQUEST['catid']) : 0;
$sub_id = isset($_REQUEST['subid'])? trim($_REQUEST['subid']) : 0;
$page = isset($_GET['p'])? trim($_GET['p']) : 1;
$page_size   = 50;
$page_offset = 10;
$self_url   = "client_visa.php";

$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_v = new VisaAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);



# get review
$review_arr = array();
$page_url   = "";
if ($cat_id > 0 && $sub_id > 0){
	$review_arr = $o_c->getVisaReview($cat_id, $sub_id, $user_id);
	
	# add process
	$proc_arr = $o_c->getProcessDateByVisa($review_arr);		
}

# get title
$title_arr = array();
$title_arr = $o_v->getVisaItemArr($cat_id, $sub_id);

# get category
$cat_arr = $o_v->getVisaNameArr();
$sub_arr = $o_v->getVisaClassArr($cat_id);

# get column length
$col_len = count($title_arr) + 2;

# set smarty tpl
$o_tpl = new Template;
$o_tpl->assign('category_arr', $cat_arr);
$o_tpl->assign('subclass_arr', $sub_arr);
$o_tpl->assign('review_arr', $review_arr);
$o_tpl->assign('title_arr', $title_arr);

$o_tpl->assign('col_len', $col_len);
$o_tpl->assign('catid', $cat_id);
$o_tpl->assign('subid', $sub_id);
$o_tpl->display('visa_review.tpl'); 

?>
