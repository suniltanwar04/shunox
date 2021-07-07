<div class="modal fade" id="sendNewsletter" tabindex="-1" role="dialog" aria-labelledby="sendNewsletterModelLabel">
    <div class="modal-dialog " role="document" style="width:45%">
        <form class="form-horizontal">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="sendNewsletterModelLabel">Send Newsletter</h4>
                </div>
                <div class="modal-body modal-tab-form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab"></a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="changePassError"></div>
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="col-lg-12">
                                            <div class="box-body">
                                            <span id="error" style="color:red"></span>
                                                <span id="success" style="color:green"></span>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Subject</label>

                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" id="subjects"
                                                               name="subjects">
                                                        <span id="subjecterror" style="color: red;"></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Message</label>

                                                    <div class="col-sm-8">
                                                        <textarea type="text" class="form-control" id="messages"
                                                               name="messages" cols="40" rows="6"></textarea>
                                                        <span id="messageError" style="color: red;"></span>
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
                    <a class="btn btn-medium btn-primary" id="sendNewsletter">Save</a>
                </div>
            </div>
        </form>
    </div>
</div>
