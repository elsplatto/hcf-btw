<?php
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin();

$tile_id = $_GET['id'];

function getTile($id, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $query = 'SELECT type_id, category_id, tile_size, title, lat, lng, image_thumb, image_thumb_med, image_med, image_large, ';
    $query .= 'directive_text, alt, category, sub_heading, trip_plan, intro_text, content, address_text, start_date, end_date, cost, tags, is_live ';
    $query .= 'FROM tiles WHERE id = ?';
    //echo $query;
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($type_id, $category_id, $tile_size, $title, $lat, $lng, $image_thumb, $image_thumb_med, $image_med, $image_large, $directive_text, $alt, $category, $sub_heading, $trip_plan, $intro_text, $content, $address_text, $start_date, $end_date, $cost, $tags, $is_live );
    $results = array();
    $i = 0;
    while($stmt->fetch())
    {
        $results[$i]['type_id'] = $type_id;
        $results[$i]['category_id'] = $category_id;
        $results[$i]['tile_size'] = $tile_size;
        $results[$i]['title'] = $title;
        $results[$i]['lat'] = $lat;
        $results[$i]['lng'] = $lng;
        $results[$i]['image_thumb'] = $image_thumb;
        $results[$i]['image_thumb_med'] = $image_thumb_med;
        $results[$i]['image_med'] = $image_med;
        $results[$i]['image_large'] = $image_large;
        $results[$i]['directive_text'] = $directive_text;
        $results[$i]['alt'] = $alt;
        $results[$i]['category'] = $category;
        $results[$i]['sub_heading'] = $sub_heading;
        $results[$i]['trip_plan'] = $trip_plan;
        $results[$i]['intro_text'] = $intro_text;
        $results[$i]['content'] = $content;
        $results[$i]['address_text'] = $address_text;
        $results[$i]['start_date'] = $start_date;
        $results[$i]['end_date'] = $end_date;
        $results[$i]['cost'] = $cost;
        $results[$i]['tags'] = $tags;
        $results[$i]['is_live'] = $is_live;
        $i++;
    }

    $mysqli->close();
    return $results;
}

function getTypes($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT id, title FROM types WHERE is_valid = 1');
    $stmt->execute();
    $stmt->bind_result($id, $title);

    $results = array();
    $i = 0;
    while($stmt->fetch())
    {
        $results[$i]['id'] = $id;
        $results[$i]['title'] = $title;
        $i++;
    }

    $mysqli->close();
    return $results;
}

function getCategories($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT c.id, c.title, c.type_id, t.title AS type_title FROM categories c, types t WHERE c.is_valid = 1 AND t.id = c.type_id ORDER BY c.type_id');
    $stmt->execute();
    $stmt->bind_result($id, $title, $type_id, $type_title);

    $results = array();
    $i = 0;
    while($stmt->fetch())
    {
        $results[$i]['id'] = $id;
        $results[$i]['title'] = $title;
        $results[$i]['type_id'] = $type_id;
        $results[$i]['type_title'] = $type_title;
        $i++;
    }

    $mysqli->close();
    return $results;
}

$tiles = getTile($tile_id, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

$types = getTypes($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

$categories = getCategories($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

$typesCount = count($types);
$categoriesCount = count($categories);
?>
<html>
<head>
    <title>Edit Tile</title>
    <?php
    include 'includes/head.php';
    ?>
</head>
<body>
<?php
foreach ($tiles as $tile)
{
    $lat = $tile['lat'];
    $lng = $tile['lng'];
?>
<section>
    <div class="row">
        <div class="large-12 columns">
            <a href="dashboard.php">Dashboard</a>
            <h1>Tile - <?=$tile['title']?></h1>
            <a href="tiles-list.php">< Back to Tile List</a>
             -
            <a href="tile-add.php">Add Tile</a>
        </div>
    </div>
</section>

<section>
    <form id="frmTile" name="frmTile" action="tile-process.php" method="post">
    <div class="row">
        <div class="large-12 columns">

                <input type="hidden" id="tileID" name="tileID" value="<?=$tile_id?>" />
                <label for="txtTitle">Title:</label>
                <input type="text" id="txtTitle" name="txtTitle" value="<?=$tile['title']?>" />

                <label for="selType">Type:</label>
                <?php
                if ($typesCount > 0)
                {
                ?>
                <select id="selType" name="selType">
                    <option value="0">Select</option>
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


                <label for="dateStartDate">Start Date:</label>
                <input type="text" id="dateStartDate" name="dateStartDate" class="dateTimePickerInput" value="<?echo $tile['start_date'] > 0 ? date('d-F-Y H:i',$tile['start_date']): ''?>" />

                <label for="endStartDate">End Date:</label>
                <input type="text" id="dateEndDate" name="dateEndDate" class="dateTimePickerInput" value="<?echo $tile['end_date'] > 0 ? date('d-F-Y H:i',$tile['end_date']): ''?>" />

                <label for="cost">Cost:</label>
                <input type="text" id="cost" name="cost" placeholder="00.00" value="<?=sprintf("%0.2f",round($tile['cost'],2))?>" />


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

                <label for="selTileSize">Size:</label>
                <select id="selTileSize" name="selTileSize">
                    <option value="">Select</option>
                    <option value="small"<?php echo ($tile['tile_size'] == 'small'?' selected="selected"':'')?>>Small</option>
                    <option value="medium"<?php echo ($tile['tile_size'] == 'medium'?' selected="selected"':'')?>>Medium</option>
                </select>
        </div>
        <div class="large-5 columns left">

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

        </div>

        <div class="large-7 columns left">
            <a href="#" class="useMap" data-target="tile-map-canvas">Hide Map</a>
            <div id="tile-map-canvas" class="google-maps" style="width: 800px; height: 500px;"></div>
        </div>

        <div class="large-12 columns">

                <label for="txtTripPlan">Trip Plan:</label>
                <textarea id="txtTripPlan" name="txtTripPlan" cols="100" rows="5"><?=stripcslashes(stripcslashes($tile['trip_plan']))?></textarea>

                <label for="txtIntroText">Intro Text:</label>
                <textarea id="txtIntroText" name="txtIntroText" cols="100" rows="5"><?=stripcslashes(stripcslashes($tile['intro_text']))?></textarea>

                <label for="txtContent">Content:</label>
                <textarea id="txtContent" name="txtContent" cols="100" rows="5"><?=stripcslashes(stripcslashes($tile['content']))?></textarea>

                <label for="txtAddressText">Address Text:</label>
                <textarea id="txtAddressText" name="txtAddressText" cols="100" rows="5"><?=stripcslashes(stripcslashes($tile['address_text']))?></textarea>

                <label for="txtTags">Tags:</label>
                <input type="text" id="txtTags" name="txtTags" value="<?=$tile['tags']?>" placeholder="No # - separate by comma."/>

                <label for="chkLive">Live:</label>
                <input type="checkbox" id="chkLive" name="chkLive" value="1"<?php echo ($tile['is_live'] == 1?' checked="checked"':'')?> />

                <input type="submit" value="Submit" />
            </div>
        </div>
    </form>
</section>
<?php
}
?>
<script>
    initialize();
    var map;
    function initialize() {
        <?php
        if ($lat != 0)
        {
        ?>
            var myLatlng = new google.maps.LatLng(<?=$lat?>,<?=$lng?>);
        <?php
        }
        else
        {
        ?>
            var myLatlng = new google.maps.LatLng(-33.836311,151.208267);

        <?php
        }
        ?>

        var myOptions = {
            zoom: 17,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById("tile-map-canvas"), myOptions);

        var marker = new google.maps.Marker({
            draggable: true,
            position: myLatlng,
            map: map,
            title: "Your location"
        });

        google.maps.event.addListener(marker, 'dragend', function (event) {
            document.getElementById("txtLat").value = this.getPosition().lat();
            document.getElementById("txtLng").value = this.getPosition().lng();
        });

    }

    $(function(){
        $('.useMap').click(function(e) {
            e.preventDefault();
            var target = $('#' + $(this).attr('data-target'));

            if (target.is(':hidden'))
            {
                target.show();
                $(this).text('Hide map');
            }
            else
            {
                target.hide();
                $(this).text('Show map');
            }
        });

        $('.dateTimePickerInput').datetimepicker({
            dateFormat: 'dd-MM-yy'
        });
        $('#dateStartDate').on('blur', function(){
            if ($(this).val() !== '')
            {
                //console.log(new Date($('#dateStartDate').val()))
                $('#dateEndDate').datetimepicker('option', 'minDate',$(this).val());
            }
        });
    })
</script>
</body>
</html>