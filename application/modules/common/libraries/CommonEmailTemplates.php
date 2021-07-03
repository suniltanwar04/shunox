<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class CommonEmailTemplates
{

    static function forgetPasswordEmail($user, $password)
    {
        $emailData = array();
        $content = "<p>Hi " . $user->FullName . ",</p>";
        $content .= "<p>New password for your ShoeMade4u account is following.</p>";
        $content .= $password . '<br><br><br>';
        $content .= "<p>Thanks <br> Team ShoeMade4u</p>";
        $content .= "<p><br><br></p>";
        $content .= "<p>Note: If it's not you, you can still login with your old password.</p>";
        $subject = "Reset Password.";

        $emailData['Content'] = $content;
        $emailData['Subject'] = $subject;
        return (object)$emailData;


    }

    static function changePasswordEmail($user, $password)
    {
        $emailData = array();
        $content = "<p>Hi " . $user->FullName . ",</p>";
        $content .= "<p>Password changed successfully.</p>";
        $content .= "<p>New password for your ShoeMade4u account is following.</p>";
        $content .= $password . '<br><br><br>';
        $content .= "<p>Thanks <br> Team ShoeMade4u</p>";
        $content .= "<p><br><br></p>";
        $subject = "Change Password.";

        $emailData['Content'] = $content;
        $emailData['Subject'] = $subject;
        return (object)$emailData;


    }

}