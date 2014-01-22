<?php
require 'includes/db.php';
require 'includes/instagram.class.php';
require 'includes/instagram.config.php';

// Receive OAuth code parameter
$code = $_GET['code'];

// Check whether the user has granted access
if (true === isset($code))
{

// Receive OAuth token object
    $data = $instagram->getOAuthToken($code);

    if(empty($data->user->username))
    {
        header('Location: index.php');
    }
    else
    {
        $instagram->setAccessToken($data);
        session_start();
// Storing instagram user data into session
        $_SESSION['userdetails']=$data;
        $user=$data->user->username;
        $fullname=$data->user->full_name;
        $bio=$data->user->bio;
        $website=$data->user->website;
        $instagramID=$data->user->id;
        $token=$data->access_token;
// Verify user details in USERS table
        $id=mysql_query("select instagram_id from instagram_users where instagram_id='$instagramID'");
        if(mysql_num_rows($id) == 0)
        {
// Inserting values into USERS table
            mysql_query("insert into instagram_users(username,fullname,bio,website,instagram_id,instagram_access_token) values('$user','$fullname','$bio','$website','$instagramID','$token')");
        }
// Redirecting you home.php 
        header('Location: index.php');
    }
}
else
{
// Check whether an error occurred
    if (true === isset($_GET['error']))
    {
        echo 'An error occurred: '.$_GET['error_description'];
    }
}
?>