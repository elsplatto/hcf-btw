<?php
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin();



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

    $mysqli->close();
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

    $mysqli->close();
    return $results;
}


$types = getTypes($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

$categories = getCategories($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

$typesCount = count($types);
$categoriesCount = count($categories);
?>
<html>
<head>
    <title>Add Tile</title>
    <?php
    include 'includes/head.php';
    ?>
</head>
<body>
<section>
    <div class="row">
        <div class="large-12 columns">
            <a href="dashboard.php">Dashboard</a>
            <h1>Tiles</h1>
            <a href="tiles-list.php">< Back to Tile List</a>

        </div>
    </div>
</section>

<section>
    <form id="frmTile" name="frmTile" action="tile-process.php" method="post">
    <div class="row">
        <div class="large-12 columns">

            <input type="hidden" id="tileID" name="tileID" value="" />
            <label for="txtTitle">Title:</label>
            <input type="text" id="txtTitle" name="txtTitle" value="" />

            <label for="selType">Type:</label>
            <?php
            if ($typesCount > 0)
            {
                ?>
                <select id="selType" name="selType">
                    <option value="0">Select</option>
                    <?php
                    foreach ($types as $type)
                    {
                                              ?>
                        <option value="<?=$type['id']?>"><?=$type['title']?></option>
                    <?php
                    }
                    ?>
                </select>
            <?php
            }
            ?>



            <label for="dateStartDate">Start Date:</label>
            <input type="text" id="dateStartDate" name="dateStartDate" class="dateTimePickerInput" />

            <label for="endStartDate">End Date:</label>
            <input type="text" id="dateEndDate" name="dateEndDate" class="dateTimePickerInput" />

            <label for="cost">Cost:</label>
            <input type="text" id="cost" name="cost" placeholder="00.00" />


            <label for="selCategory">Category:</label>
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



                        ?>
                        <option value="<?=$category['id']?>"><?=$category['title']?></option>
                        <?php
                        $lastTypeID = $category['type_id'];
                        $categoryCounter++;
                        }
                        ?>
                </select>
            <?php
            }
            ?>

            <label for="selTileSize">Size:</label>
            <select id="selTileSize" name="selTileSize">
                <option value="">Select</option>
                <option value="small">Small</option>
                <option value="medium">Medium</option>
            </select>
        </div>
        <div class="large-5 columns left">
            <label for="txtLat">Lat:</label>
            <input type="text" id="txtLat" name="txtLat" value="" />


            <label for="txtLng">Lng:</label>
            <input type="text" id="txtLng" name="txtLng" value="" />

            <label for="txtImgThumb">Thumbnail:</label>
            <input type="text" id="txtImgThumb" name="txtImgThumb" value="" />

            <label for="txtImgThumbMed">Thumbnail - Med:</label>
            <input type="text" id="txtImgThumbMed" name="txtImgThumbMed" value="" />

            <label for="txtImgMed">Medium:</label>
            <input type="text" id="txtImgMed" name="txtImgMed" value="" />

            <label for="txtImgLarge">Large:</label>
            <input type="text" id="txtImgLarge" name="txtImgLarge" value="" />

            <label for="txtAlt">Alt:</label>
            <input type="text" id="txtAlt" name="txtAlt" value="" />

            <label for="txtDirectiveText">Directive Text:</label>
            <input type="text" id="txtDirectiveText" name="txtDirectiveText"  placeholder="e.g. Read more"/>


        </div>

        <div class="large-7 columns left">
            <a href="#" class="useMap" data-target="tile-map-canvas">Hide Map</a>
            <div id="tile-map-canvas" class="google-maps" style="width: 800px; height: 500px;"></div>
        </div>

        <div class="large-12 columns">



            <label for="txtTripPlan">Trip Plan:</label>
            <textarea id="txtTripPlan" name="txtTripPlan" cols="100" rows="5"></textarea>

            <label for="txtIntroText">Intro Text:</label>
            <textarea id="txtIntroText" name="txtIntroText" cols="100" rows="5"></textarea>

            <label for="txtContent">Content:</label>
            <textarea id="txtContent" name="txtContent" cols="100" rows="5"></textarea>

            <label for="txtAddressText">Address Text:</label>
            <a href="#" class="insertTag" data-tag="address" data-target="txtAddressText">Insert Address HTML Template</a>
            <textarea id="txtAddressText" name="txtAddressText" cols="100" rows="5"></textarea>

            <label for="txtTags">Tags:</label>
            <input type="text" id="txtTags" name="txtTags" value="" placeholder="No # - separate by comma."/>

            <label for="chkLive">Live:</label>
            <input type="checkbox" id="chkLive" name="chkLive" value="1" />

            <input type="submit" value="Submit" />
        </div>
    </div>
 </form>
</section>
<script>
    initialize();
    var map;
    function initialize() {
        var myLatlng = new google.maps.LatLng(-33.836311,151.208267);

        var myOptions = {
            zoom: 12,
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



    $(function(){

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

</body>
</html>