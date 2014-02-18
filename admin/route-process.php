<?php
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin();


if (!empty($_POST))
{
    $page_title = $_POST['txtPageTitle'];
    $nav_title = $_POST['txtNavTitle'];
    $friendly_url = $_POST['txtFriendlyURL'];
    $heading = $_POST['txtHeading'];
    $heading_pullout = $_POST['txtHeadingPullout'];
    $route_colour = $_POST['txtRouteColour'];
    $css_class = $_POST['txtCSSClass'];
    $header_image = $_POST['txtHeaderImage'];
    $info_bubble_width = $_POST['txtInfoBubbleWidth'];
    $info_bubble_height = $_POST['txtInfoBubbleHeight'];
    $header_mp4 = $_POST['txtHeaderMP4'];
    $header_webm = $_POST['txtHeaderWebm'];
    $tags = $_POST['txtTags'];
    $content_header = $_POST['txtContentHeader'];
    $content = $_POST['txtContent'];

    $meta_keywords = $_POST['txtMetaKeywords'];
    $meta_desc = $_POST['txtMetaDescription'];

    $nav_order = $_POST['txtNavOrder'];
    $is_live = $_POST['chkLive'];
    if (!empty($_POST['routeID']))
    {
        $route_id = $_POST['routeID'];
        $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        $stmt = $mysqli->prepare('UPDATE route SET page_title = ?, nav_title = ?, friendly_url = ?, heading = ?, heading_pullout = ?, route_colour = ?, css_class = ?, header_image = ?, info_bubble_width = ?, info_bubble_height = ?, header_mp4 = ?, header_webm = ?, tags = ?, content_header = ?, content = ?, meta_keywords = ?, meta_desc = ?, nav_order = ?, is_live = ? WHERE id = ?');
        $stmt->bind_param('ssssssssiisssssssiii', $page_title, $nav_title, $friendly_url, $heading, $heading_pullout, $route_colour, $css_class, $header_image, $info_bubble_width, $info_bubble_height, $header_mp4, $header_webm, $tags, $content_header, $mysqli->real_escape_string($content), $meta_keywords, $meta_desc, $nav_order, $is_live, $route_id);

    }
    else
    {
        $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        $stmt = $mysqli->prepare('INSERT INTO route (page_title, nav_title, friendly_url, heading, heading_pullout, route_colour, css_class, header_image, info_bubble_width, info_bubble_height, header_mp4, header_webm, tags, content_header, content, meta_keywords, meta_desc, nav_order, is_live) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $stmt->bind_param('ssssssssiisssssssii', $page_title, $nav_title, $friendly_url, $heading, $heading_pullout, $route_colour, $css_class, $header_image, $info_bubble_width, $info_bubble_height, $header_mp4, $header_webm, $tags, $content_header, $mysqli->real_escape_string($content), $meta_keywords, $meta_desc, $nav_order, $is_live);
        $route_id = $mysqli->insert_id;
    }
    $stmt->execute();
    $stmt->close();

    /*
    echo '$page_title['.$page_title.']<br />';
    echo '$nav_title['.$nav_title.']<br />';
    echo '$friendly_url['.$friendly_url.']<br />';
    echo '$heading['.$heading.']<br />';
    echo '$heading_pullout['.$heading_pullout.']<br />';
    echo '$route_colour['.$route_colour.']<br />';
    echo '$css_class['.$css_class.']<br />';
    echo '$header_image['.$header_image.']<br />';
    echo '$info_bubble_width['.$info_bubble_width.']<br />';
    echo '$info_bubble_height['.$info_bubble_height.']<br />';
    echo '$header_mp4['.$header_mp4.']<br />';
    echo '$header_webm['.$header_webm.']<br />';
    echo '$tags['.$tags.']<br />';
    echo '$content_header['.$content_header.']<br />';
    echo '$content['.$content.']<br />';
    echo '$nav_order['.$nav_order.']<br />';
    echo '$is_live['.$is_live.']<br />';
    */

}

header('Location: route-list.php');
?>