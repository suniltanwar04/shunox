<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class AdminProduct_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }


    /*---------------Product Start ---------------*/





    public function getProduct()
    {

        $query = "
                SELECT
                CT.Id AS Id, CT.ShowToUser,
                IFNULL(CT.ProductName, '') AS ProductName,
                IFNULL(CT.Price, '') AS Price,
                IFNULL(CT.Quantity, '') AS Quantity,
                IFNULL(CT.Description, '') AS Description,
                IFNULL(CT.DiscountedPrice, '') AS DiscountedPrice,
                IFNULL(CT.SubCategoryId, '') AS SubCategoryId,
             
                IFNULL(CT.IsActive, '') AS IsActive
                FROM " . CommonTables::PRODUCT . " CT
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


    public function checkProduct($ProductName, $SubcatId)
    {
        $query = "
                SELECT
                CT.Id AS Id,
                IFNULL(CT.ProductName, '') AS ProductName,
                IFNULL(CT.SubCategoryId, '') AS SubCategoryId,
                IFNULL(CT.IsActive, '') AS IsActive
                FROM " . CommonTables::PRODUCT . " CT
                WHERE 1=1
                AND CT.ProductName='" . $ProductName . "'
                AND CT.SubCategoryId='" . $SubcatId . "'
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



    public function addProduct($arg){
        $date = date('Y-m-d H:i:s');
      $isFeatured = isset($arg['isFeatured']) ? : 0;
      $isLifeStyle = isset($arg['isLifeStyle']) ? : 0;
      
      if($arg['addSubcatId']!=''){
      	$sub = $arg['addSubcatId'];
      }else{
      	$sub = 0;
      }
      
      if($arg['AddProductAttr']!=''){
      	$att = $arg['AddProductAttr'];
      }else{
      	$att = 0;
      }
      
      if($arg['AddProductAttrValue']!=''){
      	$AddProductAttrValue = $arg['AddProductAttrValue'];
      }else{
      	$AddProductAttrValue = 0;
      }
    
        $query = "INSERT INTO  " . CommonTables::PRODUCT . " SET
        ProductName='" . $arg['addProductName'] . "',
        CategoryId='" . $arg['addCategoryId'] . "',
        SubCategoryId='" . $sub  . "',
        AttributeId='" . $att . "',
        AttributeValueId ='" . $AddProductAttrValue . "',
        Quantity='" . $arg['addQuantity'] . "',
        Price='" . $arg['addPrice'] . "',
        DiscountedPrice='" . $arg['discountPrice'] . "',
        Description='" . addslashes($arg['addDesc']) . "',
        Detail = '" . addslashes($arg['addDet']) . "',
        Gender='" . $arg['addGender'] . "',
        ShowToUser='" . $arg['showToUser'] . "',
        IsFeatured='" . $isFeatured . "',
        IsLifeStyle='" . $isLifeStyle . "',
            CreatedOn='" . $date . "',
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

    public function addImage($bigimg,$smallimg, $recordId,$ImageType, $sortorder){


        $query = "INSERT INTO  " . CommonTables::PRODUCT_IMAGE_MAPPING . " SET
        ProductId='" . $recordId . "',
        ImageName='" . $smallimg . "',
        imagePath='" . $smallimg . "',
        bigImage = '".$bigimg."',
        ImageType='" . $ImageType . "',
        sortorder = '" . $sortorder . "',
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
	public function addImageAttr($product_id, $ProductAttrValue, $bigimag){

        $query = "INSERT INTO  product_images SET
        product_id='" . $product_id . "',
        attribute	='" . $ProductAttrValue . "',
        image='" . $bigimag . "',
        status = '1'
        ";
		// return $query;
            $stmt = $this->pdoConn->prepare($query);
            $stmt->execute();

        $recordId = $this->pdoConn->lastInsertId();
        if ($recordId > 0) {
            return $recordId;
        } else {
            return false;
        }
    }


    public function enableDisableProduct($recordId, $isActive)
    {

        $query = "
                     UPDATE  " . CommonTables::PRODUCT . " SET
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


    public function getProductById($recordId) {

        $query = "
            SELECT
            P.*,
            PAV.AttributeValue,
            PA.AttributeName,
            C.CategoryName,
            SC.SubCategoryName
            FROM " . CommonTables::PRODUCT . " P
            LEFT JOIN ".CommonTables::PRODUCT_ATTRIBUTE." PA
            ON PA.Id = P.AttributeId
            LEFT JOIN ".CommonTables::PRODUCT_CATEGORY." C
            ON C.Id = P.CategoryId
            LEFT JOIN ".CommonTables::PRODUCT_SUB_CATEGORY." SC
            ON SC.Id = P.SubCategoryId
            LEFT JOIN ".CommonTables::PRODUCT_ATTRIBUTE_VALUE." PAV
            ON PAV.AttributeId = P.AttributeId AND
            PAV.SubCategoryId = P.SubCategoryId
            WHERE P.Id ='" . $recordId . "'";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function getProductimageById($recordId)
    {

        $query = "
                    SELECT
                    CT.Id AS Id,
                    IFNULL(S.ProductId, '') AS ProductId,
                    IFNULL(S.ImageName, '') AS ImageName,
                    IFNULL(CT.IsActive, '') AS IsActive
                    FROM " . CommonTables::PRODUCT . " CT
                    INNER JOIN " . CommonTables::PRODUCT_IMAGE_MAPPING . " S ON CT.Id = S.ProductId
                    WHERE CT.Id='" . $recordId . "'

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



    public function deleteProduct( $recordId)
    {
        $query = "DELETE FROM " . CommonTables::PRODUCT . "
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
        $stmt = $this->pdoConn->prepare($query);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateProduct($arg,$productId){

      $isFeatured = isset($arg['isFeatured']) ? : 0;
      $isLifeStyle = isset($arg['isLifeStyle']) ? : 0;

        $query = "UPDATE  " . CommonTables::PRODUCT . " SET
        ProductName='" . $arg['productName'] . "',
        CategoryId='" . $arg['category'] . "',
        SubCategoryId='" . $arg['subcategory'] . "',
        Quantity='" . $arg['quantity'] . "',
        Description='" . addslashes($arg['description']) . "',
        Detail = '" . addslashes($arg['detail']) . "',
        Price = '" . $arg['price'] . "',
        DiscountedPrice = '" . $arg['dis_price'] . "',
        IsFeatured='" . $isFeatured . "',
        IsLifeStyle='" . $isLifeStyle . "'
        WHERE Id = '".$productId."'";

        if($arg['price']!='' || $arg['dis_price']!=''){
            $updatePrice = "UPDATE ".CommonTables::PRODUCT_ATTRIBUTE_PRICE." SET Price='" . $arg['price'] . "',DiscountedPrice='" . $arg['dis_price'] . "' WHERE ProductId='" . $productId . "'";
            $stmtPrice = $this->pdoConn->prepare($updatePrice);
            $stmtPrice->execute();
        }

        $stmt = $this->pdoConn->prepare($query);
        if($stmt->execute()){
          return true;
        }else{
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

    public function getAttributeValue($data)
    {
        $query = "SELECT AttributeValue, Id
        FROM " . CommonTables::PRODUCT_ATTRIBUTE_VALUE . "
        WHERE AttributeId = :attrId AND SubCategoryId = :subCatId AND IsActive = '1'
        GROUP BY AttributeValue";
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

    public function getAttributesBysubCategory($subCategory){
      $stmt = $this->pdoConn->prepare("
              SELECT PAV.Id, PA.Id AS AttributeId, PA.AttributeName
              FROM ".CommonTables::PRODUCT_ATTRIBUTE_VALUE." AS PAV
              LEFT JOIN ".CommonTables::PRODUCT_ATTRIBUTE." AS PA
              ON PA.Id = PAV.AttributeId
              WHERE PAV.SubCategoryId = '".$subCategory."'
              GROUP BY PAV.AttributeId");
              $stmt->execute();
              return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function mapProductAttribute($recordId,$ProductAttribute){
      $query = "INSERT INTO  " . CommonTables::PRODUCT_ATTRIBUTE_MAPPING . " SET
        ProductId ='" . $recordId . "',
        AttributeId = '".$ProductAttribute."',
        IsActive='1'";
        $stmt = $this->pdoConn->prepare($query);
        if($stmt->execute()){
          return $this->pdoConn->lastInsertId();
        }else{
          return false;
        }
    }

    public function mapProductAttributeValue($recordId,$ProductAttributeValue){
      $query = "INSERT INTO  " . CommonTables::PRODUCT_ATTRIBUTE_VALUE_MAPPING . " SET
        ProAttrMappingId ='" . $recordId . "',
        AttrValueId = '".$ProductAttributeValue."',
        IsActive='1'";
        $stmt = $this->pdoConn->prepare($query);
        if($stmt->execute()){
          return $this->pdoConn->lastInsertId();
        }else{
          return false;
        }
    }

    public function addProductPrice($productAttrValue,$productId,$price,$discountPrice,$InProduct = 1){
      $query = "INSERT INTO  " . CommonTables::PRODUCT_ATTRIBUTE_PRICE . " SET
        PAVId ='" . $productAttrValue . "',
        ProductId = '".$productId."',
        Price = '".$price."',
        DiscountedPrice = '".$discountPrice."',
        InProduct = '".$InProduct."',
        IsActive='1'";
        $stmt = $this->pdoConn->prepare($query);
        if($stmt->execute()){
          return $this->pdoConn->lastInsertId();
        }else{
          return false;
        }
    }

    public function getProductTableHeading(){
      $query = "SELECT * FROM ".CommonTables::PRODUCT." LIMIT 0, 1";
          $stmt = $this->pdoConn->prepare($query);
          $stmt->execute();
          return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function attributeValuesBySubCategoryAndAttribute($data){
      $query = "SELECT Id, AttributeValue FROM ".CommonTables::PRODUCT_ATTRIBUTE_VALUE."
        WHERE AttributeId = '".$data[0]."' AND SubCategoryId = '".$data[1]."'GROUP BY Id";
          $stmt = $this->pdoConn->prepare($query);
          $stmt->execute();
          return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function addCsvProduct($product){
      $query = "INSERT INTO  " . CommonTables::PRODUCT . " SET
      ProductName ='" . $product[0] . "',
      CategoryId='" . $product[1] . "',
      SubCategoryId='" . $product[2] . "',
      AttributeId='" . $product[3] . "',
      AttributeValueId ='" . $product[4] . "',
      Price='" . $product[5] . "',
      Quantity='" . $product[6] . "',
      Description='" . $product[7] . "',
      DiscountedPrice='" . $product[8] . "',
      ShowToUser='" . $product[9] . "',
      IsFeatured='" . $product[10] . "',
      IsLifeStyle='" . $product[11] . "',
      IsActive = 0
      ";
      $stmt = $this->pdoConn->prepare($query);
      if($stmt->execute()){
        return $this->pdoConn->lastInsertId();
      }else{
        return 0;
      }
    }

    public function addCsvImages($productId,$image){
      $query = "INSERT INTO  " . CommonTables::PRODUCT_IMAGE_MAPPING . " SET
      ProductId='" . $productId . "',
      ImageName='" . $image . "',
      imagePath='" . $image . "',
      ImageType = 1,
      IsActive='1'
      ";
        $stmt = $this->pdoConn->prepare($query);
      if ($stmt->execute()) {
          return 1;
      } else {
          return 0;
      }
    }


    public function getUserToNotify($productId){
        $stmt = $this->pdoConn->prepare("
          SELECT N.UserId, U.Mobile, U.FullName
          FROM ".CommonTables::NOTIFY_ME."  AS N
          LEFT JOIN ".CommonTables::USER." AS U
          ON U.Id = N.UserId
          WHERE N.ProductId = ".$productId."
          GROUP BY N.Id
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function deleteNotifiedUser($userId,$productId){
        $stmt = $this->pdoConn->prepare("
          DELETE FROM ".CommonTables::NOTIFY_ME."
          WHERE ProductId = ".$productId." AND UserId = ".$userId."");
        $stmt->execute();
    }

public function updateProductPrice($price,$coloum,$productId){

    $query = "
    UPDATE " . CommonTables::PRODUCT . " SET
    $coloum ='" . $price . "'
    WHERE Id = '".$productId."'";
    $stmt = $this->pdoConn->prepare($query);
    if($stmt->execute()){
      return true;
    }else{
      return false;
    }
}


}

?>
