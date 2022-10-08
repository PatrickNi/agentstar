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
<input type="hidden" name="tpl_id" id="tpl_id" value="{$tpl_id}">
<table align="center" class="graybordertable" width="100%" cellpadding="1" cellspacing="1" border="0" id="tbl_checklist">
    <tr align="center"  class="greybg" >
        <td class="whitetext" colspan="4" style="padding:3 ">Checklist Detail Configration</td>
    </tr>
    <tr align="left" class="totalrowodd">
        <td colspan="3">
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
        <td>No.</td>
        <td>Item</td>
        <td>Tips</td>
    </tr>
    
    {assign var="rank" value="0"}
    {foreach key=id item=v from=$item_arr}
    {assign var="rank" value=$rank+1}
    <tr align="center" class="roweven" id="app_item_{$id}">
        <td style="vertical-align: top;" width="5%">{$rank}</td>
        <td style="vertical-align: top;" width="55%" align="left">
            <span onclick="widget_detail(this, {$id}, 'edit')">{$v.tit}</span>
        </td>
        <td width="40%" align="left">
            <span onclick="widget_tip(this, {$id}, 'edit')">{if $v.tip != ''}{$v.tip}{else}No tips found{/if}</span>
        </td>
    </tr>
    {/foreach}

    <tr ><td colspan="3"><hr/></td></tr>
    <tr align="left" class="roweven">
        <td colspan="3">
            <p><strong>Item: </strong><textarea name="t_name" rows="5" cols="50"></textarea></p>
            <p><strong>Tips: </strong><textarea name="t_tip" rows="5" cols="50"></textarea></p>
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

    function md_detail(obj,item_id) {
        $(obj).text('saving...').attr("disable","disable");
        if ($('#item_tit_'+item_id).val() == "") {
            if(!confirm('Delete Item: "'+$('#hidden_tit_'+item_id).val()+'"')){  
                return false;            
            }
            else {
                rm_detail(item_id);
                return true;
            }
        }

        $.post($('#form1').attr('action'), 'bt_name=modify_tit&item_id='+item_id+'&item_tit='+encodeURI($('#item_tit_'+item_id).val()), function(data){
            rtn = $.parseJSON(data);
            if (rtn.succ == 1) {
                widget_detail(obj,item_id,'postsave');
            }
            else {
                alert("modify item failed!");
                $(obj).val('save').prop("disabled", false);
            }
        });
    }

    function rm_detail(item_id) {
        $.post($('#form1').attr('action'), 'bt_name=deleteitem&del_item_id='+item_id, function(data){
            rtn = $.parseJSON(data);
            if (rtn.succ == 1) {
                $('#app_item_'+item_id).remove();
            }
            else {
                alert("delete item failed!");
            }
        });   
    }
  
    function md_tip(obj, item_id) {
        $(obj).val('saving...').prop("disabled", true);
        $.post($('#form1').attr('action'), 'bt_name=modify_tip&item_id='+item_id+'&item_tip='+encodeURI($('#item_tip_'+item_id).val()), function(data){
            rtn = $.parseJSON(data);
            if (rtn.succ == 1) {
                widget_tip(obj,item_id,'postsave');
            }
            else {
                alert("modify tips failed!");
                $(obj).text('save').attr("disable","");
            }
        });        
    }

    function widget_tip(obj, item_id, act) {
        if (act == 'edit') {
            var edit_tpl = '<textarea rows="3" style="width:100%;" id="item_tip_'+item_id+'">'+$(obj).html().replace(/<br>/g, '\n')+'</textarea><br/><button type="button" onClick="md_tip(this,'+item_id+')">save</button>&nbsp;<input type="hidden" id="hidden_tip_'+item_id+'" value="'+$(obj).html().replace(/<br>/g, '\n')+'">';
            $(obj).parent().html(edit_tpl);
        }
        else if (act == 'postsave') {
            var show_tpl = '<span onclick="widget_tip(this, '+item_id+', \'edit\')">'+$('#item_tip_'+item_id).val().replace(/\n/g,'<br>')+'</span>';
            $(obj).parent().html(show_tpl);            
        }
        else {
            var show_tpl = '<span onclick="widget_tip(this, '+item_id+', \'edit\')">'+$('#item_tip_'+item_id).val().replace(/\n/g,'<br>')+'</span>';
            $(obj).parent().html(show_tpl);
        }
    }

    function widget_detail(obj, item_id, act) {
        if (act == 'edit') {
            var edit_tpl = '<textarea rows="3" style="width:100%;" id="item_tit_'+item_id+'">'+$(obj).html().replace(/<br>/g, '\n')+'</textarea><br/><button type="button" onClick="md_detail(this,'+item_id+')">save</button>&nbsp;<button type="button" onClick="rm_detail('+item_id+')">delete</button><input type="hidden" id="hidden_tit_'+item_id+'" value="'+$(obj).html().replace(/<br>/g, '\n')+'">';
            $(obj).parent().html(edit_tpl);
        }
        else if (act == 'postsave') {
            var show_tpl = '<span onclick="widget_detail(this, '+item_id+', \'edit\')">'+$('#item_tit_'+item_id).val().replace(/\n/g,'<br>')+'</span>';
            $(obj).parent().html(show_tpl);            
        }
        else {
            var show_tpl = '<span onclick="widget_detail(this, '+item_id+', \'edit\')">'+$('#hidden_tit_'+item_id).val().replace(/\n/g,'<br>')+'</span>';
            $(obj).parent().html(show_tpl);
        }
    }
        $(function () {
            $("#tbl_checklist").sortable({
                items: 'tr:not(tr:first-child)',
                cursor: 'pointer',
                axis: 'y',
                dropOnEmpty: false,
                start: function (e, ui) {
                    ui.item.addClass("selected");
                },
                stop: function (e, ui) {
                    ui.item.removeClass("selected");
                    var app_item_ids = [];
                    $(this).find("tr:not(tr:first-child)").each(function (index) {
                        if (index > 0 && typeof($(this).attr('id')) != "undefined") {
                            $(this).find("td").eq(0).html(index-1);
                            app_item_ids.push($(this).attr('id').toString().replace('app_item_',''));
                        }
                    });
                    alert(app_item_ids.join('|'));
                    
                    $.post($('#form1').attr('action'), 'bt_name=rank_item&ord_item='+app_item_ids.join('|'), function(data){
                        rtn = $.parseJSON(data);
                        if (rtn.succ == 0) {
                            alert("Set item rank failed!");
                        }                        
                    });
                    
                }
            });
        });
{/literal}
</script>  
</html>
