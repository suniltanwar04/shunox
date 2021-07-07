<option value="">Select Item</option>

<?php foreach($subCategories  as $subCategory): ?>

	<option value='<?php echo $subCategory->Id  ?>'><?php echo $subCategory->SubCategoryName  ?></option>

<?php endforeach; ?>
