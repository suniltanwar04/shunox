<style>
	input[type="checkbox"]+label:before, input[type="radio"]+label:before{
		display:none;
	}
	input.radio {
		display: block;
	}
	ul.cd-filter-content.cd-filters.list {
		list-style: none;
	}

	ul.cd-filter-content.cd-filters.list li {
		display: flex;
	}

	.filter.radio {
		margin-top: 0;
		position: relative;
		right: 10px;
		bottom: 2px;
	}

	.cd-filter-block {
		margin-top: 25px;
	}
	.tpfltrdv {
		display: none;
	}
</style>
<div id="loader">
    <img src="<?php echo base_url().'assets/site/images/loader.gif'; ?>" alt="">
</div>
<section class="main-container col2-left-layout  animated">
<div class="container">
<!-- Filter Section -->
<div class="row tpfltrdv">

<div class="col-sm-12">
<div class="resp_filter">
<p>Filter</p>
<div class="filter-wrap">
    <form method="post">
        <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url()?>">

 <ul>
	  <?php if($this->uri->segment(1) == 'sub-category'){?>
  
    
         <input type="hidden" id="uri" name="uri" value="<?php echo $this->uri->segment(3)?>">
   <li>

  <select id="category" name="category">
   <option>Select Category</option>
      <?php foreach($subcategories as $subcategorie){?>
    <option value="<?php echo $subcategorie->Id?>"><?php echo $subcategorie->SubCategoryName?></option>
      <?php }?>

  </select>
  </li>
   
  
   <li>
  <select id="gender" name="gender">
   <option >Select Gender</option>
    <option value="Male">Male</option>
    <option value="Female">Female</option>
  </select>
  </li>
    <?php }else{?>
         <input type="hidden" id="uri" name="uri" value="0">
     <?php }?>
     <?php if($this->uri->segment(1) == 'sub-category'){?>
    <li>
  <select id="color" name="color">
   <option >Select Color Family</option>
      <?php

      foreach($colors as $color){?>
    <option value="<?php echo $color->Id?>"><?php echo $color->AttributeValue?></option>
      <?php }?>
  </select>
  </li>

    <li>
  <select id="size" name="size">
   <option>Select Size</option>
      <?php

      foreach($sizes as $size){?>
          <option value="<?php echo $size->Id?>"><?php echo $size->AttributeValue?></option>
      <?php }?>
  </select>
  </li>
     <li>

  <select id="width" name="width">
   <option>Select Foot Width</option>
      <?php

      foreach($widths as $width){?>
          <option value="<?php echo $width->Id?>"><?php echo $width->AttributeValue?></option>
      <?php }?>
     </select>
  </li>
     <?php }?>
 </ul> 
 </ul>
        </form>
</div>
</div>
</div>
</div>
<!-- Filter Section End -->
<div class="row">
<div class="col-sm-2 hcstmlft">
	<form>
	<?php if($this->uri->segment(1) == 'sub-category'){?>
		<div class="cd-filter-block">
			<h4>Choose a Category</h4>
			<ul class="cd-filter-content cd-filters list">
				<?php $i = 1; foreach($subcategories as $subcategorie){?>
					<li>
						<input class="filter radio cat_radio" type="radio" name="catbutton" id="radio<?= $i; ?>" value="<?php echo $subcategorie->Id?>">
						<label class="radio-label" for="radio<?= $i; ?>"><?php echo $subcategorie->SubCategoryName?></label>
					</li>
				<?php $i++; }?>
			</ul>
		</div>
		<!-- <div class="cd-filter-block">
			<h4>Choose a Gender</h4>
			<ul class="cd-filter-content cd-filters list">
				<li>
					<input class="filter radio gender_radio" type="radio" name="genderbutton" id="genderradio1" value="Male">
					<label class="radio-label" for="catbutton">Male</label>
				</li>
				<li>
					<input class="filter radio gender_radio" type="radio" name="genderbutton" id="genderradio2" value="Female">
					<label class="radio-label" for="catbutton">Female</label>
				</li>
			</ul>
		</div> -->
	<?php } else{?>
			<input type="hidden" id="uri" name="uri" value="0">
		<?php }?>
		
		
		<?php if($this->uri->segment(1) == 'sub-category'){?>
			<!-- <div class="cd-filter-block">
				<h4>Color</h4>
				<ul class="cd-filter-content cd-filters list">
					<?php //$i = 1; foreach($colors as $color){?>
						<li>
							<input class="filter radio color_radio" type="radio" name="colorbutton" id="radio<?= $i; ?>" value="<?php echo $color->Id; ?>">
							<label class="radio-label" for="radio<?php //echo $i; ?>"><?php //echo $color->AttributeValue?></label>
						</li>
					<?php //$i++; }?>
				</ul>
			</div>
			
			<div class="cd-filter-block">
				<h4>Choose Size</h4>
				<ul class="cd-filter-content cd-filters list">
					<?php //$i = 1; foreach($sizes as $size){?>
						<li>
							<input class="filter radio size_radio" type="radio" name="sizebutton" id="radio<?= $i; ?>" value="<?php echo $size->Id; ?>">
							<label class="radio-label" for="radio<?// echo $i; ?>"><?php //echo $size->AttributeValue?></label>
						</li>
					<?php //$i++; }?>
				</ul>
			</div>
			
			<div class="cd-filter-block">
				<h4>Choose Foot Width</h4>
				<ul class="cd-filter-content cd-filters list">
					<?php //$i = 1; foreach($widths as $width){?>
						<li>
							<input class="filter radio width_radio" type="radio" name="widthbutton" id="radio<?= $i; ?>" value="<?php echo $width->Id; ?>">
							<label class="radio-label" for="radio<?php// echo $i; ?>"><?php //echo $width->AttributeValue?></label>
						</li>
					<?php// $i++; }?>
				</ul>
			</div> -->
		<?php }?>
	</form>
</div>
<div class="col-main col-sm-10 product-grid">
<div class="pro-coloumn">
<?php
if ($products) {   ?>
    <article class="col-main">
    <!-- <div class="toolbar">
        <div id="sort-by">
            <label class="left">Sort By: </label>
            <ul>
                <li><a href="#">Position<span class="right-arrow"></span></a>
                    <ul>
                        <li><a href="#">Name</a></li>
                        <li><a href="#">Price</a></li>
                        <li><a href="#">Position</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <div id="limiter">
            <label>View: </label>
            <ul>
                <li><a href="#">15<span class="right-arrow"></span></a>
                    <ul>
                        <li><a href="#">20</a></li>
                        <li><a href="#">30</a></li>
                        <li><a href="#">35</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div> -->


    <div class="category-products">


        <ul class="products-grid" id="products_by_category">
        
            <?php            
            if($products > 0){
            foreach ($products as $product) {

                $productInfo = $this->SiteProduct_model->getProductById($product->Id);
                $productMainImage = $this->SiteProduct_model->getProductMainImage($product->Id);

                if (isset($productMainImage->ImageName)) {
                    $mainImageUrl = base_url() . CommonConstants::IMAGE_URL_PRODUCT . $productMainImage->ImageName;

                } else {
                    $mainImageUrl = base_url() . CommonConstants::IMAGE_URL_PRODUCT_PLC_HLDR;
                }
                $productName = CommonHelpers::getWords($productInfo->ProductName, 3);
                $productName = CommonHelpers::getCharacters($productName->FirstWords, 0, 20);

                $price = $productInfo->Price;
                $discountedPrice = $productInfo->DiscountedPrice;
                $attributeId = $productInfo->AttributeId;
                $attributeName = $productInfo->AttributeName;
                $attributeValueId = $productInfo->AttributeValueId;
                $attributeValue = $productInfo->AttributeValue;

                ?>

                <li class="item col-md-4 col-sm-4 col-xs-6">
                    <div class="item-inner">
                        <div class="item-img">
                            <div class="item-img-info">
                                <a href="<?php echo base_url('detail/' . $product->Id); ?>" class="product-image">
                                    <img src="<?php echo $mainImageUrl; ?>">
                                </a>

                                <div class="item-info">
                                    <div class="info-inner">
                                        <div class="item-title"><a href="#"><?php echo $productName; ?></a>
                                        </div>
                                        
                                       
                                        <div class="item-content">
                                            <div class="item-price">
                                                <div class="price-box">
                                                    <?php

                                                    if ($discountedPrice == 0) {
                                                        ?>

                                                        <span class="discount-price">
                                                                <span class="price" style="font-size: 25px;">
                                                                <i class="fa fa-inr"></i><?php echo $price; ?>
                                                                </span>
                                                                </span>
                                                    <?php
                                                    } else {
                                                        ?>
                                                        <span class="regular-price">
                                                            <span class="price" style="font-size: 18px;">
                                                                <strike>
                                                                    <i class="fa fa-inr"></i><?php echo $price; ?>
                                                                </strike>
                                                            </span>
                                                        </span>
                                                        <span class="discount-price">
                                                            <span class="price" style="font-size: 25px;">
                                                                <i class="fa fa-inr"></i><?php echo $discountedPrice; ?>
                                                            </span>
                                                        </span>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                           

                        </div>

                    </div>

                </li>


            <?php
            }
            }else{?>

                <li style="text-align: center;
    font-size: 22px;">No Products Found</li>
            <?php }
            ?>


        </ul>


    </div>


    <div class="pager">
        <div class="pages">
            <ul class="pagination">
              <!-- <li><a href="#" class="btn btn-block disabled pagination" id="pagination_prev" data-offset="0">« Prev</a></li>
              <li><a href="#" class="btn btn-block pagination" id="pagination_next" data-offset="10">Next »</a></li> -->
                <!-- <li><a href="#">«</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">»</a></li> -->
            </ul>
        </div>
    </div>


    </article>
<?php
}

?>

</div>

</div>


<?php //$this->load->view('site/test/products/filter'); ?>


</div>

<!-- Pagination -->
<!--<div class="pagination-sec">
 <div class="row">
  <div class="col-sm-12">
  <div class="pagination-sec-in">
   <div class="pagination-in">
    <label>Page</label>
    <ul>
    <li class="next-icon">
    <a href="#"><span> < </span></a>
    </li>
    <li>
    <a href="#">1</a>
    </li>
     <li>
    <a href="#">2</a>
    </li>
     <li>
    <a href="#">3</a>
    </li>
    <li class="next-icon">
    <a href="#"><span> > </span></a>
    </li>
    </ul>
    
   </div>
   <div class="show-by">
    <label>Show By</label>
    <select>
     <option value="12">12</option>
      <option value="24">24</option>
       <option value="36">36</option>
        <option value="48">48</option>
         <option value="60">60</option>
          <option value="80">80</option>
           <option value="100">100</option>
    </select>
   </div>
   <div class="view-as">
    <label>View as</label>
   </div>-->
   </div>
  </div>
 </div>
</div>
</div>
</section>
