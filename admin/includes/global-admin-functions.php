<?php
function assessLogin()
{
    session_start();
    $userId = $_SESSION['adminUserId'];
    if (!isset($userId))
    {
        header('Location: login-fail.php');
    }
}
?>