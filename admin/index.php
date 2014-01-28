<?php
if (isset($_GET['logout']))
{
    $logout = $_GET['logout'];
}

session_start();
if (isset($logout))
{
    unset($_SESSION['adminUserId']);
    unset($_SESSION['adminUsername']);
    session_destroy();
}
?>

<html>
<head>
    <title>Admin - Homepage</title>
</head>
<body>
<?php
include 'includes/login-form.php';
?>
</body>
</html>