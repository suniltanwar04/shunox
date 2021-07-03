<div class="clearfix"></div>
<div class="dark-white" >
  <div class="center">
  <div class="main-container">
   <div class="por-contaner" >
    <div class="grid-25 pull-left">
    <div class="dashboard_main">
     <?php require_once('services/user-dashboard-menu.php'); ?>
    </div>
    </div>
    <!--Right bar-->
    <div class="grid-75 pull-right">
    <div class="user-details">
      <div class="col-md-3 col-sm-3 pull-left user-big-img">
          </div>
          <div class="col-md-9 col-sm-9 pull-right">
            <!-- main body -->
          <div class="personal-detail">
          <h3>Personal Information</h3>
          <label><span><i class="fa fa-user"></i> Name</span>: &nbsp;
          <?php echo $profile_datail->FullName; ?></label>
          <label><span><i class="fa fa-envelope-o"></i> Email</span>: &nbsp; <?php echo $profile_datail->Email; ?></label>
          <label><span><i class="fa fa-phone"></i> Phone</span>: &nbsp;
          <?php echo $profile_datail->Mobile; ?></label>

          
          <?php if(!empty($profile_datail->PinCode)): ?>
          <label><span><i class="fa fa-map-marker"></i> Pin No.</span>: &nbsp; <?php echo $profile_datail->PinCode; ?></label>
          <?php endif; ?>
          <?php if(!empty($profile_datail->Address)): ?>
          <label><span><i class="fa fa-map-marker"></i> Address </span>: &nbsp;
          <?php echo $profile_datail->Address; ?> </label>
          <?php endif; ?>
          <label><span>&nbsp;</span><a href="<?php echo base_url().'user/edit-profile' ?>"><i class="fa fa-pencil-square-o"></i> Edit Profile</a></label>
          </div>
          <!-- main body ends here -->
          </div>
    </div>
    </div>
    <!--Right bar ends here-->
      </div>
  </div>
</div>