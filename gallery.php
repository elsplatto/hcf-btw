<?php
$pageMetaTitle = "Beyond the Wharf - Gallery.";
$pageSection = "gallery";
$pageMetaDesc = "Submit, share and view your photos of Sydney Harbour.";
include 'includes/head.php';
/*global includes in head.php*/


$targetStr = '/gallery/';

$targetPos = strpos($_SERVER['REQUEST_URI'],$targetStr);


if ($targetPos >= 0)
{
    $media_id = substr($_SERVER['REQUEST_URI'],$targetPos+strlen($targetStr));
    //echo '<br /><br /><br /><br /><br />['.$targetPos.']';
    //echo '<br />$media_id['.$media_id.']';
    if (strlen($media_id > 0))
    {
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


        $sharedPhoto = $instagram->getMedia($media_id, $tokenSet);
    }
}

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

$galleryHeaderClass = '';

if (isset($sharedPhoto))
{
    $galleryHeaderClass = ' standardLightGrey';
}

?>

<section class="breadcrumbsHolder">
    <div class="row">
        <div class="large-12 columns breadcrumbs">
            <a href="<?=$baseURL?>/">Home</a><span>Gallery</span>
        </div>
    </div>
</section>

<section class="photoSection<?=$galleryHeaderClass?>">

    <div class="row paddingTop20">
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

</section>


    <?php

    $callbackURL = $baseURL.'/gallery';

    if (isset($sharedPhoto))
    {
        if ($instagramUserLoggedIn)
        {
            $instagramCommentURL = $baseURL . '/overlays/instagram-comment.php';
            $instagramCommentOverlaySize = 'large';
            $instagramLikeURL = '#';
            $instagramLikeOverlaySettings = '';
            $userLikedClass = '';
        } else {

            $callbackURL = $callbackURL .'/'. $media_id;
            $instagramCommentURL = $baseURL . '/overlays/instagram-login.php?call_page='.$callbackURL;
            $instagramCommentOverlaySize = 'small';
            $instagramLikeURL = $baseURL . '/overlays/instagram-login.php?call_page='.$callbackURL;
            $instagramLikeOverlaySettings = ' data-reveal-ajax="true"';
            $userLikedClass = ' reveal-init';
        }

        if ($sharedPhoto->meta->code == 200)
        {

            if ($instagramUserLoggedIn)
            {
                $blnUserLiked = $sharedPhoto->data->user_has_liked;
                if (isset($blnUserLiked))
                {
                    if ($blnUserLiked) {
                        $userLikedClass = ' userLikes';
                        $likeURL = $baseURL . '/services/instagram-unlike-media.php?media_id='.$sharedPhoto->data->id;
                        $likeText = 'You like this media - click to unlike.';
                    }
                    else
                    {
                        $userLikedClass = ' userNoLikes';
                        $likeURL = $baseURL . '/services/instagram-like-media.php?media_id='.$sharedPhoto->data->id;
                        $likeText = 'Click to like.';
                    }

                }
            }
            else
            {
                $likeURL = $baseURL . '/overlays/instagram-login.php?call_page='.$callbackURL;
                $likeText = 'You are not logged in. Log in to like.';
            }
            ?>
            <section class="photoSection marginBottomStandard standardLightGrey paddingBottom20">
                <div class="row galleryHolder marginBottomStandard">
                    <div class="small-12 large-offset-3 large-6 medium-6 columns">
                        <h3 class="text-center"><?=$sharedPhoto->data->user->username?>'s photo</h3>
                        <div class="large-12 medium-12 small-12 insta sharedPhoto">
                            <img src="<?=$sharedPhoto->data->images->standard_resolution->url?>" alt="<?=$sharedPhoto->data->caption->text?>" />
                            <a href="<?=$instagramCommentURL?>?media_id=<?=$sharedPhoto->data->id?>" data-reveal-ajax="true" class="comments reveal-init" data-size="<?=$instagramCommentOverlaySize?>" data-mediaId="<?=$sharedPhoto->data->id?>" role="button"><span><?=$sharedPhoto->data->comments->count?></span></a>
                            <a href="<?=$instagramLikeURL?>" data-url="<?=$likeURL?>" class="likes<?=$userLikedClass?>" title="<?=$likeText?>" data-mediaId="<?=$sharedPhoto->data->id?>" role="button"<?=$instagramLikeOverlaySettings?>><span data-mediaId="<?=$sharedPhoto->data->id?>" data-likesCount="<?=$sharedPhoto->data->likes->count?>" data-displayCount><?=likeNumberFormatter($sharedPhoto->data->likes->count)?></span></a>
                            <div class="infoContainer">
                                <div class="inner">

                                    <?php
                                    if (property_exists($sharedPhoto->data,'location'))
                                    {
                                        if (is_null($sharedPhoto->data->location) || $sharedPhoto->data->location == null)
                                        {
                                            echo '<span class="location">&nbsp;</span>';
                                        }

                                        else if (property_exists($sharedPhoto->data->location,'name'))
                                        {
                                            echo '<span class="location">'.$sharedPhoto->data->location->name.'</span>';
                                        }
                                        else if (property_exists($sharedPhoto->data->location,'latitude') && property_exists($sharedPhoto->data->location,'longitude') && !property_exists($sharedPhoto->data->location,'name'))
                                        {
                                            echo '<span class="location raw">'.$sharedPhoto->data->location->latitude . ' ,'. $sharedPhoto->data->location->longitude.'</span>';
                                        }

                                    }
                                    else
                                    {
                                        echo '<span class="location">&nbsp;</span>';
                                    }
                                    ?>
                                    <span class="credit"><?=$sharedPhoto->data->user->username?></span>

                                    <a href="https://twitter.com/share?url=<?=$baseURL?>/gallery/<?=$sharedPhoto->data->id?>&text=Check out shot of the day&hashtag=beyondthewharf&count=none" class="twitter-share-button gallery-tweet" data-lang="en">Tweet</a>
                                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php
        }

    }?>


<section class="photoSection marginBottomStandard">

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
        $instagramCommentURL = $baseURL . '/overlays/instagram-comment.php';
        $instagramCommentOverlaySize = 'large';
        $instagramLikeURL = '#';
        $instagramLikeOverlaySettings = '';
        $userLikedClass = '';
    } else {
        $instagramCommentURL = $baseURL . '/overlays/instagram-login.php?call_page='.$callbackURL;
        $instagramCommentOverlaySize = 'small';
        $instagramLikeURL = $baseURL . '/overlays/instagram-login.php?call_page='.$callbackURL;
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
                    $likeURL = $baseURL . '/services/instagram-unlike-media.php?media_id='.$shotOfTheDayResults->data->id;
                    $likeText = 'You like this media - click to unlike.';
                }
                else
                {
                    $userLikedClass = ' userNoLikes';
                    $likeURL = $baseURL . '/services/instagram-like-media.php?media_id='.$shotOfTheDayResults->data->id;
                    $likeText = 'Click to like.';
                }

            }
        }
        else
        {
            $likeURL = $baseURL . '/overlays/instagram-login.php?call_page='.$callbackURL;
            $likeText = 'You are not logged in. Log in to like.';
        }
        ?>

        <div class="small-12 large-6 medium-6 columns right">
            <div class="large-12 medium-12 small-12 insta">
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
                        <span class="credit"><?=$shotOfTheDayResults->data->user->username?></span>

                        <a href="https://twitter.com/share?url=<?=$baseURL?>/gallery/<?=$shotOfTheDayResults->data->id?>&text=Check out shot of the day&hashtag=beyondthewharf&count=none" class="twitter-share-button shot-of-day-tweet" data-lang="en">Tweet</a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

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
                        $likeURL = $baseURL . '/services/instagram-unlike-media.php?media_id='.$post[$i]->id;
                        $likeText = 'You like this media - click to unlike.';
                    }
                    else
                    {
                        $userLikedClass = ' userNoLikes';
                        $likeURL = $baseURL . '/services/instagram-like-media.php?media_id='.$post[$i]->id;
                        $likeText = 'Click to like.';
                    }

                }
            }
            else
            {
                $likeURL = $baseURL . '/overlays/instagram-login.php?call_page='.$callbackURL;
                $likeText = 'You are not logged in. Log in to like.';
            }
            ?>

            <div class="small-6 medium-3 large-3 columns">
                <div class="small-12 medium-12 large-12 insta">
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
                            <a href="https://twitter.com/share?url=<?=$baseURL?>/gallery/<?=$post[$i]->id?>&text=Check out shot of the day&hashtag=beyondthewharf&count=none" class="twitter-share-button gallery-tweet" data-lang="en">Tweet</a>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

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
            <h3 class="text-center" style="margin-bottom: 0">Featured Photographer - Joel Coleman (Saltmotion)</h3>
            <h4 class="text-center">Visit <a href="http://saltmotion.com" target="_blank" rel="nofollow" class="underline">Saltmotion</a></h4>
        </div>


            <div class="small-12 medium-6 large-6 columns left">
                <div class="large-12 medium-12 small-12 insta">
                    <img src="<?=$baseURL?>/img/featuredPhotographer/medium/shelley-beach.jpg" alt="Ocean Scene" />

                    <div class="infoContainer">
                        <div class="inner">
                            <span class="location">Shelly Beach</span>
                            <span class="credit">Joel Coleman</span>
                        </div>
                    </div>
                </div>
            </div>



            <div class="small-6 medium-3 large-3 columns">
                <div class="small-12 medium-12 medium-12 large-12 insta">
                    <img src="<?=$baseURL?>/img/featuredPhotographer/small/surfboards.jpg" alt="Ocean Scene" />
                    <div class="infoContainer">
                        <div class="inner">
                            <span class="location">Manly</span>
                            <span class="credit">Joel Coleman</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="small-6 medium-3 large-3 columns">
                <div class="small-12 medium-12 large-12 insta">
                    <img src="<?=$baseURL?>/img/featuredPhotographer/small/water1.jpg" alt="Ocean Scene" />
                    <div class="infoContainer">
                        <div class="inner">
                            <span class="location">Sydney Harbour</span>
                            <span class="credit">Joel Coleman</span>
                        </div>
                    </div>
                </div>
            </div>



            <div class="small-6 medium-3 large-3 columns">
                <div class="small-12 medium-12 large-12 insta">
                    <img src="<?=$baseURL?>/img/featuredPhotographer/small/splash.jpg" alt="Ocean Scene" />
                    <div class="infoContainer">
                        <div class="inner">
                            <span class="location">Manly Beach</span>
                            <span class="credit">Joel Coleman</span>
                        </div>
                    </div>
                </div>
            </div>



            <div class="small-6 medium-3 large-3 columns">
                <div class="small-12 medium-12 large-12 insta">
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
                        $likeURL = $baseURL . '/services/instagram-unlike-media.php?media_id='.$post[$i]->id;
                        $likeText = 'You like this media - click to unlike.';
                    }
                    else
                    {
                        $userLikedClass = ' userNoLikes';
                        $likeURL = $baseURL . '/services/instagram-like-media.php?media_id='.$post[$i]->id;
                        $likeText = 'Click to like.';
                    }

                }
            }
            else
            {
                $likeURL = $baseURL . '/overlays/instagram-login.php?call_page='.$callbackURL;
                $likeText = 'You are not logged in. Log in to like.';
            }
            ?>

            <div class="small-6 medium-3 large-3 columns">
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
                            <a href="https://twitter.com/share?url=<?=$baseURL?>/gallery/<?=$post[$i]->id?>&text=Check this photo out&hashtag=beyondthewharf&count=none" class="twitter-share-button gallery-tweet" data-lang="en">Tweet</a>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

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
            <a href="<?=$baseURL?>/services/instagram-load-more.php" id="btnLoadMoreInstagram" class="button" data-maxId="<?=$instagramResults->pagination->next_max_id?>" data-instgramUserLoggedIn="<?=$instagramUserLoggedIn?>">Load More</a>
        </div>
    </div>
</section>






<?php
include 'includes/footer.php';
?>


<?php
$pageId = 4;
include 'includes/global-js.php';
include 'includes/instagram-js.php';
?>


<?php
include 'includes/analytics.php';
?>

<script>
$(function(){

    $('body').on( 'click', '#btnLoadMoreInstagram', function(e){
        e.preventDefault();
        var maxId = $(this).attr('data-maxId');
        //console.log('['+maxId+']');
        var url = $(this).attr('href');
        var el = $(this);
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                max_id: maxId
            },
            dataType: 'json',
            cache: false,
            beforeSend: function()
            {
                beforeLoadMoreHandler(el);
            },
            success: function(data) {
                successLoadMoreHandler(data, el);
            },
            error: function(data) {
                //console.log('failed');
                //console.dir(data);
            },
            complete: function(data)
            {
                completeLoadMoreHandler(data, el);
            }

        });
    });

    function beforeLoadMoreHandler(el)
    {
        el.html('<div id="loadMoreLoader"></div>');
        var cl = new CanvasLoader('loadMoreLoader');
        cl.setColor('#ffffff');
        cl.setShape('square'); // default is 'oval'
        cl.setDiameter(25); // default is 40
        cl.setDensity(90); // default is 40
        cl.setRange(1); // default is 1.3
        cl.setSpeed(3); // default is 2
        cl.setFPS(24); // default is 24
        cl.show(); // Hidden by default
    }

    function successLoadMoreHandler(data, el)
    {
        var dataObj = data.data;
        var paginationObj = data.pagination;
        var loadHTML = '';

        var isUserLoggedIn = el.attr('data-instgramUserLoggedIn');

        var instagramCommentURL = '<?=$baseURL?>/overlays/instagram-login.php?call_page=<?=$callbackURL?>';
        var instagramLikeURL = '<?=$baseURL?>/overlays/instagram-login.php?call_page=<?=$callbackURL?>';
        var likeRevealInitClass = ' reveal-init';

        if (isUserLoggedIn > 0)
        {
            instagramCommentURL = '<?=$baseURL?>/overlays/instagram-comment.php';
            likeRevealInitClass = '';
        }
        var blnUserHasLiked = false;
        var userLikedClass = '';
        var likeText = 'Click to like';

        for (var i=0; i<dataObj.length;i++)
        {
            loadHTML += '<div class="small-6 medium-3 large-3 columns">';
            loadHTML += '<div class="small-12 large-12 insta">';
            loadHTML += '<img src="'+dataObj[i].images.low_resolution.url+'" alt="'+dataObj[i].caption.text+'" />';

            loadHTML += '<a href="'+instagramCommentURL+'?media_id='+dataObj[i].id+'" class="comments reveal-init" data-size="medium" data-mediaId="'+dataObj[i].id+'" role="button"><span>'+dataObj[i].comments.count+'</span></a>';


            if (dataObj[i].hasOwnProperty('user_has_liked'))
            {
                blnUserHasLiked = dataObj[i].user_has_liked;
            }

            if (isUserLoggedIn > 0)
            {
                if (blnUserHasLiked)
                {
                    instagramLikeURL = '<?=$baseURL?>/services/instagram-unlike-media.php?media_id='+dataObj[i].id;
                    userLikedClass = ' userLikes';
                    likeText = 'Click to unlike';

                }
                else if (!blnUserHasLiked)
                {
                    instagramLikeURL = '<?=$baseURL?>/services/instagram-like-media.php?media_id='+dataObj[i].id;
                    userLikedClass = ' userNoLikes';
                    likeText = 'Click to like';
                }
            }

            loadHTML += '<a href="'+instagramLikeURL+'" class="likes'+userLikedClass + likeRevealInitClass+'" title="'+likeText+'" data-mediaId="'+dataObj[i].id+'" role="button">';
            loadHTML += '<span data-mediaId="'+dataObj[i].id+'" data-likesCount="'+dataObj[i].likes.count+'" data-displayCount>'+dataObj[i].likes.count+'</span></a>';

            loadHTML += '<div class="infoContainer">';
            loadHTML += '<div class="inner">';
            if (dataObj[i].hasOwnProperty('location'))
            {
                if (dataObj[i].location == null)
                {
                    loadHTML += '<span class="location">&nbsp;</span>';
                }

                else if (dataObj[i].location.hasOwnProperty('name'))
                {
                    loadHTML += '<span class="location">'+dataObj[i].location.name+'</span>';
                }
                else if (dataObj[i].location.hasOwnProperty('latitude') && dataObj[i].location.hasOwnProperty('longitude'))
                {
                    loadHTML += '<span class="location raw">'+dataObj[i].location.latitude+' ,'+dataObj[i].location.longitude+'</span>';
                }

            }
            else
            {
                loadHTML += '<span class="location">&nbsp;</span>';
            }
            loadHTML += '<span class="credit">'+dataObj[i].user.username+'</span>';
            loadHTML += '<a href="https://twitter.com/share?url=<?=$baseURL?>/gallery/'+dataObj[i].id+'&text=Check this photo out&hashtag=beyondthewharf&count=none" class="twitter-share-button gallery-tweet" data-lang="en">Tweet</a>';

            loadHTML += '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");<\/script>';

            loadHTML += '</div>';
            loadHTML += '</div>';


            loadHTML += '</div>';
            loadHTML += '</div>';
            $('#photoHolder02').append(loadHTML);
            loadHTML = '';
        }


        //ok - now let's see if we have more images sitting on instagram - adjust the button if we don't
        if (paginationObj.next_max_tag_id != 'undefined' && paginationObj.next_max_tag_id != undefined)
        {
            el.attr('data-maxId',paginationObj.next_max_tag_id);
            el.html('');
            el.text('Load More');
        }
        else
        {
            el.attr('data-maxId','');
            el.attr('disabled','disabled');
            el.removeAttr('href');
            el.html('');
            el.text('All photos have been fetched');
            $('body').off( 'click', '#btnLoadMoreInstagram');
        }
    }

    function completeLoadMoreHandler(data, el)
    {
        //load twitter widgets
        twttr.widgets.load()
    }

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