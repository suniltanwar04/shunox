<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Amit
 * Date: 22-10-2016
 * Time: PM 08:30
 */
class CommonHelpers{

    static function adminAddress(){
        $admin = array();

        $admin['Name'] = 'Shunox';
        $admin['Address'] = '105 Hargobind enclave';
        $admin['City'] = 'Delhi';
        $admin['State'] = 'Delh  – INDIAi';
        $admin['Pin'] = '110092';
        $admin['Contact'] = '9911088339';
        $admin['Email'] = 'krishnakantyadav511@gmail.com';

        return (object)$admin;

    }

    static function generatePassword()
    {
        $alphas = "abcdefghijklmnopqrstuvwxyz@&()#$12345";
        $alphaLength = strlen($alphas);
        $randomString = '';
        for ($i = 1; $i <= 5; $i++) {
            $randNum = floor(rand(0, 5));
            $randomString .= $randNum;
        }

        for ($i = 1; $i <= 2; $i++) {
            $randomString .= $alphas[rand(0, $alphaLength - 1)];
        }

        return $randomString;

    }

    static function generateCode()
    {
        $length = 4;
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        return 'CODE-' . $string;
    }

    static function dateDiff($time1, $time2, $precision = 6)
    {
        // If not numeric then convert texts to unix timestamps
        if (!is_int($time1)) {
            $time1 = strtotime($time1);
        }
        if (!is_int($time2)) {
            $time2 = strtotime($time2);
        }

        // If time1 is bigger than time2
        // Then swap time1 and time2
        if ($time1 > $time2) {
            $ttime = $time1;
            $time1 = $time2;
            $time2 = $ttime;
        }

        // Set up intervals and diffs arrays
        $intervals = array('year', 'month', 'day', 'hour', 'minute', 'second');

//    $intervals = array('ani', 'luni', 'zile', 'ore', 'minute', 'secunde');
        $diffs = array();

        // Loop thru all intervals
        foreach ($intervals as $interval) {
            // Create temp time from time1 and interval
            $ttime = strtotime('+1 ' . $interval, $time1);
            // Set initial values
            $add = 1;
            $looped = 0;
            // Loop until temp time is smaller than time2
            while ($time2 >= $ttime) {
                // Create new temp time from time1 and interval
                $add++;
                $ttime = strtotime("+" . $add . " " . $interval, $time1);
                $looped++;
            }

            $time1 = strtotime("+" . $looped . " " . $interval, $time1);
            $diffs[$interval] = $looped;
        }

        $count = 0;
        $times = array();
        // Loop thru all diffs
        foreach ($diffs as $interval => $value) {
            // Break if we have needed precission
            if ($count >= $precision) {
                break;
            }
            // Add value and interval
            // if value is bigger than 0
            if ($value > 0) {
                // Add s if value is not 1
                if ($value != 1) {
                    $interval .= "s";
                }
                // Add value and interval to times array
                $times[] = $value . " " . $interval . " ago.";
                $count++;
            }
        }


        // Return string with times
        return $times[0];
    }

    static function email2Username($email)
    {
        $emailArray = explode('@', $email);
        return $emailArray['0'];
    }

    static function getFormattedDate($type, $date = '')
    {
        $datetime = new DateTime();
        switch ($type) {
            case "1":
                if (isset($date)) {
                    $dateObj = new DateTime($date);
                    return $dateObj->format('Y/m/d H:i:s');
                } else {
                    $dateObj = new DateTime();
                    return $dateObj->format('Y/m/d H:i:s');
                }
                break;
            case "2":
                if (isset($date)) {
                    $dateObj = new DateTime($date);
                    return $dateObj->format('Y-m-d H:i:s');
                } else {
                    $dateObj = new DateTime();
                    return $dateObj->format('Y-m-d H:i:s');
                }
                break;
            case "3":
                if (isset($date)) {
                    $dateObj = new DateTime($date);
                    return $dateObj->format('M d Y');
                } else {
                    $dateObj = new DateTime();
                    return $dateObj->format('M d Y');
                }
                break;
            default:
                return $datetime->format('Y-m-d H:i:s');
        }
    }

    static function getFiscalYear()
    {
        $result = array();
        $date = new DateTime();
        $start = new DateTime();
        $end = new DateTime();

        $start->setTime(0, 0, 0);
        $end->setTime(23, 59, 59);

        $year = $date->format('Y');
        $start->setDate($year, 4, 1);
        if ($start <= $date) {
            $startYear = $year;
            $endYear = $year + 1;
            $end->setDate($year + 1, 3, 31);
            $end->setDate($year + 1, 3, 31);
        } else {
            $start->setDate($year - 1, 4, 1);
            $end->setDate($year, 3, 31);
            $startYear = $year - 1;
            $endYear = $year;
        }

        $result['previousYear'] = 'FY ' . ($startYear - 1) . '-' . ($endYear - 1);
        $result['currentYear'] = 'FY ' . $startYear . '-' . $endYear;
        return (object)$result;
    }

    static function getFinancialYear()
    {
        $result = array();
        $date = new DateTime();
        $start = new DateTime();
        $end = new DateTime();

        $start->setTime(0, 0, 0);
        $end->setTime(23, 59, 59);

        $year = $date->format('Y');
        $start->setDate($year, 4, 1);
        if ($start <= $date) {
            $startYear = $year;
            $endYear = $year + 1;
            $end->setDate($year + 1, 3, 31);
            $end->setDate($year + 1, 3, 31);
        } else {
            $start->setDate($year - 1, 4, 1);
            $end->setDate($year, 3, 31);
            $startYear = $year - 1;
            $endYear = $year;
        }

        $result['previousYear'] = ($startYear - 1) . '-' . ($endYear - 1);
        $result['currentYear'] = $startYear . '-' . $endYear;
        return (object)$result;
    }

    static function dateRangeCheck($startDate, $endDate, $currentDate)
    {
        // Convert to timestamp
        $startTS = strtotime($startDate);
        $endTS = strtotime($endDate);
        $currTS = strtotime($currentDate);

        // Check that user date is between start & end
        return (($currTS >= $startTS) && ($currTS <= $endTS));
    }

    static function getSelectedOption($parameter)
    {
        $selected = '';
        if ($parameter->MasterKeyId == $parameter->ForeignKeyId) {
            $selected = 'selected';
        } else {
            $selected = '';
        }
        return $selected;
    }

    static function getMultiSelectedOption($masterId, $arrayIds)
    {
        $selected = '';
        if (in_array($masterId, $arrayIds)) {
            $selected = 'selected';
        } else {
            $selected = '';
        }
        return $selected;
    }

    static function getIPDetail()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $ipDetails = @unserialize(file_get_contents('http://ip-api.com/php/' . $ip));
        return (object)$ipDetails;
    }

    static function getLocalTime($utcDateTime)
    {
        $dateTime = array();
        if ($utcDateTime != '') {

            $ipDetail = self::getIPDetail();
            $date = new DateTime($utcDateTime, new DateTimeZone('UTC'));
            $date->setTimezone(new DateTimeZone($ipDetail->timezone));
            $dateTime['Time'] = $date->format('H:i A');
            $dateTime['Date'] = $date->format('d M Y');
        } else {
            $dateTime['Time'] = '';
            $dateTime['Date'] = '';
        }
        return (object)$dateTime;
    }

    static function getStatus($statusId)
    {
        $statusId = (int)$statusId;
        switch ($statusId) {
            case 0:
                $data['Name'] = 'Inactive';
                $data['Color'] = 'red';
                return (object)$data;
                break;
            case 1:
                $data['Name'] = 'Active';
                $data['Color'] = 'green';
                return (object)$data;
                break;
            default:
                $data['Name'] = '';
                $data['Color'] = '';
                return (object)$data;
        }
    }

    static function getQueryLimits()
    {
        $queryLimits = array(
            array('Name' => '10 records', 'Value' => '10'),
            array('Name' => '25 records', 'Value' => '25'),
            array('Name' => '50 records', 'Value' => '25'),
            array('Name' => 'All records', 'Value' => '-1'),
        );


        return $queryLimits;
    }

    static function getOrderHash()
    {
        $orderHash = strtoupper('ORD_' . dechex(strtotime("now")) . dechex(strtotime("+1 day")));
        return $orderHash;


    }


    static function getCouponPrice($productTotalPrice, $coupon)
    {


        if (!empty($coupon)) {
            if ($coupon->DiscountType == 1 && $coupon->DiscountValue > 0) {
                $discountPrice = ($productTotalPrice * $coupon->DiscountValue) / 100;
                $payablePrice = $productTotalPrice - $discountPrice;

            } else if ($coupon->DiscountType == 2 && $coupon->DiscountValue > 0) {
                $discountPrice = $coupon->DiscountValue;
                $payablePrice = $productTotalPrice - $discountPrice;

            } else {
                $discountPrice = $productTotalPrice;
                $payablePrice = $productTotalPrice;
            }
        } else {
            $discountPrice = 0;
            $payablePrice = 0;

        }

        $result['DiscountPrice'] = number_format($discountPrice, 2, '.', '');
        $result['PayablePrice'] = number_format($payablePrice, 2, '.', '');
        return (object)$result;

    }


    static function getPaymentType($paymentTypeId)
    {
        $paymentTypeId = (int)$paymentTypeId;
        switch ($paymentTypeId) {
            case CommonConstants::PAYMENT_TYPE_COD:
                $data['Name'] = 'COD';
                break;
            case CommonConstants::PAYMENT_TYPE_PAYU:
                $data['Name'] = 'PAYU';
                break;
            case CommonConstants::PAYMENT_TYPE_PAYPAL:
                $data['Name'] = 'PAYPAL';
                break;
            case CommonConstants::PAYMENT_TYPE_INSTAMOJO:
                $data['Name'] = 'INSTAMOJO';
                break;
            default:
                $data['Name'] = 'NONE';

        }
        return (object)$data;
    }


    static function generateOTPCode()
    {
        $randomString = '';
        for ($i = 1; $i <= 6; $i++) {
            $randNum = floor(rand(0, 9));
            $randomString .= $randNum;
        }


        return $randomString;

    }


    static function getWords($string, $wordCount)
    {
        $words = explode(" ", $string);
        $result['FirstWords'] = join(" ", array_slice($words, 0, $wordCount));
        $result['RestWords'] = join(" ", array_slice($words, $wordCount));
        return (object)$result;


    }

    static function getCharacters($string, $startIndex, $lastIndex)
    {

        $subString = substr($string, $startIndex, $lastIndex);
        return $subString;


    }

    public static function getLoggedUser(){
        $user;
        if(isset($_SESSION['IsLoggedIn'])){
            $user = $_SESSION['Id'];
        }
        if(isset($_SESSION['GuestUser'])){
            $user = $_SESSION['GuestUser'];
        }
        return $user;
    }

     public static function getDiscountedPrice($discountType, $discountValue, $price){
        $output;

        if($discountType == 1){
            //means percent type discount
            $output = round($discountValue * $price / 100);
        }

        if($discountType == 2){
            //means flat type discount
            $output = $discountValue;
        }


        return $output;
    }


}
