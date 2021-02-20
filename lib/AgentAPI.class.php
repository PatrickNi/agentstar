<?php
require_once('MysqlDB.class.php');

class AgentAPI extends MysqlDB {

	function AgentAPI($host, $user, $pswd, $database, $debug) {
    	 $this->MysqlDB($host, $user, $pswd, $database, $debug);
    }
    
    function _register() {
        $sets['name']    = isset($_REQUEST['name'])? trim($_REQUEST['name']) : '';
        $sets['web']     = isset($_REQUEST['web'])? trim($_REQUEST['web']) : '';
        $sets['tel']     = isset($_POST['tel'])? trim($_POST['tel']) : "";
        //$sets['fax']     = isset($_POST['t_fax'])? trim($_POST['t_fax']) : "";
        $sets['email']   = isset($_POST['email'])? trim($_POST['email']) : "";
        $sets['add']     = isset($_POST['add'])? trim($_POST['add']) : "";
        $sets['country'] = isset($_POST['country'])? trim($_POST['country']) : 0;
        $sets['contact'] = isset($_POST['contact'])? trim($_POST['contact']) : "";
        $sets['type']    = isset($_POST['type'])? trim($_POST['type']) : "sub";
        $sets['note']    = isset($_POST['note'])? trim($_POST['note']) : "";
        $sets['status']  = isset($_POST['status'])? trim($_POST['status']) : 0;
        $sets['city']    = isset($_POST['city'])? trim($_POST['city']) : "";
        $sets['verify']  = isset($_POST['verify'])? trim($_POST['verify']) : 0;
        $sets['cate']    = isset($_POST['cate'])? trim($_POST['cate']) : '';    
        $sets['uid']  = isset($_POST['uid'])? trim($_POST['uid']) : 0;
        $sets['wechatid']  = isset($_POST['wechatid'])? trim($_POST['wechatid']) : '';
        $sets['pos']  = isset($_POST['pos'])? trim($_POST['pos']) : '';
        $sets['state']  = isset($_POST['state'])? trim($_POST['state']) : '';

        if ($sets['name'] == '' || $sets['email'] == '')
            return array('err'=>1, 'msg'=>'no company name or no email');

        $agent_id = $this->addAgent($sets);
        if ($agent_id > 0) {
            return array('err'=>0, 'msg'=>'succ');
        }

        return array('err'=>1, 'msg'=>'add failed');
    }



    function getAgent($type = ""){
    	$sql = "select ID, Name from agent ";
    	if ($type != ""){
    		$sql .= "where Form = '{$type}' ";
        }
        $sql .= " order by lower(Name) asc";
    	$this->query($sql);
    	$_arr = array(0=>'N/A');
    	while ($this->fetch()){
    		$_arr[$this->ID] = $this->Name;
	   	}
	   	return $_arr;
    }
    
    function delAgentByArr($rIDArr){
        if(is_array($rIDArr) && count($rIDArr) > 0){
            $_str = "";
            foreach($rIDArr as $id){
                $_str .= "{$id},";
            }
            $_str = substr($_str, 0, strlen($_str) - 1);
            $sql = "delete from agent where ID in($_str) ";
            return $this->query($sql);         
        }
        return false;
    }
    
    function getAgentList($rAgentID=0, $type="", $cate="", $staff_id=0){
        $sql = "select ID, Name, Country, Contact, Phone, Fax, Email, Address, Note, Form, StatusID, City, Web, isVerify, CATE_NAME, REFCODE, USER_ID, WECHAT_ID, STATE, POSITION from agent ";
        if($rAgentID > 0){
            $sql .= "Where ID = {$rAgentID}";
        }elseif($type != ""){
        	$sql .= "Where Form = '{$type}' ";
        }

        if ($cate != "") {
            if ($cate == 'other')
                $sql .= " AND (CATE_NAME = '' OR CATE_NAME = 'other') ";
            else
                $sql .= " AND CATE_NAME = '{$cate}' ";
        }
/*
        if ($staff_id > 0 && $type == 'sub') {
            $sql .= " AND USER_ID = {$staff_id} ";
        }
*/       	
        $sql .= " Order by isVerify asc, lower(Name) asc";
        $this->query($sql);
        //echo $sql;

        $_arr = array();
        while($this->fetch()){
            $_arr[$this->ID]['name']    = $this->Name;
            $_arr[$this->ID]['country'] = $this->Country;
            $_arr[$this->ID]['contact'] = $this->Contact;
            $_arr[$this->ID]['tel']     = $this->Phone;
            $_arr[$this->ID]['fax']     = $this->Fax;
            $_arr[$this->ID]['email']   = $this->Email;
            $_arr[$this->ID]['add']     = $this->Address;
            $_arr[$this->ID]['note']    = $this->Note;
            $_arr[$this->ID]['type']    = $this->Form;
            $_arr[$this->ID]['stid']    = $this->StatusID;
            $_arr[$this->ID]['city']    = $this->City;
            $_arr[$this->ID]['web']     = $this->Web;
			$_arr[$this->ID]['verify']  = $this->isVerify;
            $_arr[$this->ID]['cate']    = $this->CATE_NAME;
            $_arr[$this->ID]['code']    = $this->REFCODE;			
            $_arr[$this->ID]['uid']     = $this->USER_ID;
            $_arr[$this->ID]['wechatid']= $this->WECHAT_ID;
            $_arr[$this->ID]['pos']     = $this->POSITION;
            $_arr[$this->ID]['state']   = $this->STATE;
        }
        return $_arr;
    }
    
    function countAgent($type, $userid = 0, $from="", $to=""){
    	$sql = "";	
    	if ($type == 'sub') {
    			$sql = "select d.AgentID, count(distinct a.CID) as StdCnt, Sum(if(OfferCnt is null, 0, OfferCnt)) as OfferCnt, Sum(if(CoeCnt is null, 0, CoeCnt)) as CoeCnt, Sum(if(RComm is null, 0, RComm)) as RComm, Sum(if(PComm is null, 0, PComm)) as PComm, max(a.ConsultantID) as uid  
						from client_info d left join client_course a  on(d.CID = a.CID) 
								left join (select CCID, Sum(if(ProcessID = 1, 1, 0)) as OfferCnt, Sum(if(ProcessID = 5, 1, 0)) as CoeCnt from client_course_process where done = 1 group by CCID) as b on(b.CCID = a.ID)
								left join (select CCID, Sum(RComm) as RComm, Sum(CoComm) as PComm from client_course_sem  group by CCID) as c on(c.CCID = a.ID)											  
						where d.AgentID <> 0 ";
	    		
                /*
                if ($userid > 0) {
	    			//$sql .= " AND d.CourseUser = {$userid} ";
                    $sql .= " AND a.ConsultantID = {$userid} ";

                }
                */
	    		$sql .= " Group by d.AgentID  ";
		}
		elseif ($type == 'top'){
				$sql = "select a.AgentID, count(distinct a.CID) as StdCnt, Sum(if(OfferCnt is null, 0, OfferCnt)) as OfferCnt, Sum(if(CoeCnt is null, 0, CoeCnt)) as CoeCnt, Sum(if(RComm is null, 0, RComm)) as RComm, Sum(if(PComm is null, 0, PComm)) as PComm, max(a.ConsultantID) as uid  
							from client_course a left join (select CCID, Sum(if(ProcessID = 1, 1, 0)) as OfferCnt, Sum(if(ProcessID = 5, 1, 0)) as CoeCnt from client_course_process where done = 1 group by CCID) as b on(b.CCID = a.ID)
												 left join (select CCID, Sum(RComm) as RComm, Sum(CoComm) as PComm from client_course_sem  group by CCID) as c on(c.CCID = a.ID)
												 left join client_info d on(d.CID = a.CID)
							where a.AgentID <> 0 ";
                /*            
				if ($userid > 0) {
					//$sql .= " AND d.CourseUser = {$userid} ";
				    $sql .= " AND a.ConsultantID = {$userid} ";
                }
                */
				$sql .= " Group by a.AgentID  ";
    	}
    	
		if ($from != "" && $to != ""){
			$sql .= " AND  a.Sem1Date >= '{$from}' AND a.Sem1Date <= '{$to}' ";
		}
		
    	if ($sql == "") {
    		return array();
    	}	
        //echo $sql."<br/>";
	    $this->query($sql);
	    $_arr = array();
	    while ($this->fetch()){
	    	$_arr[$this->AgentID]['stdcnt'] = $this->StdCnt;
	    	$_arr[$this->AgentID]['offer' ] = $this->OfferCnt;
	    	$_arr[$this->AgentID]['coe' ]   = $this->CoeCnt;
	    	$_arr[$this->AgentID]['rcomm' ] = $this->RComm;
	    	$_arr[$this->AgentID]['pcomm' ] = $this->PComm;
            $_arr[$this->AgentID]['uid' ]   = $this->uid;   
	    }
	    return $_arr;
    }
    
    function getAgentListNumRows($rAgentID = 0){
        $sql = "select count(*) as cnt from agent ";
        if($rAgentID > 0){
            $sql = " Where ID = {$rAgentID} ";
        }
        $this->query($sql);
        while($this->fetch()){
            return $this->cnt;
        }
        return 0;
    }    
    
    
    function setAgent($agent_id, $sets){
		foreach ($sets as &$v){
			$v = addslashes($v);
		}        
        $sql = "Update agent SET Name = '{$sets['name']}', Country = '{$sets['country']}', Contact = '{$sets['contact']}', Phone = '{$sets['tel']}', Email = '{$sets['email']}', Address = '{$sets['add']}', Form = '{$sets['type']}', Note = '{$sets['note']}' , Web = '{$sets['web']}', City = '{$sets['city']}', StatusID = '{$sets['status']}', isVerify = '{$sets['verify']}', CATE_NAME = '{$sets['cate']}', user_id = '{$sets['uid']}', WECHAT_ID = '{$sets['wechatid']}', STATE = '{$sets['state']}', POSITION = '{$sets['pos']}'  Where ID = {$agent_id} "; 
        return $this->query($sql); 
    }
    
    function addAgent($sets){
		foreach ($sets as &$v){
			$v = addslashes($v);
		}   
        $sql = "insert into `geic`.`agent` (Name, Country, Contact, Phone, Email, Address, Note, Form, StatusID, City, Web, isVerify, CATE_NAME, user_id, WECHAT_ID, POSITION, STATE) values " .
                    "('{$sets['name']}', '{$sets['country']}', '{$sets['contact']}', '{$sets['tel']}', '{$sets['email']}', '{$sets['add']}', '{$sets['note']}', '{$sets['type']}', '{$sets['status']}', '{$sets['city']}', '{$sets['web']}', '{$sets['verify']}', '{$sets['cate']}', '{$sets['uid']}', '{$sets['wechatid']}', '{$sets['pos']}', '{$sets['state']}') ";
        $this->query($sql);
        return $this->getLastInsertID();
    }    


	function delProcess($pid){
		if($pid > 0){
			$sql = "delete from agent_process where ID = {$pid}";
			return $this->query($sql);
		}
		return false;
	}
	
	function getProcessOrder($pid=0, $agentid=0){
		$sql = "";
		if($pid > 0){
			$sql = "select OrderID from agent_process where ID = '{$pid}'";

		}elseif($agentid > 0){
			$sql = "select if(Max(OrderID) is null, 0, max(OrderID)) as OrderID from agent_process where AgentID = '{$agentid}'";
		}
		$this->query($sql);
		while ($this->fetch()){
			return $this->OrderID;
		}
		return 0;
	}

	function resetProcessOrder($agentid, $orderid){
		if($agentid > 0){
			$sql = "Update agent_process SET OrderID = OrderID + 1 where AgentID = '{$agentid}' and OrderID > '{$orderid}' ";
			return $this->query($sql);
		}
	}

	function setProcess($pid, $sets){
		if ($pid > 0){
			foreach ($sets as &$v){
				$v = addslashes($v);
			}
			$sql = "Update agent_process SET BeginDate = '{$sets['date']}', Subject = '{$sets['subject']}', Detail = '{$sets['detail']}', DueDate = '{$sets['due']}', Done = '{$sets['done']}' where ID = '{$pid}'";
			return $this->query($sql); 
		}
	}
	
	function addProcess($aid, $sets){
		if ($aid > 0){
			foreach ($sets as &$v){
				$v = addslashes($v);
			}
			$sql = "insert into `agent_process` (AgentID, BeginDate, Subject, Detail, DueDate, Done, OrderID) values ({$aid}, '{$sets['date']}', '{$sets['subject']}', '{$sets['detail']}', '{$sets['due']}', '{$sets['done']}', '{$sets['order']}')"; 
			return $this->query($sql); 
		}
	}
	
	function getProcess($aid){
		$_arr = array();
		if ($aid > 0){
			$sql = "select ID, AgentID, BeginDate, Subject, Detail, DueDate, Done from agent_process Where AgentID = {$aid}";
			
			$sql .= " order by OrderID asc";
			$this->query($sql);
			while ($this->fetch()){
				$_arr[$this->ID]['date']    = $this->BeginDate;
				$_arr[$this->ID]['subject'] = $this->Subject;
				$_arr[$this->ID]['detail']  = $this->Detail;
				$_arr[$this->ID]['due']     = $this->DueDate;
				$_arr[$this->ID]['done']    = $this->Done;
			}
		}	
			return $_arr;
	}		        

	function getAgentType($aid){
		if ($aid > 0) {
			$sql = "select Form from agent where ID = '{$aid}' ";
			$this->query($sql);
			while ($this->fetch()) {
				return $this->Form;
			}
		}
		return false;
	}
	
	function countStudent($from, $to, $aid, $userid=0){
		if ($aid > 0){
			$sql = "select a.ID, b.CID, b.LName, b.FName, a.IID, a.QualID, a.MajorID, a.ConsultantID, a.IsActive, a.Refuse, if(e.StartDate is null, '0000-00-00', e.StartDate) as StartDate,
							if(CoeCnt is null, 0, OfferCnt) as OfferCnt, 
							if(CoeCnt is null, 0, CoeCnt) as CoeCnt, 
							if(cocomm is null,0.00, cocomm) as cocomm, 
							if(pcomm is null, 0.00, pcomm) as pcomm 
					from client_course a left join client_info b on(a.CID = b.CID) 
								left join (select CCID, Sum(if(ProcessID = 2, 1, 0)) as OfferCnt, Sum(if(ProcessID = 5, 1, 0)) as CoeCnt from client_course_process where done = 1 group by CCID) as c on(c.CCID = a.ID)
								left join (select CCID, sum(if(CoComm is null, 0, CoComm)) as cocomm, sum(if(CoDate is null or CoDate = '0000-00-00', 0, CoComm)) as pcomm from client_course_sem Group by CCID) as d on(d.CCID = a.ID)
								left join (select CCID, StartDate from client_course_sem where SEM = 1 Group by CCID) as e on(e.CCID = a.ID) ";
			if (strtoupper($this->getAgentType($aid)) == "TOP") {
				$sql .= " where a.AgentID = '{$aid}' ";	//and a.IsActive = 1
			}else if (strtoupper($this->getAgentType($aid)) == "SUB") {
				$sql .= " where b.AgentID = '{$aid}' "; //and a.IsActive = 1
			}else {
				return array();
			}
 					
			if ($from != "" && $to != ""){
				$sql .= " AND  a.SEM1Date >= '{$from}' AND a.SEM1Date <= '{$to}' ";
			}
            /*
			if ($userid > 0 ) {//&& strtoupper($this->getAgentType($aid)) == "SUB"
				//$sql .= " AND b.CourseUser = {$userid} ";
			    $sql .= " AND a.ConsultantID = {$userid} ";
            }
            */
            $sql .= " order by  CoeCnt desc, OfferCnt desc, e.StartDate desc, b.LName asc, b.FName asc, a.IsActive asc ";//Group BY a.CID
            //echo $sql."<br/>";
			$_arr = array();
			$this->query($sql);
			while ($this->fetch()){
				$_arr[$this->ID]['school'] = $this->IID;
				$_arr[$this->ID]['cid']   = $this->CID;
				$_arr[$this->ID]['lname'] = $this->LName;
				$_arr[$this->ID]['fname'] = $this->FName;
				$_arr[$this->ID]['course']= $this->QualID;
				$_arr[$this->ID]['major'] = $this->MajorID;
				$_arr[$this->ID]['coe']   = $this->CoeCnt;
				$_arr[$this->ID]['offer'] = $this->OfferCnt;
				$_arr[$this->ID]['cuser'] = $this->ConsultantID;
				$_arr[$this->ID]['active']= $this->IsActive;
				$_arr[$this->ID]['refuse']= $this->Refuse;
				$_arr[$this->ID]['pcomm'] = $this->pcomm;
				$_arr[$this->ID]['ccomm'] = $this->cocomm;
				$_arr[$this->ID]['coedate'] = $this->StartDate;
			}
			return $_arr;
		}
	}
	
	function countStudentNumRows($from, $to, $aid, $userid=0){
		if($aid > 0){
			$sql = "select count(DISTINCT a.CID) as TotalCnt, sum(if(CoeCnt is null, 0, OfferCnt)) as OfferCnt, sum(if(CoeCnt is null, 0, CoeCnt)) as CoeCnt from client_course a 
								left join (select CCID, Sum(if(ProcessID = 2, 1, 0)) as OfferCnt, Sum(if(ProcessID = 5, 1, 0)) as CoeCnt from client_course_process where done = 1 group by CCID) as c on(c.CCID = a.ID)
								left join (select CCID, StartDate from client_course_sem where SEM = 1 Group by CCID) as e on(e.CCID = a.ID)
 								left join client_info d ON(a.CID = d.CID)";
					
			if (strtoupper($this->getAgentType($aid)) == "TOP") {
				$sql .= " where a.AgentID = '{$aid}' ";//and a.IsActive = 1";	
			}else if (strtoupper($this->getAgentType($aid)) == "SUB") {
				$sql .= " where d.AgentID = '{$aid}' ";//and a.IsActive = 1
			}else {
				return array();
			}			
			if ($from != "" && $to != ""){
				$sql .= " AND a.Sem1Date >= '{$from}' AND a.Sem1Date <= '{$to}' ";
			}
            /*
			if ($userid > 0 && strtoupper($this->getAgentType($aid)) == "SUB") {
				//$sql .= " AND d.CourseUser = {$userid} ";
			     $sql .= " AND a.ConsultantID = {$userid} ";
            }
            */
			$this->query($sql);
			$_arr = array('total'=>0, 'offer'=>0, 'coe'=>0);
			while ($this->fetch()){
				$_arr['total'] = $this->TotalCnt;
				$_arr['offer'] = $this->OfferCnt;
				$_arr['coe']   = $this->CoeCnt;
			}			
			return $_arr;
		}
	}

	function generateCode($agentid) {
	    if ($agentid > 0) {
	    	$code = substr(md5(time()), 0, 8);
	    	$sql = "UPDATE agent SET REFCODE = '{$code}' WHERE ID = {$agentid} ";
	    	$this->query($sql);
	   		return $code;
	   	}
	   	return '';
	}

	function getAgentIDByCode($code) {
		if ($code == '')
			return 0;
	
		$sql = "SELECT ID FROM agent WHERE REFCODE = '{$code}'";
		$this->query($sql);
		$this->fetch();
		return $this->ID;
	}
}
?>
