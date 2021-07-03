<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class AdminDashboard_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }

    public function countUsers(){
			$query = "SELECT Id FROM ". CommonTables::USER." WHERE UserRole > 1";
			$stmt = $this->pdoConn->prepare($query);
		    $stmt->execute();
			$result = $stmt->rowCount();
			return $result;
	}
	
	public function countOrders(){
			$query = "SELECT Id FROM ". CommonTables::USER_ORDER." WHERE 1=1";
			$stmt = $this->pdoConn->prepare($query);
			$stmt->execute();
			$result = $stmt->rowCount();
			return $result;
	}
	
	
	public function countProducts(){
			$query = "SELECT Id FROM ". CommonTables::PRODUCT." WHERE 1=1";
			$stmt = $this->pdoConn->prepare($query);
			$stmt->execute();
			$result = $stmt->rowCount();
			return $result;
	}
	
	public function countBanners(){
			$query = "SELECT Id FROM ". CommonTables::BANNER." WHERE 1=1";
			$stmt = $this->pdoConn->prepare($query);
			$stmt->execute();
			$result = $stmt->rowCount();
			return $result;
	}
	
	

  }

?>
