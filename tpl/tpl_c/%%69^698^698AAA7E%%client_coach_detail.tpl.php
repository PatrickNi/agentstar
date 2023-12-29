<?php /* Smarty version 2.6.13, created on 2020-11-05 14:33:03
         compiled from client_coach_detail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'ucwords', 'client_coach_detail.tpl', 124, false),array('modifier', 'string_format', 'client_coach_detail.tpl', 125, false),)), $this); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star - Coach Service</title>
</head>

<link rel="stylesheet" href="../css/sam.css">

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "style.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script language="javascript" src="../js/audit.js?v1"></script>
<?php echo $this->_tpl_vars['msg']; ?>

<body>

<form method="get" id="form1" name="form1" action="/scripts/client_coach_detail.php" target="_self" onSubmit="return isDelete()"> 
  <input type="hidden" name="cid" value="<?php echo $this->_tpl_vars['cid']; ?>
"> 
  <input type="hidden" name="coachid" id="coachid" value="<?php echo $this->_tpl_vars['coachid']; ?>
"> 

  <table border="0" width="95%" cellpadding="2" cellspacing="3"> 
    <tr><td colspan="2">
      <table cellpadding="0" cellspacing="0" width="100%">
        <tr align="center"  class="greybg">
          <input type="hidden" name="bt_name" id="bt_name" value="">
          <td align="left" width="10%">
            <?php if ($this->_tpl_vars['ugs']['v_visa']['d'] == 1): ?>
            <input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">&nbsp;&nbsp;&nbsp;
            <?php endif; ?>
          </td>         
          <td align="center" class="whitetext"> Detail Information &nbsp;&nbsp; </td>       
          <td align="left" width="30%">
            <input type="button" value="Save" style="font-weight:bold" onClick="save_visa(this, false);" >
            <input type="button" value="Close &amp; Refresh " style="font-weight:bold" onClick="save_visa(this, true);">
          </td>
        </tr>   
      </table>
    </td></tr>
    <tr align="center"  class="greybg" > 
      <td align="left" style="font-size:16px " colspan="2" onClick="javascript:window.location.href='client_legal.php?cid=<?php echo $this->_tpl_vars['cid']; ?>
'" onMouseMove="javascript:this.style.cursor='pointer'; this.style.backgroundColor='#000'"; onMouseOut="javascript:this.style.backgroundColor='#a3a3a3'"> <span class="highyellow">Client: <?php echo $this->_tpl_vars['client']['lname']; ?>
 <?php echo $this->_tpl_vars['client']['fname']; ?>
</span>&nbsp;&nbsp; <span class="highyellow">DoB: <?php echo $this->_tpl_vars['client']['dob']; ?>
</span>&nbsp;&nbsp;<span class="highyellow">Main Visa: <?php echo $this->_tpl_vars['client']['visa_n']; ?>
-<?php echo $this->_tpl_vars['client']['class_n']; ?>
, expr: <?php echo $this->_tpl_vars['client']['epdate']; ?>
</span>&nbsp;&nbsp; 
      </td> 
    </tr> 
    <tr> 
      <td width="60%" align="left" valign="top"> 
        <table border="0" width="100%" cellpadding="3" cellspacing="1"> 
          <tr> 
             <td width="36%" align="left" class="rowodd"><strong>Course</strong></td>
            <td width="50%" align="left" class="roweven">
                <select id="cate" size="8" style="width: 200px;"></select>&nbsp;
                <select id="course" name="itemid" size="8" style="width: 200px;">
                <input type="hidden" id="courseid" value="<?php echo $this->_tpl_vars['dt_arr']['itemid']; ?>
">
                <?php $this->assign('partnerid', $this->_tpl_vars['items_arr'][$this->_tpl_vars['dt_arr']['itemid']]['pid']); ?>
                <input type="hidden" id="catetit" value="<?php echo $this->_tpl_vars['items_arr'][$this->_tpl_vars['partnerid']]['tit']; ?>
">  
            </td> 
          </tr>
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Start Date:</strong></td> 
            <td align="left" width="64%" class="roweven"><input type="text" name="startdate" id="startdate" size="30" value='<?php echo $this->_tpl_vars['dt_arr']['startdate']; ?>
'></td> 
          </tr>           
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>End Date:</strong></td> 
            <td align="left" width="64%" class="roweven"><input type="text" name="enddate" id="enddate" size="30" value='<?php echo $this->_tpl_vars['dt_arr']['enddate']; ?>
'></td> 
          </tr>   

          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Time & Hours:</strong></td> 
            <td align="left" width="64%" class="roweven"> 
              <input type="text" name="starttime" size="10" value="<?php echo $this->_tpl_vars['dt_arr']['starttime']; ?>
">&nbsp;&nbsp;
              <input type="text" name="duehour" size="10" value="<?php echo $this->_tpl_vars['dt_arr']['duehour']; ?>
">(h)
            </td> 
          </tr> 
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Day of Week</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven"> 
               <input type="checkbox" name="freqw[]" value="Mon" <?php if (in_array ( 'Mon' , $this->_tpl_vars['dt_arr']['freqw_l'] )): ?>checked<?php endif; ?>/>Mon&nbsp;
               <input type="checkbox" name="freqw[]" value="Tue" <?php if (in_array ( 'Tue' , $this->_tpl_vars['dt_arr']['freqw_l'] )): ?>checked<?php endif; ?>/>Tue&nbsp;
               <input type="checkbox" name="freqw[]" value="Wed" <?php if (in_array ( 'Wed' , $this->_tpl_vars['dt_arr']['freqw_l'] )): ?>checked<?php endif; ?>/>Wed&nbsp;
               <input type="checkbox" name="freqw[]" value="Thu" <?php if (in_array ( 'Thu' , $this->_tpl_vars['dt_arr']['freqw_l'] )): ?>checked<?php endif; ?>/>Thu&nbsp;
               <input type="checkbox" name="freqw[]" value="Fri" <?php if (in_array ( 'Fri' , $this->_tpl_vars['dt_arr']['freqw_l'] )): ?>checked<?php endif; ?>/>Fri&nbsp;
               <input type="checkbox" name="freqw[]" value="Sat" <?php if (in_array ( 'Sat' , $this->_tpl_vars['dt_arr']['freqw_l'] )): ?>checked<?php endif; ?>/>Sat&nbsp;
               <input type="checkbox" name="freqw[]" value="Sun" <?php if (in_array ( 'Sun' , $this->_tpl_vars['dt_arr']['freqw_l'] )): ?>checked<?php endif; ?>/>Sun&nbsp;
            </td> 
          </tr>                         
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Teacher:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven"> 
                <select name="staff" >
                <?php $_from = $this->_tpl_vars['user_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['name']):
?>
                  <option  value="<?php echo $this->_tpl_vars['id']; ?>
" <?php if ($this->_tpl_vars['dt_arr']['staff'] == $this->_tpl_vars['id']): ?> selected <?php endif; ?>><?php echo $this->_tpl_vars['name']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
                <?php if ($this->_tpl_vars['dt_arr']['staff'] < 1): ?>
                  <option  value="0" selected >Choose a staff</option>
                <?php endif; ?>
              </select>       
            </td> 
          </tr> 
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Fee(/times):</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven"> 
                <input type="text" size="10" name="fee" value="<?php echo $this->_tpl_vars['dt_arr']['fee']; ?>
">
            </td> 
          </tr>
          
          <tr><td colspan="2"><hr/></td></tr>

          <tr>
              <td colspan="2"> 
                 <table border="0" cellpadding="1" cellspacing="1" width="100%"> 
                    <tr class="greybg"> 
                      <td colspan="9" class="whitetext" align="center">Payment</td> 
                    </tr>
                    <tr align="center" class="totalrowodd">
                        <td>Item</td>
                          <td>Due Amount</td>
                          <td>GST</td>
                          <td>Total Received</td>
                          <td>3rd Party</td>
                          <td>3rd Party Amount</td>
                          <td>GST</td>
                          <td>Total Paid</td>
                          <td>Profit</td>
                      </tr>
                    <?php $this->assign('total_profit', '0'); ?>
                    <?php $_from = $this->_tpl_vars['account_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id'] => $this->_tpl_vars['arr']):
?>
                    <tr align="center" class="roweven">
                        <td style="text-decoration:underline; cursor:pointer" onClick="window.open('client_account_detail.php?vid=<?php echo $this->_tpl_vars['coachid']; ?>
&aid=<?php echo $this->_tpl_vars['id']; ?>
&cid=<?php echo $this->_tpl_vars['cid']; ?>
&typ=coach','_blank', 'alwaysRaised=yes,height=500, width=800,location=no,scrollbars=yes')" ><?php echo ((is_array($_tmp=$this->_tpl_vars['arr']['step'])) ? $this->_run_mod_handler('ucwords', true, $_tmp) : ucwords($_tmp)); ?>
</td>
                        <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['arr']['dueamt'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
                        <td align="right">
                            <?php if ($this->_tpl_vars['arr']['gst'] == 1): ?>
                                <?php echo ((is_array($_tmp=$this->_tpl_vars['arr']['dueamt']/11)) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>

                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td align="right"><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_payment.php?aid=<?php echo $this->_tpl_vars['id']; ?>
','_blank', 'alwaysRaised=yes,height=500,width=800,location=no,scrollbars=yes')"><?php echo ((is_array($_tmp=$this->_tpl_vars['arr']['paid'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</span></td>
                        <td><?php echo ((is_array($_tmp=$this->_tpl_vars['arr']['party'])) ? $this->_run_mod_handler('ucwords', true, $_tmp) : ucwords($_tmp)); ?>
</td>
                        <td align="right"><?php echo ((is_array($_tmp=$this->_tpl_vars['arr']['dueamt_3rd'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</td>
                        <td>
                            <?php if ($this->_tpl_vars['arr']['gst_3rd'] == 1): ?>
                                <?php echo ((is_array($_tmp=$this->_tpl_vars['arr']['dueamt_3rd']/11)) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>

                            <?php else: ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td align="right"><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_spand.php?aid=<?php echo $this->_tpl_vars['id']; ?>
','_blank', 'alwaysRaised=yes,height=500,width=800,location=no,scrollbars=yes')"><?php echo ((is_array($_tmp=$this->_tpl_vars['arr']['spand'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</span></td>
                        <td align="right">
                            <?php echo ((is_array($_tmp=$this->_tpl_vars['arr']['paid']-$this->_tpl_vars['arr']['dueamt_3rd'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>

                            <?php $this->assign('total_profit', $this->_tpl_vars['total_profit']+$this->_tpl_vars['arr']['paid']-$this->_tpl_vars['arr']['dueamt_3rd']); ?>
                        </td>
                    </tr>
                    <?php endforeach; endif; unset($_from); ?>
                    <tr align="center" class="roweven">
                        <td align="right" colspan="8">Total Profit</td>
                        <td align="right"><strong><?php echo ((is_array($_tmp=$this->_tpl_vars['total_profit'])) ? $this->_run_mod_handler('string_format', true, $_tmp, "%.2f") : smarty_modifier_string_format($_tmp, "%.2f")); ?>
</strong></td>
                    </tr>    
                    <tr align="center" class="roweven">
                        <td colspan="9" align="center">
                          <?php if ($this->_tpl_vars['coachid'] > 0): ?>
                          <input type="button" value="Add new" onclick="window.open('client_account_detail.php?cid=<?php echo $this->_tpl_vars['cid']; ?>
&vid=<?php echo $this->_tpl_vars['coachid']; ?>
&typ=coach','_blank', 'alwaysRaised=yes,height=500,width=800,location=no,scrollbars=yes')" />
                          <?php endif; ?>
                        </td>
                    </tr>                              
                </table>
        
              </td>    
          </tr>   
          <tr> 
            <td colspan="2" height="5"><hr></td> 
          </tr>
         </table>        
        </td> 
      <td width="40%" align="left" valign="top"> 
        <strong>Note</strong>
          <textarea style="width:100%; height:100% " name="t_note" rows="30"><?php echo $this->_tpl_vars['dt_arr']['note']; ?>
</textarea>
      </td> 
    </tr>
  <tr class="greybg"><td colspan="2">&nbsp;</td></tr>
  </table> 
</form> 


<script type="text/javascript">
<?php echo $this->_tpl_vars['init_courses']; ?>



<?php echo '
      
  $(\'#startdate\').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
  $(\'#enddate\').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });

    function save_visa(obj,close_w){
        $(\'#bt_name\').val(\'save\');
        btn_n = $(obj).val();
        $(obj).val(\'waiting...\');
        //ContentType UTF-8
        $.post($(\'#form1\').attr(\'action\'), $(\'#form1\').serialize(), function(data){
            console.log(data);
            rtn = $.parseJSON(data);
            
            $(obj).val(btn_n);
            if (rtn.id > 0)
                $(\'#coachid\').val(rtn.id);
            else {
                alert(rtn.msg);
                return false;
            }
            if (close_w) {
                if(window.opener && !window.opener.closed){
                    window.opener.location.reload(true);
                }
                window.close();
            }
            else{
                alert(rtn.msg);
                if (rtn.id > 0) 
                  window.location.href = window.location.href + \'&coachid=\' + rtn.id;    
                else
                  window.location.reload();
            }
        });
    }

  var courseid = $("#courseid").val();
  var catetit  = $(\'#catetit\').val();
  for (x in items) {
    $("#cate").append(new Option(x,x));
  }

  if (catetit != "" && courseid > 0) {
    $("#cate").val(catetit);
    for (x in items[catetit]) {
        $("#course").append(new Option(items[catetit][x], x));
    }
    $("#course").val(courseid);
  }

  $("#cate").click(function(){
    $("#course").empty();
    for (x in items[$(this).val()]) {
        $("#course").append(new Option(items[$(this).val()][x], x));
    }
  });
</script>
'; ?>
  