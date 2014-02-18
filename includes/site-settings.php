<?php
$device = new Mobile_Detect;

$baseURL = '';
if ($_SERVER['SERVER_NAME'] == 'localhost')
{
$baseURL = 'http://localhost/~jasontaikato/hcf-btw';
}
else
{
$baseURL = 'http://beyondthewharf.com.au/dev';
}



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
?>