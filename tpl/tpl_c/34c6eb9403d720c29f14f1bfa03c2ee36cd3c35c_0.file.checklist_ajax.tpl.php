<?php
/* Smarty version 4.3.2, created on 2023-09-10 20:35:45
  from '/data/wwwroot/agentstar.geic.com.au/tpl/checklist_ajax.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_64fdb8215cc674_76412504',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '34c6eb9403d720c29f14f1bfa03c2ee36cd3c35c' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/checklist_ajax.tpl',
      1 => 1666214444,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64fdb8215cc674_76412504 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['section']->value == "checklist_frame") {?>
    <div style="width:100%;overflow-X:auto; overflow-Y:auto;">
        <form id="form_checklist" action="/scripts/checklist_ajax.php">
        <input type="hidden" name="cl_act" id="cl_act" value="">
        </form>
    </div>
    
    <?php echo '<script'; ?>
 type="text/javascript">
        function do_checklist(act){
            $('#cl_act').val(act);
            //ContentType UTF-8
            $.post($('#form_checklists').attr('action'), $('#form_checklist').serialize(), function(data){
                $('#form_checklist').html($data);
            });
        }
    <?php echo '</script'; ?>
>
    
<?php } elseif ($_smarty_tpl->tpl_vars['section']->value == "show_select") {?>
    <input type="hidden" name="cl_act" id="cl_act" value="">
    <input type="hidden" name="cl_typ" id="cl_typ" value="<?php echo $_smarty_tpl->tpl_vars['cl_typ']->value;?>
">
    <input type="hidden" name="cl_appid" id="cl_appid" value="<?php echo $_smarty_tpl->tpl_vars['cl_appid']->value;?>
">
    <table border="0" cellpadding="0" cellspacing="0" width="100%"> 
        <tr class="greybg"> 
            <td class="whitetext" align="center">
                <?php if ($_smarty_tpl->tpl_vars['cl_typ']->value == 'course') {?>
                    Offer checklist
                <?php } else { ?>
                    Check List
                <?php }?>
            </td>
        </tr>
        <tr align="left" class="totalrowodd"> 
            <td class="border_1">
                <select name="cl_tplid" onChange="do_checklist('change_tpl')">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tpl_arr']->value, 'v', false, 'id');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</option>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <option value="0" selected>choose a template</option>
                </select>
                &nbsp;
                <button type="button" onclick=""><strong>Create with a template</strong></button>
                &nbsp;
                <button type="button" onclick=""><strong>Create empty checklist</strong></button>
            </td>
        </tr> 
    </table> 
<?php } elseif ($_smarty_tpl->tpl_vars['section']->value == "confirm_select") {?>
    <input type="hidden" name="cl_act" id="cl_act" value="">
    <input type="hidden" name="cl_typ" id="cl_typ" value="<?php echo $_smarty_tpl->tpl_vars['cl_typ']->value;?>
">
    <input type="hidden" name="cl_appid" id="cl_appid" value="<?php echo $_smarty_tpl->tpl_vars['cl_appid']->value;?>
">
    <table border="0" cellpadding="1" cellspacing="1" width="100%"> 
        <tr class="greybg"> 
            <td colspan="3" class="whitetext" align="center">
                <?php if ($_smarty_tpl->tpl_vars['cl_typ']->value == 'course') {?>
                    Offer checklist
                <?php } else { ?>
                    Check List
                <?php }?>
            </td> 
        </tr>
        <tr align="left" class="totalrowodd"> 
            <td class="border_1" colspan="3">
               Tepmlate: 
                <select name="cl_tplid" onChange="do_checklist('change_tpl')">
                    <option value="0" selected>choose a template</option>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tpl_arr']->value, 'v', false, 'id');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['cl_tplid']->value == $_smarty_tpl->tpl_vars['id']->value) {?> selected <?php }?>>
                        <?php if ($_smarty_tpl->tpl_vars['v']->value['catename'] != '' && $_smarty_tpl->tpl_vars['v']->value['classname'] != '') {?>
                            <?php echo $_smarty_tpl->tpl_vars['v']->value['catename'];?>
 - <?php echo $_smarty_tpl->tpl_vars['v']->value['classname'];?>

                        <?php } else { ?>
                            <?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>

                        <?php }?>
                        </option>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
                &nbsp;
                <button type="button" onclick="do_checklist('apply_tpl')" <?php if (count($_smarty_tpl->tpl_vars['tpl_arr']->value) == 0) {?> disabled<?php }?>><strong>Create with a template</strong></button>
                &nbsp;&nbsp;
                <button type="button" onclick="do_checklist('apply_new')"><strong>Create empty checklist </strong></button>
            </td>
        </tr> 
        <tr align="center" class="totalrowodd"> 
            <td width="5%">No.</td> 
            <td width="55%">Item</td> 
            <td width="30%">Received</td> 
        </tr> 
        <?php $_smarty_tpl->_assignInScope('rank', "0");?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['item_arr']->value, 'v', false, 'id');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
        <?php $_smarty_tpl->_assignInScope('rank', $_smarty_tpl->tpl_vars['rank']->value+1);?>
        <tr align="center" class="roweven"> 
            <td width="5%" style="vertical-align: top;"><?php echo $_smarty_tpl->tpl_vars['rank']->value;?>
</td> 
            <td style="vertical-align: top;" width="55%" align="left"><?php echo $_smarty_tpl->tpl_vars['v']->value['tit'];?>
</td> 
            <td width="30%"></td> 
        </tr> 
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </table> 	
<?php } elseif ($_smarty_tpl->tpl_vars['section']->value == "show_detail") {?>
    <input type="hidden" name="cl_act" id="cl_act" value="">
    <input type="hidden" name="cl_typ" id="cl_typ" value="<?php echo $_smarty_tpl->tpl_vars['cl_typ']->value;?>
">
    <input type="hidden" name="cl_appid" id="cl_appid" value="<?php echo $_smarty_tpl->tpl_vars['cl_appid']->value;?>
">
    <table border="0" cellpadding="1" cellspacing="1" width="100%" id="tbl_checklist"> 
        <tr class="greybg"> 
            <td colspan="5" class="whitetext" align="center">
                <?php if ($_smarty_tpl->tpl_vars['cl_typ']->value == 'course') {?>
                    Offer checklist
                <?php } else { ?>
                    Check List
                <?php }?>
            <?php if (count($_smarty_tpl->tpl_vars['app_arr']->value) > 0) {?>
                <a href="/scripts/checklist_pdf.php?cl_typ=<?php echo $_smarty_tpl->tpl_vars['cl_typ']->value;?>
&cl_appid=<?php echo $_smarty_tpl->tpl_vars['cl_appid']->value;?>
", target="_blank">PDF Download</a>
            <?php }?>
            </td>
        </tr>
        <tr align="center" class="totalrowodd"> 
            <td width="5%">No</td> 
            <td width="73%">Item</td> 
            <td width="15%">Received</td>
            <td width="5%"></td> 
            <td width="2%"></td>
        </tr>
        <?php $_smarty_tpl->_assignInScope('rank', "0");?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['app_arr']->value, 'v', false, 'id');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
        <?php $_smarty_tpl->_assignInScope('rank', $_smarty_tpl->tpl_vars['rank']->value+1);?>
        <tr align="center" class="roweven" id="app_item_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"> 
            <td width="5%" style="vertical-align: top;"><?php echo $_smarty_tpl->tpl_vars['rank']->value;?>
</td>
            <td style="vertical-align: top;" width="80%" align="left">
                <span onclick="widget_checklist(this, <?php echo $_smarty_tpl->tpl_vars['id']->value;?>
, 'edit')"><?php echo $_smarty_tpl->tpl_vars['v']->value['tit'];?>
</span>
            </td> 
            <td width="10%" id="app_rcd_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"><?php if ($_smarty_tpl->tpl_vars['v']->value['rcd'] != '0000-00-00') {
echo $_smarty_tpl->tpl_vars['v']->value['rcd'];
}?></td>
            <td width="5%"><input type="checkbox" id="app_chk_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['v']->value['rcd'] != '0000-00-00') {?> checked <?php }?> onChange="mark_checklist(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
,this)" ></td> 
            <td><?php if ($_smarty_tpl->tpl_vars['v']->value['rmk'] != '') {?><span class="ui-icon ui-icon-help" title="<?php echo $_smarty_tpl->tpl_vars['v']->value['rmk'];?>
"></span><?php }?></td>
        </tr> 
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <tr align="center" class="roweven">
            <td></td> 
            <td align="left" colspan="4">
                <textarea rows="3" style="width:100%;"  name="cl_new_item" ></textarea><br/>
                <button type="button" onclick="do_checklist('app_add')">Add</button>
            </td> 
        </tr>     
    </table>
    
    <style type="text/css">
        .selected
        {
            background-color: #666;
            color: #fff;
        }
    </style>
    <?php echo '<script'; ?>
 type="text/javascript">
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
    <?php echo '</script'; ?>
>
    
<?php }?>			



	<?php }
}
