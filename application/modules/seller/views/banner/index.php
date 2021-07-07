<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Banner
            <div class="btn-group pull-right">
                <button id="addProduct" class="btn btn-medium btn-primary" data-toggle="modal"
                        data-target="#addBannerModal">Add Banner
                </button>
               
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

              <br>
                <div id="table-div">
                    <?php
                    if ($allbanner) { ?>
                        <table id="row-list" class="table table-bordered table-striped custom-table-head">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($allbanner as $banners) { //print_r($banners);die;
                                    $isActive = CommonHelpers::getStatus($banners->IsActive);
                                    ?>
                                    <tr>
                                        <td width="10%"></td>
                                        <td><?php echo $banners->title; ?></td>

                                        <td width="25%">
                                            <?php if($banners->image) {?>
                                                <img src="<?php echo base_url(); ?>uploads/banner/<?php echo $banners->image;?>" class="img-responsive" style="width: 90%;height: 80px;border: 2px solid #6AC4EC;border-radius: 2px;">
                                            <?php }else{?>
                                                <img src="<?php echo base_url(); ?>uploads/no-image.jpg" class="img-responsive" style="width: 90%;height: 80px;border: 2px solid #6AC4EC;border-radius: 2px;">
                                            <?php }?>
                                        </td>

                                        <td style="color: <?php echo $isActive->Color; ?>"><?php echo $isActive->Name; ?></td>
                                        <td>

                                            <a title="Edit" href="<?php echo $this->config->item('seller_base_url').'edit-banner/'.$banners->id ?>">
                                                <i class="fa fa-edit"></i></a>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php
                                            if ($banners->IsActive == 1) {
                                                ?>
                                                <a class="deactivate text-yellow" title="Deactivate"
                                                   style="cursor: pointer;"
                                                   id="<?php echo $banners->id; ?>">
                                                    <i class="fa fa-times"></i></a>
                                                <?php
                                            } else {
                                                ?>
                                                <a class="activate text-green" title="Activate"
                                                   style="cursor: pointer;"
                                                   id="<?php echo $banners->id; ?>">
                                                    <i class="fa fa-check"></i></a>

                                                <?php
                                            }
                                            ?>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <a class="glyphicon glyphicon-trash" title="Delete"
                                               style="cursor: pointer;"
                                               id="<?php echo $banners->id ?>"></a>
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

    <?php $this->load->view('seller/banner/model/add-banner-model'); ?>
    <div class="modal fade" id="editCityModal" style="display: none;padding-top: 20px;" data-backdrop="static"></div>


</div>
