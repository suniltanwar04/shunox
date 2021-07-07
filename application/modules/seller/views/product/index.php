<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Products
            <div class="btn-group pull-right">
                <button id="addProduct" class="btn btn-medium btn-primary" data-toggle="modal"
                        data-target="#addCityModal">Add Product
                </button>
                <button id="generateExcel" class="btn btn-medium btn-success">Generate CSV</button>
                <a style="display:none" id="downloadCSV" href="<?php echo base_url().'assets/admin/csv/productHeading.csv' ?>" download class="btn btn-success">Download CSV</a>
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
                <div class="row">
                  <form method="post" enctype="multipart/form-data" id="csvUpload">
                    <div class="col-lg-3">
                      <span class="btn btn-primary">
                        <input type="file" name="productCsv" id="productCsv">
                      </span>
                    </div>
                    <div class="col-lg-2">
                      <button class="btn btn-medium btn-success">Upload CSV</button>
                    </div>
                  </form>

                  <form method="post" enctype="multipart/form-data" id="ProductImages">
                    <div class="col-lg-3">
                      <span class="btn btn-primary">
                        <input type="file" name="productImages[]" id="productImage" multiple>
                      </span>
                    </div>
                    <div class="col-lg-2">
                      <button class="btn btn-medium btn-success">Upload Images</button>
                    </div>
                  </form><br><br>
                    <h3 class="text-danger text-center" id="CSVError"></h3>
                </div>
              <br>
                <div id="table-div">
                    <?php
                    if ($products) { ?>
                        <table id="row-list" class="table table-bordered table-striped custom-table-head">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Product</th>
                                    <th>Sub-Category</th>
                                    <th>Price</th>
                                    <th>Discounted Price</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($products as $product) {
                                    $isActive = CommonHelpers::getStatus($product->IsActive);
                                    $sub = $this->AdminCategory_model->getSubCatById($product->SubCategoryId);
                                   // print_r( $sub);
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo $product->ProductName; ?></td>
                                        <?php if($sub!=''){?>
                                        <td><?php echo $sub->SubCategoryName; ?></td>
                                        <?php }else{?>
                                        <td></td>
                                        <?php }?>
                                        <td><?php echo $product->Price; ?></td>

                                        <td><?php echo $product->DiscountedPrice; ?></td>
                                        <td><?php echo $product->Quantity; ?></td>


                                        <td style="color: <?php echo $isActive->Color; ?>"><?php echo $isActive->Name; ?></td>
                                        <td>
                                          <?php if($product->ShowToUser): ?>
                                            <a href='<?php echo base_url() . CommonConstants::SELLER_URL_SLUG . "/product-attributes/" . $product->Id ?>' title="EditAttr"
                                               style="cursor: pointer;"
                                               id="<?php echo $product->Id ?>">
                                                <i class="fa fa-bars"></i></a>
                                          <?php endif; ?>
                                          &nbsp;&nbsp;&nbsp;&nbsp;
                                            <a title="Edit" href="<?php echo base_url().'edit-product/'.$product->Id ?>">
                                                <i class="fa fa-edit"></i></a>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php
                                            if ($product->IsActive == 1) {
                                                ?>
                                                <a class="deactivate text-yellow" title="Deactivate"
                                                   style="cursor: pointer;"
                                                   id="<?php echo $product->Id; ?>">
                                                    <i class="fa fa-times"></i></a>
                                                <?php
                                            } else {
                                                ?>
                                                <a class="activate text-green" title="Activate"
                                                   style="cursor: pointer;"
                                                   id="<?php echo $product->Id; ?>">
                                                    <i class="fa fa-check"></i></a>

                                                <?php
                                            }
                                            ?>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <a class="glyphicon glyphicon-trash" title="Delete"
                                               style="cursor: pointer;"
                                               id="<?php echo $product->Id ?>"></a>
                                        </td>
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

    <?php $this->load->view('seller/product/model/add-product-model'); ?>
    <div class="modal fade" id="editCityModal" style="display: none;padding-top: 20px;" data-backdrop="static"></div>


</div>
