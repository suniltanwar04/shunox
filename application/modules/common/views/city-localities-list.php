<?php
if ($cityId) {

    $localities = callModalFunction('Country_model', 'getLocalitiesByCity', $cityId);

    if ($localities) {
        ?>
        <option selected="selected" value="" disabled="disabled">
            Select Locality
        </option>
        <?php
        foreach ($localities as $locality) {
            echo '<option locality-lat="'.$locality->Latitude.'" locality-lng="'.$locality->Longitude.'" value="' . $locality->Id . '">' . $locality->LocalityName . '</option>';
        }

    } else {
        echo '<option disabled="disabled" selected="selected" value=""> No Available Locality </option>';
    }
} else {
    echo '<option disabled="disabled" selected="selected" value=""> Select Locality </option>';
}