<div class="clearfix"></div>
<!--<div class="top-bar animate-dropdown" style="margin-top: 15px;">
    <div class="container">
        <div class="header-top-inner">
            <div class="cnt-account" style="color: white;font-size: 18px;text-transform: uppercase;text-align: center; float:none;">
                    Customized&nbsp;&nbsp;shoe&nbsp;&nbsp;  gives&nbsp;&nbsp;  unmatched&nbsp;&nbsp;  comfort&nbsp;&nbsp;  to&nbsp;&nbsp;  your&nbsp;&nbsp;  foot
            </div> 
        </div>
    </div>
</div> -->
<div class="container">
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">

<div class="clearfix"></div>

<!-- ============================================== FEATURED PRODUCTS ============================================== -->
<div class="col-md-12 text-center headi">
    <h3 class="section-title"></h3>
    <!-- <img src="<?php //echo base_url(); ?>assets/site/images/line.png" style="margin-top:-12px;"> -->

    <p style="font-size:20px;">Shunox brings a new dimension of unmatched comfort in Footwear by first Scanning your foot-Base & after analysing it’s structure, make a shoe exclusively to suit your foot.  After all , it’s the foot comfort that matters above everything .<br>
        <br>
    </p>
</div>
<div class="clearfix"></div>
<section class="section featured-product wow fadeInUp">
<div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
 <?php 
 $countdiv = 0;
 //print_r($featured);
  foreach($featured as $feature)
        {$countdiv++;
        $productMainImage = $this->Site_model->getProductMainImage($feature->Id);
        $productInfo = $this->SiteProduct_model->getProductById($feature->Id);
       
            ?>
<div class="item item-carousel">
    <div class="products">
        <div class="product">
            <div class="product-image">
                <div class="image" id="image-change<?php echo $countdiv;?>">
					<!-- <a href="<?php //echo base_url(); ?>uploads/products/<?php //echo $productMainImage->bigImage;//echo base_url('detail/' . $feature->Id);?>" class="zoom<?php //echo $countdiv;?>"> -->
					<a href="<?php echo base_url('detail/' . $feature->Id); ?>">
						<img src="<?php echo base_url(); ?>assets/site/images/blank.gif" data-echo="<?php echo base_url(); ?>uploads/products/<?php echo $productMainImage->ImageName; ?>" alt="">
					</a>
					<!-- </a> -->
				</div>
                <!-- /.image -->
            </div>
			
            <div class="product-info text-center">
                <!-- <h2><a href="<?php echo base_url('detail/' . $feature->Id); ?>">Black Shoes</a></h2> -->

                <h3 class="name"><a href="<?php echo base_url('detail/' . $feature->Id); ?>"><?php echo $feature->ProductName;?></a></h3>

                <!-- <div class="rating rateit-small"></div> -->
                <div class="description"></div>
                <div class="product-price"><span class="price"><i class="fa fa-inr"></i><?php echo $feature->DiscountedPrice;?></span> <span class="price-before-discount"><i class="fa fa-inr"></i><?php echo $feature->ActualPrice;?></span>
                </div>

            </div>
            <div class="cart clearfix animate-effect">
                <div class="action">
                    <ul class="list-unstyled">

                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
        <?php }?>
</div>
</section>

</div>

</div>

<?php if(count($blogs) > 0){ ?>
	<section>
		<div class="blog_section">
			<?php foreach($blogs as $blog){?>
			<div class="col-md-4">
			   <a href="<?php echo base_url()?>blog-detail/<?php echo $blog->id?>"> <div class="blog_holder"><img class="img-responsive"
											  src="<?php echo base_url(); ?>uploads/blog/<?php echo $blog->image?>">

					<div class="blog_holder_con"> <?php echo $blog->title?></div>
				</div>
				</a>
			</div>
			<?php }?>
		</div>
	</section>
<?php } ?>
</div>
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
        top:60em !important;
		right: 4em;
        /*left:550px;*/
        overflow:hidden;
        -moz-box-shadow:0 0 10px #777;
        -webkit-box-shadow:0 0 10px #777;
        box-shadow:0 0 10px #777;
        /* vertical and horizontal alignment used for preloader text */
        line-height:400px;
        text-align:center;
    }

</style>

