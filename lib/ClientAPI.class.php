<?php
require_once('MysqlDB.class.php');

class ClientAPI extends MysqlDB {

    function ClientAPI($host, $user, $pswd, $database, $debug) {
    	 $this->MysqlDB($host, $user, $pswd, $database, $debug);
    }

	function _login ($email, $pass) {
		$email = addslashes($email);
		$pass  = md5($pass);

		$sql = "SELECT CID, STATUS FROM client_info WHERE email = '{$email}' AND TOKEN = '{$pass}'";
		$this->query($sql);
		while ($this->fetch()) {
			return array('cid'=>$this->CID, 'status'=>$this->STATUS);
		}
		return 0;
	}

	
	function _register ($email,$lname='',$fname='',$phone='',$wechat_id='',$client_type='',$version=1) {
		$email = addslashes($email);
		$pass  = md5('12345');
		$lname = addslashes($lname);
		$fname = addslashes($fname);
		$phone = addslashes($phone);
		$wechat_id = addslashes($wechat_id);
		$client_type = addslashes($client_type);

		if ($email == '')
			return 0;

		$sql = "SELECT CID FROM client_info WHERE email = '{$email}' LIMIT 1";
		$this->query($sql);
		$this->fetch();
		if ($this->CID > 0)
			return 0;

		$sql = "INSERT INTO client_info (EMAIL, STATUS,TOKEN, VisaClassTxt, LName,FName,Mobile,Wechat_ID, ClientType,CreateTime) VALUES ('{$email}', 'new', '{$pass}', '', '{$lname}', '{$fname}', '{$phone}', '{$wechat_id}', '{$client_type}', NOW())";
		$this->query($sql);
		if ($version == 2) {
			$client_id = $this->getLastInsertID();
			$client_code = strtoupper(dechex($client_id));
			$sql = "update client_info SET TOKEN = '".md5($client_code)."' where cid = {$client_id}";	
			$this->query($sql);
			return array('id'=>$client_id, 'code'=>$client_code);
		}
		else {
			return $this->getLastInsertID();
		}	
	}


	function _confirm ($cid) {
		if ($cid == 0)
			return 0;

		$sql = "UPDATE client_info SET STATUS = 'new' WHERE CID = '{$cid}'";
		$this->query($sql);
 	    return $cid;		
	}	

	function addClientUserRs($cid, $uid, $type=__RECEPTION){
		if($cid > 0 && $uid > 0){
			//$sql = "delete from client_user where CID = '{$cid}' and RsType = '{$type}' ";
			//$this->query($sql);
			$sql = "insert ignore into client_user (CID, UID, RsType) value ({$cid}, {$uid}, '{$type}') ";
			$this->query($sql);
			//$sql = "insert into client_user (CID, UID, RsType) value ({$cid}, {$uid}, '{$type}') ON DUPLICATE KEY UPDATE UID = '{$uid}'";
		}
	}

	function getClientTotalRows() {
		$sql = "SELECT FOUND_ROWS() AS C";
		$this->query($sql);
		$this->fetch();
		return $this->C;
	}

	function getClientInfo($page, $page_size, $cid = 0, $user_id=0, $col_f="", $col_v="", $from="", $to="", $only_course=0, $status=''){
		$sql = " select SQL_CALC_FOUND_ROWS CID, LName, FName, Gender, DoB, EName, Email, HTel, Mobile, CurResiAdd, CNCT_PName, CNCT_HTel, CNCT_Mobile, CNCT_Add, VisaID, VisaClassID, ExpirDate, ClientType, CreateTime, STATUS, MaritalStatus, VisaClassTxt, ActiveMem, ActiveMem_Date, Bank, Wechat_ID, Wechat_Phone, Wechat_Email from client_info where 1";
		
		if ($user_id > 0){
			$sql .= " AND CID in (select distinct CID from client_user where UID = {$user_id}) ";
		}
        
        if($only_course == 1) {
			$sql .= " AND ClientType like '%study%' ";
		}
		
		if ($cid > 0){
			$sql .= " AND CID = {$cid} ";
		} elseif($col_f != "" && $col_v != ""){
			if ($col_f == 'TOKEN')
				$sql .= " AND {$col_f} = '".md5($col_v)."' ";
			else
				$sql .= " AND {$col_f} like '%{$col_v}%' ";
		}
		
		if ($from != "" && $to != ""){
			$sql .= " AND CreateTime >= '{$from}' AND CreateTime <= '{$to}' ";
		}

		if ($status != '')
			$sql .= " AND STATUS = '{$status}' ";
		
		$sql .= " Order by STATUS ASC, CreateTime desc, LName asc Limit " . ($page - 1)* $page_size . ", " . $page_size;
		//echo $sql."\n";
		$this->query($sql);

		$_arr = array();
		global $client_type_arr;
		while ($this->fetch()) {
			$_arr[$this->CID]['lname'] 	= $this->LName;
			$_arr[$this->CID]['fname'] 	= $this->FName;
			$_arr[$this->CID]['gender']	= $this->Gender;
			$_arr[$this->CID]['dob'] 	= $this->DoB;
			$_arr[$this->CID]['ename']	= $this->EName;
			$_arr[$this->CID]['email'] 	= $this->Email;
			$_arr[$this->CID]['htel'] 	= $this->HTel;
			$_arr[$this->CID]['mobile']	= $this->Mobile;
			$_arr[$this->CID]['add'] 	= $this->CurResiAdd;
			$_arr[$this->CID]['type'] 	= explode(',', $this->ClientType);
			$_arr[$this->CID]['sign'] 	= $this->CreateTime;
			$_arr[$this->CID]['status'] = $this->STATUS;
			$_arr[$this->CID]['married'] = $this->MaritalStatus;
			$_arr[$this->CID]['classtxt'] = $this->VisaClassTxt;
			$_arr[$this->CID]['actm'] = $this->ActiveMem;
			$_arr[$this->CID]['d_actm`'] = $this->ActiveMem_Date;
			$_arr[$this->CID]['bank'] = $this->Bank;
			$_arr[$this->CID]['wechatid'] = $this->Wechat_ID;
			$_arr[$this->CID]['wechatphone'] = $this->Wechat_Phone;
			$_arr[$this->CID]['wechatemail'] = $this->Wechat_Email;			
			if ($this->CNCT_PName != ""){
				$_arr[$this->CID]['hasCT'] = true;
			}
		}
		return $_arr;
	}    
	
	function getClientNumRows($cid = 0, $user_id=0, $col_f="", $col_v = "", $from="", $to="", $only_course=0, $status) {
		$sql = "select IF(b.item is null,'Others',b.item) as babout, IF(b.item is null,if(about='','Blank',about),b.item) as subabout, count(*) as cnt from client_info a left join client_from b on (a.about = b.item) where 1 ";
		if ($user_id > 0){
			$sql .= " AND CID in (select distinct CID from client_user where UID = {$user_id}) ";
        }
        
        if($only_course == 1) {
			$sql .= " AND ClientType in ('study') ";
		}
		
		if ($cid > 0){
			$sql .= " AND CID = {$cid} ";
		}  elseif($col_f != "" && $col_v != ""){
			$sql .= " AND {$col_f} like '{$col_v}%' ";
		}
		
		if ($from != "" && $to != ""){
			$sql .= " AND CreateTime >= '{$from}' AND CreateTime <= '$to' ";
		}

		if ($status != '')
			$sql .= " AND STATUS = '{$status}' ";

        $sql .= " Group by babout, subabout ";
		$this->query($sql);
		$arr = array();
		while ($this->fetch()){
            isset($arr['all'][$this->babout])? ($arr['all'][$this->babout] += $this->cnt) : ($arr['all'][$this->babout] = $this->cnt);
            if(strtolower($this->babout) == 'others'){
                $arr['other'][$this->subabout] = $this->cnt;
            }
        }
		return $arr;
	}
	
	function getClientType($cid = 0){
		if ($cid > 0){
			$sql = "select ClientType from client_info where CID = {$cid}";
			$this->query($sql);
			while ($this->fetch()){
				return explode(',', $this->ClientType);
			}
		}
		return false;
	}
	
	
	function getContactInfo($cid){
		$sql = "select  CID, CNCT_PName, CNCT_HTel, CNCT_Mobile, CNCT_Add from client_info where CID = {$cid} ";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->CID]['ct_name'] 	= $this->CNCT_PName;
			$_arr[$this->CID]['ct_htel'] 	= $this->CNCT_HTel;
			$_arr[$this->CID]['ct_mobile']= $this->CNCT_Mobile;
			$_arr[$this->CID]['ct_add'] 	= $this->CNCT_Add;
		}
		return $_arr;
	}
	
	function setClientInfo($cid, $set_arr){
		$set_arr['type'] = strtolower(implode(',', $set_arr['type']));
		foreach($set_arr as &$v){
			$v = addslashes($v);
		}
		
		$sql = "Update client_info SET LName = '{$set_arr['lname']}', FName = '{$set_arr['fname']}', DoB = '{$set_arr['dob']}', Gender = '{$set_arr['gender']}', EName = '{$set_arr['ename']}', Email = '{$set_arr['email']}', HTel = '{$set_arr['tel']}', Mobile = '{$set_arr['mobile']}', CurResiAdd = '{$set_arr['add']}', Country = '{$set_arr['country']}', VisaID = '{$set_arr['visa']}', VisaClassID = '{$set_arr['class']}', ExpirDate = '{$set_arr['epdate']}', Note = '{$set_arr['note']}', ClientType = '{$set_arr['type']}', AgentID = '{$set_arr['agent']}', About = '{$set_arr['about']}', CreateTime = '{$set_arr['sign']}', MaritalStatus = '{$set_arr['married']}', VisaClassTxt = '{$set_arr['classtxt']}', ActiveMem = '{$set_arr['actm']}', ActiveMem_Date = '{$set_arr['d_actm']}', Bank = '{$set_arr['bank']}', Wechat_ID = '{$set_arr['wechatid']}', Wechat_Phone = '{$set_arr['wechatphone']}', Wechat_Email = '{$set_arr['wechatemail']}' ";
		if (isset($set_arr['c_name']) && $set_arr['c_name'] != ""){
			$sql .= ", CNCT_PName = '{$set_arr['c_name']}', CNCT_HTel = '{$set_arr['c_tel']}', CNCT_Mobile = '{$set_arr['c_mobile']}', CNCT_ADD = '{$set_arr['c_add']}', CNCT_Email = '{$set_arr['c_email']}', CNCT_RTU = '{$set_arr['c_rtu']}' ";
		}
		if (isset($set_arr['status']) && $set_arr['status'] != ""){
			$sql .= ", STATUS = '{$set_arr['status']}' ";
		}
		if (isset($set_arr['pass']) && $set_arr['pass'] != '') {
			$sql .= ", TOKEN = '". md5($set_arr['pass']) ."' ";		
		}
		$sql .= " where CID = '{$cid}'";
		//echo $sql;
		return $this->query($sql);
	}
	
	function checkSimilarClient($set_arr){
		$name = addslashes(strtolower(str_replace(' ', '', $set_arr['lname'].$set_arr['fname'])));
		$email = addslashes($set_arr['email']);
		$sql = "select count(*) as cnt from client_info where lower(replace(concat(LName, ' ',FName),' ', '')) =  '{$name}' OR EMAIL = '{$email}' ";
		//echo $sql;
		$this->query($sql);
		while ($this->fetch()) {
			return $this->cnt;
		}
		return 0;
	}
	
	function addClientInfo($userid, $set_arr){
		$set_arr['status'] = isset($set_arr['status'])? $set_arr['status'] : 'approved';
		$password = $set_arr['pass'] != ''? md5($set_arr['pass']) : '';
		$set_arr['type'] = strtolower(implode(',', $set_arr['type']));
		foreach($set_arr as &$v){
			$v = addslashes($v);
		}
		if (isset($set_arr['c_name']) && $set_arr['c_name'] != ""){
			$sql = "insert into `geic`.`client_info` (STATUS, LName, FName, Gender, DoB, EName, Email, HTel, Mobile, CurResiAdd, Country, VisaID, VisaClassID, ExpirDate, UserID, CNCT_PName, CNCT_HTel, CNCT_Mobile, CNCT_Add, ClientType, Note, About, AgentID, CreateTime, MaritalStatus, TOKEN, VisaClassTxt, CNCT_RTU, ActiveMem, ActiveMem_Date, Bank, Wechat_ID, Wechat_Phone, Wechat_Email) values ('{$set_arr['status']}','{$set_arr['lname']}', '{$set_arr['fname']}', '{$set_arr['gender']}', '{$set_arr['dob']}', '{$set_arr['ename']}', '{$set_arr['email']}', '{$set_arr['tel']}', '{$set_arr['mobile']}', '{$set_arr['add']}', '{$set_arr['country']}', '{$set_arr['visa']}', '{$set_arr['class']}', '{$set_arr['epdate']}', {$userid}, '{$set_arr['c_name']}', '{$set_arr['c_tel']}', '{$set_arr['c_mobile']}', '{$set_arr['c_add']}', '{$set_arr['type']}', '{$set_arr['note']}', '{$set_arr['about']}', '{$set_arr['agent']}', '{$set_arr['sign']}', '{$set_arr['married']}', '{$password}', '{$set_arr['classtxt']}', '{$set_arr['c_rtu']}', '{$set_arr['actm']}', '{$set_arr['d_actm']}', '{$set_arr['bank']}', '{$set_arr['wechatid']}', '{$set_arr['wechatphone']}', '{$set_arr['wechatemail']}') ";
		}
		else{
			$sql = "insert into `geic`.`client_info` (STATUS, LName, FName, Gender, DoB, EName, Email, HTel, Mobile, CurResiAdd, Country, VisaID, VisaClassID, ExpirDate, UserID, ClientType, Note, About, AgentID, CreateTime, MaritalStatus, TOKEN, VisaClassTxt, ActiveMem, ActiveMem_Date, Bank, Wechat_ID, Wechat_Phone, Wechat_Email)values ('{$set_arr['status']}','{$set_arr['lname']}', '{$set_arr['fname']}', '{$set_arr['gender']}', '{$set_arr['dob']}', '{$set_arr['ename']}', '{$set_arr['email']}', '{$set_arr['tel']}', '{$set_arr['mobile']}', '{$set_arr['add']}', '{$set_arr['country']}', '{$set_arr['visa']}', '{$set_arr['class']}', '{$set_arr['epdate']}', {$userid}, '{$set_arr['type']}', '{$set_arr['note']}', '{$set_arr['about']}', '{$set_arr['agent']}', '{$set_arr['sign']}', '{$set_arr['married']}', '{$password}', '{$set_arr['classtxt']}', '{$set_arr['actm']}', '{$set_arr['d_actm']}', '{$set_arr['bank']}', '{$set_arr['wechatid']}', '{$set_arr['wechatphone']}', '{$set_arr['wechatemail']}') ";
		}
		return $this->query($sql);		
	}	

	function delClient($cid){
		if ($cid > 0){
			$sql = "delete from client_info where CID = {$cid}";
			$this->query($sql);
			
			$this->delVisaByClient();
			$this->delDependantByVisa();
			$this->delVisaProcByVisa();
			$this->delAccountByVisa();
			$this->delPaymentByAccount();
			$this->delIeltsByClient();
			$this->delServiceByClient();
			$this->delQualByClient();
			$this->delWorkByClient();
			$this->delCourseByClient();
			$this->delCourseProcByCourse();
			$this->delCourseSemByCourse();
			$this->delSemProcBySem();
			$this->delUserByClient();
		}
	}
	
	function delVisaByClient(){
		$sql = "delete from client_visa where CID not in(select CID from client_info)";
		$this->query($sql);
	}
	
	function delDependantByVisa(){
		$sql = "delete from client_visa_dep where CVID not in(select ID from client_visa)";
		$this->query($sql);				
	}
	
	function delVisaProcByVisa(){
		$sql = "delete from client_visa_process where CVID not in(select ID from client_visa)";
		$this->query($sql);
	}
	
	function delAccountByVisa(){
		$sql = "delete from client_account where VisaID not in(select ID from client_visa)";
		$this->query($sql);
	}
	
	function delPaymentByAccount(){
		$sql = "delete from client_payment where AccountID not in(select ID from client_account)";
		$this->query($sql);
	}
	
	function delIeltsByClient(){
		$sql = "delete from client_ielts where CID not in(select CID from client_info)";
		$this->query($sql);
	}
	
	function delServiceByClient(){
		$sql = "delete from client_service where CID not in(select CID from client_info)";
		$this->query($sql);		
	}
	
	function delQualByClient(){
		$sql = "delete from client_qual where CID not in(select CID from client_info)";
		$this->query($sql);		
	}
	
	function delWorkByClient(){
		$sql = "delete from client_work where CID not in(select CID from client_info)";
		$this->query($sql);		
	}
	
	function delCourseByClient(){
		$sql = "delete from client_course where CID not in(select CID from client_info)";
		$this->query($sql);				
	}
		
	function delCourseProcByCourse(){
		$sql = "delete from client_course_process where CCID not in(select ID from client_course)";
		$this->query($sql);				
	}	
	
	function delCourseSemByCourse(){
		$sql = "delete from client_course_sem where CCID not in(select ID from client_course)";
		$this->query($sql);				
	}	
	
	function delSemProcBySem(){
		$sql = "delete from client_course_sem_process where SemID not in(select ID from client_course_sem)";
		$this->query($sql);				
	}

	function delUserByClient(){
		$sql = "delete from client_user where CID not in(select CID from client_info)";
		$this->query($sql);				
	}
	

	function getOneClientInfo($cid){
		$_arr = array();
		if(!($cid > 0)) {
			return $_arr;
		}
		
		$sql = " select CID, LName, FName, Gender, DoB, EName, Email, HTel, Mobile, CurResiAdd, Country, CNCT_PName, CNCT_HTel, CNCT_Mobile, CNCT_Email, CNCT_Add, CNCT_RTU, VisaID, if(VisaName is null, 'n/a', VisaName) as VisaName, VisaClassID, if(ClassName is null, 'n/a', ClassName) as ClassName, ExpirDate, UserID, Note, ClientType, AgentID, About, CreateTime, CourseUser, CourseVisitDate, STATUS, MaritalStatus, VisaClassTxt, ActiveMem_Date, ActiveMem, Bank, Wechat_ID, Wechat_Phone, Wechat_Email  from client_info  a left join visa_category b on(a.VisaID = b.CateID) left join visa_subclass c on(a.VisaClassID = c.SubClassID)  where CID = {$cid} ";
		$this->query($sql);
		while($this->fetch()){
			$_arr['lname']   = $this->LName;
			$_arr['fname'] 	 = $this->FName;
			$_arr['gender']  = $this->Gender;
			$_arr['dob'] 	 = $this->DoB;
			$_arr['ename']	 = $this->EName;
			$_arr['email'] 	 = $this->Email;
			$_arr['tel'] 	 = $this->HTel;
			$_arr['mobile']	 = $this->Mobile;
			$_arr['add'] 	 = $this->CurResiAdd;
			$_arr['country'] = $this->Country;
			$_arr['visa'] 	 = $this->VisaID;
			$_arr['class'] 	 = $this->VisaClassID;
			$_arr['epdate']	 = $this->ExpirDate;
			$_arr['userid']	 = $this->UserID;
			$_arr['c_name']  = $this->CNCT_PName;
			$_arr['c_tel']   = $this->CNCT_HTel;
			$_arr['c_mobile']= $this->CNCT_Mobile;
			$_arr['c_email'] = $this->CNCT_Email;	
			$_arr['c_add'] 	 = $this->CNCT_Add;
			$_arr['c_rtu'] 	 = $this->CNCT_RTU;			
			$_arr['type'] 	 = explode(',', $this->ClientType);
			$_arr['note'] 	 = $this->Note;
			$_arr['agent'] 	 = $this->AgentID;
			$_arr['about'] 	 = $this->About;
			$_arr['sign'] 	 = $this->CreateTime;		
			$_arr['cuser'] 	 = $this->CourseUser;
			$_arr['cvdate']  = $this->CourseVisitDate;
			$_arr['status']  = $this->STATUS;
			$_arr['married'] = $this->MaritalStatus;			
			$_arr['classtxt'] = $this->VisaClassTxt;
			$_arr['actm'] = $this->ActiveMem;
			$_arr['d_actm'] = $this->ActiveMem_Date;
			$_arr['bank'] = $this->Bank;		
			$_arr['visa_n'] = $this->VisaName;
			$_arr['class_n'] = $this->ClassName;
			$_arr['wechatid'] = $this->Wechat_ID;
			$_arr['wechatphone'] = $this->Wechat_Phone;
			$_arr['wechatemail'] = $this->Wechat_Email;								
		}
		return $_arr;
	}

	function setService($sid, $sets){
		if(!($sid > 0)){
			return false;
		}
		foreach($sets as &$v){
			$v = addslashes($v);
		}
		
		$sql = "Update client_service SET Date = '{$sets['date']}', Subject = '{$sets['subject']}', Detail = '{$sets['detail']}', DueDate = '{$sets['due']}', Done = '{$sets['done']}'where ID = {$sid} ";
		return $this->query($sql);
	}

	function addService($cid, $sets){
		if(!($cid > 0)){
			return false;
		}
		foreach($sets as &$v){
			$v = addslashes($v);
		}
		
		$sql = "Insert into client_service (CID, Date, Subject, Detail, DueDate, Done) values ('{$cid}', '{$sets['date']}', '{$sets['subject']}', '{$sets['detail']}', '{$sets['due']}', '{$sets['done']}')";
		return $this->query($sql);
	}
	
	function getServiceByClient($cid=0, $sid=0){
		$sql = "select ID, CID, Date, Subject, Detail, DueDate, Done from client_service ";
		if ($cid > 0){
			$sql .= " where CID = {$cid}";
		}elseif ($sid > 0){
			$sql .= " where ID = {$sid}";
		}
		
		$this->query($sql);
		$_arr = array();
		while($this->fetch()){
			$_arr[$this->ID]['date']    = $this->Date;
			$_arr[$this->ID]['subject'] = $this->Subject;
			$_arr[$this->ID]['detail']  = $this->Detail;
			$_arr[$this->ID]['due']     = $this->DueDate;
			$_arr[$this->ID]['done']    = $this->Done;
			$_arr[$this->ID]['cid']    = $this->CID;
		}
		return $_arr;
	}	

	function delService($sid){
		if($sid > 0){
			$sql = "delete from client_service where ID = {$sid} ";
			return $this->query($sql);
		}
		return false;
	}
	
		
	function setWorkExp($wid, $set_arr){
		if(!($wid > 0)){
			return false;
		}
		foreach($set_arr as &$v){
			$v = addslashes($v);
		}
		
		$sql = "Update client_work SET FDate = '{$set_arr['fdate']}', TDate = '{$set_arr['tdate']}', Company = '{$set_arr['com']}', CountryID = '{$set_arr['country']}', Position = '{$set_arr['pos']}' , ISFULLTIME = '{$set_arr['fulltime']}', Note = '{$set_arr['note']}' where ID = {$wid} ";
		return $this->query($sql);
	}

	function addWorkExp($cid, $set_arr){
		if(!($cid > 0)){
			return false;
		}
		foreach($set_arr as &$v){
			$v = addslashes($v);
		}
		
		$sql = "Insert into client_work (FDate, TDate, Company, CountryID, Position, Note, CID, OrderID, ISFULLTIME) values ('{$set_arr['fdate']}', '{$set_arr['tdate']}', '{$set_arr['com']}', '{$set_arr['country']}', '{$set_arr['pos']}', '{$set_arr['note']}', {$cid}, '{$set_arr['order']}', '{$set_arr['fulltime']}')";
		return $this->query($sql);
	}
	
	function getWorkExpOrder($wid=0, $cid=0){
		$sql = "";
		if($wid > 0){
			$sql = "select OrderID from client_work where ID = '{$wid}'";

		}elseif($cid > 0){
			$sql = "select if(Max(OrderID) is null, 0, max(OrderID)) as OrderID from client_work where CID = '{$cid}'";
		}
		$this->query($sql);
		while ($this->fetch()){
			return $this->OrderID;
		}
		return 0;
	}

	function resetWorkExpOrder($cid, $orderid){
		if($cid > 0){
			$sql = "Update client_work SET OrderID = OrderID + 1 where CID = '{$cid}' and OrderID > '{$orderid}' ";
			return $this->query($sql);
		}
	}
	
		
	
	function getWorkExpByClient($cid=0, $wid=0){
		$sql = "select ID, FDate, TDate, Company, CountryID, Position, Note, CID, ISFULLTIME from client_work ";
		if ($cid > 0){
			$sql .= " where CID = {$cid}";
		}elseif ($wid > 0){
			$sql .= " where ID = {$wid}";
		}
		$sql .= " Order by FDate asc ";
		$this->query($sql);
		$_arr = array();
		while($this->fetch()){
			$_arr[$this->ID]['fdate'] = $this->FDate;
			$_arr[$this->ID]['tdate'] = $this->TDate;
			$_arr[$this->ID]['com']   = $this->Company;
			$_arr[$this->ID]['country']= $this->CountryID;
			$_arr[$this->ID]['pos']   = $this->Position;
			$_arr[$this->ID]['note']  = $this->Note;
			$_arr[$this->ID]['cid']   = $this->CID;
			$_arr[$this->ID]['fulltime']   = $this->ISFULLTIME;		
		}
		return $_arr;
	}	

	function delWorkExp($wid){
		if($wid > 0){
			$sql = "delete from client_work where ID = {$wid} ";
			return $this->query($sql);
		}
		return false;
	}

	function setQualification($qid, $set_arr){
		if(!($qid > 0)){
			return false;
		}
		$set_arr['status'] = isset($set_arr['status'])? $set_arr['status'] : 'YES';		
		foreach($set_arr as &$v){
			$v = addslashes($v);
		}
		
		$sql = "Update client_qual SET FDate = '{$set_arr['fdate']}', TDate = '{$set_arr['tdate']}', School = '{$set_arr['school']}', CountryID = '{$set_arr['country']}', Qual = '{$set_arr['qual']}', Major = '{$set_arr['major']}', Note = '{$set_arr['note']}', ISCOMPLETED = '{$set_arr['status']}' , ISFULLTIME = '{$set_arr['fulltime']}' where ID = {$qid} ";
		return $this->query($sql);
	}
	
	function addQualification($cid, $set_arr){
		if(!($cid > 0)){
			return false;
		}

		$set_arr['status'] = isset($set_arr['status'])? $set_arr['status'] : 'YES';
		foreach($set_arr as &$v){
			$v = addslashes($v);
		}
		
		$sql = "Insert into client_qual (FDate, TDate, School, CountryID, Qual, Major, Note, CID, OrderID, IsCompleted, IsFulltime) values ('{$set_arr['fdate']}', '{$set_arr['tdate']}', '{$set_arr['school']}', '{$set_arr['country']}', '{$set_arr['qual']}', '{$set_arr['major']}', '{$set_arr['note']}', '{$cid}', '{$set_arr['order']}', '{$set_arr['status']}', '{$set_arr['fulltime']}')";
		return $this->query($sql);
	}
	
	function getQualOrder($qid=0, $cid=0){
		$sql = "";
		if($qid > 0){
			$sql = "select OrderID from client_qual where ID = '{$qid}'";

		}elseif($cid > 0){
			$sql = "select if(Max(OrderID) is null, 0, max(OrderID)) as OrderID from client_qual where CID = '{$cid}'";
		}
		$this->query($sql);
		while ($this->fetch()){
			return $this->OrderID;
		}
		return 0;
	}

	function resetQualOrder($cid, $orderid){
		if($cid > 0){
			$sql = "Update client_qual SET OrderID = OrderID + 1 where CID = '{$cid}' and OrderID > '{$orderid}' ";
			return $this->query($sql);
		}
	}
		
	function delQual($qid){
		if($qid > 0){
			$sql = "delete from client_qual where ID = {$qid} ";
			return $this->query($sql);
		}
		return false;
	}
	
	function getQualificationByClient($cid=0, $qid=0){
		$sql = "select ID, FDate, TDate, School, CountryID, Qual, Major, Note, CID, ISCOMPLETED, ISFULLTIME from client_qual ";
		if ($cid > 0){
			$sql .= " where CID = {$cid}";
		}elseif ($qid > 0){
			$sql .= " where ID = {$qid}";
		}
		$sql .= " order by FDate asc";
		$this->query($sql);
		$_arr = array();
		while($this->fetch()){
			$_arr[$this->ID]['fdate']   = $this->FDate;
			$_arr[$this->ID]['tdate']   = $this->TDate;
			$_arr[$this->ID]['school']  = $this->School;
			$_arr[$this->ID]['country'] = $this->CountryID;
			$_arr[$this->ID]['qual']    = $this->Qual;
			$_arr[$this->ID]['major']   = $this->Major;
			$_arr[$this->ID]['note']    = $this->Note;
			$_arr[$this->ID]['cid']     = $this->CID;
			$_arr[$this->ID]['status']  = $this->ISCOMPLETED;			
			$_arr[$this->ID]['fulltime']= $this->ISFULLTIME;						
		}
		return $_arr;
	}
	
	
	function isCourseActive($course_id){
		if ($course_id > 0){
			$sql = "select IsActive from client_course where ID = {$course_id}";
			$this->query($sql);
			while ($this->fetch()){
				return $this->IsActive;
			}
		}
		return 0;
	}
	function getCourseByUser($course_id=0, $client_id=0){
		$sql = "select a.ID, b.Name, a.IID, b.CateID, d.Qual, e.Major, AppFee, ToUsDate, ToSchoolDate, UserID, AgentID, IsActive, StartDate, EndDate, TFee, Duration, a.QualID, MethodID, a.MajorID, Unit, KeyPoint, Refuse, ConsultantID, ConsultantDate, verify_migration_agent, verify_migration_status, isCompleted 
						from client_course a left join institute b on(a.IID = b.ID) 
							 left join institute_category c on(a.IID = c.ID)
							 left join institute_qual d on(a.QualID = d.ID) 
							 left join institute_major e on(a.MajorID = e.ID) Where 1 
				";
		if ($course_id > 0){
			$sql .= " And a.ID = {$course_id}";
		}
		
		if ($client_id > 0){
			$sql .= " And a.CID = {$client_id}";
		}
		
		$sql .= " Order by IsActive asc, StartDate asc";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->CateID][$this->ID]['school']   = $this->Name;
			$_arr[$this->CateID][$this->ID]['iid']      = $this->IID;
			$_arr[$this->CateID][$this->ID]['major']    = $this->MajorID;
			$_arr[$this->CateID][$this->ID]['majorname']= $this->Major;
			$_arr[$this->CateID][$this->ID]['qual']     = $this->QualID;
			$_arr[$this->CateID][$this->ID]['qualname'] = $this->Qual;
			$_arr[$this->CateID][$this->ID]['agent']    = $this->AgentID;
			$_arr[$this->CateID][$this->ID]['appfee']   = $this->AppFee;
			$_arr[$this->CateID][$this->ID]['tusdate']  = $this->ToUsDate;
			$_arr[$this->CateID][$this->ID]['tsdate']   = $this->ToSchoolDate;
			$_arr[$this->CateID][$this->ID]['method']   = $this->MethodID;
			$_arr[$this->CateID][$this->ID]['active']   = $this->IsActive;
			$_arr[$this->CateID][$this->ID]['fee']      = $this->TFee;
			$_arr[$this->CateID][$this->ID]['start']    = $this->StartDate;
			$_arr[$this->CateID][$this->ID]['end']      = $this->EndDate;
			$_arr[$this->CateID][$this->ID]['due'] 	 = $this->Duration;
			$_arr[$this->CateID][$this->ID]['unit'] 	 = $this->Unit;
			$_arr[$this->CateID][$this->ID]['key'] 	 = $this->KeyPoint;
			$_arr[$this->CateID][$this->ID]['refuse'] 	 = $this->Refuse;
			$_arr[$this->CateID][$this->ID]['consultant'] 	 = $this->ConsultantID;
			$_arr[$this->CateID][$this->ID]['consultant_date'] 	 = $this->ConsultantDate;
			$_arr[$this->CateID][$this->ID]['vma'] 	 = $this->verify_migration_agent;
			$_arr[$this->CateID][$this->ID]['vms'] 	 = $this->verify_migration_status;
			$_arr[$this->CateID][$this->ID]['completed'] 	 = $this->isCompleted;
		}
		return $_arr;
	}
	
	function getCourseByUserV2($course_id=0, $client_id=0){
		$sql = "select a.ID, b.Name, a.IID, b.CateID, d.Qual, e.Major, AppFee, ToUsDate, ToSchoolDate, UserID, AgentID, IsActive, StartDate, EndDate, TFee, Duration, a.QualID, MethodID, a.MajorID, Unit, KeyPoint, Refuse, ConsultantID, ConsultantDate,verify_migration_agent, verify_migration_status, isCompleted 
						from client_course a left join institute b on(a.IID = b.ID) 
							 left join institute_category c on(a.IID = c.ID)
							 left join institute_qual d on(a.QualID = d.ID) 
							 left join institute_major e on(a.MajorID = e.ID) Where 1 
				";
		if ($course_id > 0){
			$sql .= " And a.ID = {$course_id}";
		}
		
		if ($client_id > 0){
			$sql .= " And a.CID = {$client_id}";
		}
		
		$sql .= " Order by IF(IsActive in (0,1), 1, IsActive) asc, StartDate asc";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->ID]['school']   = $this->Name;
			$_arr[$this->ID]['iid']      = $this->IID;
			$_arr[$this->ID]['major']    = $this->MajorID;
			$_arr[$this->ID]['majorname']= $this->Major;
			$_arr[$this->ID]['qual']     = $this->QualID;
			$_arr[$this->ID]['qualname'] = $this->Qual;
			$_arr[$this->ID]['agent']    = $this->AgentID;
			$_arr[$this->ID]['appfee']   = $this->AppFee;
			$_arr[$this->ID]['tusdate']  = $this->ToUsDate;
			$_arr[$this->ID]['tsdate']   = $this->ToSchoolDate;
			$_arr[$this->ID]['method']   = $this->MethodID;
			$_arr[$this->ID]['active']   = $this->IsActive;
			$_arr[$this->ID]['fee']      = $this->TFee;
			$_arr[$this->ID]['start']    = $this->StartDate;
			$_arr[$this->ID]['end']      = $this->EndDate;
			$_arr[$this->ID]['due'] 	 = $this->Duration;
			$_arr[$this->ID]['unit'] 	 = $this->Unit;
			$_arr[$this->ID]['key'] 	 = $this->KeyPoint;
			$_arr[$this->ID]['refuse'] 	 = $this->Refuse;
			$_arr[$this->ID]['cate']     = $this->CateID;
			$_arr[$this->ID]['consultant'] 	 = $this->ConsultantID;
			$_arr[$this->ID]['consultant_date'] 	 = $this->ConsultantDate;	
			$_arr[$this->ID]['vma'] 	 = $this->verify_migration_agent;
			$_arr[$this->ID]['vms'] 	 = $this->verify_migration_status;
			$_arr[$this->ID]['completed'] 	 = $this->isCompleted;		
		}
		return $_arr;
	}

	function getCateIDbyCourse($course_id){
		if($course_id > 0){
			$sql = "select CateID from institute where ID in (select IID from client_course where ID = {$course_id}) ";
			$this->query($sql);
			while ($this->fetch()) {
				return $this->CateID;
			}
		}
		return 0;
	}
	
	
	function delCourseByID($course_id){
		if ($course_id > 0){
			$sql = "Delete from client_course where ID = {$course_id}";
			$this->query($sql);
			
			$sql = "delete from client_course_process where CCID = {$course_id}";
			$this->query($sql);
			
			$sql = "delete from client_course_sem where CCID = {$course_id}";
			$this->query($sql);
			
			$this->delSemProcBySem();
			return true;
		}	
		return false;
	}				

	function setCourseActive($course_id, $active=0){
		$sql = "Update client_course SET IsActive = {$active} where ID = {$course_id}";
		return $this->query($sql);	
	}
		
	function addCourse($user_id, $cid, $sets){
		foreach($sets as &$v){
			$v = addslashes($v);
		}
		
		$sql = "insert into `client_course` (CID, IID, MajorID, QualID, AppFee, ToUsDate, ToSchoolDate, UserID, AgentID, MethodID, StartDate, EndDate, Duration, TFee, IsActive, Refuse, Unit, KeyPoint, ConsultantID, ConsultantDate, verify_migration_agent, verify_migration_status, isCompleted) values ";
		$sql .= "('{$cid}', '{$sets['iid']}', '{$sets['major']}', '{$sets['qual']}', '{$sets['appfee']}', '{$sets['tusdate']}', '{$sets['tsdate']}', '{$user_id}', '{$sets['agent']}',  '{$sets['method']}',  '{$sets['start']}',  '{$sets['end']}',  '{$sets['due']}',  '{$sets['fee']}',  '{$sets['done']}',  '{$sets['refuse']}', '{$sets['unit']}', '{$sets['key']}', '{$sets['consultant']}', '{$sets['consultant_date']}', '{$sets['vma']}', '{$sets['vms']}', '{$sets['completed']}')";
		$this->query($sql);
		return $this->getLastInsertID();
	}
	
	function setCourse($course_id, $sets){
		foreach($sets as &$v){
			$v = addslashes($v);
		}
		$sql = "update client_course SET IID = '{$sets['iid']}', MajorID = '{$sets['major']}', QualID = '{$sets['qual']}', AppFee = '{$sets['appfee']}', ToUsDate = '{$sets['tusdate']}', ToSchoolDate = '{$sets['tsdate']}', AgentID = '{$sets['agent']}', MethodID = '{$sets['method']}', StartDate = '{$sets['start']}', EndDate = '{$sets['end']}', Duration = '{$sets['due']}', TFee = '{$sets['fee']}', IsActive = {$sets['done']}, Refuse = '{$sets['refuse']}', Unit = '{$sets['unit']}', KeyPoint = '{$sets['key']}', ConsultantID = '{$sets['consultant']}', ConsultantDate = '{$sets['consultant_date']}', verify_migration_agent = '{$sets['vma']}', verify_migration_status = '{$sets['vms']}', isCompleted = '{$sets['completed']}' where ID = {$course_id}";
		return $this->query($sql);
	}
	
	function getCourseProcess($course_id, $chase_fee=false){
		$sql = "select ID, CCID, BeginDate, ProcessID, Detail, DueDate, Done, isAuto, ExItem 
				from client_course_process 
				WHERE BeginDate <> '0000-00-00' AND BeginDate <> '' ";
		if ($course_id > 0){
			$sql .= " AND CCID = {$course_id}";
		}
		if (!$chase_fee) {
			$sql .= " AND ExItem NOT LIKE 'Chase tuition on SEM%' ";
		}
		$sql .= " order by BeginDate ASC ";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->ID]['date']    = $this->BeginDate;
			$_arr[$this->ID]['subject'] = $this->ProcessID;
			$_arr[$this->ID]['detail']  = $this->Detail;
			$_arr[$this->ID]['due']     = $this->DueDate;
			$_arr[$this->ID]['auto']    = $this->isAuto;
			$_arr[$this->ID]['done']    = $this->Done;
			$_arr[$this->ID]['add']     = $this->ExItem;
		}

		$sql = "select ID, CCID, BeginDate, ProcessID, Detail, DueDate, Done, isAuto, ExItem 
				from client_course_process 
				WHERE (BeginDate = '' OR BeginDate = '0000-00-00') ";
		if ($course_id > 0){
			$sql .= " AND CCID = {$course_id}";
		}
		if (!$chase_fee) {
			$sql .= " AND ExItem NOT LIKE 'Chase tuition on SEM%' ";
		}
		$this->query($sql);
		while ($this->fetch()){
			$_arr[$this->ID]['date']    = $this->BeginDate;
			$_arr[$this->ID]['subject'] = $this->ProcessID;
			$_arr[$this->ID]['detail']  = $this->Detail;
			$_arr[$this->ID]['due']     = $this->DueDate;
			$_arr[$this->ID]['auto']    = $this->isAuto;
			$_arr[$this->ID]['done']    = $this->Done;
			$_arr[$this->ID]['add']     = $this->ExItem;
		}		
		return $_arr;
	}
	
	function getProcessDateOfCourse($client_id=0,$course_id=0){
		$sql = "select CCID, BeginDate, ProcessID from client_course_process where Done = 1 ";
		if ($course_id > 0){
			$sql .= " And CCID = {$course_id} ";	
		}elseif ($client_id > 0){
				$sql .= " AND CCID in(select ID from client_course where CID = {$client_id}) ";
		}
		$_arr = array();
		$this->query($sql);
		while ($this->fetch()){
			$_arr[$this->CCID][$this->ProcessID] = $this->BeginDate;
		}
		return $_arr;
		
	}
	function getMajorOfCourse(){
		$sql = "select ID, Major from course_major order by Major asc ";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->ID] = $this->Major;
		}
		return $_arr;
	}
	
	function addMajorOfCourse($major){
		$major = addslashes($major);
		$sql = "Insert into course_major (Major) value ('{$major}') ";
		return $this->query($sql);
	}
	
	function delMajorOfCourse($id){
		$sql = "delete from course_major where ID = {$id}";
		return $this->query($sql);
	}
		
		
	function getQualOfCourse(){
		$sql = "select ID, Qual from course_qual order by Qual asc";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->ID] = $this->Qual;
		}
		return $_arr;
	}

	function addMethodOfCourse($method){
		$method = addslashes($method);
		$sql = "Insert into course_method (Method) value ('{$method}') ";
		return $this->query($sql);
	}
	
	function delMethodOfCourse($id){
		$sql = "delete from course_method where ID = {$id}";
		return $this->query($sql);
	}
		
		
	function getMethodOfCourse(){
		$sql = "select ID, Method from course_method order by Method asc";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->ID] = $this->Method;
		}
		return $_arr;
	}
	
	
	function addQualOfCourse($qual){
		$major = addslashes($qual);
		$sql = "Insert into course_qual (Qual) value ('{$qual}') ";
		return $this->query($sql);
	}
	
	function delQualOfCourse($id){
		$sql = "delete from course_qual where ID = {$id}";
		return $this->query($sql);
	}
	
		
	function getProcessOfCourse($isNormal=0){
		$sql = "select ID, Process, isNormal from course_process";
		if ($isNormal > 0){
			$sql .= " where isNormal = {$isNormal}";
			$sql .= " order by rank ";
			$this->query($sql);
			$_arr = array();
			while ($this->fetch()){
				$_arr[$this->ID] = $this->Process;
			}
						
		}else{
			$sql .= " order by rank ";
			$this->query($sql);
			$_arr = array();
			while ($this->fetch()){
				$_arr[$this->ID]['name']   = $this->Process;
				$_arr[$this->ID]['normal'] = $this->isNormal;
			}
		}
		return $_arr;
	}


	function getForwardProcess($item_id) {
		$sql = "SELECT FW_PROCESS FROM course_process where ID = {$item_id} ";
		$this->query($sql);
		$ids = array();
		while ($this->fetch()){
			$ids = explode(',', $this->FW_PROCESS);
		}

		$rtn = array();
		if (count($ids) > 0) {
			$sql = "SELECT ID, PROCESS From course_process WHERE ID IN (".implode(',', $ids).")";
			$this->query($sql);
			while($this->fetch()) {
				$rtn[$this->ID] = $this->PROCESS;
			}
		}
		return $rtn;		
	}
	
	function addProcessOfCourse($process){
		$process = addslashes($process);
		$sql = "Insert into course_process (Process) value ('{$process}') ";
		return $this->query($sql);
	}
	
	function delProcessOfCourse($id){
		$sql = "delete from course_process where ID = {$id}";
		$this->query($sql);
	}
	
	function delCourseProcessByID($pid){
		if ($pid > 0){
			$sql = "delete from client_course_process where ID = {$pid}";
			return $this->query($sql);
		}
		return false;
	}
	
	function checkCourseProcess($courseid, $processid){
		if ($courseid > 0 && $processid > 0){
			$sql = "select count(*) as cnt from client_course_process where CCID = '{$courseid}' and ProcessID = '{$processid}' ";
			$this->query($sql);
			while($this->fetch()){
				return $this->cnt > 0? true : false;	
			}
		}
		return true;
	}
	

	function checkCourseProcessByItem($courseid, $exitem){
		if ($courseid > 0 && $exitem != ''){
			$sql = "select ID, BeginDate, ExItem, Done, DueDate from client_course_process where CCID = '{$courseid}' and ExItem = '{$exitem}' ";
			$this->query($sql);
			$arr = array();
			while($this->fetch()){
				$arr['date'] = $this->BeginDate;
				$arr['done'] = $this->Done;
				$arr['due' ] = $this->DueDate;
				$arr['subject'] = $this->ExItem;
				$arr['id'] = $this->ID;
 			}
 			if (count($arr) > 0)
 				return $arr;
		}
		return false;
	}

	function getMaxCourseProcess($courseid=0){
		if ($courseid > 0){
			$sql = "select max(ProcessID) as id from client_course_process where CCID = {$courseid}";
			$this->query($sql);
			while ($this->fetch()){
				return is_null($this->id)? 0 : $this->id;
			}
		}
		return 0;
	}
	
    function getNextCourseProcessID($pid){
    	//currenct rank
    	$sql = "select rank from course_process where id = {$pid}";
    	$this->query($sql);
    	$rank = 0;
    	$this->fetch();
    	if ($this->rank > 0) {
    		$rank = $this->rank;
    	}
    	
    	$sql = "select id as cpid from course_process where ID <> 7 and rank > {$rank} order by rank asc limit 1";
    	$this->query($sql);
    	if($this->fetch())
    		return $this->cpid; 

    	return 0;
    	/*
    	global $course_process_arr;
    	$course_process[6]
    	if ($pid >= 0){
			$pid += 1;
			if(array_key_exists($pid, $course_process_arr)){
				return $pid;
			}
    	}
    	return 0;
    	*/
    }	


	function getCourseProcessOrder($pid=0,$cid=0){
		$sql = "";
		if($pid > 0){
			$sql = "select OrderID from client_course_process where ID = '{$pid}'";

		}elseif($cid > 0){
			$sql = "select if(Max(OrderID) is null, 0, max(OrderID)) as OrderID from client_course_process where CCID = '{$cid}'";
		}
		$this->query($sql);
		while ($this->fetch()){
			return $this->OrderID;
		}
		return 0;
	}
		

	function resetCourseProcessOrder($cid, $orderid){
		if($cid > 0){
			$sql = "Update client_course_process SET OrderID = OrderID + 1 where CCID = '{$cid}' and OrderID > '{$orderid}' ";
			return $this->query($sql);
		}
	}


	function autoCourseProcess($course_id, $sets, $isNew=0) {
		if ($this->checkCourseProcess($course_id, $sets['subject']) ) {
			return false;
		}

		$sets['isAuto'] = 1;			
		$this->addCourseProcess($course_id, $sets);
	}

	function addCourseProcess($course_id, $sets){
		foreach ($sets as &$v){
			$v = addslashes($v);
		}			
		$sql = "insert into `client_course_process` (CCID, BeginDate, ProcessID, Detail, DueDate, Done, ExItem, isAuto, OrderID) values ('{$course_id}', '{$sets['date']}', '{$sets['subject']}', '{$sets['detail']}', '{$sets['due']}', '{$sets['done']}', '{$sets['add']}', '{$sets['isAuto']}', '{$sets['order']}')";
		return $this->query($sql);
	}	

	function setCourseProcess($pid, $sets, $course_id){
		foreach ($sets as &$v){
			$v = addslashes($v);
		}

		if($pid > 0 || $sets['add'] != ""){
			$sql = "Update client_course_process SET BeginDate = '{$sets['date']}', ProcessID = '{$sets['subject']}', Detail = '{$sets['detail']}', DueDate = '{$sets['due']}', Done = '{$sets['done']}', ExItem = '{$sets['add']}', isAuto = 0 where ID = {$pid}";
			return $this->query($sql);
		} 
	}

	function setCourseProcessDue($pid, $due){
		if (!$pid || !$due)
			return false;
		$sql = "update client_course_process Set DueDate = '{$due}' where id = {$pid}";
		return $this->query($sql);
	}
		
	function delApplyVisaByID($vid){
		if ($vid > 0){
			#visa account
			$sql = "delete from client_account where VisaID = {$vid} and ACC_TYPE = 'visa' ";
			$this->query($sql);

			#visa procesb
			$sql = "delete from client_visa_process where CVID = {$vid}";
			$this->query($sql);

			#visa
			$sql = "delete from client_visa where ID = {$vid}";
			$this->query($sql);
			
			$this->delPaymentByAccount();
			$this->delDependantByVisa();
			return true;
		}
		return false;
	}

	function setAgreementID($vid, $atag){
		if ($vid >= 0 && $atag != "") {
			$sql = "Update client_visa SET ATag = '". addslashes($atag) ."' where ID = '". $vid ."' ";
			return $this->query($sql);
		}
	}
		
	function addApplyVisa($user_id, $cid, $sets){
		foreach ($sets as &$v){
			$v = addslashes($v);
		}
		$sql = "insert into client_visa (CateID, SubClassID, CID, ClientNo, FileNum, CaseDetail, Fax, Name, Tel, Email, AUserID, VUserID, Note, ABody, State, KeyPoint, ADate, AFee, Note2, ExpireDate, VisitDate, r_Status, OnShore, AscoID, CFee, OFee, AgentFee) values ('{$sets['cateid']}', '{$sets['subid']}', '{$cid}', '{$sets['clientno']}', '{$sets['file']}', '{$sets['offdt']}', '{$sets['fax']}', '{$sets['name']}', '{$sets['tel']}', '{$sets['email']}', '{$sets['auser']}', '{$sets['vuser']}', '{$sets['note']}', '{$sets['body']}', '{$sets['state']}', '{$sets['key']}', '{$sets['adate']}', '{$sets['fee']}', '{$sets['note2']}', '{$sets['epdate']}', '{$sets['vdate']}', '{$sets['status']}', '{$sets['shore']}', '{$sets['asco']}', '{$sets['cfee']}', '{$sets['ofee']}', '{$sets['sfee']}')";
		$this->query($sql);
		return $this->getLastInsertID();
	}
	
	function setApplyVisa($vid, $sets){
		foreach ($sets as &$v){
			$v = addslashes($v);
		}
		//LodgeDate = '{$sets['fdate']}', GrantDate = '{$sets['tdate']}', 
		$sql = "Update client_visa SET CateID = '{$sets['cateid']}', SubClassID = '{$sets['subid']}', ClientNo = '{$sets['clientno']}', FileNum = '{$sets['file']}', CaseDetail = '{$sets['offdt']}', Fax = '{$sets['fax']}', Name = '{$sets['name']}', Tel = '{$sets['tel']}', Note = '{$sets['note']}', AUserID = '{$sets['auser']}', VUserID = '{$sets['vuser']}', OnShore = '{$sets['shore']}' , Email = '{$sets['email']}' , ABody = '{$sets['body']}' , State = '{$sets['state']}' , KeyPoint = '{$sets['key']}' , ADate = '{$sets['adate']}' , AFee = '{$sets['fee']}' , Note2 = '{$sets['note2']}', ExpireDate = '{$sets['epdate']}', VisitDate = '{$sets['vdate']}', r_Status = '{$sets['status']}', AscoID = '{$sets['asco']}', CFee = '{$sets['cfee']}', OFee = '{$sets['ofee']}' , AgentFee = '{$sets['sfee']}'  where ID = {$vid}";
		return $this->query($sql);		
	}

	function setApplyVisaStatus($vid, $status) {
		$sql = "Update client_visa SET r_Status = '".addslashes($status)."' where ID = {$vid} ";
		return $this->query($sql);
	}
	
	function getApplyVisa($client_id = 0, $id = 0, $userid = 0){
		$sql = "select ID, VisaName, a.CateID, ClassName, a.SubClassID, ClientNo, FileNum, CaseDetail, Fax, a.Name, Email, Tel, AUserID, VUserID, a.OnShore, Note, Note2, ABody, State, KeyPoint, AFee, ADate, ATag, a.ExpireDate, a.VisitDate, a.r_Status, a.AscoID, CFee, OFee, AgentFee from client_visa a left join visa_category b on(a.CateID = b.CateID) left join visa_subclass c on(a.SubClassID = c.SubClassID) Where 1 ";
		if ($id > 0){
			$sql .= " AND ID = '{$id}'";
		}else{
			if ($client_id > 0){
				$sql .= " AND a.CID = {$client_id}";
			}
			if ($userid > 0 ) {
				$sql .= " AND (a.AUserID = '{$userid}' or a.VUserID = '{$userid}') ";
			}
		}
		$sql .= " ORDER BY IF(ADATE = '0000-00-00', '9999-99-99', ADATE) ASC ";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->ID]['visa']    = $this->VisaName;
			$_arr[$this->ID]['cateid']  = $this->CateID;
			$_arr[$this->ID]['class']   = $this->ClassName;
			$_arr[$this->ID]['classid'] = $this->SubClassID;
			$_arr[$this->ID]['clientno'] = $this->ClientNo;
			$_arr[$this->ID]['file']    = $this->FileNum;
			$_arr[$this->ID]['offdt']   = $this->CaseDetail;
			$_arr[$this->ID]['fax']     = $this->Fax;
			$_arr[$this->ID]['name']    = $this->Name;
			$_arr[$this->ID]['tel']     = $this->Tel;
			$_arr[$this->ID]['email']   = $this->Email;
			$_arr[$this->ID]['note']    = $this->Note;
			$_arr[$this->ID]['shore']   = $this->OnShore;
			$_arr[$this->ID]['auser']   = $this->AUserID;
			$_arr[$this->ID]['vuser']   = $this->VUserID;
			$_arr[$this->ID]['key']     = $this->KeyPoint;
			$_arr[$this->ID]['body']    = $this->ABody;
			$_arr[$this->ID]['state']   = $this->State;
			$_arr[$this->ID]['note2']   = $this->Note2;
			$_arr[$this->ID]['adate']   = $this->ADate;
			$_arr[$this->ID]['fee']     = $this->AFee;
			$_arr[$this->ID]['epdate']  = $this->ExpireDate;
			$_arr[$this->ID]['vdate']   = $this->VisitDate;
			$_arr[$this->ID]['status']  = $this->r_Status;
			$_arr[$this->ID]['asco']    = $this->AscoID;
			$_arr[$this->ID]['atag']    = $this->ATag;
			$_arr[$this->ID]['cfee']    = $this->CFee;			
			$_arr[$this->ID]['ofee']    = $this->OFee;
			$_arr[$this->ID]['sfee']    = $this->AgentFee;			
		}
		return $_arr;
	}		

	function getVisaLodgeGrandProc($cid, $user_id=0){
		if ($cid == 0) {
			return false;
		}
		$sql = "select BeginDate, CVID, b.Item, DueDate from client_visa_process a, visa_rs_item b, client_visa c where a.CVID = c.ID and a.ItemID = b.ItemID and c.CID = '{$cid}' and (b.Item like 'apply%' or b.Item like 'grant%') ";
		if ($user_id > 0) {
			$sql .= " AND (c.AUserID = '{$user_id}' or c.VUserID = '{$user_id}') ";
		}
		$this->query($sql);      
		$_arr = array();
		while ($this->fetch()) {
			
			if (stripos($this->Item, 'apply') !== false) {
				$_arr[$this->CVID]['lodge'] = $this->BeginDate;
			}
			elseif (stripos($this->Item, 'grant') !== false) {
				$_arr[$this->CVID]['grant'] = $this->BeginDate;			
			}
		}
		return $_arr;
	}
	
	function getApplyVisaByDep($userid){
		if($userid > 0){
			$sql = "select a.ID, VisaName, ClassName, a.OnShore, a.CID from client_visa a left join visa_category b on(a.CateID = b.CateID) left join visa_subclass c on(a.SubClassID = c.SubClassID) Where ID in(select CVID from client_visa_dep where UserID = {$userid})";
			$this->query($sql);
			$_arr = array();
			while($this->fetch()){
				$_arr[$this->ID]['visa']  = $this->VisaName;
				$_arr[$this->ID]['class'] = $this->ClassName;
				$_arr[$this->ID]['shore'] = $this->OnShore;
				$_arr[$this->ID]['cid']   = $this->CID;
			}
			return $_arr;
		}	
	}
	
    function getVisaReview($from, $to, $catid, $subid, $user_id, $isOpen){
		    	
        $sql = "select ID, a.CID, concat(LName, ' ', FName) as Name, ADate, ExpireDate 
                from client_visa a, client_info b 
                where a.CID = b.CID and CateID = {$catid} and SubClassID = {$subid} 
                      AND ADate >= '{$from}' and ADate <= '{$to}' and ADate != '' and ADate != '0000-00-00' ";
                      
        if ($isOpen == 1) {
        	$sql .= " AND a.r_Status = 'active'";
        }else{
        	$sql .= " AND a.r_Status <> 'active'";
        }
        
        if ($user_id > 0){
            $sql .= " and a.VUserID = {$user_id}";
        }
               
		$sql .= " Order By Name asc ";
        
        $this->query($sql);
        $_arr = array();
        while ($this->fetch()){
            $_arr[$this->ID]['fdate']   = $this->ADate;
            $_arr[$this->ID]['tdate']   = $this->ExpireDate;
            $_arr[$this->ID]['name']    = $this->Name;
            $_arr[$this->ID]['client']  = $this->CID;
        }
        return $_arr;
    }

    function getVisaReviewNumRows($user_id, $catid, $subid){
        $sql = "select count(*) as cnt from client_visa where CateID = {$catid} and SubClassID = {$subid} ";
        if ($user_id > 0){
            $sql .= " and UserID = {$user_id}";
        }
        $this->query($sql);
        while ($this->fetch()){
            return $this->cnt;
        }
        return 0;
    }    
    
	function getProcessDateByVisa($visa_arr){
		$vstr = "";
		foreach ($visa_arr as $vid => $v){
			$vstr .= "{$vid},";
		}
		$vstr = substr($vstr, 0, strlen($vstr) - 1);
		
		if ($vstr == "") {
			return false;
		}
		$sql = "select BeginDate, CVID, ItemID, DueDate from client_visa_process where CVID in ({$vstr}) order by ItemID asc ";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->CVID][$this->ItemID] = $this->BeginDate=='0000-00-00'? '':$this->BeginDate;
		}
		return $_arr;
	}
	
    function getAccountByVisa($visa_arr){
       	$vstr = "";
		foreach ($visa_arr as $vid => $v){
			$vstr .= "{$vid},";
		}
		$vstr = substr($vstr, 0, strlen($vstr) - 1);
//		$sql = "select VisaID, if(DueDate = '' or DueDate = '0000-00-00', 0, sum(if(DueAmount is null, 0, DueAmount)) / count(*) - Sum(if(b.PaidAmount is null, 0, b.PaidAmount))) as Balance from client_account a left join client_payment b on(a.ID = b.AccountID) where a.VisaID in({$vstr}) Group by a.ID";
		$sql = "select VisaID, if((DueDate = '' or DueDate = '0000-00-00') && (if(DueAmount is null, 0, DueAmount) > 0), 0, if(DueAmount is null, 0, DueAmount) - if(b.PaidAmount is null, 0, b.PaidAmount)) as Balance from client_account a left join (select AccountID, sum(PaidAmount) as PaidAmount from client_payment Group by AccountID) b on(a.ID = b.AccountID) where a.VisaID in({$vstr}) Group by a.ID";
		$this->query($sql);
        $_arr = array();
        while ($this->fetch()){
        	$_arr[$this->VisaID]['balance'] = isset($_arr[$this->VisaID]['balance'])? $_arr[$this->VisaID]['balance'] : 0;
        	$_arr[$this->VisaID]['balance'] += $this->Balance;
        }
        return $_arr;
    }
    
	function getDependantArr($cid){
		if ($cid > 0){
			$sql = "select CID, FName from client_info where Dependant = {$cid} ";
			$this->query($sql);
			$_arr = array();
			while ($this->fetch()){
				$_arr[$this->CID] = $this->FName;
			}
			return $_arr;
		}
		return false;
	}
	
	function delVisaProcess($pid){
		if($pid > 0){
			$sql = "delete from client_visa_process where ID = {$pid}";
			return $this->query($sql);
		}
		return false;
	}
	
	function endVisaProcess($pid){
		if ($pid > 0){
			$sql = "Update client_visa_process SET Done = 1 where ID = {$pid}";
			return $this->query($sql);
		}
		return false;
	}
	
	function setVisaProcess($pid, $sets){
		foreach ($sets as &$v){
			$v = addslashes($v);
		}
		$sets['subject'] = $sets['add'] != ""? 0 : $sets['subject'];
		$sql = "Update client_visa_process SET BeginDate = '{$sets['date']}', ItemID = '{$sets['subject']}', Detail = '{$sets['detail']}', DueDate = '{$sets['due']}', ExItem = '{$sets['add']}', Done = '{$sets['done']}' where ID = {$pid}";
		return $this->query($sql); 
	}
	
	function checkVisaProcess($vid, $itemid){
		if ($itemid > 0){
			$sql = "select ID from client_visa_process where CVID = '{$vid}' and ItemID = '{$itemid}' ";
			$this->query($sql);
			while ($this->fetch()){
				if ($this->ID > 0){
					return true;
				}
			}
		}
		return false;
	}

	function checkVisaStatusInProcess($vid, $status, $grant_item) {
		$sql = "SELECT ID FROM client_visa_process WHERE CVID = '{$vid}' and (ExItem IN ('".implode("','", $status)."') or (ItemID = '{$grant_item}' AND ExItem = ''))";
		//var_dump($sql);exit;
		$this->query($sql);
		$this->fetch();
		if ($this->ID > 0)
			return true;

		return false;

	}
	
	function getVisaProcessOrder($pid=0,$vid=0){
		$sql = "";
		if($pid > 0){
			$sql = "select OrderID from client_visa_process where ID = '{$pid}'";

		}elseif($vid > 0){
			$sql = "select if(Max(OrderID) is null, 0, max(OrderID)) as OrderID from client_visa_process where CVID = '{$vid}'";
		}
		$this->query($sql);
		while ($this->fetch()){
			return $this->OrderID;
		}
		return 0;
	}
	

	function resetVisaProcessOrder($vid, $orderid){
		if($vid > 0){
			$sql = "Update client_visa_process SET OrderID = OrderID + 1 where CVID = '{$vid}' and OrderID > '{$orderid}' ";
			return $this->query($sql);
		}
	}
	
	function addVisaProcess($vid, $sets){
		foreach ($sets as &$v){
			$v = addslashes($v);
		}
		$sets['subject'] = $sets['add'] != ""? 0 : $sets['subject'];
		$sql = "insert into `client_visa_process` (CVID, BeginDate, ItemID, Detail, DueDate, Done, ExItem, OrderID) values ({$vid}, '{$sets['date']}', '{$sets['subject']}', '{$sets['detail']}', '{$sets['due']}', '{$sets['done']}', '{$sets['add']}', '{$sets['order']}')"; 
		$this->query($sql); 
		return $this->getLastInsertID();
	}
	
	function getMaxVisaProcess($visaid){
		if ($visaid > 0){
			$sql = "select max(ItemID) as id from client_visa_process where CVID = {$visaid} and Done = 1";
			$this->query($sql);
			while ($this->fetch()){
				return is_null($this->id)? 0 : $this->id;
			}
		}
		return 0;
	}
	
	function autoVisaProcess($visa_id, $process_id, $steps=array()){
		if(!is_array($steps) || count($steps) == 0)
			return false;

		$sql = "SELECT AUTOSTEP FROM client_visa where id = {$visa_id}";
		$this->query($sql);
		$this->fetch();
		if (!$this->AUTOSTEP)
			return false;
		
		$sql = "SELECT ITEMID, DONE FROM client_visa_process where CVID = {$visa_id} AND ITEMID > 0";
		$this->query($sql);
		while ($this->fetch()) {
			if ($this->DONE == 0)
				return false;

			unset($steps[$this->ITEMID]);
		}


		if (count($steps) == 0)
			return false;

		list($sets['subject'], ) = each($steps);
		$sets['order'] = $this->getVisaProcessOrder($process_id, $visa_id);
		$sets['done']   = 0;
		$sets['detail'] = "";
		$sets['due']    = "0000-00-00";//date("Y-m-d");
		$sets['date']   = "0000-00-00";//date("Y-m-d");
		$sets['add']    = "";
		$sets['isAuot'] = 1;
		return $this->addVisaProcess($visa_id, $sets);
	}	
	
	
	function getVisaProcess($vid){
		$sql = "select ID, CVID, BeginDate, a.ItemID, b.Item, Detail, DueDate, Done, ExItem, OrderID from client_visa_process a left join visa_rs_item b on(a.ItemID = b.ItemID)";
		if ($vid > 0){
			$sql .= " Where CVID = {$vid}";
		}
		$sql .= " AND BeginDate <> '0000-00-00' AND BeginDate is NOT NULL order by BeginDate asc ";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->ID]['date']    = $this->BeginDate == '0000-00-00'? '': $this->BeginDate;
			$_arr[$this->ID]['itemid']  = $this->ItemID;
			$_arr[$this->ID]['subject'] = $this->ItemID == 0? $this->ExItem : $this->Item;
			$_arr[$this->ID]['detail']  = $this->Detail;
			$_arr[$this->ID]['due']     = $this->DueDate == '0000-00-00'? '':$this->DueDate;
			$_arr[$this->ID]['done']    = $this->Done;
			$_arr[$this->ID]['add']     = $this->ExItem;
		}

		$sql = "select ID, CVID, BeginDate, a.ItemID, b.Item, Detail, DueDate, Done, ExItem, OrderID from client_visa_process a left join visa_rs_item b on(a.ItemID = b.ItemID)";
		if ($vid > 0){
			$sql .= " Where CVID = {$vid}";
		}
		$sql .= " AND (BeginDate = '0000-00-00' or BeginDate is NULL) ";
		$this->query($sql);
		while ($this->fetch()){
			$_arr[$this->ID]['date']    = $this->BeginDate == '0000-00-00'? '': $this->BeginDate;
			$_arr[$this->ID]['itemid']  = $this->ItemID;
			$_arr[$this->ID]['subject'] = $this->ItemID == 0? $this->ExItem : $this->Item;
			$_arr[$this->ID]['detail']  = $this->Detail;
			$_arr[$this->ID]['due']     = $this->DueDate == '0000-00-00'? '':$this->DueDate;
			$_arr[$this->ID]['done']    = $this->Done;
			$_arr[$this->ID]['add']     = $this->ExItem;
		}		
		return $_arr;
	}
	
	function getVisaRsID($vid){
		if ($vid > 0){
			$sql = "select CateID, SubClassID, ADate, ExpireDate from client_visa where ID = {$vid}";
			$this->query($sql);
			$_arr = array();
			while($this->fetch()){
				$_arr['visa']  = $this->CateID;
				$_arr['class'] = $this->SubClassID;
				$_arr['adate'] = $this->ADate;
				$_arr['epd']   = $this->ExpireDate;
				$_arr['vid']   = $vid;
			}
			return $_arr;
		}
		return false;
	}
    
    
    function delAccountByID($aid){
        if ($aid > 0){
            $sql = "delete from client_account where ID = {$aid}";
            return $this->query($sql);
        }
        return false;
    }

    function addAccount($user_id, $vid, $sets, $typ){
        foreach ($sets as &$v){
        	$v = addslashes($v);
        }
        $sql = "insert into client_account (VisaID, DueAmount, Note, Step, UserID, DueDate, GST, PARTY_3RD, AMOUNT_3RD, GST_3RD, ACC_TYPE) values ('{$vid}', '{$sets['dueamt']}', '{$sets['note']}', '{$sets['step']}', '{$user_id}', '{$sets['duedate']}','{$sets['gst']}','{$sets['party']}','{$sets['dueamt_3rd']}','{$sets['gst_3rd']}','{$typ}')";
        return $this->query($sql);      
    }               

   
    function setAccount($aid, $sets){
        foreach ($sets as &$v){
        	$v = addslashes($v);
        }
        $sql = "Update client_account SET DueDate = '{$sets['duedate']}', DueAmount = '{$sets['dueamt']}', Step = '{$sets['step']}', Note = '{$sets['note']}', GST = '{$sets['gst']}', PARTY_3RD = '{$sets['party']}',  AMOUNT_3RD = '{$sets['dueamt_3rd']}', GST_3RD = '{$sets['gst_3rd']}' where ID = {$aid}";
        return $this->query($sql);      
    }
    
    
    function getAccount($visa_id = 0, $account_id = 0, $account_typ='visa'){
        $sql = "select a.ID, VisaID, DueAmount, Note, Step, UserID, DueDate, GST, PARTY_3RD, AMOUNT_3RD, GST_3RD, Sum(if(b.PaidAmount is null, 0, b.PaidAmount)) as paid, ACC_TYPE from client_account a left join client_payment b on(a.ID = b.AccountID) Where 1 ";
        if ($account_id > 0){
        	$sql .= " AND a.ID = '{$account_id}' ";
        }else{
	        if ($visa_id > 0){
	        	$sql .= " And VisaID = '{$visa_id}' ";
	        }

	        if ($account_typ != "") {
	        	$sql .= " AND ACC_TYPE = '{$account_typ}' ";
	        }
        }


        $sql .= " Group by a.ID Order by Step";
	    $this->query($sql);
        $_arr = array();
        while ($this->fetch()){
            $_arr[$this->ID]['dueamt']  = $this->DueAmount;
            $_arr[$this->ID]['step']    = $this->Step;
            $_arr[$this->ID]['duedate'] = $this->DueDate;
            $_arr[$this->ID]['paid']    = $this->paid;
            $_arr[$this->ID]['note']    = $this->Note;
            $_arr[$this->ID]['gst']     = $this->GST == 1? $this->DueAmount/11 : 0;
            $_arr[$this->ID]['party']    = $this->PARTY_3RD;
            $_arr[$this->ID]['gst_3rd']    = $this->GST_3RD == 1? $this->AMOUNT_3RD/11 : 0;
            $_arr[$this->ID]['dueamt_3rd']    = $this->AMOUNT_3RD;
            $_arr[$this->ID]['spand']    = 0;
            $_arr[$this->ID]['gst_chk']     = $this->GST;
            $_arr[$this->ID]['gst_3rd_chk'] = $this->GST_3RD;
            $_arr[$this->ID]['type'] = $this->ACC_TYPE;
            $_arr[$this->ID]['objid'] = $this->VisaID;
        }

		$sql = "select a.ID, sum(if(c.PaidAmount is null, 0, c.PaidAmount)) as spand from client_account a left join client_spand c on (a.ID = c.AccountID) Where 1 ";
        if ($account_id > 0){
        	$sql .= " AND a.ID = '{$account_id}'";
        }
        else{
	        if ($visa_id > 0){
	        	$sql .= " And VisaID = '{$visa_id}'";
	        }
        }

        if ($account_typ != "") {
        	$sql .= " AND ACC_TYPE = '{$account_typ}' ";
        }

        $sql .= " Group by a.ID ";
	    $this->query($sql);
        while ($this->fetch()){
            $_arr[$this->ID]['spand']    = $this->spand;
        }       
   
        return $_arr;
    }
    
    function checkVisaAmont($visa_id){
    	if(!($visa_id > 0)){
    		return false;
    	}

    	//check agreement payments
		$sql = "select Sum(DueAmount) as totalpay, Sum(b.paid) as paid 
				from client_account a left join  (select AccountID, SUM(PaidAmount) as paid from client_payment Group by AccountID) b on (a.ID = b.AccountID)
				Where VisaID = {$visa_id} and ACC_TYPE = 'visa' ";    	
	    $this->query($sql);
       if($this->fetch() && ($this->totalpay - $this->paid) == 0){
       		return true;
       }
       return false;
    }
    
	function getPayment($aid){
		if ($aid > 0){
			$sql = "select ID, PaidAmount, PaidDate, Remark from client_payment where AccountID = '{$aid}' ";
			$this->query($sql);
			$_arr = array();
			while ($this->fetch()){
				$_arr[$this->ID]['date'] = $this->PaidDate;
				$_arr[$this->ID]['paid'] = $this->PaidAmount;
				$_arr[$this->ID]['remark'] = $this->Remark;
			}
			return $_arr;
		}	
	}
	
	function setPayment($pid, $sets){
		if ($pid > 0){
			foreach($sets as &$v){
				$v = addslashes($v);
			}
			$sql = "Update client_payment SET PaidDate = '{$sets['date']}', PaidAmount = '{$sets['paid']}', Remark = '{$sets['remark']}' where ID = '{$pid}'";
			return $this->query($sql);
		}
	}
	
	function addPayment($aid, $sets){
		if ($aid > 0){
			foreach($sets as &$v){
				$v = addslashes($v);
			}
			$sql = "insert into client_payment (AccountID, PaidDate, PaidAmount, Remark) values ('{$aid}', '{$sets['date']}', '{$sets['paid']}', '{$sets['remark']}')";
			$this->query($sql);
			return $this->getLastInsertID();
		}
		return false;
	}
	
	function delPayment($pid){
		if($pid > 0){
			$sql = "delete from client_payment where ID = '{$pid}' ";
			return $this->query($sql);
		}
	}

	function getSpand($aid){
		if ($aid > 0){
			$sql = "select ID, PaidAmount, PaidDate from client_spand where AccountID = '{$aid}' ";
			$this->query($sql);
			$_arr = array();
			while ($this->fetch()){
				$_arr[$this->ID]['date'] = $this->PaidDate;
				$_arr[$this->ID]['paid'] = $this->PaidAmount;
			}
			return $_arr;
		}	
	}
	
	function setSpand($pid, $sets){
		if ($pid > 0){
			foreach($sets as &$v){
				$v = addslashes($v);
			}
			$sql = "Update client_spand SET PaidDate = '{$sets['date']}', PaidAmount = '{$sets['paid']}' where ID = '{$pid}'";
			return $this->query($sql);
		}
	}
	
	function addSpand($aid, $sets){
		if ($aid > 0){
			foreach($sets as &$v){
				$v = addslashes($v);
			}
			$sql = "insert into client_spand (AccountID, PaidDate, PaidAmount) values ('{$aid}', '{$sets['date']}', '{$sets['paid']}')";
			return $this->query($sql);
		}
	}
	
	function delSpand($pid){
		if($pid > 0){
			$sql = "delete from client_spand where ID = '{$pid}' ";
			return $this->query($sql);
		}
	}	
		
    function delCourseSem($sid){
        if ($sid > 0){
            $sql = "delete from client_course_sem where ID = {$sid}";
            return $this->query($sql);
        }
        return false;
    }
    
    
    function setCourseSem($sid, $is_adv, $sems){
        foreach ($sems as &$v){
        	$v = addslashes($v);
        }
        $sql = "Update client_course_sem SET TFee = {$sems['fee']}, StartDate = '{$sems['fdate']}', FinishDate = '{$sems['tdate']}', Duration = '{$sems['due']}' , IsActive = '{$sems['done']}', Refuse = '{$sems['refuse']}' ";
        if ($is_adv){
            $sql .= ", RComm = '{$sems['rcomm']}', InvoicDate = '{$sems['ivdate']}', RedComm = '{$sems['redcomm']}', RedDate = '{$sems['reddate']}', CoDate = '{$sems['cdate']}', CoComm = '{$sems['ccomm']}', Duration = '{$sems['due']}', Discount = '{$sems['discount']}', NotifyDate = '{$sems['nfdate']}', DiscountDate = '{$sems['discountdate']}', G_Invoice = '{$sems['ginvo']}', CoComm_Invo_DATE = '{$sems['coidate']}', SUBA_Invoice = '{$sems['subainvo']}' ";
        }
        $sql .= " where ID = {$sid} ";
        return $this->query($sql); 
    }
    
    function getCourseSemOrder($semid){
    	if ($semid > 0) {
    		$sql = "select SEM from client_course_sem where ID = {$semid}";
    		$this->query($sql);
    		if ($this->fetch() && $this->SEM > 0) {
    			return $this->SEM;
    		}
    	}
    	return 0;
    }
    
    function setSem1Date($courseid, $date){
    	if ($courseid > 0 && $date != "") {
    		$date = addslashes($date);
    		$sql = "Update client_course SET Sem1Date = '{$date}' where ID = {$courseid} ";
    		return $this->query($sql);
    	}
    }
    
    function addCourseSem($course_id){
        $order = 0;
    	# get max sem order
    	$sql = "select max(SEM) as SemOrder from client_course_sem where CCID = {$course_id}";
    	$this->query($sql);
    	while ($this->fetch()){
    		$order = $this->SemOrder;
    	}
    	$order++;
    	
    	# add new semster
    	$sql = "insert into client_course_sem (SEM, CCID) values ({$order}, {$course_id}) ";
    	$this->query($sql);
    	return $this->getLastInsertID();
    }                       			

	
    function getCourseSem($course_id){
        $_arr = array();
        if ($course_id > 0){
	        $sql = "select ID, CCID, SEM, TFee, Discount, StartDate, FinishDate, RComm, InvoicDate, Duration, CoComm, CoDate, RedDate, RedComm, Refuse, IsActive, NotifyDate, DiscountDate, G_Invoice, CoComm_Invo_DATE, SUBA_Invoice from client_course_sem ";
	        
	            $sql .= " Where CCID = {$course_id}";
	   
	        $sql .= " order by SEM asc";
	        $this->query($sql);
	      
	        while ($this->fetch()){
	            $_arr[$this->ID]['sem']    = $this->SEM;
	            $_arr[$this->ID]['fee']    = $this->TFee;
	            $_arr[$this->ID]['fdate']  = $this->StartDate;
	            $_arr[$this->ID]['tdate']  = $this->FinishDate;
	            $_arr[$this->ID]['rcomm']  = $this->RComm;
	            $_arr[$this->ID]['ivdate'] = $this->InvoicDate;
	            $_arr[$this->ID]['reddate'] = $this->RedDate;
	            $_arr[$this->ID]['cdate']   = $this->CoDate;
	            $_arr[$this->ID]['redcomm'] = $this->RedComm;
	            $_arr[$this->ID]['ccomm']   = $this->CoComm;
	            $_arr[$this->ID]['due']     = $this->Duration;
	            $_arr[$this->ID]['refuse']  = $this->Refuse;
	            $_arr[$this->ID]['active']  = $this->IsActive;
	            $_arr[$this->ID]['discount']  = $this->Discount;
                $_arr[$this->ID]['nfdate']  = $this->NotifyDate;
                $_arr[$this->ID]['discountdate']  = $this->DiscountDate;
	            $_arr[$this->ID]['ginvo']  = $this->G_Invoice;
                $_arr[$this->ID]['coidate']  = $this->CoComm_Invo_DATE;
                $_arr[$this->ID]['subainvo']  = $this->SUBA_Invoice;


	        }
        }
        return $_arr;
    }
    

    function auditSemStartDate($course_id, $semid, $startDate){
        $semorder = $this->getCourseSemOrder($semid);
    	if ($course_id > 0 && $semorder > 0){
    		$sql = "select StartDate from client_course_sem where CCID = '{$course_id}' and SEM < '{$semorder}' order by SEM desc limit 1";
            $this->query($sql);
            while ($this->fetch()){
            	return $startDate > $this->StartDate? true : false;
            }
    	}
        return true;
    }

    function getSemByCourse($client_id = 0){
        $sql = "select ID, CCID, SEM, TFee, StartDate, FinishDate, RComm, InvoicDate, Duration, CoComm, RedComm, RedDate, CoDate, Discount, DiscountDate, IsActive from client_course_sem ";
        if ($client_id > 0){
        		$sql .= " where CCID in(select ID from client_course where CID = {$client_id}) ";
        }
        $sql .= " order by SEM asc";
        $this->query($sql);
        $_arr = array();
        while ($this->fetch()){
            $_arr[$this->CCID][$this->ID]['sem']    = $this->SEM;
            $_arr[$this->CCID][$this->ID]['fee']    = $this->TFee;
            $_arr[$this->CCID][$this->ID]['fdate']  = $this->StartDate;
            $_arr[$this->CCID][$this->ID]['tdate']  = $this->FinishDate;
            $_arr[$this->CCID][$this->ID]['rcomm']  = $this->RComm;
            $_arr[$this->CCID][$this->ID]['redcomm']= $this->RedComm;
            $_arr[$this->CCID][$this->ID]['reddate']= $this->RedDate;
            $_arr[$this->CCID][$this->ID]['cdate']  = $this->CoDate;
            $_arr[$this->CCID][$this->ID]['ivdate'] = $this->InvoicDate;
            $_arr[$this->CCID][$this->ID]['ccomm']  = $this->CoComm;
            $_arr[$this->CCID][$this->ID]['due']    = $this->Duration;
            $_arr[$this->CCID][$this->ID]['discount']    = $this->Discount;
            $_arr[$this->CCID][$this->ID]['discountdate']    = $this->DiscountDate;
         	$_arr[$this->CCID][$this->ID]['done']    = $this->IsActive;
               
        }
        return $_arr;
    }
    
    function isGetCOEByCourse($course_id){
    	if ($course_id > 0) {
    		$sql = "select ID from client_course_process where CCID = '{$course_id}' and Done = 1 and ProcessID =".__C_GET_COE;
    		$this->query($sql);
			while ($this->fetch()){
				return $this->ID;
			}
    	}
    	return 0;
    }
    
    function getSemNumByCourse($course_id){
		if ($course_id > 0){
    		$sql = "select count(*) as cnt from client_course_sem where CCID = '{$course_id}' ";
			$this->query($sql);
			while ($this->fetch()){
				return $this->cnt;
			}
		}
		return  0;
    }
    
    function setCourseConsult($cid, $cuser, $first){
    	if($cid > 0 && $cuser > 0){
    		$sql = "Update client_info SET CourseUser = '{$cuser}', CourseVisitDate = '{$first}' where CID = {$cid}";
    		return $this->query($sql);
    	}
    }
    
    function setVisaVisitDate($cid, $first){
    	if($cid > 0){
    		$sql = "Update client_info SET VisaVisitDate = '{$first}' where CID = {$cid} ";
    		return $this->query($sql);
    	}
    }
    
    
    function getCourseConsult($course_id){
    	if($course_id > 0){
    		$sql = "select ConsultantID from client_course where ID = '{$course_id}'";
    		$this->query($sql);
    		while ($this->fetch()){
    			return $this->ConsultantID;
    		}
    		return 0;
    	}
    }

    function getCourseConsultBySem($sem_id){
    	if($sem_id > 0){
    		$sql = "select ConsultantID from client_course a, client_course_sem b where a.id = b.CCID and b.ID = '{$sem_id}'";
    		$this->query($sql);
    		while ($this->fetch()){
    			return $this->ConsultantID;
    		}
    		return 0;
    	}
    }
        
    function getUngertListOfVisa($page=1, $page_size=50, $user_id=0, $preday=7){
    	$sql = "select LName, FName, VisaName, ClassName, Item, DueDate from client_visa_process a 
						left join client_visa  b on(a.CVID = b.ID) 
						left join visa_rs_item c on(a.ItemID = c.ItemID)
						left join visa_category d on(c.CateID = d.CateID)
						left join visa_subclass e on(c.SubClassID = e.SubClassID)
						left join client_info f on(b.CID = f.CID) 
				where a.DueDate >= NOW() and a.DueDate < NOW() + INTERVAL {$preday} Day and a.Done = 0 ";
    	if ($user_id > 0){
    		$sql .= " AND b.UserID = {$user_id}";
    	}
    	$sql .= "Limit " . ($page - 1) * $page_size . ", ". $page_size;
    	$this->query($sql);
    	$_arr = array();
    }	

    
	function getCountry(){
		$sql = "select ID, Country from country order by Country asc";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->ID] = $this->Country;
		}
		return $_arr;
	}

	function getCountryZH() {
		$sql = "select ID, Country, ZH_NAME from country order by Country asc";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->ID]['en'] = $this->Country;
			$_arr[$this->ID]['zh'] = $this->ZH_NAME;
		}
		return $_arr;		
	}
	
	function addCountry($country, $zh='',$id=0){
		$country = addslashes($country);
		$zh = addslashes($zh);
		
		if ($id > 0){
			$sql = "update country SET country = '{$country}', zh_name = '{$zh}' where id = {$id}";
		}
		else {
			$sql = "insert into country (Country, ZH_NAME) values ('{$country}', '{$zh}')";
		}
		return $this->query($sql);
	}			


	function delCountry($id){
		if ($id > 0){
			$sql = "delete from country where ID = {$id}";
			return $this->query($sql);
		}
	}
	
	function getSchool($countryID=0){
		$_arr = array();
		$sql = "select ID, School from school ";
		if ($countryID > 0){
			$sql .= "where CountryID = '{$countryID}' ";
		}
		$sql .= "order by School asc"; 
		$this->query($sql);
		while ($this->fetch()){
			$_arr[$this->ID] = $this->School;
		}
		return $_arr;
	}
	
	function addSchool($name, $countryID){
		$name = addslashes($name);
		$sql = "insert into school (School, CountryID) values ('{$name}', '{$countryID}')";
		return $this->query($sql);
	}			

	function delSchool($id){
		if ($id > 0){
			$sql = "delete from school where ID = {$id}";
			return $this->query($sql);
		}
	}	
	
	function getDependantClientInfo($page, $page_size, $vid = 0, $user_id=0, $col_f="", $col_v="", $from="", $to="", $cid=0){
		$sql = " select a.CID, a.LName, a.FName, a.DoB, a.Gender, a.Email, if(b.DepID is null, 0, b.DepID) as DepID from client_info a left join client_visa_dep b on(a.CID = b.DepID and b.CVID = {$vid}) where CID != {$cid} ";
		
		if ($user_id > 0){
			$sql .= " AND CID in (select distinct CID from client_user where UID = {$user_id} and CID != {$cid}) ";
		}
		
		if($col_f != "" && $col_v != ""){
			$sql .= " AND {$col_f} like '{$col_v}%' ";
		}
		
		if ($from != "" && $to != ""){
			$sql .= " AND CreateTime >= '{$from}' AND CreateTime <= '{$to}' ";
		}
		
		$sql .= " Order by DepID desc, CreateTime asc, LName asc Limit " . ($page - 1)* $page_size . ", " . $page_size;
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()) {
			$_arr[$this->CID]['lname'] 	= $this->LName;
			$_arr[$this->CID]['fname'] 	= $this->FName;
			$_arr[$this->CID]['gender'] = $this->Gender;
			$_arr[$this->CID]['dob'] 	= $this->DoB;
			$_arr[$this->CID]['email'] 	= $this->Email;
			$_arr[$this->CID]['depid'] 	= $this->DepID;
		}
		return $_arr;
	}
	
	
	function delDependant($vid, $uid){
		if ($vid > 0 && $uid > 0){
			$sql = "delete from client_visa_dep where CVID = {$vid} and DepID = {$uid}";
			return $this->query($sql);		
		}
	}
	
	function setDependant($vid, $deparr){
    	if($vid > 0 && is_array($deparr) && count($deparr) > 0){
   			foreach($deparr as $id){
    			if($id != $cid){
    				$sql = "insert into client_visa_dep (CVID, DepID) values ({$vid}, {$id}) ON DUPLICATE KEY UPDATE ExpireDate = ExpireDate ";
    				$this->query($sql);
    			}		
    		}
    	}		
	}

	function setDependantExpireDate($vid, $deps){
		if($vid > 0 && is_array($deps) && count($deps) > 0)	{
			foreach ($deps as $depid => $date){
				$sql = "UPdate client_visa_dep SET ExpireDate = '{$date}' where DepID = {$depid} and CVID = {$vid}";
				$this->query($sql);
			}
		}
	}
	
	function getDependantByVisa($vid){
		$_arr = array();
		if ($vid > 0) {
			$sql = "select DepID, concat(b.LName, ' ', b.FName) as Name, ExpireDate from client_visa_dep a, client_info b where a.DepID = b.CID and a.CVID = {$vid} ";
			$this->query($sql);
			while ($this->fetch()) {
				$_arr[$this->DepID]['name'] = $this->Name;
				$_arr[$this->DepID]['expdate'] = $this->ExpireDate;
			}
		}
		return $_arr;
	}
	
    function finishProcessofCourse($courseid=0){
    	if ($courseid > 0){
			$sql = "Update client_course_process SET Done = 1 where CCID = {$courseid}";
			$this->query($sql);

			$sql = "DELETE FROM client_course_process where CCID = {$courseid} AND done = 0";
			return $this->query($sql);
    	}
    }
    
    function autoService($epdate, $item, $client_id, $catid=0, $subclassid=0, $isOpen=0){
    	if($catid == 0 || $client_id == "" || $item == ""){//$subclassid == 0 
    		return false;
    	}
    	$serviceid = 0;
    	#check existed service
    	$sql = "select ID from client_service where CID = '{$client_id}' and VisaCateID = '{$catid}' and VisaSubClassID = '{$subclassid}' and isOpen = {$isOpen}";
    	$this->query($sql);
    	while ($this->fetch()){
			$serviceid = $this->ID;
    	}
		
    	if($serviceid > 0){
    		$sql = "Update client_service SET DueDate = '{$epdate}'- Interval 30 Day , VisaCateID = '{$catid}' , VisaSubClassID = '{$subclassid}', Subject = '{$item}', isOpen = {$isOpen} where ID = {$serviceid}";
	    }else{
	    	$sql = "insert into `client_service`(CID, Date, Subject, DueDate, Done, VisaCateID, VisaSubClassID, isOpen) values ('{$client_id}', Date(Now()), '{$item}', '{$epdate}'- Interval 30 Day, 0, '{$catid}', '{$subclassid}', {$isOpen})";
	    }
	    return $this->query($sql);
    }
    

    function autoDobService($client_id, $user_id){
    	if($client_id == "" || $user_id == ""){//$subclassid == 0 
    		return false;
    	}

    	//get DOB
    	$sql = "select DoB from client_info where CID = {$client_id}";
    	$this->query($sql);
    	$this->fetch();
    	if ($this->DoB == "")
    		return false;

    	$upds = array();
    	$date = preg_replace('/^[\d]+-(.*)$/',date('Y').'-$1', $this->DoB);
    	if (date('Y-m-d', strtotime('+1 month')) < $date) {
    		$upds[$date] = "Birthday mention at {$date}";
    	}

    	$date = date('Y-m-d', strtotime('+1 year', strtotime($date)));
    	$upds[$date] = "Birthday mention at {$date}"; 

    	foreach ($upds as $date => $subject) {
	    	$serviceid = 0;
	    	#check existed service
	    	$sql = "select ID from client_service where CID = '{$client_id}' and ConsultantID = '{$user_id}' and subject = '{$subject}'";
	    	$this->query($sql);
	    	while ($this->fetch()){
				$serviceid = $this->ID;
	    	}
			
	    	if($serviceid == 0){
		    	$sql = "insert into `client_service`(CID, Date, Subject, DueDate, Done, ConsultantID) values ('{$client_id}', Date(Now()), '{$subject}', '{$date}'- Interval 30 Day, 0, {$user_id})";
		    	//echo $sql;
		    	$this->query($sql);

		    }
		    
	    }
    }

    function getIetls($client_id=0){
    	if ($client_id > 0){
    		$sql = "select `Mod`, TestDate, PlanDate, Overall, Listening, Reading, Writing, Speaking from client_ielts where CID = {$client_id}";
    		$this->query($sql);
    		$_arr = array();
    		while ($this->fetch()){
    			$_arr['mod'] = $this->Mod;
    			$_arr['testday'] = $this->TestDate;
    			$_arr['planday'] = $this->PlanDate;
    			$_arr['overall'] = $this->Overall;
    			$_arr['listen']  = $this->Listening;
    			$_arr['read']    = $this->Reading;
    			$_arr['write']   = $this->Writing;
    			$_arr['speak']   = $this->Speaking;
    		}
    		return $_arr;
    	}
    }
    
    function addIetls($client_id, $sets){
    	if ($client_id > 0){
    		foreach ($sets as &$v){
    			$v = addslashes($v);
    		}
    		$sql = "insert into `client_ielts` (CID, `Mod`, TestDate, PlanDate, Overall, Listening, Reading, Writing, Speaking) values ('{$client_id}', '{$sets['mod']}', '{$sets['testday']}', '{$sets['planday']}', '{$sets['overall']}', '{$sets['listen']}', '{$sets['read']}', '{$sets['write']}', '{$sets['speak']}')";
    		return $this->query($sql);
    	}
    }
    
    function setIetls($client_id, $sets){
     	if ($client_id > 0){
    		foreach ($sets as &$v){
    			$v = addslashes($v);
    		}
    		$sql = "update client_ielts SET TestDate = '{$sets['testday']}', PlanDate = '{$sets['planday']}', Overall = '{$sets['overall']}', Listening = '{$sets['listen']}', Reading = '{$sets['read']}', Writing = '{$sets['write']}', Speaking = '{$sets['speak']}' where CID = {$client_id}";
     		return $this->query($sql);
     	}   	
    }
    
    function checkIetls($client_id){
    	if($client_id > 0){
    		$sql = "select CID from client_ielts where CID = {$client_id}";
    		$this->query($sql);
    		while ($this->fetch()){
    			return $this->CID > 0? true : false;
    		}
    	}
    	return false;
    }
    
    function delIetls($client_id){
    	if($client_id > 0){
    		$sql = "delete from client_ielts where CID = '{$client_id}' ";
    		return $this->query($sql);
    	}
    }
    
	function getSemProcess($semid){
		$sql = "select ID, SemID, BeginDate, Subject, Detail, DueDate, Done, OrderID  from client_course_sem_process ";
		if ($semid > 0){
			$sql .= " Where SemID = {$semid}";
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
	
	function checkSemProcess($semid, $key){
		if ($semid > 0 && $key != "") {
			$key = addslashes($key);
			$sql = "select ID from client_course_sem_process where SemID = {$semid} and KeyPoint Regexp '^{$key}' ";
			$this->query($sql);
			if ($this->fetch() && $this->ID > 0) {
				return $this->ID;				
			}				
		}
		return 0;	
	}
	
	function changeSemProcess($pid, $key, $detail){
		if ($pid > 0 && $key != "" && $detail != "") {
			$detail = addslashes($detail);
			$sql = "Update client_course_sem_process SET Detail = concat(Detail, ' ', '{$detail}'), KeyPoint = '{$key}' where ID = {$pid}";
			return $this->query($sql);							
		}
		return false;		
	}

	function doneSemProcess($pid, $key, $done){
		if ($pid > 0 && $key != "") {
			$key = addslashes($key);
			$sql = "Update client_course_sem_process SET KeyPoint = '{$key}', Done = {$done} where ID = {$pid}";
			return $this->query($sql);							
		}
		return false;		
	}
		
	function addSemProcess($semid, $sets){
		foreach ($sets as &$v){
			$v = addslashes($v);
		}					
		$sql = "insert into `client_course_sem_process` (SemID, BeginDate, Subject, Detail, DueDate, Done, OrderID, KeyPoint) values ('{$semid}', '{$sets['date']}', '{$sets['subject']}', '{$sets['detail']}', '{$sets['due']}', '{$sets['done']}', '{$sets['order']}', '{$sets['key']}')";
		$this->query($sql);
		return $this->getLastInsertID();
	}

	function setSemProcess($pid, $sets){
		foreach ($sets as &$v){
			$v = addslashes($v);
		}

		if($pid > 0){
			$sql = "Update client_course_sem_process SET BeginDate = '{$sets['date']}', Subject = '{$sets['subject']}', Detail = '{$sets['detail']}', DueDate = '{$sets['due']}', Done = '{$sets['done']}' where ID = {$pid}";
			return $this->query($sql);
		} 
	}

	function delSemProcess($pid){
		if ($pid > 0){
			$sql = "delete from client_course_sem_process where ID = {$pid}";
			return $this->query($sql);
		}
		return false;
	}

	function getSemProcessOrder($pid=0, $semid=0){
		$sql = "";
		if($pid > 0){
			$sql = "select OrderID from client_course_sem_process where ID = '{$pid}'";

		}elseif($semid > 0){
			$sql = "select if(Max(OrderID) is null, 0, max(OrderID)) as OrderID from client_course_sem_process where SemID = '{$semid}'";
		}
		$this->query($sql);
		while ($this->fetch()){
			return $this->OrderID;
		}
		return 0;
	}

	function resetSemProcessOrder($semid, $orderid){
		if($semid > 0){
			$sql = "Update client_course_sem_process SET OrderID = OrderID + 1 where SemID = '{$semid}' and OrderID > '{$orderid}' ";
			return $this->query($sql);
		}
	}
	
	function getPosition(){
		$sql = "select ID, Position from position";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->ID] = $this->Position;
		}
		return $_arr;
	}
	
	function addPosition($pos){
		$process = addslashes($process);
		$sql = "Insert into position (Position) value ('{$pos}') ";
		return $this->query($sql);
	}
	
	function delPosition($id){
		$sql = "delete from position where ID = {$id}";
		$this->query($sql);
	}	
		
	function checkDependant($cid){
		if ($cid > 0) {
			$sql = "select DepID from client_visa_dep a, client_visa b where a.CVID = b.ID and b.r_Status = 'active' and a.DepID = '{$cid}' limit 1";
			$this->query($sql);
			while ($this->fetch() && $this->DepID > 0) {
				return true;
			}			
		}
		return false;
	}

	function getVisaPaperWorker($cid){
		if ($cid > 0){
			$sql = "SELECT VuserID from client_visa where CID = {$cid} ";
			$this->query($sql);
			while ($this->fetch()){
				return $this->VuserID;
			}
		}
		return 0;
    }

    function getClientFrom() {
        $sql = "SELECT item from client_from order by `rank`";
        $this->query($sql);
        $arr = array();
        while ($this->fetch()){
            $arr[] = $this->item;
        }
        return $arr;
    }

    function getClientAboutus() {
        $sql = "SELECT item, item_zh, rank from client_from order by rank";
        $this->query($sql);
        $arr = array();
        while ($this->fetch()){
            $arr[$this->item]['name'] = $this->item;
            $arr[$this->item]['zh'  ] = $this->item_zh;
            $arr[$this->item]['rank'] = $this->rank;
        }
        return $arr;
    }

    function addClientFrom($about,$zh,$rank){
        if($about != ""){
            $about = addslashes($about);
            $zh = addslashes($zh);
            $sql = "insert into client_from (Item, Item_ZH, Rank) value('{$about}', '{$zh}', '{$rank}')";
            $this->query($sql);
        }
    }

    function setClientFrom($about,$zh,$rank){
        if($about != ""){
            $about = addslashes($about);
            $zh = addslashes($zh);
            $sql = "update client_from SET rank = {$rank}, Item_ZH = '{$zh}' where item = '{$about}'";
            $this->query($sql);
        }
    }

    function delClientFrom($about){
        if($about != ""){
            $about = addslashes($about);
            $sql = "delete from client_from where Item = '{$about}' ";
            $this->query($sql);
        }    
    }

    function setClientMainVisa($arr, $client_id) {
    	if (!$arr || !$client_id)
    		return false;

    	$sql = "UPDATE client_info SET VISAID = '{$arr['visa']}', VISACLASSID = '{$arr['class']}', EXPIRDATE = '{$arr['epd']}' WHERE CID = {$client_id} ";
    	return $this->query($sql);
    }

    function syncDoB2CourseProcess($cid, $date='0000-00-00') {
    	if ($cid == 0)
    		return false;

    	$sql = "select id as cpid from course_process where process = 'Birthday'";
    	$this->query($sql);
    	$this->fetch();
    	$pid = $this->cpid;
    	if (!$pid)
    		return false;

    	if (!$date || $date == '0000-00-00') {
    		$sql = "select DoB from client_info where CID = {$cid}";
    		$this->query($sql);
    		$this->fetch();
    		$date = $this->DoB;
    	}

    	$date = preg_replace('/^[\d]+-(.*)$/',date('Y').'-$1', $date);



    	$sql = "update client_course_process ccp SET duedate = '{$date}' WHERE  ccp.done = 0 and ccp.processid = {$pid} and exists (select 'x' from client_course cc where ccp.CCID = cc.id and cc.cid = {$cid}) ";
    	$this->query($sql);

    }

    function syncMainVisa2CourseProcess($cid, $date='0000-00-00') {
    	if ($cid == 0)
    		return false;

    	$sql = "select id as cpid from course_process where process = 'Student visa extension'";
    	$this->query($sql);
    	$this->fetch();
    	$pid = $this->cpid;
    	if (!$pid)
    		return false;

    	if (!$date || $date == '0000-00-00') {
    		$sql = "select ExpirDate from client_info where CID = {$cid}";
    		$this->query($sql);
    		$this->fetch();
    		$date = $this->ExpirDate;
    	}



    	$sql = "update client_course_process ccp SET duedate = '{$date}' WHERE  ccp.done = 0 and ccp.processid = {$pid} and exists (select 'x' from client_course cc where ccp.CCID = cc.id and cc.cid = {$cid}) ";
    	$this->query($sql);
    }

    function verifyMigration($courseid, $vma) {
    	if ($courseid == 0 || $vma == 0)
    		return false;

    	$item = 'Verify migration course';
    	//check process 
    	$sql = "select ID from client_course_process where ccid = {$courseid} and ExItem = '{$item}'";
    	$this->query($sql);
    	$this->fetch();

    	if (!$this->ID) {
    		$sets['order'] = $this->getCourseProcessOrder(0, $courseid);
			//$this->resetCourseProcessOrder($course_id, $sets['order']);
			$sets['order'] = $sets['order'] + 1;
    		$sets['subject'] = 0;
			$sets['done']    = 0;
			$sets['detail']  = "";
			$sets['add']     = $item;
			$sets['date']    = date("Y-m-d");
			$sets['due']     = date("Y-m-d");
			$sets['isAuto']  = 1;
			$this->addCourseProcess($courseid, $sets);
    	}
    }

    function alarmAddSemester($courseid, $cpid) {
    	if ($courseid == 0 || $cpid == 0)
    		return false;

    	$sql = "select Process from course_process where id = '{$cpid}' ";
    	$this->query($sql);
    	$this->fetch();
    	if (strtolower($this->Process) != 'get coe') {
    		return false;
    	}

    	$item = 'Add new semester';
    	//check process 
    	$sql = "select ID from client_course_process where ccid = {$courseid} and ExItem = '{$item}'";
    	$this->query($sql);
    	$this->fetch();

    	if (!$this->ID) {
    		$sets['order'] = $this->getCourseProcessOrder(0, $courseid);
			//$this->resetCourseProcessOrder($course_id, $sets['order']);
			$sets['order'] = $sets['order'] + 1;
    		$sets['subject'] = 0;
			$sets['done']    = 0;
			$sets['detail']  = "";
			$sets['add']     = $item;
			$sets['date']    = '0000-00-00';
			$sets['due']     = '0000-00-00';
			$sets['isAuto']  = 1;
			$this->addCourseProcess($courseid, $sets);
    	}
    }

    function countCourseByConsultant($staff_id=0) {
    	if (!$staff_id)
    		return 0;
    	$sql = "select count(*) as c from client_course where ConsultantID = {$staff_id}";
    	$this->query($sql);
    	$this->fetch();
    	return $this->c;
    }

    function mergeCourseConsultant($from_staff_id, $to_staff_id) {
    	if (!$from_staff_id || !$to_staff_id)
    		return false;

    	$sql = "update client_course SET ConsultantID = {$to_staff_id} where ConsultantID = {$from_staff_id}";
    	$this->query($sql);
    	return $this->getAffectNum();
    } 

    function countVisaAgreementByStaff($staff_id=0) {
    	if (!$staff_id)
    		return 0;
    	//$sql = "select count(*) as c from client_visa where VUSERID = {$staff_id}";
		$sql = "select count(*) as c from client_visa v where vuserid = {$staff_id} and not exists (select 'x' from client_visa_process vp, visa_rs_item vi where vp.itemid = vi.itemid and v.id = vp.cvid and vi.Item like 'grant%' and vp.done = 1)";
    	$this->query($sql);
    	$this->fetch();
    	return $this->c;
	}

	function mergeVisaAgreementStaff($from_staff_id, $to_staff_id) {
    	if (!$from_staff_id || !$to_staff_id)
    		return false;

    	$sql = "update client_visa v SET v.VUSERID = {$to_staff_id} where v.VUSERID = {$from_staff_id} and not exists (select 'x' from client_visa_process vp, visa_rs_item vi where vp.itemid = vi.itemid and v.id = vp.cvid and vi.Item like 'grant%' and vp.done = 1)";
    	$this->query($sql);
    	return $this->getAffectNum();
    } 

    function getClientIDbyAccount($account) {
    	if (!$account || !isset($account['type']) || $account['type'] == '')
    		return false;
    	if ($account['type'] == 'visa') {
    		$sql = "select CID FROM client_visa where ID = '{$account['objid']}'";
    	}
    	elseif ($account['type'] == 'coach') {
    		$sql = "select CID FROM client_coach where ID = '{$account['objid']}'";
    	}
    	elseif ($account['type'] == 'legal') {
    		$sql = "select CID FROM client_legal where ID = '{$account['objid']}'";
    	}
    	else {
    		return false;
    	}
    	$this->query($sql);
    	$this->fetch();
    	return $this->CID;
    }

}
?>
