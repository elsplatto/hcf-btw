<?php
$instagramUsername = "";
if (isset($instagramData))
{
    $instagramUsername = $instagramData->user->username;
    $instagramLogoutURL = '?id=logout';
    $instagramPicLink = $baseURL .'/overlays/instagram-comment.php';
} else {
    // Login URL
    $instagramLoginURL = $instagram->getLoginUrl(array('basic','likes','relationships','comments'));
    $instagramPicLink = $baseURL .'/overlays/instagram-get-media.php';
}
?>
<section class="photoSection marginBottomStandard">

<div class="row marginTop20">
    <div class="large-12 columns">
        <h3 class="text-center galleryTitle">Gallery</h3>
        <?php
        if (isset($instagramData))
        {
            echo '<h4>Welcome ' . $instagramUsername . '</h4>';
            echo '<a href="'.$instagramLogoutURL.'" class="button">Logout of Instagram</a>';
        }
        /*
        else
        {
            echo '<a href="'.$instagramLoginURL.'" class="button">Log into Instagram</a>';
        }*/
        ?>
    </div>
</div>
<a id="gallery"></a>
<div id="photoHolder01" class="row">
<?php

if (isset($instagramData))
{
    $instagram->setAccessToken($instagramData);

    $token = $instagram->getAccessToken();
}

if (isset($token))
{
    $tokenSet = true;
}
else
{
    $tokenSet = false;
}

//$compWinningPhotoID = '689269929886056156_198550';
$compWinningPhotoID = '';
if (strlen($compWinningPhotoID) > 0)
{
    $compWinnerResults = $instagram->getMedia($compWinningPhotoID, $tokenSet);
}
$shotOfTheDayID = getShotOfTheDayID($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

$shotOfTheDayResults = $instagram->getMedia($shotOfTheDayID, $tokenSet);

$instagramResults = $instagram->getTagMedia('beyondthewharf',$tokenSet, 20); //get 1 more than we need to miss out pic of the day in the small images

$instagramLoginURL = $instagram->getLoginUrl(array('basic','likes','relationships','comments'));


if ($instagramUserLoggedIn)
{
    $instagramCommentURL = 'overlays/instagram-comment.php';
    $instagramCommentOverlaySize = 'large';
    $instagramLikeURL = '#';
    $instagramLikeOverlaySettings = '';
    $userLikedClass = '';
} else {
    $instagramCommentURL = 'overlays/instagram-login.php';
    $instagramCommentOverlaySize = 'small';
    $instagramLikeURL = 'overlays/instagram-login.php';
    $instagramLikeOverlaySettings = ' data-reveal-ajax="true"';
    $userLikedClass = ' reveal-init';
}

$count = 0;

if (strlen($compWinningPhotoID) > 0)
{
    if ($compWinnerResults->meta->code == 200)
    {

        if ($instagramUserLoggedIn)
        {
            $blnUserLiked = $compWinnerResults->data->user_has_liked;
            if (isset($blnUserLiked))
            {
                if ($blnUserLiked) {
                    $userLikedClass = ' userLikes';
                    $likeURL = 'services/instagram-unlike-media.php?media_id='.$compWinnerResults->data->id;
                    $likeText = 'You like this media - click to unlike.';
                }
                else
                {
                    $userLikedClass = ' userNoLikes';
                    $likeURL = 'services/instagram-like-media.php?media_id='.$compWinnerResults->data->id;
                    $likeText = 'Click to like.';
                }

            }
        }
        else
        {
            $likeURL = 'overlays/instagram-login.php';
            $likeText = 'You are not logged in. Log in to like.';
        }
        if ($compWinnerResults->data->type == 'video')
        {
            $videoClass = ' video';
        }
        else
        {
            $videoClass = '';
        }
        ?>

        <div class="small-12 medium-6 large-6 columns">
            <div class="large-12 medium-12 small-12 insta">
                <a href="<?=$instagramPicLink?>?media_id=<?=$compWinnerResults->data->id?>" data-reveal-ajax="true" class="reveal-init<?=$videoClass?>" data-size="<?=$instagramCommentOverlaySize?>" data-mediaId="<?=$compWinnerResults->data->id?>"><img src="<?=$compWinnerResults->data->images->standard_resolution->url?>" alt="<?=$compWinnerResults->data->caption->text?>" /></a>
                <div class="ribbon-wrapper"><div class="ribbon red">Winner</div></div>
                <a href="<?=$instagramCommentURL?>?media_id=<?=$compWinnerResults->data->id?>" data-reveal-ajax="true" class="comments reveal-init" data-size="<?=$instagramCommentOverlaySize?>" data-mediaId="<?=$shotOfTheDayResults->data->id?>" role="button"><span><?=$compWinnerResults->data->comments->count?></span></a>
                <a href="<?=$instagramLikeURL?>" data-url="<?=$likeURL?>" class="likes<?=$userLikedClass?>" title="<?=$likeText?>" data-mediaId="<?=$shotOfTheDayResults->data->id?>" role="button"<?=$instagramLikeOverlaySettings?>><span data-mediaId="<?=$compWinnerResults->data->id?>" data-likesCount="<?=$compWinnerResults->data->likes->count?>" data-displayCount><?=likeNumberFormatter($compWinnerResults->data->likes->count)?></span></a>
                <div class="infoContainer">
                    <div class="inner">
                        <span class="location">
                        <?php
                        if (property_exists($compWinnerResults->data,'location'))
                        {
                            if (is_null($compWinnerResults->data->location) || $compWinnerResults->data->location == null)
                            {
                                echo '--';
                            }

                            else if (property_exists($compWinnerResults->data->location,'name'))
                            {
                                echo $compWinnerResults->data->location->name;
                            }
                            else if (property_exists($compWinnerResults->data->location,'latitude') && property_exists($compWinnerResults->data->location,'longitude') && !property_exists($compWinnerResults->data->location,'name'))
                            {
                                echo $compWinnerResults->data->location->latitude . ' ,'. $compWinnerResults->data->location->longitude;
                            }

                        }
                        else
                        {
                            echo '---';
                        }
                        ?>
                        </span>
                        <span class="credit"><?=$compWinnerResults->data->user->username?></span>

                        <a href="https://twitter.com/share?url=<?=$baseURL?>/#gallery&text=Check out @beyondthewharf competition winner&hashtag=beyondthewharf&count=none" class="twitter-share-button gallery-tweet" data-lang="en">Tweet</a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                    </div>
                </div>
            </div>
        </div>

    <?php
    }
}

if ($shotOfTheDayResults->meta->code == 200)
{

    if ($instagramUserLoggedIn)
    {
        $blnUserLiked = $shotOfTheDayResults->data->user_has_liked;
        if (isset($blnUserLiked))
        {
            if ($blnUserLiked) {
                $userLikedClass = ' userLikes';
                $likeURL = 'services/instagram-unlike-media.php?media_id='.$shotOfTheDayResults->data->id;
                $likeText = 'You like this media - click to unlike.';
            }
            else
            {
                $userLikedClass = ' userNoLikes';
                $likeURL = 'services/instagram-like-media.php?media_id='.$shotOfTheDayResults->data->id;
                $likeText = 'Click to like.';
            }

        }
    }
    else
    {
        $likeURL = 'overlays/instagram-login.php';
        $likeText = 'You are not logged in. Log in to like.';
    }
    if ($shotOfTheDayResults->data->type == 'video')
    {
        $videoClass = ' video';
    }
    else
    {
        $videoClass = '';
    }
    ?>

    <div class="small-12 medium-6 large-6 columns">
        <div class="large-12 medium-12 small-12 insta">
            <a href="<?=$instagramPicLink?>?media_id=<?=$shotOfTheDayResults->data->id?>" data-reveal-ajax="true" class="reveal-init<?=$videoClass?>" data-size="<?=$instagramCommentOverlaySize?>" data-mediaId="<?=$shotOfTheDayResults->data->id?>"><img src="<?=$shotOfTheDayResults->data->images->standard_resolution->url?>" alt="<?=$shotOfTheDayResults->data->caption->text?>" /></a>
            <a href="<?=$instagramCommentURL?>?media_id=<?=$shotOfTheDayResults->data->id?>" data-reveal-ajax="true" class="comments reveal-init" data-size="<?=$instagramCommentOverlaySize?>" data-mediaId="<?=$shotOfTheDayResults->data->id?>" role="button"><span><?=$shotOfTheDayResults->data->comments->count?></span></a>
            <a href="<?=$instagramLikeURL?>" data-url="<?=$likeURL?>" class="likes<?=$userLikedClass?>" title="<?=$likeText?>" data-mediaId="<?=$shotOfTheDayResults->data->id?>" role="button"<?=$instagramLikeOverlaySettings?>><span data-mediaId="<?=$shotOfTheDayResults->data->id?>" data-likesCount="<?=$shotOfTheDayResults->data->likes->count?>" data-displayCount><?=likeNumberFormatter($shotOfTheDayResults->data->likes->count)?></span></a>
            <div class="infoContainer">
                <div class="inner">
                    <span class="location">
                    <?php
                    if (property_exists($shotOfTheDayResults->data,'location'))
                    {
                        if (is_null($shotOfTheDayResults->data->location) || $shotOfTheDayResults->data->location == null)
                        {
                            echo '--';
                        }

                        else if (property_exists($shotOfTheDayResults->data->location,'name'))
                        {
                            echo $shotOfTheDayResults->data->location->name;
                        }
                        else if (property_exists($shotOfTheDayResults->data->location,'latitude') && property_exists($shotOfTheDayResults->data->location,'longitude') && !property_exists($shotOfTheDayResults->data->location,'name'))
                        {
                            echo $shotOfTheDayResults->data->location->latitude . ' ,'. $shotOfTheDayResults->data->location->longitude;
                        }

                    }
                    else
                    {
                        echo '---';
                    }
                    ?>
                    </span>
                    <span class="credit"><?=$shotOfTheDayResults->data->user->username?></span>

                    <span class="button green photo-of-the-day">Photo of the day</span>

                    <a href="https://twitter.com/share?url=<?=$baseURL?>/#gallery&text=Check out shot of the day&hashtag=beyondthewharf&count=none" class="twitter-share-button shot-of-day-tweet" data-lang="en">Tweet</a>
                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                </div>
            </div>
        </div>
    </div>
<?php
}

if ($instagramResults->meta->code == 200)
{
    $photographerList = array();
    foreach ($instagramResults->data as $post) {
        $photographerID = $post->user->id;
        if ($post->id != $shotOfTheDayID && !in_array($photographerID,$photographerList))
        {
            $count++;
            array_push($photographerList, $photographerID);
            if ($count < 5)
            {
                if ($instagramUserLoggedIn)
                {
                    $blnUserLiked = $post->user_has_liked;

                    if (isset($blnUserLiked))
                    {
                        if ($blnUserLiked) {
                            $userLikedClass = ' userLikes';
                            $likeURL = 'services/instagram-unlike-media.php?media_id='.$post->id;
                            $likeText = 'You like this media - click to unlike.';
                        }
                        else
                        {
                            $userLikedClass = ' userNoLikes';
                            $likeURL = 'services/instagram-like-media.php?media_id='.$post->id;
                            $likeText = 'Click to like.';
                        }

                    }
                }
                else
                {
                    $likeURL = 'overlays/instagram-login.php';
                    $likeText = 'You are not logged in. Log in to like.';
                }

                if ($post->type == 'video')
                {
                    $videoClass = ' video';
                }
                else
                {
                    $videoClass = '';
                }
                ?>

                <div class="small-6 medium-3 large-3 columns">
                    <div class="small-12 large-12 insta">
                        <a href="<?=$instagramPicLink?>?media_id=<?=$post->id?>" data-reveal-ajax="true" class="reveal-init<?=$videoClass?>" data-size="<?=$instagramCommentOverlaySize?>" data-mediaId="<?=$post->id?>"><img src="<?=$post->images->low_resolution->url?>" alt="<?=$post->caption->text?>" /></a>
                        <a href="<?=$instagramCommentURL?>?media_id=<?=$post->id?>" class="comments reveal-init" data-size="<?=$instagramCommentOverlaySize?>" data-mediaId="<?=$post->id?>" role="button"><span><?=$post->comments->count?></span></a>
                        <a href="<?=$instagramLikeURL?>" data-url="<?=$likeURL?>" class="likes<?=$userLikedClass?>" title="<?=$likeText?>" data-mediaId="<?=$post->id?>" role="button"<?=$instagramLikeOverlaySettings?>><span data-mediaId="<?=$post->id?>" data-likesCount="<?=$post->likes->count?>" data-displayCount><?=likeNumberFormatter($post->likes->count)?></span></a>
                        <div class="infoContainer">
                            <div class="inner">
                                <span class="location">
                                <?php
                                //var_dump($post);
                                if (property_exists($post,'location'))
                                {
                                    if (is_null($post->location) || $post->location == null)
                                    {
                                        echo '--';
                                    }

                                    else if (property_exists($post->location,'name'))
                                    {
                                        echo $post->location->name;
                                    }
                                    else if (property_exists($post->location,'latitude') && property_exists($post->location,'longitude') && !property_exists($post->location,'name'))
                                    {
                                        echo $post->location->latitude . ' ,'. $post->location->longitude;
                                    }

                                }
                                else
                                {
                                    echo '---';
                                }
                                ?>
                                </span>
                                <span class="credit"><?=$post->user->username?></span>
                                <a href="https://twitter.com/share?url=<?=$baseURL?>/#gallery&text=Tag your photo and it will appear here&hashtag=beyondthewharf&count=none" class="twitter-share-button gallery-tweet" data-lang="en">Tweet</a>
                                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
    }
}
else {

    echo "<p>We are having problems with our gallery at the moment - we'll have it up and running again shortly.</p>";
}

?>



</div>
<div class="row marginTop20">
    <div class="large-12 columns text-center">

        <a href="<?=$baseURL?>/gallery" class="button">Go to Gallery</a>

        <h3 class="block">
            Share your experience
        </h3>
        <h4>Tag your instagram photos with <span class="tag">#beyondthewharf</span></h4>
        <?php
        if ($instagramUserLoggedIn)
        {
            $instagramFollowData = $instagram->getUserRelationship($btwInstagramID);
            $instagramFollowStatus = $instagramFollowData->data->outgoing_status;

            //echo '['.$instagramFollowStatus.']';

            if ($instagramFollowStatus == 'none')
            {
                echo '<a href="'.$baseURL.'/services/instagram-follow-btw.php" class="button stdDarkGrey insta-follow">Follow us on <span class="social instagram small"></span> Instagram</a>';
            }
            else if ($instagramFollowStatus == 'follows')
            {
                echo '<a href="'.$baseURL.'/services/instagram-unfollow-btw.php" class="button stdGreen insta-unfollow"><span class="social instagram small"></span> Following</a>';
            }
        }
        else{
            echo '<a href="'.$baseURL.'/overlays/instagram-login.php" class="button stdDarkGrey reveal-init">Follow us on <span class="social instagram small"></span> Instagram</a>';
        }
        ?>

    </div>
</div>
</section>

<!--javascript in instagram-js.php-->