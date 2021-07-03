<div id="loader">
    <img src="<?php echo base_url().'assets/site/images/loader.gif'; ?>" alt="">
</div>
<style>
input[type="radio"]+label:before {
    background: none;
}

input[type="radio"]:checked+label:before {
    background: none;
}
input[type="radio"]{
	display : block;
	}
.radio_check{
	margin-top: 5px;
    float: right;
    margin-left: 15px ! important;
}
input[type='radio'] {
  -webkit-appearance:none;
  width:15px;
  height:15px;
  border-radius:50%;
  outline:none;
  box-shadow:0 0 5px 0px ;
}

input[type='radio']:hover {
  box-shadow:0 0 5px 0px orange inset;
}

input[type='radio']:before {
  content:'';
  display:block;
  width:60%;
  height:60%;
  margin: 20% auto;    
  border-radius:50%; 
  outline:none;   
}
input[type='radio']:checked:before {
  background:orange;
  outline:none;
}
</style>
<div class="main-container col2-right-layout">
    <div class="main container">
        <div class="row">
            <div class="col-md-12 about-con">
                <h2> Contact Us </h2>

                <hr>
                <h2 style="color:black;text-align: center;font-size: 18px;">Do you have any complaint or Suggestion for us? Select &amp; click below given links with your message. We will get in touch with your shortly.</h2>
                <div class="clearfix"></div>
                <div class="alert text-center" id="response" style="display:none; font-size: 18px;">
                </div>
                <div class="row">
                
                <section class="col-main col-sm-7 wow  animated animated animated contact_wrap" style="visibility: visible;">
                    <div id="messages_product_view"></div>
                    <div class="row">
                    <div class="col-md-12 col-sm-12 col-md-12">

                        <!-- tabs left -->
                        <div class="tabbable tabs-left">
                        <div class="row">
                         <div class="col-sm-4 col-xs-4">
                            <ul class="nav nav-tabs">
                                
                                <li><a href="#payment" ><label >Payment <input type="radio" id="check_radio1" name="check_radio" class="radio_check" value="2"></label></a></li>
                                 <li><a href="#delivery" ><label>Delivery <input type="radio"  id="check_radio2" name="check_radio" class="radio_check" value="3"></label></a></li>
                                <li><a href="#product" ><label>Product <input type="radio"  id="check_radio3" name="check_radio" class="radio_check" value="4"></label></a></li>
                                <li><a href="#suggestion" ><label>Suggetion <input type="radio"  id="check_radio4" name="check_radio" class="radio_check" value="5"></label></a></li>
                                <li><a href="#cancellation" ><label>Order Cancellation <input type="radio"  id="check_radio5" name="check_radio" class="radio_check" value="6"></label></a></li>
                                <li><a href="#refund" ><label>Refund Request <input type="radio"  id="check_radio6" name="check_radio" class="radio_check" value="7"></label></a></li>
                                
                            </ul>
                            </div>
                         <div class="col-sm-6 col-xs-8">

                            <div class="tab-content">
                                
                                <div class="tab-pane active" id="payment">
                                    <form method="post" id="2" name="contactForm" class="contact-form clearfix">
                                        
                                        <div class="row">

                                            
                                            <div class="col-md-12 col-sm-12">
                                                <textarea class="form-control input-lg" id="comment" placeholder="Your message" name="comment" rows="3" disabled="disabled"></textarea>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <input type="text" id="order_id" name="order_id" placeholder="Your Order Id" class="form-control input-lg" disabled="disabled">
                                            </div>
											<div class="col-md-12 col-sm-12">
                                                <input type="text" id="name" name="name" placeholder="Your Name " class="form-control input-lg" disabled="disabled">
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <input type="email" id="email" name="email" placeholder="Your Email " class="form-control input-lg required-entry validate-email" disabled="disabled">
                                            </div>

                                            <div class="col-md-12 col-sm-12">
                                                <input type="text" id="telephone" name="telephone" placeholder="Your Phone " class="form-control input-lg" disabled="disabled">
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <textarea class="form-control input-lg"  id="address" placeholder="Your address" name="address" rows="3" disabled="disabled"></textarea>
                                            </div>
                                           
                                            <div class="col-md-12 col-sm-12">

                                                <button type="button" id="" name="submit" class="btn  btn-lg submit submitQuery" data-id="2">Send</button>
                                            </div>


                                        </div> <!-- /row -->
                                    </form>
                                </div>  <!-- /Payment Related -->
                                
                                

                            </div>
                            </div>
                            </div>                            
                        </div>
                        <!-- /tabs -->

                    </div>
                    </div>
                </section>
<aside class="sidebar col-sm-3 wow  animated animated animated" style="visibility: visible;">
                    <div class="wpb_text_column wpb_content_element ">
                        <div class="wpb_wrapper">
                         <?php  $addressContact =  callModelFunction('Site_model', 'getValue');
                            $setting  = json_decode(json_encode($addressContact), True);?>
                            <h4><?php echo $setting[19]['value']?></h4>
                            <p><?php echo $setting[1]['value']?><br>
                                </p>
                            <p>Phone Number: <?php
                                if($setting[2]['value']){
                                    echo $setting[2]['value']; }?> /&nbsp;<?php if($setting[16]['value']){ echo $setting[16]['value']; }?>/&nbsp;<?php if($setting[17]['value']){ echo $setting[17]['value']; }?>/&nbsp;<?php if($setting[18]['value']){ echo $setting[18]['value'];}?></p>

                        </div>
                    </div>
                </aside>
				</div>

            </div>

        </div><!--row-->
    </div><!--main-container-inner-->
	<?php $this->load->view('site/footer/news-latter-bar'); ?>
    <!--<div class="col-sm-14"><iframe style="border: 0px; pointer-events: none; background-color: #f7f7f7; padding: 5px; width: 100%;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.5563796132947!2d77.29451371508281!3d28.64305498241369!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfb5aa2d68e91%3A0x9cfbd208a251b10d!2sSagar+Complex%2C+Subash+Chandra+BoseMarg%2C+New+Rajdhani+Enclave%2C+Swasthya+Vihar%2C+New+Delhi%2C+Delhi+110092!5e0!3m2!1sen!2sin!4v1471346470562" width="600" height="450" frameborder="0" allowfullscreen=""></iframe></div> -->
</div>

