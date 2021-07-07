<?php $product_id = $this->uri->segment(3); ?>

<div class="modal fade" id="addCityModal" tabindex="-1" role="dialog" aria-labelledby="addCityModalLabel"
     style="padding-top: 20px;" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog " role="document" style="width: 55%">

        <form class="form-horizontal" id="productAttrAddForm" enctype="multipart/form-data">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addCityModalLabel">Add Product Attribute</h4>
                </div>
                <div class="modal-body modal-tab-form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav-tabs-custom">

                                <div class="tab-content">
                                    <div id="addFromError"></div>
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="col-lg-12">
                                            <div class="box-body">

                                                <div class="form-group">

                                                    <label class="col-sm-4 control-label">Attribute:</label>

                                                    <div class="col-sm-8">
                                                        <input type='hidden' name='SubCategoryId'
                                                         value='' id="SubCategoryId">
                                                        <input type='hidden' name='productId'
                                                        value='<?php echo $product_id; ?>'>
                                                        <select class="form-control" id="ProductsAttr"
                                                        name="ProductsAttr">
                                                            <option value="" selected="selected">
                                                                Select Attribute
                                                            </option>
                                                           <?php foreach($attributes as $attribute): ?>
                                                               <option value="<?php echo $attribute->Id; ?>">
                                                                   <?php echo $attribute->AttributeName; ?>
                                                               </option>
                                                           <?php endforeach; ?>
                                                        </select>


                                                        <span id="ProductsAttrError" style="color: red;"></span>
                                                    </div>

                                                </div>

                                                <div class="form-group" id='SelectAttrValSection' style="display:none;">
                                                    <label class="col-sm-4 control-label">value:</label>

                                                    <div class="col-sm-8" >
                                                        <select class="form-control" id="SelectAttrVal"
                                                          name="SelectAttrVal">
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="form-group">

                                                    <label class="col-sm-4 control-label">Enter Price:</label>

                                                    <div class="col-sm-8">

                                                        <input class="form-control" type='text' id='ProductPrice' name='ProductPrice' />
                                                        <span id="ProductPriceError" style="color: red;"></span>
                                                    </div>
                                                </div>



                                                <div class="form-group">

                                                    <label class="col-sm-4 control-label">Enter Discounted Price:</label>

                                                    <div class="col-sm-8">
                                                        <input class="form-control" type='text' id='discountPrice' name='discountPrice' />
                                                    </div>
                                                      <span id="discountPriceError" style="color: red;"></span>
                                                </div>
                                                <h3 class="text-center" id="AttributeInsertionResult"></h3>
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
                    <a class="btn btn-medium btn-primary" id="saveProductAttr">Save</a>
                </div>
            </div>
        </form>
    </div>
</div>
