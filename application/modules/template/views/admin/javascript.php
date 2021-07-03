<?php
?>


<!-- Bootstrap DateTimePicker -->
<script
        src="<?php echo base_url(); ?>assets/admin/js/plugins/bootstrap-datetimepicker/moment-with-locales.min.js"></script>
<script
        src="<?php echo base_url(); ?>assets/admin/js/plugins/bootstrap-datetimepicker/bootstrap-datetimepicker.js"></script>

<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/admin/js/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/admin/js/app.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url(); ?>assets/admin/js/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url(); ?>assets/admin/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url(); ?>assets/admin/js/plugins/slimScroll/jquery.slimscroll.min.js"></script>

<!-- ChartJS 1.0.1 -->
<script src="<?php echo base_url(); ?>assets/admin/js/plugins/chartjs/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/admin/js/demo.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/admin/js/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/plugins/datatables/dataTables.bootstrap.min.js"></script>


<!--<script src="--><?php //echo base_url(); ?><!--assets/admin/js/plugins/iCheck/icheck.min.js"></script>-->
<!-- Gitter -->
<script src="<?php echo base_url(); ?>assets/admin/js/plugins/gritter/js/jquery.gritter.min.js"></script>


<!-- Papa Parser -->
<script src="<?php echo base_url(); ?>assets/admin/js/papaparse.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>

<!--- Color Picker ----->
<script src="<?php echo base_url(); ?>assets/admin/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/admin/tinymce/js/tinymce/tinymce.min.js"></script>
<?php
if (isset($jquery) && $jquery != '') {
    $this->load->view($jquery);
}


if (isset($common_jquery) && $common_jquery != '') {
    $this->load->view($common_jquery);
}
?>
<script type="text/javascript">
//<![CDATA[
    tinymce.init({
        selector: "#area1",
			plugins: [
			"advlist autolink lists link image charmap print preview anchor",
			"searchreplace visualblocks code fullscreen"
			],
        	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
  //]]>
  </script> 

<script>

    function checkValidEmail(id) {
        $(document).off('blur', '#' + id).on('blur', '#' + id, function (e) {
            e.preventDefault();

            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            var fieldValue = $('#' + id).val();

            if (!regex.test(fieldValue)) {
                $('#' + id + 'Error').show().html('Please enter valid email');
                $('#' + id).focus();
                return false;
            } else {
                return true;
            }


        });
    }

    function allowDashOnly(id) {
        $(document).off('keyup', '#' + id).on('keyup', '#' + id, function (e) {
            e.preventDefault();

            var regex = /^[A-Za-z0-9 -]+$/;
            var fieldValue = $('#' + id).val();

            if (!regex.test(fieldValue)) {
                $('#' + id + 'Error').show().html('Please enter alphabets, numbers or dash.');
                $('#' + id).focus();
                return false;
            } else {
                $('#' + id + 'Error').hide().html('');
                return true;
            }


        });
    }

    function allowStringOnly(id) {
        $(document).off('keyup', '#' + id).on('keyup', '#' + id, function (e) {
            e.preventDefault();

            var regex = /^[A-Za-z0-9 ]+$/;
            var fieldValue = $('#' + id).val();

            if (!regex.test(fieldValue)) {
                $('#' + id + 'Error').show().html('Please enter alphabets or numbers are allowed.');
                $('#' + id).focus();
                return false;
            } else {
                $('#' + id + 'Error').hide().html('');
                return true;
            }


        });
    }

    function checkNumeric(id) {
        $(document).off('keypress', '#' + id).on('keypress', '#' + id, function (e) {
//            $(this).val($(this).val().replace(/[^\d].+/, ""));

            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                $('#' + id + 'Error').css('display', 'block').html('Please enter digits only.');
                $('#' + id).focus();
                return false;
            } else {
                $('#' + id + 'Error').css('display', 'none').html('');
                $('#' + id).focus();
                return true;
            }
        });
    }

    function hideError(id) {
        $(document).off('click', '#' + id).on('click', '#' + id, function (e) {
            $('#' + id + 'Error').html('');
            $('#' + id + 'Error').hide();
        });
        $(document).off('keypress', '#' + id).on('keypress', '#' + id, function (e) {
            var code = (e.keyCode ? e.keyCode : e.which);
            $('#' + id + 'Error').html('');
            $('#' + id + 'Error').hide();
        });
        $(document).off('change', '#' + id).on('change', '#' + id, function (e) {
            $('#' + id + 'Error').html('');
            $('#' + id + 'Error').hide();
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
        $(document).off('keypress', '#' + id).on('keypress', '#' + id, function (e) {

            $(this).val($(this).val().replace(/[^0-9\.]/g, ''));


            if ((e.which != 46 || $(this).val().indexOf('.') != -1) && (e.which < 48 || e.which > 57)) {
                $('#' + id + 'Error').css('display', 'block').html('Please enter valid amount.');
                $('#' + id).focus();
                return false;
            } else {
                $('#' + id + 'Error').css('display', 'none').html('');
                $('#' + id).focus();
                return true;
            }
        });
    }


</script>




