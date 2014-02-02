<?php
include 'db.php';
include 'Mobile_Detect.php';
include 'global-functions.php';
require 'instagram.class.php';
require 'instagram.config.php';

$device = new Mobile_Detect;

session_start();


// User session data availability check

if(isset($_GET['id']))
{
    //kill session to log out of instagram
    unset($_SESSION['userdetails']);
    session_destroy();
    $instagramUserLoggedIn = false;
}

if (isset($_SESSION['userdetails']))
{
    session_start();
    $instagramData = $_SESSION['userdetails'];
    $instagramUserLoggedIn = true;

}
else
{
    $instagramUserLoggedIn = false;
}
/*
echo '$instagramUserLoggedIn['.$instagramUserLoggedIn.']<br />';
echo '$instagramData->user-username['.$instagramData->user->username.']<br />';
echo '$_SESSION[\'userdetails\']->user->username['. $_SESSION['userdetails']->user->username.']<br />';
*/

?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Beyond the Wharf | Welcome</title>

    <link rel="apple-touch-icon" href="apple-icons/beyond-the-wharf-icon.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="apple-icons/beyond-the-wharf-76x76.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="apple-icons/beyond-the-wharf-120x120.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="apple-icons/beyond-the-wharf-152x152.png" />


    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/modernizr.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcRjvvKaoJuT_-v4op_kWwsV5rwQEIRG8&sensor=true"></script>

    <?php
    if (($_SERVER['SERVER_NAME'] == 'beyondthewharf.com.au') || ($_SERVER['SERVER_NAME'] == 'www.beyondthewharf.com.au') || ($_SERVER['SERVER_NAME'] == 'localhost')){
        ?>
        <link href='http://fonts.googleapis.com/css?family=Inconsolata:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="//cloud.typography.com/6681852/609364/css/fonts.css" />
        <script type="text/javascript" src="//use.typekit.net/ipr3pdx.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
    <?php
    }
    ?>


</head>