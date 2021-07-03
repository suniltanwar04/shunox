<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class SiteLogin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }


    public function getUserByEmail($email)
    {
        $query = "
        SELECT U.Id AS Id
        FROM " . CommonTables::USER . " U
        WHERE 1=1
        AND U.Email='" . $email . "'";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function getUserByMobile($mobile)
    {
        $query = "
        SELECT U.Id AS Id
        FROM " . CommonTables::USER . " U
        WHERE 1=1
        AND U.Mobile='" . $mobile . "'
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

    public function getUserByEmailMobile($value)
    {
        $query = "

SELECT U.Id AS Id
FROM " . CommonTables::USER . " U
WHERE 1=1
AND
(
U.Email='" . $value . "'
OR U.Mobile='" . $value . "'
)

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

    public function verifyOTP($otp){
      $otpHash = md5($otp);
        $query = "
        SELECT * FROM " . CommonTables::TEMP_USER . "
        WHERE OtpHash = '".$otpHash."'";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }


    public function registerTempUser($fullName, $email, $password, $mobile, $otp, $otpHash)
    {
        $query = "
        INSERT INTO  " . CommonTables::TEMP_USER . " SET
        Otp='" . $otp . "',
        OtpHash='" . $otpHash . "',
        FullName='" . $fullName . "',
        Email='" . $email . "',
        PassKey='" . md5($password) . "',
        Mobile='" . $mobile . "'
        ";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $recordId = $this->pdoConn->lastInsertId();
        if ($recordId > 0) {
            $this->updateCreator($recordId);
            return $recordId;
        } else {
            return false;
        }
    }


    public function registerUser($post){
        if($post['news'] > 0){
            $news = $post['news'];
        }else{
            $news = 0;
        }

        $query = "
        INSERT INTO  " . CommonTables::USER . " SET
        UserRole= 2,
        LoginType = 1,
        FullName='" . $post['fullName'] . "',
        LastName='" . $post['lastName'] . "',
        Email='" . $post['emailId'] . "',
        PassKey='" . md5($post['password']) . "',
        PassSalt='" . $post['password'] . "',
        Mobile='" . $post['mobile'] . "',
        IsActive='" . CommonConstants::YES . "',
        IsDeleted='" . CommonConstants::NO . "',
        is_newsletter='" . $news . "',
        CreatedOn=UTC_TIMESTAMP(),
        ModifiedOn=UTC_TIMESTAMP()
        ";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $recordId = $this->pdoConn->lastInsertId();
        $guest = $this->session->userdata("GuestUser");
        if($guest!=''){
	        $que = "UPDATE ". CommonTables::CART ." SET UserId =". $recordId." ,UserType=0  WHERE UserId = '".$guest."'";
	        
	        $stmtUp = $this->pdoConn->prepare($que);
	       
	        if($stmtUp->execute()){
	           
	            $unset = $this->session->unset_userdata("GuestUser");
	             
	        }
        }
        if ($recordId > 0) {
            $this->updateCreator($recordId);
            return $recordId;
        } else {
            return false;
        }
    }

    public function registerFacebookUser($name,$email,$picture){
        $query = "
        INSERT INTO  " . CommonTables::USER . " SET
        UserRole= 2,
        LoginType = 1,
        FullName='" . $name. "',
        Email='" . $email . "',
        ProfileImage='" . $picture . "',
        IsActive='" . CommonConstants::YES . "',
        IsDeleted='" . CommonConstants::NO . "',
        CreatedOn=UTC_TIMESTAMP(),
        ModifiedOn=UTC_TIMESTAMP()
        ";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        return $this->pdoConn->lastInsertId();
    }

    public function deleteTempUser($otp){
      $otpHash = md5($otp);
        $query = "
        DELETE FROM " . CommonTables::TEMP_USER . "
        WHERE OtpHash = '".$otpHash."'";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
    }



    public function updateCreator($recordId)
    {
        $query = "UPDATE  " . CommonTables::USER . " SET
        CreatedBy='" . $recordId . "',
        ModifiedBy='" . $recordId . "',
        ModifiedOn=UTC_TIMESTAMP()
        WHERE Id='" . $recordId . "'
        ";
        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }



    public function authenticateUser($email, $password)
    {
        
        $guest = $this->session->userdata("GuestUser");
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
                    AND (U.PassKey='" . md5($password) . "' 
                    OR U.PassSalt='". $password ."')

        ";
        
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        
        $que = "UPDATE ". CommonTables::CART ." SET UserId =". $result->Id." ,UserType=0  WHERE UserId = '".$guest."'";
        
        $stmtUp = $this->pdoConn->prepare($que);
       
        if($stmtUp->execute()){
           
            $unset = $this->session->unset_userdata("GuestUser");
             
        }
        
       
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
