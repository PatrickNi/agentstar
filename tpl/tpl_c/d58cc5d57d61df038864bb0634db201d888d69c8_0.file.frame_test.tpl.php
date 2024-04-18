<?php
/* Smarty version 4.3.2, created on 2023-09-21 18:06:07
  from '/data/wwwroot/agentstar.geic.com.au/tpl/frame_test.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_650c158f4d3387_85839758',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd58cc5d57d61df038864bb0634db201d888d69c8' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/frame_test.tpl',
      1 => 1679522292,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_650c158f4d3387_85839758 (Smarty_Internal_Template $_smarty_tpl) {
?><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>

body {margin-left: 0px;margin-top: 0px;margin-right: 0px;margin-bottom: 0px;overflow: hidden;}
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
}

</style>
<title>Agent Star -Immigration System</title>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link href="../css/sam.css" rel="stylesheet" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Agent Star - TODO</title>
</head>
<body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <?php echo '<script'; ?>
 src="/js/jquery-3.5.1.min.js" crossorigin="anonymous"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"><?php echo '</script'; ?>
>
<input type="hidden" id="uid" value="<?php echo $_smarty_tpl->tpl_vars['uid']->value;?>
">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
 <tr height="70" >
  <td width="192" align="center" valign="middle"><img src="../images/fox.gif" /></td>
  <td width="4"></td>

  <td width="" valign="bottom"><div style="margin:4px">User: <span class="orange"><?php echo $_smarty_tpl->tpl_vars['user_name']->value;?>
</span></div></td>
  <td width="100" align="right" valign="bottom"><a class="blue" href="login.php" target="_top" onclick="javascript:location.replace(this.href);event.returnValue=false;">login out</a></td>
 </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 4px">
 <tr height="20">
  <td align="center" width="192" class="bar"><b><a href="/migration/" class="home">HOME</a></b></td>
  <td width="4"></td>

  <td width="" class="navigation">&nbsp;&nbsp;<span class="white">Navigation:</span>&nbsp;&nbsp;<span class="orange"><?php if ($_smarty_tpl->tpl_vars['gid']->value > 0) {
echo $_smarty_tpl->tpl_vars['group_name']->value;?>
 > <?php echo $_smarty_tpl->tpl_vars['func_name']->value;
}?></span></td>
 </tr>
</table>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
 <tr>
  <td width="192" align="center" valign="top">
  	<table height="100%" border="0" cellpadding="0" cellspacing="0" summary="menu">
		<tr><td height="10%" valign="top">
			<div id="menuDiv">
			<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['grouArr']->value, 'arr', false, 'groupId');
$_smarty_tpl->tpl_vars['arr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['groupId']->value => $_smarty_tpl->tpl_vars['arr']->value) {
$_smarty_tpl->tpl_vars['arr']->do_else = false;
?>
			    <div class="menuPater" onClick="openMenu('<?php echo $_smarty_tpl->tpl_vars['groupId']->value;?>
')"><div class="menuTitle white"><?php echo $_smarty_tpl->tpl_vars['arr']->value['name'];?>
</div></div>
			 	<span id="<?php echo $_smarty_tpl->tpl_vars['groupId']->value;?>
" class="menuClick" <?php if ($_smarty_tpl->tpl_vars['groupId']->value != $_smarty_tpl->tpl_vars['gid']->value) {?>style="display:none;"<?php }?>>
				<ul class="menuSub">
			   	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arr']->value['func'], 'func', false, 'funcId');
$_smarty_tpl->tpl_vars['func']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['funcId']->value => $_smarty_tpl->tpl_vars['func']->value) {
$_smarty_tpl->tpl_vars['func']->do_else = false;
?>
 					<li><a href="<?php echo $_smarty_tpl->tpl_vars['func']->value['url'];?>
"><?php echo $_smarty_tpl->tpl_vars['func']->value['name'];
if (mb_strtolower((string) $_smarty_tpl->tpl_vars['func']->value['name'], 'UTF-8') == 'visa review list' && $_smarty_tpl->tpl_vars['hasReviews']->value) {?><span class="dotbadge"></span><?php }?></a></li>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				</ul>
			   </span>
			<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> 
			</div>
		</td></tr>
	</table>
  </td>	
  <td width="4"></td>
  <td align="center" valign="top">  
    <iframe  name="dataFrame"  frameborder="0" width="100%" height="100%" src="<?php echo $_smarty_tpl->tpl_vars['url']->value;?>
"></iframe>
  </td>
 </tr>
 <tr><td colspan="3"><hr   class="navigation" /></td></tr>
</table>
<br />
  <!-- Modal -->
<div class="modal fade" id="remind_pannel" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
      <div class="modal-body">
      </div>
  </div>
  </div>
</div>

</body>
<?php if ($_smarty_tpl->tpl_vars['ugs']->value['todo_alert']['v'] == 1) {?> 

<?php echo '<script'; ?>
 type="text/javascript">
    Date.prototype.format = function(format) {
       var date = {
              "M+": this.getMonth() + 1,
              "d+": this.getDate(),
              "h+": this.getHours(),
              "m+": this.getMinutes(),
              "s+": this.getSeconds(),
              "q+": Math.floor((this.getMonth() + 3) / 3),
              "S+": this.getMilliseconds()
       };
       if (/(y+)/i.test(format)) {
              format = format.replace(RegExp.$1, (this.getFullYear() + '').substr(4 - RegExp.$1.length));
       }
       for (var k in date) {
              if (new RegExp("(" + k + ")").test(format)) {
                     format = format.replace(RegExp.$1, RegExp.$1.length == 1
                            ? date[k] : ("00" + date[k]).substr(("" + date[k]).length));
              }
       }
       return format;
  }

    function sync_task(){
        $.ajax({ 
                url: '/scripts/todo_v2.php?act=reload&uid=' + $('#uid').val(),
                method: 'GET',
                success: function(rtn) {
                         }
        });
    }

    function remind_task(action='getone'){
        $.ajax({ 
                url: '/scripts/todo_v2.php?act='+action,
                method: 'GET',
                success: function(rtn) {
                            if (rtn != "") {
                                $(".modal-body").html(rtn);
                                $("#remind_pannel").modal('show');
                            }
                         }
        });
    }

    function update_task(act, id){
      var postdata = {'act':act, 'id':id}
      if (act == "remind") {
          var newDate = new Date();
          newDate.setTime(Date.parse(new Date()) + $('#remind_duetime').val() * 3600 * 1000);
          postdata['dt'] =  newDate.format('yyyy-MM-dd h:m:s');
      }

       $.ajax({ 
                url: '/scripts/todo_v2.php',
                dataType: 'json',
                method: 'POST',
                data: postdata,
                success: function(rtn) {
                            alert("Operation sucess, refresh page soon!");
                            if (rtn.succ == 1) {
                                $("#remind_pannel").modal('hide');
                                $(".modal-body").html('');                        
                            }
                            else {
                                alert('Operated Failed!');
                            }
                         }
        });
  }
  setInterval("remind_task('getappointment')", 180000);
  setInterval("remind_task()", 300000);
  setInterval("sync_task()", 150000);
<?php echo '</script'; ?>
>

<?php }?>
</html>  <?php }
}
