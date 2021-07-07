<?php
$categories = callModelFunction('AdminCategory_model', 'getCategories');
$subCategories = callModelFunction('AdminCategory_model', 'getSubCategory');
$attributes = callModelFunction('AdminProduct_model', 'getAttributes');
$attrValues = callModelFunction('AdminProduct_model', 'attributeValuesBySubCategoryAndAttribute', [$product->AttributeId,$product->SubCategoryId]);
?>

<form class="form-horizontal" id="product_edit_form">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="addCityModalLabel">Add Product</h4>
        </div>
        <div class="modal-body modal-tab-form">
            <div class="row">
                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab" id="addGenInfo">General Information</a></li>

                        </ul>
                        <div class="tab-content">
                            <div id="addFromError"></div>
                            <div class="tab-pane active" id="tab_1">
                                <div class="col-lg-12">
                                    <div class="box-body">

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Category</label>

                                            <div class="col-sm-8">
                                                <input type="hidden" name="productId" value="<?php echo $this->uri->segment(2); ?>">
                                                <select class="form-control validateEdit" id="addCategoryId" name="category" required>
                                                    <?php
                                                    foreach ($categories as $category) {
                                                        ?>
                                                        <option
                                                            value="<?php echo $category->Id; ?>"
                                                            <?php
                                                              if($category->Id == $product->CategoryId){
                                                                echo "selected";
                                                              }
                                                             ?>>
                                                            <?php echo $category->CategoryName; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>

                                                <span id="categoryError" style="color: red;"></span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Sub-Category</label>

                                            <div class="col-sm-8">
                                                <select class="form-control" id="addSubcatId" name="subcategory" required>
                                                  <option value="  <?php
                                                      echo $product->SubCategoryId;
                                                     ?>">
                                                    <?php
                                                      echo $product->SubCategoryName;
                                                     ?>
                                                  </option>
                                                </select>

                                                <span id="subCategoryError" style="color: red;"></span>
                                            </div>
                                        </div>

                                        <!-- <div class="form-group">
                                            <label class="col-sm-4 control-label">Product Attribute</label>

                                            <div class="col-sm-8">
                                                <select class="form-control" id="productAttr" name="productAttr" required>
                                                  <?php if($attributes): ?>
                                                  <?php foreach($attributes as $attribute): ?>
                                                      <option value="<?php echo $attribute->Id; ?>">
                                                        <?php echo $attribute->AttributeName; ?></option>
                                                  <?php endforeach; ?>
                                                <?php endif; ?>

                                                </select>
                                                <span id="attributeError" style="color: red;"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Attribute Value </label>

                                            <div class="col-sm-8">
                                                <select class="form-control" id="productAttributeValue" name="productAttrValue" required>
                                                        <?php foreach($attrValues as $attrValue): ?>
                                                    <option value="<?php echo $attrValue->Id; ?>"
                                                      <?php
                                                        if($attrValue->Id == $product->AttributeValueId){
                                                          echo "selected";
                                                        }
                                                       ?>
                                                      >
                                                      <?php echo $attrValue->AttributeValue; ?>
                                                    </option>
                                                  <?php endforeach; ?>
                                                </select>
                                                <span id="attrValError" style="color: red;"></span>
                                            </div>
                                        </div> -->


                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">ProductName</label>

                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="productName"
                                                       name="productName"
                                                       maxlength="100"
                                                       placeholder="Product"
                                                       value="<?php echo $product->ProductName; ?>"
                                                       required>
                                                <span id="productNameError" style="color: red;"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Price</label>

                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="price"
                                                       name="price"
                                                       maxlength="100"
                                                       placeholder="Price"
                                                       value="<?php echo $product->Price; ?>"
                                                       required>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Discount Price</label>

                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="dis_price"
                                                       name="dis_price"
                                                       maxlength="100"
                                                       placeholder="Discount Price"
                                                       value="<?php echo $product->DiscountedPrice; ?>"
                                                       required>

                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Quantity</label>

                                            <div class="col-sm-8">
                                              <input type="hidden" class="form-control" name="notifyQuantity" value="<?php echo $product->Quantity; ?>">
                                                <input type="text" class="form-control" id="quantity"
                                                       name="quantity"
                                                       maxlength="100"
                                                       placeholder="Quantity"

                                                       value="<?php echo $product->Quantity; ?>" required>
                                                <span id="quantityError" style="color: red;"></span>
                                            </div>
                                        </div>

                                        <!-- <div class="form-group">
                                            <label class="col-sm-4 control-label">Price</label>

                                            <div class="col-sm-8">
                                                <input type="text" class="form-control validateEdit" id="price"
                                                       name="price"
                                                       maxlength="6"
                                                       placeholder="Price"
                                                       value="<?php echo $product->Price; ?>" required>
                                                <span id="priceError" style="color: red;"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Discount Price</label>

                                            <div class="col-sm-8">
                                                <input type="text" class="form-control validateEdit" id="discountPrice"
                                                       name="discountPrice"
                                                       maxlength="6"
                                                       placeholder="Discount Price"
                                                       value="<?php echo $product->DiscountedPrice; ?>" required>
                                                <span id="dpError" style="color: red;"></span>
                                            </div>
                                        </div> -->


                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Description</label>

                                            <div class="col-sm-8">
                                                <textarea class="form-control" id="description"
                                                          name="description"
                                                          placeholder="Description"
                                                            required><?php echo trim($product->Description); ?></textarea>
                                                <span id="descriptionError" style="color: red;"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Details</label>

                                            <div class="col-sm-8">
                                                <textarea class="form-control" id="detail"
                                                          name="detail"
                                                          placeholder="Detail"><?php echo trim($product->Detail); ?></textarea>
                                                <span id="addDetError" style="color: red;"></span>
                                            </div>
                                        </div>


                                        <!-- <div class="form-group">
                                            <label class="col-sm-4 control-label">Show Attribute to User</label>
                                            <div class="col-sm-8">
                                                <input type="radio" name="showToUser" value="1"
                                                <?php echo $product->ShowToUser == 1 ? 'checked' : '' ?>> Yes &nbsp;   <input type="radio" name="showToUser" value="0" <?php echo $product->ShowToUser == 0 ? 'checked' : '' ?>> No
                                            </div>
                                        </div> -->

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Is Featured</label>
                                            <div class="col-sm-8">
                                                <input type="checkbox"    name="isFeatured" value="1" <?php echo $product->IsFeatured == 1 ? 'checked' : '' ?>>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Is Life Style</label>
                                            <div class="col-sm-8">
                                                <input type="checkbox"    name="isLifeStyle" value="1" <?php echo $product->IsLifeStyle == 1 ? 'checked' : '' ?>>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button class="btn btn-medium btn-primary" type="submit" id="UpdateProduct">Update</button>
            <?php //echo md5("111111"); ?>
        </div>
    </div>
</form>
