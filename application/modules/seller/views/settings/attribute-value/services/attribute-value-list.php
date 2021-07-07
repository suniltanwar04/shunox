<?php
if ($attributesValues) {
    ?>
    <div class="box-body no-padding">
        <table class="table">
            <tbody>
            <tr>
                <th style="width: 10px">#</th>
                <th>Attributes</th>
                <th>Sub-Category</th>
                <th>Attribute Value</th>
                <th>Status</th>
                <th>Action</th>
            </tr>


            <?php
            $i = 1;
            foreach ($attributesValues as $attributesValue) {

                $isActive = CommonHelpers::getStatus($attributesValue->IsActive);
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $attributesValue->AttributeName; ?></td>
                    <td><?php echo $attributesValue->SubCategoryName; ?></td>
                    <?php
                    if(strtolower($attributesValue->AttributeName)=='color' || strtolower($attributesValue->AttributeName)=='colour'){
                        ?>
                        <td style="background-color:<?php echo $attributesValue->AttributeValue; ?>">&nbsp;</td>
                        <?php
                    }else{
                        ?>
                        <td><?php echo $attributesValue->AttributeValue; ?></td>
                        <?php
                    }

                    ?>
                    <td style="color: <?php echo $isActive->Color; ?>"><?php echo $isActive->Name; ?></td>
                    <td>
                        <a class="edit" title="Edit"
                           style="cursor: pointer;"
                           id="<?php echo $attributesValue->Id ?>">
                            <i class="fa fa-edit"></i></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <?php
                        if ($attributesValue->IsActive == 1) {
                            ?>
                            <a class="deactivate text-yellow" title="Deactivate"
                               style="cursor: pointer;"
                               id="<?php echo $attributesValue->Id; ?>">
                                <i class="fa fa-times"></i></a>
                            <?php
                        } else {
                            ?>
                            <a class="activate text-green" title="Activate"
                               style="cursor: pointer;"
                               id="<?php echo $attributesValue->Id; ?>">
                                <i class="fa fa-check"></i></a>

                            <?php
                        }
                        ?>
                        &nbsp;&nbsp;&nbsp;&nbsp;

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

