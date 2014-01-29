<?php
include 'includes/head.php';
include 'includes/nav.php';
?>
<body>
<script type="text/javascript">
function initialize() {
    var mapOptions = {
        center: new google.maps.LatLng(-33.830088, 151.226978),
        zoom: 13,
        mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.TERRAIN, 'map_style'],
            position: google.maps.ControlPosition.BOTTOM_CENTER
        }
    };
    var map = new google.maps.Map(document.getElementById("map-canvas"),
        mapOptions);

    var manlyTripCoords = [
        new google.maps.LatLng(-33.860616,151.21155),
        new google.maps.LatLng(-33.854933,151.21346),
        new google.maps.LatLng(-33.854987,151.247149),
        new google.maps.LatLng(-33.824475,151.275301),
        new google.maps.LatLng(-33.800514,151.283884)
    ];

    var parramattaTripCoords = [
        new google.maps.LatLng(-33.860345,151.210552),
        new google.maps.LatLng(-33.853436,151.211057),
        new google.maps.LatLng(-33.849943,151.199813),
        new google.maps.LatLng(-33.84474,151.185908),
        new google.maps.LatLng(-33.845025,151.170287),
        new google.maps.LatLng(-33.845381,151.158271),
        new google.maps.LatLng(-33.840747,151.153636),
        new google.maps.LatLng(-33.843741,151.141877),
        new google.maps.LatLng(-33.84645,151.135268),
        new google.maps.LatLng(-33.842815,151.13029),
        new google.maps.LatLng(-33.844153,151.123896),
        new google.maps.LatLng(-33.840043,151.121128),
        new google.maps.LatLng(-33.837155,151.111515),
        new google.maps.LatLng(-33.831202,151.100271),
        new google.maps.LatLng(-33.824278,151.0957),
        new google.maps.LatLng(-33.821755,151.090615),
        new google.maps.LatLng(-33.820543,151.075981),
        new google.maps.LatLng(-33.819651,151.072934),
        new google.maps.LatLng(-33.82425,151.064265),
        new google.maps.LatLng(-33.823823,151.049244),
        new google.maps.LatLng(-33.818225,151.044052),
        new google.maps.LatLng(-33.818047,151.039031),
        new google.maps.LatLng(-33.819188,151.03667),
        new google.maps.LatLng(-33.817298,151.026757),
        new google.maps.LatLng(-33.814767,151.026113),
        new google.maps.LatLng(-33.814196,151.021907),
        new google.maps.LatLng(-33.815658,151.018689),
        new google.maps.LatLng(-33.816157,151.016243),
        new google.maps.LatLng(-33.815765,151.013839),
        new google.maps.LatLng(-33.815016,151.011908),
        new google.maps.LatLng(-33.813982,151.010664)
    ];

    var mosmanTripCoords = [
        new google.maps.LatLng(-33.86038,151.211003),
        new google.maps.LatLng(-33.854505,151.212087),
        new google.maps.LatLng(-33.85308,151.228566),
        new google.maps.LatLng(-33.848304,151.230798),
        new google.maps.LatLng(-33.850799,151.232257),
        new google.maps.LatLng(-33.850799,151.233888),
        new google.maps.LatLng(-33.848731,151.235518),
        new google.maps.LatLng(-33.844258,151.232536),
        new google.maps.LatLng(-33.843255,151.232611),
        new google.maps.LatLng(-33.840867,151.230401),
        new google.maps.LatLng(-33.838746,151.230894),
        new google.maps.LatLng(-33.838692,151.232547)
    ]

    var manlyTrip = new google.maps.Polyline({
        path: manlyTripCoords,
        geodesic: true,
        strokeColor: '#ff5857',
        strokeOpacity: 1.0,
        strokeWeight: 2
    });

    var parramattaTrip = new google.maps.Polyline({
        path: parramattaTripCoords,
        geodesic: true,
        strokeColor: '#fed555',
        strokeOpacity: 1.0,
        strokeWeight: 2
    });

    var mosmanTrip = new google.maps.Polyline({
        path: mosmanTripCoords,
        geodesic: true,
        strokeColor: '#29a1ba',
        strokeOpacity: 1.0,
        strokeWeight: 2
    });


    var styles = [
        {
            "featureType": "transit.line",
            "elementType": "geometry.fill",
            "stylers": [
                {"visibility": "off" }
            ]
        },
        {
            "featureType":"water",
            "stylers": [
                {"visibility":"on"},
                {"color":"#acbcc9"}
            ]
        },
        {
            "featureType":"landscape",
            "stylers":[
                {"color":"#f2e5d4"}
            ]
        },
        {
            "featureType":"road.highway",
            "elementType":"geometry",
            "stylers": [
                {"color":"#c5c6c6"}
            ]
        },
        {
            "featureType":"road.arterial",
            "elementType":"geometry",
            "stylers": [
                {"color":"#e4d7c6"}
            ]
        },
        {
            "featureType":"road.local",
            "elementType":"geometry",
            "stylers": [
                {
                    "color":"#fbfaf7"
                }
            ]
        },
        {
            "featureType":"poi.park",
            "elementType":"geometry",
            "stylers": [
                {
                    "color":"#c5dac6"
                }
            ]
        },
        {
            "featureType":"administrative",
            "stylers": [
                {
                    "visibility":"on"
                },
                {
                    "lightness":33
                }
            ]
        },
        {
            "featureType":"road"
        },
        {
            "featureType":"poi.park",
            "elementType":"labels",
            "stylers": [
                {
                    "visibility":"on"
                },
                {
                    "lightness":20
                }
            ]
        }
        ,
        {

        },
        {
            "featureType":"road",
            "stylers": [
                {
                    "lightness":20
                }
            ]
        }
    ]


    var styledMap = new google.maps.StyledMapType(styles, {name: "Map"});

    map.mapTypes.set('map_style', styledMap);
    map.setMapTypeId('map_style');
    manlyTrip.setMap(map);
    parramattaTrip.setMap(map);
    mosmanTrip.setMap(map);


    $(function() {

        $('.routeController').on('click', function(e) {
            e.preventDefault();
            if ($(this).attr('data-visible') === 'true')
            {
                $(this).children('span').children('span').css({'display': 'none'});
                $(this).attr('data-visible','false');
                eval('{'+$(this).attr('data-target')+'}').setMap(null);
            }
            else
            {
                $(this).children('span').children('span').css({'display': 'block'});
                $(this).attr('data-visible','true');
                eval('{'+$(this).attr('data-target')+'}').setMap(map);
            }
        });

        $('#toggleMapControlPanel').on('click', function(e) {
            e.preventDefault();
            var panelWidth = $('#mapControlPanelHolder').outerWidth() + 10;
            //console.log('['+panelWidth+']')
            if ($('#mapControlPanelHolder').is(':visible'))
            {
                $('#mapControlPanel').animate({
                        right: '-'+panelWidth+'px'
                    }, 500,
                    function() {
                        $('#mapControlPanelHolder').css({'display': 'none'});
                    }
                );

                $('#toggleMapControlPanel').animate({
                    right: '15px'
                }, 500).html('&lt;');
            }
            else
            {
                $('#mapControlPanelHolder').css({'display': 'block'});
                $('#mapControlPanelHolder').show();
                $('#mapControlPanel').animate({
                        right: '0px'
                    }, 500
                );

                $('#toggleMapControlPanel').animate({
                    right: panelWidth+'px'
                }, 500).html('&gt;');
            }

        })



    });
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>
<section class="featureImgHolder marginBottomStandard">
    <img src="img/featureImages/harbourPano-2.jpg" />
    <section class="promoHolder">
        <div class="row">
            <div class="large-12">
                <div class="large-3 columns">
                    <div>

                    </div>
                </div>

                <div class="large-3 columns">
                    <div>

                    </div>
                </div>

                <div class="large-3 columns">
                    <div>

                    </div>
                </div>

                <div class="large-3 columns">
                    <div>

                    </div>
                </div>


            </div>
        </div>
    </section>
</section>

<section class="mapHolder">
  <div class="row marginBottomStandard">
          <div class="large-12 columns" id="map-canvas"></div>

          <!--a href="#" id="toggleMapControlPanel" class="toggleControlPanel">&gt;</a>

          <div id="mapControlPanelHolder" class="controlPanelHolder">
              <div id="mapControlPanel" class="controlPanel">
                  <h5>FILTER JOURNEYS</h5>
                  <h6 class="marginTop20">SELECT ROUTE/S:</h6>

                  <ul>
                      <li><a href="#" class="routeController" data-target="manlyTrip" data-visible="true"><span><span></span></span>Manly Route</a></li>
                      <li><a href="#" class="routeController" data-target="parramattaTrip" data-visible="true"><span><span></span></span>Parramatta River</a></li>
                      <li><a href="#" class="routeController" data-target="mosmanTrip" data-visible="true"><span><span></span></span>Mosman</a></li>
                  </ul>
              </div>
          </div-->
      </div>
  </div>
</section>

<?php
if (isset($instagramData))
{
    $instagramUsername = $instagramData->user->username;
    $instagramLogoutURL = '?id=logout';
} else {
    // Login URL
    $instagramLoginURL = $instagram->getLoginUrl(array('basic','likes','relationships','comments'));
}
/*
echo 'REQUEST_URI['.$_SERVER['REQUEST_URI'].']<br />';
echo 'SCRIPT_FILENAME['.$_SERVER['SCRIPT_FILENAME'].']<br />';
echo 'PHP_SELF['.$_SERVER['PHP_SELF'].']<br />';
echo 'Page['.substr(strrchr($_SERVER['PHP_SELF'], "/"), 1).']';
*/

?>

<section class="photoSection">

  <div class="row marginBottom20">
      <div class="large-12 columns">
      <?php
      if (!empty($_SESSION['userdetails']))
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

  <div id="photoHolder01" class="row marginBottomStandard">
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

    $instagramResults = $instagram->getTagMedia('beyondthewharf',$tokenSet, 5);

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

          if ($count === 0)
          {
              echo '<div class="small-6 large-6 columns">';
              echo '<img src="'.$post->images->standard_resolution->url.'" />';
              echo '<a href="'.$instagramCommentURL.'?media_id='.$post->id.'" data-reveal-ajax="true" class="comments reveal-init" data-size="'.$instagramCommentOverlaySize.'" data-mediaId="'.$post->id.'" role="button"><span>'.$post->comments->count.'</span></a>';
              echo '<a href="'.$instagramLikeURL.'" data-url="'.$likeURL.'" class="likes'.$userLikedClass.'" title="'.$likeText.'" data-mediaId="'.$post->id.'" role="button"'.$instagramLikeOverlaySettings.'><span data-mediaId="'.$post->id.'" data-likesCount="'.$post->likes->count.'" data-displayCount>'.likeNumberFormatter($post->likes->count).'</span></a>';
              echo '</div>';
          }
          else
          {
              echo '<div class="small-3 large-3 columns">';
              echo '<img src="'.$post->images->low_resolution->url.'" alt="'.$post->caption->text.'" />';
              echo '<a href="'.$instagramCommentURL.'?media_id='.$post->id.'" class="comments reveal-init" data-size="'.$instagramCommentOverlaySize.'" data-mediaId="'.$post->id.'" role="button"><span>'.$post->comments->count.'</span></a>';
              echo '<a href="'.$instagramLikeURL.'" data-url="'.$likeURL.'" class="likes'.$userLikedClass.'" title="'.$likeText.'" data-mediaId="'.$post->id.'" role="button"'.$instagramLikeOverlaySettings.'><span data-mediaId="'.$post->id.'" data-likesCount="'.$post->likes->count.'" data-displayCount>'.likeNumberFormatter($post->likes->count).'</span></a>';
              echo '</div>';
          }

          $count++;
      }
    }
    else {

      $to = 'jason.taikato@tobiasandtobias.com';
      $subject = 'System error mail';
      $message = '<html><head></head><body><p><strong>Type:</strong> '.$instagramResults->error_type.'</p><p><strong>Msg:</strong> '.$instagramResults->error_message.'</p><p><strong>URL:</strong> '.$_SERVER['REQUEST_URI'].'</p></body></html>';


      //$message = 'Error:\rType: '.$instagramResults->error_type.'\rMsg: '.$instagramResults->error_message.'\rURL: '.$_SERVER['REQUEST_URI'];
      $from = 'website@harbourcityferries.com.au';
      $headers = 'MIME-Version: 1.0\r\n';
      $headers .= 'Content-type: text/html; charset=iso-8859-1\r\n';
      $headers  .= 'From:' .$from.'\r\n';
      //mail($to,$subject,$message,$headers);


      echo '<div class="systemError"><h2>Error:</h2>';
      echo '<p>An email with the following message has been sent to the webmaster - sorry for any inconvenience.</a></p>';
      echo '<p><strong>Type:</strong> '.$instagramResults->error_type.'</p>';
      echo '<p><strong>Msg:</strong> '.$instagramResults->error_message.'</p>';
      echo '<p><strong>URL:</strong> '.$_SERVER['REQUEST_URI'].'</p>';
      echo '</div>';
    }


    /*
    echo '<script>';
    echo 'console.dir('.json_encode($instagramResults).')';
    echo '</script>';
    */
    ?>
  </div>


</section>

<div id="modalShell" class="reveal-modal <?=$instagramCommentOverlaySize?>" data-reveal="">

</div>

<section class="photoPaginationHolder">
  <div id="photoPagination" class="row marginBottomStandard">

  </div>
</section>

<?php
include 'includes/db.php';
?>
    
<script src="js/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script src="js/foundation/foundation.reveal.js"></script>
<script src="js/global-functions.js"></script>

<script src="js/vendor/plugins/indie/heartcode-canvasloader-min-0.9.1.js"></script>


<script>


$(function() {

    $('body').on('click', '.reveal-init', function(e)
    {
        e.preventDefault();
        console.log('overlay');
        var url = $(this).attr('href');
        $('#modalShell').html('<div id="canvasLoader"></div>');

        var cl = new CanvasLoader('canvasLoader');
        //cl.setColor('#c43442'); // default is '#000000'
        cl.setColor('#000000');
        cl.setShape('square'); // default is 'oval'
        cl.setDiameter(42); // default is 40
        cl.setDensity(90); // default is 40
        cl.setRange(1); // default is 1.3
        cl.setSpeed(3); // default is 2
        cl.setFPS(24); // default is 24
        cl.show(); // Hidden by default

        $('#modalShell').foundation('reveal', 'open');
        $('#modalShell').load(url);
    });

    $('body').on('click','.reveal-close', function(e)
    {
        e.preventDefault();
        $('#modalShell').foundation('reveal', 'close');
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
</body>
</html>
