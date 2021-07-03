<div class="content-wrapper" style="min-height: 916px;">
<section class="content-header">
<h1>Edit Banner</h1>
<ol class="breadcrumb">
<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Edit Social</li>
</ol>
</section>
	
<section class="content">
<div class="row">
<div class="col-md-12">

<?php echo $this->session->flashdata('message'); ?>	
	
<div class="nav-tabs-custom">

<form action="<?php echo $this->config->item('admin_base_url') . 'updatesocial/'.$social['id'].''; ?>" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">	
<div class="tab-content">
	
<div class="active tab-pane" id="setting">
	<div class="box-body">
		<div class="form-group">
		<label class="col-md-2 control-label">Title</label>
		<div class="col-md-8">	
                    <input type="text" name="title" id="title" value="<?php echo $social['title']?>" class="form-control" placeholder="Enter title">
		</div>
		</div>
            
                <div class="form-group">
		<label class="col-md-2 control-label">Url</label>
		<div class="col-md-8">	
                    <input type="url" name="url" id="url" value="<?php echo $social['url']?>" class="form-control" placeholder="Enter url">
		</div>
		</div>
            
                <div class="form-group">
		<label class="col-md-2 control-label">Banner Image</label>
		<div class="col-sm-5">
		<label class="btn btn-primary" for="inputImage" title="Upload image file">
		<input type="file" class="hide" id="inputImage" name="userfile" accept="image/*">
		Upload  image	
		</label>
		<input type="hidden" name="old_userfile" value="<?php echo base_url(); ?>uploads/social/<?php echo $social['image']?>">			
		</div>
		</div>	
		
		<div class="form-group">
		<label class="col-md-2 control-label"></label>
		<div class="col-sm-5">
		<?php if($social['image']){ ?>	
		<img src="<?php echo base_url(); ?>uploads/social/<?php echo $social['image']?>" width="25" style="border: 2px solid #6AC4EC;border-radius: 2px;">
		<?php }else{?>	
		<img src="<?php echo base_url(); ?>uploads/no-image.jpg" width="105"  style="border: 2px solid #6AC4EC;border-radius: 2px;">
		<?php }?>		
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