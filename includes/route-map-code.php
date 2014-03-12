

<script src="<?=$baseURL?>/js/vendor/google/maps/infoBubble.js"></script>
<?php



function placeRouteMapMarkers($routeId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE) {
    global $baseURL;
    $results = getRouteMapMarkers($routeId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    //$numRows =  mysqli_num_rows($results);
    $numRows = count($results);
    $counter = 0;
    $markerJS = '';
    if ($numRows > 0)
    {
        $markerJS .= 'var iconBase = \''.$baseURL.'/img/\';';
        $markerJS .= "\r\n";
        $markerJS .= 'var thmbBase = \''.$baseURL.'/img/locations/thumbnails/\';';
        $markerJS .= "\r\n";


        $markerJS .= 'var markerLocations = [';
        $markerJS .= "\r\n";
        foreach($results as $row)
        {
            $counter++;

            $markerJS .= '{';
            $markerJS .= "\r\n";
            $markerJS .= 'id: ' . $row['id'] . ', ';
            $markerJS .= "\r\n";
            $markerJS .= 'title: "' . $row['title'] . '", ';
            $markerJS .= "\r\n";
            $markerJS .= 'lat: ' . $row['lat'] . ', ';
            $markerJS .= "\r\n";
            $markerJS .= 'lng: ' . $row['lng'] . ', ';
            $markerJS .= "\r\n";
            $markerJS .= 'icon: iconBase + \''.$row['map_icon'].'\', ';
            $markerJS .= "\r\n";
            $markerJS .= 'image_thumb: thmbBase + \''.$row['image_thumb'].'\', ';
            $markerJS .= "\r\n";
            $markerJS .= 'alt: "'.$row['alt'].'", ';
            $markerJS .= "\r\n";
            $markerJS .= 'category: "'.$row['category_title'].'", ';
            $markerJS .= "\r\n";
            $markerJS .= 'sub_heading: "'.$row['type_title'].'"';
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

<script type="text/javascript">

$(function(){

    var cl = new CanvasLoader('map-canvas-loader');
    cl.setColor('#ffffff');
    cl.setShape('square'); // default is 'oval'
    cl.setDiameter(60); // default is 40
    cl.setDensity(90); // default is 40
    cl.setRange(1); // default is 1.3
    cl.setSpeed(3); // default is 2
    cl.setFPS(24); // default is 24
    cl.show(); // Hidden by default

    $('<h4 class="left loading">Loading...</h4>').insertAfter('#canvasLoader');
});

function initialize() {

    var stdGrey = '#272e35';

    var mapOptions = {
        center: new google.maps.LatLng(-33.836311,151.208267),
        zoom: 12,
        mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.TERRAIN, 'map_style'],
            position: google.maps.ControlPosition.BOTTOM_CENTER
        }
    };
    var map = new google.maps.Map(document.getElementById("map-canvas"),
        mapOptions);

    // map: an instance of GMap3
// latlng: an array of instances of GLatLng
   /* var latlngbounds = new google.maps.LatLngBounds();
    latlng.each(function(n){
        latlngbounds.extend(n);
    });
    map.setCenter(latlngbounds.getCenter());
    map.fitBounds(latlngbounds);

*/

    <?php
    $coordsJson = getJsonConents('json/routeCoords.json');

    //get the route coordinates and create latlng objects in javascript
    prepMapRoutes($coordsJson, $routeId);
    drawMapRoute($coordsJson, $routeId);

    drawRouteInfoBubbles($coordsJson, $routeId);
    setMapRoutes($coordsJson, $routeId);

    drawWaypoints($coordsJson, $routeId);

    placeRouteMapMarkers($routeId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);



    function prepMapRoutes($coordsJson, $routeId) {
        $coordsJS = '';

        foreach ($coordsJson['routes'] as $route)
        {
        if ($route['id'] == $routeId)
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

                break;
            }
        }


        echo $coordsJS;
    }

    function drawMapRoute($coordsJson, $routeId){
        $coordsJS = '';
        foreach ($coordsJson['routes'] as $route)
        {
            if ($route['id'] == $routeId)
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
                break;
            }
        }
        echo $coordsJS;
    }

    function drawWaypoints($coordsJson, $routeId)
    {
        $wayPointsArray = array();
        $coordsJS = '';
        $coordsJS .= 'var wayPoints = {};';
        $coordsJS .= "\r\n";
        $count = 0;

        foreach ($coordsJson['routes'] as $route)
        {
            if ($route['id'] == $routeId)
            {

                foreach ($route['coords'] as $coords)
                {
                    $count++;

                    if ($coords['is_waypoint'] == 1 || $coords['is_destination'] == 1)
                    {
                        $coords['colour'] = $route['colour'];
                        $coords['sub_colour'] = $route['sub_colour'];
                        array_push($wayPointsArray, $coords);
                    }
                }

                break;
            }
        }



        foreach ($wayPointsArray as $wayPoint)
        {
            $coordsJS .= 'wayPoints["waypoint-'.$count.'"] = {';
            $coordsJS .= "\r\n";
            $coordsJS .= 'center: new google.maps.LatLng('.$wayPoint['lat'].','.$wayPoint['lng'].'),';
            $coordsJS .= "\r\n";
            if ($wayPoint['is_destination'] == 1)
            {
                $coordsJS .= 'opacity: 0,';
            }
            else
            {
                $coordsJS .= 'opacity: 1,';
            }
            $coordsJS .= "\r\n";
            if ($wayPoint['is_sub_route'] == 1 && strlen($wayPoint['sub_colour']) > 0)
            {
                $coordsJS .= 'fill_color: "'.$wayPoint['sub_colour'].'",';
            }
            else
            {
                $coordsJS .= 'fill_color: "'.$wayPoint['colour'].'",';
            }
            $coordsJS .= "\r\n";
            $coordsJS .= 'stroke_color: "'.$wayPoint['colour'].'",';
            $coordsJS .= "\r\n";
            $coordsJS .= 'label: "'.$wayPoint['label'].'"';
            $coordsJS .= "\r\n";
            $coordsJS .= '};';
            $coordsJS .= "\r\n";
            $count++;
        }

        $coordsJS .= 'var stopCircle;';
        $coordsJS .= "\r\n";

        $coordsJS .= 'for (var point in wayPoints) {';
        $coordsJS .= "\r\n";
        $coordsJS .= 'var wayPointOptions = {';
        $coordsJS .= "\r\n";
        $coordsJS .= 'strokeColor: wayPoints[point].stroke_color,';
        $coordsJS .= "\r\n";
        $coordsJS .= 'strokeOpacity: 1,';
        $coordsJS .= "\r\n";
        $coordsJS .= 'strokeWeight: 4,';
        $coordsJS .= "\r\n";
        $coordsJS .= 'fillColor: wayPoints[point].fill_color,';
        //$coordsJS .= 'fillColor: "#ffffff",';
        $coordsJS .= "\r\n";
        $coordsJS .= 'fillOpacity: wayPoints[point].opacity,';
        $coordsJS .= "\r\n";
        $coordsJS .= 'map: map,';
        $coordsJS .= "\r\n";
        $coordsJS .= 'center: wayPoints[point].center,';
        $coordsJS .= "\r\n";
        $coordsJS .= 'radius: 80';
        $coordsJS .= "\r\n";
        $coordsJS .= '};';
        $coordsJS .= "\r\n";
        $coordsJS .= 'stopCircle = new google.maps.Circle(wayPointOptions);';
        $coordsJS .= "\r\n";
        $coordsJS .= 'stopCircle.setMap(map);';
        $coordsJS .= "\r\n";
        $coordsJS .= '}';
        $coordsJS .= "\r\n";

        //$coordsJS .= 'console.dir(wayPoints)';
        $coordsJS .= "\r\n";
        echo $coordsJS;
    }

    function drawRouteInfoBubbles($coordsJson, $routeId){
    global $baseURL;
        $bubbleJS = 'var infoBubble;';
        foreach ($coordsJson['routes'] as $route)
        {
            if ($route['id'] == $routeId)
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
                $bubbleJS .= 'content: \'<div class="infoBubble routes '.strtolower($route['class']).'"><h5>'.$route['title'].'</h5><a href="'.$baseURL.'/route/'.$route['url'].'" class="directive">Go to route</a></div>\',';
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
                break;
            }

        }
        echo $bubbleJS;
    }

    function setMapRoutes($coordsJson, $routeId){
        $mapJS = '';
        foreach ($coordsJson['routes'] as $route)
        {
            if ($route['id'] == $routeId)
            {
                $mapJS .= strtolower($route['class']).'Trip.setMap(map);';
                $mapJS .= "\r\n";
            }
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
                    "visibility":"off"
                },
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
                    "visibility":"off"
                },
                {
                    "color":"#c5dac6"
                }
            ]
        },
        {
            "featureType":"administrative",
            "stylers": [
                {
                    "visibility":"off"
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
                    "visibility":"off"
                },
                {
                    "lightness":20
                }
            ]
        },
        {
            "featureType":"poi.business",
            "elementType":"labels",
            "stylers": [
                {
                    "visibility":"off"
                },
                {
                    "lightness":20
                }
            ]
        },
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
            if (markerArray[i].category === targetCategory)
            {
                //console.log('same category');
                if(markerArray[i].visible)
                {
                    //console.log('hide marker');
                    markerArray[i].setVisible(false);
                    $(this).addClass('off');
                }
                else
                {
                    //console.log('show marker');
                    markerArray[i].setVisible(true);
                    $(this).removeClass('off');
                }
            }
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
                locationContent += '<h5><a href="#" class="panelFlyoutTrigger" data-location="'+location.id+'" data-target="mapContainer">'+location.title+'</a></h5>';
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
                    maxWidth: 260,
                    minHeight: 270
                });

                google.maps.event.addListener(marker, 'click', function(){
                    locationBubble.open(map, marker);
                });

                google.maps.event.addListener(locationBubble,'domready', function()
                {
                    $('.panelFlyoutTrigger').on('click', function(e) {
                        e.preventDefault();
                        //console.log('here');
                        var target = $('#'+$(this).attr('data-target'));
                        var id = $(this).attr('data-location');

                        beforeLocationRetrieveHandler(target);
                        $('#flyoutPanel').load('<?=$baseURL?>/services/load-location.php?id='+id +'&relPath=<?=$baseURL?>/');
                    });

                    $('body').on('click', '.flyoutPanelClose', function(e){
                        e.preventDefault();
                        $('#flyoutPanel').remove();
                    });

                    function beforeLocationRetrieveHandler(target) {
                        if ($('#flyoutPanel').length > 0)
                        {
                            $('#flyoutPanel').remove();
                        }
                        var panelFlyout = '';
                        panelFlyout += '<div id="flyoutPanel" class="panelFlyout  large-12 columns left">';
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

                        var scrollHeight = ($('#flyoutPanel').offset().top - $('#navHolder').outerHeight());
                        $('html, body').animate({
                            scrollTop: scrollHeight
                        },'slow');
                    }



                    function locationRetrieveErrorHandler(target) {
                        var locationHTML = '';
                        var closeHTML = '<a href="#" class="flyoutPanelClose">Close panel</a>';
                        locationHTML = '<div class="large-12 columns standardDarkGrey paddingTopBottom20">';
                        locationHTML += closeHTML;
                        locationHTML += '<h4>Whoops... we appear to have an issue</h4>';
                        locationHTML += '</div>';
                        $('#flyoutPanel').html(locationHTML);
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

            if ($('#mapControlPanelHolder').is(':visible'))
            {
                //hide
                //console.log('hide');
                $('#mapControlPanel').animate({
                        left: controlPanelWidth
                    }, 500,
                    function() {
                        $('#mapControlPanelHolder').css({'display': 'none'});
                    }
                );

                $('#toggleMapControlPanel').removeClass('show').addClass('hide');
            }
            else
            {
                $('#mapControlPanelHolder').css({'display': 'block'});
                $('#mapControlPanelHolder').show();
                $('#mapControlPanel').animate({
                        left: 0
                    }, 500
                );

                $('#toggleMapControlPanel').removeClass('hide').addClass('show');
            }

        });
    });


}

google.maps.event.addDomListener(window, 'load', initialize);

</script>