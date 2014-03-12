<?php
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin();

$route_id = $_GET['id'];

function getRoute($id, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $query = 'SELECT nav_title, route_title, page_title, friendly_url, heading, heading_pullout, route_colour, sub_route_colour, css_class, info_bubble_width, info_bubble_height, ';
    $query .= 'header_image, header_mp4, header_webm, nav_order, ';
    $query .= 'tags,  content_header, content, meta_keywords, meta_desc, is_live FROM route WHERE id = ?';
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $stmt->bind_result($nav_title, $route_title, $page_title, $friendly_url, $heading, $heading_pullout, $route_colour, $sub_route_colour, $css_class, $info_bubble_width, $info_bubble_height, $header_image, $header_mp4, $header_webm, $nav_order, $tags, $content_header, $content, $meta_keywords, $meta_desc, $is_live);

    $results = array();
    $i = 0;
    while($stmt->fetch())
    {
        $results[$i]['nav_title'] = $nav_title;
        $results[$i]['route_title'] = $route_title;
        $results[$i]['page_title'] = $page_title;
        $results[$i]['friendly_url'] = $friendly_url;
        $results[$i]['heading'] = $heading;
        $results[$i]['heading_pullout'] = $heading_pullout;
        $results[$i]['route_colour'] = $route_colour;
        $results[$i]['sub_route_colour'] = $sub_route_colour;
        $results[$i]['css_class'] = $css_class;
        $results[$i]['info_bubble_width'] = $info_bubble_width;
        $results[$i]['info_bubble_height'] = $info_bubble_height;
        $results[$i]['header_image'] = $header_image;
        $results[$i]['header_mp4'] = $header_mp4;
        $results[$i]['header_webm'] = $header_webm;
        $results[$i]['nav_order'] = $nav_order;
        $results[$i]['tags'] = $tags;
        $results[$i]['content_header'] = $content_header;
        $results[$i]['content'] = $content;
        $results[$i]['meta_keywords'] = $meta_keywords;
        $results[$i]['meta_desc'] = $meta_desc;
        $results[$i]['is_live'] = $is_live;
        $i++;
    }

    $stmt->close();
    $mysqli->close();
    return $results;
}


function getSelectedRouteMapTiles($id,$DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT route_id, tile_id, tiles.title, tiles.tags FROM route_map_tile JOIN tiles ON tile_id = tiles.id WHERE route_id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($route_id, $tile_id, $title, $tags);
    $results = array();
    $i = 0;
    while($stmt->fetch())
    {
        $results[$i]['route_id'] = $route_id;
        $results[$i]['tile_id'] = $tile_id;
        $results[$i]['title'] = $title;
        $results[$i]['tags'] = $tags;
        $i++;
    }
    $stmt->close();
    $mysqli->close();
    return $results;
}

function getAllMapTiles($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT tiles.id, tiles.title, tiles.image_thumb, tiles.tags FROM tiles WHERE tiles.is_live = 1 AND tiles.type_id = 1 AND tiles.image_thumb IS NOT NULL AND tiles.image_thumb != \'\'');
    $stmt->execute();
    $stmt->bind_result($id, $title, $image_thumb, $tags);
    $results = array();
    $i = 0;
    while($stmt->fetch())
    {
        $results[$i]['id'] = $id;
        $results[$i]['title'] = $title;
        $results[$i]['image_thumb'] = $image_thumb;
        $results[$i]['tags'] = $tags;
        $i++;
    }
    $stmt->close();
    $mysqli->close();
    return $results;
}

function getAllTiles($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT tiles.id, tiles.title, tiles.image_thumb, tiles.image_thumb_med, tiles.tile_size, tiles.tags  FROM tiles WHERE tiles.is_live = 1');
    $stmt->execute();
    $stmt->bind_result($id, $title, $image_thumb, $image_thumb_med, $tile_size, $tags);
    $results = array();
    $i = 0;
    while($stmt->fetch())
    {
        $results[$i]['id'] = $id;
        $results[$i]['title'] = $title;
        $results[$i]['image_thumb'] = $image_thumb;
        $results[$i]['image_thumb_med'] = $image_thumb_med;
        $results[$i]['tile_size'] = $tile_size;
        $results[$i]['tags'] = $tags;
        $i++;
    }
    $stmt->close();
    $mysqli->close();
    return $results;
}

function getSelectedRouteTiles($id,$DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT tiles.title, tiles.image_thumb, tiles.image_thumb_med, tiles.tile_size, tile_id, route_page_tile.order, tiles.tags FROM (route_page_tile) JOIN tiles ON tiles.id = route_page_tile.tile_id WHERE route_id = ? ORDER BY route_page_tile.order');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($title, $image_thumb, $image_thumb_med, $tile_size, $tile_id, $order, $tags);
    $results = array();
    $i = 0;
    while($stmt->fetch())
    {
        $results[$i]['title'] = $title;
        $results[$i]['image_thumb'] = $image_thumb;
        $results[$i]['image_thumb_med'] = $image_thumb_med;
        $results[$i]['tile_size'] = $tile_size;
        $results[$i]['tile_id'] = $tile_id;
        $results[$i]['order'] = $order;
        $results[$i]['tags'] = $tags;
        $i++;
    }
    $stmt->close();
    $mysqli->close();
    return $results;
}

$routes = getRoute($route_id, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
$allMapTiles = getAllMapTiles($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
$selectedMapTiles = getSelectedRouteMapTiles($route_id ,$DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
$allPageTiles = getAllTiles($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
$selectedRoutePageTiles = getSelectedRouteTiles($route_id ,$DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
?>
<html>
<head>
    <title>Edit Route</title>
    <?php
    include 'includes/head.php';
    ?>
</head>
<body>

<section>
    <div class="row">
        <div class="large-12 columns">
            <a href="dashboard.php">Dashboard</a>
            <h1>Route - Edit</h1>
            <a href="route-list.php">< Back to Route List</a>
            -
            <a href="route-add.php">Add Route</a>
        </div>
    </div>
</section>

<section>
<div class="row">
<div class="large-12 columns">
<form id="frmRoute" name="frmRoute" action="route-process.php" method="post">
<?php
foreach ($routes as $route)
{
    ?>
    <input type="hidden" id="routeID" name="routeID" value="<?=$route_id?>" />

    <label for="txtTitle">Title:(appears in browsers title barl)</label>
    <input type="text" id="txtPageTitle" name="txtPageTitle" value="<?=$route['page_title']?>" />

    <label for="txtTitle">Nav Title:</label>
    <input type="text" id="txtNavTitle" name="txtNavTitle" value="<?=$route['nav_title']?>" />

    <label for="txtFriendlyURL">Friendly URL:</label>
    <input type="text" id="txtFriendlyURL" name="txtFriendlyURL" value="<?=$route['friendly_url']?>" placeholder="Lower case and separated by '-'" />


    <label for="txtHeading">Heading:</label>
    <input type="text" id="txtHeading" name="txtHeading" value="<?=$route['heading']?>" />

    <label for="txtHeadingPullout">Heading Pullout/Quote:</label>
    <input type="text" id="txtHeadingPullout" name="txtHeadingPullout" value="<?=$route['heading_pullout']?>" />

    <label for="txtRouteColour">Route Colour:</label>
    <input type="text" id="txtRouteColour" name="txtRouteColour" value="<?=$route['route_colour']?>" />

    <label for="txtSubRouteColour">Sub Route Colour:</label>
    <input type="text" id="txtSubRouteColour" name="txtSubRouteColour" value="<?=$route['sub_route_colour']?>" />

    <label for="txtCSSClass">CSS Class:</label>
    <input type="text" id="txtCSSClass" name="txtCSSClass" value="<?=$route['css_class']?>" />

    <label for="txtHeaderImage">Header Image:</label>
    <input type="text" id="txtHeaderImage" name="txtHeaderImage" value="<?=$route['header_image']?>" />


    <label for="txtInfoBubbleWidth">Info Bubble Width:</label>
    <input type="text" id="txtInfoBubbleWidth" name="txtInfoBubbleWidth" value="<?=$route['info_bubble_width']?>" />

    <label for="txtInfoBubbleHeight">Info Bubble Height:</label>
    <input type="text" id="txtInfoBubbleHeight" name="txtInfoBubbleHeight" value="<?=$route['info_bubble_height']?>" />

    <label for="txtHeaderMP4">Header mp4:</label>
    <input type="text" id="txtHeaderMP4" name="txtHeaderMP4" value="<?=$route['header_mp4']?>" />

    <label for="txtHeaderWebm">Header webm:</label>
    <input type="text" id="txtHeaderWebm" name="txtHeaderWebm" value="<?=$route['header_webm']?>" />

    <label for="txtTags">Tags:</label>
    <input type="text" id="txtTags" name="txtTags" value="<?=$route['tags']?>" placeholder="No # and separate by comma" />

    <label for="txtContentHeader">Content Heading:</label>
    <input type="text" d="txtContentHeader" name="txtContentHeader" value="<?=$route['content_header']?>" placeholder="Appears above the content" />

    <label for="txtContent">Content:</label>
    <textarea id="txtContent" name="txtContent" cols="100" rows="5"><?=stripcslashes($route['content'])?></textarea>

    <label for="txtMetaKeywords">Meta Keywords:</label>
    <input type="text" id="txtMetaKeywords" name="txtMetaKeywords" value="<?=$route['meta_keywords']?>" placeholder="No # and separate by comma" />

    <label for="txtMetaDescription">Meta Description:</label>
    <input type="text" id="txtMetaDescription" name="txtMetaDescription" value="<?=$route['meta_desc']?>" />

    <label for="txtNavOrder">Order:</label>
    <input type="text" id="txtNavOrder" name="txtNavOrder" value="<?=$route['nav_order']?>" />

    <label>Map Tiles</label>
    <div class="mapTiles">
        <input type="text" class="tileFilter" data-containment="mapTileList" placeholder="Enter text to filter tiles" />
        <ul class="tileList" id="mapTileList">
            <?php
            foreach ($allMapTiles as $mapTile)
            {
                $strSelected = '';
                $strSelectedIndicator = '';
                foreach ($selectedMapTiles as $selectedMapTile)
                {
                    if ($mapTile['id'] == $selectedMapTile['tile_id'])
                    {
                        $strSelected = ' data-map-tile-selected';
                        break;
                    }
                }
                ?>
                <li<?=$strSelected?> data-tile-id="<?=$mapTile['id']?>" data-route-id="<?=$route_id?>" class="large-3 columns left" data-tags="<?=$mapTile['tags']?>">
                    <div class="tile">
                        <div class="imgHolder">
                            <img src="../img/locations/thumbnails/<?=$mapTile['image_thumb']?>" />
                        </div>
                        <div class="textholder">
                            <h5><?=$mapTile['title']?></h5>
                        </div>
                    </div>
                </li>
            <?php
            }
            ?>
        </ul>
    </div>

    <label>Page Tiles</label>


    <div class="pageTiles large-12">
        <input type="text" class="tileFilter" data-containment="pageTileList" placeholder="Enter text to filter tiles" />
        <ul class="tileList large-12" id="pageTileList">
            <?php

            foreach ($selectedRoutePageTiles as $selectedPageTile)
            {
                if ($selectedPageTile['tile_size'] == 'medium')
                {
                    $imagePath = '../img/locations/thumbnail-med/'.$selectedPageTile['image_thumb_med'];
                    $tileClass = 'large-6 columns left';
                }
                else
                {
                    $imagePath = '../img/locations/thumbnails/'.$selectedPageTile['image_thumb'];
                    $tileClass = 'large-3 columns left';
                }
                ?>
                <li data-route-tile-selected data-tile-id="<?=$selectedPageTile['tile_id']?>" data-route-id="<?=$route_id?>" class="<?=$tileClass?>" data-tags="<?=$selectedPageTile['tags']?>">
                    <div class="tile">
                        <div class="imgHolder">
                            <img src="<?=$imagePath?>" />
                        </div>
                        <div class="textholder">
                            <h5><?=$selectedPageTile['title']?></h5>
                        </div>
                    </div>
                </li>
            <?php
            }

            foreach ($allPageTiles as $pageTile)
            {
                $tileMatch = false;
                foreach ($selectedRoutePageTiles as $selectedPageTile)
                {
                    if ($pageTile['id'] == $selectedPageTile['tile_id'])
                    {
                        $tileMatch = true;
                        break;
                    }
                }
                if (!$tileMatch)
                {
                    if ($pageTile['tile_size'] == 'medium')
                    {
                        $imagePath = '../img/locations/thumbnail-med/'.$pageTile['image_thumb_med'];
                        $tileClass = 'large-6 columns left';
                    }
                    else
                    {
                        $imagePath = '../img/locations/thumbnails/'.$pageTile['image_thumb'];
                        $tileClass = 'large-3 columns left';
                    }
                    ?>
                    <li data-tile-id="<?=$pageTile['id']?>" data-route-id="<?=$route_id?>" class="<?=$tileClass?>" data-tags="<?=$pageTile['tags']?>">
                        <div class="tile">
                            <div class="imgHolder">
                                <img src="<?=$imagePath?>" />
                            </div>
                            <div class="textholder">
                                <h5><?=$pageTile['title']?></h5>
                            </div>
                        </div>
                    </li>
                <?php
                }
            }
            ?>
        </ul>
    </div>




    <label for="chkLive">Live:</label>
    <input type="checkbox" id="chkLive" name="chkLive" value="1"<?php echo ($route['is_live'] == 1?'checked="checked"':'')?> />

    <input type="submit" value="Submit" />
<?php
}
?>
</form>
</div>
</div>
</section>
<script>
    $(document).ready(function() {

        $('.tileFilter').keyup(function(e) {

            var containmentEl = $('#' + $(this).attr('data-containment'));
            var elValue = $(this).val();
            if (elValue.length === 0)
            {
                containmentEl.children('li').each(function(i){
                    $(this).attr('style','');
                });
            }
            else
            {
                containmentEl.children('li').each(function(i) {
                    var tagAttrStr = $(this).attr('data-tags');
                    if (tagAttrStr.indexOf(elValue) < 0)
                    {
                        $(this).attr('style','display: none');
                    }
                    else
                    {
                        $(this).attr('style','');
                    }
                });
            }
        });


        $('.mapTiles .tileList li').on('click', function(e) {
            e.preventDefault();
            var isSelected = $(this).attr('data-map-tile-selected');
            var action;
            var route_id = $(this).attr('data-route-id');
            var tile_id = $(this).attr('data-tile-id');
            if (typeof isSelected !== 'undefined' && isSelected !== false)
            {
                $(this).removeAttr('data-map-tile-selected');
                action = 'remove';
            }
            else
            {
                $(this).attr('data-map-tile-selected','');
                action = 'add';
            }

            $.ajax({
                type: 'POST',
                url: 'add-delete-route-map-tile.php',
                data: {action: action, route_id: route_id, tile_id: tile_id},
                success: function(data)
                {
                    var obj = JSON.parse(data);
                    //console.dir(obj);
                    //console.dir(data);
                }
            });
        });

        $('.pageTiles .tileList li').on('click', function(e) {
            e.preventDefault();
            var isSelected = $(this).attr('data-route-tile-selected');
            var action;
            var route_id = $(this).attr('data-route-id');
            var tile_id = $(this).attr('data-tile-id');
            var item_index = $(this).index() + 1; //add on to number as this will be our order
            if (typeof isSelected !== 'undefined' && isSelected !== false)
            {
                $(this).removeAttr('data-route-tile-selected');
                action = 'remove';
            }
            else
            {
                $(this).attr('data-route-tile-selected','');
                action = 'add';
            }

            $.ajax({
                type: 'POST',
                url: 'add-delete-route-page-tile.php',
                data: {action: action, route_id: route_id, tile_id: tile_id, order: item_index},
                success: function(data)
                {
                    var obj = JSON.parse(data);
                    //console.dir(obj);
                }
            });
        });

        $('.pageTiles .tileList').sortable({
            containment: 'parent',
            update: function (event, ui) {
                var isSelected = ui.item.context.dataset.hasOwnProperty('routeTileSelected');
                if (isSelected)
                {
                    //get all selected items and update database
                    $(this).children('li[data-route-tile-selected]').each(function(i){
                        console.log('index['+$(this).index()+']');
                        var route_id = $(this).attr('data-route-id');
                        var tile_id = $(this).attr('data-tile-id');
                        var item_index = $(this).index() + 1;
                        $.ajax({
                            type: 'POST',
                            url: 'update-route-page-tile-order.php',
                            data: {route_id: route_id, tile_id: tile_id, order: item_index},
                            success: function(data)
                            {
                                var obj = JSON.parse(data);
                                console.dir(obj);
                            } ,
                            error: function(data)
                            {
                                var obj = JSON.parse(data);
                                console.dir(obj);
                            }

                        });
                    });
                }
            }
        });
    });
</script>
</body>
</html>