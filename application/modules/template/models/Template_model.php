<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class Template_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }
    
    public function getBanner(){
        $query = "SELECT * FROM " . CommonTables :: BANNER . " WHERE is_deleted=0";
        
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    
    public function getAllCategory(){
        $query = "SELECT * FROM " . CommonTables :: PRODUCT_CATEGORY . " WHERE IsActive=1";
        
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }
    
    public function getSubCategoryById($catId){
        $query = "SELECT * FROM " . CommonTables :: PRODUCT_SUB_CATEGORY . " WHERE IsActive=1 AND CategoryId='".$catId."'";
        
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }
    public function getSocial(){
        $query = "SELECT * FROM " . CommonTables :: SOCIAL . " WHERE is_deleted=0";
        
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }
    public function getCopyRight(){
        $name = 'COPYRIGHT';
        $query = "SELECT * FROM " . CommonTables :: SETTING . " WHERE name='".$name."'";
        
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
