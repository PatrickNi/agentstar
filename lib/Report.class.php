<?php
require_once('MysqlDB.class.php');

class ReportAPI extends MysqlDB {

    function ReportAPI($host, $user, $pswd, $database, $debug) {
    	$this->MysqlDB($host, $user, $pswd, $database, $debug);
    }
    
    
    function getUrgentVisa($userid, $sort_list, $null_du=1, $page=1, $page_size=50){
		$_arr = array();

		$sql = "select SQL_CALC_FOUND_ROWS a.ID, concat(LName, ' ', FName) as ClientName, VisaName, ClassName, IF(a.ItemID > 0, Item, ExItem) as Item, DueDate, BeginDate, f.CID, CVID,
		               if(((a.DueDate >= Date(NOW()) and a.DueDate < Date(NOW()) + INTERVAL 7 Day) or a.DueDate < Date(NOW()))and a.DueDate <> '0000-00-00',0,1) as isTodo,
		               if(a.DueDate = '0000-00-00', '9999-99-99', a.DueDate) as sortdue 
    				from client_visa_process a left join visa_rs_item c on(a.ItemID = c.ItemID) ,  client_visa  b, visa_category d,  visa_subclass e, client_info f   
					where a.Done = 0 and a.CVID = b.ID and b.CID = f.CID and b.CateID = d.CateID and b.SubClassID = e.SubClassID ";
		//((a.DueDate >= Date(NOW()) and a.DueDate < Date(NOW()) + INTERVAL 7 Day) or a.DueDate < Date(NOW()))and a.DueDate <> '0000-00-00' and	
		if ($null_du)
			$sql .= " AND a.DueDate <> '0000-00-00' ";	

		if ($userid > 0){
			$sql .= " AND b.VUserID = {$userid} "; //(b.AUserID = {$userid} or 
		}
        elseif ($userid == -1) {
            $sql .= " AND b.VUSERID = 0 ";
        }

		if ($sort_list != ''){
	        $sql .= " Order by {$sort_list}";
		}
		else{
            $sql .= " Order by sortdue asc, Name asc, Item desc";	
		}
		//$sql .= " limit 200 ";
        //$sql .= " LIMIT ".($page - 1)*$page_size .", {$page_size} " 
        //echo $sql."<br/>";
		$this->query($sql);
		while ($this->fetch()){
			$_arr[$this->ID]['name'] = $this->ClientName;
			$_arr[$this->ID]['item']  = $this->Item;
	        if (strpos(strtolower($_arr[$this->ID]['item']), 'lodged') !== FALSE){
                $_arr[$this->ID]['islodge'] = 1;
            }
            else{
                $_arr[$this->ID]['islodge'] = 0;
            }
			$_arr[$this->ID]['cate']  = $this->VisaName;
			$_arr[$this->ID]['class'] = $this->ClassName;
			$_arr[$this->ID]['begin'] = $this->BeginDate;
			$_arr[$this->ID]['due']   = $this->DueDate;
			$_arr[$this->ID]['clientid']= $this->CID;
			$_arr[$this->ID]['visaid']  = $this->CVID;
			$_arr[$this->ID]['isTodo']  = $this->isTodo;
		}
		return $_arr;
	}        


    function getUrgentLegal($userid, $sort_list, $null_du=1, $page=1, $page_size=50){
        $_arr = array();

        $sql = "select SQL_CALC_FOUND_ROWS a.ID, concat(LName, ' ', FName) as ClientName, d.Name AS VisaName, ClassName, IF(a.ItemID > 0, Item, ExItem) as Item, DueDate, BeginDate, f.CID, CVID,
                       if(((a.DueDate >= Date(NOW()) and a.DueDate < Date(NOW()) + INTERVAL 7 Day) or a.DueDate < Date(NOW()))and a.DueDate <> '0000-00-00',0,1) as isTodo,
                       if(a.DueDate = '0000-00-00', '9999-99-99', a.DueDate) as sortdue 
                    from client_legal_process a left join legal_step c on(a.ItemID = c.ItemID) ,  client_legal  b, legal_category d,  legal_subclass e, client_info f   
                    where a.Done = 0 and a.CVID = b.ID and b.CID = f.CID and b.CateID = d.CateID and b.SubClassID = e.SubClassID ";
        //((a.DueDate >= Date(NOW()) and a.DueDate < Date(NOW()) + INTERVAL 7 Day) or a.DueDate < Date(NOW()))and a.DueDate <> '0000-00-00' and    
        if ($null_du)
            $sql .= " AND a.DueDate <> '0000-00-00' ";    

        if ($userid > 0){
            $sql .= " AND b.VUserID = {$userid} "; //(b.AUserID = {$userid} or 
        }

        if ($sort_list != ''){
            $sql .= " Order by {$sort_list}";
        }
        else{
            $sql .= " Order by sortdue asc, Name asc, Item desc";    
        }
        
        $sql .= " LIMIT ".($page - 1)*$page_size .", {$page_size} "; 
        //echo $sql;
        $this->query($sql);
        while ($this->fetch()){
            $_arr[$this->ID]['name'] = $this->ClientName;
            $_arr[$this->ID]['item']  = $this->Item;
            if (strpos(strtolower($_arr[$this->ID]['item']), 'lodged') !== FALSE){
                $_arr[$this->ID]['islodge'] = 1;
            }
            else{
                $_arr[$this->ID]['islodge'] = 0;
            }
            $_arr[$this->ID]['cate']  = $this->VisaName;
            $_arr[$this->ID]['class'] = $this->ClassName;
            $_arr[$this->ID]['begin'] = $this->BeginDate;
            $_arr[$this->ID]['due']   = $this->DueDate;
            $_arr[$this->ID]['clientid']= $this->CID;
            $_arr[$this->ID]['visaid']  = $this->CVID;
            $_arr[$this->ID]['isTodo']  = $this->isTodo;
        }
        return $_arr;
    }  
	
	function getUrgentCourse($userid, $sort_list, $only_course, $null_du = 1){
		$_arr = array();
    	$sql = "select a.ID, concat(LName, ' ', FName) as ClientName, Qual, Major, e.Name, DueDate, BeginDate, if(p.ID is not null, p.Process, ExItem) as ProcessName, f.CID, CCID,
            if(((a.DueDate >= Date(NOW()) and a.DueDate < Date(NOW()) + INTERVAL 7 Day) or a.DueDate < Date(NOW()))and a.DueDate <> '0000-00-00',0,1) as isTodo,
                if(a.DueDate = '0000-00-00', '9999-99-99', a.DueDate) as sortdue, if(p.ID > 0, p.ID, 0) AS ProcessID  
    				from client_course_process a left join course_process p on (a.ProcessID = p.ID), client_course  b,  institute_qual c,  institute_major d, institute e, client_info f
					where b.CID = f.CID and a.Done = 0 and a.CCID = b.ID and b.QualID = c.ID and b.MajorID = d.ID and b.IID = e.ID ";
    	//a.DueDate >= Date(NOW()) and 
		if ($userid > 0 && $only_course == 0){
			$sql .= " AND b.ConsultantID = {$userid}";
		}
		
		if ($only_course == 1){
		    $sql .= " AND f.ClientType like '%sutdy%' ";
		}
		
		if ($null_du)
			$sql .= " AND a.DueDate <> '0000-00-00' ";	
        //$sql .= " AND a.DueDate > '0000-00-00' AND a.DueDate <= NOW() + INTERVAL 30 DAY ";  

	    if ($sort_list != ''){
            $sql .= " Order by {$sort_list}";
        }
        else{
            $sql .= " Order by sortdue asc, ClientName asc ";   
        }
        //$sql .= " limit 200 ";
		//echo $sql."<br>";
		$this->query($sql);
		
		global $course_process_arr;
		while ($this->fetch()){
			$_arr[$this->ID]['name']  = $this->ClientName;
			$_arr[$this->ID]['qual']   = $this->Qual;
			$_arr[$this->ID]['major']  = $this->Major;
			$_arr[$this->ID]['school'] = $this->Name;
			$_arr[$this->ID]['begin']  = $this->BeginDate;
			$_arr[$this->ID]['due']    = $this->DueDate;
			$_arr[$this->ID]['item']   = $this->ProcessName;//($this->ProcessID > 0 && array_key_exists($this->ProcessID, $course_process_arr))? $course_process_arr[$this->ProcessID] : $this->ExItem;
			$_arr[$this->ID]['clientid'] = $this->CID;
			$_arr[$this->ID]['courseid'] = $this->CCID;
            $_arr[$this->ID]['isTodo'] = $this->isTodo;
            $_arr[$this->ID]['isColor'] = ($this->ProcessID == __C_RECEIVE_OFFER || $this->ProcessID == __C_PASS_OFFER || $this->ProcessID == __C_GET_COE || ($this->ProcessID == 0 && stripos($this->ProcessName, 'p:') === 0))? 1 : 0;
		}
		return $_arr;
	}

    function getUrgentVerifyMigration($userid = 0, $sort_list, $null_du = 1){
        $_arr = array();
        $sql = "select a.ID, concat(LName, ' ', FName) as ClientName, Qual, Major, e.Name, DueDate, BeginDate, if(p.ID is not null, p.Process, ExItem) as ProcessName, f.CID, CCID,
            if(((a.DueDate >= Date(NOW()) and a.DueDate < Date(NOW()) + INTERVAL 7 Day) or a.DueDate < Date(NOW()))and a.DueDate <> '0000-00-00',0,1) as isTodo,
                if(a.DueDate = '0000-00-00', '9999-99-99', a.DueDate) as sortdue, if(p.ID > 0, p.ID, 0) AS ProcessID  
                    from client_course_process a left join course_process p on (a.ProcessID = p.ID), client_course  b,  institute_qual c,  institute_major d, institute e, client_info f
                    where b.CID = f.CID and a.Done = 0 and a.CCID = b.ID and b.QualID = c.ID and b.MajorID = d.ID and b.IID = e.ID  AND a.DueDate <> '0000-00-00' and verify_migration_agent = {$userid} and a.ExItem = 'verify migration course' ";

        if ($sort_list != ''){
            $sql .= " Order by {$sort_list}";
        }
        else{
            $sql .= " Order by sortdue asc, ClientName asc ";   
        }
        //$sql .= " limit 200 ";
        //echo $sql."<br>";
        $this->query($sql);
        
        global $course_process_arr;
        while ($this->fetch()){
            $_arr[$this->ID]['name']  = $this->ClientName;
            $_arr[$this->ID]['qual']   = $this->Qual;
            $_arr[$this->ID]['major']  = $this->Major;
            $_arr[$this->ID]['school'] = $this->Name;
            $_arr[$this->ID]['begin']  = $this->BeginDate;
            $_arr[$this->ID]['due']    = $this->DueDate;
            $_arr[$this->ID]['item']   = $this->ProcessName;//($this->ProcessID > 0 && array_key_exists($this->ProcessID, $course_process_arr))? $course_process_arr[$this->ProcessID] : $this->ExItem;
            $_arr[$this->ID]['clientid'] = $this->CID;
            $_arr[$this->ID]['courseid'] = $this->CCID;
            $_arr[$this->ID]['isTodo'] = $this->isTodo;
            $_arr[$this->ID]['isColor'] = ($this->ProcessID == __C_RECEIVE_OFFER || $this->ProcessID == __C_PASS_OFFER || $this->ProcessID == __C_GET_COE || ($this->ProcessID == 0 && stripos($this->ProcessName, 'p:') === 0))? 1 : 0;
        }
        return $_arr;
    }

	function getUrgentInstitute($sort_list, $null_du = 1){
		$_arr = array();
		$sql = "select a.ID, a.Subject, a.BeginDate, a.DueDate, a.InstID, b.Name, if(ic.Category is not null, ic.Category, 'Unkonwn') as cate,
            if(((a.DueDate >= Date(NOW()) and a.DueDate < Date(NOW()) + INTERVAL 7 Day) or a.DueDate < Date(NOW()))and a.DueDate <> '0000-00-00',0,1) as isTodo ,
                 if(a.DueDate = '0000-00-00', '9999-99-99', a.DueDate) as sortdue
		        from institute_process a, institute b left join institute_category ic on (b.CateID = ic.ID)
				where a.Done = 0 and a.InstID = b.ID 
				";
		if ($null_du)
			$sql .= " AND a.DueDate <> '0000-00-00' ";	

	    if ($sort_list != ''){
            $sql .= " Order by cate asc, {$sort_list}";
        }
        else{
            $sql .= " Order by cate asc,  sortdue desc, Name asc ";   
        }
        //$sql .= " limit 200 ";
		$this->query($sql);		
		while ($this->fetch()) {
            $_arr[$this->ID]['cate'] = $this->cate;
			$_arr[$this->ID]['school'] = $this->Name;
			$_arr[$this->ID]['begin'] = $this->BeginDate;
			$_arr[$this->ID]['due'] = $this->DueDate;
			$_arr[$this->ID]['item'] = $this->Subject;
			$_arr[$this->ID]['iid'] = $this->InstID;
			$_arr[$this->ID]['isTodo'] = $this->isTodo;
		}
		return $_arr;
	}
	
	function getUrgentAgent($sort_list, $form='sub', $null_du=1){

		$_arr = array();
		$sql = "select a.ID, a.Subject, a.BeginDate, a.DueDate, a.AgentID, b.Name,
            if(((a.DueDate >= Date(NOW()) and a.DueDate < Date(NOW()) + INTERVAL 7 Day) or a.DueDate < Date(NOW()))and a.DueDate <> '0000-00-00',0,1) as isTodo ,
                 if(a.DueDate = '0000-00-00', '9999-99-99', a.DueDate) as sortdue
		        from agent_process a, agent b
				where a.Done = 0 and a.AgentID = b.ID and b.Form = '{$form}'  
				";
		if ($null_du)
			$sql .= " AND a.DueDate <> '0000-00-00' ";	


        if ($sort_list != ''){
            $sql .= " Order by {$sort_list}";
        }
        else{
            $sql .= " Order by sortdue desc, Name asc ";   
        }
        
        //echo $sql."<br/>";
		//$sql .= " limit 200 ";
		$this->query($sql);		
		while ($this->fetch()) {
			$_arr[$this->ID]['agent'] = $this->Name;
			$_arr[$this->ID]['begin'] = $this->BeginDate;
			$_arr[$this->ID]['due'] = $this->DueDate;
			$_arr[$this->ID]['item'] = $this->Subject;
			$_arr[$this->ID]['aid'] = $this->AgentID;
			$_arr[$this->ID]['isTodo'] = $this->isTodo;
		}
		return $_arr;
	}
	

    function checkYearDob($cid, $year_dob, $user_id) {
        $sql = "insert ignore into birthday_mention (cid, year_dob, created, user_id) values ('{$cid}', '{$year_dob}', NOW(), '{$user_id}')";
        return $this->query($sql);
    }
	
    function getUrgentService($userid, $sort_list, $null_du=1){
		$_arr = array();
        $year = date('Y');
        $month_day  = date('m-d');
        $sql = "SELECT CID, DOB, concat(LName, ' ', FName) as ClientName FROM client_info WHERE DOB like '%{$month_day}' order by ClientName";
        $this->query($sql);
        while ($this->fetch()) {
            $_arr[$this->CID]['name'] = $this->ClientName;
            $_arr[$this->CID]['item']  = "Birthday at {$year}-{$month_day}";
            $_arr[$this->CID]['begin'] = $year.'-'.$month_day;
            $_arr[$this->CID]['due']   = $year.'-'.$month_day;
            $_arr[$this->CID]['clientid'] = $this->CID;
            $_arr[$this->CID]['isTodo']   = 1;  
        }

        if ($userid > 0 && count($_arr) > 0) {
            $sql = "SELECT distinct CID FROM client_course WHERE ConsultantID = {$userid} and CID in (".implode(',', array_keys($_arr)).")";
            $this->query($sql);
            while ($this->fetch()) {
                $_arr[$this->CID]['keep'] = 1;
            }

            $sql = "SELECT distinct CID FROM client_visa WHERE AUserID = {$userid} and CID in (".implode(',', array_keys($_arr)).")";
            $this->query($sql);
            while ($this->fetch()) {
                $_arr[$this->CID]['keep'] = 1;
            }

            foreach ($_arr as $cid => $v) {
                if (!isset($v['keep']))
                    unset($_arr[$cid]);
            }
        }

        if (count($_arr) > 0) {
            $sql = "SELECT CID, YEAR_DOB FROM birthday_mention WHERE CID in (".implode(',', array_keys($_arr)).")";
            $this->query($sql);
            while ($this->fetch()) {
                if (isset($_arr[$this->CID]) && $_arr[$this->CID]['due'] == $this->YEAR_DOB)
                    $_arr[$this->CID]['isTodo'] = 0;
            }
        }


        return $_arr;
    }	


	
    function getTodoVisa($userid, $sort_key, $sort_ord){
		$_arr = array();
		$condition = "";
		if ($userid > 0){
			$condition = " AND b.VUserID = {$userid} "; //;(b.AUserID = {$userid} or 
		}
		
        if ($sort_key != '' && $sort_ord != ''){
            $sqlord = " Order by {$sort_key} {$sort_ord}";
        }
        else{
            $sqlord = " Order by a.Duedate asc, Name asc, ItemID desc";   
        }
        		
		$sql = array("SELECT a.ID, concat(LName, ' ', FName) as ClientName, VisaName, ClassName, Item, a.ItemID, DueDate, BeginDate, ExItem, f.CID, CVID 
    			 	  FROM client_visa_process a left join visa_rs_item c on(a.ItemID = c.ItemID),  client_visa  b, visa_category d, visa_subclass e, client_info f    
				      WHERE a.DueDate > Date(NOW()) + INTERVAL 7 Day {$condition} 
				 		    and a.Done = 0 and a.CVID = b.ID and b.CID = f.CID and b.CateID = d.CateID and b.SubClassID = e.SubClassID
				 	  {$sqlord}",
					  "SELECT a.ID, concat(LName, ' ', FName) as ClientName, VisaName, ClassName, Item, a.ItemID, DueDate, BeginDate, ExItem, f.CID, CVID 
    			 	   FROM client_visa_process a left join visa_rs_item c on(a.ItemID = c.ItemID),  client_visa  b, visa_category d, visa_subclass e, client_info f    
				       WHERE (a.DueDate = '' or a.DueDate = '0000-00-00' ) {$condition} 
				 		    and a.Done = 0 and a.CVID = b.ID and b.CID = f.CID and b.CateID = d.CateID and b.SubClassID = e.SubClassID"
		             );
		        
		foreach($sql as $_sql){             
			$this->query($_sql);
			while ($this->fetch()){
				$_arr[$this->ID]['name'] = $this->ClientName;
				$_arr[$this->ID]['item']  = $this->ItemID > 0? $this->Item : $this->ExItem;
				if (strpos(strtolower($_arr[$this->ID]['item']), 'lodged') !== FALSE){
					$_arr[$this->ID]['islodge'] = 1;
				}
				else{
					$_arr[$this->ID]['islodge'] = 0;
				}
				$_arr[$this->ID]['cate']  = $this->VisaName;
				$_arr[$this->ID]['class'] = $this->ClassName;
				$_arr[$this->ID]['begin'] = $this->BeginDate;
				$_arr[$this->ID]['due']   = $this->DueDate;
				$_arr[$this->ID]['clientid']= $this->CID;
				$_arr[$this->ID]['visaid']  = $this->CVID;
				$_arr[$this->ID]['isTodo']  = 1;
			}
		}
		return $_arr;
	}        

	
	function getTodoCourse($userid, $sort_key, $sort_ord){
		$_arr = array();
    	$condition = "";
		if ($userid > 0){
			$condition = " AND f.CourseUser = {$userid}";
		}
		
	    if ($sort_key != '' && $sort_ord != ''){
            $sqlord = " Order by {$sort_key} {$sort_ord}";
        }
        else{
            $sqlord = " Order by a.DueDate asc, ClientName asc ";   
        }
		
		$sql = array("SELECT a.ID, concat(LName, ' ', FName) as ClientName, Qual, Major, e.Name, DueDate, BeginDate, if(p.ID is not null, p.Process, ExItem) as ProcessName, f.CID, CCID 
    				  FROM client_course_process a left join course_process p on (a.ProcessID = p.ID), client_course  b,  institute_qual c,  institute_major d, institute e, client_info f
					  WHERE a.DueDate > Date(NOW()) + INTERVAL 7 Day {$condition} 
					  		and b.CID = f.CID and a.Done = 0 and a.CCID = b.ID and b.QualID = c.ID and b.MajorID = d.ID and b.IID = e.ID 
					  		{$sqlord}",
					  "SELECT a.ID, concat(LName, ' ', FName) as ClientName, Qual, Major, e.Name, DueDate, BeginDate, if(p.ID is not null, p.Process, ExItem) as ProcessName, f.CID, CCID 
    				  FROM client_course_process a left join course_process p on (a.ProcessID = p.ID), client_course  b,  institute_qual c,  institute_major d, institute e, client_info f
					  WHERE (a.DueDate = '' or a.DueDate = '0000-00-00') {$condition} 
					  		and b.CID = f.CID and a.Done = 0 and a.CCID = b.ID and b.QualID = c.ID and b.MajorID = d.ID and b.IID = e.ID 
					  "
					);
		global $course_process_arr;		
		foreach ($sql as $_sql){		
			$this->query($_sql);
			while ($this->fetch()){
				$_arr[$this->ID]['name']  = $this->ClientName;
				$_arr[$this->ID]['qual']   = $this->Qual;
				$_arr[$this->ID]['major']  = $this->Major;
				$_arr[$this->ID]['school'] = $this->Name;
				$_arr[$this->ID]['begin']  = $this->BeginDate;
				$_arr[$this->ID]['due']    = $this->DueDate;
				$_arr[$this->ID]['item']   = $this->ProcessName;//($this->ProcessID > 0 && array_key_exists($this->ProcessID, $course_process_arr))? $course_process_arr[$this->ProcessID] : $this->ExItem;
				$_arr[$this->ID]['clientid'] = $this->CID;
				$_arr[$this->ID]['courseid'] = $this->CCID;
				$_arr[$this->ID]['isTodo']  = 1;
			}
		}
		return $_arr;
	}
	
	function getTodoInstitute($sort_key, $sort_ord){
		
	    if ($sort_key != '' && $sort_ord != ''){
            $sqlord = " Order by {$sort_key} {$sort_ord}";
        }
        else{
            $sqlord = " Order by a.DueDate asc, Name asc ";   
        }
        
		$_arr = array();
		$sql = array("SELECT a.ID, a.Subject, a.BeginDate, a.DueDate, a.InstID, b.Name 
					  FROM institute_process a, institute b 
					  WHERE a.DueDate > Date(NOW()) + INTERVAL 7 Day and a.Done = 0 and a.InstID = b.ID 
					  {$sqlord} ",
					 "SELECT a.ID, a.Subject, a.BeginDate, a.DueDate, a.InstID, b.Name 
					  FROM institute_process a, institute b 
					  WHERE (a.DueDate = '' or a.DueDate = '0000-00-00') and a.Done = 0 and a.InstID = b.ID"
					 ); 
		foreach ($sql as $_sql){
			$this->query($_sql);		
			while ($this->fetch()) {
				$_arr[$this->ID]['school'] = $this->Name;
				$_arr[$this->ID]['begin'] = $this->BeginDate;
				$_arr[$this->ID]['due'] = $this->DueDate;
				$_arr[$this->ID]['item'] = $this->Subject;
				$_arr[$this->ID]['iid'] = $this->InstID;
				$_arr[$this->ID]['isTodo']  = 1;
			}			
		}

		return $_arr;
	}

	
	function getTodoAgent($sort_key, $sort_ord){
		
	    if ($sort_key != '' && $sort_ord != ''){
            $sqlord = " Order by {$sort_key} {$sort_ord}";
        }
        else{
            $sqlord = " Order by a.DueDate asc, Name asc ";   
        }		
		
		$_arr = array();
		$sql = array("SELECT a.ID, a.Subject, a.BeginDate, a.DueDate, a.AgentID, b.Name 
					  FROM agent_process a, agent b 
					  WHERE a.DueDate > Date(NOW()) + INTERVAL 7 Day and a.Done = 0 and a.AgentID = b.ID 
					  {$sqlord} ",
					 "SELECT a.ID, a.Subject, a.BeginDate, a.DueDate, a.AgentID, b.Name 
					  FROM agent_process a, agent b 
					  WHERE (a.DueDate = '' or a.DueDate = '0000-00-00') and a.Done = 0 and a.AgentID = b.ID 
					  Order by a.DueDate asc, b.Name asc "// 
					);
		foreach ($sql as $_sql){
			$this->query($_sql);		
			while ($this->fetch()) {
				$_arr[$this->ID]['agent'] = $this->Name;
				$_arr[$this->ID]['begin'] = $this->BeginDate;
				$_arr[$this->ID]['due'] = $this->DueDate;
				$_arr[$this->ID]['item'] = $this->Subject;
				$_arr[$this->ID]['aid'] = $this->AgentID;
				$_arr[$this->ID]['isTodo']  = 1;
			}		
		}

		return $_arr;
	}
	
    function getTodoService($userid, $sort_key, $sort_ord){
		$_arr = array();
		$condition = "";
		if ($userid > 0){
			 $condition = " AND b.CourseUser = {$userid} ";
		}		
		
        if ($sort_key != '' && $sort_ord != ''){
            $sqlord = " Order by {$sort_key} {$sort_ord}";
        }
        else{
            $sqlord = " Order by a.Duedate asc, ClientName asc, Subject asc";   
        }
        
    	$sql = array("SELECT a.ID, concat(LName, ' ', FName) as ClientName, a.Subject, DueDate, a.Date, a.CID 
    				  FROM client_service a, client_info b  
					  WHERE a.DueDate > Date(NOW()) + INTERVAL 7 Day {$condition}
					     and a.Done = 0 and a.CID = b.CID and a.VisaCateID = 0 and VisaSubClassID = 0 
					     {$sqlord} ",
					  "SELECT a.ID, concat(LName, ' ', FName) as ClientName, a.Subject, DueDate, a.Date, a.CID 
    				  FROM client_service a, client_info b  
					  WHERE (a.DueDate = '' or a.DueDate = '0000-00-00') {$condition}
					     and a.Done = 0 and a.CID = b.CID and a.VisaCateID = 0 and VisaSubClassID = 0 
					  ");
		foreach ($sql as $_sql){
			$this->query($_sql);
			while ($this->fetch()){
				$_arr[$this->ID]['name'] = $this->ClientName;
				$_arr[$this->ID]['item']  = $this->Subject;
				$_arr[$this->ID]['begin'] = $this->Date;
				$_arr[$this->ID]['due']   = $this->DueDate;
				$_arr[$this->ID]['clientid']   = $this->CID;
				$_arr[$this->ID]['isTodo']  = 1;
			}						        
		}

		return $_arr;
	}        	
	
    function getMainVisa($userid=0) {
        $_arr = array();
        $sql = "select CID, FName, LName, c.VisaName, d.ClassName, ExpirDate as Epd from client_info a left join visa_category c on(a.VisaID = c.CateID) left join visa_subclass d on(a.VisaClassID = d.SubClassID) where ExpirDate >= '2018-05-04' AND CourseUser = {$userid} order by Epd asc";
        $this->query($sql);
        $i=0;
        while ($this->fetch()) {
            $_arr[$i]['cid'] = $this->CID;
            $_arr[$i]['vid'] = 0;
            $_arr[$i]['lname'] = $this->LName;
            $_arr[$i]['fname'] = $this->FName;
            $_arr[$i]['date']  = $this->Epd;
            $_arr[$i]['category']  = $this->VisaName;
            $_arr[$i]['subclass']  = $this->ClassName;
            $_arr[$i]['main']  = 0;
            $i++;
        }
        return $_arr;     
    }

	function getVisaService($userid=0){
		$_arr = array();
		$sql = "select a.ID as VID, a.CID, a.ExpireDate as Epd, b.FName, b.LName, c.VisaName, d.ClassName, 0 as main from client_visa a left join visa_category c on(a.CateID = c.CateID) left join visa_subclass d on(a.SubClassID = d.SubClassID), client_info b where a.CID = b.CID and a.r_Status = 'active' and a.OnShore = 1 and (a.ADate <> '' and a.ADate <> '0000-00-00') AND a.ExpireDate >= '2018-05-04' ";
		if($userid > 0){
			$sql .= " AND (a.AUserID = {$userid} or a.VUserID = {$userid}) ";
		}
		$sql .= "Union all select e.CVID as VID, e.DepID, e.ExpireDate as Epd, b.FName, b.LName, c.VisaName, d.ClassName, a.CID as main from client_visa a left join visa_category c on(a.CateID = c.CateID) left join visa_subclass d on(a.SubClassID = d.SubClassID) , client_visa_dep e, client_info b where e.DepID = b.CID and e.CVID = a.ID and a.r_Status = 'active' and (a.ADate <> '' and a.ADate <> '0000-00-00')  AND a.ExpireDate >= '2018-05-04' ";
		if($userid > 0){
			$sql .= " AND (a.AUserID = {$userid} or a.VUserID = {$userid}) ";
		}		
		$sql .= " order by Epd asc ";
		$this->query($sql);
		$i=0;
		while ($this->fetch()) {
			$_arr[$i]['cid'] = $this->CID;
			$_arr[$i]['vid'] = $this->VID;
			$_arr[$i]['lname'] = $this->LName;
			$_arr[$i]['fname'] = $this->FName;
			$_arr[$i]['date']  = $this->Epd;
			$_arr[$i]['category']  = $this->VisaName;
			$_arr[$i]['subclass']  = $this->ClassName;
			$_arr[$i]['main']  = $this->main;
			$i++;
		}
		return $_arr;
	}
	
	function getOtherService($userid=0){
		$_arr = array();
		$sql = "select a.ID, a.CID, a.DueDate, b.LName, b.FName, c.VisaName, d.ClassName from client_service a left join visa_category c on(c.CateID = a.VisaCateID) left join visa_subclass d on(d.SubClassID = a.VisaSubClassID ), client_info b where a.Done = 0 and a.VisaCateID > 0 and a.CID = b.CID and a.CID not in (select distinct DepID from client_visa_dep t1, client_visa t2 where t1.CVID = t2.ID and t2.r_Status = 'active') AND a.DueDate >= '2018-05-04' ";
		if($userid > 0){
			$sql .= " AND b.CourseUser = {$userid} ";
		}
		$sql .= " order by a.DueDate asc ";
		$this->query($sql);
		while ($this->fetch()) {
			$_arr[$this->ID]['cid'] = $this->CID;
			$_arr[$this->ID]['lname'] = $this->LName;
			$_arr[$this->ID]['fname'] = $this->FName;
			$_arr[$this->ID]['date']  = $this->DueDate;
			$_arr[$this->ID]['category']  = $this->VisaName;
			$_arr[$this->ID]['subclass']  = $this->ClassName;
		}
		return $_arr;		
	}

	function getNumOfCourseClientByUser($fromDay, $toDay, $userid){
		//$sql = "select Date_Format(CourseVisitDate, '%Y%u') as Week,  concat(LName, ' ', FName) as Name, a.CID, School, Qual from client_info a left join (select CID, School, Qual, max(t1.ID) from client_qual t1, school t2, course_qual t3 where t1.SchoolID = t2.ID and t1.QualID = t3.ID Group by t1.CID) b on(b.CID = a.CID) where CourseVisitDate != '0000-00-00' ";
		$sql = "select Date_Format(ConsultantDate, '%Y%u') as Week,  concat(LName, ' ', FName) as Name, t1.CID, t2.ID as CourseID, t2.ProcessID, t3.IsActive from client_info t1 left join (select a.ID as PID, b.CID, b.ID, a.ProcessID from client_course_process a, client_course b where a.ProcessID = ".__C_APPLY_OFFER." and a.CCID = b.ID AND a.Done = 1) t2 on (t1.CID = t2.CID) left join client_course t3 ON(t1.CID = t3.CID) WHERE 1 ";		
		if ($userid > 0) {
			$sql .= " AND ConsultantID = {$userid} ";
		}
		if ($fromDay != "" && $toDay  != "") {
			$sql .= " AND ConsultantDate >= '{$fromDay}' and ConsultantDate <= '{$toDay}' ";
		}
        
		$this->query($sql);
		$_arr = array();
        $clients = array();
		while ($this->fetch()) {
			if ($this->ProcessID == __C_APPLY_OFFER) {
				$_arr[$this->Week]['apo'][$this->CID] = 1;	
			}
			else {
				$_arr[$this->Week]['apo'][$this->CID] = 0;
			}
			if (!isset($_arr[$this->Week]['num'][$this->CID])) {
				$_arr[$this->Week]['num'][$this->CID] = 1;
				$_arr[$this->Week]['refuse'][$this->CID] = $this->IsActive == 2? 1 : 0;				
			}
			else {
				$_arr[$this->Week]['num'][$this->CID] += 1;
				$_arr[$this->Week]['refuse'][$this->CID] += $this->IsActive == 2? 1 : 0;							
			}

			$_arr[$this->Week]['name'][$this->CID] = $this->Name;
			$_arr[$this->Week]['cnt' ] = count($_arr[$this->Week]['name']);	
            $clients[$this->CID] = 1;	
        }

        if (count($clients) > 0) {        
            $sql = "select t1.CID, Date_Format(ConsultantDate, '%Y%u') as Week, MIN(ConsultantDate) as cd from client_info t1 left join (select a.ID as PID, b.CID, b.ID, a.ProcessID from client_course_process a, client_course b where a.ProcessID = ".__C_APPLY_OFFER." and a.CCID = b.ID AND a.Done = 1) t2 on (t1.CID = t2.CID) left join client_course t3 ON (t1.CID = t3.CID) WHERE t1.CID in (".implode(',', array_keys($clients)).") GROUP BY t1.CID HAVING cd >= '{$fromDay}' and cd <= '{$toDay}' ";
            $this->query($sql);
            while ($this->fetch()) {
                if(isset($_arr[$this->Week]) && isset($_arr[$this->Week]['name'][$this->CID]))
                    $_arr[$this->Week]['name_new'][$this->CID] = $_arr[$this->Week]['name'][$this->CID];
            }        
        }
        
        foreach ($_arr as $w => $v) {
            $_arr[$w]['cnt_new'] = isset($_arr[$w]['name_new'])? count($_arr[$w]['name_new']) : 0;
        }
		
		return $_arr;		 
	}
	
	function getAllOfCourseClientByUser($fromDay, $toDay, $userid){
		//$sql = "select count(*) as cnt from client_info where CourseVisitDate != '0000-00-00' ";
		//$sql = "select concat(LName, ' ', FName) as Name, a.CID, School, Qual from client_info a left join (select CID, School, Qual, max(t1.ID) from client_qual t1, school t2, course_qual t3 where t1.SchoolID = t2.ID and t1.QualID = t3.ID Group by t1.CID) b on(b.CID = a.CID) where CourseVisitDate != '0000-00-00' ";
		$sql = "select concat(LName, ' ', FName) as Name, t1.CID, t2.ID as CourseID, t2.ProcessID, t3.IsActive from client_info t1 left join (select a.ID as PID, b.CID, b.ID, a.ProcessID from client_course_process a, client_course b where a.ProcessID = ".__C_APPLY_OFFER." and a.CCID = b.ID AND a.Done = 1) t2 on (t1.CID = t2.CID) left join client_course t3 ON (t1.CID = t3.CID) WHERE 1 ";

		if ($userid > 0) {
			$sql .= " AND ConsultantID = {$userid} ";
		}
		if ($fromDay != "" && $toDay  != "") {
			$sql .= " AND ConsultantDate >= '{$fromDay}' and ConsultantDate <= '{$toDay}' ";
		}		
        
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()) {
			if ($this->ProcessID == __C_APPLY_OFFER) {
				$_arr['all']['apo'][$this->CID] = 1;	
			}
			else {
				$_arr['all']['apo'][$this->CID] = 0;
			}
			$_arr['all']['name'][$this->CID] = $this->Name;

			if (!isset($_arr['all']['num'][$this->CID])) {
				$_arr['all']['num'][$this->CID] = 1;
				$_arr['all']['refuse'][$this->CID] = $this->IsActive == 2? 1 : 0;				
			}
			else {
				$_arr['all']['num'][$this->CID] += 1;
				$_arr['all']['refuse'][$this->CID] += $this->IsActive == 2? 1 : 0;							
			}
		}
        //print_r($_arr);
		$_arr['all']['cnt'] = isset($_arr['all'])? count($_arr['all']['name']) : 0;

        if ($_arr['all']['cnt'] > 0) {
            $sql = "select t1.CID, MIN(ConsultantDate) as cd from client_info t1 left join (select a.ID as PID, b.CID, b.ID, a.ProcessID from client_course_process a, client_course b where a.ProcessID = ".__C_APPLY_OFFER." and a.CCID = b.ID AND a.Done = 1) t2 on (t1.CID = t2.CID) left join client_course t3 ON (t1.CID = t3.CID) WHERE t1.CID in (".implode(',', array_keys($_arr['all']['name'])).") GROUP BY t1.CID HAVING cd >= '{$fromDay}' and cd <= '{$toDay}' ";
            $this->query($sql);
            while ($this->fetch()) {
                if(isset($_arr['all']['name'][$this->CID]))
                    $_arr['all']['name_new'][$this->CID] = $_arr['all']['name'][$this->CID];
            }
        }
        @$_arr['all']['cnt_new'] = isset($_arr['all']['name_new'])? count($_arr['all']['name_new']) : 0;
		return $_arr;		 
	}
		
	function getNumOfCourseProcessByUser($fromDay, $toDay, $userid){	
        $sql = "select Date_Format(BeginDate, '%Y%u') as Week, b.IsActive, b.ID, a.ProcessID, concat(LName, ' ', FName) as Name, d.Name as School, e.Qual, c.CID, c.CreateTime, c.AgentID from client_course_process a, client_info c, client_course b left join institute d on(b.IID = d.ID) left join institute_qual e on(b.QualID = e.ID) where (a.ProcessID = ".__C_RECEIVE_OFFER." or a.ProcessID = ".__C_PASS_OFFER." or a.ProcessID = ".__C_GET_COE." or a.ProcessID = ".__C_PAY_TUITION_FEE.") and a.CCID = b.ID and b.CID = c.CID and a.Done = 1 ";
   
		if ($userid > 0) {
			$sql .= " AND b.ConsultantID = {$userid} ";
		}else{
			
		}
		if ($fromDay != "" && $toDay  != "") {
			$sql .= " AND BeginDate >= '{$fromDay}' and BeginDate <= '{$toDay}' ";
        }
        //echo $sql;
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()) {
			if ($this->ProcessID == __C_RECEIVE_OFFER) {
                $_arr[$this->Week]['aponame'][$this->ID] = $this->Name. " (to ". $this->School ." : ". $this->Qual .")";	
				$_arr[$this->Week]['apocid' ][$this->ID] = $this->CID;
				$_arr[$this->Week]['reo'    ][$this->ID] = 0;	

                if ($this->CreateTime >= $fromDay && $this->CreateTime <= $toDay) {
                    $_arr[$this->Week]['aponame_new'][$this->ID] = $this->Name. " (to ". $this->School ." : ". $this->Qual .")";  
                    
                    $_arr[$this->Week]['apo_new'][$this->CID]=1;
                    if ($this->AgentID > 0) 
                        $_arr[$this->Week]['apo_new_aid'][$this->CID]=1;
                }
                else {
                    $_arr[$this->Week]['aponame_old'][$this->ID] = $this->Name. " (to ". $this->School ." : ". $this->Qual .")";  
                   
                    $_arr[$this->Week]['apo_old'][$this->CID]=1;
                    if ($this->AgentID > 0)
                        $_arr[$this->Week]['apo_old_aid' ][$this->CID] = 1;
                }

				//isset($_arr[$this->Week]['apocnt'])? $_arr[$this->Week]['apocnt']++ : $_arr[$this->Week]['apocnt'] = 1; 
            }
            elseif ($this->ProcessID == __C_PASS_OFFER){
                $_arr[$this->Week]['reoname'][$this->ID] = $this->Name. " (to ". $this->School ." : ". $this->Qual .")";	
				$_arr[$this->Week]['reocid' ][$this->ID] = $this->CID;
				$_arr[$this->Week]['reo'    ][$this->ID] = 1;	
				
                $_arr[$this->Week]['reo_st' ][$this->ID] = $this->IsActive == 2? -1 : 0;	

                if ($this->CreateTime >= $fromDay && $this->CreateTime <= $toDay){
                    $_arr[$this->Week]['reoname_new'][$this->ID] = $this->Name. " (to ". $this->School ." : ". $this->Qual .")";  
                 
                    $_arr[$this->Week]['reo_new'][$this->CID]=1;
                    if ($this->AgentID > 0)
                        $_arr[$this->Week]['reo_new_aid'][$this->CID]=1;
                }
                else {
                    $_arr[$this->Week]['reoname_old'][$this->ID] = $this->Name. " (to ". $this->School ." : ". $this->Qual .")";  
                 
                    $_arr[$this->Week]['reo_old'][$this->CID]=1;
                    if ($this->AgentID > 0)
                        $_arr[$this->Week]['reo_old_aid'][$this->CID] = 1;
                }
				//isset($_arr[$this->Week]['reocnt'])? $_arr[$this->Week]['reocnt']++ : $_arr[$this->Week]['reocnt'] = 1;
            }
            elseif ($this->ProcessID == __C_GET_COE){
                $_arr[$this->Week]['recname'][$this->ID] = $this->Name. " (to ". $this->School ." : ". $this->Qual .")";	
				$_arr[$this->Week]['reccid' ][$this->ID] = $this->CID;	                
				$_arr[$this->Week]['rec'    ][$this->ID] = 1;

                if ($this->CreateTime >= $fromDay && $this->CreateTime <= $toDay){
                    $_arr[$this->Week]['recname_new'][$this->ID] = $this->Name. " (to ". $this->School ." : ". $this->Qual .")";  
                 
                    $_arr[$this->Week]['rec_new'][$this->CID]=1;
                   
                    if ($this->AgentID > 0)
                        $_arr[$this->Week]['rec_new_aid'][$this->CID]=1;
                }
                else {
                    $_arr[$this->Week]['recname_old'][$this->ID] = $this->Name. " (to ". $this->School ." : ". $this->Qual .")";  
                 
                    $_arr[$this->Week]['rec_old'][$this->CID]=1;
                    if ($this->AgentID > 0)
                        $_arr[$this->Week]['rec_old_aid' ][$this->CID] = 1;
                }
				//isset($_arr[$this->Week]['reccnt'])? $_arr[$this->Week]['reccnt']++ : $_arr[$this->Week]['reccnt'] = 1; 
            }
            elseif($this->ProcessID == __C_PAY_TUITION_FEE && isset($_arr[$this->Week]['reo_st'][$this->ID]) && $_arr[$this->Week]['reo_st'][$this->ID] == 0) {
                $_arr[$this->Week]['reo_st'][$this->ID] = 1;
            }            
        }		
        
        foreach ($_arr as $w => $v) {
            $_arr[$w]['apocnt'] = isset($_arr[$w]) && isset($_arr[$w]['aponame']) ? count($_arr[$w]['aponame']): 0;
            $_arr[$w]['reocnt'] = isset($_arr[$w]) && isset($_arr[$w]['reoname']) ? count($_arr[$w]['reoname']): 0;
            $_arr[$w]['reccnt'] = isset($_arr[$w]) && isset($_arr[$w]['recname']) ? count($_arr[$w]['recname']): 0;
		
            $_arr[$w]['apocnt_st'] = isset($_arr[$w]) && isset($_arr[$w]['apo_old']) ? count($_arr[$w]['apo_old']) : 0;
            $_arr[$w]['reocnt_st'] = isset($_arr[$w]) && isset($_arr[$w]['reo_old']) ? count($_arr[$w]['reo_old']): 0;
            $_arr[$w]['reccnt_st'] = isset($_arr[$w]) && isset($_arr[$w]['rec_old']) ? count($_arr[$w]['rec_old']): 0;

            $_arr[$w]['apo_new'] = isset($_arr[$w]) && isset($_arr[$w]['apo_new']) ? count($_arr[$w]['apo_new']) : 0;
            $_arr[$w]['reo_new'] = isset($_arr[$w]) && isset($_arr[$w]['reo_new']) ? count($_arr[$w]['reo_new']): 0;
            $_arr[$w]['rec_new'] = isset($_arr[$w]) && isset($_arr[$w]['rec_new']) ? count($_arr[$w]['rec_new']): 0;

            $_arr[$w]['apocnt_aid'] = isset($_arr[$w]) && isset($_arr[$w]['apo_old_aid']) ? count($_arr[$w]['apo_old_aid']): 0;
            $_arr[$w]['reocnt_aid'] = isset($_arr[$w]) && isset($_arr[$w]['reo_old_aid']) ? count($_arr[$w]['reo_old_aid']): 0;
            $_arr[$w]['reccnt_aid'] = isset($_arr[$w]) && isset($_arr[$w]['rec_old_aid']) ? count($_arr[$w]['rec_old_aid']): 0;

            $_arr[$w]['apo_new_aid'] = isset($_arr[$w]) && isset($_arr[$w]['apo_new_aid']) ? count($_arr[$w]['apo_new_aid']) : 0;
            $_arr[$w]['reo_new_aid'] = isset($_arr[$w]) && isset($_arr[$w]['reo_new_aid']) ? count($_arr[$w]['reo_new_aid']): 0;
            $_arr[$w]['rec_new_aid'] = isset($_arr[$w]) && isset($_arr[$w]['rec_new_aid']) ? count($_arr[$w]['rec_new_aid']): 0;


        }
        return $_arr;			
	}
	
	
	function getAllOfCourseProcessByUser($fromDay, $toDay, $userid){
		$where = "";
		if ($userid > 0) {
			$where .= " AND b.ConsultantID = {$userid} ";
		}
		
		if ($fromDay != "" && $toDay  != "") {
			$where .= " AND BeginDate >= '{$fromDay}' and BeginDate <= '{$toDay}' ";
		}
		//get apply offer
		$sql = "select b.IsActive, b.ID, a.ProcessID, concat(LName, ' ', FName) as Name, d.Name as School, e.Qual, c.CID, ConsultantDate, c.AgentID, c.CreateTime from client_course_process a, client_info c, client_course b left join institute d on(b.IID = d.ID) left join institute_qual e on(b.QualID = e.ID) where (a.ProcessID = ".__C_RECEIVE_OFFER." or a.ProcessID = ".__C_PASS_OFFER." or a.ProcessID = ".__C_GET_COE." or a.ProcessID = ".__C_PAY_TUITION_FEE.") and a.CCID = b.ID and b.CID = c.CID and a.Done = 1 ";
        $this->query($sql.$where);

		$_arr = array();
		while ($this->fetch()) {
			if ($this->ProcessID == __C_RECEIVE_OFFER) {
                $_arr['all']['aponame'][$this->ID] = $this->Name. " (to ". $this->School ." : ". $this->Qual .")";	
				$_arr['all']['apocid' ][$this->ID] = $this->CID;
                

                $_arr['all']['reo'    ][$this->ID] = 0;	
                //$this->ConsultantDate >= $fromDay && $this->ConsultantDate <= $toDay
                if ($this->CreateTime >= $fromDay && $this->CreateTime <= $toDay) {
                    $_arr['all']['aponame_new'][$this->ID] = $this->Name. " (to ". $this->School ." : ". $this->Qual .")";  
                    
                    $_arr['all']['apo_new'][$this->CID]=1;
                    if ($this->AgentID > 0) 
                        $_arr['all']['apo_new_aid'][$this->CID]=1;
                }
                else {
                    $_arr['all']['aponame_old'][$this->ID] = $this->Name. " (to ". $this->School ." : ". $this->Qual .")";  
                   
                    $_arr['all']['apo_old'][$this->CID]=1;
                    if ($this->AgentID > 0)
                        $_arr['all']['apo_old_aid' ][$this->CID] = 1;
                }

            }
            elseif ($this->ProcessID == __C_PASS_OFFER){
                $_arr['all']['reoname'][$this->ID] = $this->Name. " (to ". $this->School ." : ". $this->Qual .")";	
				$_arr['all']['reocid' ][$this->ID] = $this->CID;
                
				
                $_arr['all']['reo'    ][$this->ID] = 1;	
				$_arr['all']['reo_st' ][$this->ID] = $this->IsActive == 2? -1 : 0;

                //$this->ConsultantDate >= $fromDay && $this->ConsultantDate <= $toDay
                if ($this->CreateTime >= $fromDay && $this->CreateTime <= $toDay){
                    $_arr['all']['reoname_new'][$this->ID] = $this->Name. " (to ". $this->School ." : ". $this->Qual .")";  
                 
                    $_arr['all']['reo_new'][$this->CID]=1;
                    if ($this->AgentID > 0)
                        $_arr['all']['reo_new_aid'][$this->CID]=1;
                }
                else {
                    $_arr['all']['reoname_old'][$this->ID] = $this->Name. " (to ". $this->School ." : ". $this->Qual .")";  
                 
                    $_arr['all']['reo_old'][$this->CID]=1;
                    if ($this->AgentID > 0)
                        $_arr['all']['reo_old_aid' ][$this->CID] = 1;
                }

            }
            elseif ($this->ProcessID == __C_GET_COE){
                $_arr['all']['recname'][$this->ID] = $this->Name. " (to ". $this->School ." : ". $this->Qual .")";	
				$_arr['all']['reccid' ][$this->ID] = $this->CID;
				
                $_arr['all']['rec'    ][$this->ID] = 1;
                //$this->ConsultantDate >= $fromDay && $this->ConsultantDate <= $toDay
                if ($this->CreateTime >= $fromDay && $this->CreateTime <= $toDay){
                    $_arr['all']['recname_new'][$this->ID] = $this->Name. " (to ". $this->School ." : ". $this->Qual .")";  
                 
                    $_arr['all']['rec_new'][$this->CID]=1;
                   
                    if ($this->AgentID > 0)
                        $_arr['all']['rec_new_aid'][$this->CID]=1;
                }
                else {
                    $_arr['all']['recname_old'][$this->ID] = $this->Name. " (to ". $this->School ." : ". $this->Qual .")";  
                 
                    $_arr['all']['rec_old'][$this->CID]=1;
                    if ($this->AgentID > 0)
                        $_arr['all']['rec_old_aid' ][$this->CID] = 1;
                }
            }
            elseif($this->ProcessID == __C_PAY_TUITION_FEE && isset($_arr['all']['reo_st'][$this->ID]) && $_arr['all']['reo_st'][$this->ID] == 0) {
                $_arr['all']['reo_st'][$this->ID] = 1;
            }
		}

		$_arr['all']['apocnt'] = isset($_arr['all']) && isset($_arr['all']['aponame']) ? count($_arr['all']['aponame']) : 0;
		$_arr['all']['reocnt'] = isset($_arr['all']) && isset($_arr['all']['reoname']) ? count($_arr['all']['reoname']): 0;
        $_arr['all']['reccnt'] = isset($_arr['all']) && isset($_arr['all']['recname']) ? count($_arr['all']['recname']): 0;

        $_arr['all']['apocnt_st'] = isset($_arr['all']) && isset($_arr['all']['apo_old']) ? count($_arr['all']['apo_old']) : 0;
        $_arr['all']['reocnt_st'] = isset($_arr['all']) && isset($_arr['all']['reo_old']) ? count($_arr['all']['reo_old']): 0;
        $_arr['all']['reccnt_st'] = isset($_arr['all']) && isset($_arr['all']['rec_old']) ? count($_arr['all']['rec_old']): 0;

        $_arr['all']['apo_new'] = isset($_arr['all']) && isset($_arr['all']['apo_new']) ? count($_arr['all']['apo_new']) : 0;
        $_arr['all']['reo_new'] = isset($_arr['all']) && isset($_arr['all']['reo_new']) ? count($_arr['all']['reo_new']): 0;
        $_arr['all']['rec_new'] = isset($_arr['all']) && isset($_arr['all']['rec_new']) ? count($_arr['all']['rec_new']): 0;

        $_arr['all']['apocnt_aid'] = isset($_arr['all']) && isset($_arr['all']['apo_old_aid']) ? count($_arr['all']['apo_old_aid']): 0;
        $_arr['all']['reocnt_aid'] = isset($_arr['all']) && isset($_arr['all']['reo_old_aid']) ? count($_arr['all']['reo_old_aid']): 0;
        $_arr['all']['reccnt_aid'] = isset($_arr['all']) && isset($_arr['all']['rec_old_aid']) ? count($_arr['all']['rec_old_aid']): 0;

        $_arr['all']['apo_new_aid'] = isset($_arr['all']) && isset($_arr['all']['apo_new_aid']) ? count($_arr['all']['apo_new_aid']) : 0;
        $_arr['all']['reo_new_aid'] = isset($_arr['all']) && isset($_arr['all']['reo_new_aid']) ? count($_arr['all']['reo_new_aid']): 0;
        $_arr['all']['rec_new_aid'] = isset($_arr['all']) && isset($_arr['all']['rec_new_aid']) ? count($_arr['all']['rec_new_aid']): 0;

		return $_arr;			
	}

	
	function getAmountOfCourseCommByUser($fromDay, $toDay, $userid){

		$_arr = array();
		$sql = "SELECT  date_format(RedDate, '%Y%u') as wk,
                        concat(LName, ' ', FName) as Name, 
                        c.CID,
                        a.ID,
                        a.CCID,
                        c.DOB,
						IF(t1.BeginDate >= d.StartDate and d.StartDate <> '' and d.StartDate <> '0000-00-00', IF(CoComm > 0 OR Discount > 0, RComm-CoComm-Discount,RedComm-Discount), 0) as bonus,
						IF(t1.BeginDate >= d.StartDate and d.StartDate <> '' and d.StartDate <> '0000-00-00', 0, 1) as nobonus
                FROM client_course_sem a  
                      left join client_course_process t1 on (a.CCID = t1.CCID AND t1.Done = 1 and t1.ProcessID = 5)
                     , client_course b,client_info c, sys_user d
                WHERE a.CCID = b.ID 
                  AND b.CID = c.CID 
                  AND b.ConsultantID = d.ID
                  AND RedDate >= '{$fromDay}' AND RedDate <= '{$toDay}' "; 
	    if ($userid > 0) {
            $sql .= " AND b.ConsultantID = {$userid} ";
        }
        $sql .= " Order by wk, Name, a.SEM ";
		$this->query($sql);
        $i = 0;
		while ($this->fetch()) {
	  //  if($this->bonus == 0) continue;	
            $_arr[$this->wk]['client'][$i] = $this->CID;
            $_arr[$this->wk]['sem'   ][$i] = $this->ID;
            $_arr[$this->wk]['course'][$i] = $this->CCID;
			$_arr[$this->wk]['bonusname'][$i] = $this->Name;
			$_arr[$this->wk]['bonuscomm'][$i] = number_format($this->bonus, '2', '.', ''); 
			$_arr[$this->wk]['bonusfail'][$i] = $this->nobonus;
            $_arr[$this->wk]['dob'      ][$i] = $this->DOB;
            $_arr[$this->wk]['bonus'] = isset($_arr[$this->wk]['bonus'])? $_arr[$this->wk]['bonus'] : 0;
            $_arr[$this->wk]['bonus'] += $this->bonus;
            
            $i++;
        }
		return $_arr;			
	}
	
	
	function getAllOfCourseCommByUser($fromDay, $toDay, $userid){
		      $sql = "SELECT  date_format(RedDate, '%Y-%u') as wk,
                        concat(LName, ' ', FName) as Name, 
                        c.CID, a.ID, a.CCID,c.DOB, ConsultantDate, c.AgentID,
						IF(t1.BeginDate >= d.StartDate and d.StartDate <> '' and d.StartDate <> '0000-00-00', IF(CoComm > 0 OR Discount > 0, RComm-CoComm-Discount,RedComm-Discount), 0) as bonus,
						IF(t1.BeginDate >= d.StartDate and d.StartDate <> '' and d.StartDate <> '0000-00-00', 0, 1) as nobonus
                      FROM client_course_sem a
                        left join client_course_process t1 on (a.CCID = t1.CCID AND t1.Done = 1 and t1.ProcessID = 5)
		                    , client_course b,client_info c, sys_user d
		               WHERE a.CCID = b.ID 
		                  AND b.CID = c.CID 
                          AND b.ConsultantID = d.ID 
                          AND RedDate >= '{$fromDay}' AND RedDate <= '{$toDay}'";
                  
		if ($userid > 0) {
			$sql .= " AND b.ConsultantID = {$userid} ";
        }

        $sql .= " Order by wk, Name, a.SEM ";
        //echo $sql."\n";
		$this->query($sql);
		$_arr = array();
		$i = $rcomm = $bonus = 0;
		while ($this->fetch()) {
			//if($this->bonus == 0) continue;
			$_arr['all']['bonusname'][$i] = $this->Name;//$this->Name." $ {$this->bonus}";
			$_arr['all']['bonuscomm'][$i] = number_format($this->bonus, '2', '.', '');
			$_arr['all']['bonusfail'][$i] = $this->nobonus;
            $_arr['all']['dob'   ][$i] = $this->DOB;
			$_arr['all']['client'][$i] = $this->CID;
			$_arr['all']['sem'   ][$i] = $this->ID;
			$_arr['all']['course'][$i] = $this->CCID;

            if ($this->AgentID > 0)
                $_arr['all']['agent'][$i] = $this->CID;

            if ($this->ConsultantDate >= $fromDay && $this->ConsultantDate <= $toDay){
                $_arr['all']['bonus_new'][$this->CID] = 1;
                if ($this->AgentID > 0) 
                    $_arr['all']['bonus_new_aid'][$this->CID] = 1;  
            }

			$bonus += $this->bonus;
			$i++;
		}
		$_arr['all']['bonus'] = $bonus;
        @$_arr['all']['bonus_st'] = count(array_unique($_arr['all']['client'], SORT_NUMERIC));
        @$_arr['all']['bonus_new'] = count($_arr['all']['bonus_new']);
        @$_arr['all']['bonus_aid'] = count(array_unique($_arr['all']['agent'], SORT_NUMERIC));
        @$_arr['all']['bonus_new_aid'] = count($_arr['all']['bonus_new_aid']);
		return $_arr;			
	}


	function getAmountOfCoursePotCommByUser($fromDay, $toDay, $userid){

		$_arr = array();
		$sql = "SELECT  date_format(BeginDate, '%Y%u') as wk,
                        concat(LName, ' ', FName) as Name, 
                        c.CID,
                        a.ID,
                        a.CCID,
                        c.DOB,
                        ConsultantDate, 
						IF(t1.BeginDate >= d.StartDate and d.StartDate <> '' and d.StartDate <> '0000-00-00', IF(CoComm > 0 OR Discount > 0, RComm-CoComm-Discount,RComm-Discount), 0) as rcomm,
						IF(t1.BeginDate >= d.StartDate and d.StartDate <> '' and d.StartDate <> '0000-00-00', 0, 1) as norcomm
                FROM client_course_sem a  
                      left join client_course_process t1 on (a.CCID = t1.CCID AND t1.Done = 1 and t1.ProcessID = 5)
                     , client_course b,client_info c, sys_user d
                WHERE a.CCID = b.ID 
                  AND b.CID = c.CID 
                  AND b.ConsultantID = d.ID
                  AND t1.BeginDate >= '{$fromDay}' AND t1.BeginDate <= '{$toDay}' "; 
	    if ($userid > 0) {
            $sql .= " AND b.ConsultantID = {$userid} ";
        }
        $sql .= " Order by wk, Name, a.SEM ";
        $this->query($sql);
        $i = 0;
		while ($this->fetch()) {
	    //if($this->rcomm == 0) continue;	
			$_arr[$this->wk]['name'  ][$i] = $this->Name;
			$_arr[$this->wk]['comm'  ][$i] = number_format($this->rcomm, '2', '.', '');
			$_arr[$this->wk]['commfail'][$i] = $this->norcomm;
            $_arr[$this->wk]['dob'   ][$i] = $this->DOB;
            $_arr[$this->wk]['client'][$i] = $this->CID;
            $_arr[$this->wk]['sem'   ][$i] = $this->ID;
            $_arr[$this->wk]['course'][$i] = $this->CCID;
            if (isset($_arr[$this->wk]['rcomm'])) {
                $_arr[$this->wk]['rcomm'] += $this->rcomm;
            }
            else {
                $_arr[$this->wk]['rcomm'] = $this->rcomm;
            }
            $i++;
        }
		return $_arr;			
    }
    
    function getAllOfCoursePotCommByUser($fromDay, $toDay, $userid){
    			//concat(LName, ' ', FName) like 'sub-%',
		      $sql = "SELECT  date_format(BeginDate, '%Y-%u') as wk,
                        concat(LName, ' ', FName) as Name, ConsultantDate,
                        c.CID, a.ID, a.CCID, c.DOB, c.AgentID,
						IF(t1.BeginDate >= d.StartDate and d.StartDate <> '' and d.StartDate <> '0000-00-00', IF(CoComm > 0 OR Discount > 0, RComm-CoComm-Discount,RComm-Discount), 0) as rcomm,
						IF(t1.BeginDate >= d.StartDate and d.StartDate <> '' and d.StartDate <> '0000-00-00', 0, 1) as norcomm
                      FROM client_course_sem a
                        left join client_course_process t1 on (a.CCID = t1.CCID AND t1.Done = 1 and t1.ProcessID = 5)
		                    , client_course b,client_info c, sys_user d
		               WHERE a.CCID = b.ID 
		                  AND b.CID = c.CID 
                          AND b.ConsultantID = d.ID 
                          AND t1.BeginDate >= '{$fromDay}' AND t1.BeginDate <= '{$toDay}'";
                  
		if ($userid > 0) {
			$sql .= " AND b.ConsultantID = {$userid} ";
        }

        $sql .= " Order by wk, Name, a.SEM ";
		$this->query($sql);
		$_arr = array();
		$i = $rcomm = $bonus = 0;
		while ($this->fetch()) {
		//	if($this->rcomm == 0) continue;
			$_arr['all']['name'  ][$i] = $this->Name;
			$_arr['all']['comm'  ][$i] = number_format($this->rcomm, '2', '.', '');
			$_arr['all']['commfail'][$i] = $this->norcomm; 			
            $_arr['all']['dob'   ][$i] = $this->DOB;
			$_arr['all']['client'][$i] = $this->CID;
			$_arr['all']['sem'   ][$i] = $this->ID;
			$_arr['all']['course'][$i] = $this->CCID;
            if ($this->AgentID) 
                $_arr['all']['agent'][$i] = $this->CID;
            if ($this->ConsultantDate >= $fromDay && $this->ConsultantDate <= $toDay){
                $_arr['all']['rcomm_new'][$this->CID] = 1;
                if ($this->AgentID > 0) 
                    $_arr['all']['rcomm_new_aid'][$this->CID] = 1;
                   
            }

			$rcomm += $this->rcomm;
			$i++;
		}

		$_arr['all']['rcomm'] = $rcomm;
        @$_arr['all']['rcomm_st'] = count(array_unique($_arr['all']['client'], SORT_NUMERIC));
        @$_arr['all']['rcomm_new'] = count($_arr['all']['rcomm_new']);
        @$_arr['all']['rcomm_aid'] = count(array_unique($_arr['all']['agent'], SORT_NUMERIC));
        @$_arr['all']['rcomm_new_aid'] = count($_arr['all']['rcomm_new_aid']);
        return $_arr;			
	}

	function getNumOfAgreementByUser($fromDay, $toDay, $userid){
		$sql = "select date_format(ADate, '%Y%u') as Week, concat(LName, ' ', FName) as Name, a.ID, b.CID, c.VisaName, d.ClassName, 
				IF(`State` = 'active' and ADate > '0000-00-00', 1, 0) as sign
				from client_visa a, client_info b, visa_category c, visa_subclass d 
				where a.CID = b.CID and a.CateID = c.CateID and a.SubClassID = d.SubClassID ";
		if ($userid > 0) {
			$sql .= " AND AUserID = {$userid} ";
		}
		if ($fromDay != "" && $fromDay  != "0000-00-00") {
			$sql .= " AND a.ADate >= '{$fromDay}'";
		}
	    if ($toDay != "" && $toDay  != "0000-00-00") {
            $sql .= " And a.ADate <= '{$toDay}' ";
        }		

        $sql .= " GROUP BY a.ID ";
		$this->query($sql);
		$_arr = $visa = array();
		while ($this->fetch()) {

            if (!isset($_arr[$this->Week]) || !isset($_arr[$this->Week]['pcnt'])) {
                $_arr[$this->Week]['pcnt' ] = 0;
                $_arr[$this->Week]['sign1'] = 0;
                $_arr[$this->Week]['sign0'] = 0;    
                $_arr[$this->Week]['fee'  ] = 0;                
            }

            $_arr[$this->Week]['pcnt']++;

            $_arr[$this->Week]['pname'][$_arr[$this->Week]['pcnt']] = $this->Name." ( {$this->VisaName} {$this->ClassName} )";
            $_arr[$this->Week]['client'][$_arr[$this->Week]['pcnt']] = $this->CID;
            $_arr[$this->Week]['visa'  ][$_arr[$this->Week]['pcnt']] = $this->ID;

            if ($this->sign == 1) {
                $visa[$this->ID]['client'][$this->Week][] = $_arr[$this->Week]['pcnt'];
                $visa[$this->ID]['fee'] = 0;
                $_arr[$this->Week]['fname' ][$_arr[$this->Week]['pcnt']] = $this->Name." ( {$this->VisaName} {$this->ClassName} )";
            }
		}

        //calc payment
        if (count($visa) > 0) {
            $sql = "select a.ID, VisaID, DueAmount, GST, AMOUNT_3RD, GST_3RD, Sum(if(b.PaidAmount is null, 0, b.PaidAmount)) as paid from client_account a left join client_payment b on(a.ID = b.AccountID) Where VisaID IN (".implode(',', array_keys($visa)).") AND ACC_TYPE = 'visa' Group by a.ID";
            $this->query($sql);
       
            while ($this->fetch()){
                //paperwork profit
                $visa[$this->VisaID]['fee'] += ($this->GST == 1? $this->DueAmount/1.1 : $this->DueAmount) - ($this->GST_3RD == 1? $this->AMOUNT_3RD/1.1 : $this->AMOUNT_3RD);
            }            
                  
            foreach ($visa as $vid => $v) {
                if (isset($v['client'])) {
                    foreach ($v['client'] as $w => $vv) {
                        foreach ($vv as $i) {
                            $_arr[$w]['fname'][$i] .= ' $'.$v['fee'];
                            $_arr[$w]['fee'] += $v['fee'];

                            $_arr[$w]['sign1']++;
                            if ($v['fee'] == 0)
                                $_arr[$w]['sign0']++;
                        }
                    }
                }
            }
        
            foreach($_arr as $w => $v){
                $_arr[$w]['sign1'] -= $_arr[$w]['sign0'];
            }   
        }
		return $_arr;		
	}
	
	
	
    function getNumOfVisitByUser($fromDay, $toDay, $userid){
        $sql = "select date_format(VisitDate, '%Y%u') as Week, concat(LName, ' ', FName) as Name, a.ID, b.CID, AFee, c.VisaName, d.ClassName, CFee,
                IF(`State` = 'active' and ADate != '0000-00-00' and Adate != '', 1, 0) as sign, a.r_STATUS AS STATUS
                from client_visa a, client_info b, visa_category c, visa_subclass d 
                where a.CID = b.CID and a.CateID = c.CateID and a.SubClassID = d.SubClassID ";
        if ($userid > 0) {
            $sql .= " AND AUserID = {$userid} ";
        }
        if ($fromDay != "" && $fromDay  != "0000-00-00") {
            $sql .= " AND a.VisitDate >= '{$fromDay}'";
        }
        if ($toDay != "" && $toDay  != "0000-00-00") {
            $sql .= " And a.VisitDate <= '{$toDay}' ";
        }       
        $this->query($sql);
        $_arr = array();
        while ($this->fetch()) {
            isset($_arr[$this->Week]['pcnt'])? $_arr[$this->Week]['pcnt']++ : $_arr[$this->Week]['pcnt'] = 1;
            $_arr[$this->Week]['pname'  ][$_arr[$this->Week]['pcnt']] = $this->Name." ( {$this->VisaName} {$this->ClassName} )";
            $_arr[$this->Week]['client' ][$_arr[$this->Week]['pcnt']] = $this->CID;  
            $_arr[$this->Week]['visa'   ][$_arr[$this->Week]['pcnt']] = $this->ID;
			$_arr[$this->Week]['sign'   ][$_arr[$this->Week]['pcnt']] = $this->sign == 1? 1 : 0;  
			$_arr[$this->Week]['decline'][$_arr[$this->Week]['pcnt']] = stripos($this->STATUS, 'declined') !== false? 1 : 0;				             
			
			if (stripos($this->STATUS, 'client decline') !== false) {
				$_arr[$this->Week]['decline'][$_arr[$this->Week]['pcnt']] = $this->ID;
			}
			
			if (stripos($this->ClassName, 'onshore') !== false) {
				$this->CFee = round($this->CFee/1.1, 2);
			}

			if (isset($_arr[$this->Week]['totalcfee']))			
				$_arr[$this->Week]['totalcfee'] += $this->CFee;
			else
				$_arr[$this->Week]['totalcfee'] = $this->CFee;	

            $_arr[$this->Week]['cfee'  ][$_arr[$this->Week]['pcnt']] = $this->CFee;	
			            		
        }
        return $_arr;       
    }
    	
	
	function getAllOfAgreementByUser($fromDay, $toDay, $userid){
		$sql = "select concat(LName, ' ', FName) as Name, a.ID, b.CID, c.VisaName, d.ClassName, IF(`State` = 'active' and ADate > '0000-00-00', 1, 0) as sign, AUserID, AFee 
                from client_visa a, client_info b, visa_category c, visa_subclass d where a.CID = b.CID and a.CateID = c.CateID and a.SubClassID = d.SubClassID ";
		if ($userid > 0) {
			$sql .= " AND AUserID = {$userid} ";
		}
        if ($fromDay != "" && $fromDay  != "0000-00-00") {
            $sql .= " AND a.ADate >= '{$fromDay}'";
        }
        if ($toDay != "" && $toDay  != "0000-00-00") {
            $sql .= " And a.ADate <= '{$toDay}' ";
        } 
        $sql .= " GROUP BY a.ID ";  
		$this->query($sql);
		$_arr = $visa = array();
		$i = $fee = $signed = $signed_0 = 0; 
		while ($this->fetch()) {
			$_arr['all']['pname'][$i] = $this->Name." ( {$this->VisaName} {$this->ClassName} )";
			$_arr['all']['client'][$i] = $this->CID;
            $_arr['all']['visa'  ][$i] = $this->ID;

			if ($this->sign == 1) {
                $visa[$this->ID]['client'][] = $i;
                $visa[$this->ID]['fee'] = 0;
				$_arr['all']['fname' ][$i] = $this->Name." ( {$this->VisaName} {$this->ClassName} )";
                $_arr['all']['line' ][$i] = $this->Name."\t".$this->VisaName."\t".$this->ClassName."\t".$this->sign."\t".$this->AUserID."\t".$this->AFee;
			}
			$i++;			
		}

        //calc payment
        if (count($visa) > 0) {
            $sql = "select VisaID, DueAmount, GST, AMOUNT_3RD, GST_3RD from client_account a Where VisaID IN (".implode(',', array_keys($visa)).") AND ACC_TYPE = 'visa'";
            $this->query($sql);   
            while ($this->fetch()){
                //paperwork profit
                $visa[$this->VisaID]['fee'] += ($this->GST == 1? $this->DueAmount/1.1 : $this->DueAmount) - ($this->GST_3RD == 1? $this->AMOUNT_3RD/1.1 : $this->AMOUNT_3RD);
            }

            //echo "<pre>";
            foreach ($visa as $vid => $v) {
                if (isset($v['client'])) {
                    foreach ($v['client'] as $i) {
                        $_arr['all']['fname'][$i] .= ' $'.$v['fee'];
                        //echo $_arr['all']['line'][$i] ."\t". $v['fee']."\n";
                        $fee += $v['fee'];
                        $signed++;
                        if ($v['fee'] == 0)
                            $signed_0++;
                    }
                }
            }
            //echo "</pre>";
        }

		$_arr['all']['pcnt'] = $i;
		$_arr['all']['fee'] = $fee;
		$_arr['all']['sign1'] = $signed-$signed_0;
		$_arr['all']['sign0'] = $signed_0;
		return $_arr;		
	}

	
    function getAllOfVisitByUser($fromDay, $toDay, $userid){
        $sql = "select concat(LName, ' ', FName) as Name, a.ID, b.CID, AFee, c.VisaName, d.ClassName, CFee,  
                       IF(`State` = 'active' and ADate != '0000-00-00' and ADate != '', 1, 0) as sign, a.r_STATUS AS STATUS
                from client_visa a, client_info b, visa_category c, visa_subclass d 
                where a.CID = b.CID and a.CateID = c.CateID and a.SubClassID = d.SubClassID ";
        if ($userid > 0) {
            $sql .= " AND AUserID = {$userid} ";
        }
        if ($fromDay != "" && $fromDay  != "0000-00-00") {
            $sql .= " AND a.VisitDate >= '{$fromDay}'";
        }
        if ($toDay != "" && $toDay  != "0000-00-00") {
            $sql .= " And a.VisitDate <= '{$toDay}' ";
        }   
        $this->query($sql);
        $_arr = array();
        $i = $cfee = 0;
		while ($this->fetch()) {
			
			if (stripos($this->ClassName, 'onshore') !== false) {
				$this->CFee = round($this->CFee/1.1, 2);
			}			

			$cfee += $this->CFee;			
            $_arr['all']['pname'][$i] = $this->Name." ( {$this->VisaName} {$this->ClassName} )";
            $_arr['all']['client'][$i] = $this->CID;
            $_arr['all']['visa'  ][$i] = $this->ID;
			$_arr['all']['sign'  ][$i] = $this->sign == 1? 1 : 0;
			$_arr['all']['cfee'  ][$i] = $this->CFee;			
			$_arr['all']['decline'][$i] = stripos($this->STATUS, 'declined') !== false? 1 : 0;

            $i++;
        }
		$_arr['all']['pcnt'] = $i;
        $_arr['all']['totalcfee'] = $cfee;		
        return $_arr;       
    }	
	
	function getNumOfVisaProcByUser($fromDay, $toDay, $userid){
		
		$sql  = "select date_format(BeginDate, '%Y%u') as Week, if(b.Item is null, ExItem, b.Item) as Item, c.AFee, concat(LName, ' ', FName) as Name, d.CID, c.ID, c.r_Status, c.CateID, c.SubClassID   
		          from client_visa_process a left join visa_rs_item b on (a.ItemID = b.ItemID), client_visa c, client_info d  
		          where a.CVID  = c.ID and c.CID = d.CID and (b.Item not like '%assessment'  or b.Item is null) and a.Done = 1 ";
		if ($userid > 0) {
			$sql .= " AND c.VUserID = {$userid} ";
		}
		if ($fromDay != "" && $toDay  != "") {
			$sql .= " AND a.BeginDate >= '{$fromDay}' and a.BeginDate <= '{$toDay}' ";
		}
		//$sql .= " GROUP BY b.ITEM, c.ID ";
        //echo $sql;
		$this->query($sql);
		$_arr = array();
        $visa = array();
		while ($this->fetch()) {
			//$comm = round($this->Fee_Recv - $this->Fee_Pay,2);	
			if (preg_match('/^apply/i', $this->Item)) {
				
				if (!isset($_arr[$this->Week]) || !isset($_arr[$this->Week]['lcnt'])) {
					$_arr[$this->Week]['lcnt' ] = 0;
					$_arr[$this->Week]['lcnt1'] = 0;
					$_arr[$this->Week]['lcnt0']	= 0;	
                    $_arr[$this->Week]['lfee' ] = 0;
                    $_arr[$this->Week]['lfee_paid' ] = 0;	
                    $_arr[$this->Week]['lfee_free' ] = 0;			
                
                    $_arr[$this->Week]['lc_free'  ] = 0;
                    $_arr[$this->Week]['lc_free_0'] = 0;
                    $_arr[$this->Week]['lc_paid'  ] = 0;
                    $_arr[$this->Week]['lc_paid_0'] = 0;    
                }

				$_arr[$this->Week]['lcnt']++;

				$_arr[$this->Week]['lname'][$_arr[$this->Week]['lcnt']] = $this->Name;
				$_arr[$this->Week]['lc'   ][$_arr[$this->Week]['lcnt']] = $this->CID;
				$_arr[$this->Week]['lv'   ][$_arr[$this->Week]['lcnt']] = $this->ID;
                $visa[$this->ID]['apply'][$this->Week][] = $_arr[$this->Week]['lcnt'];
                $visa[$this->ID]['profit'] = 0; 
                $visa[$this->ID]['has_agreement_fee'] = 0; 
                $visa[$this->ID]['cate'] = $this->CateID;
                $visa[$this->ID]['subclass'] = $this->SubClassID;
            }
            
            if (preg_match('/^grant/i', $this->Item)){
				if (!isset($_arr[$this->Week]) || !isset($_arr[$this->Week]['gcnt'])) {
					$_arr[$this->Week]['gcnt' ] = 0;
					$_arr[$this->Week]['gcnt1'] = 0;
					$_arr[$this->Week]['gcnt0']	= 0;
                    $_arr[$this->Week]['gfee' ] = 0;
                    $_arr[$this->Week]['gfee_paid' ] = 0;	
                    $_arr[$this->Week]['gfee_free' ] = 0;
				
                    $_arr[$this->Week]['gc_free'  ] = 0;
                    $_arr[$this->Week]['gc_free_0'] = 0;
                    $_arr[$this->Week]['gc_paid'  ] = 0;
                    $_arr[$this->Week]['gc_paid_0'] = 0;  
                }

				$_arr[$this->Week]['gcnt']++;

				$_arr[$this->Week]['gname'][$_arr[$this->Week]['gcnt']] = $this->Name;
				$_arr[$this->Week]['gc'   ][$_arr[$this->Week]['gcnt']] = $this->CID;
                $_arr[$this->Week]['gv'   ][$_arr[$this->Week]['gcnt']] = $this->ID;
                $visa[$this->ID]['grant'][$this->Week][] = $_arr[$this->Week]['gcnt'];
                $visa[$this->ID]['profit'] = 0;
                $visa[$this->ID]['has_agreement_fee'] = 0; 		
			}

            if (preg_match('/^withdraw/i', $this->Item)){
                if (!isset($_arr[$this->Week]) || !isset($_arr[$this->Week]['wcnt'])) {
                    $_arr[$this->Week]['wcnt' ] = 0;
                    $_arr[$this->Week]['wcnt1'] = 0;
                    $_arr[$this->Week]['wcnt0'] = 0;
                    $_arr[$this->Week]['wfee' ] = 0;
                    $_arr[$this->Week]['wfee_paid' ] = 0;   
                    $_arr[$this->Week]['wfee_free' ] = 0;
                
                    $_arr[$this->Week]['wc_free'  ] = 0;
                    $_arr[$this->Week]['wc_free_0'] = 0;
                    $_arr[$this->Week]['wc_paid'  ] = 0;
                    $_arr[$this->Week]['wc_paid_0'] = 0;  
                }

                $_arr[$this->Week]['wcnt']++;

                $_arr[$this->Week]['wname'][$_arr[$this->Week]['wcnt']] = $this->Name;
                $_arr[$this->Week]['wc'   ][$_arr[$this->Week]['wcnt']] = $this->CID;
                $_arr[$this->Week]['wv'   ][$_arr[$this->Week]['wcnt']] = $this->ID;
                $visa[$this->ID]['withraw'][$this->Week][] = $_arr[$this->Week]['wcnt'];
                $visa[$this->ID]['profit'] = 0;
                $visa[$this->ID]['has_agreement_fee'] = 0;      
            }         

            if (preg_match('/^refused/i', $this->Item)){
                if (!isset($_arr[$this->Week]) || !isset($_arr[$this->Week]['rcnt'])) {
                    $_arr[$this->Week]['rcnt' ] = 0;
                    $_arr[$this->Week]['rcnt1'] = 0;
                    $_arr[$this->Week]['rcnt0'] = 0;
                    $_arr[$this->Week]['rfee' ] = 0;
                    $_arr[$this->Week]['rfee_paid' ] = 0;   
                    $_arr[$this->Week]['rfee_free' ] = 0;
                
                    $_arr[$this->Week]['rc_free'  ] = 0;
                    $_arr[$this->Week]['rc_free_0'] = 0;
                    $_arr[$this->Week]['rc_paid'  ] = 0;
                    $_arr[$this->Week]['rc_paid_0'] = 0;  
                }

                $_arr[$this->Week]['rcnt']++;

                $_arr[$this->Week]['rname'][$_arr[$this->Week]['rcnt']] = $this->Name;
                $_arr[$this->Week]['rc'   ][$_arr[$this->Week]['rcnt']] = $this->CID;
                $_arr[$this->Week]['rv'   ][$_arr[$this->Week]['rcnt']] = $this->ID;
                $visa[$this->ID]['refuse'][$this->Week][] = $_arr[$this->Week]['rcnt'];
                $visa[$this->ID]['profit'] = 0;
                $visa[$this->ID]['has_agreement_fee'] = 0;      
            }

            if (preg_match('/^cancel agreement/i', $this->Item)){
                if (!isset($_arr[$this->Week]) || !isset($_arr[$this->Week]['ccnt'])) {
                    $_arr[$this->Week]['ccnt' ] = 0;
                    $_arr[$this->Week]['ccnt1'] = 0;
                    $_arr[$this->Week]['ccnt0'] = 0;
                    $_arr[$this->Week]['cfee' ] = 0;
                    $_arr[$this->Week]['cfee_paid' ] = 0;   
                    $_arr[$this->Week]['cfee_free' ] = 0;
                
                    $_arr[$this->Week]['cc_free'  ] = 0;
                    $_arr[$this->Week]['cc_free_0'] = 0;
                    $_arr[$this->Week]['cc_paid'  ] = 0;
                    $_arr[$this->Week]['cc_paid_0'] = 0;  
                }

                $_arr[$this->Week]['ccnt']++;

                $_arr[$this->Week]['cname'][$_arr[$this->Week]['ccnt']] = $this->Name;
                $_arr[$this->Week]['cc'   ][$_arr[$this->Week]['ccnt']] = $this->CID;
                $_arr[$this->Week]['cv'   ][$_arr[$this->Week]['ccnt']] = $this->ID;
                $visa[$this->ID]['cancel'][$this->Week][] = $_arr[$this->Week]['ccnt'];
                $visa[$this->ID]['profit'] = 0;
                $visa[$this->ID]['has_agreement_fee'] = 0;      
            } 

            if (preg_match('/agent stop/i', $this->Item)){
                if (!isset($_arr[$this->Week]) || !isset($_arr[$this->Week]['scnt'])) {
                    $_arr[$this->Week]['scnt' ] = 0;
                    $_arr[$this->Week]['scnt1'] = 0;
                    $_arr[$this->Week]['scnt0'] = 0;
                    $_arr[$this->Week]['sfee' ] = 0;
                    $_arr[$this->Week]['sfee_paid' ] = 0;   
                    $_arr[$this->Week]['sfee_free' ] = 0;
                
                    $_arr[$this->Week]['sc_free'  ] = 0;
                    $_arr[$this->Week]['sc_free_0'] = 0;
                    $_arr[$this->Week]['sc_paid'  ] = 0;
                    $_arr[$this->Week]['sc_paid_0'] = 0;  
                }

                $_arr[$this->Week]['scnt']++;

                $_arr[$this->Week]['sname'][$_arr[$this->Week]['scnt']] = $this->Name;
                $_arr[$this->Week]['sc'   ][$_arr[$this->Week]['scnt']] = $this->CID;
                $_arr[$this->Week]['sv'   ][$_arr[$this->Week]['scnt']] = $this->ID;
                $visa[$this->ID]['stop'][$this->Week][] = $_arr[$this->Week]['scnt'];
                $visa[$this->ID]['profit'] = 0;
                $visa[$this->ID]['has_agreement_fee'] = 0;      
            } 

            if (preg_match('/^declined/i', $this->Item)){
                if (!isset($_arr[$this->Week]) || !isset($_arr[$this->Week]['dcnt'])) {
                    $_arr[$this->Week]['dcnt' ] = 0;
                    $_arr[$this->Week]['dcnt1'] = 0;
                    $_arr[$this->Week]['dcnt0'] = 0;
                    $_arr[$this->Week]['dfee' ] = 0;
                    $_arr[$this->Week]['dfee_paid' ] = 0;   
                    $_arr[$this->Week]['dfee_free' ] = 0;
                
                    $_arr[$this->Week]['dc_free'  ] = 0;
                    $_arr[$this->Week]['dc_free_0'] = 0;
                    $_arr[$this->Week]['dc_paid'  ] = 0;
                    $_arr[$this->Week]['dc_paid_0'] = 0;  
                }

                $_arr[$this->Week]['dcnt']++;

                $_arr[$this->Week]['dname'][$_arr[$this->Week]['dcnt']] = $this->Name;
                $_arr[$this->Week]['sc'   ][$_arr[$this->Week]['dcnt']] = $this->CID;
                $_arr[$this->Week]['sv'   ][$_arr[$this->Week]['dcnt']] = $this->ID;
                $visa[$this->ID]['declined'][$this->Week][] = $_arr[$this->Week]['dcnt'];
                $visa[$this->ID]['profit'] = 0;
                $visa[$this->ID]['has_agreement_fee'] = 0;      
            }

		}
        
        //calc payment
        if (count($visa) > 0) {
            $sql = "select a.ID, VisaID, DueAmount, GST, AMOUNT_3RD, GST_3RD, SUM(IF(STEP = 'agreement' AND DueAmount > 0, 1, 0)) AS HAS_AGREEMENT_FEE, Sum(if(b.PaidAmount is null, 0, b.PaidAmount)) as paid from client_account a left join client_payment b on(a.ID = b.AccountID) Where VisaID IN (".implode(',', array_keys($visa)).") AND ACC_TYPE = 'visa' Group by a.ID";
            $this->query($sql);
            
            while ($this->fetch()){
                //paperwork profit
                $visa[$this->VisaID]['profit'] += $this->paid - ($this->GST == 1? $this->DueAmount/11 : 0) - $this->AMOUNT_3RD + ($this->GST_3RD == 1? $this->AMOUNT_3RD/11 : 0);
                $visa[$this->VisaID]['has_agreement_fee'] += $this->HAS_AGREEMENT_FEE; 
            }            
            foreach ($visa as $vid => $v) {
                if (isset($v['apply'])) {
                    foreach ($v['apply'] as $w => $vv) {
                        foreach ($vv as $i) {
                            //$_arr[$w]['lname'][$i] .= ' $'.$v['profit'];
                            $_arr[$w]['lfee'] += $v['profit'];
                            $_arr[$w]['lcnt1']++;

                            if ($v['profit'] <= 0)
                                $_arr[$w]['lcnt0']++;
                            
                            if ($v['cate'] == 5 && $v['subclass'] != 168 && $v['subclass'] != 53 && $v['subclass'] != 84  && $v['subclass'] != 167  && $v['subclass'] != 31  && $v['subclass'] != 30  && $v['subclass'] != 33  && $v['subclass'] != 210 && $v['subclass'] != 174) {
                                $_arr[$w]['lfee_free'] += $v['profit'];
                                $_arr[$w]['lc_free']++;    
                                if ($v['profit'] <= 0)
                                    $_arr[$w]['lc_free_0']++;

                                $_arr[$w]['lname_free'][$i] = $_arr[$w]['lname'][$i] .' $'.$v['profit'];                                
                            }
                            else { // $v['has_agreement_fee'] > 0
                                $_arr[$w]['lfee_paid'] += $v['profit'];
                                $_arr[$w]['lc_paid']++;
                                if ($v['profit'] <= 0)
                                    $_arr[$w]['lc_paid_0']++;

                                $_arr[$w]['lname_paid'][$i] = $_arr[$w]['lname'][$i] .' $'.$v['profit'];
                            }

                            //$_arr[$w]['lname'][$i] .= ' $'.$v['profit'];
                        }
                    }
                }
                if (isset($v['grant'])) {
                    foreach ($v['grant'] as $w => $vv) {
                        foreach ($vv as $i) {
                            
                            $_arr[$w]['gfee'] += $v['profit'];
                            $_arr[$w]['gcnt1']++;
                            
                            if ($v['profit'] <= 0) 
                                $_arr[$w]['gcnt0']++; 

                            if ($v['has_agreement_fee'] > 0) {
                                $_arr[$w]['gfee_paid'] += $v['profit'];
                                $_arr[$w]['gc_paid']++;
                                if ($v['profit'] <= 0)
                                    $_arr[$w]['gc_paid_0']++;

                                $_arr[$w]['gname_paid'][$i] = $_arr[$w]['gname'][$i] .' $'.$v['profit'];
                            }
                            else {
                                $_arr[$w]['gfee_free'] += $v['profit'];
                                $_arr[$w]['gc_free']++;

                                if ($v['profit'] > 0)
                                    $_arr[$w]['gc_free_0']++;

                                $_arr[$w]['gname_free'][$i] = $_arr[$w]['gname'][$i] .' $'.$v['profit']; 
                            }
                        }
                    }
                }

                if (isset($v['withdraw'])) {
                    foreach ($v['withdraw'] as $w => $vv) {
                        foreach ($vv as $i) {
                            
                            $_arr[$w]['wfee'] += $v['profit'];
                            $_arr[$w]['wcnt1']++;
                            
                            if ($v['profit'] <= 0) 
                                $_arr[$w]['wcnt0']++; 

                            if ($v['has_agreement_fee'] > 0) {
                                $_arr[$w]['wfee_paid'] += $v['profit'];
                                $_arr[$w]['wc_paid']++;
                                if ($v['profit'] <= 0)
                                    $_arr[$w]['wc_paid_0']++;

                                $_arr[$w]['wname_paid'][$i] = $_arr[$w]['wname'][$i] .' $'.$v['profit'];
                            }
                            else {
                                $_arr[$w]['wfee_free'] += $v['profit'];
                                $_arr[$w]['wc_free']++;

                                if ($v['profit'] > 0)
                                    $_arr[$w]['wc_free_0']++;

                                $_arr[$w]['wname_free'][$i] = $_arr[$w]['wname'][$i] .' $'.$v['profit']; 
                            }
                        }
                    }
                }

                if (isset($v['refuse'])) {
                    foreach ($v['refuse'] as $w => $vv) {
                        foreach ($vv as $i) {
                            
                            $_arr[$w]['rfee'] += $v['profit'];
                            $_arr[$w]['rcnt1']++;
                            
                            if ($v['profit'] <= 0) 
                                $_arr[$w]['rcnt0']++; 

                            if ($v['has_agreement_fee'] > 0) {
                                $_arr[$w]['rfee_paid'] += $v['profit'];
                                $_arr[$w]['rc_paid']++;
                                if ($v['profit'] <= 0)
                                    $_arr[$w]['rc_paid_0']++;

                                $_arr[$w]['rname_paid'][$i] = $_arr[$w]['rname'][$i] .' $'.$v['profit'];
                            }
                            else {
                                $_arr[$w]['rfee_free'] += $v['profit'];
                                $_arr[$w]['rc_free']++;

                                if ($v['profit'] > 0)
                                    $_arr[$w]['rc_free_0']++;

                                $_arr[$w]['rname_free'][$i] = $_arr[$w]['rname'][$i] .' $'.$v['profit']; 
                            }
                        }
                    }
                }

                if (isset($v['cancel'])) {
                    foreach ($v['cancel'] as $w => $vv) {
                        foreach ($vv as $i) {
                            
                            $_arr[$w]['cfee'] += $v['profit'];
                            $_arr[$w]['ccnt1']++;
                            
                            if ($v['profit'] <= 0) 
                                $_arr[$w]['ccnt0']++; 

                            if ($v['has_agreement_fee'] > 0) {
                                $_arr[$w]['cfee_paid'] += $v['profit'];
                                $_arr[$w]['cc_paid']++;
                                if ($v['profit'] <= 0)
                                    $_arr[$w]['cc_paid_0']++;

                                $_arr[$w]['cname_paid'][$i] = $_arr[$w]['cname'][$i] .' $'.$v['profit'];
                            }
                            else {
                                $_arr[$w]['cfee_free'] += $v['profit'];
                                $_arr[$w]['cc_free']++;

                                if ($v['profit'] > 0)
                                    $_arr[$w]['cc_free_0']++;

                                $_arr[$w]['cname_free'][$i] = $_arr[$w]['cname'][$i] .' $'.$v['profit']; 
                            }
                        }
                    }
                }

                if (isset($v['stop'])) {
                    foreach ($v['stop'] as $w => $vv) {
                        foreach ($vv as $i) {
                            
                            $_arr[$w]['sfee'] += $v['profit'];
                            $_arr[$w]['scnt1']++;
                            
                            if ($v['profit'] <= 0) 
                                $_arr[$w]['scnt0']++; 

                            if ($v['has_agreement_fee'] > 0) {
                                $_arr[$w]['sfee_paid'] += $v['profit'];
                                $_arr[$w]['sc_paid']++;
                                if ($v['profit'] <= 0)
                                    $_arr[$w]['sc_paid_0']++;

                                $_arr[$w]['sname_paid'][$i] = $_arr[$w]['sname'][$i] .' $'.$v['profit'];
                            }
                            else {
                                $_arr[$w]['sfee_free'] += $v['profit'];
                                $_arr[$w]['sc_free']++;

                                if ($v['profit'] > 0)
                                    $_arr[$w]['sc_free_0']++;

                                $_arr[$w]['sname_free'][$i] = $_arr[$w]['sname'][$i] .' $'.$v['profit']; 
                            }
                        }
                    }
                }
                if (isset($v['declined'])) {
                    foreach ($v['declined'] as $w => $vv) {
                        foreach ($vv as $i) {
                            
                            $_arr[$w]['dfee'] += $v['profit'];
                            $_arr[$w]['dcnt1']++;
                            
                            if ($v['profit'] <= 0) 
                                $_arr[$w]['dcnt0']++; 

                            if ($v['has_agreement_fee'] > 0) {
                                $_arr[$w]['dfee_paid'] += $v['profit'];
                                $_arr[$w]['dc_paid']++;
                                if ($v['profit'] <= 0)
                                    $_arr[$w]['dc_paid_0']++;

                                $_arr[$w]['dname_paid'][$i] = $_arr[$w]['dname'][$i] .' $'.$v['profit'];
                            }
                            else {
                                $_arr[$w]['dfee_free'] += $v['profit'];
                                $_arr[$w]['dc_free']++;

                                if ($v['profit'] > 0)
                                    $_arr[$w]['dc_free_0']++;

                                $_arr[$w]['dname_free'][$i] = $_arr[$w]['dname'][$i] .' $'.$v['profit']; 
                            }
                        }
                    }
                }
                
            }
        }

		return $_arr;				
	}

	
	function getAllOfVisaProcByUser($fromDay, $toDay, $userid){
		
        //and (b.Item not like '%assessment' or b.Item is null) 
		$sql  = "select if(b.Item is null, a.ExItem, b.Item) AS Item, c.AFee, concat(LName, ' ', FName) as Name, d.CID, c.ID, c.r_Status, c.CateID, c.SubClassID from client_visa_process a left join visa_rs_item b on (a.ItemID = b.ITEMID), client_visa c, client_info d
		         where a.CVID  = c.ID and c.CID = d.CID and b.Item is not null and a.Done = 1 ";
		if ($userid > 0) {
			$sql .= " AND c.VUserID = {$userid} ";
		}
		if ($fromDay != "" && $toDay  != "") {
			$sql .= " AND a.BeginDate >= '{$fromDay}' and a.BeginDate <= '{$toDay}' ";
		}		
		//$sql .= " GROUP BY b.ITEM,c.ID ";
        //echo $sql."\n";
		$this->query($sql);
		$lodge  = $grant = $withdraw = $refuse = $cancel = $stop = $declined = 0;
        $visa   = array();
		while ($this->fetch()) {
 			//$comm = round($this->Fee_Recv - $this->Fee_Pay,2);	

			if (preg_match('/^apply/i', $this->Item)) {
				$_arr['all']['lname' ][$lodge] = $this->Name;
				$_arr['all']['lc'    ][$lodge] = $this->CID;
				$_arr['all']['lv'    ][$lodge] = $this->ID; 
                $visa[$this->ID]['apply'][] = $lodge;
                $visa[$this->ID]['profit'] = 0;
                $visa[$this->ID]['has_agreement_fee'] = 0;           
                $visa[$this->ID]['cate'] = $this->CateID;
                $visa[$this->ID]['subclass'] = $this->SubClassID;     
                $lodge++;
			}
            
            if (preg_match('/^grant/i', $this->Item)){
				$_arr['all']['gname' ][$grant] = $this->Name;
                $_arr['all']['gc'    ][$grant] = $this->CID;
                $_arr['all']['gv'    ][$grant] = $this->ID;		
				$visa[$this->ID]['grant'][] = $grant;
                $visa[$this->ID]['profit'] = 0;
                $visa[$this->ID]['has_agreement_fee'] = 0;                  
                $grant++;			
			}
            elseif (preg_match('/^withdraw/i', $this->Item) ){
                $_arr['all']['withdraw' ][$withdraw] = $this->Name;
                $_arr['all']['wc'    ][$withdraw] = $this->CID;
                $_arr['all']['wv'    ][$withdraw] = $this->ID;     
                $visa[$this->ID]['withdraw'][] = $withdraw;
                $visa[$this->ID]['profit'] = 0;
                $visa[$this->ID]['has_agreement_fee'] = 0;                  
                $withdraw++;   
            }
            elseif (preg_match('/^refused/i', $this->Item) ){
                $_arr['all']['refuse' ][$refuse] = $this->Name;
                $_arr['all']['rc'    ][$refuse] = $this->CID;
                $_arr['all']['rv'    ][$refuse] = $this->ID;     
                $visa[$this->ID]['refuse'][] = $refuse;
                $visa[$this->ID]['profit'] = 0;
                $visa[$this->ID]['has_agreement_fee'] = 0;                  
                $refuse++;   
            }
            elseif (preg_match('/^cancel agreement/i', $this->Item) ){
                $_arr['all']['cancel' ][$cancel] = $this->Name;
                $_arr['all']['cc'    ][$cancel] = $this->CID;
                $_arr['all']['cv'    ][$cancel] = $this->ID;     
                $visa[$this->ID]['cancel'][] = $cancel;
                $visa[$this->ID]['profit'] = 0;
                $visa[$this->ID]['has_agreement_fee'] = 0;                  
                $cancel++;  
            }
            elseif (preg_match('/agent stop/i', $this->Item) ){
                $_arr['all']['stop' ][$stop] = $this->Name;
                $_arr['all']['sc'    ][$stop] = $this->CID;
                $_arr['all']['sv'    ][$stop] = $this->ID;     
                $visa[$this->ID]['stop'][] = $stop;
                $visa[$this->ID]['profit'] = 0;
                $visa[$this->ID]['has_agreement_fee'] = 0;                  
                $stop++;  
            }
            elseif (preg_match('/^declined/i', $this->Item) ){
                $_arr['all']['declined' ][$declined] = $this->Name;
                $_arr['all']['dc'    ][$declined] = $this->CID;
                $_arr['all']['dv'    ][$declined] = $this->ID;     
                $visa[$this->ID]['declined'][] = $declined;
                $visa[$this->ID]['profit'] = 0;
                $visa[$this->ID]['has_agreement_fee'] = 0;                  
                $declined++; 
            }

		}
    
        //calc payment
        $lodge_0     = $lc_paid = $lc_paid_0 =  $lc_free = $lc_free_0 = $lrev = $lrev_paid = $lrev_free = 0;
        $grant_0     = $gc_paid = $gc_paid_0 =  $gc_free = $gc_free_0 = $grev = $grev_paid = $grev_free = 0;
        $withdraw_0  = $wc_paid = $wc_paid_0 =  $wc_free = $wc_free_0 = $wrev = $wrev_paid = $wrev_free = 0;
        $refuse_0    = $rc_paid = $rc_paid_0 =  $rc_free = $rc_free_0 = $rrev = $rrev_paid = $rrev_free = 0;
        $cancel_0    = $cc_paid = $cc_paid_0 =  $cc_free = $cc_free_0 = $crev = $crev_paid = $crev_free = 0;
        $stop_0      = $sc_paid = $sc_paid_0 =  $sc_free = $sc_free_0 = $srev = $srev_paid = $srev_free = 0;
        $declined_0  = $dc_paid = $dc_paid_0 =  $dc_free = $dc_free_0 = $drev = $drev_paid = $drev_free = 0;

        $comm_l = $comm_g = array();
        if (count($visa) > 0) {
            $sql = "select a.ID, VisaID, DueAmount, GST, AMOUNT_3RD, GST_3RD, SUM(IF(STEP = 'agreement' AND DueAmount > 0, 1, 0)) AS HAS_AGREEMENT_FEE, Sum(if(b.PaidAmount is null, 0, b.PaidAmount)) as paid from client_account a left join client_payment b on(a.ID = b.AccountID) Where VisaID IN (".implode(',', array_keys($visa)).") AND ACC_TYPE = 'visa' Group by a.ID";
            $this->query($sql);
       
            while ($this->fetch()){
                //paperwork profit
                $visa[$this->VisaID]['profit'] += $this->paid - ($this->GST == 1? $this->DueAmount/11 : 0) - $this->AMOUNT_3RD + ($this->GST_3RD == 1? $this->AMOUNT_3RD/11 : 0);
                $visa[$this->VisaID]['has_agreement_fee'] += $this->HAS_AGREEMENT_FEE;
            }            
        
            foreach ($visa as $vid => $v) {
                if (isset($v['apply'])) {
                    foreach ($v['apply'] as $i) {
                        
                        $lrev += $v['profit'];
                        if ($v['profit'] <= 0)
                            $lodge_0++;

                        if ($v['cate'] == 5 && $v['subclass'] != 168 && $v['subclass'] != 53 && $v['subclass'] != 84  && $v['subclass'] != 167  && $v['subclass'] != 31  && $v['subclass'] != 30  && $v['subclass'] != 33  && $v['subclass'] != 210 && $v['subclass'] != 174){
                            $lrev_free += $v['profit'];
                            $_arr['all']['lname_free'][$i] = $_arr['all']['lname'][$i] .' $'.$v['profit'];
                            $lc_free++;
                            if ($v['profit'] <= 0)
                                $lc_free_0++;
                        }
                        else {
                            $lrev_paid += $v['profit'];
                            $_arr['all']['lname_paid'][$i] = $_arr['all']['lname'][$i] .' $'.$v['profit'];
                            $lc_paid++;
                            if ($v['profit'] <= 0)
                                $lc_paid_0++; 
                        }

                        //$_arr['all']['lname'][$i] .= ' $'.$v['profit'];    
                    }
                }
                if (isset($v['grant'])) {
                    foreach ($v['grant'] as $i) {
                        
                        $grev += $v['profit'];   
                        if ($v['profit'] <= 0)
                            $grant_0++;      

                        if ($v['has_agreement_fee'] > 0) {
                            $grev_paid += $v['profit'];
                            $_arr['all']['gname_paid'][$i] = $_arr['all']['gname'][$i].' $'.$v['profit'];
                            $gc_paid++;
                            if ($v['profit'] <= 0)
                                $gc_paid_0++;
                        }
                        else {
                            $grev_free += $v['profit'];
                            $_arr['all']['gname_free'][$i] = $_arr['all']['gname'][$i].' $'.$v['profit'];                           
                            $gc_free++;
                            if ($v['profit'] <= 0)
                                $gc_free_0++;
                        }
                        //$_arr['all']['gname'][$i] .= ' $'.$v['profit'];
                    }
                }
                if (isset($v['withdraw'])) {
                    foreach ($v['withdraw'] as $i) {
                        
                        $wrev += $v['profit'];   
                        if ($v['profit'] <= 0)
                            $withdraw_0++;      

                        if ($v['has_agreement_fee'] > 0) {
                            $wrev_paid += $v['profit'];
                            $_arr['all']['wname_paid'][$i] = $_arr['all']['withdraw'][$i].' $'.$v['profit'];
                            $wc_paid++;
                            if ($v['profit'] <= 0)
                                $wc_paid_0++;
                        }
                        else {
                            $wrev_free += $v['profit'];
                            $_arr['all']['wname_free'][$i] = $_arr['all']['withdraw'][$i].' $'.$v['profit'];                           
                            $wc_free++;
                            if ($v['profit'] <= 0)
                                $wc_free_0++;
                        }
                    }
                }
                if (isset($v['refuse'])) {
                    foreach ($v['refuse'] as $i) {
                        
                        $rrev += $v['profit'];   
                        if ($v['profit'] <= 0)
                            $refuse_0++;      

                        if ($v['has_agreement_fee'] > 0) {
                            $rrev_paid += $v['profit'];
                            $_arr['all']['rname_paid'][$i] = $_arr['all']['refuse'][$i].' $'.$v['profit'];
                            $rc_paid++;
                            if ($v['profit'] <= 0)
                                $rc_paid_0++;
                        }
                        else {
                            $rrev_free += $v['profit'];
                            $_arr['all']['rname_free'][$i] = $_arr['all']['refuse'][$i].' $'.$v['profit'];                           
                            $rc_free++;
                            if ($v['profit'] <= 0)
                                $rc_free_0++;
                        }
                    }
                }
                if (isset($v['cancel'])) {
                    foreach ($v['cancel'] as $i) {
                        
                        $crev += $v['profit'];   
                        if ($v['profit'] <= 0)
                            $cancel_0++;      

                        if ($v['has_agreement_fee'] > 0) {
                            $crev_paid += $v['profit'];
                            $_arr['all']['cname_paid'][$i] = $_arr['all']['cancel'][$i].' $'.$v['profit'];
                            $cc_paid++;
                            if ($v['profit'] <= 0)
                                $cc_paid_0++;
                        }
                        else {
                            $crev_free += $v['profit'];
                            $_arr['all']['cname_free'][$i] = $_arr['all']['cancel'][$i].' $'.$v['profit'];                           
                            $cc_free++;
                            if ($v['profit'] <= 0)
                                $cc_free_0++;
                        }
                    }
                }
                if (isset($v['stop'])) {
                    foreach ($v['stop'] as $i) {
                        
                        $srev += $v['profit'];   
                        if ($v['profit'] <= 0)
                            $stop_0++;      

                        if ($v['has_agreement_fee'] > 0) {
                            $srev_paid += $v['profit'];
                            $_arr['all']['sname_paid'][$i] = $_arr['all']['stop'][$i].' $'.$v['profit'];
                            $sc_paid++;
                            if ($v['profit'] <= 0)
                                $sc_paid_0++;
                        }
                        else {
                            $srev_free += $v['profit'];
                            $_arr['all']['sname_free'][$i] = $_arr['all']['stop'][$i].' $'.$v['profit'];                           
                            $sc_free++;
                            if ($v['profit'] <= 0)
                                $sc_free_0++;
                        }
                    }
                }
                if (isset($v['declined'])) {
                    foreach ($v['declined'] as $i) {
                        
                        $drev += $v['profit'];   
                        if ($v['profit'] <= 0)
                            $declined_0++;      

                        if ($v['has_agreement_fee'] > 0) {
                            $drev_paid += $v['profit'];
                            $_arr['all']['dname_paid'][$i] = $_arr['all']['declined'][$i].' $'.$v['profit'];
                            $dc_paid++;
                            if ($v['profit'] <= 0)
                                $dc_paid_0++;
                        }
                        else {
                            $drev_free += $v['profit'];
                            $_arr['all']['dname_free'][$i] = $_arr['all']['declined'][$i].' $'.$v['profit'];                           
                            $dc_free++;
                            if ($v['profit'] <= 0)
                                $dc_free_0++;
                        }
                    }
                }

            }
        } 
        
		$_arr['all']['lcnt1'] = $lodge;
		$_arr['all']['gcnt1'] = $grant;
        $_arr['all']['wcnt1'] = $withdraw;
        $_arr['all']['rcnt1'] = $refuse;
        $_arr['all']['ccnt1'] = $cancel;
        $_arr['all']['scnt1'] = $stop;
        $_arr['all']['dcnt1'] = $declined;

		$_arr['all']['lcnt0'] = $lodge_0;
		$_arr['all']['gcnt0'] = $grant_0;
        $_arr['all']['wcnt0'] = $withdraw_0;
        $_arr['all']['rcnt0'] = $refuse_0;
        $_arr['all']['ccnt0'] = $cancel_0;
        $_arr['all']['scnt0'] = $stop_0;
        $_arr['all']['dcnt0'] = $declined_0;


		$_arr['all']['lfee'] = $lrev;
        $_arr['all']['lfee_paid'] = $lrev_paid;
        $_arr['all']['lfee_free'] = $lrev_free;
		$_arr['all']['gfee'] = $grev;
        $_arr['all']['gfee_paid'] = $grev_paid;
        $_arr['all']['gfee_free'] = $grev_free;
        $_arr['all']['wfee'] = $wrev;
        $_arr['all']['wfee_paid'] = $wrev_paid;
        $_arr['all']['wfee_free'] = $wrev_free;
        $_arr['all']['rfee'] = $rrev;
        $_arr['all']['rfee_paid'] = $rrev_paid;
        $_arr['all']['rfee_free'] = $rrev_free;
        $_arr['all']['cfee'] = $crev;
        $_arr['all']['cfee_paid'] = $crev_paid;
        $_arr['all']['cfee_free'] = $crev_free;
        $_arr['all']['sfee'] = $srev;
        $_arr['all']['sfee_paid'] = $srev_paid;
        $_arr['all']['sfee_free'] = $srev_free;
        $_arr['all']['dfee'] = $drev;
        $_arr['all']['dfee_paid'] = $drev_paid;
        $_arr['all']['dfee_free'] = $drev_free;

        $_arr['all']['lc_paid'] = $lc_paid;
        $_arr['all']['lc_paid_0'] = $lc_paid_0;
        $_arr['all']['lc_free'] = $lc_free;
        $_arr['all']['lc_free_0'] = $lc_free_0;
        $_arr['all']['gc_paid'] = $gc_paid;
        $_arr['all']['gc_paid_0'] = $gc_paid_0;
        $_arr['all']['gc_free'] = $gc_free;
        $_arr['all']['gc_free_0'] = $gc_free_0;
        $_arr['all']['wc_paid']   = $wc_paid;
        $_arr['all']['wc_paid_0'] = $wc_paid_0;
        $_arr['all']['wc_free']   = $wc_free;
        $_arr['all']['wc_free_0'] = $wc_free_0;
        $_arr['all']['rc_paid']   = $rc_paid;
        $_arr['all']['rc_paid_0'] = $rc_paid_0;
        $_arr['all']['rc_free']   = $rc_free;
        $_arr['all']['rc_free_0'] = $rc_free_0;
        $_arr['all']['cc_paid']   = $cc_paid;
        $_arr['all']['cc_paid_0'] = $cc_paid_0;
        $_arr['all']['cc_free']   = $cc_free;
        $_arr['all']['cc_free_0'] = $cc_free_0;
        $_arr['all']['sc_paid']   = $sc_paid;
        $_arr['all']['sc_paid_0'] = $sc_paid_0;
        $_arr['all']['sc_free']   = $sc_free;
        $_arr['all']['sc_free_0'] = $sc_free_0;
        $_arr['all']['dc_paid']   = $dc_paid;
        $_arr['all']['dc_paid_0'] = $dc_paid_0;
        $_arr['all']['dc_free']   = $dc_free;
        $_arr['all']['dc_free_0'] = $dc_free_0;

		return $_arr;				
	}

	
	
	function getCommissionByUser($userid, $page=0, $page_size=0){
		$sql = "select concat(LName, ' ', FName) as Name, a.CID, b.ID as CourseID, c.ID as SemID, d.Detail, d.KeyPoint, d.BeginDate from client_info a 
				left join client_course b on(a.CID = b.CID) 
				left join client_course_sem c on(b.ID = c.CCID) 
				left join client_course_sem_process d on(c.ID = d.SemID and d.KeyPoint <> '' and Done = 0) 
				where d.ID is not null and a.ClientType like '%study%' and c.StartDate <= NOW()"; //a.CID in ($id_str) and 
		if ($userid > 0) {
			$sql .= " AND b.ConsultantID = {$userid} ";
		}
		
		$sql .= " Order by Name asc ";//d.OrderID
		
		if ($page > 0 && $page_size > 0) {
			$sql .= " Limit ".($page-1)*$page_size.", ".$page_size;
		}		
		$_arr = array();
		$this->query($sql);//echo $sql."<p/>";
		while ($this->fetch()) {
			$_arr[$this->CID]['name'] = $this->Name;
			$_arr[$this->CID]['course'][$this->CourseID][$this->SemID]['desc'] = $this->Detail;
			$_arr[$this->CID]['course'][$this->CourseID][$this->SemID]['key'] = $this->KeyPoint;
            $_arr[$this->CID]['course'][$this->CourseID][$this->SemID]['cid'] = $this->CID;
            $_arr[$this->CID]['course'][$this->CourseID][$this->SemID]['date'] = $this->BeginDate;
		}
		return $_arr;
	}
	
	function getNumOfCommissionsByUser($userid){
		$sql = "select count(*) as cnt from client_info a 
				left join client_course b on(a.CID = b.CID) 
				left join client_course_sem c on(b.ID = c.CCID) 
				left join client_course_sem_process d on(c.ID = d.SemID and d.KeyPoint <> '' and Done = 0) 
				where d.ID is not null and a.ClientType like '%study%' and c.StartDate <= NOW()"; //a.CID in ($id_str) and 
		if ($userid > 0) {
			$sql .= " AND b.ConsultantID = {$userid} ";
		}
		
		$sql .= " Order by d.OrderID asc ";
		$this->query($sql);//echo $sql."<p/>";
		while ($this->fetch() && $this->cnt > 0) {
			return $this->cnt;
		}
		return 0;
	}


    function getCommissionByTopAgent($userid, $page=0, $page_size=0){
        $sql = "select concat(LName, ' ', FName) as Name, if(ag.Name is null, '*n/a', ag.Name) as NameAgent, b.AgentID, a.CID, b.ID as CourseID, c.ID as SemID, d.Detail, d.KeyPoint, d.BeginDate from client_info a 
                left join client_course b on(a.CID = b.CID) 
                left join client_course_sem c on(b.ID = c.CCID) 
                left join client_course_sem_process d on(c.ID = d.SemID and d.KeyPoint <> '' and Done = 0) 
                left join agent ag on (ag.ID = b.AgentID and ag.Form = 'top')
                where d.ID is not null and a.ClientType like '%study%' and c.StartDate <= NOW() and b.AgentID > 0 "; //a.CID in ($id_str) and 
        if ($userid > 0) {
            $sql .= " AND b.ConsultantID = {$userid} ";
        }
        
        $sql .= " Order by NameAgent asc, Name asc ";//d.OrderID
        
        if ($page > 0 && $page_size > 0) {
            $sql .= " Limit ".($page-1)*$page_size.", ".$page_size;
        }       
        $_arr = array();
        $this->query($sql);//echo $sql."<p/>";
        while ($this->fetch()) {
            $_arr[$this->AgentID]['name'] = $this->NameAgent;
            $_arr[$this->AgentID]['course'][$this->CourseID][$this->SemID]['desc'] = $this->Detail;
            $_arr[$this->AgentID]['course'][$this->CourseID][$this->SemID]['key'] = $this->KeyPoint;
            $_arr[$this->AgentID]['course'][$this->CourseID][$this->SemID]['cid'] = $this->CID;
            $_arr[$this->AgentID]['course'][$this->CourseID][$this->SemID]['client'] = $this->Name;
            $_arr[$this->AgentID]['course'][$this->CourseID][$this->SemID]['date'] = $this->BeginDate;
        }
        return $_arr;
    }
    
    function getNumOfCommissionsByTopAgent($userid){
        $sql = "select count(*) as cnt from client_info a 
                left join client_course b on(a.CID = b.CID) 
                left join client_course_sem c on(b.ID = c.CCID) 
                left join client_course_sem_process d on(c.ID = d.SemID and d.KeyPoint <> '' and Done = 0) 
                left join agent ag on (ag.ID = b.AgentID and ag.Form = 'top')
                where d.ID is not null and a.ClientType like '%study%' and c.StartDate <= NOW() and b.AgentID > 0"; //a.CID in ($id_str) and 
        if ($userid > 0) {
            $sql .= " AND b.ConsultantID = {$userid} ";
        }
        
        $sql .= " Order by d.OrderID asc ";
        $this->query($sql);//echo $sql."<p/>";
        while ($this->fetch() && $this->cnt > 0) {
            return $this->cnt;
        }
        return 0;
    }


    function getCommissionBySchool($userid, $page=0, $page_size=0){
        $sql = "select concat(LName, ' ', FName) as Name, if(i.Name is null, '*n/a', i.Name) as NameSchool, b.IID, a.CID, b.ID as CourseID, c.ID as SemID, d.Detail, d.KeyPoint, d.BeginDate from client_info a 
                left join client_course b on(a.CID = b.CID)
                left join client_course_sem c on(b.ID = c.CCID) 
                left join client_course_sem_process d on(c.ID = d.SemID and d.KeyPoint <> '' and Done = 0) 
                left join institute i on (b.iid = i.id) 
                where d.ID is not null and a.ClientType like '%study%' and c.StartDate <= NOW() and b.IID > 0 "; //a.CID in ($id_str) and 
        if ($userid > 0) {
            $sql .= " AND b.ConsultantID = {$userid} ";
        }
        
        $sql .= " Order by NameSchool asc, Name asc ";//d.OrderID
        
        if ($page > 0 && $page_size > 0) {
            $sql .= " Limit ".($page-1)*$page_size.", ".$page_size;
        }       
        $_arr = array();
        $this->query($sql);//echo $sql."<p/>";
        while ($this->fetch()) {
            $_arr[$this->IID]['name'] = $this->NameSchool;
            $_arr[$this->IID]['course'][$this->CourseID][$this->SemID]['desc'] = $this->Detail;
            $_arr[$this->IID]['course'][$this->CourseID][$this->SemID]['key'] = $this->KeyPoint;
            $_arr[$this->IID]['course'][$this->CourseID][$this->SemID]['cid'] = $this->CID;
            $_arr[$this->IID]['course'][$this->CourseID][$this->SemID]['client'] = $this->Name;
            $_arr[$this->IID]['course'][$this->CourseID][$this->SemID]['date'] = $this->BeginDate; 
        }
        return $_arr;
    }
    
    function getNumOfCommissionsBySchool($userid){
        $sql = "select count(*) as cnt from client_info a 
                left join client_course b on(a.CID = b.CID) 
                left join client_course_sem c on(b.ID = c.CCID) 
                left join client_course_sem_process d on(c.ID = d.SemID and d.KeyPoint <> '' and Done = 0) 
                left join institute i on (b.iid = i.id) 
                where d.ID is not null and a.ClientType like '%study%' and c.StartDate <= NOW() and b.IID > 0"; //a.CID in ($id_str) and 
        if ($userid > 0) {
            $sql .= " AND b.ConsultantID = {$userid} ";
        }
        
        $this->query($sql);//echo $sql."<p/>";
        while ($this->fetch() && $this->cnt > 0) {
            return $this->cnt;
        }
        return 0;
    }


    function getCommissionByAccount($userid, $page=0, $page_size=0){
        $sql = "select concat(LName, ' ', FName) as Name, if(i.Name is null, '*n/a', i.Name) as NameSchool, b.IID, a.CID, b.ID as CourseID, c.ID as SemID, d.Subject, d.KeyPoint, d.BeginDate from client_info a 
                left join client_course b on(a.CID = b.CID)
                left join client_course_sem c on(b.ID = c.CCID) 
                left join client_course_sem_process d on(c.ID = d.SemID and d.KeyPoint = '' and Done = 0) 
                left join institute i on (b.iid = i.id) 
                where d.ID is not null and a.ClientType like '%study%' and c.StartDate <= NOW() and b.IID > 0 and d.KeyPoint = '' "; //a.CID in ($id_str) and 
        if ($userid > 0) {
            $sql .= " AND b.ConsultantID = {$userid} ";
        }
        
        $sql .= " Order by NameSchool asc, Name asc ";//d.OrderID
        
        if ($page > 0 && $page_size > 0) {
            $sql .= " Limit ".($page-1)*$page_size.", ".$page_size;
        }       
        $_arr = array();
        $this->query($sql);//echo $sql."<p/>";
        while ($this->fetch()) {
            $_arr[$this->IID]['name'] = $this->NameSchool;
            $_arr[$this->IID]['course'][$this->CourseID][$this->SemID]['desc'] = $this->Subject;
            $_arr[$this->IID]['course'][$this->CourseID][$this->SemID]['key'] = $this->KeyPoint;
            $_arr[$this->IID]['course'][$this->CourseID][$this->SemID]['cid'] = $this->CID;
            $_arr[$this->IID]['course'][$this->CourseID][$this->SemID]['client'] = $this->Name;
            $_arr[$this->IID]['course'][$this->CourseID][$this->SemID]['date'] = $this->BeginDate;
        }
        return $_arr;
    }
    
    function getNumOfCommissionsByAccount($userid){
        $sql = "select count(*) as cnt from client_info a 
                left join client_course b on(a.CID = b.CID) 
                left join client_course_sem c on(b.ID = c.CCID) 
                left join client_course_sem_process d on(c.ID = d.SemID and d.KeyPoint = '' and Done = 0) 
                left join institute i on (b.iid = i.id) 
                where d.ID is not null and a.ClientType like '%study%' and c.StartDate <= NOW() and b.IID > 0 and d.KeyPoint = ''"; //a.CID in ($id_str) and 
        if ($userid > 0) {
            $sql .= " AND b.ConsultantID = {$userid} ";
        }
        
        $this->query($sql);//echo $sql."<p/>";
        while ($this->fetch() && $this->cnt > 0) {
            return $this->cnt;
        }
        return 0;
    }

	function getCoCommissionByUser($userid, $page=0, $page_size=0){
		/*$sql = "select concat(LName, ' ', FName) as Name, a.CID, b.ID as CourseID, c.ID as SemID, d.Detail, IF(NotifyDate is null or NotifyDate = '0000-00-00','', NotifyDate) as NotifyDate, DoB from client_info a 
				left join client_course b on(a.CID = b.CID) 
				left join client_course_sem c on(b.ID = c.CCID) 
				left join client_course_sem_process d on(c.ID = d.SemID and d.subject like 'AUTO: Course Started%' and done = 1) 
				where d.id is not null and  (a.ClientType = 'Study' or ClientType = 'all') and c.StartDate <= NOW() AND LName like 'SUB%' AND (RedDate is not null and RedDate != '0000-00-00') AND (CoDate is null or CoDate = '0000-00-00') "; //a.CID in ($id_str) and   d.ID is not null and
		 */
		$sql = "SELECT  a.AgentID, concat(LName, ' ', FName) as Name, a.CID, b.ID as CourseID, c.ID as SemID, d.NAME AS SchoolName, c.SEM, RedDate, IF(NotifyDate is null or NotifyDate = '0000-00-00','', NotifyDate) as NotifyDate, DoB, c.CoComm  
				FROM client_info a, client_course b, client_course_sem c, institute d 
				WHERE a.CID = b.CID AND b.ID = c.CCID AND b.IID = d.ID AND a.ClientType like '%study%' and c.StartDate <= NOW() AND LName like 'SUB%' AND (RedDate is not null and RedDate != '0000-00-00') AND (CoDate is null or CoDate = '0000-00-00') ";
		if ($userid > 0) {
			$sql .= " AND b.ConsultantID = {$userid} ";
		}
		
		$sql .= " Order by Name asc ";//d.OrderID
		
		if ($page > 0 && $page_size > 0) {
			$sql .= " Limit ".($page-1)*$page_size.", ".$page_size;
		}		
		$_arr = array();
		$this->query($sql);//echo $sql."<p/>";
		while ($this->fetch()) {
			$_arr[$this->AgentID][$this->CID]['name'] = $this->Name;
			$_arr[$this->AgentID][$this->CID]['dob' ] = $this->DoB;			

			if ($this->NotifyDate != '') 
				$_arr[$this->AgentID][$this->CID]['course'][$this->CourseID][$this->SemID]['desc'] = "SEM *{$this->SEM}: in {$this->SchoolName} co-com notify date {$this->NotifyDate}, Co-Comm: {$this->CoComm}";
			else
				$_arr[$this->AgentID][$this->CID]['course'][$this->CourseID][$this->SemID]['desc'] = "SEM *{$this->SEM}: in {$this->SchoolName} Commission Received {$this->RedDate}, Co-Comm: {$this->CoComm}";

			$_arr[$this->AgentID][$this->CID]['course'][$this->CourseID][$this->SemID]['date'] = $this->NotifyDate;
		}
		return $_arr;
	}

	function getNumOfCoCommissionsByUser($userid){
		$sql = "select count(*) as cnt FROM client_info a, client_course b, client_course_sem c, institute d 
				WHERE a.CID = b.CID AND b.ID = c.CCID AND b.IID = d.ID AND a.ClientType like '%study%' and c.StartDate <= NOW() AND LName like 'SUB%' AND (RedDate is not null and RedDate != '0000-00-00') AND (CoDate is null or CoDate = '0000-00-00') "; //a.CID in ($id_str) and 
		if ($userid > 0) {
			$sql .= " AND b.ConsultantID = {$userid} ";
		}
		
		$this->query($sql);//echo $sql."<p/>";
		while ($this->fetch() && $this->cnt > 0) {
			return $this->cnt;
		}
		return 0;
	}	

	function getAmountofVisaByUser($fromDay, $toDay, $userid){
//		$sql = "select date_format(PaidDate, '%u') as Week, concat(LName, ' ', FName) as Name, sum(PaidAmount) as Paid, sum(if(DueAmount is null, 0, DueAmount)) as Amount 
//				from client_payment a, client_account b, client_visa c, client_info d 
//				where a.AccountID = b.ID and b.VisaID = c.ID and c.CID = d.CID ";
		$sql = "select date_format(PaidDate, '%Y%u') as Week, concat(LName, ' ', FName) as Name, PaidAmount as Paid, if(DueAmount is null, 0, DueAmount) as Amount 
				from client_payment a, client_account b, client_visa c, client_info d 
				where a.AccountID = b.ID and b.VisaID = c.ID and c.CID = d.CID and b.ACC_TYPE = 'visa' ";		
		if ($userid > 0) {
			$sql .= " AND c.VUserID = {$userid} ";
		}
		if ($fromDay != "" && $toDay  != "") {
			$sql .= " AND a.PaidDate >= '{$fromDay}' and a.PaidDate <= '{$toDay}' ";
		}		
		$sql .= " ORDER BY d.LName, d.FName";
//		$sql .= " Group by d.CID";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()) {
			$_arr[$this->Week]['name'][] = $this->Name."$ ".($this->Amount - $this->Paid);
			$_arr[$this->Week]['paid'] = isset($_arr[$this->Week]['paid'])? $_arr[$this->Week]['paid']  : 0;
			$_arr[$this->Week]['paid'] += ($this->Amount - $this->Paid);			
		}
		return $_arr;		
	}


	function getTotalAmountofVisaByUser($fromDay, $toDay, $userid){
		$sql = "select concat(LName, ' ', FName) as Name, sum(PaidAmount) as Paid, sum(if(DueAmount is null, 0, DueAmount)) as Amount from client_payment a, client_account b, client_visa c, client_info d where a.AccountID = b.ID and b.VisaID = c.ID and c.CID = d.CID and ACC_TYPE = 'visa' ";
		if ($userid > 0) {
			$sql .= " AND c.VUserID = {$userid} ";
		}
		if ($fromDay != "" && $toDay  != "") {
			$sql .= " AND a.PaidDate >= '{$fromDay}' and a.PaidDate <= '{$toDay}' ";
		}		
		$sql .= " Group by d.CID";
        $this->query($sql);
//        echo $sql."\n";
		$_arr = array();
		$i = $paid = 0;
		while ($this->fetch()) {
			$_arr['all']['name'][$i] = $this->Name." $ ".($this->Paid);//$this->Amount - 
			$paid += ($this->Paid);	//$this->Amount - 
			$i++;	
		}		
		$_arr['all']['paid'] = $paid;
		return $_arr;
	}
	
	
    function getAllOfHomeLoan($fromDay, $toDay, $userid){
        $sql = "select concat(LName, ' ', FName) as Name, a.ID, b.CID, c.Name AS Lending, c.Category from client_homeloan a, client_info b, lending_institue c where a.CID = b.CID and a.LID = c.ID ";
        if ($userid > 0) {
            $sql .= " AND a.UserID = {$userid} ";
        }
        $sql .= " and EXISTS (select 'x' from client_homeloan_process e WHERE a.ID = e.HID AND STEP = 'refer home loan' AND BEGINDATE between '{$fromDay}' AND '{$toDay}') ";
        /*
        if ($fromDay != "" && $fromDay  != "0000-00-00") {
            $sql .= " AND a.Addtime >= '{$fromDay}'";
        }
        if ($toDay != "" && $toDay  != "0000-00-00") {
            $sql .= " And a.AddTime <= '{$toDay}' ";
        } 
        */
        $sql .= " GROUP BY a.ID ";  
        $this->query($sql);
        //echo $sql."\n";
        $_arr = array();
        $i = $fee = $signed = $signed_0 = 0;
        while ($this->fetch()) {
            $_arr['all']['pname'][$i] = $this->Name." ( {$this->Category} {$this->Lending} )";
            $_arr['all']['client'][$i] = $this->CID;
            $_arr['all']['loan'  ][$i] = $this->ID;

            $i++;
            
        }
        $_arr['all']['pcnt'] = $i;
        return $_arr;        
    }


    function getNumOfHomeLoan($fromDay, $toDay, $userid){
        $sql = "select date_format(e.BEGINDATE, '%Y%u') as Week, concat(LName, ' ', FName) as Name, a.ID, b.CID, c.Name AS Lending, c.Category from client_homeloan a left join client_homeloan_process e on (a.ID = e.HID), client_info b, lending_institue c where a.CID = b.CID and a.LID = c.ID and STEP = 'Refer home loan' ";
        if ($userid > 0) {
            $sql .= " AND a.UserID = {$userid} ";
        }
        if ($fromDay != "" && $fromDay  != "0000-00-00") {
            $sql .= " AND e.BEGINDATE >= '{$fromDay}'";
        }
        if ($toDay != "" && $toDay  != "0000-00-00") {
            $sql .= " And e.BEGINDATE <= '{$toDay}' ";
        } 
        $sql .= " GROUP BY a.ID ";  
        $this->query($sql);
        $_arr = array();
        $i = $fee = $signed = $signed_0 = 0;
        while ($this->fetch()) {
            if (!isset($_arr[$this->Week])) {
                $_arr[$this->Week] = array('pcnt' => 0, 'pname'=>array(), 'client'=>array(), 'loan'=>array());
            }

            $_arr[$this->Week]['pcnt']++;

            $_arr[$this->Week]['pname' ][$_arr[$this->Week]['pcnt']] = $this->Name." ( {$this->Category} {$this->Lending} )";
            $_arr[$this->Week]['client'][$_arr[$this->Week]['pcnt']] = $this->CID;
            $_arr[$this->Week]['loan'  ][$_arr[$this->Week]['pcnt']] = $this->ID;

            $i++;
            
        }
        return $_arr;        
    }


    function getAllOfHomeLoanFee($fromDay, $toDay, $userid){
        $sql = "select concat(LName, ' ', FName) as Name, a.ID, b.CID, c.Name AS Lending, c.Category, Commission from client_homeloan a, client_info b, lending_institue c where a.CID = b.CID and a.LID = c.ID ";
        if ($userid > 0) {
            $sql .= " AND a.UserID = {$userid} ";
        }

        $sql .= " and EXISTS (select 'x' from client_homeloan_process e WHERE a.ID = e.HID AND STEP = 'Commission received' AND BEGINDATE between '{$fromDay}' AND '{$toDay}') ";
        
        /*
        if ($fromDay != "" && $fromDay  != "0000-00-00") {
            $sql .= " AND a.Addtime >= '{$fromDay}'";
        }
        if ($toDay != "" && $toDay  != "0000-00-00") {
            $sql .= " And a.AddTime <= '{$toDay}' ";
        } 
        */
        $sql .= " GROUP BY a.ID ";  
        $this->query($sql);
        $_arr = array();
        $i = $fee = 0;
        while ($this->fetch()) {
            $_arr['all']['pname'][$i] = $this->Name." ( {$this->Category} {$this->Lending} ".'$'.$this->Commission.")";
            $_arr['all']['client'][$i] = $this->CID;
            $_arr['all']['loan'  ][$i] = $this->ID;

            $i++;
            $fee += $this->Commission;
            
        }
        $_arr['all']['fee'] = $fee;
        return $_arr;        
    }


    function getNumOfHomeLoanFee($fromDay, $toDay, $userid){
        $sql = "select date_format(e.BEGINDATE, '%Y%u') as Week, concat(LName, ' ', FName) as Name, a.ID, b.CID, c.Name AS Lending, c.Category, Commission from client_homeloan a left join client_homeloan_process e on (a.ID = e.HID), client_info b, lending_institue c where a.CID = b.CID and a.LID = c.ID and STEP = 'Commission received' ";
        if ($userid > 0) {
            $sql .= " AND a.UserID = {$userid} ";
        }
        if ($fromDay != "" && $fromDay  != "0000-00-00") {
            $sql .= " AND e.BEGINDATE >= '{$fromDay}'";
        }
        if ($toDay != "" && $toDay  != "0000-00-00") {
            $sql .= " And e.BEGINDATE <= '{$toDay}' ";
        } 
        $sql .= " GROUP BY a.ID ";  
        $this->query($sql);
        $_arr = array();
        $i = $fee = $signed = $signed_0 = 0;
        while ($this->fetch()) {
            if (!isset($_arr[$this->Week])) {
                $_arr[$this->Week] = array('pcnt'=>0, 'fee' => 0, 'pname'=>array(), 'client'=>array(), 'loan'=>array());
            }

            $_arr[$this->Week]['fee'] += $this->Commission;
            $_arr[$this->Week]['pcnt']++;

            $_arr[$this->Week]['pname' ][$_arr[$this->Week]['pcnt']] = $this->Name." ( {$this->Category} {$this->Lending} ".'$'.$this->Commission.")";
            $_arr[$this->Week]['client'][$_arr[$this->Week]['pcnt']] = $this->CID;
            $_arr[$this->Week]['loan'  ][$_arr[$this->Week]['pcnt']] = $this->ID;

            $i++;
            
        }
        return $_arr;        
    }


    function getAllOfCoach($fromDay, $toDay, $userid){
        $sql = "select concat(LName, ' ', FName) as Name, itemid, ci.title, ccl.DueHour, ccl.StartDate, cc.id as COACHID, cc.CID, ccl.Status, ccl.WeekName,ccl.StartTime from client_coach cc, coach_item ci, client_info c, client_coach_lessons as ccl where cc.itemid = ci.id and c.CID = cc.CID and cc.id = ccl.coachid and  ccl.StartDate between '{$fromDay}' AND '{$toDay}' ";

        if ($userid > 0) {
            $sql .= " AND (cc.staffid = {$userid} OR cc.saleid = {$userid}) ";
        }

        $sql .= "Order by ci.title asc, cc.CID asc, ccl.StartDate asc ";  
        $this->query($sql);
        $_arr = array();
        //$coaches = array();
        while ($this->fetch()) {
            if (!isset($_arr['all']) || !isset($_arr['all'][$this->itemid]))
                $_arr['all'][$this->itemid] = array('title'=>'', 'hour'=>0, 'client'=>0, 'list'=>array(), 'extrahour'=>0, 'lessons'=>array());   

            $_arr['all'][$this->itemid]['title'] = $this->title;
            //$_arr['all'][$this->itemid]['client']++;
            if (!isset($_arr['all'][$this->itemid]['list'][$this->COACHID])) {
                $_arr['all'][$this->itemid]['list'][$this->COACHID] = array('name'=>$this->Name, 'cid'=>$this->CID, 'duehour' => 0, 'duedetail'=>array());
            }

            //$_arr['all'][$this->itemid]['sale'] = 0;
            //$_arr['all'][$this->itemid]['paid'] = 0;
            if ($this->Status == 'Completed') {
                $_arr['all'][$this->itemid]['hour']  += round($this->DueHour/60, 2);
                $_arr['all'][$this->itemid]['lessons'][md5($this->StartDate.'|'.$this->StartTime)] = 1;
                if ($this->WeekName == 'Sat' || $this->WeekName == 'Sun' || $this->StartTime < '09:00' || $this->StartTime > '17:30') {
                    $_arr['all'][$this->itemid]['extrahour']  += round($this->DueHour/60, 2);
                }

                array_push($_arr['all'][$this->itemid]['list'][$this->COACHID]['duedetail'], $this->StartDate."[".round($this->DueHour/60, 2)."h]");

                if (!isset($_arr['all'][$this->itemid]['list'][$this->COACHID]['duehour'])) {
                    $_arr['all'][$this->itemid]['list'][$this->COACHID]['duehour'] = round($this->DueHour/60, 2);
                }
                else {
                    $_arr['all'][$this->itemid]['list'][$this->COACHID]['duehour'] += round($this->DueHour/60, 2);
                }
            }
            //$coaches[$this->COACHID] = $this->itemid;
        }

        return $_arr;
    }

    function getAllOfCoachFee($fromDay, $toDay, $userid) {
        $sql = "select itemid, cc.id as COACHID from client_coach cc, coach_item ci, client_info c, client_coach_lessons as ccl where cc.itemid = ci.id and c.CID = cc.CID and cc.id = ccl.coachid and  ccl.StartDate between '{$fromDay}' AND '{$toDay}' ";

        if ($userid > 0) {
            $sql .= " AND cc.saleid = {$userid} ";
        }

        $sql .= "Order by ci.title asc, cc.CID asc, ccl.StartDate asc ";  
        $this->query($sql);
        $_arr = array();
        $coaches = array();
        while ($this->fetch()) {    
            $_arr['all'][$this->itemid]['sale'] = 0;
            $_arr['all'][$this->itemid]['paid'] = 0;
            $coaches[$this->COACHID] = $this->itemid;
        }

        //calc payment
        if (count($coaches) > 0) {
            foreach (array_chunk(array_keys($coaches),500,true) as $coach_ids) {
                $sql = "select VisaID, DueAmount, GST, AMOUNT_3RD, GST_3RD from client_account a Where VisaID IN (".implode(',', $coach_ids).") AND ACC_TYPE = 'coach'";
                $this->query($sql);   
                while ($this->fetch()){
                    //paperwork profit
                    $_arr['all'][$coaches[$this->VisaID]]['sale'] += ($this->GST == 1? $this->DueAmount/1.1 : $this->DueAmount) - ($this->GST_3RD == 1? $this->AMOUNT_3RD/1.1 : $this->AMOUNT_3RD);
                }
    
                $sql = "select a.VisaID, Sum(if(b.PaidAmount is null, 0, b.PaidAmount)) as paid from client_account a,  client_payment b where a.ID = b.AccountID and VisaID IN (".implode(',',$coach_ids).") AND ACC_TYPE = 'coach' group by a.VisaID";
                $this->query($sql);
                while ($this->fetch()) {
                    $_arr['all'][$coaches[$this->VisaID]]['paid'] += $this->paid;
                }
            }
        }
        return $_arr;        
    }


    function getNumOfCoach($fromDay, $toDay, $userid){
        $sql = "select date_format(ccl.StartDate, '%Y%u') as Week, concat(LName, ' ', FName) as Name, itemid, ci.title, ccl.DueHour, ccl.Status, ccl.StartDate, cc.id as COACHID, cc.CID, ccl.StartTime, ccl.WeekName from client_coach cc, coach_item ci, client_info c , client_coach_lessons as ccl where cc.itemid = ci.id and c.CID = cc.CID and cc.id = ccl.coachid and ccl.StartDate between '{$fromDay}' AND '{$toDay}' ";

        if ($userid > 0) {
            $sql .= " AND ( cc.staffid = {$userid} or cc.saleid = {$userid}) ";
        }

        $sql .= "Order by ci.title asc, cc.CID asc, ccl.StartDate asc ";  
        $this->query($sql);
        $_arr = array();
        //$coaches = array();
        while ($this->fetch()) {
            if (!isset($_arr[$this->Week]) || !isset($_arr[$this->Week][$this->itemid]))
                $_arr[$this->Week][$this->itemid] = array('title'=>'', 'hour'=>0, 'client'=>0, 'list'=>array(), 'extrahour' => 0, 'lessons'=>array());   

            $_arr[$this->Week][$this->itemid]['title'] = $this->title;
            //$_arr[$this->Week][$this->itemid]['client']++;
            if (!isset($_arr[$this->Week][$this->itemid]['list'][$this->COACHID]))
                $_arr[$this->Week][$this->itemid]['list'][$this->COACHID] = array('name'=>$this->Name, 'cid'=>$this->CID, 'duehour' => 0,  'duedetail'=>array());

            //$_arr[$this->Week][$this->itemid]['sale'] = 0;
            //$_arr[$this->Week][$this->itemid]['paid'] = 0;
        
            if ($this->Status == 'Completed') {
                $_arr[$this->Week][$this->itemid]['hour']  += round($this->DueHour/60, 2);
                $_arr[$this->Week][$this->itemid]['lessons'][md5($this->StartDate.'|'.$this->StartTime)] = 1;
                
                if ($this->WeekName == 'Sat' || $this->WeekName == 'Sun' || $this->StartTime < '09:00' || $this->StartTime > '17:30') {
                    $_arr[$this->Week][$this->itemid]['extrahour']  += round($this->DueHour/60, 2);
                }
                array_push($_arr[$this->Week][$this->itemid]['list'][$this->COACHID]['duedetail'], $this->StartDate."[".round($this->DueHour/60, 2)."h]");

                if (!isset($_arr[$this->Week][$this->itemid]['list'][$this->COACHID]['duehour'])) {
                    $_arr[$this->Week][$this->itemid]['list'][$this->COACHID]['duehour'] = round($this->DueHour/60, 2);
                }
                else {
                    $_arr[$this->Week][$this->itemid]['list'][$this->COACHID]['duehour'] += round($this->DueHour/60, 2);
                }
            }
            //$coaches[$this->COACHID] = array('item_id'=>$this->itemid, 'week'=>$this->Week);
        }
        return $_arr;
    }

    function getNumOfCoachFee($fromDay, $toDay, $userid){
        $sql = "select date_format(ccl.StartDate, '%Y%u') as Week, itemid, cc.id as COACHID from client_coach cc, coach_item ci, client_info c , client_coach_lessons as ccl where cc.itemid = ci.id and c.CID = cc.CID and cc.id = ccl.coachid and ccl.StartDate between '{$fromDay}' AND '{$toDay}' ";

        if ($userid > 0) {
            $sql .= " AND cc.saleid = {$userid} ";
        }
        $sql .= "Order by ci.title asc, cc.CID asc, ccl.StartDate asc ";  
        $this->query($sql);
        $_arr = array();
        $coaches = array();
        while ($this->fetch()) {
            $_arr[$this->Week][$this->itemid]['sale'] = 0;
            $_arr[$this->Week][$this->itemid]['paid'] = 0;
            $coaches[$this->COACHID] = array('item_id'=>$this->itemid, 'week'=>$this->Week);
        }

        //calc payment
        if (count($coaches) > 0) {
            foreach (array_chunk(array_keys($coaches), 500, true) as  $coach_ids) {
                $sql = "select VisaID, DueAmount, GST, AMOUNT_3RD, GST_3RD from client_account a Where VisaID IN (".implode(',',$coach_ids).") AND ACC_TYPE = 'coach'";
                $this->query($sql);   
                while ($this->fetch()){
                    //paperwork profit
                    $_arr[$coaches[$this->VisaID]['week']][$coaches[$this->VisaID]['item_id']]['sale'] += ($this->GST == 1? $this->DueAmount/1.1 : $this->DueAmount) - ($this->GST_3RD == 1? $this->AMOUNT_3RD/1.1 : $this->AMOUNT_3RD);
                }

                $sql = "select a.VisaID, Sum(if(b.PaidAmount is null, 0, b.PaidAmount)) as paid from client_account a,  client_payment b where a.ID = b.AccountID and VisaID IN (".implode(',', $coach_ids).") AND ACC_TYPE = 'coach' group by a.VisaID";
                $this->query($sql);
                while ($this->fetch()) {
                    $_arr[$coaches[$this->VisaID]['week']][$coaches[$this->VisaID]['item_id']]['paid'] += $this->paid;
                }
            }
        }
        return $_arr;        
    }

	function getVisaReviewByUser($fromDay, $toDay, $userid){
		$sql = "select CateID, SubClassID, Sum(if(r_Status='active',1,0)) as OpenCase,  Sum(if(r_Status<>'active', 1, 0)) as CloseCase 
				from client_visa 
				Where ADate >= '{$fromDay}' and ADate <= '{$toDay}' and ADate != '' and ADate != '0000-00-00'";
		if ($userid > 0) {
			$sql .= " AND VUserID = {$userid} ";
		}
		
		$sql .= " Group by CateID , SubClassID ";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()) {
			$_arr[$this->CateID][$this->SubClassID]['open'] = $this->OpenCase;		
			$_arr[$this->CateID][$this->SubClassID]['close'] = $this->CloseCase;
		}
//		echo $sql."\n";

		$sql = "select c.CateID, c.SubClassID, 
					Sum(if(a.DueAmount is null, 0, a.DueAmount))as DueAmount, 
					Sum(if(b.PaidAmount is null, 0, b.PaidAmount)) as PaidAmount, 
					Sum(if((a.DueAmount - if(b.PaidAmount is null, 0, b.PaidAmount)) < 0, 0, a.DueAmount - if(b.PaidAmount is null, 0, b.PaidAmount))) as SubAmount 
				from client_account a left join 
					(select AccountID, sum(PaidAmount)as PaidAmount from client_payment Group by AccountID) b on(a.ID = b.AccountID),  client_visa c  where a.VisaID = c.ID ";		
		$sql .= " And c.ADate >= '{$fromDay}' and c.ADate < '{$toDay}' ";		
		
		if ($userid > 0) {
			$sql .= " AND c.VUserID = {$userid} ";
		}	
		$sql .= " Group by a.ID";

		$this->query($sql);
		while ($this->fetch()) {
			$_arr[$this->CateID][$this->SubClassID]['amount'] = isset($_arr[$this->CateID][$this->SubClassID]['amount'])? $_arr[$this->CateID][$this->SubClassID]['amount'] : 0;
			$_arr[$this->CateID][$this->SubClassID]['paid'] = isset($_arr[$this->CateID][$this->SubClassID]['paid'])? $_arr[$this->CateID][$this->SubClassID]['paid'] : 0;
			$_arr[$this->CateID][$this->SubClassID]['subamt'] = isset($_arr[$this->CateID][$this->SubClassID]['subamt'])? $_arr[$this->CateID][$this->SubClassID]['subamt'] : 0;
			$_arr[$this->CateID][$this->SubClassID]['amount'] += $this->DueAmount;		
			$_arr[$this->CateID][$this->SubClassID]['paid']   += $this->PaidAmount;
			$_arr[$this->CateID][$this->SubClassID]['subamt'] += $this->SubAmount;
		}
		return $_arr;
	}
	
	function getVisaOpenCaseByUser($fromDay, $toDay, $catid, $subid, $userid, $opencase){	
		$visaArr = array();
		$sql = "SELECT DISTINCT CVID FROM client_visa_process WHERE BeginDate >= '{$fromDay}' AND BeginDate <= '{$toDay}' ";
		$this->query($sql);
		while ($this->fetch()) {
			array_push($visaArr, $this->CVID);
		}

		if (count($visaArr) == 0) {
			return false;
		}
		$_str = "'". implode("','", $visaArr) ."'";
				
			
		$sql = "select ID, b.CID, concat(b.FName,' ', b.LName) as Name, CateID, SubClassID, r_Status, ADate, AFee 
				from client_visa a left join client_info b on(a.CID = b.CID) 
				Where a.ID in ({$_str})";
		if ($catid > 0) {
			$sql .= " AND CateID = {$catid}";
		}
		if ($subid > 0) {
			$sql .= " AND SubClassID = {$subid}";
		}
		
		if ($userid > 0) {
			$sql .= " AND VUserID = {$userid} ";
		}	
		
		if ($opencase) {
			$sql .= " AND r_Status = 'active' ";
		}
		$sql .= "Order by Name asc, ADate";	
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()) {
			$_arr[$this->ID]['name'] = $this->Name;	
			$_arr[$this->ID]['cid'] = $this->CID;	
			$_arr[$this->ID]['adate'] = $this->ADate;
			$_arr[$this->ID]['afee'] = $this->AFee;
			$_arr[$this->ID]['catid'] = $this->CateID;
			$_arr[$this->ID]['subid'] = $this->SubClassID;
			$_arr[$this->ID]['case'] = $this->r_Status;
		}	
		return $_arr;		
	}
	
    function getAccountOwe(){
		$sql = "select concat(d.LName, ' ', d.FName) as Name, c.CID, c.CateID, c.SubClassID, a.VisaID, if(DueAmount is null, 0, DueAmount) as amount,
 				if((DueDate = '' or DueDate = '0000-00-00') && (if(DueAmount is null, 0, DueAmount) > 0), 0, if(DueAmount is null, 0, DueAmount) - if(b.PaidAmount is null, 0, b.PaidAmount)) as Balance 
 						from client_account a 
						left join (select AccountID, sum(PaidAmount) as PaidAmount from client_payment Group by AccountID) b on(a.ID = b.AccountID) 
						left join client_visa c on(a.VisaID = c.ID)
						left join client_info d on(c.CID = d.CID)
				Group by a.ID having Balance <> 0 order by Balance desc, Name asc ";
        $this->query($sql);
        $_arr = array();
        while ($this->fetch()){
        	$_arr[$this->VisaID]['client'] = $this->Name;
        	$_arr[$this->VisaID]['clientid'] = $this->CID;
        	$_arr[$this->VisaID]['cateid'] = $this->CateID;
        	$_arr[$this->VisaID]['subclassid'] = $this->SubClassID;
        	$_arr[$this->VisaID]['balance'] = isset($_arr[$this->VisaID]['balance'])? $_arr[$this->VisaID]['balance'] : 0;
        	$_arr[$this->VisaID]['balance'] += $this->Balance;
        	$_arr[$this->VisaID]['amount'] = isset($_arr[$this->VisaID]['amount'])? $_arr[$this->VisaID]['amount'] : 0;
        	$_arr[$this->VisaID]['amount'] += $this->amount;
        	
        }
        return $_arr;
    }

    function getStaffArchive($staff_id, $rpt_type) {
        $rtn = array();
        $file = __DOWNLOAD_PATH.'reportstaff/'.$rpt_type.$staff_id.'.dat';
        if (!file_exists($file))
            return $rtn;
        //unlink($file);exit;
        $fp = fopen($file, 'r');
        if (!$fp)
            return $rtn;
            
        while(!feof($fp)) {
            $lr = explode("#####", trim(fgets($fp)));
            if ($lr[0] == 'filter') {
                $rtn = json_decode($lr[1], true);
            }
            elseif(isset($lr[1])) {
                $rtn[$lr[0]] = json_decode($lr[1], true);
            }
        }
        fclose($fp);
        
        /*
        $sql = "SELECT * FROM report_staff where staff_id = '{$staff_id}' and rpt_type = '{$rpt_type}' ";

        $this->query($sql);
        $rtn = array();
        while($this->fetch()) {
            $rtn = json_decode($this->filtering, true);

            $rtn['courses'] = json_decode($this->courses, true);
            $rtn['courseprocs'] = json_decode($this->courseprocs, true);
            $rtn['coursesems'] = json_decode($this->coursesems, true);
            $rtn['coursepots'] = json_decode($this->coursepots, true);
            $rtn['visaagrees'] = json_decode($this->visaagrees, true);
            $rtn['visaprocs'] = json_decode($this->visaprocs, true);
            $rtn['visavisits'] = json_decode($this->visavisits, true);
            $rtn['homeloan'] = json_decode($this->homeloan, true);
            $rtn['homeloan_fee'] = json_decode($this->homeloan_fee, true);
        }
        */
        return $rtn;
    }

    function doStaffArchive($staff_id, $rpt_type, $filter, $courses, $courseprocs, $coursesems, $coursepots, $visaagrees, $visaprocs, $visavisits, $homeloan, $homeloan_fee, $coaches) {
        $path = __DOWNLOAD_PATH.'reportstaff/';
        if (!is_dir($path)) {
            mkdir($path) or die("Cannot create user dir!");
        }	

        $fw = fopen($path.$rpt_type.$staff_id.'.dat', 'w');
        if (!$fw)
            die("Archive file failed");

        fwrite($fw, 'filter#####'.json_encode($filter)."\n");
        fwrite($fw, 'courses#####'.json_encode($courses)."\n");
        fwrite($fw, 'courseprocs#####'.json_encode($courseprocs)."\n");
        fwrite($fw, 'coursesems#####'.json_encode($coursesems)."\n");
        fwrite($fw, 'coursepots#####'.json_encode($coursepots)."\n");
        fwrite($fw, 'visaagrees#####'.json_encode($visaagrees)."\n");
        fwrite($fw, 'visaprocs#####'.json_encode($visaprocs)."\n");
        fwrite($fw, 'visavisits#####'.json_encode($visavisits)."\n");
        fwrite($fw, 'homeloan#####'.json_encode($homeloan)."\n");
        fwrite($fw, 'homeloan_fee#####'.json_encode($homeloan_fee)."\n");
        fwrite($fw, 'coaches#####'.json_encode($coaches)."\n");
        fclose($fw);

        return true;
/*
        $courses = addslashes(json_encode($courses));
        $courseprocs = addslashes(json_encode($courseprocs));
        $coursesems = addslashes(json_encode($coursesems));
        $coursepots = addslashes(json_encode($coursepots));
        $visaagrees = addslashes(json_encode($visaagrees));
        $visaprocs = addslashes(json_encode($visaprocs));
        $visavisits = addslashes(json_encode($visavisits));
        $homeloan = addslashes(json_encode($homeloan));
        $homeloan_fee = addslashes(json_encode($homeloan_fee));
        $filter = addslashes(json_encode($filter));

        $sql = "replace into report_staff (staff_id,rpt_type, filtering,courses,courseprocs,coursesems,coursepots,visaagrees,visaprocs,visavisits,homeloan,homeloan_fee) values ('{$staff_id}', '{$rpt_type}', '{$filter}', '{$courses}','{$courseprocs}','{$coursesems}','{$coursepots}','{$visaagrees}','{$visaprocs}','{$visavisits}','{$homeloan}','{$homeloan_fee}') ";
	   return $this->query($sql);
*/  
    }    		

    function checkStaffArchive($staff_id) {
        $path = __DOWNLOAD_PATH.'reportstaff/';
        if (!file_exists($path.'s'.$staff_id.'.dat')) {
            return false;
        }
        if (!file_exists($path.'d'.$staff_id.'.dat')) {
            return false;
        }
        return true;
    }
}
?>
