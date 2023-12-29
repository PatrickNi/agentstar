<?php /* Smarty version 2.6.13, created on 2020-10-24 03:35:12
         compiled from todo_sample.tpl */ ?>
<?php $_from = $this->_tpl_vars['todos']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['task_id'] => $this->_tpl_vars['task']):
?>
<div class="alert alert-warning" role="alert">
  <h4 class="alert-heading"><?php echo $this->_tpl_vars['task']['source']; ?>
 --- Due: <?php echo $this->_tpl_vars['task']['due_date']; ?>
</h4>
  <p style="text-decoration:underline;"  onclick="window.open('<?php echo $this->_tpl_vars['task']['openurl']; ?>
','','height='+screen.width*4/5+','+'width='+screen.width*4/5)"><?php echo $this->_tpl_vars['task']['title']; ?>
</p>
  <p><?php echo $this->_tpl_vars['task']['descrption']; ?>
</p>
  <hr>
  <p class="mb-0">
    <a href="#" class="btn btn-success" onclick="update_task('done', <?php echo $this->_tpl_vars['task']['id']; ?>
);">Done</a>
    <a href="#" class="btn <?php if ($this->_tpl_vars['task']['remind'] == ''): ?> btn-warning <?php else: ?>btn-light<?php endif; ?>" onclick="update_task('remind', <?php echo $this->_tpl_vars['task']['id']; ?>
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
<?php endforeach; endif; unset($_from); ?>