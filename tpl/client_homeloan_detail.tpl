<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star -Home Loan</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>

<script language="javascript">{$msg_alert}</script>
<body>
<form method="get" name="form1" action="" target="_self" onkeydown="if(event.keyCode==13)return false;" onsubmit="return isDelete()">
  <input type="hidden" name="cid" value="{$cid}">
  <input type="hidden" name="hid" value="{$hid}">
  <input type="hidden" name="isChange" value="0">
  <table border="0" width="100%" cellpadding="1" cellspacing="1">
    <tr>
      <td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
          <tr align="center"  class="greybg">
            <input type="hidden" name="bt_name" value="">
            <td align="left"  width="31%"><input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;alert(1)" >
            </td>
            <td width="49%" align="center" class="whitetext">Home Loan Detail</td>
            <td align="right"  width="20%"><input type="submit" value="Save" style="font-weight:bold" onClick="this.form.bt_name.value='save';this.disable=false;" >
            </td>
          </tr>
        </table></td>
    </tr>
    <tr align="center"  class="greybg" >
      <td align="left" style="font-size:16px " colspan="2" onClick="javascript:window.location.href='client_course.php?cid={$cid}'" onMouseMove="javascript:this.style.cursor='pointer'; this.style.backgroundColor='#000'"; onMouseOut="javascript:this.style.backgroundColor='#a3a3a3'"><span class="highyellow">Client: {$client.lname} {$client.fname}</span>&nbsp;&nbsp; <span class="highyellow">DoB: {$client.dob}</span>&nbsp;&nbsp;<span class="highyellow">Main Visa: {$client.visa_n}-{$client.class_n}, expr: {$client.epdate}</span></td>
    </tr>
    <tr>
      <td width="60%"><table border="0" width="100%" cellpadding="3" cellspacing="1">
          <tr>
            <td width="28%" align="left" style="color:#FF0000" class="rowodd"><strong>Status:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><select name="t_status" style=" font-weight:bold;color:#FF0000">
                <option value="pending" {if $dt_arr.status eq 'pending'} selected {/if}>Active</option>
                <option value="approved" {if $dt_arr.status eq 'approved'} selected {/if}>Approved</option>
                <option value="rejected" {if $dt_arr.status eq 'rejected'} selected {/if}>Rejected</option>
              </select>
            </td>
          </tr>
          <tr>
            <td colspan="2"><hr></td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Category:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven" id="lend_cate">
                {$lend_arr[$dt_arr.lid].cate}
            </td>
          </tr>
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Agreement Staff:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven"> 
                <select name="t_user" >
                {foreach key=id item=name from=$user_arr}
                  <option  value="{$id}" {if $dt_arr.user eq $id} selected {/if}>{$name}</option>
                {/foreach}
                {if $dt_arr.user lt 1}
                  <option  value="0" selected >select a user</option>
                {/if}
              </select>      
            </td> 
          </tr>                     
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Lending Institute:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven">
              <select name="t_lend" onChange="new_lend(this)">  
										{foreach key=id item=lend from=$lend_arr}
                       <option cate="{$lend.cate}" cr="{$lend.cr*100}" value="{$id}" {if $id eq $dt_arr.lid} selected {/if}>{$lend.name}</option>
										{/foreach}
										{if  not array_key_exists($dt_arr.lid, $lend_arr)}
                      <option value="0" selected>Choose Lending institute</option>
                    {/if}                  
              </select>
            </td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Lending manager:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven" id="lend_cate">
                <select name="staff" id="lend_staff">
                {foreach key=id item=v from=$lend_staff}
                  <option value="{$id}" {if $id eq $dt_arr.staff} selected {/if}>{$v.name}</option>
                {/foreach}
                {if $dt_arr.staff eq 0} 
                  <option value="0" selected>Choose a lending manager</option>
                {/if}
                </select>
            </td>
          </tr>          
          <tr>
            <td width="28%" align="left"class="rowodd"><strong>Commission Rate:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven">
              <input type="hidden" name="t_cr" id="t_cr" value="{$dt_arr.cr*100}" size="10" >
              <span id="t_cr_show">{$dt_arr.cr*100}</span>%
            <td>  
          </tr>
          <tr>
            <td width="28%" align="left"class="rowodd"><strong>Property Price:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven">
              <input type="text" name="t_price" value="{$dt_arr.price|number_format:2:'.':','}" size="30" >
            <td>  
          </tr> 
          <tr>
            <td width="28%" align="left"class="rowodd"><strong>Loan Amount:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven">
              <input type="text" name="t_amount" id="t_amount" value="{$dt_arr.amount|number_format:2:'.':','}" size="30" onChange="calcul_comm()">
            <td>  
          </tr>                        
          <tr>
            <td colspan="2"><hr></td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd"><strong>Commissions:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven" id="t_comm">{$dt_arr.comm}(GST: {$dt_arr.comm*0.1|number_format:2:'.':','})(Total: {$dt_arr.comm*1.1|number_format:2:'.':','})</td>
          </tr>
          <tr>
            <td width="28%" align="left" class="rowodd" style="color:#CC3300"><strong>Co-comm amount:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><input type="text" name="t_cocomm" value="{$dt_arr.cocomm}" size="30" onChange="audit_money(this)"></td>
          </tr>
           <tr>
            <td width="28%" align="left" class="rowodd" style="color:#CC3300"><strong>Co-comm invoice Recevied Date:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><input type="text" name="t_codate" id="t_codate" value="{$dt_arr.codate}" size="30" ></td>
          </tr>
           <tr>
            <td width="28%" align="left"  class="rowodd"style="color:#CC3300"><strong>Discount:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><input type="text" name="t_discount" value="{$dt_arr.discount}" size="30" onChange="audit_money(this)"></td>
          </tr>  
                           <tr>
            <td width="28%" align="left"  class="rowodd"style="color:#CC3300"><strong>Discount PayDay:</strong>&nbsp;&nbsp;</td>
            <td align="left" width="72%" class="roweven"><input type="text" name="t_discountdate" id="t_discountdate"value="{$dt_arr.discountdate}" size="30">
            </td>
          </tr>      
                                
      </table></td>
    <td width="40%" align="left" valign="top">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr class="bordered_2">
              <td colspan="4" class="whitetext" align="center">Process
               {if $hid > 0 }
                          <input type="button" value="add new" style="font-weight:bold" onClick="window.open('client_homeloan_process.php?hid={$hid}&cid={$cid}&isNew=1','_blank','alwaysRaised=yes,height=500,width=800, location=no')">
                {/if}
              </td>
            </tr>
            <tr align="center" class="totalrowodd">
              <td class="border_1" width="30%">Date</td>
              <td class="border_1" width="65%">Subject</td>
              <td class="border_1" width="5%">Insert</td>
            </tr>
            {foreach key=id item=arr from=$process_arr}
            <tr align="left" class="roweven">
              <td class="border_1" nowrap="nowrap"><span style="font-size:16px;font-weight:bolder; color:#990000">{if $arr.done eq 1}&radic;{else}?{/if}</span> {$arr.date} </td>
              <td class="border_1"><span style="cursor:pointer; text-decoration:underline;"  onClick="window.open('client_homeloan_process.php?hid={$hid}&pid={$arr.id}&cid={$cid}','_blank', 'alwaysRaised=yes,resizable=yes,scrollbars=yes,width=500,height=380')">{$arr.subject}</span></td>
              <td class="border_1"><img src="../images/arr_down.gif" style="cursor:pointer" onClick="window.open('client_homeloan_process.php?hid={$hid}&cid={$cid}&isOther=1','_blank', 'alwaysRaised=yes,resizable=yes,scrollbars=yes,width=500,height=380')"></td>
            </tr>
            {/foreach}
          </table>
       </td>      
    </tr>
    <tr>
      <td colspan="2" class="greybg">&nbsp;</td>
    </tr>
  </table>
</form>
{literal}
<script type="text/javascript">
	$('#t_fdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });        
	$('#t_tdate').datepicker({ dateFormat: "yy-mm-dd" , changeMonth: true, changeYear: true});
  $('#t_codate').datepicker({ dateFormat: "yy-mm-dd" , changeMonth: true, changeYear: true});
  $('#t_discountdate').datepicker({ dateFormat: "yy-mm-dd" , changeMonth: true, changeYear: true});	
  function new_lend(obj){
      $('#lend_cate').html($(obj).find('option:checked').attr('cate'));
      $('#t_cr').val($(obj).find('option:checked').attr('cr'));
      $('#t_cr_show').text($(obj).find('option:checked').attr('cr'));
      calcul_comm();
      $.getJSON('lending_staff.php?act=dl&lid=' + $(obj).val(), function(data){
          $('#lend_staff').empty();
          if (data != null) {
              $.each(data, function(i, n){
                   $('#lend_staff').append($("<option></option>").attr("value", i).text(n.name));
              });  

              if (data.length == 0)
                  $('#lend_staff').append($("<option></option>").attr("value", 0).text("Choose a lending staff"));
          }  
      });
  }

  function calcul_comm() {
       var amount = parseFloat($('#t_amount').val().split(',').join(""));
       $('#t_comm').text( amount * $('#t_cr').val()/100 + ' (GST: ' + Math.round(amount * $('#t_cr').val()/100 *0.1) +')');
  }
</script>
{/literal}	