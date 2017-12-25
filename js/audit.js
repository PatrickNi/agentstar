function isDelete()
{
	obj = document.getElementsByName('bt_name');
	if(obj.length == 1 && obj[0].value == 'delete')
	{
		var is_del = confirm("Do you want to delete it?");
		if(is_del)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	return true;
}


function form_audit(names)
{
	obj = document.getElementsByName(names);
	if(obj[0].hCancel.value == 1)
	{
		return true;
	}
	inputs = document.getElementsByTagName("input");
	if(inputs.length < 0)
	{
		return false;
	}
	for(i=0; i<inputs.length; i++)
	{
		if(inputs[i].type == 'text' && inputs[i].value == "" && inputs[i].disabled == false)
		{
			alert("Please input a correct content!");
			return false;	
			break;
		}
	}
}

function client_audit(obj)
{
	inputs = document.getElementsByTagName("input");	
	if(inputs.length < 0)
	{
		return false;
	}
	para = "^t_c_";
	for(i=0; i<inputs.length; i++)
	{
		if(inputs[i].type == 'text' && inputs[i].value == "" && inputs[i].name.match(para) == null)
		{
			alert("Please input a correct content!");
			return false;
		}
	}
	return true;
}

function has_contact(hStatus)
{
	inputs = document.getElementsByTagName("input");
	hStatus = !hStatus
	if(inputs.length < 0)
	{
		return false;
	}
	para = "^t_c_";
	for(i=0; i<inputs.length; i++)
	{
		if(inputs[i].name.match(para) != null)
		{
			inputs[i].disabled = hStatus;
		}
	}
}

function audit_email(str)
{
	para = '^[\\.a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+\\.[a-zA-Z0-9_-]+[.]*[a-zA-Z0-9_-]+$';
	if(str.match(para) == null)
	{
		alert("Incorrect Email Format");
		return false;
	}
}

function audit_date(obj)
{
	para = '^[0-9]{4}-[0-9]{2}-[0-9]{2}$';
	if(obj.value.match(para) == null)
	{	
		alert("Incorrect Date Format !");
		obj.value = '';
		obj.select();
		return false;
	}
}

function audit_money(obj)
{
	num = obj.value;
	para = '^[0-9]+[.]*[0-9]*$';
	if(num.match(para) == null)
	{
		alert("Incorrect Number Format");
		obj.value = "";
		obj.style.background = "#FFCC99"
		return false;
	}else{
		obj.style.background = "";
	}
}

function audit_number(obj)
{
	num = obj.value
	para = '^[0-9]+$';
	if(num != "" && num.match(para) == null)
	{
		alert("Incorrect Number Format");
		obj.value = "";
		obj.style.background = "#FFCC99"
		return false;		
	}else{
		obj.style.background = "";
	}
}


function open_fold(tagname)
{
	names = document.getElementsByTagName("TR");
	if(names.length <= 0)
	{
		return false;
	}

	for(i=0; i<names.length; i++)
	{
		if(names[i].name == tagname && names[i].style.display == "none")
		{
			names[i].style.display = "block";
		}
		else if(names[i].name == tagname)
		{
			names[i].style.display = "none";
		}
	}
}

function openExModel(filename,width,height,resizable,names)
{
	formobj = document.getElementsByName(names);
	var rtn = window.showModalDialog('ExModel.htm',filename,"dialogHeight: "+height+"px; dialogWidth: "+width+"px; dialogTop: px; dialogLeft: px; edge: Raised; center: Yes; help: No; resizable: "+resizable+"; status: No;");
	if(rtn > 0)
	{
		formobj[0].submit();
	}
}

function openModel(filename,width,height,resizable,names,newsave)
{
	formobj = document.getElementsByName(names);
	var rtn = window.showModalDialog('IEModel.htm',filename,"dialogHeight: "+height+"px; dialogWidth: "+width+"px; dialogTop: px; dialogLeft: px; edge: Raised; center: Yes; help: No; resizable: "+resizable+"; status: No;");
	if(rtn > 0)
	{
		if(newsave != undefined){
			formobj[0].bt_name.value=newsave;
		}
		formobj[0].submit();
	}
}

function openModelFrame(filename,width,height,resizable,names)
{
	frame = document.getElementById(names);
	var rtn = window.showModalDialog('IEModel.htm',filename,"dialogHeight: "+height+"px; dialogWidth: "+width+"px; dialogTop: px; dialogLeft: px; edge: Raised; center: Yes; help: No; resizable: "+resizable+"; status: No;");
	if(rtn > 0)
	{
		frame.src = frame.src;
	}
}

function openModelless(filename,width,height,resizable,names)
{
	formobj = document.getElementsByName(names);
	var rtn = window.showModelessDialog('IEModel.htm',filename,"dialogHeight: "+height+"px; dialogWidth: "+width+"px; dialogTop: px; dialogLeft: px; edge: Raised; center: Yes; help: No; resizable: "+resizable+"; status: No;");
	//var rtn = window.showModelessDialog('IEModel.htm',filename,"dialogHeight: "+height+"px; dialogWidth: "+width+"px; dialogTop: px; dialogLeft: px; edge: Raised; center: Yes; help: No; resizable: "+resizable+"; status: No;");
	if(rtn > 0)
	{
		formobj[0].submit();
	}
}

function openModelNoform(filename,width,height,resizable)
{
	window.showModelessDialog('IEModel.htm',filename,"dialogHeight: "+height+"px; dialogWidth: "+width+"px; dialogTop: px; dialogLeft: px; edge: Raised; center: Yes; help: No; resizable: "+resizable+"; status: No;");
}


function refuse(value, trid, txtnames)
{
	trobj = document.getElementById(trid);
	txtobj = document.getElementsByName(txtnames);
	if(value == 2)
	{
		txtobj[0].disabled = false;
		trobj.style.display = "block";
	}
	else
	{
		txtobj[0].disabled = true;
		trobj.style.display = "none";		
	}
}

function setPayment(obj)
{
	var paydate = document.getElementById('d_'+obj.value).innerText;
	var payamount = document.getElementById('a_'+obj.value).innerText;
	var remark = document.getElementById('r_'+obj.value).value;
    document.getElementById('t_date').value = paydate;
	document.getElementById('t_paid').value = payamount;
	document.getElementById('t_remark').value = remark;
	document.getElementById('t_new').checked = false;
}

function newPayment(obj)
{
	if(obj.checked)
	{
		var arr = document.getElementsByName('pid');
		if(arr.length <= 0)
		{
			return false;
		}
		for(i=0; i<arr.length; i++)
		{
			arr[i].checked = false;
		}
		document.getElementById('t_date').value = "";
		document.getElementById('t_paid').value = "";
		document.getElementById('t_remark').value = "";	
	}
}

function openClientPage(cid)
{
	window.open('client_detail.php?cid='+cid,'','height='+screen.width*4/5+','+'width='+screen.width*4/5);
}

function openSchoolPage(iid)
{
	window.open('institute_detail.php?sid='+iid,'','height='+screen.width*4/5+','+'width='+screen.width*4/5);
}
function openAgentPage(aid)
{
	window.open('agent_add.php?aid='+aid,'','height='+screen.width*4/5+','+'width='+screen.width*4/5);
}

function openinSatff(idstr)
{
	obj = document.getElementById(idstr);
	obj.style.display = '';
}

function printPage(){
	if(window.print != null){
		window.print();
	}else{
		alert('Please install the printer');   
	}	
}

function selectAll(objname, selfobj)
{
	obj = document.getElementsByName(objname);
	if(obj.length == 0) return;
	for(i=0;i<obj.length;i++)
	{
		obj[i].checked = selfobj.checked;
	}
}
