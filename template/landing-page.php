<body>
<?php
include 'includes/nav.php';


$pageTiles = getPagesSelectedTiles($pageId,$DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
?>
<section class="breadcrumbsHolder">
    <div class="row">
        <div class="large-12 columns breadcrumbs">
            <a href="<?=$baseURL?>/">Home</a><span><?=$pageNavTitle?></span>
        </div>
    </div>
</section>

<?php
if ($friendly_url == 'local-insights')
{
?>

<section class="featureTileHolder marginTop10 marginBottomStandard">
    <div class="row">
        <div class="large-12 columns">
            <h2 class="block text-left"><?=$pageHeading?></h2>
        </div>

        <div class="large-12" id="featureTileContainer">
            <div class="large-6 small-6 columns left">
                <div class="tile">
                    <div class="imgHolder">
                        <img src="<?=$baseURL?>/img/locations/thumbnail-med/mariner.jpg" />
                    </div>
                    <div class="textHolder">
                        <h5><a href="<?=$baseURL?>/page/sydney-harbour-history">Sydney Harbour History</a></h5>
                        <span>The Mariner</span>
                    </div>
                </div>
            </div>

            <div class="large-3 small-3 columns left">
                <div class="tile">
                    <div class="imgHolder">
                        <img src="../img/locations/thumbnails/ancestral.jpg" />
                    </div>
                    <div class="textHolder">
                        <h5><a href="#" class="panelFlyoutTrigger" data-location="5" data-target="featureTileContainer">Indigenous Culture</a></h5>
                        <span>The Ancestral Spirit</span>
                    </div>
                </div>
            </div>

            <div class="large-3 small-3 columns left">
                <div class="tile">
                    <div class="imgHolder">
                        <img src="../img/locations/thumbnails/artist.jpg" />
                    </div>
                    <div class="textHolder">
                        <h5><a href="#" class="panelFlyoutTrigger" data-location="5" data-target="featureTileContainer">Title</a></h5>
                        <span>Theme</span>
                    </div>
                </div>
            </div>

            <div class="large-3 small-3 columns left">
                <div class="tile">
                    <div class="imgHolder">
                        <img src="../img/locations/thumbnails/family.jpg" />
                    </div>
                    <div class="textHolder">
                        <h5><a href="#" class="panelFlyoutTrigger" data-location="5" data-target="featureTileContainer">Family Fun</a></h5>
                        <span>The Child at Heart</span>
                    </div>
                </div>
            </div>

            <div class="large-3 small-3 columns left">
                <div class="tile social blue">

                </div>
            </div>

            <div class="large-6 small-6 columns left">
                <div class="tile">
                    <div class="imgHolder">
                        <img src="../img/locations/thumbnail-med/entertainment.jpg" />
                    </div>
                    <div class="textHolder">
                        <h5><a href="#" class="panelFlyoutTrigger" data-location="5" data-target="featureTileContainer">Harbour Entertainment</a></h5>
                        <span>The Party Goer</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

</section>
<?php
}
?>

<?php
if ($hasMap > 0 || count($pageTiles) > 0)
{
?>
<section class="mapHolder standardLightGrey paddingTopBottom20 marginBottomStandard">

    <div class="row">
        <?php
        if ($hasMap > 0)
        {
            ?>
            <h3 class="text-center">Find a Journey</h3>
            <div class="large-12 columns" id="mapContainer">

                <div class="large-12" id="map-canvas"></div>
                <a href="#" id="toggleMapControlPanel" class="toggleControlPanel">&gt;</a>

                <div id="mapControlPanelHolder" class="controlPanelHolder large-3">
                    <div id="mapControlPanel" class="controlPanel">
                        <h6 class="white">FILTER:</h6>

                        <ul>
                            <?php
                            $filters = getFilters($pageId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
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
        <?php
        }
        ?>

        <div class="large-12" id="pageTileContainer">

            <?php
            foreach ($pageTiles as $pageTile)
            {
                if ($pageTile['tile_size'] == 'medium')
                {
                    $imagePath = '../img/locations/thumbnail-med/'.$pageTile['image_thumb_med'];
                    $tileClass = 'large-6 small-6';
                }
                else
                {
                    $imagePath = '../img/locations/thumbnails/'.$pageTile['image_thumb'];
                    $tileClass = 'large-3 small-3';
                }

                if (!isset($pageTile['category_title']))
                {
                    $categoryTitle =  $pageTile['type_title'];
                }
                else
                {
                    $categoryTitle =  $pageTile['category_title'];
                }
                ?>
                <div class="<?=$tileClass?> columns left">
                    <div class="tile">
                        <div class="imgHolder">
                            <img src="<?=$imagePath?>" />
                        </div>
                        <div class="textHolder">
                            <span><?=$categoryTitle?></span>
                            <h5><a href="#" class="panelFlyoutTrigger" data-location="<?=$pageTile['tile_id']?>" data-target="pageTileContainer" title="<?=$pageTile['title']?>"><?=$pageTile['title']?></a></h5>
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
}
?>


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

<?php
$relPath = '../';
include 'includes/global-js.php';
include 'includes/map-code.php';
?>