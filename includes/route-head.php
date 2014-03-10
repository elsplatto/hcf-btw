<?php
date_default_timezone_set('Australia/NSW');
include 'db.php';
include 'Mobile_Detect.php';
include 'global-functions.php';
require 'instagram.class.php';
require 'instagram.config.php';

include 'site-settings.php';

$targetStr = 'route/';
$targetPos = strpos($_SERVER['REQUEST_URI'],$targetStr);
$targetPos = ($targetPos + strlen($targetStr));

$friendly_url = substr($_SERVER['REQUEST_URI'],$targetPos);

//echo '$friendly_url['.$friendly_url.']';


function getRoute($friendly_url, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{

    $query = '';
    $query .= 'SELECT id, page_title, nav_title, heading, heading_pullout, route_colour, css_class, header_image, ';
    $query .= 'info_bubble_width, info_bubble_height, header_mp4, header_webm, content_header, content, meta_keywords, ';
    $query .= 'meta_desc FROM route WHERE is_live = 1 AND friendly_url = ?';



    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    if (!$stmt = $mysqli->prepare($query)) {
        echo 'Error: ' . $mysqli->error;
        return false; // throw exception, die(), exit, whatever..
    } else {
        $stmt->bind_param('s', strtolower($friendly_url));
        $stmt->execute();
        $stmt->bind_result($id, $page_title, $nav_title, $heading, $heading_pullout, $route_colour, $css_class, $header_image, $info_bubble_width, $info_bubble_height, $header_mp4, $header_webm, $content_header, $content, $meta_keywords, $meta_desc);

        $results = array();
        $i = 0;
        while($stmt->fetch())
        {
            $results[$i]['id'] = $id;
            $results[$i]['page_title'] = $page_title;
            $results[$i]['nav_title'] = $nav_title;
            $results[$i]['heading'] = $heading;
            $results[$i]['heading_pullout'] = $heading_pullout;
            $results[$i]['route_colour'] = $route_colour;
            $results[$i]['css_class'] = $css_class;
            $results[$i]['header_image'] = $header_image;
            $results[$i]['info_bubble_width'] = $info_bubble_width;
            $results[$i]['info_bubble_height'] = $info_bubble_height;
            $results[$i]['header_mp4'] = $header_mp4;
            $results[$i]['header_webm'] = $header_webm;
            $results[$i]['content_header'] = $content_header;
            $results[$i]['content'] = $content;
            $results[$i]['meta_keywords'] = $meta_keywords;
            $results[$i]['meta_desc'] = $meta_desc;
            $i++;
        }
        return $results;
    }
    $stmt->close();
    $mysqli->close();
    return $results;
}

$routeDetails = getRoute($friendly_url, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
//var_dump($routeDetails);

$fetchSuccess = false;
foreach ($routeDetails as $routeDetail) {
    if (isset($routeDetail['id']))
    {
        $routeId = $routeDetail['id'];
        $routeTitle = $routeDetail['page_title'];
        $routeNavTitle = $routeDetail['nav_title'];
        $routeHeading = $routeDetail['heading'];
        $routePullout = $routeDetail['heading_pullout'];
        $routeHeaderImage = $routeDetail['header_image'];
        $routeColour = $routeDetail['route_colour'];
        $routeCSSClass = $routeDetail['css_class'];
        $routeInfoBubbleWidth = $routeDetail['info_bubble_width'];
        $routeInfoBubbleHeight = $routeDetail['info_bubble_height'];

        $routeHeaderMP4 = $routeDetail['header_mp4'];
        $routeHeaderWebm = $routeDetail['header_webm'];
        $routeContentHeader = $routeDetail['content_header'];
        $routeContent = $routeDetail['content'];
        $routeMetaKeywords= $routeDetail['meta_keywords'];
        $routeMetaDesc= $routeDetail['meta_desc'];

        $fetchSuccess = true;
    }
    else{
        break;
    }

}

if ($fetchSuccess)
{
    //echo 'All Good';
}
else
{
    //echo 'Houston - we have a problem.';
    header('Location: '.$baseURL.'/404');
}


?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?=$routeTitle?></title>
    <meta name="keywords" content="<?=$routeMetaKeywords ?>" />
    <meta name="description" content="<?=$routeMetaDesc?>" />


    <link rel="icon" href="<?=$baseURL?>/apple-icons/beyond-the-wharf-icon.png" type="image/png" />
    <link rel="apple-touch-icon" href="<?=$baseURL?>/apple-icons/beyond-the-wharf-icon.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="<?=$baseURL?>/apple-icons/beyond-the-wharf-76x76.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="<?=$baseURL?>/apple-icons/beyond-the-wharf-120x120.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="<?=$baseURL?>/apple-icons/beyond-the-wharf-152x152.png" />


    <link rel="stylesheet" href="<?=$baseURL?>/css/foundation.css" />
    <link rel="stylesheet" href="<?=$baseURL?>/css/style.css" />

    <?php
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
