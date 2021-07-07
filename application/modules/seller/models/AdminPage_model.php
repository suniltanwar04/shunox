<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class AdminPage_model extends CI_Model {
	
    public function __construct() {
        parent::__construct();
		$this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }	

	
//create function for get page ---------
	public function getPage(){
		$query = "
                    SELECT
                    *
                     FROM " . CommonTables:: PAGE . " 
                    WHERE 1=1
                   

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
	
	
//create function for get menu ---------
	/* public function getMenu(){
		//$this->db->select('*');
		//$this->db->where('is_deleted',0);
		//$query = $this->db->get('position');
		
		$query = $this->db->query('SELECT * FROM '.POSITION.' WHERE is_deleted=0 AND is_active=1');
		if($query){
			return $query->result_array();
		}else{
			return false;
		}
	} */	
	

//create function for  get page by id --------	
	public function getPageById($id){	
		$query = "
                    SELECT
                    *
                     FROM " . CommonTables:: PAGE . " 
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
	
	
//create function for update page ----------	
	public function update($data, $id){
		$this->db->where('id', $id);
		$res =  $this->db->update(PAGE, $data); 
		
		if($res ){
		  return true;
		}
		else{
			return false;
		}
	}		
	
	
//create function delete page --------
	public function delete($id){
		$this->db->where('id',$id);
		$data['is_deleted'] = 1;
		$query = $this->db->update(PAGES,$data);
		
		if($query){
			return true;
		}else{
			return false;
		}
	} 
	
	public function do_upload(){
		$gallery_path = './../upload/page/' ;			
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
	
	
	public function addPageData($arg, $img)
    {
		
		 $title = strtolower($arg['title']);
		$slug = str_replace(' ', '-', $title);
		$date = date('Y-m-d H:i:s');
        $query = "INSERT INTO ". CommonTables::PAGE." SET

        page_menu ='".$arg['page']."',
        title='".$arg['title']."',
        description='" . addslashes($arg['area1']) . "',
		image = '".$img."',
        slug='" . $slug. "',
        created_at= '".$date ."',
        is_active='1'
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
    
    public function updatePageData($arg, $img, $id)
    {
		
		$title = strtolower($arg['title']);
		$slug = str_replace(' ', '-', $title);
		$date = date('Y-m-d H:i:s');
        $query = "UPDATE ". CommonTables::PAGE." SET

        page_menu ='".$arg['page']."',
        title='".$arg['title']."',
        description='" . addslashes($arg['area1']) . "',
		image = '".$img."',
        slug='" . $slug. "',
        is_active='1',
        modified_at= '".$date ."'
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
