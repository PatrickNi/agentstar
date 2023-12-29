<?php /* Smarty version 2.6.13, created on 2020-12-09 02:56:01
         compiled from report_staff.2.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'string_format', 'report_staff.2.tpl', 180, false),)), $this); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Client Management</title>
</head>
<link rel="stylesheet" href="../css/sam.css">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "style.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script language="javascript" src="../js/audit.js"></script>
<body>
<form name="form1" target="_self" method="post">
  <table align="center" width="100%"  class="graybordertable" cellpadding="1" cellspacing="1" border="0">
    <tr class="bordered_2">
      <td align="left"><strong>Start Date</strong>&nbsp;&nbsp;
        <input type="text" id="t_fdate" name="t_fdate"  value="<?php echo $this->_tpl_vars['fromDay']; ?>
" >

        &nbsp;&nbsp;&nbsp;&nbsp; <strong>Finish Date</strong>&nbsp;&nbsp;
        <input type="text" id="t_tdate" name="t_tdate"  value="<?php echo $this->_tpl_vars['toDay']; ?>
" >

        &nbsp;&nbsp;&nbsp;&nbsp; <strong>Staff:</strong>&nbsp;&nbsp;
        <select name="t_staff" onChange="this.form.bt_name.focus();">
          
                <?php $_from = $this->_tpl_vars['slUsers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user_id'] => $this->_tpl_vars['user_name']):
?>
                    
          <option value="<?php echo $this->_tpl_vars['user_id']; ?>
" <?php if ($this->_tpl_vars['staffid'] == $this->_tpl_vars['user_id']): ?> selected <?php endif; ?>><?php echo $this->_tpl_vars['user_name']; ?>
</option>
          
                <?php endforeach; endif; unset($_from); ?>
                <?php if ($this->_tpl_vars['ugs']['rpt_staff']['v'] == 1): ?>
                    
          <option value="all" <?php if ($this->_tpl_vars['staffid'] == 'all'): ?> selected <?php endif; ?>>All Staff</option>
          
                <?php endif; ?>
            
        </select>
        &nbsp;&nbsp;&nbsp;&nbsp; </td>
    </tr>
    <tr class="bordered_2" align="center">
      <td align="left" colspan="2"> Report Type:&nbsp;
        <select name="rp_type" onChange="this.form.bt_name.focus();">
          <option value="d" <?php if ($this->_tpl_vars['isAll'] == 'd'): ?> selected <?php endif; ?>>Detail</option>
          <option value="s" <?php if ($this->_tpl_vars['isAll'] == 's'): ?> selected <?php endif; ?>>Summary</option>
        </select>
        &nbsp;&nbsp;&nbsp;
        <input type="submit" name="bt_name" value="create report" style="font-weight:bold ">

        <?php if ($this->_tpl_vars['from_archive']): ?>
          <strong>Reporting data from Archive</strong>
        <?php else: ?>
          <input type="submit" name="bt_archive" value="archive report" style="font-weight:bold ">
        <?php endif; ?>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <!--<input type="button" style="font-weight:bold" onclick="printPage();"value="Print">-->
        <input type="button" style="font-weight:bold" value="Print" onClick="document.all.WebBrowser.ExecWB(6,1)">
        <input type="button"style="font-weight:bold" value="Print Setting" onClick="document.all.WebBrowser.ExecWB(8,1)">
        <input type="button" style="font-weight:bold" value="Print Review" onClick="document.all.WebBrowser.ExecWB(7,1)"></td>
    </tr>
  </table>
</form>
<table width="100%" cellpadding="3" cellspacing="1" border="0" align="left">
  <?php $_from = $this->_tpl_vars['weeks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['week'] => $this->_tpl_vars['daterange']):
?>
  <tr>
    <td  class="highlighttext" colspan="6"><?php echo $this->_tpl_vars['daterange']; ?>
</td>
  </tr>
  <tr class="greybg">
    <td colspan="6" class="highyellow">Apply School</td>
  </tr>
  <tr align="center" class="totalrowodd" >
    <td>Course clients</td>
    <td>Apply Offer</td>
    <td>Received Offer</td>
    <td>Received COE</td>
    <td>Potential Comm</td>  
    <td>Received Comm</td>
  </tr>

  <tr align="right" class="roweven" >
    <td>
        <span onClick="openinSatff('d1_all_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;">
        <?php echo $this->_tpl_vars['courses'][$this->_tpl_vars['week']]['cnt']; ?>
 
        </span>
        <br/>
        <span onClick="openinSatff('d1_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;">
        (New clients: <?php echo $this->_tpl_vars['courses'][$this->_tpl_vars['week']]['cnt_new']; ?>
)
        </span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:300px" id="d1_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['courses'][$this->_tpl_vars['week']]['name_new']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <li><span style="text-decoration:underline; cursor:pointer; <?php if ($this->_tpl_vars['courses'][$this->_tpl_vars['week']]['apo'][$this->_tpl_vars['id']] == 0): ?>color:#0000FF<?php elseif ($this->_tpl_vars['courses'][$this->_tpl_vars['week']]['num'][$this->_tpl_vars['id']] == $this->_tpl_vars['courses'][$this->_tpl_vars['week']]['refuse'][$this->_tpl_vars['id']]): ?>color:#999999;<?php endif; ?>" onClick="window.open('client_course.php?cid=<?php echo $this->_tpl_vars['id']; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);"><?php echo $this->_tpl_vars['name']; ?>
</span>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
        <span style="font-size:16px; font-weight:bolder; cursor:pointer;" onClick="d1_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span> 
      </div>

      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:300px" id="d1_all_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['courses'][$this->_tpl_vars['week']]['name']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <li><span style="text-decoration:underline; cursor:pointer; <?php if ($this->_tpl_vars['courses'][$this->_tpl_vars['week']]['apo'][$this->_tpl_vars['id']] == 0): ?>color:#0000FF<?php elseif ($this->_tpl_vars['courses'][$this->_tpl_vars['week']]['num'][$this->_tpl_vars['id']] == $this->_tpl_vars['courses'][$this->_tpl_vars['week']]['refuse'][$this->_tpl_vars['id']]): ?>color:#999999;<?php endif; ?>" onClick="window.open('client_course.php?cid=<?php echo $this->_tpl_vars['id']; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);"><?php echo $this->_tpl_vars['name']; ?>
</span>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
        <span style="font-size:16px; font-weight:bolder; cursor:pointer;" onClick="d1_all_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span> 
      </div>


    </td>
    <td>
          <?php echo $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['apocnt']; ?>

          <br/><span onClick="openinSatff('d2_old_<?php echo $this->_tpl_vars['week']; ?>
');"  style="text-decoration:underline; cursor:pointer;"><?php echo $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['apocnt_st']; ?>
 old students</span> 
          <br/>&nbsp;&nbsp;(inc <?php echo $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['apocnt_aid']; ?>
 subagents)
          <br/><span onClick="openinSatff('d2_new_<?php echo $this->_tpl_vars['week']; ?>
');"  style="text-decoration:underline; cursor:pointer;"><?php echo $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['apo_new']; ?>
 new clients</span> 
          <br/>&nbsp;&nbsp;(inc <?php echo $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['apo_new_aid']; ?>
 subagents)
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:500px" id="d2_old_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['aponame_old']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <li><span style="text-decoration:underline; cursor:pointer; <?php if ($this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['reo'][$this->_tpl_vars['id']] == 0): ?>color:#0000FF<?php elseif ($this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['reo_st'][$this->_tpl_vars['id']] == -1): ?>color:#999999;<?php endif; ?>" onClick="window.open('client_course_detail.php?cid=<?php echo $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['apocid'][$this->_tpl_vars['id']]; ?>
&courseid=<?php echo $this->_tpl_vars['id']; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);"><?php echo $this->_tpl_vars['name']; ?>
</span>
            <?php endforeach; endif; unset($_from); ?>
        </ul>

        <span style="font-weight:bolder; cursor:pointer;" onClick="d2_old_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span> </div>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:500px" id="d2_new_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['aponame_new']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <li><span style="text-decoration:underline; cursor:pointer; <?php if ($this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['reo'][$this->_tpl_vars['id']] == 0): ?>color:#0000FF<?php elseif ($this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['reo_st'][$this->_tpl_vars['id']] == -1): ?>color:#999999;<?php endif; ?>" onClick="window.open('client_course_detail.php?cid=<?php echo $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['apocid'][$this->_tpl_vars['id']]; ?>
&courseid=<?php echo $this->_tpl_vars['id']; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);"><?php echo $this->_tpl_vars['name']; ?>
</span>
            <?php endforeach; endif; unset($_from); ?>
        </ul>

        <span style="font-weight:bolder; cursor:pointer;" onClick="d2_new_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span> </div>
    </td>  

     <td >
           <?php echo $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['reocnt']; ?>

           <br/><span onClick="openinSatff('d3_old_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;"><?php echo $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['reocnt_st']; ?>
 old students</span> 
           <br/>&nbsp;&nbsp;(inc <?php echo $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['reocnt_aid']; ?>
 subagents)
           <br/><span onClick="openinSatff('d3_new_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;"><?php echo $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['reo_new']; ?>
 new clients</span> 
           <br/>&nbsp;&nbsp;(inc <?php echo $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['reo_new_aid']; ?>
 subagents)
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:500px" id="d3_old_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['reoname_old']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <li><span style="text-decoration:underline; cursor:pointer; <?php if ($this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['reo_st'][$this->_tpl_vars['id']] == 0): ?>color:#0000FF<?php elseif ($this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['reo_st'][$this->_tpl_vars['id']] == -1): ?>color:#999999;<?php endif; ?>" onClick="window.open('client_course_detail.php?cid=<?php echo $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['reocid'][$this->_tpl_vars['id']]; ?>
&courseid=<?php echo $this->_tpl_vars['id']; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);"><?php echo $this->_tpl_vars['name']; ?>
</span>
            <?php endforeach; endif; unset($_from); ?>
        </ul>

        <span style="font-weight:bolder; cursor:pointer;" onClick="d3_old_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span> </div>
        <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:500px" id="d3_new_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['reoname_new']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <li><span style="text-decoration:underline; cursor:pointer; <?php if ($this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['reo_st'][$this->_tpl_vars['id']] == 0): ?>color:#0000FF<?php elseif ($this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['reo_st'][$this->_tpl_vars['id']] == -1): ?>color:#999999;<?php endif; ?>" onClick="window.open('client_course_detail.php?cid=<?php echo $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['reocid'][$this->_tpl_vars['id']]; ?>
&courseid=<?php echo $this->_tpl_vars['id']; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);"><?php echo $this->_tpl_vars['name']; ?>
</span>
            <?php endforeach; endif; unset($_from); ?>
        </ul>

        <span style="font-weight:bolder; cursor:pointer;" onClick="d3_new_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span> </div>
      </td>   

    <td>
        <?php echo $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['reccnt']; ?>

        <br/><span onClick="openinSatff('d4_old_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;"><?php echo $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['reccnt_st']; ?>
 old students</span> 
        <br/>&nbsp;&nbsp;(inc <?php echo $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['reccnt_aid']; ?>
 subagents)</span>  
        <br/><span onClick="openinSatff('d4_new_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;"><?php echo $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['rec_new']; ?>
 new clients</span> 
        <br/>&nbsp;&nbsp;(inc <?php echo $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['rec_new_aid']; ?>
 subagents) 
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:500px" id="d4_old_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['recname_old']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_course_detail.php?cid=<?php echo $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['reccid'][$this->_tpl_vars['id']]; ?>
&courseid=<?php echo $this->_tpl_vars['id']; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);"><?php echo $this->_tpl_vars['name']; ?>
</span>
            <?php endforeach; endif; unset($_from); ?>
        </ul>

        <span style="font-weight:bolder; cursor:pointer;" onClick="d4_old_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span> </div>
     <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:500px" id="d4_new_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['recname_new']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_course_detail.php?cid=<?php echo $this->_tpl_vars['courseprocs'][$this->_tpl_vars['week']]['reccid'][$this->_tpl_vars['id']]; ?>
&courseid=<?php echo $this->_tpl_vars['id']; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);"><?php echo $this->_tpl_vars['name']; ?>
</span>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
        
        <span style="font-weight:bolder; cursor:pointer;" onClick="d4_new_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span> </div>
    </td>  
    <td>
      <?php if ($this->_tpl_vars['ugs']['rpt_staff_pc']['v'] == 1): ?>
      <span onClick="openinSatff('d5_<?php echo $this->_tpl_vars['week']; ?>
');" style="cursor:pointer;">
        <?php echo ((is_array($_tmp=$this->_tpl_vars['coursepots'][$this->_tpl_vars['week']]['rcomm'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
<br/>
        <?php echo $this->_tpl_vars['coursepots'][$this->_tpl_vars['week']]['rcomm_st']; ?>
 old students 
        <br/>&nbsp;&nbsp;<span style="text-decoration:underline; ">(inc <?php echo $this->_tpl_vars['coursepots'][$this->_tpl_vars['week']]['rcomm_aid']; ?>
 subagents)</span><br/>  
        <?php echo $this->_tpl_vars['coursepots'][$this->_tpl_vars['week']]['rcomm_new']; ?>
 new clients 
        <br/>&nbsp;&nbsp;<span style="text-decoration:underline; ">(inc <?php echo $this->_tpl_vars['coursepots'][$this->_tpl_vars['week']]['rcomm_new_aid']; ?>
 subagents)</span>
      </span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:180px" id="d5_<?php echo $this->_tpl_vars['week']; ?>
">
        <table width="100%">
        <tr><td>Name</td><td  align="right">Comm($)</td></tr>
          <?php $_from = $this->_tpl_vars['coursepots'][$this->_tpl_vars['week']]['name']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <tr><td align="center"><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_course_sem.php?cid=<?php echo $this->_tpl_vars['coursepots'][$this->_tpl_vars['week']]['client'][$this->_tpl_vars['id']]; ?>
&courseid=<?php echo $this->_tpl_vars['coursepots'][$this->_tpl_vars['week']]['course'][$this->_tpl_vars['id']]; ?>
&semid=<?php echo $this->_tpl_vars['coursepots'][$this->_tpl_vars['week']]['sem'][$this->_tpl_vars['id']]; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);"><?php echo $this->_tpl_vars['name']; ?>
</span></td><td align="right" <?php if ($this->_tpl_vars['coursepots'][$this->_tpl_vars['week']]['commfail'][$this->_tpl_vars['id']] == 1): ?>style="color:#0000CC"<?php endif; ?>><?php echo $this->_tpl_vars['coursepots'][$this->_tpl_vars['week']]['comm'][$this->_tpl_vars['id']]; ?>
</td></tr><?php endforeach; endif; unset($_from); ?>
          </table>

        <span style="font-weight:bolder; cursor:pointer;" onClick="d5_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span> 
      </div>
      <?php endif; ?>
    </td>                   
     <td>
       <?php if ($this->_tpl_vars['ugs']['rpt_staff_rc']['v'] == 1): ?>
       <span onClick="openinSatff('d11_<?php echo $this->_tpl_vars['week']; ?>
');" style="cursor:pointer;">
        <?php echo ((is_array($_tmp=$this->_tpl_vars['coursesems'][$this->_tpl_vars['week']]['bonus'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
<br/>
        <?php echo $this->_tpl_vars['coursesems'][$this->_tpl_vars['week']]['bonus_st']; ?>
 old students 
        <br/>&nbsp;&nbsp;<span style="text-decoration:underline; ">(inc <?php echo $this->_tpl_vars['coursesems'][$this->_tpl_vars['week']]['bonus_aid']; ?>
 subagents)</span><br/> 
        <?php echo $this->_tpl_vars['coursesems'][$this->_tpl_vars['week']]['bonus_new']; ?>
 new clients 
        <br/>&nbsp;&nbsp;<span style="text-decoration:underline; ">(inc <?php echo $this->_tpl_vars['coursesems'][$this->_tpl_vars['week']]['bonus_new_aid']; ?>
 subagents) </span>
      </span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:180px" id="d11_<?php echo $this->_tpl_vars['week']; ?>
">
        <table width="100%">
        <tr><td>Name</td><td align="right">Comm($)</td></tr>
          <?php $_from = $this->_tpl_vars['coursesems'][$this->_tpl_vars['week']]['bonusname']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <tr><td align="center"><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_course_sem.php?cid=<?php echo $this->_tpl_vars['coursesems'][$this->_tpl_vars['week']]['client'][$this->_tpl_vars['id']]; ?>
&courseid=<?php echo $this->_tpl_vars['coursesems'][$this->_tpl_vars['week']]['course'][$this->_tpl_vars['id']]; ?>
&semid=<?php echo $this->_tpl_vars['coursesems'][$this->_tpl_vars['week']]['sem'][$this->_tpl_vars['id']]; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);"><?php echo $this->_tpl_vars['name']; ?>
</span></td><td align="right" <?php if ($this->_tpl_vars['coursesems'][$this->_tpl_vars['week']]['bonusfail'][$this->_tpl_vars['id']] == 1): ?>style="color:#0000CC"<?php endif; ?>><?php echo $this->_tpl_vars['coursesems'][$this->_tpl_vars['week']]['bonuscomm'][$this->_tpl_vars['id']]; ?>
</td></tr><?php endforeach; endif; unset($_from); ?>
        </table>

        <span style="font-weight:bolder; cursor:pointer;" onClick="d11_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span>  
        </div>
        <?php endif; ?>
      </td>           
  </tr>

  <tr class="greybg">
    <td colspan="6" class="highyellow">Visa Service</td>
  </tr> 
  <tr align="center" class="totalrowodd">
    <td>Visa Consultant </td>
    <td>Consultant Fee</td>
    <td>Agreement Signed</td>
    <td>Apply Visa </td>
    <td>Finalized Cases (Free) </td>
    <td>Finalized Cases (Paid) </td>
  </tr>

  <tr align="right" class="roweven" >
    <td><span onClick="openinSatff('d6_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;"><?php echo $this->_tpl_vars['visavisits'][$this->_tpl_vars['week']]['pcnt']; ?>
</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:400px" id="d6_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['visavisits'][$this->_tpl_vars['week']]['pname']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <li><span style="text-decoration:underline; cursor:pointer; <?php if ($this->_tpl_vars['visavisits'][$this->_tpl_vars['week']]['decline'][$this->_tpl_vars['id']] > 0): ?>color:#999999;<?php elseif ($this->_tpl_vars['visavisits'][$this->_tpl_vars['week']]['sign'][$this->_tpl_vars['id']] == 0): ?>color:#0000FF;<?php endif; ?>" onClick="window.open('client_visa_detail.php?cid=<?php echo $this->_tpl_vars['visavisits'][$this->_tpl_vars['week']]['client'][$this->_tpl_vars['id']]; ?>
&vid=<?php echo $this->_tpl_vars['visavisits'][$this->_tpl_vars['week']]['visa'][$this->_tpl_vars['id']]; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);"><?php echo $this->_tpl_vars['name']; ?>
</span> <?php endforeach; endif; unset($_from); ?>
        </ul>

        <span style="font-weight:bolder; cursor:pointer;" onClick="d6_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span> </div></td>
     
     <td><span onClick="openinSatff('d66_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;"><?php echo $this->_tpl_vars['visavisits'][$this->_tpl_vars['week']]['totalcfee']; ?>
</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:400px" id="d66_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['visavisits'][$this->_tpl_vars['week']]['pname']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
           <?php if ($this->_tpl_vars['visavisits'][$this->_tpl_vars['week']]['cfee'][$this->_tpl_vars['id']] > 0): ?>
            <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $this->_tpl_vars['visavisits'][$this->_tpl_vars['week']]['client'][$this->_tpl_vars['id']]; ?>
&vid=<?php echo $this->_tpl_vars['visavisits'][$this->_tpl_vars['week']]['visa'][$this->_tpl_vars['id']]; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*4/5 +',width='+screen.width*4/5);"><?php echo $this->_tpl_vars['name']; ?>
 </span></li>
            <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
            
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d66_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span> </div></td> 

    <td><span onClick="openinSatff('d7_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;"><?php echo ((is_array($_tmp=$this->_tpl_vars['visaagrees'][$this->_tpl_vars['week']]['fee'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
&nbsp;($0/paid : <?php echo $this->_tpl_vars['visaagrees'][$this->_tpl_vars['week']]['sign0']; ?>
/<?php echo $this->_tpl_vars['visaagrees'][$this->_tpl_vars['week']]['sign1']; ?>
)</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="d7_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['visaagrees'][$this->_tpl_vars['week']]['fname']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $this->_tpl_vars['visaagrees'][$this->_tpl_vars['week']]['client'][$this->_tpl_vars['id']]; ?>
&vid=<?php echo $this->_tpl_vars['visaagrees'][$this->_tpl_vars['week']]['visa'][$this->_tpl_vars['id']]; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $this->_tpl_vars['name']; ?>
</span> <?php endforeach; endif; unset($_from); ?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d7_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span> </div></td>

    <td>
      <?php if ($this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['lc_free'] > 0): ?>
        <span onClick="openinSatff('d8_free_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['lc_free']; ?>
)</span>&nbsp;
      <?php endif; ?>
      Free:&nbsp;$<?php echo ((is_array($_tmp=$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['lfee_free'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
<br/>
      <?php if ($this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['lc_paid'] > 0): ?>
        <span onClick="openinSatff('d8_paid_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['lc_paid']; ?>
)</span>&nbsp;
      <?php endif; ?>
      Paid:&nbsp;$<?php echo ((is_array($_tmp=$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['lfee_paid'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
<br/>
      <hr/>
      <!--
      <span onClick="openinSatff('d8_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;">[<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['lcnt0']; ?>
/<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['lcnt1']; ?>
]
      </span>&nbsp;&nbsp;
      -->
      <?php if ($this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['lcnt1'] > 0): ?>
        (<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['lcnt1']; ?>
)&nbsp;
      <?php endif; ?>
      Total:&nbsp;$<?php echo ((is_array($_tmp=$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['lfee'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
<br/>
      
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="d8_free_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['lname_free']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['lc'][$this->_tpl_vars['id']]; ?>
&vid=<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['lv'][$this->_tpl_vars['id']]; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $this->_tpl_vars['name']; ?>
</span> <?php endforeach; endif; unset($_from); ?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d8_free_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span> </div>

      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="d8_paid_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['lname_paid']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['lc'][$this->_tpl_vars['id']]; ?>
&vid=<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['lv'][$this->_tpl_vars['id']]; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $this->_tpl_vars['name']; ?>
</span> <?php endforeach; endif; unset($_from); ?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="d8_paid_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span> </div>
    </td>  
  
    <!--Fee Section-->
    <td>
      <?php if ($this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['gc_free'] > 0): ?>
        <span onClick="openinSatff('gc_free_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['gc_free']; ?>
)</span>&nbsp;
      <?php endif; ?>
        granted, &nbsp;$<?php echo ((is_array($_tmp=$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['gfee_free'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 <br/>

      <?php if ($this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['wc_free'] > 0): ?>
        <span onClick="openinSatff('wc_free_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['wc_free']; ?>
)</span>&nbsp;
      <?php endif; ?>
        withdraw, &nbsp;$<?php echo ((is_array($_tmp=$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['wfee_free'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 <br/>   

       <?php if ($this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['rc_free'] > 0): ?>
        <span onClick="openinSatff('rc_free_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['rc_free']; ?>
)</span>&nbsp;
      <?php endif; ?>
        refused, &nbsp;$<?php echo ((is_array($_tmp=$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['rfee_free'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 <br/>      

       <?php if ($this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['cc_free'] > 0): ?>
        <span onClick="openinSatff('cc_free_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['cc_free']; ?>
)</span>&nbsp;
      <?php endif; ?>
        client cancel agreement, &nbsp;$<?php echo ((is_array($_tmp=$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['cfee_free'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 <br/>           

       <?php if ($this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['sc_free'] > 0): ?>
        <span onClick="openinSatff('sc_free_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['sc_free']; ?>
)</span>&nbsp;
      <?php endif; ?>
        stop agent, &nbsp;$<?php echo ((is_array($_tmp=$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['sfee_free'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 <br/>                      
      
      <hr/>
      <?php if (( $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['gc_free']+$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['wc_free']+$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['rc_free']+$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['cc_free']+$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['sc_free'] ) > 0): ?>
      (<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['gc_free']+$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['wc_free']+$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['rc_free']+$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['cc_free']+$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['sc_free']; ?>
)&nbsp;
      <?php endif; ?>
      Total: &nbsp;$<?php echo ((is_array($_tmp=$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['gfee_free']+$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['wfee_free']+$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['rfee_free']+$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['cfee_free']+$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['sfee_free'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
   
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="gc_free_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['gname_free']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['gc'][$this->_tpl_vars['id']]; ?>
&vid=<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['gv'][$this->_tpl_vars['id']]; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $this->_tpl_vars['name']; ?>
</span> <?php endforeach; endif; unset($_from); ?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="gc_free_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span> </div>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="wc_free_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['wname_free']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['wc'][$this->_tpl_vars['id']]; ?>
&vid=<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['wv'][$this->_tpl_vars['id']]; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $this->_tpl_vars['name']; ?>
</span> <?php endforeach; endif; unset($_from); ?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="wc_free_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span> </div>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="rc_free_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['rname_free']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['rc'][$this->_tpl_vars['id']]; ?>
&vid=<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['rv'][$this->_tpl_vars['id']]; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $this->_tpl_vars['name']; ?>
</span> <?php endforeach; endif; unset($_from); ?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="rc_free_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span> </div>  
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="cc_free_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['cname_free']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['cc'][$this->_tpl_vars['id']]; ?>
&vid=<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['cv'][$this->_tpl_vars['id']]; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $this->_tpl_vars['name']; ?>
</span> <?php endforeach; endif; unset($_from); ?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="cc_free_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span> </div>   
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="sc_free_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['sname_free']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['sc'][$this->_tpl_vars['id']]; ?>
&vid=<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['sv'][$this->_tpl_vars['id']]; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $this->_tpl_vars['name']; ?>
</span> <?php endforeach; endif; unset($_from); ?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="sc_free_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span> </div>                   
    </td>


    <!--Paid Section-->
    <td>
      <?php if ($this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['gc_paid'] > 0): ?>
        <span onClick="openinSatff('gc_paid_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['gc_paid']; ?>
)</span>&nbsp;
      <?php endif; ?>
        granted, &nbsp;$<?php echo ((is_array($_tmp=$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['gfee_paid'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 <br/>

      <?php if ($this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['wc_paid'] > 0): ?>
        <span onClick="openinSatff('wc_paid_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['wc_paid']; ?>
)</span>&nbsp;
      <?php endif; ?>
        withdraw, &nbsp;$<?php echo ((is_array($_tmp=$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['wfee_paid'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 <br/>   

       <?php if ($this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['rc_paid'] > 0): ?>
        <span onClick="openinSatff('rc_paid_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['rc_paid']; ?>
)</span>&nbsp;
      <?php endif; ?>
        refused, &nbsp;$<?php echo ((is_array($_tmp=$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['rfee_paid'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 <br/>      

       <?php if ($this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['cc_paid'] > 0): ?>
        <span onClick="openinSatff('cc_paid_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['cc_paid']; ?>
)</span>&nbsp;
      <?php endif; ?>
        client cancel agreement, &nbsp;$<?php echo ((is_array($_tmp=$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['cfee_paid'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 <br/>           

       <?php if ($this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['sc_paid'] > 0): ?>
        <span onClick="openinSatff('dc_paid_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;">(<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['sc_paid']; ?>
)</span>&nbsp;
      <?php endif; ?>
        stop agent, &nbsp;$<?php echo ((is_array($_tmp=$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['sfee_paid'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 <br/>                      
      
      <hr/>
      <?php if (( $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['gc_paid']+$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['wc_paid']+$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['rc_paid']+$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['cc_paid']+$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['sc_paid'] ) > 0): ?>
      (<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['gc_paid']+$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['wc_paid']+$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['rc_paid']+$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['cc_paid']+$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['sc_paid']; ?>
)&nbsp;
      <?php endif; ?>
      Total: &nbsp;$<?php echo ((is_array($_tmp=$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['gfee_paid']+$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['wfee_paid']+$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['rfee_paid']+$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['cfee_paid']+$this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['sfee_paid'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
 

      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="gc_paid_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['gname_paid']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['gc'][$this->_tpl_vars['id']]; ?>
&vid=<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['gv'][$this->_tpl_vars['id']]; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $this->_tpl_vars['name']; ?>
</span> <?php endforeach; endif; unset($_from); ?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="gc_paid_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span> </div>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="wc_paid_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['wname_paid']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['wc'][$this->_tpl_vars['id']]; ?>
&vid=<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['wv'][$this->_tpl_vars['id']]; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $this->_tpl_vars['name']; ?>
</span> <?php endforeach; endif; unset($_from); ?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="wc_paid_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span> </div>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="rc_paid_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['rname_paid']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['rc'][$this->_tpl_vars['id']]; ?>
&vid=<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['rv'][$this->_tpl_vars['id']]; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $this->_tpl_vars['name']; ?>
</span> <?php endforeach; endif; unset($_from); ?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="rc_paid_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span> </div>  
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="cc_paid_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['cname_paid']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['cc'][$this->_tpl_vars['id']]; ?>
&vid=<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['cv'][$this->_tpl_vars['id']]; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $this->_tpl_vars['name']; ?>
</span> <?php endforeach; endif; unset($_from); ?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="cc_paid_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span> </div>   
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width::400px" id="sc_paid_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['sname_paid']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_visa_detail.php?cid=<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['sc'][$this->_tpl_vars['id']]; ?>
&vid=<?php echo $this->_tpl_vars['visaprocs'][$this->_tpl_vars['week']]['sv'][$this->_tpl_vars['id']]; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $this->_tpl_vars['name']; ?>
</span> <?php endforeach; endif; unset($_from); ?>
        </ul>
        <span style="font-weight:bolder; cursor:pointer;" onClick="sc_paid_<?php echo $this->_tpl_vars['week']; ?>
.style.display='none'">&times;</span> </div> 

    </td>

  </tr>
  
  <tr class="greybg">
    <td colspan="6"class="highyellow">Legal Service</td>
  </tr> 
  <tr align="center" class="totalrowodd">
    <td>Legal consulted</td>
    <td>Legal consulted fees</td>
    <td>Legal agreement signed</td>
    <td>Completed legal</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr align="right" class="roweven" >
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr> 
  
  <tr class="greybg">
    <td colspan="6"class="highyellow">Home Loan</td>
  </tr>   
  <tr align="center" class="totalrowodd">
    <td> Referred clients</td>
    <td >Referred commission fees</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>    
  </tr>
  <tr align="right" class="roweven" >  
   <td >
      <span onClick="openinSatff('d12_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;"><?php echo $this->_tpl_vars['homeloan'][$this->_tpl_vars['week']]['pcnt']; ?>
</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:300px" id="d12_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['homeloan'][$this->_tpl_vars['week']]['pname']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onclick="window.open('client_homeloan_detail.php?cid=<?php echo $this->_tpl_vars['homeloan'][$this->_tpl_vars['week']]['client'][$this->_tpl_vars['id']]; ?>
&hid=<?php echo $this->_tpl_vars['homeloan'][$this->_tpl_vars['week']]['loan'][$this->_tpl_vars['id']]; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $this->_tpl_vars['name']; ?>
</span>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
        <span style="font-size:16px; font-weight:bolder; cursor:pointer;" onclick="$('#d12_<?php echo $this->_tpl_vars['week']; ?>
').css('display', 'none')">&times;</span> </div>
    </td>
    <td>
     <span onClick="openinSatff('d13_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;"><?php echo $this->_tpl_vars['homeloan_fee'][$this->_tpl_vars['week']]['fee']; ?>
</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:300px" id="d13_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['homeloan_fee'][$this->_tpl_vars['week']]['pname']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onclick="window.open('client_homeloan_detail.php?cid=<?php echo $this->_tpl_vars['homeloan_fee'][$this->_tpl_vars['week']]['client'][$this->_tpl_vars['id']]; ?>
&hid=<?php echo $this->_tpl_vars['homeloan_fee'][$this->_tpl_vars['week']]['loan'][$this->_tpl_vars['id']]; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $this->_tpl_vars['name']; ?>
</span>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
        <span style="font-size:16px; font-weight:bolder; cursor:pointer;" onclick="$('#d13_<?php echo $this->_tpl_vars['week']; ?>
').css('display', 'none')">&times;</span> </div>
    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr> 

  <tr class="greybg">
    <td colspan="6"class="highyellow">Coach Services</td>
  </tr>   
  <tr align="center" class="totalrowodd">
    <td>Course Item</td>
    <td ># of hours delivered</td>
    <td># of students(active / current)</td>
    <td>Profit / Sales</td>
    <td>Received Coaching Fee(Payment)</td>
    <td>&nbsp;</td>
  </tr>
  <?php $_from = $this->_tpl_vars['coaches'][$this->_tpl_vars['week']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['coach']):
?>
  <tr align="right" class="roweven" >
    <td align="center"><?php echo $this->_tpl_vars['coach']['title']; ?>
</td>
    <td><?php echo $this->_tpl_vars['coach']['hour']; ?>
</td>
    <td>
     <span onClick="openinSatff('d14_<?php echo $this->_tpl_vars['week']; ?>
');" style="text-decoration:underline; cursor:pointer;"><?php echo $this->_tpl_vars['coach']['client']; ?>
</span>
      <div style="display:none; float:inherit; position:absolute; background-color:#FFFFCC;width:300px" id="d14_<?php echo $this->_tpl_vars['week']; ?>
">
        <ul>
          <?php $_from = $this->_tpl_vars['coach']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['coach_id'] => $this->_tpl_vars['coach_st']):
?>
          <li><span style="text-decoration:underline; cursor:pointer;" onclick="window.open('/scripts/client_coach_detail.php?cid=<?php echo $this->_tpl_vars['coach_st']['cid']; ?>
&coachid=<?php echo $this->_tpl_vars['coach_id']; ?>
','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)"><?php echo $this->_tpl_vars['coach_st']['name']; ?>
</span>
            <?php endforeach; endif; unset($_from); ?>
        </ul>
        <span style="font-size:16px; font-weight:bolder; cursor:pointer;" onclick="$('#d14_<?php echo $this->_tpl_vars['week']; ?>
').css('display', 'none')">&times;</span> </div>
      <?php echo $this->_tpl_vars['coach']['client']; ?>


    </td>
    <td><?php echo $this->_tpl_vars['coach']['sale']; ?>
</td>
    <td><?php echo $this->_tpl_vars['coach']['paid']; ?>
</td>
    <td>&nbsp;</td>
  </tr> 
  <?php endforeach; endif; unset($_from); ?>
  <?php endforeach; endif; unset($_from); ?>
</table>
<?php echo '
<script type="text/javascript">
    $(\'#t_fdate\').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
    $(\'#t_tdate\').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
</script>
'; ?>
  
</body>
</html>