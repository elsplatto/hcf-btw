<?php
include 'includes/admin-settings.php';
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin($securityArrAuthor);

$page_id = $_POST['page_id'];
$tile_id = $_POST['tile_id'];
$index = $_POST['order'];


if (isset($page_id) && isset($tile_id) && isset($index))
{
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('UPDATE page_tile SET page_tile.order = ? WHERE tile_id = ? AND page_id = ?');
    $stmt->bind_param('iii', $index, $tile_id, $page_id);
    $stmt->execute();
    $stmt->close();
    $mysqli->close();

    $json = '{"success": true, "msg": "Update successfully."}';
}
else
{
    $json = '{"success": false, "msg": "We didn\'t get all the variables."}';
}

echo json_encode($json);
?>