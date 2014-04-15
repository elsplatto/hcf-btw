<?php
include 'includes/admin-settings.php';
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin($securityArrAuthor);

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

    $stmt->close();
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

    $stmt->close();
    $mysqli->close();;
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

    $stmt->close();
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

<?php
include 'includes/header.php';
?>

<section>
    <div class="row">
        <div class="large-12 columns">
            <a href="dashboard.php">Home</a>
            <h1>Tile - <?=$tile['title']?></h1>
            <a href="tiles-list.php">< Back to Tile List</a>
        </div>
    </div>
</section>

<section>
    <form enctype="multipart/form-data" id="frmTile" name="frmTile" action="tile-process.php" method="post">
    <div class="row">
        <div class="large-12 columns">

                <input type="hidden" id="tileID" name="tileID" value="<?=$tile_id?>" />
                <label for="txtTitle">Title:
                    <input type="text" id="txtTitle" name="txtTitle" value="<?=$tile['title']?>" />
                </label>

                <label for="selType">Type:
                <?php
                if ($typesCount > 0)
                {
                $typeSelectedTitle = '';
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
                                $typeSelectedTitle = $type['title'];
                            }

                        ?>
                            <option value="<?=$type['id']?>"<?=$typeSelected?>><?=$type['title']?></option>
                        <?php
                        }
                        ?>
                    </select>
                </label>
                <?php
                }
                ?>
                <div id="eventArea" class="<?php echo (strtolower($typeSelectedTitle) != 'events' ? 'hide':'')?>">
                    <label for="dateStartDate">Start Date:
                        <input type="text" id="dateStartDate" name="dateStartDate" class="dateTimePickerInput" value="<?echo $tile['start_date'] > 0 ? date('d-F-Y H:i',$tile['start_date']): ''?>" />
                    </label>

                    <label for="endStartDate">End Date:
                        <input type="text" id="dateEndDate" name="dateEndDate" class="dateTimePickerInput" value="<?echo $tile['end_date'] > 0 ? date('d-F-Y H:i',$tile['end_date']): ''?>" />
                    </label>

                    <label for="cost">Cost:
                        <input type="text" id="cost" name="cost" placeholder="00.00" value="<?=sprintf("%0.2f",round($tile['cost'],2))?>" />
                    </label>
                </div>


                <label for="selCategory">Category:
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
                </label>

                <label for="selTileSize">Size:
                    <select id="selTileSize" name="selTileSize">
                        <option value="">Select</option>
                        <option value="small"<?php echo ($tile['tile_size'] == 'small'?' selected="selected"':'')?>>Small</option>
                        <option value="medium"<?php echo ($tile['tile_size'] == 'medium'?' selected="selected"':'')?>>Medium</option>
                    </select>
                </label>


            <label<?= ($tile['tile_size'] == 'medium'?' class="hide"':'') ?> id="smallImg" for="txtImgThumb">Thumbnail:
                <input type="text" id="txtImgThumb" name="txtImgThumb" value="<?=$tile['image_thumb']?>" readonly />
                <input type="file" id="thumbImgUpload" name="thumbImgUpload" />
                <inpu type="hidden" name="thmbDir" id="thmbDir" value="../img/locations/thumbnails/" />
            </label>



            <label<?= ($tile['tile_size'] == 'small'?' class="hide"':'') ?> id="medImg" for="txtImgThumbMed">Thumbnail - Med:
                <input type="text" id="txtImgThumbMed" name="txtImgThumbMed" value="<?=$tile['image_thumb_med']?>" readonly />
                <input type="file" id="mediumThumbImgUpload" name="mediumThumbImgUpload" />
                <inpu type="hidden" name="mediumThmbDir" id="mediumThmbDir" value="../img/locations/thumbnail-med/" />
            </label>



            <label for="txtImgMed">Medium:
                <input type="text" id="txtImgMed" name="txtImgMed" value="<?=$tile['image_med']?>" readonly />
                <input type="file" id="mediumImgUpload" name="mediumImgUpload" />
                <inpu type="hidden" name="mediumDir" id="mediumDir" value="../img/locations/medium/" />
            </label>

            <label for="txtImgLarge">Large:
                <input type="text" id="txtImgLarge" name="txtImgLarge" value="<?=$tile['image_large']?>" readonly />
                <input type="file" id="largeImgUpload" name="largeImgUpload" />
                <inpu type="hidden" name="largeDir" id="largeDir" value="../img/locations/large/" />
            </label>

            <label for="txtAlt">Alt:
                <input type="text" id="txtAlt" name="txtAlt" value="<?=$tile['alt']?>" />
            </label>

            <label for="txtDirectiveText">Directive Text:
                <input type="text" id="txtDirectiveText" name="txtDirectiveText" value="<?=stripcslashes($tile['directive_text'])?>" placeholder="e.g. Read more"/>
            </label>


            <a href="#" class="showHide" data-target="#mapArea" data-hideText="Hide Map" data-showText="Show Map">Show Map</a>
            <div id="mapArea" class="hide">

                <label for="txtLat">Lat:
                    <input type="text" id="txtLat" name="txtLat" value="<?=$tile['lat']?>" />
                </label>


                <label for="txtLng">Lng:
                    <input type="text" id="txtLng" name="txtLng" value="<?=$tile['lng']?>" />
                </label>

                <div id="tile-map-canvas" class="google-maps" style="width: 800px; height: 500px;"></div>
            </div>


                <label for="txtTripPlan">Trip Plan:</label>
                <textarea id="txtTripPlan" name="txtTripPlan" cols="100" rows="5"><?=stripcslashes(stripcslashes($tile['trip_plan']))?></textarea>

                <label for="txtIntroText">Intro Text:</label>
                <textarea id="txtIntroText" name="txtIntroText" cols="100" rows="5"><?=stripcslashes(stripcslashes($tile['intro_text']))?></textarea>

                <label for="txtContent">Content:</label>
                <textarea id="txtContent" name="txtContent" cols="100" rows="5"><?=stripcslashes(stripcslashes($tile['content']))?></textarea>

                <label for="txtAddressText">Address Text:</label>
                <a href="#" class="insertTag" data-tag="address" data-target="txtAddressText">Insert Address HTML Template</a>
                <textarea id="txtAddressText" name="txtAddressText" cols="100" rows="5"><?=stripcslashes(stripcslashes($tile['address_text']))?></textarea>

                <label for="txtTags">Tags:
                    <input type="text" id="txtTags" name="txtTags" value="<?=$tile['tags']?>" placeholder="No # - separate by comma."/>
                </label>

                <label for="chkLive">Live:
                    <input type="checkbox" id="chkLive" name="chkLive" value="1"<?php echo ($tile['is_live'] == 1?' checked="checked"':'')?> />
                </label>

            <input type="submit" value="Submit" class="button" />&nbsp;<a href="tiles-list.php"class="cancel">Cancel</a>
            </div>
        </div>
    </form>
</section>

    <div id="converterArea"></div>
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

    $(function() {

        $('#selType').change(function(e) {
            if ($(this).find(':selected').text().toLowerCase() === 'events')
            {
                if ($('#eventArea').is(':hidden'))
                {
                    $('#eventArea').show();
                }
            }
            else
            {
                if (!$('#eventArea').is(':hidden'))
                {
                    $('#eventArea').hide();
                }
            }
        });

        $('#selTileSize').change(function(e) {

            if($(this).find(':selected').val().toLowerCase() === 'medium')
            {
                $('#medImg').show();
                $('#smallImg').hide();

            }
            else if ($(this).find(':selected').val().toLowerCase() === 'small')
            {
                $('#smallImg').show();
                $('#medImg').hide();
            }
        })


        $('.insertTag').click(function(e) {
            e.preventDefault();
            var target = $('#' + $(this).attr('data-target'));
            var tag = $(this).attr('data-tag');
            var tagHTML = '';
            switch(tag){
                case 'address':
                    tagHTML = '<p>\n';
                    tagHTML += '<strong>Address:<\/strong><br \/>\nAddress 1\n<br \/>\nCity/Suburb\n<br \/>\nNSW ####\n<br \/>';
                    tagHTML += '<strong>Phone:<\/strong>+61 (02) #### ####\n<br \/>\n';
                    tagHTML += '<strong>Website:<\/strong> <a href="http:\/\/www" target="_blank" rel="nofollow">www<\/a>\n<\/p>';
                    break;

            }

            target.val(target.val() + tagHTML);
        });

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

<?php
include 'includes/global-admin-js.php';
?>
</body>
</html>