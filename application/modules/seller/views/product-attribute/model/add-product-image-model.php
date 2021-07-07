<?php $product_id = $this->uri->segment(3); ?>

<div class="modal fade" id="addImageModal" tabindex="-2" role="dialog" aria-labelledby="addCityImageLabel"
     style="padding-top: 20px;" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog " role="document" style="width: 55%">

        <form class="form-horizontal" id="productImageAddForm" enctype="multipart/form-data">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addCityImageLabel">Add Product Image</h4>
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

                                                <div class="form-group" id='SelectAttrValSection'>
                                                    <label class="col-sm-4 control-label">Color:</label>

                                                    <div class="col-sm-8" >
														<select class="form-control" id="SelectAttrVal" name="SelectAttrVal">
															<option value="26">Black</option>
															<option value="27">Brown</option>
														</select>
                                                    </div>

                                                </div>

                                                <div class="form-group">

                                                    <label class="col-sm-4 control-label">Select Images:</label>

                                                    <div class="col-sm-8">
                                                        <input type="file" name="attrImages[]" id="attrImage" multiple="">
                                                    </div>
                                                </div>

                                                <h3 class="text-center" id="ImageInsertionResult"></h3>
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
					<input type='hidden' name='SubCategoryId' value='' id="SubCategoryId">
					<input type='hidden' name='productId' value='<?php echo $product_id; ?>'>
                    <a class="btn btn-medium btn-primary" id="saveImageAttr">Save</a>
                </div>
            </div>
        </form>
    </div>
</div>
