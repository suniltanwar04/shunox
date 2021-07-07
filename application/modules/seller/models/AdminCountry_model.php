<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class AdminCountry_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }

    /*---------------Country Starts ---------------*/

    public function getCategories()
    {
        $query = "
                  SELECT
                  C.Id AS Id,
                  IFNULL(C.CategoryName, '') AS CategoryName,
                  IFNULL(C.IsActive, '') AS IsActive,
                  IFNULL(C.CreatedBy, '') AS CreatedBy,
                  IFNULL(C.CreatedOn, '') AS CreatedOn,
                  IFNULL(C.ModifiedBy, '') AS ModifiedBy,
                  IFNULL(C.	ModifiedOn, '') AS 	ModifiedOn
                  FROM " . CommonTables::PRODUCT_CATEGORY . " C
                  WHERE 1=1
                  ORDER BY CategoryName
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

    public function addCategory($addCategoryName)
    {
        $query = "
                    INSERT INTO  " . CommonTables::PRODUCT_CATEGORY . " SET
                    CategoryName='" . $addCategoryName . "',
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

    public function enableDisableCountry($recordId, $isActive)
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
    /*---------------Country Ends ---------------*/


    /*---------------States Starts ---------------*/
    public function getSubCategory()
    {

        $query = "
                    SELECT
                    S.Id AS Id,
                    IFNULL(S.SubCategoryName, '') AS SubCategoryName,
                    IFNULL(S.CategoryId, '') AS CategoryId,
                    IFNULL(C.Id, '') AS Id,
                    IFNULL(C.CategoryName, '') AS CategoryName,
                    IFNULL(S.IsActive, '') AS IsActive
                    FROM " . CommonTables::PRODUCT_SUB_CATEGORY . " S
                    INNER JOIN " . CommonTables::PRODUCT_CATEGORY . " C ON C.Id=S.Id
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

    public function checkSubcat($SubcatName, $addCatId)
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

    public function addSubCategory($SubcatName, $addCatId)
    {
        $query = "INSERT INTO  " . CommonTables::PRODUCT_SUB_CATEGORY . " SET
        SubCategoryName='" . $SubcatName . "',
        CategoryId='" . $addCatId . "',
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

    public function getSubCatById($recordId)
    {
        $query = "
SELECT
S.Id AS Id,
IFNULL(S.SubCategoryName, '') AS SubCategoryName,
IFNULL(S.CategoryId, '') AS CategoryId,
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

    public function updateSubCat($catId, $SubcatName, $recordId)
    {
        $query = "
        UPDATE  " . CommonTables::PRODUCT_SUB_CATEGORY . " SET
        SubCategoryName='" . $SubcatName . "',
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


    public function enableDisableState($recordId, $isActive)
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


    public function getSubCategoryByCategory($CategoryId)
    {
        $query = "
                SELECT
                S.Id AS Id,
                IFNULL(S.SubCategoryName, '') AS SubCategoryName
                FROM " . CommonTables::PRODUCT_SUB_CATEGORY . " S
                WHERE 1=1
                AND S.IsActive=1
                AND S.CategoryId='" . $CategoryId . "'
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


    /*---------------States Ends ---------------*/


    /*---------------Cities Starts ---------------*/
    public function getProduct()
    {

        $query = "
SELECT
CT.Id AS Id,
IFNULL(CT.ProductName, '') AS ProductName,
IFNULL(CT.Price, '') AS Price,
IFNULL(CT.Quantity, '') AS Quantity,
IFNULL(CT.Description, '') AS Description,
IFNULL(CT.DiscountType, '') AS DiscountType,
IFNULL(CT.DiscountValue, '') AS DiscountValue,
IFNULL(CT.SubCategoryId, '') AS SubCategoryId,
IFNULL(S.SubCategoryName, '') AS SubCategoryName,
IFNULL(CT.IsActive, '') AS IsActive
FROM " . CommonTables::PRODUCT . " CT
INNER JOIN " . CommonTables::PRODUCT_SUB_CATEGORY . " S ON S.Id=CT.SubCategoryId
ORDER BY SubCategoryName, ProductName
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


    public function checkCity($cityName, $stateId)
    {
        $query = "
SELECT
CT.Id AS Id,
IFNULL(CT.CityName, '') AS CityName,
IFNULL(CT.StateId, '') AS StateId,
IFNULL(CT.IsActive, '') AS IsActive
FROM " . CommonTables::CITY . " CT
WHERE 1=1
AND CT.CityName='" . $cityName . "'
AND CT.StateId='" . $stateId . "'
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


    public function addCity($cityName, $stateId)
    {
        $query = "INSERT INTO  " . CommonTables::CITY . " SET
        CityName='" . $cityName . "',
        StateId='" . $stateId . "',
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


    public function getCityById($cityId)
    {

        $query = "
SELECT
CT.Id AS Id,
IFNULL(CT.CityName, '') AS CityName,
IFNULL(CT.StateId, '') AS StateId,
IFNULL(S.StateName, '') AS StateName,
IFNULL(S.CountryId, '') AS CountryId,
IFNULL(C.CountryName, '') AS CountryName,
IFNULL(CT.IsActive, '') AS IsActive
FROM " . CommonTables::CITY . " CT
LEFT JOIN " . CommonTables::STATE . " S ON S.Id=CT.StateId
LEFT JOIN  " . CommonTables::COUNTRY . " C ON C.Id=S.CountryId
WHERE CT.Id='" . $cityId . "'

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


    public function updateCity($cityName, $stateId, $recordId)
    {
        $query = "UPDATE  " . CommonTables::CITY . " SET
        CityName='" . $cityName . "',
        StateId='" . $stateId . "'
        WHERE Id='" . $recordId . "'
        ";
        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
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


    public function getCitiesByState($stateId)
    {

        $query = "
SELECT
CT.Id AS Id,
IFNULL(CT.CityName, '') AS CityName,
IFNULL(CT.StateId, '') AS StateId,
IFNULL(S.StateName, '') AS StateName,
IFNULL(CT.IsActive, '') AS IsActive
FROM " . CommonTables::CITY . " CT
LEFT JOIN " . CommonTables::STATE . " S ON S.Id=CT.StateId
WHERE 1=1
AND CT.IsActive=1
AND CT.StateId='" . $stateId . "'
ORDER BY CityName
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

    /*---------------Cities Ends ---------------*/


    /*---------------Localities Starts ---------------*/
    public function getLocalities()
    {
        $query = "
SELECT
L.id AS Id,
IFNULL(L.LocalityName, '') AS LocalityName,
IFNULL(L.Latitude,'0') AS Latitude,
IFNULL(L.Longitude,'0') AS Longitude,
IFNULL(L.CityId, '') AS CityId,
IFNULL(L.Pincode, '') AS Pincode,
IFNULL(CT.CityName, '') AS CityName,
IFNULL(CT.StateId, '') AS StateId,
IFNULL(S.StateName, '') AS StateName,
IFNULL(S.CountryId, '') AS CountryId,
IFNULL(C.CountryName, '') AS CountryName,
IFNULL(L.IsActive, '') AS IsActive
FROM " . CommonTables::LOCALITY . " L
LEFT JOIN " . CommonTables::CITY . "  CT ON CT.id=L.CityId
LEFT JOIN " . CommonTables::STATE . "  S ON S.id=CT.StateId
LEFT JOIN " . CommonTables::COUNTRY . "  C ON C.id=S.CountryId

ORDER BY CountryName, StateName, CityName, LocalityName
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


    public function checkLocality($localityName, $cityId)
    {
        $query = "
                    SELECT
L.id AS Id,
IFNULL(L.LocalityName, '') AS LocalityName,
IFNULL(L.Latitude,'0') AS Latitude,
IFNULL(L.Longitude,'0') AS Longitude,
IFNULL(L.CityId, '') AS CityId,
IFNULL(L.Pincode, '') AS Pincode,
IFNULL(CT.CityName, '') AS CityName,
IFNULL(CT.StateId, '') AS StateId,
IFNULL(S.StateName, '') AS StateName,
IFNULL(S.CountryId, '') AS CountryId,
IFNULL(C.CountryName, '') AS CountryName,
IFNULL(L.IsActive, '') AS IsActive
FROM " . CommonTables::LOCALITY . " L
LEFT JOIN " . CommonTables::CITY . "  CT ON CT.id=L.CityId
LEFT JOIN " . CommonTables::STATE . "  S ON S.id=CT.StateId
LEFT JOIN " . CommonTables::COUNTRY . "  C ON C.id=S.CountryId
WHERE 1=1
AND L.LocalityName='" . $localityName . "'
AND L.CityId='" . $cityId . "'
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


    public function addLocality($localityName, $pinCode, $cityId, $latitude, $longitude)
    {

        $query = "INSERT INTO  " . CommonTables::LOCALITY . " SET
        LocalityName='" . $localityName . "',
        CityId='" . $cityId . "',
        Pincode='" . $pinCode . "',
        Latitude='" . $latitude . "',
        Longitude='" . $longitude . "',
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


    public function getLocalityById($recordId)
    {
        $query = "
                                        SELECT
L.id AS Id,
IFNULL(L.LocalityName, '') AS LocalityName,
IFNULL(L.Latitude,'0') AS Latitude,
IFNULL(L.Longitude,'0') AS Longitude,
IFNULL(L.CityId, '') AS CityId,
IFNULL(L.Pincode, '') AS Pincode,
IFNULL(CT.CityName, '') AS CityName,
IFNULL(CT.StateId, '') AS StateId,
IFNULL(S.StateName, '') AS StateName,
IFNULL(S.CountryId, '') AS CountryId,
IFNULL(C.CountryName, '') AS CountryName,
IFNULL(L.IsActive, '') AS IsActive
FROM " . CommonTables::LOCALITY . " L
LEFT JOIN " . CommonTables::CITY . "  CT ON CT.id=L.CityId
LEFT JOIN " . CommonTables::STATE . "  S ON S.id=CT.StateId
LEFT JOIN " . CommonTables::COUNTRY . "  C ON C.id=S.CountryId
WHERE 1=1

AND L.Id='" . $recordId . "'
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


    public function updateLocality($localityName, $pinCode, $cityId, $latitude, $longitude, $recordId)
    {

        $query = "UPDATE  " . CommonTables::LOCALITY . " SET
        LocalityName='" . $localityName . "',
        CityId='" . $cityId . "',
        Pincode='" . $pinCode . "',
        Latitude='" . $latitude . "',
        Longitude='" . $longitude . "'
        WHERE Id='" . $recordId . "'
        ";


        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }


    public function enableDisableLocality($recordId, $isActive)
    {

        $query = "
                     UPDATE  " . CommonTables::LOCALITY . " SET
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


    /*---------------Localities Ends ---------------*/
}
