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

<form  method="post" role="form" class="form-horizontal" enctype="multipart/form-data">	
<div class="tab-content">
	
<div class="active tab-pane" id="setting">
	<div class="box-body">
		<div class="form-group">
		<label class="col-md-2 control-label">Name</label>
		<div class="col-md-8">	
                    <div  class="form-control"><?php echo $becomedealers->name;?></div>
		</div>
		</div>
		
        <div class="form-group">
		<label class="col-md-2 control-label">Email</label>
		<div class="col-md-8">	
                    <div  class="form-control"><?php echo $becomedealers->email;?></div>
		</div>
		</div>
		
		<div class="form-group">
		<label class="col-md-2 control-label">Mobile</label>
		<div class="col-md-8">	
                    <div  class="form-control"><?php echo $becomedealers->mobile;?></div>
		</div>
		</div>

        <?php if($becomedealers->landline){?>
            <div class="form-group">
                <label class="col-md-2 control-label">Landline<br>number</label>
                <div class="col-md-8">
                    <div  class="form-control"><?php echo $becomedealers->landline;?></div>
                </div>
            </div>
        <?php }?>

        <?php if($becomedealers->pan){?>
            <div class="form-group">
                <label class="col-md-2 control-label">Pan number</label>
                <div class="col-md-8">
                    <div  class="form-control"><?php echo $becomedealers->pan;?></div>
                </div>
            </div>
        <?php }?>

        <?php if($becomedealers->gst_no){?>
            <div class="form-group">
                <label class="col-md-2 control-label">GST Number</label>
                <div class="col-md-8">
                    <div  class="form-control"><?php echo $becomedealers->gst_no;?></div>
                </div>
            </div>
        <?php }?>

        <?php if($becomedealers->vat){?>
            <div class="form-group">
                <label class="col-md-2 control-label">Vat number</label>
                <div class="col-md-8">
                    <div  class="form-control"><?php echo $becomedealers->vat;?></div>
                </div>
            </div>
        <?php }?>


        <?php if($becomedealers->excise){?>
            <div class="form-group">
                <label class="col-md-2 control-label">Excise<br>number</label>
                <div class="col-md-8">
                    <div  class="form-control"><?php echo $becomedealers->excise;?></div>
                </div>
            </div>
        <?php }?>
   
        <div class="form-group">
		<label class="col-md-2 control-label">Address</label>
		<div class="col-md-8">	
                    <div  class="form-control"><?php echo $becomedealers->address;?></div>
		</div>
		</div>

        <div class="form-group">
            <label class="col-md-2 control-label">Landmark</label>
            <div class="col-md-8">
                <div  class="form-control"><?php echo $becomedealers->landmark;?></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Country</label>
            <div class="col-md-8">
                <div  class="form-control"><?php echo $country->name;?></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">State</label>
            <div class="col-md-8">
                <div  class="form-control"><?php echo $state->name;?></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">City</label>
            <div class="col-md-8">
                <div  class="form-control"><?php echo $city->name;?></div>
            </div>
        </div>
		
		<div class="form-group">
		<label class="col-md-2 control-label">Pincode</label>
		<div class="col-md-8">	
                    <div  class="form-control"><?php echo $becomedealers->pincode;?></div>
		</div>
		</div>

		
		<div class="form-group">
		<label class="col-md-2 control-label">Message</label>
		<div class="col-md-8">	
                    <div  class="form-control"><?php echo $becomedealers->comment;?></div>
		</div>
		</div>

		
		<div class="form-group">
		<label class="col-md-2 control-label">Comapny Name</label>
		<div class="col-md-8">	
                    <div  class="form-control"><?php echo $becomedealers->company;?></div>
		</div>
		</div>
		
		<div class="form-group">
		<label class="col-md-2 control-label">Create date</label>
		<div class="col-md-8">	
                    <div  class="form-control"><?php echo date('d-m-Y', strtotime($becomedealers->created_at));?></div>
		</div>
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
