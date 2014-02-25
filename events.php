<?php
$pageMetaTitle = "Beyond the Wharf - Events";
$pageSection = "events";
$pageMetaDesc = "Find and share events that are coming up on Sydney Harbour.";
include 'includes/head.php';


function getEvents($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{   $str = 'events';
    $query = 'SELECT tiles.start_date, tiles.end_date, tiles.title, types.title as type_title, categories.title AS category_title, ';
    $query .= 'tiles.image_thumb, tiles.image_thumb_med, tiles.tile_size, tiles.alt, tiles.id FROM tiles ';
    $query .= 'JOIN types ON (tiles.type_id = types.id) ';
    $query .= 'LEFT OUTER JOIN categories ON (tiles.category_id = categories.id) ';
    $query .= 'WHERE types.title = ? AND tiles.start_date > ' . time() .' OR tiles.end_date > '. time() .' ORDER BY tiles.start_date';
    //echo 'query['.$query.']';
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $str);
    $stmt->execute();

    $stmt->bind_result($start_date, $end_date, $title, $type_title, $category_title, $image_thumb, $image_thumb_med, $tile_size, $alt, $tile_id);

    $results = array();
    $i = 0;
    while($stmt->fetch())
    {
        $results[$i]['start_date'] = $start_date;
        $results[$i]['end_date'] = $end_date;
        $results[$i]['title'] = $title;
        $results[$i]['type_title'] = $type_title;
        $results[$i]['category_title'] = $category_title;
        $results[$i]['image_thumb'] = $image_thumb;
        $results[$i]['image_thumb_med'] = $image_thumb_med;
        $results[$i]['tile_size'] = $tile_size;
        $results[$i]['alt'] = $alt;
        $results[$i]['tile_id'] = $tile_id;
        $i++;
    }
    return $results;
}

$events = getEvents($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

?>
<body>
<?php
include 'includes/nav.php';
?>
<section class="breadcrumbsHolder">
    <div class="row">
        <div class="large-12 columns breadcrumbs">
            <a href="<?=$baseURL?>/">Home</a><span>Events</span>
        </div>
    </div>
</section>

<section class="featureEvents marginBottomStandard">

    <div class="row marginTop20">
        <div class="large-12 columns">
            <h2 class="block clearfix text-left">Harbour Event Diary</h2>

        </div>

        <div class="small-9 large-9 columns left">
            <div class="large-12 small-12 eventFeature">
                <img src="<?=$baseURL?>/img/locations/large/vivid.jpg" alt="Vivid Sydney - Opera House in lights" />
                <div class="infoContainer">
                    <div class="inner">
                        <h5>Vivid</h5>
                        <span>23 May - 10 June 2014</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="small-3 large-3 columns">
            <div class="small-12 large-12 insta">
                <img src="<?=$baseURL?>/img/btwTile.gif" alt="" />

            </div>
        </div>

        <div class="small-3 large-3 columns">
            <div class="small-12 large-12 insta">
                <img src="<?=$baseURL?>/img/fbShareTile.gif" alt="" />

            </div>
        </div>
    </div>
</section>

<section class="eventTileHolder standardLightGrey paddingTopBottom20 marginBottomStandard">

    <div class="row marginBottomStandard">
        <?php
        $present_timestamp = getdate(time());
        $present_month_num = $present_timestamp['mon'];
        $present_month_name = $present_timestamp['month'];
        $event_count = 0;
        $flyout_count = 0;
        $last_month_name = '';
        $new_month = false;
        foreach ($events as $event)
        {
            $event_count++;
            $start_date = getdate($event['start_date']);
            $month_name = $start_date['month'];
            $month_num =  $start_date['mon'];

            if ($month_num < $present_month_num) {
                $month_name = $present_month_name;
            }

            if ($last_month_name !== $month_name)

            {
                $new_month = true;
                $flyout_count++;


                ?>
                    <div id="panelHolder-<?=$flyout_count?>" class="large-12 columns"></div>
                    <div class="large-12 columns">
                        <h3 class="text-center"><?=$month_name?></h3>
                    </div>
                <?php
            }
            else
            {
                $new_month = false;
            }

            ?>
            <div class="large-3 small-3 columns left">
                <div class="tile">
                    <div class="imgHolder">
                        <img src="<?=$baseURL?>/img/locations/thumbnails/<?=$event['image_thumb']?>" alt="<?=$event['alt']?>" />
                    </div>
                    <div class="textHolder">
                        <span><?=$event['type_title']?></span>
                        <h5><a href="#" class="panelFlyoutTrigger" data-location="<?=$event['tile_id']?>" data-target="panelHolder-<?=($flyout_count+1)?>" title="<?=$event['title']?>"><?=$event['title']?></a></h5>
                    </div>
                </div>
            </div>
            <?php
            $last_month_name = $month_name;
            if ($event_count == count($events))
            {
                ?>
                <div id="panelHolder-<?=($flyout_count+1)?>" class="large-12 columns"></div>
                <?php
            }
        }
        ?>



    </div>
</section>

<?php
include 'includes/footer.php';
?>


<?php
$pageId = 3;
include 'includes/global-js.php';
?>


<?php
include 'includes/analytics.php';
?>

<script>

</script>
</body>
</html>