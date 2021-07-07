

<div class="modal fade" id="addBannerModal" tabindex="-1" role="dialog" aria-labelledby="addCityModalLabel"
     style="padding-top: 20px;" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog " role="document" style="width: 55%">

        <form class="form-horizontal" id="bannerAddForm" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addCityModalLabel">Add Banner</h4>
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
                                                    <label class="col-sm-4 control-label">Title</label>

                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="addName"
                                                               name="addName"
                                                               maxlength="100"
                                                               placeholder="Title">
                                                        <span id="addNameError" style="color: red;"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Image</label>

                                                    <div class="col-sm-8">
                                                        <input type="file" class="form-control" id="addimage"
                                                               name="addImage"
                                                               maxlength="100">
                                                        <span id="addimageError" style="color: red;"></span>
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
                    <a class="btn btn-medium btn-primary" id="saveBanner">Save</a>
                </div>
            </div>
        </form>
    </div>
</div>
