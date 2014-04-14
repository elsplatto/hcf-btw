<?php
include 'includes/admin-settings.php';
include '../includes/db.php';
include '../includes/global-functions.php';
include 'includes/global-admin-functions.php';
assessLogin($securityArr);


if (isset($_POST['txtMediaId']))
{
    $previous_media_id = $_POST['compareMediaId'];
    $instagram_media_id = $_POST['txtMediaId'];
    $date_remove = time();
    $date_live = time();
    $admin_user_id = $_SESSION['adminUserId'];
    $is_valid = 1;

    /*
    echo '$previous_media_id[' .$previous_media_id. ']<br />';
    echo '$instagram_media_id[' .$instagram_media_id. ']<br />';
    echo '$date_remove[' .$date_remove. ']<br />';
    echo '$date_live[' .$date_live. ']<br />';
    echo '$admin_user_id[' .$admin_user_id. ']<br />';
    */

    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

    $query = 'UPDATE pic_of_the_day SET date_remove = ?, is_valid = 0 WHERE instagram_media_id = ? AND is_valid = 1';
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('is',$date_remove,$previous_media_id);
    $stmt->execute();

    $query = 'INSERT INTO pic_of_the_day (instagram_media_id, date_live, admin_user_id, is_valid) VALUES (?,?,?,?)';
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('siii',$instagram_media_id, $date_live, $admin_user_id, $is_valid);
    $stmt->execute();

    $stmt->close();
    $mysqli->close();
}

header('Location: dashboard.php');

?>