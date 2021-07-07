

<div class="modal-dialog " role="document" style="width: 55%">
    <form class="form-horizontal" id="dealerEditForm" method="post">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editDealerModalLabel">Dealer Id</h4>
            </div>
<input type="hidden" id="base_url" name="base_url" value="<?php echo base_url();?>">
            <div class="modal-body modal-tab-form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="nav-tabs-custom">
                            <input type="hidden" class="form-control" id="editRecordId"
                                   name="editRecordId"
                                   value="<?php echo $becomedealers->id ?>">
                            <div class="tab-content">
                                <div id="editFromError"></div>
                                <div class="tab-pane active" id="tab_1">
                                    <div class="col-lg-12">
                                        <div class="box-body" id="formBody">
                                            <?php  if($becomedealers->uniqueId !=''){?>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Dealer Id</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="dealer_id"
                                                           name="dealer_id"
                                                           maxlength="50"
                                                           value="<?php echo  $becomedealers->uniqueId ?>">

                                                    <span id="editIdError" style="color: red;"></span>
                                                </div>
                                            </div>
                                            <?php }else{?>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Dealer Id</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="dealer_id"
                                                           name="dealer_id"
                                                           maxlength="50"
                                                           value="">

                                                    <span id="editIdError" style="color: red;"></span>
                                                </div>
                                            </div>
                                            <?php }?>




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
                <a class="btn btn-medium btn-primary"  id="updateDealer">Update</a>
            </div>
        </div>
    </form>
</div>

