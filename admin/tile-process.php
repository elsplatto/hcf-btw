<?php
include 'includes/admin-settings.php';
include 'includes/global-admin-functions.php';
include '../includes/db.php';
include 'includes/class.upload.php';
assessLogin($securityArrAuthor);


if (!empty($_POST))
{
    $title = $_POST['txtTitle'];
    $type_id = $_POST['selType'];
    $start_date = strtotime($_POST['dateStartDate']);
    $end_date = strtotime($_POST['dateEndDate']);
    $cost = $_POST['cost'];
    $category_id = $_POST['selCategory'];
    $tile_size = $_POST['selTileSize'];
    $lat = $_POST['txtLat'];
    $lng = $_POST['txtLng'];
    $image_thumb = $_POST['txtImgThumb'];
    $image_thumb_med = $_POST['txtImgThumbMed'];
    $image_med = $_POST['txtImgMed'];
    $image_large = $_POST['txtImgLarge'];
    $alt = $_POST['txtAlt'];
    $directive_text = $_POST['txtDirectiveText'];
    $trip_plan = $_POST['txtTripPlan'];
    $intro_text = $_POST['txtIntroText'];
    $content =$_POST['txtContent'];
    $address_text = $_POST['txtAddressText'];
    $tags = $_POST['txtTags'];
    if (!empty($_POST['chkLive']))
    {
        $is_live = $_POST['chkLive'];
    }
    else
    {
        $is_live = 0;
    }


    if (isset($_FILES['thumbImgUpload']))
    {
        // ---------- IMAGE UPLOAD ----------

        // we create an instance of the class, giving as argument the PHP object
        // corresponding to the file field from the form
        // All the uploads are accessible from the PHP object $_FILES
        $thmbImg = new Upload($_FILES['thumbImgUpload']);


        //Get directory
        $thmbDir = '../img/locations/thumbnails/';
        if (isset($_POST['thmbDir']))
        {
            $thmbDir = $_POST['thmbDir'];
        }

        if ($thmbImg->uploaded)
        {
            // uploaded - process and save to correct directory
            $thmbImg->image_resize = true;
            $thmbImg->image_ratio_y = false;
            $thmbImg->image_x = 260;
            $thmbImg->image_y = 180;
            $thmbImg->Process($thmbDir);
            $image_thumb = $thmbImg->file_dst_name;
        }
    }

    if (isset($_FILES['mediumThumbImgUpload']))
    {
        $mediumThmbImg = new Upload($_FILES['mediumThumbImgUpload']);

        $mediumThmbDir = '../img/locations/thumbnail-med/';
        if (isset($_POST['mediumThmbDir']))
        {
            $mediumThmbDir = $_POST['mediumThmbDir'];
        }

        if ($mediumThmbImg->uploaded)
        {
            $mediumThmbImg->image_resize = true;
            $mediumThmbImg->image_ratio_y = false;
            $mediumThmbImg->image_x = 560;
            $mediumThmbImg->image_y = 180;
            $mediumThmbImg->Process($mediumThmbDir);
            $image_thumb_med = $mediumThmbImg->file_dst_name;
        }

    }

    if (isset($_FILES['mediumImgUpload']))
    {
        $mediumImg = new Upload($_FILES['mediumImgUpload']);

        $mediumDir = '../img/locations/medium/';
        if (isset($_POST['mediumDir']))
        {
            $mediumDir = $_POST['mediumDir'];
        }

        if ($mediumImg->uploaded)
        {
            $mediumImg->image_resize = true;
            $mediumImg->image_ratio_y = false;
            $mediumImg->image_x = 720;
            $mediumImg->image_y = 422;
            $mediumImg->Process($mediumDir);
            $image_med = $mediumImg->file_dst_name;
        }

    }

    if (isset($_FILES['largeImgUpload']))
    {
        $largeImg = new Upload($_FILES['largeImgUpload']);

        $largeDir = '../img/locations/large/';
        if (isset($_POST['largeDir']))
        {
            $largeDir = $_POST['largeDir'];
        }

        if ($largeImg->uploaded)
        {
            $largeImg->image_resize = true;
            $largeImg->image_ratio_y = false;
            $largeImg->image_x = 860;
            $largeImg->image_y = 560;
            $largeImg->Process($largeDir);
            $image_large = $largeImg->file_dst_name;
        }

    }


    if (!empty($_POST['tileID']))
    {
        $tile_id = $_POST['tileID'];
        $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        $stmt = $mysqli->prepare('UPDATE tiles SET title = ?, type_id = ?, category_id = ?, tile_size = ?, lat = ?, lng = ?, image_thumb = ?, image_thumb_med = ?, image_med = ?, image_large = ?, alt = ?, directive_text = ?, intro_text = ?, trip_plan = ?, content = ?, address_text = ?, tags = ?, start_date = ?, end_date = ?, cost = ?, is_live = ? WHERE id = ?');
        $stmt->bind_param('siisddsssssssssssiidii', $title, $type_id, $category_id, $tile_size, $lat, $lng, $image_thumb, $image_thumb_med, $image_med, $image_large, $alt, $directive_text, $mysqli->real_escape_string($intro_text), $mysqli->real_escape_string($trip_plan), $mysqli->real_escape_string($content), $mysqli->real_escape_string($address_text), $tags, $start_date, $end_date, $cost, $is_live, $tile_id);
    }
    else
    {
        $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        $stmt = $mysqli->prepare('INSERT INTO tiles (title, type_id, category_id, tile_size, lat, lng, image_thumb, image_thumb_med, image_med, image_large, alt, directive_text, intro_text, trip_plan, content, address_text, tags, start_date, end_date, cost, is_live) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $stmt->bind_param('siisddsssssssssssiidi', $title, $type_id, $category_id, $tile_size, $lat, $lng, $image_thumb, $image_thumb_med, $image_med, $image_large, $alt, $directive_text, $mysqli->real_escape_string($intro_text), $mysqli->real_escape_string($trip_plan), $mysqli->real_escape_string($content), $mysqli->real_escape_string($address_text), $tags, $start_date, $end_date, $cost, $is_live);
        $tile_id = $mysqli->insert_id;
    }
    $stmt->execute();

    $stmt->close();
    $mysqli->close();

    /*
    echo '$title['.$title.']<br />';
    echo '$type_id['.$type_id.']<br />';
    echo '$category_id['.$category_id.']<br />';
    echo '$lat['.$lat.']<br />';
    echo '$lng['.$lng.']<br />';
    echo '$image_thumb['.$image_thumb.']<br />';
    echo '$image_thumb_med['.$image_thumb_med.']<br />';
    echo '$image_med['.$image_med.']<br />';
    echo '$image_large['.$image_large.']<br />';
    echo '$alt['.$alt.']<br />';
    echo '$directive_text['.$directive_text.']<br />';
    echo '$trip_plan['.$trip_plan.']<br />';
    echo '$intro_text['.$intro_text.']<br />';
    echo '$content['.$content.']<br />';
    echo '$address_text['.$address_text.']<br />';
    echo '$start_date['.$start_date.']<br />';
    echo '$end_date['.$end_date.']<br />';
    echo '$cost['.$cost.']<br />';
    echo '$is_live['.$is_live.']<br />';
    echo '$tile_id['.$tile_id.']<br />';
    */
}

header('Location: tiles-list.php');
?>