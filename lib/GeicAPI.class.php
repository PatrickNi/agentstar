<?php
require_once('MysqlDB.class.php');

class GeicAPI extends MysqlDB {

    private $user_orders = array(29,3,86,37,79,80,58,67,57,81,84,82,50);

    function GeicAPI ($host, $user, $pswd, $database, $debug) {
    	 $this->MysqlDB($host, $user, $pswd, $database, $debug);
    }
    
    function getUserActive($user_id=0){
    	if ($user_id > 0){
			$sql = "select Mark from sys_user where ID = {$user_id}";
			$this->query($sql);
			while ($this->fetch()){
				return $this->Mark;
			}    	
    	}
    	return false;
    }
    
    function getUserAdvance($user_id){
    	if ($user_id > 0){
			$sql = "select Advance from sys_user where ID = {$user_id}";
			$this->query($sql);
			while ($this->fetch()){
				return $this->Advance;
			}    	
    	}
    	return 0;
    }


    function getUserPosition($user_id){
    	if ($user_id > 0){
			$sql = "select Position from sys_user where ID = {$user_id}";
			$this->query($sql);
			while ($this->fetch()){
				return $this->Position;
			}   	
    	}
    	return false;
    }
    
    function getFuncByUser($user_id){
		if (!($user_id > 0)) {
			return false;			
		}
		$sql = "select a.ID as FuncID, a.Func, a.FuncScript, b.ID as GroupID, b.FuncGroup from sys_func a left join sys_funcgroup b on(a.GroupID = b.ID) where a.ID in (select FuncID from sys_userfunc_rs where UserID = {$user_id}) order by b.FuncGroup asc, a.FUNC asc ";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()) {
			$_arr[$this->GroupID]['name'] = $this->FuncGroup;		
			$_arr[$this->GroupID]['func'][$this->FuncID]['name'] = $this->Func;
			$_arr[$this->GroupID]['func'][$this->FuncID]['url']  = "?g={$this->GroupID}&f={$this->FuncID}";
		}
		return $_arr;
	}
	
	function getFuncList($func_id = 0){
		$sql = "select ID, Mark, FUNC, FuncScript, GroupID from sys_func ";
		if($func_id > 0){
			$sql .= " Where ID = {$func_id} ";
		}
        $sql .= "Order by ID asc ";
		$this->query($sql);		
		$_arr = array();
		while ($this->fetch()) {
			$_arr[$this->ID]['name'] = $this->FUNC;		
			$_arr[$this->ID]['mark'] = $this->Mark;
			$_arr[$this->ID]['group'] = $this->GroupID;
			$_arr[$this->ID]['script'] = $this->FuncScript;
		}
		return $_arr;
	}
	
	function getFuncName($func_id=0){
		if ($func_id > 0){
			$sql = "select FUNC from sys_func where ID = {$func_id}";
			$this->query($sql);
			while ($this->fetch()){
				return $this->FUNC;
			}
		}
		return false;
	}
	
	function getGroupName($group_id=0){
		if ($group_id > 0){
			$sql = "select FuncGroup from sys_funcgroup where ID = {$group_id}";
			$this->query($sql);
			while ($this->fetch()){
				return $this->FuncGroup;
			}
		}
		return false;
	}	
	
	function getFuncUrl($groupId, $funcId){
		$sql = "select FuncScript from sys_func where GroupID = {$groupId} and ID = {$funcId} ";
		$this->query($sql);
		while ($this->fetch()){
			return $this->FuncScript;
		}
		return false;
	}
	
	function getUserName($userId){
		$sql = "select UserName from sys_user where ID = {$userId} ";
		$this->query($sql);
		while ($this->fetch()){
			return $this->UserName;
		}
		return false;
	}
	
	
    function getUserNameArr($userid=0,$allmember=false,$specify=array()){
    	$sql = "select ID, UserName, LeaveDate, Department from sys_user WHERE 1 ";
		if (!$allmember) {
			$sql .= " AND LeaveDate = '0000-00-00' ";
		}

		if($userid > 0){
			$sql .= " AND ID = {$userid} ";
		}    	

		if ($specify && count($specify) > 0 && is_array($specify)) {
			$sql .= " AND ID  in (".implode(',', $specify). ") ";
		}

		$sql .= " Order by Department, DepartmentRank ";
		$this->query($sql);
		//echo $sql."\n";
		$_arr = array();
		$departed = array();
		$departed['###Departed###'] = '---Darparted---';
		$department = '';
		$has_departed = false;
		while($this->fetch()){
			if ($userid > 0) {
				$_arr[$this->ID] =  ucwords($this->UserName);
			}
			elseif ($this->LeaveDate != '0000-00-00') {
				$departed[$this->ID] =  ucwords($this->UserName);
				$has_departed = true;
			}
			else {
				if ($department == '' || $department != $this->Department) {
					$_arr['###'.$this->Department.'###'] =  '---'.$this->Department.'---';
				}
				
				$_arr[$this->ID] =  ucwords($this->UserName);
				$department = $this->Department;
			}	
		}
		if ($has_departed) {
			foreach ($departed as $k => $v) {
				$_arr[$k] = $v;
			}
		}
		return $_arr;  	
    }
    	
	function getUserMark($userId){
		$sql = "select Mark from sys_user where ID = {$userId} ";
		$this->query($sql);
		while ($this->fetch()){
			return $this->Mark;
		}
		return false;		
	}


	function getUserList($rUserID=0){
		$sql = "Select ID, UserName, UserPassword, Position, Email, Mobile, Telephone, Address, Mark, Advance, StartDate, LeaveDate, Department, DepartmentRank from sys_user";
		if($rUserID > 0){
			$sql .= " Where ID = {$rUserID}";
		}
		$_arr = array();
		$this->query($sql);
		while($this->fetch()){
			$_arr[$this->ID]['name']   = $this->UserName;
			$_arr[$this->ID]['pswd']   = $this->UserPassword;
			$_arr[$this->ID]['pos']    = $this->Position;
			$_arr[$this->ID]['mark']   = $this->Mark;
			$_arr[$this->ID]['email']  = $this->Email;
			$_arr[$this->ID]['mobile'] = $this->Mobile;
			$_arr[$this->ID]['phone']  = $this->Telephone;
			$_arr[$this->ID]['add']    = $this->Address;
			$_arr[$this->ID]['adv']    = $this->Advance;
			$_arr[$this->ID]['startdate']    = $this->StartDate;
            $_arr[$this->ID]['leavedate']    = $this->LeaveDate;
			$_arr[$this->ID]['department']    = $this->Department;
			$_arr[$this->ID]['department_rank']    = $this->DepartmentRank;

		}
		return $_arr;
	}
	
    function setUserPermission($user_id, $func_arr){
    	if($user_id > 0 && is_array($func_arr) && count($func_arr) > 0){
    		# delete user func rs not in func array
    		$_delStr = "";    	
    		foreach($func_arr as $funcID){
    			$_delStr .= "{$funcID},";
    		}
    		$_delStr = substr($_delStr, 0, strlen($_delStr) - 1);
    		$sql = "delete from sys_userfunc_rs where UserID = {$user_id} and FuncID not in({$_delStr}) ";
    		$this->query($sql);
    		
    		# get user func list 
    		$_existArr = $this->getFuncArrByUser($user_id);
    		
    		# get rest func list
    		$_resetArr = array_diff($func_arr, $_existArr);
    		
    		if(is_array($_resetArr) && count($_resetArr) > 0){
    			$func_str = "";
    			foreach($_resetArr as $id){
    				$func_str .= "{$id},";
    			}
    			$func_str = substr($func_str, 0, strlen($func_str) - 1);
    			$sql = "insert into `sys_userfunc_rs` (UserID, FuncID, GroupID) select {$user_id} as userid, ID, GroupID from sys_func where ID in($func_str)";
    			return $this->query($sql);
    		}
    	}
    }
    
 	function delUserByArr($user_arr){
		if(is_array($user_arr) && count($user_arr) > 0){
			$_str = implode(',',$user_arr);
			$sql = "delete from sys_user where ID in($_str) ";
			return $this->query($sql);	 
		}
		return false;
	}   
	
    function checkUser($rName){
    	$rName = addslashes($rName);
    	$sql = "select ID from sys_user where UserName = '{$rName}'";
    	$this->query($sql);
    	$this->fetch();
    	while($this->ID > 0){
    		return true;
    	}
    	return false;
    }
    
    	
    function addUser($rName, $rPassword, $rEmail, $rMobile, $rPhone, $rAddress, $rPosition, $rMark, $rAdv, $rStartDate, $rLeaveDate, $rDepartment="", $rDepartmentRank=0){
    	if($this->checkUser($rName)){
    		return false;
    	}
    	
    	$rName 		= addslashes($rName);
    	$rPassword 	= addslashes($rPassword);
    	$rEmail 	= addslashes($rEmail);
    	$rPhone 	= addslashes($rPhone);
    	$rPosition 	= addslashes($rPosition);
    	$rMobile 	= addslashes($rMobile);
    	$rAddress 	= addslashes($rAddress);
    	$rStartDate = addslashes($rStartDate);
        $rLeaveDate = addslashes($rLeaveDate);
		$rDepartment = addslashes($rDepartment);
		$rDepartmentRank = addslashes($rDepartmentRank);

		$sql = "insert into `sys_user`(UserName, UserPassword, Position, Email, Mobile, Telephone, Address, Mark, Advance, StartDate, LeaveDate, Department, DepartmentRank)values ('{$rName}', '{$rPassword}', '{$rPosition}', '{$rEmail}', '{$rMobile}', '{$rPhone}', '{$rAddress}', '{$rMark}', '{$rAdv}', '{$rStartDate}', '{$rLeaveDate}', '{$rDepartment}', '{$rDepartmentRank}')";
 		return $this->query($sql);
 	}
 	

	function setUser($rUserID, $rName, $rPassword, $rEmail, $rMobile, $rPhone, $rAddress, $rPosition, $rMark, $rAdv, $rStartDate, $rLeaveDate, $rDepartment="", $rDepartmentRank=0){
    	$rName 		= addslashes($rName);
    	$rPassword 	= addslashes($rPassword);
    	$rEmail 	= addslashes($rEmail);
    	$rPhone 	= addslashes($rPhone);
    	$rPosition 	= addslashes($rPosition);
    	$rMobile 	= addslashes($rMobile);
    	$rAddress 	= addslashes($rAddress);
    	$rStartDate = addslashes($rStartDate);
        $rLeaveDate = addslashes($rLeaveDate);	
		$rDepartment = addslashes($rDepartment);
		$rDepartmentRank = addslashes($rDepartmentRank);

		$sql = "Update sys_user SET UserName = '{$rName}', UserPassword = '{$rPassword}', Position = '{$rPosition}', Email = '{$rEmail}', Mobile = '{$rMobile}', Telephone = '{$rPhone}', Address = '{$rAddress}', Mark = '{$rMark}', Advance = {$rAdv}, StartDate = '{$rStartDate}', LeaveDate = '{$rLeaveDate}', Department = '{$rDepartment}', DepartmentRank = '{$rDepartmentRank}'  where ID = {$rUserID} ";
		return $this->query($sql);
	}
	
	 		
	function delFuncByArr($func_arr){
		if(is_array($func_arr) && count($func_arr) > 0){
			$_str = "";
			foreach($func_arr as $id){
				$_str .= "{$id},";
			}
			$_str = substr($_str, 0, strlen($_str) - 1);
			$sql = "delete from sys_func where ID in($_str) ";
			return $this->query($sql);	 
		}
		return false;
	}
	
	function addFunc($rFunc, $rMark, $rScript, $rGroupID){
		$rFunc = addslashes($rFunc);
		$rMark = addslashes($rMark);
		$rScript = addslashes($rScript);		
		$sql = "insert into sys_func (FUNC, Mark, FuncScript, GroupID) values ('{$rFunc}', '{$rMark}', '{$rScript}', '{$rGroupID}') ";
		return $this->query($sql);
	}
	
	function setFunc($rFuncID, $rFunc, $rMark, $rGroupID, $rScript){
		$rFunc = addslashes($rFunc);
		$rMark = addslashes($rMark);
		$rScript = addslashes($rScript);		
		$sql = "Update sys_func SET FUNC = '{$rFunc}', Mark = '{$rMark}', FuncScript = '{$rScript}', GroupID = {$rGroupID} Where ID = {$rFuncID}";
		return $this->query($sql);
	}
	
	function getFuncGroupList($rGroupID=0){
		$sql = "select ID, FuncGroup, Mark from sys_funcgroup";
		if($rGroupID > 0){
			$sql .= " Where ID = {$rGroupID} ";
		}
		$this->query($sql);
		$_arr = array();
		while($this->fetch()){
			$_arr[$this->ID]['name'] = $this->FuncGroup;
			$_arr[$this->ID]['mark'] = $this->Mark;
		}
		return $_arr;
	}
	
	function delFuncGroupByArr($group_arr){
		if(is_array($group_arr) && count($group_arr) > 0){
			$_str = "";
			foreach($group_arr as $id){
				$_str .= "{$id},";
			}
			$_str = substr($_str, 0, strlen($_str) - 1);
			$sql = "delete from sys_funcgroup where ID in($_str) ";
			return $this->query($sql);	 
		}
		return false;
	}
	
	function delFuncByGroupArr($group_arr){
		if(is_array($group_arr) && count($group_arr) > 0){
			$_str = "";
			foreach($group_arr as $id){
				$_str .= "{$id},";
			}
			$_str = substr($_str, 0, strlen($_str) - 1);
			$sql = "delete from sys_func where GroupID in($_str) ";
			return $this->query($sql);	 
		}
		return false;
	}
	
	function addFuncGroup($rGroup, $rMark){
		$rGroup = addslashes($rGroup);
		$rMark  = addslashes($rMark);
		$sql = "insert into `sys_funcgroup`(FuncGroup, Mark) values ('{$rGroup}', '{$rMark}') ";
		return $this->query($sql);
	}
	
	function setFuncGroup($rGroupID, $rGroup, $rMark){
		$rGroup = addslashes($rGroup);
		$rMark  = addslashes($rMark);
		if($rGroupID > 0){
			$sql = "Update sys_funcgroup SET FuncGroup = '{$rGroup}', Mark = '{$rMark}' where ID = {$rGroupID} ";
			return $this->query($sql);
		}
		return false;
	}

	function getFuncArrByUser($user_id=0){
		$sql = "select FuncID from sys_userfunc_rs where UserID = {$user_id}";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[] = $this->FuncID;
		}
		return $_arr;
	}
	
	
    function getUserFuncList($user_id=0){
    	if($user_id > 0){
    		$sql = "select a.FUNC, a.ID, b.UserID from sys_func a left join sys_userfunc_rs b on(a.ID = b.FuncID and b.UserID = {$user_id}) order by a.ID asc ";
    		$this->query($sql);
    		$_arr = array();
    		while($this->fetch()){
    			$_arr[$this->ID]['name']   = $this->FUNC;
    			$_arr[$this->ID]['select'] = (is_null($this->UserID) || $this->UserID == "")? 0 : 1;
    		}
    		return $_arr;
    	}
    	return false;
    }
    
    
	function delContact($ctid){
		if($ctid > 0){
			$sql = "delete from contact_info where ID = {$ctid}";
			return $this->query($sql);
		}
		return false;
	}    

	function setContact($ctid, $sets){
		foreach($sets as &$v){
			$v = addslashes($v);
		}		
		$sql = "Update contact_info SET Organization = '{$sets['org']}', Person = '{$sets['person']}', Phone = '{$sets['phone']}', Mobile = '{$sets['mobile']}' , Email = '{$sets['email']}', Address = '{$sets['add']}', Fax = '{$sets['fax']}', Web = '{$sets['web']}', Note = '{$sets['note']}' where ID = {$ctid}";
		return $this->query($sql); 
	}    								

	function addContact($group_id, $sets){
		foreach($sets as &$v){
			$v = addslashes($v);
		}		
		$sql = "insert into `contact_info` (GroupID, Organization, Person, Phone, Mobile, Email, Address, Fax, Web, Note) values ('{$group_id}', '{$sets['org']}', '{$sets['person']}', '{$sets['phone']}', '{$sets['mobile']}', '{$sets['email']}', '{$sets['add']}', '{$sets['fax']}', '{$sets['web']}', '{$sets['note']}')"; 
		return $this->query($sql); 
	}
	
	function getContact($ctid = 0){
		$sql = "select GroupID, ID, Note, Organization, Phone, Address, Person, Mobile, Email, Fax, Web from contact_info ";
		if ($ctid > 0){
			$sql .= " Where ID = {$ctid}";
		}
		$sql .= " Order by Organization asc ";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->GroupID][$this->ID]['org']    = $this->Organization;
			$_arr[$this->GroupID][$this->ID]['person'] = $this->Person;
			$_arr[$this->GroupID][$this->ID]['phone']  = $this->Phone;
			$_arr[$this->GroupID][$this->ID]['mobile'] = $this->Mobile;
			$_arr[$this->GroupID][$this->ID]['email']  = $this->Email;
			$_arr[$this->GroupID][$this->ID]['add']    = $this->Address;
			$_arr[$this->GroupID][$this->ID]['fax']    = $this->Fax;
			$_arr[$this->GroupID][$this->ID]['web']    = $this->Web;
			$_arr[$this->GroupID][$this->ID]['note']    = $this->Note;
		}
		return $_arr;
	}			


	function getContactGroup($gid=0){
		$sql = "select ID, `Group`, Tel, Person from contact_group";
		if ($gid > 0){
			$sql .= " Where ID = {$gid}";
		}
		$sql .= " Order by `Group` asc ";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->ID]['name']   = $this->Group;
			$_arr[$this->ID]['tel']    = $this->Tel;
			$_arr[$this->ID]['person'] = $this->Person;
		}
		return $_arr;
	}
	
	
	function delContactGroup($gid){
		if($gid > 0){
			$sql = "delete from contact_group where ID = {$gid} ";
			return $this->query($sql);
		}
	}	
	
	function addContactGroup($group, $tel, $person){
		$sql = "insert into contact_group (`Group`, Tel, Person) values ('{$group}', '{$tel}', '{$person}') ";
		return $this->query($sql);
	}
	
	function setContactGroup($group_id, $group, $tel, $person){
		$sql = "Update contact_group SET `Group` = '{$group}', Tel = '{$tel}', Person = '{$person}' where ID = '{$group_id}'";
		return $this->query($sql);
	}
	
	function getAssignTask($tid=0, $userid=0){
			$codition = "";
			if($tid > 0){
				$codition .= " AND  ID = {$tid}";
			}
			
			if ($userid > 0){
				$codition .= " And FromUser = {$userid}";
			}		
		
			$sql = array("select ID, SignDate, FromUser, ToUser, DueDate, DueHour, Task, Detail, Done 
						  from task_process 
						  where DueDate <> '0000-00-00' AND Done = 0 {$codition} 
						  ORDER BY DueDate ASC, DueHour ASC",
						  "select ID, SignDate, FromUser, ToUser, DueDate, DueHour, Task, Detail, Done 
					 	   from task_process 
					 	   where DueDate = '0000-00-00' AND Done = 0 {$codition}
         			       ORDER BY DueDate ASC, DueHour ASC",						  
						  "select ID, SignDate, FromUser, ToUser, DueDate, DueHour, Task, Detail, Done 
					 	   from task_process 
					 	   where DueDate <> '0000-00-00' AND Done = 1 {$codition}
         			       ORDER BY DueDate ASC, DueHour ASC",
         			       "select ID, SignDate, FromUser, ToUser, DueDate, DueHour, Task, Detail, Done 
					 	   from task_process 
					 	   where DueDate = '0000-00-00' AND Done = 1 {$codition}
         			       ORDER BY DueDate ASC, DueHour ASC"
				 	);
			$_arr = array();
			foreach ($sql as $_sql){	 			
				$this->query($_sql);

				while ($this->fetch()){
					$_arr[$this->ToUser][$this->ID]['date']   = $this->SignDate;
					$_arr[$this->ToUser][$this->ID]['from']   = $this->FromUser;
					$_arr[$this->ToUser][$this->ID]['task']   = $this->Task;
					$_arr[$this->ToUser][$this->ID]['detail'] = $this->Detail;
					$_arr[$this->ToUser][$this->ID]['done']   = $this->Done;
					$_arr[$this->ToUser][$this->ID]['due']    = $this->DueDate;
					$_arr[$this->ToUser][$this->ID]['duehour']    = $this->DueHour;
				}
			}
			return $_arr;
	}
	
	function getReceiveTask($tid=0, $userid=0){
			$condition = "";
			if($tid > 0){
				$condition .= " AND  ID = {$tid}";
			}
			
			if ($userid > 0){
				$condition .= " And ToUser = {$userid}";
			}


			$sql = array("select ID, SignDate, FromUser, ToUser, DueDate, DueHour, Task, Detail, Done 
						  from task_process 
					      where DueDate <> '0000-00-00' AND Done = 0 {$condition}
						  ORDER BY DueDate ASC, DueHour ASC ",
						  "select ID, SignDate, FromUser, ToUser, DueDate, DueHour, Task, Detail, Done 
						  from task_process 
					      where DueDate = '0000-00-00' AND Done = 0 {$condition}
						  ORDER BY DueDate ASC, DueHour ASC ",
						  "select ID, SignDate, FromUser, ToUser, DueDate, DueHour, Task, Detail, Done 
						  from task_process 
					      where DueDate <> '0000-00-00' AND Done = 1 {$condition}
						  ORDER BY DueDate ASC, DueHour ASC ",
						  "select ID, SignDate, FromUser, ToUser, DueDate, DueHour, Task, Detail, Done 
						  from task_process 
					      where DueDate = '0000-00-00' AND Done = 1 {$condition}
						  ORDER BY DueDate ASC, DueHour ASC ",
					);
			$_arr = array();					
			foreach ($sql as $_sql){
				$this->query($_sql);
				while ($this->fetch()){
					$_arr[$this->ToUser][$this->ID]['date']   = $this->SignDate;
					$_arr[$this->ToUser][$this->ID]['from']   = $this->FromUser;
					$_arr[$this->ToUser][$this->ID]['task']   = $this->Task;
					$_arr[$this->ToUser][$this->ID]['detail'] = $this->Detail;
					$_arr[$this->ToUser][$this->ID]['done']   = $this->Done;
					$_arr[$this->ToUser][$this->ID]['due']    = $this->DueDate;
					$_arr[$this->ToUser][$this->ID]['duehour']    = $this->DueHour;
				}
			}
			return $_arr;
	}

	
	function getNumberOfUndoTask($userid=0){
			$sql = "select count(*) as ct from task_process where Done <> 1 ";
			
			if ($userid > 0){
				$sql .= " And ToUser = {$userid}";
			}
							
			$this->query($sql);
			while ($this->fetch()){
				return $this->ct;
			}
			return 0;		
	}
	
	function getTask($tid=0){	
		if($tid > 0){
			$sql = "select ID, SignDate, FromUser, ToUser, DueDate, Task, Detail, Done, DueHour from task_process where ID = {$tid}";
			$this->query($sql);
			$_arr = array();
			while ($this->fetch()){
				$_arr[$this->ID]['date']   = $this->SignDate;
				$_arr[$this->ID]['from']   = $this->FromUser;
				$_arr[$this->ID]['task']   = $this->Task;
				$_arr[$this->ID]['detail'] = $this->Detail;
				$_arr[$this->ID]['done']   = $this->Done;
				$_arr[$this->ID]['due']    = $this->DueDate;
				$_arr[$this->ID]['to']     = $this->ToUser;
				$_arr[$this->ID]['duehour']     = $this->DueHour;
			}
			return $_arr;
		}
	}
		
	function addTask($userid, $sets){
		foreach ($sets as &$v){
			$v = addslashes($v);
		}
		$sql = "insert into `geic`.`task_process` (SignDate, FromUser, ToUser, DueDate, Task, Detail, Done, DueHour) values ('{$sets['date']}', '{$userid}', '{$sets['to']}', '{$sets['due']}', '{$sets['task']}', '{$sets['detail']}', '{$sets['done']}', '{$sets['duehour']}')";
		return $this->query($sql);
	}	
	
	function setTask($tid, $sets){
		if ($tid > 0){
			foreach ($sets as &$v){
				$v = addslashes($v);
			}
			$sql = "UPdate task_process SET SignDate = '{$sets['date']}', ToUser = '{$sets['to']}', DueDate = '{$sets['due']}', Task = '{$sets['task']}', Detail = '{$sets['detail']}', Done = '{$sets['done']}', DueHour = '{$sets['duehour']}' where ID = '{$tid}'";
			return $this->query($sql);
		}
	}
	
	function delTask($tid){
		if (is_array($tid) && count($tid) > 0){
			$tid_str = implode(',', $tid);
			$sql = "delete from task_process where ID in ($tid_str)";
			return $this->query($sql);
		}elseif($tid > 0){
			$sql = "delete from task_process where ID = '{$tid}'";
			return $this->query($sql);
		}
	}
	
	function delReceiveTaskByUser($user){
		if (is_array($user) && count($user) > 0){
			$user_str = implode(',', $user);
			$sql = "delete from task_process where ToUser in ($user_str)";
			return $this->query($sql);
		}elseif($user > 0){
			$sql = "delete from task_process where ToUser = '{$user}'";
			return $this->query($sql);
		}		
	}
	
	function delAssignTaskByUser($user){
		if (is_array($user) && count($user) > 0){
			$user_str = implode(',', $user);
			$sql = "delete from task_process where FromUser in ($user_str)";
			return $this->query($sql);
		}elseif($user > 0){
			$sql = "delete from task_process where FromUser = '{$user}'";
			return $this->query($sql);
		}		
	}
	
	function addAttachment($itemid, $itemtype, $file, $user_id){
		if ($itemid > 0 && $itemtype != "" && $file != "" && $user_id > 0){
			$itemtype = addslashes($itemtype);
			$file = addslashes($file);
			$sql = "insert into `attachment` (ItemID, ItemType, File, UploadTime, UserID) values ('{$itemid}', '{$itemtype}', '{$file}', Now(), '{$user_id}')";
			return $this->query($sql);
		}
	}
	
	function delAttachment($id){
		if($id > 0){
			$sql = "delete from attachment where ID = ". $id;
			return $this->query($sql);
		}
	}
	
	function changeAttachment($id, $file){
		if ($id > 0 && $file != "") {
			$file = addslashes($file);
			$sql = "Update attachment SET File = '{$file}' where ID = {$id}";
			return $this->query($sql);		
		}	
	}
	
	function getAttachmentFileName($id){
		if ($id > 0) {
			$sql = "select File from attachment where ID = {$id}";
			$this->query($sql);
			if ($this->fetch()) {
				return $this->File;
			}	
		}	
	}
	
	
	function getAttachment($itemid, $itemtype){
		if ($itemid > 0 && $itemtype != "" ){
			$itemtype = addslashes($itemtype);
			$sql = "select ItemID, ItemType, ID, File, UploadTime from attachment where ItemID = '{$itemid}' and ItemType = '{$itemtype}' order by UploadTime desc ";
			$this->query($sql);
			$_arr = array();
			while ($this->fetch()){
				$_arr[$this->ID]['item'] = $this->ItemID;
				$_arr[$this->ID]['type'] = $this->ItemType;
				$_arr[$this->ID]['file'] = basename($this->File);
				$_arr[$this->ID]['time'] = $this->UploadTime;
				$_arr[$this->ID]['url'] = $this->File;
			}
			return $_arr;
		}
	}
	
	function getSalesCatgory($iid=0, $cateid=0){
		$sql = "select ID, CategoryName, IID from sales_category Where IID = {$iid}";
		if($cateid > 0){
			$sql .= " AND ID = '{$cateid}'";
		}
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->IID][$this->ID] = $this->CategoryName;
		}
		return $_arr;
	}
	
	function getSalesPoint($pointid = 0){
		$sql = "select ID, CateID, PointName, Note from sales_point ";
		if($pointid > 0){
			$sql .= " Where ID = '{$pointid}'";
		}
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->CateID][$this->ID]['name'] = $this->PointName;
			$_arr[$this->CateID][$this->ID]['note'] = $this->Note;
		}
		return $_arr;
	}
	
	function addSalesCategory($iid, $categoryName){
		if($categoryName != "" && $iid > 0){
			$categoryName = addslashes($categoryName);
			$sql = "insert into `sales_category` (IID, CategoryName) values ('{$iid}', '{$categoryName}')";
			return $this->query($sql);
		}
	}
	
	function setSalesCategory($cateid, $categoryName){
		if($cateid > 0 && $categoryName != ""){
			$categoryName = addslashes($categoryName);
			$sql = "Update `sales_category` SET CategoryName = '{$categoryName}' where ID = {$cateid} ";
			return $this->query($sql);
		}
	}
	
	function delSalesCategory($cateid){
		if($cateid > 0){
			$sql = "delete from  `sales_category` where ID = {$cateid} ";
			return $this->query($sql);
		}
	}
	
	function addSalesPoint($cateid, $pointName, $pointNote){
		if($pointName != "" && $cateid > 0){
			$pointName = addslashes($pointName);
			$pointNote = addslashes($pointNote);
			$sql = "insert into `sales_point` (CateID, PointName, Note) values ('{$cateid}', '{$pointName}', '{$pointNote}')";
			return $this->query($sql);
		}
	}
	
	function setSalesPoint($pointid, $pointName, $pointNote){
		if($pointid > 0 && $pointName != ""){
			$pointName = addslashes($pointName);
			$pointNote = addslashes($pointNote);
			$sql = "Update `sales_point` SET PointName = '{$pointName}', Note = '{$pointNote}' where ID = {$pointid} ";
			return $this->query($sql);
		}
	}
	
	function delSalesPoint($pointid){
		if($pointid > 0){
			$sql = "delete from  `sales_point` where ID = {$pointid} ";
			return $this->query($sql);
		}
	}

	function set_user_adv($userid, $grants){
		if (!($userid > 0) || !is_array($grants) || !count($grants) > 0) {
			return false;
		}
		foreach ($grants as $item=>$op){
			$sql = "Replace into sys_user_grants (UserID, Item, Operate) values ('". $userid. "', '". addslashes($item). "', ". $op .") ";
			$this->query($sql);
		}
		return true;
	}

	function get_user_adv($userid){
		if (!($userid > 0)) {
			return false;
		}
		$sql = "select Advance, IsActive from sys_user_adv where UserID = '". $userid ."'";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()) {
			$_arr[$this->Advance] = $this->IsActive;
		}
		return $_arr;
	}
	
	function get_user_adv_one($userid, $advtag){
		if ($userid > 0 && $advtag != "") {
			$sql = "select IsActive from sys_user_adv where UserID = '". $userid ."' and Advance ='". addslashes($advtag) ."' ";
			$this->query($sql);
			while ($this->fetch() && $this->IsActive == 1) {
				return true;				
			}
		}
		return false;
	}
	
	function get_user_by_tag($advtag){
		if ($advtag != "") {
			$sql = "select UserID, UserName from sys_user_adv a, sys_user b where a.UserID = b.ID and a.IsActive = 1 and a.Advance = '". addslashes($advtag) ."'";
			$this->query($sql);
			$_arr = array();
			while ($this->fetch()) {
				$_arr[$this->UserID] = $this->UserName;
			}
			return $_arr;
		}
	}
	
	function get_user_grants($userid){
		$_arr = array();
		if ($userid > 0) {
			$sql = "select Item, Operate from sys_user_grants where UserID = '". $userid ."'";
			$this->query($sql);
			while ($this->fetch()) {
				$_arr[$this->Item] = $this->Operate;
			}
		}
		return $_arr;
	}

	function check_user_grant($ug, $fg){
		if ($ug == "" || $fg == "") {
			return 0;
		}
		if (($ug & $fg) == $fg) {
			return 1;
		}else{
			return 0;
		}
	}

    function set_sys_views($userid, $type, $view_uids) {
        $sql = "DELETE FROM sys_user_views WHERE UserID = {$userid} AND ViewType = '{$type}' ";
        $this->query($sql);
        $inserts = array();
        foreach ($view_uids as $u) {
            array_push($inserts, "({$userid}, '{$type}', $u)");
        }
        $sql = "INSERT INTO sys_user_views (UserID, ViewType, ViewUserID) values " .implode(',', $inserts);
        return $this->query($sql);
    }

    function del_sys_views($userid, $type) {
        $sql = "DELETE FROM sys_user_views WHERE UserID = {$userid} AND ViewType = '{$type}' ";
        return $this->query($sql);
        
    }

    function get_sys_views($userid) {
        $arr = array();
        $sql = "SELECT * FROM sys_user_views WHERE UserID = {$userid}";
        $this->query($sql);
        while ($this->fetch()) {
            $arr[$this->ViewType][]=$this->ViewUserID;
        }
        return $arr;
    }

    function get_course_viewer($userid) {
        $sql = "select ID, UserName from sys_user a, sys_user_views b WHERE a.id = b.ViewUserID and b.viewtype = 'course' and b.UserID = $userid";
        $this->query($sql);
        $_arr = array();
        while($this->fetch()){
            $_arr[$this->ID] = $this->UserName;
        }

        return $_arr;   
    }

    function get_migration_agents() {
        $arr = $this->getUserNameArr();
        $agents = array();
        foreach (array(3,29,57,67,81) as $uid) {
            if(isset($arr[$uid])) {
                $agents[$uid] = $arr[$uid];
            }
        }
        return $agents;
	}	
	
	function getMemberByStaffId($user_id) {
		$sql = "select UserName, u.ID from sys_user u, sys_user_management um where u.ID = um.StaffID and um.ManagerID = {$user_id}";
		//var_dump($sql);
		$this->query($sql);
		$rtn = array();
		while($this->fetch()){
			$rtn[$this->ID] = $this->UserName;
		}
		return $rtn;
	}

	function setMemberByStaffId($user_id, $members) {
		if (!$user_id || !$members || count($members) == 0)
			return false;

		$sql = "SELECT id, staffid from sys_user_management WHERE ManagerID = {$user_id} ";
		$this->query($sql);
		$dels = $exists = array();
		while($this->fetch()) {
			if (!in_array($this->staffid, $members)){
				array_push($dels, $this->id);
			}
			else {
				$exists[$this->staffid] = 1;
			}
		}

		$inserts = array();
		foreach ($members as $member_id) {
			if (isset($exists[$member_id]))
				continue;

			array_push($inserts, "({$member_id}, {$user_id})");
		}

		if (count($inserts) > 0) {
			$sql = "INSERT INTO sys_user_management (StaffID, ManagerID) values ". implode(',', $inserts);
			//echo $sql."\n";
			$this->query($sql);
		}

		if (count($dels) > 0) {
			$sql = "DELETE FROM sys_user_management where id in (".implode(',', $dels).")";
			//echo $sql."\n";
			$this->query($sql);
		}

		return true;
	}
}
?>