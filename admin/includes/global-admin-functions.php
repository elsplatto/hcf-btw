<?php
function assessLogin()
{
    session_start();
    //$userId = $_SESSION['adminUserId'];
    if (!isset($_SESSION['adminUserId']))
    {
        header('Location: login-fail.php');
    }
}
?>