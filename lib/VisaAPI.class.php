<?php
require_once('MysqlDB.class.php');
class VisaAPI extends MysqlDB {

	
    function __construct($host, $user, $pswd, $database, $debug) {
		$this->setDBconf($host, $user, $pswd, $database, $debug);
    }
	

    
    function getVisaNameArr(){
    	$sql = "select CateID, VisaName from visa_category order by (VisaName+0) asc";
    	$this->query($sql);
    	$_arr = array();
    	while($this->fetch()){
    		$_arr[$this->CateID] = $this->VisaName;
    	}
    	return $_arr;
    }

    function getVisas(){
        $sql = "select CateID, VisaName, ZH_NAME from visa_category order by (VisaName+0) asc";
        $this->query($sql);
        $_arr = array();
        while($this->fetch()){
            $_arr[$this->CateID]['en'] = $this->VisaName;
            $_arr[$this->CateID]['zh'] = $this->ZH_NAME;
        }
        return $_arr;
    }

    function getVisaName($catid){
    	if ($catid > 0){
    		$sql = "select CateID, VisaName from visa_category where CateID = {$catid}";
    		$this->query($sql);
    		while($this->fetch()){
				return $this->VisaName;
    		}
    		return false;
    	}
    	return false;
    }
    
 
    function getSubclassName($catid, $subid){
    	if ($catid > 0 && $subid > 0){
    		$sql = "select ClassName from visa_subclass where CateID = {$catid} and SubClassID = {$subid}";
    		$this->query($sql);
    		while($this->fetch()){
				return $this->ClassName;
    		}
    		return false;
    	}
    	return false;
    }
        
    function getVisaClassNameArr(){
    	$sql = "select SubClassID, CateID, ClassName from visa_subclass";
    	$this->query($sql);
    	$_arr = array();
    	while($this->fetch()){
    		$_arr[$this->CateID][$this->SubClassID] = $this->ClassName;
    	}
    	return $_arr;
    }

    function getVisaClassArr($catid = 0,$status='',$lable=false){
    	$sql = "select SubClassID, CateID, ClassName, SubStatus from visa_subclass WHERE 1 ";
    	if ($catid > 0){
    		$sql .= " AND CateID = {$catid}";	
		}
		
		if ($status != '') {
			$sql .= " AND SubStatus = '{$status}' ";
		}
		$sql .= " order by ClassName asc ";

    	$this->query($sql);
    	$_arr = array();

		if ($lable) {
			while($this->fetch()){
				$_arr[$this->SubClassID] = array('name'=>$this->ClassName, 'status'=>$this->SubStatus);
			}
		}
		else {
			while($this->fetch()){
				$_arr[$this->SubClassID] = $this->ClassName;
			}
		}

    	return $_arr;
    }
    
    function getVisaItemArr($visaid, $classid){
    	$_arr = array();
    	if ($visaid > 0 && $classid > 0){
    		$sql = "select ItemID, Item from visa_rs_item where CateID = {$visaid} and SubClassID = {$classid} order by Priority asc";
    		$this->query($sql);
    		$_arr = array();
    		while ($this->fetch()){
    			$_arr[$this->ItemID] = $this->Item;
    		}
    		return $_arr;
    	}
    	return $_arr;
    }
    
    function getVisaProcessArr($visaid, $classid){
        $_arr = array();
        if ($visaid > 0 && $classid > 0){
            $sql = "select Priority, ItemID, Item from visa_rs_item where CateID = {$visaid} and SubClassID = {$classid} order by Priority asc";
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

    function getNextItemID($cateid, $classid, $itemid){
    	if ($cateid > 0 && $classid > 0 && $itemid >= 0){
   			$sql = "select ItemID, Item from visa_rs_item where CateID = {$cateid} and SubClassID = {$classid} and ItemID > {$itemid} order by ItemID asc limit 1";
    		$this->query($sql);
    		while ($this->fetch()){
    			return $this->ItemID;
    		}
    		
    		return 0;
    	}
    	return 0;
    }
    
    
    function delVisaCategory($cid){
    	if ($cid > 0){
    		$sql = "delete from visa_category where CateID = {$cid}";
    		return $this->query($sql);
    	}
		return false;
    }
    
    function addVisaCategory($catname, $zh_name){
    	if ($catname != ""){
    		$catname = addslashes($catname);
            $zh_name = addslashes($zh_name);
    		$sql = "insert into visa_category (VisaName, ZH_NAME) values ('{$catname}', '{$zh_name}')";
    		return $this->query($sql);
    	}
    	return false;
    }

    function setVisaCategory($catid, $catname, $zh_name){
    	if ($catname != "" && $catid > 0){
    		$catname = addslashes($catname);
            $zh_name = addslashes($zh_name);
    		$sql = "Update visa_category SET VisaName = '{$catname}', ZH_NAME = '{$zh_name}' where CateID = {$catid}";
    		return $this->query($sql);
    	}
    	return false;
    }


    function delVisaSubclass($catid, $subid){
    	if ($catid > 0){
    		$sql = "delete from visa_subclass where CateID = {$catid} and SubClassID = {$subid}";
    		//$sql = "UPDATE visa_subclass SET status = 'Inactive' where CateID = {$catid} and SubClassID = {$subid} ";
			return $this->query($sql);
    	}
		return false;
    }

	function setVisaSubclassStatus($catid, $subid, $status) {
    	if ($catid > 0){
			$sql = "UPDATE visa_subclass SET substatus = '{$status}' where CateID = {$catid} and SubClassID = {$subid} ";
			return $this->query($sql);
    	}
		return false;		
	}
    
    function addVisaSubclass($catid, $classname){
    	if ($classname != "" && $catid > 0){
    		$classname = addslashes($classname);
    		$sql = "insert into visa_subclass (ClassName, CateID) values ('{$classname}', {$catid})";
    		return $this->query($sql);
    	}
    	return false;
    }

    function setVisaSubclass($catid, $subid, $classname){
    	if ($classname != "" && $catid > 0 && $subid > 0){
    		$classname = addslashes($classname);
    		$sql = "Update visa_subclass SET ClassName = '{$classname}' where CateID = {$catid} and SubClassID = {$subid}";
    		return $this->query($sql);
    	}
    	return false;
    }
    
    function delVisaRelate($rid){
    	if ($rid > 0){
    		$sql = "delete from visa_rs_item where ItemID = {$rid}";
    		return $this->query($sql);
    	}
    	return false;
    }
    
    function getRelateSortID($catid, $subid){
    	if ($catid > 0 && $subid > 0){
    		$sql = "select max(Priority) as ID from visa_rs_item where CateID = {$catid} and SubClassID = {$subid}";
    		$this->query($sql);
    		while($this->fetch()){
    			return $this->ID;
    		}
    	}
    	return 0;
    }
    
    function addVisaRelate($catid, $subid, $process, $sort){
    	if ($process != "" && $catid > 0 && $subid > 0){
            $items = array();
            if ($sort == 0) {
    		    $sort = $this->getRelateSortID($catid, $subid);
    		    $sort++;
            }
            else {
                 $sql = "SELECT ITEMID, Priority FROm visa_rs_item WHERE CateID = {$catid} and SubClassID = {$subid} AND Priority >= {$sort}";
                 $this->query($sql);
                 while ($this->fetch()) {
                     $items[$this->ITEMID] = ++$this->Priority;
                 }
            }
           
    		$process = addslashes($process);
    		$sql = "insert into visa_rs_item (CateID, SubClassID, Priority, Item) values ({$catid}, {$subid}, {$sort}, '{$process}')";
    		$this->query($sql);
    	
            foreach ($items as $id => $s) {
                $this->query("update visa_rs_item SET Priority = '{$s}' WHERE ITEMID = {$id}");
            }
            return true;
        }
    	return false;
    }

    function setVisaRelate($rid, $process, $order){
    	if ($process != "" && $rid > 0 && $order > 0){
    		$process = addslashes($process);
    		$sql = "Update visa_rs_item SET Item = '{$process}', Priority = '{$order}' where ItemID = {$rid}";
    		return $this->query($sql);
    	}
    	return false;
    }    
    
    function setVisaABody($bid, $body){
    	if ($body != "" && $bid > 0) {
    		$body = addslashes($body);
    		$sql = "Update visa_abody SET Name = '{$body}' where ABodyID = {$bid}";
    		return $this->query($sql);
    	}
    	return false;
    }
        
    function addVisaABody($body){
    	if ($body != "") {
    		$body = addslashes($body);
    		$sql = "insert into visa_abody (Name) value ('{$body}') ";
    		return $this->query($sql);
    	}
    	return false;
    }
    
    function delVisaBody($pid = 0){
    	if ($pid > 0) {
    		$sql = "delete from visa_abody where ABodyID = '{$pid}' ";
    		return $this->query($sql);
    	}
    	return false;
    }
    
    function getVisaBody($pid = 0){
    	$sql = "select ABodyID, Name from visa_abody ";
    	if ($pid > 0) {
			$sql .= " where ABodyID = '{$pid}' ";
    	}
    	$this->query($sql);
    	$_arr = array();
    	while ($this->fetch()) {
    		$_arr[$this->ABodyID] = $this->Name;
    	}
    	return $_arr;
    }
    
    function setVisaSponsor($spid, $sponsor){
    	if ($sponsor != "" && $spid > 0) {
    		$sponsor = addslashes($sponsor);
    		$sql = "Update visa_sponsor SET Name = '{$sponsor}' where SpID = {$spid}";
    		return $this->query($sql);
    	}
    	return false;
    }
        
    function addVisaSponsor($sponsor){
    	if ($sponsor != "") {
    		$sponsor = addslashes($sponsor);
    		$sql = "insert into visa_sponsor (Name) value ('{$sponsor}') ";
    		return $this->query($sql);
    	}
    	return false;
    }
    
    function delVisaSponsor($spid = 0){
    	if ($spid > 0) {
    		$sql = "delete from visa_sponsor where SpID = '{$spid}' ";
    		return $this->query($sql);
    	}
    	return false;
    }
    
    function getVisaSponsor($spid = 0){
    	$sql = "select SpID, Name from visa_sponsor ";
    	if ($spid > 0) {
			$sql .= " where SpID = '{$spid}' ";
    	}
    	$this->query($sql);
    	$_arr = array();
    	while ($this->fetch()) {
    		$_arr[$this->SpID] = $this->Name;
    	}
    	return $_arr;
    }    
    
    
    
     function setVisaStatus($id, $name){
    	if ($name != "" && $id > 0) {
    		$name = addslashes($name);
    		$sql = "Update visa_status SET Name = '{$name}' where ID = {$id}";
    		return $this->query($sql);
    	}
    	return false;
    }
        
    function addVisaStatus($name){
    	if ($name != "") {
    		$name = addslashes($name);
    		$sql = "insert into visa_status (Name) value ('{$name}') ";
    		return $this->query($sql);
    	}
    	return false;
    }
    
    function delVisaStatus($id = 0){
    	if ($id > 0) {
    		$sql = "delete from visa_status where ID = '{$id}' ";
    		return $this->query($sql);
    	}
    	return false;
    }
    
    function getVisaStatus($id = 0){
    	$sql = "select ID, Name from visa_status ";
    	if ($id > 0) {
			$sql .= " where ID = '{$id}' ";
    	}
    	$this->query($sql);
    	$_arr = array();
    	while ($this->fetch()) {
    		$_arr[$this->ID] = $this->Name;
    	}
    	return $_arr;
    }

    function setVisaAsco($id, $asco){
    	if ($asco != "" && $id > 0) {
    		$asco = addslashes($asco);
    		$sql = "Update visa_abody_asco SET Name = '{$asco}' where ID = {$id}";
    		return $this->query($sql);
    	}
    	return false;
    }
        
    function addVisaAsco($asco, $abodyid){
    	if ($asco != "" && $abodyid > 0) {
    		$asco = addslashes($asco);
    		$sql = "insert into visa_abody_asco (ABodyID, Name) value ('{$abodyid}', '{$asco}') ";
    		return $this->query($sql);
    	}
    	return false;
    }
    
    function delVisaAsco($id = 0){
    	if ($id > 0) {
    		$sql = "delete from visa_abody_asco where ID = '{$id}' ";
    		return $this->query($sql);
    	}
    	return false;
    }
    
    function getVisaAsco($id = 0, $abodyid = 0){
    	$sql = "select ID, Name from visa_abody_asco ";
    	if ($id > 0) {
			$sql .= " where ID = '{$id}' ";
    	}elseif ($abodyid > 0){
    		$sql .= " where ABodyID = '{$abodyid}' ";
    	}
    	$this->query($sql);
    	$_arr = array();
    	while ($this->fetch()) {
    		$_arr[$this->ID] = $this->Name;
    	}
    	return $_arr;
    } 

    function getVisaAscoByABody(){
    	$sql = "select ABodyID, ID, Name from visa_abody_asco ";
    	$this->query($sql);
    	$_arr = array();
    	while ($this->fetch()) {
    		$_arr[$this->ABodyID][$this->ID] = $this->Name;
    	}
    	return $_arr;
    }        

	function getVisaBalance($vid = 0){
		if ($vid == 0) return 0;
		$sql = "SELECT SUM(DueAmount) as damt FROM client_account WHERE VisaID = {$vid} AND (DueDate <> '' or DueDate <> '0000-00-00') and DueAmount > 0 ";
		$this->query($sql);
		while ($this->fetch()){
			$dueamount = $this->damt;
		}
		$sql = "SELECT SUM(PaidAmount) as pamt FROM client_payment a WHERE exists (select 1 from client_account b where a.AccountID = b.ID and b.VisaID = {$vid})";
		$this->query($sql);
		while ($this->fetch()){
			$paidamount = $this->pamt;
		}

		return ($dueamount - $paidamount);
	}

    function checkVisaPayment($vid) {
        if ($vid == 0)
            return false;

        $sql = "select a.ID, VisaID, DueAmount, GST, AMOUNT_3RD, GST_3RD, Sum(if(b.PaidAmount is null, 0, b.PaidAmount)) as paid from client_account a left join client_payment b on(a.ID = b.AccountID) Where VisaID = '{$vid}' AND ACC_TYPE = 'visa' Group by a.ID";
        $this->query($sql);
        while ($this->fetch()) {
            if (($this->DueAmount - $this->paid) > 0)
                return false;
        }
        return true;
    }

    function getApplyVisa($userid = 0, $abodyid = 0, $ascoid = 0, $page=0, $page_size=0, $company=''){
        $sql = "SELECT ID, VisaName, ClassName, a.ExpireDate, concat(LName, ' ', FName) as ClientName, a.CID
                FROM client_visa a left join visa_category b on(a.CateID = b.CateID) 
                                   left join visa_subclass c on(a.SubClassID = c.SubClassID),
                                   client_info d 
                Where a.CID = d.CID ";
        if ($userid > 0) {
               $sql .= " AND (a.AUserID = '{$userid}' or a.VUserID = '{$userid}') ";
        }
        if ($abodyid > 0) {
               $sql .= " AND ABody = {$abodyid} ";
        }
        if ($ascoid > 0) {
               $sql .= " AND AscoID = {$ascoid} ";
        }
        if ($company != '') {
			$sql .= " AND Company = '{$company}' ";
		}

        $sql .= " Order by ClientName, ExpireDate ";
        
        if ($page > 0 && $page_size > 0) {
            $sql .= " Limit ".($page-1)*$page_size.", ".$page_size;
        }
		//echo $sql."\n";
           
        $this->query($sql);
        $_arr = array();
        while ($this->fetch()){
            $_arr[$this->CID][$this->ID]['visa']  = $this->VisaName;
            $_arr[$this->CID][$this->ID]['class'] = $this->ClassName;
            $_arr[$this->CID][$this->ID]['edp']   = $this->ExpireDate;
            $_arr[$this->CID][$this->ID]['client']= $this->ClientName;
        }
        return $_arr;    	
    }
    
    function getNumOfApplyVisa($userid = 0, $abodyid = 0, $ascoid = 0, $company=''){
        $sql = "SELECT count(*) as cnt
                FROM client_visa a left join visa_category b on(a.CateID = b.CateID) 
                                   left join visa_subclass c on(a.SubClassID = c.SubClassID),
                                   client_info d 
                Where a.CID = d.CID ";
        if ($userid > 0) {
               $sql .= " AND (a.AUserID = '{$userid}' or a.VUserID = '{$userid}') ";
        }
        if ($abodyid > 0) {
               $sql .= " AND ABody = {$abodyid} ";
        }
        
        if ($ascoid > 0) {
               $sql .= " AND AscoID = {$ascoid} ";
        }
        if ($company != '') {
			$sql .= " AND Company = '{$company}' ";
		}
        
        $this->query($sql);
        while ($this->fetch()){
            return $this->cnt;          
        }
        return 0;     	
    }

    function is_auto_step($visaid=0){
        if (!$visaid)
            return false;

        $sql = "SELECT AUTOSTEP FROM client_visa where ID = {$visaid}";
        $this->query($sql);
        $this->fetch();
        return $this->AUTOSTEP;
    }

    function close_auto_step($processid=0) {
        if (!$processid)
            return false;

        $sql = "SELECT CVID, ITEMID FROM client_visa_process WHERE ID = {$processid} ";
        $this->query($sql);
        $this->fetch();
        if ($this->CVID > 0 && $this->ITEMID > 0) {
            $sql = "UPDATE client_visa SET AUTOSTEP = 0 WHERE ID = {$this->CVID}";
            $this->query($sql);
        }
        return false;
    }

    function setVisaExpire($vid, $date) {
        if (!$vid || !$date)
            return false;
        
        $sql = "UPDATE client_visa SET ExpireDate = '{$date}' WHERE ID = {$vid}";
        return $this->query($sql);
    }

}
?>
