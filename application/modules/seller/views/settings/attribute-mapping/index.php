<?php
$products = callModelFunction('AdminProduct_model', 'getProduct');
$attributevalues = callModelFunction('AdminAttribute_model', 'getAttributeValues');

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Attribute Mapping
            <div class="btn-group pull-right">
                <button id="addAttribute" class="btn btn-medium btn-primary" data-toggle="modal"
                        data-target="#addCategoryModal">Add Attribute Mapping
                </button>
            </div>
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
                    if ($attributeMapping) {
                        ?>
                        <div class="box-body no-padding">
                            <table class="table">
                                <tbody>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Product</th>
                                    <th>Attribute Value</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>


                                <?php
                                $i = 1;

                                foreach ($attributeMapping as $attributeMap) {

                                    $isActive = CommonHelpers::getStatus($attributeMap->IsActive);
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $attributeMap->ProductName; ?></td>
                                        <td><?php echo $attributeMap->AttributeValue; ?></td>
                                        <td style="color: <?php echo $isActive->Color; ?>"><?php echo $isActive->Name; ?></td>
                                        <td>
                                            <a class="edit" title="Edit"
                                               style="cursor: pointer;"
                                               id="<?php echo $attributeMap->Id ?>">
                                                <i class="fa fa-edit"></i></a>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php
                                            if ($attributeMap->IsActive == 1) {
                                                ?>
                                                <a class="deactivate text-yellow" title="Deactivate"
                                                   style="cursor: pointer;"
                                                   id="<?php echo $attributeMap->Id; ?>">
                                                    <i class="fa fa-times"></i></a>
                                                <?php
                                            } else {
                                                ?>
                                                <a class="activate text-green" title="Activate"
                                                   style="cursor: pointer;"
                                                   id="<?php echo $attributeMap->Id; ?>">
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

                      <!----  Pagination start
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

                </div>
            </div>
        </div>
    </section>

    <?php $this->load->view('seller/settings/attribute-mapping/model/add-attribute-mapping-model'); ?>
    <div class="modal fade" id="editAttributeMappingModel" style="display: none;padding-top: 20px;" data-backdrop="static"
         data-keyboard="false"></div>
</div>