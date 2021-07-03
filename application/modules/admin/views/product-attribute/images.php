<?php
if(count($this->uri->segments) > 3)
	$product_id = $this->uri->segment(4); 
else
	$product_id = $this->uri->segment(3); 
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Attributes
            <div class="btn-group pull-right">
				<a id="pr" class="btn btn-medium btn-primary" href="/admin/product-attributes/<?php echo $product_id; ?>">Product Attributes</a>
				<button id="addImages" class="btn btn-medium btn-primary" data-toggle="modal" data-target="#addImageModal">Add Images</button>
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
                        <table id="row-list" class="table table-bordered table-striped custom-table-head">
                            <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Color</th>
                                <th>Image</th>
                               <th>Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sno=1;
                            if(!empty($Images)) {
                             
                                foreach ($Images as $Image) { ?>
                                <tr>
                                    <td><?php echo $sno++; ?></td>
                                    <td><?php echo $Image->attribute ?></td>
                                    <td>
										<img src="<?php echo base_url().'uploads/products/attr/'.$Image->image; ?>" class="img" alt="" style="cursor: pointer; width: 80px">
									</td>

                                    <td>
										<a id="deleteimage" class="btn btn-medium btn-danger" href="/admin/delete-image/<?php echo $Image->id; ?>/<?php echo $product_id; ?>">DELETE</a>
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

    <?php $this->load->view('admin/product-attribute/model/add-product-attribute-model'); ?>
    <?php $this->load->view('admin/product-attribute/model/add-product-image-model'); ?>
    <div class="modal fade" id="editCityModal" style="display: none;padding-top: 20px;" data-backdrop="static"></div>


</div>
