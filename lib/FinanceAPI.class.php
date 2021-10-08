<?php
require_once('MysqlDB.class.php');
/*
 CREATE TABLE `internal_transfer_note` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Reciption` varchar(255) default null,
  `SemesterID` int(11) NOT NULL DEFAULT 0,
  `TransferDate` date NOT NULL DEFAULT '0000-00-00',
  `CommRate` decimal(9,2) not null default 0.00,
  `CommAmount` decimal(9,2) not null default 0.00,
  `CommAmountGst` decimal(9,2) not null default 0.00,
  `BonusAmount` decimal(9,2) not null default 0.00,
  `Comm2Biz`  decimal(9,2) not null default 0.00,
  `FeeDetail` text default null,
  `BankDetail` text default null,
  `AddTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `LastUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `SemsterID` (`SemsterID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
*/
class FinanceAPI extends MysqlDB{

 
    function __construct($host, $user, $pswd, $database, $debug) {
         $this->MysqlDB($host, $user, $pswd, $database, $debug);
    }

    public function getTransferNotes($id) {
        if (!$id)
            return false;
        $sql = "SELECT * from internal_transfer_note where id = {$id}";
        $this->query($sql);
        $rtn = array();
        while($this->fetch()) {
            $rtn['date'] = $this->TransferDate;
            $rtn['comm'] = $this->CommAmount;
            $rtn['commgst'] = $this->CommAmountGst;
            $rtn['comm2biz'] = $this->Comm2Biz;
            $rtn['recipt'] = $this->Reciption;
            $rtn['semid'] = $this->SemesterID;
            $rtn['cr'] = $this->CommRate;
            $rtn['bonus'] = $this->BonusAmount;
            $rtn['fees'] = json_decode($this->FeeDetail, true);
            $rtn['bank'] = json_decode($this->BankDetail, true);
            $rtn['id'] = $this->ID;

            $rtn['netpayment'] = array_sum($rtn['fees']) - $rtn['comm2biz'];
        }
        return $rtn;
    }

    public function getTransferBrief($sem_id) {
        if (!$sem_id)
            return false;
        $sql = "SELECT ID, TransferDate, CommAmountGst, Comm2Biz, Reciption from internal_transfer_note where semesterid = {$sem_id} order by TransferDate asc ";
        $this->query($sql);
        $rtn = array();
        while($this->fetch()) {
            $rtn[$this->ID]['date'] = $this->TransferDate;
            $rtn[$this->ID]['comm'] = $this->CommAmountGst;
            $rtn[$this->ID]['comm2biz'] = $this->Comm2Biz;
            $rtn[$this->ID]['recipt'] = $this->Reciption;
        }
        return $rtn;
    }

    public function addTransferNotes($sem_id, $course_id) {
        
        $transfer_start_date = '2021-01-01'; 
        $transfer_end_date = date("Y-m-d");
        $sql = "SELECT TransferDate FROM internal_transfer_note where SemesterID = {$sem_id} order by TransferDate desc limit 1";
        $this->query($sql);
        if ($this->fetch()) {
            $transfer_start_date = $this->TransferDate;
        }

        $sql = "select Step, sum(PaidAmount) as paid from client_payment p, client_account a where p.AccountID = a.id and a.acc_type = 'semester' and a.visaid= {$sem_id} and PaidDate >= '{$transfer_start_date}'and PaidDate <= '{$transfer_end_date}' group by step ";
        $fees = array();
        $this->query($sql);
        while($this->fetch()) {
            $fees[$this->Step] = $this->paid;
        }

        if (count($fees) == 0)
            return array('succ'=>false,'msg'=>'Do not have any Fees!');

        $bank = array('name'=>'','no'=>'', 'bsb'=>'');
        $sql = "select AccountName, AccountNo, BSB from institute_bank b where exists (select 'x' from client_course c where b.instid = c.iid and c.id = {$course_id})";
        $this->query($sql);
        if ($this->fetch()) {
            $bank['name'] = $this->AccountName;
            $bank['no'] = $this->AccountNo;
            $bank['bsb'] = $this->BSB;
        }
        else {
            return array('succ'=>false,'msg'=>'Empty Instiute Back Info!');
        }

        $cr = $this->getCommRate($course_id, $transfer_start_date);
        $comm = @$fees['tuition'] * $cr;
        $comm_w_gst =  $comm * 1.1;
        $bonus = 0;
        $comm2biz = $comm_w_gst + $bonus + @$fees['discount'];


        $sql = "insert into internal_transfer_note (SemesterID, TransferDate, CommRate, CommAmount, CommAmountGst, Comm2Biz, BonusAmount, FeeDetail, BankDetail, AddTime) values ('{$sem_id}', '{$transfer_end_date}', '{$cr}', '{$comm}', '{$comm_w_gst}', '{$comm2biz}', '{$bonus}', '".addslashes(json_encode($fees))."', '".addslashes(json_encode($bank))."', NOW())";
        //echo $sql;exit;
        return array('succ'=>$this->query($sql), 'msg'=>'');
    }

    public function updateTransferNotes($id, $cr=0, $comm_w_gst=0,$comm2biz=0, $reciption='',$bonus=0) {
        if (!$id)
            return false;
        $upd = array();
        if ($cr > 0) {
            array_push($upd, " CommRate = '{$cr}' ");
        }

        if ($comm_w_gst > 0) {
            array_push($upd, " CommAmountGst = '{$comm_w_gst}' ");
        }

        if ($comm2biz > 0) {
            array_push($upd, " Comm2Biz = '{$comm2biz}' ");
        }

        if ($reciption != '') {
            array_push($upd, " Reciption = '{$reciption}' ");
        }

        if ($bonus > 0) {
            array_push($upd, " BonusAmount = '{$bonus}' ");
        }


        if (count($upd) > 0) {
            $sql = "UPDATE internal_transfer_note SET ". implode(',', $upd) ." WHERE id = {$id}";
            return $this->query($sql);
        }

        return false;
    }

    public function getCommRate($course_id, $sem_start_date) {
        if (!$course_id || !$sem_start_date)
            return 0;

        $sql = "SELECT MajorID, QualID, IID as InstID FROM client_course where ID = {$course_id}";
        $this->query($sql);
        if(!$this->fetch()) {
            return 0;
        }
        $school_id = $this->InstID;


        $sql = "SELECT CommRate FROM institute_comm where InstID = {$school_id} AND MajorID = {$this->MajorID} AND QualID = {$this->QualID} and StartDate <= '{$sem_start_date}' and (EndDate >= '{$sem_start_date}' or EndDate = '0000-00-00') order by StartDate desc limit 1";
  
        $this->query($sql);
        $cr = false;
        if (!$this->fetch()) {
            $sql = "SELECT CommRate FROM institute_comm where InstID = {$school_id} AND MajorID = 0 AND QualID = 0 and StartDate <= '{$sem_start_date}' and (EndDate >= '{$sem_start_date}' or EndDate = '0000-00-00')  order by StartDate desc limit 1";
            $this->query($sql);
            if ($this->fetch()) {
                $cr = $this->CommRate;
            }
        }
        else {
            $cr = $this->CommRate;
        }
        if (!$cr)
            return 0;

        return $this->formatCommRate($cr);

    }

    public function formatCommRate($cr) {
        if (preg_match('/([0-9.]+)%/', $cr, $m)) {
            return round($m[1]/100, 2);
        }
        return 0;
    }
}
?>
