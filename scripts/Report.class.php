<?php
require_once('MysqlDB.class.php');

class ReportAPI extends MysqlDB {

    function ReportAPI($host, $user, $pswd, $database, $debug) {
    	$this->MysqlDB($host, $user, $pswd, $database, $debug);
    }
    
    
    function getUrgentVisa($userid, $sort_list){
		$_arr = array();
		$sql = "select a.ID, concat(LName, ' ', FName) as ClientName, VisaName, ClassName, IF(a.ItemID > 0, Item, ExItem) as Item, DueDate, BeginDate, f.CID, CVID,
		               if(((a.DueDate >= Date(NOW()) and a.DueDate < Date(NOW()) + INTERVAL 7 Day) or a.DueDate < Date(NOW()))and a.DueDate <> '0000-00-00',0,1) as isTodo,
		               if(a.DueDate = '0000-00-00', '9999-99-99', a.DueDate) as sortdue 
    				from client_visa_process a left join visa_rs_item c on(a.ItemID = c.ItemID) ,  client_visa  b, visa_category d,  visa_subclass e, client_info f   
					where a.Done = 0 and a.CVID = b.ID and b.CID = f.CID and b.CateID = d.CateID and b.SubClassID = e.SubClassID ";
		//((a.DueDate >= Date(NOW()) and a.DueDate < Date(NOW()) + INTERVAL 7 Day) or a.DueDate < Date(NOW()))and a.DueDate <> '0000-00-00' and		
		if ($userid > 0){
			$sql .= " AND b.VUserID = {$userid} "; //(b.AUserID = {$userid} or 
		}
		if ($sort_list != ''){
	        $sql .= " Order by {$sort_list}";
		}
		else{
            $sql .= " Order by sortdue asc, Name asc, Item desc";	
		}
		
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

	
	function getUrgentCourse($userid, $sort_list, $only_course){
		$_arr = array();
    	$sql = "select a.ID, concat(LName, ' ', FName) as ClientName, Qual, Major, e.Name, DueDate, BeginDate, if(p.ID is not null, p.Process, ExItem) as ProcessName, f.CID, CCID,
            if(((a.DueDate >= Date(NOW()) and a.DueDate < Date(NOW()) + INTERVAL 7 Day) or a.DueDate < Date(NOW()))and a.DueDate <> '0000-00-00',0,1) as isTodo,
                if(a.DueDate = '0000-00-00', '9999-99-99', a.DueDate) as sortdue, if(p.ID > 0, p.ID, 0) AS ProcessID  
    				from client_course_process a left join course_process p on (a.ProcessID = p.ID), client_course  b,  institute_qual c,  institute_major d, institute e, client_info f
					where b.CID = f.CID and a.Done = 0 and a.CCID = b.ID and b.QualID = c.ID and b.MajorID = d.ID and b.IID = e.ID ";
    	//a.DueDate >= Date(NOW()) and 
		if ($userid > 0 && $only_course == 0){
			$sql .= " AND f.CourseUser = {$userid}";
		}
		
		if ($only_course == 1){
		    $sql .= " AND f.ClientType in ('sutdy', 'all') ";
		}
		
	    if ($sort_list != ''){
            $sql .= " Order by {$sort_list}";
        }
        else{
            $sql .= " Order by sortdue asc, ClientName asc ";   
        }
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

	function getUrgentInstitute($sort_list){
		$_arr = array();
		$sql = "select a.ID, a.Subject, a.BeginDate, a.DueDate, a.InstID, b.Name,
            if(((a.DueDate >= Date(NOW()) and a.DueDate < Date(NOW()) + INTERVAL 7 Day) or a.DueDate < Date(NOW()))and a.DueDate <> '0000-00-00',0,1) as isTodo ,
                 if(a.DueDate = '0000-00-00', '9999-99-99', a.DueDate) as sortdue
		        from institute_process a, institute b
				where a.Done = 0 and a.InstID = b.ID 
				";
	    if ($sort_list != ''){
            $sql .= " Order by {$sort_list}";
        }
        else{
            $sql .= " Order by sortdue desc, Name asc ";   
        }
        
		$this->query($sql);		
		while ($this->fetch()) {
			$_arr[$this->ID]['school'] = $this->Name;
			$_arr[$this->ID]['begin'] = $this->BeginDate;
			$_arr[$this->ID]['due'] = $this->DueDate;
			$_arr[$this->ID]['item'] = $this->Subject;
			$_arr[$this->ID]['iid'] = $this->InstID;
			$_arr[$this->ID]['isTodo'] = $this->isTodo;
		}
		return $_arr;
	}
	
	function getUrgentAgent($sort_list){

		$_arr = array();
		$sql = "select a.ID, a.Subject, a.BeginDate, a.DueDate, a.AgentID, b.Name,
            if(((a.DueDate >= Date(NOW()) and a.DueDate < Date(NOW()) + INTERVAL 7 Day) or a.DueDate < Date(NOW()))and a.DueDate <> '0000-00-00',0,1) as isTodo ,
                 if(a.DueDate = '0000-00-00', '9999-99-99', a.DueDate) as sortdue
		        from agent_process a, agent b
				where a.Done = 0 and a.AgentID = b.ID 
				";
		
        if ($sort_list != ''){
            $sql .= " Order by {$sort_list}";
        }
        else{
            $sql .= " Order by sortdue desc, Name asc ";   
        }
        		
		
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
	
    function getUrgentService($userid, $sort_list){
		$_arr = array();
    	$sql = "select a.ID, concat(LName, ' ', FName) as ClientName, a.Subject, DueDate, a.Date, a.CID, 
            if(((a.DueDate >= Date(NOW()) and a.DueDate < Date(NOW()) + INTERVAL 7 Day) or a.DueDate < Date(NOW()))and a.DueDate <> '0000-00-00',0,1) as isTodo,
                 if(a.DueDate = '0000-00-00', '9999-99-99', a.DueDate) as sortdue
    				from client_service a, client_info b  
					where a.Done = 0 and a.CID = b.CID and a.VisaCateID = 0 and VisaSubClassID = 0 ";
		if ($userid > 0){
			$sql .= " AND b.CourseUser = {$userid} ";
		}
		
        if ($sort_list != ''){
            $sql .= " Order by {$sort_list}";
        }
        else{
            $sql .= " Order by sortdue desc, ClientName asc, Subject asc";   
        }
		$this->query($sql);
		while ($this->fetch()){
			$_arr[$this->ID]['name'] = $this->ClientName;
			$_arr[$this->ID]['item']  = $this->Subject;
			$_arr[$this->ID]['begin'] = $this->Date;
			$_arr[$this->ID]['due']   = $this->DueDate;
			$_arr[$this->ID]['clientid']   = $this->CID;
			$_arr[$this->ID]['isTodo']   = $this->isTodo;
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
	
	function getVisaService($userid=0){
		$_arr = array();
		$sql = "select a.ID as VID, a.CID, a.ExpireDate as Epd, b.FName, b.LName, c.VisaName, d.ClassName, 0 as main from client_visa a left join visa_category c on(a.CateID = c.CateID) left join visa_subclass d on(a.SubClassID = d.SubClassID), client_info b where a.CID = b.CID and a.r_Status = 'active' and a.OnShore = 1 and (a.ADate <> '' and a.ADate <> '0000-00-00')";
		if($userid > 0){
			$sql .= " AND (a.AUserID = {$userid} or a.VUserID = {$userid}) ";
		}
		$sql .= "Union all select e.CVID as VID, e.DepID, e.ExpireDate as Epd, b.FName, b.LName, c.VisaName, d.ClassName, a.CID as main from client_visa a left join visa_category c on(a.CateID = c.CateID) left join visa_subclass d on(a.SubClassID = d.SubClassID) , client_visa_dep e, client_info b where e.DepID = b.CID and e.CVID = a.ID and a.r_Status = 'active' and (a.ADate <> '' and a.ADate <> '0000-00-00') ";
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
		$sql = "select a.ID, a.CID, a.DueDate, b.LName, b.FName, c.VisaName, d.ClassName from client_service a left join visa_category c on(c.CateID = a.VisaCateID) left join visa_subclass d on(d.SubClassID = a.VisaSubClassID ), client_info b where a.Done = 0 and a.VisaCateID > 0 and a.CID = b.CID and a.CID not in (select distinct DepID from client_visa_dep t1, client_visa t2 where t1.CVID = t2.ID and t2.r_Status = 'active')";
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
		$sql = "select Date_Format(CourseVisitDate, '%Y%u') as Week,  concat(LName, ' ', FName) as Name, t1.CID, t2.ID as CourseID, t2.ProcessID from client_info t1 left join (select a.ID as PID, b.CID, b.ID, a.ProcessID from client_course_process a, client_course b where a.ProcessID = ".__C_APPLY_OFFER." and a.CCID = b.ID AND a.Done = 1) t2 on (t1.CID = t2.CID) WHERE 1 ";		
		if ($userid > 0) {
			$sql .= " AND CourseUser = {$userid} ";
		}
		if ($fromDay != "" && $toDay  != "") {
			$sql .= " AND CourseVisitDate >= '{$fromDay}' and CourseVisitDate <= '{$toDay}' ";
		}
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()) {
			if ($this->ProcessID == __C_APPLY_OFFER) {
				$_arr[$this->Week]['apo'][$this->CID] = 1;	
			}
			else {
				$_arr[$this->Week]['apo'][$this->CID] = 0;
			}
			$_arr[$this->Week]['name'][$this->CID] = $this->Name;
			$_arr[$this->Week]['cnt' ] = count($_arr[$this->Week]['name']);		
		}

		
		return $_arr;		 
	}
	
	function getAllOfCourseClientByUser($fromDay, $toDay, $userid){
		//$sql = "select count(*) as cnt from client_info where CourseVisitDate != '0000-00-00' ";
		//$sql = "select concat(LName, ' ', FName) as Name, a.CID, School, Qual from client_info a left join (select CID, School, Qual, max(t1.ID) from client_qual t1, school t2, course_qual t3 where t1.SchoolID = t2.ID and t1.QualID = t3.ID Group by t1.CID) b on(b.CID = a.CID) where CourseVisitDate != '0000-00-00' ";
		$sql = "select concat(LName, ' ', FName) as Name, t1.CID, t2.ID as CourseID, t2.ProcessID, t2.IsActive from client_info t1 left join (select a.ID as PID, b.CID, b.ID, a.ProcessID, b.IsActive from client_course_process a, client_course b where a.ProcessID = ".__C_APPLY_OFFER." and a.CCID = b.ID AND a.Done = 1) t2 on (t1.CID = t2.CID) WHERE 1 ";

		if ($userid > 0) {
			$sql .= " AND CourseUser = {$userid} ";
		}
		if ($fromDay != "" && $toDay  != "") {
			$sql .= " AND CourseVisitDate >= '{$fromDay}' and CourseVisitDate <= '{$toDay}' ";
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
			$_arr['all']['st'][$this->CID] = $this->IsActive == 2? -1 : 0;				
		}

		$_arr['all']['cnt'] = isset($_arr['all'])? count($_arr['all']['name']) : 0;
		return $_arr;		 
	}
		
	function getNumOfCourseProcessByUser($fromDay, $toDay, $userid){	
        $sql = "select Date_Format(BeginDate, '%Y%u') as Week, b.IsActive, b.ID, a.ProcessID, concat(LName, ' ', FName) as Name, d.Name as School, e.Qual, c.CID from client_course_process a, client_info c, client_course b left join institute d on(b.IID = d.ID) left join institute_qual e on(b.QualID = e.ID) where (a.ProcessID = ".__C_RECEIVE_OFFER." or a.ProcessID = ".__C_PASS_OFFER." or a.ProcessID = ".__C_GET_COE." or a.ProcessID = ".__C_PAY_TUITION_FEE.") and a.CCID = b.ID and b.CID = c.CID and a.Done = 1 ";
   
		if ($userid > 0) {
			$sql .= " AND c.CourseUser = {$userid} ";
		}else{
			
		}
		if ($fromDay != "" && $toDay  != "") {
			$sql .= " AND BeginDate >= '{$fromDay}' and BeginDate <= '{$toDay}' ";
        }

		$this->query($sql);
		$_arr = array();
		while ($this->fetch()) {
			if ($this->ProcessID == __C_APPLY_OFFER) {
                $_arr[$this->Week]['aponame'][$this->ID] = $this->Name. " (to ". $this->School ." : ". $this->Qual .")";	
				$_arr[$this->Week]['apocid' ][$this->ID] = $this->CID;
				$_arr[$this->Week]['reo'    ][$this->ID] = 0;	

				isset($_arr[$this->Week]['apocnt'])? $_arr[$this->Week]['apocnt']++ : $_arr[$this->Week]['apocnt'] = 1; 
            }
            elseif ($this->ProcessID == __C_RECEIVE_OFFER){
                $_arr[$this->Week]['reoname'][$this->ID] = $this->Name. " (to ". $this->School ." : ". $this->Qual .")";	
				$_arr[$this->Week]['reocid' ][$this->ID] = $this->CID;
				$_arr[$this->Week]['reo'    ][$this->ID] = 1;	
				
                $_arr[$this->Week]['reo_st' ][$this->ID] = $this->IsActive == 2? -1 : 0;	

				isset($_arr[$this->Week]['reocnt'])? $_arr[$this->Week]['reocnt']++ : $_arr[$this->Week]['reocnt'] = 1;
            }
            elseif ($this->ProcessID == __C_GET_COE){
                $_arr[$this->Week]['recname'][$this->ID] = $this->Name. " (to ". $this->School ." : ". $this->Qual .")";	
				$_arr[$this->Week]['reccid' ][$this->ID] = $this->CID;	                
				$_arr[$this->Week]['rec'    ][$this->ID] = 1;

				isset($_arr[$this->Week]['reccnt'])? $_arr[$this->Week]['reccnt']++ : $_arr[$this->Week]['reccnt'] = 1; 
            }
            elseif($this->ProcessID == __C_PAY_TUITION_FEE && isset($_arr[$this->Week]['reo_st'][$this->ID]) && $_arr[$this->Week]['reo_st'][$this->ID] == 0) {
                $_arr[$this->Week]['reo_st'][$this->ID] = 1;
            }            
        }		
  
		return $_arr;			
	}
	
	
	function getAllOfCourseProcessByUser($fromDay, $toDay, $userid){
		$where = "";
		if ($userid > 0) {
			$where .= " AND c.CourseUser = {$userid} ";
		}
		
		if ($fromDay != "" && $toDay  != "") {
			$where .= " AND BeginDate >= '{$fromDay}' and BeginDate <= '{$toDay}' ";
		}
		//get apply offer
		$sql = "select b.IsActive, b.ID, a.ProcessID, concat(LName, ' ', FName) as Name, d.Name as School, e.Qual, c.CID from client_course_process a, client_info c, client_course b left join institute d on(b.IID = d.ID) left join institute_qual e on(b.QualID = e.ID) where (a.ProcessID = ".__C_RECEIVE_OFFER." or a.ProcessID = ".__C_PASS_OFFER." or a.ProcessID = ".__C_GET_COE." or a.ProcessID = ".__C_PAY_TUITION_FEE.") and a.CCID = b.ID and b.CID = c.CID and a.Done = 1 ";
        $this->query($sql.$where);

		$_arr = array();
		while ($this->fetch()) {
			if ($this->ProcessID == __C_RECEIVE_OFFER) {
                $_arr['all']['aponame'][$this->ID] = $this->Name. " (to ". $this->School ." : ". $this->Qual .")";	
				$_arr['all']['apocid' ][$this->ID] = $this->CID;
				$_arr['all']['reo'    ][$this->ID] = 0;	

            }
            elseif ($this->ProcessID == __C_PASS_OFFER){
                $_arr['all']['reoname'][$this->ID] = $this->Name. " (to ". $this->School ." : ". $this->Qual .")";	
				$_arr['all']['reocid' ][$this->ID] = $this->CID;
				$_arr['all']['reo'    ][$this->ID] = 1;	
				
				$_arr['all']['reo_st' ][$this->ID] = $this->IsActive == 2? -1 : 0;	

            }
            elseif ($this->ProcessID == __C_GET_COE){
                $_arr['all']['recname'][$this->ID] = $this->Name. " (to ". $this->School ." : ". $this->Qual .")";	
				$_arr['all']['reccid' ][$this->ID] = $this->CID;	                
				$_arr['all']['rec'    ][$this->ID] = 1;
            }
            elseif($this->ProcessID == __C_PAY_TUITION_FEE && isset($_arr['all']['reo_st'][$this->ID]) && $_arr['all']['reo_st'][$this->ID] == 0) {
                $_arr['all']['reo_st'][$this->ID] = 1;
            }
		}

		$_arr['all']['apocnt'] = isset($_arr['all']) && isset($_arr['all']['aponame']) ? count($_arr['all']['aponame']) : 0;
		$_arr['all']['reocnt'] = isset($_arr['all']) && isset($_arr['all']['reoname']) ? count($_arr['all']['reoname']): 0;
        $_arr['all']['reccnt'] = isset($_arr['all']) && isset($_arr['all']['recname']) ? count($_arr['all']['recname']): 0;
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
						IF(t1.BeginDate >= d.StartDate and d.StartDate <> '' and d.StartDate <> '0000-00-00', IF(concat(LName, ' ', FName) like 'sub-%', RedComm-CoComm,RedComm-Discount), 0) as bonus,
						IF(t1.BeginDate >= d.StartDate and d.StartDate <> '' and d.StartDate <> '0000-00-00', 0, 1) as nobonus
                FROM client_course_sem a  
                      left join client_course_process t1 on (a.CCID = t1.CCID AND t1.Done = 1 and t1.ProcessID = 5)
                     , client_course b,client_info c, sys_user d
                WHERE a.CCID = b.ID 
                  AND b.CID = c.CID 
                  AND c.CourseUser = d.ID
                  AND RedDate >= '{$fromDay}' AND RedDate <= '{$toDay}' "; 
	    if ($userid > 0) {
            $sql .= " AND c.CourseUser = {$userid} ";
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
                        c.CID, a.ID, a.CCID,c.DOB,
						IF(t1.BeginDate >= d.StartDate and d.StartDate <> '' and d.StartDate <> '0000-00-00', IF(concat(LName, ' ', FName) like 'sub-%', RedComm-CoComm,RedComm-Discount), 0) as bonus,
						IF(t1.BeginDate >= d.StartDate and d.StartDate <> '' and d.StartDate <> '0000-00-00', 0, 1) as nobonus
                      FROM client_course_sem a
                        left join client_course_process t1 on (a.CCID = t1.CCID AND t1.Done = 1 and t1.ProcessID = 5)
		                    , client_course b,client_info c, sys_user d
		               WHERE a.CCID = b.ID 
		                  AND b.CID = c.CID 
                          AND c.CourseUser = d.ID 
                          AND RedDate >= '{$fromDay}' AND RedDate <= '{$toDay}'";
                  
		if ($userid > 0) {
			$sql .= " AND c.CourseUser = {$userid} ";
        }

        $sql .= " Order by wk, Name, a.SEM ";
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
			$bonus += $this->bonus;
			$i++;
		}
		$_arr['all']['bonus'] = $bonus;
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
						IF(t1.BeginDate >= d.StartDate and d.StartDate <> '' and d.StartDate <> '0000-00-00', IF(concat(LName, ' ', FName) like 'sub-%', RComm-CoComm,RComm-Discount), 0) as rcomm,
						IF(t1.BeginDate >= d.StartDate and d.StartDate <> '' and d.StartDate <> '0000-00-00', 0, 1) as norcomm
                FROM client_course_sem a  
                      left join client_course_process t1 on (a.CCID = t1.CCID AND t1.Done = 1 and t1.ProcessID = 5)
                     , client_course b,client_info c, sys_user d
                WHERE a.CCID = b.ID 
                  AND b.CID = c.CID 
                  AND c.CourseUser = d.ID
                  AND t1.BeginDate >= '{$fromDay}' AND t1.BeginDate <= '{$toDay}' "; 
	    if ($userid > 0) {
            $sql .= " AND c.CourseUser = {$userid} ";
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
		      $sql = "SELECT  date_format(BeginDate, '%Y-%u') as wk,
                        concat(LName, ' ', FName) as Name, 
                        c.CID, a.ID, a.CCID, c.DOB,
						IF(t1.BeginDate >= d.StartDate and d.StartDate <> '' and d.StartDate <> '0000-00-00', IF(concat(LName, ' ', FName) like 'sub-%', RComm-CoComm,RComm-Discount), 0) as rcomm,
						IF(t1.BeginDate >= d.StartDate and d.StartDate <> '' and d.StartDate <> '0000-00-00', 0, 1) as norcomm
                      FROM client_course_sem a
                        left join client_course_process t1 on (a.CCID = t1.CCID AND t1.Done = 1 and t1.ProcessID = 5)
		                    , client_course b,client_info c, sys_user d
		               WHERE a.CCID = b.ID 
		                  AND b.CID = c.CID 
                          AND c.CourseUser = d.ID 
                          AND t1.BeginDate >= '{$fromDay}' AND t1.BeginDate <= '{$toDay}'";
                  
		if ($userid > 0) {
			$sql .= " AND c.CourseUser = {$userid} ";
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
			$rcomm += $this->rcomm;
			$i++;
		}
		$_arr['all']['rcomm'] = $rcomm;
		return $_arr;			
	}

	function getNumOfAgreementByUser($fromDay, $toDay, $userid){
		$sql = "select date_format(ADate, '%Y%u') as Week, concat(LName, ' ', FName) as Name, a.ID, b.CID, AFee, c.VisaName, d.ClassName, 
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
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()) {
			isset($_arr[$this->Week]['pcnt'])? $_arr[$this->Week]['pcnt']++ : $_arr[$this->Week]['pcnt'] = 1;
			$_arr[$this->Week]['pname'][$_arr[$this->Week]['pcnt']] = $this->Name." ( {$this->VisaName} {$this->ClassName} )";
			$_arr[$this->Week]['client'][$_arr[$this->Week]['pcnt']] = $this->CID;  
            $_arr[$this->Week]['visa'  ][$_arr[$this->Week]['pcnt']] = $this->ID;   
			
			if ($this->sign == 1) {
				isset($_arr[$this->Week]['sign'])? ($_arr[$this->Week]['sign']++) : ($_arr[$this->Week]['sign'] = 1);
				$_arr[$this->Week]['fname' ][$_arr[$this->Week]['pcnt']] = $this->Name." ( {$this->VisaName} {$this->ClassName} )    $ {$this->AFee}";	
				isset($_arr[$this->Week]['fee'])? ($_arr[$this->Week]['fee'] += $this->AFee) : ($_arr[$this->Week]['fee'] = $this->AFee);
			}
		}
		return $_arr;		
	}
	
	
	
    function getNumOfVisitByUser($fromDay, $toDay, $userid){
        $sql = "select date_format(VisitDate, '%Y%u') as Week, concat(LName, ' ', FName) as Name, a.ID, b.CID, AFee, c.VisaName, d.ClassName, 
                IF(`State` = 'active' and ADate != '0000-00-00' and Adate != '', 1, 0) as sign
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
            $_arr[$this->Week]['pname'][$_arr[$this->Week]['pcnt']] = $this->Name." ( {$this->VisaName} {$this->ClassName} )";
            $_arr[$this->Week]['client'][$_arr[$this->Week]['pcnt']] = $this->CID;  
            $_arr[$this->Week]['visa'  ][$_arr[$this->Week]['pcnt']] = $this->ID;
            $_arr[$this->Week]['sign'  ][$_arr[$this->Week]['pcnt']] = $this->sign == 1? 1 : 0;               
        }
        return $_arr;       
    }
    	
	
	function getAllOfAgreementByUser($fromDay, $toDay, $userid){
		$sql = "select concat(LName, ' ', FName) as Name, a.ID, b.CID, AFee, c.VisaName, d.ClassName, 
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
		$this->query($sql);
		$_arr = array();
		$i = $fee = $signed = 0;
		while ($this->fetch()) {
			$_arr['all']['pname'][$i] = $this->Name." ( {$this->VisaName} {$this->ClassName} )";
			$_arr['all']['client'][$i] = $this->CID;
            $_arr['all']['visa'  ][$i] = $this->ID;
			
			if ($this->sign == 1) {
				$signed++;
				$_arr['all']['fname' ][$i] = $this->Name." ( {$this->VisaName} {$this->ClassName} )    $ {$this->AFee}";

				$fee += $this->AFee;
			}
			$i++;
			
		}
		$_arr['all']['pcnt'] = $i;
		$_arr['all']['fee'] = $fee;
		$_arr['all']['sign'] = $signed;
		return $_arr;		
	}

	
    function getAllOfVisitByUser($fromDay, $toDay, $userid){
        $sql = "select concat(LName, ' ', FName) as Name, a.ID, b.CID, AFee, c.VisaName, d.ClassName, 
                       IF(`State` = 'active' and ADate != '0000-00-00' and ADate != '', 1, 0) as sign
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
        $i = 0;
        while ($this->fetch()) {
            $_arr['all']['pname'][$i] = $this->Name." ( {$this->VisaName} {$this->ClassName} )";
            $_arr['all']['client'][$i] = $this->CID;
            $_arr['all']['visa'  ][$i] = $this->ID;
            $_arr['all']['sign'  ][$i] = $this->sign == 1? 1 : 0;
            $i++;
        }
        $_arr['all']['pcnt'] = $i;
        return $_arr;       
    }	
	
	function getNumOfVisaProcByUser($fromDay, $toDay, $userid){
/*		$sql = "select d.CID, sum(PaidAmount) as Paid, sum(if(DueAmount is null, 0, DueAmount)) as Amount from client_payment a, client_account b, client_visa c, client_info d where a.AccountID = b.ID and b.VisaID = c.ID and c.CID = d.CID ";
		if ($userid > 0) {
			$sql .= " AND c.VUserID = {$userid} ";
		}
		if ($fromDay != "" && $toDay  != "") {
			$sql .= " AND a.PaidDate >= '{$fromDay}' and a.PaidDate <= '{$toDay}' ";
		}		
		$sql .= " Group by d.CID";
		$this->query($sql);
		$clientArr = array();
		while ($this->fetch()) {
			$clientArr[$this->CID] = $this->Paid;//$this->Amount - 
		}		*/
		
		$sql  = "select date_format(BeginDate, '%Y%u') as Week, b.Item, c.AFee, concat(LName, ' ', FName) as Name, 
		                d.CID, c.ID 
		          from client_visa_process a, visa_rs_item b, client_visa c, client_info d 
		          where a.CVID  = c.ID and c.CID = d.CID and a.ItemID = b.ItemID and b.Item not like '%assessment' and a.Done = 1 ";
		if ($userid > 0) {
			$sql .= " AND c.VUserID = {$userid} ";
		}
		if ($fromDay != "" && $toDay  != "") {
			$sql .= " AND a.BeginDate >= '{$fromDay}' and a.BeginDate <= '{$toDay}' ";
		}
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()) {
//			$signAmount = isset($clientArr[$this->CID])? $clientArr[$this->CID] : 0.00;
			
			if (preg_match('/^lodge/i', $this->Item)) {
				$_arr[$this->Week]['lcnt'] = isset($_arr[$this->Week]['lcnt'])? ++$_arr[$this->Week]['lcnt'] : 1;

				$_arr[$this->Week]['lname'][$_arr[$this->Week]['lcnt']] = $this->Name .' $'. $this->AFee;
				$_arr[$this->Week]['lc'   ][$_arr[$this->Week]['lcnt']] = $this->CID;
				$_arr[$this->Week]['lv'   ][$_arr[$this->Week]['lcnt']] = $this->ID;
				if(isset($_arr[$this->Week]['lfee'])){ 
					$_arr[$this->Week]['lfee'] += $this->AFee; 
				}else{
					$_arr[$this->Week]['lfee'] = $this->AFee;
				}
				
			}
			elseif (preg_match('/^grant/i', $this->Item)){
				$_arr[$this->Week]['gcnt'] = isset($_arr[$this->Week]['gcnt'])? ++$_arr[$this->Week]['gcnt'] : 1;

				$_arr[$this->Week]['gname'][$_arr[$this->Week]['gcnt']] = $this->Name .' $'. $this->AFee;
				$_arr[$this->Week]['gc'   ][$_arr[$this->Week]['gcnt']] = $this->CID;
                $_arr[$this->Week]['gv'   ][$_arr[$this->Week]['gcnt']] = $this->ID;
				if(isset($_arr[$this->Week]['gfee'])){ 
					$_arr[$this->Week]['gfee'] += $this->AFee; 
				}else{
					$_arr[$this->Week]['gfee'] = $this->AFee;
				}				
			}
		}
		return $_arr;				
	}

	
	function getAllOfVisaProcByUser($fromDay, $toDay, $userid){
/*		$sql = "select d.CID, sum(PaidAmount) as Paid, sum(if(DueAmount is null, 0, DueAmount)) as Amount from client_payment a, client_account b, client_visa c, client_info d where a.AccountID = b.ID and b.VisaID = c.ID and c.CID = d.CID ";
		if ($userid > 0) {
			$sql .= " AND c.VUserID = {$userid} ";
		}
		if ($fromDay != "" && $toDay  != "") {
			$sql .= " AND a.PaidDate >= '{$fromDay}' and a.PaidDate <= '{$toDay}' ";
		}		
		$sql .= " Group by d.CID";
		$this->query($sql);
		$clientArr = array();
		while ($this->fetch()) {
			$clientArr[$this->CID] = $this->Paid;//$this->Amount - 
		}	*/	
		
		$sql  = "select b.Item, c.AFee, concat(LName, ' ', FName) as Name, d.CID, c.ID 
		          from client_visa_process a, visa_rs_item b, client_visa c, client_info d 
		          where a.CVID  = c.ID and c.CID = d.CID and a.ItemID = b.ItemID and b.Item not like '%assessment' and a.Done = 1 ";
		if ($userid > 0) {
			$sql .= " AND c.VUserID = {$userid} ";
		}
		if ($fromDay != "" && $toDay  != "") {
			$sql .= " AND a.BeginDate >= '{$fromDay}' and a.BeginDate <= '{$toDay}' ";
		}		
		$this->query($sql);
		$lodge  = $grant = $lrev = $grev = 0;
		while ($this->fetch()) {
//			$signAmount = isset($clientArr[$this->CID])? $clientArr[$this->CID] : 0.00;
			if (preg_match('/^lodge/i', $this->Item)) {
				$_arr['all']['lname' ][$lodge] = $this->Name .' $'. $this->AFee;
				$_arr['all']['lc'    ][$lodge] = $this->CID;
				$_arr['all']['lv'    ][$lodge] = $this->ID;
				$lodge++;	
				$lrev += $this->AFee;
			}elseif (preg_match('/^grant/i', $this->Item)){
				$_arr['all']['gname' ][$grant] = $this->Name .' $'. $this->AFee;
                $_arr['all']['gc'    ][$grant] = $this->CID;
                $_arr['all']['gv'    ][$grant] = $this->ID;				
				$grant++;
				$grev += $this->AFee;
			}
		}
		$_arr['all']['lcnt'] = $lodge;
		$_arr['all']['gcnt'] = $grant;
		$_arr['all']['lfee'] = $lrev;
		$_arr['all']['gfee'] = $grev;
		return $_arr;				
	}

	
	
	function getCommissionByUser($userid, $page=0, $page_size=0){
		$sql = "select concat(LName, ' ', FName) as Name, a.CID, b.ID as CourseID, c.ID as SemID, d.Detail, d.KeyPoint from client_info a 
				left join client_course b on(a.CID = b.CID) 
				left join client_course_sem c on(b.ID = c.CCID) 
				left join client_course_sem_process d on(c.ID = d.SemID and d.KeyPoint <> '' and Done = 0) 
				where d.ID is not null and (a.ClientType = 'Study' or ClientType = 'all') and c.StartDate <= NOW()"; //a.CID in ($id_str) and 
		if ($userid > 0) {
			$sql .= " AND a.CourseUser = {$userid} ";
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
		}
		return $_arr;
	}
	
	function getNumOfCommissionsByUser($userid){
		$sql = "select count(*) as cnt from client_info a 
				left join client_course b on(a.CID = b.CID) 
				left join client_course_sem c on(b.ID = c.CCID) 
				left join client_course_sem_process d on(c.ID = d.SemID and d.KeyPoint <> '' and Done = 0) 
				where d.ID is not null and (a.ClientType = 'Study' or ClientType = 'all') and c.StartDate <= NOW()"; //a.CID in ($id_str) and 
		if ($userid > 0) {
			$sql .= " AND a.CourseUser = {$userid} ";
		}
		
		$sql .= " Order by d.OrderID asc ";
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
				where a.AccountID = b.ID and b.VisaID = c.ID and c.CID = d.CID ";		
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
		$sql = "select concat(LName, ' ', FName) as Name, sum(PaidAmount) as Paid, sum(if(DueAmount is null, 0, DueAmount)) as Amount from client_payment a, client_account b, client_visa c, client_info d where a.AccountID = b.ID and b.VisaID = c.ID and c.CID = d.CID ";
		if ($userid > 0) {
			$sql .= " AND c.VUserID = {$userid} ";
		}
		if ($fromDay != "" && $toDay  != "") {
			$sql .= " AND a.PaidDate >= '{$fromDay}' and a.PaidDate <= '{$toDay}' ";
		}		
		$sql .= " Group by d.CID";
        $this->query($sql);
        echo $sql."\n";
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
	
	
	function getVisaReviewByUser($fromDay, $toDay, $userid){
//		$visaArr = array();
//		$sql = "SELECT DISTINCT CVID FROM client_visa_process WHERE BeginDate >= '{$fromDay}' AND BeginDate <= '{$toDay}' ";
//		$this->query($sql);
//		while ($this->fetch()) {
//			array_push($visaArr, $this->CVID);
//		}
//
//		if (count($visaArr) == 0) {
//			return false;
//		}
//		$_str = "'". implode("','", $visaArr) ."'";
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
}
?>
