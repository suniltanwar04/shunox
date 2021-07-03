<div class="copyright-bar" style="padding-bottom:0 !important; ">
    <div class="container">
        <div class="col-xs-12 col-sm-6">
        <span id="newError"></span>
        <form method="post" onSubmit="return newsLetter()" style="display: inline-grid;width: 100%;">
        
            <p style="float:left !important; text-align:left !important;"><i class="fa fa-envelope"></i><!-- Newsletter-->
            	
                <input type="text" name="email" id="email" placeholder="Enter your email to recieve our newsletter">
                <input type="submit" value="Submit" id="newSubmit">
                
            </p>
            </form>
        </div>
        <div class="col-xs-12 col-sm-6 " style="margin-top:-5px;">
            <div class="social-links pull-right">
                    <h3 class="pull-left follow-link">Follow Us</h3>
                    <?php
                   // echo '<pre>';
                    //print_r($socials);
                     foreach($socials as $social){?>
                    <a href="<?php echo $social->url?>" class="fb"><img src="<?php echo base_url()?>uploads/social/<?php echo $social->image?>"></a>
                    <?php }?>
                </div>
                
            <!-- /.payment-methods -->
        </div>
    </div>
</div>
<script>

</script>
