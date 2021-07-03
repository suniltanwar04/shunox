<?php  //echo '<pre>'; print_r($product_priceNattr);

if(!empty($product_priceNattr) && !empty($attributeName))
{
echo 'Attribute name:    '.$attributeName.'</br>';

foreach($product_priceNattr as $k=>$v)
{
	foreach($v as $k1=>$v1)
	{
		if($k1=='AttributeValue' || $k1=='Price' || $k1=='DiscountedPrice')
		echo $k1."= ".$v1."</br>";
	
	}
	echo '</br>';
}
}





 ?>

<div class="modal fade" id="addCityModal" tabindex="-1" role="dialog" aria-labelledby="addCityModalLabel"
     style="padding-top: 20px;" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog " role="document" style="width: 55%">

        <form class="form-horizontal" id="productAddForm" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addCityModalLabel">Add Product Attribute</h4>
                </div>
                <div class="modal-body modal-tab-form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav-tabs-custom">
                                
                                <div class="tab-content">
                                    <div id="addFromError"></div>
                                    <div class="tab-pane active" id="tab_1">
                                        <div class="col-lg-12">
                                            <div class="box-body">

                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Color</label>

                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="addCategoryId"
                                                                name="addCategoryId">
                                                            <option value="" selected="selected" disabled="disabled">
                                                                Select Color
                                                            </option>
                                                            <?php
                                                            foreach ($attributes as $attribute) {
                                                                ?>
                                                                <option
                                                                    value="<?php echo $attribute->Id; ?>"><?php echo $attribute->AttributeValue; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>

                                                        <span id="addCategoryIdError" style="color: red;"></span>
                                                    </div>
                                                </div>


               

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a class="btn btn-medium btn-primary" id="saveProduct">Save</a>
                </div>
            </div>
        </form>
    </div>
</div>