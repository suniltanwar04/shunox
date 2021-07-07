<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class AdminNotifyList_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }

    public function getNotifyUsers(){
      $query = "
              SELECT N.ProductId, N.CreatedOn AS date,
              U.FullName, U.Email,
              P.ProductName
              FROM ".CommonTables::NOTIFY_ME." AS N
              LEFT JOIN ".CommonTables::USER." AS U
              ON U.Id = N.UserId
              LEFT JOIN ".CommonTables::PRODUCT." AS P
              ON P.Id = N.ProductId";
              $stmt = $this->pdoConn->prepare($query);
          $stmt->execute();
          return $stmt->fetchAll(PDO::FETCH_OBJ);
      }

  }

?>
