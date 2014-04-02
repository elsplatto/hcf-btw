<?php
include 'includes/route-head.php';
?>
<body>
<?php
include 'includes/nav.php';


function getRoutesSelectedTiles($id, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $query = 'SELECT tiles.title, types.title as type_title, categories.title AS category_title, ';
    $query .= 'tiles.image_thumb, tiles.image_thumb_med, tiles.tile_size, tiles.alt, tile_id FROM route_page_tile ';
    $query .= 'JOIN tiles ON (tiles.id = route_page_tile.tile_id) ';
    $query .= 'JOIN types ON (tiles.type_id = types.id) ';
    $query .= 'LEFT OUTER JOIN categories ON (tiles.category_id = categories.id) ';
    $query .= 'WHERE route_id = ? ORDER BY route_page_tile.order';
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $stmt->bind_result($title, $type_title, $category_title, $image_thumb, $image_thumb_med, $tile_size, $alt, $tile_id);

    $results = array();
    $i = 0;
    while($stmt->fetch())
    {
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
    $stmt->close();
    $mysqli->close();
    return $results;
}



$routeTiles = getRoutesSelectedTiles($routeId,$DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
?>
<section class="breadcrumbsHolder">
    <div class="row">
        <div class="large-12 columns breadcrumbs">
            <a href="<?=$baseURL?>/">Home</a><span><?=$routeNavTitle?> Route</span>
        </div>
    </div>
</section>

<section class="routeHeaderHolder <?=$routeCSSClass?>">
    <div class="row">
        <div class="large-12 columns">
            <h2 class="sub"><?=$routeHeading?></h2>
            <?php
            if (strlen(trim($routeHeaderImage)) > 0)
            {
            ?>
                <div class="large-12 text-center">
                    <img src="<?=$baseURL?>/img/routes/<?=$routeHeaderImage?>" alt="" class="routeGraphic" />
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>

<section class="contentHolder marginBottomStandard">
    <div class="row">
        <div class="large-12 columns">

            <div class="large-12 columns white paddingTopBottom40">

                <div class="large-10 columns large-offset-1">
                    <?php
                    include 'includes/addthis.php';
                    ?>

                    <?php
                    if ($friendly_url == 'parramatta-river')
                    {
                    ?>
                    <div class="route-anchors">
                        <a href="#parramattaRoute" class="parramattaRoute route-legend slow-scroll">Parramatta Route</a>
                        <a href="#cockatooRoute" class="cockatooRoute route-legend slow-scroll">Cockatoo Island Route</a>
                    </div>
                        <a id="parramattaRoute"></a>
                    <?php
                    }
                    ?>

                    <h2 class="block clearfix text-left"><?=$routeContentHeader?></h2>
                    <?=stripcslashes($routeContent)?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mapHolder standardLightGrey paddingTopBottom20 marginBottomStandard">

    <div class="row marginBottomStandard">

            <!--h3 class="text-center">Find a Journey</h3-->
            <div class="large-12 columns" id="mapContainer">

                <div class="large-12" id="map-canvas">
                    <div id="map-canvas-loader"></div>
                </div>
                <a href="#" id="toggleMapControlPanel" class="toggleControlPanel"></a>

                <div id="mapControlPanelHolder" class="controlPanelHolder medium-6 small-6 large-3">
                    <div id="mapControlPanel" class="controlPanel">
                        <h6 class="white">FILTER:</h6>

                        <ul>
                            <?php
                            $filters = getRouteMapFilters($routeId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
                            for ($i = 0; $i < count($filters); $i++)
                            {
                                ?>
                                <li><a href="#" class="mapFilter" data-category="<?=$filters[$i]?>" data-visible="true"><?=$filters[$i]?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>

        <div class="large-12" id="pageTileContainer">

            <?php
            foreach ($routeTiles as $routeTile)
            {
                if ($routeTile['tile_size'] == 'medium')
                {
                    $imagePath = '../img/locations/thumbnail-med/'.$routeTile['image_thumb_med'];
                    $tileClass = 'large-6 medium-6 small-12';
                }
                else
                {
                    $imagePath = '../img/locations/thumbnails/'.$routeTile['image_thumb'];
                    $tileClass = 'large-3 medium-3 small-12';
                }

                if (!isset($routeTile['category_title']))
                {
                    $categoryTitle =  $routeTile['type_title'];
                }
                else
                {
                    $categoryTitle =  $routeTile['category_title'];
                }
                ?>
                <div class="<?=$tileClass?> columns left">
                    <div class="tile">
                        <div class="imgHolder">
                            <img src="<?=$imagePath?>" />
                        </div>
                        <div class="textHolder">
                            <span><?=$categoryTitle?></span>
                            <h5><a href="#" class="panelFlyoutTrigger" data-location="<?=$routeTile['tile_id']?>" data-target="pageTileContainer" title="<?=$routeTile['title']?>" onClick="trackInternalLink('Standard <?=$routeNavTitle?> Route Tile - click', '<?=addslashes($routeTile['title'])?>'); return false;"><?=$routeTile['title']?></a></h5>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>

        </div>
    </div>
</section>

<?php
include 'includes/itineraries.php';

include 'includes/more-articles.php';
include 'includes/instagram-shot-of-the-day.php';
include 'includes/footer.php';
include 'includes/analytics.php';

include 'includes/global-js.php';
include 'includes/instagram-js.php';
include 'includes/route-map-code.php';

?>
</body>
</html>