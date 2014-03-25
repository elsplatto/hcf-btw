<?php

$baseURL = '';
if ($_SERVER['SERVER_NAME'] == 'localhost')
{
    $baseURL = 'http://localhost/~jasontaikato/hcf-btw';
    $adminEmailAddress = 'jason.taikato@tobiasandtobias.com';
}
else
{
    $baseURL = 'http://beyondthewharf.com.au';
    $adminEmailAddress = 'admin@beyondthewharf.com.au';
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