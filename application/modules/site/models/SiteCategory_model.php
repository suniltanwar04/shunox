<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class SiteCategory_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }


    public function getCategories()
    {
        $query = "
SELECT
PC.Id AS Id
FROM " . CommonTables::PRODUCT_CATEGORY . " PC
WHERE 1=1
AND PC.IsActive='" . CommonConstants::YES . "'

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


    public function getCategoriesForFilter()
    {
        $query = "
SELECT
PC.Id AS Id
FROM " . CommonTables::PRODUCT_CATEGORY . " PC

WHERE 1=1
AND PC.IsActive='" . CommonConstants::YES . "'

GROUP BY PC.Id
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


    public function getCategoryBySlug($slug)
    {
        $query = "
SELECT
PC.Id AS Id,
IFNULL(PC.CategoryName, '') AS CategoryName,
IFNULL(PC.UrlSlug, '') AS UrlSlug
FROM " . CommonTables::PRODUCT_CATEGORY . " PC
WHERE 1=1
AND PC.UrlSlug='" . $slug . "'

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
    
     public function getCategoryById($categoryId)
    {
        $query = "
SELECT
PC.Id AS Id,
IFNULL(PC.CategoryName, '') AS CategoryName,
IFNULL(PC.UrlSlug, '') AS UrlSlug
FROM " . CommonTables::PRODUCT_CATEGORY . " PC
WHERE 1=1
AND PC.Id='" . $categoryId . "'

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


    public function getSubCategoryByCategory($categoryId)
    {
        $query = "
SELECT
PSC.Id AS Id
FROM " . CommonTables::PRODUCT_SUB_CATEGORY . " PSC
WHERE 1=1
AND PSC.CategoryId='" . $categoryId . "'
AND PSC.IsActive='" . CommonConstants::YES . "'

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

	public function getSubCategoryBySlug($slug)
    {
        $query = "
SELECT
PC.Id AS Id,
IFNULL(PC.SubCategoryName, '') AS SubCategoryName,
IFNULL(PC.UrlSlug, '') AS UrlSlug
FROM " . CommonTables::PRODUCT_SUB_CATEGORY . " PC
WHERE 1=1
AND PC.UrlSlug='" . $slug . "'

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
    
    public function getSubCategoryById($subCategoryId)
    {
        $query = "
        SELECT
        PSC.Id AS Id,
        IFNULL(PSC.CategoryId, '') AS CategoryId,
        IFNULL(PS.CategoryName, '') AS CategoryName,
        IFNULL(PSC.SubCategoryName, '') AS SubCategoryName,
        IFNULL(PSC.Description, '') AS Description,
        IFNULL(PSC.Image, '') AS SubCategoryImage,
        IFNULL(PSC.UrlSlug, '') AS UrlSlug
        FROM " . CommonTables::PRODUCT_SUB_CATEGORY . " PSC
        INNER JOIN " . CommonTables::PRODUCT_CATEGORY . " PS ON PS.Id = PSC.CategoryId
        WHERE 1=1
        AND PSC.Id='" . $subCategoryId . "'";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function getHomeSubCategories()
    {
        $query = "
SELECT
PSC.Id AS Id, SubCategoryName
FROM " . CommonTables::PRODUCT_SUB_CATEGORY . " PSC
WHERE 1=1
AND PSC.IsActive='" . CommonConstants::YES . "'
ORDER BY RAND()
LIMIT 3


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

}
