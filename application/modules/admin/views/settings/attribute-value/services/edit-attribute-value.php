<?php
$subcategories = callModelFunction('AdminCategory_model', 'getSubCategory');
$attributes = callModelFunction('AdminAttribute_model', 'getAttributes');

?>




<div class="modal-dialog " role="document" style="width: 55%">
    <form class="form-horizontal" id="stateEditForm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editStateModalLabel">Edit Attribute Value</h4>
            </div>

            <div class="modal-body modal-tab-form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab" id="editGenInfo">General Information</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="editFromError"></div>
                                <div class="tab-pane active" id="tab_1">
                                    <div class="col-lg-12">
                                        <div class="box-body" id="formBody">

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Sub Category</label>

                                                <div class="col-sm-8">
                                                    <select class="form-control" id="editSubCatId"
                                                            name="editSubCatId">
                                                        <option value="" selected="selected">Select sub category</option>
                                                        <?php

                                                        foreach ($subcategories as $subcategory) {
                                                            $parameter['ForeignKeyId'] = $subcategory->CategoryId;
                                                            $parameter['MasterKeyId'] = $subcategory->Id;
                                                            $isSelected = CommonHelpers::getSelectedOption((object)$parameter);

                                                            ?>
                                                            <option
                                                                value="<?php echo $subcategory->Id; ?>" <?php echo $isSelected;?>><?php echo $subcategory->SubCategoryName; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>

                                                    <span id="editSubCatIdError" style="color: red;"></span>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Attribute</label>

                                                <div class="col-sm-8">
                                                    <select class="form-control" id="editAttriuteId"
                                                            name="editAttriuteId">
                                                        <option value="" selected="selected">Select Attribute</option>
                                                        <?php

                                                        foreach ($attributes as $attribute) {
                                                            $parameter['ForeignKeyId'] = $attribute->AttributeName;
                                                            $parameter['MasterKeyId'] = $attribute->Id;
                                                            $isSelected = CommonHelpers::getSelectedOption((object)$parameter);

                                                            ?>
                                                            <option

                                                                value="<?php echo  $attribute->Id ?>" <?php if($attribute->Id == $attributeValue->AttributeId){echo "Selected";} ?>><?php echo $attribute->AttributeName; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>

                                                    <span id="editAttributeIdError" style="color: red;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Attribute Value</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="editAttributValue"
                                                           name="editAttributValue"
                                                           maxlength="50"
                                                           value="<?php echo $attributeValue->AttributeValue; ?>">
                                                    <input type="hidden" class="form-control" id="editRecordId"
                                                           name="editRecordId"
                                                           value="<?php echo $attributeValue->Id; ?>">
                                                    <span id="editAttributeValueError" style="color: red;"></span>
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
                <a class="btn btn-medium btn-primary" id="updateAttributeValue">Update</a>
            </div>
        </div>
    </form>
</div>

