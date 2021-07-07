<?php

class AdminScanningLocation_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }



     public function getValue()
	{
		$query = "
                SELECT
                *
                
                FROM " . CommonTables::SCANNINGLOCATION . " CT
                WHERE 1=1";


        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
	}
	
//create function for update website details ------	
	public function update($uploaddata,$key)
	{	//print_r($uploaddata);
		$res =$this->db->query("UPDATE setting SET value='".$uploaddata."' WHERE name='".$key."'");	
		//echo $this->db->last_query();die;
		if($res )
		{
		  return true;
		}
		else
		{
			return false;
		}
	}
	
	
	public function saveLocation($post)
	{
        $date = date('Y-m-d');
		$query = "
		INSERT INTO ".CommonTables::SCANNINGLOCATION."
		SET address = '".$post['addAddress']."',
		country = '".$post['country']."',
		state = '".$post['state']."',
		city = '".$post['city']."',
		company = '".$post['company']."',
		email = '".$post['email']."',
		phone = '".$post['mobile']."',
		pincode = '".$post['pincode']."',
		map_url = '".$post['addMapurl']."',
		createOn = '".$date."',
		IsActive = 1";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $recordId = $this->pdoConn->lastInsertId();
        if ($recordId > 0) {
            return $recordId;
        } else {
            return false;
        }
	 }

    public function enableDisableLocation($recordId, $isActive)
    {

        $query = "
                     UPDATE  " . CommonTables::SCANNINGLOCATION . " SET
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


    public function deleteLocation( $recordId)
    {
        $query = "DELETE FROM " . CommonTables::SCANNINGLOCATION . "
        WHERE Id='" . $recordId . "'
        ";

        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getLocationById($id){	
		$query = "
                    SELECT
                    *
                     FROM " . CommonTables:: SCANNINGLOCATION . " 
                    WHERE id='".$id."'
                   

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
	
	public function updateLocationData($arg, $id)
    {
		
		$date = date('Y-m-d H:i:s');
        $query = "UPDATE ". CommonTables::SCANNINGLOCATION ." SET

       company ='".addslashes($arg['editcompany'])."',
        email ='".addslashes($arg['editEmail'])."',
        phone='" . $arg['editMobile'] . "',
		
        address='" . addslashes($arg['editAddress']). "',
         map_url='" .  addslashes($arg['editMapurl']). "',
          city='" . $arg['city']. "',
          pincode = '".$arg['pincode']."',
           country='" . $arg['country']. "',
            state='" . $arg['state']. "'
        
       
        WHERE id = '".$id."'
        ";
     
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $recordId = $stmt->execute();;
        if ($recordId) {
            return true;
        } else {
            return false;
        }
    }
	
	 


}
