<?php
$categories = callModelFunction('AdminCategory_model', 'getCategories');
$subCategories = callModelFunction('AdminCategory_model', 'getSubCategory');
?>
<div class="modal-dialog " role="document" style="width: 55%">
    <form class="form-horizontal" id="producteditForm" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editCityModalLabel">Edit Product</h4>
            </div>
            <div class="modal-body modal-tab-form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab" id="editGenInfo">General
                                        Information</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="editFromError"></div>
                                <div class="tab-pane active" id="tab_1">
                                    <div class="col-lg-12">
                                        <div class="box-body" id="formBody">

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Category</label>

                                                <div class="col-sm-8">
                                                    <select class="form-control" id="editCategoryId"
                                                            name="editCategoryId">
                                                        <option value="" selected="selected" disabled="disabled">
                                                            Select Category
                                                        </option>
                                                        <?php
                                                        //                                                        echo '<pre>';
                                                        //                                                        print_r($city);
                                                        //                                                        echo '</pre>';
                                                        //                                                        die;
                                                        foreach ($categories as $category) {
                                                            $parameter['ForeignKeyId'] = $products->CategoryId;
                                                            $parameter['MasterKeyId'] = $category->Id;


                                                            $isSelected = CommonHelpers::getSelectedOption((object)$parameter);
                                                            ?>
                                                            <option
                                                                value="<?php echo $category->Id; ?>" <?php echo $isSelected; ?>><?php echo $category->CategoryName; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>

                                                    <span id="editCategoryIdError" style="color: red;"></span>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Sub-Category</label>

                                                <div class="col-sm-8">
                                                    <select class="form-control" id="editSubCatId"
                                                            name="editSubCatId">
                                                        <option value="" disabled="disabled">
                                                            Select Sub-Category
                                                            <?php
                                                            foreach ($subCategories as $subCategory){
                                                            $parameter['ForeignKeyId'] = $products->SubCategoryId;
                                                            $parameter['MasterKeyId'] = $subCategory->Id;


                                                            $isSelected = CommonHelpers::getSelectedOption((object)$parameter);
                                                            ?>
                                                        <option
                                                            value="<?php echo $subCategory->Id; ?>" <?php echo $isSelected;?>><?php echo $subCategory->SubCategoryName; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                        </option>
                                                    </select>
                                                    <span id="editStateIdError" style="color: red;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Product</label>

                                                <div class="col-sm-8">
                                                    <input type="hidden" class="form-control" id="editRecordId"
                                                           name="editRecordId"
                                                           value="<?php echo $products->Id; ?>">
                                                    <input type="text" class="form-control" id="editProductName"
                                                           name="editProductName"
                                                           maxlength="10"
                                                           value="<?php echo $products->ProductName; ?>">
                                                    <span id="editProductNameError" style="color: red;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Price</label>

                                                <div class="col-sm-8">
                                                    <input type="hidden" class="form-control" id="editRecordId"
                                                           name="editRecordId"
                                                           value="<?php echo $products->Id; ?>">
                                                    <input type="text" class="form-control" id="editPrice"
                                                           name="editPrice"
                                                           maxlength="10"
                                                           value="<?php echo $products->Price; ?>">
                                                    <span id="editPriceError" style="color: red;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Quantity</label>

                                                <div class="col-sm-8">
                                                    <input type="hidden" class="form-control" id="editRecordId"
                                                           name="editRecordId"
                                                           value="<?php echo $products->Id; ?>">
                                                    <input type="text" class="form-control" id="editQuantity"
                                                           name="editQuantity"
                                                           maxlength="10"
                                                           value="<?php echo $products->Quantity; ?>">
                                                    <span id="editQuantityError" style="color: red;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Description</label>

                                                <div class="col-sm-8">
                                                    <input type="hidden" class="form-control" id="editRecordId"
                                                           name="editRecordId"
                                                           value="<?php echo $products->Id; ?>">
                                                    <input type="text" class="form-control" id="editDesc"
                                                           name="editDesc"
                                                           maxlength="10"
                                                           value="<?php echo $products->Description; ?>">
                                                    <span id="editCityNameError" style="color: red;"></span>
                                                </div>
                                            </div>





                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Discount Type</label>

                                                <div class="col-sm-8">
                                                    <select class="form-control" id="editDiscountType"
                                                            name="editDiscountType">
                                                        <option value="" selected="selected" disabled="disabled">
                                                            Select Discount Type
                                                        </option>

                                                        <option value="0" <?php if($products->DiscountType == 0){echo "selected";}?>>None</option>
                                                        <option value="1" <?php if($products->DiscountType == 1){echo "selected";}?>>Percentage</option>
                                                        <option value="2" <?php if($products->DiscountType == 'flat'){echo "selected";}?>>Flat</option>

                                                    </select>

                                                    <span id="addCategoryIdError" style="color: red;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Discounted Price</label>

                                                <div class="col-sm-8">
                                                    <input type="hidden" class="form-control" id="editRecordId"
                                                           name="editRecordId"
                                                           value="<?php echo $products->Id; ?>">
                                                    <input type="text" class="form-control" id="editDiscountValue"
                                                           name="editDiscountValue"
                                                           maxlength="10"
                                                           value="<?php echo $products->DiscountedPrice; ?>">
                                                    <span id="editDiscountValueError" style="color: red;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Image</label>

                                                <div class="col-sm-4">
                                                    <input type="file" class="form-control" id="editThumbImage0"
                                                           name="editimage[]"
                                                           maxlength="100">
                                                    <?php if(isset($productsimg[0]->ImageName)){ ?>
                                                        <img style="height: 50px;width: 50px;" src="<?php echo base_url();?>uploads/products/<?php echo $productsimg[0]->ImageName; ?>"></img>
                                                        <input type="hidden" name="hiddenimage[]" id="hiddenimage1" value="<?php echo $productsimg[0]->ImageName; ?>"/>
                                                    <?php } ?>
                                                    <span id="addProductImageError" style="color: red;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">ThumbImage1</label>

                                                <div class="col-sm-4">
                                                    <input type="file" class="form-control" id="editThumbImage1"
                                                           name="editimage[]"
                                                           maxlength="100">
                                                    <?php if(isset($productsimg[1]->ImageName)){ ?>
                                                        <img style="height: 50px;width: 50px;" src="<?php echo base_url();?>uploads/products/<?php echo $productsimg[1]->ImageName; ?>"></img>
                                                        <input type="hidden" name="hiddenimage[]" id="hiddenimage2" value="<?php echo $productsimg[1]->ImageName; ?>"/>
                                                    <?php } ?>
                                                    <span id="addThumbImage1Error" style="color: red;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">ThumbImage2</label>

                                                <div class="col-sm-4">
                                                    <input type="file" class="form-control" id="editThumbImage2"
                                                           name="editimage[]"
                                                           maxlength="100">
                                                    <?php if(isset($productsimg[2]->ImageName)){ ?>
                                                        <img style="height: 50px;width: 50px;" src="<?php echo base_url();?>uploads/products/<?php echo $productsimg[2]->ImageName; ?>"></img>
                                                        <input type="hidden" name="hiddenimage[]" id="hiddenimage3" value="<?php echo $productsimg[2]->ImageName; ?>"/>
                                                    <?php } ?>
                                                    <span id="addThumbImage2Error" style="color: red;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">ThumbImage3</label>

                                                <div class="col-sm-4">

                                                    <input type="file" class="form-control" id="editThumbImage3"
                                                           name="editimage[]"
                                                           maxlength="100">
                                                    <?php if(isset($productsimg[3]->ImageName)){ ?>
                                                        <img style="height: 50px;width: 50px;" src="<?php echo base_url();?>uploads/products/<?php echo $productsimg[3]->ImageName; ?>"></img>
                                                        <input type="hidden" name="hiddenimage[]" id="hiddenimage4" value="<?php echo $productsimg[3]->ImageName; ?>"/>
                                                    <?php } ?>
                                                    <span id="addThumbImage3Error" style="color: red;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">ThumbImage4</label>

                                                <div class="col-sm-4">
                                                    <input type="file" class="form-control" id="editThumbImage4"
                                                           name="editimage[]"
                                                           maxlength="100">
                                                    <?php if(isset($productsimg[4]->ImageName)){ ?>
                                                        <img style="height: 50px;width: 50px;" src="<?php echo base_url();?>uploads/products/<?php echo $productsimg[4]->ImageName; ?>"></img>
                                                        <input type="hidden" name="hiddenimage[]" id="hiddenimage5" value="<?php echo $productsimg[4]->ImageName; ?>"/>
                                                    <?php } ?>
                                                    <span id="addThumbImage4Error" style="color: red;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">ThumbImage5</label>

                                                <div class="col-sm-4">
                                                    <input type="file" class="form-control" id="editThumbImage5"
                                                           name="editimage[]"
                                                           maxlength="100">
                                                    <?php if(isset($productsimg[5]->ImageName)){ ?>
                                                        <img style="height: 50px;width: 50px;" src="<?php echo base_url();?>uploads/products/<?php echo $productsimg[5]->ImageName; ?>"></img>
                                                        <input type="hidden" name="hiddenimage[]" id="hiddenimage6" value="<?php echo $productsimg[5]->ImageName; ?>"/>
                                                    <?php } ?>
                                                    <span id="addThumbImage6Error" style="color: red;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">ThumbImage6</label>

                                                <div class="col-sm-4">
                                                    <input type="file" class="form-control" id="editThumbImage6"
                                                           name="editimage[]"
                                                           maxlength="100">
                                                    <?php if(isset($productsimg[6]->ImageName)){ ?>
                                                        <img style="height: 50px;width: 50px;" src="<?php echo base_url();?>uploads/products/<?php echo $productsimg[6]->ImageName; ?>"></img>
                                                        <input type="hidden" name="hiddenimage[]" id="hiddenimage7" value="<?php echo $productsimg[6]->ImageName; ?>"/>
                                                    <?php } ?>
                                                    <span id="addThumbImage6Error" style="color: red;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">ThumbImage7</label>

                                                <div class="col-sm-4">
                                                    <input type="file" class="form-control" id="editThumbImage6"
                                                           name="editimage[]"
                                                           maxlength="100">
                                                    <?php if(isset($productsimg[7]->ImageName)){ ?>
                                                        <img style="height: 50px;width: 50px;" src="<?php echo base_url();?>uploads/products/<?php echo $productsimg[7]->ImageName; ?>"></img>
                                                        <input type="hidden" name="hiddenimage[]" id="hiddenimage8" value="<?php echo $productsimg[7]->ImageName; ?>"/>
                                                    <?php } ?>
                                                    <span id="addThumbImage6Error" style="color: red;"></span>
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
                <a class="btn btn-medium btn-primary" id="updateProduct">Update</a>
            </div>
        </div>
    </form>
</div>

