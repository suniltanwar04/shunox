<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Cart List
            <div class="btn-group pull-right">
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
                    <?php
                    if ($items) { ?>
                        <table id="row-list" class="table table-bordered table-striped custom-table-head">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Product ID</th>
                                    <th>Product</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php $i = 1;  foreach ($items as $item) { ?>
                              <tr>
                                  <td><?php echo $i++; ?></td>
                                  <td><?php echo $item->ProductId; ?></td>
                                  <td><?php echo $item->ProductName; ?></td>
                                  <td><?php echo $item->FullName; ?></td>
                                  <td><?php echo $item->Email; ?></td>
                                  <td><?php echo date("d-M-Y",strtotime($item->date)); ?></td>
                              <?php  }   ?>
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

    <?php $this->load->view('admin/product/model/add-product-model'); ?>
    <div class="modal fade" id="editCityModal" style="display: none;padding-top: 20px;" data-backdrop="static"></div>


</div>
