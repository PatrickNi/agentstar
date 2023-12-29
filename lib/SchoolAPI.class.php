<?php
require_once('MysqlDB.class.php');
class SchoolAPI extends MysqlDB{

    function __construct($host, $user, $pswd, $database, $debug) {
		$this->setDBconf($host, $user, $pswd, $database, $debug);
    }

    
    function delSchoold($scid){
    	if ($scid > 0){
    		$sql = "delete from institute where ID = {$scid}";
    		return $this->query($sql);
    	}
    	return false;
    }
    
    
    function getSchool($catid = 0){
    	$sql = "select ID, Name from institute ";
    	if($catid > 0){
    		$sql .= " where CateID = '{$catid}'";
    	}
    	$sql .= " order by Name asc ";
    	$this->query($sql);
    	$_arr = array();
    	while ($this->fetch()){
    		$_arr[$this->ID] = $this->Name;
    	}
    	return $_arr;
    }

    function getNameByIID($iid){
    	if($iid > 0){
    		$sql = "select Name from institute where ID = {$iid}";
    		$this->query($sql);
    		while ($this->fetch()){
    			return $this->Name;
    		}
    	}
    	return false;
    }
    
    
	function getSchoolList($sc_id, $column, $value, $page = 1, $page_size = 50, $cateid = 0){
		$sql = "select a.ID, Name, Note, b.AgentStatus, StatusID, WebSite, CateID, SubCateID, TopAgentID from institute a left join institute_status b on(a.StatusID = b.ID)";

		if ($sc_id > 0){
			$sql .= "where a.ID = {$sc_id}";	
		} elseif($column != "" && $value != ""){
			$sql .= "where {$column} = '{$value}'";
		}elseif($cateid > 0){
			$sql .= "where CateID = {$cateid} ";
		}
		
		$sql .= " order by Name asc Limit " . ($page - 1)*$page_size . "," . $page_size;
		$this->query($sql);
		$_arr = array();
		while($this->fetch()){
			$_arr[$this->ID]['school']   = $this->Name;
			$_arr[$this->ID]['note']   = $this->Note;
			$_arr[$this->ID]['status'] = $this->AgentStatus;
			$_arr[$this->ID]['agent']   = $this->StatusID;
			$_arr[$this->ID]['web']    = $this->WebSite;
			$_arr[$this->ID]['cate']   = $this->CateID;
			$_arr[$this->ID]['subcate']   = $this->SubCateID;
			$_arr[$this->ID]['topagent'] = $this->TopAgentID;
		}
		return $_arr;
	}

	function getSchoolRsh(){
		$sql = "select a.ID, CateID, SubCateID, Name, AgentStatus 
		        from institute a left join institute_status b on (a.StatusID = b.ID) 
		        order by b.Rank, a.Name asc";
		$this->query($sql);
		$_arr = array();
		while($this->fetch()){
			$_arr[$this->CateID.$this->SubCateID][$this->ID]['name'] = $this->Name;
			$_arr[$this->CateID.$this->SubCateID][$this->ID]['status'] = $this->AgentStatus;
		}
		return $_arr;
	}
	
	function getCategoryByIID($iid){
		if($iid > 0){
			$sql = "select CateID from institute where ID = '{$iid}' ";
			$this->query($sql);
			while ($this->fetch()) {
				return $this->CateID;
			}
		}
		return  0;
	}

	function getSchoolListRowsNum($sc_id, $column, $value, $cateid=0){
		$sql = "select count(*) as cnt from Institute ";
		if ($sc_id > 0){
			$sql .= "where ID = {$rInstID}";	
		} elseif($column != "" && $value != ""){
			$sql .= "where {$column} = '{$value}'";
		}elseif($cateid > 0){
			$sql .= "where CateID = {$cateid} ";
		}
		
		$this->query($sql);
		while($this->fetch()){
			return $this->cnt;
		}
		return 0;
	}

	function countSchool($userid=0, $from, $to){
			$sql = "select IID,count(distinct d.CID) as StdCnt, sum(if(OfferCnt is null, 0, OfferCnt)) as OfferCnt, sum(if(CoeCnt is null, 0, CoeCnt)) as CoeCnt, sum(if(rcomm is null,0.00,rcomm)) as rcomm, sum(if(pcomm is null, 0.00, pcomm)) as pcomm from client_course a 
								left join (select CCID, Sum(if(ProcessID = 2, 1, 0)) as OfferCnt, Sum(if(ProcessID = 5, 1, 0)) as CoeCnt from client_course_process where done = 1 group by CCID) as b on(b.CCID = a.ID)
								left join (select CCID, sum(if(RComm is null , 0, RComm)) as rcomm, sum(if(RedComm is null, 0, RedComm)) as pcomm from client_course_sem Group by CCID) as c on(c.CCID = a.ID)
								left join client_info d on(d.CID = a.CID)
							  where IID <> 0";//or InvoicDate = '' or InvoicDate = '0000-00-00'
			if($userid > 0){
				$sql .= " AND d.CourseUser = {$userid} ";	
			}
			
			if ($from != "" && $to != "") {
				$sql .= " AND a.Sem1Date >= '{$from}' and a.Sem1Date <= '{$to}'";
			}
			$sql .= " Group by IID ";
		    $this->query($sql);
		    $_arr = array();
		    while ($this->fetch()){
		    	$_arr[$this->IID]['num'] = $this->StdCnt;
		    	$_arr[$this->IID]['s2'] = $this->OfferCnt;
		    	$_arr[$this->IID]['s3'] = $this->CoeCnt;
		    	$_arr[$this->IID]['a1'] = ($this->rcomm - $this->pcomm);
		    	$_arr[$this->IID]['a2'] = $this->pcomm;
		    }
		    return $_arr;
	}
	
	function countStudent($from, $to, $iid, $userid=0){
		if ($iid > 0){
			$sql = "select a.ID, b.CID, b.LName, b.FName, a.IID, a.QualID, a.MajorID, a.ConsultantID, a.IsActive, a.Refuse, if(e.StartDate is null, a.StartDate, e.StartDate) as StartDate,
							if(CoeCnt is null, 0, OfferCnt) as OfferCnt, 
							if(CoeCnt is null, 0, CoeCnt) as CoeCnt, 
							if(rcomm is null,0.00, rcomm) as rcomm, 
							if(pcomm is null, 0.00, pcomm) as pcomm,
							if(CoeCnt > 0, 1, 0) as hascode 
					from client_course a left join client_info b on(a.CID = b.CID) 
								left join (select CCID, Sum(if(ProcessID = 2, 1, 0)) as OfferCnt, Sum(if(ProcessID = 5, 1, 0)) as CoeCnt from client_course_process where done = 1 group by CCID) as c on(c.CCID = a.ID)
								left join (select CCID, sum(if(RComm is null, 0, RComm)) as rcomm, sum(if(RedComm is null, 0, RedComm)) as pcomm from client_course_sem Group by CCID) as d on(d.CCID = a.ID)
								left join (select CCID, StartDate from client_course_sem where SEM = 1 Group by CCID) as e on(e.CCID = a.ID)
 					where a.IID = '{$iid}' ";//and a.IsActive = 1 or InvoicDate = '' or InvoicDate = '0000-00-00'
			if ($from != "" && $to != ""){
				$sql .= " AND  a.Sem1Date >= '{$from}' AND a.Sem1Date <= '{$to}' ";
			}
			
			if($userid > 0){
				$sql .= " AND a.ConsultantID = {$userid} ";
			}
			
			$sql .= " order by hascode desc, StartDate desc , b.LName asc, b.FName asc, a.IsActive asc ";//Group BY a.CID
			//echo $sql."\n";
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
				$_arr[$this->ID]['rcomm'] = ($this->rcomm - $this->pcomm);
				$_arr[$this->ID]['coedate'] = $this->StartDate;
			}
			return $_arr;
		}
	}
	
	function countStudentNumRows($from, $to, $iid, $userid){
		if($iid > 0){
			$sql = "select count(DISTINCT a.CID) as TotalCnt, sum(if(CoeCnt is null, 0, OfferCnt)) as OfferCnt, sum(if(CoeCnt is null, 0, CoeCnt)) as CoeCnt from client_course a 
								left join (select CCID, Sum(if(ProcessID = 2, 1, 0)) as OfferCnt, Sum(if(ProcessID = 5, 1, 0)) as CoeCnt, Sum(if(ProcessID = 11, 1, 0)) as CnocCnt  from client_course_process where done = 1 group by CCID) as c on(c.CCID = a.ID)
								left join (select CCID, StartDate from client_course_sem where SEM = 1 Group by CCID) as e on(e.CCID = a.ID)
 								left join client_info d on(a.CID = d.CID) 
					where a.IID = '{$iid}' ";//and a.IsActive = 1
			if ($from != "" && $to != ""){
				$sql .= " AND a.Sem1Date >= '{$from}' AND a.Sem1Date <= '{$to}' ";
			}
			if($userid > 0){
				$sql .= " AND a.ConsultantID = {$userid} ";
			}			
			$this->query($sql);
			$_arr = array('total'=>0, 'offer'=>0, 'coe'=>0, 'cnoc'=>0);
			while ($this->fetch()){
				$_arr['total'] = $this->TotalCnt;
				$_arr['offer'] = $this->OfferCnt;
				$_arr['coe']   = $this->CoeCnt;
				$_arr['cnoc']  = $this->CnocCnt;
			}			
			return $_arr;
		}
	}
		
	function setSchoolInfo($sid, $set_arr){
		if (is_array($set_arr) && count($set_arr) > 0){
			foreach($set_arr as &$v){
				$v = addslashes($v);
			}
			
			$sql = "Update institute SET Name = '{$set_arr['school']}', WebSite = '{$set_arr['web']}', StatusID = '{$set_arr['agent']}', Note = '{$set_arr['note']}', CateID = '{$set_arr['cate']}', SubCateID = '{$set_arr['subcate']}', TopAgentID = '{$set_arr['topagent']}' where ID = {$sid}";
			return $this->query($sql);
		}
		return false;
	}
	
	function addSchoolInfo($set_arr){
		if (is_array($set_arr) && count($set_arr) > 0){
			foreach($set_arr as &$v){
				$v = addslashes($v);
			}
			
			$sql = "insert into institute (Name, WebSite, StatusID, Note, CateID, SubCateID, TopAgentID) values ('{$set_arr['school']}', '{$set_arr['web']}', '{$set_arr['agent']}', '{$set_arr['note']}', '{$set_arr['cate']}', '{$set_arr['subcate']}','{$set_arr['topagent']}')";
			return $this->query($sql);
		}
		return false;
	}
	
	function delProcess($pid){
		if($pid > 0){
			$sql = "delete from institute_process where ID = {$pid}";
			return $this->query($sql);
		}
		return false;
	}
	
	function endProcess($pid){
		if ($pid > 0){
			$sql = "Update institute_process SET Done = 1 where ID = {$pid}";
			return $this->query($sql);
		}
		return false;
	}
	
	function setProcess($pid, $sets){
		if ($pid > 0){
			foreach ($sets as &$v){
				$v = addslashes($v);
			}
			$sql = "Update institute_process SET BeginDate = '{$sets['date']}', Subject = '{$sets['subject']}', Detail = '{$sets['detail']}', DueDate = '{$sets['due']}', Done = '{$sets['done']}'  where ID = '{$pid}'";
			return $this->query($sql); 
		}
	}
	
	function addProcess($sid, $sets){
		if ($sid > 0){
			foreach ($sets as &$v){
				$v = addslashes($v);
			}
			$sql = "insert into `institute_process` (InstID, BeginDate, Subject, Detail, DueDate, Done, OrderID) values ({$sid}, '{$sets['date']}', '{$sets['subject']}', '{$sets['detail']}', '{$sets['due']}', '{$sets['done']}', '{$sets['order']}')"; 
			return $this->query($sql); 
		}
	}

	function getProcessOrder($pid=0, $sid=0){
		$sql = "";
		if($pid > 0){
			$sql = "select OrderID from institute_process where ID = '{$pid}'";

		}elseif($sid > 0){
			$sql = "select if(Max(OrderID) is null, 0, max(OrderID)) as OrderID from institute_process where InstID = '{$sid}'";
		}
		$this->query($sql);
		while ($this->fetch()){
			return $this->OrderID;
		}
		return 0;
	}

	function resetProcessOrder($sid, $orderid){
		if($sid > 0){
			$sql = "Update institute_process SET OrderID = OrderID + 1 where InstID = '{$sid}' and OrderID > '{$orderid}' ";
			return $this->query($sql);
		}
	}
		
	function getProcess($sid){
		$sql = "select ID, InstID, BeginDate, Subject, Detail, DueDate, Done from institute_process ";
		if ($sid > 0){
			$sql .= " Where InstID = {$sid}";
		}
		$sql .= " order by OrderID asc";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->ID]['date']    = $this->BeginDate;
			$_arr[$this->ID]['subject'] = $this->Subject;
			$_arr[$this->ID]['detail']  = $this->Detail;
			$_arr[$this->ID]['due']     = $this->DueDate;
			$_arr[$this->ID]['done']    = $this->Done;
		}
		return $_arr;
	}
	
	
	function delStaff($fid){
		if($fid > 0){
			$sql = "delete from institute_staff where ID = {$fid}";
			return $this->query($sql);
		}
		return false;
	}
	
	function setStaff($fid, $sets){
		if ($fid > 0){
			foreach ($sets as &$v){
				$v = addslashes($v);
			}
			$sql = "Update institute_staff SET Name = '{$sets['name']}', Position = '{$sets['pos']}', Phone = '{$sets['phone']}', Mobile = '{$sets['mobile']}' , Fax = '{$sets['fax']}', Email = '{$sets['email']}', Address = '{$sets['add']}' where ID = '{$fid}' ";
			return $this->query($sql); 
		}
	}
	
	function addStaff($sid, $sets){
		if ($sid > 0){	
			foreach ($sets as &$v){
				$v = addslashes($v);
			}
			$sql = "insert into `institute_staff` (InstID, Name, Position, Phone, Mobile, Fax, Email, Address) values ('{$sid}', '{$sets['name']}', '{$sets['pos']}', '{$sets['phone']}', '{$sets['mobile']}', '{$sets['fax']}', '{$sets['email']}', '{$sets['add']}')"; 
			return $this->query($sql);
		} 
	}		


	function getStaff($sid){
		$sql = "select ID, InstID, Name, Position, Phone, Mobile, Fax, Email, Address from institute_staff ";
		if ($sid > 0){
			$sql .= " Where InstID = {$sid}";
		}
		$sql .= " order by Name asc ";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->ID]['name']   = $this->Name;
			$_arr[$this->ID]['pos']    = $this->Position;
			$_arr[$this->ID]['phone']  = $this->Phone;
			$_arr[$this->ID]['mobile'] = $this->Mobile;
			$_arr[$this->ID]['fax']    = $this->Fax;
			$_arr[$this->ID]['email']  = $this->Email;
			$_arr[$this->ID]['add']    = $this->Address;
		}
		return $_arr;
	}
	
	function delComm($cid){
		if($cid > 0){
			$sql = "delete from institute_comm where ID = {$cid}";
			return $this->query($sql);
		}
		return false;
	}
	
	function setComm($cid, $course, $rate, $agent, $boun, $start_date, $end_date, $major_id, $qual_id){
		$course = addslashes($course);
		$rate   = addslashes($rate);
		$boun   = addslashes($boun);
		$start_date   = addslashes($start_date);
		$end_date   = addslashes($end_date);
		$major_id   = addslashes($major_id);
		$qual_id   = addslashes($qual_id);
		$sql = "Update institute_comm SET Course = '{$course}', CommRate = '{$rate}', AgentID = '{$agent}', Bouns = '{$boun}' , StartDate = '{$start_date}' , EndDate = '{$end_date}' , MajorID = '{$major_id}' , QualID = '{$qual_id}' where ID = {$cid}";
		return $this->query($sql); 
	}
	
	function addComm($sid, $course, $rate, $agent, $boun, $start_date, $end_date, $major_id, $qual_id){
		$course = addslashes($course);
		$rate   = addslashes($rate);
		$boun   = addslashes($boun);
		$start_date   = addslashes($start_date);
		$end_date   = addslashes($end_date);
		$major_id   = addslashes($major_id);
		$qual_id   = addslashes($qual_id);
		$sql = "insert into institute_comm (InstID, Course, CommRate, AgentID, Bouns, StartDate, EndDate, MajorID, QualID) values ({$sid}, '{$course}', '{$rate}', '{$agent}', '{$boun}', '{$start_date}', '{$end_date}', '{$major_id}', '{$qual_id}')";
		return $this->query($sql); 
	}
	
	function getComm($sid){
		$sql = "select a.ID, Course, CommRate, a.AgentID, b.Name, Bouns, StartDate, EndDate, MajorID, QualID from institute_comm a left join agent b on(a.AgentID = b.ID)";
		if ($sid > 0){
			$sql .= " where InstID = {$sid} ";
		}
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->ID]['course']  = $this->Course;
			$_arr[$this->ID]['rate']    = $this->CommRate;
			$_arr[$this->ID]['agentid'] = $this->AgentID;
			$_arr[$this->ID]['agent']   = $this->Name;	
			$_arr[$this->ID]['boun']    = $this->Bouns;
			$_arr[$this->ID]['startdate']    = $this->StartDate;
			$_arr[$this->ID]['enddate']    = $this->EndDate;
			$_arr[$this->ID]['major']    = $this->MajorID;
			$_arr[$this->ID]['qual']    = $this->QualID;
		}
		return $_arr;
	}
	
	function getAgentStatus(){
		$sql = "select ID, AgentStatus from institute_status";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->ID] = $this->AgentStatus;
		}
		return $_arr;
	}
	
	function addAgentStatus($status){
		$status = addslashes($status);
		$sql = "insert into institute_status (AgentStatus) values ('{$status}')";
		return $this->query($sql);
	}			

	function delAgentStatus($id){
		if ($id > 0){
			$sql = "delete from institute_status where ID = {$id}";
			return $this->query($sql);
		}
	}
	
	function getCategory($catid = 0){
		$sql = "select ID, Category from institute_category";
		if ($catid > 0){
			$sql .= " WHERE ID = {$catid} ";
		}
		$sql .= " order by rank asc";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->ID] = $this->Category;
		}
		return $_arr;
	}

	function getCategoryWithRank($catid = 0){
		$sql = "select ID, Category, Rank from institute_category ";
		if ($catid > 0){
			$sql .= " WHERE ID = {$catid} ";
		}
		$sql .= " order by rank asc";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->ID]['name'] = $this->Category;
			$_arr[$this->ID]['rank'] = $this->Rank;
		}
		return $_arr;
	}
	
	function addCategory($category, $rank=0){
		$category = addslashes($category);
		$sql = "insert into institute_category (Category, Rank) values ('{$category}', {$rank})";
		return $this->query($sql);
	}

	function setCategory($catid, $catename, $rank=0){
		if ($catid > 0 && $catename != ""){
			$catename = addslashes($catename);
			$sql = "Update institute_category SET Category = '{$catename}', Rank = {$rank} WHERE ID = {$catid}";
			return $this->query($sql);
		}
		return FALSE;
	}

	function delCategory($id){
		if ($id > 0){
			$sql = "delete from institute_category where ID = {$id}";
			return $this->query($sql);
		}
	}

	function getSubCategory($parentid = 0){
		$parentid = addslashes($parentid);
		$sql = "SELECT ID, ParentID, CateName from institute_category_sub ";
		if ($parentid > 0){
			$sql .= " WHERE ParentID = {$parentid} ";
		}
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->ParentID][$this->ID] = $this->CateName;
		}
		return $_arr;
	}
	
	function addSubCategory($catid, $subname){
        if ($catid > 0 && $subname != ""){
        	$subname = addslashes($subname);
        	$sql = "insert into institute_category_sub (ParentID, CateName) values ('{$catid}', '{$subname}')";
            return $this->query($sql);
        }
        return false;
    }

    function setSubCategory($subid, $catename){
        if ($subid > 0 && $catename != ""){
            $catename = addslashes($catename);
            $sql = "Update institute_category_sub SET CateName = '{$catename}' WHERE ID = {$subid}";
            return $this->query($sql);
        }
        return FALSE;
    }

    function delSubCategory($id){
        if ($id > 0){
            $sql = "delete from institute_category_sub where ID = {$id}";
            return $this->query($sql);
        }
        return false;
    }
	
	
	function getCourseQual($iid=0, $id=0){
		$sql = "select ID, Qual, IID from institute_qual Where 1 ";
		if($iid > 0){
			$sql .= " AND IID = {$iid}";
		}
		if($id > 0){
			$sql .= " AND ID = '{$id}'";
		}
		$sql .= " Order by Qual asc ";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->IID][$this->ID] = $this->Qual;
		}
		return $_arr;
	}
	
	function getCourseMajor($qualid=0, $id=0){
		$sql = "select ID, QualID, Major from institute_major Where 1 ";
		if($qualid > 0){
			$sql .= " AND QualID = {$qualid}";
		}
		
		if($id > 0){
			$sql .= " And  ID = '{$id}'";
		}
		$sql .= " Order by Major asc ";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->QualID][$this->ID] = $this->Major;
		}
		return $_arr;
	}
	
	function getCourseMajorBySchool($iid=0){
		$sql = "select a.ID, b.Qual, Major, b.IID from institute_major a, institute_qual b Where a.QUalID = b.ID and b.IID = {$iid} ";
		$sql .= " Order by Qual, Major asc ";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->IID][$this->ID] = $this->Qual.'------'.$this->Major;
		}
		return $_arr;
	}

	function addCourseQual($iid, $qual){
		if($qual != "" && $iid > 0){
			$qual = addslashes($qual);
			$sql = "insert into `institute_qual` (IID, Qual) values ('{$iid}', '{$qual}')";
			return $this->query($sql);
		}
	}
	
	function setCourseQual($id, $qual){
		if($id > 0 && $qual != ""){
			$qual = addslashes($qual);
			$sql = "Update `institute_qual` SET Qual = '{$qual}' where ID = {$id} ";
			return $this->query($sql);
		}
	}
	
	function delCourseQual($id){
		if($id > 0){
			$sql = "delete from  `institute_qual` where ID = {$id} ";
			return $this->query($sql);
		}
	}
	
	function addCourseMajor($qualid, $major){
		if($major != "" && $qualid > 0){
			$major = addslashes($major);
			$sql = "insert into `institute_major` (QualID, Major) values ('{$qualid}', '{$major}')";
			return $this->query($sql);
		}
	}
	
	function setCourseMajor($id, $major){
		if($id > 0 && $major != ""){
			$major = addslashes($major);
			$sql = "Update `institute_major` SET Major = '{$major}' where ID = {$id} ";
			return $this->query($sql);
		}
	}
	
	function delCourseMajor($id){
		if($id > 0){
			$sql = "delete from  `institute_major` where ID = {$id} ";
			return $this->query($sql);
		}
	}		


	function delBank($bankid){
		if($bankid > 0){
			$sql = "delete from institute_bank where ID = {$bankid}";
			return $this->query($sql);
		}
		return false;
	}
	
	function setBank($bankid, $account_name, $bsb, $account_no){
		$account_name = addslashes($account_name);
		$bsb   = addslashes($bsb);
		$account_no   = addslashes($account_no);

		$sql = "Update institute_bank SET AccountName = '{$account_name}', BSB = '{$bsb}', AccountNo = '{$account_no}' where ID = {$bankid}";
		return $this->query($sql); 
	}
	
	function addBank($sid, $account_name, $bsb, $account_no){
		$account_name = addslashes($account_name);
		$bsb   = addslashes($bsb);
		$account_no   = addslashes($account_no);

		$sql = "insert into institute_bank (InstID, AccountName, BSB, AccountNo) values ({$sid}, '{$account_name}', '{$bsb}', '{$account_no}')";
		return $this->query($sql); 
	}
	
	function getBank($sid){
		$sql = "select ID, InstID, AccountName, BSB, AccountNo from institute_bank  ";
		if ($sid > 0){
			$sql .= " where InstID = {$sid} ";
		}
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->ID]['aname']  = $this->AccountName;
			$_arr[$this->ID]['ano']    = $this->AccountNo;
			$_arr[$this->ID]['bsb'] = $this->BSB;
			$_arr[$this->ID]['iid']   = $this->InstID;
		}
		return $_arr;
	}

}
?>
