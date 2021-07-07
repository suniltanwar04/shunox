<?php
if ($alllocations) { ?>
    <table id="row-list" class="table table-bordered table-striped custom-table-head">
        <thead>
        <tr>
            <th>S.No.</th>
            <th>Company</th>
            <th>Address</th>
            <th>Country</th>
            <th>State</th>
            <th>City</th>
            <th>Pincode</th>
            <th>status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($alllocations as $alllocation) {
            $isActive = CommonHelpers::getStatus($alllocation->IsActive);
            $country = $this->Common_model->getCountryById($alllocation->country);
            $state = $this->Common_model->getStateById($alllocation->state);
            $city = $this->Common_model->getCityById($alllocation->city);
            ?>
            <tr>
                <td width="7%"></td>
                <td><?php echo $alllocation->company; ?></td>

                <td width="7%">
                    <?php echo $alllocation->address; ?>
                </td>
                <td width="10%">
                    <?php echo $country->name; ?>
                </td>
                <td width="10%">
                    <?php echo $state->name; ?>
                </td>
                <td width="10%">
                    <?php echo $city->name; ?>
                </td>
                <td width="10%">
                    <?php echo $alllocation->pincode; ?>
                </td>

                <td style="color: <?php echo $isActive->Color; ?>"><?php echo $isActive->Name; ?></td>
                <td>


                    <?php
                    if ($alllocation->IsActive == 1) {
                        ?>
                        <a class="deactivate text-yellow" title="Deactivate"
                           style="cursor: pointer;"
                           id="<?php echo $alllocation->Id; ?>">
                            <i class="fa fa-times"></i></a>
                    <?php
                    } else {
                        ?>
                        <a class="activate text-green" title="Activate"
                           style="cursor: pointer;"
                           id="<?php echo $alllocation->Id; ?>">
                            <i class="fa fa-check"></i></a>

                    <?php
                    }
                    ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a class="glyphicon glyphicon-trash" title="Delete"
                       style="cursor: pointer;"
                       id="<?php echo $alllocation->Id ?>"></a>
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