<?php
$baseURL = '';
if ($_SERVER['SERVER_NAME'] == 'localhost')
{
    $baseURL = 'http://localhost/~jasontaikato/hcf-btw';
    $adminEmailAddress = 'jason.taikato@tobiasandtobias.com';
}
else if ($_SERVER['SERVER_NAME'] == 'www.beyondthewharf.com.au')
{
    $baseURL = 'http://www.beyondthewharf.com.au';
    $adminEmailAddress = 'admin@beyondthewharf.com.au';
}
else if ($_SERVER['SERVER_NAME'] == 'beyondthewharf.com.au')
{
    $baseURL = 'http://beyondthewharf.com.au';
    $adminEmailAddress = 'admin@beyondthewharf.com.au';
}
else if (($_SERVER['SERVER_NAME'] == 'www.harbourcityferries.com.au') || ($_SERVER['SERVER_NAME'] == 'harbourcityferries.com.au'))
{
    $baseURL = 'http://beyondthewharf.com.au';
    $adminEmailAddress = 'admin@beyondthewharf.com.au';
}
else
{
    $baseURL = 'http://localhost/~jasontaikato/hcf-btw';
    $adminEmailAddress = 'jason.taikato@tobiasandtobias.com';
}


if(!isset($_SESSION)) {
    session_start();
}

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