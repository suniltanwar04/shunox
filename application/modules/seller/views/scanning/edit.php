<div class="content-wrapper" style="min-height: 916px;">
<section class="content-header">
<h1>Edit Scanning Location</h1>
<ol class="breadcrumb">
<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Edit Scanning Location</li>
</ol>
</section>
	
<section class="content">
<div class="row">
<div class="col-md-12">

<?php echo $this->session->flashdata('message'); ?>	
	
<div class="nav-tabs-custom">

<form action="<?php echo $this->config->item('seller_base_url') . 'updateLocation/'.$location->Id; ?>" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">	
<div class="tab-content">
	<input type="hidden" name="base_url" id="base_url" value="<?php echo base_url()?>" >
<div class="active tab-pane" id="setting">
	<div class="box-body">
		<div class="form-group">
		<label class="col-md-2 control-label">Company</label>
		<div class="col-md-8">	
                    <input type="text" name="editcompany" id="editcompany" value="<?php echo $location->company?>" class="form-control" placeholder="Enter Company">
		</div>
		</div>	
		
		<div class="form-group">
		<label class="col-md-2 control-label">Email</label>
		<div class="col-md-8">	
                    <input type="email" name="editEmail" id="editEmail" value="<?php echo $location->email?>" class="form-control" placeholder="Enter Email">
		</div>
		</div>
		
		<div class="form-group">
		<label class="col-md-2 control-label">Mobile</label>
		<div class="col-md-8">	
                    <input type="text" name="editMobile" id="editMobile" value="<?php echo $location->phone?>" class="form-control" placeholder="Enter Mobile">
		</div>
		</div>
		
		<div class="form-group">
		<label class="col-md-2 control-label">Address</label>
		<div class="col-md-8">	
                    <textarea  class="form-control" id="editAddress" name="editAddress"><?php echo $location->address?></textarea>
		</div>
		</div>
		
		<div class="form-group">
                    <label class="col-md-2 control-label">Country</label>

                    <div class="col-sm-8">
                        <select id="country" name="country" class="form-control">
                            <option value="">Select Country</option>
                            <?php foreach($countries as $country){?>
                                <option value="<?php echo $country->id?>" <?php if($location->country == $country->id){echo 'selected';}?>><?php echo $country->name?></option>
                            <?php }?>
                            </select>
                       
                    </div>
                </div>



                <div class="form-group">
                    <label class="col-md-2 control-label">State</label>

                    <div class="col-sm-8">
                        <select id="state" name="state" class="form-control">
                             <?php foreach($states as $state){?>
            <option value="<?php echo $state->id?>"  <?php if($location->state ==  $state->id){echo 'selected';}?>><?php echo $state->name?></option>
             <?php }?>

                        </select>
                        
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">City</label>

                    <div class="col-sm-8">
                        <select id="city" name="city" class="form-control">
                            <?php foreach($cities as $city){?>
            <option value="<?php echo $city->id?>"  <?php if($location->city ==  $city->id){echo 'selected';}?>><?php echo $city->name?></option>
             <?php }?>
            </select>

                        </select>
                      
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Pincode</label>

                    <div class="col-sm-8">
                        <input type="text" id="pincode" name="pincode" class="form-control" maxlength="6" value="<?php echo $location->pincode?>">
                       
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Map Url</label>

                    <div class="col-sm-8">
                        <textarea  class="form-control" id="editMapurl"
                                   name="editMapurl"><?php echo $location->map_url?></textarea>

                    </div>
                </div>

            
               
		
            
           
	</div>
</div>
	
	

		
</div>
	
<div class="box-footer">
<button type="submit" class="btn btn-primary pull-right">Update</button>
</div>		
</form>	
	
</div>
</div>


</div><!-- /.col -->
</div><!-- /.row -->    
</section><!-- /.content -->   
</div>