<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'Template.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'VisaAPI.class.php');

$PAYMENT_ITEMS['visa'] = array('agreement'=>'sub-agent', 'extra-agreement'=>'', 'app'=>'app', 'marriage'=>'marriage', 'printing'=>'printing', 'postage'=>'postage', 'translation'=>'translation', "OSHC"=>"OSHC", 'other'=>'', 'coaching'=>'coaching', 'material'=>'material');
$PAYMENT_ITEMS['coach'] = array('coaching'=>'coaching');
$PAYMENT_ITEMS['semester'] = array('tuition'=>'tuition', 'enrollment'=>'enrollment','material'=>'material','coe'=>'coe','other'=>'other','discount'=>'discount');
$PAYMENT_ITEMS['legal'] = array('app'=>'app', 'translation'=>'translation', 'postage'=>'postage', 'printing'=>'printing', 'barrister'=>'barrister', 'other'=>'');




# check valid user
$user_id = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

# get course id
$visa_id    = isset($_REQUEST['vid'])? trim($_REQUEST['vid']) : 0;
$client_id  = isset($_REQUEST['cid'])? trim($_REQUEST['cid']) : 0;
$account_typ = isset($_REQUEST['typ'])? trim($_REQUEST['typ']) : 'visa';
$account_id = isset($_REQUEST['aid'])? trim($_REQUEST['aid']) : 0;


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

if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "SAVE"){
    
    $sets['duedate'] = isset($_POST['t_duedate'])? trim($_POST['t_duedate']) : "0000-00-00";
    $sets['duedate'] = $sets['duedate'] == ""? "0000-00-00" : $sets['duedate'];

	$sets['dueamt'] = isset($_POST['t_dueamt'])? trim($_POST['t_dueamt']) : 0;
    $sets['dueamt'] = str_replace(array('$', ','), '', $sets['dueamt']);
    $sets['dueamt'] = abs($sets['dueamt']) > 0? $sets['dueamt'] : 0;


    $sets['step'] = isset($_POST['t_step'])? trim($_POST['t_step']) : "";
    $sets['note'] = isset($_POST['t_note'])? trim($_POST['t_note']) : "";
    $sets['gst'] = isset($_POST['t_gst'])? trim($_POST['t_gst']) : 0;
    $sets['party'] = isset($_POST['t_party'])? trim($_POST['t_party']) : "";
    
	$sets['dueamt_3rd'] = isset($_POST['t_dueamt_3rd'])? trim($_POST['t_dueamt_3rd']) : 0;
    $sets['dueamt_3rd'] = str_replace(array('$', ','), '', $sets['dueamt_3rd']);
    $sets['dueamt_3rd'] = abs($sets['dueamt_3rd']) > 0? $sets['dueamt_3rd'] : 0;


    $sets['gst_3rd'] = isset($_POST['t_gst_3rd'])? trim($_POST['t_gst_3rd']) : 0;

    if ($sets['step'] == '') {
        echo "<script language='javascript'>alert('Please select one of payment items!');</script>";
    }
    else {

        if($account_id > 0){
            if (($account_typ == 'visa' && $ugs['v_agf']['m'] == 1) || $account_typ != 'visa') {
                $o_c->setAccount($account_id, $sets);
                echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
                exit;  
            }
            else {
                echo "<script language='javascript'>alert('Permission denied!');</script>"; 
            }
        }
        else{
            if (($account_typ == 'visa' && $ugs['v_agf']['i'] == 1) || $account_typ != 'visa') {
                $o_c->addAccount($user_id, $visa_id, $sets, $account_typ);
                echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
                exit;  
            }
            else {
                echo "<script language='javascript'>alert('Permission denied!');</script>"; 
            }
            
        }  
    }
}
elseif (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "DELETE"){
    if($account_id > 0){
        if (($account_typ == 'visa' && $ugs['v_agf']['m'] == 1) || $account_typ != 'visa') {
            $o_c->delAccountByID($account_id);
            echo "<script language='javascript'>alert('Deleted successfully');if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
            exit;  
        }
        else {
            echo "<script language='javascript'>alert('Permission denied!');</script>"; 
        }
        
    }
}

if ($account_typ == 'visa' && $ugs['v_agf']['v'] == 0) {
    echo "<script language='javascript'>alert('Permission denied!');</script>";
    exit;
}

# set smarty tpl
$o_tpl = new Template;

if($account_id > 0){
    $show_arr = $o_c->getAccount(0,$account_id,$account_typ);
    $o_tpl->assign('dt_arr', $show_arr[$account_id]);
}


$o_tpl->assign('ugs', $ugs);
$o_tpl->assign('vid', $visa_id);
$o_tpl->assign('cid', $client_id);
$o_tpl->assign('aid', $account_id);
$o_tpl->assign('typ', $account_typ);
$o_tpl->assign('steps', $PAYMENT_ITEMS[$account_typ]);
$o_tpl->display('client_account_detail.tpl'); 

?>
