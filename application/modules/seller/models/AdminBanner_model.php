<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class AdminBanner_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }

    public function getBanner(){
      $query = "
              SELECT *
              FROM ".CommonTables::BANNER." 
                 where 1=1
             ";
      
          $stmt = $this->pdoConn->prepare($query);

          $stmt->execute();
          return $stmt->fetchAll(PDO::FETCH_OBJ);
      }
      
      public function addBanner($arg, $img){
     $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO  " . CommonTables::BANNER . " SET
        title='" . $arg['addName'] . "',
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
    
    
    public function enableDisableBanner($recordId, $isActive)
    {

        $query = "
                     UPDATE  " . CommonTables::BANNER . " SET
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
    
    public function deleteBanner( $recordId)
    {
        $query = "DELETE FROM " . CommonTables::BANNER . "
        WHERE Id='" . $recordId . "'
        ";

        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getBannerById($recordId) {

        $query = "
            SELECT
            * FROM " . CommonTables::BANNER . "
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
		$gallery_path = './uploads/banner/' ;			
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
        
        public function updateBanner($data, $image, $id){

            $query = "
                         UPDATE  " . CommonTables::BANNER . " SET
                        title='" . $data . "',
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

?>
