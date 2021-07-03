<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }

    public function getProfile(){
        
     
      $userId = $this->session->userdata("Id");
      $stmt = $this->pdoConn->prepare("
            SELECT *
            FROM " . CommonTables::USER . "
            WHERE Id = :userId");
        $stmt->execute(["userId" => $userId]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function myOrders(){
      $userId = $this->session->userdata("Id");

      $stmt = $this->pdoConn->prepare("
        SELECT O.CurrentStatus,
        OD.TotalPrice, OD.OrderQuantity,
        P.ProductName, PI.ImageName AS ProductImage
        FROM ".CommonTables::USER_ORDER." O
        LEFT JOIN ".CommonTables::USER_ORDER_DETAIL." AS OD
        ON OD.OrderId = O.Id
        LEFT JOIN ".CommonTables::PRODUCT." AS P
        ON P.Id = OD.ProductId
        LEFT JOIN ".CommonTables::PRODUCT_IMAGE_MAPPING." AS PI
        ON PI.ProductId = OD.ProductId
        WHERE O.UserId = '".$userId."' GROUP BY OD.Id ORDER BY OD.Id DESC
      ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }



    public function updateUserPassword($data){
        $userId = $this->session->userdata('Id');
        $old_pass = md5($data['oldPassword']);
        $new_pass = md5($data['newPassword']);
        $stmt = $this->pdoConn->prepare("
            SELECT Id
            FROM " . CommonTables::USER . "
            WHERE Id = :id AND PassKey = :pass");
        $stmt->execute(["id" => $userId, "pass"  =>  $old_pass]);
        if($stmt->rowCount()){
            $stmt = $this->pdoConn->prepare("
            UPDATE " . CommonTables::USER . "
            SET PassKey = :newPass, PassSalt = :salt
            WHERE Id = :id");

            if ($stmt->execute(["newPass" => $new_pass,"salt" =>  $new_pass, "id" => $userId])) {
                echo 1;
            } else {
                echo 0;
            }
        }else{
          echo -1;
        }
    }

    public function updateUserProfile($data){
        $user_id = $this->session->userdata('Id');
        $email = $data['email'];
        $stmt = $this->pdoConn->prepare("
            SELECT Email FROM ".CommonTables::USER."
            WHERE Email = '$email' AND Id != $user_id");
        $stmt->execute();
        // if($stmt->rowCount() > 0){
            // return -3;
        // }else{
            $stmt = $this->pdoConn->prepare("UPDATE "
            . CommonTables::USER . " SET FullName = :name,
            Email = :email, Mobile = :mobile,
            State = :state, City = :city,
            PinCode = :pin, Address = :address,
            Title = :title,Landline = :landline,
            Country = :country,DOB = :dob,
            LastName = :lname, CompanyName = :companyname,
            OtherAddress = :otheradd,Landmark = :landmark
            WHERE Id = :id");
           $dob =  date("Y-m-d", strtotime($data['dob']) );
          
            if ($stmt->execute([
                "name" => $data['name'],
                "email" => $email,
                "mobile" => $data['phone'],
                "state" => $data['state'],
                "city" => $data['city'],
                "pin" => $data['pinCode'],
                "address" => $data['address'],
                "title" => $data['title'],
                "lname" => $data['lastname'],
                "id" => $user_id,
                "landline" =>$data['landline'],
                "country" => $data['country'],
                "dob" =>  $dob ,
                "companyname" => $data['com_name'],
                "otheradd" => $data['otheradd'],
                "landmark" => $data['landmark']
            ])) {
                return 1;
            } else {
                return 0;
            }
        // }
    }

    public function updateUserProfilePicture($file_name){
        $user_id = $this->session->userdata('Id');
        $stmt = $this->pdoConn->prepare("UPDATE "
            . CommonTables::USER . " SET ProfileImage = :picture WHERE Id = :id");
        if ($stmt->execute(["picture" => $file_name, "id" => $user_id])) {
            return true;
        } else {
            return false;
        }
    }
    
    public function myWishlist(){
      $userId = $this->session->userdata("Id");

      $stmt = $this->pdoConn->prepare("
        SELECT *
        FROM ".CommonTables::WISHLIST." AS W
        INNER JOIN ".CommonTables::PRODUCT." AS P
        ON  W.ProductId = P.Id
        
        WHERE W.UserId = '".$userId."'  ORDER BY W.Id DESC
      ");
      
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

	public function removeWishlist($proID){
      $userId = $this->session->userdata("Id");

      $stmt = $this->pdoConn->prepare("
        DELETE 
        FROM ".CommonTables::WISHLIST." 
        WHERE UserId = '".$userId."'  AND ProductId='".$proID."'
      ");
      
        $stmt->execute();
        return true;
    }
    
	
    
    
    

}
