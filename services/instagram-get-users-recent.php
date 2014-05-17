<?php
require '../includes/site-settings.php';
require '../includes/instagram.class.php';
require '../includes/instagram.config.php';

$tag = 'beyondthewharf';
if (isset($_POST['tag']))
{
    $tag = $_POST['tag'];
}

$userData=$_SESSION['userdetails'];
$userInstagramId = $userData->user->id;
$instagram->setAccessToken($userData);

$media = $instagram->getUserMedia();

$json = array();

foreach ($media->data as $m)
{
    if (in_array($tag,$m->tags))
    {
        array_push($json,$m);
    }
}
echo json_encode($json);
?>