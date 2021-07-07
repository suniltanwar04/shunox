<?php
$subcategories = callModelFunction('AdminCategory_model', 'getSubCategory');
$attributes = callModelFunction('AdminAttribute_model', 'getAttributes');
?>


<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel"
     style="padding-top: 20px;" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog " role="document" style="width: 55%">
        <form class="form-horizontal" id="AttributeAddForm" >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addAttributeModalLabel">Add Attribute</h4>
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
                                                    <label class="col-sm-4 control-label">Sub Category</label>

                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="addSubCatId"
                                                                name="addSubCatId">
                                                            <option value="" selected="selected">Select Sub Category</option>
                                                            <?php
                                                            foreach ($subcategories as $subcategory) {
                                                                ?>
                                                                <option
                                                                    value="<?php echo $subcategory->Id; ?>"><?php echo $subcategory->SubCategoryName; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>

                                                        <span id="addSubCatIdError" style="color: red;"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Attribute</label>

                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="addAttributeid"
                                                                name="addAttributeid">
                                                            <option value="" selected="selected">Select Attribute</option>
                                                            <?php
                                                            foreach ($attributes as $attribute) {
                                                                ?>
                                                                <option
                                                                    value="<?php echo $attribute->Id; ?>"><?php echo $attribute->AttributeName; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>

                                                        <span id="addAttributeIdError" style="color: red;"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Attribute Value</label>

                                                    <div class="col-sm-8" id="addattributeValueInputDiv">
                                                        <input type="text" class="form-control" id="addAttributeValue"
                                                               name="addAttributeValue"
                                                               maxlength="50"
                                                               placeholder="Attribute Value">
                                                        <span id="addattributeValueError" style="color: red;"></span>












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
                    <a class="btn btn-medium btn-primary" id="saveAttributeValue">Save</a>
                </div>
            </div>
        </form>
    </div>
</div>
