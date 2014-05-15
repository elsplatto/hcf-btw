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

<!--div class="row marginTop20">
    <div class="large-12 columns">
        <h3 class="text-center" style="margin-bottom: -0.5rem">Gallery</h3>
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
</div-->


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



$instagramResults = $instagram->getTagMedia('vividsydney',$tokenSet, 20); //get 1 more than we need to miss out pic of the day in the small images

$instagramLoginURL = $instagram->getLoginUrl(array('basic','likes','relationships','comments'));


if ($instagramUserLoggedIn)
{
    $instagramCommentURL = $baseURL . '/overlays/instagram-comment.php';
    $instagramCommentOverlaySize = 'large';
    $instagramLikeURL = '#';
    $instagramLikeOverlaySettings = '';
    $userLikedClass = '';
} else {
    $instagramCommentURL = $baseURL . '/overlays/instagram-login.php';
    $instagramCommentOverlaySize = 'small';
    $instagramLikeURL = $baseURL . '/overlays/instagram-login.php';
    $instagramLikeOverlaySettings = ' data-reveal-ajax="true"';
    $userLikedClass = ' reveal-init';
}

$count = 0;

if (!isset($instaMaxCount))
{
    $instaMaxCount = 4;
}


if (!isset($instaFeature))
{
    $instaFeature = false;
    $instaMaxCount = 4;
}

if ($instaFeature == true)
{
    $instaMaxCount = 5;
}


if ($instagramResults->meta->code == 200)
{
    $photographerList = array();
    foreach ($instagramResults->data as $post) {
        $photographerID = $post->user->id;

            $count++;
            array_push($photographerList, $photographerID);
            if ($count <= $instaMaxCount)
            {
                if ($instagramUserLoggedIn)
                {
                    $blnUserLiked = $post->user_has_liked;

                    if (isset($blnUserLiked))
                    {
                        if ($blnUserLiked) {
                            $userLikedClass = ' userLikes';
                            $likeURL = $baseURL . '/services/instagram-unlike-media.php?media_id='.$post->id;
                            $likeText = 'You like this media - click to unlike.';
                        }
                        else
                        {
                            $userLikedClass = ' userNoLikes';
                            $likeURL = $baseURL . '/services/instagram-like-media.php?media_id='.$post->id;
                            $likeText = 'Click to like.';
                        }

                    }
                }
                else
                {
                    $likeURL = $baseURL . '/overlays/instagram-login.php';
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

                if ($instaFeature == true && $count == 1)
                {
                    $classList = 'small-12 medium-6 large-6';
                }
                else if ($instaFeature == true && $count > 1)
                {
                    $classList = 'small-12 medium-6 large-3';
                }
                else
                {
                    $classList = 'small-6 medium-3 large-6';
                }
                ?>

                <div class="<?=$classList?> columns">
                    <div class="small-12 large-12 insta">
                        <a href="<?=$instagramPicLink?>?media_id=<?=$post->id?>" data-reveal-ajax="true" class="reveal-init<?=$videoClass?>" data-size="<?=$instagramCommentOverlaySize?>" data-mediaId="<?=$post->id?>"><?php
                        if ($instaFeature == true && $count == 1)
                        {
                            ?><img src="<?=$post->images->standard_resolution->url?>" alt="<?=$post->caption->text?>" /><?php
                        }
                        else
                        {
                            ?><img src="<?=$post->images->low_resolution->url?>" alt="<?=$post->caption->text?>" /><?php
                        }
                            ?></a>
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
                                <a href="https://twitter.com/share?url=<?=$baseURL?>/#gallery&text=Tag your photo and it will appear here&hashtag=vividsydney&count=none" class="twitter-share-button gallery-tweet" data-lang="en">Tweet</a>
                                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
    }
}
else {

    echo "<p>We are having problems with our gallery at the moment - we'll have it up and running again shortly.</p>";
}

?>




<!--javascript in instagram-js.php-->