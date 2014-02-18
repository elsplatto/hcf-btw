<?php
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin();


if (!empty($_POST))
{
    $title = $_POST['txtTitle'];
    if (!empty($_POST['chkNav']))
    {
        $is_nav = intval('0' . $_POST['chkNav']);
    }
    else
    {
        $is_nav = 0;
    }

    if (!empty($_POST['chkLanding']))
    {
        $is_landing_page = intval('0' . $_POST['chkLanding']);
    }
    else
    {
        $is_landing_page = 0;
    }
    if (!empty($_POST['chkHasMap']))
    {
        $has_map = intval('0' . $_POST['chkHasMap']);
    }
    else
    {
        $has_map = 0;
    }
    $nav_title = $_POST['txtNavTitle'];
    $heading = $_POST['txtHeading'];
    $heading_pullout = $_POST['txtHeadingPullout'];
    $sub_heading = $_POST['txtSubHeading'];
    $header_image = $_POST['txtHeaderImage'];
    $header_mp4 = $_POST['txtHeaderMP4'];
    $header_webm = $_POST['txtHeaderWebm'];
    $tags = $_POST['txtTags'];
    $content_header = $_POST['txtContentHeader'];
    $content = $_POST['txtContent'];

    $order = $_POST['txtOrder'];
    $parent_id = $_POST['selParentID'];
    $friendly_url = $_POST['txtFriendlyURL'];
    $is_live = $_POST['chkLive'];
    if (!empty($_POST['pageID']))
    {
        $page_id = $_POST['pageID'];
        $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        $stmt = $mysqli->prepare('UPDATE pages SET title = ?, is_nav = ?, is_landing_page = ?, has_map = ?, nav_title = ?, heading = ?, heading_pullout = ?, sub_heading = ?, header_image = ?, header_mp4 = ?, header_webm = ?, tags = ?, content_header = ?, content = ?, pages.order = ?, parent_id = ?, friendly_url = ?, is_live = ? WHERE id = ?');
        $stmt->bind_param('siiissssssssssiisii', $title, $is_nav, $is_landing_page, $has_map, $nav_title, $heading, $heading_pullout, $sub_heading, $header_image, $header_mp4, $header_webm, $tags, $content_header, $mysqli->real_escape_string($content), $order, $parent_id, $friendly_url, $is_live, $page_id);

    }
    else
    {
        $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        $stmt = $mysqli->prepare('INSERT INTO pages (title, is_nav, is_landing_page, has_map, nav_title, heading, heading_pullout, sub_heading, header_image, header_mp4, header_webm, tags, content_header, content, pages.order, parent_id, friendly_url, is_live) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $stmt->bind_param('siiissssssssssiisi', $title, $is_nav, $is_landing_page, $has_map, $nav_title, $heading, $heading_pullout, $sub_heading, $header_image, $header_mp4, $header_webm, $tags, $content_header, $mysqli->real_escape_string($content), $order, $parent_id, $friendly_url, $is_live);
        $page_id = $mysqli->insert_id;
    }
    $stmt->execute();
    $stmt->close();
    /*
    echo '$title['.$title.']<br />';
    echo '$is_nav['.$is_nav.']<br />';
    echo '$nav_title['.$nav_title.']<br />';
    echo '$heading['.$heading.']<br />';
    echo '$heading_pullout['.$heading_pullout.']<br />';
    echo '$sub_heading['.$sub_heading.']<br />';
    echo '$header_image['.$header_image.']<br />';
    echo '$header_mp4['.$header_mp4.']<br />';
    echo '$header_webm['.$header_webm.']<br />';
    echo '$tags['.$tags.']<br />';
    echo '$content['.$content.']<br />';
    echo '$order['.$order.']<br />';
    echo '$parent_id['.$parent_id.']<br />';
    echo '$friendly_url['.$friendly_url.']<br />';
    echo '$is_live['.$is_live.']<br />';
    echo '$page_id['.$page_id.']<br />';
    */
}

header('Location: page-list.php');
?>