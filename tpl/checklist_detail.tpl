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
<table align="center" class="graybordertable" width="100%" cellpadding="1" cellspacing="1" border="0">
    <tr align="center"  class="greybg" >
        <td class="whitetext" colspan="2" style="padding:3 ">Checklist Detail Configration</td>
    </tr>
    <tr>
        <td align="center" valign="top">
            <table  border="0" cellpadding="1" cellspacing="1" width="100%">
                <tr align="left" class="totalrowodd">
                    <td colspan="4">{$tpl_arr.name}</td>
                </tr>
                <tr align="center" class="totalrowodd">
                    <td>Item</td>
                    <td>Tips</td>
                    <td>Status</td>
                    <td>Links</td>
                </tr>
                {foreach key=id item=v from=$item_arr}
                <tr align="center" class="roweven">
                    <td>{$v.tit}</td>
                    <td>{$v.tip}</td>
                    <td>{if $v.del eq 0}Active{else}Deleted{/if}</td>
                    <td>
                        <a href="#">Detail</a>&nbsp;
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
    <tr><td><hr/></td></tr>
    {if count($meta_arr) > 0}
    <tr align="left" class="roweven">
        <td colspan="4">
        <select name="t_idx_existed">
            {foreach key=id item=v from=$meta_arr}
                <option value="{$v.idx}">{$v.tit}</option>
            {/foreach}
        </select>&nbsp;&nbsp;
        <button onClick="save_detail('AddExist')">Add from existed items</button>
        </td>
    </tr>
    {/if}
    <tr><td><hr/></td></tr>
    <tr align="left" class="roweven">
        <td colspan="2">
            <input type="text" size="50" name="t_name" value=""/> (Item Name) &nbsp;&nbsp;
            <input type="text" size="30" name="t_idx" value=""/> (Item Idx)<p/>
            <textarea name="t_tip" rows="5" cols="50"></textarea> (Item Tips)<p/>
            <button onClick="save_detail('CreateNew')">Create new items</button>
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
  
{/literal}
</script>  
</html>
