<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH . "modules/common/controllers/Common.php";

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */

class AdminProduct extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('AdminProduct_model', 'AdminAttribute_model', 'AdminAttributeMapping_Model', 'AdminCategory_model'));

    }



    public function productAttributeList($productId){
        $this->Common_model->loginCheck();
        $data['attributes_vals'] = $this->AdminAttribute_model->getProductAttributes($productId);
        // echo "<pre>";
        // print_r($data['attributes_vals']);
        // die;
        $data['attributes'] = $this->AdminAttribute_model->getAttributes();
        $data['jquery'] = 'admin/product-attribute/js/product-attribute-js';
        $data['content'] = 'admin/product-attribute/index';
        echo Modules::run('template/adminTemplate', $data);

    }
	public function productImagesList($productId){
        $this->Common_model->loginCheck();
        $data['Images'] = $this->AdminAttribute_model->getProductImages($productId);
        // echo "<pre>";
        // print_r($data['Images']);
        // die;
        // $data['attributes'] = $this->AdminAttribute_model->getAttributes();
        $data['jquery'] = 'admin/product-attribute/js/product-attribute-js';
        $data['content'] = 'admin/product-attribute/images';
        echo Modules::run('template/adminTemplate', $data);

    }
	public function productImagesDelete($id,$productId){
        $this->Common_model->loginCheck();
        $data['Delete'] = $this->AdminAttribute_model->productImagesDelete($id);
        $data['Images'] = $this->AdminAttribute_model->getProductImages($productId);
        // echo "<pre>";
        // print_r($data['Images']);
        // die;
        // $data['attributes'] = $this->AdminAttribute_model->getAttributes();
        $data['jquery'] = 'admin/product-attribute/js/product-attribute-js';
        $data['content'] = 'admin/product-attribute/images';
        echo Modules::run('template/adminTemplate', $data);

    }

     public function saveProductAttribute(){

         $this->Common_model->loginCheck();
         $productId = $this->input->post('productId');
         $ProductAttr = $this->input->post('ProductsAttr');
         $ProductAttrValue = $this->input->post('SelectAttrVal');
         $Price = $this->input->post('ProductPrice');
         $discountedPrice = $this->input->post('discountPrice');


         //checking wheather the value is already exists or not
         $checkExist = $this->AdminAttribute_model->checkExistAttribute($productId, $ProductAttr,$ProductAttrValue);
         if(!$checkExist){

           $attributeMapingId = $this->AdminProduct_model->mapProductAttribute($productId,$ProductAttr);

           //mapping product attribue value
           $this->AdminProduct_model->mapProductAttributeValue($attributeMapingId,$ProductAttrValue);

           //mapping the product price against the attribute
           $this->AdminProduct_model->addProductPrice($ProductAttrValue,$productId,$Price,$discountedPrice,$InProduct = 0);
           echo 1;
         }else{
           echo -1;
         }

     }
     public function saveImageAttribute(){

        $this->Common_model->loginCheck();
        $productId = $this->input->post('productId');
		//echo $productId;
		$ProductAttrValue = $this->input->post('SelectAttrVal');
		$ProductAttrImage = $this->input->post('attrImages');
		
		
		if (isset($_FILES['attrImages']['name'])) {

            $sortorder = 0;
            for($i=0;$i<count($_FILES['attrImages']['name']);$i++) {

                if ($_FILES['attrImages']['name'][$i] != "") {
                    $uploadedfile = $_FILES['attrImages']['tmp_name'][$i];
                    $filename = stripslashes($_FILES['attrImages']['name'][$i]);

                    $extension = $this->getExtension($filename);
                    $extension = strtolower($extension);
                    if($extension=="jpg" || $extension=="jpeg" )
                    {
                        $uploadedfile = $_FILES['attrImages']['tmp_name'][$i];
                        $src = imagecreatefromjpeg($uploadedfile);

                    }
                    else if($extension=="png")
                    {
                        $uploadedfile = $_FILES['attrImages']['tmp_name'][$i];
                        $src = imagecreatefrompng($uploadedfile);

                    }
                    else
                    {
                        $src = imagecreatefromgif($uploadedfile);
                    }
                    list($width,$height)=getimagesize($uploadedfile);


                    $newwidth=3000;
                    $newheight=($height/$width)*$newwidth;
                    $tmp=imagecreatetruecolor($newwidth,$newheight);


                    $newwidth1=600;
                    $newheight1=($height/$width)*$newwidth1;
                    $tmp1=imagecreatetruecolor($newwidth1,$newheight1);

                    imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

                    imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);

					$unqid = uniqid();
                    $bigImage = "uploads/products/attr/".$unqid.$_FILES['attrImages']['name'][$i];

                    //$smallImage = "uploads/products/attr/small".uniqid().$_FILES['attrImages']['name'][$i];

                    $bigimag = $unqid.$_FILES['attrImages']['name'][$i];
                    //$smallImag = "small".uniqid().$_FILES['attrImages']['name'][$i];

                    imagejpeg($tmp,$bigImage,100);
                    //imagejpeg($tmp1,$smallImage,100);

                    imagedestroy($src);
                    imagedestroy($tmp);
                    imagedestroy($tmp1);
                    $ImageType = 1;
                    $res = $this->AdminProduct_model->addImageAttr($productId, $ProductAttrValue, $bigimag);

                }
                $sortorder++;
            }
        }
		// echo $res;
		if($res){
			echo "success";
		}
		else{
			echo "failed";
		}
		die();
     }


    public function products(){
        $this->Common_model->loginCheck();
        $data['products'] = $this->AdminProduct_model->getProduct();
        $data['attributes'] = $this->AdminProduct_model->getAttributes();
        $data['jquery'] = 'admin/product/js/product-js';
        $data['content'] = 'admin/product/index';
        echo Modules::run('template/adminTemplate', $data);
    }


    public function saveProduct(){
        $this->Common_model->loginCheck();

        //adding product
        $productId = $this->AdminProduct_model->addProduct($_POST);
        //adding product image

        //mapping product attribute
        $attributeMapingId = $this->AdminProduct_model->mapProductAttribute($productId,$_POST['AddProductAttr']);
        //mapping product attribue value
        $mapProductAttributeValue = $this->AdminProduct_model->mapProductAttributeValue($attributeMapingId,$_POST['AddProductAttrValue']);

        //mapping the product price against the attribute
        $this->AdminProduct_model->addProductPrice($_POST['AddProductAttrValue'],$productId,$_POST['addPrice'],$_POST['discountPrice']);
        if (isset($_FILES['addimage']['name'])) {

            $sortorder = 0;
            for($i=0;$i<count($_FILES['addimage']['name']);$i++) {

                if ($_FILES['addimage']['name'][$i] != "") {
                    $uploadedfile = $_FILES['addimage']['tmp_name'][$i];
                    $filename = stripslashes($_FILES['addimage']['name'][$i]);

                    $extension = $this->getExtension($filename);
                    $extension = strtolower($extension);
                    if($extension=="jpg" || $extension=="jpeg" )
                    {
                        $uploadedfile = $_FILES['addimage']['tmp_name'][$i];
                        $src = imagecreatefromjpeg($uploadedfile);

                    }
                    else if($extension=="png")
                    {
                        $uploadedfile = $_FILES['addimage']['tmp_name'][$i];
                        $src = imagecreatefrompng($uploadedfile);

                    }
                    else
                    {
                        $src = imagecreatefromgif($uploadedfile);
                    }
                    list($width,$height)=getimagesize($uploadedfile);


                    $newwidth=3000;
                    $newheight=($height/$width)*$newwidth;
                    $tmp=imagecreatetruecolor($newwidth,$newheight);


                    $newwidth1=600;
                    $newheight1=($height/$width)*$newwidth1;
                    $tmp1=imagecreatetruecolor($newwidth1,$newheight1);

                    imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);

                    imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1,$width,$height);


                    $bigImage = "uploads/products/". $_FILES['addimage']['name'][$i];

                    $smallImage = "uploads/products/small". $_FILES['addimage']['name'][$i];

                    $bigimag = $_FILES['addimage']['name'][$i];
                    $smallImag = "small".$_FILES['addimage']['name'][$i];

                    imagejpeg($tmp,$bigImage,100);

                    imagejpeg($tmp1,$smallImage,100);

                    imagedestroy($src);
                    imagedestroy($tmp);
                    imagedestroy($tmp1);
                    $ImageType = 1;
                    $this->AdminProduct_model->addImage($bigimag,$smallImag, $productId,$ImageType,$sortorder);

                }



                $sortorder++;
            }
        }




    }

    function getExtension($str) {
        $i = strrpos($str,".");
        if (!$i) { return ""; }
        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);
        return $ext;
    }


    public function enableDisableProduct()
    {
        $this->Common_model->loginCheck();
        $recordId = $this->input->post('recordId');
        $isActive = $this->input->post('isActive');
        $activate = $this->AdminProduct_model->enableDisableProduct($recordId, $isActive);

        if ($activate) {
            $data['products'] = $this->AdminProduct_model->getProduct();
            $this->load->view('admin/product/services/product-list', $data);
        } else {
            echo -1;
        }
    }


    public function editProduct($productId){
        $this->Common_model->loginCheck();
        // $productsimg = $this->AdminProduct_model->getProductimageById($productId);
        // $data['productsimg'] = $productsimg;
        $data['jquery'] = 'admin/product/js/product-js';
        $data['product'] = $this->AdminProduct_model->getProductById($productId);
        // echo "<pre>";
        // print_r($data['product']);
        // echo "</pre>";
        // die;
        $data['content'] = 'admin/product/edit-product';
        echo Modules::run('template/adminTemplate', $data);
    }

    public function updateProduct(){
      // print_r($_POST);
      // die;
      sleep(2);
        $this->Common_model->loginCheck();
        $productId  = $this->input->post("productId");
        $productName  = $this->input->post("productName");
        $preQuantity  = $this->input->post("notifyQuantity");
        $quantity  = $this->input->post("quantity");

        if($this->AdminProduct_model->updateProduct($_POST,$productId)){
          //notifying the user who requested for the product
          if($preQuantity == 0 AND $quantity > $preQuantity){
              $users = $this->AdminProduct_model->getUserToNotify($productId);
              if($users){
                $message = "Hi ";
                foreach ($users as $user) {
                  $message .= $user->FullName."\r\n";
                  $message .= $productName." is now available in stock.\r\n";
                  $message .= "Thanks and regards\r\n";
                  $message .= "ShoeMade4u Team\r\n";
                  CommonSms::mobileSms($user->Mobile, $message);
                  $message = "Hi ";
                  $this->AdminProduct_model->deleteNotifiedUser($user->UserId,$productId);
                }
              }
          }
          echo 1;
        }else{
          echo 0;
        }
    }



    public function deleteProduct(){
        $recordId = $this->input->post('recordId');
        $deleteproduct = $this->AdminProduct_model->deleteProduct($recordId);
        $data['products'] = $this->AdminProduct_model->getProduct();
        $this->load->view('admin/product/services/product-list', $data);
    }

    //Shobhit Singh

    public function getAttributeValue(){
        $data = $this->AdminProduct_model->getAttributeValue($_POST);
        foreach($data as $data){
            echo "<option value='".$data->Id."'>".$data->AttributeValue."</option>";
        }
    }

    public function getAttributeVals(){
        $data = $this->AdminAttribute_model->attributeValue($_POST);
        foreach($data as $data){
            echo "<option value='".$data->Id."'>".$data->AttributeValue."</option>";
        }
    }

    public function getAttributesBysubCategory(){
        $subCategory = $this->input->post("subCategory");
        $data['attributes'] = $this->AdminProduct_model->getAttributesBysubCategory($subCategory);
        $this->load->view('product/services/attribute-by-sub-category',$data);
    }

    public function generateExcel(){
        $data = $this->AdminProduct_model->getProductTableHeading();
        unset($data['Id'],$data['IsActive'],$data['CreatedBy'],$data['CreatedOn'],$data['ModifiedBy'],$data['ModifiedOn']);
        $data = array_keys($data);

        array_push($data,"Images");

        $filePath = FCPATH.'assets/admin/csv/productHeading.csv';

        $handle = fopen($filePath,"w");
          if(fputcsv($handle,$data)){
            echo 1;
          }else{
            echo 0;
          }
        fclose($handle);
    }

    public function uploadExcel(){
      sleep(2);
      $uploadPath = FCPATH.'assets/admin/csv/';
      $file_name = "Products.csv";
      $file_tmp = $_FILES['productCsv']['tmp_name'];

      if(!empty($file_name)){
        if(move_uploaded_file($file_tmp,$uploadPath.$file_name)){

          $uploadedCsv = $uploadPath.$file_name;
          $handle = fopen($uploadedCsv,"r");
          $i = 0;
          $result = 0;
          while(!feof($handle)){
            $product = fgetcsv($handle);
            //checking $i > 0 to skip the headings of csv
            if($i != 0){
              //fgetcsv reads the last row which is empty, so checking if $product is not empty then insert the product
              if($product){
                $productId = $this->AdminProduct_model->addCsvProduct($product);

                //mapping product attribute
                $attributeMapingId = $this->AdminProduct_model->mapProductAttribute($productId,$product[3]);
                //mapping product attribue value
                $mapProductAttributeValue = $this->AdminProduct_model->mapProductAttributeValue($attributeMapingId,$product[4]);

                //mapping the product price against the attribute
                $this->AdminProduct_model->addProductPrice($product[4],$productId,$product[5],$product[8]);

                //adding product images
                $images = explode(',',end($product));
                foreach($images as $image){
                  $result = $this->AdminProduct_model->addCsvImages($productId,$image);
                }
              }
            }
            $i++;
          }
          fclose($handle);
          if($result){
            unlink($uploadedCsv);
            echo $result;
          }
        }else{
          //means file not uploaded
          echo -1;
        }
      }

    }

    public function uploadProductImages(){
      $uploadPath =   $uploadPath = FCPATH."uploads/products/";
      $files = $_FILES['productImages']['name'];
      $tmp_name = $_FILES['productImages']['tmp_name'];
      $allowedTypes = ['jpg','jpeg','png'];

      foreach($files as $file){
        $ext = explode(".",$file);
        $ext = strtolower(end($ext));
        if(!in_array($ext,$allowedTypes)){
          echo -1;
          exit;
        }
      }

      $i = 0;
      $result = 0;
      foreach($_FILES as  $files){
        foreach($files['tmp_name'] as $file_tmp){
          $name = $files['name'][$i];
          if(move_uploaded_file($file_tmp,$uploadPath.$name)){
            $result += 1;
          }
          $i++;
        }
      }
      echo $result;

    }

    public function updateAttributePrice(){
      sleep(2);
      $price = $this->input->post("price");
      $attributePriceId = $this->input->post("attributePriceId");
      $coloum = $this->input->post("coloum");
      $inProduct = $this->input->post("inProduct");
      $productId = $this->input->post("productId");
      if($this->AdminAttribute_model->updateAttributePrice($price,$coloum,$attributePriceId)){
        if($inProduct > 0){
            $this->AdminProduct_model->updateProductPrice($price,$coloum,$productId);
        }
        // echo 1;
      }
    }

}

?>
