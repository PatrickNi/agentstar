<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'GeicAPI.class.php');
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

$_userid = isset($_COOKIE['userid'])? $_COOKIE['userid'] : 0;

if (!($_userid > 0)) {
    echo "<script language='javascript'>parent.location.href='login.php';</script>";
}

$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);


# get function id
$leader_id  = isset($_REQUEST['leader_id'])? trim($_REQUEST['leader_id']) : 0;
$members = isset($_POST['member'])? $_POST['member'] : array();
$token = isset($_POST['token'])? trim($_POST['token']) : '';

if (isset($_POST['btn_name']) && $_POST['btn_name'] == 'SAVE') {
    if ($token == 'gu$9d' && $leader_id > 0 && count($members) > 0) {
        $o_g->setMemberByStaffId($leader_id, $members);
        echo "<script language='javascript'>alert('Save success!');</script>";
    }
    else {
        echo "<script language='javascript'>alert('Save failed!');</script>";
    }
}
$members_pending = $o_g->getUserNameArr();
$members_approved = $o_g->getMemberByStaffId($leader_id);
foreach ($members_pending as $k => $v) {
    if (stripos($k, '###') !== false || isset($members_approved[$k])){
        unset($members_pending[$k]);
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
<script src="../js/jquery-1.9.1.js"></script>
<script src="../js/jquery-ui-1.10.3.custom.js"></script>

<body>
<form method="POST" name="form1" id="form1" target="_self">
<table width="60%"  class="graybordertable">
    <input type="hidden" name="token" id="token" value="">
    <input type="hidden" id="btn_name" name="btn_name" value=""> 
    <tr  class="title" >
        <td align="center" colspan="3"><strong>Team Member Manager</strong></td>
    </tr>
    <tr>
        <td align="left" colspan="3"><strong>Team Leader:</strong>&nbsp;&nbsp;
            <select name="leader_id" onChange="javascript:this.form.submit();">
            <?php
                if ($leader_id == 0) 
                    echo "<option value='0' selected>Choose a leader </option>";

                foreach($o_g->getUserNameArr(0,true) as $uid => $uname) {
                    if ($uid == $leader_id && $leader_id > 0) {
                        echo "<option value='{$uid}' selected>{$uname}</option>";
                    }
                    else {
                        echo "<option value='{$uid}'>{$uname}</option>";
                    }
                }
            ?>
            </select>
        </td>
    </tr>
    <tr>
        <td width="25%" align="left">
            <strong style="color:red">Pending Members</strong><br/>
            <select size="30" id="members_pending" style="width:100%" multiple="multiple">
            <?php  
                foreach($members_pending as $uid => $uname) {
                    echo "<option value='{$uid}'>{$uname}</option>";
                }
            ?>                
            </select> 
        </td>
        <td width="10%" align="center">
                <button type="button" onclick="member_add();">Add to &gt;&gt;&gt; </button><br/>
                <button type="button" onclick="member_remove()">&lt;&lt;&lt; Remove</button><p/><p/>
                <button type="button" id="btn_save" style="font-weight:bolder;font-size:larger" onclick="do_save()" disabled="disabled">Save</button>
        </td>
        <td width="25%" align="left">
        <strong style="color:green">Approved Members</strong><br/>
            <select name="member[]" multiple="multiple" size="30" id="members_approved" style="width:100%">
            <?php  
                foreach($members_approved as $uid => $uname) {
                    echo "<option value='{$uid}' selected>{$uname}</option>";
                }
            ?>                
            </select> 
        </td>
    </tr>                
    <tr>
        <td class="title" colspan="3" align="center"></td>
    </tr>
</table>
</form>
</body>
<script type="text/javascript">
    function do_save() {
        var token = prompt("Plese type in execute token");
        if (token == null) {
            return false;
        }

        $("#members_approved option").each(function(){
            $(this).prop('selected', true);
        });
        $("#token").val(token);
        $("#btn_name").val("SAVE");
        $("#form1").submit();
        return true;
    }
    
    function member_add() {
        $("#members_pending option:selected").each(function(){
            $("#members_approved").append("<option value='"+$(this).val()+"' selected>"+$(this).text()+"</option>");
            $(this).remove();
        });
        $("#btn_save").css("color", "red");
        $("#btn_save").attr("disabled", false);
    }

    function member_remove() {
        $("#members_approved option:selected").each(function(){
            $("#members_pending").append("<option value='"+$(this).val()+"' >"+$(this).text()+"</option>");
            $(this).remove();
        });
        $("#btn_save").css("color", "red");
        $("#btn_save").attr("disabled", false);
    }
</script>
</html>