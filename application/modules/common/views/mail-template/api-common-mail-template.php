<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>{title}</title>
</head>
<style>

body{
    font-family: Arial, Helvetica, sans-serif;
    font-size: 13px;
}
p{
    margin-left: 15px;
}

</style>
<body>

<div style="width:600px;margin:0 auto;background:#ccc;padding:15px 0;">
    <div style="width:100%;text-align:center"> 
        <img src="<?php echo base_url(); ?>assets/site/images/logo.png" width="250px">
    </div>
    <h3 style="margin-left: 15px">Hi <span style="color:#db3484;">{fullName}</span>,</h3>
    <div style="width:100%;padding: 1px 0px;background: #db3484;box-sizing: border-box;">
        <p style="color: #fff;"><b>Your Shunox login details</b></p>
    </div>
    <p><b>Thank you for registering with SHUNOX.</b></p>
    <p>Here are your login details:</p>
    <p>E-mail address: <a href="#">{email} </a></p>
    <p>Password: <b>{mobile}</b></p>
    
    <p><b>Important Security Tips:</b></p>
    <ul style="list-style:decimal">
        <li>Always keep your account details safe.</li>
        <li>Never disclose your login details to anyone.</li>
        <li>Change your password regularly.</li>
        <li>Should you suspect someone is using your account illegally, please notify us immediately</li>
    </ul>
    <p>you can now Login to our website & select your favourite Item:: <a href="www.shunox.in/login">SHUNOX.</a></p>
</div>
</body>
</html>
