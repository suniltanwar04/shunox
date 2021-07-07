<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class AdminAttributeMapping_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }

    public function getAttributeMapping()
    {
        $query = "
                  SELECT
                  C.Id AS Id,
                  IFNULL(C.ProductId, '') AS ProductId,
                  IFNULL(C.AttributeId, '') AS AttributeId,
                  IFNULL(C.IsActive, '') AS IsActive,
                  IFNULL(S.ProductName, '') AS ProductName,
                  IFNULL(K.AttributeValue, '') AS AttributeValue
                  FROM " . CommonTables::PRODUCT_ATTRIBUTE_MAPPING . " C
                  INNER JOIN " . CommonTables::PRODUCT . " S ON C.ProductId=S.Id
                  INNER JOIN " . CommonTables::PRODUCT_ATTRIBUTE_VALUE . " K ON C.AttributeId=K.Id
                   WHERE 1=1
                  ORDER BY ProductId
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

    public function addAttributeMapping($ProductId, $Attributevalueid)
    {
        $query = "
                    INSERT INTO  " . CommonTables::PRODUCT_ATTRIBUTE_MAPPING . " SET
                    ProductId='" . $ProductId . "',
                    AttributeId='" . $Attributevalueid . "',
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


    public function getAttributeMappingById($recordId)
    {
        $query = "
                  SELECT
                  C.Id AS Id,
                  IFNULL(C.ProductId, '') AS ProductId,
                  IFNULL(C.AttributeId, '') AS AttributeId,
                  IFNULL(C.IsActive, '') AS IsActive
                  FROM " . CommonTables::PRODUCT_ATTRIBUTE_MAPPING . " C
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

    public function updateAttributeMapping($ProductId, $AttributeMappingId, $recordId)
    {
        $query = "
        UPDATE " . CommonTables::PRODUCT_ATTRIBUTE_MAPPING . " SET
        ProductId='" . $ProductId . "',
        AttributeId='" . $AttributeMappingId . "'
        WHERE id='" . $recordId . "'
        ";

        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function enableDisableAttributeMapping($recordId, $isActive)
    {
        $query = "
                    UPDATE  " . CommonTables::PRODUCT_ATTRIBUTE_MAPPING . " SET
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

} 
