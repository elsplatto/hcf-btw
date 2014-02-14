<?php
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin();


if (!empty($_POST))
{
    $title = $_POST['txtTitle'];
    $type_id = $_POST['selType'];
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
    $content = $_POST['txtContent'];
    $address_text = $_POST['txtAddressText'];
    if (!empty($_POST['chkLive']))
    {
        $is_live = $_POST['chkLive'];
    }
    else
    {
        $is_live = 0;
    }

    if (!empty($_POST['tileID']))
    {
        $tile_id = $_POST['tileID'];
        $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        $stmt = $mysqli->prepare('UPDATE tiles SET title = ?, type_id = ?, category_id = ?, tile_size = ?, lat = ?, lng = ?, image_thumb = ?, image_thumb_med = ?, image_med = ?, image_large = ?, alt = ?, directive_text = ?, intro_text = ?, trip_plan = ?, content = ?, address_text = ?, is_live = ? WHERE id = ?');
        $stmt->bind_param('siisddssssssssssii', $title, $type_id, $category_id, $tile_size, $lat, $lng, $image_thumb, $image_thumb_med, $image_med, $image_large, $alt, $directive_text, $intro_text, $trip_plan, $content, $address_text, $is_live, $tile_id);
    }
    else
    {
        $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        $stmt = $mysqli->prepare('INSERT INTO tiles (title, type_id, category_id, tile_size, lat, lng, image_thumb, image_thumb_med, image_med, image_large, alt, directive_text, intro_text, trip_plan, content, address_text, is_live) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $stmt->bind_param('siisddssssssssssi', $title, $type_id, $category_id, $tile_size, $lat, $lng, $image_thumb, $image_thumb_med, $image_med, $image_large, $alt, $directive_text, $intro_text, $trip_plan, $content, $address_text, $is_live);
        $tile_id = $mysqli->insert_id;
    }
    $stmt->execute();
    $stmt->close();
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
    echo '$is_live['.$is_live.']<br />';
    echo '$tile_id['.$tile_id.']<br />';
}

//header('Location: tiles-list.php');
?>