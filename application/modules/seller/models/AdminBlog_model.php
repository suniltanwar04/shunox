<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

class AdminBlog_model extends CI_Model {
	
    public function __construct() {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
       
    }	


//create function for get all blog --------
	public function getBlog(){
        $query = "
              SELECT *
              FROM ".CommonTables::BLOGS."
                 where 1=1
             ";

        $stmt = $this->pdoConn->prepare($query);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
	}	
	
	
//create function for  get blog by id --------	
	public function getBlogById($id){
        $query = "
            SELECT
            * FROM " . CommonTables::BLOGS . "
            WHERE id ='" . $id . "'";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
	}

    public function addBlog($arg, $img){
        $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO  " . CommonTables::BLOGS . " SET
        title='" . $arg['title'] . "',
        description='" . $arg['description'] . "',
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


//create function for update blog ----------	
	public function update($data, $id){
		$this->db->where('id', $id);
		$res =  $this->db->update(BLOGS, $data); 
		if($res ){
		  return true;
		}
		else{
			return false;
		}
	}	
		
	
//create function delete blog --------
	public function delete($id){
        $query = "DELETE FROM " . CommonTables::BLOGS . "
        WHERE Id='" . $id . "'
        ";

        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
	}

    public function updateBlog($data, $image, $id){

        $query = "
                         UPDATE  " . CommonTables::BLOGS . " SET
                        title='" . $data['title'] . "',
                        image = '".$image."',
                        description = '".$data['description']."',
                        is_active = '".$data['is_active']."'
                        WHERE Id='" . $id . "'
            ";

        $stmt = $this->pdoConn->prepare($query);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
	

//create function for file upload -------	


	
}	
