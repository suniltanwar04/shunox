
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="assets/src/jquery.picZoomer.js"></script>
<script type="text/javascript">
    $(function() {
        $('.picZoomer').picZoomer();


        //切换图片
        $('.piclist li').on('click',function(event){
            var $pic = $(this).find('img');
            $('.picZoomer-pic').attr('src',$pic.attr('src'));
        });
    });
</script>


<script type="text/javascript">
    function validateForm() {
        if (isEmpty(document.getElementById('data_11').value.trim())) {
            alert('Reviewer is required!');
            return false;
        }
        if (isEmpty(document.getElementById('data_4').value.trim())) {
            alert('Title is required!');
            return false;
        }
        if (isEmpty(document.getElementById('data_8').value.trim())) {
            alert('Review is required!');
            return false;
        }
        if (!document.getElementById('data_9_0').checked && !document.getElementById('data_9_1').checked && !document.getElementById('data_9_2').checked ) {
            alert('Would you recommend this product? is required!');
            return false;}
        return true;
    }
    function isEmpty(str) { return (str.length === 0 || !str.trim()); }
    function validateEmail(email) {
        var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,15}(?:\.[a-z]{2})?)$/i;
        return isEmpty(email) || re.test(email);
    }
</script>