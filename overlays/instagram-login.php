<?php
include '../includes/site-settings.php';
include '../includes/db.php';
include '../includes/Mobile_Detect.php';
require '../includes/instagram.class.php';
require '../includes/instagram.config.php';

$device = new Mobile_Detect;
$instagramLoginURL = $instagram->getLoginUrl(array('basic','likes','relationships','comments'));
if (isset($_GET['call_page']))
{
    $callPage = $_GET['call_page'];
}
else
{
    $callPage = $baseURL;
}
//echo '['.$callPage.']';
?>
<div id="instagramLoginModal" class="white">
    <h3>Instagram Login</h3>
    <p>To Like or view comments an Instagram image we will need you to sign in.</p>

    <a href="<?=$instagramLoginURL?>" class="button">Log into Instagram</a>
    <a class="close-reveal-modal reveal-close">Close overlay</a>
</div>