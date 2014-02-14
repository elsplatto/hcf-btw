<?php
include '../includes/db.php';

$locationId = $_GET['id'];
$relPath = $_GET['relPath'];

if (isset($locationId))
{
    $query = 'SELECT tiles.title, tiles.image_med, tiles.alt, tiles.sub_heading, tiles.intro_text, ';
    $query .= 'tiles.lat, tiles.lng, tiles.trip_plan, tiles.address_text, ';
    $query .= 'categories.title AS category_title, types.title AS type_title, categories.map_icon FROM tiles ';
    $query .= 'JOIN types ON tiles.type_id = types.id ';
    $query .= 'LEFT OUTER JOIN categories ON tiles.category_id = categories.id ';
    $query .= 'WHERE tiles.id = ?';

    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $locationId);

    $stmt->execute();

    $numRows = count($stmt->bind_result($title, $image_med, $alt, $sub_heading, $intro_text, $lat, $lng, $trip_plan, $address_text, $category_title, $type_title, $map_icon));

    $json = array();
    if ($numRows > 0)
    {
        //echo 'trip plan['.$trip_plan.']';
        while ($stmt->fetch()) {

            if (is_null($category_title))
            {
                $category_title = $type_title;
            }


        ?>
            <div class="large-12 columns standardDarkGrey paddingTop40">
                <a href="#" class="flyoutPanelClose">Close panel</a>
                <span><?=ucwords($category_title)?></span>
                <h3><?=$title?></h3>
                <?=$intro_text?>

                <?php
                if (!is_null($trip_plan))
                {
                ?> <div class="ferryInfo large-12 columns ultraDarkGrey">
                    <h4>Ferry Information</h4>
                    <?=$trip_plan?>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="large-12 standardDarkGrey paddingBottom20">
                <div class="large-7 columns left"><img src="<?=$relPath?>img/locations/medium/<?=$image_med?>" alt="<?=$alt?>"></div>
                <div class="large-5 columns left">
                    <div id="flyoutMap" class="map"></div>

                    <?=$address_text?>
                </div>
            </div>

            <script>
                var flyoutMapOptions = {
                center: new google.maps.LatLng(<?=$lat?>,<?=$lng?>),
                zoom: 14,
                mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.TERRAIN],
                position: google.maps.ControlPosition.BOTTOM_CENTER
                }
                };
                var map = new google.maps.Map(document.getElementById("flyoutMap"),
                flyoutMapOptions);

                var flyoutLatLng = new google.maps.LatLng(<?=$lat?>,<?=$lng?>);
                var flyoutMarker = new google.maps.Marker({
                position: flyoutLatLng,
                icon: '<?=$relPath?>img/<?=$map_icon?>',
                map: map,
                id: 'flyoutMarker'
                });
            </script>
        <?php
        }
    }
    else
    {
        ?>
        <div class="large-12 columns standardDarkGrey paddingTopBottom20">
        <a href="#" class="flyoutPanelClose">Close panel</a>
        <h4>Whoops... we appear to have an issue</h4>
        </div>
        <?php
    }
    //$jsonData = json_encode($json);
    //echo $jsonData;
    $mysqli->close();
}

?>


