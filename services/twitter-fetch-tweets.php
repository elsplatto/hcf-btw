<?php

include '../includes/site-settings.php';
include '../includes/global-functions.php';
require '../includes/twitter.class.php';
require '../includes/twitter.config.php';


$twitterResults = $twitter->search('#beyondthewharf'); //homepage only page with twitter feed at this point - move to site-settings.php if more prolific

$tweetCount = 0;
$tweetMax = 3;

if (count($twitterResults) > 0)
{
    foreach ($twitterResults as $tweet)
    {
        //$tweetText = $tweet->text;
        $tweetText = preg_replace('"\b(http://\S+)"', '<a href="$1" target="_blank" rel="nofollow">$1</a>', $tweet->text);

    ?>
    <li class="large-3 medium-3 small-3 columns">
        <div class="tile">


            <div class="tweetText">
                <?=$tweetText?>
            </div>
            <div class="tweetCred">
                <a href="http://twitter.com/<?=$tweet->user->name?>" target="_blank" rel="nofollow">@<?=$tweet->user->name?></a>

                <a href="https://twitter.com/share?url=<?=$baseURL?>/&text=Living like a local&hashtag=beyondthewharf&count=none" class="twitter-share-button right marginTop3" data-lang="en">Tweet</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

            </div>
        </div>
    </li>
    <?php
        $tweetCount++;
        if ($tweetCount >= $tweetMax) {
            break;
        }
    }
}
else
{
?>
    <li class="large-3 medium-3 small-3 columns">
        <div class="tile">


            <div class="tweetText">
                We are having some trouble connecting to twitter.
            </div>
            <div class="tweetCred">
                <a href="http://twitter.com/beyondthewharf" target="_blank" rel="nofollow">@beyondthewharf</a>

            </div>
        </div>
    </li>

    <li class="large-3 medium-3 small-3 columns">
        <div class="tile">


            <div class="tweetText">
                <img src="../img/content/twitterRobot-tile.png" alt="Looks like we are having trouble connecting to twitter" />
            </div>
            <div class="tweetCred">
                <a href="http://twitter.com/beyondthewharf" target="_blank" rel="nofollow">@beyondthewharf</a>

            </div>
        </div>
    </li>

<?php
}
?>