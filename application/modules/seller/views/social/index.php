<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Social
            <div class="btn-group pull-right">
                <button id="addSocial" class="btn btn-medium btn-primary" data-toggle="modal"
                        data-target="#addSocialModal">Add Social
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

              <br>
                <div id="table-div">
                    <?php
                    if ($allsocial) { ?>
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
                                foreach ($allsocial as $socials) { //print_r($socials);die;
                                    $isActive = CommonHelpers::getStatus($socials->is_active);
                                    ?>
                                    <tr>
                                        <td width="10%"></td>
                                        <td><?php echo $socials->title; ?></td>

                                        <td width="15%">
                                            <?php if($socials->image) {?>
                                                <img src="<?php echo base_url(); ?>uploads/social/<?php echo $socials->image;?>" class="img-responsive" style="width: 30%;height: 40px;border: 2px solid #6AC4EC;border-radius: 2px;">
                                            <?php }else{?>
                                                <img src="<?php echo base_url(); ?>uploads/no-image.jpg" class="img-responsive" style="width: 90%;height: 80px;border: 2px solid #6AC4EC;border-radius: 2px;">
                                            <?php }?>
                                        </td>

                                        <td style="color: <?php echo $isActive->Color; ?>"><?php echo $isActive->Name; ?></td>
                                        <td>

                                            <a title="Edit" href="<?php echo $this->config->item('seller_base_url').'edit-social/'.$socials->id ?>">
                                                <i class="fa fa-edit"></i></a>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php
                                            if ($socials->is_active == 1) {
                                                ?>
                                                <a class="deactivate text-yellow" title="Deactivate"
                                                   style="cursor: pointer;"
                                                   id="<?php echo $socials->id; ?>">
                                                    <i class="fa fa-times"></i></a>
                                                <?php
                                            } else {
                                                ?>
                                                <a class="activate text-green" title="Activate"
                                                   style="cursor: pointer;"
                                                   id="<?php echo $socials->id; ?>">
                                                    <i class="fa fa-check"></i></a>

                                                <?php
                                            }
                                            ?>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <a class="glyphicon glyphicon-trash" title="Delete"
                                               style="cursor: pointer;"
                                               id="<?php echo $socials->id ?>"></a>
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

    <?php $this->load->view('seller/social/model/add-social-model'); ?>
    <div class="modal fade" id="editCityModal" style="display: none;padding-top: 20px;" data-backdrop="static"></div>


</div>
