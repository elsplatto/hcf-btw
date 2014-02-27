<?php

require '../includes/instagram.class.php';
require '../includes/instagram.config.php';

session_start();
$userData=$_SESSION['userdetails'];
$userInstagramId = $userData->user->id;
$instagram->setAccessToken($userData);

if (isset($userInstagramId))
{
    $followJSON = $instagram->modifyRelationship('follow', $btwInstagramID);
}

echo json_encode($followJSON);


?>