<?php
require_once('MysqlDB.class.php');
class LegalAPI extends MysqlDB{

    function __construct($host, $user, $pswd, $database, $debug) {
		$this->setDBconf($host, $user, $pswd, $database, $debug);
    }


    function getStatus() {
    	return array('active', 'decline', 'cancel agreement', 'complate');
    }
    
    function getCategory($id = 0){
    	$sql = "SELECT CATEID, NAME FROM legal_category";

    	if ($id > 0) 
    		$sql .= " WHERE CATEID = {$id} ";

    	$this->query($sql);
    	$arr = array();
    	while ($this->fetch()) {
    		$arr[$this->CATEID] = $this->NAME;
    	}

    	return isset($arr[$id])? $arr[$id] : $arr;
    	//return array(1=>'Conveyance');
    }

    function addCategory($catname){
		if ($catname != ""){
    		$catname = addslashes($catname);
    		$sql = "insert into legal_category (Name) values ('{$catname}')";
    		return $this->query($sql);
    	}
    	return false;
    }


    function setCategory($catid, $catname){
		if ($catname != "" && $catid > 0){
    		$catname = addslashes($catname);
    		$sql = "Update legal_category SET Name = '{$catname}' where CateID = {$catid}";
    		return $this->query($sql);
    	}
    	return false;    	
    }

    function delCategory($catid){
    	if ($catid > 0){
    		$sql = "delete from legal_category where CateID = {$catid} ";
    		return $this->query($sql);
    	}
		return false;
    }


    function getSubClass($cateid=0, $subid=0) {
    	$sql = "SELECT SubClassID, CateID, ClassName FROM legal_subclass WHERE 1";
    	if ($cateid > 0) 
    		$sql .= " AND CateID = {$cateid} ";
    	if ($subid > 0) 
    		$sql .= " AND SubClassID = {$subid} ";

    	$this->query($sql);

    	$arr = array();
    	while ($this->fetch()) {
    		$arr[$this->CateID][$this->SubClassID] = $this->ClassName;
    	}

    	return isset($arr[$cateid])? (isset($arr[$cateid][$subid])? $arr[$cateid][$subid] : $arr[$cateid]) : $arr;
    }
	
	function delSubclass($catid, $subid){
    	if ($catid > 0){
    		$sql = "delete from legal_subclass where CateID = {$catid} and SubClassID = {$subid}";
    		return $this->query($sql);
    	}
		return false;
    }
    
    function addSubclass($catid, $classname){
    	if ($classname != "" && $catid > 0){
    		$classname = addslashes($classname);
    		$sql = "insert into legal_subclass (ClassName, CateID) values ('{$classname}', {$catid})";
    		return $this->query($sql);
    	}
    	return false;
    }

    function setSubclass($catid, $subid, $classname){
    	if ($classname != "" && $catid > 0 && $subid > 0){
    		$classname = addslashes($classname);
    		$sql = "Update legal_subclass SET ClassName = '{$classname}' where CateID = {$catid} and SubClassID = {$subid}";
    		return $this->query($sql);
    	}
    	return false;
    }



    function delStep($rid){
    	if ($rid > 0){
    		$sql = "delete from legal_step where ItemID = {$rid}";
    		return $this->query($sql);
    	}
    	return false;
    }
    
    
    function addStep($catid, $subid, $process, $sort){
    	if ($process != "" && $catid > 0 && $subid > 0){
    		$process = addslashes($process);
    		$sql = "insert into legal_step (CateID, SubClassID, Priority, Item) values ({$catid}, {$subid}, {$sort}, '{$process}')";
    		return $this->query($sql);
    	}
    	return false;
    }

    function setStep($rid, $process, $order){
    	if ($process != "" && $rid > 0 && $order > 0){
    		$process = addslashes($process);
    		$sql = "Update legal_step SET Item = '{$process}', Priority = '{$order}' where ItemID = {$rid}";
    		return $this->query($sql);
    	}
    	return false;
    }    
    
	function getStep($cateid, $classid){
        $_arr = array();
        if ($cateid > 0 && $classid > 0){
            $sql = "select Priority, ItemID, Item from legal_step where CateID = {$cateid} and SubClassID = {$classid} order by Priority asc";
            $this->query($sql);
            $_arr = array();
            while ($this->fetch()){
                $_arr[$this->ItemID]['name'] = $this->Item;
                $_arr[$this->ItemID]['pri'] = $this->Priority;
            }
            return $_arr;
        }
        return $_arr;
    }


	function addLegal($user_id, $cid, $sets){
		foreach($sets as &$v){
			$v = addslashes($v);
		}
		
		$sql = "insert into client_legal (CateID, SubClassID, CID, AUserID, VUserID, Note, STATUS, ADDTIME, ConsultDate, ADATE) values ('{$sets['cateid']}', '{$sets['subid']}', '{$cid}', '{$sets['auser']}', '{$sets['vuser']}', '{$sets['note']}', '{$sets['status']}', NOW(), '{$sets['vdate']}', '{$sets['adate']}')";
		$this->query($sql);
		return $this->getLastInsertID();
	}

	function setLegal($vid, $sets){
		foreach($sets as &$v){
			$v = addslashes($v);
		}
		$sql = "Update client_legal SET CateID = '{$sets['cateid']}', SubClassID = '{$sets['subid']}', Note = '{$sets['note']}', AUserID = '{$sets['auser']}', VUserID = '{$sets['vuser']}',  Status = '{$sets['status']}', ConsultDate = '{$sets['vdate']}' , ADate = '{$sets['adate']}' where ID = {$vid}";
		return $this->query($sql);	
	}

	function delLegal($vid){
		if ($vid > 0){
			#visa account
			$sql = "delete from client_account where VisaID = {$vid} and ACC_TYPE = 'legal' ";
			$this->query($sql);

			#visa
			$sql = "delete from client_legal where ID = {$vid}";
			$this->query($sql);
			
			$sql = "delete from client_payment where AccountID not in(select ID from client_account)";
			$this->query($sql);
			return true;
		}
		return false;
	}

	function getLegal($client_id = 0, $id = 0, $userid = 0){
		$cates = $this->getCategory();
		$class = $this->getSubClass();

		$sql = "select * from client_legal  Where 1 ";
		if ($id > 0){
			$sql .= " AND ID = '{$id}'";
		}else{
			if ($client_id > 0){
				$sql .= " AND CID = {$client_id}";
			}
			if ($userid > 0 ) {
				$sql .= " AND (AUserID = '{$userid}' or VUserID = '{$userid}') ";
			}
		}
		$sql .= " ORDER BY ADDTIME ASC ";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->ID]['cate']    = $cates[$this->CateID];
			$_arr[$this->ID]['cateid']  = $this->CateID;
			$_arr[$this->ID]['class']   = $class[$this->CateID][$this->SubClassID];
			$_arr[$this->ID]['subid']   = $this->SubClassID;
			$_arr[$this->ID]['auser']   = $this->AUserID;
			$_arr[$this->ID]['vuser']   = $this->VUserID;
			$_arr[$this->ID]['status']  = $this->STATUS;
			$_arr[$this->ID]['vdate']   = $this->ConsultDate;
			$_arr[$this->ID]['adate']   = $this->ADate;
			$_arr[$this->ID]['note']    = $this->Note;	
		}
		return $_arr;
	}			

	function countLegal($agent_id){
		if (!$agent_id )
			return false;

		$cates = $this->getCategory();
		$class = $this->getSubClass();

		$sql = "select a.*, CONCAT(b.Fname, ' ', b.Lname) as ClientName from client_legal a left join client_info b on (a.CID = b.CID) where b.AgentID = {$agent_id} ";
		$sql .= " ORDER BY ADDTIME ASC ";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->ID]['cate']    = $cates[$this->CateID];
			$_arr[$this->ID]['cateid']  = $this->CateID;
			$_arr[$this->ID]['class']   = $class[$this->CateID][$this->SubClassID];
			$_arr[$this->ID]['subid']   = $this->SubClassID;
			$_arr[$this->ID]['auser']   = $this->AUserID;
			$_arr[$this->ID]['vuser']   = $this->VUserID;
			$_arr[$this->ID]['status']  = $this->STATUS;
			$_arr[$this->ID]['vdate']   = $this->ConsultDate;
			$_arr[$this->ID]['adate']   = $this->ADate;
			$_arr[$this->ID]['note']    = $this->Note;	
			$_arr[$this->ID]['cid']    = $this->CID;	
			$_arr[$this->ID]['cname']    = $this->ClientName;	
		}
		return $_arr;
	}		

	function autoProcess($visa_id, $cateid, $subclassid) {
		if (!$visa_id || !$cateid || !$subclassid)
			return false;

		$sql = "SELECT AUTOSTEP FROM client_legal WHERE ID = {$visa_id}";
		$this->query($sql);
		$this->fetch();
		if (!$this->AUTOSTEP)
			return false;

		$auto_steps = $this->getStep($cateid, $subclassid);
		$sql = "SELECT ItemID, DONE FROM client_legal_process WHERE CVID = {$visa_id} AND ItemID > 0 ";
		$this->query($sql);
		while ($this->fetch()) {
			$auto_steps[$this->ItemID]['done'] = $this->DONE;
		}
        
		foreach ($auto_steps as $itemid => $v) {
			if (isset($v['done'])) {
				if ($v['done'] == 0)
					break;
				continue;
			}

			$sets['subject'] = $itemid;
			$sets['done']    = 0;
			$sets['detail']  = "";
			$sets['add']     = "";
			$sets['date']    = '0000-00-00';
			$sets['due']     = '0000-00-00';
			return $this->addProcess($visa_id, $sets);
		}
		return false;
	}

	function addProcess($vid, $sets){
		foreach ($sets as &$v){
			$v = addslashes($v);
		}			
		$sets['subject'] = $sets['add'] != ""? 0 : $sets['subject'];
		$sql = "insert into `client_legal_process` (CVID, BeginDate, ItemID, Detail, DueDate, Done, ExItem) values ({$vid}, '{$sets['date']}', '{$sets['subject']}', '{$sets['detail']}', '{$sets['due']}', '{$sets['done']}', '{$sets['add']}')"; 
		return $this->query($sql); 
	}	

	function setProcess($pid, $sets){
		foreach ($sets as &$v){
			$v = addslashes($v);
		}
		$sets['subject'] = $sets['add'] != ""? 0 : $sets['subject'];
		$sql = "Update client_legal_process SET BeginDate = '{$sets['date']}', ItemID = '{$sets['subject']}', Detail = '{$sets['detail']}', DueDate = '{$sets['due']}', ExItem = '{$sets['add']}', Done = '{$sets['done']}' where ID = {$pid}";
		return $this->query($sql); 
	}	

	function delProcess($pid){
		if ($pid > 0){

        	$sql = "SELECT CVID, ITEMID FROM client_legal_process WHERE ID = {$pid} ";
        	$this->query($sql);
        	$this->fetch();
        	if ($this->CVID > 0 && $this->ITEMID > 0) {
            	$sql = "UPDATE client_legal SET AUTOSTEP = 0 WHERE ID = {$this->CVID}";
            	$this->query($sql);
        	}
        	
        	$sql = "Delete from client_legal_process where ID = {$pid}";
			return $this->query($sql);
		}	
		return false;
	}


	function getProcess($pid, $cvid, $cateid, $classid){
		if ($cvid == 0) {
			return array();
		}

		$steps = $this->getStep($cateid, $classid);
		$sql = "select * from client_legal_process WHERE 1";
		if ($pid > 0){
			$sql .= " AND ID = {$pid}";
		}

		if ($cvid > 0) {
			$sql .= " AND CVID = {$cvid} ";
		}
		$sql .= " ORDER BY ID ASC ";
		$this->query($sql);
		$_arr = array();
		$sorts = array();
		$last_idx = 0;
		while ($this->fetch()){
			$k = 'p'.$this->ID;
            $_arr[$k]['date']    = $this->BeginDate;
			$_arr[$k]['subject'] = isset($steps[$this->ItemID])? $steps[$this->ItemID]['name'] : $this->ExItem;
            $_arr[$k]['itemid']  = $this->ItemID;
            $_arr[$k]['add']     = $this->ExItem;
			$_arr[$k]['detail']  = $this->Detail;
			$_arr[$k]['due']     = $this->DueDate;
			$_arr[$k]['done']    = $this->Done;
		    $_arr[$k]['pid']    = $this->ID;
			$last_idx = isset($steps[$this->ItemID])? $steps[$this->ItemID]['pri'] : $last_idx;
			$sorts[$k] = $last_idx+$this->ID;
		}
		if ($pid > 0)
			return $_arr['p'.$pid];
        
		array_multisort($sorts, SORT_ASC, $_arr);
		return $_arr;
	}
	
}
?>
