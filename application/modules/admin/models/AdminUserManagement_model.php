<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class AdminUserManagement_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }

    public function getUserManagement()
    {
        $query = "
                  SELECT
                  C.Id AS Id,
                  IFNULL(C.FullName, '') AS FullName,
                  IFNULL(C.Email, '') AS Email,
                  IFNULL(C.IsActive, '') AS IsActive
                  FROM " . CommonTables::USER . " C
                  WHERE UserRole='" . 2 . "'
                  ORDER BY FullName

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

    public function enableDisableUsers($recordId, $isActive)
    {
        $query = "
                    UPDATE  " . CommonTables::USER . " SET
                    IsActive='" . $isActive . "'
                    WHERE Id='" . $recordId . "'
        ";
//        return $query();die;
        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteUser($recordId)
    {
        $query = "
                    DELETE From  " . CommonTables::USER . "
                    WHERE Id='" . $recordId . "'
        ";
//        return $query();die;
        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function listUserWiseOrders($recordId)
    {
        $query = "
                  SELECT
                  C.Id AS Id,
                  IFNULL(C.OrderHash, '') AS OrderHash,
                  IFNULL(C.UserId, '') AS UserId,
                  IFNULL(C.TotalPrice, '') AS TotalPrice,
                  IFNULL(C.PaymentType, '') AS PaymentType,
                  IFNULL(C.TransactionId, '') AS TransactionId,
                  IFNULL(C.OnlinePaymentStatus, '') AS OnlinePaymentStatus,
                  IFNULL(C.IsPaid, '') AS IsPaid,
                  IFNULL(S.FullName, '') AS FullName,
                  IFNULL(S.Email, '') AS Email
                  FROM " . CommonTables::USER_ORDER . " C
                  INNER JOIN " . CommonTables::USER . " S ON C.UserId = S.Id
                  WHERE C.UserId = '" . $recordId . "'
                  ORDER BY FullName

                ";
//return $query;die;
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }


    public function getUserDetailById($recordId)
    {
        $query = "
                  SELECT
                  *
                  FROM " . CommonTables::USER. "

                  WHERE Id = '" . $recordId . "'
                  ORDER BY FullName

                ";
//return $query;die;
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }


    }
    public function getListUserWiseByOrderId($OrderId)
    {
        $query = "
                  SELECT
                  OD.Id AS Id,
                  IFNULL(P.ProductName, '') AS ProductName,
                  IFNULL(OD.UnitPrice, '') AS UnitPrice,
                  IFNULL(OD.AttributeId, '') AS AttributeId,
                  IFNULL(OD.AttributeValueId, '') AS AttributeValueId,
                  IFNULL(OD.DiscountType, '') AS DiscountType,
                  IFNULL(OD.DiscountValue, '') AS DiscountValue,
                  IFNULL(OD.OrderQuantity, '') AS OrderQuantity,
                  IFNULL(OD.TotalPrice, '') AS TotalPrice
                  FROM " . CommonTables::USER_ORDER_DETAIL . " OD
                  INNER JOIN " . CommonTables::PRODUCT . " P ON OD.ProductId = P.Id
                  WHERE OD.OrderId = '" . $OrderId . "'
                  ORDER BY Id

                ";
//return $query;die;
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }


    }
    
    public function userUpdate($post, $id){
    	$query = "UPDATE ".CommonTables::USER." SET FullName = '".$post['name']."',
    	Email = '".$post['email']."',
    	Mobile = '".$post['mobile']."',
    	Address = '".$post['address']."',
    	Landmark = '".$post['landmark']."',
    	Country = '".$post['country']."',
    	State = '".$post['state']."',
    	City = '".$post['city']."',
    	Pincode = '".$post['pincode']."'
    	
    	WHERE Id = '".$id."'";
    	
    	$stmt = $this->pdoConn->prepare($query);
        $result = $stmt->execute();
        
         if ($result) {
            return true;
        } else {
            return false;
        }
 
    }
    
    public function userPasswordUpdate($post, $id){
    	$query = "UPDATE ".CommonTables::USER." SET PassKey = '".md5($post['password'])."',
    	PassSalt= '".$post['password']."'
    	
    	WHERE Id = '".$id."'";
    	
    	$stmt = $this->pdoConn->prepare($query);
        $result = $stmt->execute();
        
         if ($result) {
            return true;
        } else {
            return false;
        }
 
    }
}
