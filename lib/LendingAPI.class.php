<?php
require_once('MysqlDB.class.php');
class LendingAPI extends MysqlDB{

    function LendingAPI($host, $user, $pswd, $database, $debug) {
    	 $this->MysqlDB($host, $user, $pswd, $database, $debug);
    }
    
    function getCategory(){
    	return array('bank', 'loan broker');
    }

    function getStep(){
    	return array('Refer home loan', 'Loan approved', 'Loan settled', 'Commission received');
    }

    function delLending($id){
    	if ($id > 0){
    		$sql = "delete from lending_institue where ID = {$id}";
    		return $this->query($sql);
    	}
    	return false;
    }
    
	function setLending($id, $set_arr){
		if (is_array($set_arr) && count($set_arr) > 0){
			foreach($set_arr as &$v){
				$v = addslashes($v);
			}
			
			$sql = "Update lending_institue SET Name = '{$set_arr['name']}', CR = '{$set_arr['cr']}', CATEGORY = '{$set_arr['cate']}', CONTACT = '{$set_arr['contact']}' where ID = {$id}";
			return $this->query($sql);
		}
		return false;
	}
	
	function addLending($set_arr){
		if (is_array($set_arr) && count($set_arr) > 0){
			foreach($set_arr as &$v){
				$v = addslashes($v);
			}
			
			$sql = "insert into lending_institue (Name, CR, CATEGORY, CONTACT, ADDTIME) values ('{$set_arr['name']}', '{$set_arr['cr']}', '{$set_arr['cate']}', '{$set_arr['contact']}', NOW())";
			return $this->query($sql);
		}
		return false;
	}

	function getLending($lid, $column, $value){
		$sql = "select * from lending_institue ";

		if ($lid > 0){
			$sql .= "where ID = {$lid}";	
		} elseif($column != "" && $value != ""){
			$sql .= "where {$column} = '{$value}'";
		}
		
		$sql .= " order by Name asc";
		$this->query($sql);
		$_arr = array();
		while($this->fetch()){
			$_arr[$this->ID]['name']   = $this->Name;
			$_arr[$this->ID]['cate']   = $this->CATEGORY;
			$_arr[$this->ID]['cr']     = $this->CR;
			$_arr[$this->ID]['contact']   = $this->Contact;
		}
		return $_arr;
	}

	function getLendingStats($fd='',$td='') {
		$sql = "SELECT LID, a.ID FROM client_homeloan a" ;

		$where = '';
		if ($fd != '' && $fd != '0000-00-00')
			$where .= " AND BeginDate >= '{$fd}'";
		if ($td != '' && $td != '0000-00-00')
			$where .= " AND BeginDate <= '{$td}'";

		$sql .= " WHERE EXISTS (select 'x' from client_homeloan_process e WHERE a.ID = e.HID AND STEP = 'refer home loan' {$where})";
        
		$this->query($sql);
		$rtn = array();
		$hids = array();
		while ($this->fetch()) {
			if (!isset($rtn[$this->LID])) {
				$rtn[$this->LID]['referre' ] = 0;
				$rtn[$this->LID]['settled' ] = 0;
				$rtn[$this->LID]['comm_ref'] = 0;
				$rtn[$this->LID]['comm_rec'] = 0;
			}

			$rtn[$this->LID]['referre']++;
			$hids[$this->ID] = 1;
		}

		$sql = "SELECT LID, a.ID, SUM(IF(STEP = 'Loan settled', 1, 0)) AS SETTLED, SUM(IF(STEP = 'Loan settled', 1, 0)) AS SETTLED_STEP,  SUM(IF(STEP = 'Loan settled', COMMISSION, 0)) AS SETTLED_COMM, SUM(IF(STEP = 'Commission received', 1, 0)) AS RECITVED_STEP, SUM(IF(STEP = 'Commission received', Commission, 0)) AS RECITVED_COMM  FROM client_homeloan a, client_homeloan_process b WHERE a.ID = b.HID  AND BeginDate <> '0000-00-00' AND DONE  = 1 GROUP BY a.ID";
		$this->query($sql);
		while ($this->fetch()) {
			if (!isset($hids[$this->ID]))
				continue;

			$rtn[$this->LID]['settled' ] += $this->SETTLED;
			$rtn[$this->LID]['comm_ref'] += $this->SETTLED_COMM;
			$rtn[$this->LID]['comm_rec'] += $this->RECITVED_COMM;
		}
		return $rtn;
	}

	
	function addHomeloan($user_id, $cid, $sets){
		$comm = $sets['cr'] * $sets['amount'];
		foreach($sets as &$v){
			$v = addslashes($v);
		}
		
		$sql = "insert into `client_homeloan` (CID, LID, CR, AMOUNT, PROPERTY_PRICE, USERID, StartDate, ENDDATE, STATUS, ADDTIME, Commission, LSID, CoComm, CoDate, Discount, DiscountDate) values ";
		$sql .= "('{$cid}', '{$sets['lid']}', '{$sets['cr']}', '{$sets['amount']}', '{$sets['price']}', '{$user_id}', '{$sets['start']}', '{$sets['end']}', '{$sets['status']}',  NOW(), $comm, '{$sets['staff']}', '{$sets['cocomm']}', '{$sets['codate']}', '{$sets['discount']}', '{$sets['discountdate']}')";
		$this->query($sql);
		return $this->getLastInsertID();
	}

	function setHomeloan($hid, $sets){
		$comm = $sets['cr'] * $sets['amount'];
		foreach($sets as &$v){
			$v = addslashes($v);
		}
		$sql = "update client_homeloan SET LID = '{$sets['lid']}', CR = '{$sets['cr']}', AMOUNT = '{$sets['amount']}', PROPERTY_PRICE = '{$sets['price']}', StartDate = '{$sets['start']}', EndDate = '{$sets['end']}', STATUS = '{$sets['status']}', Commission = {$comm}, LSID = '{$sets['staff']}', UserID='{$sets['user']}', CoComm = '{$sets['cocomm']}',  CoDate = '{$sets['codate']}',  Discount = '{$sets['discount']}' ,  DiscountDate = '{$sets['discountdate']}'where ID = {$hid}";
		return $this->query($sql);
	}

	function delHomeloan($hid){
		if ($hid > 0){
			$sql = "Delete from client_homeloan where ID = {$hid}";
			$this->query($sql);
			
			$sql = "delete from client_homeloan_process where HID = {$hid}";
			$this->query($sql);
			
			return true;
		}	
		return false;
	}

	function getHomeloan($hid, $client_id, $user_id, $lend_id=0) {
		$sql = "SELECT a.*, b.LNAME, b.FNAME  FROM client_homeloan a, client_info b WHERE a.CID = b.CID";

		if ($hid > 0)
			$sql .= " AND a.ID = {$hid} ";

		if ($user_id > 0)
			$sql .= " AND a.USERID = {$user_id} ";

		if ($client_id > 0)
			$sql .= " AND a.CID = {$client_id} ";

		if ($lend_id > 0)
			$sql .= " AND a.LID = {$lend_id} ";
		
		$sql .= " ORDER BY a.ID ASC ";
		$rtn = array();
		$this->query($sql);
		while ($this->fetch()) {
			$rtn[$this->ID]['cid'   ] = $this->CID;
			$rtn[$this->ID]['cr'    ] = $this->CR;
			$rtn[$this->ID]['lid'   ] = $this->LID;
			$rtn[$this->ID]['amount'] = $this->AMOUNT;
			$rtn[$this->ID]['price' ] = $this->PROPERTY_PRICE;
			$rtn[$this->ID]['start' ] = $this->StartDate;
			$rtn[$this->ID]['end'   ] = $this->EndDate;
			$rtn[$this->ID]['status'] = $this->Status;
			$rtn[$this->ID]['comm'  ] = $this->Commission;
			$rtn[$this->ID]['staff' ] = $this->LSID;
			$rtn[$this->ID]['user'  ] = $this->UserID;
			$rtn[$this->ID]['lname' ] = $this->LNAME;
			$rtn[$this->ID]['fname' ] = $this->FNAME;		
			$rtn[$this->ID]['cocomm' ] = $this->CoComm;
			$rtn[$this->ID]['codate' ] = $this->CoDate;
			$rtn[$this->ID]['discount' ] = $this->Discount;
			$rtn[$this->ID]['discountdate' ] = $this->DiscountDate;									
		}

		if ($hid > 0 && count($rtn) > 0)
			return $rtn[$hid];
		else
			return $rtn;
	}


	function autoProcess($hid) {
		if ($hid < 0)
			return false;

		$auto_steps = $this->getStep();
		$sql = "SELECT STEP, DONE FROM client_homeloan_process WHERE HID = {$hid}  AND STEP IN ('".implode("','", $auto_steps)."')";
		$this->query($sql);
		$chks= array();
		while ($this->fetch()) {
			$chks[$this->STEP] = $this->DONE;
		}

		foreach ($auto_steps as $step) {
			if (isset($chks[$step])) {
				if ($chks[$step] == 0)
					break;
				continue;
			}

			$sets['subject'] = $step;
			$sets['done']    = 0;
			$sets['detail']  = "";
			$sets['date']    = '0000-00-00';
			$sets['due']     = '0000-00-00';
			return $this->addProcess($hid, $sets);
		}
		return false;
	}

	function addProcess($hid, $sets){
		foreach ($sets as &$v){
			$v = addslashes($v);
		}			
		$sql = "insert into `client_homeloan_process` (HID, BeginDate, STEP, Detail, DueDate, Done, ADDTIME) values ('{$hid}', '{$sets['date']}', '{$sets['subject']}', '{$sets['detail']}', '{$sets['due']}', '{$sets['done']}', NOW())";
		return $this->query($sql);
	}	

	function setProcess($pid, $sets, $hid){
		foreach ($sets as &$v){
			$v = addslashes($v);
		}

		if($pid > 0 ){
			$sql = "Update client_homeloan_process SET BeginDate = '{$sets['date']}', STEP = '{$sets['subject']}', Detail = '{$sets['detail']}', DueDate = '{$sets['due']}', Done = '{$sets['done']}' where ID = {$pid}";
			return $this->query($sql);
		} 
	}	

	function delProcess($pid){
		if ($pid > 0){
			$sql = "Delete from client_homeloan_process where ID = {$pid}";
			return $this->query($sql);
		}	
		return false;
	}

	function getProcessByClient($cid) {
		$sql = "select HID, REPLACE(Step, ' ', '') AS Step, BeginDate, Detail, Done, DueDate from client_homeloan_process a WHERE exists (select 'x' from client_homeloan b WHERE a.HID = b.ID and b.CID = {$cid}) ORDER BY HID, ID ASC ";

		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->HID][$this->Step]['date']    = $this->BeginDate;
			$_arr[$this->HID][$this->Step]['subject'] = $this->Step;
			$_arr[$this->HID][$this->Step]['detail']  = $this->Detail;
			$_arr[$this->HID][$this->Step]['due']     = $this->DueDate;
			$_arr[$this->HID][$this->Step]['done']    = $this->Done;
		}
		return $_arr;		
	}

	function getProcessByLend($lid) {
		$sql = "select HID, REPLACE(Step, ' ', '') AS Step, BeginDate, Detail, Done, DueDate from client_homeloan_process a WHERE exists (select 'x' from client_homeloan b WHERE a.HID = b.ID and b.LID = {$lid}) ORDER BY HID, ID ASC ";

		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->HID][$this->Step]['date']    = $this->BeginDate;
			$_arr[$this->HID][$this->Step]['subject'] = $this->Step;
			$_arr[$this->HID][$this->Step]['detail']  = $this->Detail;
			$_arr[$this->HID][$this->Step]['due']     = $this->DueDate;
			$_arr[$this->HID][$this->Step]['done']    = $this->Done;
		}
		return $_arr;		
	}


	function getProcess($pid, $hid){
		$steps = array_flip($this->getStep());
		$sql = "select * from client_homeloan_process WHERE 1";
		if ($pid > 0){
			$sql .= " AND ID = {$pid}";
		}

		if ($hid > 0) {
			$sql .= " AND HID = {$hid} ";
		}
		$sql .= " ORDER BY ID ASC ";

		$this->query($sql);
		$_arr = array();
		$sorts = array();
		$last_idx = 0;
		while ($this->fetch()){
			$_arr[$this->ID]['id']    = $this->ID;
			$_arr[$this->ID]['date']    = $this->BeginDate;
			$_arr[$this->ID]['subject'] = $this->STEP;
			$_arr[$this->ID]['detail']  = $this->Detail;
			$_arr[$this->ID]['due']     = $this->DueDate;
			$_arr[$this->ID]['done']    = $this->Done;
		
			$last_idx = isset($steps[$this->STEP])? $steps[$this->STEP] : $last_idx;
			$sorts[$this->ID] = $last_idx;
		}

		if ($pid > 0)
			return $_arr[$pid];

		array_multisort($sorts, SORT_ASC, $_arr);
		return $_arr;
	}
	


    function delStaff($fid){
		if($fid > 0){
			$sql = "delete from lending_staff where ID = {$fid}";
			return $this->query($sql);
		}
		return false;
	}
	
	function setStaff($fid, $sets){
		if ($fid > 0){
			foreach ($sets as &$v){
				$v = addslashes($v);
			}
			$sql = "Update lending_staff SET Name = '{$sets['name']}', Phone = '{$sets['phone']}', Mobile = '{$sets['mobile']}' , Fax = '{$sets['fax']}', Email = '{$sets['email']}', Address = '{$sets['addr']}', INTRODUCER_ID = '{$sets['code']}' where ID = '{$fid}' ";
			return $this->query($sql); 
		}
	}
	
	function addStaff($sid, $sets){
		if ($sid > 0){	
			foreach ($sets as &$v){
				$v = addslashes($v);
			}
			$sql = "insert into `lending_staff` (LID, Name, Phone, Mobile, Fax, Email, Address, INTRODUCER_ID) values ('{$sid}', '{$sets['name']}', '{$sets['phone']}', '{$sets['mobile']}', '{$sets['fax']}', '{$sets['email']}', '{$sets['addr']}', '{$sets['code']}')"; 
			return $this->query($sql);
		} 
	}		


	function getStaff($sid){
		$sql = "select ID, LID, Name , Phone, Mobile, Fax, Email, Address, INTRODUCER_ID from lending_staff ";
		if ($sid > 0){
			$sql .= " Where LID = {$sid}";
		}
		$sql .= " order by Name asc ";
		$this->query($sql);
		$_arr = array();
		while ($this->fetch()){
			$_arr[$this->ID]['name']   = $this->Name;
			$_arr[$this->ID]['phone']  = $this->Phone;
			$_arr[$this->ID]['mobile'] = $this->Mobile;
			$_arr[$this->ID]['fax']    = $this->Fax;
			$_arr[$this->ID]['email']  = $this->Email;
			$_arr[$this->ID]['lid']    = $this->LID;
			$_arr[$this->ID]['addr']    = $this->Address;
			$_arr[$this->ID]['code']    = $this->INTRODUCER_ID;
		}
		return $_arr;
	}
	
}
?>
