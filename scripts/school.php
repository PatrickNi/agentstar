<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'ClientAPI.class.php');

# get course id
$id      = isset($_REQUEST['id'])? trim($_REQUEST['id']) : 0;
$school  = isset($_REQUEST['t_name'])? trim($_REQUEST['t_name']) : 0;
$country = isset($_REQUEST['country'])? trim($_REQUEST['country']) : 0;
$button  = isset($_REQUEST['bt_name'])? strtoupper($_REQUEST['bt_name']) : "";


if($country == 0){
	echo "<script language='javascript'>alert('Please set country firse');window.returnValue=1;self.close();</script>";
	exit;
}

$o_c = new ClientAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
switch($button){
	case "SAVE":
		if($school != ""){
			$o_c->addSchool($school, $country);
			echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
		}else{
			echo "<script language='javascript'>alert('Error School Name');</script>";
		}
		break;
	case "DELETE":
		if ($stid > 0){
			$o_c->delSchool($id);
		}
		echo "<script language='javascript'>window.returnValue=1;self.close();</script>";
		break;
	default:
		break;
}

$country_arr = array();
$country_arr = $o_c->getCountry();

$school_arr = array();
$school_arr = $o_c->getSchool($country);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Configration</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="post" name="form1" action="" target="_self" >
<input type="hidden" name="country" value="<?php echo $country; ?>">
			<table border="0" width="100%" cellpadding="1" cellspacing="1">
				<tr class="greybg">
					<td colspan="3"align="center" class="whitetext">
							School &nbsp;
					</td>
				</tr>	
				<tr>	  
				  <td align="left" width="83%" class="rowadd">
				  	   <strong>From: <?php echo $country_arr[$country]?></strong>
					   <select name="t_cate" >
					   <?php
					   	 foreach($school_arr as $id => $name){
					   	 	echo "<option value={$id}>{$name}</option>";
					   	 }
					   ?>
				      </select>
				  </td>    
				  <td width="17%" align="left" class="roweven">
						<input type="submit" value="Delete" name="bt_name" style="font-weight:bold">				  
				  </td>
				</tr>
				<tr>
					<td align="left" width="83%" class="rowadd"><input type="text" name="t_name" size="30" value=""></td>
					<td width="17%" align="left" class="roweven"><input type="submit" value="Save" name="bt_name" style="font-weight:bold ">&nbsp;&nbsp;&nbsp;&nbsp;</td>
				</tr>																		
				<tr align="center"  class="greybg" >
				  <td colspan="2">&nbsp;</td>
				</tr>									
			</table>	
</form>			
</body>
</html>