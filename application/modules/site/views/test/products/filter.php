<aside class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9 wow  animated animated"
       style="visibility: visible;">

<?php
    $categories = $this->SiteCategory_model->getCategoriesForFilter();
?>

<?php
if ($categories) {
    ?>

    <div class="side-nav-categories">
        <div class="block-title"> Categories</div>

        <div class="box-content box-category">
            <ul>


                <?php
                if ($categories) {
                    $i = 1;
                   
                    foreach ($categories as $category) {
                    
                        $categoryInfo = $this->SiteCategory_model->getCategoryById($category->Id);
                       
                        if ($i == 1) {
                            $activeClass = 'active';
                            $signClass = 'minus';
                            $displayClass = 'block';
                        } else {
                            $activeClass = '';
                            $signClass = 'plus';
                            $displayClass = 'none';
                        }
                        if ($i <= 5) {
                            ?>

                            <li class="<?php echo $activeClass; ?>"><a
                                    href="<?php echo base_url('category/' . $categoryInfo->UrlSlug); ?>"><?php echo $categoryInfo->CategoryName; ?></a> 

                                <?php
                                $subCategories = $this->SiteCategory_model->getSubCategoryByCategory($category->Id);
                                if ($subCategories) {
                                    ?>
                                    <ul class="level0_415" style="display:<?php echo $displayClass; ?>">

                                        <?php
                                        foreach ($subCategories as $subCategory) {
                                            $subCategoryInfo = $this->SiteCategory_model->getSubCategoryById($subCategory->Id);
                                            ?>
                                            <li><a href="<?php echo base_url('sub-category/' . $subCategoryInfo->UrlSlug); ?>"> <?php echo $subCategoryInfo->SubCategoryName ?> </a></li>
                                        <?php
                                        }
                                        ?>


                                    </ul>

                                <?php
                                }
                                ?>


                            </li>


                        <?php
                        }
                        $i++;
                    }
                }
                ?>


            </ul>
        </div>

    </div>

<?php
}
?>





<?php
if ($products) {
    ?>
    <div class="block block-list block-cart">
        <div class="block-title"> Related Product</div>
        <div class="block-content">
            <p class="block-subtitle">Recently added item(s)</p>
            <ul id="cart-sidebar" class="mini-products-list">
                <?php

                $i = 1;
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


                    if ($i % 2 == 0) {
                        $lastClass = '';
                    } else {
                        $lastClass = 'last1';
                    }
                    if ($i <= 2) {
                        ?>

                        <li class="item">
                            <div class="item-inner">
                                <a href="<?php echo base_url('product-detail/' . $product->Id); ?>"
                                   class="product-image"><img
                                        src="<?php echo $mainImageUrl; ?>"
                                        alt="product"
                                        width="80"></a>

                                <div class="product-details">
                                    <p class="product-name"><a href="<?php echo base_url('product-detail/' . $productInfo->Id); ?>"><?php echo $productName; ?></a></p>
                                         <span class="price"><i class="fa fa-inr"></i>
                                             <?php

                                             if ($discountedPrice == 0) {
                                                 echo $price;
                                             } else {
                                                 echo $discountedPrice;
                                             }
                                             ?>

                                        </span>
                                </div>
                                <!--product-details-bottoms-->
                            </div>
                        </li>


                    <?php
                    }
                    $i++;
                }
                ?>
            </ul>
        </div>
    </div>
<?php
}
?>
</aside>
