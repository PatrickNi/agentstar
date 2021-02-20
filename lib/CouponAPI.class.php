<?php
require_once('MysqlDB.class.php');

/*
coupons
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

    function update($coupon_id, $sets) {

    }

    function delete($coupon_id) {

    }

    function send($client_id) {

    }

    function redeemCoupon($couponid, $objtype, $objid) {
        $sql = "update coupon_clients SET status = 'REDEEMED', ObjType = '{$objtype}', ObjID = {$objid} where id = '{$couponid}'";
        return $this->query($sql);
    }

    function getCouponsByClient($client_id, $scope, $status='') {
        if (!$client_id)
            return false;

        $sql = "select a.id, title, a.Amount from coupon_clients a, coupon_confs b where a.CouponID = b.id and CID = {$client_id} ";
        if ($scope) {
            $sql .= " AND FIND_IN_SET('{$scope}', SCOPE) ";
        }

        if ($status <> '') {
            $sql .= " AND a.Status = '{$status}' ";
        }
        //echo $sql."<br/>";
        $this->query($sql);
        $rtn = array();
        while($this->fetch()) {
            $rtn[$this->id] = $this->title.' --- $'.$this->Amount;
        }
        return $rtn;
    }

    function getCouponById($id) {
        if (!$id)
            return false;

        $sql = "select id, Amount,  from coupon_clients where id = {$id}";
        $this->query($sql);
        while ($this->fetch()) {

        }
    }

    function checkAvalid($couponid, $service, $date) {
        if (!$couponid || !$service || !$date)
            return false;

        $rtn = array();
        $sql = "select a.id, a.amount from coupon_clients a, coupon_confs b where a.CouponID = b.ID and a.id = {$couponid} AND FIND_IN_SET('{$service}', b.SCOPE) AND a.StartDate <= '{$date}' AND a.EndDate >= '{$date}' ";
        $this->query($sql);
        while($this->fetch()) {
            $rtn[$this->id] = $this->amount;
        }
        return $rtn;
    }

}
?>
