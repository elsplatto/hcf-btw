<?php
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin(['super','publisher','author','restricted'])
?>
<html>
<head>
<?php
include 'includes/head.php';
?>
</head>
<body>

<?php
include 'includes/header.php';
?>

<section>
    <div class="row">
        <div class="large-12 columns">
            <h1>
            Dashboard
            </h1>

            <h3>Hello <?=$_SESSION['adminName']?></h3>



            <?php
            if (in_array($_SESSION['adminRole'],['super','publisher','author']))
            {
            ?>
                <p><a href="page-list.php">Pages</a></p>
            <?php
            }
            if (in_array($_SESSION['adminRole'],['super','publisher','author']))
            {
            ?>
                <p><a href="tiles-list.php">Tiles</a></p>
            <?php
            }
            if (in_array($_SESSION['adminRole'],['super','publisher','author']))
            {
            ?>
                <p><a href="route-list.php">Routes</a></p>
            <?php
            }
            if (in_array($_SESSION['adminRole'],['super']))
            {
            ?>
                <p><a href="user-list.php">Users</a></p>
            <?php
            }
            if (in_array($_SESSION['adminRole'],['super','publisher','author','restricted']))
            {
            ?>
                <p><a href="shot-of-the-day.php">Shot of the day</a></p>
            <?php
            }
            ?>
        </div>
    </div>
</section>
</body>
</html>