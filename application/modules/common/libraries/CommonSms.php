<?php

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class CommonSms
{

    static function mobileSms($mobileNumber, $message)
    {
        $authKey = "134419AHIwsrrvh585918a2";
//        $mobileNumber = "9555436989";
        $senderId = "KHDGHR";
        $route = "4";
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $senderId,
            'route' => $route
        );
        $url = "https://control.msg91.com/api/sendhttp.php";
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
            //,CURLOPT_FOLLOWLOCATION => true
        ));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($ch);
        if (curl_errno($ch)) {
            //echo 'error:' . curl_error($ch);
        } else {

            //echo 'success:' . $output;

        }

        curl_close($ch);


    }

}
