<div class="main-container default-page"><header class="entry-header">
        <h1 class="entry-title">Scanning location's</h1>
    </header>
    <div class="clearfix">&nbsp;</div>
    <div class="container">
        <div class="breadcrumbs" style="margin-bottom: 15px;"><a href="http://www.shoemade4u.com/">Home</a><span class="separator">/</span> Scanning location's</div>
        <form id="seacrhLocation" method="post">
            <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url()?>">
        <div class="col-md-2" style="margin-top: 5px">
            <select id="country" name="country" class="form-control">
                <option>Select Country</option>
                <?php foreach($countries as $country){?>
                <option value="<?php echo $country->id?>"><?php echo $country->name?></option>
                <?php }?>
            </select>
        </div>
        <div class="col-md-2" style="margin-top: 5px">
            <select id="state" name="state" class="form-control">
                <option>Select State</option>
            </select>
        </div>
        <div class="col-md-2" style="margin-top: 5px">
            <select id="city" name="city" class="form-control">
                <option>Select City</option>
            </select>
        </div>
        <div class="col-md-2" style="margin-top: 5px">
           <input type="button" value="Search" class="login_btn" id="searchScanLoc">
        </div>
            </form>
        <div class="clearfix">&nbsp;</div>
        <div class="clearfix">&nbsp;</div>
        <div class="row" id="row_location">

            <?php foreach($pagesdetails as $pagesdetail){
                $city = $this->Common_model->getCityById($pagesdetail->city);
                ?>

            <div class="col-xs-8 ">

                <div class="page-content default-page">
                    <article id="post-4382" class="post-4382 page type-page status-publish hentry">
                        <div class="col-xs-2" style="width:12%">
                        <a href="<?php echo $pagesdetail->map_url?>" target="_blank"><img src="<?php echo base_url()?>assets/site/images/map.jpg" style="width:60px;"></a>
                            </div>
                        <div class="entry-content col-xs-6">

                            <h5><strong><span style="color: #5a3c00;"><?php echo $pagesdetail->company?></span></strong></h5>
                            <h5><span style="color: #5a3c00;"><?php echo $pagesdetail->address?></span></h5>
                            <h5><span style="color: #5a3c00;"><?php echo $city->name?> &ndash; <?php echo $pagesdetail->pincode?></span></h5>
                            <h5><span style="color: #5a3c00;">Email : <?php echo $pagesdetail->email?></span></h5>
                            <h5><span style="color: #5a3c00;">Contact :  <?php echo $pagesdetail->phone?></span></h5>
                            <p>&nbsp;</p>

                        </div>
                    </article>
                    <div id="comments" class="comments-area">&nbsp;</div>
                    <!-- #comments .comments-area --></div>
            </div>
            <?php }?>

        </div>
    </div>
</div>

