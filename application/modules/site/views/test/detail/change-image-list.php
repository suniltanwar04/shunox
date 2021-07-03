<?php
$imagePath = base_url().'uploads/products/attr/';
?>

<a href="<?php echo $imagePath.$mainImage->image; ?>" class="zoom">
                    <img src="<?php echo $imagePath.$mainImage->image; ?>"  alt="" style="max-width:80% !important;">
                    </a>
<script src="<?php echo base_url(); ?>assets/site/js/easyzoom.js"></script>
<script type="text/javascript">

    jQuery(function($){

        $('a.zoom').easyZoom();

    });

</script>

<style>

    /*

    Copy/paste this into your own stylesheet.
    Edit width, height and placement of the dynamically created image zoom box.

    */

    #easy_zoom{

        width:600px;
        height:400px;
        border:5px solid #eee;
        background:#fff;
        color:#333;
        position:absolute;
        top:190px !important;
        left:550px;
        overflow:hidden;
        -moz-box-shadow:0 0 10px #777;
        -webkit-box-shadow:0 0 10px #777;
        box-shadow:0 0 10px #777;
        /* vertical and horizontal alignment used for preloader text */
        line-height:400px;
        text-align:center;
    }

</style>
