<?php
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin();

$mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
$stmt = $mysqli->prepare('SELECT id, nav_title, css_class, route_colour, friendly_url, info_bubble_width, info_bubble_height from route WHERE is_live = 1 ORDER BY nav_order');

$stmt->execute();

//$result = $stmt->get_result();
$stmt->bind_result($id, $nav_title, $css_class, $route_colour, $friendly_url, $info_bubble_width, $info_bubble_height);

$first = true;
$innerLoopFirst = true;

$json = '';

$results = array();
$i = 0;
while($stmt->fetch())
{
    $results[$i]['id'] = $id;
    $results[$i]['nav_title'] = $nav_title;
    $results[$i]['css_class'] = $css_class;
    $results[$i]['route_colour'] = $route_colour;
    $results[$i]['friendly_url'] = $friendly_url;
    $results[$i]['info_bubble_width'] = $info_bubble_width;
    $results[$i]['info_bubble_height'] = $info_bubble_height;
    $i++;
}

$stmt->close();

$numRows =  count($results);

if ($numRows > 0)
{

    $json .= '{"routes": [';

    foreach ($results as $row)
    {
        if($first) {
            $first = false;
        } else {
            $json .= ',';
        }

        $json .= '{';
        $rowID = $row["id"];

        $json .= '"id": ' .$rowID . ',';
        $json .= '"title": "' .$row["nav_title"]. '",';
        $json .= '"class": "' . $row['css_class'] . '",';
        $json .= '"colour": "' . $row['route_colour'] . '",';
        $json .= '"info_bubble_width": ' . $row['info_bubble_width'] . ',';
        $json .= '"info_bubble_height": ' . $row['info_bubble_height'] . ',';
        $json .= '"url": "' . $row['friendly_url'] . '"';

        $innerStmt = $mysqli->prepare('SELECT lat, lng, is_waypoint, is_destination, label, is_sub_route  from route_geo WHERE route_id = ? ORDER BY route_geo.order');
        $innerStmt->bind_param('i', $rowID);
        $innerStmt->execute();

        $innerStmt->bind_result($lat, $lng, $is_waypoint, $is_destination, $label, $is_sub_route);

        //$innerResult = $innerStmt->get_result();
        $innerResult = array();

        $i = 0;
        while ($innerStmt->fetch())
        {
            $innerResult[$i]['lat'] = $lat;
            $innerResult[$i]['lng'] = $lng;
            $innerResult[$i]['is_waypoint'] = $is_waypoint;
            $innerResult[$i]['is_destination'] = $is_destination;
            $innerResult[$i]['label'] = $label;
            $innerResult[$i]['is_sub_route'] = $is_sub_route;
            $i++;
        }

        $innerNumRows = count($innerResult);
        $innerJson = array();
        $innerCount = 0;
        if ($numRows > 0)
        {
            $json .= ',"coords": [';
            foreach ($innerResult as $innerRow)
            {
                $json .= json_encode($innerRow);
                $innerCount++;
                /*if($innerLoopFirst) {
                    $innerLoopFirst = false;
                } else {
                    $json .= ',';
                }*/
                if ($innerCount < $innerNumRows)
                {
                    $json .= ',';
                }
            }
            $json .= ']}';
        }
    }

    $json .= ']}';
}
else
{
    $errorArr = array("error" => "No rows returned", "error_display_msg" => "There has been a problem retrieving content.");
    $json[] = $errorArr;
}
//$jsonData = json_encode($json);
//echo $jsonData;
//echo json_encode($json);
echo $json;
$mysqli->close();

$file = fopen("../json/routeCoords.json","w");
fwrite($file, $json);
fclose($file);
?>