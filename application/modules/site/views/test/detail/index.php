<?php $mainImage = callModelFunction('site_model','getProductMainImage',$product->Id);
$imagePath = base_url().'uploads/products/';
$imagePathattr = base_url().'uploads/products/attr/';
$productImages = callModelFunction('site_model','getProductImages',$product->Id);
$productAngelImages = callModelFunction('site_model','getProductAngelImages',$product->Id);
$productColorImages = callModelFunction('site_model','getProductColorImages',$product->Id);
// print_r($productColorImages);
// die;
?>
<style>
    input[type="radio"]+label:before {
        background: none;

    }
    input[type="radio"]:checked+label:before{
        background: none;
    }
	ul.piclist li {
		display: block;
	}
	ul.laycolim li {
		display: inline-block !important;
	}
</style>
<div class="container main-container" style="width: 100%;">
    <div class="row">
        <div class="col-sm-12 col-md-12">

            <div class="col-md-6 text-center headi" >
				<div class="col-md-3">
					<ul class="piclist" id="unqimgid">
						<?php
						if($productAngelImages){
						foreach($productAngelImages as $imagesa){
							if($imagesa->attribute == $productAngelImages[0]->attribute){?>
								<li><img src="<?php echo $imagePathattr.$imagesa->image; ?>" class="change_image" id="<?php echo  $imagesa->id; ?>" alt="" style="cursor: pointer; height: 80%"></li>
							<?php  } } }?>
						
					</ul>
				</div>
				<div class="col-md-9">
					<div id="image-change">
						<a href="<?php echo $imagePath.$mainImage->bigImage; ?>" class="zoom">
							<img src="<?php echo $imagePath.$mainImage->ImageName; ?>"  alt="" style="max-width:80% !important;">
						</a>
					</div>
					<ul class="piclist laycolim">
						<?php
						if($productColorImages){
						foreach($productColorImages as $images){?>


							<li><img src="<?php echo $imagePathattr.$images->image; ?>" class="change_image_color" id="<?php echo  $images->attribute; ?>" alt="" style="cursor: pointer; height: 80%"></li>
						<?php } }?>
					</ul>
				</div>
            </div>

            <div class="col-md-2">
                <div class="detail-right">
                    <h2><?php echo $product->ProductName;?></h2>
                    <p>&nbsp;</p>

                </div>
                <form id="product" name="product" method="post">
                    <span id="error" style="color:red"></span>
                    <input type="hidden" id="pro_id" name="pro_id" value="<?php echo $product->Id?>">
                <p>
                   <?php if($product->Quantity > 0){?>
                    <select name="quantity" id="quantity" class="option" style="display: none;">
                        <option value="">Quantity</option>
						<option value="1" selected>1</option>
                       <?php  //for($i=1; $i<=5; $i++){?>
                        <!-- <option value="<?php //echo $i?>"><?php //echo $i?></option>-->
                       <?php //}?>
                        
                    </select>
                   <?php }?>
                   <?php if($productAttribute){     
                          foreach($productAttribute as $productAttributeVal){?>
                    <input type="hidden" id="attributeId" name="attributeId" value="<?php echo $productAttributeVal['attributeId']?>" >
                              <select name="<?php echo strtolower($productAttributeVal['attributeName'])?>" id="<?php echo strtolower($productAttributeVal['attributeName'])?>" class="option">
                                   <option value=""><?php echo $productAttributeVal['attributeName']?></option>
                                   <?php foreach($productAttributeVal[0] as $value){
                                     
                                       ?>
                                   <option value="<?php echo $value->AttributeValueId?>"><?php echo $value->AttributeValue?></option>
                                  <?php  }?>
                           
                                 </select>
                        
                    <?php } }?>

                </p>
                <?php if($product->Quantity > 0){?>
                <p>Ships within 1-2 business days</p>
                <h3 style="color: blue;">In Stock</h3>
                <p>

                    <input type="button" name="submit" id ="<?php echo $product->Id;?>"value="ADD TO CART" class="submit addToCart" />
                    
                </p>
                <?php }else{?>
                    <h3>Out of Stock</h3>
               <?php }?>
                </form>
              <!--  <div class="blog_section">
                    <h4>Choose Color<span>*</span></h4>
                    <div>
                        <div class="holder"> <img class="img-responsive" src="<?php /*echo base_url(); */?>assets/site/images/black..png"><p>Black</p>
                        </div>
                    </div>
                    <div>
                        <div class="holder"> <img class="img-responsive" src="<?php /*echo base_url(); */?>assets/site/images/blue.png"><p>Blue</p>
                        </div>
                    </div>
                    <div>
                        <div class="holder"> <img class="img-responsive" src="<?php /*echo base_url(); */?>assets/site/images/red.png"><p>Red</p>
                        </div>
                    </div>
                </div>
-->
            </div>
            <div class="col-md-4">
                <div class="detail-right">
                <p style="color: #5a3c00;margin-top: 50px;font-weight: 700;"><?php echo $product->Description?></p>
                    </div>
                </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-8">
            <div>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active tab1"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Produt Details</a></li>
                    <li role="presentation" class="tab1"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>
                    <!--<li role="presentation" class="tab1"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Return/Exchange</a></li>-->
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active description" id="home"><?php echo $product->Detail?></div>

                    <div role="tabpanel" class="tab-pane fade description" id="profile">
                        <span id="error-review" style="color:red"></span>
                        <span id="suc" style="color:green"></span>
                        <form method="post" >

                            <div style="width: 400px;">
                            </div>
                            <div class="detail-right"><h1>Product Review</h1></div>
                            <div class="review">Reviewer<span> *</span><br/>
                                <input type="text" id="name" name="name" class="form-control"/>
                            </div>

                            <div class="cont">
                                <div class="stars">
                                    <div class="review">Rating<span> *</span><br/>

                                        <input class="star star-5" id="star-5-2" name ="star[]" type="radio" name="star" value="5">
                                        <label class="star star-5" for="star-5-2"></label>
                                        <input class="star star-4" id="star-4-2" name ="star[]" type="radio" name="star" value="4">
                                        <label class="star star-4" for="star-4-2"></label>
                                        <input class="star star-3" id="star-3-2" name ="star[]" type="radio" name="star" value="3">
                                        <label class="star star-3" for="star-3-2"></label>
                                        <input class="star star-2" id="star-2-2" name ="star[]" type="radio" name="star" value="2">
                                        <label class="star star-2" for="star-2-2"></label>
                                        <input class="star star-1" id="star-1-2" name ="star[]" type="radio" name="star" value="1">
                                        <label class="star star-1" for="star-1-2"></label>
                            </div>
                                </div>
                            </div>



                            <div class="review">Review<span"> *</span><br/>
                                <textarea id="desc"  name="desc" rows="10" class="form-control" ></textarea>
                            </div>

                            <input type="button" name="submit" value="SUBMIT" class="submit" id="submit_review">
                            <div>
                            </div>
                        </form></div>

                    <div role="tabpanel" class="tab-pane fade description" id="messages">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</div>
                </div>

            </div>
        </div>

        

    </div>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/site/js/easyzoom.js"></script>
<script type="text/javascript">

    jQuery(function($){

        $('a.zoom').easyZoom();

    });

</script>

<style>

    /*

    Copy/paste this into your own stylesheet.
    Edit width, height and placement of the dynamically created image zoom box.

    */

    #easy_zoom{

        width:600px;
        height:400px;
        border:5px solid #eee;
        background:#fff;
        color:#333;
        position:absolute;
        top:190px !important;
        left:550px;
        overflow:hidden;
        -moz-box-shadow:0 0 10px #777;
        -webkit-box-shadow:0 0 10px #777;
        box-shadow:0 0 10px #777;
        /* vertical and horizontal alignment used for preloader text */
        line-height:400px;
        text-align:center;
    }

</style>
     

      
