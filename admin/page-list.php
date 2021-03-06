<?php

include 'includes/admin-settings.php';
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin($securityArrAuthor);

function getPages($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE) {
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT pages.id, pages.title, is_live FROM pages ORDER BY pages.order');

    $stmt->execute();
    $stmt->bind_result($id, $title, $is_live);

    $results = array();
    $i = 0;
    while($stmt->fetch())
    {
        $results[$i]['id'] = $id;
        $results[$i]['title'] = $title;
        $results[$i]['is_live'] = $is_live;
        $i++;
    }

    $stmt->close();
    $mysqli->close();
    return $results;
}

$pages = getPages($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
?>
<html>
<head>
    <title>List Pages</title>
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
<?php
include 'includes/header.php';
?>
<section>
    <div class="row">
        <div class="large-12 columns">
            <a href="dashboard.php">Home</a>
            <h1>Pages</h1>
            <a href="page-add.php">Add Page</a>
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
                <th>Parent Page</th>
                <th>Status</th>
                <th>Action</th>
                </thead>
                <tbody>
                <?php
                foreach ($pages as $page)
                {
                    ?>
                    <tr>
                        <td><?=$page['id']?></td>
                        <td><?=$page['title']?></td>
                        <td></td>
                        <td><?php echo ($page['is_live'] == 1 ? 'Live' :  'Not Live') ?></td>
                        <td><a href="page-edit.php?id=<?=$page['id']?>">edit</a></td>
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