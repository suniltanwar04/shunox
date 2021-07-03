
<div class="main-container default-page"><header class="entry-header">
        <h1 class="entry-title">Find doctors by pincode and city</h1>
    </header>
    <div class="clearfix">&nbsp;</div>
    <div class="container">
        <div class="breadcrumbs" style="margin-bottom: 15px;"><a href="http://www.shunox.in/">Home</a><span class="separator">/</span> Our Doctors</div>
        <form id="seacrhLocation1" method="post" action="<?php echo base_url();?>">
            <input type="hidden" id="base_url" name="base_url" value="<?php echo base_url();?>">
        <div class="col-md-2" style="margin-top: 5px">
			<label>Pincode</label>
            <input type="text" id="pincode" name="pincode" class="form-control" placeholder="Enter Pincode">
               
        </div>
        <div class="col-md-1" style="margin-top:35px">
			<label>Or</label>
		</div>
        <div class="col-md-2" style="margin-top: 5px">
			<label>City</label>
            <input type="text" id="city" name="city" class="form-control">
        </div>
        <div class="col-md-2" style="margin-top: 30px">
           <input type="button" value="Search" class="login_btn" id="searchDoc1">
		
        </div>
			<div class="col-md-2" style="margin-top: 30px">
           
			<input type="button" value="Refresh" class="login_btn" id="refresh">
        </div>
            </form>
		<span id="userNameError"></span>
        <div class="clearfix">&nbsp;</div>
        <div class="clearfix">&nbsp;</div>
        <div class="row" id="row_location">
        </div>

<table id="mytable" class="table table-dark">
</table>
		<span id="dataError" style="color:red;display:none;">Currently, No Doctor on our panel in your area</span>		
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
</script>
<script>
jQuery(document).ready(function () {
    jQuery('#refresh').on('click', function (e) {
		e.preventDefualt;
		window.location.reload();
	});
});
</script>
<script>
jQuery(document).ready(function () {
    jQuery('#searchDoc1').on('click', function (e) {
		e.preventDefualt;
		
            var pincode = jQuery("#pincode").val();
            var city = jQuery("#city").val();

if (pincode!=null && pincode!="") {
				jQuery.ajax({
                    type: "POST",
                    data: {
                        'pincode': pincode,
                    },
                    url: 'https://shunox.in/' + 'search-doctors',
                    success: function (result) {
						console.log(result)
						var obj = JSON.parse(JSON.parse(result));
	jQuery('#mytable').css('display','block');					
let table = '<thead><tr><th scope="col">#</th><th scope="col">Name</th><th scope="col">Mobile</th><th scope="col">Address</th><th scope="col">City</th><th scope="col">Country</th><th scope="col">State</th><th scope="col">Pin</th><th scope="col">Hospital Name</th></tr>  </thead><tbody>';						
var count = 1;
if(obj.getDoctorListByPinResult.length>0){
for(var i=0;i<obj.getDoctorListByPinResult.length;i++){
	table += '<tr><td>'+count+'</td>';
	table += '<td>'+obj.getDoctorListByPinResult[0]["DoctorName"]+'</td>';
	table += '<td>'+obj.getDoctorListByPinResult[0]["DoctorMobile"]+'</td>';
	table += '<td>'+obj.getDoctorListByPinResult[0]["DoctorAddress"]+'</td>';
	table += '<td>'+obj.getDoctorListByPinResult[0]["DoctorCity"]+'</td>';
	table += '<td>'+obj.getDoctorListByPinResult[0]["DoctorCountry"]+'</td>';
	table += '<td>'+obj.getDoctorListByPinResult[0]["DoctorState"]+'</td>';
	table += '<td>'+obj.getDoctorListByPinResult[0]["DoctorPin"]+'</td>';
	table += '<td>'+obj.getDoctorListByPinResult[0]["Hospital"]+'</td></tr>';
	count++;
}
table += '</tbody>';
jQuery('#mytable').empty().html(table);
jQuery('#dataError').css('display','none');
	
}else{
jQuery('#dataError').css('display','block');
jQuery('#mytable').css('display','none');
}
						
						
},
 error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert("Status: " + textStatus);
                        alert("Error: " + errorThrown);
                    }
});
				
}else if(city!=null && city!=""){
jQuery.ajax({
            type: "POST",
            data: { 'city':city},
            url: 'https://shunox.in/' + 'search-doctors',
            success: function (result) {
				
            var obj = JSON.parse(JSON.parse(result));
jQuery('#mytable').css('display','block');
let table = '<thead><tr><th scope="col">#</th><th scope="col">Name</th><th scope="col">Mobile</th><th scope="col">Address</th><th scope="col">City</th><th scope="col">Country</th><th scope="col">State</th><th scope="col">Pin</th><th scope="col">Hospital Name</th></tr>  </thead><tbody>';						
var count = 1;
if(obj.getDoctorListByCityResult.length>0){				
for(var i=0;i<obj.getDoctorListByCityResult.length;i++){
	table += '<tr><td>'+count+'</td>';
	table += '<td>'+obj.getDoctorListByCityResult[0]["DoctorName"]+'</td>';
	table += '<td>'+obj.getDoctorListByCityResult[0]["DoctorMobile"]+'</td>';
	table += '<td>'+obj.getDoctorListByCityResult[0]["DoctorAddress"]+'</td>';
	table += '<td>'+obj.getDoctorListByCityResult[0]["DoctorCity"]+'</td>';
	table += '<td>'+obj.getDoctorListByCityResult[0]["DoctorCountry"]+'</td>';
	table += '<td>'+obj.getDoctorListByCityResult[0]["DoctorState"]+'</td>';
	table += '<td>'+obj.getDoctorListByCityResult[0]["DoctorPin"]+'</td>';
	table += '<td>'+obj.getDoctorListByCityResult[0]["Hospital"]+'</td></tr>';
	count++;
}
table += '</tbody>';
jQuery('#mytable').empty().html(table);
	jQuery('#dataError').css('display','none');
}else{
jQuery('#dataError').css('display','block');
jQuery('#mytable').css('display','none');	
}						
						

},
 error: function (XMLHttpRequest, textStatus, errorThrown) {
                        alert("Status: " + textStatus);
                        alert("Error: " + errorThrown);
                    }
                });
}});
          
});

</script>


