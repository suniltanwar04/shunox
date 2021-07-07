<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Coupon
            <div class="btn-group pull-right">
                <button id="addCoupon" class="btn btn-medium btn-primary" data-toggle="modal"
                        data-target="#addCityModal">Add Coupon
                </button>
            </div>
        </h1>
    </section>
    <section class="content">
        <div class="row" id="page-msg" style="display: none;"></div>
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">&nbsp;</h3>
            </div>
            <div class="box-body">
                <div id="table-div">
                    <table id="row-list" class="table table-bordered table-striped custom-table-head">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Coupon Code</th>
                                <th>Item Type</th>
                                <th>Valid Till</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if($coupons):
                                    foreach($coupons as $coupon):
                            ?>
                            <tr>
                                <td></td>
                                <td><?php echo $coupon->CouponCode; ?></td>
                                <td><?php echo $coupon->ItemType; ?></td>
                                <td><?php echo date('d-M-Y',$coupon->ValidTill); ?></td>
                                <td>
                                  <?php if($coupon->ValidTill > time()): ?>
                                  <span class="fa fa-check text-success" title="active"></span>
                                <?php else: ?>
                                  <span class="fa fa-times text-danger" title="Expired"></span>

                                <?php endif; ?>
                                </td>

                            </tr>

                        <?php
                                endforeach;
                                endif;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

</div>
    <?php $this->load->view('seller/coupon/model/add-coupon-model'); ?>
