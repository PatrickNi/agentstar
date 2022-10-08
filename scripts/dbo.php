<?php
ini_set("display_errors", 1);
error_reporting(2047);

require_once '../etc/const.php';
require_once '../lib/MysqlDB.class.php';

try {

	if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "SUBMIT") {
		$db = new MysqlDB(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
		if ($db->query($_POST['sql'])) {
			echo "sucess<p/>";
			if (stripos($_POST['sql'], 'select') !== false) {
				echo "<pre>";
				while ($row = $db->fetch_array()) {
					print_r($row);
					echo "========\n";
					//echo implode("@@@@", $row)."\n";
				}
				echo "</pre>";
			}
			elseif (stripos($_POST['sql'], 'show') !== false) {
				echo "<pre>";
				while ($row = $db->fetch_array()) {
					print_r($row);
					echo "========\n";
					//echo implode("@@@@", $row)."\n";
				}
				echo "</pre>";
			}
		}
	}

}
catch (Exception $e) {
	echo $e->getMessage()."<p/>";	
}


?>
<form method="post" name="form1" action="" target="_self" enctype="multipart/form-data">
	<textarea style="width:100%; height:100% " name="sql" rows="30"></textarea>
	<input type="submit" name="bt_name" value="SUBMIT" style="font-weight:bold">
</form>
