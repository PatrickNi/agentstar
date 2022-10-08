<?php
require_once('MysqlDB.class.php');

/*
coupon_confs
+-----------+----------------------------------+------+-----+------------+----------------+
| Field     | Type                             | Null | Key | Default    | Extra          |
+-----------+----------------------------------+------+-----+------------+----------------+
| ID        | int                              | NO   | PRI | NULL       | auto_increment |
| Title     | varchar(255)                     | NO   |     |            |                |
| StartDate | date                             | NO   |     | 0000-00-00 |                |
| EndDate   | date                             | NO   |     | 0000-00-00 |                |
| AddUserID | int                              | NO   |     | 0          |                |
| Amount    | decimal(9,2)                     | NO   |     | 0.00       |                |
| Status    | enum('Draft','Active','Deleted') | NO   |     | Draft      |                |
| Detail    | text                             | YES  |     | NULL       |                |
| Created   | datetime                         | YES  |     | NULL       |                |
| Scope     | varchar(255)                     | NO   |     |            |                |
+-----------+----------------------------------+------+-----+------------+----------------+

coupons_client
+-------------+----------------------------------+------+-----+------------+----------------+
| Field       | Type                             | Null | Key | Default    | Extra          |
+-------------+----------------------------------+------+-----+------------+----------------+
| ID          | int                              | NO   | PRI | NULL       | auto_increment |
| CouponID    | int                              | NO   | MUL | 0          |                |
| CID         | int                              | NO   | MUL | 0          |                |
| StartDate   | date                             | NO   |     | 0000-00-00 |                |
| EndDate     | date                             | NO   |     | 0000-00-00 |                |
| AddUserID   | int                              | NO   |     | 0          |                |
| Amount      | decimal(9,2)                     | NO   |     | 0.00       |                |
| Status      | enum('New','Redeemed','Deleted') | NO   |     | New        |                |
| Created     | datetime                         | YES  |     | NULL       |                |
| AccountType | varchar(32)                      | NO   |     |            |                |
| AccountID   | int                              | NO   |     | 0          |                |
+-------------+----------------------------------+------+-----+------------+----------------+
*/
class CouponAPI extends MysqlDB{

    function __construct($host, $user, $pswd, $database, $debug) {
         $this->MysqlDB($host, $user, $pswd, $database, $debug);
    }

    function add($sets) {
        if (!$sets)
            return false;

        $sets['tit'] = addslashes($sets['tit']);

    }

    function update($couponid, $sets) {

    }

    function delete($couponid) {

    }

    function listConfs($is_active=true, $conf_id=0) {        
        $sql = "SELECT ID, Title, StartDate, EndDate, Amount, Status, Detail from coupon_confs WHERE 1 ";
        if ($is_active) {
            $sql .= ' AND Status = "Active" ';
        }
        if ($conf_id > 0) {
            $sql .= " AND ID = {$conf_id} ";
        }

        $this->query($sql);
        $rtn = array();
        while($this->fetch()) {
            $rtn[$this->ID]['title'] = $this->Title;
            $rtn[$this->ID]['start_date'] = $this->StartDate;
            $rtn[$this->ID]['end_date'] = $this->EndDate;
            $rtn[$this->ID]['amount'] = $this->Amount;
            $rtn[$this->ID]['status'] = $this->Status;
            $rtn[$this->ID]['detail'] = $this->Detail;
        }
        return $rtn;
    }

    function send($client_id, $conf_id, $start_date,  $end_date, $staff_id) {
        if (!$client_id || !$conf_id || $start_date == '0000-00-00' || $end_date == '0000-00-00')
            return false;

        $conf = $this->listConfs(true, $conf_id);

        if (!$conf)
            return false;

        $sql = "INSERT INTO coupon_clients (COUPONID, CID, StartDate, EndDate, Amount, AddUserID, Created) values ({$conf_id}, {$client_id}, '{$start_date}', '{$end_date}', {$conf[$conf_id]['amount']}, {$staff_id}, NOW())";
        return $this->query($sql);
    }


    function transfer($coupon_id, $client_id, $client_email) {
        if (!$coupon_id || !$client_id || !$client_email)
            return array('err'=>1, 'msg'=>'incorrect input');

        $sql = "select ID from coupon_clients where CID = {$client_id} AND ID = {$coupon_id} and EndDate >= NOW() and Status = 'NEW' ";
        $this->query($sql);
        if (!$this->fetch())
            return array('err'=>1, 'msg'=>'coupon expired or not exists');

        if ($this->ID != $coupon_id)
            return array('err'=>1, 'msg'=>'coupon expired or not exists');

        $client_email = addslashes($client_email);
        $sql = "select CID from client_info where email = '{$client_email}'";
        $this->query($sql);
        if (!$this->fetch()) {
            return array('err'=>1, 'msg'=>'transfer email not exists');
        }

        $sql = "update client_clients SET CID = {$this->CID} where ID = {$coupon_id}";
        if($this->query($sql)) {
            return array('err'=>0, 'msg'=>'transfer succ');
        }
        else {
            return array('err'=>1, 'msg'=>'transfer fail');
        }
    }


    function redeem($couponid,$service, $date) {
        if (!$couponid || !$service || !$date)
            return false;

        $rtn = array();
        $sql = "select a.id, a.amount from coupon_clients a, coupon_confs b where a.CouponID = b.ID and a.id = {$couponid} AND FIND_IN_SET('{$service}', b.SCOPE) AND a.StartDate <= '{$date}' AND a.EndDate >= '{$date}' and a.status = 'NEW' and b.Status = 'Active' limit 1";
        $this->query($sql);
        
        while($this->fetch()) {
            $rtn[$this->id] = $this->amount;
        }
        
        foreach ($rtn as $id => $v) {
            $sql = "update coupon_clients SET status = 'Redeemed' where id = {$id}";
            $this->query($sql);
        }

        return $rtn;
    }

    function postRedeem($couponid, $accountid, $account_type, $paymentid) {
        if (!$couponid || !$paymentid)
            return false;

        $sql = "Update coupon_clients SET AccountType = '{$account_type}', AccountID = {$accountid}, PaymentID = {$paymentid} where id = {$couponid}";
        return $this->query($sql);
    }

    function getCouponsByClient($client_id, $scope, $status='',$short=true) {
        if (!$client_id)
            return false;

        $sql = "select a.id, title, a.Amount, a.StartDate, a.EndDate, a.Status, a.CouponID from coupon_clients a, coupon_confs b where a.CouponID = b.id and CID = {$client_id} ";
        if ($scope) {
            $sql .= " AND FIND_IN_SET('{$scope}', SCOPE) ";
        }

        if ($status <> '') {
            $sql .= " AND a.Status = '{$status}' ";
        }
        //echo $sql."<br/>";
        $this->query($sql);
        $rtn = array();
        if ($short) {
            while($this->fetch()) {
                $rtn[$this->id] = $this->title.' --- $'.$this->Amount;
            }
        }
        else {
            while($this->fetch()) {
                $rtn[$this->id]['title'] = $this->title;
                $rtn[$this->id]['amount'] = $this->Amount;
                $rtn[$this->id]['sdate'] = $this->StartDate;
                $rtn[$this->id]['edate'] = $this->EndDate;
                $rtn[$this->id]['status'] = $this->Status;
                $rtn[$this->id]['confid'] = $this->CouponID;
            }
        }

        return $rtn;
    }
}
?>
