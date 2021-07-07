
<div class="content-wrapper" style="min-height: 916px;">
<section class="content-header">
<a class="btn btn-primary" href="<?php echo site_url('seller/pagelist'); ?>"><i class="fa fa-backward"></i> Page</a>
<ol class="breadcrumb">
<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Edit Page</li>
</ol>
</section>
	
<section class="content">
<div class="row">
<div class="col-md-12">

<?php echo $this->session->flashdata('message'); ?>	

<div class="box box-primary">
<div class="box-header with-border"><h3 class="box-title">Edit Page</h3></div>
	

<form action="<?php echo site_url('seller/updatePage/'.$page->id); ?>" method="post" role="form" class="form-horizontal" enctype="multipart/form-data">	
<div class="box-body">
	<div class="form-group">
	<label class="col-md-2 control-label">Select Page</label>
	<div class="col-md-7">	
	<select name="page" id="page" class="form-control">
	<option value="">Select Page</option>
	<option <?php  if($page->page_menu=='other_pages'){ echo 'selected="selected"';  }?>  value="other_pages">Other Pages</option>
	<option <?php  if($page->page_menu=='Foot Essentials'){ echo 'selected="selected"';  }?> value="Foot Essentials">Foot Essentials</option>
	<option <?php  if($page->page_menu=='Foot Scanning'){ echo 'selected="selected"';  }?> value="Foot Scanning">Foot Scanning</option>
	<option <?php  if($page->page_menu=='Purchase'){ echo 'selected="selected"';  }?> value="Purchase">Purchase</option>
	<option <?php  if($page->page_menu=='Customer care'){ echo 'selected="selected"';  }?> value="Customer care">Customer care</option>
    <option <?php  if($page->page_menu=='Dealer'){ echo 'selected="selected"';  }?> value="Dealer">Dealer</option>
	</select>
		
	</div>
	</div>

	<div class="form-group">
	<label class="col-md-2 control-label">Title</label>
	<div class="col-md-7">	
	<input type="text" name="title" id="title" value="<?php echo $page->title; ?>" class="form-control" placeholder="Enter title">
	
	</div>
	</div>

	<div class="form-group">
	<label class="col-md-2 control-label">Description</label>
	<div class="col-md-7">		
	<textarea   name="area1"  id="area1" style="width:100%;height:300px;"><?php echo $page->description; ?></textarea>
	
	</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-2 control-label">Status</label>
	<div class="col-md-7">		
	<select name="is_active" id="is_active" class="form-control">
		<option <?php if($page->is_active == 1){ ?> selected <?php }?> value="1">Active</option>		
		<option <?php if($page->is_active == 0){ ?> selected <?php }?> value="0">In active</option>
	</select>
	
	</div>
	</div>		
	
	<div class="form-group">
	<label class="col-md-2 control-label">Meta Title</label>
	<div class="col-md-7">	
	<input type="text" name="meta_title" id="meta_title" value="<?php echo $page->meta_title; ?>" class="form-control" placeholder="Enter Meta Title">
	</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-2 control-label">Meta Description</label>
	<div class="col-md-7">	
	<textarea name="meta_description" id="meta_description" rows="3" class="form-control" placeholder="Enter Meta Description"><?php echo $page->meta_description; ?></textarea>	
	</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-2 control-label">Meta Keyword</label>
	<div class="col-md-7">	
	<input type="text" name="meta_keyword" id="meta_keyword" value="<?php echo $page->meta_keyword; ?>" class="form-control" placeholder="Enter Meta Keyword">
	</div>
	</div>

	<div class="form-group">
	<label class="col-md-2 control-label"></label>
	<div class="col-sm-5">
	<label class="btn btn-primary" for="inputImage" title="Upload image file">
	<input type="file" class="hide" id="addImage" name="addImage" accept="image/*">
	Upload  image	
	</label>
	<input type="hidden" name="old_userfile" value="<?php echo $page->image; ?>">	
	</div>
	</div>
	
	<div class="form-group">
	<label class="col-md-2 control-label"></label>
	<div class="col-sm-5">
	<?php if($page->image) {?>
	<img src="<?php echo base_url(); ?>uploads/page/<?php echo $page->image; ?>" class="img-responsive"  width="100">
	<?php }else{?>
	<img src="<?php echo base_url();  ?>uploads/no-image.jpg" class="img-responsive"  width="100">
	<?php }?>		
	</div>
	</div>
</div>

<div class="box-footer">
<button type="submit"  class="btn btn-primary pull-right">Update</button>
</div>
</form>
</div>
		
</div><!-- /.col -->
</div><!-- /.row -->    
</section><!-- /.content -->   
</div>

<?php $this->load->view("footer"); ?>

