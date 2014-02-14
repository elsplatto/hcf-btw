<?php
header('Content-type:application/json');
include '../includes/db.php';

$locationId = $_GET['id'];

if (isset($locationId))
{
    $query = 'SELECT tiles.title, tiles.image_med, tiles.alt, tiles.sub_heading, tiles.intro_text, ';
    $query .= 'tiles.lat, tiles.lng, tiles.trip_plan, tiles.address_text, ';
    $query .= 'categories.title AS category_title, types.title AS type_title, categories.map_icon FROM tiles ';
    $query .= 'JOIN types ON tiles.type_id = types.id ';
    $query .= 'LEFT OUTER JOIN categories ON tiles.category_id = categories.id ';
    $query .= 'WHERE tiles.id = ?';

    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $locationId);

    $stmt->execute();

    $numRows = count($stmt->bind_result($title, $image_med, $alt, $sub_heading, $intro_text, $lat, $lng, $trip_plan, $address_text, $category_title, $type_title, $map_icon));

    $json = array();
    if ($numRows > 0)
    {
        //echo 'trip plan['.$trip_plan.']';
        while ($stmt->fetch()) {
            $json['title'] = $title;
            $json['image_med'] = $image_med;
            $json['alt'] = $alt;
            $json['sub_heading'] = $sub_heading;
            $json['intro_text'] = $intro_text;
            $json['lat'] = $lat;
            $json['lng'] = $lng;
            $json['trip_plan'] = $trip_plan;
            $json['address_text'] = $address_text;
            $json['category_title'] = $category_title;
            $json['type_title'] = $type_title;
            $json['map_icon'] = $map_icon;
        }
    }
    else
    {
        $errorArr = array("error" => "No rows returned", "error_display_msg" => "There has been a problem retrieving content.");
        $json[] = $errorArr;
    }
    $jsonData = json_encode($json);
    echo $jsonData;
    $mysqli->close();
}

?>


