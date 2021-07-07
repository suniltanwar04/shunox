
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Products Attribute
            <div class="btn-group pull-right">
                <button id="addProduct" class="btn btn-medium btn-primary" data-toggle="modal"
                        data-target="#addCityModal">Add Attribute Value
                </button>
            </div>
        </h1>
    </section>
    <section class="content">
        <div class="row" id="page-msg" style="display: none;"></div>
        
      
                                        
<div class="form-group">
                                                    <label class="col-sm-4 control-label">Select Attribute</label>

                                                    <div class="col-sm-8">
                                                        <select class="form-control" id="selectAttributeId"
                                                                name="selectAttributeId">
                                                            <option value="" selected="selected" disabled="disabled">
                                                                <?php if(!empty($attributeName))echo $attributeName; ?> 
                                                            </option>
                                                           
                                                                <option
                                                                    value="color">color</option>
                                                                    <option
                                                                    value="size">size</option>
                                                                    <option
                                                                    value="length">length</option>
                                                         
                                                        </select>

                                                        <span style="color: red;"></span>
                                                    </div>
                                                    
                                                   
                                                    
                                                </div>
        
    </section>

     <?php $this->load->view('seller/product/model/add-productattr-model'); ?>


</div>