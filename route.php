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
                    <img src="<?=$baseURL?>/img/<?=$routeHeaderImage?>" alt="" class="routeGraphic" />
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
                    <h2 class="block clearfix text-left"><?=$routeContentHeader?></h2>
                    <?=stripcslashes($routeContent)?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="calloutHolder marginBottomStandard">
    <div class="row">
        <div class="large-12 columns">
            <div class="large-12 callout">
                <div class="inner green">
                    <h3>Do you have a great story about Sydney’s historic harbour?</h3>
                    <p>Share you secrets with us and win a <strong>month free travel</strong> on Sydney’s historic ferries</p>
                    <a href="#" class="button wire white">Find out more</a>
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
                <a href="#" id="toggleMapControlPanel" class="toggleControlPanel">&gt;</a>

                <div id="mapControlPanelHolder" class="controlPanelHolder large-3">
                    <div id="mapControlPanel" class="controlPanel">
                        <h6 class="white">FILTER:</h6>

                        <ul>
                            <?php
                            $filters = getRouteMapFilters($routeId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
                            for ($i = 0; $i < count($filters); $i++)
                            {
                                ?>
                                <li><a href="#" class="mapFilter" data-category="<?=$filters[$i]?>" data-visible="true"><span><span></span></span><?=$filters[$i]?></a></li>
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
                    $tileClass = 'large-6 small-6';
                }
                else
                {
                    $imagePath = '../img/locations/thumbnails/'.$routeTile['image_thumb'];
                    $tileClass = 'large-3 small-3';
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
                            <h5><a href="#" class="panelFlyoutTrigger" data-location="<?=$routeTile['tile_id']?>" data-target="pageTileContainer" title="<?=$routeTile['title']?>"><?=$routeTile['title']?></a></h5>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>

        </div>
    </div>
</section>

<section class="itineraryTileHolder marginBottomStandard">
    <div class="row">
        <div class="large-12">
            <h3 class="text-center">Recommended Itineraries</h3>
            <div class="large-6 columns left">
                <div class="itineraryTile" style="background-image: url('<?=$baseURL?>/img/itineraries/tile/tile-2.jpg'); background-repeat: no-repeat;">
                    <div class="inner">
                        <div class="textHolder">
                            <span>Itinerary – by Joel Beck – 3 hours</span>
                            <h3><a href="#">Enjoy the history of the harbour in our Manly Itinerary</a></h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="large-6 columns right">
                <div class="itineraryTile" style="background-image: url('<?=$baseURL?>/img/itineraries/tile/tile-1.jpg'); background-repeat: no-repeat;">
                    <div class="inner">
                        <div class="textHolder">
                            <span>Itinerary – by Joel Beck – 3 hours</span>
                            <h3><a href="#">Enjoy the history of the harbour in our Manly Itinerary.</a></h3>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>





<?php


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