

<div class="modal-dialog " role="document" style="width: 55%">
    <form class="form-horizontal" id="categoryEditForm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editCountryModalLabel">Edit Attribute</h4>
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
                                                <label class="col-sm-4 control-label">Attribute</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="editAttributeName"
                                                           name="editAttributeName"
                                                           maxlength="50"
                                                           value="<?php echo $attribute->AttributeName; ?>">
                                                    <input type="hidden" class="form-control" id="editRecordId"
                                                           name="editRecordId"
                                                           value="<?php echo $attribute->Id; ?>">
                                                    <span id="editAttributeNameError" style="color: red;"></span>
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
                <a class="btn btn-medium btn-primary"  data-dismiss="modal" id="updateAttribute">Update</a>
            </div>
        </div>
    </form>
</div>

