<?php 
$email =  callModelFunction('AdminLogin_model', 'getEmail');
?>
<div class="modal fade" id="changeEmail" tabindex="-1" role="dialog" aria-labelledby="changeEmailModelLabel">
    <div class="modal-dialog " role="document" style="width:45%">
        <form class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="changeEmailModelLabel">Change Email</h4>
                </div>
                <div class="modal-body modal-tab-form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Email</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="changePassError"></div>
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="col-lg-12">
                                            <div class="box-body">
                                            <span id="error" style="color:red"></span>
                                                <span id="success" style="color:green"></span>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Admin Email</label>

                                                    <div class="col-sm-8">
                                                        <input type="email" class="form-control" id="adminemail"
                                                               name="adminemail" value="<?php echo $email->Email?>">
                                                        <span id="emailIdError" style="color: red;"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">To Email</label>

                                                    <div class="col-sm-8">
                                                        <input type="email" class="form-control" id="toemail"
                                                               name="toemail" value="<?php echo $email->to_email?>">
                                                        <span id="toemailIdError" style="color: red;"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Change Password</label>

                                                    <div class="col-sm-8">
                                                        <input type="password" class="form-control" id="newPass"
                                                               name="newPass" value="<?php echo $email->PassSalt?>">
                                                        <span id="newPassError" style="color: red;"></span>
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
                    <a class="btn btn-medium btn-primary" id="saveNewEmail">Save</a>
                </div>
            </div>
        </form>
    </div>
</div>
