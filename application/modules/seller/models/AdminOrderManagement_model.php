<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class AdminOrderManagement_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }

    public function getOrderManagement(){
        $query = "
                  SELECT
                  C.Id AS Id,
                  userorderdetail.orderScanID AS orderScanID,
                  IFNULL(C.OrderHash, '') AS OrderHash,
                  IFNULL(C.UserId, '') AS UserId,
                  IFNULL(C.TotalPrice, '') AS TotalPrice,
                  IFNULL(C.OnlinePaymentStatus, '') AS PaymentStatus,
                  IFNULL(C.payment_mode, '') AS PaymentMode,
                  IFNULL(C.TransactionId, '') AS TransactionId,
                  IFNULL(C.HasCoupon, '') AS HasCoupon,
                  IFNULL(C.OnlinePaymentStatus, '') AS OnlinePaymentStatus,
                  IFNULL(C.IsPaid, '') AS IsPaid,
                  IFNULL(C.CurrentStatus, '') AS CurrentStatus,
                  IFNULL(C.CreatedOn, '') AS CreatedOn
                  
                  FROM " . CommonTables::USER_ORDER . " C
                  JOIN userorderdetail ON C.Id=userorderdetail.OrderId
                  ORDER BY Id DESC";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }


    public function orderWiseProductDetails($recordId)
    {
        $query = "
                  SELECT
                  C.Id AS Id,
                  IFNULL(C.OrderHash, '') AS OrderHash,
                  IFNULL(C.ProductId, '') AS ProductId,
                  IFNULL(C.UnitPrice, '') AS UnitPrice,
                  IFNULL(C.DiscountValue, '') AS DiscountValue,
                  IFNULL(C.OrderQuantity, '') AS OrderQuantity,
                  IFNULL(C.TotalPrice, '') AS TotalPrice,
                  IFNULL(S.OrderHash, '') AS OrderHash,
                  IFNULL(K.ProductName, '') AS ProductName
                  FROM " . CommonTables::USER_ORDER_DETAIL . " C
                  INNER JOIN " . CommonTables::USER_ORDER . " S ON C.OrderHash = S.OrderHash
                  INNER JOIN " . CommonTables::PRODUCT . " K ON C.ProductId = K.Id
                  WHERE C.OrderHash = '" . $recordId . "'
                  ORDER BY OrderHash

                ";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }

    }
    public function getCouponById($recordId)
    {
        $query = "
                  SELECT
                  C.Id AS Id,
                  IFNULL(UCM.UserId, '') AS UserId,
                  IFNULL(UCM.CouponCode, '') AS CouponCode,
                  IFNULL(UCM.OrderId, '') AS OrderId,
                  IFNULL(UCM.UsedOn, '') AS UsedOn,
                  IFNULL(C.ItemType, '') AS ItemType,
                  IFNULL(C.ValidTill, '') AS ValidTill,
                  IFNULL(C.DiscountType, '') AS DiscountType,
                  IFNULL(C.DiscountValue, '') AS DiscountValue
                  FROM " . CommonTables::USER_COUPON_MAPPING . " UCM
                  INNER JOIN " . CommonTables::COUPON . " C ON UCM.CouponCode = C.CouponCode
                  WHERE UCM.OrderId = '" . $recordId . "'
                  ORDER BY OrderId

                ";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }

    }

    public function currentStatus($currentstatusId,$recordId){

        $query = "
          UPDATE  " . CommonTables::USER_ORDER . " SET
          CurrentStatus='" . $currentstatusId . "'
          WHERE Id='" . $recordId . "'
        ";

        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function notifyUser($recordId){
      $stmt =  $this->pdoConn->prepare("
        SELECT O.Id,NewBillingAddress,
        BA.FirstName,BA.Email,BA.Mobile
        FROM ".CommonTables::USER_ORDER." AS O
        LEFT JOIN ".CommonTables::BILLINGADDRESS." AS BA
        ON BA.OrderId = O.Id
        WHERE O.Id = {$recordId}");

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getbillingAddress($addressId){
      $stmt =  $this->pdoConn->prepare("
        SELECT FirstName,Email,Mobile
        FROM ".CommonTables::BILLINGADDRESS."
        WHERE Id = {$addressId} ");

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
    public function getStatusByOrder($status){
        $query = "
                  SELECT
                  C.Id AS Id,
                  IFNULL(C.OrderHash, '') AS OrderHash,
                  IFNULL(C.UserId, '') AS UserId,
                  IFNULL(C.TotalPrice, '') AS TotalPrice,
                  IFNULL(C.PaymentType, '') AS PaymentType,
                  IFNULL(C.TransactionId, '') AS TransactionId,
                  IFNULL(C.HasCoupon, '') AS HasCoupon,
                  IFNULL(C.OnlinePaymentStatus, '') AS OnlinePaymentStatus,
                  IFNULL(C.IsPaid, '') AS IsPaid,
                  IFNULL(C.CurrentStatus, '') AS CurrentStatus,
                  IFNULL(S.FullName, '') AS FullName,
                  IFNULL(S.Email, '') AS Email
                  FROM " . CommonTables::USER_ORDER . " C
                  INNER JOIN " . CommonTables::USER . " S
                  ON C.UserId = S.Id WHERE C.CurrentStatus = '".$status."'
                  ORDER BY FullName";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }
    
    public function deleteOrderManagement( $recordId)
    {
        $query = "DELETE FROM " . CommonTables::USER_ORDER. "
        WHERE Id='" . $recordId . "'
        ";
        
        $query1 = "DELETE FROM " . CommonTables::USER_ORDER_DETAIL. "
        WHERE OrderId='" . $recordId . "'
        ";
	$stmt1 = $this->pdoConn->prepare($query1);
	$stmt1->execute();
        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }



}
