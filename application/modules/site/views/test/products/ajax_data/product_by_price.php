<ul class="products-grid" id="products_by_category">

    <?php
if($products > 0) {
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

        <li class="item col-md-3 col-sm-4 col-xs-6">
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