<?php $this->load->view('site/head'); ?>
<?php $this->load->view('site/stylesheet'); ?>

<body class="cnt-home">

<?php $this->load->view('site/header'); ?>


<?php
if (!$this->uri->segment(1)) {
    $this->load->view('site/banner/home-banner');
}
?>






<?php $this->load->view($content); ?>


<?php $this->load->view('site/footer'); ?>
<?php $this->load->view('site/javascript'); ?>
<?php $this->load->view('site/js/site-js');?>

</body>
</html>
