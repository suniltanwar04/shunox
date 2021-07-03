<?php
if ($countryId) {
    $states = callModalFunction('Country_model', 'getStatesByCountry', $countryId);
    if ($states) {
        ?>
        <option selected="selected" value="" disabled="disabled">
            Select State
        </option>
        <?php
        foreach ($states as $state) {
            echo '<option value="' . $state->Id . '">' . $state->StateName . '</option>';
        }

    } else {
        echo '<option disabled="disabled" selected="selected" value=""> No Available State </option>';
    }
} else {
    echo '<option disabled="disabled" selected="selected" value=""> Select State </option>';
}