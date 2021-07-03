<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class Site_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }



    public function getProduct()
    {

        $query = "
SELECT
P.Id AS Id,
P.ProductName AS ProductName,
P.Price AS ActualPrice,
P.DiscountedPrice AS DiscountedPrice
FROM " . CommonTables::PRODUCT . " P
WHERE 1=1
AND P.IsActive='" . CommonConstants::YES . "'
AND P.CreatedOn >= DATE_SUB( CURDATE( ) ,INTERVAL " . CommonConstants::OLDER_THAN . " )
ORDER BY RAND()
LIMIT 10


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

    public function getProductMainImage($productId)
    {
        $query = "
SELECT
PI.Id AS Id,
IFNULL(PI.ImageName, '') AS ImageName,
IFNULL(PI.bigImage, '') AS bigImage

FROM " . CommonTables::PRODUCT_IMAGE_MAPPING . " PI
WHERE sortorder=0
AND PI.IsActive='" . CommonConstants::YES . "'
AND PI.ProductId='" . $productId . "'
LIMIT 1

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

    public function getProductById($productId)
    {
        $query = "
                SELECT
                P.Id AS Id,
                IFNULL(P.ProductName,'') AS ProductName,
                IFNULL(P.CategoryId,'') AS CategoryId,
                IFNULL(PC.CategoryName,'') AS CategoryName,
                IFNULL(P.SubCategoryId,'') AS SubCategoryId,



                IFNULL(P.AttributeId,'') AS AttributeId,
                IFNULL(PA.AttributeName,'') AS AttributeName,
                IFNULL(P.AttributeValueId,'') AS AttributeValueId,
                IFNULL(PAV.AttributeValue,'') AS AttributeValue,
                IFNULL(P.Price,'00.00') AS Price,
                IFNULL(P.DiscountedPrice,'00.00') AS DiscountedPrice,

                IFNULL(P.Quantity,'') AS Quantity,
                IFNULL(P.Detail,'') AS Detail,
                IFNULL(P.Description,'') AS Description,
                IFNULL(P.IsFeatured,0) AS IsFeatured,
                P.ShowToUser
                FROM " . CommonTables::PRODUCT . " P
                INNER JOIN " . CommonTables::PRODUCT_CATEGORY . " PC ON PC.Id=P.CategoryId


                LEFT JOIN " . CommonTables::PRODUCT_ATTRIBUTE . " PA ON PA.Id=P.AttributeId
                LEFT JOIN " . CommonTables::PRODUCT_ATTRIBUTE_VALUE . " PAV
                ON PAV.Id=P.    AttributeValueId
                WHERE P.Id='" . $productId . "' AND P.IsActive = '1'";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function getProductImages($productId)
    {
        $query = "
SELECT
PI.Id AS Id,
IFNULL(PI.ImageName, '') AS ImageName,
IFNULL(PI.sortorder, '') AS sortorder
FROM " . CommonTables::PRODUCT_IMAGE_MAPPING . " PI
WHERE 1=1
AND PI.IsActive='" . CommonConstants::YES . "'
AND PI.ProductId='" . $productId . "'

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
		
	public function getProductAngelImages($productId)
    {
        $query = "SELECT * from product_images where product_id=$productId and status='1'";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }
	public function getProductColorImages($productId)
    {
        $query = "SELECT * from product_images where product_id=$productId and status='1' GROUP BY attribute";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }



    public function getProductAttributes($productId, $attrID){

        $stmt = $this->pdoConn->prepare("
              SELECT
              PAM.Id AS PAVMId, PAM.ProductId, PAM.AttributeId,
              PAP.Id AS AttributePriceId, PAP.Price, PAP.DiscountedPrice,
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
              WHERE PAP.ProductId = $productId AND PAM.AttributeId=$attrID
              GROUP BY PAV.Id ORDER BY PAP.Id DESC");

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    
    
    public function getAttributeName($proId){
        $query = "
        SELECT *
        FROM " . CommonTables::PRODUCT_ATTRIBUTE_MAPPING . " PAM
        INNER JOIN " . CommonTables::PRODUCT_ATTRIBUTE . " PA
        ON PAM.AttributeId = PA.Id
        WHERE PAM.ProductId = '".$proId."'
            group by PAM.AttributeId
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

    public function getProductAttributeValues($productAttributeMappingId) {
        $query = "
        SELECT
        PAVM.Id AS PAVMId,
        PAVM.AttrValueId AS AttributeValueId,
        PAV.AttributeValue AS AttributeValue,
        PAP.Price, PAP.DiscountedPrice,
        PA.Id AS AttributeId
        FROM " . CommonTables::PRODUCT_ATTRIBUTE_VALUE_MAPPING . " PAVM
        INNER JOIN " . CommonTables::PRODUCT_ATTRIBUTE_VALUE . " PAV
        ON PAV.Id = PAVM.AttrValueId
        INNER JOIN " . CommonTables::PRODUCT_ATTRIBUTE_PRICE . " PAP
        ON PAP.PAVId = PAVM.AttrValueId
        LEFT JOIN " . CommonTables::PRODUCT_ATTRIBUTE . " PA
        ON PA.Id = PAV.AttributeId
        WHERE PAVM.IsActive='" . CommonConstants::YES . "'
        AND PAVM.ProAttrMappingId='" . $productAttributeMappingId . "'
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
    
    public function getFeaturedProduct()
    {

        $query = "
SELECT
P.Id AS Id,
P.ProductName AS ProductName,
P.Price AS ActualPrice,
P.DiscountedPrice AS DiscountedPrice
FROM " . CommonTables::PRODUCT . " P
WHERE 1=1 AND IsFeatured = 1
AND P.IsActive='" . CommonConstants::YES . "'

ORDER BY RAND()
LIMIT 10


        ";
        
//echo $query;die;
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }
    
   public function saveContactQuery($post){
	   $date = date('Y-m-d');
		$query = "INSERT INTO ".CommonTables::CONTACTUS."
		SET name = '".$post['name']."',
		email = '".$post['email']."',
		mobile = '".$post['phone']."',
		address = '".$post['address']."',
		comment = '".$post['query']."',
		type = '".$post['type']."',
		created_at = '".$date."'
		";
		
		
		$stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
	}
	
	public function saveBecomeQuery($post){
        $landline = $post['areacode'].''.$post['landline'];
	   $date = date('Y-m-d');
	    $name = $post["name"];
		$lname = $post["lname"];
	    $full_name = $name.' ';$lname;
		$query = "INSERT INTO ".CommonTables::BECOMEDEALER."
		SET name = '".$full_name."',
		email = '".$post['email']."',
		company = '".$post['company']."',
		mobile = '".$post['mobile']."',
		pan = '".$post['pan']."',
		gst_no = '".$post['gst_no']."',
		landline = '".$landline."',
		address = '".$post['address']."',
		landmark = '".$post['landmark']."',
		city = '".$post['city']."',
		pincode = '".$post['pincode']."',
		country = '".$post['country']."',
		state = '".$post['state']."',
		comment = '".$post['comment']."',
		created_at = '".$date."'
		";
		$stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
	}
   
   public function checknewsLetter($email){
   	$query = "SELECT * FROM newsletter WHERE email='".$email."'";
   	
   	$stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->rowCount(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
   }
   
   public function newsLetter($email){
   	$date = date('Y-m-d');
   	$query = "INSERT INTO newsletter SET email = '".$email."' , createOn = '".$date."'";
   	
   	$stmt = $this->pdoConn->prepare($query);
        if($stmt->execute()){
        	return true;
        }else{
        	return false;
        }
   }
   
   public function getBlogs(){
        $query = "
              SELECT *
              FROM ".CommonTables::BLOGS."
                 where 1=1
             ";

        $stmt = $this->pdoConn->prepare($query);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
	}	
	
	public function getValue()
    {
        $query = "
                SELECT
                *

                FROM " . CommonTables::SETTING . " CT
                WHERE 1=1";


        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }
   
    
}
