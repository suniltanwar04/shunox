<style>
    .personal-detail label select {
        border: none;
        border-bottom: 1px solid #eee !important;
        padding: 0;
        margin-top: -15px;
        font-size: 15px;
        color: #666;
        width: 40%;
        font-family: "Open Sans", sans-serif;
        height: 35px;
    }

    .personal-detail label input[type="date"] {
        border: none;
        border-bottom: 1px solid #eee !important;
        padding: 0;
        margin-top: -15px;
        font-size: 15px;
        color: #666;
        width: 40%;
        font-family: "Open Sans", sans-serif;
        height: 35px;
    }
    #ui-datepicker-div{
    width:28%;
    }
</style>
<div class="clearfix"></div>
<div class="dark-white" >
  <div class="center">
  <div class="main-container" id="hedt">
   <div class="por-contaner">
    <div class="grid-25 pull-left">
    <div class="dashboard_main">
     <?php require_once('services/user-dashboard-menu.php'); 
				//echo "<pre>"; print_r($profile_datail);?>
    </div>
    </div>
    <!--Right bar-->
    <div class="grid-75 pull-right">
    <div class="user-details">
      <form action="#" method="post" enctype="multipart/form-data" id="user_profile_update">
          <div class="col-md-2 col-sm-2 pull-left user-big-img">
           <?php
                $img_src;
                if($profile_datail->ProfileImage != null){
                    $img_src = base_url().'assets/site/images/'.$profile_datail->ProfileImage;
                }else{
                    $img_src = base_url().'assets/site/images/user-img.jpg';
                }

            ?>
          <img src="<?php echo $img_src; ?>">
          <br>
           <label><input style="visibility:hidden" type="file" id="upload_picture" name="profile_pic"><span><i class="fa fa-camera"></i>  Upload</span></label>
          </div>

          <div class="col-md-5 col-sm-5">
			  <div class="personal-detail">
				  <h3>Personal Information</h3>
				  <input type="hidden" name="base_url" value="<?php echo base_url(); ?>" id="base_url">
				  <label>
					<span><i class="fa fa-user-circle-o"></i>Title</span> &nbsp;
					<select id="title" name="title">
						<option value="">Select Title</option>
						<option value="Mr." <?php if($profile_datail->Title == 'Mr.'){echo 'selected';}?>>Mr.</option>
						<option value="Mrs." <?php if($profile_datail->Title == 'Mrs.'){echo 'selected';}?>>Mrs.</option>
						<option value="Miss" <?php if($profile_datail->Title == 'Ms.'){echo 'selected';}?>>Ms.</option>
					</select>
					  &nbsp;<i class="text-danger" id="usertitleError" style="margin-left:100px;"></i>
				  </label>
				  <label><span><i class="fa fa-user"></i>Last Name</span> &nbsp;<input type="text" name="lastname" value="<?php echo $profile_datail->LastName; ?>" id="lastname">
					  &nbsp;<i class="text-danger" id="userNameError" style="margin-left:100px;"></i>
				  </label>
			  </div>
		</div>
      
      <div class="col-md-5 col-sm-5">
          <div class="personal-detail frstnme mmt-0">
          <h3 class="mobnone">&nbsp;&nbsp;</h3>
          <label><span><i class="fa fa-user"></i>First Name</span> &nbsp;<input type="text" name="name" value="<?php echo $profile_datail->FullName; ?>" id="userName">
           &nbsp;<i class="text-danger" id="userNameError" style="margin-left:100px;"></i>
          </label>
           <label><span><i class="fa fa-phone"></i> Mobile</span> &nbsp;  <input type="text" name="phone" value="<?php echo $profile_datail->Mobile; ?>" id="userMobile">
           &nbsp;<i class="text-danger" id="userMobileError" style="margin-left:100px;"></i>
          </label>
        </div>
        </div>
        
        <div class="col-md-10 col-sm-10 pull-right" style="margin-top:-40px;">
			<div class="personal-detail">
          <label><span><i class="fa fa-envelope-o"></i> Email</span> &nbsp; <input type="text" name="email" value="<?php echo $profile_datail->Email; ?>" id="userEmail">
           &nbsp;<i class="text-danger" id="userEmailError" style="margin-left:100px;"></i>
          </label>
           
          </div>
        </div>
        
        <div class="col-md-5 col-sm-5 mml-0" style="margin-top:-22px;margin-left: 138px;">
          <div class="personal-detail mmt-0">
          <label><span><i class="fa fa-phone"></i> Landline Phone</span> &nbsp;  <input type="text" name="landline" value="<?php echo $profile_datail->Landline; ?>" id="landline">
              &nbsp;<i class="text-danger" id="userMobileError" style="margin-left:100px;"></i>
          </label>
         
          <label><span><i class="fa fa-building-o"></i> Company Name</span> &nbsp;  <input type="text" name="com_name" value="<?php echo $profile_datail->CompanyName; ?>" id="com_name">
                  &nbsp;<i class="text-danger" id="userCompanyError" style="margin-left:100px;"></i>
              </label>
              <label><span><i class="fa fa-map-marker"></i> State </span> &nbsp;  
            <select id="state" name="state">
            <?php foreach($states as $state){?>
            <option value="<?php echo $state->id?>"  <?php if($profile_datail->State ==  $state->id){echo 'selected';}?>><?php echo $state->name?></option>
             <?php }?>
            </select>
           &nbsp;<i class="text-danger" id="userStateError" style="margin-left:100px;"></i>
           </label>
           <label><span><i class="fa fa-map-marker"></i> Pin Code </span> &nbsp;  <input type="text" name="pinCode" maxlength="6" value="<?php  echo $profile_datail->Pincode; ?>" id="userPinCode">
           &nbsp;<i class="text-danger" id="userPinCodeError" style="margin-left:100px;"></i>
           </label>
      </div>
      </div>
      
      <div class="col-md-5 col-sm-5 pull-right mtt-20" style="margin-top:-22px;">
          <div class="personal-detail">
          <label><span><i class="fa fa-calendar"></i> Date of Birth</span> &nbsp;  <input type="text" name="dob" value="<?php echo date("d/m/Y", strtotime($profile_datail->DOB)); ?>" id="dob">
                  &nbsp;<i class="text-danger" id="userDobError" style="margin-left:100px;"></i>
              </label>
           <label><span><i class="fa fa-map-marker"></i> Country </span> &nbsp; 
               <select id="country" name="country">
                  <option value="">Select Country</option>
                  <?php foreach($countries as $country){?>
                  <option value="<?php echo $country->id?>" <?php if($profile_datail->Country ==  $country->id){echo 'selected';}?>><?php echo $country->name?></option>
                  <?php }?>
                  
              </select>
                  &nbsp;<i class="text-danger" id="userCountryError" style="margin-left:100px;"></i>
              </label>
              <label><span><i class="fa fa-map-marker"></i> City </span> &nbsp;   
           <select id="city" name="city">
          	<?php foreach($cities as $city){?>
            <option value="<?php echo $city->id?>"  <?php if($profile_datail->City ==  $city->id){echo 'selected';}?>><?php echo $city->name?></option>
             <?php }?>
            </select>
           &nbsp;<i class="text-danger" id="userCityError" style="margin-left:100px;"></i>
           </label>
          

              <label><span><i class="fa fa-map-marker"></i>Landmark</span> &nbsp;  <input type="text" name="landmark"  value="<?php  echo $profile_datail->Landmark; ?>" id="landmark">
                  &nbsp;
              </label>
        </div>
        </div>
        <div class="col-md-10 col-sm-10 pull-right" style="margin-top:-40px;">
			<div class="personal-detail">
        <label><span> <i class="fa fa-map-marker"></i>Current Address </span> &nbsp; <textarea name="address" id="userAddress"><?php echo $profile_datail->Address; ?></textarea>
              &nbsp;<i class="text-danger" id="userAddressError" style="margin-left:100px;"></i> </label>
        <label><span> <i class="fa fa-map-marker"></i> Other  Address</span> &nbsp; <textarea name="otheradd" id="otheradd"><?php echo $profile_datail->OtherAddress; ?></textarea> </label>
          <label style="color:#ff0000;font-weight:bold;text-align:center" id="update_profile_error"></label>
          <label><span>&nbsp;</span><button class="btn btn-block" id="update_user_profile">Update Profile</button></label>
          </div>
          </div>
        
        </form>
    </div>
    </div>
    <!--Right bar ends here-->
      </div>
  </div>
</div>
</div>
