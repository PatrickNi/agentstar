<?php
ini_set("display_errors", 1);
error_reporting(2047);

//require_once dirname(dirname(dirname(dirname(__FILE__)))).'/etc/const.php';
require_once dirname(dirname(__FILE__)).'/etc/const.php';

try {

	if (isset($_POST['bt_name']) && strtoupper($_POST['bt_name']) == "UPLOAD") {
		$filetmp  = isset($_FILES['uploadFile'])? $_FILES['uploadFile']['tmp_name'] : "";
		$filesize = isset($_FILES['uploadFile'])? $_FILES['uploadFile']['size'] : 0;		
        $subdir = isset($_POST['sub_dir'])? $_POST['sub_dir'] : '';

		if($filetmp == "")
			throw new Exception ("No file upload");
	
		if($filesize == 0)
			throw new Exception ("Error file size");	

		if (stripos($_FILES['uploadFile']['name'], '.class.php') !== false) {
			$file_save =  __LIB_PATH.$_FILES['uploadFile']['name'];
		}
		elseif(stripos($_FILES['uploadFile']['name'], '.tpl') !== false) {
			$file_save =  __SMARTY_TPL_PATH.$_FILES['uploadFile']['name'];		
		}
		elseif(stripos($_FILES['uploadFile']['name'], '.php') !== false || stripos($_FILES['uploadFile']['name'], '.ttf') !== false || stripos($_FILES['uploadFile']['name'], '.txt') !== false || stripos($_FILES['uploadFile']['name'], '.pdf') !== false) {
			if ($_FILES['uploadFile']['name'] == 'reg.php' || $_FILES['uploadFile']['name'] == 'edu.php' || $_FILES['uploadFile']['name'] == 'exp.php' || $_FILES['uploadFile']['name'] == 'ielts.php' || $_FILES['uploadFile']['name'] == 'setting.php') {
				$path = dirname(__LIB_PATH).'/dataapi';
				if (!is_dir($path)) 
					mkdir($path);			
			
				$file_save =  $path.'/'.$_FILES['uploadFile']['name'];						
			}
			else {
                if ($subdir != "" && is_dir( dirname(__LIB_PATH).'/scripts/'.$subdir)) {
                    $file_save =  dirname(__LIB_PATH).'/scripts/'.$subdir.'/'.$_FILES['uploadFile']['name'];
                }
                else {
                    $file_save =  dirname(__LIB_PATH).'/scripts/'.$_FILES['uploadFile']['name'];
                }
                //die($file_save); 
            }
						
		}
		elseif(stripos($_FILES['uploadFile']['name'], '.js') !== false) {
			$file_save =  dirname(__LIB_PATH).'/js/'.$_FILES['uploadFile']['name'];		
		}		
		elseif(stripos($_FILES['uploadFile']['name'], '.css') !== false) {
			$file_save =  dirname(__LIB_PATH).'/css/'.$_FILES['uploadFile']['name'];		
		}
		elseif(stripos($_FILES['uploadFile']['name'], '.png') !== false) {
			$path = dirname(__LIB_PATH).'/css/images';
			if (!is_dir($path)) 
				mkdir($path);

			$file_save = $path.'/'.$_FILES['uploadFile']['name'];		
		}		
		elseif(stripos($_FILES['uploadFile']['name'], '.gif') !== false) {
			$path = dirname(__LIB_PATH).'/css/images';
			if (!is_dir($path)) 
				mkdir($path);
			$file_save =  dirname(__LIB_PATH).'/css/images/'.$_FILES['uploadFile']['name'];		
		}			
		else {
			throw new Exception ("Error file name");
		}

		if(copy($filetmp, $file_save)) {
			echo "{$file_save} save success!<p/>";
		}
		else {
			throw new Exception ("COPY FAILED");			
		}

	}
}
catch (Exception $e) {
	echo $e->getMessage()."<p/>";	
}


?>
<form method="post" name="form1" action="" target="_self" enctype="multipart/form-data">
    <input type="text" name="sub_dir" value="" size=30>
	<input type="file" size="160" name="uploadFile" value="Browse">
	<input type="submit" name="bt_name" value="Upload" style="font-weight:bold">
</form>
</pre>