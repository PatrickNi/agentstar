<?php
/* Smarty version 4.3.2, created on 2023-11-22 08:26:07
  from '/data/wwwroot/agentstar.geic.com.au/tpl/report_staff.3.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.2',
  'unifunc' => 'content_655d4a9f954003_58775406',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5fa1f21dbfb3acd2d7ab5f01d56295ca19bb3f01' => 
    array (
      0 => '/data/wwwroot/agentstar.geic.com.au/tpl/report_staff.3.tpl',
      1 => 1687513186,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:style.tpl' => 1,
  ),
),false)) {
function content_655d4a9f954003_58775406 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/data/site/wwwroot/agentstar.geic.com.au/lib/SmartyV4/plugins/modifier.count.php','function'=>'smarty_modifier_count',),));
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">

<?php $_smarty_tpl->_subTemplateRender("file:style.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
 language="javascript" src="../js/audit.js"><?php echo '</script'; ?>
>
<body>
<form name="form1" id="form1" target="_self" method="post">
  <table align="center" width="100%"  class="graybordertable" cellpadding="1" cellspacing="1" border="0">
    <tr class="bordered_2">
      <td align="left"><strong>Start Date</strong>&nbsp;&nbsp;
        <input type="text" id="t_fdate" name="t_fdate"  value="<?php echo $_smarty_tpl->tpl_vars['fromDay']->value;?>
" autocomplete="off" >

        &nbsp;&nbsp;&nbsp;&nbsp; <strong>Finish Date</strong>&nbsp;&nbsp;
        <input type="text" id="t_tdate" name="t_tdate"  value="<?php echo $_smarty_tpl->tpl_vars['toDay']->value;?>
" autocomplete="off" >

        &nbsp;&nbsp;&nbsp;&nbsp; <strong>Staff:</strong>&nbsp;&nbsp;
        <select name="t_staff" id='t_staff' onChange="show_startdate();this.form.bt_name.focus();">
          
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
                <?php if ($_smarty_tpl->tpl_vars['ugs']->value['rpt_staff']['v'] == 1) {?>
                    
          <option value="all" <?php if ($_smarty_tpl->tpl_vars['staffid']->value == 'all') {?> selected <?php }?>>All Staff</option>
          
                <?php }?>
            
        </select>
        <strong id="user_startdate" style="color:red" ></strong>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <?php if ($_smarty_tpl->tpl_vars['uid']->value == 3) {?> 
            <select name="t_about">
                <option value="" selected>Choose where about us</option>
                <option value="Others" <?php if ($_smarty_tpl->tpl_vars['query_about']->value == "Others") {?> selected <?php }?>>Others</option>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['clientfroms']->value, 'name');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" <?php if ($_smarty_tpl->tpl_vars['query_about']->value == $_smarty_tpl->tpl_vars['name']->value) {?> selected <?php }?>><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</option>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </select>  
        <?php }?>
      </td>
    </tr>
    <tr class="bordered_2" align="center">
      <td align="left" colspan="2"> Report Type:&nbsp;
        <select name="rp_type" onChange="this.form.bt_name.focus();">
          <option value="d" <?php if ($_smarty_tpl->tpl_vars['isAll']->value == 'd') {?> selected <?php }?>>Detail</option>
          <option value="s" <?php if ($_smarty_tpl->tpl_vars['isAll']->value == 's') {?> selected <?php }?>>Summary</option>
        </select>
        &nbsp;&nbsp;&nbsp;
        <input type="submit" name="bt_name" value="create report" style="font-weight:bold ">
        &nbsp;&nbsp;&nbsp;&nbsp;
        <!--<input type="button" style="font-weight:bold" onclick="printPage();"value="Print">
        <input type="button" style="font-weight:bold" value="Print" onClick="document.all.WebBrowser.ExecWB(6,1)">
        <input type="button"style="font-weight:bold" value="Print Setting" onClick="document.all.WebBrowser.ExecWB(8,1)">
        <input type="button" style="font-weight:bold" value="Print Review" onClick="document.all.WebBrowser.ExecWB(7,1)">
        -->
        <?php if ($_smarty_tpl->tpl_vars['uid']->value == 50 && $_smarty_tpl->tpl_vars['staffid']->value == 87) {?>
          &nbsp;&nbsp;
          <input type="hidden" id="token" name="token" value="">
          <input type="hidden" id="bt_locked" name="bt_locked" value="">
          <button type="button" id="btn_save" style="font-weight:bolder;font-size:larger" onclick="do_save()">Locked Period</button>
        <?php }?>
      </td>
    </tr>
  </table>
  <p>
        <?php if ($_smarty_tpl->tpl_vars['from_archive']->value) {?>
          <strong style="color:red;">Reporting data from Archive</strong>
        <?php } else { ?>
          <?php if ($_smarty_tpl->tpl_vars['uid']->value == 3) {?>
          <input type="hidden" id="bt_archive" name="bt_archive" value="">
          <button type="button" onClick="archive_confirm()" style="font-weight:bold;">Archive report</button>
          <?php }?>
        <?php }?>
  </p>
</form>
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="left">
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['weeks']->value, 'daterange', false, 'week');
$_smarty_tpl->tpl_vars['daterange']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['week']->value => $_smarty_tpl->tpl_vars['daterange']->value) {
$_smarty_tpl->tpl_vars['daterange']->do_else = false;
?>
  <tr>
    <td  class="highlighttext" colspan="8" style="text-decoration: underline;background-color: palegreen;"><?php echo $_smarty_tpl->tpl_vars['daterange']->value;?>
</td>
  </tr>
  <tr class="greybg">
    <td colspan="8" class="highyellow">Apply School</td>
  </tr>
  <tr align="center" class="totalrowodd" >
    <td>Course clients</td>
    <td>Apply Offer</td>
    <td>Received Offer</td>
    <td>Received COE</td>
    <td colspan="2">Potential Comm</td>  
    <td colspan="2">Received Comm</td>
  </tr>

  <tr align="right" class="roweven" >
    <td>
        <span onClick="openinSatff('d1_all_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;">
        <?php echo $_smarty_tpl->tpl_vars['courses']->value[$_smarty_tpl->tpl_vars['week']->value]['cnt'];?>
 
        </span>
        <br/>
        <span onClick="openinSatff('d1_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;">
        (New clients: <?php echo $_smarty_tpl->tpl_vars['courses']->value[$_smarty_tpl->tpl_vars['week']->value]['cnt_new'];?>
)
        </span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:300px" id="d1_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
        <ul>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['courses']->value[$_smarty_tpl->tpl_vars['week']->value]['name_new'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
          <li><span style="text-decoration:underline; cursor:pointer; <?php if ($_smarty_tpl->tpl_vars['courses']->value[$_smarty_tpl->tpl_vars['week']->value]['apo'][$_smarty_tpl->tpl_vars['id']->value] == 0) {?>color:#0000FF<?php } elseif ($_smarty_tpl->tpl_vars['courses']->value[$_smarty_tpl->tpl_vars['week']->value]['num'][$_smarty_tpl->tpl_vars['id']->value] == $_smarty_tpl->tpl_vars['courses']->value[$_smarty_tpl->tpl_vars['week']->value]['refuse'][$_smarty_tpl->tpl_vars['id']->value]) {?>color:#999999;<?php }?>" onClick="window.open('client_course.php?cid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <span style="font-size:16px; font-weight:bolder; cursor:pointer;" onClick="d1_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
.style.display='none'">&times;</span> 
      </div>

      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:300px" id="d1_all_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
        <ul>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['courses']->value[$_smarty_tpl->tpl_vars['week']->value]['name'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
          <li><span style="text-decoration:underline; cursor:pointer; <?php if ($_smarty_tpl->tpl_vars['courses']->value[$_smarty_tpl->tpl_vars['week']->value]['apo'][$_smarty_tpl->tpl_vars['id']->value] == 0) {?>color:#0000FF<?php } elseif ($_smarty_tpl->tpl_vars['courses']->value[$_smarty_tpl->tpl_vars['week']->value]['num'][$_smarty_tpl->tpl_vars['id']->value] == $_smarty_tpl->tpl_vars['courses']->value[$_smarty_tpl->tpl_vars['week']->value]['refuse'][$_smarty_tpl->tpl_vars['id']->value]) {?>color:#999999;<?php }?>" onClick="window.open('client_course.php?cid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <span style="font-size:16px; font-weight:bolder; cursor:pointer;" onClick="d1_all_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
.style.display='none'">&times;</span> 
      </div>


    </td>
    <td>
          <?php $_smarty_tpl->_assignInScope('cateidx', "0");?>
          <?php echo $_smarty_tpl->tpl_vars['courseprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['apocnt'];?>

          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['courseprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['apocnt_st'], 'catenum', false, 'catename');
$_smarty_tpl->tpl_vars['catenum']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['catename']->value => $_smarty_tpl->tpl_vars['catenum']->value) {
$_smarty_tpl->tpl_vars['catenum']->do_else = false;
?>
              <?php $_smarty_tpl->_assignInScope('cateidx', $_smarty_tpl->tpl_vars['cateidx']->value+1);?>
              <br/><span onClick="openinSatff('d2_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['cateidx']->value;?>
');"  style="text-decoration:underline; cursor:pointer;">(<?php echo $_smarty_tpl->tpl_vars['catenum']->value;?>
) <?php echo $_smarty_tpl->tpl_vars['catename']->value;?>
</span> 
          
              <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:500px" id="d2_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['cateidx']->value;?>
">
                <ul>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['courseprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['aponame'][$_smarty_tpl->tpl_vars['catename']->value], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
                  <li><span style="text-decoration:underline; cursor:pointer; <?php if ($_smarty_tpl->tpl_vars['courseprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['reo'][$_smarty_tpl->tpl_vars['catename']->value][$_smarty_tpl->tpl_vars['id']->value] == 0) {?>color:#0000FF<?php } elseif ($_smarty_tpl->tpl_vars['courseprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['reo_st'][$_smarty_tpl->tpl_vars['catename']->value][$_smarty_tpl->tpl_vars['id']->value] == -1) {?>color:#999999;<?php }?>" onClick="window.open('client_course_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['courseprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['apocid'][$_smarty_tpl->tpl_vars['catename']->value][$_smarty_tpl->tpl_vars['id']->value];?>
&courseid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </ul>
                <span style="font-weight:bolder; cursor:pointer;" onClick="d2_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['cateidx']->value;?>
.style.display='none'">&times;</span> 
              </div>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </td>  

     <td >
           <?php $_smarty_tpl->_assignInScope('cateidx', "0");?>
           <?php echo $_smarty_tpl->tpl_vars['courseprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['reocnt'];?>

           <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['courseprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['reocnt_st'], 'catenum', false, 'catename');
$_smarty_tpl->tpl_vars['catenum']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['catename']->value => $_smarty_tpl->tpl_vars['catenum']->value) {
$_smarty_tpl->tpl_vars['catenum']->do_else = false;
?>
              <?php $_smarty_tpl->_assignInScope('cateidx', $_smarty_tpl->tpl_vars['cateidx']->value+1);?>
              <br/><span onClick="openinSatff('d3_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['cateidx']->value;?>
');"  style="text-decoration:underline; cursor:pointer;">(<?php echo $_smarty_tpl->tpl_vars['catenum']->value;?>
) <?php echo $_smarty_tpl->tpl_vars['catename']->value;?>
</span>

              <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:500px" id="d3_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['cateidx']->value;?>
">
              <ul>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['courseprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['reoname'][$_smarty_tpl->tpl_vars['catename']->value], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
                <li><span style="text-decoration:underline; cursor:pointer; <?php if ($_smarty_tpl->tpl_vars['courseprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['reo_st'][$_smarty_tpl->tpl_vars['catename']->value][$_smarty_tpl->tpl_vars['id']->value] == 0) {?>color:#0000FF<?php } elseif ($_smarty_tpl->tpl_vars['courseprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['reo_st'][$_smarty_tpl->tpl_vars['catename']->value][$_smarty_tpl->tpl_vars['id']->value] == -1) {?>color:#999999;<?php }?>" onClick="window.open('client_course_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['courseprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['reocid'][$_smarty_tpl->tpl_vars['catename']->value][$_smarty_tpl->tpl_vars['id']->value];?>
&courseid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span>
                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </ul>
              <span style="font-weight:bolder; cursor:pointer;" onClick="d3_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['cateidx']->value;?>
.style.display='none'">&times;</span> 
            </div>
           <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
      </td>   

    <td>
        <?php $_smarty_tpl->_assignInScope('cateidx', "0");?>
        <?php echo $_smarty_tpl->tpl_vars['courseprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['reccnt'];?>

        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['courseprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['reccnt_st'], 'catenum', false, 'catename');
$_smarty_tpl->tpl_vars['catenum']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['catename']->value => $_smarty_tpl->tpl_vars['catenum']->value) {
$_smarty_tpl->tpl_vars['catenum']->do_else = false;
?>
             <?php $_smarty_tpl->_assignInScope('cateidx', $_smarty_tpl->tpl_vars['cateidx']->value+1);?>
            <br/><span onClick="openinSatff('d4_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['cateidx']->value;?>
');"  style="text-decoration:underline; cursor:pointer;">(<?php echo $_smarty_tpl->tpl_vars['catenum']->value;?>
) <?php echo $_smarty_tpl->tpl_vars['catename']->value;?>
</span>
            <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:500px" id="d4_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['cateidx']->value;?>
">
            <ul>
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['courseprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['recname'][$_smarty_tpl->tpl_vars['catename']->value], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
              <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_course_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['courseprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['reccid'][$_smarty_tpl->tpl_vars['catename']->value][$_smarty_tpl->tpl_vars['id']->value];?>
&courseid=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </ul>
            <span style="font-weight:bolder; cursor:pointer;" onClick="d4_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['cateidx']->value;?>
.style.display='none'">&times;</span> </div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </td>  

    <td  colspan="2">
      <?php if ($_smarty_tpl->tpl_vars['ugs']->value['rpt_staff_pc']['v'] == 1) {?>
      <span onClick="openinSatff('d5_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="cursor:pointer;">
        <?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['coursepots']->value[$_smarty_tpl->tpl_vars['week']->value]['rcomm']);?>
<br/>
        <?php echo $_smarty_tpl->tpl_vars['coursepots']->value[$_smarty_tpl->tpl_vars['week']->value]['rcomm_st'];?>
 old students 
        <br/>&nbsp;&nbsp;<span style="text-decoration:underline; ">(inc <?php echo $_smarty_tpl->tpl_vars['coursepots']->value[$_smarty_tpl->tpl_vars['week']->value]['rcomm_aid'];?>
 subagents)</span><br/>  
        <?php echo $_smarty_tpl->tpl_vars['coursepots']->value[$_smarty_tpl->tpl_vars['week']->value]['rcomm_new'];?>
 new clients 
        <br/>&nbsp;&nbsp;<span style="text-decoration:underline; ">(inc <?php echo $_smarty_tpl->tpl_vars['coursepots']->value[$_smarty_tpl->tpl_vars['week']->value]['rcomm_new_aid'];?>
 subagents)</span>
      </span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:180px" id="d5_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
        <table width="100%">
        <tr><td>Name</td><td  align="right">Comm($)</td></tr>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['coursepots']->value[$_smarty_tpl->tpl_vars['week']->value]['name'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
          <tr><td align="center"><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_course_sem.php?cid=<?php echo $_smarty_tpl->tpl_vars['coursepots']->value[$_smarty_tpl->tpl_vars['week']->value]['client'][$_smarty_tpl->tpl_vars['id']->value];?>
&courseid=<?php echo $_smarty_tpl->tpl_vars['coursepots']->value[$_smarty_tpl->tpl_vars['week']->value]['course'][$_smarty_tpl->tpl_vars['id']->value];?>
&semid=<?php echo $_smarty_tpl->tpl_vars['coursepots']->value[$_smarty_tpl->tpl_vars['week']->value]['sem'][$_smarty_tpl->tpl_vars['id']->value];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span></td><td align="right" <?php if ($_smarty_tpl->tpl_vars['coursepots']->value[$_smarty_tpl->tpl_vars['week']->value]['commfail'][$_smarty_tpl->tpl_vars['id']->value] == 1) {?>style="color:#0000CC"<?php }?>><?php echo $_smarty_tpl->tpl_vars['coursepots']->value[$_smarty_tpl->tpl_vars['week']->value]['comm'][$_smarty_tpl->tpl_vars['id']->value];?>
</td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </table>

        <span style="font-weight:bolder; cursor:pointer;" onClick="d5_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
.style.display='none'">&times;</span> 
      </div>
      <?php }?>
    </td>                   
     <td  colspan="2">
       <?php if ($_smarty_tpl->tpl_vars['ugs']->value['rpt_staff_rc']['v'] == 1) {?>
       <span onClick="openinSatff('d11_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="cursor:pointer;">
        <?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['coursesems']->value[$_smarty_tpl->tpl_vars['week']->value]['bonus']);?>
<br/>
        <?php echo $_smarty_tpl->tpl_vars['coursesems']->value[$_smarty_tpl->tpl_vars['week']->value]['bonus_st'];?>
 old students 
        <br/>&nbsp;&nbsp;<span style="text-decoration:underline; ">(inc <?php echo $_smarty_tpl->tpl_vars['coursesems']->value[$_smarty_tpl->tpl_vars['week']->value]['bonus_aid'];?>
 subagents)</span><br/> 
        <?php echo $_smarty_tpl->tpl_vars['coursesems']->value[$_smarty_tpl->tpl_vars['week']->value]['bonus_new'];?>
 new clients 
        <br/>&nbsp;&nbsp;<span style="text-decoration:underline; ">(inc <?php echo $_smarty_tpl->tpl_vars['coursesems']->value[$_smarty_tpl->tpl_vars['week']->value]['bonus_new_aid'];?>
 subagents) </span>
      </span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:180px" id="d11_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
        <table width="100%">
        <tr><td>Name</td><td align="right">Comm($)</td></tr>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['coursesems']->value[$_smarty_tpl->tpl_vars['week']->value]['bonusname'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
          <tr><td align="center"><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_course_sem.php?cid=<?php echo $_smarty_tpl->tpl_vars['coursesems']->value[$_smarty_tpl->tpl_vars['week']->value]['client'][$_smarty_tpl->tpl_vars['id']->value];?>
&courseid=<?php echo $_smarty_tpl->tpl_vars['coursesems']->value[$_smarty_tpl->tpl_vars['week']->value]['course'][$_smarty_tpl->tpl_vars['id']->value];?>
&semid=<?php echo $_smarty_tpl->tpl_vars['coursesems']->value[$_smarty_tpl->tpl_vars['week']->value]['sem'][$_smarty_tpl->tpl_vars['id']->value];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span></td><td align="right" <?php if ($_smarty_tpl->tpl_vars['coursesems']->value[$_smarty_tpl->tpl_vars['week']->value]['bonusfail'][$_smarty_tpl->tpl_vars['id']->value] == 1) {?>style="color:#0000CC"<?php }?>><?php echo $_smarty_tpl->tpl_vars['coursesems']->value[$_smarty_tpl->tpl_vars['week']->value]['bonuscomm'][$_smarty_tpl->tpl_vars['id']->value];?>
</td></tr><?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </table>

        <span style="font-weight:bolder; cursor:pointer;" onClick="d11_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
.style.display='none'">&times;</span>  
        </div>
        <?php }?>
      </td>    
  </tr>

  <tr class="greybg">
    <td colspan="8" class="highyellow">Visa Service</td>
  </tr> 
  <tr align="center" class="totalrowodd">
    <td>Visa Consultant </td>
    <td>Consultant Fee</td>
    <td>Agreement Signed</td>
    <td>Agreement staff visa grant</td>
    <td>(Net received/Net deduction)<br/>Net profit</td>
    <td>Apply Visa </td>
    <td>Finalized Cases (Free) </td>
    <td>Finalized Cases (Paid) </td>
  </tr>

  <tr align="right" class="roweven" >
    <td><span onClick="openinSatff('d6_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;"><?php echo $_smarty_tpl->tpl_vars['visavisits']->value[$_smarty_tpl->tpl_vars['week']->value]['pcnt'];?>
</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:400px" id="d6_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
        <ul>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visavisits']->value[$_smarty_tpl->tpl_vars['week']->value]['pname'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
          <li><span style="text-decoration:underline; cursor:pointer; <?php if ($_smarty_tpl->tpl_vars['visavisits']->value[$_smarty_tpl->tpl_vars['week']->value]['decline'][$_smarty_tpl->tpl_vars['id']->value] > 0) {?>color:#999999;<?php } elseif ($_smarty_tpl->tpl_vars['visavisits']->value[$_smarty_tpl->tpl_vars['week']->value]['sign'][$_smarty_tpl->tpl_vars['id']->value] == 0) {?>color:#0000FF;<?php }?>" onClick="window.open('client_visa_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['visavisits']->value[$_smarty_tpl->tpl_vars['week']->value]['client'][$_smarty_tpl->tpl_vars['id']->value];?>
&vid=<?php echo $_smarty_tpl->tpl_vars['visavisits']->value[$_smarty_tpl->tpl_vars['week']->value]['visa'][$_smarty_tpl->tpl_vars['id']->value];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>

        <span style="font-weight:bolder; cursor:pointer;" onClick="d6_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
.style.display='none'">&times;</span> </div>
    </td>
     
    <td><span onClick="openinSatff('d66_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;"><?php echo $_smarty_tpl->tpl_vars['visavisits']->value[$_smarty_tpl->tpl_vars['week']->value]['totalcfee'];?>
</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:400px" id="d66_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
        <ul>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visavisits']->value[$_smarty_tpl->tpl_vars['week']->value]['pname'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
           <?php if ($_smarty_tpl->tpl_vars['visavisits']->value[$_smarty_tpl->tpl_vars['week']->value]['cfee'][$_smarty_tpl->tpl_vars['id']->value] > 0) {?>
            <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['visavisits']->value[$_smarty_tpl->tpl_vars['week']->value]['client'][$_smarty_tpl->tpl_vars['id']->value];?>
&vid=<?php echo $_smarty_tpl->tpl_vars['visavisits']->value[$_smarty_tpl->tpl_vars['week']->value]['visa'][$_smarty_tpl->tpl_vars['id']->value];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
 </span></li>
            <?php }?>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d66_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
.style.display='none'">&times;</span> </div>
    </td> 

    <td><span onClick="openinSatff('d7_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;"><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['visaagrees']->value[$_smarty_tpl->tpl_vars['week']->value]['fee']);?>
&nbsp;($0:<?php echo $_smarty_tpl->tpl_vars['visaagrees']->value[$_smarty_tpl->tpl_vars['week']->value]['sign0'];?>
/paid:<?php echo $_smarty_tpl->tpl_vars['visaagrees']->value[$_smarty_tpl->tpl_vars['week']->value]['sign1'];?>
)</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="d7_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
        <ul>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visaagrees']->value[$_smarty_tpl->tpl_vars['week']->value]['fname'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
          <li><span style="text-decoration:underline; cursor:pointer; <?php if ($_smarty_tpl->tpl_vars['visaagrees']->value[$_smarty_tpl->tpl_vars['week']->value]['done'][$_smarty_tpl->tpl_vars['id']->value] == 1) {?>color:gray;<?php } elseif ($_smarty_tpl->tpl_vars['visaagrees']->value[$_smarty_tpl->tpl_vars['week']->value]['done'][$_smarty_tpl->tpl_vars['id']->value] == 2) {?>color:blue;<?php }?>" onClick="window.open('client_visa_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['visaagrees']->value[$_smarty_tpl->tpl_vars['week']->value]['client'][$_smarty_tpl->tpl_vars['id']->value];?>
&vid=<?php echo $_smarty_tpl->tpl_vars['visaagrees']->value[$_smarty_tpl->tpl_vars['week']->value]['visa'][$_smarty_tpl->tpl_vars['id']->value];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d7_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
.style.display='none'">&times;</span> </div> 
    </td>

    <td>
      <?php if ($_smarty_tpl->tpl_vars['visagrants']->value[$_smarty_tpl->tpl_vars['week']->value]['gc_free'] > 0) {?>
        <span onClick="openinSatff('d8g_free_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $_smarty_tpl->tpl_vars['visagrants']->value[$_smarty_tpl->tpl_vars['week']->value]['gc_free'];?>
)</span>&nbsp;
      <?php }?>
      Student:&nbsp;$<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['visagrants']->value[$_smarty_tpl->tpl_vars['week']->value]['gfee_free']);?>
<br/>
      <?php if ($_smarty_tpl->tpl_vars['visagrants']->value[$_smarty_tpl->tpl_vars['week']->value]['gc_paid'] > 0) {?>
        <span onClick="openinSatff('d8g_paid_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $_smarty_tpl->tpl_vars['visagrants']->value[$_smarty_tpl->tpl_vars['week']->value]['gc_paid'];?>
)</span>&nbsp;
      <?php }?>
      Other:&nbsp;$<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['visagrants']->value[$_smarty_tpl->tpl_vars['week']->value]['gfee_paid']);?>
<br/>
      <hr/>
      <?php if ($_smarty_tpl->tpl_vars['visagrants']->value[$_smarty_tpl->tpl_vars['week']->value]['gcnt1'] > 0) {?>
        (<?php echo $_smarty_tpl->tpl_vars['visagrants']->value[$_smarty_tpl->tpl_vars['week']->value]['gcnt1'];?>
)&nbsp;
      <?php }?>
      Total:&nbsp;$<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['visagrants']->value[$_smarty_tpl->tpl_vars['week']->value]['gfee']);?>
<br/>
      
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="d8g_free_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
        <ul>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visagrants']->value[$_smarty_tpl->tpl_vars['week']->value]['gname_free'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['visagrants']->value[$_smarty_tpl->tpl_vars['week']->value]['gc'][$_smarty_tpl->tpl_vars['id']->value];?>
&vid=<?php echo $_smarty_tpl->tpl_vars['visagrants']->value[$_smarty_tpl->tpl_vars['week']->value]['gv'][$_smarty_tpl->tpl_vars['id']->value];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d8g_free_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
.style.display='none'">&times;</span> </div>

      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="d8g_paid_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
        <ul>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visagrants']->value[$_smarty_tpl->tpl_vars['week']->value]['gname_paid'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['visagrants']->value[$_smarty_tpl->tpl_vars['week']->value]['gc'][$_smarty_tpl->tpl_vars['id']->value];?>
&vid=<?php echo $_smarty_tpl->tpl_vars['visagrants']->value[$_smarty_tpl->tpl_vars['week']->value]['gv'][$_smarty_tpl->tpl_vars['id']->value];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d8g_paid_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
.style.display='none'">&times;</span> </div>
    </td> 

    
    <td>
          $<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['visapaids']->value[$_smarty_tpl->tpl_vars['week']->value]['paid']);?>
 <?php if ($_smarty_tpl->tpl_vars['visapaids']->value[$_smarty_tpl->tpl_vars['week']->value]['spand'] > 0) {?>&nbsp;/ -$<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['visapaids']->value[$_smarty_tpl->tpl_vars['week']->value]['spand']);
}?><br/>
          <hr/>
          Total: <span onClick="openinSatff('d71_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;">$<?php echo $_smarty_tpl->tpl_vars['visapaids']->value[$_smarty_tpl->tpl_vars['week']->value]['paid']-sprintf("%.2f",$_smarty_tpl->tpl_vars['visapaids']->value[$_smarty_tpl->tpl_vars['week']->value]['spand']);?>
</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="d71_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
        <ul>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visapaids']->value[$_smarty_tpl->tpl_vars['week']->value]['show'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['visapaids']->value[$_smarty_tpl->tpl_vars['week']->value]['client'][$_smarty_tpl->tpl_vars['id']->value];?>
&vid=<?php echo $_smarty_tpl->tpl_vars['visapaids']->value[$_smarty_tpl->tpl_vars['week']->value]['vid'][$_smarty_tpl->tpl_vars['id']->value];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d71_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
.style.display='none'">&times;</span> </div></td>
      </td>

    <td>
      <?php if ($_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['lc_free'] > 0) {?>
        <span onClick="openinSatff('d8_free_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['lc_free'];?>
)</span>&nbsp;
      <?php }?>
      Student:&nbsp;$<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['lfee_free']);?>
<br/>
      <?php if ($_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['lc_paid'] > 0) {?>
        <span onClick="openinSatff('d8_paid_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['lc_paid'];?>
)</span>&nbsp;
      <?php }?>
      Other:&nbsp;$<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['lfee_paid']);?>
<br/>
      <hr/>
      <!--
      <span onClick="openinSatff('d8_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;">[<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['lcnt0'];?>
/<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['lcnt1'];?>
]
      </span>&nbsp;&nbsp;
      -->
      <?php if ($_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['lcnt1'] > 0) {?>
        (<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['lcnt1'];?>
)&nbsp;
      <?php }?>
      Total:&nbsp;$<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['lfee']);?>
<br/>
      
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="d8_free_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
        <ul>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['lname_free'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['lc'][$_smarty_tpl->tpl_vars['id']->value];?>
&vid=<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['lv'][$_smarty_tpl->tpl_vars['id']->value];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d8_free_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
.style.display='none'">&times;</span> </div>

      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="d8_paid_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
        <ul>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['lname_paid'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['lc'][$_smarty_tpl->tpl_vars['id']->value];?>
&vid=<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['lv'][$_smarty_tpl->tpl_vars['id']->value];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d8_paid_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
.style.display='none'">&times;</span> </div>
    </td>  
  
 
    <!--Fee Section-->
    <td>
      <?php if ($_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['gc_free'] > 0) {?>
        <span onClick="openinSatff('gc_free_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['gc_free'];?>
)</span>&nbsp;
      <?php }?>
        granted, &nbsp;$<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['gfee_free']);?>
 <br/>

      <?php if ($_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['wc_free'] > 0) {?>
        <span onClick="openinSatff('wc_free_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['wc_free'];?>
)</span>&nbsp;
      <?php }?>
        withdraw, &nbsp;$<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['wfee_free']);?>
 <br/>   

       <?php if ($_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['rc_free'] > 0) {?>
        <span onClick="openinSatff('rc_free_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['rc_free'];?>
)</span>&nbsp;
      <?php }?>
        refused, &nbsp;$<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['rfee_free']);?>
 <br/>      

       <?php if ($_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['cc_free'] > 0) {?>
        <span onClick="openinSatff('cc_free_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['cc_free'];?>
)</span>&nbsp;
      <?php }?>
        client cancel agreement, &nbsp;$<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['cfee_free']);?>
 <br/>           

       <?php if ($_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['sc_free'] > 0) {?>
        <span onClick="openinSatff('sc_free_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['sc_free'];?>
)</span>&nbsp;
      <?php }?>
        stop agent, &nbsp;$<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['sfee_free']);?>
 <br/>                      
      
      <hr/>
      <?php if (($_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['gc_free']+$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['wc_free']+$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['rc_free']+$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['cc_free']+$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['sc_free']) > 0) {?>
      (<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['gc_free']+$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['wc_free']+$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['rc_free']+$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['cc_free']+$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['sc_free'];?>
)&nbsp;
      <?php }?>
      Total: &nbsp;$<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['gfee_free']+$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['wfee_free']+$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['rfee_free']+$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['cfee_free']+sprintf("%.2f",$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['sfee_free']);?>
   
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="gc_free_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
        <ul>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['gname_free'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['gc'][$_smarty_tpl->tpl_vars['id']->value];?>
&vid=<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['gv'][$_smarty_tpl->tpl_vars['id']->value];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="gc_free_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
.style.display='none'">&times;</span> </div>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="wc_free_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
        <ul>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['wname_free'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['wc'][$_smarty_tpl->tpl_vars['id']->value];?>
&vid=<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['wv'][$_smarty_tpl->tpl_vars['id']->value];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="wc_free_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
.style.display='none'">&times;</span> </div>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="rc_free_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
        <ul>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['rname_free'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['rc'][$_smarty_tpl->tpl_vars['id']->value];?>
&vid=<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['rv'][$_smarty_tpl->tpl_vars['id']->value];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="rc_free_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
.style.display='none'">&times;</span> </div>  
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="cc_free_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
        <ul>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['cname_free'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['cc'][$_smarty_tpl->tpl_vars['id']->value];?>
&vid=<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['cv'][$_smarty_tpl->tpl_vars['id']->value];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="cc_free_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
.style.display='none'">&times;</span> </div>   
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="sc_free_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
        <ul>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['sname_free'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['sc'][$_smarty_tpl->tpl_vars['id']->value];?>
&vid=<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['sv'][$_smarty_tpl->tpl_vars['id']->value];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="sc_free_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
.style.display='none'">&times;</span> </div>                   
    </td>


    <!--Paid Section-->
    <td>
      <?php if ($_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['gc_paid'] > 0) {?>
        <span onClick="openinSatff('gc_paid_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['gc_paid'];?>
)</span>&nbsp;
      <?php }?>
        granted, &nbsp;$<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['gfee_paid']);?>
 <br/>

      <?php if ($_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['wc_paid'] > 0) {?>
        <span onClick="openinSatff('wc_paid_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['wc_paid'];?>
)</span>&nbsp;
      <?php }?>
        withdraw, &nbsp;$<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['wfee_paid']);?>
 <br/>   

       <?php if ($_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['rc_paid'] > 0) {?>
        <span onClick="openinSatff('rc_paid_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['rc_paid'];?>
)</span>&nbsp;
      <?php }?>
        refused, &nbsp;$<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['rfee_paid']);?>
 <br/>      

       <?php if ($_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['cc_paid'] > 0) {?>
        <span onClick="openinSatff('cc_paid_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['cc_paid'];?>
)</span>&nbsp;
      <?php }?>
        client cancel agreement, &nbsp;$<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['cfee_paid']);?>
 <br/>           

       <?php if ($_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['sc_paid'] > 0) {?>
        <span onClick="openinSatff('dc_paid_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['sc_paid'];?>
)</span>&nbsp;
      <?php }?>
        stop agent, &nbsp;$<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['sfee_paid']);?>
 <br/>                      
      
      <hr/>
      <?php if (($_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['gc_paid']+$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['wc_paid']+$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['rc_paid']+$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['cc_paid']+$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['sc_paid']) > 0) {?>
      (<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['gc_paid']+$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['wc_paid']+$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['rc_paid']+$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['cc_paid']+$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['sc_paid'];?>
)&nbsp;
      <?php }?>
      Total: &nbsp;$<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['gfee_paid']+$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['wfee_paid']+$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['rfee_paid']+$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['cfee_paid']+sprintf("%.2f",$_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['sfee_paid']);?>
 

      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="gc_paid_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
        <ul>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['gname_paid'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['gc'][$_smarty_tpl->tpl_vars['id']->value];?>
&vid=<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['gv'][$_smarty_tpl->tpl_vars['id']->value];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="gc_paid_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
.style.display='none'">&times;</span> </div>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="wc_paid_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
        <ul>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['wname_paid'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['wc'][$_smarty_tpl->tpl_vars['id']->value];?>
&vid=<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['wv'][$_smarty_tpl->tpl_vars['id']->value];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="wc_paid_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
.style.display='none'">&times;</span> </div>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="rc_paid_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
        <ul>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['rname_paid'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['rc'][$_smarty_tpl->tpl_vars['id']->value];?>
&vid=<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['rv'][$_smarty_tpl->tpl_vars['id']->value];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="rc_paid_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
.style.display='none'">&times;</span> </div>  
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="cc_paid_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
        <ul>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['cname_paid'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['cc'][$_smarty_tpl->tpl_vars['id']->value];?>
&vid=<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['cv'][$_smarty_tpl->tpl_vars['id']->value];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="cc_paid_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
.style.display='none'">&times;</span> </div>   
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="sc_paid_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
        <ul>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['sname_paid'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['sc'][$_smarty_tpl->tpl_vars['id']->value];?>
&vid=<?php echo $_smarty_tpl->tpl_vars['visaprocs']->value[$_smarty_tpl->tpl_vars['week']->value]['sv'][$_smarty_tpl->tpl_vars['id']->value];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="sc_paid_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
.style.display='none'">&times;</span> </div> 

    </td>

  <tr align="center" class="totalrowodd">
    <td>Reviewer </td>
    <td colspan="7"></td>
  </tr>

  <tr align="right" class="roweven" >
    <td>
          <span onClick="openinSatff('d99_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;">
            (<?php echo $_smarty_tpl->tpl_vars['visareviews']->value[$_smarty_tpl->tpl_vars['week']->value]['cnt'];?>
)
          </span>
          <?php if ($_smarty_tpl->tpl_vars['staffid']->value != 105) {?>
          $ <?php echo $_smarty_tpl->tpl_vars['visareviews']->value[$_smarty_tpl->tpl_vars['week']->value]['total_profit'];?>

          <?php }?>
          <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="d99_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
            <ul>
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visareviews']->value[$_smarty_tpl->tpl_vars['week']->value]['pname'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
              <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['visareviews']->value[$_smarty_tpl->tpl_vars['week']->value]['client'][$_smarty_tpl->tpl_vars['id']->value];?>
&vid=<?php echo $_smarty_tpl->tpl_vars['visareviews']->value[$_smarty_tpl->tpl_vars['week']->value]['visa'][$_smarty_tpl->tpl_vars['id']->value];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span></li> 
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </ul>
            <span style="font-weight:bolder; cursor:pointer;" onClick="d99_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
.style.display='none'">&times;</span> 
          </div>


          <hr>
          expt.paperwork:
          <span onClick="openinSatff('d991_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $_smarty_tpl->tpl_vars['visareviews']->value[$_smarty_tpl->tpl_vars['week']->value]['cnt_notpaperwork'];?>
)</span>
          <?php if ($_smarty_tpl->tpl_vars['staffid']->value != 105) {?>
            $ <?php echo $_smarty_tpl->tpl_vars['visareviews']->value[$_smarty_tpl->tpl_vars['week']->value]['total_profit_notpaperwork'];?>

          <?php }?>
          <?php if ($_smarty_tpl->tpl_vars['staffid']->value != 105) {?>
            <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="d991_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
              <ul>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['visareviews']->value[$_smarty_tpl->tpl_vars['week']->value]['pname'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
                  <?php if ($_smarty_tpl->tpl_vars['visareviews']->value[$_smarty_tpl->tpl_vars['week']->value]['notpaperwork'][$_smarty_tpl->tpl_vars['id']->value] == 1) {?>
                    <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['visareviews']->value[$_smarty_tpl->tpl_vars['week']->value]['client'][$_smarty_tpl->tpl_vars['id']->value];?>
&vid=<?php echo $_smarty_tpl->tpl_vars['visareviews']->value[$_smarty_tpl->tpl_vars['week']->value]['visa'][$_smarty_tpl->tpl_vars['id']->value];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span> 
                  <?php }?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </ul>
              <span style="font-weight:bolder; cursor:pointer;" onClick="d991_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
.style.display='none'">&times;</span> 
            </div>  
          <?php }?>
    </td>
    <td colspan="7"></td>
  </tr>
  
  </tr>
    <tr class="greybg">
    <td colspan="8"class="highyellow">Coach Services</td>
  </tr>   
  <tr align="center" class="totalrowodd">
    <td>Course Item</td>
    <td>hours delivered<br/>(Fee Remaining/Delivered)</td>
    <td>Students(active / current)</td>
    <td>Lessons (net hours)</td>
    <td><?php if ($_smarty_tpl->tpl_vars['user_pos']->value == 'PC' || $_smarty_tpl->tpl_vars['user_pos']->value == 'C' || $_smarty_tpl->tpl_vars['user_pos']->value == 'M') {?>Received Coaching Fee<?php }?></td>
    <td><?php if ($_smarty_tpl->tpl_vars['user_pos']->value == 'PC' || $_smarty_tpl->tpl_vars['user_pos']->value == 'C' || $_smarty_tpl->tpl_vars['user_pos']->value == 'M') {?>Profit<?php }?></td>
    <td colspan="2"></td>
  </tr>
  <?php $_smarty_tpl->_assignInScope('total_paid', "0");?>
  <?php $_smarty_tpl->_assignInScope('total_sale', "0");?>
  <?php $_smarty_tpl->_assignInScope('total_hour', "0");?>
  <?php $_smarty_tpl->_assignInScope('total_student', "0");?>
  <?php $_smarty_tpl->_assignInScope('total_extrahour', "0");?>
  <?php $_smarty_tpl->_assignInScope('total_lesson', "0");?>
  <?php $_smarty_tpl->_assignInScope('total_lesson_hour', "0");?>
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['coaches']->value[$_smarty_tpl->tpl_vars['week']->value], 'coach', false, 'titleid');
$_smarty_tpl->tpl_vars['coach']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['titleid']->value => $_smarty_tpl->tpl_vars['coach']->value) {
$_smarty_tpl->tpl_vars['coach']->do_else = false;
?>
  <tr align="right" class="roweven" >
    <td align="center"><?php echo $_smarty_tpl->tpl_vars['coach']->value['title'];?>
</td>
    <td>
      <?php $_smarty_tpl->_assignInScope('total_hour', $_smarty_tpl->tpl_vars['total_hour']->value+$_smarty_tpl->tpl_vars['coach']->value['hour']);?>
      <?php $_smarty_tpl->_assignInScope('total_extrahour', $_smarty_tpl->tpl_vars['total_extrahour']->value+$_smarty_tpl->tpl_vars['coach']->value['extrahour']);?>
      <span onClick="openinSatff('d15_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['titleid']->value;?>
');" style="text-decoration:underline; cursor:pointer;"><?php echo $_smarty_tpl->tpl_vars['coach']->value['hour'];?>
[h]|($<?php echo $_smarty_tpl->tpl_vars['coach']->value['actual_pay'];?>
/$<?php echo $_smarty_tpl->tpl_vars['coach']->value['should_pay'];?>
)</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:300px" id="d15_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['titleid']->value;?>
">
        <ul>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['coach']->value['list'], 'coach_st', false, 'coach_id');
$_smarty_tpl->tpl_vars['coach_st']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['coach_id']->value => $_smarty_tpl->tpl_vars['coach_st']->value) {
$_smarty_tpl->tpl_vars['coach_st']->do_else = false;
?>
          <?php if ($_smarty_tpl->tpl_vars['coach_st']->value['duehour'] > 0) {?>
              <li><span style="text-decoration:underline; cursor:pointer;" onclick="window.open('/scripts/client_coach_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['coach_st']->value['cid'];?>
&coachid=<?php echo $_smarty_tpl->tpl_vars['coach_id']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['coach_st']->value['name'];?>
 -- <?php echo $_smarty_tpl->tpl_vars['coach_st']->value['duehour'];?>
(h)|($<?php echo $_smarty_tpl->tpl_vars['coach_st']->value['actual_pay'];?>
/$<?php echo $_smarty_tpl->tpl_vars['coach_st']->value['should_pay'];?>
)</span>
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['coach_st']->value['duedetail'], 'lesson_st');
$_smarty_tpl->tpl_vars['lesson_st']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['lesson_st']->value) {
$_smarty_tpl->tpl_vars['lesson_st']->do_else = false;
?>
                <br><?php echo $_smarty_tpl->tpl_vars['lesson_st']->value;?>

              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </li>
          <?php }?>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <span style="font-size:16px; font-weight:bolder; cursor:pointer;" onclick="$('#d15_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['titleid']->value;?>
').css('display', 'none')">&times;</span> </div>
    
    </td>
    <td>
     <?php $_smarty_tpl->_assignInScope('tmp_student', smarty_modifier_count($_smarty_tpl->tpl_vars['coach']->value['list']));?>
     <?php $_smarty_tpl->_assignInScope('total_student', $_smarty_tpl->tpl_vars['total_student']->value+$_smarty_tpl->tpl_vars['tmp_student']->value);?>
     <span onClick="openinSatff('d14_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['titleid']->value;?>
');" style="text-decoration:underline; cursor:pointer;"><?php echo smarty_modifier_count($_smarty_tpl->tpl_vars['coach']->value['list']);?>
</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:300px" id="d14_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['titleid']->value;?>
">
        <ul>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['coach']->value['list'], 'coach_st', false, 'coach_id');
$_smarty_tpl->tpl_vars['coach_st']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['coach_id']->value => $_smarty_tpl->tpl_vars['coach_st']->value) {
$_smarty_tpl->tpl_vars['coach_st']->do_else = false;
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onclick="window.open('/scripts/client_coach_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['coach_st']->value['cid'];?>
&coachid=<?php echo $_smarty_tpl->tpl_vars['coach_id']->value;?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['coach_st']->value['name'];?>
</span></li>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <span style="font-size:16px; font-weight:bolder; cursor:pointer;" onclick="$('#d14_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['titleid']->value;?>
').css('display', 'none')">&times;</span> </div>
    </td>
    <td>
      <?php $_smarty_tpl->_assignInScope('tmp_lesson', smarty_modifier_count($_smarty_tpl->tpl_vars['coach']->value['lessons']));?>
      <?php $_smarty_tpl->_assignInScope('total_lesson', $_smarty_tpl->tpl_vars['total_lesson']->value+$_smarty_tpl->tpl_vars['tmp_lesson']->value);?>
      <?php $_smarty_tpl->_assignInScope('tmp_lesson_hour', array_sum($_smarty_tpl->tpl_vars['coach']->value['lessons']));?>
      <?php $_smarty_tpl->_assignInScope('total_lesson_hour', $_smarty_tpl->tpl_vars['total_lesson_hour']->value+$_smarty_tpl->tpl_vars['tmp_lesson_hour']->value);?>
      <?php echo smarty_modifier_count($_smarty_tpl->tpl_vars['coach']->value['lessons']);?>
(<?php echo array_sum($_smarty_tpl->tpl_vars['coach']->value['lessons']);?>
 h)
    </td>
    <td>
      <?php if ($_smarty_tpl->tpl_vars['user_pos']->value == 'PC' || $_smarty_tpl->tpl_vars['user_pos']->value == 'C' || $_smarty_tpl->tpl_vars['user_pos']->value == 'M') {?>
        <?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['coaches_fee']->value[$_smarty_tpl->tpl_vars['week']->value][$_smarty_tpl->tpl_vars['titleid']->value]['paid']);?>

        <?php $_smarty_tpl->_assignInScope('total_paid', $_smarty_tpl->tpl_vars['total_paid']->value+$_smarty_tpl->tpl_vars['coaches_fee']->value[$_smarty_tpl->tpl_vars['week']->value][$_smarty_tpl->tpl_vars['titleid']->value]['paid']);?>
      <?php }?>
    </td>
    <td>
      <?php if ($_smarty_tpl->tpl_vars['user_pos']->value == 'PC' || $_smarty_tpl->tpl_vars['user_pos']->value == 'C' || $_smarty_tpl->tpl_vars['user_pos']->value == 'M') {?>
        <?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['coaches_fee']->value[$_smarty_tpl->tpl_vars['week']->value][$_smarty_tpl->tpl_vars['titleid']->value]['sale']);?>

        <?php $_smarty_tpl->_assignInScope('total_sale', $_smarty_tpl->tpl_vars['total_sale']->value+$_smarty_tpl->tpl_vars['coaches_fee']->value[$_smarty_tpl->tpl_vars['week']->value][$_smarty_tpl->tpl_vars['titleid']->value]['sale']);?>
      <?php }?>
    </td>
    <td>&nbsp;</td>
    <td colspan="2"></td>
  </tr> 
  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

    <tr align="right" class="roweven" >
      <td><strong>Total:</strong></td>
      <td><strong><?php echo $_smarty_tpl->tpl_vars['total_hour']->value;?>
</strong><br/><hr/>Extra hour: <?php echo $_smarty_tpl->tpl_vars['total_extrahour']->value;?>
</td>
      <td><strong><?php echo $_smarty_tpl->tpl_vars['total_student']->value;?>
</strong></td>
      <td><strong><?php echo $_smarty_tpl->tpl_vars['total_lesson']->value;?>
(<?php echo $_smarty_tpl->tpl_vars['total_lesson_hour']->value;?>
 h)</strong></td>
      <td><strong><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['total_paid']->value);?>
</strong></td>
      <td><strong><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['total_sale']->value);?>
</strong></td>
    </tr>

  <tr class="greybg">
    <td colspan="8"class="highyellow">Legal Service</td>
  </tr> 
  <tr align="center" class="totalrowodd">
    <td>Legal consulted</td>
    <td>Legal consulted fees</td>
    <td>Legal agreement signed</td>
    <td>Completed legal</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"></td>
  </tr>
  <tr align="right" class="roweven" >
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"></td>
  </tr> 
  
  <tr class="greybg">
    <td colspan="8"class="highyellow">Home Loan</td>
  </tr>   
  <tr align="center" class="totalrowodd">
    <td> Referred clients</td>
    <td >Referred commission fees</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>    
    <td colspan="2"></td>
  </tr>
  <tr align="right" class="roweven" >  
   <td >
      <span onClick="openinSatff('d12_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;"><?php echo $_smarty_tpl->tpl_vars['homeloan']->value[$_smarty_tpl->tpl_vars['week']->value]['pcnt'];?>
</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:300px" id="d12_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
        <ul>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['homeloan']->value[$_smarty_tpl->tpl_vars['week']->value]['pname'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onclick="window.open('client_homeloan_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['homeloan']->value[$_smarty_tpl->tpl_vars['week']->value]['client'][$_smarty_tpl->tpl_vars['id']->value];?>
&hid=<?php echo $_smarty_tpl->tpl_vars['homeloan']->value[$_smarty_tpl->tpl_vars['week']->value]['loan'][$_smarty_tpl->tpl_vars['id']->value];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <span style="font-size:16px; font-weight:bolder; cursor:pointer;" onclick="$('#d12_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
').css('display', 'none')">&times;</span> </div>
    </td>
    <td>
     <span onClick="openinSatff('d13_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
');" style="text-decoration:underline; cursor:pointer;"><?php echo $_smarty_tpl->tpl_vars['homeloan_fee']->value[$_smarty_tpl->tpl_vars['week']->value]['fee'];?>
</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:300px" id="d13_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
">
        <ul>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['homeloan_fee']->value[$_smarty_tpl->tpl_vars['week']->value]['pname'], 'name', false, 'id');
$_smarty_tpl->tpl_vars['name']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['id']->value => $_smarty_tpl->tpl_vars['name']->value) {
$_smarty_tpl->tpl_vars['name']->do_else = false;
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onclick="window.open('client_homeloan_detail.php?cid=<?php echo $_smarty_tpl->tpl_vars['homeloan_fee']->value[$_smarty_tpl->tpl_vars['week']->value]['client'][$_smarty_tpl->tpl_vars['id']->value];?>
&hid=<?php echo $_smarty_tpl->tpl_vars['homeloan_fee']->value[$_smarty_tpl->tpl_vars['week']->value]['loan'][$_smarty_tpl->tpl_vars['id']->value];?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</span>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>
        <span style="font-size:16px; font-weight:bolder; cursor:pointer;" onclick="$('#d13_<?php echo $_smarty_tpl->tpl_vars['week']->value;?>
').css('display', 'none')">&times;</span> </div>
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2"></td>
  </tr> 
  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</table>
<?php echo '<script'; ?>
 type="text/javascript">
  <?php echo $_smarty_tpl->tpl_vars['leave_staffs']->value;?>
;
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 type="text/javascript">
    $('#t_fdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true, firstDay: 1 });        
    $('#t_tdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true, firstDay: 1 });

  function archive_confirm() { 
      if(confirm("Please confirm to archive report")){
        $("#bt_archive").val('archive report');
        $("#form1").submit();
      }
      return true;  
  }

	function do_save() {

      var token = prompt("Plese type in execute token");
      if (token == null) {
          return false;
      }    
      $("#token").val(token);
      $("#bt_locked").val("Locked Period");
      $("#form1").submit();
      return true;
  }

  function show_startdate() {
    staff_id = $('#t_staff').val();
    if (leave_staffs[staff_id] !== undefined ) {
      $('#user_startdate').text("(Started: " + leave_staffs[staff_id] + ")");
    }
    else {
       $('#user_startdate').text('');
    }
  }
<?php echo '</script'; ?>
>
  
</body>
</html>
<?php }
}
