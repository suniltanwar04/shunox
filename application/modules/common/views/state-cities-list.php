<?php
if ($stateId) {

    $cities = callModalFunction('Country_model', 'getCitiesByState', $stateId);

    if ($cities) {
        ?>
        <option selected="selected" value="" disabled="disabled">
            Select City
        </option>
        <?php
        foreach ($cities as $city) {
            echo '<option value="' . $city->Id . '">' . $city->CityName . '</option>';
        }

    } else {
        echo '<option disabled="disabled" selected="selected" value=""> No Available City </option>';
    }
} else {
    echo '<option disabled="disabled" selected="selected" value=""> Select City </option>';
}