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

<section class="mapHolder">
  <div class="row marginBottomStandard">
      <h3 class="text-center">Find a Journey</h3>
      <div class="large-12 columns" id="mapContainer">

        <div class="large-12" id="map-canvas"></div>
          <a href="#" id="toggleMapControlPanel" class="toggleControlPanel">&gt;</a>

          <div id="mapControlPanelHolder" class="controlPanelHolder large-3">
              <div id="mapControlPanel" class="controlPanel">
                  <h6 class="white">FILTER:</h6>
                  <!--h6 class="marginTop20">Select Route/s:</h6-->

                  <ul>

                      <li><a href="#" class="mapFilter" data-category="attractions" data-visible="true"><span><span></span></span>Attractions</a></li>
                      <li><a href="#" class="mapFilter" data-category="shopping" data-visible="true"><span><span></span></span>Shopping</a></li>
                      <li><a href="#" class="mapFilter" data-category="adventure" data-visible="true"><span><span></span></span>Adventure</a></li>
                      <li><a href="#" class="mapFilter" data-category="nature" data-visible="true"><span><span></span></span>Nature</a></li>
                      <li><a href="#" class="mapFilter" data-category="food" data-visible="true"><span><span></span></span>Food &amp; Drink</a></li>
                      <li><a href="#" class="mapFilter" data-category="family" data-visible="true"><span><span></span></span>Family</a></li>
                      <li><a href="#" class="mapFilter" data-category="secret" data-visible="true"><span><span></span></span>Local Secrets</a></li>
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
              echo '<img src="'.$post->images->standard_resolution->url.'" alt="'.$post->caption->text.'" />';
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

function placeMapMarkers($pageId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE) {
    $results = getMapMarkers($pageId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $numRows =  mysqli_num_rows($results);
    $counter = 0;
    $markerJS = '';
    if ($numRows > 0)
    {


        $markerJS .= 'var iconBase = \'img/\';';
        $markerJS .= "\r\n";
        $markerJS .= 'var icons = {';
        $markerJS .= "\r\n";
        $markerJS .= 'history: {';
        $markerJS .= "\r\n";
        $markerJS .= 'icon: iconBase + \'lightAnchorMarker.png\'';
        $markerJS .= "\r\n";
        $markerJS .= '},';
        $markerJS .= "\r\n";
        $markerJS .= 'attraction: {';
        $markerJS .= "\r\n";
        $markerJS .= 'icon: iconBase + \'lightStarMarker.png\'';
        $markerJS .= "\r\n";
        $markerJS .= '},';
        $markerJS .= "\r\n";
        $markerJS .= 'secret: {';
        $markerJS .= "\r\n";
        $markerJS .= 'icon: iconBase + \'lightStarMarker.png\'';
        $markerJS .= "\r\n";
        $markerJS .= '}';
        $markerJS .= "\r\n";
        $markerJS .= '};';
        $markerJS .= "\r\n";
        $markerJS .= 'var thmbBase = \'img/locations/thumbnails/\';';
        $markerJS .= "\r\n";


        $markerJS .= 'var markerLocations = [';
        $markerJS .= "\r\n";
        while ($row = $results->fetch_assoc())
        {
            $counter++;

            $markerJS .= '{';
            $markerJS .= "\r\n";
            $markerJS .= 'id: ' . $row['id'] . ', ';
            $markerJS .= "\r\n";
            $markerJS .= 'location_name: "' . $row['location_name'] . '", ';
            $markerJS .= "\r\n";
            $markerJS .= 'lat: ' . $row['lat'] . ', ';
            $markerJS .= "\r\n";
            $markerJS .= 'lng: ' . $row['lng'] . ', ';
            $markerJS .= "\r\n";
            $markerJS .= 'icon: iconBase + \'lightAnchorMarker.png\', ';
            $markerJS .= "\r\n";
            $markerJS .= 'image_thumb: thmbBase + \''.$row['image_thumb'].'\', ';
            $markerJS .= "\r\n";
            $markerJS .= 'alt: \''.$row['alt'].'\', ';
            $markerJS .= "\r\n";
            $markerJS .= 'category: \''.$row['category_title'].'\', ';
            $markerJS .= "\r\n";
            $markerJS .= 'sub_heading: \''.$row['type_title'].'\'';
            $markerJS .= "\r\n";
            $markerJS .= '}';
            if ($counter < $numRows)
            {
                $markerJS .= ',';
            }
            $markerJS .= "\r\n";

        }
        $markerJS .= '];';
        $markerJS .= "\r\n";
        $markerJS .= "\r\n";
    }

    echo $markerJS;
}


?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="js/vendor/google/maps/infoBubble.js" />
<script>window.jQuery || document.write('<script src="js/jquery.js"><\/script>')</script>
<script src="js/foundation.min.js"></script>
<script src="js/foundation/foundation.reveal.js"></script>
<script src="js/global-functions.js"></script>
<script src="js/vendor/plugins/indie/heartcode-canvasloader-min-0.9.1.js"></script>

<script type="text/javascript">
function initialize() {

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

<?php
$coordsJson = getJsonConents('json/routeCoords.json');

//get the route coordinates and create latlng objects in javascript
prepRoutes($coordsJson);
drawRoutes($coordsJson);

drawRouteInfoBubbles($coordsJson);
setRoutes($coordsJson);

placeMapMarkers(1, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

function prepRoutes($coordsJson) {
    $coordsJS = '';

    foreach ($coordsJson['routes'] as $route)
    {
        $count = 0;
        $coordsJS .= "\r\n";
        $coordsJS .= 'var '. strtolower($route['class']).'TripCoords = [';
        $coordsJS .= "\r\n";
        foreach ($route['coords'] as $coords)
        {
            $count++;
            $coordsJS .= 'new google.maps.LatLng('.$coords['lat'].','.$coords['lng'].')';
            if ($count < count($route['coords']))
            {
                $coordsJS .= ',';
                $coordsJS .= "\r\n";
            }
        }
        $coordsJS .= "\r\n";
        $coordsJS .= ']; ';
        $coordsJS .= "\r\n";
        $coordsJS .= "\r\n";
    }
    echo $coordsJS;
}

function drawRoutes($coordsJson){
    $coordsJS = '';
    foreach ($coordsJson['routes'] as $route)
    {
        $coordsJS .= 'var '. strtolower($route['class']).'Trip = new google.maps.Polyline({';
        $coordsJS .= "\r\n";
        $coordsJS .= 'path: '. strtolower($route['class']).'TripCoords,';
        $coordsJS .= "\r\n";
        $coordsJS .= 'geodesic: true,';
        $coordsJS .= "\r\n";
        $coordsJS .= 'strokeColor: "'. $route['colour'].'",';
        $coordsJS .= "\r\n";
        $coordsJS .= 'strokeOpacity: 1,';
        $coordsJS .= "\r\n";
        $coordsJS .= 'strokeWeight: 3';
        $coordsJS .= "\r\n";
        $coordsJS .= '}); ';
        $coordsJS .= "\r\n";
        $coordsJS .= "\r\n";
    }
    echo $coordsJS;
}

function drawRouteInfoBubbles($coordsJson){
    $bubbleJS = 'var infoBubble;';
    foreach ($coordsJson['routes'] as $route)
    {
        $bubbleJS .= 'google.maps.event.addListener('.strtolower($route['class']).'Trip, \'click\', function(event) {';
        $bubbleJS .= "\r\n";
        $bubbleJS .= 'var latLng = new google.maps.LatLng(event.latLng.lat(),event.latLng.lng());';
        $bubbleJS .= "\r\n";
        $bubbleJS .= 'if(infoBubble)';
        $bubbleJS .= "\r\n";
        $bubbleJS .= '{';
        $bubbleJS .= "\r\n";
        $bubbleJS .= 'infoBubble.close(map);';
        $bubbleJS .= "\r\n";
        $bubbleJS .= 'infoBubble.setMap(null);';
        $bubbleJS .= "\r\n";
        $bubbleJS .= '}';
        $bubbleJS .= "\r\n";
        $bubbleJS .= 'infoBubble = new InfoBubble({';
        $bubbleJS .= "\r\n";
        $bubbleJS .= 'map: map,';
        $bubbleJS .= "\r\n";
        $bubbleJS .= 'content: \'<div class="infoBubble routes '.strtolower($route['class']).'"><h5>'.$route['title'].'</h5><a href="#" class="directive">Go to route</a></div>\',';
        $bubbleJS .= "\r\n";
        $bubbleJS .= 'position: latLng,';
        $bubbleJS .= "\r\n";
        $bubbleJS .= 'shadowStyle: 1,';
        $bubbleJS .= "\r\n";
        $bubbleJS .= 'padding: 0,';
        $bubbleJS .= "\r\n";
        $bubbleJS .= 'backgroundColor: \''.$route['colour'].'\',';
        $bubbleJS .= "\r\n";
        $bubbleJS .= 'borderRadius: 0,';
        $bubbleJS .= "\r\n";
        $bubbleJS .= 'arrowSize: 10,';
        $bubbleJS .= "\r\n";
        $bubbleJS .= 'borderWidth: 1,';
        $bubbleJS .= "\r\n";
        $bubbleJS .= 'borderColor: \''.$route['colour'].'\',';
        $bubbleJS .= "\r\n";
        $bubbleJS .= 'disableAutoPan: true,';
        $bubbleJS .= "\r\n";
        $bubbleJS .= 'hideCloseButton: false,';
        $bubbleJS .= "\r\n";
        $bubbleJS .= 'arrowPosition: 25,';
        $bubbleJS .= "\r\n";
        $bubbleJS .= 'backgroundClassName: \'infoBubbleWrapper\',';
        $bubbleJS .= "\r\n";
        $bubbleJS .= 'arrowStyle: 0,';
        $bubbleJS .= "\r\n";
        $bubbleJS .= 'disableAutoPan: true,';
        $bubbleJS .= "\r\n";
        $bubbleJS .= 'minWidth: '.$route['info_bubble_width'].',';
        $bubbleJS .= "\r\n";
        $bubbleJS .= 'minHeight: '.$route['info_bubble_height'].'';
        $bubbleJS .= "\r\n";
        $bubbleJS .= '});';
        $bubbleJS .= "\r\n";
        $bubbleJS .= 'infoBubble.setPosition(latLng);';
        $bubbleJS .= "\r\n";
        $bubbleJS .= ' infoBubble.open(map);';
        $bubbleJS .= "\r\n";
        $bubbleJS .= '});';
        $bubbleJS .= "\r\n";
        $bubbleJS .= "\r\n";

    }
    echo $bubbleJS;
}

function setRoutes($coordsJson){
    $mapJS = '';
    foreach ($coordsJson['routes'] as $route)
    {
        $mapJS .= strtolower($route['class']).'Trip.setMap(map);';
        $mapJS .= "\r\n";
    }
    echo $mapJS;
}
?>


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





    var markerArray= [];
    showLocations(markerLocations);

    //console.dir(markerArray);

    $('.mapFilter').on('click', function(e){
        e.preventDefault();
        var targetCategory = $(this).attr('data-category');
        for (var i = 0; i < markerArray.length; i++) {
            console.log('targetCategory['+targetCategory+']markerArray[i].category['+markerArray[i].category+']');
            console.log('visibility['+markerArray[i].visible+']');
            console.log('type of var ['+typeof markerArray[i].visible+']');
            if (markerArray[i].category === targetCategory)
            {
                console.log('same category');
                if(markerArray[i].visible)
                {
                    console.log('hide marker');
                    markerArray[i].setVisible(false);
                }
                else
                {
                    console.log('show marker');
                    markerArray[i].setVisible(true);
                }
            }

            console.dir(markerArray[i]);
        }
    });

    function showLocations(locations)
    {
        for (var i=0; i<locations.length;i++)
        {
            (function(location){
                var latLng = new google.maps.LatLng(location.lat,location.lng)
                var marker = new google.maps.Marker({
                    position: latLng,
                    icon: location.icon,
                    map: map,
                    id: 'marker-'+i,
                    category: location.category
                });
                //console.dir(marker);
                //console.log('marker-'+i);
                markerArray.push(marker);



                var locationContent = '';
                locationContent += '<div class="imgHolder" data-category="'+location.category+'">';
                locationContent += '<div class="closeBg"></div>';
                locationContent += '<img src="'+location.image_thumb+'" alt="'+location.alt+'" />';
                locationContent += '</div>';
                locationContent += '<div class="textHolder">';
                locationContent += '<span>'+location.sub_heading+'</span>';
                locationContent += '<h5><a href="#" class="panelFlyoutTrigger" data-location="'+location.id+'" data-target="mapContainer">'+location.location_name+'</a></h5>';
                locationContent += '<a href="#" class="panelFlyoutTrigger directive" data-location="'+location.id+'" data-target="mapContainer">Read More</a>';
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
                    minHeight: 270
                });

                google.maps.event.addListener(marker, 'click', function(){
                    locationBubble.open(map, marker);
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
                        $('#flyoutPanel').remove();
                    });

                    function beforeLocationRetrieveHandler(target) {
                        //console.log('panel length['+$('#flyoutPanel').length+']');
                        if ($('#flyoutPanel').length > 0)
                        {
                            $('#flyoutPanel').remove();
                        }
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
                        var obj = data;
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
                        $('html').animate({
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
