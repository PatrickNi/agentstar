<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Configration</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<script language="javascript" src="../js/calendar.js"></script>
<script language="javascript">{$msg_alert}</script>
<body>
<form method="post" name="form1" action="" target="_self" onSubmit="return isDelete()">
<input type="hidden" name="cid" value="{$cid}">
<input type="hidden" name="courseid" value="{$courseid}">
<input type="hidden" name="isChange" value="0">
			<table border="0" width="100%" cellpadding="1" cellspacing="1">
				<tr><td colspan="2"><table cellpadding="0" cellspacing="0" width="100%">
					<tr align="center"  class="greybg">
						<input type="hidden" name="bt_name" value="">
						<td align="center" class="whitetext">Apply Course Detail</td>		
					</tr>
				</table></td></tr>				
				<tr>
					<td width="58%">
						<table border="0" width="100%" cellpadding="3" cellspacing="1">
								<tr>
									<td width="28%" align="left" style="color:#FF0000" class="rowodd"><strong>Status:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven">
										<select name="done" style=" font-weight:bold;color:#FF0000" onChange="this.form.t_key.focus();refuse(this.value,'rf', 't_rf')">
											<option value="0" {if $dt_arr.active eq 0} selected {/if}>N/A</option>
											<option value="1" {if $dt_arr.active eq 1} selected {/if}>Active</option>
											<option value="2" {if $dt_arr.active eq 2} selected {/if}>Refused</option>
										</select>
									</td>
								</tr>
								<tr id="rf" style="{if $dt_arr.active neq 2}display:none;{/if}">
									<td width="28%" align="left" style="color:#FF0000" class="rowodd"><strong>Refuse Reason:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%"  class="roweven">
										<textarea name="t_rf" style="width:300px; height:100px " {if $dt_arr.active neq 2}disabled{/if}>{$dt_arr.refuse}</textarea>
									</td>
								</tr>								
								<tr>
									<td colspan="2"><hr></td>
								</tr>
								<tr>	
									<td width="28%" align="left" class="rowodd"><strong>Category Of Institute:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven">
                                      <select name="t_cate" onChange="this.form.isChange.value=1;this.form.submit();">
										{foreach key=id item=name from=$cate_arr}
                                        	<option value="{$id}" {if $id eq $dt_arr.catid} selected {/if}>{$name}</option>
										{/foreach}
										{if  not array_key_exists($dt_arr.catid, $cate_arr)}<option value="0" selected>choose category</option>{/if}
                                      </select>
									</td>
								</tr>																																
								<tr>	
									<td width="28%" align="left" class="rowodd"><strong>Institute:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven">
                                      <select name="t_school" onChange="this.form.isChange.value=1;this.form.submit();">
										{foreach key=sc_id item=sc_name from=$sc_arr}
                                        	<option value="{$sc_id}" {if $sc_id eq $dt_arr.iid} selected {/if}>{$sc_name}</option>
										{/foreach}
										{if not array_key_exists($dt_arr.iid, $sc_arr)}<option value="0" selected>choose institute</option>{/if}
                                      </select>
									</td>
								</tr>
								<tr>
									<td width="28%" align="left" class="rowodd"><strong>Qualification:</strong>&nbsp;&nbsp;</td>
								  	<td align="left" width="72%" class="roweven">
										<select name="t_qual" onChange="this.form.isChange.value=1;this.form.submit();">
										{foreach key=id item=qual from=$qual_arr}
											<option value="{$id}" {if $id eq $dt_arr.qual} selected {/if}>{$qual}</option>
										{/foreach}
										{if not array_key_exists($dt_arr.qual, $qual_arr)}<option value="0" selected>choose qualification</option>{/if}
										</select>
								    </td>
								</tr>
								<tr>
									<td width="28%" align="left"class="rowodd"><strong>Major:</strong>&nbsp;&nbsp;</td>
									  <td align="left" width="72%" class="roweven">
	                                    <select name="t_major" onChange="this.form.t_key.focus();">
										  {foreach key=id item=major from=$major_arr}	
	                                      	<option value="{$id}" {if $id eq $dt_arr.major} selected {/if}>{$major}</option>
										  {/foreach}
										  {if not array_key_exists($dt_arr.major, $major_arr)}<option value="0" selected>choose major</option>{/if}
	                                    </select>
									  </td>
								</tr>
								<tr>
									<td width="28%" align="left" class="rowodd"><strong>To top-agent :</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven">
                                      <select name="t_agent" onChange="this.form.t_key.focus();">
										{foreach key=ag_id item=ag_name from=$agent_arr}
	                                        <option value="{$ag_id}" {if $ag_id eq $dt_arr.agent} selected {/if}>{$ag_name}</option>   
										{/foreach}
											<option value="0" {if $dt_arr.agent lt 1 }selected{/if}>N/A</option>
                                      </select>
									</td>
								</tr>											
								<tr>
									<td colspan="2"><hr></td>
								</tr>	
								<tr>
									<td width="28%" align="left" class="rowodd"><strong>Key Point:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven">
										<textarea name="t_key" style="width:350px; height:150px ">{$dt_arr.key}</textarea>
									</td>
								</tr>								
								<tr>
									<td colspan="2"><hr></td>
								</tr>												
								<tr>
									<td width="28%" align="left" class="rowodd"><strong>Course Start Date:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven"><input type="text" name="t_fdate" value="{$dt_arr.start}" size="30" onDblClick="calendar()" onChange="audit_date(this)"></td>
								</tr>
								<tr>
									<td width="28%" align="left"class="rowodd" ><strong>Course Complete Date:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven"><input type="text" name="t_tdate" value="{$dt_arr.end}" size="30" onDblClick="calendar()" onChange="audit_date(this)" ></td>
								</tr>
								<tr>
									<td width="28%" align="left" class="rowodd"><strong>Tution Fee:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven"><input type="text" name="t_fee" value="{$dt_arr.fee}" size="30" onChange="audit_money(this)"></td>
								</tr>
								<tr>
									<td width="28%" align="left" class="rowodd"><strong>Duration:</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven">
										<input type="text" name="t_due" value="{$dt_arr.due}" size="10" onChange="audit_number(this)">&nbsp;&nbsp;
										<select name="t_unit" onChange="this.form.t_appfee.focus();">
											<option value="year" {if $dt_arr.unit eq 'year'} selected {/if}>year</option>
											<option value="month" {if $dt_arr.unit eq 'month'} selected {/if}>month</option>
										</select>
									</td>
								</tr>
																																										
								<tr>
									<td colspan="2"><hr></td>
								</tr>	
								<tr>
									<td width="28%" align="left" class="rowodd"><strong>Apply Fee :</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven"><input type="text" name="t_appfee" value="{$dt_arr.appfee}" size="30" onChange="audit_money(this)"></td>
								</tr>
								<tr>
									<td width="28%" align="left"class="rowodd"><strong>To Us Date :</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven"><input type="text" name="t_tusdate" value="{$dt_arr.tusdate}" size="30" onDblClick="calendar()" onChange="audit_date(this)"></td>
								</tr>	
								<tr>
									<td width="28%" align="left" class="rowodd"><strong>To School Date :</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven"><input type="text" name="t_tsdate" value="{$dt_arr.tsdate}" size="30" onDblClick="calendar()" onChange="audit_date(this)"></td>
								</tr>
								<tr>
									<td width="28%" align="left" class="rowodd"><strong>Method :</strong>&nbsp;&nbsp;</td>
									<td align="left" width="72%" class="roweven">
										<select name="t_method" onChange="this.form.t_key.focus()">
										{foreach key=id item=method from=$method_arr}
											<option value="{$id}" {if $id eq $dt_arr.method} selected {/if}>{$method}</option>
										{/foreach}
										{if $dt_arr.method lt 1}<option value="0" selected>select a method</option>{/if}
										</select>							
									</td>
								</tr>																	
						</table>
				  </td>
					<td width="42%" align="left" valign="top">  
							<div style="height:300px; overflow-Y:auto;">
									<table width="100%" border="0" cellpadding="0" cellspacing="0">
									<tr class="greybg">
											<td colspan="4" class="whitetext" align="center">Process</td>				
									</tr>
									<tr align="center" class="totalrowodd">
										<td class="border_1" width="26%">Date</td>
										<td class="border_1" width="67%">Subject</td>
										<td class="border_1" width="7%">Insert</td>
									</tr>
									{foreach key=id item=arr from=$process_arr}
									<tr align="left" class="roweven">
										<td class="border_1" nowrap="nowrap">
											<span style="font-size:16px;font-weight:bolder; color:#990000">{if $arr.done eq 1}&radic;{else}?{/if}</span>
											{$arr.date}
										</td>
										<td class="border_1"><span style="cursor:pointer; text-decoration:underline;" >{if $arr.subject eq 0}{$arr.add}{else}{if $arr.auto eq 1}AUTO:{/if}{$item_arr[$arr.subject].name}{/if}</span></td>
										<td class="border_1"><img src="../images/arr_down.gif" style="cursor:pointer"></td>
									</tr>
									{/foreach}							
								</table>
						</div>
				  </td>
				</tr>
				<tr><td colspan="2" class="greybg">&nbsp;</td></tr>	
 		  </table>					
</form>	
