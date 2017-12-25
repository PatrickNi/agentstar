<?php /* Smarty version 2.6.13, created on 2014-12-14 14:06:43
         compiled from frame_test.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lower', 'frame_test.tpl', 37, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Agent Star -Immigration System</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link href="../css/sam.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
 <tr height="70" >
  <td width="192" align="center" valign="middle"><img src="../images/fox.gif" /></td>
  <td width="4"></td>

  <td width="" valign="bottom"><div style="margin:4px">User: <span class="orange"><?php echo $this->_tpl_vars['user_name']; ?>
</span></div></td>
  <td width="100" align="right" valign="bottom"><a class="blue" href="login.php" target="_top" onclick="javascript:location.replace(this.href);event.returnValue=false;">login out</a></td>
 </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 4px">
 <tr height="20">
  <td align="center" width="192" class="bar"><b><a href="/migration/" class="home">HOME</a></b></td>
  <td width="4"></td>

  <td width="" class="navigation">&nbsp;&nbsp;<span class="white">Navigation:</span>&nbsp;&nbsp;<span class="orange"><?php if ($this->_tpl_vars['gid'] > 0):  echo $this->_tpl_vars['group_name']; ?>
 > <?php echo $this->_tpl_vars['func_name'];  endif; ?></span></td>
 </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
 <tr>
  <td width="192" align="center" valign="top">
  	<table height="100%" border="0" cellpadding="0" cellspacing="0" summary="menu">
		<tr><td height="10%" valign="top">
			<div id="menuDiv">
			<?php $_from = $this->_tpl_vars['grouArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['groupId'] => $this->_tpl_vars['arr']):
?>
			    <div class="menuPater" onClick="openMenu('<?php echo $this->_tpl_vars['groupId']; ?>
')"><div class="menuTitle white"><?php echo $this->_tpl_vars['arr']['name']; ?>
</div></div>
			 	<span id="<?php echo $this->_tpl_vars['groupId']; ?>
" class="menuClick" <?php if ($this->_tpl_vars['groupId'] != $this->_tpl_vars['gid']): ?>style="display:none;"<?php endif; ?>>
				<ul class="menuSub">
			   	<?php $_from = $this->_tpl_vars['arr']['func']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['funcId'] => $this->_tpl_vars['func']):
?>
 					<li><a href="<?php echo $this->_tpl_vars['func']['url']; ?>
"><?php echo $this->_tpl_vars['func']['name'];  if (((is_array($_tmp=$this->_tpl_vars['func']['name'])) ? $this->_run_mod_handler('lower', true, $_tmp) : smarty_modifier_lower($_tmp)) == 'task' && $this->_tpl_vars['task_num'] > 0): ?>&nbsp;&nbsp;<strong style="color:#FF0000 ">Undo: <?php echo $this->_tpl_vars['task_num']; ?>
</strong><?php endif; ?></a></li>
				<?php endforeach; endif; unset($_from); ?>
				</ul>
			   </span>
			<?php endforeach; endif; unset($_from); ?> 
			</div>
		</td></tr>
	</table>
  </td>	
  <td width="4"></td>
  <td align="center" valign="top">  
    <iframe  name="dataFrame"  frameborder="0" width="100%" height="600" scrolling="auto" src="<?php echo $this->_tpl_vars['url']; ?>
"></iframe>
  </td>
 </tr>
 <tr><td colspan="3"><hr   class="navigation" /></td></tr>
</table>
<br />
</body>
</html>  