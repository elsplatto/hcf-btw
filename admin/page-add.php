<?php
include 'includes/admin-settings.php';
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin($securityArrAuthor);

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
    $stmt->close();
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
<?php
include 'includes/header.php';
?>
<section>
    <div class="row">
        <div class="large-12 columns">
            <a href="dashboard.php">Home</a>
            <h1>Page - Add</h1>
            <a href="page-list.php">< Back to Page List</a>
        </div>
    </div>
</section>

<section>
    <div class="row">
        <div class="large-12 columns">
            <form id="frmPage" name="frmPage" action="page-process.php" method="post">

                <label for="selParentID">Parent Page:
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
                </label>


                <label for="txtFriendlyURL">Friendly URL:
                    <input type="text" id="txtFriendlyURL" name="txtFriendlyURL" placeholder="Lower case and separated by '-'" />
                </label>

                <a href="#" class="showHide" data-target="#metaArea" data-hideText="Hide Meta Data Fields" data-showText="Show Meta Data Fields">Show Meta Data Fields</a>

                <div id="metaArea" class="hide">

                    <label for="txtTags">Tags:
                        <input type="text" id="txtTags" name="txtTags" value="" placeholder="No # and separate by comma" />
                    </label>

                    <label for="txtTitle">Meta Title:
                        <input type="text" id="txtTitle" name="txtTitle" placeholder="This appears in the tab on the browser" />
                    </label>


                    <label for="txtMetaKeywords">Meta Keywords:
                        <input type="text" id="txtMetaKeywords" name="txtMetaKeywords" value="" placeholder="No # and separate by comma" />
                    </label>

                    <label for="txtMetaDescription">Meta Description:
                        <input type="text" id="txtMetaDescription" name="txtMetaDescription" value="" />
                    </label>
                </div>

                <label for="chkLanding">Is Landing Page:
                    <input type="checkbox" id="chkLanding" name="chkLanding" value="1" />
                </label>

                <label for="chkNav">Show in Nav:
                    <input type="checkbox" id="chkNav" name="chkNav" value="1" class="showHide" data-target="#navTitleArea" />
                </label>

                <label id="navTitleArea" class="hide" for="txtNavTitle">Nav Title:
                    <input type="text" id="txtNavTitle" name="txtNavTitle" value="" />
                </label>

                <label for="txtHeading">Heading:
                    <input type="text" id="txtHeading" name="txtHeading" value="" />
                </label>

                <label for="txtHeadingPullout">Heading Pullout/Quote:
                    <input type="text" id="txtHeadingPullout" name="txtHeadingPullout" value="" />
                </label>

                <label for="txtSubHeading">Sub Heading:
                    <input type="text" id="txtSubHeading" name="txtSubHeading" value="" />
                </label>

                <label for="txtHeaderImage">Header Image:
                    <input type="text" id="txtHeaderImage" name="txtHeaderImage" value="" />
                </label>

                <!--label for="txtHeaderMP4">Header mp4:
                <input type="text" id="txtHeaderMP4" name="txtHeaderMP4" value="" />
                </label>

                <label for="txtHeaderWebm">Header webm:
                <input type="text" id="txtHeaderWebm" name="txtHeaderWebm" value="" />
                </label-->

                <label for="txtVideoEmbed">Video Embed:
                    <input type="text" id="txtVideoEmbed" name="txtVideoEmbed" />
                </label>

                <label for="txtContentHeader">Content Heading:</label>
                <input type="text" id="txtContentHeader" name="txtContentHeader" value="" placeholder="Appears above the content" />

                <label for="txtContent">Content:</label><a href="#" class="insertTag" data-tag="paragraph" data-target="txtContent">Insert Paragraph Tag</a> | <a href="#" class="insertTag" data-tag="image" data-target="txtContent">Insert Image Tag</a> | <a href="#" class="insertTag" data-tag="quote" data-target="txtContent">Insert Quote Tag</a>
                <textarea id="txtContent" name="txtContent" cols="100" rows="15"></textarea>



                <label for="txtThemeClass">Theme Class:
                    <input type="text" id="txtThemeClass" name="txtThemeClass" value="" />
                </label>

                <label for="txtOrder">Order:
                    <input type="text" id="txtOrder" name="txtOrder" value="" />
                </label>

                <label for="chkHasMap">Has Map:
                    <input type="checkbox" id="chkHasMap" name="chkHasMap" value="1" />
                </label>

                <label for="chkLive">Publish:
                    <input type="checkbox" id="chkLive" name="chkLive" value="1" />
                </label>

                <input type="submit" value="Submit" class="button" /> &nbsp; <a href="page-list.php"class="cancel">Cancel</a>

            </form>
        </div>
    </div>
</section>
<script>
    $(function() {
        $('.insertTag').click(function(e) {
            e.preventDefault();
            var target = $('#' + $(this).attr('data-target'));
            var tag = $(this).attr('data-tag');
            var tagHTML = '';
            switch(tag){
                case 'paragraph':
                    tagHTML = '<p><\/p>';
                    break;

                case 'quote':
                    tagHTML = '<blockquote><br \/><small><\/small><\/blockquote>';
                    break;

                case 'image':
                    tagHTML = '<figure><img src="" alt="" /><figcaption>Caption goes here</figcaption></figure>';
                    break;
            }

            target.val(target.val() + tagHTML);
        });
    });
</script>

<?php
include 'includes/global-admin-js.php';
?>
</body>
</html>