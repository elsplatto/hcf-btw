<?php
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
    $callPage = 'index.php';
}
//echo '['.$callPage.']';
?>
<div id="instagramLoginModal" class="white">
    <h3>Instagram Login</h3>
    <p>To Like or Comment on an Instagram image or video we will need you to sign in.</p>

    <p>Our application won't do anything other than connect to your Instgram account so that you can Like or Comment on images/videos we are pulling into our site.</p>


    <a href="<?php echo $instagramLoginURL ?>" class="button">Log into Instagram</a>
    <a class="close-reveal-modal reveal-close">x</a>
</div>