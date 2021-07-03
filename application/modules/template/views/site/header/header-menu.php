<?php

    $CI =& get_instance();
    $CI->load->model(array('SiteCart_model'));
	if($this->session->userdata("Id")){ 
		$userId = $this->session->userdata("Id");
		$userName = $CI->SiteCart_model->getUserName($userId)->name;
	}
 ?>
 <style>


.dropdowns {
    position: relative;
    display: inline-block;
}

#sub-cat {
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1000;
}

#sub-cat a {
    text-decoration: none;
    display: block;
}


.dropdowns:hover #sub-cat {
    display: block;
}

.dropdowns:hover .dropbtn {
    background-color: #3e8e41;
}
.basket {
    margin-top: 15px;
}
.cnt-account {
    float: right;
    padding-top: 25px;
}

.cnt-account .list-unstyled {
    display: flex;
}

.cnt-account .list-unstyled li {
    padding-left: 10px;
}
</style>
<div class="main-header">
    <div class="container-fluid">
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                <div class="logo" style="text-align:center;">
					<a href="<?php echo base_url(); ?>"> 
						<img src="<?php echo base_url(); ?>assets/site/images/logo.png" alt="" style="width: 100%;max-width: 250px;">
					</a>
					<div class="mshow dhide mobileburger">
						<?php if($this->session->userdata("Id")){ 
							
						?>
							<a href="<?php echo base_url().'user/edit-profile' ?>" title="My Account"><?php echo $userName; ?></a>
							<a href="<?php echo base_url('logout'); ?>">Logout</a>
						<?php } else {?>
							<a  style="cursor: pointer;"  href="<?php echo base_url().'login' ?>" title="Login"><i class="icon fa fa-sign-in"></i>Login</a>
							<!-- <a  style="cursor: pointer;" href="<?php echo base_url().'create-account' ?>" title="Create"><i class="icon fa fa-user"></i>Signup</a> -->
						<?php }?>
					</div>
				</div>
				
			</div>

            <div class="col-md-9">
                <div class="cart_Holder animate-dropdown top-cart-row pull-right">
                    <div class="dropdown dropdown-cart">
                      <!--<a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown"></a>-->
                            <div class="items-cart-inner">                              
                                
                                <div class="basket">
                                     <?php
                                    $userId = '';
                                    if($this->session->userdata("Id")){
                                        $userId = $this->session->userdata("Id");
                                    }
                                    if($this->session->userdata("GuestUser")){
                                        $userId = $this->session->userdata("GuestUser");
                                    }
                              
                                    if($this->session->userdata("Id")) {
                                        ?>
                                        <a href="<?php echo base_url('cart'); ?>">
                                        <?php
                                    } else {
                                        ?>
                                        <a  style="cursor: pointer;text-decoration: none;"  href="<?php echo base_url().'login' ?>"  title="Login">
                                        <?php
                                    }
                                        $cartCount = $CI->SiteCart_model->getCartCount($userId);
                                   
                                        
                                         if($cartCount->ProductCount > 0){
                                             
                                    ?>
                                        <span id="bucketCartCount"> <?php echo $cartCount->ProductCount; ?> </span>
                                        <img src="<?php echo base_url(); ?>assets/site/images/cart.png">
                                        </a>
                                    <?php } else {  
                                       
                                    
                                        ?>
                                        
									<span id="bucketCartCount">0</span>
                                        <img src="<?php echo base_url(); ?>assets/site/images/cart.png">
                                        </a>
                                         <?php } ?>
                                </div>
                               
                            </div>
                        </div>
                </div>

                <!-- <div class="col-xs-9 col-sm-9 col-md-3 pull-right">
                     <form id="itemSearchForm">
                    <div class="search-area">
                        <input class="search-area_input" type="text" placeholder="Search here" id="searchedKey">
                        <button class="search-area_button" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
                     </form>
                </div> -->
				<div class="cnt-account cart_Holder animate-dropdown top-cart-row pull-right mhide">
					<ul class="list-unstyled">
					<?php if($this->session->userdata("Id")){?>
						<li><a href="<?php echo base_url().'user/edit-profile' ?>" title="My Account"><?php echo $userName; ?></a></li>
						<li class="last"><a href="<?php echo base_url('logout'); ?>">Logout</a></li>
					<?php } else {?>
						<li><a  style="cursor: pointer;"  href="<?php echo base_url().'login' ?>" title="Login"><i class="icon fa fa-sign-in"></i>Login</a></li>
						<!-- <li><a  style="cursor: pointer;" href="<?php echo base_url().'create-account' ?>" title="Create"><i class="icon fa fa-user"></i>Signup</a></li> -->
					<?php }?>
					</ul>
				</div>

                <div class="clearfix mhide" ></div>

                <!-- ============================================== NAVBAR ============================================== -->
                <div class="header-nav animate-dropdown">
                    <div class="container">
                        <div class="yamm navbar navbar-default" role="navigation">
                            <div class="navbar-header">
                                <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse"
                                        class="navbar-toggle collapsed hcstmmbtn" type="button"><span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span> <span class="icon-bar"></span> <span
                                        class="icon-bar"></span></button>
                            </div>
                            <div class="nav-bg-class">
                                <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                                    <div class="nav-outer">
                                        <ul class="nav navbar-nav">
                                            <li class="active dropdown yamm-fw"><a href="<?php echo base_url()?>"
                                                                                   data-hover="dropdown"
                                                                                   class="dropdown-toggle">Home</a>
                                            </li>
                                            <li class="dropdown yamm"><a href="#" data-hover="dropdown" class="dropdown-toggle">Foot Health</a>
                                                <ul class="dropdown-menu pages">
                                                    <li>
                                                        <div class="yamm-content">
                                                            <div class="row">
                                                                <div class="col-xs-12 col-menu">
                                                                    <ul class="links">
                                                                        <li><a href="<?php echo base_url()?>foot-health">About Human Foot</a></li>
                                                                        <li><a href="<?php echo base_url()?>shoe-essentials">Shoe Essentials </a></li>
                                                                        <!-- <li><a href="<?php echo base_url()?>anti-bacterial-socks"> Anti Bacterial Socks</a>
                                                                        </li> -->
                                                                        <li><a href="<?php echo base_url()?>foot-size-guide"> Foot Size Guide</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="dropdown"><a href="#" data-hover="dropdown"
                                                                    class="dropdown-toggle">Foot Scanning</a>
                                                <ul class="dropdown-menu pages">
                                                    <li>
                                                        <div class="yamm-content">
                                                            <div class="row">
                                                                <div class="col-xs-12 col-menu">
                                                                    <ul class="links">
                                                                        <li><a href="<?php echo base_url()?>scanner-technology">Scanning Technology</a></li>
                                                                        <li><a href="<?php echo base_url()?>scanning-locator">Scanning locations</a></li>
																		<li><a href="<?php echo base_url()?>our-doctors">Our Doctors</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="dropdown"><a href="#" data-hover="dropdown"
                                                                    class="dropdown-toggle">Purchase</a>
                                                <ul class="dropdown-menu pages">
                                                    <li>
                                                        <div class="yamm-content">
                                                            <div class="row">
                                                                <div class="col-xs-12 col-menu">
                                                                    <ul class="links">
                                                                        <li><a href="<?php echo base_url()?>how-to-purchase" >How to Purchase </a></li>
                                                                       			
																			
                                                                        <li class="dropdowns" id=""><a href="/sub-category/regular/10"  data-hover="dropdown" class="dropdown-toggle">Our Products</a>
                                                                       																	<?php 
																			//$subCategories =  $CI->Template_model->getSubCategoryById(1);
																			//if($subCategories > 0){?>
																				<!-- <ul class="dropdown-menu pages " id="sub-cat">
																					<li>
																						<div class="yamm-content">
																							<div class="row">
																								<div class="col-xs-12 col-menu">
																									<ul class="links">
																										<?php /*foreach($subCategories as $subCategory){?>
																											<li ><a href="<?php echo base_url()?>sub-category/<?php echo $subCategory->UrlSlug?>/<?php echo $subCategory->Id?>" ><?php echo $subCategory->SubCategoryName */?></a></li>
																								
																										<?php //}?>  
																									</ul>
																								</div>
																							</div>
																						</div>
																					</li>
																				</ul> -->
																			<?php //}?>
																			</li>			
                                                                       
                                                                       <!--  <li><a href="<?php //echo base_url()?>category/anti-bacterial-socks/2" >Anti Bacterial Socks </a></li> -->
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
											<li class="dropdown"><a href="#" data-hover="dropdown" class="dropdown-toggle">Customer Service</a>
                                                <ul class="dropdown-menu pages">
                                                    <li>
                                                        <div class="yamm-content">
                                                            <div class="row">
                                                                <div class="col-xs-12 col-menu">
                                                                    <ul class="links">
                                                                        <li><a href="<?php echo base_url()?>contact-us">Contact Us</a></li>
                                                                        <li><a href="<?php echo base_url()?>track-your-order">Track your Order</a></li>
                                                                        <li><a href="<?php echo base_url()?>faq">FAQs</a></li>
                                                                        <li><a href="<?php echo base_url()?>warranty">Warranty</a></li>
                                                                        <li><a href="<?php echo base_url()?>privacy-policy">Privacy Policy</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="dropdown"><a href="<?php echo base_url()?>become-a-dealer"" data-hover="dropdown" class="dropdown-toggle">Dealership</a>
                                                <!--<ul class="dropdown-menu pages">
                                                    <li>
                                                        <div class="yamm-content">
                                                            <div class="row">
                                                                <div class="col-xs-12 col-menu">
                                                                    <ul class="links">
                                                                        <li><a href="<?php //echo base_url()?>become-a-dealer">Become a Dealer</a></li>
                                                                        
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul> -->
                                            </li>
                                            
                                            <li class="dropdown"><a href="#" data-hover="dropdown"
                                                                    class="dropdown-toggle">Support</a>
                                                <ul class="dropdown-menu pages">
                                                    <li>
                                                        <div class="yamm-content">
                                                            <div class="row">
                                                                <div class="col-xs-12 col-menu">
                                                                    <ul class="links">
                                                                        <li><a href="<?php echo base_url()?>download-software">Download Software </a></li>
                                                                        <li><a href="<?php echo base_url()?>installation-support">Installation Support </a>
                                                                        </li>
                                                                        <li><a href="<?php echo base_url()?>operate-scanner">Operate Scanner </a>
                                                                        <li><a href="<?php echo base_url()?>technical-faq">Technical FAQ's </a></li>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
											<li class="dropdown"><a href="#" data-hover="dropdown"
                                                                    class="dropdown-toggle">About Us</a>
                                                <ul class="dropdown-menu pages">
                                                    <li>
                                                        <div class="yamm-content">
                                                            <div class="row">
                                                                <div class="col-xs-12 col-menu">
                                                                    <ul class="links">
																		<li><a href="<?php echo base_url()?>catalogue" title="Catalogue">Catalogue </a></li>
                                                                        <li><a href="<?php echo base_url()?>video" title="Video's">Videos</a></li>
																		<li><a href="<?php echo base_url()?>press-room" title="Press Room">Press Release</a></li>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.header-nav -->
        </div>
    </div>
    <!-- ============================================== NAVBAR : END ============================================== -->


</div>
