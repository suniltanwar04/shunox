<?php
$categories = callModelFunction('AdminCategory_model', 'getCategories');
//print_r($SubCategories);die;
?>




<div class="modal-dialog " role="document" style="width: 55%">
    <form class="form-horizontal" id="editSubCategoryForm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editStateModalLabel">Edit Sub-Category</h4>
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
                                                <label class="col-sm-4 control-label">Category</label>

                                                <div class="col-sm-8">
                                                    <select class="form-control" id="editcatId"
                                                            name="editcatId">
                                                        <option value="" selected="selected">Select Category</option>
                                                        <?php

                                                        foreach ($categories as $category) {
                                                            $parameter['ForeignKeyId'] = $SubCategories->CategoryId;
                                                            $parameter['MasterKeyId'] = $category->Id;
                                                            $isSelected = CommonHelpers::getSelectedOption((object)$parameter);

                                                            ?>
                                                            <option
                                                                value="<?php echo $category->Id; ?>" <?php echo $isSelected;?>><?php echo $category->CategoryName; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>

                                                    <span id="editCountryIdError" style="color: red;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Sub-Category</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="editSubcatName"
                                                           name="editSubcatName"
                                                           maxlength="100"
                                                           value="<?php echo $SubCategories->SubCategoryName; ?>">
                                                    <input type="hidden" name="recordId" id="recordId" value="<?php echo $SubCategories->Id; ?>">
                                                    <span id="editSubCatNameError" style="color: red;"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Description</label>

                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="editSubcatDesc"
                                                           name="editSubcatDesc"
                                                           maxlength="100"
                                                           value="<?php echo $SubCategories->Description; ?>">
                                                    <span id="editSubCatNameError" style="color: red;"></span>
                                                </div>
                                            </div>



                                            <!-- <div class="form-group">
                                                <label class="col-sm-4 control-label">Image</label>

                                                <div class="col-sm-8">
                                                    <input type="file" class="form-control" id="editSubcatImage"
                                                           name="editSubcatImage">
                                                    <?php if(isset($SubCategories->image)){ ?>
                                                        <img style="height: 50px;width: 50px;" src="<?php echo base_url();?>uploads/subcategory/<?php echo $SubCategories->image; ?>"></img>
                                                        <input type="hidden" name="hiddenimage" id="hiddenimage" value="<?php echo $SubCategories->image; ?>"/>
                                                    <?php } ?>
                                                    <span id="editSubcatImageError" style="color: red;"></span>
                                                </div>
                                            </div> -->


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
                <a class="btn btn-medium btn-primary" id="updateSubCat">Update</a>
            </div>
        </div>
    </form>
</div>
