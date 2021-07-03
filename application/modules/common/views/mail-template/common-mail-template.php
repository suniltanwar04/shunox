<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>{title}</title>
    <style>
        * {
            font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
            font-size: 100%;
            line-height: 1.6em;
            margin: 0;
            padding: 0;
        }

        img {
            max-width: 600px;
            width: auto;
        }

        a {
            color: #20BDBD;
        }



        .last {
            margin-bottom: 0;
        }

        .first {
            margin-top: 0;
        }

        .padding {
            padding: 10px 0;
        }

        table.body-wrap {
            padding: 20px;
            width: 100%;
        }

        table.body-wrap .container {
            border: 1px solid #f0f0f0;
        }

        table.footer-wrap {
            clear: both !important;
            width: 100%;
        }

        .footer-wrap .container p {
            color: #666666;
            font-size: 12px;

        }

        table.footer-wrap a {
            color: #999999;
        }

        h1,
        h2,
        h3 {
            color: #111111;
            font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
            font-weight: 200;
            line-height: 1.2em;
            margin: 40px 0 10px;
        }

        h1 {
            font-size: 36px;
        }
        h2 {
            font-size: 28px;
        }
        h3 {
            font-size: 22px;
        }

        p,
        ul,
        ol {
            font-size: 14px;
            font-weight: normal;
            margin-bottom: 10px;
        }

        ul li,
        ol li {
            margin-left: 5px;
            list-style-position: inside;
        }

    </style>
</head>

<body bgcolor="#f6f6f6" style="-webkit-font-smoothing: antialiased; height: 100%; -webkit-text-size-adjust: none; width: 100% !important;">

<!-- body -->
<div style="width:100%;text-align:center"> 
	<img src="<?php echo base_url(); ?>assets/site/images/logo.png" width="250px" style="width: 250px !important;">
</div>
<table class="body-wrap" bgcolor="#f6f6f6" style=" width: 100%; padding: 20px;">
    <tr>
        <td></td>
        <td class="container" bgcolor="#FFFFFF" style="padding: 20px;clear: both !important;  display: block !important;  Margin: 0 auto !important;  max-width: 600px !important;">

            <!-- content -->
            <div class="content" style="display: block; margin: 0 auto; max-width: 600px;">
                <table style="width: 100%;">
                    <tr>
                        <td>
                            {content}
                        </td>
                    </tr>
                </table>
            </div>
            <!-- /content -->

        </td>
        <td></td>
    </tr>
</table>
<!-- /body -->

<!-- footer -->
<table class="footer-wrap">
    <tr>
        <td></td>
        <td class="container">
        </td>
        <td></td>
    </tr>
</table>
<!-- /footer -->

</body>
</html>