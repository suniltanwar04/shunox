<?php
$products = callModelFunction('AdminProduct_model', 'getProduct');
$attributevalues = callModelFunction('AdminAttribute_model', 'getAttributeValues');
?>


<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel"
     style="padding-top: 20px;" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog " role="document" style="width: 55%">
        <form class="form-horizontal" id="AttributeAddForm" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addAttributeModalLabel">Add Attribute Mapping</h4>
                </div>
                <div class="modal-body modal-tab-form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab" id="addGenInfo">General
                                            Information</a></li>

                                </ul>
                                <div class="tab-content">
                                    <div id="addFromError"></div>
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="col-lg-12">
                                            <div class="box-body">

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Product</label>

                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="addProductId"
                                                                name="addProductId">
                                                            <option value="" selected="selected">Select Product</option>
                                                            <?php
                                                            foreach ($products as $product) {
                                                                ?>
                                                                <option
                                                                    value="<?php echo $product->Id; ?>"><?php echo $product->ProductName; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>

                                                        <span id="addaddProductIdError" style="color: red;"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Attribute Value</label>

                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="addAttributevalueid"
                                                                name="addAttributevalueid">
                                                            <option value="" selected="selected">Select Attribute Value</option>
                                                            <?php
                                                            foreach ($attributevalues as $attributevalue) {
                                                                ?>
                                                                <option
                                                                    value="<?php echo $attributevalue->Id; ?>"><?php echo $attributevalue->AttributeValue; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>

                                                        <span id="addaddAttributevalueidError" style="color: red;"></span>
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
                    <a class="btn btn-medium btn-primary" id="saveAttributeMapping">Save</a>
                </div>
            </div>
        </form>
    </div>
</div>
