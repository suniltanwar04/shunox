
<div class="content-wrapper" style="min-height: 916px;">
<section class="content-header">
<a class="btn btn-primary" href="<?php echo site_url('seller/blog/add'); ?>"><i class="fa fa-plus-circle"></i> Add New Blog</a>
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
<div class="box-header with-border">
	<h3 class="box-title">List of Blog</h3>


</div>
	
<div class="box-body">
	<table id="customers2" class="table table-bordered table-striped">
	<thead>
		<tr>
		<th>Sr No.</th>
		<th>Title</th>
        <th>Image</th>
		<th>Status</th>
		<th>Created On</th>

		<th>Operation</th>
		</tr>
	</thead>
	<tbody>	
		<?php
		$i = 1;
		foreach($allblog as $blog){ 
		?>			
		<tr>
		<td width="8%" style="text-align: center;"><?php echo $i; ?></td>
		<td><?php echo $blog->title; ?></td>
        <td><img src="<?php echo base_url()?>uploads/blog/<?php echo $blog->image; ?>" style="width:50px;"></td>
		<td>
			<?php 
			if($blog->is_active == 1) {
				echo "Active";
			}else{
				echo "In active";
			}
			?>
		</td>
		<td><?php echo $blog->created_at; ?></td>

		<td width="20%">
			<a class="btn btn-success" href="<?php echo site_url('seller/blog/edit/'.$blog->id); ?>"><i class="fa fa-edit"></i> Edit</a>
			<a class="btn btn-danger" href="<?php echo site_url('seller/blog/delete/'.$blog->id); ?>" onclick="return confirm('Are you sure you want to delete')"><i class="fa fa-trash-o"></i> Delete</a>
		</td>
		</tr>   
		<?php $i++; }?>
	</tbody>
	</table>
</div>
</div>
	
	
</div>
</div>
</section>

</div>
