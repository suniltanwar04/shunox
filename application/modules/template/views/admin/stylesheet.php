<?php
?>
<!-- Bootstrap 3.3.5 -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/font-awesome.min.css">
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">-->
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- jvectormap -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/js/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/skins/_all-skins.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/custom-style.css">

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/js/plugins/datatables/dataTables.bootstrap.css">
<!-- Bootstrap DateTimePicker -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.css">

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/js/plugins/iCheck/square/blue.css">

<!--- Color Picker ----->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/css/bootstrap-colorpicker.min.css">


<!-- Gitter -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/js/plugins/gritter/css/jquery.gritter.css">

<!-- jquery datepicker ui css -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">



<?php
if (isset($style) && $style != '') {
    $this->load->view($style);
}
?>




<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->


<!-- jQuery 3.1.1 -->
<script
  src="https://code.jquery.com/jquery-3.1.1.min.js"
  integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
  crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- form valiation js -->
<script src="http://khabartoday.in/shobhit/api/js/form_validation.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>
<!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>-->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAnnoBDTJmxn2WKlVGbWP1Qov9EDDrMTxg&libraries=places"></script>
