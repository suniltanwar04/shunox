<script src="<?php echo base_url(); ?>assets/site/js/jquery-1.11.1.min.js"></script>

<script src="<?php echo base_url(); ?>assets/site/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/site/js/bootstrap-hover-dropdown.min.js"></script>
<script src="<?php echo base_url(); ?>assets/site/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>assets/site/js/echo.min.js"></script>
<script src="<?php echo base_url(); ?>assets/site/js/jquery.easing-1.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/site/js/bootstrap-slider.min.js"></script>
<script src="<?php echo base_url(); ?>assets/site/js/jquery.rateit.min.js"></script>
<script src="<?php echo base_url(); ?>assets/site/js/lightbox.min.js"></script>
<script src="<?php echo base_url(); ?>assets/site/js/bootstrap-select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/site/js/wow.min.js"></script>
<script src="<?php echo base_url(); ?>assets/site/js/scripts.js"></script>
<script src="<?php echo base_url(); ?>assets/site/js/plugins/gritter/js/jquery.gritter.min.js"></script>
<script src="<?php echo base_url(); ?>assets/site/js/easyzoom.js"></script>
<script src = "https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



<script>

    function checkValidEmail(id) {
        jQuery(document).off('blur', '#' + id).on('blur', '#' + id, function (e) {
            e.preventDefault();

            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var fieldValue = jQuery('#' + id).val();

            if (!regex.test(fieldValue)) {
                jQuery('#' + id + 'Error').show().html('Please enter valid email');
                jQuery('#' + id).focus();
                return false;
            } else {
                return true;
            }


        });
    }

    function checkValidMobile(id) {
        jQuery(document).off('blur', '#' + id).on('blur', '#' + id, function (e) {
            e.preventDefault();


            var regex = /^(\+91-|\+91|0)?\d{10}$/; // indian only
//            var regex = /^\+(?:[0-9] ?){6,14}[0-9]$/; // international format
            var fieldValue = jQuery('#' + id).val();

            if (!regex.test(fieldValue)) {
                jQuery('#' + id + 'Error').show().html('Please enter valid mobile');
                jQuery('#' + id).focus();
                return false;
            } else {
                return true;
            }


        });
    }

    function allowDashOnly(id) {
        jQuery(document).off('keyup', '#' + id).on('keyup', '#' + id, function (e) {
            e.preventDefault();

            var regex = /^[A-Za-z0-9 -]+$/;
            var fieldValue = jQuery('#' + id).val();

            if (!regex.test(fieldValue)) {
                jQuery('#' + id + 'Error').show().html('Please enter alphabets, numbers or dash.');
                jQuery('#' + id).focus();
                return false;
            } else {
                jQuery('#' + id + 'Error').hide().html('');
                return true;
            }


        });
    }

    function allowStringOnly(id) {
        jQuery(document).off('keyup', '#' + id).on('keyup', '#' + id, function (e) {
            e.preventDefault();

            var regex = /^[A-Za-z0-9 ]+$/;
            var fieldValue = jQuery('#' + id).val();

            if (!regex.test(fieldValue)) {
                jQuery('#' + id + 'Error').show().html('Please enter alphabets or numbers are allowed.');
                jQuery('#' + id).focus();
                return false;
            } else {
                jQuery('#' + id + 'Error').hide().html('');
                return true;
            }


        });
    }

    function checkNumeric(id) {
        jQuery(document).off('keypress', '#' + id).on('keypress', '#' + id, function (e) {
//            jQuery(this).val(jQuery(this).val().replace(/[^\d].+/, ""));

            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                jQuery('#' + id + 'Error').css('display', 'block').html('Please enter digits only.');
                jQuery('#' + id).focus();
                return false;
            } else {
                jQuery('#' + id + 'Error').css('display', 'none').html('');
                jQuery('#' + id).focus();
                return true;
            }
        });
    }

    function hideError(id) {
        jQuery(document).off('click', '#' + id).on('click', '#' + id, function (e) {
            jQuery('#' + id + 'Error').html('');
            jQuery('#' + id + 'Error').hide();
        });
        jQuery(document).off('keypress', '#' + id).on('keypress', '#' + id, function (e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            jQuery('#' + id + 'Error').html('');
            jQuery('#' + id + 'Error').hide();
        });
        jQuery(document).off('change', '#' + id).on('change', '#' + id, function (e) {
            jQuery('#' + id + 'Error').html('');
            jQuery('#' + id + 'Error').hide();
        });
    }

    function checkImageExt(fileName) {
        var extension = fileName.split('.').pop();
        switch (extension) {
            case 'jpg':
            case 'png':
            case 'gif':
                return true
            default:
                return false
        }

    }

    function checkNumericDecimal(id) {
        jQuery(document).off('keypress', '#' + id).on('keypress', '#' + id, function (e) {

            jQuery(this).val(jQuery(this).val().replace(/[^0-9\.]/g, ''));


            if ((e.which != 46 || jQuery(this).val().indexOf('.') != -1) && (e.which < 48 || e.which > 57)) {
                jQuery('#' + id + 'Error').css('display', 'block').html('Please enter valid amount.');
                jQuery('#' + id).focus();
                return false;
            } else {
                jQuery('#' + id + 'Error').css('display', 'none').html('');
                jQuery('#' + id).focus();
                return true;
            }
        });
    }


</script>
<script type="text/javascript">
$(document).ready(function(){
		jQuery("#itemSearchForm").on('submit', function(e){
        e.preventDefault();
        var keyword = jQuery("#searchedKey").val();
        if(keyword != ""){
          
          window.location.href = '<?php echo base_url();?>'+'search/'+keyword;
        }else{
            return false;
        }
    });
	$(".post-4389 li").click(function(){
		$(this).siblings().removeClass('active');
	});
});

</script>

			<script type="text/javascript">

				jQuery(function($){
					$('a.zoom1').easyZoom();
					$('a.zoom2').easyZoom();
				});

			</script>


<?php
if (isset($jquery) && $jquery != '') {
    $this->load->view($jquery);
}
