<?php
if ($CategoryId) {
    $subcategories = callModelFunction('AdminCategory_model', 'getSubCategoryByCategory', $CategoryId);

    if ($subcategories) {
        ?>
        <option selected="selected" value="" disabled="disabled">
            Select Sub-Category
        </option>
        <?php
        foreach ($subcategories as $subcategory) {
            echo '<option value="' . $subcategory->Id . '">' . $subcategory->SubCategoryName . '</option>';
        }

    } else {
        echo '<option disabled="disabled" selected="selected" value=""> No Available State </option>';
    }
} else {
    echo '<option disabled="disabled" selected="selected" value=""> Select Sub-Category </option>';
}