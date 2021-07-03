<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel"
     style="padding-top: 20px;" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog " role="document" style="width: 55%">
        <form class="form-horizontal" id="categoryAddForm" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addCategoryModalLabel">Add Category</h4>
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
                                                    <label class="col-sm-4 control-label">Category</label>

                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="addCategoryName"
                                                               name="addCategoryName"
                                                               maxlength="50"
                                                               placeholder="Category">
                                                        <span id="addCategoryNameError" style="color: red;"></span>
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
                    <a class="btn btn-medium btn-primary" id="saveCategory">Save</a>
                </div>
            </div>
        </form>
    </div>
</div>