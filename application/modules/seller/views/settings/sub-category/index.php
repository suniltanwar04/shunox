<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Sub-Categories
            <div class="btn-group pull-right">
                <button id="addSubcat" class="btn btn-medium btn-primary" data-toggle="modal"
                        data-target="#addStateModal">Add Sub-Category
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
                    <?php
                    if ($SubCategories) { ?>
                      <?php
                        // echo "<pre>";
                        //   print_r($SubCategories);
                        // echo "</pre>";
                      ?>
                        <table id="row-list" class="table table-bordered table-striped custom-table-head">
                            <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>CategoryName / Category Id</th>
                                <th>Sub-CategoryName / SubCategory Id</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($SubCategories as $SubCategory) {
                                $isActive = CommonHelpers::getStatus($SubCategory->IsActive);
                                ?>
                                <tr>
                                    <td></td>
                                    <td><?php echo $SubCategory->CategoryName .' / '.$SubCategory->CategoryId; ?></td>
                                    <td><?php echo $SubCategory->SubCategoryName .' / '.$SubCategory->Id; ?></td>


                                    <td style="color: <?php echo $isActive->Name; ?>"><?php echo $isActive->Name; ?></td>
                                    <td>
                                        <a class="edit" title="Edit"
                                           style="cursor: pointer;"
                                           id="<?php echo $SubCategory->Id ?>">
                                            <i class="fa fa-edit"></i></a>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                        <?php
                                        if ($SubCategory->IsActive == 1) {
                                            ?>
                                            <a class="deactivate text-yellow" title="Deactivate"
                                               style="cursor: pointer;"
                                               id="<?php echo $SubCategory->Id; ?>">
                                                <i class="fa fa-times"></i></a>
                                            <?php
                                        } else {
                                            ?>
                                            <a class="activate text-green" title="Activate"
                                               style="cursor: pointer;"
                                               id="<?php echo $SubCategory->Id; ?>">
                                                <i class="fa fa-check"></i></a>

                                            <?php
                                        }
                                        ?>
                                        &nbsp;&nbsp;&nbsp;&nbsp;
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
                                <td colspan="5" class="dataTables_empty">No Records Found.</td>
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

    <?php $this->load->view('seller/settings/sub-category/model/add-sub-category-modal'); ?>
    <div class="modal fade" id="editStateModal" style="display: none;padding-top: 20px;" data-backdrop="static"></div>


</div>
