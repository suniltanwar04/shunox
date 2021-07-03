<div class="clearfix"></div>
<div class="dark-white" >
  <div class="center">
  <div class="main-container">
   <div class="por-contaner">
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
  			  <h3>Change Password</h3>
  			  <label><p>Old Password</p> &nbsp;  <input type="password" id="old_password"  placeholder="Old Password" ><i class="fa fa-pencil"></i></label>
  			  <label><p>New Password</p> &nbsp;  <input type="password" id="new_password"  placeholder="New Password"><i class="fa fa-pencil"></i></label>
  			  <label><p>Confirm Password</p> &nbsp;  <input type="password" id="cnf_new_password" placeholder="Confirm Password"><i class="fa fa-pencil"></i></label>
  			  <label style="color:#ff0000;font-weight:bold;text-align:center" id="update_password_error"></label>
  			  <label><p>&nbsp;</p><button class="btn btn-block" id="update_password"><i class="fa fa-key">&nbsp; </i> Update Password</button></label>
  			  </div>
          <!-- main body ends here -->
          </div>
    </div>
    </div>
    <!--Right bar ends here-->
      </div>
  </div>
</div>
</div>
