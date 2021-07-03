<link rel="icon" type="image/png" href="<?php echo base_url(); ?>uploads/fv.png">

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/css/bootstrap.min.css">
<!-- Customizable CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/css/main.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/css/blue.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/css/owl.carousel.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/css/owl.transitions.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/css/animate.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/css/rateit.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/css/bootstrap-select.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/js/plugins/gritter/css/jquery.gritter.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/css/pages.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/css/style.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/css/reset2.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/css/layouts2.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/css/global2.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/css/easyzoom.css">


<!--<link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/css/js_composer.css">-->

<link href = "https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel = "stylesheet">
    



<!-- Icons/Glyphs -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/css/font-awesome.css">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<!--<link rel="stylesheet" href="<?php echo base_url(); ?>assets/site/css/basictable.css">-->

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800'
      rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

<?php
if (isset($style) && $style != '') {
    $this->load->view($style);
}
?>

<style>
		.post-4389 {
		text-align: center;
	}
	.post-4389 li {
		display: inline;
		align-items: center;
		justify-content: center;
		width: 60px;
		height: 60px;
		background-color: #3B1D19;
		border-radius: 100%;
		color: #000;
		text-transform: uppercase;
		flex-wrap: wrap;
		font-size: 20px;
		padding: 8px 16px;
		margin: 0 47px;
		color: #fff;
	}
	.post-4389 li.active {
		background-color: #DE3B34;
	}
	.post-4389 li a{
		color: #fff;
	}
	.post-4389 .tab-pane.fade {
		margin-top: 50px;
	}
</style>
</head>
