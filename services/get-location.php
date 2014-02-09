<?php
header('Content-type:application/json');
include '../includes/db.php';

$locationId = $_GET['id'];

if (isset($locationId))
{
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT location_name, image_med, alt, sub_heading, intro_text, category FROM tiles WHERE id = ?');
    $stmt->bind_param('i', $locationId);

    $stmt->execute();

    $result = $stmt->get_result();
    $numRows =  mysqli_num_rows($result);

    $json = array();
    if ($numRows > 0)
    {
        while ($row = $result->fetch_assoc()) {
            // do something with $row
            //var_dump($row);
            $json[] = $row;
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