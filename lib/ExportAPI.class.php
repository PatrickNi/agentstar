<?php
require_once 'MysqlDB.class.php';
class ExportAPI extends MysqlDB {
	
	const EMAIL_TPL = '/([a-zA-Z0-9_.-]+@[a-zA-Z0-9]+\.[a-zA-Z0-9_.-]+)/';
	
	public function __construct($host, $user, $pswd, $database, $debug) {
		$this->MysqlDB($host, $user, $pswd, $database, $debug);
	}
	
//	public function generateMailList($file, $mailArr){
//		$fp = fopen($this->dlpath.$file, 'w');
//		if ($fp) {
//			fwrite($fp, implode(';', $mailArr));
//		}else{
//			die("Cannot create file => $file");
//		}
//		fclose($fp);
//		return $this->dlpath.$file;
//	}
	
	public function dlEmails($mailArr, $filename){
		$content = implode("\r\n", $mailArr);
		//download function
		Header("Content-type: application/octet-stream");
		Header("Accept-Ranges: bytes");
		Header("Accept-Length: " . count($content));
		Header("Content-Disposition: attachment; filename={$filename}");
		echo $content;
		exit;	
	}
	
	public function exportClientEmail($col_f="", $col_v="", $from="", $to="", $clientArr=array(), $file=''){
		
		$sql = "SELECT EMAIL, CNCT_EMAIL FROM client_info WHERE (EMAIL <> '' OR CNCT_EMAIL <> '') AND EMAIL NOT LIKE '%@geic.com%' ";
		if($col_f != "" && $col_v != ""){
			$sql .= " AND {$col_f} like '{$col_v}%' ";
		}
		if ($from != "" && $to != ""){
			$sql .= " AND CreateTime >= '{$from}' AND CreateTime <= '{$to}' ";
		}
		if (is_array($clientArr) && count($clientArr) > 0 ){
			$_str = implode(',', $clientArr);
			$sql .= " AND CID IN ({$_str})";	
		}
		
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$m = array();
			if($this->EMAIL != '' && preg_match_all(self::EMAIL_TPL, $this->EMAIL, $m)){
				foreach ($m[0] as $mail){
					array_push($_arr, $mail);
				}
			}
			$m = array();
			if ($this->CNCT_EMAIL != '' && preg_match_all(self::EMAIL_TPL, $this->CNCT_EMAIL, $m)){
				foreach ($m[0] as $mail){
					array_push($_arr, $mail);
				}	
			}
		}
		$prefix = $file != ''? $file : 'client_emails';
		$this->dlEmails($_arr, $prefix.'_'.date("Ymd").'.doc');
	}
	
	public function exportAgentEmail($mailArr, $type){
		$_arr = array();
		foreach ($mailArr as $mail){
			$m = array();
			if (preg_match_all(self::EMAIL_TPL, $mail, $m)){
				foreach ($m[0] as $_mail){
					array_push($_arr, $_mail);
				}
			}
		}
		$this->dlEmails($_arr, $type.'_agent_'.date("Ymd").'.doc');
	}

	public function exportInstituteEmail() {
		$sql = "SELECT DISTINCT EMAIL FROM institute_staff WHERE email LIKE '%@%'";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()) {
			if(preg_match_all(self::EMAIL_TPL, $this->EMAIL, $m)){
				foreach ($m[0] as $mail){
					array_push($_arr, $mail);
				}
			}			
		}
		$this->dlEmails($_arr, 'institute_staff_'.date("Ymd").'.doc');
	}
}

?>
