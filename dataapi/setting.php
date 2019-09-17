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
						$db->COUNTRY = $db->COUNTRY.'(ÖÐ¹ú)';
						break;
					case 'MALAYSIA':
						$db->COUNTRY = $db->COUNTRY.'(ÂíÀ´Î÷ÑÇ)';
						break;
					case 'HONG KONG':
						$db->COUNTRY = $db->COUNTRY.'(Ïã¸Û)';
						break;
					case 'TAIWAN':
						$db->COUNTRY = $db->COUNTRY.'(Ì¨Íå)';
						break;						
					case 'MACAO':
						$db->COUNTRY = $db->COUNTRY.'(°ÄÃÅ)';
						break;						
						
				}
				$arr[$db->ID] = $db->COUNTRY;
			}		
			break;	
		case 'vc2':		
			$sql = "SELECT CATEID, VISANAME, ZH_NAME FROM visa_category order by (VISANAME+0) asc";
			$db->query($sql);
			while ($db->fetch()) {
				$arr[$db->CATEID]['en'] = $db->VISANAME;
				$arr[$db->CATEID]['zh'] = $db->ZH_NAME;
			}		
			break;
		case 'aboutus':		
			$sql = "SELECT ITEM, ITEM_ZH FROM client_from where rank <> 100 order by rank asc";
			$db->query($sql);
			while ($db->fetch()) {
				$arr[$db->ITEM]['en'] = $db->ITEM;
				$arr[$db->ITEM]['zh'] = $db->ITEM_ZH;
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
