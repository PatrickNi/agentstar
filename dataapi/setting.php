<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'MysqlDB.class.php');

try {
	$db = new MysqlDB(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);	
	switch(isset($_REQUEST['act'])? $_REQUEST['act'] : '') {
		case 'vc':
			$sql = "SELECT CATEID, VISANAME FROM visa_category order by VISANAME asc";
			$db->query($sql);
			while ($db->fetch()) {
				$arr[$db->CATEID] = $db->VISANAME;
			}		
			break;
		case 'co':
			$sql = "SELECT ID, COUNTRY FROM country order by country asc";
			$db->query($sql);
			while ($db->fetch()) {
				switch(strtoupper($db->COUNTRY)) {
					case 'CHINA':
						$db->COUNTRY = $db->COUNTRY.'(中国)';
						break;
					case 'MALAYSIA':
						$db->COUNTRY = $db->COUNTRY.'(马来西亚)';
						break;
					case 'HONG KONG':
						$db->COUNTRY = $db->COUNTRY.'(香港)';
						break;
					case 'TAIWAN':
						$db->COUNTRY = $db->COUNTRY.'(台湾)';
						break;						
					case 'MACAO':
						$db->COUNTRY = $db->COUNTRY.'(澳门)';
						break;						
						
				}
				$arr[$db->ID] = $db->COUNTRY;
			}		
			break;			
		default:
			throw new Exception ("No action");
			break;		
	}

	echo serialize($arr);
	exit;

}
catch (Exception $e){
	echo $e->getMessage()."\n";
	exit(1);
}

?>
