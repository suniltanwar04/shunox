<div id="loader">
    <img src="<?php echo base_url().'assets/site/images/loader.gif'; ?>" alt="">
</div>
<div class="container main-container" >

  <div class="signin-wrap" >
    <h1 class="top_heading">SIGN IN / CREATE AN ACCOUNT</h1>
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <div class="right-sec">
          <h2>ALREADY REGISTERED?</h2>
          <p>If you have an account with us, please log in.</p>
          <form id="signin-form"  method="post">
            <div class="row">
              <div class="col-sm-12">
                <label>Email Address <span>*</span></label>
                <div class="form-group">
                  <input type="text" name="userName" id="userName" class="form-control"/>
                    <span id="userNameError" style="color: red;margin-left: 118px;font-size:14px;"></span>
                </div>

              </div>
              <div class="col-sm-12">
                <label class="mr-45">Password <span>*</span></label>
                <div class="form-group">
                  <input type="password" name="loginPass"  id="loginPass"  class="form-control"  value=""/>
                    <span id="loginPassError" style="color: red;margin-left: 118px;font-size:14px;"></span>
                </div>
              </div>
              <div class="col-sm-6">
				   <input type="button" value="Login" id="loginBtn" class="login_btn" style="float: right;
              margin-right: 20px;padding: 7px 20px;"/>
               
              </div>
              <div class="col-sm-6">
                <p class="required_feild"><a href="#">* required fields</a></p>
                <p class="forgot_pass"><a href="#"  data-target="#forgotPassword" data-toggle="modal">Forgot Your Password?</a></p>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-sm-3"></div>
    </div>
    <!-- <div class="row">
      <div class="col-sm-12">
        <div class="social_login">
          <h1>LOGIN & CHECKOUT WITH FACEBOOK</h1>
          <a  href="<?php //echo $facebookLoginUrl;?>"   class="facebook_login">Login With Facebook</a>
          <p>Checkout quickly and easily by signing in to your Facebook account.</p>
        </div>
      </div>
    </div> -->
  </div>
  <?php $this->load->view('forgotpassword');?>
</div>



