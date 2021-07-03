<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
include APPPATH . "modules/common/controllers/Common.php";

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class SiteProduct extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('SiteProduct_model', 'SiteCategory_model'));
    }


    public function productsByCategory($slug){
		$categoryId = $this->SiteCategory_model->getCategoryBySlug($slug);
        $category = $this->SiteCategory_model->getCategoryById($categoryId->Id);
        $data['innerBannerName'] = $category->CategoryName;
        $data['innerBannerSubName'] = $category->CategoryName;
        $data['products'] = $this->SiteProduct_model->getProductsByCategory($categoryId->Id);

        $data['jquery'] = 'site/test/products/js/products-js';
        $data['content'] = 'site/test/products/index';
        echo Modules::run('template/siteTemplate', $data);
    }

    public function lifeStyle(){

        // $category = $this->SiteCategory_model->getCategoryById($categoryId);
        // $data['innerBannerName'] = $category->CategoryName;
        // $data['innerBannerSubName'] = $category->CategoryName;
        $data['products'] = $this->SiteProduct_model->lifeStyleProduct();
        $data['jquery'] = 'site/products/js/products-js';
        $data['content'] = 'site/products/index';
        echo Modules::run('template/siteTemplate', $data);
    }


    public function latestProducts()
    {
        $data['innerBannerName'] = 'Latest Fashion';
        $data['innerBannerSubName'] = 'Latest Fashion';
        $data['products'] = $this->SiteProduct_model->getLatestProducts();
        $data['jquery'] = 'site/products/js/products-js';
        $data['content'] = 'site/products/index';
        echo Modules::run('template/siteTemplate', $data);
    }

    public function featuredProducts()
    {
        $data['innerBannerName'] = 'Featured Fashion';
        $data['innerBannerSubName'] = 'Featured Fashion';
        $data['products'] = $this->SiteProduct_model->getFeaturedProducts();
        $data['jquery'] = 'site/products/js/products-js';
        $data['content'] = 'site/products/index';
        echo Modules::run('template/siteTemplate', $data);
    }

    public function productsBySubCategory($slug)
    {
		$subCategoryId = $this->SiteCategory_model->getSubCategoryBySlug($slug);
        $subCategory = $this->SiteCategory_model->getSubCategoryById($subCategoryId->Id);
         
        $data['innerBannerName'] = $subCategory->CategoryName;
        $data['innerBannerSubName'] = $subCategory->SubCategoryName;
        $data['subcategories'] = $this->SiteCategory_model->getHomeSubCategories();
        $data['colors'] = $this->SiteProduct_model->getAttributeValueByName('Color');
        $data['sizes'] = $this->SiteProduct_model->getAttributeValueByName('Size');
        $data['widths'] = $this->SiteProduct_model->getAttributeValueByName('Width');
        $data['products'] = $this->SiteProduct_model->getProductsBySubCategory($subCategoryId->Id);


        $data['jquery'] = 'site/test/products/js/products-js';
        $data['content'] = 'site/test/products/index';
        echo Modules::run('template/siteTemplate', $data);
    }


    public function productDetail($productId)
    {
        $product = $this->SiteProduct_model->getProductById($productId);
        $data['innerBannerName'] = $product->CategoryName;
        $data['innerBannerSubName'] = $product->SubCategoryName;
        $subCatProducts = $this->SiteProduct_model->getProductsBySubCategory($product->SubCategoryId);
        $data['product'] = $product;

        $data['reviews'] = $this->SiteProduct_model->getProductReviews($productId);
        $data['similarProducts'] = $subCatProducts;
        $data['jquery'] = 'site/product-detail/js/product-detail-js';
        $data['content'] = 'site/product-detail/index';
        echo Modules::run('template/siteTemplate', $data);
    }


    public function productReviews($productId)
    {
        $product = $this->SiteProduct_model->getProductById($productId);
        $data['innerBannerName'] = $product->ProductName;
        $data['innerBannerSubName'] = 'Reviews';
        $subCatProducts = $this->SiteProduct_model->getProductsBySubCategory($product->SubCategoryId);
        $data['product'] = $product;

        $data['reviews'] = $this->SiteProduct_model->getProductReviews($productId);

        $data['similarProducts'] = $subCatProducts;
        $data['jquery'] = 'site/product-reviews/js/product-reviews-js';
        $data['content'] = 'site/product-reviews/index';
        echo Modules::run('template/siteTemplate', $data);
    }

    /*
    \
    \Shobhit Singh
    \01/Feb/2017
    \
    */

    public function getCategoryProductByPrice(){
        sleep(2);
        $data['products'] = $this->SiteProduct_model->getProductsByPrice($_POST);
        $this->load->view('products/ajax_data/product_by_price', $data);
    }

    public function searchForProduct($key){
      $keyword = str_replace("-"," ",$key);
      $data['products'] = $this->SiteProduct_model->searchForProduct($keyword);
      $data['jquery'] = 'site/test/products/js/products-js';
      $data['content'] = 'site/test/products/searched_product';
      echo Modules::run('template/siteTemplate', $data);
    }


    /*
    * price filters
    */

    public function priceFilterWithCategory(){
      sleep(2);
      $min = $this->input->post("min");
      $max = $this->input->post("max");
      $category = $this->input->post("param");
      $data['products'] = $this->SiteProduct_model->priceFilterWithCategory($category,$min,$max);
      $this->load->view('products/ajax_data/product_by_price', $data);
    }

    public function productByFilter(){
      sleep(2);
      $min = $this->input->post("min");
      $max = $this->input->post("max");
      $gender = $this->input->post("gender");
      $subcategory = $this->input->post("category");
      $color = $this->input->post("color");
      $size = $this->input->post("size");
      $width = $this->input->post("width");
        $position = $this->input->post("position");
        if($min!='' && $max!='' && $subcategory!='') {
            $data['products'] = $this->SiteProduct_model->priceFilterWithSubCategory($subcategory, $min, $max);
        }else if($gender!='' && $subcategory!=''){
            $data['products'] = $this->SiteProduct_model->priceFilterWithGender($subcategory,$gender);
        }else if($subcategory!='' && $color=='' && $gender=='' && $min==''){
            $data['products'] = $this->SiteProduct_model->getProductsBySubCategory($subcategory);
        }else if($color!='' && $subcategory!=''){
            $data['products'] = $this->SiteProduct_model->getProductsByAttribute($subcategory, $color);
        }else if($size!='' && $subcategory!=''){
            $data['products'] = $this->SiteProduct_model->getProductsByAttribute($subcategory, $size);
        }else if($position!='' && $subcategory!=''){
            $data['products'] = $this->SiteProduct_model->getProductsByPosition($subcategory, $position);
        }else if($width!='' && $subcategory!=''){
            $data['products'] = $this->SiteProduct_model->getProductsByAttribute($subcategory, $width);
        }
//print_r($data['products']);
      $this->load->view('site/test/products/ajax_data/product_by_price', $data);
    }

//    public function priceFilterWithSearchedProduct(){
//      sleep(2);
//      $min = $this->input->post("min");
//      $max = $this->input->post("max");
//      $key = $this->input->post("param");
//      $keyword = str_replace("-"," ",$key);
//      $data['products'] = $this->SiteProduct_model->searchForProduct($keyword,$min,$max);
//      $this->load->view('products/ajax_data/product_by_price', $data);
//    }
//
//    public function priceFilterWithLifeStyle(){
//      sleep(2);
//      $min = $this->input->post("min");
//      $max = $this->input->post("max");
//      $key = $this->input->post("category");
//      $data['products'] = $this->SiteProduct_model->priceFilterWithLifeStyle($min,$max,$key);
//      $this->load->view('products/ajax_data/product_by_price', $data);
//    }
//
//    public function priceFilterWithFeaturedFashion(){
//      sleep(2);
//      $min = $this->input->post("min");
//      $max = $this->input->post("max");
//      $data['products'] = $this->SiteProduct_model->priceFilterWithFeaturedFashion($min,$max);
//      $this->load->view('products/ajax_data/product_by_price', $data);
//    }


    public function notifyMe(){
      sleep(2);
      $product = $this->input->post("productId");
      $userId = $this->session->userdata("Id");
      $requested = $this->SiteProduct_model->checkIfRequested($product,$userId);
      if(!$requested){
        if($this->SiteProduct_model->saveNotifyMe($product,$userId)){
          $this->load->model("User_model");
          $user = $this->User_model->getProfile();
          $message = "Hi, ".$user->FullName."\r\n";
          $message .= "We will notified you once the stock will be availble. \r\n";
          $message .= "Thanks and Regards \r\n";
          $message .= "ShoeMade4u Team";
          CommonSms::mobileSms($user->Mobile, $message);
          echo 1;
        }else{
          echo 0;
        }
      }else{
        echo -1;
      }

    }

    public function review()
    {
        $name = $this->input->post('name');
        $pro_id = $this->input->post('productId');
        $rating = $this->input->post('rating');
        $desc = $this->input->post('desc');
        $review = $this->SiteProduct_model->saveReview($name,$pro_id,$rating,$desc);
        if($review){
            echo '1';
        }else{
            echo '0';
        }
    }
    
    public function changeThumbImage()
    {
        $sort = $this->input->post('sort');
        $pro_id = $this->input->post('pro_id');
        $imgId = $this->input->post('imgId');

        $image = $this->SiteProduct_model->changeThumbImage($sort,$pro_id,$imgId);

        if($image){
            $data['mainImage'] = $image;
            $this->load->view('site/test/detail/change-image-list', $data);
        }else{
            echo '0';
        }
    }
	public function changeThumbImageColor()
    {
        $sort = $this->input->post('sort');
        $pro_id = $this->input->post('pro_id');
        $attr_id = $this->input->post('imgId');

        $image = $this->SiteProduct_model->changeThumbImageColor($sort,$pro_id,$attr_id);

        if($image){
            $data['mainImage'] = $image;
			if($image){
			foreach($image as $imagesa){ ?>
					<li><img src="<?php echo  base_url().'uploads/products/attr/'.$imagesa->image; ?>" class="change_image" id="<?php echo  $imagesa->id; ?>" alt="" style="cursor: pointer; height: 80%"></li>
				<?php  } }
        }else{
            echo '0';
        }
    }


}
