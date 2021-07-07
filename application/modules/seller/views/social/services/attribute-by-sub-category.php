
<?php if($attributes): ?>
  <option value="">Select Product Attribute</option>
<?php foreach($attributes as $attribute):  ?>
  <option value="<?php echo $attribute->AttributeId; ?>"><?php echo $attribute->AttributeName; ?></option>
<?php endforeach; ?>
<?php else: ?>
  <option value=''>No Attributes Found</option>
<?php endif; ?>
