<script>

jQuery(document).ready(function () {

    $(document).off('change', '#country').on('change', '#country', function (e) {
        e.preventDefault;

        var country = $("#country").val();

        $.ajax({
            type: "POST",
            data: {
                'country': country
            },
            url: $('#base_url').val() + "getState",
            success: function (result) {

                $('#state').html(result)
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });
    });

    $(document).off('change', '#state').on('change', '#state', function (e) {
        e.preventDefault;

        var state = $("#state").val();

        $.ajax({
            type: "POST",
            data: {
                'state': state
            },
            url: $('#base_url').val() + "getCity",
            success: function (result) {

                $('#city').html(result)
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });
    });

    $(document).off('click', '#searchScanLoc').on('click', '#searchScanLoc', function (e) {
        
        e.preventDefault;

        var city_id = $("#city").val();
        if(city_id > 0){

        $.ajax({
            type: "POST",
            data: {
                'city_id': city_id
            },
            url: $('#base_url').val() + "search-location",
            success: function (result) {

                $('#row_location').html(result)
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            }
        });
        }
    });

});



</script>
