<script src="<?php echo base_url(); ?>assets/admin/js/formwizard.js"></script>

<div class="container" id="formwizard">
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#VerifyEmail-step" type="button" class="btn btn-success btn-circle" disabled="disabled">
                    <span class="glyphicon glyphicon-envelope"></span>
                </a>
                <p>Verify Email</p>
            </div>
            <div class="stepwizard-step">
                <a href="#ProfileSetup-step" type="button" class="btn btn-primary btn-circle" id="ProfileSetup-step-2">
                    <span class="glyphicon glyphicon-user"></span>
                </a>
                <p>Profile Setup</p>
            </div>
            <div class="stepwizard-step">
                <a href="#Security-Setup-step" type="button"  class="btn btn-success-2 btn-circle"  disabled="disabled" id="Security-Setup-step-3">
                    <span class="glyphicon glyphicon-ok"></span>
                </a>
                <p>Security Setup</p>
            </div>
        </div>
    </div>
    <form role="form">
        <div class="row setup-content" id="VerifyEmail-step">
            <div class="col-xs-12">
                <div class="col-md-12">
                    <br/>
                    <div class="form-horizontal">
                        <form  role="form">
                            <fieldset>
                                <legend>Enter Your Email Information</legend>
                                <br/>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="card-holder-name">Your Email</label>
                                    <div class="col-sm-9">
                                        <input  maxlength="100" type="email" required="required" class="form-control" placeholder="Enter Email"  />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="card-number">Password</label>
                                    <div class="col-sm-9">
                                        <input  maxlength="100" type="password" required="required" class="form-control" placeholder="Enter Password"  />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="card-number">Re-enter Password</label>
                                    <div class="col-sm-9">
                                        <input  maxlength="100" type="password" required="required" class="form-control" placeholder="Enter Password"  />
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Setup Profile</button>
                </div>
            </div>
        </div>
        <div class="row setup-content" id="ProfileSetup-step">
            <div class="col-xs-12">
                <div class="col-md-12">
                    <br/>
                    <div class="form-horizontal">
                        <form  role="form">
                            <fieldset>

                                <legend>Enter Your Profile Information</legend>
                                <br/>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="card-holder-name">Your Email</label>
                                    <div class="col-sm-9">
                                        <input  maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Email"  />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="card-number">Name</label>
                                    <div class="col-sm-9">
                                        <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Name" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="card-number">Primary Phone Number</label>
                                    <div class="col-sm-9">
                                        <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Primary Phone Number" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="card-number">Address</label>
                                    <div class="col-sm-9">
                                        <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Address" />
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label" for="card-number">City</label>
                                        <div class="col-sm-6" style="padding-left:8px">
                                            <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter City" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="col-sm-6 control-label" for="card-number">State/Province</label>
                                        <div class="col-sm-6" style="padding:0px">
                                            <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter State/Province" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="card-number">Country</label>
                                    <div class="col-sm-9">
                                        <select required="required" class="form-control" >
                                            <option value="0">Select Country</option>
                                            <option value="pakistan">Pakistan</option>
                                            <option value="usa">USA</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Setup Profile</button>
                </div>
            </div>
        </div>
        <div class="row setup-content" id="Security-Setup-step">
            <div class="col-xs-12">
                <div class="col-md-12">
                    <b>Thanks you  <stong>Muneeb Ashraf</stong></b>
                    <p>We are almost done, please enter the following information so we can recover your account in case you ever forget your password.</p>

                    <div class="form-horizontal">
                        <form  role="form">
                            <fieldset>
                                <br/>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="card-holder-name">Security Question 1:</label>
                                    <div class="col-sm-9">
                                        <select required="required" class="form-control" >
                                            <option value="0">Select Country</option>
                                            <option value="pakistan">Pakistan</option>
                                            <option value="usa">USA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="card-number">Your Answer:</label>
                                    <div class="col-sm-9">
                                        <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Name" />
                                    </div>
                                </div>
                                <br/>
                                <hr>
                                <br/>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="card-holder-name">Security Question 2:</label>
                                    <div class="col-sm-9">
                                        <select required="required" class="form-control" >
                                            <option value="0">Select Country</option>
                                            <option value="pakistan">Pakistan</option>
                                            <option value="usa">USA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="card-number">Your Answer:</label>
                                    <div class="col-sm-9">
                                        <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Name" />
                                    </div>
                                </div>
                                <br/>
                                <hr>
                                <br/>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="card-holder-name">Security Question 3:</label>
                                    <div class="col-sm-9">
                                        <select required="required" class="form-control" >
                                            <option value="0">Select Country</option>
                                            <option value="pakistan">Pakistan</option>
                                            <option value="usa">USA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="card-number">Your Answer:</label>
                                    <div class="col-sm-9">
                                        <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Name" />
                                    </div>
                                </div>
                                <br/>
                                <hr>
                                <br/>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="card-number">Recover cellphone Number:</label>
                                    <div class="col-sm-9">
                                        <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Cellphone Number" />
                                        <p>Optional: We may send you a recovery code on this phone number if you are ever unable to lgoin to your account.</p>
                                    </div>

                                </div>
                            </fieldset>
                        </form>
                    </div>
                    <!--h3> You are all set!</h3>
                    <p>Welcome to MetroPago. We are glade to have you here.</p-->
                    <button class="btn btn-primary btn-lg pull-right nextBtn" type="submit">Complete Registration</button>
                </div>
            </div>
        </div>
    </form>
</div>