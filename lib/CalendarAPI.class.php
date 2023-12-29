<?php
require_once('MysqlDB.class.php');

class CalendarAPI extends MysqlDB{
    
    function __construct($host, $user, $pswd, $database, $debug) {
         $this->setDBconf($host, $user, $pswd, $database, $debug);
    }
    
    function getUserCalendar($rDate, $rUserID){
        if($rDate == "" || $rUserID == ""){
            return array();
        }
        $sql = "select ID, Date, Time, Duration, Title, Description, UserID, Done from calendar where Date = '{$rDate}' and UserID = {$rUserID} order by Time asc";
        $this->query($sql);
        $_arr = array();
        while($this->fetch()){
            $_arr[$this->ID]['hour']  = $this->Time;
            $_arr[$this->ID]['title'] = $this->Title;
            $_arr[$this->ID]['desc']  = $this->Description;
            $_arr[$this->ID]['due']   = $this->Duration;
            $_arr[$this->ID]['done']  = $this->Done;
        }
        return $_arr;
    }
    
    function cancelCalendar($id){
        if ($id > 0){
            $sql = "Delete from calendar where ID = {$id}";
            return $this->query($sql);
        }   
        return false;
    }
    
    function receptCalendar($id){
        if ($id > 0){
            $sql = "Update calendar SET Done = 1 where ID = {$id}";
            return $this->query($sql);
        }   
        return false;
    }
    
    
    function setCalendar($cal_id, $sets){
		foreach ($sets as &$v){
			$v = addslashes($v);
		}
        $sql = "Update calendar SET Title = '{$sets['title']}', Duration = '{$sets['due']}', Description = '{$sets['desc']}', Done = {$sets['done']}, UserID = '{$sets['user']}' where ID = {$cal_id}";
        return $this->query($sql);
    }  
    
    function addCalendar($sets, $user_id){
		foreach ($sets as &$v){
			$v = addslashes($v);
		}
        $sql = "insert into calendar (Date, UserID, Time, Title, Duration, Description, FromUserID, Done) values ('{$sets['date']}', {$sets['user']}, '{$sets['hour']}', '{$sets['title']}',  '{$sets['due']}', '{$sets['desc']}', {$user_id}, '{$sets['done']}')";
        $this->query($sql);
        return $this->getLastInsertID();
    } 

    function getOneUserCalendar($id){
        if ($id > 0){
            $sql = "select ID, Done, Date, Time, Duration, Title, Description, UserID, FromUserID from calendar where ID = {$id}";
            $this->query($sql);
            $_arr = array();
            while($this->fetch()){
                $_arr['user']  = $this->UserID;
                $_arr['title'] = $this->Title;
                $_arr['desc']  = $this->Description;
                $_arr['due']   = $this->Duration;
                $_arr['date']  = $this->Date;
                $_arr['hour']  = $this->Time;
                $_arr['from']  = $this->FromUserID;
                $_arr['done']  = $this->Done;
            }
            return $_arr;
        }
        return false;
    }
    
	function checkDueTime($user, $date, $nexthour, $curhour, $due, $calid){
	
		if ($calid > 0) {
			//get cur due
            $sql = "select Duration from calendar where ID = '{$calid}' ";            
			$this->query($sql);
			while ($this->fetch()) {
				$curdue = $this->Duration;
			}
			if ($curdue >= $due) {
				return false;
			}else{
				$hours  = explode(":", $curhour);
				$curhour =  date("H:i", mktime($hours[0], $hours[1] + $curdue, 0,0,0,0));
			}
			#get due
        	$sql = "select ID from calendar where UserID = '{$user}' and Date = '{$date}' and Time >= '{$curhour}' and Time < '{$nexthour}' limit 1";// 
	    	$this->query($sql);
    		while ($this->fetch()){
    			if ($this->ID > 0){
    				return true;
	    		}
    		}			
		}
		else {
			$sql = "select ID from calendar where UserID = '{$user}' and Date = '{$date}' and Time >= '{$curhour}' and Time < '{$nexthour}' limit 1";// 
	    	$this->query($sql);
    		while ($this->fetch()){
    			if ($this->ID > 0){
    				return true;
	    		}
	    	}			
		}		
    
    	return false;
    }
}    
?>
