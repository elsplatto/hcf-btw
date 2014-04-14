<?php
include 'includes/admin-settings.php';
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin($securityArrAuthor);

function getRoutes($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE) {
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT route.id, route.nav_title, is_live FROM route ORDER BY route.nav_order');

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

$routes = getRoutes($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
?>
<html>
<head>
    <title>List Routes</title>
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
            <h1>Routes</h1>
            <a href="route-add.php">Add Route</a>
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
                <th>Status</th>
                <th>Action</th>
                </thead>
                <tbody>
                <?php
                foreach ($routes as $route)
                {
                    ?>
                    <tr>
                        <td><?=$route['id']?></td>
                        <td><?=$route['title']?></td>
                        <td><?php echo ($route['is_live'] == 1 ? 'Live' :  'Not Live') ?></td>
                        <td><a href="route-edit.php?id=<?=$route['id']?>">edit</a></td>
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