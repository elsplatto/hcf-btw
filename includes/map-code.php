

<script src="<?=$relPath?>js/vendor/google/maps/infoBubble.js"></script>
<?php



function placeMapMarkers($pageId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE) {
    global $relPath;
    $results = getMapMarkers($pageId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    //$numRows =  mysqli_num_rows($results);
    $numRows = count($results);
    $counter = 0;
    $markerJS = '';
    if ($numRows > 0)
    {
        $markerJS .= 'var iconBase = \''.$relPath.'img/\';';
        $markerJS .= "\r\n";
        $markerJS .= 'var thmbBase = \''.$relPath.'img/locations/thumbnails/\';';
        $markerJS .= "\r\n";


        $markerJS .= 'var markerLocations = [';
        $markerJS .= "\r\n";
        //while ($row = $results->fetch_assoc())
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

    placeMapMarkers($pageId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

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
            //console.log('targetCategory['+targetCategory+']markerArray[i].category['+markerArray[i].category+']');
            //console.log('visibility['+markerArray[i].visible+']');
            //console.log('type of var ['+typeof markerArray[i].visible+']');
            if (markerArray[i].category === targetCategory)
            {
                //console.log('same category');
                if(markerArray[i].visible)
                {
                    //console.log('hide marker');
                    markerArray[i].setVisible(false);
                    $(this).children('span').children('span').hide();
                }
                else
                {
                    //console.log('show marker');
                    markerArray[i].setVisible(true);
                    $(this).children('span').children('span').show();
                }
            }

            //console.dir(markerArray[i]);
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
                        var url = '<?=$relPath?>services/get-location.php?id='+id;
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
                    }

                    function locationRetrieveSuccessHandler(data) {
                        var obj = data;
                        var locationHTML = '';
                        var subHeading = '';
                        var closeHTML = '<a href="#" class="flyoutPanelClose">Close panel</a>';
                        if (obj.hasOwnProperty('title'))
                        {
                            if (obj['category_title'] === null)
                            {
                                subHeading = obj['type_title'];
                            }
                            else
                            {
                                if (obj['category_title'].length === 0)
                                {
                                    subHeading = obj['category_title'];
                                }
                                else
                                {
                                    subHeading = obj['type_title'];
                                }
                            }


                            locationHTML += '<div class="large-12 columns standardDarkGrey paddingTopBottom20">';
                            locationHTML += closeHTML;
                            locationHTML += '<span>'+subHeading+'</span>';
                            locationHTML += '<h3>'+obj['title']+'</h3>';
                            if (obj['intro_text'] !== null)
                            {
                                locationHTML += '<p>'+obj['intro_text']+'</p>';
                            }
                            if (obj['trip_plan'] !== null)
                            {
                                if (obj['trip_plan'].length > 0)
                                {
                                    locationHTML += '<div class="ferryInfo large-12 columns ultraDarkGrey">';
                                    locationHTML += '<h4>Ferry Information</h4>';
                                    locationHTML += obj['trip_plan'];
                                    locationHTML += '</div>';
                                }
                            }
                            locationHTML += '<img src="<?=$relPath?>img/locations/medium/'+obj['image_med']+'" alt="'+obj['alt']+'" />';
                            locationHTML += '</div>';
                        }
                        else
                        {
                            locationHTML += '<div class="large-12 columns standardDarkGrey paddingTopBottom20">';
                            locationHTML += closeHTML;
                            locationHTML += '<h4>'+obj['error_display_msg']+'</div>';
                            locationHTML += '</div>';
                        }
                        //console.log('data: '+obj[0]['image_med']);
                        $('#flyoutPanel').html(locationHTML);
                        var scrollHeight = ($('#flyoutPanel').offset().top - $('#navHolder').outerHeight());
                        $('html').animate({
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
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>