<?php
$categories = callModelFunction('AdminCategory_model', 'getCategories');
$subCategories = callModelFunction('AdminCategory_model', 'getSubCategory');
?>

<div class="modal fade" id="addCityModal" tabindex="-1" role="dialog" aria-labelledby="addCityModalLabel"
     style="padding-top: 20px;" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog " role="document" style="width: 55%">

        <form class="form-horizontal" id="productAddForm" enctype="multipart/form-data">
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
                                                        <select class="form-control" id="addCategoryId"
                                                                name="addCategoryId">
                                                            <option value="" selected="selected" disabled="disabled">
                                                                Select Category
                                                            </option>
                                                            <?php
                                                            foreach ($categories as $category) {
                                                                ?>
                                                                <option
                                                                    value="<?php echo $category->Id; ?>"><?php echo $category->CategoryName; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>

                                                        <span id="addCategoryIdError" style="color: red;"></span>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Sub-Category</label>

                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="addSubcatId"
                                                                name="addSubcatId">
                                                            <option value="" selected="selected" disabled="disabled">
                                                                Select Sub-Category
                                                            </option>

                                                        </select>

                                                        <span id="addSubCatIdError" style="color: red;"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Product Attribute</label>

                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="AddProductAttr"
                                                                name="AddProductAttr">

                                                        </select>
                                                        <span id="AddProductAttrError" style="color: red;"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group" style="display:none" id="AttributeValueSection">
                                                    <label class="col-sm-4 control-label">Attribute Value </label>

                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="AddProductAttrValue"
                                                                name="AddProductAttrValue">
                                                            <option value="">Select Attribute Value</option>
                                                        </select>
                                                        <span id="AddProductAttrValueError" style="color: red;"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group" >
                                                    <label class="col-sm-4 control-label">Gender</label>

                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="addGender"
                                                                name="addGender">
                                                            <option value="">Select Gender</option>
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                        <span id="AddGenderError" style="color: red;"></span>
                                                    </div>
                                                </div>



                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">ProductName</label>

                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="addProductName"
                                                               name="addProductName"
                                                               maxlength="100"
                                                               placeholder="Product">
                                                        <span id="addProductNameError" style="color: red;"></span>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Quantity</label>

                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="addQuantity"
                                                               name="addQuantity"
                                                               maxlength="100"
                                                               placeholder="Quantity">
                                                        <span id="addProductQuantityError" style="color: red;"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Price</label>

                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="addPrice"
                                                               name="addPrice"
                                                               maxlength="6"
                                                               placeholder="Price">
                                                        <span id="addPriceError" style="color: red;"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Discount Price</label>

                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="discountPrice"
                                                               name="discountPrice"
                                                               maxlength="6"
                                                               placeholder="Discount Price">
                                                        <span id="discountPriceError" style="color: red;"></span>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Description</label>

                                                    <div class="col-sm-8">
                                                        <textarea class="form-control" id="addDesc"
                                                                  name="addDesc"
                                                                  placeholder="Description"></textarea>
                                                        <span id="addDescError" style="color: red;"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Details</label>

                                                    <div class="col-sm-8">
                                                        <textarea class="form-control" id="addDet"
                                                                  name="addDet"
                                                                  placeholder="Detail"></textarea>
                                                        <span id="addDetError" style="color: red;"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Image</label>

                                                    <div class="col-sm-8">
                                                        <input type="file" class="form-control" id="addimage"
                                                               name="addimage[]"
                                                               maxlength="100">
                                                        <span id="addimageError" style="color: red;"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">ThumbImage1</label>

                                                    <div class="col-sm-8">
                                                        <input type="file" class="form-control" id="addThumbImage1"
                                                               name="addimage[]"
                                                               maxlength="100">
                                                        <span id="addThumbImage1Error" style="color: red;"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">ThumbImage2</label>

                                                    <div class="col-sm-8">
                                                        <input type="file" class="form-control" id="addThumbImage2"
                                                               name="addimage[]"
                                                               maxlength="100">
                                                        <span id="addThumbImage2Error" style="color: red;"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">ThumbImage3</label>

                                                    <div class="col-sm-8">
                                                        <input type="file" class="form-control" id="addThumbImage3"
                                                               name="addimage[]"
                                                               maxlength="100">
                                                        <span id="addThumbImage3Error" style="color: red;"></span>
                                                    </div>
                                                </div>






                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Show Attribute to User</label>
                                                    <div class="col-sm-8">
                                                        <input type="radio"    name="showToUser" value="1"> Yes &nbsp;   <input type="radio" name="showToUser" value="0" checked> No
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Is Featured</label>
                                                    <div class="col-sm-8">
                                                        <input type="checkbox"    name="isFeatured" value="1">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Is Life Style</label>
                                                    <div class="col-sm-8">
                                                        <input type="checkbox"    name="isLifeStyle" value="1">
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
                    <a class="btn btn-medium btn-primary" id="saveProduct">Save</a>
                </div>
            </div>
        </form>
    </div>
</div>
