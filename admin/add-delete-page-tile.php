<?php
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin();

$page_id = $_POST['page_id'];
$tile_id = $_POST['tile_id'];
$order = $_POST['order'];
$action = $_POST['action'];

if ($action === 'remove')
{
    if (isset($page_id) && isset($tile_id))
    {
        $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        $stmt = $mysqli->prepare('DELETE FROM page_tile WHERE tile_id = ? AND page_id = ?');
        $stmt->bind_param('ii', $tile_id, $page_id);
        $stmt->execute();
        $stmt->close();

        $json = '{"success": true, "msg": "Record deleted."}';
    }
}
else if ($action === 'add')
{
    if (isset($page_id) && isset($tile_id))
    {
        $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        $stmt = $mysqli->prepare('INSERT INTO page_tile (tile_id, page_id, page_tile.order) VALUES (?,?,?)');
        $stmt->bind_param('iii', $tile_id, $page_id,$order);
        $stmt->execute();
        $stmt->close();

        $json = '{"success": true, "msg": "Record added."}';
    }
}
else
{
    $json = '{"success": false, "msg": "Variables not passed correctly."}';
}

echo json_encode($json);
?>