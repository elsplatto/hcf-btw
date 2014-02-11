<?php
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin();

function getTiles($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE) {
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT tiles.id, tiles.title, tiles.image_thumb, types.title AS type_title FROM (tiles, types) WHERE types.id = tiles.type_id');

    $stmt->execute();

    $results = $stmt->get_result();
    return $results;
}

$tiles = getTiles($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
?>
<html>
<head>
    <title>List Tiles</title>
    <?php
    include 'includes/head.php';
    ?>
    <style>
        .list th, .list td {
            padding: 0.5rem 1rem 0.5rem 0
        }
    </style>
</head>
<body>
    <section>
        <h1>Tiles</h1>
        <a href="tile-add.php">Add Tile</a>
    </section>

    <section>
        <table class="list" border="0">
            <thead>
                <th>ID</th>
                <th>Title</th>
                <th>Type</th>
                <th>Action</th>
            </thead>
            <tbody>
            <?php
            foreach ($tiles as $tile)
            {
            ?>
            <tr>
                <td><?=$tile['id']?></td>
                <td><?=$tile['title']?></td>
                <td><?=$tile['type_title']?></td>
                <td><a href="tile-edit.php?id=<?=$tile['id']?>">edit</a></td>
            </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </section>
</body>
</html>