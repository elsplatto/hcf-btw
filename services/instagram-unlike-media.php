<?php

require '../includes/instagram.class.php';
require '../includes/instagram.config.php';

if(session_id() == '') {
    session_start();
}
$userData=$_SESSION['userdetails'];
$userInstagramId = $userData->user->id;
$instagram->setAccessToken($userData);

$unlikedMediaId = $_GET['media_id'];
if (isset($unlikedMediaId))
{
    $unliked = $instagram->deleteLikedMedia($unlikedMediaId);
}

echo json_encode($unliked);


?>