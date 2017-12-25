<?php
define("__ROOT_PATH", "/Library/WebServer/Documents/immi");//e:/inetpub/wwwroot/

define("__LIB_PATH", __ROOT_PATH."lib/");
define("__DOWNLOAD_PATH", __ROOT_PATH."download/");
define("__SMARTY_LIB_PATH", __LIB_PATH."Smarty/");
define("__SMARTY_TPL_PATH", __ROOT_PATH."/tpl/");
define("__SMARTY_CPL_PATH", __SMARTY_TPL_PATH."tpl_c/");
define("__SMARTY_CFG_PATH", __SMARTY_TPL_PATH."config/");
define("__SMARTY_CAH_PATH", __SMARTY_TPL_PATH."cache/");

# database configuration
define("__DB_HOST", "localhost");
define("__DB_USER", "root");
define("__DB_PASSWORD", "dowhatyoudo"); //
define("__DB_DATABASE", "geic");

define("__REDIR_PHP", "redir.php");
define("__SCRIPT_URL", "http://localhost/immi/scripts/");

define("__SUPERVISOR_TAG", "S");

# action define
define("__ACT_EDIT", "E");
define("__ACT_DEL", "D");
define("__ACT_PROCESS", "P");
define("__ACT_DONE", "F");
define("__ACT_NEW", "N");
define("__ACT_ACTIVE", "A");
define("__ACT_REFUSE", "R");


# define action for visa setting
define("__ACT_SUBCLASS", "SUB");
define("__ACT_RElATION", "REAL");


# define action for sem
define("__ACT_SEM", "S");


# define process for course
define("__C_APPLY_OFFER", 1); // collect document
define("__C_RECEIVE_OFFER", 2); // apply offer
define("__C_PASS_OFFER", 3); // receive offer
define("__C_PAY_TUITION_FEE", 4); //pay fee
define("__C_GET_COE", 5);
define("__C_PASS_COE", 6);
$course_process_arr = array(__C_APPLY_OFFER=>"Collect Document", __C_RECEIVE_OFFER=>"Apply Offer", __C_PASS_OFFER=>"Receive Offer", __C_PAY_TUITION_FEE=>"Pay tuition fee", __C_GET_COE=>"Get COE", __C_PASS_COE=>"Student Visa Extension");

# user right configuration
$position_arr = array('E'=>'Employee', 'M'=>'Manager', 'C'=>'CEO');
$mark_arr	  = array('S'=>'Super', 'C'=>'Course', 'V'=>'Visa');
define('ADV_BI', 'BI');
define('ADV_CI', 'CI');
define('ADV_VI', 'VI');
define('ADV_VTA', 'VTA');
define('ADV_VSA', 'VSA');
define('ADV_VAS', 'VAS');
define('ADV_VAF', 'VAF');
define('ADV_STP', 'STP');

# contact array
$contact_type_arr = array("D" => "DIMIA", "O" => "Office Suplier");

# client type
$client_type_arr = array('Study'=>"Study", 'visa'=>"Immi", 'all'=>"all");

# define file type
define("__FILE_VISA", "visa");
define("__FILE_AGENT", "agent");
define("__FILE_INSTITUTE", "institute");
define("__FILE_INSTITUTE_PROCESS", "institute_proc");
define("__FILE_QUAL", "qual");
define("__FILE_WXP", "wxp");
define("__FILE_APPLY_COURSE", "course");

#define open case
define("__OPEN_CASE", 1);

define("__COURSE_CONSULTANT", "C");
define("__VISA_PAPERWORK", "V");
define("__AGREEMENT_STAFF", "A");
define("__RECEPTION", "R");

#sem process auto template
define("__SEM_START", "ST");
define("__SEM_INVOICE", "IV");
define("__SEM_COMM", "CM");

#visa status
$g_visa_status = array('active', 'client decline', 'grant', 'withdraw', 'cancel agreement', 'stop Agent', 'refused', 'declined');


#grants
$g_user_grants = array('b_service', 'b_visa', 'b_ctype', 'b_suba','b_epd', 'b_abouts', 'b_nocp', 'b_fromto',
					   'c_service', 'c_user', 'c_track', 'c_rev',
					   'v_service', 'v_visa', 'v_abas', 'v_agsf', 'v_vpwk', 'v_agd', 'v_agf','v_pay', 'v_dp', 'v_epd',
					   'i_service', 'i_course', 'i_proc', 'i_comm', 'i_rev', 'i_st','i_del', 'i_nocp', 'i_export','i_soc',
					   'a_service', 'a_dt', 'a_proc', 'a_st', 'a_rev', 'a_top', 'a_sub', 'a_del',
					   'seeall', 'p_duedate', 'p_h',
					   'rpt_staff', 'rpt_staff_rc', 'rpt_staff_pc',
					   'export', 'v_track', 'todo_visa', 'todo_course');
					   
$g_user_ops = array('v'=>0x1, 'i'=>0x2, 'm'=>0x4, 'd'=>0x8);	

define('FORBID_RIGHTCLK', 'oncontextmenu="window.event.returnvalue=false"');
define('FORBID_SELECT', 'onselectstart="return false"');
define('FORBID_PASTE', 'onpaste="return false"');
define('FORBID_COPY', 'oncopy="return false;" oncut="return false;"')
						
?>
