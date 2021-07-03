<?php
/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */

class CommonPush
{

    static function androidPush($deviceToken, $outputs)
    {

        $url = 'https://android.googleapis.com/gcm/send';
        $registrationIDs = array($deviceToken);

        $message = $outputs;
        $headers = array(
            'Authorization: key=AIzaSyBo_WFKQnqFB7tGDpzOTUGxvPb92vpzvIc',
            'Content-Type: application/json'
        );
        $fields = array(
            'registration_ids' => $registrationIDs,
            'data' => $message,
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        } else {
            //echo $result;
        }
        curl_close($ch);
    }


    static function sendJobNotificationPush($deviceToken, $jobId, $content)
    {
        $output = array("message" => $content, "job_id" => $jobId, "push_type" => ApiConstants::NEW_JOB_NOTIFY_PUSH);
        $push = self::androidPush($deviceToken, $output);
        return $push;
    }

    static function sendSessionNotificationPush($deviceToken, $sessionId, $content)
    {
        $output = array("message" => $content, "session_id" => $sessionId, "push_type" => ApiConstants::NEW_SESSION_NOTIFY_PUSH);
        $push = self::androidPush($deviceToken, $output);
        return $push;
    }


    static function sendGroupPush($deviceToken, $subject, $content)
    {
        $output = array("message" => $content, "subject" => $subject, "push_type" => ApiConstants::GROUP_PUSH);
        $push = self::androidPush($deviceToken, $output);
        return $push;
    }


}
