<?php
require_once('../etc/const.php');
require_once(__LIB_PATH.'MysqlDB.class.php');

$db = new MysqlDb(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);
$dbw = new MysqlDb(__DB_HOST, __DB_USER, __DB_PASSWORD, __DB_DATABASE, 1);


$sql = "select ID from attachment_his ";
$dbw->query($sql);
$his = [];
while ($dbw->fetch()) {
    $his[$dbw->ID] = true;
}
$sql = "select ItemID, ItemType, ID, File, UploadTime from attachment where ItemType in ('visa') order by ID desc ";
$db->query($sql);
while ($db->fetch()) {
    if (isset($his[$db->ID]))
        continue;
        
    echo $db->File."\n";

    $pre_fix = $db->ItemType."/".$db->ItemID."/";
    $url = 'http://110.143.32.230:8080/download/'.$pre_fix.rawurlencode(str_replace($pre_fix, '', $db->File));
    echo $url."\n";
    if (!is_dir(__DOWNLOAD_PATH.'/'.$pre_fix)) 
        mkdir(__DOWNLOAD_PATH.'/'.$pre_fix,777,true);
    
    if(file_put_contents(__DOWNLOAD_PATH.'/'.$db->File, file_get_contents($url))) {
        $sql = "insert into attachment_his (ID) value (".$db->ID.")";
        $dbw->query($sql);
    }
    else {
	echo "Failed\n";	
    }
    echo "------------------\n\n";

}
