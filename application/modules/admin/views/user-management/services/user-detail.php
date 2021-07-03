<?php
if($userdetails->Country) {
    $country = $this->Common_model->getCountryById($userdetails->Country);
    $cou = $country->name;
}else{
    $cou = '';
}
if($userdetails->State) {
    $state = $this->Common_model->getStateById($userdetails->State);
    $stat = $state->name;
}else{
    $stat = '';
}
if($userdetails->City){
    $city = $this->Common_model->getCityById($userdetails->City);
    $cit = $city->name;
}else{
    $cit = '';
}
?>
<div class="content-wrapper" style="min-height: 916px;">
    <section class="content-header">
        <h1>User Detail</h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User Detail</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">

                <?php echo $this->session->flashdata('message'); ?>

                <div class="nav-tabs-custom">

                    <form  method="post" role="form" class="form-horizontal" enctype="multipart/form-data">
                        <div class="tab-content">

                            <div class="active tab-pane" id="setting">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Name</label>
                                        <div class="col-md-8">
                                            <input type="text"  value="<?php echo $userdetails->FullName?>" class="form-control" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Email</label>
                                        <div class="col-md-8">
                                            <input type="text"  value="<?php echo $userdetails->Email?>" class="form-control" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> Mobile</label>
                                        <div class="col-md-8">
                                            <input type="text"  value="<?php echo $userdetails->Mobile?>" class="form-control" disabled>
                                            <div class="error"></div>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Address</label>
                                        <div class="col-md-8">
                                            <textarea  class="form-control" disabled><?php echo $userdetails->Address?></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Landmark</label>
                                        <div class="col-md-8">
                                            <input type="text"  value="<?php echo $userdetails->Landmark?>" class="form-control" disabled>
                                            <div class="error"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Country</label>
                                        <div class="col-md-8">
                                            <input type="text"  value="<?php echo $cou?>" class="form-control" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">State</label>
                                        <div class="col-md-8">
                                            <input type="text"  value="<?php echo $stat?>" class="form-control" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label"> City</label>
                                        <div class="col-md-8">
                                            <input type="text"  value="<?php echo $cit?>" class="form-control" disabled>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Pincode</label>
                                        <div class="col-md-8">
                                            <input type="text"  value="<?php echo $userdetails->Pincode?>" class="form-control" disabled >
                                        </div>
                                    </div>


                                </div>
                            </div>




                        </div>


                    </form>

                </div>
            </div>


        </div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->
</div>