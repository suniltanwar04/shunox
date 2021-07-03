<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class Common_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;

    }

    public function loginCheck()
    {
        if ($this->session->userdata('adminId') > 0 && ($this->session->userdata('UserRole') == 1)) {
            return true;
        } else {
            redirect($this->config->item('base_url') . 'admin', 301);
        }
    }

    public function siteLoginCheck()
    {
        if ($this->session->userdata('IsLoggedIn') == 1 && ($this->session->userdata('UserRole') != 1)) {
            return true;
        } else {
            return false;
        }
    }


    public function setPasswordRequest($userId, $hashSalt)
    {
        $query = "UPDATE  " . Tables::USERS . " SET
        password_requested=:password_requested,
        hashsalt=:hashsalt
        WHERE id=:user_id
        ";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->bindValue(':password_requested', 1, PDO::PARAM_INT);
        $stmt->bindValue(':hashsalt', $hashSalt, PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function checkOldPass($userId, $password)
    {
        $query = "SELECT id AS Id, U.name AS Name FROM " . Tables::USERS . " U WHERE U.id='" . $userId . "' AND U.password='" . md5($password) . "' ";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function resetPassword($userId, $password)
    {
        $query = "UPDATE  " . Tables::USERS . " SET
        password_requested=:password_requested,
        hashsalt=:hashsalt,
        password=:password
        WHERE id=:user_id
        ";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->bindValue(':password_requested', 0, PDO::PARAM_INT);
        $stmt->bindValue(':hashsalt', NULL, PDO::PARAM_STR);
        $stmt->bindValue(':password', md5($password), PDO::PARAM_STR);
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    function  imageResize($path, $image, $sizes, $id, $tbl, $field)
    {
        foreach ($sizes as $key => $value) {
            $width = $value['width'];
            $height = $value['height'];
            $ext = substr($image, strrpos($image, "."), (strlen($image) - strrpos($image, ".")));
            $newImage = $width . 'X' . $height . $ext;
            $config['image_library'] = 'gd2';
            $this->load->library('image_lib', $config);
            $config = array(
                'source_image' => $path . "/" . $image,
                'new_image' => $path . "/" . $newImage,
                'maintain_ratio' => FALSE,
                'width' => $width,
                'height' => $height
            );
            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();

            $qry = "UPDATE " . $tbl . " SET " . $field . " ='$newImage' WHERE id=$id";
            $stmt = $this->pdoConn->prepare($qry);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }

    function uploadImage($file, $path)
    {
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['encrypt_name'] = TRUE;
        $config['remove_space'] = TRUE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload($file)) {
            return -1;
        } else {
            $data = $this->upload->data();
            return $data;

        }
    }
    
     public function getCountries()
    {
        $query = "SELECT * FROM countries  WHERE 1=1 ";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }
    
    public function getState($id)
    {
        $query = "SELECT * FROM states  WHERE country_id='".$id."' ";
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }
	
	  public function getCity1()
    {
        $query = "SELECT * FROM cities";
       
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }
    
     public function getCity($id)
    {
        $query = "SELECT * FROM cities  WHERE state_id='".$id."' ";
       
        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function getCountryById($id)
    {
        $query = "SELECT * FROM countries  WHERE id='".$id."' ";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function getStateById($id)
    {
        $query = "SELECT * FROM states  WHERE id='".$id."' ";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }

    public function getCityById($id)
    {
        $query = "SELECT * FROM cities  WHERE id='".$id."' ";

        $stmt = $this->pdoConn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (!empty($result)) {
            return $result;
        } else {
            return false;
        }
    }
    
    public function adminMail()
    {
        $query = "SELECT to_email FROM " . CommonTables::USER . " U WHERE U.UserRole =1 ";
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
