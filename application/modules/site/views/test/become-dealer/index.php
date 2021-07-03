<style>
/*.group-select li input.input-text, .group-select li textarea{
        background: white;
 }*/
 .group-select li .input-box input.input-text, .group-select li .input-box textarea,  .group-select li input.input-text, .group-select li textarea {
	background: rgba(240, 240, 240, 0.31);
	border-color: #ccc;
}

#becomeForm select {
    width: 100%;
    height: 30px;
    margin: 5px 0;
    background: rgba(240, 240, 240, 0.31);
    border-color: #ccc;
    padding: 4px;
}
.col-md-9{
width : 70% !important;
}
</style>
<div class="main-container col2-right-layout">
  <div class="main container">
    <div class="row">
        <div class="col-md-1 about-con">
            </div>
      <div class="col-md-10 about-con">
        <h2> Become A Dealer </h2>
        <hr>
        <div class="clearfix"></div>
        <div class="alert alert-danger text-center" id="response" style="display:none;    "></div>
        <div class="alert alert-success text-center" id="response" style="display:none; font-size: 20px;"> </div>
        <section class="col-main col-sm-12 wow  animated animated animated" style="visibility: visible;">
          <div id="messages_product_view"></div>
          <form action="" id="becomeForm" method="post">
          <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url()?>" / > 
            <div class="static-contain" style="border-color: #999999">
              <fieldset class="group-select">
                <fieldset class="">
                  <div class="customer-name">
                    <div class="row">
                      <div class="col-sm-3">
                          <label for="name">First Name <em class="required">*</em></label>
                          <input type="text" name="name" id="name" title="Name"  class="input-text required-entry"  placeholder="First Name" />                        
                      </div>
                      <div class="col-sm-3">
                          <label for="lname">Last Name <em class="required">*</em></label>
                          <input type="text" name="lname" id="lname" title="lname"  class="input-text " placeholder="Last Name" / >                       
                      </div>
                      <div class="col-sm-5" style="width:46%">
                          <label for="email">Email <em class="required">*</em></label>
                          <input name="email" id="email" title="Email"  class="input-text required-entry validate-email" type="email" placeholder="Email ID" />                       
                      </div>

                    </div>
                  </div>
                  <!--<div class="customer-name">
                    <div class="row">                      
                    </div>
                  </div>-->
                  <div class="customer-name">
                    <div class="row">
                        <div class="col-sm-3" >
                            <label for="mobile">Mobile No. <em class="required">*</em></label>
                            <input name="mobile" id="mobile" title="mobile"  class="input-text" type="text" placeholder="Enter Mobile No." maxlength="12" style="width:194px"/>
                        </div>
                        <div class="col-sm-3" >
                            <label for="landline">Landline(with area code)</label>
                            <input name="areacode" id="areacode" title="areacode"  class="input-text" type="text"  placeholder="+91" style="width:43px;">
                            <input name="landline" id="landline" title="landline"  class="input-text" type="text" placeholder="Enter Landline No." style="width:146px;"/>
                        </div>
                      <div class="col-sm-3"  >
                          <label for="pan">Pan Number <em class="required">*</em></label>
                          <input name="pan" id="pan" title="pan"  class="input-text required-entry" type="text"  placeholder="Enter Pan No." style="width:194px"/>
                      </div>
                        <!-- <div class="col-sm-2"  style="width:16%">
                            <label for="vat">Vat Number <em class="required">*</em></label>
                            <input name="vat" id="vat" title="vat"  class="input-text required-entry" type="text" placeholder="Enter Vat No." style="width:125px"/>
                        </div>
                        <div class="col-sm-3">
                            <label for="excise">Excise No.(If available)</label>
                            <input name="excise" id="excise" title="excise"  class="input-text" type="text" placeholder="Enter Excise No." style="width:125px"/>
                        </div> -->

                        <div class="col-sm-3">
                            <label for="gst_no">GST No.<em class="required">*</em></label>
                            <input name="gst_no" id="gst_no" title="gst_no"  class="input-text" type="text" placeholder="Enter GST No." style="width:157px"/>
                        </div>

                    </div>
                  </div>
                    <div class="customer-name">
                        <div class="row">
                        <div class="col-sm-8" style="width:96%">
                            <label for="company"><em class="required">*</em>Company</label>
                            <input name="company" id="company" title="company"  class="input-text" type="text" placeholder="Company" />
                        </div>
                            <div class="col-sm-5" style="width:96%">
                                <label for="address">Address <em class="required">*</em></label>
                                <textarea name="address" id="address" title="address" class="required-entry input-text" placeholder="Address" /></textarea>
                            </div>
                            <div class="col-sm-5" style="width:96%">
                                <label for="landmark">Landmark</label>
                                <input name="landmark" id="landmark" title="landmark"  class="input-text" type="text" placeholder="Landmark" />
                            </div>
                        </div>
                    </div>
                  <div class="customer-name">
                    <div class="row">
                        <div class="col-sm-3 col-xs-6">
                            <label for="country">Country <em class="required">*</em></label>
                            <select id="country" name="country"  style="width:125px">
                                <option value="">Select Country</option>
                                <?php foreach($countries as $country){?>
                                    <option value="<?php echo $country->id?>"><?php echo $country->name?></option>
                                <?php }?>

                            </select>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <label for="state">State <em class="required">*</em></label>
                            <select id="state" name="state"  style="width:125px">
                                <option value="">Select State</option>
                            </select>
                        </div>

                        <div class="col-sm-3 col-xs-6">
                        <label for="city">City <em class="required">*</em></label>
                        <select id="city" name="city" style="width:125px" >
                         <option value="">Select City</option>
                       </select>
                      </div>
                      <div class="col-sm-3 col-xs-6">
                        <label for="pincode">Pincode <em class="required">*</em></label>
                        <input name="pincode" id="pincode" title="pincode"  class="input-text" type="text" placeholder="Pincode" style="width:125px"/>
                      </div>
                      
                    </div>
                  </div>
                  
                  <div class="customer-name">
                    <div class="row">

                      <div class="col-sm-5" style="width:96%">
                        <label for="comment">Message <em class="required">*</em></label>
                        <textarea name="comment" id="comment" title="Comment" class="required-entry input-text"  placeholder="Message" /></textarea>
                      </div>                    
                    </div>
                  </div>
                  <!--<div class="customer-name">
                    <div class="row">                      
                    </div>
                  </div>-->
                  <div class="customer-name">
                    <div class="row">


                    </div>
                  </div>
                  
                 
                </fieldset>
                <!--<p class="require">Required Fields <em class="required">*</em></p>-->
                
                <div class="buttons-set">
                  <button type="submit" title="Submit" class="button submit" >Submit</button>
                </div>
              </fieldset>
            </div>
          </form>
        </section>
      </div>
        <div class="col-sm-1"></div>
    </div>
    <!--row--> 
  </div>
  <!--main-container-inner--> 
</div>
