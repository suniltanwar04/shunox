<div class="modal fade" id="changePassModel" tabindex="-1" role="dialog" aria-labelledby="changePassModelLabel">
    <div class="modal-dialog " role="document" style="width:45%">
        <form class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="changePassModelLabel">Change Password</h4>
                </div>
                <div class="modal-body modal-tab-form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Passwords</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="changePassError"></div>
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="col-lg-12">
                                            <div class="box-body">
<input type="hidden" class="form-control" id="user_id" name="user_id" value="">
                                                <span id="error" style="color: red;"></span>

                                                <div class="form-group">
                                                <span id="successs" style="color: green;"></span>
                                                    <label class="col-sm-4 control-label">New Password</label>

                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control" id="newPasss"
                                                               name="newPasss">
                                                        <span id="newPasssError" style="color: red;"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Confirm Password</label>

                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control" id="confirmPass"
                                                               name="confirmPass">
                                                        <span id="confirmPassError" style="color: red;"></span>
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
                    <a class="btn btn-medium btn-primary" id="saveUserNewPass">Save</a>
                </div>
            </div>
        </form>
    </div>
</div>
