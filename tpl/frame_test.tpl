<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Agent Star -Immigration System</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<link href="../css/sam.css" rel="stylesheet" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Agent Star - TODO</title>
</head>
<body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/js/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<input type="hidden" id="uid" value="{$uid}">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
 <tr height="70" >
  <td width="192" align="center" valign="middle"><img src="../images/fox.gif" /></td>
  <td width="4"></td>

  <td width="" valign="bottom"><div style="margin:4px">User: <span class="orange">{$user_name}</span></div></td>
  <td width="100" align="right" valign="bottom"><a class="blue" href="login.php" target="_top" onclick="javascript:location.replace(this.href);event.returnValue=false;">login out</a></td>
 </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 4px">
 <tr height="20">
  <td align="center" width="192" class="bar"><b><a href="/migration/" class="home">HOME</a></b></td>
  <td width="4"></td>

  <td width="" class="navigation">&nbsp;&nbsp;<span class="white">Navigation:</span>&nbsp;&nbsp;<span class="orange">{if $gid gt 0}{$group_name} > {$func_name}{/if}</span></td>
 </tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
 <tr>
  <td width="192" align="center" valign="top">
  	<table height="100%" border="0" cellpadding="0" cellspacing="0" summary="menu">
		<tr><td height="10%" valign="top">
			<div id="menuDiv">
			{foreach key=groupId item=arr from=$grouArr}
			    <div class="menuPater" onClick="openMenu('{$groupId}')"><div class="menuTitle white">{$arr.name}</div></div>
			 	<span id="{$groupId}" class="menuClick" {if $groupId neq $gid}style="display:none;"{/if}>
				<ul class="menuSub">
			   	{foreach key=funcId item=func from=$arr.func}
 					<li><a href="{$func.url}">{$func.name}{if $func.name|lower == 'task'&& $task_num > 0}&nbsp;&nbsp;<strong style="color:#FF0000 ">Undo: {$task_num}</strong>{/if}</a></li>
				{/foreach}
				</ul>
			   </span>
			{/foreach} 
			</div>
		</td></tr>
	</table>
  </td>	
  <td width="4"></td>
  <td align="center" valign="top">  
    <iframe  name="dataFrame"  frameborder="0" width="100%" height="600" scrolling="auto" src="{$url}"></iframe>
  </td>
 </tr>
 <tr><td colspan="3"><hr   class="navigation" /></td></tr>
</table>
<br />
  <!-- Modal -->
<div class="modal fade" id="remind_pannel" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
      <div class="modal-body">
      </div>
  </div>
  </div>
</div>

</body>
{if $ugs.todo_alert.v eq 1} 
{literal}
<script type="text/javascript">
    Date.prototype.format = function(format) {
       var date = {
              "M+": this.getMonth() + 1,
              "d+": this.getDate(),
              "h+": this.getHours(),
              "m+": this.getMinutes(),
              "s+": this.getSeconds(),
              "q+": Math.floor((this.getMonth() + 3) / 3),
              "S+": this.getMilliseconds()
       };
       if (/(y+)/i.test(format)) {
              format = format.replace(RegExp.$1, (this.getFullYear() + '').substr(4 - RegExp.$1.length));
       }
       for (var k in date) {
              if (new RegExp("(" + k + ")").test(format)) {
                     format = format.replace(RegExp.$1, RegExp.$1.length == 1
                            ? date[k] : ("00" + date[k]).substr(("" + date[k]).length));
              }
       }
       return format;
  }

    function sync_task(){
        $.ajax({ 
                url: '/scripts/todo_v2.php?act=reload&uid=' + $('#uid').val(),
                method: 'GET',
                success: function(rtn) {
                         }
        });
    }

    function remind_task(){
        $.ajax({ 
                url: '/scripts/todo_v2.php?act=getone',
                method: 'GET',
                success: function(rtn) {
                            if (rtn != "") {
                                $(".modal-body").html(rtn);
                                $("#remind_pannel").modal('show');
                            }
                         }
        });
    }

    function update_task(act, id){
      var postdata = {'act':act, 'id':id}
      if (act == "remind") {
          var newDate = new Date();
          newDate.setTime(Date.parse(new Date()) + $('#remind_duetime').val() * 3600 * 1000);
          postdata['dt'] =  newDate.format('yyyy-MM-dd h:m:s');
      }

       $.ajax({ 
                url: '/scripts/todo_v2.php',
                dataType: 'json',
                method: 'POST',
                data: postdata,
                success: function(rtn) {
                            alert("Operation sucess, refresh page soon!");
                            if (rtn.succ == 1) {
                                $("#remind_pannel").modal('hide');
                                $(".modal-body").html('');                        
                            }
                            else {
                                alert('Operated Failed!');
                            }
                         }
        });
  }
  setTimeout("remind_task()", 300000);
  setTimeout("sync_task()", 150000);
</script>
{/literal}
{/if}
</html>  