<div class="content-wrapper" style="min-height: 916px;">
<section class="content-header">
<h1>Setting</h1>
<ol class="breadcrumb">
<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Setting</li>
</ol>
</section>
	
<section class="content">
<div class="row">
<div class="col-md-12">

<?php 
//print_r($setting);
echo $this->session->flashdata('message'); ?>	
	
<div class="nav-tabs-custom">

<form action="<?php echo $this->config->item('seller_base_url') . 'savesettings'; ?>" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">	
<div class="tab-content">

<div class="active tab-pane" id="setting">
	<div class="box-body">
		<div class="form-group">
		<label class="col-md-2 control-label">Website Name</label>
		<div class="col-md-8">	
                    <input type="text" name="SITE_TITLE" id="SITE_TITLE" value="<?php echo $setting[0]['value']?>" class="form-control" placeholder="Enter name">
		</div>
		</div>
        
    <div class="form-group">
		<label class="col-md-2 control-label">Company</label>
		<div class="col-md-8">		
		 <input type="text" name="SITE_COMPANY" id="SITE_COMPANY" value="<?php echo $setting[19]['value']?>" class="form-control" placeholder="Enter Company">
		</div>
		</div>
        
		<div class="form-group">
		<label class="col-md-2 control-label">Address</label>
		<div class="col-md-8">		
		<textarea name="SITE_ADDRESS" id="SITE_ADDRESS" class="form-control" placeholder="Enter Address"><?php echo $setting[1]['value']?></textarea>
		</div>
		</div>


		
		<div class="form-group">
		<label class="col-md-2 control-label">General Email-Id</label>
		<div class="col-md-8">		
		<input type="email" name="SITE_EMAIL" id="SITE_EMAIL" value="<?php echo $setting[3]['value']?>" class="form-control" placeholder="Enter email">
		</div>
		</div>
		
		<div class="form-group">
		<label class="col-md-2 control-label">Scanner Email-Id</label>
		<div class="col-md-8">		
		<input type="email" name="SUPPORT_EMAIL" id="SUPPORT_EMAIL" value="<?php echo $setting[11]['value']?>" class="form-control" placeholder="Enter Support Email-Id">
		</div>
		</div>
        
        <div class="form-group">
		<label class="col-md-2 control-label"> Currency</label>
		<div class="col-md-8">		
		<input type="text" name="Currency" id="Currency" value="<?php echo $setting[14]['value']?>" class="form-control" placeholder="Currency">
		</div>
		</div>
        
        <div class="form-group">
		<label class="col-md-2 control-label">Currency Symbol</label>
		<div class="col-md-8">		
		<input type="text" name="Currency_Symbol" id="Currency_Symbol" value="<?php echo $setting[15]['value']?>" class="form-control" placeholder="Currency Symbol">
		</div>
		</div>
		
		<div class="form-group">
		<label class="col-md-2 control-label">Website Logo</label>
		<div class="col-sm-5">
		<label class="btn btn-primary" for="inputImage" title="Upload image file">
		<input type="file" class="hide" id="inputImage" name="SITE_LOGO" accept="image/*">
		Upload  image	
		</label>
		<input type="hidden" name="OLD_LOGO" value="">			
		</div>
		</div>		
		
		<div class="form-group">
		<label class="col-md-2 control-label"></label>
		<div class="col-sm-5">
		<?php if($setting[4]['value']){ ?>	
		<img src="<?php echo base_url(); ?>uploads/setting/<?php echo $setting[4]['value']?>" width="105" style="border: 2px solid #6AC4EC;border-radius: 2px;">
		<?php }else{?>	
		<img src="<?php echo base_url(); ?>uploads/no-image.jpg" width="105"  style="border: 2px solid #6AC4EC;border-radius: 2px;">
		<?php }?>			
		</div>
		</div>

        <div class="form-group">
            <label class="col-md-2 control-label">Website Mobile</label>
            <div class="col-md-8">
                <input type="text" name="SITE_MOBILE" id="SITE_MOBILE" value="<?php echo $setting[2]['value']?>" class="form-control" placeholder="Enter Mobile">
                <div class="error"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Website Mobile</label>
            <div class="col-md-8">
                <input type="text" name="SITE_MOBILE1" id="SITE_MOBILE1" value="<?php echo $setting[16]['value']?>" class="form-control" placeholder="Enter Mobile">
                <div class="error"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Website Mobile</label>
            <div class="col-md-8">
                <input type="text" name="SITE_MOBILE2" id="SITE_MOBILE2" value="<?php echo $setting[17]['value']?>" class="form-control" placeholder="Enter Mobile">
                <div class="error"></div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">Website Telephone</label>
            <div class="col-md-8">
                <input type="text" name="SITE_MOBILE3" id="SITE_MOBILE3" value="<?php echo $setting[18]['value']?>" class="form-control" placeholder="Enter Mobile">
                <div class="error"></div>
            </div>
        </div>
            
            <div class="form-group">
		<label class="col-md-2 control-label">Copyright</label>
		<div class="col-md-8">	
		<textarea name="COPYRIGHT" id="COPYRIGHT" class="form-control" placeholder="Enter Search a Booking Details"><?php echo $setting[8]['value']?></textarea>
		</div>
		</div>
	</div>
</div>
	
	

		
</div>
	
<div class="box-footer">
<button type="submit" class="btn btn-primary pull-right">Update Setting</button>
</div>		
</form>	
	
</div>
</div>


</div><!-- /.col -->
</div><!-- /.row -->    
</section><!-- /.content -->   
</div>