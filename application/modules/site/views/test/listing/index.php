<div class="container-fluid">
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">

<section class="section featured-product wow fadeInUp" style="margin-top:20px;">
    <div class=" home-owl-carousel">
        <?php
        $countdiv = 0;
       // for($i=0;$i<count($product);$i++) {  $countdiv++;
       //print_r($product);die;
        foreach($product as $countdiv=>$prod)
       
        {$countdiv++;
        $productMainImage = $this->Site_model->getProductMainImage($prod->Id);
            ?>
        <div class="item item-carousel">
            <div class="products">
                <div class="product">
                    <div class="product-image">
                        <div class="image">
                            <a href="<?php echo base_url('detail/' . $prod->Id); ?>">
                                <img src="<?php echo base_url(); ?>assets/site/images/blank.gif"
                                     data-echo="<?php echo base_url(); ?>assets/site/images/product/<?php echo $productMainImage->ImageName; ?>"
                                                            alt=""></a></div>
                    </div>
                    <div class="product-info text-center">
                        <h5><?php echo $prod->ProductName;?></h5>

                        <div class="rating rateit-small"></div>
                        <div class="description"></div>
                        <div class="product-price"><span class="price"> <?php echo $prod->DiscountedPrice;?></span> <span
                                class="price-before-discount"><?php echo $prod->ActualPrice;?></span></div>
                    </div>

                </div>

            </div>
        </div>

            <?php
            if ($countdiv%4==0)
                echo '</div><div class=" home-owl-carousel">';
        } ?>

    </div>

</section>


</div>
</div>
</div>