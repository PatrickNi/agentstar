<?php
/* Smarty version 4.3.2, created on 2023-09-10 20:58:08
  from '/data/wwwroot/agentstar.geic.com.au/tpl/login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_64fdbd60918997_76011727',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '82b89ee9f92af7c1e4fe3d25266489846f65e330' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/login.tpl',
      1 => 1247463332,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64fdbd60918997_76011727 (Smarty_Internal_Template $_smarty_tpl) {
?><html>
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=gb2312">
<META HTTP-EQUIV="Content-Language" content="EN">
<title>Agent-Star login page</title>
<link rel="stylesheet" type="text/css" href="../css/sam.css">
</head>
<body>

<table cellSpacing=0 cellPadding=0 width=850 align=center border=0>
    <tr> 
      <td> 
	  	<table cellSpacing=0 cellPadding=0 width="100%" border=0 background="../images/mice_bg.gif">
            <tr valign="middle"> 
 				<TD height="70" align="center"><span class="loginTitle">Migration System</span></TD>
			</tr>
        </table>
	  </td>
    </tr>
	<tr> 
      <td> 
	  	<table cellSpacing=1 cellPadding=0 width="100%" border=0 class="greybg">
            <tr> 
              <td> 
			  	<table cellSpacing=0 cellPadding=0 width="100%" border=0 class="whitebg">
				   <form name="form1" method="post" action="">
				   	<input type="hidden" name="login" value="on">
                    <tr valign="top" align="center"> 
                      <td width="100%" align="center">
					  	<table width="550" border=0 align="center" cellPadding=2 cellSpacing=2>
                              <tr> 
                                <td colspan="2"><img height=18 alt="" src="login_files/sp.gif" width=1 border=0></td>
                              </tr>
                              <tr align=center> 
                                <td colspan="2"><font class="bigwords">User Login</font></td>
                              </tr>
                              <tr> 
                                <td colspan="2" height="20" align="center">
									<font class="highlighttext"><?php echo $_smarty_tpl->tpl_vars['error_msg']->value;?>
</font>
                                </td>
                              </tr>
                              <tr align=center> 
                                <td width="203">Username: &nbsp;&nbsp; </td>
                                <td width="333" align="left">
                                    <INPUT name="tUser" id="username" style="width:150" value="">
                                </td>
                              </tr>
                              <tr align=center> 
                                <td>Password: &nbsp;&nbsp; </td>
                                <td align="left">
                                    <INPUT name="tPswd" type="password" id="password" style="width:150">
                                </td>
                              </tr>
                              <tr> 
                                <td colspan="2"><img height=20 alt="" src="login_files/sp.gif" width=1 border=0></td>
                              </tr>
                              <tr align=center> 
                                <td colspan="2" align="center">
								  <input type="image" src="../images/cm_butt_enter.gif" width=74 border=0 height="23" onClick="GOTO()">
								  <!--<img height="23" src="../images/cm_butt_enter.gif" width=74 border=0  style="cursor:pointer " onClick="GOTO()">-->
								</td>
                              </tr>
                              <tr> 
                                <td colspan="2"><img height=10 alt="" src="login_files/sp.gif" width=1 border=0></td>
                              </tr>
                              <tr valign="middle"> 
                                <td colspan="2">&nbsp;</td>
                              </tr>
                        </table>
					  </td>
                    </tr>
				  </form>
                </table></td>
            </tr>
        </table></td>
    </tr>
    <tr> 
      <td><img height=10 alt="" src="../images/sp.gif" width=1 border=0></td>
    </tr>
    <tr> 
      	<td>
			<table cellSpacing=1 cellPadding=1 width="100%" border=0>
            	<tr> 
              		<td><font class="smalltext">&copy; AgentStar. 2006. All Rights Reserved.</font></td>
              		<td align="right"><font class="smalltext">AgentStar MIGRATION MANGAGEMENT &copy;</font></td>
            	</tr>
        	</table>
		</td>
    </tr>
</table>
</body>
</html>


<?php }
}
