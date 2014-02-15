<?php
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin();

$page_id = $_GET['id'];

function getPage($id, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $query = 'SELECT title, is_nav, is_landing_page, has_map, nav_title, heading, heading_pullout, sub_heading, header_image, header_mp4, ';
    $query .= 'header_webm, tags, friendly_url, content_header, content, meta_keywords, meta_desc, parent_id, pages.order, is_live FROM pages WHERE id = ?';
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    //$results = $stmt->get_result();

    $stmt->bind_result($title, $is_nav, $is_landing_page, $has_map, $nav_title, $heading, $heading_pullout, $sub_heading, $header_image, $header_mp4, $header_webm, $tags, $friendly_url, $content_header, $content, $meta_keywords, $meta_desc, $parent_id, $order, $is_live);

    $results = array();
    $i = 0;
    while($stmt->fetch())
    {
        $results[$i]['title'] = $title;
        $results[$i]['is_nav'] = $is_nav;
        $results[$i]['is_landing_page'] = $is_landing_page;
        $results[$i]['has_map'] = $has_map;
        $results[$i]['nav_title'] = $nav_title;
        $results[$i]['heading'] = $heading;
        $results[$i]['heading_pullout'] = $heading_pullout;
        $results[$i]['sub_heading'] = $sub_heading;
        $results[$i]['header_image'] = $header_image;
        $results[$i]['header_mp4'] = $header_mp4;
        $results[$i]['header_webm'] = $header_webm;
        $results[$i]['tags'] = $tags;
        $results[$i]['friendly_url'] = $friendly_url;
        $results[$i]['content_header'] = $content_header;
        $results[$i]['content'] = $content;
        $results[$i]['meta_keywords'] = $meta_keywords;
        $results[$i]['meta_desc'] = $meta_desc;
        $results[$i]['parent_id'] = $parent_id;
        $results[$i]['order'] = $order;
        $results[$i]['is_live'] = $is_live;
        $i++;
    }


    $mysqli->close();
    return $results;
}

function getAllPages($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE) {
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT pages.id, pages.title FROM pages ORDER BY pages.order');

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
    return $results;
}

function getSelectedMapTiles($id,$DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT page_id, tile_id, map_tile.order, tiles.title FROM map_tile JOIN tiles ON tile_id = tiles.id WHERE page_id = ? ORDER BY map_tile.order');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($page_id, $tile_id, $order, $title);
    $results = array();
    $i = 0;
    while($stmt->fetch())
    {
        $results[$i]['page_id'] = $page_id;
        $results[$i]['tile_id'] = $tile_id;
        $results[$i]['order'] = $order;
        $results[$i]['title'] = $title;
        $i++;
    }
    return $results;
}

function getAllMapTiles($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT tiles.id, tiles.title, tiles.image_thumb FROM tiles WHERE tiles.is_live = 1 AND tiles.type_id = 1 AND tiles.image_thumb IS NOT NULL AND tiles.image_thumb != \'\'');
    $stmt->execute();
    $stmt->bind_result($id, $title, $image_thumb);
    $results = array();
    $i = 0;
    while($stmt->fetch())
    {
        $results[$i]['id'] = $id;
        $results[$i]['title'] = $title;
        $results[$i]['image_thumb'] = $image_thumb;
        $i++;
    }
    return $results;
}

function getAllTiles($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT tiles.id, tiles.title, tiles.image_thumb, tiles.image_thumb_med, tiles.tile_size  FROM tiles WHERE tiles.is_live = 1');
    $stmt->execute();
    $stmt->bind_result($id, $title, $image_thumb, $image_thumb_med, $tile_size);
    $results = array();
    $i = 0;
    while($stmt->fetch())
    {
        $results[$i]['id'] = $id;
        $results[$i]['title'] = $title;
        $results[$i]['image_thumb'] = $image_thumb;
        $results[$i]['image_thumb_med'] = $image_thumb_med;
        $results[$i]['tile_size'] = $tile_size;
        $i++;
    }
    return $results;
}

function getSelectedTiles($id,$DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT tiles.title, tiles.image_thumb, tiles.image_thumb_med, tiles.tile_size, tile_id, page_tile.order FROM (page_tile) JOIN tiles ON tiles.id = page_tile.tile_id WHERE page_id = ? ORDER BY page_tile.order');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($title, $image_thumb, $image_thumb_med, $tile_size, $tile_id, $order);
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
        $i++;
    }
    return $results;
}

$pages = getPage($page_id, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
$allPages = getAllPages($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
$allMapTiles = getAllMapTiles($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
$selectedMapTiles = getSelectedMapTiles($page_id ,$DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
$allPageTiles = getAllTiles($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
$selectedPageTiles = getSelectedTiles($page_id ,$DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
?>
<html>
<head>
    <title>Edit Page</title>
    <?php
    include 'includes/head.php';
    ?>
</head>
<body>

<section>
    <div class="row">
        <div class="large-12 columns">
            <a href="dashboard.php">Dashboard</a>
            <h1>Page - Edit</h1>
            <a href="page-list.php">< Back to Page List</a>
            -
            <a href="page-add.php">Add Page</a>
        </div>
    </div>
</section>

<section>
    <div class="row">
        <div class="large-12 columns">
        <form id="frmPage" name="frmPage" action="page-process.php" method="post">
            <?php
            foreach ($pages as $page)
            {
                ?>
                <input type="hidden" id="pageID" name="pageID" value="<?=$page_id?>" />
                <label for="txtTitle">Title:</label>
                <input type="text" id="txtTitle" name="txtTitle" value="<?=$page['title']?>" />

                <label for="txtFriendlyURL">Friendly URL:</label>
                <input type="text" id="txtFriendlyURL" name="txtFriendlyURL" value="<?=$page['friendly_url']?>" placeholder="Lower case and separated by '-'" />

                <label for="selParentID">Parent Page</label>
                <select id="selParentID" name="selParentID">
                    <option value="0">Select</option>
                    <?php
                    foreach ($allPages as $parentPage)
                    {
                        $strSelected = '';
                        if ($parentPage['id'] == $page['parent_id'])
                        {
                            $strSelected = ' selected="selected"';
                        }
                        if ($parentPage['id'] != $page_id)
                        {

                    ?>
                        <option value="<?=$parentPage['id']?>"<?=$strSelected?>><?=$parentPage['title']?></option>
                    <?php
                        }
                    }
                    ?>
                </select>

                <label for="chkNav">Show in Nav:</label>
                <input type="checkbox" id="chkNav" name="chkNav" value="1"<?php if ($page['is_nav'] == 1) { echo ' checked="checked"';}?> />


                <label for="chkLanding">Is Landing Page:</label>
                <input type="checkbox" id="chkLanding" name="chkLanding" value="1"<?php if ($page['is_landing_page'] == 1) { echo ' checked="checked"';}?> />

                <label for="txtNavTitle">Nav Title:</label>
                <input type="text" id="txtNavTitle" name="txtNavTitle" value="<?=$page['nav_title']?>" />

                <label for="txtHeading">Heading:</label>
                <input type="text" id="txtHeading" name="txtHeading" value="<?=$page['heading']?>" />

                <label for="txtHeadingPullout">Heading Pullout/Quote:</label>
                <input type="text" id="txtHeadingPullout" name="txtHeadingPullout" value="<?=$page['heading_pullout']?>" />

                <label for="txtSubHeading">Sub Heading:</label>
                <input type="text" id="txtSubHeading" name="txtSubHeading" value="<?=$page['sub_heading']?>" />

                <label for="txtHeaderImage">Header Image:</label>
                <input type="text" id="txtHeaderImage" name="txtHeaderImage" value="<?=$page['header_image']?>" />

                <label for="txtHeaderMP4">Header mp4:</label>
                <input type="text" id="txtHeaderMP4" name="txtHeaderMP4" value="<?=$page['header_mp4']?>" />

                <label for="txtHeaderWebm">Header webm:</label>
                <input type="text" id="txtHeaderWebm" name="txtHeaderWebm" value="<?=$page['header_webm']?>" />

                <label for="txtTags">Tags:</label>
                <input type="text" id="txtTags" name="txtTags" value="<?=$page['tags']?>" placeholder="No # and separate by comma" />



                <label for="txtContentHeader">Content Heading:</label>
                <input type="text" d="txtContentHeader" name="txtContentHeader" value="<?=$page['content_header']?>" placeholder="Appears above the content" />

                <label for="txtContent">Content:</label>
                <textarea id="txtContent" name="txtContent" cols="100" rows="5"><?=$page['content']?></textarea>

                <label for="txtMetaKeywords">Meta Keywords:</label>
                <input type="text" id="txtMetaKeywords" name="txtMetaKeywords" value="<?=$page['meta_keywords']?>" placeholder="No # and separate by comma" />

                <label for="txtMetaDescription">Meta Description:</label>
                <input type="text" id="txtMetaDescription" name="txtMetaDescription" value="<?=$page['meta_desc']?>" />

                <label for="txtOrder">Order:</label>
                <input type="text" id="txtOrder" name="txtOrder" value="<?=$page['order']?>" />

                <label for="chkHasMap">Has Map:</label>
                <input type="checkbox" id="chkHasMap" name="chkHasMap" value="1"<?php echo ($page['has_map']==1?'checked="checked"':'')?> />

                <label>Map Tiles</label>
                <div class="mapTiles">
                    <ul class="tileList">
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
                        <li<?=$strSelected?> data-tile-id="<?=$mapTile['id']?>" data-page-id="<?=$page_id?>" class="large-3 columns left">
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
                    <ul class="tileList large-12">
                        <?php

                            foreach ($selectedPageTiles as $selectedPageTile)
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
                                <li data-page-tile-selected data-tile-id="<?=$selectedPageTile['tile_id']?>" data-page-id="<?=$page_id?>" class="<?=$tileClass?>">
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
                                foreach ($selectedPageTiles as $selectedPageTile)
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
                                    <li data-tile-id="<?=$pageTile['id']?>" data-page-id="<?=$page_id?>" class="<?=$tileClass?>">
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
                <input type="checkbox" id="chkLive" name="chkLive" value="1"<?php echo ($page['is_live'] == 1?'checked="checked"':'')?> />

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
    $('.mapTiles .tileList li').on('click', function(e) {
        e.preventDefault();
        var isSelected = $(this).attr('data-map-tile-selected');
        var action;
        var page_id = $(this).attr('data-page-id');
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
            url: 'add-delete-map-tile.php',
            data: {action: action, page_id: page_id, tile_id: tile_id},
            success: function(data)
            {
                var obj = JSON.parse(data);
                console.dir(obj);
            }
        });
    });

    $('.pageTiles .tileList li').on('click', function(e) {
        e.preventDefault();
        var isSelected = $(this).attr('data-page-tile-selected');
        var action;
        var page_id = $(this).attr('data-page-id');
        var tile_id = $(this).attr('data-tile-id');
        var item_index = $(this).index() + 1; //add on to number as this will be our order
        if (typeof isSelected !== 'undefined' && isSelected !== false)
        {
            $(this).removeAttr('data-page-tile-selected');
            action = 'remove';
        }
        else
        {
            $(this).attr('data-page-tile-selected','');
            action = 'add';
        }

        console.log('action['+action+']page_id['+page_id+']tile_id['+tile_id+']item_index['+item_index+']');
        $.ajax({
            type: 'POST',
            url: 'add-delete-page-tile.php',
            data: {action: action, page_id: page_id, tile_id: tile_id, order: item_index},
            success: function(data)
            {
                var obj = JSON.parse(data);
                //console.dir(obj);
            }
        });
    });

    $('.pageTiles .tileList').sortable({
        update: function (event, ui) {
            //console.dir(event);
            //console.dir(ui);
            var isSelected = ui.item.context.dataset.hasOwnProperty('pageTileSelected');
            if (isSelected)
            {
                //get all selected items and update database
                $(this).children('li[data-page-tile-selected]').each(function(i){
                    console.log('index['+$(this).index()+']');
                    var page_id = $(this).attr('data-page-id');
                    var tile_id = $(this).attr('data-tile-id');
                    var item_index = $(this).index() + 1;
                    $.ajax({
                        type: 'POST',
                        url: 'update-page-tile-order.php',
                        data: {page_id: page_id, tile_id: tile_id, order: item_index},
                        success: function(data)
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