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
?>
<section class="featureImgHolder marginBottomStandard">
    <img src="img/featureImages/harbourPano-2.jpg" />
    <div class="headerHolder">
        <h2 class="sub">Secrets</h2>
        <h2>Beyond the Wharf</h2>
        <hr />
        <h3>Discover. Share. Contribute.</h3>
    </div>
    <a href="#" id="creditToggle" data-target="featureCreditPanel" class="triggerContainer" title="Click here for photo credits">
        <div class="flip-container">
            <div class="flipper">
                <div class="cameraIcon"></div>
                <div class="closeIcon"></div>
            </div>
        </div>
    </a>
    <div id="featureCreditPanel" class="creditPanel">
        <span class="latLng">33.8368 S, 151.2811 E</span>
        <span class="location">MINER'S POINT</span>
        <span class="routes darling">Darling Harbour</span>
        <span class="credit">Photo by David Jones</span>
        <span><a href="#" target="_blank" rel="nofollow">Visit David's Gallery</a></span>
    </div>
    <section class="promoHolder">
        <div class="row">
            <div class="large-12">
                <div class="large-3 columns">
                    <div class="imgHolder social instagram">
                        <a href="#" title="Click to follow us on Instagram"></a>
                    </div>
                    <div class="textHolder">
                        <a href="#" class="button" title="Click to follow us on Instagram">Follow Us</a>
                    </div>
                </div>

                <div class="large-3 columns">
                    <div class="imgHolder">
                        <a href="#"><img src="img/promoImages/promo1.jpg" alt="Image of fireworks over Sydney Opera House on New Years Eve" /></a>
                    </div>
                    <div class="textHolder">
                        <span>On the Harbour</span>
                        <h5><a href="#">Event Diary</a></h5>
                        <a href="#" class="directive">Read More</a>
                    </div>
                </div>

                <div class="large-3 columns">
                    <div class="imgHolder">
                        <a href="#"><img src="img/promoImages/promo2.jpg" alt="Image of Musicians" /></a>
                    </div>
                    <div class="textHolder">
                       <span>Promotion</span>
                        <h5><a href="#">Music on the Boat</a></h5>
                        <a href="#" class="directive">Read More</a>
                    </div>
                </div>

                <div class="large-3 columns">
                    <div class="imgHolder">
                        <a href="#"><img src="img/promoImages/promo3.jpg" alt="" /></a>
                    </div>
                    <div class="textHolder">
                       <span>Beyond the Wharf</span>
                        <h5><a href="#">Foodies Guide</a></h5>
                        <a href="#" class="directive">Read More</a>
                    </div>
                </div>


            </div>
        </div>
    </section>
</section>

<section class="themeFeature">
    <div class="row marginBottomStandard">
        <h3 class="text-center">Explore our harbour through the eyes of locals</h3>
        <div class="large-12 columns">

            <div class="large-6 themedPromoText standardDarkGrey left">
                <span>The Mariner</span>
                <h3 class="block">Sydney Harbour History</h3>
                <a href="#" class="button wire white">Read the Article</a>
                <p>
                    Our harbour history told by Andrew Callager. A tale of explorers, settlers, invaders, soldiers, merchant ships, pirates and stowaways.
                </p>
                <img src="img/themedPromos/profile.jpg" class="profile" alt="Picture of Andrew Callager." />
                <p>Andrew Callager</p>
                <span class="purple">Master Sailor, Queenscliff</span>
            </div>
            <div class="large-6 themedPromoImage">
                <img src="img/themedPromos/sailor.jpg" alt="Image of salty old captain." />
                <div class="large-6 themedPromoOverlay">
                    <a href="#" class="button red play tungsten small">Watch the video</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mapHolder standardLightGrey paddingTopBottom20">
  <div class="row marginBottomStandard">
      <h3 class="text-center">Find a Journey</h3>
      <div class="large-12 columns" id="mapContainer">

        <div class="large-12" id="map-canvas"></div>
          <a href="#" id="toggleMapControlPanel" class="toggleControlPanel">&gt;</a>

          <div id="mapControlPanelHolder" class="controlPanelHolder large-3">
              <div id="mapControlPanel" class="controlPanel">
                <h6 class="white">FILTER:</h6>

                  <ul>
                  <?php
                  $filters = getFilters(1, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
                  for ($i = 0; $i < count($filters); $i++)

                  //foreach ($filters as $filter)
                  {

                  ?>
                      <li><a href="#" class="mapFilter" data-category="<?=$filters[$i]?>" data-visible="true"><span><span></span></span><?=$filters[$i]?></a></li>
                  <?php
                  }
                  ?>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</section>

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

<?php
include 'includes/footer.php';
?>

<div id="modalShell" class="reveal-modal <?=$instagramCommentOverlaySize?>" data-reveal="">

</div>









<?php
$relPath = '';
$pageId = 1;
include 'includes/global-js.php';
include 'includes/map-code.php';
?>
<script>

$(function() {

    if ($('#creditToggle').length > 0)
    {
        $('#creditToggle').animate({
            right: 0,
            easing: 'easeOut'
        }, 200);
    }

    $('body').on('click', '#creditToggle', function(e)
    {
        e.preventDefault();
        var target = $('#'+$(this).attr('data-target'));
        var targetLeft = target.offset().left;
        var targetWidth = target.outerWidth();
        var windowWidth = $(document).width();
        if (targetLeft >= windowWidth)
        {
            target.animate({
                left: windowWidth - targetWidth
            });
            $(this).addClass('flip');
        }else{
            target.animate({
                left: windowWidth + targetWidth
            });
            $(this).removeClass('flip');
        }
    });

    $('body').on('click','a.userLikes', function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        var el = $(this);
        $.ajax({
            type: 'POST',
            url: url,
            beforeSend: function()
            {
                beforeLikeSendHandler(el);
            },
            success: function(data)
            {
                unLikeSuccessHandler(data);
            }
        });
    });

    $('body').on('click','a.userNoLikes', function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        var el = $(this);
        $.ajax({
            type: 'POST',
            url: url,
            beforeSend: function()
            {
                beforeLikeSendHandler(el);
            },
            success: function(data)
            {
                likeSuccessHandler(data);
            }
        });
    });

    function beforeLikeSendHandler(el) {
        var mediaId = el.attr('data-mediaId');
        var triggerLikesCount = el.attr('data-likesCount');

        if (el.hasClass('userNoLikes'))
        {
            //console.log('you clicked to like');
            //switch urls
            el.attr('data-url','<?=$mediaUnLikeURL?>?media_id='+mediaId);

            //change classes on heart icon
            $('.userNoLikes[data-mediaId="'+mediaId+'"]').each(function(i){
                $(this).removeClass('userNoLikes').addClass('userLikes');
            });

            //update count data and text
            $('[data-mediaId="'+mediaId+'"][data-likesCount]').each(function(i){
                var newCount = parseInt('0'+$(this).attr('data-likesCount'))+1;
                var newCountText = likeNumberFormatter(newCount);

                $(this).attr('data-likesCount',newCount);

                var hasAttr = $(this).attr('data-displayCount');

                if (typeof hasAttr !== 'undefined' && hasAttr !== false)
                {
                    $(this).text(newCountText);
                }
            });

            $('p.commentsShoutout').each(function(i) {
                var existingHTML = $(this).html();
                if ($(this).text().toLowerCase().trim() == '')
                {
                    $(this).html('<a href="http://instagram.com/<?=$instagramUsername?>" target="_blank">You</a> like this.');
                }
                else if (parseInt('0'+triggerLikesCount) == 1)
                {
                    $(this).html('<a href="http://instagram.com/<?=$instagramUsername?>" target="_blank">You</a> and '+ existingHTML);
                }
                else if (parseInt('0'+triggerLikesCount) > 1)
                {
                    $(this).html('<a href="http://instagram.com/<?=$instagramUsername?>" target="_blank">You</a>, '+ existingHTML);
                }

            });

        }
        else
        {
            //console.log('you clicked to unlike');
            //switch urls
            el.attr('data-url','<?=$mediaLikeURL?>?media_id='+mediaId);

            $('.userLikes[data-mediaId="'+mediaId+'"]').each(function(i){
                $(this).removeClass('userLikes').addClass('userNoLikes');
            });
            $('[data-mediaId="'+mediaId+'"][data-likesCount]').each(function(i){
                var newCount = parseInt('0'+$(this).attr('data-likesCount'))-1;
                var newCountText = likeNumberFormatter(newCount);

                $(this).attr('data-likesCount',newCount);

                var hasAttr = $(this).attr('data-displayCount');

                if (typeof hasAttr !== 'undefined' && hasAttr !== false)
                {
                    $(this).text(newCountText);
                }
            });

            //@TODO: fix you text removal
            $('p.commentsShoutout').each(function(i) {
                //console.log('['+$(this).text().toLowerCase().trim()+']');
                var existingHTML = $(this).html();
                $(this).css({
                    outline: '1px solid red'
                });
                $(this).remove('.youText');
            });
        }
    }

    function unLikeSuccessHandler(data){
        var obj = JSON.parse(data);

        if (obj.hasOwnProperty('meta'))
        {
            if (obj.meta.code === 200)
            {
                //console.log('unlike server response successful');
            }
            else
            {

                //console.log('unlike server response error');
                //console.dir(obj);
            }
        }
    }

    function likeSuccessHandler(data){
        var obj = JSON.parse(data);

        if (obj.hasOwnProperty('meta'))
        {
            if (obj.meta.code === 200)
            {
                //console.log('like server response successful');
            }
            else
            {
                //console.log('like server response error');
                //console.dir(obj);
            }
        }
    }

    function isJson(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }

});
</script>

<?php
include 'includes/analytics.php';
?>
</body>
</html>
