

<div class="modal fade" id="addLocationModal" tabindex="-1" role="dialog" aria-labelledby="addCityModalLabel"
     style="padding-top: 20px;" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog " role="document" style="width: 55%">

        <form class="form-horizontal" id="locationAddForm" enctype="multipart/form-data">
            <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url()?>">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addCityModalLabel">Add Location</h4>
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
                                                    <label class="col-sm-4 control-label">Company Name</label>

                                                    <div class="col-sm-8">
                                                       <input type="text" id="company" name="company" class="form-control">
                                                        <span id="addCompanyError" style="color: red;"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Email</label>

                                                    <div class="col-sm-8">
                                                        <input type="text" id="email" name="email" class="form-control">

                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Mobile</label>

                                                    <div class="col-sm-8">
                                                        <input type="text" id="mobile" name="mobile" class="form-control">

                                                    </div>
                                                </div>



                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Address</label>

                                                    <div class="col-sm-8">
                                                        <textarea  class="form-control" id="addAddress"
                                                               name="addAddress"></textarea>
                                                        <span id="addAddressError" style="color: red;"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Country</label>

                                                    <div class="col-sm-8">
                                                        <select id="country" name="country" class="form-control">
                                                            <option value="">Select Country</option>
                                                            <?php foreach($countries as $country){?>
                                                                <option value="<?php echo $country->id?>"><?php echo $country->name?></option>
                                                            <?php }?>
                                                            </select>
                                                        <span id="addCountryError" style="color: red;"></span>
                                                    </div>
                                                </div>



                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">State</label>

                                                    <div class="col-sm-8">
                                                        <select id="state" name="state" class="form-control">
                                                            <option >Select State</option>

                                                        </select>
                                                        <span id="addStateError" style="color: red;"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">City</label>

                                                    <div class="col-sm-8">
                                                        <select id="city" name="city" class="form-control">
                                                            <option >Select City</option>

                                                        </select>
                                                        <span id="addCityError" style="color: red;"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Pincode</label>

                                                    <div class="col-sm-8">
                                                        <input type="text" id="pincode" name="pincode" class="form-control" maxlength="6">
                                                        <span id="addPincodeError" style="color: red;"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Map Url</label>

                                                    <div class="col-sm-8">
                                                        <textarea  class="form-control" id="addMapurl"
                                                                   name="addMapurl"></textarea>

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
                    <a class="btn btn-medium btn-primary" id="saveLocation">Save</a>
                </div>
            </div>
        </form>
    </div>
</div>
