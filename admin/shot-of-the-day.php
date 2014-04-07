<?php
include '../includes/site-settings.php';
include '../includes/db.php';
include '../includes/global-functions.php';
require '../includes/instagram.class.php';
require '../includes/instagram.config.php';
include 'includes/global-admin-functions.php';
assessLogin(['super','publisher','author','restricted']);

//function getShotOfTheDayID()
?>
<html>
    <head>
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
                <a href="dashboard.php">Dashboard</a>
                <h1>
                    Shot of the day
                </h1>
            </div>
        </div>
    </section>


    <section>
        <div class="row">
            <div class="large-6 columns">
                <form action="shot-of-the-day-process.php" name="frmShotOfTheDay" id="frmShotOfTheDay" method="post">
                    <label for="mediaId">Media ID:
                        <input type="text" id="txtMediaId" name="txtMediaId" />
                    </label>
                    <input type="submit" class="button" value="Submit" />
                </form>
            </div>

            <div class="large-6 columns">
                here
            </div>
        </div>
    </section>
    <?php
    include 'includes/footer.php';
    ?>
    </body>
</html>