<?php
include 'includes/db.php';
include 'includes/Mobile_Detect.php';
$device = new Mobile_Detect;



    // Redirecting to home.php
    //header('Location: home.php');

require 'includes/instagram.class.php';
require 'includes/instagram.config.php';

session_start();
// User session data availability check

if($_GET['id']=='logout')
{
    unset($_SESSION['userdetails']);
    session_destroy();
    $instagramUserLoggedIn = false;
}

if (!empty($_SESSION['userdetails']))
{
    $instagramUserLoggedIn = true;
}
else{
    $instagramUserLoggedIn = false;
}

?>
<!doctype html>
<html class="no-js" lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Foundation | Welcome</title>
<link rel="stylesheet" href="css/foundation.css" />
<link rel="stylesheet" href="css/style.css" />
<script src="js/modernizr.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcRjvvKaoJuT_-v4op_kWwsV5rwQEIRG8&sensor=true"></script>
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

</head>
<body>
<?php
if ($device->isMobile()) {
  // Your code here.
  echo "Im a mobile";
}
?>
<section class="mapHolder">
  <div class="row marginBottomStandard">
      <div class="large-12 columns">
          <div id="map-canvas"></div>

          <a href="#" id="toggleMapControlPanel" class="toggleControlPanel">&gt;</a>

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
          </div>
      </div>
  </div>
</section>

<?php
if (!empty($_SESSION['userdetails']))
{
    //echo 'Welcome ' . $_SESSION['userdetails']['user'];
    $data=$_SESSION['userdetails'];
    $instagramUsername = $data->user->username;
    $instagramLogoutURL = '?id=logout';
} else {
    // Login URL
    $instagramLoginURL = $instagram->getLoginUrl();
}
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

      $instagramJSONFilename = 'json/results.json';
      $currentTime = time();
      //Interval in seconds
      $fileRewriteInterval = 180;

      $fileAge = 0;

      if (file_exists($instagramJSONFilename))
      {
          $instagramJSONFileExists = true;
          $instagramFileTimestamp =  filemtime($instagramJSONFilename);
          $fileAge =  $currentTime - $instagramFileTimestamp;
          //echo 'Last modified['.$instagramFileTimestamp.']';
          //echo 'Current time['.$currentTime.']';
          //echo 'File Age['.$fileAge.']';
      }
      else
      {
          $instagramJSONFileExists = false;
      }

      if (!$instagramJSONFileExists || ($fileAge > $fileRewriteInterval))
      {
          echo 'writing from api';
          //Use Instagram API
          $instagramResults = $instagram->getTagMedia('beyondthewharf',5);
          //write JSON results to file
          $instagram->writeTaggedMediaJSON($instagramResults, $instagramJSONFilename);

      } else {
          echo 'writing from file';
          //Get JSON from file
          $instagramResults = json_decode(file_get_contents($instagramJSONFilename, true));

          //echo '['.strlen(serialize($instagramResults)).']';
          echo '['.count($instagramResults->data).']';
      }

      $instagramLoginURL = $instagram->getLoginUrl();

      if ($instagramUserLoggedIn)
      {
        $instagramCommentURL = 'overlays/instagram-comment.php';
        $instagramCommentOverlaySize = 'large';
      } else {
        $instagramCommentURL = 'overlays/instagram-login.php';
        $instagramCommentOverlaySize = 'small';
      }

      if ($instagramResults->meta->code == 200)
      {
          foreach ($instagramResults->data as $post) {
              if ($count == 0)
              {
                  echo '<div class="small-6 large-6 columns">';
                  echo '<img src="'.$post->images->standard_resolution->url.'" />';
                  echo '<a href="'.$instagramCommentURL.'?media_id='.$post->id.'" class="comments reveal-init" data-size="'.$instagramCommentOverlaySize.'"><span>'.$post->comments->count.'</span></a>';
                  echo '<a href="#" class="likes"><span>'.$post->likes->count.'</span></a>';
                  echo '</div>';
              }
              else
              {
                  echo '<div class="small-3 large-3 columns">';
                  echo '<img src="'.$post->images->low_resolution->url.'" alt="'.$post->caption->text.'" />';
                  echo '<a href="'.$instagramCommentURL.'?media_id='.$post->id.'" class="comments reveal-init" data-size="'.$instagramCommentOverlaySize.'"><span>'.$post->comments->count.'</span></a>';
                  echo '<a href="#" class="likes"><span>'.$post->likes->count.'</span></a>';
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
      ?>
  </div>
</section>

<section class="photoPaginationHolder">
  <div id="photoPagination" class="row marginBottomStandard">

  </div>
</section>

<?php
include 'includes/db.php';
?>
    
<script src="js/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script>
$(document).foundation();



$(function() {

  $('.reveal-init').click(function(e)
  {
      e.preventDefault();
      var size = 'small';
      size = $(this).attr('data-size');
      $('.reveal-modal-bg').show();
      var modal = $('<div>').addClass('reveal-modal '+size).prependTo('body');
      $.get($(this).attr('href'), function(data) {
          modal.empty().html(data).foundation('reveal', 'open');
      });
      $('.reveal-modal').show();
  });





});
</script>
</body>
</html>
