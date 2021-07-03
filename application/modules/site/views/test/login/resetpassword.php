<div id="loader">
    <img src="<?php echo base_url().'assets/site/images/loader.gif'; ?>" alt="">
</div>
<div class="container main-container" >

  <div class="signin-wrap" >
    <h1 class="top_heading">Reset Password</h1>
    <div class="row">
      
      <div class="col-sm-6">
                 
          
          <form id="signin-form"  method="post">
           <span id="errorDisplay" style="color: red;margin-left: 118px;font-size:14px;"></span>
           <span id="successDisplay" style="color: green;margin-left: 118px;font-size:14px;"></span>
            <input type="hidden" name="token" id="token" class="form-control" value="<?php echo $token?>"/>
            <div class="row">
              <div class="col-sm-12">
                <label>New Password<span>*</span></label>
                <div class="form-group">
                  <input type="password" name="newPassword" id="newPassword" class="form-control" style="max-width:none"/>
                    
                </div>

              </div>
              <div class="col-sm-12">
                <label class="mr-45">Confirm Password <span>*</span></label>
                <div class="form-group">
                  <input type="password" name="confirmPassword"  id="confirmPassword"  class="form-control"  value="" style="max-width:none"/>
                   
                </div>
              </div>
              <div class="col-sm-12">
				   <input type="button" value="Reset Password" id="resetBtn" class="login_btn" style="float: right;
    margin-right: 20px;padding: 7px 20px;"/>
               
              </div>
              
            </div>
          </form>
        </div>
      
    </div>
    
  </div>
  
  
  
</div>



