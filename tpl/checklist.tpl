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
<input type="hidden" name="clone_tpl_id" id="clone_tpl_id" value="">
<input type="hidden" name="clone_tpl_name" id="clone_tpl_name" value="">
<table align="center" class="graybordertable" width="100%" cellpadding="1" cellspacing="1" border="0">
    <tr align="center"  class="greybg" >
        <td class="whitetext" colspan="5" style="padding:3 ">Checklist Template Configration
        </td>
    </tr>
    <tr align="center" class="totalrowodd">
        <td>Template Name</td>
        <td>Visa Category</td>
        <td>Visa SubClass</td>
        <td>Status</td>
        <td>Links</td>
    </tr>
    {foreach key=id item=v from=$about_arr}
    <tr align="center" class="roweven">
        <td>{$v.name}</td>
        <td>{$visa_arr[$v.visacate]}</td>
        <td>{$visaclass_arr[$v.visaclass]}</td>
        <td>{$v.status}</td>
        <td>
            <a href="/scripts/checklist_detail.php?tpl_id={$id}">Detail</a>&nbsp;
            {if $v.status == 'Draft'}
                <span style="text-decoration: underline; cursor:pointer; "onClick="save_checklist({$id}, 'Active')">Active</span>&nbsp;
            {elseif $v.status == 'InActive'}
                <span style="text-decoration: underline; cursor:pointer; " onClick="save_checklist({$id}, 'Active')">ReActive</span>&nbsp;
            {else}
                 <span style="text-decoration: underline; cursor:pointer; " onClick="save_checklist({$id}, 'InActive')">InActive</span>&nbsp; 
            {/if}
            <span style="text-decoration: underline; cursor:pointer; " onClick="clone_checklist({$id})">Clone</span>&nbsp;&nbsp;&nbsp;
            <span style="text-decoration: underline; cursor:pointer; " onClick="save_checklist({$id}, 'Delete')">Delete</span>
        </td>
    </tr>
    {/foreach}
    <tr align="left" class="totalrowodd">
        <td colspan="5"><input type="text" name="t_name" value="" size="50">
            <button onClick="save_checklist(0, 'Save')">Create new template</button>
        </td>
    </tr>
</table>
</form> 
</body>
{$alert_msg}
<script language="javascript">
{literal}
    function save_checklist(tplid, act) {
        if (act == 'Delete' && !confirm("Confirm delete current item?")) {
            return false;
        }
    
        $("#tpl_id").val(tplid);
        $("#bt_name").val(act);
        $("#form1").submit();
    }

    function clone_checklist(tplid) {
        var tpl_name = prompt("Please type a template name");
        if (!tpl_name)
            return false;
        $('#clone_tpl_id').val(tplid);
        $('#clone_tpl_name').val(tpl_name);
        $('#bt_name').val('clone');
        $('#form1').submit();
    }
{/literal}
</script>  
</html>
