<?php
$country = $this->common_model->getCountryById($becomedealers->country);
$state = $this->common_model->getStateById($becomedealers->state);
$city = $this->common_model->getCityById($becomedealers->city);?>
<div class="content-wrapper" style="min-height: 916px;">
<section class="content-header">
<h1>Become Dealer Details</h1>
<ol class="breadcrumb">
<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Become Dealer Details</li>
</ol>
</section>
	
<section class="content">
<div class="row">
<div class="col-md-12">


	
<div class="nav-tabs-custom">

<form  method="post" role="form" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url()?>seller/updatedealerdetails/<?php echo $becomedealers->id?>">	
<div class="tab-content">
	<input type="hidden" value="<?php echo base_url()?>" id="base_url" name="base_url">
<div class="active tab-pane" id="setting">
	<div class="box-body">
		<div class="form-group">
		<?php 
			// print_r($becomedealers);
			// die;
		?>
		<label class="col-md-2 control-label">Dealer Id</label>
		<div class="col-md-8">	
                    <div><input type="text" value="<?php echo $becomedealers->uniqueId;?>" class="form-control" name="dealer_id"></div>
		</div>
		</div>
		<div class="form-group">
		<label class="col-md-2 control-label">Name</label>
		<div class="col-md-8">	
                    <div><input type="text" value="<?php echo $becomedealers->name;?>" class="form-control" name="name"></div>
		</div>
		</div>
		
        <div class="form-group">
		<label class="col-md-2 control-label">Email</label>
		<div class="col-md-8">	
                    <div><input type="text" value="<?php echo $becomedealers->email;?>" class="form-control" name="email"></div>
		</div>
		</div>
		
		<div class="form-group">
		<label class="col-md-2 control-label">Mobile</label>
		<div class="col-md-8">	
                    <div ><input type="text" value="<?php echo $becomedealers->mobile;?>" class="form-control" name="mobile"></div>
		</div>
		</div>

        <?php if($becomedealers->landline){?>
            <div class="form-group">
                <label class="col-md-2 control-label">Landline<br>number</label>
                <div class="col-md-8">
                    <div><input type="text" value="<?php echo $becomedealers->landline;?>" class="form-control" name="landline"></div>
                </div>
            </div>
        <?php }?>

        <?php if($becomedealers->pan){?>
            <div class="form-group">
                <label class="col-md-2 control-label">Pan number</label>
                <div class="col-md-8">
                    <div><input type="text" value="<?php echo $becomedealers->pan;?>" class="form-control" name="pan"></div>
                </div>
            </div>
        <?php }?>
		
		<?php //if($becomedealers->gst_no){?>
            <div class="form-group">
                <label class="col-md-2 control-label">GST number</label>
                <div class="col-md-8">
                    <div><input type="text" value="<?php echo $becomedealers->gst_no;?>" class="form-control" name="gst_no"></div>
                </div>
            </div>
        <?php //}?>
		

        <!-- <?php //if($becomedealers->vat){?>
            <div class="form-group">
                <label class="col-md-2 control-label">Vat number</label>
                <div class="col-md-8">
                    <div><input type="text" value="<?php //echo $becomedealers->vat;?>" class="form-control" name="vat"></div>
                </div>
            </div>
        <?php //}?>


        <?php //if($becomedealers->excise){?>
            <div class="form-group">
                <label class="col-md-2 control-label">Excise<br>number</label>
                <div class="col-md-8">
                    <div><input type="text" value="<?php //echo $becomedealers->excise;?>" class="form-control" name="excise"></div>
                </div>
            </div>
        <?php //}?> -->
   
        <div class="form-group">
		<label class="col-md-2 control-label">Address</label>
		<div class="col-md-8">	
                    <div><input type="text" value="<?php echo $becomedealers->address;?>" class="form-control" name="address"></div>
		</div>
		</div>

        <div class="form-group">
            <label class="col-md-2 control-label">Landmark</label>
            <div class="col-md-8">
                <div><input type="text" value="<?php echo $becomedealers->landmark;?>" class="form-control" name="landmark"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Country</label>
            <div class="col-md-8">
                <select id="country" name="country" class="form-control">
                            <option value="">Select Country</option>
                            <?php foreach($countries as $country){?>
                                <option value="<?php echo $country->id?>" <?php if($becomedealers->country == $country->id){echo 'selected';}?>><?php echo $country->name?></option>
                            <?php }?>
                            </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">State</label>
            <div class="col-md-8">
                <select id="state" name="state" class="form-control">
                             <?php foreach($states as $state){?>
            <option value="<?php echo $state->id?>"  <?php if($becomedealers->state ==  $state->id){echo 'selected';}?>><?php echo $state->name?></option>
             <?php }?>

                        </select>
                        
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">City</label>
            <div class="col-md-8">
                <select id="city" name="city" class="form-control">
                            <?php foreach($cities as $city){?>
            <option value="<?php echo $city->id?>"  <?php if($becomedealers->city ==  $city->id){echo 'selected';}?>><?php echo $city->name?></option>
             <?php }?>
            </select>
            </div>
        </div>
		
		<div class="form-group">
		<label class="col-md-2 control-label">Pincode</label>
		<div class="col-md-8">	
                    <div><input type="text" value="<?php echo $becomedealers->pincode;?>" class="form-control" name="pincode"></div>
		</div>
		</div>

		
		<div class="form-group">
		<label class="col-md-2 control-label">Message</label>
		<div class="col-md-8">	
                    <div><input type="text" value="<?php echo $becomedealers->comment;?>" class="form-control" name="message"></div>
		</div>
		</div>

		
		<div class="form-group">
		<label class="col-md-2 control-label">Comapny Name</label>
		<div class="col-md-8">	
                    <div><input type="text" value="<?php echo $becomedealers->company;?>" class="form-control" name="company_name"></div>
		</div>
		</div>
		
		<div class="form-group">
		<label class="col-md-2 control-label">Create date</label>
		<div class="col-md-8">	
                    <div  class="form-control"><?php echo date('d-m-Y', strtotime($becomedealers->created_at));?></div>
		</div>
		</div>
		
		<div class="form-group">
              
                <input type="submit" class="btn btn-primary pull-right" id="updateSubCat" value="Update">
            </div>
		


		
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
