<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star - Legal Service</title>
</head>

<link rel="stylesheet" href="../css/sam.css">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
<script language="javascript" src="../js/audit.js?v1"></script>
{$msg}
<body>

<form method="get" id="form1" name="form1" action="/scripts/client_legal_detail.php" target="_self" onSubmit="return isDelete()"> 
  <input type="hidden" name="cid" value="{$cid}"> 
  <input type="hidden" name="vid" id="vid" value="{$vid}"> 
  <input type="hidden" name="hCancel" value="0"> 
  
  <table border="0" width="95%" cellpadding="2" cellspacing="3"> 
	  <tr><td colspan="2">
      <table cellpadding="0" cellspacing="0" width="100%">
    	  <tr align="center"  class="greybg">
    		  <input type="hidden" name="bt_name" id="bt_name" value="">
    		  <td align="left" width="10%">
    			  {if $ugs.v_visa.d eq 1}
    			  <input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">&nbsp;&nbsp;&nbsp;
    			  {/if}
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
      <td align="left" style="font-size:16px " colspan="2" onClick="javascript:window.location.href='client_legal.php?cid={$cid}'" onMouseMove="javascript:this.style.cursor='pointer'; this.style.backgroundColor='#000'"; onMouseOut="javascript:this.style.backgroundColor='#a3a3a3'"> <span class="highyellow">Client: {$client.lname} {$client.fname}</span>&nbsp;&nbsp; <span class="highyellow">DoB: {$client.dob}</span>&nbsp;&nbsp;<span class="highyellow">Main Visa: {$client.visa_n}-{$client.class_n}, expr: {$client.epdate}</span>&nbsp;&nbsp; 
      </td> 
    </tr> 
    <tr> 
      <td width="60%" align="left" valign="top"> 
        <table border="0" width="100%" cellpadding="3" cellspacing="1"> 
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Status</strong></td> 
            <td align="left" width="64%" class="roweven">
				      <select name="t_status" class="highlighttext">
  				    {foreach key=id item=st from=$status}
  					    <option value="{$st}" {if $st eq $dt_arr.status} selected {/if}>{$st|ucwords}</option>
  				    {/foreach}
  				    </select>
  			     </td> 
          </tr>	  	  
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Legal Category:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven"> 
              <select name="t_cate" onChange="new_lend(this);">  
                  {foreach key=id item=cate_name from=$cate_arr}
                       <option value="{$id}" {if $id eq $dt_arr.cateid} selected {/if}>{$cate_name}</option>
                  {/foreach}
                  {if  not array_key_exists($dt_arr.cateid, $cate_arr)}
                      <option value="0" selected>Choose legal category</option>
                  {/if}                  
              </select>
			      </td> 
          </tr> 
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Type:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven"> 
                <select name="t_type" id="subclass"> 
                {if array_key_exists($dt_arr.cateid, $type_arr)}
                {foreach key=id item=class from=$type_arr[$dt_arr.cateid]}
                  <option value="{$id}" {if $id eq $dt_arr.subid} selected {/if}>{$class}</option>
                {/foreach}
                {/if}
                {if $dt_arr.subid eq 0} 
                  <option value="0" selected>Choose a type</option>
                {/if}
                </select>		
			      </td> 
          </tr> 		  		  		  		  
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Agreement Staff:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven"> 
                <select name="t_auser" >
                {foreach key=id item=name from=$user_arr}
                  <option  value="{$id}" {if $dt_arr.auser eq $id} selected {/if}>{$name}</option>
                {/foreach}
                {if $dt_arr.auser lt 1}
                  <option  value="0" selected >select a user</option>
                {/if}
              </select>   		
			      </td> 
          </tr> 
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Legal Paperwork:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven"> 
                <select name="t_vuser" >
                {foreach key=id item=name from=$user_arr}
                  <option  value="{$id}" {if $dt_arr.vuser eq $id} selected {/if}>{$name}</option>
                {/foreach}
                {if $dt_arr.vuser lt 1}
                  <option  value="0" selected >select a user</option>
                {/if}
              </select>  	
            </td> 
          </tr>
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Consult Date:</strong></td> 
            <td align="left" width="64%" class="roweven"><input type="text" name="t_first" id="t_first" size="30" value='{$dt_arr.vdate}'>
              
            </td> 
          </tr>           
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Agreement Date:</strong></td> 
            <td align="left" width="64%" class="roweven"><input type="text" name="t_adate" id="t_adate" size="30" value='{$dt_arr.adate}'>
              
            </td> 
          </tr>             
          <tr><td colspan="2"><hr/></td></tr>                     <tr>
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
{assign var="total_profit" value="0"}
                    {foreach key=id item=arr from=$account_arr}
                    <tr align="center" class="roweven">
                        <td style="text-decoration:underline; cursor:pointer" onClick="window.open('client_account_detail.php?vid={$vid}&aid={$id}&cid={$cid}&typ=legal','_blank', 'alwaysRaised=yes,height=500, width=800,location=no,scrollbars=yes')" >{$arr.step|ucwords}</td>
                        <td align="right">{$arr.dueamt|string_format:"%.2f"}</td>
                        <td align="right">{$arr.gst|string_format:"%.2f"}</td>
                        <td align="right"><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_payment.php?aid={$id}','_blank', 'alwaysRaised=yes,height=500,width=800,location=no,scrollbars=yes')">{$arr.paid|string_format:"%.2f"}</span></td>
                        <td>{$arr.party|ucwords}</td>
                        <td align="right">{$arr.dueamt_3rd|string_format:"%.2f"}</td>
                        <td>{$arr.gst_3rd|string_format:"%.2f"}</td>
                        <td align="right"><span style="text-decoration:underline; cursor:pointer;" onClick="window.open('client_spand.php?aid={$id}','_blank', 'alwaysRaised=yes,height=500,width=800,location=no,scrollbars=yes')">{$arr.spand|string_format:"%.2f"}</span></td>
                        <td align="right">
                            {$arr.paid-$arr.dueamt_3rd|string_format:"%.2f"}
                            {assign var="total_profit" value=$total_profit+$arr.paid-$arr.dueamt_3rd}
                        </td>
                    </tr>
                    {/foreach}
                    <tr align="center" class="roweven">
                        <td align="right" colspan="8">Total Profit</td>
                        <td align="right"><strong>{$total_profit|string_format:"%.2f"}</strong></td>
                    </tr>    
                    <tr align="center" class="roweven">
                        <td colspan="9" align="center">
                          {if $vid > 0}
                          <input type="button" value="Add new" onclick="window.open('client_account_detail.php?cid={$cid}&vid={$vid}&typ=legal','_blank', 'alwaysRaised=yes,height=500,width=800,location=no,scrollbars=yes')" />
                          {/if}
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
        <div style="width:100%;overflow-X:auto; overflow-Y:auto;"> 
            <table border="0" cellpadding="0" cellspacing="0" width="100%"> 
              <tr class="greybg"> 
                <td colspan="4" class="whitetext" align="center">Process &nbsp; 
                     {if $vid > 0 }
                          <input type="button" value="add new" style="font-weight:bold" onClick="window.open('client_legal_process.php?vid={$vid}&cid={$cid}&isNew=1','_blank','alwaysRaised=yes,height=500,width=800, location=no')">
                     {/if}
                  </td> 
              </tr> 
              <tr align="center" class="totalrowodd"> 
                <td class="border_1" width="33%">Date</td> 
                <td class="border_1" width="60%">Subject</td> 
                <td class="border_1" width="7%">Insert</td> 
              </tr> 
              {foreach key=id item=arr from=$process_arr}
              <tr align="left" class="roweven"> 
                <td class="border_1"><span style="font-size:16px;font-weight:bolder; color:#990000">{if $arr.done eq 1}&radic;{else}?{/if}</span>{$arr.date}</td> 
                <td class="border_1"><span style="cursor:pointer; text-decoration:underline;" onClick="window.open('client_legal_process.php?vid={$vid}&pid={$arr.pid}&cid={$cid}','_blank','alwaysRaised=yes,height=500,width=800, location=no')">{$arr.subject}</span></td>
                <td class="border_1"><img src="../images/arr_down.gif" style="cursor:pointer" onClick="window.open('client_legal_process.php?vid={$vid}&pid={$arr.pid}&cid={$cid}&isNew=1&isOther=1','_blank','alwaysRaised=yes,height=500,width=800, location=no')"></td> 
              </tr> 
              {/foreach}
            </table> 
          </div>
          <hr/>     		
    	</td> 
    </tr>
    <tr>
        <td align="left" class="roweven">
             <strong>Note</strong>
          <textarea style="width:100%; height:100% " name="t_note" rows="30">{$dt_arr.note}</textarea>
        </td>        
    </tr>    
	<tr class="greybg"><td colspan="2">&nbsp;</td></tr>
  </table> 
</form> 

{literal}
<script type="text/javascript">      
	$('#t_first').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
  $('#t_adate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });

    function save_visa(obj,close_w){
        $('#bt_name').val('save');
        btn_n = $(obj).val();
        $(obj).val('waiting...');
        //ContentType UTF-8
        $.post($('#form1').attr('action'), $('#form1').serialize(), function(data){
            rtn = $.parseJSON(data);
            
            $(obj).val(btn_n);
            if (rtn.id > 0)
                $('#vid').val(rtn.id);
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
                  window.location.href = window.location.href + '&vid=' + rtn.id;    
                else
                  window.location.reload();
            }
        });
    }

    function new_lend(obj){
      $.getJSON('client_legal_detail.php?act=subclass&cateid=' + $(obj).val(), function(data){
          $('#subclass').empty();
          if (data != null) {
              $.each(data, function(i, n){
                   $('#subclass').append($("<option></option>").attr("value", i).text(n));
              });  

              if (data.length == 0){
                  $('#subclass').append($("<option></option>").attr("value", 0).text("Choose a type"));
              }
          }
      });
    }
</script>
{/literal}	