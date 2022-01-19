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
<input type="hidden" name="bt_name" id="bt_name" value="">
<input type="hidden" name="del_item_id" id="del_item" value="">
<table align="center" class="graybordertable" width="100%" cellpadding="1" cellspacing="1" border="0">
    <tr align="center"  class="greybg" >
        <td class="whitetext" colspan="4" style="padding:3 ">Checklist Detail Configration</td>
    </tr>
    <tr align="left" class="totalrowodd">
        <td colspan="4">
            Tepmalte: {$tpl_arr.name} &nbsp;&nbsp;&nbsp;&nbsp;
            Visa Category:
            <select name="t_visa" onChange="save_detail('SetVisaCate')">
                {foreach key=id item=name from=$visa_arr}
                  <option value="{$id}" {if $id eq $visa_cate_id} selected {/if}>{$name}</option>
                {/foreach}
                {if $visa_cate_id eq 0}
                  <option value="0" selected>choose a category</option>
                  {/if}
            </select>&nbsp;&nbsp;
            Visa Subclass:
            <select name="t_class" onChange="save_detail('SetVisaClass')">
                  {foreach key=id item=name from=$visaclass_arr}
                  <option value="{$id}" {if $id eq $visa_class_id} selected {/if}>{$name}</option>
                  {/foreach}
                  {if $visa_class_id eq 0}
                  <option value="0" selected>choose a subclass</option>
                  {/if}
            </select>
        </td>
    </tr>
    <tr align="center" class="totalrowodd">
        <td>Item</td>
        <td>Tips</td>
        <td>Status</td>
        <td>Links</td>
    </tr>
    {foreach key=id item=v from=$item_arr}
    <tr align="center" class="roweven">
        <td width="45%" alert="left">{$v.tit}</td>
        <td width="35%" alert="left">{$v.tip}</td>
        <td width="10%">{if $v.del eq 0}Active{else}Deleted{/if}</td>
        <td width="10%">
            <a href="#" onclick="remove_detail({$id})">Delete</a>&nbsp;
        </td>
    </tr>
    {/foreach}

    <tr><td colspan="4"><hr/></td></tr>
    
    {if count($meta_arr) > 0}
    <tr align="left" class="roweven">
        <td colspan="4">
        <select name="t_idx_existed">
            {foreach key=id item=v from=$meta_arr}
                <option value="{$v.idx}">{$v.tit}</option>
            {/foreach}
        </select>&nbsp;&nbsp;
        <button onClick="save_detail('AddExist')">Create from an existed item</button>
        </td>
    </tr>
    {/if}

    <tr ><td colspan="4"><hr/></td></tr>
    <tr align="left" class="roweven">
        <td colspan="4">
            <p><strong>Item: </strong><input type="text" size="50" name="t_name" value=""/></p>
            <p><strong>Tips: <textarea name="t_tip" rows="5" cols="50"></textarea></p>
            <p><button onClick="save_detail('CreateNew')">Create a new item</button></p>
        </td>
    </tr>
</table>
</form> 
</body>
{$alert_msg}
<script language="javascript">
{literal}
    function save_detail(act) {
        $("#bt_name").val(act);
        $("#form1").submit();
    }

    function remove_detail(id) {
        $("#bt_name").val('DeleteItem');
        $('#del_item').val(id);
        $("#form1").submit();        
    }
  
{/literal}
</script>  
</html>
