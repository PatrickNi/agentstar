<?php
$url = "http://127.0.0.1/immi/dataapi/setting.php";
try {
	$fp = fopen ('as.setting.php', 'w');
	fwrite($fp, "<?php \n");
	//country
	$data = file($url.'?act=co');
	foreach ($data as $lr){
		$lr = explode("\t", trim($lr));
		fwrite($fp, '$AS_COUNTRY['.$lr[0].'] = \''.$lr[1].'\';'."\n");			
	}
	fwrite($fp, "\n\n");

	//visa category
	$data = file($url.'?act=vc');
	foreach ($data as $lr){
		$lr = explode("\t", trim($lr));
		fwrite($fp, '$AS_VISA_CATEGORY['.$lr[0].'] = \''.$lr[1].'\';'."\n");			
	}
	fwrite($fp, "\n\n");

	//visa subclass
	$data = file($url.'?act=vs');
	foreach ($data as $lr){
		$lr = explode("\t", trim($lr));
		fwrite($fp, '$AS_VISA_SUBCLASS['.$lr[0].']['.$lr[1].']  = \''.$lr[2].'\';'."\n");			
	}

	fwrite($fp, "?>");	
	fclose($fp);
	
}
catch (Exception $e){
	echo $e->getMessage()."\n";
	exit(1);
}

?>
