<style>
    input[type="checkbox"] {
         display: block;
    }
    </style>
<div id="loader">
    <img src="<?php echo base_url().'assets/site/images/loader.gif'; ?>" alt="">
</div>
<div class="col-sm-2">
</div>
<div class="container  main-container col-sm-8">
  <div class="signin-wrap">
    <h1 class="top_heading">CREATE AN ACCOUNT</h1>
      <span id="error" style="color: red;font-size:14px;"></span>
    <div class="row">

      <div class="col-sm-12">
        <div class="right-sec">
          <h2>PERSONAL INFORMATION</h2>

          <form id="create-ac-form" action="" method="post">
            <div class="row">
              <div class="col-sm-4">
                <label>First Name <span>*</span></label>
                <div class="form-group">
                  <input type="text" name="fullName" id="fullName" class="form-control"  />

                </div>
              </div>
              <div class="col-sm-4">
                <label>Last Name <span>*</span></label>
                <div class="form-group">
                  <input type="text" name="lastName" id="lastName" class="form-control"  />

                </div>
              </div>
                </div>
                <div class="row">
              <div class="col-sm-4">
                <label>Email Address <span>*</span></label>
                <div class="form-group">
                  <input type="email" name="emailId" id="emailId" class="form-control"  />

                </div>
              </div>
                <div class="col-sm-4">
                    <label>Mobile Number <span>*</span></label>
                    <div class="form-group">
                        <input type="text" name="mobile" id="mobile" class="form-control"  />

                    </div>
                </div>
              <div class="col-sm-12">
                <div class="news_check"><span style="float: right; margin-right: -1px; padding-left: 12px;">Sign Up for Newsletter</span><input type="checkbox" name="newsletter" id="newsletter" value="1"/></div>
              </div>
              <div class="col-sm-4 clear-both">
                <label>Password <span>*</span></label>
                <div class="form-group">
                  <input type="password" name="password" id="password" class="form-control"  />

                </div>
                </div>
                <div class="col-sm-4">
                <label>Confirm Password <span>*</span></label>
                <div class="form-group">
                  <input type="password" name="confirmPass" id="confirmPass" class="form-control"  />

                </div>
                </div>
                <div class="col-sm-12">
                 <div class="g-recaptcha" data-theme="light" data-sitekey="XXXXXXXXXXXXX" style="transform:scale(0.77);-webkit-transform:scale(0.77);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>
                </div>
              <div class="col-sm-6">
             <div class="back_btn_wrap">
               <a href="<?php echo base_url()?>login" class="back-btn"><span><<</span> Back</a>
               </div>
                 <div class="submit_btn">
                <input type="button" value="SUBMIT" class="login_btn" id="registerBtn" />
                <span>* Required Fields</span>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div>
    <div class="row">
      <div class="col-sm-6">
        <div class="social_login">
          <h1>LOGIN & CHECKOUT WITH FACEBOOK</h1>
            <a  href="<?php echo $facebookLoginUrl;?>"   class="facebook_login">Login With Facebook</a>
          <p>Checkout quickly and easily by signing in to your Facebook account.</p>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="col-sm-2">
</div>

