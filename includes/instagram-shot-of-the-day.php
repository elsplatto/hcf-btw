
<?php
$instagramUsername = "";
if (isset($instagramData))
{
    $instagramUsername = $instagramData->user->username;
    $instagramLogoutURL = '?id=logout';
} else {
    // Login URL
    $instagramLoginURL = $instagram->getLoginUrl(array('basic','likes','relationships','comments'));
}

?>

<section class="photoSection marginBottomStandard">

<div class="row marginTop20 marginBottom20">
    <div class="large-12 columns">
        <?php
        if (isset($instagramData))
        {
            echo '<h4>Welcome ' . $instagramUsername . '</h4>';
            echo '<a href="'.$instagramLogoutURL.'" class="button">Logout of Instagram</a>';
        }
        else
        {
            echo '<a href="'.$instagramLoginURL.'" class="button">Log into Instagram</a>';
        }
        ?>
    </div>
</div>

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
else{
    $tokenSet = false;
}

$shotOfTheDayID = getShotOfTheDayID($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

$shotOfTheDayResults = $instagram->getMedia($shotOfTheDayID, $tokenSet);

$instagramResults = $instagram->getTagMedia('beyondthewharf',$tokenSet, 4);

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
    ?>

    <div class="small-6 large-6 columns">
        <div class="large-12 small-12 insta">
            <img src="<?=$shotOfTheDayResults->data->images->standard_resolution->url?>" alt="<?=$shotOfTheDayResults->data->caption->text?>" />
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
                </div>
            </div>
        </div>
    </div>
<?php
}

if ($instagramResults->meta->code == 200)
{
    foreach ($instagramResults->data as $post) {

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
        ?>

        <div class="small-3 large-3 columns">
            <div class="small-12 large-12 insta">
                <img src="<?=$post->images->low_resolution->url?>" alt="<?=$post->caption->text?>" />
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
                    </div>
                </div>
            </div>
        </div>
        <?php

        $count++;
    }
}
else {

    /*$to = 'jason.taikato@tobiasandtobias.com';
    $subject = 'System error mail';
    $message = '<html><head></head><body><p><strong>Type:</strong> '.$instagramResults->error_type.'</p><p><strong>Msg:</strong> '.$instagramResults->error_message.'</p><p><strong>URL:</strong> '.$_SERVER['REQUEST_URI'].'</p></body></html>';

    $from = 'website@harbourcityferries.com.au';
    $headers = 'MIME-Version: 1.0\r\n';
    $headers .= 'Content-type: text/html; charset=iso-8859-1\r\n';
    $headers  .= 'From:' .$from.'\r\n';*/
    //mail($to,$subject,$message,$headers);


    echo '<div class="systemError"><h2>Error:</h2>';
    //echo '<p>An email with the following message has been sent to the webmaster - sorry for any inconvenience.</a></p>';
    echo '<p><strong>Type:</strong> '.$instagramResults->error_type.'</p>';
    echo '<p><strong>Msg:</strong> '.$instagramResults->error_message.'</p>';
    echo '<p><strong>URL:</strong> '.$_SERVER['REQUEST_URI'].'</p>';
    echo '</div>';
}

?>



</div>
<div class="row marginTop20">
    <div class="large-12 columns text-center">
        <h3 class="block">
            Share your experience
        </h3>
        <h4>Tag your instagram photos with <span class="tag">#beyondthewharf</span></h4>
        <a href="#" class="button stdDarkGrey">Follow us on <span class="social instagram small"></span> Instagram</a>
    </div>
</div>
</section>

<!--javascript in global-js-->