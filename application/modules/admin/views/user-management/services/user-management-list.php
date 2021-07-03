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
                                            <a href="<?php echo $this->config->item('admin_base_url') . 'user-details/'.$UserManagement->Id; ?>" class="fa fa-eye-slash" aria-hidden="true"></a>



                    </td>
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
                                <li><a href="#">«</a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">»</a></li>
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