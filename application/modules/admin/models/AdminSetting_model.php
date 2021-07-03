<?php

class AdminSetting_model extends CI_Model {

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
                
                FROM " . CommonTables::SETTING . " CT
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
	
	
	public function uploadfile($name)
	{
		$gallery_path = './uploads/setting/';			
		$config = array(
			'upload_path' => $gallery_path,
		   'allowed_types' => 'gif|jpg|png',
		   'max_size' => '1000000000',
		   'remove_spaces' => true,
		  ); 
		
		  $this->load->library('upload', $config);
		  
		  if ($this->upload->do_upload($name)){
				$image_data = $this->upload->data();
			   return $image_data;
		  }
		  else{
				$image_data = $this->upload->data();
				return $image_data;
		  }
	 }	
	
	
	
	 


}
