<?php
include '../includes/db.php';
include '../includes/site-settings.php';
include '../includes/Mobile_Detect.php';

function getVideo($id, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $query = 'SELECT title, video_embed FROM pages WHERE id = ?';

    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    if (!$stmt = $mysqli->prepare($query)) {
        echo 'Error: ' . $mysqli->error;
        return false; // throw exception, die(), exit, whatever..
    } else {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->bind_result($title, $video_embed);

        $results = array();
        $i = 0;
        while($stmt->fetch())
        {
            $results[$i]['title'] = $title;
            $results[$i]['video_embed'] = $video_embed;
            $i++;
        }
        return $results;
    }
}



?>
<div id="videoModal" class="white">
    <?php
    if (isset($_GET['id']))
    {
        $pageId = $_GET['id'];
        $pageDetails = getVideo($pageId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        foreach($pageDetails as $pageDetail)
        {
            echo '<h3>'.$pageDetail['title'].'</h3>';
            echo '<div class="text-center">'.stripcslashes($pageDetail['video_embed']).'</div>';
        }
    }
    ?>
    <a class="close-reveal-modal reveal-close">x</a>
</div>