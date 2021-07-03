<?php
$this->load->view('admin/header');
$this->load->view('admin/stylesheet');
$this->load->view('admin/head-bar');
$this->load->view('admin/left-menu');
?>


<?php $this->load->view($content); ?>
<?php
$this->load->view('admin/footer-bar');
//$this->load->view('admin/right-side-bar');
$this->load->view('admin/javascript');
$this->load->view('admin/footer');
?>


