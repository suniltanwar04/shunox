<!-- <div class="modal fade" id="otp-modal" tabindex="-1" role="dialog" aria-labelledby="otp-modalLabel"
     aria-hidden="true" data-backdrop="static" data-keyboard="false">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header login_modal_header">
                <button type="button" class="close" data-dismiss="modal"
                        aria-hidden="true">&times;</button>
                <h2 class="modal-title" id="myModalLabel">Enter Your OTP to Complete Your Registration</h2>
            </div>
            <div class="modal-body login-modal">
                <br/>
                <div class="clearfix"></div>
                <form id="otpForm">
                    <div class="alert alert-danger text-center result" style="display:none;margin-bottom:5px;font-weight:bold;"
                         id="otpStatus">
                    </div>

                    <div class="form-group">
                        <input type="otp" id="otp" placeholder="ENTER YOUR OTP"
                               class="form-control login-field">
                        <i class="fa fa-lock login-field-icon"></i>
                        <span id="otpError" style="color: red;"></span>
                    </div>
                    <button style="cursor: pointer;" class="btn btn-success modal-login-btn"
                       id="completeregisteration">Submit</button>

                </form>

            </div>
            <div class="clearfix"></div>
            <div class="modal-footer login_modal_footer">
            </div>
        </div>
    </div>
</div> -->
<div id="otpFormWrapper">
  <div class="row">
    <div class="col-lg-6 col-lg-offset-3">
      <h3>Enter your OTP to complete the Registration.</h3>
      <form id="otpForm" class="form-horizontal">
        <div id="otpStatus" style="font-weight:bold"></div>
          <div class="form-group">
              <input type="text" id="otp" placeholder="ENTER YOUR OTP"
                     class="form-control login-field">
              <i class="fa fa-lock login-field-icon"></i>
          </div>
          <button style="cursor: pointer;" class="btn btn-success modal-login-btn"
             id="completeregisteration">Submit</button>
      </form>
    </div>
  </div>
</div>
