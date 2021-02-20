<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
require_once(__LIB_PATH.'ClientAPI.class.php');
require_once(__LIB_PATH.'Report.class.php');

$_userid = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

if (!($_userid > 0)) {
    echo "<script language='javascript'>parent.location.href='login.php';</script>";
}

$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_c = new ClientAPI (__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$o_r = new ReportAPI (__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);


# get function id
$from_user_id  = isset($_REQUEST['uid'])? trim($_REQUEST['uid']) : 0;
$to_user_id = isset($_POST['merge_uid'])? trim($_POST['merge_uid']) : 0;
$token = isset($_POST['token'])? trim($_POST['token']) : '';

if (isset($_POST['btn_name']) && $_POST['btn_name'] == 'Execute') {
    if (!$o_r->checkStaffArchive($from_user_id)) {
        echo "<script language='javascript'>alert('No Archive file found!!! Please backup user report data first!');self.location.href='sys_user_merge.php';</script>";
        exit;
    }
    elseif ($token == 'gu$9d' && $from_user_id > 0 && $to_user_id > 0) {
        $o_c->mergeCourseConsultant($from_user_id, $to_user_id);
        $o_c->mergeVisaAgreementStaff($from_user_id, $to_user_id);
        echo "<script language='javascript'>alert('Merge success!');self.location.href='sys_user_merge.php';</script>";
        exit;
    }
    else {
        echo "<script language='javascript'>alert('Merge failed!');self.location.href='sys_user_merge.php';</script>";
        exit;
    }
}


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title></title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>

<body>
<form method="post" action="sys_user_merge.php" name="form1" target="_self">
<table width="100%"  class="graybordertable">
    <input type="hidden" name="token" value="">
    <tr  class="title" >
        <td align="center" colspan="2"><strong>Course Consultant Merge</strong></td>
    </tr>
    <tr>
        <td width="14%" align="left"><strong>Merge from</strong>&nbsp;&nbsp;</td>
        <td align="left" width="86%">
            <select name="uid" onChange="javascript:this.form.submit();">
            <?php  
                foreach($o_g->getUserNameArr(0,true) as $uid => $uname) {
                    if ($uid == $from_user_id) {
                        echo "<option value='{$uid}' selected>{$uname}</option>";
                    }
                    else {
                        echo "<option value='{$uid}'>{$uname}</option>";
                    }
                }

                    if ($from_user_id == 0) 
                        echo "<option value='0' selected>Choose an employee</option>";
            ?>
            </select>
        </td>
    </tr>
    <tr>
        <td width="14%" align="left"><strong>Total impacted courses</strong>&nbsp;&nbsp;</td>
        <td align="left" width="86%">
            <?php  
                if ($from_user_id > 0) {
                    echo $o_c->countCourseByConsultant($from_user_id);
                }
            ?>
        </td>
    </tr>
    <tr>
        <td width="14%" align="left"><strong>Total impacted visa agreements</strong>&nbsp;&nbsp;</td>
        <td align="left" width="86%">
            <?php  
                if ($from_user_id > 0) {
                    echo $o_c->countVisaAgreementByStaff($from_user_id);
                }
            ?>
        </td>
    </tr>
    <tr>
        <td width="14%" align="left"><strong>Merge to</strong>&nbsp;&nbsp;</td>
        <td align="left" width="86%">
            <select name="merge_uid">
            <?php  
                foreach($o_g->getUserNameArr() as $uid => $uname) {
                    if ($uid == $to_user_id) {
                        echo "<option value='{$uid}' selected>{$uname}</option>";
                    }
                    else {
                        echo "<option value='{$uid}'>{$uname}</option>";
                    }
                }

                    if ($merge_uid == 0) 
                        echo "<option value='0' selected>Choose an employee</option>";

            ?>
            </select>
        </td>
    </tr> 
    <tr>
        <td colspan="2" align="center">           
            <?php echo $o_r->checkStaffArchive($from_user_id)? '<h3 style="color:green">Staff Archive data found!!!!</h3>' : '<h3 style="color:red">Please backup staff (Summary & Detail) report data first!!!</h3>';?>
        </td>
    </tr>                   
    <tr>
        <td class="title" colspan="2" align="center">           
            <input type="submit" style="font-weight:bold;" name="btn_name" value="Execute" onclick="javascript:merge_staff(this.form);">&nbsp;&nbsp;
        </td>
    </tr>
</table>
</form>
</body>
<script type="text/javascript">
    function merge_staff(form) {
        var token = prompt("Plese type in execute token");
        if (!token)
            return false;
        
        form.token.value=token;
        return true;
    }
</script>
</html>