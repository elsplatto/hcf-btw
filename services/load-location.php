<?php
include '../includes/site-settings.php';
include '../includes/db.php';

$locationId = $_GET['id'];
$relPath = $_GET['relPath'];

if (isset($locationId))
{
    $query = 'SELECT tiles.title, tiles.image_med, tiles.alt, tiles.sub_heading, tiles.intro_text, ';
    $query .= 'tiles.lat, tiles.lng, tiles.trip_plan, tiles.address_text, ';
    $query .= 'categories.title AS category_title, types.title AS type_title, categories.map_icon, tiles.start_date, tiles.end_date, tiles.cost FROM tiles ';
    $query .= 'JOIN types ON tiles.type_id = types.id ';
    $query .= 'LEFT OUTER JOIN categories ON tiles.category_id = categories.id ';
    $query .= 'WHERE tiles.id = ?';

    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $locationId);

    $stmt->execute();

    $numRows = count($stmt->bind_result($title, $image_med, $alt, $sub_heading, $intro_text, $lat, $lng, $trip_plan, $address_text, $category_title, $type_title, $map_icon, $start_date, $end_date, $cost));

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
            <div class="large-12 medium-12 small-12 columns standardDarkGrey paddingTop20">
                <a href="#" class="flyoutPanelClose">Close panel</a>
                <span><?=ucwords($category_title)?></span>
                <h3><?=$title?></h3>
                <?=stripcslashes(stripcslashes($intro_text))?>
                <?php
                if ($type_title == 'events')
                {

                    $event_start_date = getdate($start_date);
                    $event_end_date = getdate($end_date);

                    $event_start_month_name = $event_start_date['month'];
                    $event_end_month_name = $event_end_date['month'];


                    $event_start_hour = $event_start_date['hours'];
                    $event_start_mins = $event_start_date['minutes'];

                    $event_end_hour = $event_end_date['hours'];
                    $event_end_mins = $event_end_date['minutes'];


                    if ($event_start_hour == 0 && $event_start_mins == 0)
                    {
                        $display_start_date = date('d F',$start_date);
                    }
                    else
                    {
                        $display_start_date = date('d F Y H:i',$start_date);
                    }

                    if ($event_end_hour == 0 && $event_end_mins == 0)
                    {
                        $display_end_date = date('d F',$end_date);
                    }
                    else
                    {
                        $display_end_date = date('d F Y H:i',$end_date);
                    }


                ?>
                    <h4>Event Details</h4>
                    <p><strong>Dates: </strong> <?=$display_start_date?> - <?=$display_end_date?></p>
                    <p><strong>Cost: </strong> <?echo $cost>0? '$'.sprintf("%0.2f",round($cost,2)): 'Free'?></p>
                <?php
                }
                ?>
            </div>
            <div class="large-12 medium-12 small-12 standardDarkGrey paddingBottom20">
                <div class="large-7 medium-7 small-12 columns left"><img src="<?=$relPath?>img/locations/medium/<?=$image_med?>" alt="<?=$alt?>"></div>
                <div class="large-5 medium-5 small-12 columns left">
                    <div id="flyoutMap" class="map"></div>

                    <?=stripcslashes(stripcslashes($address_text))?>
                </div>
            </div>

            <?php
            if (!is_null($trip_plan) && strlen(trim($trip_plan)) > 0)
            {
            ?>
            <div class="large-12 medium-12 small-12 columns standardDarkGrey">
                <div class="ferryInfo large-12 medium-12 small-12 columns ultraDarkGrey">
                    <h4>Ferry Information</h4>
                    <?=stripcslashes(stripcslashes($trip_plan))?>
                </div>
            </div>
            <?php
            }
            ?>

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
                icon: '<?=$baseURL?>/img/secretsMarker.png',
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
        <div class="large-12 medium-12 small-12 columns standardDarkGrey paddingTopBottom20">
        <a href="#" class="flyoutPanelClose">Close panel</a>
        <h4>Whoops... we appear to have an issue</h4>
        </div>
        <?php
    }
    //$jsonData = json_encode($json);
    //echo $jsonData;

    $stmt->close();
    $mysqli->close();
}

?>


