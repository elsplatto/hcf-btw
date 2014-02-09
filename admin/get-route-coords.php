<?php
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin();

$mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
$stmt = $mysqli->prepare('SELECT id, nav_title, css_class, route_colour, friendly_url, info_bubble_width, info_bubble_height from route WHERE is_live = 1 ORDER BY nav_order');

$stmt->execute();

$result = $stmt->get_result();
$numRows =  mysqli_num_rows($result);

$first = true;
$innerLoopFirst = true;

$json = '';



if ($numRows > 0)
{

    $json .= '{"routes": [';

    while ($row = $result->fetch_assoc())
    {
        if($first) {
            $first = false;
        } else {
            $json .= ',';
        }
        //$json .= json_encode($row);

        $json .= '{';
        $rowID = $row["id"];

        $json .= '"id": ' .$rowID . ',';
        $json .= '"title": "' .$row["nav_title"]. '",';
        $json .= '"class": "' . $row['css_class'] . '",';
        $json .= '"colour": "' . $row['route_colour'] . '",';
        $json .= '"info_bubble_width": ' . $row['info_bubble_width'] . ',';
        $json .= '"info_bubble_height": ' . $row['info_bubble_height'] . ',';
        $json .= '"url": "' . $row['friendly_url'] . '"';

        $innerStmt = $mysqli->prepare('SELECT lat, lng  from route_geo WHERE route_id = ? ORDER BY route_geo.order');
        $innerStmt->bind_param('i', $rowID);
        $innerStmt->execute();

        $innerResult = $innerStmt->get_result();
        $innerNumRows =  mysqli_num_rows($innerResult);
        $innerJson = array();
        $innerCount = 0;
        if ($numRows > 0)
        {
            $json .= ',"coords": [';
            while ($innerRow = $innerResult->fetch_assoc())
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
        //$json .= '}';

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