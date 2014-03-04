<?php

require '../includes/instagram.class.php';
require '../includes/instagram.config.php';
require '../includes/site-settings.php';

$tag = 'beyondthewharf';
$clientID = $instagram->getApiKey();
if (isset($_POST['max_id']))
{
    $maxID = $_POST['max_id'];
}

if (isset($instagramData))
{
    $instagram->setAccessToken($instagramData);

    $token = $instagram->getAccessToken();
}

if (isset($token))
{
    $tokenSet = true;
}
else{
    $tokenSet = false;
}

$call = new stdClass();
$call->pagination = new stdClass();
$call->pagination->next_max_id = $maxID;
$call->pagination->next_url = 'https://api.instagram.com/v1/tags/'.$tag.'/media/recent?client_id='.$clientID.'&max_tag_id='.$maxID;
$media = $instagram->pagination($call,$tokenSet);

echo json_encode($media);
?>