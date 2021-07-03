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



