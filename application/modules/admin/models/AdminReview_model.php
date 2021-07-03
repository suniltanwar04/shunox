<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class AdminReview_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }


    /*---------------Product Start ---------------*/





    public function getReview()
    {

        $query = "
                SELECT
                PR.Id AS Id,
                IFNULL(PR.ProductId, '') AS ProductId,
                IFNULL(PR.NickName, '') AS NickName,
                IFNULL(PR.Summary, '') AS Summary,
                IFNULL(PR.Review, '') AS Review,
                IFNULL(P.ProductName, '') AS ProductName,
                IFNULL(PR.IsApproved, '') AS IsApproved
                FROM " . CommonTables::PRODUCT_REVIEW . " PR
                INNER JOIN " . CommonTables::PRODUCT . " P
                ON P.Id = PR.ProductId ORDER BY PR.Id DESC";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }


    public function checkProduct($ProductName, $SubcatId){
        $query = "
                SELECT
                CT.Id AS Id,
                IFNULL(CT.ProductName, '') AS ProductName,
                IFNULL(CT.SubCategoryId, '') AS SubCategoryId,
                IFNULL(CT.IsActive, '') AS IsActive
                FROM " . CommonTables::PRODUCT . " CT
                WHERE 1=1
                AND CT.ProductName='" . $ProductName . "'
                AND CT.SubCategoryId='" . $SubcatId . "'";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }



    public function addProduct($arg){

        $query = "INSERT INTO  " . CommonTables::PRODUCT . " SET
        ProductName='" . $arg['addProductName'] . "',
        CategoryId='" . $arg['addCategoryId'] . "',
        SubCategoryId='" . $arg['addSubcatId'] . "',
        AttributeId='" . $arg['AddProductAttr'] . "',
        AttributeValueId ='" . $arg['AddProductAttrValue'] . "',
        Quantity='" . $arg['addQuantity'] . "',
        Price='" . $arg['addPrice'] . "',
        DiscountedPrice='" . $arg['discountPrice'] . "',
        DiscountType='" . $arg['adDiscountType'] . "',
        Description='" . $arg['addDesc'] . "',
        IsActive = 0
        ";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $recordId = $this->pdoConn->lastInsertId();
        if ($recordId > 0) {
            return $recordId;
        } else {
            return false;
        }
    }



    public function enableDisableReview($recordId, $isActive)
    {

        $query = "
                     UPDATE  " . CommonTables::PRODUCT_REVIEW . " SET
                    IsApproved='" . $isActive . "'
                    WHERE Id='" . $recordId . "'
        ";
        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }






    public function deleteReview( $recordId)
    {
        $query = "DELETE FROM " . CommonTables::PRODUCT_REVIEW . "
        WHERE Id='" . $recordId . "'
        ";

        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteImage($recordId)
    {
        $query = "DELETE FROM " . CommonTables::PRODUCT_IMAGE_MAPPING . "
        WHERE ProductId='" . $recordId . "'
        ";
//        return $query;die;
        $stmt = $this->pdoConn->prepare($query);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateProduct($arg,$recordId)
    {

        $query = "UPDATE  " . CommonTables::PRODUCT . " SET
        ProductName='" . $arg['ProductName'] . "',
        CategoryId='" . $arg['CategoryId'] . "',
        SubCategoryId='" . $arg['SubCatId'] . "',
        Price='" . $arg['Price'] . "',
        Quantity='" . $arg['Quantity'] . "',
        Description='" . $arg['Desc'] . "',
        DiscountedPrice='" . $arg['DiscountedPrice'] . "'
        WHERE Id='" . $recordId . "'
        ";

        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }



    //Shobhit Singh

    public function getAttributes()
    {

        $query = "SELECT * FROM " . CommonTables::PRODUCT_ATTRIBUTE . "";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function getAttributeValue($data)
    {
        $query = "SELECT AttributeValue, Id FROM " . CommonTables::PRODUCT_ATTRIBUTE_VALUE . "
         WHERE (AttributeId = :attrId AND SubCategoryId = :subCatId AND IsActive = 1)";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute([
            "attrId"    =>  $data['attrId'],
            "subCatId"    =>  $data['subCatId']
        ]);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }



}

?>
