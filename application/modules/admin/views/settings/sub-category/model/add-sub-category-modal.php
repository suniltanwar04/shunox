<?php
$categories = callModelFunction('AdminCategory_model', 'getCategories');
?>


<div class="modal fade" id="addStateModal" tabindex="-1" role="dialog" aria-labelledby="addStateModalLabel"
     style="padding-top: 20px;" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog " role="document" style="width: 55%">
        <form class="form-horizontal" id="subCatAddForm" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addStateModalLabel">Add Sub-Category</h4>
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
                                                        <select class="form-control" id="addCatId"
                                                                name="addCatId">
                                                            <option value="" selected="selected">Select Category</option>
                                                            <?php
                                                            foreach ($categories as $category) {
                                                                ?>
                                                                <option
                                                                    value="<?php echo $category->Id; ?>"><?php echo $category->CategoryName; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>

                                                        <span id="addCountryIdError" style="color: red;"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Sub-Category</label>

                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="addSubcatName"
                                                               name="addSubcatName"
                                                               maxlength="100"
                                                               placeholder="Sub-category">
                                                        <span id="addSubCatNameError" style="color: red;"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Description</label>

                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="addSubcatDesc"
                                                               name="addSubcatDesc"
                                                               maxlength="100"
                                                               placeholder="Description">
                                                        <span id="addSubCatDescError" style="color: red;"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Image</label>

                                                    <div class="col-sm-8">
                                                        <input type="file" class="form-control" id="addSubcatImage"
                                                               name="addSubcatImag">
                                                        <span id="addSubCatImageError" style="color: red;"></span>
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
                    <a class="btn btn-medium btn-primary" id="saveSubCategory">Save</a>
                </div>
            </div>
        </form>
    </div>
</div>
