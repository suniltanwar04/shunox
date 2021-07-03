<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class Admin_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }

    public function getNewsLetter(){
        $query = "SELECT * FROM ".CommonTables::NEWSLETTER." WHERE 1=1";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public function getbecomeDealer(){
        $query = "SELECT * FROM ".CommonTables::BECOMEDEALER." WHERE uniqueId Is NULL";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public function getbecomeWithDealerId(){
        $query = "SELECT * FROM ".CommonTables::BECOMEDEALER." WHERE uniqueId Is NOT NULL";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public function getbecomeDealerDetailById($id){
        $query = "SELECT * FROM ".CommonTables::BECOMEDEALER." WHERE id= '".$id."'";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public function saveEmailAddress($email, $toemail, $pass){
        $passkey = md5($pass);
        $id = $this->session->userdata('adminId');
        $query = "UPDATE  ".CommonTables::USER." SET Email = '".$email."',to_email='".$toemail."', PassKey = '".$passkey."',PassSalt='".$pass."' WHERE id= '".$id."'";
        
        $stmt = $this->pdoConn->prepare($query);
        $result = $stmt->execute();

        if($result){
            return $result;
        }else{
            return false;
        }
    }
    
    
    
    public function deleteDealer( $recordId)
    {
        $query = "DELETE FROM " . CommonTables::BECOMEDEALER . "
        WHERE Id='" . $recordId . "'
        ";

        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkId($id){
        $query = "SELECT * FROM ".CommonTables::BECOMEDEALER." WHERE uniqueId= '".$id."'";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public function updateDealerId($dealer_id, $recordId){
        $query = "UPDATE  ".CommonTables::BECOMEDEALER." SET uniqueId= '".$dealer_id."'  WHERE id='".$recordId."'";
echo $query;
        $stmt = $this->pdoConn->prepare($query);

        $result = $stmt->execute();;
        if($result){
            return true;
        }else{
            return false;
        }
    }
    
    public function dealerUsers($id){
        $query = "SELECT U.* FROM ".CommonTables::USER." AS U INNER JOIN ".CommonTables::DEALERUSERS." AS D ON D.user_id = U.Id WHERE D.dealer_id='".$id."'";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if($result){
            return $result;
        }else{
            return false;
        }
    }
    
    public function updateDealerDetails($post, $id){
    	//$query = "UPDATE  ".CommonTables::BECOMEDEALER." SET uniqueId= '".$post['dealer_id']."', name='".$post['name']."', email='".$post['email']."', mobile='".$post['mobile']."', landline='".$post['landline']."', pan='".$post['pan']."', vat='".$post['vat']."', company='".$post['company_name']."', excise='".$post['excise']."',address='".$post['address']."', country='".$post['country']."', state='".$post['state']."', city='".$post['city']."', pincode='".$post['pincode']."', comment= '".$post['message']."',landmark='".$post['landmark']."'  WHERE id='".$id."'";
		
		$query = "UPDATE  ".CommonTables::BECOMEDEALER." SET uniqueId= '".$post['dealer_id']."', name='".$post['name']."', email='".$post['email']."', mobile='".$post['mobile']."', landline='".$post['landline']."', pan='".$post['pan']."', gst_no='".$post['gst_no']."', company='".$post['company_name']."',address='".$post['address']."', country='".$post['country']."', state='".$post['state']."', city='".$post['city']."', pincode='".$post['pincode']."', comment= '".$post['message']."',landmark='".$post['landmark']."'  WHERE id='".$id."'";
    	
    	$stmt = $this->pdoConn->prepare($query);
        $result = $stmt->execute();

        if($result){
            return $result;
        }else{
            return false;
        }
    }


} 
