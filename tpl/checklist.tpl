<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Configration</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
{include file="style.tpl"}

<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="post" name="form1" id="form1" action="" target="_self">
<input type="hidden" name="tpl_id" id="tpl_id" value="">
<input type="hidden" name="bt_name" id="bt_name" value="">
<table align="center" class="graybordertable" width="100%" cellpadding="1" cellspacing="1" border="0">
    <tr align="center"  class="greybg" >
        <td class="whitetext" colspan="2" style="padding:3 ">Checklist Template Configration
        </td>
    </tr>
    <tr>
        <td align="center" valign="top">
            <table  border="0" cellpadding="1" cellspacing="1" width="100%">
                <tr align="left" class="totalrowodd">
                    <td colspan="3"><input type="text" name="t_name" value="" size="50">
                        <button onClick="save_checklist(0, 'Save')">Create new checklist</button>
                    </td>
                </tr>
                <tr align="center" class="totalrowodd">
                    <td>Template Name</td>
                    <td>Status</td>
                    <td>Links</td>
                </tr>
                {foreach key=id item=v from=$about_arr}
                <tr align="center" class="roweven">
                    <td>{$v.name}</td>
                    <td>{$v.status}</td>
                    <td>
                        <a href="/scripts/checklist_detail.php?tpl_id={$id}">Detail</a>&nbsp;
                        {if $v.status == 'Draft'}
                            <a href="#" onClick="save_checklist({$id}, 'Active')">Active</a>&nbsp;
                        {elseif $v.status == 'InActive'}
                            <a href="#" onClick="save_checklist({$id}, 'Active')">ReActive</a>&nbsp;
                        {else}
                            <a href="#" onClick="save_checklist({$id}, 'InActive')">InActive</a>&nbsp; 
                        {/if}
                    </td>
                </tr>
                {/foreach}
            </table>
        </td>
    </tr>
</table>
</form> 
</body>
{$alert_msg}
<script language="javascript">
{literal}
    function save_checklist(tplid, act) {
        $("#tpl_id").val(tplid);
        $("#bt_name").val(act);
        $("#form1").submit();
    }
{/literal}
</script>  
</html>
