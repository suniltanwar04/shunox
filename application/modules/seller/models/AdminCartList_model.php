<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class AdminCartList_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->pdo = $this->load->database('pdo', true);
        $this->pdoConn = $this->pdo->conn_id;
    }

    public function getCartList(){
      $query = "
              SELECT C.Id AS CartId, C.Quantity,
              CAV.AttributeId,
              P.ProductName, P.ShowToUser,
              PA.AttributeName,
              PAV.AttributeValue,
              PAP.Price, PAP.DiscountedPrice,
              U.FullName, U.Id AS UserId, U.Email
              FROM ".CommonTables::CART." AS C
              LEFT JOIN ".CommonTables::CART_ATTR_VALUE." AS CAV
              ON CAV.CartId = C.Id
              LEFT JOIN ".CommonTables::PRODUCT." AS P
              ON P.Id = C.ProductId
              LEFT JOIN ".CommonTables::PRODUCT_ATTRIBUTE." AS PA
              ON PA.Id = CAV.AttributeId
              LEFT JOIN ".CommonTables::PRODUCT_ATTRIBUTE_VALUE." AS PAV
              ON PAV.Id = CAV.ValueId
              LEFT JOIN ".CommonTables::PRODUCT_ATTRIBUTE_PRICE." AS PAP
              ON PAP.PAVId = CAV.ValueId AND PAP.ProductId = C.ProductId
              LEFT JOIN ".CommonTables::USER." AS U
              ON U.Id = C.UserId";
          $stmt = $this->pdoConn->prepare($query);

          $stmt->execute();
          return $stmt->fetchAll(PDO::FETCH_OBJ);
      }

  }

?>
