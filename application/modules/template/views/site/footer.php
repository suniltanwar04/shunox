<div class="clearfix"></div>
<footer id="footer" class="footer color-bg">



    <?php
    if (!$this->uri->segment(1)) {
        $this->load->view('site/footer/news-latter-bar');
    }
    ?>



    <?php $this->load->view('site/footer/footer-menu'); ?>
    <?php $this->load->view('site/footer/copy-right-bar'); ?>

</footer>

