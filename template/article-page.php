<body>
<?php
include 'includes/nav.php';


$pageTiles = getPagesSelectedTiles($pageId,$DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
?>
<section class="breadcrumbsHolder">
    <div class="row">
        <div class="large-12 columns breadcrumbs">
            <a href="<?=$baseURL?>/">Home</a><span><?=$pageHeading?></span>
        </div>
    </div>
</section>
<section class="featureImgHolder">
    <img src="../img/featureImages/<?=$pageHeaderImage?>" />
    <div class="headerHolder">
        <h2 class="sub"><?=$pageHeading?></h2>
        <hr />
        <h3 class="pullout clearfix"><?=$pagePullout?></h3><br />
        <?php
        if (strlen($videoEmbed) > 0)
        {
        ?>
        <a href="<?=$baseURL?>/overlays/show-video.php?id=<?=$pageId?>" class="button red play tungsten small reveal-init" data-size="medium">Watch the video</a>
        <?php
        }
        ?>
    </div>
</section>
<section class="contentHolder marginBottomStandard">
    <div class="row">
        <div class="large-12 columns">
            <div class="large-12 columns white paddingTopBottom40">
                <div class="large-10 columns large-offset-1 headerContentArea">
                    <h2 class="block clearfix text-left"><?=$pageContentHeader?></h2>
                    <?=stripcslashes($pageContent)?>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
if ($friendly_url !== 'about-us')
{
?>
<section class="calloutHolder marginBottomStandard">
    <div class="row">
        <div class="large-12 columns">
            <div class="large-12 callout">
                <div class="inner green">
                    <h3>Do you have a great story about Sydney’s historic harbour?</h3>
                    <p>Share you secrets with us and win a <strong>month free travel</strong> on Sydney’s historic ferries</p>
                    <a href="<?=$baseURL?>/overlays/contribute-story.php" class="button wire white reveal-init" data-size="small">Find out more</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
}
if ($hasMap > 0 || count($pageTiles) > 0)
{
?>
<section class="mapHolder standardLightGrey paddingTopBottom20 marginBottomStandard">

    <div class="row marginBottomStandard">
        <?php
        if ($hasMap > 0)
        {
            ?>
            <h3 class="text-center">Find a Journey</h3>
            <div class="large-12 columns" id="mapContainer">

                <div class="large-12" id="map-canvas">
                    <div id="map-canvas-loader"></div>
                </div>
                <a href="#" id="toggleMapControlPanel" class="toggleControlPanel">;</a>

                <div id="mapControlPanelHolder" class="controlPanelHolder medium-6 small-6 large-3">
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

<?php
if ($friendly_url !== 'about-us')
{

    include 'includes/itineraries.php';

    include 'includes/more-articles.php';
}
?>


<?php
include 'includes/global-js.php';

if ($hasMap > 0)
{
    include 'includes/map-code.php';
}

?>