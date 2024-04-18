<?php
class MysqlDB {
	
	public $m_user 	= "";
    public $m_pswd	= "";
    public $m_classVar = array();
    public $m_host			= "";
    public $m_database 	= "";
    public $m_debug		= "0"; 
    public $m_plink			= "0"; 
    public $m_linkID		= ""; 
    public $m_res			= ""; 
		
     
    function __construct($r_host, $r_user, $r_pswd, $r_database, $_debug = 0) {
		$this->m_host 			= $r_host;	
    	$this->m_user 			= $r_user;
    	$this->m_pswd 			= $r_pswd;
    	$this->m_debug		= $_debug;
    	$this->m_database 	= $r_database;
    	$this->m_classVar		= get_class_vars(get_class($this));
//    	$this->connect();
    }
    
    function setDBconf($r_host, $r_user, $r_pswd, $r_database, $_debug = 0) {
		$this->m_host 			= $r_host;	
    	$this->m_user 			= $r_user;
    	$this->m_pswd 			= $r_pswd;
    	$this->m_debug		= $_debug;
    	$this->m_database 	= $r_database;
    	$this->m_classVar		= get_class_vars(get_class($this));
//    	$this->connect();
    }

    function setDebug($debug = 0){
    	if ($debug == 0 || $debug == 1){
    		$this->m_debug = $debug;
    	}
    }
    
    function setPlink($plink = 0){
  		if($plink == 1 || $plink == 0){
  			$this->m_plink = $plink;	  
  		}
    }
    
    function errorProcess($errorMsg="", $sql=""){
    	echo $errorMsg . "<br>\n";
    	echo "Exec: => " . $sql . "<br>\n";
    	if($this->m_debug == 1){
    		exit;
    	}
    	return true;
    }
    
    function connect(){
     	if(!$this->m_linkID){
     		# create connection
     		if($this->m_plink == 1){
     			$this->m_linkID = @mysqli_connect('p:'.$this->m_host, $this->m_user, $this->m_pswd);
     		}else{
     			$this->m_linkID = @mysqli_connect($this->m_host, $this->m_user, $this->m_pswd);
     		}
		
    	//	var_dump(mysqli_character_set_name($this->m_linkID));		
     		mysqli_set_charset($this->m_linkID, "latin1");
	//        var_dump(mysqli_character_set_name($this->m_linkID));  
		# check connection
     		if (!$this->m_linkID){	
				$this->errorProcess("Error code" . mysqli_errno($this->m_LinkID) . ", Error info: ". mysqli_error($this->m_LinkID));
				return false;
			}
			
			# use database;
			$this->database();
     	}
     	return true;
     }
	
	function database($database=""){
		if ($database != ""){
			$this->m_database = $database;	
		}
		
		if (!@mysqli_select_db($this->m_linkID, $this->m_database)){
			$this->errorProcess("Error code" . mysqli_errno($this->m_linkID) . ", Error info: ". mysqli_error($this->m_linkID));
			return false;			
		}
		return true;
	}


	function query($sql=""){
		if (!$this->m_linkID || !@mysqli_ping($this->m_linkID)){
			$this->connect();
		}
		
		$this->freeObj();
		$this->m_res = @mysqli_query($this->m_linkID, $sql);
		if (!$this->m_res){
			$this->errorProcess("Error code" . mysqli_errno($this->m_linkID) . ", Error info: ". mysqli_error($this->m_linkID), $sql);
			return false;								
		}
		return true;
	}
	
	function fetch_array() {
        if($this->m_res){
            return mysqli_fetch_array($this->m_res, MYSQLI_ASSOC); 
        }
        else{
            return false;
        }
    }

	function fetch(){
		if($this->m_res){
			$_arr = mysqli_fetch_array($this->m_res, MYSQLI_ASSOC); 
			return $this->res2obj($_arr);
		}else{
			return false;
		}
	}
	
	
	function res2obj(&$rArr){
		if(is_array($rArr) && count($rArr) > 0){
			foreach($rArr as $key => $v){
				$this->$key = $v;
			}
			return true;
		}
		return false;
	}
	
	
	function freeObj(){
		$objVarArr   = get_object_vars($this);
		if (is_array($objVarArr) && count($objVarArr) > 0){
			foreach ($objVarArr as $key => $v){
				if (!array_key_exists($key, $this->m_classVar)){
					unset($this->$key);
				}
			}
		}
	}


	function getSelectNum(){
		if($this->m_res){
			return @mysqli_num_rows($this->m_res);
		}
		return 0;
	}


	function getAffectNum(){
		if($this->m_res){
			return @mysqli_affected_rows($this->m_res);
		}
		return 0;
	}

	function getLastInsertID(){
		if($this->m_linkID){
			return @mysqli_insert_id($this->m_linkID);
		}
	}
	
	function close(){
		return @mysqli_close($this->m_linkID);
	}	
}
?>
