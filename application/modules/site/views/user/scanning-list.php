


<div class="clearfix"></div>
<div class="dark-white" >
  <div class="center">
  <div class="main-container">
   <div class="por-contaner">
    <div class="grid-25 pull-left">
    <div class="dashboard_main">
     <?php require_once('services/user-dashboard-menu.php'); ?>
    </div>
    </div>
    <!--Right bar-->
    <div class="grid-75 pull-right">
		<div class="user-details">
			<div class="row">
      <?php if($lists){ ?>
				<?php foreach($lists as $list){ ?>
						<div class="col-sm-3 pdf_sec"> 
							<div class="pdf_dv">
								<img src="<?php echo base_url()?>assets/site/images/scan_print.jpeg">
							</div>
							<p class="pdf_scan_no">Scan No: <?php echo $list['ScanNo']; ?></p>
							<p class="pdf_scan_date">Scan Date: <?php echo $list['ScanDate']; ?></p>
							<a href="pdf-download/<?php echo $list['ScanID']; ?>" class="pdf_download" target="_blank">Download</a>
						</div>
        <?php } 
        }
        else{ ?>
          <p class="pdf_scan_no">No Record Found!</p>
       <?php } ?>
						 
						 
					
					
				
				
			</div>
		</div>
    </div>
    <!--Right bar ends here-->
      </div>
  </div>
</div>
</div>
</div>