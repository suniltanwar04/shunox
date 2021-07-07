<?php $this->load->view("left-menu");?>

<div class="content-wrapper" style="min-height: 916px;">
<section class="content-header">
<a class="btn btn-primary" href="<?php echo site_url('page'); ?>"><i class="fa fa-backward"></i> Page</a>
<ol class="breadcrumb">
<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Add New Page</li>
</ol>
</section>
	
<section class="content">
<div class="row">
<div class="col-md-12">

<?php echo $this->session->flashdata('message'); ?>	

<div class="box box-primary">
<div class="box-header with-border"><h3 class="box-title">Add New Page</h3></div>
	

<form  method="post" action="<?php echo base_url()?>seller/savePage" role="form" id="pageAddForm" class="form-horizontal" enctype="multipart/form-data">
	<input type="hidden" name="baseUrl" id="baseUrl" value="<?php echo base_url()?>">	
<div class="box-body">
	<div class="form-group">
	<label class="col-md-2 control-label">Select Page</label>
	<div class="col-md-7">	
	<select name="page" id="page" class="form-control">
	<option value="">Select Page</option>
	<option value="other_pages">Other Pages</option>
	<option value="Foot Essentials">Foot Essentials</option>
	<option value="Foot Scanning">Foot Scanning</option>
	<option value="Purchase">Purchase</option>
	<option value="Customer care">Customer care</option>
        <option value="Dealer">Dealer</option>
	</select>
	
	</div>
	<span id="addpageError" style="color: red;"></span>
	</div>

	<div class="form-group">
	<label class="col-md-2 control-label">Title</label>
	<div class="col-md-7">	
	<input type="text" name="title" id="title" value="" class="form-control" placeholder="Enter title">
	
	</div>
	<span id="addtitleError" style="color: red;"></span>
	</div>

	<div class="form-group">
	<label class="col-md-2 control-label">Description</label>
	<div class="col-md-7">		
	<textarea   name="area1"  id="area1" value="" style="width:100%;height:300px;"></textarea>
	
	</div>
	</div>
	<div class="form-group">
	<label class="col-md-2 control-label"></label>
	<div class="col-sm-5">
	<label class="btn btn-primary" for="inputImage" title="Upload image file">
	<input type="file" class="hide" id="addImage" name="addImage" accept="image/*">
	Upload  image	
	</label>
	</div>
	</div>
	<div class="form-group">
	<label class="col-md-2 control-label">Meta Title</label>
	<div class="col-md-7">	
	<input type="text" name="meta_title" id="meta_title" value="" class="form-control" placeholder="Enter Meta Title">
	</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-2 control-label">Meta Description</label>
	<div class="col-md-7">	
	<textarea name="meta_description" id="meta_description" rows="3" value="" class="form-control" placeholder="Enter Meta Description">
	</textarea>	
	</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-2 control-label">Meta Keyword</label>
	<div class="col-md-7">	
	<input type="text" name="meta_keyword" id="meta_keyword" value="" class="form-control" placeholder="Enter Meta Keyword">
	</div>
	</div>	
</div>

<div class="box-footer">
<button type="submit"  class="btn btn-primary pull-right">Submit</button>
</div>
</form>
</div>
	
	
</div><!-- /.col -->
</div><!-- /.row -->    
</section><!-- /.content -->   
</div>

<?php $this->load->view("footer"); ?>

