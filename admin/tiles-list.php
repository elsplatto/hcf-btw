<?php
include 'includes/admin-settings.php';
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin($securityArrAuthor);

function getTiles($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE) {
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT tiles.id, tiles.title, tiles.image_thumb, types.title AS type_title FROM (tiles, types) WHERE types.id = tiles.type_id');

    $stmt->execute();
    $stmt->bind_result($id, $title, $image_thumb, $type_title);

    $results = array();
    $i = 0;
    while($stmt->fetch())
    {
        $results[$i]['id'] = $id;
        $results[$i]['title'] = $title;
        $results[$i]['image_thumb'] = $image_thumb;
        $results[$i]['type_title'] = $type_title;
        $i++;
    }

    $stmt->close();
    $mysqli->close();
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
</head>
<body>

    <?php
    include 'includes/header.php';
    ?>

    <section>
        <div class="row">
            <div class="large-12 columns">
                <a href="dashboard.php">Home</a>
                <h1>Tiles</h1>
                <a href="tile-add.php">Add Tile</a>
            </div>
        </div>
    </section>


    <section>
        <div class="row">
            <div class="large-12 columns">
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
            </div>
        </div>
    </section>
</body>
</html>