<?php
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin();

function getPages($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE) {
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT pages.id, pages.title, is_live FROM pages ORDER BY pages.order');

    $stmt->execute();

    $results = $stmt->get_result();
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
<section>
    <h1>Pages</h1>
    <a href="tile-add.php">Add Page</a>
</section>

<section>
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
</section>
</body>
</html>