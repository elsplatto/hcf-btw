<?php
include '../includes/site-settings.php';
include '../includes/db.php';

$itineraryId = $_GET['id'];
$relPath = $_GET['relPath'];


if (isset($itineraryId))
{
    $query = 'SELECT title, doc, citation, intro, img FROM itineraries ';
    $query .= 'WHERE id = ? AND is_live = 1';

    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $itineraryId);

    $stmt->execute();

    $numRows = count($stmt->bind_result($title, $doc, $citation, $intro, $img));

    $json = array();
    if ($numRows > 0)
    {
        //echo 'trip plan['.$trip_plan.']';
        while ($stmt->fetch()) {

            ?>
            <div class="large-12 medium-12 small-12 columns standardDarkGrey paddingTop20">
                <a href="#" class="flyoutPanelClose">Close panel</a>
                <span>Itineraries</span>
                <h3><?=$title?></h3>
                <?=stripcslashes(stripcslashes($intro))?>
            </div>
            <div class="large-12 medium-12 small-12 standardDarkGrey paddingBottom20">
                <div class="large-7 medium-7 small-12 columns left"><img src="<?=$baseURL?>/img/itineraries/<?=$img?>" alt=""></div>
                <div class="large-5 medium-5 small-12 columns left">
                    <p>Download PDF: <strong><a href="<?=$baseURL?>/docs/itineraries/<?=$doc?>" target="_blank" style="text-transform: capitalize" onclick="trackInternalLink('Itinerary PDF - click', <?=$title?>); return false;"><?=$title?></a></strong></p>
                </div>
            </div>

            <?php
        }
    }
    else{
    ?>
        <div class="large-12 medium-12 small-12 columns standardDarkGrey paddingTopBottom20">
            <a href="#" class="flyoutPanelClose">Close panel</a>
            <h4>Whoops... we appear to have an issue</h4>
        </div>
    <?php
    }

    $stmt->close();
    $mysqli->close();
}

?>

