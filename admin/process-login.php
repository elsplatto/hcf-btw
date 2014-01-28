<?php
include '../includes/db.php';

$username = $_POST['fldUsername'];
$password = $_POST['fldPassword'];


if (isset($username) && isset($password))
{
    $password = md5($password);

    $q = "SELECT id, username FROM admin_users WHERE password = '$password' AND username = '$username'";
    $result = mysql_query($q, $connection);

    $numRows = mysql_num_rows($result);

    if($numRows > 0)
    {
        session_start();
        // Storing instagram user data into session
        while($data = mysql_fetch_assoc($result))
        {
            $_SESSION['adminUserId'] = $data["id"];
            $_SESSION['adminUsername'] = $data["username"];
        }
    }
}

if (isset($_SESSION['adminUserId']))
{
    //echo 'here';
    //$sessionDataId = $_SESSION['adminUserId'];
    header('Location: dashboard.php');
}
else
{
    header('Location: login-fail.php');
}



?>