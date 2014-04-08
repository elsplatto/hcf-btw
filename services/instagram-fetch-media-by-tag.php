<?php
require '../includes/site-settings.php';
require '../includes/instagram.class.php';
require '../includes/instagram.config.php';

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

if (isset($_POST['tag']))
{
    $tag = $_POST['tag'];
}
else
{
    $tag = 'beyondthewharf';
}

$instagramResults = $instagram->getTagMedia($tag,$tokenSet);


echo json_encode($instagramResults);
?>