<?php

/**
 * Created by PhpStorm.
 * User: amit
 * Date: 22/10/16
 * Time: 11:07 PM
 */
class AdminSocial_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }


    public function getSocial()
    {
        $query = "
                  SELECT
                  *
                  FROM " . CommonTables::SOCIAL . "
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


    public function addSocial($arg, $img){
     $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO  " . CommonTables::SOCIAL . " SET
        title='" . $arg['addName'] . "',
        url='" . $arg['url'] . "',
        image='" . $img. "',
        created_at = '".$date."'
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
    
    public function enableDisableSocial($recordId, $isActive)
    {

        $query = "
                     UPDATE  " . CommonTables::SOCIAL . " SET
                    is_active='" . $isActive . "'
                    WHERE Id='" . $recordId . "'
        ";

        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    
    public function deleteSocial( $recordId)
    {
        $query = "DELETE FROM " . CommonTables::SOCIAL . "
        WHERE Id='" . $recordId . "'
        ";

        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getSocialById($recordId) {

        $query = "
            SELECT
            * FROM " . CommonTables::SOCIAL . "
            WHERE id ='" . $recordId . "'";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }
    
    public function do_upload(){
		$gallery_path = './uploads/social/' ;			
		$config = array(
			'upload_path' => $gallery_path,
			'allowed_types' => 'gif|jpg|png|jpeg',
			'max_size' => '1000000',
			'remove_spaces' => true,
		);	

		$this->load->library('upload', $config);
		
		if ($this->upload->do_upload()){
			$image_data = $this->upload->data();
			return $image_data;
		}
		else{
			$image_data = $this->upload->data();
			return $image_data;
		}
	}
        
        public function updateSocial($data, $image, $id){

            $query = "
                         UPDATE  " . CommonTables::SOCIAL . " SET
                        title='" . $data['title'] . "',
                        url='" . $data['url'] . "',
                        image = '".$image."'
                        WHERE Id='" . $id . "'
            ";

            $stmt = $this->pdoConn->prepare($query);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
         }

}