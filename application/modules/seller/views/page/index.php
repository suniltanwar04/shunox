<?php $this->load->view("header");?>
<?php $this->load->view("left-menu");?>


<div class="content-wrapper" style="min-height: 916px;">
<section class="content-header">
<a class="btn btn-primary" href="<?php echo site_url('seller/addPage'); ?>"><i class="fa fa-plus-circle"></i>  Add New Page</a>
<ol class="breadcrumb">
<li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active"> Page</li>
</ol>
</section>
	
<section class="content">
<div class="row">
<div class="col-md-12">

<?php echo $this->session->flashdata('message'); ?>	

<div class="box box-primary">
<div class="box-header with-border">
	<h3 class="box-title">List of Pages</h3>
	
		
</div>
	
<div class="box-body">
	<table id="customers2" class="table table-bordered table-striped">
	<thead>
		<tr>
		<th>Sr No.</th>
		<th>Page Title</th>
		<th>Menu Page</th>
		<!--<th>Status</th>-->
		<th>Created On</th>
		<th>Updated On</th>		
		<th>Operation</th>
		</tr>
	</thead>
	<tbody>	
		<?php
		$i = 1;
		
		if($allpage!=''){
		foreach($allpage as $pages){ 
		?>			
		<tr>
		<td width="8%" style="text-align: center;"><?php echo $i; ?></td>
		<td><?php echo $pages->title; ?></td>
		<td><?php 
		$p_menu = str_replace('_',' ', $pages->page_menu);
		echo ucfirst($p_menu); ?></td>
	
			
		
		
		<td><?php echo $pages->created_at; ?></td>
		<td><?php echo $pages->modified_at; ?></td>		
		<td width="20%">
			<a class="btn btn-success" href="<?php echo site_url('seller/editPage/'.$pages->id); ?>"><i class="fa fa-edit"></i> Edit</a>  
			<!--<a class="btn btn-danger" href="<?php echo site_url('seller/page/delete/'.$pages->id); ?>" onclick="return confirm('Are you sure you want to delete')"><i class="fa fa-trash-o"></i> Delete</a>-->
		</td>
		</tr>   
		<?php $i++; } }else{?>
			<td><?php echo 'No record found';?></td>	
		<?php	}?>
	</tbody>
	</table>
</div>
</div>
	
	
</div><!-- /.col -->
</div><!-- /.row -->    
</section><!-- /.content -->   
</div>

<?php $this->load->view("footer"); ?>

