<?php
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin(['super','publisher']);

$mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
$stmt = $mysqli->prepare('SELECT  DISTINCT(label) FROM route_geo WHERE is_waypoint = 1 OR is_destination = 1 order by label');

$stmt->execute();

//$result = $stmt->get_result();
$stmt->bind_result($label);

$json = '';

$results = array();
$i = 0;
while($stmt->fetch())
{
    $results[$i]['label'] = $label;
    $i++;
}

$numRows =  count($results);

if ($numRows > 0)
{
    $i = 0;
    $json .= '[';
    foreach ($results as $row)
    {
        $json .= '"'.$row["label"].'"';
        if ($i < $numRows-1)
        {
            $json .= ',';
        }
        $i++;
    }
    $json .= ']';
}

$stmt->close();
$mysqli->close();

echo $json;
$file = fopen("../json/wharfs.json","w");
fwrite($file, $json);
fclose($file);