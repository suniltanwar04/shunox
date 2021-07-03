<?php
    $current = $this->uri->segment(2);
    $active = "0";
    switch($current){
        case  "my-account":
        $active = 0;
        break;

        case  "my-orders":
        $active = 1;
        break;

        case  "change-password":
        $active = 2;
        break;
        
        case  "my-wishlist":
        $active = 3;
        break;
		
		case  "scanning-list":
        $active = 4;
        break;

    }
?>
   <div class="user-img">
    <?php
        $img_src;

        if($profile_datail->ProfileImage == ''){
          $img_src = base_url().'assets/site/images/user-img.jpg';
        }else{
			
			if(substr($profile_datail->ProfileImage, 0, 8) == 'https://')  {
				$img_src = $profile_datail->ProfileImage;
			} else {
		
			  $img_src = base_url().'assets/site/images/'.$profile_datail->ProfileImage;
			}
            
        }

    ?>
    <img src="<?php echo $img_src; ?>">
</div>
<h2><?php echo $profile_datail->FullName; ?></h2>
<div class="dashboard-menu">
<ul>
  <li><a class="<?php if($active == 0): echo 'active'; endif; ?>" href="<?php echo base_url().'user/edit-profile' ?>">
    <i class="fa fa-user"></i> Dashboard </a> </li>

<li><a class="<?php if($active == 1): echo 'active'; endif; ?>" href="<?php echo base_url().'user/my-orders' ?>"><i class="fa fa-user"></i> My Orders </a> </li>

<li><a class="<?php if($active == 2): echo 'active'; endif; ?>" href="<?php echo base_url().'user/change-password' ?>"><i class="fa fa-unlock-alt"></i> Change Password </a></li>
<!--<li><a class="<?php //if($active == 3): echo 'active'; endif; ?>" href="<?php //echo base_url().'user/my-wishlist' ?>"><i class="fa fa-user"></i> My Wishlist </a></li>-->
<!-- <li><a class="<?php if($active == 3): echo 'active'; endif; ?>" href="<?php echo base_url().'user/scanning' ?>"><i class="fa fa-user"></i> Print Scanning </a></li> -->

<li><a class="<?php if($active == 4): echo 'active'; endif; ?>" href="<?php echo base_url().'user/scanning-list' ?>"><i class="fa fa-user"></i> Scanning Report </a></li>
</ul>
</div>
