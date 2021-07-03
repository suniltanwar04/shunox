<div class="content-wrapper" style="min-height: 916px;">
<section class="content-header">
<a class="btn btn-primary" href="<?php echo site_url('blog'); ?>"><i class="fa fa-backward"></i> Back to Blog</a>
<ol class="breadcrumb">
<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Add New Blog</li>
</ol>
</section>
	
<section class="content">
<div class="row">
<div class="col-md-12">

<?php echo $this->session->flashdata('message'); ?>	

<div class="box box-primary">
<div class="box-header with-border"><h3 class="box-title">Add New Blog</h3></div>
	

<form action="<?php echo site_url('admin/blog/add-blog-form'); ?>" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
<div class="box-body">
	<div class="form-group">
	<label class="col-md-2 control-label">Title</label>
	<div class="col-md-7">	
	<input type="text" name="title" id="title"  class="form-control" placeholder="Enter title">

	</div>
	</div>

	<div class="form-group">
	<label class="col-md-2 control-label">Description</label>
	<div class="col-md-7">		
	<textarea  cols="80" name="description"  id="area1" style="width:100%;height:250px;"></textarea>

	</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-2 control-label">Upload Image</label>
	<div class="col-sm-5">
	<label class="btn btn-primary" for="inputImage" title="Upload image file">
	<input type="file" class="hide" id="inputImage" name="userfile" accept="image/*">
	Upload  image	
	</label>
	</div>
	</div>		


</div>

<div class="box-footer">
<button type="submit" class="btn btn-primary pull-right">Submit</button>
</div>
</form>
</div>
	
	
</div>
</div>
</section>
</div>
