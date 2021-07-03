<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class AdminLogin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }


    public function authenticateUser($email, $password)
    {
        $query = "
                    SELECT
                    U.Id AS Id,
                    U.FullName AS FullName,
                    U.Email AS 	Email,
                    U.IsActive AS IsActive,
                    U.UserRole AS UserRole,
                    U.IsDeleted AS IsDeleted
                     FROM " . CommonTables:: USER . " U
                    WHERE 1=1
                    AND U.Email='" . $email . "'
                    AND U.PassKey='" . md5($password) . "'

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
    
     public function getEmail()
    {
    $id = $this->session->userdata('adminId');
        $query = "
                    SELECT
                    U.to_email, U.Email, U.PassSalt
                     FROM " . CommonTables:: USER . " U
                    WHERE 1=1
                    AND U.Id='" . $id . "'
                    

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
    
    public function updateToken($email, $token){
    	$query = "UPDATE  ". CommonTables::USER ." 
    	SET email_token='".$token."'
    	WHERE Email = '".$email."'";
    	
    	$stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function updatePassword($password, $token){
    	$query = "UPDATE  ". CommonTables::USER ." 
    	SET PassKey='".md5($password)."',
    	PassSalt ='".$password."'
    	WHERE email_token= '".$token."'";
    	
    	$stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


}
