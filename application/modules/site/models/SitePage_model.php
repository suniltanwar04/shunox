<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class SitePage_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }

   

    public function getPageDetails($slug){
        $stmt = $this->pdoConn->prepare("
            SELECT description
            FROM  ".CommonTables::PAGE." 
            WHERE slug = '".$slug."'
           
        ");

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getScanningLocator(){
        $stmt = $this->pdoConn->prepare("
            SELECT *
            FROM  ".CommonTables::SCANNINGLOCATION."
            WHERE IsActive = 1

        ");

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getScanningLocatorById($id){
        $stmt = $this->pdoConn->prepare("
            SELECT *
            FROM  ".CommonTables::SCANNINGLOCATION."
            WHERE city = '".$id."'

        ");

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function getblogDetail($id){
        $stmt = $this->pdoConn->prepare("
            SELECT *
            FROM  ".CommonTables::BLOGS." 
            WHERE id = '".$id."'
           
        ");

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    


}
