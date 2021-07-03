<option value="">Select Product</option>

<?php foreach($products  as $product): ?>

	<option value='<?php echo $product->Id  ?>'><?php echo $product->ProductName  ?></option>

<?php endforeach; ?>
