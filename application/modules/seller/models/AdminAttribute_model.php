<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class AdminAttribute_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }



     public function getSubCategoryId($id)
    {

        $query = "
                SELECT

                SubCategoryId


                FROM " . CommonTables::PRODUCT . " WHERE Id=".$id;


        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

     public function addAttributePAP($arg)
    {


        $query = "INSERT INTO ". CommonTables::PRODUCT_ATTRIBUTE_PRICE." SET

        PAVId='".$arg['PAVId']."',
        ProductId='".$arg['productId']."',
        Price='" . $arg['Price'] . "',

        DiscountedPrice='" . $arg['DiscountedPrice'] . "',
        IsActive='1'
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

    public function getQuery($arg)
    {

        $query = "INSERT INTO ". CommonTables::PRODUCT_ATTRIBUTE_VALUE." SET

        AttributeId='3',
        SubCategoryId='3',
        AttributeValue='".$arg."',
        IsActive='1'
        ";

        return($query);
    }

    public function addAttributePAV($arg)
    {
        //print_r($arg); echo $arg['size']; die;
        $query='';
        if($arg['color']!='')
        {
            $query = getQuery($arg['color']);
        }
        elseif($arg['size']!='')
        {

           $query = getQuery($arg['size']);

        }
        elseif($arg['length']!='')
        {
           $query = getQuery($arg['length']);
        }


        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $recordId = $this->pdoConn->lastInsertId();
        if ($recordId > 0) {
            return $recordId;
        } else {
            return false;
        }
    }

    public function addAttributePAM($arg)
    {


        $query = "INSERT INTO ". CommonTables::PRODUCT_ATTRIBUTE_MAPPING." SET

        AttributeId='3',
        ProductId='".$arg['productId']."',

        IsActive='1'
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


    public function addAttributePAVM($arg)
    {


        $query = "INSERT INTO ". CommonTables::PRODUCT_ATTRIBUTE_VALUE_MAPPING." SET

        ProAttrMappingId='3',
        AttrValueId='5',

        IsActive='1'
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





    public function getProductPrice($productId) {
        $query = "
SELECT
PAP.Id AS PriceId,
IFNULL(PAP.Price,'') AS Price,
IFNULL(PAP.DiscountedPrice,'') AS DiscountedPrice,
IFNULL(PAV.AttributeValue,'') AS AttributeValue,
IFNULL(PA.AttributeName,'') AS AttributeName





FROM " . CommonTables::PRODUCT_ATTRIBUTE_PRICE . " PAP
LEFT JOIN " . CommonTables::PRODUCT_ATTRIBUTE_VALUE_MAPPING . " PAVM ON PAVM.Id=PAP.PAVId
LEFT JOIN " . CommonTables::PRODUCT_ATTRIBUTE_VALUE . " PAV ON PAV.Id=PAVM.AttrValueId
LEFT JOIN " . CommonTables::PRODUCT_ATTRIBUTE . " PA ON PA.Id=PAV.AttributeId

WHERE 1=1
AND PAP.IsActive='" . CommonConstants::YES . "'
AND PAP.ProductId='" . $productId . "'

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


    public function getAttributeById($recordId)
    {
        $query = "
                  SELECT
                  C.Id AS Id,
                  IFNULL(C.AttributeName, '') AS AttributeName,
                  IFNULL(C.IsActive, '') AS IsActive
                  FROM " . CommonTables::PRODUCT_ATTRIBUTE . " C
                  WHERE 1=1
                  AND C.Id='" . $recordId . "'
                ";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }
    /*--------------------------fsdfds-------------------------------------------------------------------*/








    /*---------------Attribute starts ---------------*/




    public function checkAttributeName($AttributeName)
    {
        $query = "
                  SELECT
                  C.Id AS Id,
                  IFNULL(C.AttributeName, '') AS AttributeName
                  FROM " . CommonTables::PRODUCT_ATTRIBUTE . " C
                  WHERE 1=1
                  AND C.AttributeName='" . $AttributeName . "'
                ";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }



    public function addAttribute($AttributeName)
    {
        $query = "
                    INSERT INTO  " . CommonTables::PRODUCT_ATTRIBUTE . " SET
                    AttributeName='" . $AttributeName . "',
                    IsActive='1'
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



    public function updateAttribute($editAttributeName, $recordId)
    {
        $query = "
        UPDATE " . CommonTables::PRODUCT_ATTRIBUTE . " SET
        AttributeName='" . $editAttributeName . "'
        WHERE id='" . $recordId . "'
        ";

        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function enableDisableAttribute($recordId, $isActive)
    {
        $query = "
                    UPDATE  " . CommonTables::PRODUCT_ATTRIBUTE . " SET
                    IsActive='" . $isActive . "'
                    WHERE Id='" . $recordId . "'
        ";
        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    /*---------------Attribute End ---------------*/

    /*---------------Attribute Value Starts ---------------*/

    public function getAttributeValues()
    {
        $query = "
                  SELECT
                  C.Id AS Id,
                  IFNULL(C.AttributeId, '') AS AttributeId,
                  IFNULL(K.SubCategoryName, '') AS SubCategoryName,
                  IFNULL(C.SubCategoryId, '') AS SubCategoryId,
                  IFNULL(C.AttributeValue, '') AS AttributeValue,
                  IFNULL(C.IsActive, '') AS IsActive,
                  IFNULL(S.AttributeName, '') AS AttributeName
                  FROM " . CommonTables::PRODUCT_ATTRIBUTE_VALUE . " C
                  INNER JOIN " . CommonTables::PRODUCT_ATTRIBUTE . " S ON S.Id=C.AttributeId
                  INNER JOIN " . CommonTables::PRODUCT_SUB_CATEGORY . " K ON K.Id=C.SubCategoryId
                  ORDER BY C.AttributeValue,S.AttributeName asc
                ";
//return $query;
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function checkAttributeValueName($SubCatId, $AttributeValue){
        $query = "SELECT Id
                  FROM " . CommonTables::PRODUCT_ATTRIBUTE_VALUE . "
                  WHERE AttributeValue ='" . $AttributeValue . "'
                  AND SubCategoryId = '".$SubCatId."'";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function addAttributeValue($SubCatId,$Attributeid,$AttributeValue){
        $query = "
                    INSERT INTO  " . CommonTables::PRODUCT_ATTRIBUTE_VALUE . " SET
                    AttributeId ='" . $Attributeid . "',
                    SubCategoryId ='" . $SubCatId . "',
                    AttributeValue ='" . $AttributeValue . "',
                    IsActive ='1'";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $recordId = $this->pdoConn->lastInsertId();
        if ($recordId > 0) {
            return $recordId;
        } else {
            return false;
        }
    }

    public function getAttributeValueById($recordId)
    {
        $query = "
                  SELECT
                  C.Id AS Id,
                  IFNULL(C.AttributeId, '') AS AttributeId,
                  IFNULL(C.SubCategoryId, '') AS SubCategoryId,
                  IFNULL(C.AttributeValue, '') AS AttributeValue,
                  IFNULL(C.IsActive, '') AS IsActive
                  FROM " . CommonTables::PRODUCT_ATTRIBUTE_VALUE . " C
                  WHERE 1=1
                  AND C.Id='" . $recordId . "'
                ";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }




    public function updateAttributeValue($editSubCatValueId,$AttributevalueId,$AttributeValue, $recordId)
    {
        $query = "
        UPDATE " . CommonTables::PRODUCT_ATTRIBUTE_VALUE . " SET
        AttributeId='" . $AttributevalueId . "',
        SubCategoryId='" . $editSubCatValueId . "',
        AttributeValue='" . $AttributeValue . "'
        WHERE id='" . $recordId . "'
        ";

        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function enableDisableAttributeValue($recordId, $isActive){
        $query = "
                    UPDATE  " . CommonTables::PRODUCT_ATTRIBUTE_VALUE . " SET
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



    //shobhit singh


    public function getProductAttributes($pro_id){
      $stmt = $this->pdoConn->prepare("
            SELECT
            PAM.Id AS PAVMId, PAM.ProductId, PAM.AttributeId,
            PAP.Id AS AttributePriceId, PAP.Price, PAP.DiscountedPrice,PAP.InProduct,
            P.SubCategoryId,
            PA.AttributeName,
            PAV.AttributeValue,
            PAVM.AttrValueId AS AttributeValueId
            FROM ".CommonTables::PRODUCT_ATTRIBUTE_MAPPING." as PAM
            LEFT JOIN ".CommonTables::PRODUCT." as P
            ON P.Id = PAM.ProductId
            LEFT JOIN ".CommonTables::PRODUCT_ATTRIBUTE." as PA
            ON PA.Id = PAM.AttributeId
            LEFT JOIN ".CommonTables::PRODUCT_ATTRIBUTE_VALUE_MAPPING." as PAVM
            ON PAVM.ProAttrMappingId = PAM.Id
            LEFT JOIN ".CommonTables::PRODUCT_ATTRIBUTE_VALUE." as PAV
            ON PAV.Id = PAVM.AttrValueId
            LEFT JOIN ".CommonTables::PRODUCT_ATTRIBUTE_PRICE." as PAP
            ON PAP.PAVId = PAVM.AttrValueId
            WHERE PAP.ProductId = $pro_id
            GROUP BY PAV.Id ORDER BY PAP.Id DESC");

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
	public function getProductImages($pro_id){
      $stmt = $this->pdoConn->prepare("SELECT * from product_images WHERE product_id=$pro_id");

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
	public function productImagesDelete($id){
      $stmt = $this->pdoConn->prepare("DELETE from product_images WHERE id=$id");

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function attributeValue($data){
        $stmt = $this->pdoConn->prepare("
            SELECT Id, AttributeValue FROM ".CommonTables::PRODUCT_ATTRIBUTE_VALUE."
            WHERE (AttributeId = :attrId  AND IsActive = 1)");
        $stmt->execute(["attrId"    =>  $data['id']]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function checkAttributeMapping($pro_id, $attr_id){
        $stmt = $this->pdoConn->prepare("
            SELECT Id FROM ".CommonTables::PRODUCT_ATTRIBUTE_MAPPING."
            WHERE ProductId = :proId AND AttributeId = :attrId");
        $stmt->execute(['proId' => $pro_id, 'attrId'    =>   $attr_id]);

        if($stmt->rowCount() > 0){
            return false;
        }else{
            return true;
        }
    }

    public function mapAttribute($pro_id, $attr_id){
        $stmt = $this->pdoConn->prepare("
            INSERT INTO ".CommonTables::PRODUCT_ATTRIBUTE_MAPPING."
            (ProductId, AttributeId) VALUE (:proId, :attrId)");
           if($stmt->execute(['proId' => $pro_id, 'attrId' => $attr_id])){
               return true;
           }else{
               return false;
           }
    }


    public function checkAttributeValueMapping($data){
        $stmt = $this->pdoConn->prepare("
            SELECT Id FROM ".CommonTables::PRODUCT_ATTRIBUTE_VALUE."
            WHERE SubCategoryId = :subCatId AND AttributeId = :attrId AND AttributeValue = :attrVal");
        $stmt->execute(['subCatId' => $data['SubCategoryId'], 'attrId' =>  $data['ProductsAttr'], "attrVal" =>  $data['SelectAttrVal']]);

        if($stmt->rowCount() > 0){
            return false;
        }else{
            return true;
        }
    }

    public function mapAttributeValue($data){
        $stmt = $this->pdoConn->prepare("
            INSERT INTO ".CommonTables::PRODUCT_ATTRIBUTE_VALUE."
            (AttributeId, SubCategoryId, AttributeValue) VALUE (:attrId, :subCat, :attrValue)");
        if($stmt->execute(['attrId' => $data['ProductsAttr'], 'subCat' => $data['SubCategoryId'], 'attrValue' => $data['SelectAttrVal']])){
            return true;
        }else{
            return false;
        }
    }

    public function checkExistAttribute($productId, $ProductAttr,$ProductAttrValue){
        $stmt = $this->pdoConn->prepare("
            SELECT PAM.Id AS productAttributeMapingId, PAVM.Id
            FROM ".CommonTables::PRODUCT_ATTRIBUTE_MAPPING." AS PAM
            LEFT JOIN ".CommonTables::PRODUCT_ATTRIBUTE_VALUE_MAPPING." AS PAVM
            ON PAVM.ProAttrMappingId = PAM.Id
            WHERE (PAM.ProductId = '".$productId."' AND PAM.AttributeId = '".$ProductAttr."' AND PAVM.AttrValueId = '".$ProductAttrValue."')
        ");
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function updateAttributePrice($price,$coloum,$attributePriceId){
      $stmt = $this->pdoConn->prepare("
            UPDATE " .CommonTables::PRODUCT_ATTRIBUTE_PRICE. " SET
          $coloum = {$price} WHERE Id = ".$attributePriceId."");

      if($stmt->execute()){
        return true;
      }else{
        return false;
      }
    }


}
