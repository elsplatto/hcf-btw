<?php
include 'site-settings.php';
include 'db.php';
include 'Mobile_Detect.php';
include 'global-functions.php';
require 'instagram.class.php';
require 'instagram.config.php';

$device = new Mobile_Detect;

$deviceType = ($device->isMobile() ? ($device->isTablet() ? 'tablet' : 'phone') : 'computer');
$folder = '';
$deviceClass = '';

if ($deviceType === 'phone')
{
    $folder = 'phone/';
    $deviceClass = ' phone';
}

if (isset($instagramData))
{
    $competitionURL = 'overlays/enter-competition.php?step=2';
} else {
    $competitionURL = 'overlays/enter-competition.php?step=1';
}

if (isset($_GET['competitionId']))
{
    $competitionId = $_GET['competitionId'];
}
else
{
    $competitionId = 0;
}

if (!isset($_COOKIE['LandingCookie']))
{
    setcookie("LandingCookie","visited", time()+3600*24*30); //flags that user has been to landing page before - expires in 30days
}

if (isset($_GET['killCookie']))
{
    setcookie("LandingCookie", "", time()-3600);   //expire cookie
}

?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?=$pageMetaTitle?></title>
    <meta name="description" content="<?=$pageMetaDesc?>" />
    <meta name="keywords" content="<?=$pageMetaKeywords?>" />


    <meta name="robots" content="index, follow" />


    <link rel="icon" href="<?=$baseURL?>/apple-icons/beyond-the-wharf-icon.png" type="image/png" />
    <link rel="apple-touch-icon" href="<?=$baseURL?>/apple-icons/beyond-the-wharf-icon.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?=$baseURL?>/apple-icons/beyond-the-wharf-76x76.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="<?=$baseURL?>/apple-icons/beyond-the-wharf-120x120.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="<?=$baseURL?>/apple-icons/beyond-the-wharf-152x152.png" />


    <link rel="stylesheet" href="<?=$baseURL?>/css/foundation.css" />
    <link rel="stylesheet" href="<?=$baseURL?>/css/style.css" />
    <?php
    if ($pageSection == 'vivid')
    {
    ?>
        <link rel="stylesheet" href="<?=$baseURL?>/css/vivd.css" />
    <?php
    }


    if (($_SERVER['SERVER_NAME'] == 'beyondthewharf.com.au') || ($_SERVER['SERVER_NAME'] == 'www.beyondthewharf.com.au') || ($_SERVER['SERVER_NAME'] == 'localhost')){
        ?>
        <link href='http://fonts.googleapis.com/css?family=Inconsolata:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" type="text/css" href="//cloud.typography.com/6746472/661984/css/fonts.css" />
        <script type="text/javascript" src="//use.typekit.net/bmv2swy.js"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
    <?php
    }
    ?>

    <script src="<?=$baseURL?>/js/modernizr.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcRjvvKaoJuT_-v4op_kWwsV5rwQEIRG8&sensor=true"></script>

</head>