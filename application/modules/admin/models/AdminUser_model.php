<?php

/**
 * Created by PhpStorm.
 * User: amit
 * Date: 22/10/16
 * Time: 11:07 PM
 */
class AdminUser_model extends CI_Model
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
                  SELECT
                  UL.*
                  FROM " . CommonTables::USER . " UL
                  WHERE 1=1
                  AND UL.Email='" . $email . "'
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


    public function getUserByHash($hashSalt)
    {
        $query = "
                  SELECT
                  UL.Id AS Id,
                  IFNULL(UL.Email,'') AS Email,
                  IFNULL(UL.Mobile,'') AS Mobile,
                  IFNULL(UL.UserType,'') AS UserType,
                  IFNULL(UL.IsActive,'') AS IsActive
                  FROM " . CommonTables::USER_LOGIN . " UL
                  WHERE 1=1
                  AND UL.HashSalt='" . $hashSalt . "'
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

    public function getUsersByType($userType)
    {
        $query = "
                  SELECT
                  UL.Id AS Id,
                  IFNULL(UL.Email,'') AS Email,
                  IFNULL(UL.Mobile,'') AS Mobile,
                  IFNULL(UL.UserType,'') AS UserType,
                  IFNULL(UL.IsActive,'') AS IsActive
                  FROM " . CommonTables::USER_LOGIN . " UL
                  WHERE 1=1
                  AND UL.UserType='" . $userType . "'
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


    public function getDriversById($userId)
    {
        $query = "
                  SELECT
                  D.Id AS Id,
                  IFNULL(D.FirstName,'') AS FirstName,
                  IFNULL(D.MiddleName,'') AS MiddleName,
                  IFNULL(D.SurName,'') AS SurName,
                  IFNULL(D.State,'') AS State,
                  IFNULL(D.PIN,'') AS PIN,
                  IFNULL(D.ContactNo,'') AS ContactNo,
                  IFNULL(D.AlternativeContactNo,'') AS AlternativeContactNo,
                  IFNULL(D.EmailId,'') AS EmailId,
                  IFNULL(D.IdentityDoc,'') AS IdentityDoc,
                  IFNULL(D.IdentityDocNo,'') AS IdentityDocNo,
                  IFNULL(D.DOB,'') AS DOB,
                  IFNULL(D.Education,'') AS Education,
                  IFNULL(D.IdentificationMark,'') AS IdentificationMark,
                  IFNULL(D.AssociationType,'') AS AssociationType,
                  IFNULL(D.Expperience,'') AS Expperience,
                  IFNULL(D.DriverEligibility,'') AS DriverEligibility,
                  IFNULL(D.Illness,'') AS Illness,
                  IFNULL(D.Insured,'') AS Insured,
                  IFNULL(D.BioMetric,'') AS BioMetric,
                  IFNULL(D.BankAccountNo,'') AS BankAccountNo,
                  IFNULL(D.FamilyDependent,'') AS FamilyDependent,
                  IFNULL(D.IsActive,'') AS IsActive,
                  IFNULL(D.Alcoholic,'') AS Alcoholic
                  FROM " . CommonTables::DRIVER . " D
                  WHERE 1=1
                  AND D.UserLoginId='" . $userId . "'
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


}