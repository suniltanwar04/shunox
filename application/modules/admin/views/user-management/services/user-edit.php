<?php
if($userdetails->Country) {
    $country = $this->Common_model->getCountryById($userdetails->Country);
    $cou = $country->name;
}else{
    $cou = '';
}
if($userdetails->State) {
    $state = $this->Common_model->getStateById($userdetails->State);
    $stat = $state->name;
}else{
    $stat = '';
}
if($userdetails->City){
    $city = $this->Common_model->getCityById($userdetails->City);
    $cit = $city->name;
}else{
    $cit = '';
}
?>
<div class="content-wrapper" style="min-height: 916px;">
    <section class="content-header">
        <h1>User Edit</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User Edit</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <?php echo $this->session->flashdata('message'); ?>

                <div class="nav-tabs-custom">

                    <form  method="post" role="form" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url()?>admin/user-update/<?php echo $userdetails->Id?>">
                        <div class="tab-content">
<input type="hidden" id="base_url" name="base_url" value="<?php echo base_url();?>">
                            <div class="active tab-pane" id="setting">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Name</label>
                                        <div class="col-md-8">
                                            <input type="text"  value="<?php echo $userdetails->FullName?>" class="form-control" name="name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Email</label>
                                        <div class="col-md-8">
                                            <input type="text"  value="<?php echo $userdetails->Email?>" class="form-control" name="email">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Mobile</label>
                                        <div class="col-md-8">
                                            <input type="text"  value="<?php echo $userdetails->Mobile?>" class="form-control" name="mobile">
                                            <div class="error"></div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Address</label>
                                        <div class="col-md-8">
                                            <textarea  class="form-control" name="address"><?php echo $userdetails->Address?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Landmark</label>
                                        <div class="col-md-8">
                                            <input type="text" name="landmark" value="<?php echo $userdetails->Landmark?>" class="form-control" >
                                            <div class="error"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Country</label>
                                        <div class="col-md-8">
                                           <select id="country" name="country" class="form-control">
		                            <option value="">Select Country</option>
		                            <?php foreach($countries as $countrys){?>
		                                <option value="<?php echo $countrys->id?>" <?php if($userdetails->Country == $countrys->id){echo 'selected';}?>><?php echo $countrys->name?></option>
		                            <?php }?>
		                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">State</label>
                                        <div class="col-md-8">
                                            <select id="state" name="state" class="form-control">
			                             <?php foreach($states as $state){?>
			            <option value="<?php echo $state->id?>"  <?php if($userdetails->State ==  $state->id){echo 'selected';}?>><?php echo $state->name?></option>
			             <?php }?>
			
			                        </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> City</label>
                                        <div class="col-md-8">
                                            <select id="city" name="city" class="form-control">
				                            <?php foreach($cities as $city){?>
				            <option value="<?php echo $city->id?>"  <?php if($userdetails->City==  $city->id){echo 'selected';}?>><?php echo $city->name?></option>
				             <?php }?>
				            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Pincode</label>
                                        <div class="col-md-8">
                                            <input type="text" name="pincode" value="<?php echo $userdetails->Pincode?>" class="form-control">
                                        </div>
                                    </div>

<input type="submit" class="btn btn-primary pull-right" id="updateSubCat" value="Update">
                                </div>
                            </div>




                        </div>


                    </form>

                </div>
            </div>


        </div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
</div>