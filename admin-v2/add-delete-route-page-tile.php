<?php
include 'includes/admin-settings.php';
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin($securityArrAuthor);

$route_id = $_POST['route_id'];
$tile_id = $_POST['tile_id'];
$order = $_POST['order'];
$action = $_POST['action'];

if ($action === 'remove')
{
    if (isset($route_id) && isset($tile_id))
    {
        $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        $stmt = $mysqli->prepare('DELETE FROM route_page_tile WHERE tile_id = ? AND route_id = ?');
        $stmt->bind_param('ii', $tile_id, $route_id);
        $stmt->execute();
        $stmt->close();
        $mysqli->close();

        $json = '{"success": true, "msg": "Record deleted."}';
    }
}
else if ($action === 'add')
{
    if (isset($route_id) && isset($tile_id))
    {
        $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        $stmt = $mysqli->prepare('INSERT INTO route_page_tile (tile_id, route_id, route_page_tile.order) VALUES (?,?,?)');
        $stmt->bind_param('iii', $tile_id, $route_id,$order);
        $stmt->execute();
        $stmt->close();
        $mysqli->close();

        $json = '{"success": true, "msg": "Record added."}';
    }
}
else
{
    $json = '{"success": false, "msg": "Variables not passed correctly."}';
}

echo json_encode($json);
?>