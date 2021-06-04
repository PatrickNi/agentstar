<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<title>Agent Star - Coach Service</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
{include file="style.tpl"}
<body>
<form name="form1" action="" target="_self" method="get">
<input type="hidden" name="cid" value="{$cid}">
<table align="center" class="graybordertable" width="100%" cellpadding="0" cellspacing="0">
    <tr align="left"  class="bordered_2">
        <td colspan="9">
         {if $ugs.b_service.v eq 1}
            <input style="font-weight:bold;" type="button" value="Client Detail" onClick="javascript:this.form.action='client_detail.php';this.form.submit();">&nbsp;&nbsp;
            <input style="font-weight:bold;" type="button" value="EDU Background" onClick="javascript:this.form.action='client_qual.php';this.form.submit();">&nbsp;&nbsp;
            <input style="font-weight:bold;" type="button" value="Working experience" onClick="javascript:this.form.action='client_workexp.php';this.form.submit();">&nbsp;&nbsp;
            <input style="font-weight:bold;" type="button" value="Service" onClick="javascript:this.form.action='client_service.php';this.form.submit();">&nbsp;&nbsp;
        {/if}
        {if in_array('study', $client_type) && $ugs.c_service.v eq 1}
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_course.php';this.form.submit();" value="Apply Course">
        &nbsp;&nbsp; 
        {/if} 
        {if in_array('immi', $client_type) && $ugs.v_service.v eq 1}
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_visa.php';this.form.submit();" value="Visa Service">
        &nbsp;&nbsp; 
        {/if} 
        {if in_array('homeloan', $client_type)}
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_homeloan.php';this.form.submit();" value="Home Loan">
        &nbsp;&nbsp; 
        {/if}   
        {if in_array('legal', $client_type)}
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_legal.php';this.form.submit();" value="Legal Service">
        &nbsp;&nbsp; 
        {/if}          
        <input name="button" type="button" style="font-weight:bold;" onClick="javascript:this.form.action='client_coach.php';this.form.submit();" value="Coach Service"> 
        </td>
    </tr>
    <tr align="center"  class="greybg" >
        <td class="whitetext" colspan="9" style="padding:3 ">Client Coach Service
            &nbsp;&nbsp;&nbsp;&nbsp;
            <span style="font-weight:bold; font-size:10px; color:#0066FF; cursor:pointer; text-decoration:underline" onClick="window.open('client_coach_detail.php?cid={$cid}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">Add new schedule</span>
        </td>
    </tr>
    <tr align="center"  class="greybg" >
        <td align="left" style="font-size:16px " colspan="9"> <span class="highyellow">Client: {$client.lname} {$client.fname}</span>&nbsp;&nbsp; <span class="highyellow">DoB: {$client.dob}</span>&nbsp;&nbsp;<span class="highyellow">Main Visa: {$client.visa_n}-{$client.class_n}, expr: {$client.epdate}</span></td>
    </tr>       
    <tr align="center" class="totalrowodd">
        <td class="border_1">Course</td>
        <td class="border_1">Subject</td>
        <td class="border_1">Grade</td>
        <td class="border_1">Teacher</td>
        <td class="border_1">&nbsp;</td>
    </tr>
    {foreach key=id item=arr from=$coach_arr}
    <tr align="center" class="roweven" >
        <td class="border_1"><span style="cursor:pointer;" onClick="window.open('client_coach_detail.php?cid={$cid}&coachid={$id}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth='+screen.height*6/7 +',width='+screen.width*6/7)">
        {assign var="partnerid" value=$items_arr[$arr.itemid].pid}
        {$items_arr[$partnerid].tit}&nbsp;&nbsp;</span></td>
        <td class="border_1">{$items_arr[$arr.itemid].tit}</td>
        <td class="border_1">{$grade_arr[$arr.grade]}</td>
        <td class="border_1">{$user_arr[$arr.staff]}</td>
        <td class="border_1">&nbsp;</td>                       
    </tr>
    {if count($lesson_arr[$id]) > 0}
        <tr style="font-weight:bolder;" align="center" class="yellowbg">
            <td class="border_1" >Lesson</td>
            <td class="border_1" >Date</td>
            <td class="border_1" >Week</td>
            <td class="border_1" >Fee</td>
            <td class="border_1" >Status</td>
        </tr>
        {assign var="lesson_no" value="0"}
        {foreach key=lessonid item=larr from=$lesson_arr[$id]}
        {assign var="lesson_no" value=$lesson_no+1}
        <tr class="yellowbg" align="center">
            <td class="border_1" >Lesson {$lesson_no}</td>
            <td class="border_1">{$larr.startdate}</td>
            <td class="border_1">{$larr.week}&nbsp;&nbsp;{$larr.starttime}&nbsp;&nbsp;{$larr.duehour/60}(hours)</td>
            <td class="border_1" align="right">${$larr.fee}</td>
            <td class="border_1"> <a href="#" style="cursor:pointer;" onClick="window.open('client_lesson_detail.php?cid={$cid}&coachid={$id}&lessonid={$lessonid}','_blank','alwaysRaised=yes,resizable=yes,scrollbars=yes,'+'heigth=300,width=500')">{$larr.status}</a></td>
        </tr>        
        {/foreach}
    {/if}
    {/foreach}
</table>
</form>

<script type="text/javascript">
{literal}
      
function complete_lesson(obj,coachid,lessonid){
    btn_n = $(obj).val();
    $(obj).val('waiting...');
    //ContentType UTF-8
    $.post('/scripts/client_coach_detail.php', '&coachid='+coachid+'&lessonid='+lessonid+'&bt_name='+btn_n, function(data){
        console.log(data);
        rtn = $.parseJSON(data);           
        $(obj).val(btn_n);
        alert(rtn.msg);
        window.location.reload();
        
    });
}
{/literal}
</script>