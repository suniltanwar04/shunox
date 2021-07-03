
<div class="copyright-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
               
                 <div class="clearfix payment-methods">
                <ul>
                    <li><img src="<?php echo base_url(); ?>assets/site/images/payments/1.png" alt=""></li>
                    <li><img src="<?php echo base_url(); ?>assets/site/images/payments/2.png" alt=""></li>
                    <li><img src="<?php echo base_url(); ?>assets/site/images/payments/3.png" alt=""></li>
                    <li><img src="<?php echo base_url(); ?>assets/site/images/payments/4.png" alt=""></li>
                    <li><img src="<?php echo base_url(); ?>assets/site/images/payments/5.png" alt=""></li>
                    
                </ul>
            </div>
            </div>
            <div class="col-md-4 copyright" style="text-align:right !important;">
            <?php $test = $this->Template_model->getCopyRight(); ?>
                <a class="#"><?php echo $test[0]->value; ?> </a>
            </div>

        </div>
    </div>
