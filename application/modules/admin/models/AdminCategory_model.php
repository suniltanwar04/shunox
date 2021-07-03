<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class AdminCategory_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }

    /*---------------Category Starts ---------------*/
    public function getCategories()
    {
        $query = "
                      SELECT Id, CategoryName, IsActive
                      FROM ".CommonTables::PRODUCT_CATEGORY." AS C
                      
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


    public function addCategory($addCategoryName)
    {
        $loggedInUser = $this->session->userdata('Id');
		$title = strtolower($addCategoryName);
		$slug = str_replace(' ', '-', $title);
        $query = "
                    INSERT INTO  " . CommonTables::PRODUCT_CATEGORY . " SET
                    CategoryName='" . $addCategoryName . "',
                    UrlSlug='" . $slug . "',
                    CreatedBy='" . $loggedInUser . "',
                    ModifiedBy='" . $loggedInUser . "',
                    CreatedOn=UTC_TIMESTAMP(),
                    ModifiedOn=UTC_TIMESTAMP(),
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

    public function getCategoryById($recordId)
    {
        $query = "
                  SELECT
                  C.Id AS Id,
                  IFNULL(C.CategoryName, '') AS CategoryName,
                  IFNULL(C.IsActive, '') AS IsActive
                  FROM " . CommonTables::PRODUCT_CATEGORY . " C
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

    public function updateCategory($editCategoryName, $recordId)
    {
        $query = "
        UPDATE " . CommonTables::PRODUCT_CATEGORY . " SET
        CategoryName='" . $editCategoryName . "'
        WHERE id='" . $recordId . "'
        ";

        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function enableDisableCategory($recordId, $isActive)
    {
        $query = "
                    UPDATE  " . CommonTables::PRODUCT_CATEGORY . " SET
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

    public function getSubCategoryByCategory($CategoryId)
    {
        $query = "
                SELECT
                S.Id AS Id,
                S.SubCategoryName
                FROM " . CommonTables::PRODUCT_SUB_CATEGORY . " S
                WHERE 1=1
                AND S.IsActive = 1
                AND S.CategoryId = '" . $CategoryId . "'
                ORDER BY SubCategoryName
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

    /*---------------Category Ends ---------------*/

    /*---------------Sub-Category Start ---------------*/

    public function getSubCategory()
    {

        $query = "
                    SELECT
                    S.Id AS Id,
                    IFNULL(S.SubCategoryName, '') AS SubCategoryName,
                    IFNULL(S.CategoryId, '') AS CategoryId,
                    IFNULL(C.CategoryName, '') AS CategoryName,
                    IFNULL(S.Description, '') AS Description,
                    IFNULL(S.image, '') AS image,
                    IFNULL(S.IsActive, '') AS IsActive
                    FROM " . CommonTables::PRODUCT_SUB_CATEGORY . " S
                    INNER JOIN " . CommonTables::PRODUCT_CATEGORY . " C
                    ON C.Id=S.CategoryId
                    ORDER BY CategoryName
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


    public function loginCheck($SubcatName, $addCatId)
    {
        $query = "
                SELECT
                S.Id AS Id,
                IFNULL(S.SubCategoryName, '') AS SubCategoryName,
                IFNULL(S.CategoryId, '') AS CategoryId,
                IFNULL(S.IsActive, '') AS IsActive
                FROM " . CommonTables::PRODUCT_SUB_CATEGORY . " S
                WHERE 1=1
                AND S.SubCategoryName='" . $SubcatName . "'
                AND S.CategoryId='" . $addCatId . "'
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


    public function addSubCategory($SubcatName,$addCatId,$addSubcatDesc,$image)
    {
		$title = strtolower($SubcatName);
		$slug = str_replace(' ', '-', $title);
        $query = "INSERT INTO  " . CommonTables::PRODUCT_SUB_CATEGORY . " SET
        SubCategoryName='" . $SubcatName . "',
        UrlSlug='" . $slug . "',
        CategoryId='" . $addCatId . "',
        Description='" . $addSubcatDesc . "',
        image='" . $image . "',
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

    public function checkSubcat($addCatId,$SubcatName)
    {
        $query = "
                SELECT
                S.Id AS Id,
                IFNULL(S.SubCategoryName, '') AS SubCategoryName,
                IFNULL(S.CategoryId, '') AS CategoryId,
                IFNULL(S.IsActive, '') AS IsActive
                FROM " . CommonTables::PRODUCT_SUB_CATEGORY . " S
                WHERE 1=1
                AND S.SubCategoryName='" .$SubcatName. "'
                AND S.CategoryId='" .$addCatId. "'
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


    public function checkCategoryName($categoryName)
    {
        $query = "
                  SELECT
                   C.Id AS Id,
                  IFNULL(C.CategoryName, '') AS CategoryName,
                  IFNULL(C.IsActive, '') AS IsActive
                  FROM " . CommonTables::PRODUCT_CATEGORY . " C
                  WHERE 1=1
                  AND C.CategoryName='" . $categoryName . "'
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


    public function getSubCatById($recordId)
    {
        $query = "
                SELECT
                S.Id AS Id,
                IFNULL(S.SubCategoryName, '') AS SubCategoryName,
                IFNULL(S.CategoryId, '') AS CategoryId,
                 IFNULL(S.Description, '') AS Description,
                IFNULL(S.image, '') AS image,
                IFNULL(C.CategoryName, '') AS CategoryName,
                IFNULL(S.IsActive, '') AS IsActive
                FROM " . CommonTables::PRODUCT_SUB_CATEGORY . " S
                INNER JOIN " . CommonTables::PRODUCT_CATEGORY . " C ON C.Id=S.CategoryId
                 WHERE S.Id='" . $recordId . "'
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

    public function updateSubCat($catId, $SubcatName, $Description, $recordId)
    {
        $query = "
        UPDATE  " . CommonTables::PRODUCT_SUB_CATEGORY . " SET
        SubCategoryName='" . $SubcatName . "',
        Description ='" . $Description . "',
        CategoryId='" . $catId . "'
        WHERE Id='" . $recordId . "'
        ";
        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function enableDisableSubCat($recordId, $isActive)
    {

        $query = "
                     UPDATE  " . CommonTables::PRODUCT_SUB_CATEGORY . " SET
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

    /*---------------Sub-category End ---------------*/


}
