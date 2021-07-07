<div class="content-wrapper" style="min-height: 916px;">
<section class="content-header">
<h1>Dashboard</h1>
<ol class="breadcrumb">
<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Dashboard</li>
</ol>
</section>
	
<section class="content">
<p> Welcome to Dashboard</p>	

<div class="row">
	<!-- <div class="col-lg-3 col-xs-6">
	<div class="small-box bg-yellow">
	<div class="inner">
	<h3><?php //echo $products?></h3>
	<p>Total</p>
	</div>
	<div class="icon">
	<i class="ion ion-document-text"></i>
	</div>
	<a href="<?php //echo base_url()?>seller/product" class="small-box-footer">Products</a>
	</div>
	</div> -->
	
	<div class="col-lg-3 col-xs-6">
	<div class="small-box bg-aqua">
	<div class="inner">
	<h3><?php echo $orders?></h3>
	<p>Total </p>
	</div>
	<div class="icon">
	<i class="ion ion-bag"></i>
	</div>
	<a href="<?php echo base_url()?>seller/order-management" class="small-box-footer">Orders </a>
	</div>
	</div>

	<div class="col-lg-3 col-xs-6">
	<div class="small-box bg-red">
	<div class="inner">
	<h3><?php echo $users?></h3>
	<p>Total </p>
	</div>
	<div class="icon">
	<i class="ion ion-person-add"></i>
	</div>
	<a href="<?php echo base_url()?>seller/user-management" class="small-box-footer">Users </a>
	</div>
	</div>
	
	<!-- <div class="col-lg-3 col-xs-6">
	<div class="small-box bg-blue">
	<div class="inner">
	<h3><?php //echo $banners; ?></h3>
	<p>Total </p>
	</div>
	<div class="icon">
	<i class="ion ion-android-mail"></i>
	</div>
	<a href="<?php //echo base_url()?>admin/banner" class="small-box-footer">Banners </a>
	</div>
	</div> -->

	
</div>	
</section>

</div>
