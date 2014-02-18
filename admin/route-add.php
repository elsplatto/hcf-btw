<?php
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin();


?>
<html>
<head>
    <title>Add Route</title>
    <?php
    include 'includes/head.php';
    ?>
</head>
<body>

<section>
    <div class="row">
        <div class="large-12 columns">
            <a href="dashboard.php">Dashboard</a>
            <h1>Route - Add</h1>
            <a href="route-list.php">< Back to Route List</a>
        </div>
    </div>
</section>

<section>
    <div class="row">
        <div class="large-12 columns">
            <form id="frmRoute" name="frmRoute" action="route-process.php" method="post">

                    <input type="hidden" id="routeID" name="routeID" value="" />

                    <label for="txtTitle">Title:(appears in browsers title barl)</label>
                    <input type="text" id="txtPageTitle" name="txtPageTitle" value="" />

                    <label for="txtTitle">Nav Title:</label>
                    <input type="text" id="txtNavTitle" name="txtNavTitle" value="" />

                    <label for="txtFriendlyURL">Friendly URL:</label>
                    <input type="text" id="txtFriendlyURL" name="txtFriendlyURL" value="" placeholder="Lower case and separated by '-'" />


                    <label for="txtHeading">Heading:</label>
                    <input type="text" id="txtHeading" name="txtHeading" value="" />

                    <label for="txtHeadingPullout">Heading Pullout/Quote:</label>
                    <input type="text" id="txtHeadingPullout" name="txtHeadingPullout" value="" />

                    <label for="txtRouteColour">Route Colour:</label>
                    <input type="text" id="txtRouteColour" name="txtRouteColour" value="" />

                    <label for="txtCSSClass">CSS Class:</label>
                    <input type="text" id="txtCSSClass" name="txtCSSClass" value="" />

                    <label for="txtHeaderImage">Header Image:</label>
                    <input type="text" id="txtHeaderImage" name="txtHeaderImage" value="" />


                    <label for="txtInfoBubbleWidth">Info Bubble Width:</label>
                    <input type="text" id="txtInfoBubbleWidth" name="txtInfoBubbleWidth" value="" />

                    <label for="txtInfoBubbleHeight">Info Bubble Height:</label>
                    <input type="text" id="txtInfoBubbleHeight" name="txtInfoBubbleHeight" value="" />

                    <label for="txtHeaderMP4">Header mp4:</label>
                    <input type="text" id="txtHeaderMP4" name="txtHeaderMP4" value="" />

                    <label for="txtHeaderWebm">Header webm:</label>
                    <input type="text" id="txtHeaderWebm" name="txtHeaderWebm" value="" />

                    <label for="txtTags">Tags:</label>
                    <input type="text" id="txtTags" name="txtTags" value="" placeholder="No # and separate by comma" />

                    <label for="txtContentHeader">Content Heading:</label>
                    <input type="text" d="txtContentHeader" name="txtContentHeader" value="" placeholder="Appears above the content" />

                    <label for="txtContent">Content:</label>
                    <textarea id="txtContent" name="txtContent" cols="100" rows="5"></textarea>

                    <label for="txtMetaKeywords">Meta Keywords:</label>
                    <input type="text" id="txtMetaKeywords" name="txtMetaKeywords" value="" placeholder="No # and separate by comma" />

                    <label for="txtMetaDescription">Meta Description:</label>
                    <input type="text" id="txtMetaDescription" name="txtMetaDescription" value="" />

                    <label for="txtNavOrder">Order:</label>
                    <input type="text" id="txtNavOrder" name="txtNavOrder" value="" />





                    <label for="chkLive">Live:</label>
                    <input type="checkbox" id="chkLive" name="chkLive" value="1" />

                    <input type="submit" value="Submit" />

            </form>
        </div>
    </div>
</section>

</body>
</html>