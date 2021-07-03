<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

function callLibraryFunction($library_name, $function_name, $parameters = null)
{
    $ci = &get_instance();
    $ci->load->library($library_name);
    return $ci->$library_name->$function_name($parameters);
}


function callModelFunction($model_name, $function_name, $parameters = null)
{
    $ci = &get_instance();
    $ci->load->model($model_name);
    return $ci->$model_name->$function_name($parameters);
}
