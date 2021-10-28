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
        $.post($('#form_checklist').attr('action'), $('#form_checklist').serialize(), function(data){
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
                Client Check list 
            </td>
        </tr>
        <tr align="center" class="totalrowodd"> 
            <td class="border_1">
                <select name="cl_tplid" onChange="do_checklist('change_tpl')">
                {foreach key=id item=v from=$tpl_arr}
                    <option value="{$id}">{$v.name}</option>
                {/foreach}
                <option value="0" selected>choose a list</option>
                </select>
            </td>
        </tr> 
    </table> 
{elseif $section == "confirm_select"}
    <input type="hidden" name="cl_act" id="cl_act" value="">
    <input type="hidden" name="cl_typ" id="cl_typ" value="{$cl_typ}">
    <input type="hidden" name="cl_appid" id="cl_appid" value="{$cl_appid}">
    <input type="hidden" name="cl_tplid" value="{$cl_tplid}">
    <table border="0" cellpadding="0" cellspacing="0" width="100%"> 
        <tr class="greybg"> 
            <td colspan="3" class="whitetext" align="center">
                Client Check list
                <button type="button" onclick="do_checklist('apply_tpl')"><strong>Apply</strong></button>     
            </td> 
        </tr>
        <tr align="center" class="totalrowodd"> 
            <td width="5%">No.</td> 
            <td class="border_1" width="55%">Item</td> 
            <td class="border_1" width="30%">Received</td> 
        </tr> 
        {assign var="rank" value="0"}
        {foreach key=id item=v from=$item_arr}
        {assign var="rank" value=$rank+1}
        <tr align="center" class="roweven"> 
            <td class="border_1" width="5%">{$rank}</td> 
            <td class="border_1" width="55%">{$v.tit}</td> 
            <td class="border_1" width="30%"></td> 
        </tr> 
        {/foreach}
    </table> 	
{elseif $section == "show_detail"}
    <input type="hidden" name="cl_act" id="cl_act" value="">
    <input type="hidden" name="cl_typ" id="cl_typ" value="{$cl_typ}">
    <input type="hidden" name="cl_appid" id="cl_appid" value="{$cl_appid}">
    <table border="0" cellpadding="0" cellspacing="0" width="100%"> 
        <tr class="greybg"> 
            <td colspan="3" class="whitetext" align="center">Client Check List</td>
        </tr>
        <tr align="center" class="totalrowodd"> 
            <td class="border_1" width="5%">No</td> 
            <td class="border_1" width="55%">Item</td> 
            <td class="border_1" width="30%">Received</td> 
        </tr>
        {assign var="rank" value="0"} 
        {foreach key=id item=v from=$app_arr}
        {assign var="rank" value=$rank+1}
        <tr align="center" class="roweven"> 
            <td class="border_1" width="5%">{$rank}</td> 
            <td class="border_1" width="55%">
                {if $v.rmk != ""}
                    <a href="#" title="{$v.rmk}">{$v.tit}</a>
                {else}
                    {$v.tit}
                {/if}
            </td> 
            <td class="border_1" width="30%">
                <input type="text" name="cl_rd_{$id}" value="{$v.rcd}">
            </td> 
        </tr> 
        {/foreach}
        <tr align="center" class="roweven"> 
            <td class="border_1" width="5%">Add</td> 
            <td class="border_1" width="55%">
                <input type="text" name="cl_item_new" value="" size="50">
            </td> 
            <td class="border_1" width="30%">
                <input type="text" name="cl_rd_new" value="">
            </td> 
        </tr>    
        <tr align="right" class="roweven"> 
            <td class="border_1" colspan="3">
                <button type="button" onclick="do_checklist('save_app')"><strong>Save All</strong></button>
            </td> 
        </tr>     
    </table> 
    {literal}
    <script type="text/javascript">
        $( document ).tooltip();
    </script>
    {/literal}	
{/if}			



	