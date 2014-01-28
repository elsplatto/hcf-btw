<?php
require '../includes/instagram.class.php';
require '../includes/instagram.config.php';

session_start();
$userData=$_SESSION['userdetails'];
$userInstagramId = $userData->user->id;
$instagram->setAccessToken($userData);

//$instagramPostData = $_POST['data'];

//$commentedMediaId = $instagramPostData->media_id;
//$commentedText = $instagramPostData->comment;

$commentedMediaId = $_GET['media_id'];
$commentedText = $_GET['comment'];

if (isset($commentedMediaId))
{
    $commentedJSON = $instagram->addMediaComment($commentedMediaId, $commentedText);
    if (isset ($commentedJSON))
    {
        echo json_encode($commentedJSON);
    }
}
else
{
    $objJSON = '{mediaId: '.$commentedMediaId.', comment: '.$commentedText.'}';
    echo json_encode($objJSON);
}

?>