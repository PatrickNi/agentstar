{if $section == "checklist_frame"}
    <div style="width:100%;overflow-X:auto; overflow-Y:auto;">
        <form id="form_checklist" action="/scripts/checklist_ajax.php">
        <input type="hidden" name="cl_act" id="cl_act" value="">
        </form>
    </div>
    {literal}
    <script type="text/javascript">
        function do_checklist(act){
            $('#cl_act').val(act);
            //ContentType UTF-8
            $.post($('#form_checklists').attr('action'), $('#form_checklist').serialize(), function(data){
                $('#form_checklist').html($data);
            });
        }
    </script>
    {/literal}
{elseif $section == "show_select"}
    <input type="hidden" name="cl_act" id="cl_act" value="">
    <input type="hidden" name="cl_typ" id="cl_typ" value="{$cl_typ}">
    <input type="hidden" name="cl_appid" id="cl_appid" value="{$cl_appid}">
    <table border="0" cellpadding="0" cellspacing="0" width="100%"> 
        <tr class="greybg"> 
            <td class="whitetext" align="center">
                Check List
            </td>
        </tr>
        <tr align="left" class="totalrowodd"> 
            <td class="border_1">
                <select name="cl_tplid" onChange="do_checklist('change_tpl')">
                {foreach key=id item=v from=$tpl_arr}
                    <option value="{$id}">{$v.name}</option>
                {/foreach}
                <option value="0" selected>choose a template</option>
                </select>
                &nbsp;
                <button type="button" onclick=""><strong>Create with a template</strong></button>
                &nbsp;
                <button type="button" onclick=""><strong>Create new </strong></button>
            </td>
        </tr> 
    </table> 
{elseif $section == "confirm_select"}
    <input type="hidden" name="cl_act" id="cl_act" value="">
    <input type="hidden" name="cl_typ" id="cl_typ" value="{$cl_typ}">
    <input type="hidden" name="cl_appid" id="cl_appid" value="{$cl_appid}">
    <table border="0" cellpadding="1" cellspacing="1" width="100%"> 
        <tr class="greybg"> 
            <td colspan="3" class="whitetext" align="center">
                Check list   
            </td> 
        </tr>
        <tr align="left" class="totalrowodd"> 
            <td class="border_1" colspan="3">
               Tepmlate: 
                <select name="cl_tplid" onChange="do_checklist('change_tpl')">
                    <option value="0" selected>choose a template</option>
                    {foreach key=id item=v from=$tpl_arr}
                        <option value="{$id}" {if $cl_tplid eq $id} selected {/if}>{$v.name}</option>
                    {/foreach}
                </select>
            </td>
        </tr> 
        <tr align="center" class="totalrowodd"> 
            <td width="5%">No.</td> 
            <td width="55%">Item</td> 
            <td width="30%">Received</td> 
        </tr> 
        {assign var="rank" value="0"}
        {foreach key=id item=v from=$item_arr}
        {assign var="rank" value=$rank+1}
        <tr align="center" class="roweven"> 
            <td width="5%">{$rank}</td> 
            <td width="55%" align="left">{$v.tit}</td> 
            <td width="30%"></td> 
        </tr> 
        {/foreach}
        <tr align="left" class="totalrowodd"> 
            <td colspan="3">
                <button type="button" onclick="do_checklist('apply_tpl')"><strong>Create with a template</strong></button>
                &nbsp;
                <button type="button" onclick="do_checklist('apply_new')"><strong>Create new </strong></button>
            </td>
        </tr>
    </table> 	
{elseif $section == "show_detail"}
    <input type="hidden" name="cl_act" id="cl_act" value="">
    <input type="hidden" name="cl_typ" id="cl_typ" value="{$cl_typ}">
    <input type="hidden" name="cl_appid" id="cl_appid" value="{$cl_appid}">
    <table border="0" cellpadding="1" cellspacing="1" width="100%" id="tbl_checklist"> 
        <tr class="greybg"> 
            <td colspan="4" class="whitetext" align="center">Check List</td>
        </tr>
        <tr align="center" class="totalrowodd"> 
            <td width="5%">No</td> 
            <td width="80%">Item</td> 
            <td width="10%">Received</td>
            <td width="5%"></td> 
        </tr>
        {assign var="rank" value="0"}
        {foreach key=id item=v from=$app_arr}
        {assign var="rank" value=$rank+1}
        <tr align="center" class="roweven" id="app_item_{$id}"> 
            <td width="5%">{$rank}</td>
            <td width="80%" align="left">
                <span onclick="widget_checklist(this, {$id}, 'edit')">{$v.tit}</span>
            </td> 
            <td width="10%" id="app_rcd_{$id}">{if $v.rcd != '0000-00-00'}{$v.rcd}{/if}</td>
            <td width="5%"><input type="checkbox" id="app_chk_{$id}" {if $v.rcd != '0000-00-00'} checked {/if} onChange="mark_checklist({$id},this)" ></td> 
        </tr> 
        {/foreach}
        <tr align="center" class="roweven">
            <td></td> 
            <td align="left" colspan="3">
                <input type="text" size="50" name="cl_new_item" value="">&nbsp;&nbsp;<button type="button" onclick="do_checklist('app_add')">Add</button>
            </td> 
        </tr>     
    </table>
    {literal}
    <style type="text/css">
        .selected
        {
            background-color: #666;
            color: #fff;
        }
    </style>
    <script type="text/javascript">
        function rm_checklist(app_item_id) {
            $.post($('#form_checklists').attr('action'), 'cl_act=del_app&cl_app_item='+app_item_id+'&cl_typ='+$('#cl_typ').val()+'&cl_appid='+$('#cl_appid').val(), function(data){
                rtn = $.parseJSON(data);
                if (rtn.succ == 1) {
                    $('#app_item_'+app_item_id).remove();
                }
                else {
                    alert("Remove checklist failed!");
                }
            });
        }

       function md_checklist(obj,app_item_id) {
            $.post($('#form_checklists').attr('action'), 'cl_act=edit_app&cl_app_item='+app_item_id+'&cl_typ='+$('#cl_typ').val()+'&cl_appid='+$('#cl_appid').val()+'&cl_app_tit='+$('#app_tit_'+app_item_id).val(), function(data){
                rtn = $.parseJSON(data);
                if (rtn.succ == 1) {
                    widget_checklist(obj,app_item_id,'cancel');
                }
                else {
                    alert("edit checklist failed!");
                }
            });
        }

        function mark_checklist(app_item_id,obj) {
            $rcd = 0;
            if($(obj).prop("checked")) {
                $rcd = 1;
            }
            
            $.post($('#form_checklists').attr('action'), 'cl_app_rcd='+$rcd+'&cl_act=rcd_app&cl_app_item='+app_item_id+'&cl_typ='+$('#cl_typ').val()+'&cl_appid='+$('#cl_appid').val(), function(data){
                rtn = $.parseJSON(data);
                if (rtn.succ != 0) {
                    if (rtn.succ != '0000-00-00') {
                        $('#app_rcd_'+app_item_id).html(rtn.succ);
                    }
                    else {
                        $('#app_rcd_'+app_item_id).html('');
                    }
                }
                else {
                    alert("Check failed!");
                    $(obj).prop("checked", !rcd);
                }
            });
        }

        function widget_checklist(obj, app_item_id, act) {
            if (act == 'edit') {
                var edit_tpl = '<input size="50" type="text" id="app_tit_'+app_item_id+'" value="'+$(obj).text()+'">&nbsp;<button type="button" onClick="md_checklist(this,'+app_item_id+')">save</button>&nbsp;<button type="button" onClick="widget_checklist(this,'+app_item_id+',\'cancel\')">cancel</button>&nbsp;<button type="button" onClick="rm_checklist('+app_item_id+')">remove</button>';
                $(obj).parent().html(edit_tpl);
            }
            else {
                var show_tpl = '<span onclick="widget_checklist(this, '+app_item_id+', \'edit\')">'+$('#app_tit_'+app_item_id).val()+'</span>';
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
                            $(this).find("td").eq(0).html(index);
                            app_item_ids.push($(this).attr('id').toString().replace('app_item_',''));
                        }
                    });
                    $.post($('#form_checklists').attr('action'), 'cl_act=rank_app&cl_ord='+app_item_ids.join('|')+'&cl_typ='+$('#cl_typ').val()+'&cl_appid='+$('#cl_appid').val(), function(data){
                        rtn = $.parseJSON(data);
                        if (rtn.succ == 0) {
                            alert("Set item rank failed!");
                        }                        
                    });
                }
            });
        });
    </script>
    {/literal}
{/if}			



	