<?php $product_id = $this->uri->segment(3); ?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Attributes
            <div class="btn-group pull-right">
                <button id="addProduct" class="btn btn-medium btn-primary" data-toggle="modal"
                        data-target="#addCityModal">Manage Attributes
                </button>
				<button id="addImages" class="btn btn-medium btn-primary" data-toggle="modal" data-target="#addImageModal">Add Images</button>
				<a id="addImages" class="btn btn-medium btn-primary" href="/admin/manage-images/<?php echo $product_id?>">Manage Images</a>
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
                                <th>Attribute Name</th>
                                <th>Attribute value</th>
                                <th>Price</th>
                                <th>Discounted Price</th>
								
                               <!-- <th>Action</th>-->

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sno=1;
                            if(!empty($attributes_vals)) {
                             
                                foreach ($attributes_vals as $attributes_val) { ?>
                                <tr>
                                    <td><?php echo $sno++; ?></td>
                                    <td><?php echo $attributes_val->AttributeName ?></td>
                                    <td><?php echo $attributes_val->AttributeValue ?></td>

                                    <td>
                                      <!--<input type="text" value="<?php //echo $attributes_val->Price ?>"  class="editablePrice"
                                      attributePriceId="<?php// echo $attributes_val->AttributePriceId ?>"
                                      InProduct="<?php //echo $attributes_val->InProduct ?>"
                                      ProductId="<?php //echo $attributes_val->ProductId ?>"
                                      title="Price"
                                      style="border:none;" tabindex="-1">-->
                                        <?php echo $attributes_val->Price ?>
                                    </td>

                                    <td>
                                      <!--<input type="text" value="<?php //echo $attributes_val->DiscountedPrice ?>"  class="editablePrice"
                                      attributePriceId="<?php //echo $attributes_val->AttributePriceId ?>"
                                      InProduct="<?php //echo $attributes_val->InProduct ?>"
                                      ProductId="<?php //echo $attributes_val->ProductId ?>"
                                      title="DiscountedPrice"
                                      style="border:none;" tabindex="-1">-->
                                        <?php echo $attributes_val->DiscountedPrice ?>
                                    </td>
									
									
                                    <!--<td>
                                      <span class="fa fa-edit btn text-warning"
                                        mappingId="<?php //echo $attributes_val->PAVMId ?>"
                                        ProductId="<?php //echo $attributes_val->ProductId ?>"
                                      ></span>
                                    </td>-->
                                </tr>
                                <?php
                                 }
                                 ?>
                            </tbody>
                        </table>
                        <?php
                            } else {
                        ?>
                        <table class="table table-bordered table-striped">
                            <tbody>
                            <tr>
                                <td class="dataTables_empty">No Records Found.</td>
                            </tr>
                            </tbody>
                        </table>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

    <?php $this->load->view('admin/product-attribute/model/add-product-attribute-model'); ?>
    <?php $this->load->view('admin/product-attribute/model/add-product-image-model'); ?>
    <div class="modal fade" id="editCityModal" style="display: none;padding-top: 20px;" data-backdrop="static"></div>


</div>
