<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'GeicAPI.class.php');

$cateid = isset($_REQUEST['cateid'])? $_REQUEST['cateid'] : 0;
$iid = isset($_REQUEST['iid'])? $_REQUEST['iid'] : 0;
$o_g = new GeicAPI(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);

if(isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "SAVE"){
	$categoryName = isset($_REQUEST['t_name'])? $_REQUEST['t_name'] : "";
	if ($cateid > 0){
		$o_g->setSalesCategory($cateid, $categoryName);
	}else{
		$o_g->addSalesCategory($iid, $categoryName);
	}
	echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
	exit;
}elseif(isset($_REQUEST['bt_name']) && strtoupper($_REQUEST['bt_name']) == "DELETE"){
	if ($cateid > 0){
		$o_g->delSalesCategory($cateid);
	}
	echo "<script language='javascript'>if(window.opener && !window.opener.closed){window.opener.location.reload(true);}window.close();</script>";
	exit;	
}


$categories = $o_g->getSalesCatgory($iid,$cateid);
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Agent Star -Configration</title>
</head>
<link rel="stylesheet" href="../css/sam.css">
<script language="javascript" src="../js/audit.js"></script>
<body>
<form method="post" name="form1" action="" target="_self">
<input type="hidden" name="cateid" value="<?php echo $cateid; ?>">
<input type="hidden" name="iid" value="<?php echo $iid; ?>">
	<table border="0" width="100%" cellpadding="3" cellspacing="1">
		<tr class="greybg">
			<td colspan="3"align="center" class="whitetext">
					Contact Group&nbsp;
			</td>
		</tr>	
		<tr>
			<td width="25%" align="left" class="rowodd"><strong>Category Name:</strong>&nbsp;&nbsp;</td>
			<td align="left" width="75%" class="roweven">
			<textarea name="t_name" style="width:300px; height:100px;"><?php echo ($iid > 0 && $cateid > 0)? $categories[$iid][$cateid] : "";?></textarea>
			</td>
		</tr>																		
		<tr align="center"  class="greybg" >
		  <td colspan="2">
				<input type="submit" value="Save" name="bt_name" style="font-weight:bold ">&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="submit" value="Delete" name="bt_name" style="font-weight:bold">
			</td>
		</tr>									
	</table>	
</form>			
</body>
</html>