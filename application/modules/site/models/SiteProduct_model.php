<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class SiteProduct_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }


    public function getProducts($categoryId, $subCategoryId, $keyword, $minPrice, $maxPrice, $limit, $offset)
    {
        $categoryId = $categoryId ? $categoryId : 'P.CategoryId';
        $subCategoryId = $subCategoryId ? $subCategoryId : 'P.SubCategoryId';
        $minPrice = $minPrice ? $minPrice : 'P.Price';
        $maxPrice = $maxPrice ? $maxPrice : 'P.Price';
        $productNameString = $keyword ? '\'%' . $keyword . '%\'' : 'P.ProductName';
        $productNameStringParam = $keyword ? '\'' . $keyword . '\'' : 'P.ProductName';


        $query = "
SELECT
P.Id AS Id
FROM " . CommonTables::PRODUCT . " P
INNER JOIN ProductAttributeMapping PAM ON PAM.ProductId=P.Id
INNER JOIN ProductAttributeValueMapping PAVM ON PAVM.ProAttrMappingId=PAM.Id
INNER JOIN ProductAttrPrice PAP ON PAP.PAVId=PAVM.Id

WHERE 1=1
AND P.IsActive='" . CommonConstants::YES . "'
AND P.CategoryId = IFNULL(IF(" . $categoryId . " IS NULL OR " . $categoryId . " = '', NULL, " . $categoryId . "), P.CategoryId)
AND P.SubCategoryId = IFNULL(IF(" . $subCategoryId . " IS NULL OR " . $subCategoryId . " = '', NULL, " . $subCategoryId . "), P.SubCategoryId)
AND P.ProductName LIKE IFNULL(IF(" . $productNameStringParam . " IS NULL OR " . $productNameStringParam . " = '', NULL, $productNameString), P.ProductName)
AND P.Price BETWEEN IFNULL(IF(" . $minPrice . " IS NULL OR " . $minPrice . " = '', NULL, " . $minPrice . "), P.Price) AND IFNULL(IF(" . $maxPrice . " IS NULL OR " . $maxPrice . " = '', NULL, " . $maxPrice . "), P.Price)



 LIMIT " . $limit . " OFFSET " . $offset . "
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

    public function getHomeLatestProducts()
    {

        $query = "
SELECT
P.Id AS Id
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

    public function getFeaturedProducts()
    {

        $query = "
SELECT
P.Id AS Id
FROM " . CommonTables::PRODUCT . " P
WHERE 1=1
AND P.IsFeatured='" . CommonConstants::YES . "'
AND P.IsActive='" . CommonConstants::YES . "'
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

    public function getLatestProducts()
    {

        $query = "
SELECT
P.Id AS Id
FROM " . CommonTables::PRODUCT . " P
WHERE 1=1
AND P.IsActive='" . CommonConstants::YES . "'
AND P.CreatedOn >= DATE_SUB( CURDATE( ) ,INTERVAL " . CommonConstants::OLDER_THAN . " )


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

    public function getProductsByCategory($categoryId)
    {
         $query = "
                SELECT
                P.Id AS Id
                FROM " . CommonTables::PRODUCT . " P
                WHERE 1=1
                AND P.IsActive='" . CommonConstants::YES . "'
                AND P.CategoryId='" . $categoryId . "'";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function lifeStyleProduct()
    {
         $query = "
                SELECT
                P.Id AS Id
                FROM " . CommonTables::PRODUCT . " P
                WHERE 1=1
                AND P.IsActive='" . CommonConstants::YES . "'
                AND P.IsLifeStyle = '1'";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }




    public function getProductsBySubCategory($subCategoryId, $limit = 12, $offset = 0)
    {

        $query = "
                SELECT
                P.Id AS Id,
                IFNULL(P.ProductName,'') AS ProductName,
                IFNULL(P.CategoryId,'') AS CategoryId,
                IFNULL(PC.CategoryName,'') AS CategoryName,
                IFNULL(P.SubCategoryId,'') AS SubCategoryId,
                IFNULL(PSC.SubCategoryName,'') AS SubCategoryName,
                IFNULL(P.AttributeId,'') AS AttributeId,
                IFNULL(PA.AttributeName,'') AS AttributeName,
                IFNULL(P.AttributeValueId,'') AS AttributeValueId,
                IFNULL(PAV.AttributeValue,'') AS AttributeValue,
                IFNULL(P.Price,'00.00') AS Price,
                IFNULL(P.DiscountedPrice,'00.00') AS DiscountedPrice,
                IFNULL(P.Quantity,'') AS Quantity,
                IFNULL(P.Description,'') AS Description,
                IFNULL(P.IsFeatured,0) AS IsFeatured
                FROM " . CommonTables::PRODUCT . " P
                INNER JOIN " . CommonTables::PRODUCT_CATEGORY . " PC
                ON PC.Id=P.CategoryId
                INNER JOIN " . CommonTables::PRODUCT_SUB_CATEGORY . " PSC
                ON PSC.Id=P.SubCategoryId
                LEFT JOIN " . CommonTables::PRODUCT_ATTRIBUTE . " PA
                ON PA.Id=P.AttributeId
                LEFT JOIN " . CommonTables::PRODUCT_ATTRIBUTE_VALUE . " PAV
                ON PAV.Id = P.AttributeValueId
                WHERE P.SubCategoryId='" . $subCategoryId . "' AND P.IsActive = '1' LIMIT $offset, $limit";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
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


    public function getProductMainImage($productId)
    {
        $query = "
SELECT
PI.Id AS Id,
IFNULL(PI.ImageName, '') AS ImageName
FROM " . CommonTables::PRODUCT_IMAGE_MAPPING . " PI
WHERE 1=1
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


    public function getProductImages($productId)
    {
        $query = "
SELECT
PI.Id AS Id,
IFNULL(PI.ImageName, '') AS ImageName
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


    public function getProductPrice($productId)
    {
        $query = "
SELECT
PAP.Id AS PriceId,
IFNULL(PAP.Price,'') AS Price,
IFNULL(PAP.DiscountedPrice,'') AS DiscountedPrice,
IFNULL(PA.Id,'') AS AttributeId,
IFNULL(PAV.Id,'') AS AttributeValueId,
IFNULL(PAV.AttributeValue,'') AS AttributeValue,
IFNULL(PA.AttributeName,'') AS AttributeName

FROM " . CommonTables::PRODUCT_ATTRIBUTE_PRICE . " PAP
INNER JOIN " . CommonTables::PRODUCT_ATTRIBUTE_VALUE_MAPPING . " PAVM ON PAVM.Id=PAP.PAVId
INNER JOIN " . CommonTables::PRODUCT_ATTRIBUTE_VALUE . " PAV ON PAV.Id=PAVM.AttrValueId
INNER JOIN " . CommonTables::PRODUCT_ATTRIBUTE . " PA ON PA.Id=PAV.AttributeId

WHERE 1=1
AND PAP.IsActive='" . CommonConstants::YES . "'
AND PAP.ProductId='" . $productId . "'
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


    public function getProductAttributes($productId){

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
              WHERE PAP.ProductId = $productId
              GROUP BY PAV.Id ORDER BY PAP.Id DESC");

          $stmt->execute();
          return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function getProductAttributeValues($productAttributeMappingId)
    {
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


    public function getProductReviews($productId)
    {

        $query = "
SELECT
PR.Id AS Id,
PR.NickName AS NickName,
PR.Summary AS Summary,
PR.Review AS Review,
DATE_FORMAT(PR.CreatedOn,'%d/%m/%Y') AS CreatedOn


FROM " . CommonTables::PRODUCT_REVIEW . " PR
WHERE 1=1
AND PR.ProductId='" . $productId . "'
AND PR.IsApproved='" . CommonConstants::YES . "'
AND PR.IsDeleted='" . CommonConstants::NO . "'


        ";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result['rows'] = $stmt->fetchAll(PDO::FETCH_OBJ);
        $result['rowCount'] = $stmt->rowCount();
        if (!empty($result)) {
            return (object)$result;
        } else {
            return false;
        }
    }

    /*
    \
    \Shobhit Singh
    \01/Feb/2017
    \
    */

    public function getProductsByPrice($data){
        $query = "SELECT P.Id AS Id,
                IFNULL(P.ProductName,'') AS ProductName,
                IFNULL(P.CategoryId,'') AS CategoryId,
                IFNULL(PC.CategoryName,'') AS CategoryName,
                IFNULL(P.SubCategoryId,'') AS SubCategoryId,
                IFNULL(PSC.SubCategoryName,'') AS SubCategoryName,


                IFNULL(P.AttributeId,'') AS AttributeId,
                IFNULL(PA.AttributeName,'') AS AttributeName,
                IFNULL(P.AttributeValueId,'') AS AttributeValueId,
                IFNULL(PAV.AttributeValue,'') AS AttributeValue,
                IFNULL(P.Price,'00.00') AS Price,
                IFNULL(P.DiscountedPrice,'00.00') AS DiscountedPrice,

                IFNULL(P.Quantity,'') AS Quantity,

                IFNULL(P.Description,'') AS Description,
                IFNULL(P.IsFeatured,0) AS IsFeatured
                FROM " . CommonTables::PRODUCT . " P
                INNER JOIN " . CommonTables::PRODUCT_CATEGORY . " PC ON PC.Id=P.CategoryId
                INNER JOIN " . CommonTables::PRODUCT_SUB_CATEGORY . " PSC ON PSC.Id=P.SubCategoryId

                LEFT JOIN " . CommonTables::PRODUCT_ATTRIBUTE . " PA ON PA.Id=P.AttributeId
                LEFT JOIN " . CommonTables::PRODUCT_ATTRIBUTE_VALUE . " PAV ON PAV.Id=P.AttributeValueId
                WHERE 1=1
                AND P.categoryId='" . $data['category'] . "'
                 AND P.Price BETWEEN '".$data['min']."' AND '".$data['max']."'
                 ORDER BY P.Price ASC";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function searchForProduct($key, $min = 0, $max = 10000000000){

        $search = str_replace('%20', ' ', $key);
      $query = "
        SELECT P.Id AS Id,
        IFNULL(P.ProductName,'') AS ProductName,
        IFNULL(P.CategoryId,'') AS CategoryId,
        IFNULL(P.SubCategoryId,'') AS SubCategoryId,
        IFNULL(P.AttributeId,'') AS AttributeId,
        IFNULL(P.AttributeValueId,'') AS AttributeValueId,
        IFNULL(P.Price,'00.00') AS Price,
        IFNULL(P.DiscountedPrice,'00.00') AS DiscountedPrice,
        IFNULL(P.Quantity,'') AS Quantity,
        IFNULL(P.Description,'') AS Description,
        IFNULL(P.IsFeatured,0) AS IsFeatured
        FROM " . CommonTables::PRODUCT . " P

        WHERE P.ProductName LIKE '%".$search."%' GROUP BY P.Id";

      $stmt = $this->pdoConn->prepare($query);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /*------------------------ Price filters --------------------------------*/

    public function priceFilterWithCategory($category,$min,$max){
      $query = "
                SELECT
                P.Id AS Id,
                IFNULL(P.ProductName,'') AS ProductName,
                IFNULL(P.CategoryId,'') AS CategoryId,
                IFNULL(PC.CategoryName,'') AS CategoryName,
                IFNULL(P.SubCategoryId,'') AS SubCategoryId,
                IFNULL(PSC.SubCategoryName,'') AS SubCategoryName,
                IFNULL(P.AttributeId,'') AS AttributeId,
                IFNULL(PA.AttributeName,'') AS AttributeName,
                IFNULL(P.AttributeValueId,'') AS AttributeValueId,
                IFNULL(PAV.AttributeValue,'') AS AttributeValue,
                IFNULL(P.Price,'00.00') AS Price,
                IFNULL(P.DiscountedPrice,'00.00') AS DiscountedPrice,
                IFNULL(P.Quantity,'') AS Quantity,
                IFNULL(P.Description,'') AS Description,
                IFNULL(P.IsFeatured,0) AS IsFeatured
                FROM " . CommonTables::PRODUCT . " P
                INNER JOIN " . CommonTables::PRODUCT_CATEGORY . " PC
                ON PC.Id=P.CategoryId
                INNER JOIN " . CommonTables::PRODUCT_SUB_CATEGORY . " PSC
                ON PSC.Id=P.SubCategoryId
                LEFT JOIN " . CommonTables::PRODUCT_ATTRIBUTE . " PA ON PA.Id=P.AttributeId
                LEFT JOIN " . CommonTables::PRODUCT_ATTRIBUTE_VALUE . " PAV
                ON PAV.Id = P.AttributeValueId WHERE
                (P.CategoryId = '" . $category . "' AND
                P.Price BETWEEN ".$min." AND ".$max." AND
                P.IsActive = '1') GROUP BY P.Id";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function priceFilterWithSubCategory($subcategory,$min,$max){
        if($subcategory > 0) {
            $query = "
                SELECT
                P.Id AS Id,
                IFNULL(P.ProductName,'') AS ProductName,
                IFNULL(P.CategoryId,'') AS CategoryId,
                IFNULL(PC.CategoryName,'') AS CategoryName,
                IFNULL(P.SubCategoryId,'') AS SubCategoryId,
                IFNULL(PSC.SubCategoryName,'') AS SubCategoryName,
                IFNULL(P.AttributeId,'') AS AttributeId,
                IFNULL(PA.AttributeName,'') AS AttributeName,
                IFNULL(P.AttributeValueId,'') AS AttributeValueId,
                IFNULL(PAV.AttributeValue,'') AS AttributeValue,
                IFNULL(P.Price,'00.00') AS Price,
                IFNULL(P.DiscountedPrice,'00.00') AS DiscountedPrice,
                IFNULL(P.Quantity,'') AS Quantity,
                IFNULL(P.Description,'') AS Description,
                IFNULL(P.IsFeatured,0) AS IsFeatured
                FROM " . CommonTables::PRODUCT . " P
                INNER JOIN " . CommonTables::PRODUCT_CATEGORY . " PC
                ON PC.Id=P.CategoryId
                INNER JOIN " . CommonTables::PRODUCT_SUB_CATEGORY . " PSC
                ON PSC.Id=P.SubCategoryId
                LEFT JOIN " . CommonTables::PRODUCT_ATTRIBUTE . " PA
                ON PA.Id=P.AttributeId
                LEFT JOIN " . CommonTables::PRODUCT_ATTRIBUTE_VALUE . " PAV
                ON PAV.Id = P.AttributeValueId WHERE
                (P.SubCategoryId='" . $subcategory . "' AND
                P.Price BETWEEN " . $min . " AND " . $max . " AND
                P.IsActive = '1') GROUP BY P.Id";
        }else{
            $query = "
                SELECT
                P.Id AS Id,
                IFNULL(P.ProductName,'') AS ProductName,
                IFNULL(P.CategoryId,'') AS CategoryId,
                IFNULL(P.SubCategoryId,'') AS SubCategoryId,
                IFNULL(P.AttributeId,'') AS AttributeId,
                IFNULL(P.AttributeValueId,'') AS AttributeValueId,
                IFNULL(P.Price,'00.00') AS Price,
                IFNULL(P.DiscountedPrice,'00.00') AS DiscountedPrice,
                IFNULL(P.Quantity,'') AS Quantity,
                IFNULL(P.Description,'') AS Description,
                IFNULL(P.IsFeatured,0) AS IsFeatured
                FROM " . CommonTables::PRODUCT . " P
                 WHERE
                (P.SubCategoryId='" . $subcategory . "' AND
                P.Price BETWEEN " . $min . " AND " . $max . " AND
                P.IsActive = '1') GROUP BY P.Id";
        }

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function priceFilterWithGender($subcategory,$gender){
        if($subcategory > 0) {
            $query = "
                SELECT
                P.Id AS Id,
                IFNULL(P.ProductName,'') AS ProductName,
                IFNULL(P.CategoryId,'') AS CategoryId,
                IFNULL(PC.CategoryName,'') AS CategoryName,
                IFNULL(P.SubCategoryId,'') AS SubCategoryId,
                IFNULL(PSC.SubCategoryName,'') AS SubCategoryName,
                IFNULL(P.AttributeId,'') AS AttributeId,
                IFNULL(PA.AttributeName,'') AS AttributeName,
                IFNULL(P.AttributeValueId,'') AS AttributeValueId,
                IFNULL(PAV.AttributeValue,'') AS AttributeValue,
                IFNULL(P.Price,'00.00') AS Price,
                IFNULL(P.DiscountedPrice,'00.00') AS DiscountedPrice,
                IFNULL(P.Quantity,'') AS Quantity,
                IFNULL(P.Description,'') AS Description,
                IFNULL(P.IsFeatured,0) AS IsFeatured
                FROM " . CommonTables::PRODUCT . " P
                INNER JOIN " . CommonTables::PRODUCT_CATEGORY . " PC
                ON PC.Id=P.CategoryId
                INNER JOIN " . CommonTables::PRODUCT_SUB_CATEGORY . " PSC
                ON PSC.Id=P.SubCategoryId
                LEFT JOIN " . CommonTables::PRODUCT_ATTRIBUTE . " PA
                ON PA.Id=P.AttributeId
                LEFT JOIN " . CommonTables::PRODUCT_ATTRIBUTE_VALUE . " PAV
                ON PAV.Id = P.AttributeValueId WHERE
                (P.SubCategoryId='" . $subcategory . "' AND
                P.Gender ='" . $gender . "' AND
                P.IsActive = '1') GROUP BY P.Id";
        }else{
            $query = "
                SELECT
                P.Id AS Id,
                IFNULL(P.ProductName,'') AS ProductName,
                IFNULL(P.CategoryId,'') AS CategoryId,
                IFNULL(P.SubCategoryId,'') AS SubCategoryId,
                IFNULL(P.AttributeId,'') AS AttributeId,
                IFNULL(P.AttributeValueId,'') AS AttributeValueId,
                IFNULL(P.Price,'00.00') AS Price,
                IFNULL(P.DiscountedPrice,'00.00') AS DiscountedPrice,
                IFNULL(P.Quantity,'') AS Quantity,
                IFNULL(P.Description,'') AS Description,
                IFNULL(P.IsFeatured,0) AS IsFeatured
                FROM " . CommonTables::PRODUCT . " P
                 WHERE
                (P.SubCategoryId='" . $subcategory . "' AND
                P.Gender =  '" . $gender . "' AND
                P.IsActive = '1') GROUP BY P.Id";
        }

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function getProductsByAttribute($subcategory,$attId){

        $query = "
                SELECT
                P.Id AS Id,
                IFNULL(P.ProductName,'') AS ProductName,
                IFNULL(P.CategoryId,'') AS CategoryId,
                IFNULL(PC.CategoryName,'') AS CategoryName,
                IFNULL(P.SubCategoryId,'') AS SubCategoryId,
                IFNULL(PSC.SubCategoryName,'') AS SubCategoryName,
                IFNULL(P.AttributeId,'') AS AttributeId,

                IFNULL(P.AttributeValueId,'') AS AttributeValueId,
                IFNULL(PAV.AttributeValue,'') AS AttributeValue,
                IFNULL(P.Price,'00.00') AS Price,
                IFNULL(P.DiscountedPrice,'00.00') AS DiscountedPrice,
                IFNULL(P.Quantity,'') AS Quantity,
                IFNULL(P.Description,'') AS Description,
                IFNULL(P.IsFeatured,0) AS IsFeatured
                FROM " . CommonTables::PRODUCT . " P
                INNER JOIN " . CommonTables::PRODUCT_CATEGORY . " PC
                ON PC.Id=P.CategoryId
                INNER JOIN " . CommonTables::PRODUCT_SUB_CATEGORY . " PSC
                ON PSC.Id=P.SubCategoryId

                LEFT JOIN " . CommonTables::PRODUCT_ATTRIBUTE_VALUE . " PAV
                ON PAV.Id = P.AttributeValueId
                LEFT JOIN " . CommonTables::PRODUCT_ATTRIBUTE_PRICE . " PAC
                ON PAC.ProductId = P.Id WHERE
                (P.SubCategoryId='" . $subcategory . "' AND
                PAC.PAVId ='".$attId."'AND
                P.IsActive = '1') GROUP BY P.Id";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function getProductsByPosition($subCategoryId, $position)
    {
        if($subCategoryId > 0) {
            $query = "
                SELECT
                P.Id AS Id,
                IFNULL(P.ProductName,'') AS ProductName,
                IFNULL(P.CategoryId,'') AS CategoryId,
                IFNULL(PC.CategoryName,'') AS CategoryName,
                IFNULL(P.SubCategoryId,'') AS SubCategoryId,
                IFNULL(PSC.SubCategoryName,'') AS SubCategoryName,
                IFNULL(P.AttributeId,'') AS AttributeId,
                IFNULL(PA.AttributeName,'') AS AttributeName,
                IFNULL(P.AttributeValueId,'') AS AttributeValueId,
                IFNULL(PAV.AttributeValue,'') AS AttributeValue,
                IFNULL(P.Price,'00.00') AS Price,
                IFNULL(P.DiscountedPrice,'00.00') AS DiscountedPrice,
                IFNULL(P.Quantity,'') AS Quantity,
                IFNULL(P.Description,'') AS Description,
                IFNULL(P.IsFeatured,0) AS IsFeatured
                FROM " . CommonTables::PRODUCT . " P
                INNER JOIN " . CommonTables::PRODUCT_CATEGORY . " PC
                ON PC.Id=P.CategoryId
                INNER JOIN " . CommonTables::PRODUCT_SUB_CATEGORY . " PSC
                ON PSC.Id=P.SubCategoryId
                LEFT JOIN " . CommonTables::PRODUCT_ATTRIBUTE . " PA
                ON PA.Id=P.AttributeId
                LEFT JOIN " . CommonTables::PRODUCT_ATTRIBUTE_VALUE . " PAV
                ON PAV.Id = P.AttributeValueId
                WHERE P.SubCategoryId='" . $subCategoryId . "' AND P.IsActive = '1' ORDER BY P.ProductName $position";
        }else{
            $query = "
                SELECT
                P.Id AS Id,
                IFNULL(P.ProductName,'') AS ProductName,
                IFNULL(P.CategoryId,'') AS CategoryId,
                IFNULL(P.SubCategoryId,'') AS SubCategoryId,
                IFNULL(P.AttributeId,'') AS AttributeId,
                IFNULL(P.AttributeValueId,'') AS AttributeValueId,
                IFNULL(P.Price,'00.00') AS Price,
                IFNULL(P.DiscountedPrice,'00.00') AS DiscountedPrice,
                IFNULL(P.Quantity,'') AS Quantity,
                IFNULL(P.Description,'') AS Description,
                IFNULL(P.IsFeatured,0) AS IsFeatured
                FROM " . CommonTables::PRODUCT . " P
                 WHERE
                (P.SubCategoryId='" . $subCategoryId . "' AND

                P.IsActive = '1') ORDER BY P.ProductName $position ";
        }

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function checkIfRequested($product,$userId){
          $query = "SELECT Id FROM " . CommonTables::NOTIFY_ME . " WHERE
          ProductId = '".$product."' AND UserId = '".$userId."'";
         $stmt = $this->pdoConn->prepare($query);
         $stmt->execute();
         return $stmt->rowCount();
      }

    public function saveNotifyMe($product,$userId){
      $stmt = $this->pdoConn->prepare("
          INSERT INTO ".CommonTables::NOTIFY_ME." SET
          ProductId = :product,
          UserId = :userId");

      if($stmt->execute([
          "product" =>  $product,
          "userId" =>  $userId
        ])){
        return true;
      }else{
        return false;
      }
    }

    public function saveReview($name,$pro_id,$rating,$desc){
        $date = date('Y-m-d H:i:s');
        $query = $this->pdoConn->prepare("
        INSERT INTO ".CommonTables::PRODUCT_REVIEW."
        SET ProductId ='".$pro_id."',
        NickName = '".$name."',
        Rating = '".$rating."',
        Review = '".$desc."',
        CreatedOn = '".$date."'
        ");

        if($query->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getAttributeValueByName($attname){
        $query = "SELECT PAV.* FROM " . CommonTables::PRODUCT_ATTRIBUTE_VALUE . " PAV
        INNER JOIN " . CommonTables::PRODUCT_ATTRIBUTE . " PA ON PA.Id = PAV.AttributeId
        WHERE AttributeName='".$attname."'";
//echo $query ;
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }

    }
    
    public function changeThumbImage($sort,$pro_id,$imgId)
    {
        // $query = "
// SELECT
// PI.*
// FROM " . CommonTables::PRODUCT_IMAGE_MAPPING . " PI
// WHERE 1=1
// AND PI.IsActive='" . CommonConstants::YES . "'
// AND PI.ProductId='" . $pro_id . "'
// AND PI.sortorder = '".$sort."'
// AND PI.Id = '".$imgId."'

        // ";
		$query = "SELECT * from product_images where id=$imgId";


        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function changeThumbImageColor($sort,$pro_id,$attr_id)
    {

		$query = "SELECT * from product_images where attribute=$attr_id";
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
