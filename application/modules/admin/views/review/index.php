<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Review

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
                    if ($reviews) {
                        ?>
                        <table id="row-list" class="table table-bordered table-striped custom-table-head">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Summary</th>
                                    <th>Review</th>
                                    <th>ProductName</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($reviews as $review) {
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo $review->NickName; ?></td>
                                        <td><?php echo $review->Summary; ?></td>
                                        <td><?php echo $review->Review; ?></td>
                                        <td><?php echo $review->ProductName; ?></td>
                                        <td><?php if($review->IsApproved==1){echo "Approved";}else{echo "Unapproved";} ?></td>

                                        <td>
                                            <?php
                                            if ($review->IsApproved == 1) {
                                                ?>
                                                <a class="deactivate text-yellow" title="Deactivate"
                                                   style="cursor: pointer;"
                                                   id="<?php echo $review->Id; ?>">
                                                    <i class="fa fa-times"></i></a>
                                                <?php
                                            } else {
                                                ?>
                                                <a class="activate text-green" title="Activate"
                                                   style="cursor: pointer;"
                                                   id="<?php echo $review->Id; ?>">
                                                    <i class="fa fa-check"></i></a>

                                                <?php
                                            }
                                            ?>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <a class="glyphicon glyphicon-trash" title="Delete"
                                               style="cursor: pointer;"
                                               id="<?php echo $review->Id ?>"></a>
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



</div>