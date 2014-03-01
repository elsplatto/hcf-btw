<?php
date_default_timezone_set('Australia/NSW');
require 'includes/instagram.class.php';


/**
 * ALL YOUR IMPORTANT API INFO
 * EDIT THE CODES BELOW
 */
$client_id = 'b48c027b0de949648cf7c72e03dffc49';
$client_secret = 'cd2952d0e1674b0aacd96256e2cd4acd';
$object = 'tag';
$object_id = 'fashion';
$aspect = 'media';
$verify_token='';
$callback_url = 'http://beyondthewharf.com.au/instagram-success.php';

/**
 * SETTING UP THE CURL SETTINGS
 * DO NOT EDIT BELOW
 */
$attachment =  array(
    'client_id' => $client_id,
    'client_secret' => $client_secret,
    'object' => $object,
    'object_id' => $object_id,
    'aspect' => $aspect,
    'verify_token' => $verify_token,
    'callback_url'=>$callback_url
);

// URL TO THE INSTAGRAM API FUNCTION
$url = "https://api.instagram.com/v1/subscriptions/";

$ch = curl_init();

// EXECUTE THE CURL...
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $attachment);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //to suppress the curl output
$result = curl_exec($ch);
curl_close ($ch);

// PRINT THE RESULTS OF THE SUBSCRIPTION, IF ALL GOES WELL YOU'LL SEE A 200
print_r($result);

?>