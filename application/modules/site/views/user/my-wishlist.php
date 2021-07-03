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
      <table id="table">
    <thead>
      <tr>
        
        <th>Product Name</th>
        
        <th>Remove</th>
      </tr>
    </thead>
    <tbody>
      <?php  if($wishlists): ?>
        <?php foreach ($wishlists as $wishlist): ?>
         <tr class="remove_<?php echo $wishlist->ProductId?>">
          
          <td><?php echo $wishlist->ProductName; ?></td>
          <td style="cursor:pointer" class="rem_wishlist" id="rem_<?php echo $wishlist->ProductId?>"><img src="<?php echo base_url();?>uploads/delete-button.png"></td>
          
        </tr>
    <?php endforeach; ?>
    <?php else: ?>
      <td colspan="5" class="text-center">Sorry, You have no wishlist!</td>
    <?php endif; ?>
    </tbody>
  </table>
    </div>
    </div>
    <!--Right bar ends here-->
      </div>
  </div>
</div>
</div>
