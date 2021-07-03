<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <!-- /.col -->

            <div class="col-xs-12 col-sm-2">
                <div class="module-heading">
                    <h4 class="module-title">Information</h4>
                </div>
                <!-- /.module-heading -->

                <div class="module-body">
                    <ul class='list-unstyled'>
                        <li class="first"><a href="<?php echo base_url()?>video" title="Video's">Video's</a></li>
                        <li><a href="<?php echo base_url()?>catalogue" title="Catalogue">Catalogue </a></li>
                        <li><a href="<?php echo base_url()?>press-room" title="Press Room">Press Room</a></li>
                    </ul>
                </div>
                <!-- /.module-body -->
            </div>

            <div class="col-xs-12 col-sm-2">
                <div class="module-heading">
                    <h4 class="module-title">Customer Service</h4>
                </div>
                <!-- /.module-heading -->

                <div class="module-body">
                    <ul class='list-unstyled'>
                    <?php if($this->session->userdata("Id")==''){
                     
                    ?>
                        <li class="first"><a href="#" title="Track Your Order" onClick="return loginUrl();">Track Your Order</a></li>
                        <?php }else{?>
                        <li class="first"><a href="<?php echo base_url()?>track-your-order" title="Track Your Order">Track Your Order</a></li>
                        <?php }?>
                        <li><a href="<?php echo base_url()?>warranty" title="Warranty">Warranty</a></li>
                        <li><a href="<?php echo base_url()?>privacy-policy" title="Privacy Policy">Privacy Policy</a></li>
                    </ul>
                </div>
                <!-- /.module-body -->
            </div>


            <div class="col-xs-12 col-sm-5">
                <div class="module-heading">
                    <h4 class="module-title" style="">Address</h4>
                </div>
                <!-- /.module-heading -->

                <div class="module-body">
                    <ul class="toggle-footer" style="">
                        <li class="media">
                            <div class="pull-left"><span class="icon fa-stack fa-lg"> <i
                                        class="fa fa-map-marker fa-stack-1x fa-inverse"></i> </span></div>
                            <div class="media-body">
                                <?php  $addressContact =  callModelFunction('Site_model', 'getValue');
                               $setting  = json_decode(json_encode($addressContact), True);

                               ?>
                                <p><?php echo $setting[19]['value']?>,<br><?php echo $setting[1]['value']?></p>
                            </div>
                        </li>
                        
                        <li class="media">
                           <div class="pull-left" style="height:250px;"> <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.218286069367!2d77.38450691508235!3d28.623219182421572!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cef062aaebf33%3A0xd6ea2cfa6d6be663!2sShunox%20-%20Shoes%20made%20with%20foot%20scanning!5e0!3m2!1sen!2sin!4v1592833609376!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div>
                         </li><!--<li class="media">
                           <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-envelope fa-stack-1x fa-inverse"></i> </span> </div>
                           <div class="media-body"> <span><a href="#">info@shoemade4u.com</a></span> </div>
                         </li>-->
                    </ul>

                </div>
                <!-- /.module-body -->
            </div>
            <div class="col-xs-12 col-sm-3">
                <div class="module-heading">
                    <h4 class="module-title" style="text-align:center">Contact Us</h4>
                </div>
                <!-- /.module-heading -->

                <div class="module-body" style="margin-left:30px;">
                    
                    <ul class="toggle-footer" style="">
                        <li class="media">
                            <div class="pull-left"><span class="icon fa-stack fa-lg"> <i
                                        class="fa fa-mobile fa-stack-1x fa-inverse"></i> </span></div>
                            <div class="media-body">
                                <p><?php
                                    if($setting[2]['value']){
                                    echo $setting[2]['value']; }?> &nbsp;<br> <?php if($setting[16]['value']){ echo $setting[16]['value']; }?>    &nbsp;<br><?php if($setting[17]['value']){ echo $setting[17]['value']; }?>&nbsp;<br><?php if($setting[18]['value']){ echo $setting[18]['value'];}?><br><a href="mailto:customercare@shunox.in">customercare@shunox.in</a>
                                </p>
                            </div>
                        </li>
                        
                        <!-- <li class="media">
                           <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-envelope fa-stack-1x fa-inverse"></i> </span> </div>
                           <div class="media-body"> <span><a href="#">info@shoemade4u.com</a></span> </div>
                         </li>-->
                    </ul>
                </div>
                <!-- /.module-body -->
            </div>
        </div>
    </div>
</div>
