<?php
/* Smarty version 4.3.2, created on 2023-11-24 21:54:14
  from '/data/wwwroot/agentstar.geic.com.au/tpl/todo_sample.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_6560ab06521aa3_41964702',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e6a7d00fca19913be554ece7980a48a07d252c7a' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/todo_sample.tpl',
      1 => 1539716120,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6560ab06521aa3_41964702 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['todos']->value, 'task', false, 'task_id');
$_smarty_tpl->tpl_vars['task']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['task_id']->value => $_smarty_tpl->tpl_vars['task']->value) {
$_smarty_tpl->tpl_vars['task']->do_else = false;
?>
<div class="alert alert-warning" role="alert">
  <h4 class="alert-heading"><?php echo $_smarty_tpl->tpl_vars['task']->value['source'];?>
 --- Due: <?php echo $_smarty_tpl->tpl_vars['task']->value['due_date'];?>
</h4>
  <p style="text-decoration:underline;"  onclick="window.open('<?php echo $_smarty_tpl->tpl_vars['task']->value['openurl'];?>
','','height='+screen.width*4/5+','+'width='+screen.width*4/5)"><?php echo $_smarty_tpl->tpl_vars['task']->value['title'];?>
</p>
  <p><?php echo $_smarty_tpl->tpl_vars['task']->value['descrption'];?>
</p>
  <hr>
  <p class="mb-0">
    <a href="#" class="btn btn-success" onclick="update_task('done', <?php echo $_smarty_tpl->tpl_vars['task']->value['id'];?>
);">Done</a>
    <a href="#" class="btn <?php if ($_smarty_tpl->tpl_vars['task']->value['remind'] == '') {?> btn-warning <?php } else { ?>btn-light<?php }?>" onclick="update_task('remind', <?php echo $_smarty_tpl->tpl_vars['task']->value['id'];?>
);">Remind after</a>
    <select class="form form-control-sm" id="remind_duetime">
        <option value="0.5">30(min)</option>
        <option value="1">1(hr)</option>
        <option value="2">2(hr)</option>
        <option value="4">4(hr)</option>
      </select>
    </div>
 </p>
</div>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
