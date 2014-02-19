<?php
$pageMetaTitle = "Beyond the Wharf - Sydney Harbour, Sydney Activities, Sydney Ferries";
$pageSection = "home";
$pageMetaDesc = "Beyond the Wharf provides local and international insights to Sydney Harbour.";
include 'includes/head.php';
/*global includes in head.php*/

?>
    <body>
<?php
include 'includes/nav.php';




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

<section class="breadcrumbsHolder">
    <div class="row">
        <div class="large-12 columns breadcrumbs">
            <a href="<?=$baseURL?>/">Home</a><span>Gallery</span>
        </div>
    </div>
</section>

<section class="photoSection marginBottomStandard">

    <div class="row marginTop20">
        <div class="large-12 columns">
            <h2 class="block clearfix text-left">Gallery</h2>

            <?php
            /*if (isset($instagramData))
            {
                echo '<h4>Welcome ' . $instagramUsername . '</h4>';
                echo '<a href="'.$instagramLogoutURL.'" class="button">Logout of Instagram</a>';
            }
            else
            {
                echo '<a href="'.$instagramLoginURL.'" class="button">Log into Instagram</a>';
            }*/
            ?>
        </div>
    </div>

    <div id="photoHolder01" class="row galleryHolder">

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

    $instagramResults = $instagram->getTagMedia('beyondthewharf',$tokenSet);

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

        <div class="small-6 large-6 columns right">
            <div class="large-12 small-12 insta">
                <img src="<?=$shotOfTheDayResults->data->images->standard_resolution->url?>" alt="<?=$shotOfTheDayResults->data->caption->text?>" />
                <a href="<?=$instagramCommentURL?>?media_id=<?=$shotOfTheDayResults->data->id?>" data-reveal-ajax="true" class="comments reveal-init" data-size="<?=$instagramCommentOverlaySize?>" data-mediaId="<?=$shotOfTheDayResults->data->id?>" role="button"><span><?=$shotOfTheDayResults->data->comments->count?></span></a>
                <a href="<?=$instagramLikeURL?>" data-url="<?=$likeURL?>" class="likes<?=$userLikedClass?>" title="<?=$likeText?>" data-mediaId="<?=$shotOfTheDayResults->data->id?>" role="button"<?=$instagramLikeOverlaySettings?>><span data-mediaId="<?=$shotOfTheDayResults->data->id?>" data-likesCount="<?=$shotOfTheDayResults->data->likes->count?>" data-displayCount><?=likeNumberFormatter($shotOfTheDayResults->data->likes->count)?></span></a>
                <div class="infoContainer">
                    <div class="inner">

                                <?php
                                if (property_exists($shotOfTheDayResults->data,'location'))
                                {
                                    if (is_null($shotOfTheDayResults->data->location) || $shotOfTheDayResults->data->location == null)
                                    {
                                        echo '<span class="location">&nbsp;</span>';
                                    }

                                    else if (property_exists($shotOfTheDayResults->data->location,'name'))
                                    {
                                        echo '<span class="location">'.$shotOfTheDayResults->data->location->name.'</span>';
                                    }
                                    else if (property_exists($shotOfTheDayResults->data->location,'latitude') && property_exists($shotOfTheDayResults->data->location,'longitude') && !property_exists($shotOfTheDayResults->data->location,'name'))
                                    {
                                        echo '<span class="location raw">'.$shotOfTheDayResults->data->location->latitude . ' ,'. $shotOfTheDayResults->data->location->longitude.'</span>';
                                    }

                                }
                                else
                                {
                                    echo '<span class="location">&nbsp;</span>';
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
        $post = $instagramResults->data;

        $breakCount = 4;

        for ($i = 0; $i < $breakCount; $i++) {

            if ($instagramUserLoggedIn)
            {
                $blnUserLiked = $post[$i]->user_has_liked;

                if (isset($blnUserLiked))
                {
                    if ($blnUserLiked) {
                        $userLikedClass = ' userLikes';
                        $likeURL = 'services/instagram-unlike-media.php?media_id='.$post[$i]->id;
                        $likeText = 'You like this media - click to unlike.';
                    }
                    else
                    {
                        $userLikedClass = ' userNoLikes';
                        $likeURL = 'services/instagram-like-media.php?media_id='.$post[$i]->id;
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
                    <img src="<?=$post[$i]->images->low_resolution->url?>" alt="<?=$post[$i]->caption->text?>" />
                    <a href="<?=$instagramCommentURL?>?media_id=<?=$post[$i]->id?>" class="comments reveal-init" data-size="<?=$instagramCommentOverlaySize?>" data-mediaId="<?=$post[$i]->id?>" role="button"><span><?=$post[$i]->comments->count?></span></a>
                    <a href="<?=$instagramLikeURL?>" data-url="<?=$likeURL?>" class="likes<?=$userLikedClass?>" title="<?=$likeText?>" data-mediaId="<?=$post[$i]->id?>" role="button"<?=$instagramLikeOverlaySettings?>><span data-mediaId="<?=$post[$i]->id?>" data-likesCount="<?=$post[$i]->likes->count?>" data-displayCount><?=likeNumberFormatter($post[$i]->likes->count)?></span></a>
                    <div class="infoContainer">
                        <div class="inner">
                            <?php
                            //var_dump($post);
                            if (property_exists($post[$i],'location'))
                            {
                                if (is_null($post[$i]->location) || $post[$i]->location == null)
                                {
                                    echo '<span class="location">&nbsp;</span>';
                                }

                                else if (property_exists($post[$i]->location,'name'))
                                {
                                    echo '<span class="location">'.$post[$i]->location->name.'</span>';
                                }
                                else if (property_exists($post[$i]->location,'latitude') && property_exists($post[$i]->location,'longitude') && !property_exists($post[$i]->location,'name'))
                                {
                                    echo '<span class="location raw">'.$post[$i]->location->latitude . ' ,'. $post[$i]->location->longitude.'</span>';
                                }

                            }
                            else
                            {
                                echo '<span class="location">&nbsp;</span>';
                            }
                            ?>
                            <span class="credit"><?=$post[$i]->user->username?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php

            //$count++;
            if ($i == $breakCount) {
                break;
            }
        }
    }
    else {


        echo '<div class="systemError">';
        echo '<h2>Error:</h2>';
        echo '<p><strong>Type:</strong> '.$instagramResults->error_type.'</p>';
        echo '<p><strong>Msg:</strong> '.$instagramResults->error_message.'</p>';
        echo '<p><strong>URL:</strong> '.$_SERVER['REQUEST_URI'].'</p>';
        echo '</div>';
    }

    ?>

    </div>
</section>

<section id="featuredPhotographer" class="featurePhotographerHolder standardLightGrey">
    <div class="row paddingBottom40">
        <div class="large-12 columns marginTop40">
            <h3 class="text-center" style="margin-bottom: 0">Featured Photographer</h3>
        </div>


            <div class="small-6 large-6 columns left">
                <div class="large-12 small-12 insta">
                    <img src="<?=$baseURL?>/img/featuredPhotographer/medium/shelley-beach.jpg" alt="Ocean Scene" />

                    <div class="infoContainer">
                        <div class="inner">
                            <span class="location">Shelly Beach</span>
                            <span class="credit">Joel Coleman</span>
                        </div>
                    </div>
                </div>
            </div>



            <div class="small-3 large-3 columns">
                <div class="small-12 large-12 insta">
                    <img src="<?=$baseURL?>/img/featuredPhotographer/small/surfboards.jpg" alt="Ocean Scene" />
                    <div class="infoContainer">
                        <div class="inner">
                            <span class="location">Manly</span>
                            <span class="credit">Joel Coleman</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="small-3 large-3 columns">
                <div class="small-12 large-12 insta">
                    <img src="<?=$baseURL?>/img/featuredPhotographer/small/water1.jpg" alt="Ocean Scene" />
                    <div class="infoContainer">
                        <div class="inner">
                            <span class="location">Sydney Harbour</span>
                            <span class="credit">Joel Coleman</span>
                        </div>
                    </div>
                </div>
            </div>



            <div class="small-3 large-3 columns">
                <div class="small-12 large-12 insta">
                    <img src="<?=$baseURL?>/img/featuredPhotographer/small/splash.jpg" alt="Ocean Scene" />
                    <div class="infoContainer">
                        <div class="inner">
                            <span class="location">Manly Beach</span>
                            <span class="credit">Joel Coleman</span>
                        </div>
                    </div>
                </div>
            </div>



            <div class="small-3 large-3 columns">
                <div class="small-12 large-12 insta">
                    <img src="<?=$baseURL?>/img/featuredPhotographer/small/dolphin.jpg" alt="Ocean Scene" />
                    <div class="infoContainer">
                        <div class="inner">
                            <span class="location">Sydney Harbour</span>
                            <span class="credit">Joel Coleman</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>


</section>




<section class="photoSection marginBottomStandard">



<div id="photoHolder02" class="row galleryHolder">

<?php


if ($instagramResults->meta->code == 200)
{


    for ($i = $breakCount; $i < count($post); $i++) {

        if ($instagramUserLoggedIn)
        {
            $blnUserLiked = $post[$i]->user_has_liked;

            if (isset($blnUserLiked))
            {
                if ($blnUserLiked) {
                    $userLikedClass = ' userLikes';
                    $likeURL = 'services/instagram-unlike-media.php?media_id='.$post[$i]->id;
                    $likeText = 'You like this media - click to unlike.';
                }
                else
                {
                    $userLikedClass = ' userNoLikes';
                    $likeURL = 'services/instagram-like-media.php?media_id='.$post[$i]->id;
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
                <img src="<?=$post[$i]->images->low_resolution->url?>" alt="<?=$post[$i]->caption->text?>" />
                <a href="<?=$instagramCommentURL?>?media_id=<?=$post[$i]->id?>" class="comments reveal-init" data-size="<?=$instagramCommentOverlaySize?>" data-mediaId="<?=$post[$i]->id?>" role="button"><span><?=$post[$i]->comments->count?></span></a>
                <a href="<?=$instagramLikeURL?>" data-url="<?=$likeURL?>" class="likes<?=$userLikedClass?>" title="<?=$likeText?>" data-mediaId="<?=$post[$i]->id?>" role="button"<?=$instagramLikeOverlaySettings?>><span data-mediaId="<?=$post[$i]->id?>" data-likesCount="<?=$post[$i]->likes->count?>" data-displayCount><?=likeNumberFormatter($post[$i]->likes->count)?></span></a>
                <div class="infoContainer">
                    <div class="inner">
                        <?php
                        if (property_exists($post[$i],'location'))
                        {
                            if (is_null($post[$i]->location) || $post[$i]->location == null)
                            {
                                echo '<span class="location">&nbsp;</span>';
                            }

                            else if (property_exists($post[$i]->location,'name'))
                            {
                                echo '<span class="location">'.$post[$i]->location->name.'</span>';
                            }
                            else if (property_exists($post[$i]->location,'latitude') && property_exists($post[$i]->location,'longitude') && !property_exists($post[$i]->location,'name'))
                            {
                                echo '<span class="location raw">'.$post[$i]->location->latitude . ' ,'. $post[$i]->location->longitude.'</span>';
                            }

                        }
                        else
                        {
                            echo '<span class="location">&nbsp;</span>';
                        }
                        ?>
                        <span class="credit"><?=$post[$i]->user->username?></span>
                    </div>
                </div>
            </div>
        </div>

        <?php


    }
}
else {

    echo '<div class="systemError">';
    echo '<h2>Error:</h2>';
    echo '<p><strong>Type:</strong> '.$instagramResults->error_type.'</p>';
    echo '<p><strong>Msg:</strong> '.$instagramResults->error_message.'</p>';
    echo '<p><strong>URL:</strong> '.$_SERVER['REQUEST_URI'].'</p>';
    echo '</div>';
}

?>


</div>


<div class="row marginTop40">
    <div class="large-12 text-center">
        <a href="#" class="button">Load More</a>
    </div>

</div>
</section>






<?php
include 'includes/footer.php';
?>


<?php
$pageId = 4;
include 'includes/global-js.php';
?>


<?php
include 'includes/analytics.php';
?>

<script>
$(function(){

    /* TODO get location function working
    $('.location.raw').each(function(i) {
        var latLng = $(this).text().toString();
        //console.log('['+latLng+']');
        latLng = latLng.split(',');
        var lat = latLng[0].toString().trim();
        var lng = latLng[1].toString().trim();
        //console.log('lat: ['+lat + ']lng: [' + lng + ']');

        var latlng = new google.maps.LatLng(lat, lng);
        var geocoder = new google.maps.Geocoder();
        var address = '';

        geocoder.geocode({ 'latLng': latlng }, function (results, status) {
            if (status !== google.maps.GeocoderStatus.OK) {
                //console.log(status);
                address = '';
            }
            // This is checking to see if the Geoeode Status is OK before proceeding
            if (status == google.maps.GeocoderStatus.OK) {
                // console.log('results['+results+']');
                //address = (results[0].formatted_address);
                var suburb = results[0].address_components[2].long_name + ', ';
                var state = results[0].address_components[3].short_name + ' ';
                var postcode = results[0].address_components[5].long_name;
                address = suburb + state + postcode;

                //console.log('address inside['+address+']');
            }

        });

        console.log('address['+address+']')
    });*/


});
</script>
    </body>
</html>