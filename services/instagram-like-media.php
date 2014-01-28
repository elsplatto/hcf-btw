<?php

require '../includes/instagram.class.php';
require '../includes/instagram.config.php';

session_start();
$userData=$_SESSION['userdetails'];
$userInstagramId = $userData->user->id;
$instagram->setAccessToken($userData);

$likedMediaId = $_GET['media_id'];
if (isset($likedMediaId))
{
    $likedJSON = $instagram->likeMedia($likedMediaId);
}

echo json_encode($likedJSON);


?>