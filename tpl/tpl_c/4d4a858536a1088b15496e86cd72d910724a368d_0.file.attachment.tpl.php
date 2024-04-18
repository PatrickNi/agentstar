<?php
/* Smarty version 4.3.2, created on 2024-01-09 15:00:12
  from '/data/wwwroot/agentstar.geic.com.au/tpl/attachment.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_659ceefcb86154_06537058',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4d4a858536a1088b15496e86cd72d910724a368d' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/attachment.tpl',
      1 => 1704783608,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_659ceefcb86154_06537058 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<meta http-equiv="pragma" content="no-cache">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="/css/sam.css">
<link href="/css/dropzone.css" type="text/css" rel="stylesheet" />




<?php echo '<script'; ?>
 language="javascript">
		function setNameBox(id, obj)
		{
			arr = document.getElementsByTagName('INPUT');
			document.getElementsByName('new_'+id)[0].disabled = !obj.checked;
			document.getElementById('ch_'+id).disabled = !obj.checked;
			document.getElementById('del_'+id).disabled = !obj.checked;
			for(i=0;i < arr.length; i++)
			{
				if(arr[i].type == 'text' && arr[i].name.match('^new_') && arr[i].name != 'new_'+id)
				{
					arr[i].disabled = true;
				}
				if(arr[i].type == 'submit' && arr[i].name == 'Change' && arr[i].id != 'ch_'+id)
				{
					arr[i].disabled = true;
				}		
				if(arr[i].type == 'submit' && arr[i].name == 'Delete' && arr[i].id != 'del_'+id)
				{
					arr[i].disabled = true;
				}						
			}			
		}
<?php echo '</script'; ?>
>
		
<body>
<form method="post" name="form1" action="" target="_self" enctype="multipart/form-data">
<input type="hidden" name="item" value="<?php echo $_smarty_tpl->tpl_vars['itemid']->value;?>
">
<input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['itemtype']->value;?>
">
<table align="center" class="graybordertable" width="100%" cellpadding="1" cellspacing="1">
	<tr align="center"  class="greybg" >
		<td class="whitetext" colspan="2" style="padding:2 ">Attachment</span></td>
	</tr>
	<tr align="center"  class="greybg" >
		<td align="left" style="font-size:16px " colspan="2"> <span class="highyellow">ItemID: <?php echo $_smarty_tpl->tpl_vars['itemid']->value;?>
</span>&nbsp;&nbsp;&nbsp;<span class="highyellow">Type: <?php echo $_smarty_tpl->tpl_vars['itemtype']->value;?>
</span></td>
	</tr>			
	<tr align="center">
		<td class="roweven" align="left" colspan="2"><input type="file" size="160" name="uploadFile" value="Browse">
		  <input type="submit" name="bt_name" value="Upload" style="font-weight:bold">	  </td>
	</tr>
	<tr align="center">
		<td class="highlighttext"><?php echo $_smarty_tpl->tpl_vars['msg']->value;?>
</td>
	</tr>
	<tr><td>
		<table border="0" cellpadding="1" cellspacing="1" width="100%">
			<tr class="totalrowodd" align="center">
				<td width="2%">&nbsp;</td>
				<td width="30%">Name Change</td>
				<td width="40%">Download File</td>
				<td>Upload Time</td>
			</tr>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['files']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
			<tr class="roweven" align="left">
				<td width="2%"><input type="radio" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" onClick="setNameBox(<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
, this)"></td>
				<td><input type="text" name="new_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" value="" disabled>&nbsp;
					<input type="submit" id="ch_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" name="Change" value="Change" style="font-weight:bold;" disabled="disabled">&nbsp;
					<input type="submit" id="del_<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" name="Delete" value="Delete" style="font-weight:bold;" disabled="disabled">				</td>
				<td><a href="<?php if ($_smarty_tpl->tpl_vars['arr']->value['his']) {?>http://110.143.32.230:8080/download/<?php } else { ?>/download/<?php }
echo $_smarty_tpl->tpl_vars['arr']->value['url'];?>
" ><?php echo $_smarty_tpl->tpl_vars['arr']->value['file'];?>
</a></td>				
				<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['time'];?>
</td>
			</tr>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
		</table>	
	</td></tr>
</table>
</form>	

<form action="/scripts/attachment.php" class="dropzone" id="upload-dropzone">
  <input type="hidden" name="item" value="<?php echo $_smarty_tpl->tpl_vars['itemid']->value;?>
">
  <input type="hidden" name="type" value="<?php echo $_smarty_tpl->tpl_vars['itemtype']->value;?>
">
  <input type="hidden" name="bt_name" value="UPLOAD">
  <input type="hidden" name="xhr" value="1">
  <div class="dz-message needsclick">
    Drop files here or click to upload.
  </div>
</form>

</body>
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-1.9.1.min.js" ><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="/js/dropzone.js" ><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 language="javascript">
	Dropzone.autoDiscover = false;
	Dropzone.maxFilesize = 5;
$(function() {
  // Now that the DOM is fully loaded, create the dropzone, and setup the
  // event listeners
  var myDropzone = new Dropzone("#upload-dropzone");
  myDropzone.on("complete", function(file) {
    location.href = location.href;

  });
})
<?php echo '</script'; ?>
>	
	
</html>
<?php }
}
