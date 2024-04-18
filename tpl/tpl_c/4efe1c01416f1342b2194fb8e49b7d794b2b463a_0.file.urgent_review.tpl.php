<?php
/* Smarty version 4.3.2, created on 2023-11-22 07:32:38
  from '/data/wwwroot/agentstar.geic.com.au/tpl/urgent_review.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_655d3e165502d9_93257308',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4efe1c01416f1342b2194fb8e49b7d794b2b463a' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/urgent_review.tpl',
      1 => 1680756346,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_655d3e165502d9_93257308 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/data/site/wwwroot/agentstar.geic.com.au/lib/SmartyV4/plugins/function.cycle.php','function'=>'smarty_function_cycle',),));
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
<link rel="stylesheet" href="../css/sam.css">
</head>

<?php echo '<script'; ?>
 language="javascript" src="../js/RolloverTable.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-1.9.1.min.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>

<style>
.dotbadge {
  display: inline-block;
  padding: 0.3em 0.3em;
  font-size: 75%;
  font-weight: 700;
  line-height: 1;
  text-align: center;
  white-space: nowrap;
  vertical-align: text-top;
  color: #212529;
  background-color: red;
  border-radius: 0.3rem;

  // Empty badges collapse automatically
  &:empty {
    display: none;
  }
}

</style>
<?php echo '<script'; ?>
 language="javascript">
	function setSortOrd(col, ord){
	     var cols = document.getElementById('sort_list').value;
	//	 alert(cols);
		 if(cols == ''){
		 	document.getElementById('sort_list').value = col+':'+ord;
	//		alert('N1=>'+document.getElementById('sort_list').value);
		 }
		 else {
		 	var flag = false;
			var colarr = cols.split('|');
			for(var i=0; i<colarr.length; i++){
				var co = colarr[i].split(':');
				if(co.length == 2 && col == co[0]){
					colarr[i] = col+':'+ord;
					flag = true;
				}
			}
			if(!flag){
			   colarr[i] = col+':'+ord;
			}
			
		 	document.getElementById('sort_list').value = colarr.join('|');
	//		alert('N2=>'+document.getElementById('sort_list').value);
			
		 }
	}

	function trigger_list(view_mod,obj,view_id) {
		if (document.getElementById('view_show').value == view_mod) {
			document.getElementById('view_show').value = '';
			$('#'+view_id).css('visibility','collapse');

		}
		else {
			document.getElementById('sort_list').value='';
			document.getElementById('t_view').value=view_mod;
			obj.submit();
		}	
	}

	function birthday_done(cid, dob,obj) {
		 $.post('/scripts/urgent_review.php', '&act=check_dob&cid='+cid+'&dob='+dob, function(data){
            rtn = $.parseJSON(data);
            if(rtn.succ==1) {
            	$(obj).remove();
            }
        });
	}
<?php echo '</script'; ?>
>

<body>
<form name="form1" id="form1" target="_self">
<input type="hidden" id="t_view" name="t_view" value="">
<input type="hidden" id="sort_list" name="sort_list" value="<?php echo $_smarty_tpl->tpl_vars['sort_list']->value;?>
">
<input type="hidden" id="view_show" value="<?php echo $_smarty_tpl->tpl_vars['view_show']->value;?>
">

<table align="center" width="100%"  class="graybordertable" cellpadding="1" cellspacing="1" border="0">
	<tr><td align="center" class="title" style="font-size:14px; padding:3">
		Todo List&nbsp;&nbsp;&nbsp;&nbsp;
	   <!--<input type="button" style="font-weight:bold" onClick="printPage();"value="Print">-->
	</td></tr>
	<?php if ($_smarty_tpl->tpl_vars['ugs']->value['v_service']['v'] == 1) {?>
	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="trigger_list('v',form1,'view_v');">
    		Visa List&nbsp;&nbsp;
      </td></tr>
	<?php if ($_smarty_tpl->tpl_vars['viewWhat']->value == 'v') {?>
	<tr id="view_v"><td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="center" class="title">
					<td width="5%">
              	        <select name="vUid" onChange="sort_list.value='';t_view.value='v';form1.submit();">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['slUsers']->value, 'user_name', false, 'user_id');
$_smarty_tpl->tpl_vars['user_name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['user_id']->value => $_smarty_tpl->tpl_vars['user_name']->value) {
$_smarty_tpl->tpl_vars['user_name']->do_else = false;
?>		
                          <option value="<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['staffid']->value == $_smarty_tpl->tpl_vars['user_id']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
</option>  
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php if ($_smarty_tpl->tpl_vars['ugs']->value['todo_visa']['v'] == 1) {?>				
                          <option value="0" <?php if ($_smarty_tpl->tpl_vars['staffid']->value == '0') {?> selected <?php }?>>All Staff</option>  
                           <option value="-1" <?php if ($_smarty_tpl->tpl_vars['staffid']->value == '-1') {?> selected <?php }?>>Unassigned</option>  
                        <?php }?>		
                    </select>
                    </td>
					<td align="left" nowrap="nowrap">Client Name
					</td>		
					<td align="left" nowrap="nowrap">Category
					</td>
					<td align="left">SubClass				
					</td>
					<td align="left" width="40%">Process&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="setSortOrd(4,0);t_view.value='v';form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="setSortOrd(4,1);t_view.value='v';form1.submit();"/>					
					</td>
					<td nowrap="nowrap">Agreement Staff
					</td>
					<td nowrap="nowrap">Paperwork
					</td>
					<td nowrap="nowrap">Reviewer
					</td>
					<td nowrap="nowrap">Due Date<br/>
						<input type="checkbox" name="vdu" value="1" <?php if ($_smarty_tpl->tpl_vars['vdu']->value == 1) {?> checked <?php }?> onChange="t_view.value='v';form1.submit()"/> ex(0000-00-00)
					</td>
				</tr>
				<?php $_smarty_tpl->_assignInScope('rank', "0");?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['urgent_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
				<?php $_smarty_tpl->_assignInScope('rank', $_smarty_tpl->tpl_vars['rank']->value+1);?>
				 <tr align="center" class="<?php echo smarty_function_cycle(array('values'=>'rowodd,roweven'),$_smarty_tpl);?>
">
					<td width="2%"><?php echo $_smarty_tpl->tpl_vars['rank']->value;?>
</td>
				 	<td align="left" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['arr']->value['name'];?>
</td>
					<td align="left" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['arr']->value['cate'];?>
</td>
					<td align="left"><?php echo $_smarty_tpl->tpl_vars['arr']->value['class'];?>
</td>
					<!-- onClick="openModel('client_visa_process.php?pid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&cid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['clientid'];?>
&vid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['visaid'];?>
',800,560,'NO', 'form1')"-->
					<td align="left" style="<?php if ($_smarty_tpl->tpl_vars['arr']->value['islodge'] == 1) {?>color:#FF3300;<?php } elseif (stripos($_smarty_tpl->tpl_vars['arr']->value['item'],'DHA request') === 0 || stripos($_smarty_tpl->tpl_vars['arr']->value['item'],'apply onshore') === 0) {?>color:red;<?php } elseif ($_smarty_tpl->tpl_vars['arr']->value['isApply'] == 1) {?>color:blue;<?php }?>cursor:pointer; text-decoration:underline" onClick="window.open('client_visa_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['clientid'];?>
&vid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['visaid'];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['arr']->value['item'];?>
</td>
					<td nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['slUsers']->value[$_smarty_tpl->tpl_vars['arr']->value['auid']];?>
</td>
					<td nowrap="nowrap">
						<span <?php if ($_smarty_tpl->tpl_vars['arr']->value['is_review'] == 2 && $_smarty_tpl->tpl_vars['arr']->value['status'] != 'grant' && $_smarty_tpl->tpl_vars['arr']->value['status'] != 'refused' && stripos($_smarty_tpl->tpl_vars['arr']->value['item'],'apply onshore') === 0) {?>style="color:red;"<?php }?>><?php echo $_smarty_tpl->tpl_vars['slUsers']->value[$_smarty_tpl->tpl_vars['arr']->value['vuid']];?>
</span>
					</td>
					<td nowrap="nowrap" align="left">
						<span><?php echo $_smarty_tpl->tpl_vars['slUsers']->value[$_smarty_tpl->tpl_vars['arr']->value['reviewer']];?>
</span>
					</td>
					<td nowrap="nowrap" <?php if ($_smarty_tpl->tpl_vars['arr']->value['isTodo'] != 1) {?>style="color:#660000; font-weight:bold"<?php }?>><?php echo $_smarty_tpl->tpl_vars['arr']->value['due'];?>
</td>
				 </tr>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>	
			</table>
	</td></tr>
	<?php }?>
	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="trigger_list('vreview',form1,'view_vreview');">
    		Visa Review List
			<?php if ($_smarty_tpl->tpl_vars['hasReviews']->value) {?>
				&nbsp;
				<span class="dotbadge"></span>
			<?php }?>
      </td>
	</tr>
	<?php if ($_smarty_tpl->tpl_vars['viewWhat']->value == 'vreview') {?>
	<tr id="view_vreview">
		<td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="center" class="title">
					<td width="5%">
              	        <select name="vUid" onChange="sort_list.value='';t_view.value='vreview';form1.submit();">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['slUsers']->value, 'user_name', false, 'user_id');
$_smarty_tpl->tpl_vars['user_name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['user_id']->value => $_smarty_tpl->tpl_vars['user_name']->value) {
$_smarty_tpl->tpl_vars['user_name']->do_else = false;
?>		
                          <option value="<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['staffid']->value == $_smarty_tpl->tpl_vars['user_id']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
</option>  
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        <?php if ($_smarty_tpl->tpl_vars['ugs']->value['todo_visa']['v'] == 1) {?>				
                          <option value="0" <?php if ($_smarty_tpl->tpl_vars['staffid']->value == '0') {?> selected <?php }?>>choose a staff</option>  
                        <?php }?>		
                    </select>
                    </td>
					<td align="left" nowrap="nowrap">Client Name</td>		
					<td align="left" nowrap="nowrap">Category</td>
					<td align="left">SubClass</td>
					<td align="left" width="40%">Process</td>
					<td nowrap="nowrap">Agreement Staff</td>
					<td nowrap="nowrap">Paperwork</td>
					<td nowrap="nowrap">Reviewer</td>
					<td nowrap="nowrap">Due Date</td>
				</tr>
				<?php $_smarty_tpl->_assignInScope('rank', "0");?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['urgent_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
				<?php $_smarty_tpl->_assignInScope('rank', $_smarty_tpl->tpl_vars['rank']->value+1);?>
				 <tr align="center" class="<?php echo smarty_function_cycle(array('values'=>'rowodd,roweven'),$_smarty_tpl);?>
">
					<td width="2%"><?php echo $_smarty_tpl->tpl_vars['rank']->value;?>
</td>
				 	<td align="left" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['arr']->value['name'];?>
</td>
					<td align="left" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['arr']->value['cate'];?>
</td>
					<td align="left"><?php echo $_smarty_tpl->tpl_vars['arr']->value['class'];?>
</td>
					<td align="left" style="<?php if ($_smarty_tpl->tpl_vars['arr']->value['islodge'] == 1) {?>color:#FF3300;<?php } elseif (stripos($_smarty_tpl->tpl_vars['arr']->value['item'],'DHA request') === 0 || stripos($_smarty_tpl->tpl_vars['arr']->value['item'],'apply onshore') === 0) {?>color:red;<?php } elseif ($_smarty_tpl->tpl_vars['arr']->value['isApply'] == 1) {?>color:blue;<?php }?>cursor:pointer; text-decoration:underline" onClick="window.open('client_visa_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['clientid'];?>
&vid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['visaid'];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['arr']->value['item'];?>
</td>
					<td nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['slUsers']->value[$_smarty_tpl->tpl_vars['arr']->value['auid']];?>
</td>
					<td nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['slUsers']->value[$_smarty_tpl->tpl_vars['arr']->value['vuid']];?>
</td>
					<td nowrap="nowrap" align="left">
						<span <?php if ($_smarty_tpl->tpl_vars['arr']->value['is_review'] == 1 && stripos($_smarty_tpl->tpl_vars['arr']->value['item'],'review application') === 0) {?>style="color:red;"<?php }?>><?php echo $_smarty_tpl->tpl_vars['slUsers']->value[$_smarty_tpl->tpl_vars['arr']->value['reviewer']];?>
</span>
					</td>
					<td nowrap="nowrap" <?php if ($_smarty_tpl->tpl_vars['arr']->value['isTodo'] != 1) {?>style="color:#660000; font-weight:bold"<?php }?>><?php echo $_smarty_tpl->tpl_vars['arr']->value['due'];?>
</td>
				 </tr>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>	
			</table>
		</td>	
	</tr>
	<?php }?>
	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="trigger_list('vexp',form1,'view_vexp');">
    		Visa Expire List
      </td>
	</tr>
	<?php if ($_smarty_tpl->tpl_vars['viewWhat']->value == 'vexp') {?>
	<tr id="view_vexp">
		<td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
			<tr align="center" class="totalrowodd">
				<td width="5%">
					<select name="vUid" onChange="sort_list.value='';t_view.value='vexp';form1.submit();">
					<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['slUsers']->value, 'user_name', false, 'user_id');
$_smarty_tpl->tpl_vars['user_name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['user_id']->value => $_smarty_tpl->tpl_vars['user_name']->value) {
$_smarty_tpl->tpl_vars['user_name']->do_else = false;
?>		
						<option value="<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['staffid']->value == $_smarty_tpl->tpl_vars['user_id']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
</option>  
					<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					<?php if ($_smarty_tpl->tpl_vars['ugs']->value['todo_visa']['v'] == 1) {?>				
						<option value="0" <?php if ($_smarty_tpl->tpl_vars['staffid']->value == '0') {?> selected <?php }?>>All Staff</option>  
						<option value="-1" <?php if ($_smarty_tpl->tpl_vars['staffid']->value == '-1') {?> selected <?php }?>>Unassigned</option>  
					<?php }?>		
				</select>
				</td>
				<td>Expire Date </td>
				<td>Last Name</td>
				<td>Firset Name</td>
				<td>Visa Category</td>
				<td>Visa SubClass</td>
			</tr>
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['urgent_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
			<tr align="center" class="roweven">
				<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['type'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['date'];?>
</td>
				<td><span style="cursor:pointer; text-decoration:underline;" onClick="window.open('client_visa_detail.php?cid=<?php if ($_smarty_tpl->tpl_vars['arr']->value['main'] > 0) {
echo $_smarty_tpl->tpl_vars['arr']->value['main'];
} else {
echo $_smarty_tpl->tpl_vars['arr']->value['cid'];
}?>&vid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['vid'];?>
','','height='+screen.width*4/5+','+'width='+screen.width*4/5)"><?php echo $_smarty_tpl->tpl_vars['arr']->value['lname'];?>
</span></td>
				<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['fname'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['category'];?>
</td>
				<td><?php echo $_smarty_tpl->tpl_vars['arr']->value['subclass'];?>
</td>
			</tr>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</table>
		</td>
	</tr>
	<?php }?>

	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="trigger_list('vm',form1,'view_vm');">
    		Verify Migration Course List&nbsp;&nbsp;
      </td></tr>
	<?php if ($_smarty_tpl->tpl_vars['viewWhat']->value == 'vm') {?>
	<tr id="view_vm"><td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="left" class="title">
					<td colspan="6">
              	        <select name="vmUid" onChange="sort_list.value='';t_view.value='vm';form1.submit();">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['slUsers']->value, 'user_name', false, 'user_id');
$_smarty_tpl->tpl_vars['user_name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['user_id']->value => $_smarty_tpl->tpl_vars['user_name']->value) {
$_smarty_tpl->tpl_vars['user_name']->do_else = false;
?>
                          	<option value="<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['staffid']->value == $_smarty_tpl->tpl_vars['user_id']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
</option>  
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>                    			          
                        <?php if ($_smarty_tpl->tpl_vars['ugs']->value['todo_course']['v'] == 1) {?>				
                          <option value="0" <?php if ($_smarty_tpl->tpl_vars['staffid']->value == '0') {?> selected <?php }?>>All Staff</option>  
                        <?php }?>	            		
                    </select>
                    </td>
                 </tr>
   				<tr align="center" class="title">
					<td align="left" width="100px">Client Name &nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(1,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(1,1);form1.submit();"/>					
					</td>	
					<td align="left" width="100px">Institute &nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(2,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(2,1);;form1.submit();"/>										
					</td>
					<td align="left" width="100px">Qualification&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(3,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(3,1);form1.submit();"/>									
					</td>
					<td align="left" width="100px">Major&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(4,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(4,1);form1.submit();"/>										
					</td>		
					<td align="left"width="300px">Process &nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(5,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(5,1);form1.submit();"/>							
					</td>
					<td width="100px">Due Date&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(6,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(6,1);form1.submit();"/>			
						<br/><input type="checkbox" name="cdu" value="1" <?php if ($_smarty_tpl->tpl_vars['cdu']->value == 1) {?> checked <?php }?> onChange="t_view.value='vm';form1.submit()"/> ex(0000-00-00)							
					</td>
				</tr>
				 <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['urgent_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
				 <tr align="center" class="<?php echo smarty_function_cycle(array('values'=>'rowodd,roweven'),$_smarty_tpl);?>
">
					<td align="left"><?php echo $_smarty_tpl->tpl_vars['arr']->value['name'];?>
</td>
					<td align="left"><?php echo $_smarty_tpl->tpl_vars['arr']->value['school'];?>
</td>
					<td align="left"><?php echo $_smarty_tpl->tpl_vars['arr']->value['qual'];?>
</td>
					<td align="left"><?php echo $_smarty_tpl->tpl_vars['arr']->value['major'];?>
</td>
					<td style="cursor:pointer; text-decoration:underline; <?php if ($_smarty_tpl->tpl_vars['arr']->value['isColor'] == 1) {?>color:#0000FF<?php }?>"  onClick="window.open('client_course_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['clientid'];?>
&courseid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['courseid'];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['arr']->value['item'];?>
</td>
					<td nowrap="nowrap" <?php if ($_smarty_tpl->tpl_vars['arr']->value['isTodo'] != 1) {?>style="color:#660000; font-weight:bold"<?php }?>><?php echo $_smarty_tpl->tpl_vars['arr']->value['due'];?>
</td>
				 </tr>
				 <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</table>
	</td></tr><?php }?>

	<?php }?>	
	<?php if ($_smarty_tpl->tpl_vars['ugs']->value['c_service']['v'] == 1) {?>
	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="trigger_list('c',form1,'view_c');">Course List&nbsp;&nbsp;</td></tr>
	<?php if ($_smarty_tpl->tpl_vars['viewWhat']->value == 'c') {?>
	<tr id="view_c"><td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="left" class="title">
					<td colspan="9">
              	        <select name="cUid" onChange="sort_list.value='';t_view.value='c';form1.submit();">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['slUsers']->value, 'user_name', false, 'user_id');
$_smarty_tpl->tpl_vars['user_name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['user_id']->value => $_smarty_tpl->tpl_vars['user_name']->value) {
$_smarty_tpl->tpl_vars['user_name']->do_else = false;
?>
                          	<option value="<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['staffid']->value == $_smarty_tpl->tpl_vars['user_id']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
</option>  
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>                    			          
                        <?php if ($_smarty_tpl->tpl_vars['ugs']->value['todo_course']['v'] == 1) {?>				
                          <option value="0" <?php if ($_smarty_tpl->tpl_vars['staffid']->value == '0') {?> selected <?php }?>>All Staff</option>  
                        <?php }?>	            		
                    </select>
                    </td>
                 </tr>
   				<tr align="center" class="title">
					<td align="center" width="3%">No.</td>
					<td align="left" width="100px">Client Name &nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(1,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(1,1);form1.submit();"/>					
					</td>	
					<td align="left" width="100px">Institute &nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(2,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(2,1);;form1.submit();"/>										
					</td>
					<td align="left" width="100px">Qualification&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(3,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(3,1);form1.submit();"/>									
					</td>
					<td align="left" width="100px">Major&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(4,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(4,1);form1.submit();"/>										
					</td>		
					<td align="left"width="300px">Process &nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(5,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(5,1);form1.submit();"/>							
					</td>
					<td width="100px">Consultant</td>
					<td width="100px">Paperwork</td>
					<td width="100px">Due Date&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(6,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='c';setSortOrd(6,1);form1.submit();"/>			
						<br/><input type="checkbox" name="cdu" value="1" <?php if ($_smarty_tpl->tpl_vars['cdu']->value == 1) {?> checked <?php }?> onChange="t_view.value='c';form1.submit()"/> ex(0000-00-00)							
					</td>
				</tr>
				<?php $_smarty_tpl->_assignInScope('rank', "0");?>
				 <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['urgent_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
				 <tr align="center" class="<?php echo smarty_function_cycle(array('values'=>'rowodd,roweven'),$_smarty_tpl);?>
">
				 	<td align="center">
						 <?php $_smarty_tpl->_assignInScope('rank', $_smarty_tpl->tpl_vars['rank']->value+1);?>
						 <?php echo $_smarty_tpl->tpl_vars['rank']->value;?>

					</td>
					<td align="left"><?php echo $_smarty_tpl->tpl_vars['arr']->value['name'];?>
</td>
					<td align="left"><?php echo $_smarty_tpl->tpl_vars['arr']->value['school'];?>
</td>
					<td align="left"><?php echo $_smarty_tpl->tpl_vars['arr']->value['qual'];?>
</td>
					<td align="left"><?php echo $_smarty_tpl->tpl_vars['arr']->value['major'];?>
</td>
					<td style="cursor:pointer; text-decoration:underline; <?php if ($_smarty_tpl->tpl_vars['arr']->value['isColor'] == 1) {?>color:#0000FF <?php } elseif ($_smarty_tpl->tpl_vars['arr']->value['item'] == 'Add new semester') {?> color:blue<?php } elseif ($_smarty_tpl->tpl_vars['arr']->value['item'] == 'Pay tuition fee') {?> color:red<?php }?>"  onClick="window.open('client_course_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['clientid'];?>
&courseid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['courseid'];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['arr']->value['item'];?>
</td>
					<td align="center"><?php echo $_smarty_tpl->tpl_vars['slCourseViewer']->value[$_smarty_tpl->tpl_vars['arr']->value['consultant']];?>
</td>
					<td align="center"><?php echo $_smarty_tpl->tpl_vars['slCourseViewer']->value[$_smarty_tpl->tpl_vars['arr']->value['paperwork']];?>
</td>
					<td nowrap="nowrap" <?php if ($_smarty_tpl->tpl_vars['arr']->value['isTodo'] != 1) {?>style="color:#660000; font-weight:bold"<?php }?>><?php echo $_smarty_tpl->tpl_vars['arr']->value['due'];?>
</td>
				 </tr>
				 <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</table>
	</td></tr><?php }
}?>
	<?php if ($_smarty_tpl->tpl_vars['ugs']->value['i_proc']['v'] == 1) {?>	
	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="trigger_list('i',form1,'view_i');">Institute List&nbsp;&nbsp;</td></tr>
	<?php if ($_smarty_tpl->tpl_vars['viewWhat']->value == 'i') {?>
	<tr id="view_i"><td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="center" class="title">
					<td width="2%">&nbsp;</td>
					<td align="left">Category</td>
					<td align="left" nowrap="nowrap">Institute&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='i';setSortOrd(1,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='i';setSortOrd(1,1);form1.submit();"/>										
					</td>	
					<td align="left" width="70%">Process&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='i';setSortOrd(2,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='i';setSortOrd(2,1);form1.submit();"/>							
					</td>
					<td nowrap="nowrap">Due Date&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='i';setSortOrd(3,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='i';setSortOrd(3,1);form1.submit();"/>			
						<br/><input type="checkbox" name="idu" value="1" <?php if ($_smarty_tpl->tpl_vars['idu']->value == 1) {?> checked <?php }?> onChange="t_view.value='i';form1.submit()"/> ex(0000-00-00)					
					</td>
				</tr>
				 <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['urgent_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
				 <tr align="center" class="<?php echo smarty_function_cycle(array('values'=>'rowodd,roweven'),$_smarty_tpl);?>
">
				 	<td width="2%"><input type="checkbox"></td>
					<td align="left" width="10%" ><?php echo $_smarty_tpl->tpl_vars['arr']->value['cate'];?>
</td>
					<td align="left" ><?php echo $_smarty_tpl->tpl_vars['arr']->value['school'];?>
</td>
					<td align="left" style="cursor:pointer; text-decoration:underline" onClick="window.open('institute_process.php?sid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['iid'];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['arr']->value['item'];?>
</td>
					<td nowrap="nowrap" <?php if ($_smarty_tpl->tpl_vars['arr']->value['isTodo'] != 1) {?>style="color:#660000; font-weight:bold"<?php }?>><?php echo $_smarty_tpl->tpl_vars['arr']->value['due'];?>
</td>
				 </tr>
				 <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</table>	
	</td></tr><?php }
}?>
	<?php if ($_smarty_tpl->tpl_vars['ugs']->value['a_service']['v'] == 1) {?>
	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="trigger_list('asub',form1,'view_asub');">Sub Agent List&nbsp;&nbsp;</td></tr>		
	<?php if ($_smarty_tpl->tpl_vars['viewWhat']->value == 'asub') {?>
	<tr id="view_asub"><td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="center" class="title">
					<td width="2%">&nbsp;</td>
					<td align="left" nowrap="nowrap">Agent &nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='a';setSortOrd(1,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='a';setSortOrd(1,1);form1.submit();"/>															
					</td>	
					<td align="left" width="40%">Process &nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='a';setSortOrd(2,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='a';setSortOrd(2,1);;form1.submit();"/>															
					</td>
					<td nowrap="nowrap">Due Date&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='a';setSortOrd(3,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='a';setSortOrd(3,1);form1.submit();"/>			
						<br/><input type="checkbox" name="asubdu" value="1" <?php if ($_smarty_tpl->tpl_vars['asubdu']->value == 1) {?> checked <?php }?> onChange="t_view.value='asub';form1.submit()"/> ex(0000-00-00)																	
					</td>
				</tr>
				 <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['urgent_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
				 <tr align="center" class="<?php echo smarty_function_cycle(array('values'=>'rowodd,roweven'),$_smarty_tpl);?>
">
				 	<td width="2%"><input type="checkbox"></td>
					<td align="left" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['arr']->value['agent'];?>
</td>
					<td align="left" style="cursor:pointer; text-decoration:underline" onClick="openAgentPage(<?php echo $_smarty_tpl->tpl_vars['arr']->value['aid'];?>
);window.open('redir.php?t=agt&pid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&aid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['aid'];?>
','','height='+screen.width*3/5+','+'width='+screen.width*4/5)"><?php echo $_smarty_tpl->tpl_vars['arr']->value['item'];?>
</td>
					<td nowrap="nowrap" <?php if ($_smarty_tpl->tpl_vars['arr']->value['isTodo'] != 1) {?>style="color:#660000; font-weight:bold"<?php }?>><?php echo $_smarty_tpl->tpl_vars['arr']->value['due'];?>
</td>
				 </tr>
				 <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</table>
	</td></tr><?php }?>	

	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="trigger_list('atop',form1,'view_atop')">Top Agent List&nbsp;&nbsp;</td></tr>		
	<?php if ($_smarty_tpl->tpl_vars['viewWhat']->value == 'atop') {?>
	<tr id="view_atop"><td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="center" class="title">
					<td width="2%">&nbsp;</td>
					<td align="left" nowrap="nowrap">Agent &nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='a';setSortOrd(1,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='a';setSortOrd(1,1);form1.submit();"/>															
					</td>	
					<td align="left" width="40%">Process &nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='a';setSortOrd(2,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='a';setSortOrd(2,1);;form1.submit();"/>															
					</td>
					<td nowrap="nowrap">Due Date&nbsp;&nbsp;
						<img src="../images/sort_up.gif" style="cursor:pointer" onClick="t_view.value='a';setSortOrd(3,0);form1.submit();"/>&nbsp;&nbsp;
						<img src="../images/sort_down.gif" style="cursor:pointer" onClick="t_view.value='a';setSortOrd(3,1);form1.submit();"/>
						<br/><input type="checkbox" name="atopdu" value="1" <?php if ($_smarty_tpl->tpl_vars['atopdu']->value == 1) {?> checked <?php }?> onChange="t_view.value='atop';form1.submit()"/> ex(0000-00-00)																				
					</td>
				</tr>
				 <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['urgent_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
				 <tr align="center" class="<?php echo smarty_function_cycle(array('values'=>'rowodd,roweven'),$_smarty_tpl);?>
">
				 	<td width="2%"><input type="checkbox"></td>
					<td align="left" nowrap="nowrap"><?php echo $_smarty_tpl->tpl_vars['arr']->value['agent'];?>
</td>
					<!--onClick="openModel('institute_process.php?pid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&cid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['clientid'];?>
&courseid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['courseid'];?>
',700,400,'NO', 'form1')"-->
					<td align="left" style="cursor:pointer; text-decoration:underline" onClick="openAgentPage(<?php echo $_smarty_tpl->tpl_vars['arr']->value['aid'];?>
);window.open('redir.php?t=agt&pid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&aid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['aid'];?>
','','height='+screen.width*3/5+','+'width='+screen.width*4/5)"><?php echo $_smarty_tpl->tpl_vars['arr']->value['item'];?>
</td>
					<td nowrap="nowrap" <?php if ($_smarty_tpl->tpl_vars['arr']->value['isTodo'] != 1) {?>style="color:#660000; font-weight:bold"<?php }?>><?php echo $_smarty_tpl->tpl_vars['arr']->value['due'];?>
</td>
				 </tr>
				 <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</table>
	</td></tr><?php }?>	


	<?php }?>
	<?php if ($_smarty_tpl->tpl_vars['ugs']->value['b_service']['v'] == 1) {?>
	<tr><td class="menu"  align="left" style="cursor:pointer" onClick="trigger_list('s',form1,'view_s')">Birthday List&nbsp;&nbsp;</td></tr>
	<?php if ($_smarty_tpl->tpl_vars['viewWhat']->value == 's') {?>
	<tr id="view_s"><td>
			<table width="100%" cellpadding="1" cellspacing="1" border="0">
				<tr align="left" class="title">
					<td colspan="6">
              	        <select name="cUid" onChange="sort_list.value='';t_view.value='s';form1.submit();">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['slUsers']->value, 'user_name', false, 'user_id');
$_smarty_tpl->tpl_vars['user_name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['user_id']->value => $_smarty_tpl->tpl_vars['user_name']->value) {
$_smarty_tpl->tpl_vars['user_name']->do_else = false;
?>
                          	<option value="<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['staffid']->value == $_smarty_tpl->tpl_vars['user_id']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
</option>  
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>                    			          
                        <?php if ($_smarty_tpl->tpl_vars['ugs']->value['todo_course']['v'] == 1) {?>			
                          <option value="0" <?php if ($_smarty_tpl->tpl_vars['staffid']->value == '0') {?> selected <?php }?>>All Staff</option>  
                        <?php }?>	            		
                    </select>
                    </td>
                 </tr>
				<tr align="center" class="title">
					<td width="2%">&nbsp;</td>
					<td align="left" nowrap="nowrap">ClientName															
					</td>	
					<td align="left"nowrap="nowrap" width="40%">Process
																									
					</td>
					<td nowrap="nowrap">Due Date
					</td>
					<td>Link</td>
				</tr>
				 <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['urgent_arr']->value, 'arr', false, 'id');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
				 <tr align="center" class="<?php echo smarty_function_cycle(array('values'=>'rowodd,roweven'),$_smarty_tpl);?>
">
				 	<td width="2%"><input type="checkbox"></td>
					<td align="left"><?php echo $_smarty_tpl->tpl_vars['arr']->value['name'];?>
</td>
					<!--onClick="openModel('institute_process.php?pid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&cid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['clientid'];?>
&courseid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['courseid'];?>
',700,400,'NO', 'form1')"-->
					<td align="left" style="cursor:pointer; text-decoration:underline" onClick="openClientPage(<?php echo $_smarty_tpl->tpl_vars['arr']->value['clientid'];?>
);window.open('redir.php?t=ser&pid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
&cid=<?php echo $_smarty_tpl->tpl_vars['arr']->value['clientid'];?>
','','height='+screen.width*3/5+','+'width='+screen.width*4/5)"><?php echo $_smarty_tpl->tpl_vars['arr']->value['item'];?>
</td>
					<td nowrap="nowrap" <?php if ($_smarty_tpl->tpl_vars['arr']->value['isTodo'] != 1) {?>style="color:#660000; font-weight:bold"<?php }?>><?php echo $_smarty_tpl->tpl_vars['arr']->value['due'];?>
</td>
					<td><?php if ($_smarty_tpl->tpl_vars['arr']->value['isTodo'] == 1) {?><input type="button" value="Done" onClick="birthday_done('<?php echo $_smarty_tpl->tpl_vars['arr']->value['clientid'];?>
','<?php echo $_smarty_tpl->tpl_vars['arr']->value['due'];?>
', this)"><?php }?></td>
				 </tr>
				 <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
			</table>					
	</td></tr><?php }
}?>
</table>
</form>
</body>
</html>
<?php }
}
