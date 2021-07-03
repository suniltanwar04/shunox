<?php

require_once("vendor/autoload.php");

$apiContext = new \PayPal\Rest\ApiContext(
  new \PayPal\Auth\OAuthTokenCredential(
    'AaOMf6deCkFC-6HEmQTFCFcExSaM89Jbld1SaI6-qVF7MZECOcGZo3VuPbJKDdiZNR8Lg3ruDk4N3lDb',    
    'EAiKi1Y9ajS2ptzlKagV3KWBHmkFFPW_sK9imQeH3twdlXxHbfss0kc4tPp4lvnfZw0EuGxfsVQ93o4v'  
  )
);