<?php
$categories = callModelFunction('AdminCategory_model', 'getCategories');
$subCategories = callModelFunction('AdminCategory_model', 'getSubCategory');
?>


<div class="modal fade" id="addCityModal" tabindex="-1" role="dialog" aria-labelledby="addCityModalLabel"
     style="padding-top: 20px;" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog " role="document" style="width: 55%">

        <form class="form-horizontal" id="couponAddForm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addCityModalLabel">Add Coupon</h4>
                </div>
                <div class="modal-body modal-tab-form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab" id="addGenInfo">General Information</a></li>

                                </ul>
                                <div class="tab-content">
                                    <div id="table-div">
                                        <div class="box-body no-padding">
                                            <div class="form-group">
                                                <label for="" class="control-label col-lg-2">Coupon Code</label>
                                                <div class="col-lg-10">
                                                    <input type="text" name="coupon" id="coupon" class="form-control validate" placeholder="Coupon Code"
                                                    data-validation-rules="required|alphaNumeric"
                                                    data-validation-label="Coupon Code"
                                                    data-validation-message-id="CouponError">
                                                    <span class="help-block" id="CouponError"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="control-label col-lg-2">Item Type</label>
                                                <div class="col-lg-10">
                                                    <select name="item-type" id="itemType" class="form-control validate"
                                                    data-validation-rules="required"
                                                    data-validation-label="Item Type"
                                                    data-validation-message-id="itemTypeError">
                                                        <option value="">Select Item Type</option>
                                                        <option value="1">All Products</option>
                                                        <option value="2">Sub Category</option>
                                                        <option value="3">For Single Product</option>


                                                    </select>
                                                    <span class="help-block" id="itemTypeError"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="control-label col-lg-2">Item</label>
                                                <div class="col-lg-10">
                                                    <select name="item" id="item" class="form-control validate"
                                                    data-validation-rules="required"
                                                    data-validation-label="Item"
                                                    data-validation-message-id="itemError">
                                                        <option value="">Select Item</option>
                                                    </select>
                                                    <span class="help-block" id="itemError"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="control-label col-lg-2">Discount Type</label>
                                                <div class="col-lg-10">
                                                    <select name="discountType" id="discountType" class="form-control validate"
                                                    data-validation-rules="required"
                                                    data-validation-label="Discount Type"
                                                    data-validation-message-id="discountTypeError">
                                                    <option value="">Select Discount Type</option>
                                                        <option value="1">Discount</option>
                                                        <option value="2">Flat</option>

                                                    </select>
                                                    <span class="help-block" id="discountTypeError"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="control-label col-lg-2">Discount Value</label>
                                                <div class="col-lg-10">
                                                    <input type="number" name="discountValue" id="discountValue" class="form-control validate"
                                                     placeholder="Discount Value"
                                                    data-validation-rules="required"
                                                    data-validation-label="Coupon"
                                                    data-validation-message-id="discountValueError" min="1">
                                                    <span class="help-block" id="discountValueError"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="" class="control-label col-lg-2">Valid Till</label>
                                                <div class="col-lg-10">
                                                    <input type="text" name="validTill" id="validTill" class="form-control validate datepicker"
                                                     placeholder="Valid Till"
                                                    data-validation-rules="required"
                                                    data-validation-label="Expiry Date"
                                                    data-validation-message-id="validTillError">
                                                    <span class="help-block" id="validTillError"></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <button class="btn btn-primary pull-right" id="addCouponBtn">Add Coupon</button>

                                            </div>
                                    <div class="form-group text-center"><h3 id="addCouponError"></h3></div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
            </div>
        </form>
    </div>
</div>
