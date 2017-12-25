<?php
$user_id = isset($_COOKIE['userid'])? trim($_COOKIE['userid']) : 0;
if ($user_id > 0){
	header("Location: scripts/index.php");
	$url = "scripts/index.php";

}else{
	header("Location: scripts/login.php");
	$url = "scripts/index.php";
} 
?>
<!--<html>
<head>
<script language="javascript">
alert(1);
window.open("<?php echo $url; ?>", "_blank", "menubar=no,resizable=yes,toolbar=no, status=yes");
window.close();
</script>
</head>
</html>-->
