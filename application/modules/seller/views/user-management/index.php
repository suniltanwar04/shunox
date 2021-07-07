<div class="content-wrapper">
    <section class="content-header">
        <h1>
           List Of Users
           <!-- <div class="btn-group pull-right">
                <button id="addCategory" class="btn btn-medium btn-primary" data-toggle="modal"
                        data-target="#addCategoryModal">Add Category
                </button>
            </div>-->
        </h1>
    </section>
    <section class="content">
        <div class="row" id="page-msg" style="display: none;"></div>
        <div class="box">

            <?php
            $queryLimits = CommonHelpers::getQueryLimits();
            ?>


            <div class="box-header with-border">
                <!-- Data Limit

                <div class="col-lg-2">

                    <select class="form-control">
                        <?php
                foreach ($queryLimits as $queryLimit) {
                    ?>
                            <option
                                value="<?php echo $queryLimit['Value']; ?>"><?php echo $queryLimit['Name']; ?></option>
                        <?php
                }

                ?>
                    </select>


                </div>
-->
                <!-- Search Panel
                <div class="col-lg-3">
                    <input type="text" class="form-control">
                </div>
                <div class="col-lg-3">
                    <input type="text" class="form-control">
                </div>
                <div class="col-lg-3">
                    <select class="form-control">
                        <option>Yes</option>
                        <option>No</option>
                    </select>
                </div>
                <div class="col-lg-1">
                    <button id="addCategory" class="btn btn-medium btn-default">Search</button>
                </div>
-->

            </div>
            <div class="box-body no-padding">
                <div id="table-div">

                    <?php
                    if ($UserManagements) {
                        ?>
                        <div class="box-body no-padding">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    <th>Change Password</th>
                                </tr>


                                <?php
                                $i = 1;
                                foreach ($UserManagements as $UserManagement) {

                                    $isActive = CommonHelpers::getStatus($UserManagement->IsActive);
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $UserManagement->FullName; ?></td>
                                        <td><?php echo $UserManagement->Email; ?></td>
                                        <td style="color: <?php echo $isActive->Color; ?>"><?php echo $isActive->Name; ?></td>
                                        <td>

                                            <?php
                                            if ($UserManagement->IsActive == 1) {
                                                ?>
                                                <a class="deactivate text-yellow" title="Deactivate"
                                                   style="cursor: pointer;"
                                                   id="<?php echo $UserManagement->Id; ?>">
                                                    <i class="fa fa-times"></i></a>
                                                <?php
                                            } else {
                                                ?>
                                                <a class="activate text-green" title="Activate"
                                                   style="cursor: pointer;"
                                                   id="<?php echo $UserManagement->Id; ?>">
                                                    <i class="fa fa-check"></i></a>

                                                <?php
                                            }
                                            ?>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <a class="glyphicon glyphicon-trash" title="Delete"
                                               style="cursor: pointer;"
                                               id="<?php echo $UserManagement->Id; ?>"></a>

                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="<?php echo $this->config->item('seller_base_url') . 'user-details/'.$UserManagement->Id; ?>" class="fa fa-eye-slash" aria-hidden="true"></a>
                                            
                                             &nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="<?php echo $this->config->item('seller_base_url') . 'user-edit/'.$UserManagement->Id; ?>" aria-hidden="true"><i  class="fa fa-edit"></i></a>

                                        </td>
                                        <td><a style="cursor: pointer; " 
                                   id="<?php echo $UserManagement->Id; ?>" class="edit" title="Edit">
                                     Change Password</a></td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>


                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination
                                            <div class="box-footer clearfix">
                                                <ul class="pagination pagination-sm no-margin pull-right">
                                                    <li><a href="#">�</a></li>
                                                    <li><a href="#">1</a></li>
                                                    <li><a href="#">2</a></li>
                                                    <li><a href="#">3</a></li>
                                                    <li><a href="#">�</a></li>
                                                </ul>
                                            </div>
                        -->






                        <?php
                    } else {
                        ?>
                        <div class="box-body no-padding">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td class="dataTables_empty">No Records Found.</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </section>

    
    <?php $this->load->view('seller/user-management/model/change-password'); ?>
  <?php  $this->load->view('seller/user-management/model/change-password');?>




    <div class="modal fade" id="changePassModel" style="display: none;padding-top: 20px;" data-backdrop="static"
         data-keyboard="false"></div>
</div>