<?php
date_default_timezone_set('Australia/NSW');
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

    $instagramData = $_SESSION['userdetails'];
    $instagramUserLoggedIn = true;

}
else
{
    $instagramUserLoggedIn = false;
}


$targetStr = 'page/';
$targetPos = strpos($_SERVER['REQUEST_URI'],'page/');
$targetPos = ($targetPos + strlen($targetStr));

$friendly_url = substr($_SERVER['REQUEST_URI'],$targetPos);

//echo '['.$friendly_url.']';

function getPage($friendly_url, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{

    $query = '';
    $query .= 'SELECT id, title, is_landing_page, has_map, heading, heading_pullout, sub_heading, header_image, header_mp4, header_webm, content, meta_keywords, meta_desc FROM pages WHERE friendly_url = ?';

    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    if (!$stmt = $mysqli->prepare($query)) {
        echo 'Error: ' . $mysqli->error;
        return false; // throw exception, die(), exit, whatever..
    } else {
        $stmt->bind_param('s', strtolower($friendly_url));
        $stmt->execute();
        $stmt->bind_result($id, $title, $is_landing_page, $has_map, $heading, $heading_pullout, $sub_heading, $header_image, $header_mp4, $header_webm, $content, $meta_keywords, $meta_desc);

        $results = array();
        $i = 0;
        while($stmt->fetch())
        {
            $results[$i]['id'] = $id;
            $results[$i]['title'] = $title;
            $results[$i]['is_landing_page'] = $is_landing_page;
            $results[$i]['has_map'] = $has_map;
            $results[$i]['heading'] = $heading;
            $results[$i]['heading_pullout'] = $heading_pullout;
            $results[$i]['sub_heading'] = $sub_heading;
            $results[$i]['header_image'] = $header_image;
            $results[$i]['header_mp4'] = $header_mp4;
            $results[$i]['header_webm'] = $header_webm;
            $results[$i]['content'] = $content;
            $results[$i]['meta_keywords'] = $meta_keywords;
            $results[$i]['meta_desc'] = $meta_desc;
            $i++;
        }
        return $results;
    }
    $mysqli->close();
    return $results;
}

$pageDetails = getPage($friendly_url, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

$fetchSuccess = false;
foreach ($pageDetails as $pageDetail) {
    if (isset($pageDetail['id']))
    {
        $pageId = $pageDetail['id'];
        $isLandingPage = intval('0' . $pageDetail['is_landing_page']);
        $pageTitle = $pageDetail['title'];
        $pageHeading = $pageDetail['heading'];
        $pagePullout = $pageDetail['heading_pullout'];
        $pageSubHeading = $pageDetail['sub_heading'];
        $pageHeaderImage = $pageDetail['header_image'];
        $pageHeaderMP4 = $pageDetail['header_mp4'];
        $pageHeaderWebm = $pageDetail['header_webm'];
        $pageContent = $pageDetail['content'];
        $hasMap =  $pageDetail['has_map'];
        $pageMetaKeywords= $pageDetail['meta_keywords'];
        $pageMetaDesc= $pageDetail['meta_desc'];

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
    /*@TODO - redirect to 404 page here*/
}


?>
    <!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?=$pageTitle?></title>
    <meta name="keywords" content="<?=$pageMetaKeywords ?>" />
    <meta name="description" content="<?=$pageMetaDesc?>" />

    <link rel="apple-touch-icon" href="../apple-icons/beyond-the-wharf-icon.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="../apple-icons/beyond-the-wharf-76x76.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="../apple-icons/beyond-the-wharf-120x120.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="../apple-icons/beyond-the-wharf-152x152.png" />


    <link rel="stylesheet" href="../css/foundation.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <script src="../js/modernizr.js"></script>
    <?php
    if ($hasMap > 0)
    {
    ?>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcRjvvKaoJuT_-v4op_kWwsV5rwQEIRG8&sensor=true"></script>
    <?php
    }
    ?>
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
