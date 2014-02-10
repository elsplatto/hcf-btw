<?php
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin();

$tile_id = $_GET['id'];

function getTile($id, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT * FROM tiles WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $results = $stmt->get_result();
    $mysqli->close();
    return $results;
}

function getTypes($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT * FROM types WHERE is_valid = 1');
    $stmt->execute();
    $results = $stmt->get_result();
    $mysqli->close();
    return $results;
}

function getCategories($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT c.id, c.title, c.type_id, t.title AS type_title FROM categories c, types t WHERE c.is_valid = 1 AND t.id = c.type_id ORDER BY c.type_id');
    $stmt->execute();
    $results = $stmt->get_result();
    $mysqli->close();
    return $results;
}

$tiles = getTile($tile_id, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

$types = getTypes($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

$categories = getCategories($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

$typesCount = mysqli_num_rows($types);
$categoriesCount = mysqli_num_rows($categories);
?>
<html>
<head>
    <title>Edit Tile</title>
    <style>
        label {
            clear: left;
            display: block;
            margin-top: 1rem;
        }
        input {
            clear: left;
            display: block;
        }
    </style>
</head>
<body>
<section>
    <h1>Tiles</h1>
    <a href="tiles-list.php">< Back to Tile List</a>
     -
    <a href="tile-add.php">Add Tile</a>
</section>

<section>
    <form id="frmTile" name="frmTile" action="tile-process.php" method="post">
        <?php
        foreach ($tiles as $tile)
        {
        ?>
        <input type="hidden" id="tileID" name="tileID" value="<?=$tile_id?>" />
        <label for="txtTitle">Title:</label>
        <input type="text" id="txtTitle" name="txtTitle" value="<?=$tile['title']?>" />

        <label for="selType">Type:</label>
        <?php
        if ($typesCount > 0)
        {
        ?>
        <select id="selType" name="selType">
            <?php
            foreach ($types as $type)
            {
                $typeSelected = '';
                if ($type['id'] == $tile['type_id'])
                {
                    $typeSelected = ' selected="selected"';
                }

            ?>
                <option value="<?=$type['id']?>"<?=$typeSelected?>><?=$type['title']?></option>
            <?php
            }
            ?>
        </select>
        <?php
        }
        ?>

        <label for="selCategory">Category:</label>
        <?php
        if ($categoriesCount > 0)
        {
            ?>
            <select id="selCategory" name="selCategory">
                <option value="0">Select</option>
                <?php
                $newTypeID = 0;
                $lastTypeID = 0;
                $categoryCounter = 0;
                foreach ($categories as $category)
                {
                    $newTypeID = $category['type_id'];

                    if ($newTypeID != $lastTypeID)
                    {
                        if ($categoryCounter > 0)
                        {
                            echo '</optgroup>';
                        }
                    ?>
                    <optgroup label="<?=$category['type_title']?>">
                    <?php
                    }

                    $categorySelected = '';
                    if ($category['id'] == $tile['category_id'])
                    {
                        $categorySelected = ' selected="selected"';
                    }

                    ?>
                    <option value="<?=$category['id']?>"<?=$categorySelected?>><?=$category['title']?></option>
                <?php
                    $lastTypeID = $category['type_id'];
                    $categoryCounter++;
                }
                ?>
            </select>
        <?php
        }
        ?>

        <label for="txtLat">Lat:</label>
        <input type="text" id="txtLat" name="txtLat" value="<?=$tile['lat']?>" />


        <label for="txtLng">Lng:</label>
        <input type="text" id="txtLng" name="txtLng" value="<?=$tile['lng']?>" />

        <label for="txtImgThumb">Thumbnail:</label>
        <input type="text" id="txtImgThumb" name="txtImgThumb" value="<?=$tile['image_thumb']?>" />

        <label for="txtImgThumbMed">Thumbnail - Med:</label>
        <input type="text" id="txtImgThumbMed" name="txtImgThumbMed" value="<?=$tile['image_thumb_med']?>" />

        <label for="txtImgMed">Medium:</label>
        <input type="text" id="txtImgMed" name="txtImgMed" value="<?=$tile['image_med']?>" />

        <label for="txtImgLarge">Large:</label>
        <input type="text" id="txtImgLarge" name="txtImgLarge" value="<?=$tile['image_large']?>" />

        <label for="txtAlt">Alt:</label>
        <input type="text" id="txtAlt" name="txtAlt" value="<?=$tile['alt']?>" />

        <label for="txtDirectiveText">Directive Text:</label>
        <input type="text" id="txtDirectiveText" name="txtDirectiveText" value="<?=$tile['directive_text']?>" placeholder="e.g. Read more"/>

        <label for="txtTripPlan">Trip Plan:</label>
        <textarea id="txtTripPlan" name="txtTripPlan" cols="100" rows="5"><?=$tile['trip_plan']?></textarea>

        <label for="txtIntroText">Intro Text:</label>
        <textarea id="txtIntroText" name="txtIntroText" cols="100" rows="5"><?=$tile['intro_text']?></textarea>

        <label for="txtContent">Content:</label>
        <textarea id="txtContent" name="txtContent" cols="100" rows="5"><?=$tile['content']?></textarea>

        <label for="txtAddressText">Address Text:</label>
        <textarea id="txtAddressText" name="txtAddressText" cols="100" rows="5"><?=$tile['address_text']?></textarea>

        <label for="chkLive">Live:</label>
        <input type="checkbox" id="chkLive" name="chkLive" value="1"<?php if ($tile['is_live'] == 1) { echo ' checked="checked"';}?> />

        <input type="submit" value="Submit" />
        <?php
        }
        ?>
    </form>
</section>
</body>
</html>