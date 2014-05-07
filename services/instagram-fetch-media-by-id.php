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

if (isset($_POST['media_id']))
{
    $id = $_POST['media_id'];
    $instagramResults = $instagram->getMedia($id,$tokenSet);
    $json = $instagramResults;
}
else
{
    $json = '{"success": true, "msg": "Unable to retrieve image."}';
}

echo json_encode($json);
?>