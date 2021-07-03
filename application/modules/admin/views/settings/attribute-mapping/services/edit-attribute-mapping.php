<?php
$products = callModelFunction('AdminProduct_model', 'getProduct');
$attributeValues = callModelFunction('AdminAttribute_model', 'getAttributeValues');

?>



<div class="modal-dialog " role="document" style="width: 55%">
    <form class="form-horizontal" id="stateEditForm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editStateModalLabel">Edit Attribute Mapping</h4>
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
                                                <label class="col-sm-4 control-label">product</label>

                                                <div class="col-sm-8">
                                                    <select class="form-control" id="editProductId"
                                                            name="editProductId">
                                                        <option value="" selected="selected">Select product</option>
                                                        <?php

                                                        foreach ($products as $product) {
                                                            $parameter['ForeignKeyId'] = $product->ProductName;
                                                            $parameter['MasterKeyId'] = $product->Id;
                                                            $isSelected = CommonHelpers::getSelectedOption((object)$parameter);

                                                            ?>
                                                            <option
                                                                value="<?php echo $product->Id; ?>" <?php if($product->Id == $attributeMapping->ProductId){echo "Selected";} ?>><?php echo $product->ProductName; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>

                                                    <span id="editProductIdError" style="color: red;"></span>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Attribute</label>

                                                <div class="col-sm-8">
                                                    <select class="form-control" id="editAttributeMappingId"
                                                            name="editAttributeMappingId">
                                                        <option value="" selected="selected">Select Attribute</option>
                                                        <?php

                                                        foreach ($attributeValues as $attributeValue) {
                                                            $parameter['ForeignKeyId'] = $attributeValue->AttributeValue;
                                                            $parameter['MasterKeyId'] = $attributeValue->Id;
                                                            $isSelected = CommonHelpers::getSelectedOption((object)$parameter);

                                                            ?>
                                                            <option

                                                                value="<?php echo $attributeValue->Id ?>" <?php if($attributeValue->Id == $attributeMapping->AttributeId){echo "Selected";} ?>><?php echo $attributeValue->AttributeValue; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <input type="hidden" class="form-control" id="editRecordId"
                                                           name="editRecordId"
                                                           value="<?php echo $attributeMapping->Id; ?>">

                                                    <span id="editAttributeMappingIdError" style="color: red;"></span>
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
                <a class="btn btn-medium btn-primary" id="updateAttributeMapping">Update</a>
            </div>
        </div>
    </form>
</div>

