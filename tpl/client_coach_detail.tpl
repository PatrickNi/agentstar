<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star - Coach Service</title>
</head>

<link rel="stylesheet" href="../css/sam.css">

{include file="style.tpl"}

<script language="javascript" src="../js/audit.js?v1"></script>
{$msg}
<body>

<form method="get" id="form1" name="form1" action="/scripts/client_coach_detail.php" target="_self" onSubmit="return isDelete()"> 
  <input type="hidden" name="cid" value="{$cid}"> 
  <input type="hidden" name="coachid" id="coachid" value="{$coachid}"> 

  <table border="0" width="95%" cellpadding="2" cellspacing="3"> 
    <tr><td colspan="2">
      <table cellpadding="0" cellspacing="0" width="100%">
        <tr align="center"  class="greybg">
          <input type="hidden" name="bt_name" id="bt_name" value="">
          <td align="left" width="10%">
            <input type="submit" value="Delete" style="font-weight:bold" onClick="this.form.bt_name.value='delete';this.disable=false;">&nbsp;&nbsp;&nbsp;
          </td>         
          <td align="center" class="whitetext"> Lesson Schedule Detail </td>       
          <td align="left" width="30%">
            <input type="button" value="Save" style="font-weight:bold" onClick="save_visa(this, false);" >
            <input type="button" value="Close &amp; Refresh " style="font-weight:bold" onClick="save_visa(this, true);">
          </td>
        </tr>   
      </table>
    </td></tr>
    <tr align="center"  class="greybg" > 
      <td align="left" style="font-size:16px " colspan="2" onClick="javascript:window.location.href='client_coach.php?cid={$cid}'" onMouseMove="javascript:this.style.cursor='pointer'; this.style.backgroundColor='#000'"; onMouseOut="javascript:this.style.backgroundColor='#a3a3a3'"> <span class="highyellow">Client: {$client.lname} {$client.fname}</span>&nbsp;&nbsp; <span class="highyellow">DoB: {$client.dob}</span>&nbsp;&nbsp;<span class="highyellow">Main Visa: {$client.visa_n}-{$client.class_n}, expr: {$client.epdate}</span>&nbsp;&nbsp; 
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
                <input type="hidden" id="courseid" value="{$dt_arr.itemid}">
                {assign var="partnerid" value=$items_arr[$dt_arr.itemid].pid}
                <input type="hidden" id="catetit" value="{$items_arr[$partnerid].tit}">  
            </td> 
          </tr>
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Start Date:</strong></td> 
            <td align="left" width="64%" class="roweven"><input type="text" name="startdate" id="startdate" size="30" value='{$dt_arr.startdate}'></td> 
          </tr>           
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>End Date:</strong></td> 
            <td align="left" width="64%" class="roweven"><input type="text" name="enddate" id="enddate" size="30" value='{$dt_arr.enddate}'></td> 
          </tr>   
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Grade</strong></td> 
            <td align="left" width="64%" class="roweven">
              <select name="t_grade">
                <option value="0">n/a</option>
                {foreach key=id item=name from=$grade_arr}
                  <option value="{$id}" {if $id == $dt_arr.grade} selected {/if}>{$name}</option>
                {/foreach}
              </select>
            </td> 
          </tr> 
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>School</strong></td> 
            <td align="left" width="64%" class="roweven"><input type="text" name="t_school" id="enddate"  size="50" value='{$dt_arr.school}'></td> 
          </tr> 
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Class start & Class hours:</strong></td> 
            <td align="left" width="64%" class="roweven"> 

              <select name="starttime">
                {foreach key=id item=name from=$init_hour}
                  <option value="{$name}" {if $name eq $dt_arr.starttime} selected {/if}>{$name}</option>
                {/foreach}
              </select>&nbsp;&nbsp;


              <select name="duehour">
                {foreach key=id item=name from=$due_arr}
                  <option value="{$id}" {if $id eq $dt_arr.duehour} selected {/if}>{$name}</option>
                {/foreach}
            </select>
            </td> 
          </tr> 
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Day of Week</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven"> 
               <input type="checkbox" name="freqw[]" value="Mon" {if in_array('Mon', $dt_arr.freqw_l)}checked{/if}/>Mon&nbsp;
               <input type="checkbox" name="freqw[]" value="Tue" {if in_array('Tue', $dt_arr.freqw_l)}checked{/if}/>Tue&nbsp;
               <input type="checkbox" name="freqw[]" value="Wed" {if in_array('Wed', $dt_arr.freqw_l)}checked{/if}/>Wed&nbsp;
               <input type="checkbox" name="freqw[]" value="Thu" {if in_array('Thu', $dt_arr.freqw_l)}checked{/if}/>Thu&nbsp;
               <input type="checkbox" name="freqw[]" value="Fri" {if in_array('Fri', $dt_arr.freqw_l)}checked{/if}/>Fri&nbsp;
               <input type="checkbox" name="freqw[]" value="Sat" {if in_array('Sat', $dt_arr.freqw_l)}checked{/if}/>Sat&nbsp;
               <input type="checkbox" name="freqw[]" value="Sun" {if in_array('Sun', $dt_arr.freqw_l)}checked{/if}/>Sun&nbsp;
            </td> 
          </tr>   
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Agreement Staff:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven"> 
                <select name="sales" >
                {foreach key=id item=name from=$user_arr}
                  <option  value="{$id}" {if $dt_arr.sales eq $id} selected {/if}>{$name}</option>
                {/foreach}
                {if $dt_arr.sales lt 1}
                  <option  value="0" selected >Choose an agreement staff</option>
                {/if}
              </select>       
            </td> 
          </tr>                       
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Teacher:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven"> 
                <select name="staff" >
                {foreach key=id item=name from=$user_arr}
                  <option  value="{$id}" {if $dt_arr.staff eq $id} selected {/if}>{$name}</option>
                {/foreach}
                {if $dt_arr.staff lt 1}
                  <option  value="0" selected >Choose a teacher</option>
                {/if}
              </select>       
            </td> 
          </tr> 
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Fee(per class):</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven"> 
                <input type="text" size="10" name="fee" value="{$dt_arr.fee}">
            </td> 
          </tr>
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong>Total Deliver Hours:</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven"> 
                <strong><em>{$dt_arr.deliverhour/60|string_format:"%.1f"}</em></strong>
            </td> 
          </tr>     
          <tr> 
            <td width="36%" align="left" class="rowodd"><strong style="color:red">Save addition</strong>&nbsp;&nbsp;</td> 
            <td align="left" width="64%" class="roweven"> 
                <input type="radio" value="0" name="save_w_method"/> base info &nbsp;&nbsp;
                <input type="radio" value="2" name="save_w_method"/> update fee in lesson&nbsp;&nbsp;
                <input type="radio" value="1" name="save_w_method"/> rebuild lesson&nbsp;&nbsp;
            </td> 
          </tr>    
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
                    {assign var="total_profit" value="0"}
                    {foreach key=id item=arr from=$account_arr}
                    <tr align="center" class="roweven">
                        <td style="text-decoration:underline; cursor:pointer" onClick="window.open('client_account_detail.php?vid={$coachid}&aid={$id}&cid={$cid}&typ=coach','_blank', 'alwaysRaised=yes,height=500, width=800,location=no,scrollbars=yes')" >{$arr.step|ucwords}</td>
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
                          {if $coachid > 0}
                          <input type="button" value="Add new" onclick="window.open('client_account_detail.php?cid={$cid}&vid={$coachid}&typ=coach','_blank', 'alwaysRaised=yes,height=500,width=800,location=no,scrollbars=yes')" />
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
        <strong>Note</strong>
          <textarea style="width:100%; height:100% " name="t_note" rows="30">{$dt_arr.note}</textarea>
      </td> 
    </tr>
  <tr class="greybg"><td colspan="2">&nbsp;</td></tr>
  </table> 
</form> 


<script type="text/javascript">
{$init_courses}


{literal}
      
  $('#startdate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });
  $('#enddate').datepicker({ dateFormat: "yy-mm-dd", changeMonth: true, changeYear: true });

    function save_visa(obj,close_w){
        $('#bt_name').val('save');
        btn_n = $(obj).val();
        $(obj).val('waiting...');
        //ContentType UTF-8
        $.post($('#form1').attr('action'), $('#form1').serialize(), function(data){
            console.log(data);
            rtn = $.parseJSON(data);
            
            $(obj).val(btn_n);
            if (rtn.id > 0)
                $('#coachid').val(rtn.id);
            else {
                alert(rtn.msg);
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
                  window.location.href = window.location.href + '&coachid=' + rtn.id;    
                else
                  window.location.reload();
            }
        });
    }

  var courseid = $("#courseid").val();
  var catetit  = $('#catetit').val();
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

{/literal}  
</script>