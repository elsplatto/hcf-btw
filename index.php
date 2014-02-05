<?php
$pageMetaTitle = "Beyond the Wharf - The Sydney Harbour Ferry Experience";
$pageSection = "home";
include 'includes/head.php';
include 'includes/db.php';

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
                        <span>On the Harbour<span>
                        <a href="#">Event Diary</a>
                    </div>
                </div>

                <div class="large-3 columns">
                    <div class="imgHolder">
                        <a href="#"><img src="img/promoImages/promo2.jpg" alt="Image of Musicians" /></a>
                    </div>
                    <div class="textHolder">
                       <span>Promotion<span>
                        <a href="#">Music on the Boat</a>
                    </div>
                </div>

                <div class="large-3 columns">
                    <div class="imgHolder">
                        <a href="#"><img src="img/promoImages/promo3.jpg" alt="" /></a>
                    </div>
                    <div class="textHolder">
                       <span>Beyond the Wharf<span>
                        <a href="#">Foodies Guide</a>
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
            <div class="large-6 left">
                <div class="imgHolder">
                    <img src="img/themedPromos/history-med.jpg" alt="Promo Image" />
                    <a href="#" class="button">Explore Our Harbour History<span></span></a>
                </div>
                <div class="large-6 route darling opacity">
                    <div class="inner">

                    </div>
                </div>

                <div class="large-6 route manly opacity">
                    <div class="inner">

                    </div>
                </div>
            </div>
            <div class="large-6 standardDarkGrey">

            </div>
        </div>
    </div>
</section>

<section class="mapHolder">
  <div class="row marginBottomStandard">
      <h3 class="text-center">Find a Journey</h3>
      <div class="large-12 columns" id="mapContainer">


        <div class="large-12" id="map-canvas"></div>
          <a href="#" id="toggleMapControlPanel" class="toggleControlPanel">&gt;</a>

          <div id="mapControlPanelHolder" class="controlPanelHolder large-3">
              <div id="mapControlPanel" class="controlPanel">
                  <h5>FILTER JOURNEYS</h5>
                  <h6 class="marginTop20">Select Route/s:</h6>

                  <ul>
                      <li><a href="#" class="routeController" data-target="manlyTrip" data-visible="true"><span><span></span></span>Manly Route</a></li>
                      <li><a href="#" class="routeController" data-target="parramattaTrip" data-visible="true"><span><span></span></span>Parramatta River</a></li>
                      <li><a href="#" class="routeController" data-target="mosmanTrip" data-visible="true"><span><span></span></span>Mosman</a></li>
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

  <div class="row marginBottom20">
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




<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="js/vendor/google/maps/infoBubble.js" />
<script>window.jQuery || document.write('<script src="js/jquery.js"><\/script>')</script>
<script src="js/foundation.min.js"></script>
<script src="js/foundation/foundation.reveal.js"></script>
<script src="js/global-functions.js"></script>
<script src="js/vendor/plugins/indie/heartcode-canvasloader-min-0.9.1.js"></script>

<script type="text/javascript">
function initialize() {

    var manlyColor = '#bf5757';
    var parramattaColor = '#e2b076';
    var mosmanColor = '#c98abf';
    var tarongaColor = '#30bda1';
    var darlingColor = '#59acb3';
    var neutralColor = '#798fa7';
    var easternColor = '#eee8c0';
    var stdGrey = '#272e35';



    var mapOptions = {
        center: new google.maps.LatLng(-33.81221,151.176853),
        zoom: 12,
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
        strokeColor: manlyColor,
        strokeOpacity: 1.0,
        strokeWeight: 3
    });

    var parramattaTrip = new google.maps.Polyline({
        path: parramattaTripCoords,
        geodesic: true,
        strokeColor: parramattaColor,
        strokeOpacity: 1.0,
        strokeWeight: 3
    });

    var mosmanTrip = new google.maps.Polyline({
        path: mosmanTripCoords,
        geodesic: true,
        strokeColor: mosmanColor,
        strokeOpacity: 1.0,
        strokeWeight: 3
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

    var infoBubble;

    google.maps.event.addListener(manlyTrip, 'click', function(event) {
        var latLng = new google.maps.LatLng(event.latLng.lat(),event.latLng.lng());

        if(infoBubble)
        {
            infoBubble.close(map);
            infoBubble.setMap(null);
        }

        infoBubble = new InfoBubble({
            map: map,
            content: '<div class="infoBubble routes manly"><h5>Manly</h5><a href="#">Go to route</a></div>',
            position: latLng,
            shadowStyle: 1,
            padding: 0,
            backgroundColor: manlyColor,
            borderRadius: 0,
            arrowSize: 10,
            borderWidth: 1,
            borderColor: manlyColor,
            disableAutoPan: true,
            hideCloseButton: false,
            arrowPosition: 25,
            backgroundClassName: 'infoBubbleWrapper',
            arrowStyle: 0,
            disableAutoPan: true,
            minWidth: 130,
            minHeight: 70
        });

        infoBubble.setPosition(latLng);
        infoBubble.open(map);
    });

    google.maps.event.addListener(parramattaTrip, 'click', function(event) {
        var latLng = new google.maps.LatLng(event.latLng.lat(),event.latLng.lng());

        if(infoBubble)
        {
            infoBubble.close(map);
            infoBubble.setMap(null);
        }

        infoBubble = new InfoBubble({
            map: map,
            content: '<div class="infoBubble routes parramatta"><h5>Parramatta River</h5><a href="#">Go to route</a></div>',
            position: latLng,
            shadowStyle: 1,
            padding: 0,
            backgroundColor: parramattaColor,
            borderRadius: 0,
            arrowSize: 10,
            borderWidth: 1,
            borderColor: parramattaColor,
            disableAutoPan: true,
            hideCloseButton: false,
            arrowPosition: 25,
            backgroundClassName: 'infoBubbleWrapper',
            arrowStyle: 0,
            disableAutoPan: true,
            minWidth: 190,
            minHeight: 100
        });

        infoBubble.setPosition(latLng);
        infoBubble.open(map);
    });



    google.maps.event.addListener(mosmanTrip, 'click', function(event) {
        var latLng = new google.maps.LatLng(event.latLng.lat(),event.latLng.lng());

        if(infoBubble)
        {
            infoBubble.close(map);
            infoBubble.setMap(null);
        }

        infoBubble = new InfoBubble({
            map: map,
            content: '<div class="infoBubble routes mosman"><h5>Mosman</h5><a href="#">Go to route</a></div>',
            position: latLng,
            shadowStyle: 1,
            padding: 0,
            backgroundColor: mosmanColor,
            borderRadius: 0,
            arrowSize: 10,
            borderWidth: 1,
            borderColor: mosmanColor,
            disableAutoPan: true,
            hideCloseButton: false,
            arrowPosition: 25,
            backgroundClassName: 'infoBubbleWrapper',
            arrowStyle: 0,
            disableAutoPan: true,
            minWidth: 130,
            minHeight: 70
        });

        infoBubble.setPosition(latLng);
        infoBubble.open(map);
    });

    var iconBase = 'img/';
    var thmbBase = 'img/locations/thumbnails/'
    var markerLocations = [
        {
            id: 1,
            location_name: 'Manly Wharf',
            lat: -33.800432,
            lng: 151.283906,
            icon: iconBase + 'lightAnchorMarker.png',
            image_thumb: thmbBase + 'cockatooIsland.jpg',
            alt: 'Image of Manly Wharf',
            category: 'history',
            sub_heading: 'Destination'
        },
        {
            id: 1,
            location_name: 'North Head',
            lat: -33.817076,
            lng: 151.286845,
            icon: iconBase + 'lightStarMarker.png' ,
            image_thumb: thmbBase + 'cockatooIsland.jpg',
            alt: 'Image of North Head',
            category: 'attraction',
            sub_heading: 'Attraction'
        },
        {
            id: 2,
            location_name: 'Cockatoo Island',
            lat: -33.846949,
            lng: 151.17209,
            icon: iconBase + 'lightAnchorMarker.png',
            image_thumb: thmbBase + 'cockatooIsland.jpg',
            alt: 'Image of Cockatoo Island',
            category: 'history',
            sub_heading: 'Destination'
        },
        {
            id: 1,
            location_name: 'Circular Quay',
            lat: -33.861218,
            lng: 151.210874,
            icon: iconBase + 'lightAnchorMarker.png',
            image_thumb: thmbBase + 'circularQuay.jpg',
            alt: 'Image of Circular Quay',
            category: 'history',
            sub_heading: 'Destination'
        },
        {
            id: 1,
            location_name: 'Darling Point',
            lat: -33.867724,
            lng: 151.237246,
            icon: iconBase + 'lightCameraMarker.png',
            image_thumb: thmbBase + 'cockatooIsland.jpg',
            alt: 'Image of Darling Point',
            category: 'secret',
            sub_heading: 'Photography Spot'
        }
    ]

    showLocations(markerLocations);

    function showLocations(locations)
    {
        for (var i=0; i<locations.length;i++)
        {
            (function(location){
                var latLng = new google.maps.LatLng(location.lat,location.lng)
                var marker = new google.maps.Marker({
                    position: latLng,
                    icon: location.icon,
                    map: map
                });
                //console.dir(marker);

                var locationContent = '';
                locationContent += '<div class="imgHolder" data-category="'+location.category+'">';
                locationContent += '<img src="'+location.image_thumb+'" alt="'+location.alt+'" />';
                locationContent += '</div>';
                locationContent += '<div class="textHolder">';
                locationContent += '<span>'+location.sub_heading+'</span>';
                locationContent += '<h5><a href="#" class="panelFlyoutTrigger" data-location="'+location.id+'" data-target="mapContainer">'+location.location_name+'</a></h5>';
                locationContent += '</div>';

                var locationBubble = new InfoBubble({
                    map: map,
                    content: locationContent,
                    position: latLng,
                    shadowStyle: 1,
                    padding: 0,
                    backgroundColor: stdGrey,
                    borderRadius: 0,
                    arrowSize: 10,
                    borderWidth: 0,
                    borderColor: stdGrey,
                    disableAutoPan: false,
                    hideCloseButton: false,
                    arrowPosition: 25,
                    backgroundClassName: 'locationBubbleWrapper',
                    arrowStyle: 0,
                    disableAutoPan: true,
                    minWidth: 260,
                    minHeight: 260
                });

                google.maps.event.addListener(marker, 'click', function(){
                    locationBubble.open(map, marker)
                });

                google.maps.event.addListener(locationBubble,'domready', function(){
                    $('.panelFlyoutTrigger').on('click', function(e) {
                        e.preventDefault();
                        //console.log('here');
                        var target = $('#'+$(this).attr('data-target'));
                        var id = $(this).attr('data-location');
                        var url = 'services/get-location.php?id='+id;
                        $.ajax({
                            type: 'POST',
                            url: url,
                            beforeSend: function()
                            {
                                beforeLocationRetrieveHandler(target);
                            },
                            success: function(data)
                            {
                                locationRetrieveSuccessHandler(data);
                            },
                            error: function()
                            {
                                locationRetrieveErrorHandler(target);
                            }
                        });
                    });

                    $('body').on('click', '.flyoutPanelClose', function(e){
                        e.preventDefault();
                        //$('#flyoutPanel').hide();
                        $('#flyoutPanel').remove();
                    })

                    function beforeLocationRetrieveHandler(target) {
                        var panelFlyout = '';
                        panelFlyout += '<div id="flyoutPanel" class="panelFlyout large-12 columns left">';
                        panelFlyout += '<div class="large-12 columns standardDarkGrey">';
                        panelFlyout += '<div id="flyoutCanvas" class="paddingTopBottom20 left"></div>';
                        panelFlyout += '<h4 class="left loading">Loading...</h4>';
                        panelFlyout += '<div class="left"></div>';
                        panelFlyout += '</div>';
                        panelFlyout += '</div>';
                        $(panelFlyout).insertAfter(target);
                        var cl = new CanvasLoader('flyoutCanvas');
                        cl.setColor('#ffffff');
                        cl.setShape('square'); // default is 'oval'
                        cl.setDiameter(42); // default is 40
                        cl.setDensity(90); // default is 40
                        cl.setRange(1); // default is 1.3
                        cl.setSpeed(3); // default is 2
                        cl.setFPS(24); // default is 24
                        cl.show(); // Hidden by default
                    }

                    function locationRetrieveSuccessHandler(data) {
                        //var obj = JSON.parse(data);
                        var obj = data;
                        //console.dir(obj);
                        var locationHTML = '';
                        var closeHTML = '<a href="#" class="flyoutPanelClose">Close panel</a>';
                        if (obj[0].hasOwnProperty('location_name'))
                        {
                            locationHTML += '<div class="large-12 columns standardDarkGrey paddingTopBottom20">';
                            locationHTML += closeHTML;
                            locationHTML += '<span>'+obj[0]['sub_heading']+'</span>';
                            locationHTML += '<h3>'+obj[0]['location_name']+'</h3>';
                            locationHTML += '<img src="img/locations/medium/'+obj[0]['image_med']+'" alt="'+obj[0]['location_name']+'" />';
                            locationHTML += '</div>';
                        }
                        else
                        {
                            locationHTML += '<div class="large-12 columns standardDarkGrey paddingTopBottom20">';
                            locationHTML += closeHTML;
                            locationHTML += '<h4>'+obj[0]['error_display_msg']+'</div>';
                            locationHTML += '</div>';
                        }
                        //console.log('data: '+obj[0]['image_med']);
                        $('#flyoutPanel').html(locationHTML);
                        var scrollHeight = ($('#flyoutPanel').offset().top - $('#navHolder').outerHeight());
                        $('html,body').animate({
                                scrollTop: scrollHeight
                        },'slow');
                    }
                });

            }(locations[i]));
        }
    }

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

            var variant = 20;
            var mapCanvasWidth = $('#map-canvas').outerWidth();
            var controlPanelWidth =  $('#mapControlPanelHolder').outerWidth();
            var controlPanelTargetLeft = (mapCanvasWidth - controlPanelWidth) + variant;
            var toggleMapControlPanelWidth = $('#toggleMapControlPanel').outerWidth();
            var toggleTargetIn = (mapCanvasWidth - controlPanelWidth) - toggleMapControlPanelWidth + variant
            var toggleTargetOut = (mapCanvasWidth - toggleMapControlPanelWidth) + variant;

            //console.log('toggleTargetIn['+toggleTargetIn+']');
            //console.log('controlPanelTargetLeft['+controlPanelTargetLeft+']');

            if ($('#mapControlPanelHolder').is(':visible'))
            {
                //hide
                $('#mapControlPanel').animate({
                        left: controlPanelWidth
                    }, 500,
                    function() {
                        $('#mapControlPanelHolder').css({'display': 'none'});
                    }
                );

                $('#toggleMapControlPanel').animate({
                    left: toggleTargetOut
                }, 500).html('&lt;');
            }
            else
            {
                $('#mapControlPanelHolder').css({'display': 'block'});
                $('#mapControlPanelHolder').show();
                $('#mapControlPanel').animate({
                        left: 0
                    }, 500
                );

                $('#toggleMapControlPanel').animate({
                    left: toggleTargetIn
                }, 500).html('&gt;');
            }

        });


    });
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>
<script>


$(document).ready(function() {

    //console.log('map-canvas width['+$('#map-canvas').outerWidth()+']');

    if ($('#creditToggle').length > 0)
    {
        $('#creditToggle').animate({
            right: 0,
            easing: 'easeOut'
        }, 200);
    }



    if ($('#mapControlPanelHolder').length > 0) {
        var variant = 20;
        var mapCanvasWidth = $('#map-canvas').outerWidth();
        var controlPanelWidth =  $('#mapControlPanelHolder').outerWidth();
        var controlPanelTargetLeft = (mapCanvasWidth - controlPanelWidth) + variant;
        var toggleMapControlPanelWidth = $('#toggleMapControlPanel').outerWidth();
        var toggleTargetLeft = controlPanelTargetLeft - toggleMapControlPanelWidth;

        $('#mapControlPanelHolder').css({
            left: controlPanelTargetLeft
        });

        $('#toggleMapControlPanel').css({
            left: toggleTargetLeft
        });
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

    $('body').on('click', '.reveal-init', function(e)
    {
        e.preventDefault();
        //console.log('overlay');
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

<?php
include 'includes/analytics.php';
?>
</body>
</html>
