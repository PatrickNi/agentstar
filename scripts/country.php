<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'ClientAPI.class.php');

# get course id
$coid  = isset($_REQUEST['coid'])? trim($_REQUEST['coid']) : 0;
$en_co = isset($_REQUEST['en_co'])? trim($_REQUEST['en_co']) : "";
$zh_co = isset($_REQUEST['zh_co'])? trim($_REQUEST['zh_co']) : "";
$button = isset($_REQUEST['bt_name'])? strtoupper($_REQUEST['bt_name']) : "";



$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

$group_arr = array();

switch($button){
	case "SAVE":
		$o_c->addCountry($en_co, $zh_co, $coid);
		echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
		exit;	
		break;
	case "DELETE":
		if ($stid > 0){
			$o_c->delCountry($id);
		}
		echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
		exit;
		break;
	default:
		break;
}

$country_arr = $o_c->getCountryZH();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Configration</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<body>
<input type="hidden" name="hCancel" value="0">
<table border="0" width="100%" cellpadding="3">
	<tr class="greybg">
		<td colspan="3"align="center" class="whitetext">
				Country &nbsp;
		</td>
	</tr>			
	<tr>	  
	  <td align="left" width="83%">
	  	<form method="get" name="form1" action="" target="_self">
		   <select name="coid" onchange="this.form.submit();">
		   <option value="0" >Add new / Chonse one</option>	
		   <?php
		   	 foreach($country_arr as $id => $v){
		   	 	echo "<option value={$id} ".($id == $coid? "selected" : "").">{$v['en']}</option>";
		   	 }
		   ?>
		   
	      </select>
	     </form>
	  </td>    
	</tr>
	<tr>
		<td width="100%"><hr/></td>	
	</tr>
	<tr>
		<form method="post" name="form2" target="_self">
		<input type="hidden" name="coid" value="<?php echo $coid; ?>">
		<td width="100%">
			EN: <input type="text" name="en_co" value="<?php echo isset($country_arr[$coid])? $country_arr[$coid]['en'] : "" ; ?>"/><br/>
			ZH: <input type="text" name="zh_co" value="<?php echo isset($country_arr[$coid])? $country_arr[$coid]['zh'] : "" ; ?>"/><br/>
			<p/>
			<input type="submit" value="Save" name="bt_name" style="font-weight:bold">
			<input type="submit" value="Delete" name="bt_name" style="font-weight:bold">
		</td>
		</form>
	</tr>
</table>
</body>
</html>