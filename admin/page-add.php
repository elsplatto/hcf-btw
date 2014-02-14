<?php
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin();

function getAllPages($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE) {
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT pages.id, pages.title FROM pages ORDER BY pages.order');

    $stmt->execute();
    $stmt->bind_result($id, $title);

    $results = array();
    $i = 0;
    while($stmt->fetch())
    {
        $results[$i]['id'] = $id;
        $results[$i]['title'] = $title;
        $i++;
    }

    $mysqli->close();
    return $results;
}

$allPages = getAllPages($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
?>
<html>
<head>
    <title>Add Page</title>
    <?php
    include 'includes/head.php';
    ?>
</head>
<body>
<section>
    <div class="row">
        <div class="large-12 columns">
            <h1>Page - Add</h1>
            <a href="page-list.php">< Back to Page List</a>
        </div>
    </div>
</section>

<section>
    <div class="row">
        <div class="large-12 columns">
            <form id="frmPage" name="frmPage" action="page-process.php" method="post">

                <label for="txtTitle">Title:</label>
                <input type="text" id="txtTitle" name="txtTitle" />

                <label for="txtFriendlyURL">Friendly URL:</label>
                <input type="text" id="txtFriendlyURL" name="txtFriendlyURL" placeholder="Lower case and separated by '-'" />

                <label for="selParentID">Parent Page</label>
                <select id="selParentID" name="selParentID">
                    <option value="0">Select</option>
                    <?php
                    foreach ($allPages as $parentPage)
                    {
                        if ($parentPage['id'] != $page_id)
                        {
                            ?>
                            <option value="<?=$parentPage['id']?>"><?=$parentPage['title']?></option>
                        <?php
                        }
                    }
                    ?>
                </select>

                <label for="chkNav">Show in Nav:</label>
                <input type="checkbox" id="chkNav" name="chkNav" value="1"/>

                <label for="chkLanding">Is Landing Page:</label>
                <input type="checkbox" id="chkLanding" name="chkLanding" value="1" />

                <label for="txtNavTitle">Nav Title:</label>
                <input type="text" id="txtNavTitle" name="txtNavTitle" value="" />

                <label for="txtHeading">Heading:</label>
                <input type="text" id="txtHeading" name="txtHeading" value="" />

                <label for="txtHeadingPullout">Heading Pullout/Quote:</label>
                <input type="text" id="txtHeadingPullout" name="txtHeadingPullout" value="" />

                <label for="txtSubHeading">Sub Heading:</label>
                <input type="text" id="txtSubHeading" name="txtSubHeading" value="" />

                <label for="txtHeaderImage">Header Image:</label>
                <input type="text" id="txtHeaderImage" name="txtHeaderImage" value="" />

                <label for="txtHeaderMP4">Header mp4:</label>
                <input type="text" id="txtHeaderMP4" name="txtHeaderMP4" value="" />

                <label for="txtHeaderWebm">Header webm:</label>
                <input type="text" id="txtHeaderWebm" name="txtHeaderWebm" value="" />

                <label for="txtTags">Tags:</label>
                <input type="text" id="txtTags" name="txtTags" value="" placeholder="No # and separate by comma" />

                <label for="txtContent">Content:</label>
                <textarea id="txtContent" name="txtContent" cols="100" rows="5"></textarea>

                <label for="txtMetaKeywords">Meta Keywords:</label>
                <input type="text" id="txtMetaKeywords" name="txtMetaKeywords" value="" placeholder="No # and separate by comma" />

                <label for="txtMetaDescription">Meta Description:</label>
                <input type="text" id="txtMetaDescription" name="txtMetaDescription" value="" />

                <label for="txtMetaDescription">Meta Description:</label>
                <input type="text" id="txtMetaDescription" name="txtMetaDescription" value="" />

                <label for="txtOrder">Order:</label>
                <input type="text" id="txtOrder" name="txtOrder" value="" />

                <label for="chkHasMap">Has Map:</label>
                <input type="checkbox" id="chkHasMap" name="chkHasMap" value="1" />

                <label for="chkLive">Live:</label>
                <input type="checkbox" id="chkLive" name="chkLive" value="1" />

                <input type="submit" value="Submit" />

            </form>
        </div>
    </div>
</section>
</body>
</html>