<div class="top-bar animate-dropdown">
    <div class="container">
        <div class="header-top-inner">
            <div class="cnt-account">
                <ul class="list-unstyled">
                <?php if($this->session->userdata("Id")){ ?>
                    <li><a href="<?php echo base_url().'user/edit-profile' ?>" title="My Account">My Account&nbsp;&nbsp;</a></li>
                    <li class="last"><a href="<?php echo base_url('logout'); ?>">Logout</a></li>
                <?php } else {?>
                    <li><a  style="cursor: pointer;"  href="<?php echo base_url().'login' ?>" title="Login"><i class="icon fa fa-sign-in"></i>Login &nbsp;&nbsp;/</a></li>
                    <li><a  style="cursor: pointer;" href="<?php echo base_url().'create-account' ?>" title="Create"><i class="icon fa fa-user"></i> Not a customer ? Signup &nbsp;&nbsp;/ </a></li>
                <?php }?>
                    <li><a href="mailto:helpglobusnexgen@gmail.com"><i class="icon fa fa-envelope"></i>helpglobusnexgen@gmail.com</a></li> 
                    <!-- <li><a href="mailto:support@shoemade4u.com"><i class="icon fa fa-envelope"></i>support@shoemade4u.com</a></li> -->
                </ul>
            </div>
            <!-- /.cnt-account -->

            <div class="cnt-block cnt-account">
                <ul class="list-unstyled">
                    
                    
                    <?php /* if($this->session->userdata("Id")){?>
                    <li><a href="<?php echo base_url()?>user/my-wishlist">My Wish List</a></li>
                    <?php }else{?>
					<li><a  style="cursor: pointer;" href="<?php echo base_url().'login' ?>" title="Login">My Wish List</a></li>
					<?php }*/?>
                    
                </ul>
                <!-- /.list-unstyled -->
            </div>
            <!-- /.cnt-cart -->
            <div class="clearfix"></div>
        </div>
        <!-- /.header-top-inner -->
    </div>

    <!-- /.container -->
</div>
<!-- /.header-top -->
