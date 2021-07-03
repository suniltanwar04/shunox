<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<style>
body{
    margin: 0;
    padding: 0;
    font-family: Arial;
}
.pdf_wrapper{
    margin: 0 auto;
    width: 1000px;
    height: auto;
    padding: 15px;
    box-sizing: border-box;
    /* border: 1px solid #000; */
}
.pdf_container{
    width: 100%;
    height: auto;
    /*border: 1px dotted #000;*/
    padding-left: 25px;
    padding-right: 25px;
    padding-bottom: 25px;
    box-sizing: border-box;
}
.tr1{
    border-bottom: 2pt solid #000;
    display: flex;
    width: 100%;
    height: 35px;
}
table{
    width:100%; 
    border-collapse: collapse;
}
/* table tr{
    border-bottom: 2px solid #000; 
} */
.hr{
    height: 2px;
    width: 150px;
    margin: 1px auto;
    /* color: #000; */
    background-color: #000;
    border: none
}
</style>
    <div class="wrapper pdf_wrapper">
        <div class="container pdf_container">
            <table cellpadding="0" cellspacing="0" >
				<tr>
				<td>
					<br>
				<div> 
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	<img src="<?php echo base_url(); ?>assets/site/images/logo.png" width="350px" style="width: 350px !important;" height="140px">
				</div>
				</td>
                <td> 
					
                    <p style="text-align:center;margin-bottom: 0;font-weight: 900; font-size:22px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Globus Nexgen Tradex Pvt Ltd</p>
                    <p style="text-align:center;margin: 0;font-size:19px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;E-189, Sector 63, Noida, U.P.- 201301</p>
<p style="text-align:center;margin: 0;font-size:19px;">Website :- www.shunox.in</p>
<p style="text-align:center;margin: 0;font-size:19px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Email :- customercare@shunox.in</p>
                </td>
				</tr>
            </table> 
			<table style="margin-top:10px;width:1000px;">
				<tr><td style="width:150px;font-size:15px;padding:5px">Foot Scanner Developed With</td><td style="font-size:15px;padding:5px"> &nbsp;&nbsp;&nbsp;&nbsp;I.I.T. Delhi & Technical know-how from USA & Taiwan</td></tr>
				
				<tr><td style="font-size:15px;padding:5px ">Foot Orthotics Designed With</td><td style="font-size:15px;padding:5px">&nbsp;&nbsp;&nbsp;&nbsp;Dr.Siddharth Gupta, M.B.B.S., M.S.(Ortho) Gold medallist, FIAA, UK, Mob.8588881146, Adarsh Hospital, Delhi</td></tr>
                <tr><td style="font-size:15px;padding:5px">Foot-wear Designed With</td><td style="font-size:15px;padding:5px">&nbsp;&nbsp;&nbsp;&nbsp;Prof. Alok Mittal, Ex. Chief Designer & HOD, Footwear Division, F.D.D.I. Govt. College, Noida</td></tr>
			</table>
           
            <img src="<?php echo $lists['scanImages'];?>" width="975px;" height="600px;" style="margin-left:0px;padding:5px">
     
            <table cellpadding="0" cellspacing="0" style="height: 100px;">
				
                <tr>
					<td>Scan Date :<?php echo $lists['scDate'];?></td>
					<td><b>Name: </b><?php echo $lists['CustName'];?></td>
					<td>DOB: <?php echo $lists['DOB'];?></td>
					<td>Height: <?php echo $lists['Foot_Height'];?></td>
                    
                </tr>
	
				<tr>
					<td >Scan No: <?php echo $lists['ScanNo'];?></td>
					<td >Mobile : <?php echo $lists['Mobile'];?></td>
					<td >Sex: <?php echo $lists['Sex'];?></td>
					<td >Weight: <?php echo $lists['Foot_Width'];?></td>
					
                    
				</tr>
				<tr>
					<td >Cust. No: <?php echo $lists['CustomerNo'];?></td>
					<td >Email : <?php echo $lists['EmailID'];?></td>
					<td ></td>
					<td >Daibetic: <?php echo $lists['Is_Diabetic'];?></td>
				</tr>
            </table>
			<hr style="width:975px;border: .5px solid #000;margin-top:-4px;">
			<div class=row style="margin-top:-10px;">
				<div class="col">
<P class="p4 ft8" style="text-align:center;font-weight:bold;font-size:19px;">Foot Pressure %</P>
<TABLE cellpadding=0 cellspacing=0 class="t2" style="border: 2px solid #000;margin-left:0px;margin-top: -10px;width:455;">
<TR>
	<TD colspan=2 class="tr4 td8" style="border-right: 2px solid #000"><P class="p5 ft6" style="text-align:center;font-weight:bold;font-size:17px;margin-top:5px;">Left Foot</P></TD>
	<TD colspan=2 class="tr4 td9"><P class="p6 ft6" style="text-align:center;font-weight:bold;font-size:17px;margin-top:5px;">Right Foot</P></TD>
</TR>
<TR>
	<TD class="tr4 td10" style="width:30%;padding-bottom:11px;">&nbsp;Forefoot %</TD>
	<TD class="tr4 td11" style="border-right: 2px solid #000;padding-bottom:11px;">: <?php echo round($lists['L_Forefoot'],2)?></TD>
	<TD class="tr4 td12" style="padding-bottom:11px;">&nbsp;Forefoot %</TD>
	<TD class="tr4 td13" style="padding-bottom:11px;">:<?php echo round($lists['R_Forefoot'],2)?></TD>
</TR>
<TR>
	<TD class="tr0 td10" style="width:10px;padding-bottom:11px;">&nbsp;Heel %</TD>
	<TD class="tr0 td11" style="border-right: 2px solid #000;padding-bottom:11px;">: <?php echo round($lists['L_Heel'],2)?></TD>
	<TD class="tr0 td12" style="padding-bottom:11px;">&nbsp;Heel %</TD>
	<TD class="tr0 td13" style="padding-bottom:11px;">: <?php echo round($lists['R_Heel'],2)?></TD>
</TR>
<TR style="border-bottom: 2px solid #000;">
	<TD class="tr0 td10" style="width:10px;padding-bottom:11px;">&nbsp;Foot total %</TD>
	<TD class="tr0 td11" style="border-right: 2px solid #000;padding-bottom:11px;">: <?php echo round($lists['L_TotalPressure'],2)?></TD>
	<TD class="tr0 td12" style="padding-bottom:11px;">&nbsp;Foot total %</TD>
	<TD class="tr0 td13" style="padding-bottom:11px;">: <?php echo round($lists['R_TotalPressure'],2)?></TD>
</TR>
	
	
<TR>
	
	<TD class="tr4 td10" style="padding-top:8px;">&nbsp;Arch %</TD>
	<TD class="tr4 td11" style="border-right: 2px solid #000;padding-top:8px;">: <?php echo round($lists['L_Arch'],2)?></TD>
	<TD class="tr4 td12" style="padding-top:8px;">&nbsp;Arch %</TD>
	<TD class="tr4 td13" style="padding-top:8px;">: <?php echo round($lists['R_Arch'],2)?></TD>
</TR>
<TR style="border-bottom: 2px solid #000">
	<TD class="tr0 td10" style="padding-top:5px;padding-bottom:10px;">&nbsp;Arch type</TD>
	<TD class="tr0 td11" style="border-right: 2px solid #000;">: <?php echo $lists['L_ArchType']?></TD>
	<TD class="tr0 td12" style="padding-top:5px;">&nbsp;Arch type</TD>
	<TD class="tr0 td13">: <?php echo $lists['R_ArchType']?></TD>
</TR>

<TR>
	<TD class="tr6 td10">&nbsp;</TD>
	<TD class="tr6 td11" style="border-right: 2px solid #000; padding-bottom:8px;">mm</TD>
	<TD class="tr6 td12">&nbsp;</TD>
	<TD class="tr6 td13" style="padding-bottom:8px;">mm</TD>
</TR>
<TR>
	<TD class="tr7 td10" style="padding-bottom:11px;">&nbsp;Ball Joint (L)</TD>
	<TD class="tr7 td11" style="border-right: 2px solid #000;padding-bottom:11px;">: <?php echo $lists['L_Lateraljoint']?></TD>
	<TD class="tr7 td12" style="padding-bottom:11px;">&nbsp;Ball Joint (L)</TD>
	<TD class="tr7 td13" style="padding-bottom:11px;">: <?php echo $lists['R_Lateraljoint']?></TD>
</TR>
<TR>
	<TD class="tr7 td10" style="padding-bottom:11px;">&nbsp;Ball Joint (M) </TD>
	<TD class="tr0 td18" style="border-right: 2px solid #000;padding-bottom:11px;">: <?php echo $lists['L_Medialjoint']?></TD>
	<TD class="tr7 td10" style="padding-bottom:11px;">&nbsp;Ball Joint (M)</TD>
	<TD class="tr0 td2" style="padding-bottom:11px;">: <?php echo $lists['R_Medialjoint']?></TD>
</TR>
<TR>
	<TD class="tr0 td10" style="padding-bottom:11px;">&nbsp;Foot width</TD>
	<TD class="tr0 td11" style="border-right: 2px solid #000;padding-bottom:11px;">: <?php echo round($lists['L_Width'],2)?></TD>
	<TD class="tr0 td12" style="padding-bottom:11px;">&nbsp;Foot width</TD>
	<TD class="tr0 td13" style="padding-bottom:11px;">: <?php echo round($lists['R_Width'],2)?></TD>
</TR>
<TR style="border-bottom: 2px solid #000">
	<TD class="tr0 td10" style="padding-bottom:11px;">&nbsp;Foot length</TD>
	<TD class="tr0 td11" style="border-right: 2px solid #000;padding-bottom:1!px;">: <?php echo round($lists['L_Length'],2)?></TD>
	<TD class="tr0 td12" style="padding-bottom:11px;">&nbsp;Foot length</TD>
	<TD class="tr0 td13" style="padding-bottom:11px;">: <?php echo round($lists['R_Length'],2)?></TD>
</TR>

<TR>
	<TD class="tr8 td10" style="padding-top:8px;">&nbsp;<b>Foot type<b></TD>
	<TD class="tr8 td11" style="border-right: 2px solid #000;padding-top:8px;">: <b><?php echo $lists['L_Foottype']?></b></TD>
		<TD class="tr8 td10" style="padding-top:8px;">&nbsp;<b>Foot type</b></TD>
		<TD class="tr8 td2" style="padding-top:8px;">: <b><?php echo $lists['R_Foottype']?></b></TD>
</TR>
<TR style="border-bottom: 2px solid #000">
	<TD class="tr0 td10" style="padding-top:8px;padding-bottom:11px;">&nbsp;<b>Shoe size</b></TD>
	<TD class="tr0 td11" style="border-right: 2px solid #000;padding-top:8px;padding-bottom:11px;">: <b><?php echo $lists['L_Shoesize']?></b></TD>
	<TD class="tr0 td10" style="padding-top:8px;padding-bottom:11px;">&nbsp;<b>Shoe size</b></TD>
	<TD class="tr0 td2" style="padding-top:8px;padding-bottom:11px;">: <b><?php echo $lists['R_Shoesize']?></b></TD>
</TR>
		
	
<TR>
	<TD colspan=4 style="padding-top:10px;padding-bottom:10px">&nbsp;<b>Recommended Model: <?php echo $lists['RecmModel']?></b></TD>
	
	
	
</TR>
</TABLE>
</div>
<div class="col" style="margin-right:-60px;">
	
	<P class="p0 ft8" style="text-align:center;font-weight:bold;font-size:19px;">Dealer detail</P>
<table  class="t3" style="border:2px solid #000;margin-top: -10px; width:92%">
	<TR>
		<TD></TD>
		<TD></TD>
	</TR>
	<TR>
		<TD></TD>
		<TD></TD>
	</TR>
	<TR>
		<TD></TD>
		<TD></TD>
	</TR>
	<TR>
		<TD></TD>
		<TD></TD>
	</TR>
<TR>

	<TD class="tr4 td24"><P class="p7 ft2">&nbsp;Name :</P></TD>
	<TD class="tr4 td25"><P class="p0 ft0"><?php echo $lists['clientName']?></P></TD>
</TR>
<TR>
	<TD class="tr0 td24"><P class="p7 ft2">&nbsp;Add :</P></TD>
	<TD class="tr0 td25"><P class="p0 ft0"><?php echo $lists['clientAddress']?></P></TD>
</TR>
<TR>
	<TD class="tr11 td25"><P class="p21 ft2">&nbsp;Dealer ID :&nbsp;<?php echo $lists['ClientID']?></P></TD>
	<TD class="tr11 td24" style='border-right;solid 1px #000'><P class="p7 ft2"></P></TD>
</TR>
<TR>
	<TD class="tr0 td25"><P class="p21 ft2">&nbsp;Mob.:&nbsp;<?php echo $lists['clientMobile']?></P></TD>
	<TD class="tr0 td25"><P class="p21 ft2">&nbsp;Tel.:&nbsp;<?php echo $lists['clientPhone']?></P></TD>
</TR>

	</table>

	<table>
<TR >
	<TD class="tr8 td27" style="padding-top:14px;"><P class="p22 ft13" style="text-align:center;font-size:18px;font-weight:bold">Hospital's near you for further consultation</P></TD>
</TR>
</table>
	
<table cellpadding=0 cellspacing=0  style="border:2px solid #000; width:92%">
		<TR>
		<TD ></TD>
		
		<TD style="border-right: 2px solid #000">&nbsp;</TD>
	</TR>
<TR>
	<TD class="tr4 td24" style="width:30%"><P class="p7 ft2">&nbsp;Hospital name :</P></TD>
	<TD class="tr4 td25"><P class="p0 ft0"><?php echo $lists['Hospital']?></P></TD>
</TR>
<TR>
	<TD class="tr0 td24"><P class="p7 ft2">&nbsp;Dr. Name :</P></TD>
	<TD class="tr0 td25"><P class="p0 ft0"><?php echo $lists['DoctorName']?></P></TD>
</TR>
<TR>
	<TD class="tr0 td24"><P class="p7 ft2">&nbsp;Add :</P></TD>
	<TD class="tr0 td25"><P class="p0 ft0"><?php echo $lists['DoctorAddress']?></P></TD>
</TR>
<TR>
	<TD class="tr11 td24"><P class="p7 ft2">&nbsp;City :</P></TD>
	<TD class="tr11 td25"><P class="p0 ft0"><?php echo $lists['DoctorCity']?></P></TD>
</TR>
<TR>
	<TD class="tr0 td24"><P class="p7 ft2">&nbsp;Pin : <?php echo $lists['DoctorPin']?></P></TD>
	<TD class="tr0 td25"><P class="p23 ft2">Tel.: <?php echo $lists['DoctorPhone']?></P></TD>
</TR>
<TR>
	<TD colspan=2 class="tr0 td24" ><P class="p7 ft2">&nbsp;State : <?php echo $lists['DoctorState']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mob.: <?php echo $lists['DoctorMobile']?></P>
	</TD>
	<!--<TD class="tr0 td25" style="padding-top:10px"><P class="p23 ft2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mob.: <?php echo $lists['DoctorMobile']?></P></TD>-->
</TR>
</table>
	<div style="padding-top:25px">
		<span style="font-weight:bold">Note:</span>&nbsp;Print this foot scan report for consultation with a certified doctor/podiatrist.
	</div>
</div>		
</div>
      </div>
    </div>
<script>
$(window).load(function(){
	window.print();
});
</script>