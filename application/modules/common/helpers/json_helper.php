<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


function getJsonResult($result)
{
    $response = array();
    $response['input'] = isset($result['input']) ? $result['input'] : [];
    $response['files'] = isset($result['files']) ? $result['files'] : [];
    $response['commandResult']['success'] = isset($result['success']) ? $result['success'] : 0;
    $response['commandResult']['message'] = isset($result['message']) ? $result['message'] : 'Exception Occurred!';
    $response['commandResult']['data'] = isset($result['data']) ? $result['data'] : (object)[];
    return json_encode($response);
}