<?php

include 'db.php';
include 'Mobile_Detect.php';
include 'global-functions.php';
require 'instagram.class.php';
require 'instagram.config.php';
require 'twitter.class.php';
require 'twitter.config.php';

include 'site-settings.php';

$twitterResults = $twitter->search('#beyondthewharf'); //homepage only page with twitter feed at this point - move to site-settings.php if more prolific


$device = new Mobile_Detect;
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?=$pageMetaTitle?></title>
    <meta name="description" content="<?=$pageMetaDesc?>" />

    <link rel="apple-touch-icon" href="<?=$baseURL?>/apple-icons/beyond-the-wharf-icon.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?=$baseURL?>/apple-icons/beyond-the-wharf-76x76.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="<?=$baseURL?>/apple-icons/beyond-the-wharf-120x120.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="<?=$baseURL?>/apple-icons/beyond-the-wharf-152x152.png" />


    <link rel="stylesheet" href="<?=$baseURL?>/css/foundation.css" />
    <link rel="stylesheet" href="<?=$baseURL?>/css/style.css" />
    <script src="<?=$baseURL?>/js/modernizr.js"></script>
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