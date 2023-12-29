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
                {if $cl_typ == 'course'}
                    Offer checklist
                {else}
                    Check List
                {/if}
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
                <button type="button" onclick=""><strong>Create empty checklist</strong></button>
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
                {if $cl_typ == 'course'}
                    Offer checklist
                {else}
                    Check List
                {/if}
            </td> 
        </tr>
        <tr align="left" class="totalrowodd"> 
            <td class="border_1" colspan="3">
               Tepmlate: 
                <select name="cl_tplid" onChange="do_checklist('change_tpl')">
                    <option value="0" selected>choose a template</option>
                    {foreach key=id item=v from=$tpl_arr}
                        <option value="{$id}" {if $cl_tplid eq $id} selected {/if}>
                        {if $v.catename != "" && $v.classname != ""}
                            {$v.catename} - {$v.classname}
                        {else}
                            {$v.name}
                        {/if}
                        </option>
                    {/foreach}
                </select>
                &nbsp;
                <button type="button" onclick="do_checklist('apply_tpl')" {if count($tpl_arr) == 0} disabled{/if}><strong>Create with a template</strong></button>
                &nbsp;&nbsp;
                <button type="button" onclick="do_checklist('apply_new')"><strong>Create empty checklist </strong></button>
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
            <td width="5%" style="vertical-align: top;">{$rank}</td> 
            <td style="vertical-align: top;" width="55%" align="left">{$v.tit}</td> 
            <td width="30%"></td> 
        </tr> 
        {/foreach}
    </table> 	
{elseif $section == "show_detail"}
    <input type="hidden" name="cl_act" id="cl_act" value="">
    <input type="hidden" name="cl_typ" id="cl_typ" value="{$cl_typ}">
    <input type="hidden" name="cl_appid" id="cl_appid" value="{$cl_appid}">
    <table border="0" cellpadding="1" cellspacing="1" width="100%" id="tbl_checklist"> 
        <tr class="greybg"> 
            <td colspan="5" class="whitetext" align="center">
                {if $cl_typ == 'course'}
                    Offer checklist
                {else}
                    Check List
                {/if}
            {if count($app_arr) > 0}
                <a href="/scripts/checklist_pdf.php?cl_typ={$cl_typ}&cl_appid={$cl_appid}", target="_blank">PDF Download</a>
            {/if}
            </td>
        </tr>
        <tr align="center" class="totalrowodd"> 
            <td width="5%">No</td> 
            <td width="73%">Item</td> 
            <td width="15%">Received</td>
            <td width="5%"></td> 
            <td width="2%"></td>
        </tr>
        {assign var="rank" value="0"}
        {foreach key=id item=v from=$app_arr}
        {assign var="rank" value=$rank+1}
        <tr align="center" class="roweven" id="app_item_{$id}"> 
            <td width="5%" style="vertical-align: top;">{$rank}</td>
            <td style="vertical-align: top;" width="80%" align="left">
                <span onclick="widget_checklist(this, {$id}, 'edit')">{$v.tit}</span>
            </td> 
            <td width="10%" id="app_rcd_{$id}">{if $v.rcd != '0000-00-00'}{$v.rcd}{/if}</td>
            <td width="5%"><input type="checkbox" id="app_chk_{$id}" {if $v.rcd != '0000-00-00'} checked {/if} onChange="mark_checklist({$id},this)" ></td> 
            <td>{if $v.rmk != ""}<span class="ui-icon ui-icon-help" title="{$v.rmk}"></span>{/if}</td>
        </tr> 
        {/foreach}
        <tr align="center" class="roweven">
            <td></td> 
            <td align="left" colspan="4">
                <textarea rows="3" style="width:100%;"  name="cl_new_item" ></textarea><br/>
                <button type="button" onclick="do_checklist('app_add')">Add</button>
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
            if(!confirm('Delete Item: "'+$('#app_tit_'+app_item_id).val()+'"')){  
                return false;            
            }
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
            $(obj).val('saving...').prop("disabled", true);
            $.post($('#form_checklists').attr('action'), 'cl_act=edit_app&cl_app_item='+app_item_id+'&cl_typ='+$('#cl_typ').val()+'&cl_appid='+$('#cl_appid').val()+'&cl_app_tit='+encodeURI($('#app_tit_'+app_item_id).val()), function(data){
                rtn = $.parseJSON(data);
                if (rtn.succ == 1) {
                    widget_checklist(obj,app_item_id,'postsave');
                }
                else {
                    $(obj).val('save').prop("disabled", false);
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
                var edit_tpl = '<textarea rows="3" style="width:100%;" id="app_tit_'+app_item_id+'">'+$(obj).html().replace(/<br>/g, '\n')+'</textarea><br/><button type="button" onClick="md_checklist(this,'+app_item_id+')">save</button>&nbsp;<button type="button" onClick="rm_checklist('+app_item_id+')">delete</button>&nbsp;&nbsp;&nbsp;<input type="hidden" id="hidden_tit_'+app_item_id+'" value="'+$(obj).html().replace(/<br>/g, '\n')+'">';
                $(obj).parent().html(edit_tpl);
            }
            else if (act == 'postsave') {
                var show_tpl = '<span onclick="widget_checklist(this, '+app_item_id+', \'edit\')">'+$('#app_tit_'+app_item_id).val().replace(/\n/g,'<br>')+'</span>';
                $(obj).parent().html(show_tpl);            
            }
            else {
                var show_tpl = '<span onclick="widget_checklist(this, '+app_item_id+', \'edit\')">'+$('#hidden_tit_'+app_item_id).val().replace(/\n/g,'<br>')+'</span>';
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
            $( document ).tooltip({ 
                content: function(callback) { 
                    callback($(this).prop('title').replace(/\n/g, '<br/>')); 
                }
            });
        });
    </script>
    {/literal}
{/if}			



	