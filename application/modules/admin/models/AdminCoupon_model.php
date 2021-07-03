<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class AdminCoupon_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }


    /*---------------Product Start ---------------*/





    public function getCoupon()
    {

        $query = "
                SELECT
                CT.Id AS Id,
                IFNULL(CT.CouponCode, '') AS CouponCode,
                IFNULL(CT.Description, '') AS Description,
                IFNULL(CT.ItemType, '') AS ItemType,
                IFNULL(CT.ItemId, '') AS ItemId,
                IFNULL(CT.ValidTill, '') AS ValidTill,
                IFNULL(CT.DiscountType, '') AS DiscountType,
                IFNULL(CT.DiscountValue, '') AS DiscountValue,
                IFNULL(CT.IsActive, '') AS IsActive
                FROM " . CommonTables::COUPON . " CT
                 ORDER BY CT.Id DESC";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }


    public function getAllProducts(){

        $query = "SELECT Id,ProductName
                    FROM " . CommonTables::PRODUCT . "
                    ORDER BY ProductName ASC";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function getSubCategory()
    {

        $query = "
                    SELECT
                    Id,SubCategoryName
                    FROM " . CommonTables::PRODUCT_SUB_CATEGORY . "
                    ORDER BY SubCategoryName ASC
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

    public function checkExistCoupon($coupon){
        $stmt = $this->pdoConn->prepare("
                SELECT Id FROM ".CommonTables::COUPON."
                WHERE CouponCode = '".$coupon."'");
        $stmt->execute();
        if($stmt->rowCount()){
            return false;
        }else{
            return true;
        }
    }

    public function saveCoupon($data){
        // > 1 means item type is not for all-products
        $ValidTill = strtotime($data['validTill']);
        $stmt = $this->pdoConn->prepare("
                INSERT INTO ".CommonTables::COUPON." SET
                CouponCode =  '".$data['coupon']."',
                ItemType =  '".$data['item-type']."',
                ItemId =  '".$data['item']."',
                ValidTill =  '".$ValidTill."',
                DiscountType =  '".$data['discountType']."',
                DiscountValue =  '".$data['discountValue']."'

            ");

        if($stmt->execute()){
            return 1;
        }else{
            return 0;
        }
    }
}

?>
