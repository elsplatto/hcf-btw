<?php
$pageHeading = "Vivid";
$pageMetaTitle = "Vivid Sydney";
$pageSection = "vivid";
$pageMetaDesc = "Beyond the Wharf is proud to be a partner of Vivid Sydney. ";
$pageMetaKeywords = "Sydney, vivid, lights, harbour, experience, activities, events, international, travel";

/*global includes in head.php*/
include '../includes/head.php';
?>


<body>
<?php
include '../includes/nav.php';
?>

<section class="breadcrumbsHolder">
    <div class="row">
        <div class="large-12 columns breadcrumbs">
            <a href="<?=$baseURL?>/">Home</a><span>Vivid Sydney</span>
        </div>
    </div>
</section>

<section class="vividPromo paddingBottom40">
  <div class="row">
      <div class="large-12 columns">
          <div class="large-12">
            <div class="large-12 pinkBackground infoRibbon">
                <h3 class="block text-center">Harbour Lights <span class="darkPurple">23 May - 09 June</span></h3>
            </div>
          </div>
          <div class="large-12 darkPurpleBackground overflow">
              <div class="large-3 promoText left ">
                <div class="large-12">
                    <a href="http://www.vividsydney.com/" target="_blank" rel="nofollow" onClick="trackOutboundLink('http://www.vividsydney.com/'); return false;"><img src="<?=$baseURL?>/img/vividLogo-1.jpg" alt="Vivid Sydney Logo" /></a>
                </div>
                <div class="large-12 padding32">
                  <p>
                      Vivid Sydney extends onto the harbour for the first time in 2014 with the spectacular Harbour Lights.
                  </p>
                  <p>
                      During Vivid, make the most of your experience by exploring Sydney Harbour’s best kept secrets with Beyond the Wharf.
                  </p>
                  <p class="sponsor">
                      Presented by 32 Hundred Lighting, Intel and Destination NSW.
                  </p>
                </div>
              </div>

              <div class="large-9 left">
                  <img src="<?=$baseURL?>/img/promoImages/vivid-lighting-boats.jpg" alt="Sydney ferries decorated with lights" />
                  <div class="large-9 lightPurpleBackground paddingLeft32 paddingRight32 floated">
                      <h3 class="block white">Harbour Lights</h3>
                      <p>
                          Many of the cruise vessels, ferries and water taxis that regularly travel around the harbour will become part of Vivid Lights this year when
                          they are decorated with brilliant LED lights that change colour as they enter different parts of the harbour. These 'colour precincts' will be
                          computer-controlled using Intel technology and the latest in sat-nav geo-positioning.
                      </p>
                  </div>
              </div>
          </div>
      </div>

  </div>
</section>

<!--section class="darkPurpleBackground paddingTopBottom20">
    <div class="row marginBottomStandard">
        <h3 class="text-center">Vivid App</h3>
        <div class="large-12 columns">
            <div class="large-12">
                <div class="large-12 lightPurpleBackground padding32 overflow">
                    <div class="large-6 left paddingRight32">
                        <h3 class="block">Vivid Trails</h3>
                        <span>interactive itinerary and guide app</span>
                        <p class="paddingTop10">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                        </p>
                        <a href="#" class="button orange">DOWNLOAD TO YOUR PHONE</a>
                    </div>
                    <div class="large-6 standardDarkGrey left">
                     sss
                    </div>
                </div>
            </div>
        </div>
    </div>
</section-->

<section class="lightPurpleBackground paddingTopBottom20">
    <div class="row marginBottom20">
        <h3 class="text-center galleryTitle">Vivid Sydney Galleries</h3>
        <div class="large-12">
            <div class="large-6 insta columns left">
                <div class="large-12 left pinkBackground padding16 text-center">
                    <img src="<?=$baseURL?>/img/content/vivid-in-lights.jpg" alt="Night time photograph - Vivid spelt with lights" />
                    <div class="large-12 padding16 ultraDarkGrey">
                        <h4 class="block">FEATURED PROFESSIONAL PHOTOGRAPHER</h4>
                    </div>
                    <div class="large-12 paddingTop40 pinkBackground text-center">
                        <a href="<?=$baseURL?>/vivid/gallery-pro" class="button">More from Andy Richards</a>
                        <h4>Night photographer Andy Richards & Understand Down Under</h4>
                    </div>
                </div>
            </div>

            <div class="large-6 right">
                <?php
                include '../includes/instagram-get-latest.php';
                ?>
                <div class="large-12 overflow paddingTop30 text-center">
                    <a href="<?=$baseURL?>/vivid/gallery" class="button marginTop16">Go to Vivid Sydney Gallery</a>
                    <h4 class="white"><span class="block">SHARE YOUR  EXPERIENCE</span> <br />Tag your instagram photos with <span class="block green">#VIVIDSYDNEY</span></h4>
                </div>
            </div>
        </div>
    </div>
</section>

<!--section class="darkPurpleBackground paddingTopBottom20">
    <div class="row marginBottomStandard">
        <h3 class="text-center">Instameet Event</h3>
        <div class="large-12 columns">
            <div class="large-12 lightPurpleBackground">
                <div class="large-12 padding32 overflow">
                    <div class="large-6 left paddingRight32">
                        <h2 class="block text-left">Lauren Bath</h2>
                        <span>Photographer Lauren Bath is hosting an Instameet event, to help all the budding photographers out there, join her to photograph VIVID SYDNEY.</span>
                        <p class="paddingTop10">
                        Lauren had already accumulated close to 345,000 followers, and travels around the world, posting photos on her Instagram account to a huge market audience and getting paid big bucks to do it.
                        </p>
                        <h4 class="block text-center">Join Lauren Bath<br /> on Board A Sydney<br /> FERRY DD/MM/YYYY</h4>
                        <div class="large-12 text-center paddingTop20">
                            <a href="#" class="button orange instagram">Go To Lauren Bath Instameet Page</a>
                        </div>
                    </div>
                    <div class="large-6 orangeBackground left padding32 text-center">
                        <img src="<?=$baseURL?>/img/content/manOnRock.jpg" alt="Sample" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section-->

<section class="darkPurpleBackground paddingTopBottom20">
    <div class="row marginBottomStandard">
        <h3 class="text-center">Night Photography Course</h3>
        <div class="large-12 columns">
            <div class="large-12 lightPurpleBackground">
                <div class="large-12 padding32 overflow">
                    <div class="large-6 left paddingRight32">
                        <h2 class="block text-left">UNDERSTAND DOWN UNDER</h2>
                        <h3 class="block text-left">NIGHT PHOTOGRAPHY CLASS</h3>
                        <span class="spreadMed">Make the most of VIVID festival by learning how to master night photography and long exposures. Enjoy the art of playing with light, and create magical images with writing and drawing or sublime studio style portraits... using only a torch!</span>

                        <h4 class="block text-center paddingTopBottom20">Duration: 90 Minutes <br />From AUD $50.00</h4>
                        <p>
                            Sessions are at 6:00pm or 8:00pm, Bookings are accepted through our easy to use online system.
                        </p>
                        <div class="large-12 text-center paddingTop20">
                            <a href="https://udu.rezdy.com/25571/vivid-special-learn-night-photography" class="button orange"  rel="nofollow" onClick="trackOutboundLink('https://udu.rezdy.com/25571/vivid-special-learn-night-photography'); return false;">Book Now</a>
                        </div>
                    </div>
                    <div class="large-6 orangeBackground left padding32 text-center">
                        <img src="<?=$baseURL?>/img/content/beyondthewharf-lights.jpg" alt="Beyond The Wharf spelt out with lights for Vivid Sydney 2014" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="darkPurpleBackground paddingTopBottom20 vividComp">
    <div class="row marginBottomStandard">
        <h3 class="text-center">Competitions</h3>
        <div class="large-12 columns">
            <div class="large-6 medium-12 small-12 standardDarkGrey padding32 left setHeight">
                <h2 class="block text-left tightHeight">BEYOND THE WHARF VIVID PHOTO COMPETITION</h2>
                <span>The competition runs between 23<sup>rd</sup> May 2014 to 9<sup>th</sup> June 2014.</span>
                <p style="margin-top: 1rem">
                    Take a great shot of VIVID SYDNEY 2014, share it on Instagram & WIN.
                </p>
                <p>
                    Don't forget to check out our professional night <a href="#phototips">photography tips</a> and share your images with your friends to improve your chances.
                </p>
                <h4 class="white text-center">Enter the competition and tag your photos with<br /> <span class="block">#VIVIDSYDNEY</span><br /> to win!</h4>
                <div class="large-12 text-center paddingTop20">
                    <a href="<?=$baseURL?>/<?=$competitionURL?>&mode=competition&competitionId=2&call_page=<?=$baseURL?>/vivid/?competitionId=2" class="reveal-init button orange" id="enterVividComp">Enter Competition</a>
                </div>
            </div>

            <div class="large-6 medium-12 small-12 pinkBackground padding32 right setHeight text-center">
                <h2 class="block text-left tightHeight">WIN THE NEW CANON EOS 1200D Single Kit with EF-S 18-55mm f/3.5-5.6 III Lens
                    RRP $649</h2>
                <span class="white clearfix left">THE EASY WAY TO CAPTURE MAGIC MOMENTS</span><br />
                <img src="<?=$baseURL?>/img/content/camera.jpg" class="paddingTopBottom20 text-center" style="margin: 0 auto; display: block" alt="Canon EOS1200D" />
                <h3 class="block text-left tightHeight">WEEKLY PRIZES TO WIN MARITIME MUSEUM TICKETS</h3>
                <span class="white clearfix left text-left">In addition to the big prize we’ll be giving away weekly family passes to the Australian National Maritime Museum for the best family photo.</span>
            </div>

        </div>
    </div>
</section>

<section class="mapHolder lightPurpleBackground paddingTopBottom20">
    <div class="row marginBottomStandard">
        <h3 class="text-center">Vivid Sydney - Best Photography Locations from a Ferry</h3>
        <div class="large-12 columns" id="mapContainer">

            <div class="large-12" id="map-canvas">
                <div id="map-canvas-loader"></div>
            </div>
            <a href="#" id="toggleMapControlPanel" class="toggleControlPanel"></a>

            <div id="mapControlPanelHolder" class="controlPanelHolder medium-6 small-6 large-3">
                <div id="mapControlPanel" class="controlPanel text-center">
                    <!--h4 class="marginTop10">Vivid Photo Locations From a Ferry</h4-->
                    <img src="../img/iHaig.jpg" class="circle" alt="Iain Haig" />
                    <p style="line-height: 1.5rem;">
                        <span>Haig Gilchrist, Ferry Crew: With a modern point to shoot camera and or smart phone, you can get good quality photos and videos of Vivid. Around icons such as the Harbour Bridge and Opera House, ferries travel at slow speeds which will allow you to get great shots.</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="mapHolder lightPurpleBackground paddingTopBottom20">
    <a name="phototips"></a>
    <div class="row marginBottomStandard">
        <h3 class="text-center">Andy Richard's  - Night Photography Tips</h3>
        <div class="large-12 columns">
            <div class="large-9 medium-12 small-12 left orangeBackground setHeight photoTips">

                <ul id="photoTipsHolder" data-orbit data-options="animation: slide; timer_show_progress_bar: false; swipe: true; timer: false;
                    pause_on_hover: false;
                    animation_speed: 500;
                    navigation_arrows: true;
                    bullets: true;
                    slide_number: false;">
                    <li data-orbit-slide="tip-1">
                        <h3>Tip One. <span class="block">Camera and equipment</span></h3>
                        <p>
                            Long exposure photography can be achieved with surprisingly little equipment, for example a point-and-shoot camera that has a setting that enables a longer shutter speed. I've taken a lot of interesting photos using the Lumix (which has a 15, 30 or 60 second “Starry Sky” mode) placed on a rock. However, for best results you’ll need a DSLR or Mirror-less camera with full manual mode. A tripod and shutter release cable will allow you to take photos without camera movement. This will enable you to capture scenes, however you can get creative by adding your own sources of light.
                        </p>
                    </li>
                    <li data-orbit-slide="tip-2">
                        <h3>Tip Two. <span class="block">Focus and settings</span></h3>
                        <p>
                            Your camera’s auto-focus will only work if there is enough light for it to “see” the object you're trying to focus on. So, in dark areas it's often good to take a torch with you. For long exposures you’ll be using a tripod, and your subject will hopefully be staying still. That means your focus won't change, so you can “lock” the focus by switching your lens to manual-focus. Your settings will vary for each photo. Your ISO should usually be between 100-800, your shutter speed will often depend on the movement within the frame, and your aperture will depend on the ambient light.

                        </p>
                    </li>
                    <li data-orbit-slide="tip-3">
                        <h3>Tip Three. <span class="block">Light Illumination</span></h3>
                        <p>
                            In a photo, your camera sees only what the light sees. In a long exposure, it will see all the light that happens while the shutter is open, so in effect its a composite of numerous moments. This means you can use torches to “illuminate” objects. You can walk into the frame and the camera won't “see” you, as long as its dark, you keep moving and light doesn't fall on you. The torch wont be seen either, so long as you shine it away from the camera. By doing this, you can create beautiful lighting and textures. Use bigger torches for bigger objects, and experiment with different colours, remembering there are many different whites (from warm to cool).
                        </p>
                    </li>
                    <li data-orbit-slide="tip-4">
                        <h3>Tip Four. <span class="block">Painting with light</span></h3>
                        <p>
                            By shining light at the camera, you can “burn” into the image various patterns. Because you're facing the camera, everything you do will be in reverse.  So, to “write” something, you’ll need to write from right to left, with each letter being a mirror image of itself, i.e. “End” would be “bn3”. You’ll need to turn off the light between each letter, either with the switch or by blocking the light with your hand. You can also draw/light paint other objects, smiley faces, love hearts, cats… its up to you. Different types of lights and torches will give different effects, and you can also shine light through coloured “filters” such as cellophane.
                        </p>
                    </li>
                    <li data-orbit-slide="tip-5">
                        <h3>Tip Five. <span class="block">Using flash</span></h3>
                        <p>
                            Flash is great for creating quick bursts of light. Where as a torch can be used like a paintbrush to gradually light a scene, flash can be used to freeze objects. Like with torches, with a long exposure you can take a flash into the scene. Ideally this is done with an external camera flash using ‘pilot’ mode to manually fire the flash, where you can adjust the power of the output. If you dont have an external flash though, you can simply borrow someone else’s camera, and then use its flash by taking a ‘normal photo’ while your camera is taking the long exposure photo.
                            Flash can also be used to capture the same object more than once, i.e. flash the same person in two positions, and in the one photo you’ll see two of them!
                        </p>
                    </li>
                    <li data-orbit-slide="tip-6">
                        <h3>Tip Six. <span class="block">Capturing people</span></h3>
                        <p>
                            When lighting your photo, for a sharp image its essential that objects are still…. this can be very challenging when lighting people! Although flash is easier, using a warm torch at the right angle can create stunning results. You can actually create studio style photographs… the principles are the same. Instead of expensive lighting equipment, one torch can be your key light, fill light and rim light. Your body can be the light stand, the way you wave the light onto your subject will determine the size and proximity of your light box, and you can determine precisely which areas to illuminate, and which to leave dark.
                        </p>
                    </li>
                    <li data-orbit-slide="tip-7">
                        <h3>Tip Seven. <span class="block">Composition</span></h3>
                        <p>
                            When taking long exposure photographs, it's important to keep in mind that all the usual principles of photography still apply. Take time to compose your photos until they look good to you. You may benefit from using principles such as the “rule-of-thirds”, and using angles to lead the eye into you images and create a photo that is more 3 dimensional. You can take these principles a step further, by using light trails to similar effect, or by shining your torch more on key areas so that they are more illuminated and therefore become the focus of attention. In the dark, the world becomes a blank canvas, it up to you how you'd like to paint it.
                        </p>
                    </li>
                </ul>
            </div>
            <div id="photoTipsNav" class="large-3 hide-for-small hide-for-medium left standardDarkGrey setHeight photoTipsNav">
                <ul>
                    <li class="active"><p><a data-orbit-link="tip-1" href="#"><strong>Tip one.</strong> Camera and equipment.</a></p></li>
                    <li><p><a data-orbit-link="tip-2" href="#"><strong>Tip Two.</strong> Focus and settings.</a></p></li>
                    <li><p><a data-orbit-link="tip-3" href="#"><strong>Tip Three.</strong> Light Illumination.</a></p></li>
                    <li><p><a data-orbit-link="tip-4" href="#"><strong>Tip Four.</strong> Painting with light.</a></p></li>
                    <li><p><a data-orbit-link="tip-5" href="#"><strong>Tip Five.</strong> Using flash.</a></p></li>
                    <li><p><a data-orbit-link="tip-6" href="#"><strong>Tip Six.</strong> Capturing people.</a></p></li>
                    <li><p><a data-orbit-link="tip-7" href="#"><strong>Tip Seven.</strong> Composition.</a></p></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!--section class="paddingTopBottom20 themeFeature">
    <div class="row marginBottomStandard">
        <h3 class="text-center">Behind the Scenes</h3>

        <div class="large-12 columns">
            <div class="text-center large-6 medium-12 small-12 standardDarkGrey themedPromoText left">

                <span>The Back Story.</span>

                <h2 class="block tightHeight">Behind the Scenes Vivid Harbour Lights</h2>
                <h3>Take a look at how it's done, a journey with the ferry crew. Behind the scenes preparing for the spectacular event.</h3>
                <a href="<?=$baseURL?>/overlays/show-video.php?src=//player.vimeo.com/video/87308642&title=Behind%20The%20Scenes" class="button red play tungsten small reveal-init hide-for-large" data-size="medium">Watch the video</a>
                <img src="../img/dhoward.jpg" class="circle" />
                <span class="clearfix">Don Howard tells the story</span>
            </div>

                <div class="large-6 hide-for-medium hide-for-small themedPromoImage">
                    <img src="../img/themedPromos/ferryLights.jpg" alt="Harbour ferry with Vivid lighting." />
                    <div class="large-6 medium-6 small-6 themedPromoOverlay">
                        <a href="<?=$baseURL?>/overlays/show-video.php?src=//player.vimeo.com/video/87308642&title=Behind%20The%20Scenes" class="button red play tungsten small reveal-init" data-size="medium">Watch the video</a>

                    </div>
                </div>

        </div>

    </div>
</section-->

<?php
include '../includes/footer.php';
?>


<?php
$pageId = 1;
include '../includes/global-js.php';
include '../includes/instagram-js.php';
//include '../includes/photo-map-code.php';
?>


<script src="<?=$baseURL?>/js/vendor/google/maps/infoBubble.js"></script>
<script type="text/javascript">

$(function(){

    <?if ($competitionId == 2)
    {
    ?>
    $('#enterVividComp').trigger('click');
    <?php
    }
    ?>

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
    var orange = '#ffa200';

    var mapOptions = {
        center: new google.maps.LatLng(-33.848287,151.20904),
        zoom: 13,
        mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.TERRAIN, 'map_style'],
            position: google.maps.ControlPosition.BOTTOM_CENTER
        }
    };
    var map = new google.maps.Map(document.getElementById("map-canvas"),
        mapOptions);


    var manlyTripCoords = [
        new google.maps.LatLng(-33.86047800,151.21151000),
        new google.maps.LatLng(-33.85493300,151.21346000),
        new google.maps.LatLng(-33.85498700,151.24714900),
        new google.maps.LatLng(-33.82447500,151.27530100),
        new google.maps.LatLng(-33.80051400,151.28388400)
    ];


    var tarongaTripCoords = [
        new google.maps.LatLng(-33.86047800,151.21151000),
        new google.maps.LatLng(-33.86062200,151.21094200),
        new google.maps.LatLng(-33.86007000,151.21120000),
        new google.maps.LatLng(-33.85942800,151.21147900),
        new google.maps.LatLng(-33.85873300,151.21173600),
        new google.maps.LatLng(-33.85811000,151.21203700),
        new google.maps.LatLng(-33.85668000,151.21275500),
        new google.maps.LatLng(-33.85608300,151.21321700),
        new google.maps.LatLng(-33.85558800,151.21386100),
        new google.maps.LatLng(-33.85523200,151.21457400),
        new google.maps.LatLng(-33.85511600,151.21529300),
        new google.maps.LatLng(-33.85468800,151.22027100),
        new google.maps.LatLng(-33.85444300,151.22316200),
        new google.maps.LatLng(-33.85413600,151.22689600),
        new google.maps.LatLng(-33.85406500,151.22763100),
        new google.maps.LatLng(-33.85373500,151.22897700),
        new google.maps.LatLng(-33.85290600,151.23149900),
        new google.maps.LatLng(-33.85005500,151.23630500),
        new google.maps.LatLng(-33.84626300,151.24009000)
    ];


    var parramattaTripCoords = [
        new google.maps.LatLng(-33.86047800,151.21151000),
        new google.maps.LatLng(-33.85271800,151.21098200),
        new google.maps.LatLng(-33.84933200,151.21072400),
        new google.maps.LatLng(-33.84861900,151.20623900),
        new google.maps.LatLng(-33.84951000,151.20658300),
        new google.maps.LatLng(-33.85024100,151.20656100),
        new google.maps.LatLng(-33.85273600,151.20192600),
        new google.maps.LatLng(-33.85548000,151.19909400),
        new google.maps.LatLng(-33.85850500,151.19889000),
        new google.maps.LatLng(-33.86645200,151.20004900),
        new google.maps.LatLng(-33.86686500,151.20088800),
        new google.maps.LatLng(-33.86645200,151.20004900),
        new google.maps.LatLng(-33.85850500,151.19889000),
        new google.maps.LatLng(-33.85701200,151.19572500),
        new google.maps.LatLng(-33.85373000,151.19408400),
        new google.maps.LatLng(-33.85397900,151.18927700),
        new google.maps.LatLng(-33.85471200,151.18637300),
        new google.maps.LatLng(-33.85459500,151.18673300),
        new google.maps.LatLng(-33.85434500,151.18758000),
        new google.maps.LatLng(-33.85406000,151.18873900),
        new google.maps.LatLng(-33.85367300,151.19075100),
        new google.maps.LatLng(-33.85333400,151.19158200),
        new google.maps.LatLng(-33.85317800,151.19191500),
        new google.maps.LatLng(-33.85291500,151.19226900),
        new google.maps.LatLng(-33.85255400,151.19250500),
        new google.maps.LatLng(-33.85193100,151.19270900),
        new google.maps.LatLng(-33.85130200,151.19279400),
        new google.maps.LatLng(-33.85060300,151.19270300),
        new google.maps.LatLng(-33.84979200,151.19220400),
        new google.maps.LatLng(-33.84921300,151.19153400),
        new google.maps.LatLng(-33.84861200,151.19070200),
        new google.maps.LatLng(-33.84758700,151.18962900),
        new google.maps.LatLng(-33.84703400,151.18892700),
        new google.maps.LatLng(-33.84678500,151.18843300),
        new google.maps.LatLng(-33.84652600,151.18767700),
        new google.maps.LatLng(-33.84644600,151.18696900),
        new google.maps.LatLng(-33.84646600,151.18631700),
        new google.maps.LatLng(-33.84636500,151.18640400),
        new google.maps.LatLng(-33.84625200,151.18646700),
        new google.maps.LatLng(-33.84612000,151.18651700),
        new google.maps.LatLng(-33.84595800,151.18655300),
        new google.maps.LatLng(-33.84573800,151.18655400),
        new google.maps.LatLng(-33.84554400,151.18653600),
        new google.maps.LatLng(-33.84535800,151.18649100),
        new google.maps.LatLng(-33.84516400,151.18641500),
        new google.maps.LatLng(-33.84495800,151.18631200),
        new google.maps.LatLng(-33.84486900,151.18626700),
        new google.maps.LatLng(-33.84473000,151.18607700),
        new google.maps.LatLng(-33.84462400,151.18581800),
        new google.maps.LatLng(-33.84457600,151.18549500),
        new google.maps.LatLng(-33.84450500,151.18507800),
        new google.maps.LatLng(-33.84433600,151.18431600),
        new google.maps.LatLng(-33.84371100,151.18166300),
        new google.maps.LatLng(-33.84346100,151.18070800),
        new google.maps.LatLng(-33.84331200,151.18036100),
        new google.maps.LatLng(-33.84323400,151.18025500),
        new google.maps.LatLng(-33.84310600,151.18021100),
        new google.maps.LatLng(-33.84296300,151.18018800),
        new google.maps.LatLng(-33.84271000,151.18021500),
        new google.maps.LatLng(-33.84246100,151.18039300),
        new google.maps.LatLng(-33.84219500,151.18057800),
        new google.maps.LatLng(-33.84202600,151.18070300),
        new google.maps.LatLng(-33.84185700,151.18022700),
        new google.maps.LatLng(-33.84149200,151.17924900),
        new google.maps.LatLng(-33.84115800,151.17853000),
        new google.maps.LatLng(-33.84091700,151.17798900),
        new google.maps.LatLng(-33.84050300,151.17727500),
        new google.maps.LatLng(-33.84009300,151.17677100),
        new google.maps.LatLng(-33.83941500,151.17640100),
        new google.maps.LatLng(-33.83876600,151.17603700),
        new google.maps.LatLng(-33.83893200,151.17602700),
        new google.maps.LatLng(-33.83927300,151.17600600),
        new google.maps.LatLng(-33.84030900,151.17594700),
        new google.maps.LatLng(-33.84127500,151.17580900),
        new google.maps.LatLng(-33.84290600,151.17548700),
        new google.maps.LatLng(-33.84363600,151.17510100),
        new google.maps.LatLng(-33.84410900,151.17475700),
        new google.maps.LatLng(-33.84489300,151.17389900),
        new google.maps.LatLng(-33.84558400,151.17299000),
        new google.maps.LatLng(-33.84554600,151.15989400),
        new google.maps.LatLng(-33.84550600,151.15710900),
        new google.maps.LatLng(-33.84529100,151.15707900),
        new google.maps.LatLng(-33.84480400,151.15701400),
        new google.maps.LatLng(-33.84369200,151.15685100),
        new google.maps.LatLng(-33.84287000,151.15664500),
        new google.maps.LatLng(-33.84190800,151.15625800),
        new google.maps.LatLng(-33.84113200,151.15521000),
        new google.maps.LatLng(-33.84073100,151.15456600),
        new google.maps.LatLng(-33.84038400,151.15354700),
        new google.maps.LatLng(-33.84033900,151.15284900),
        new google.maps.LatLng(-33.84050000,151.15098200),
        new google.maps.LatLng(-33.84108800,151.14864300),
        new google.maps.LatLng(-33.84177400,151.14570400),
        new google.maps.LatLng(-33.84194300,151.14398700),
        new google.maps.LatLng(-33.84191300,151.14225400),
        new google.maps.LatLng(-33.84381700,151.14201800),
        new google.maps.LatLng(-33.84555500,151.14179900),
        new google.maps.LatLng(-33.84560400,151.14004100),
        new google.maps.LatLng(-33.84580900,151.13810400),
        new google.maps.LatLng(-33.84600100,151.13601200),
        new google.maps.LatLng(-33.84592500,151.13480500),
        new google.maps.LatLng(-33.84561800,151.13368900),
        new google.maps.LatLng(-33.84519000,151.13252500),
        new google.maps.LatLng(-33.84401400,151.13121100),
        new google.maps.LatLng(-33.84329600,151.13021900),
        new google.maps.LatLng(-33.84312300,151.12966600),
        new google.maps.LatLng(-33.84303900,151.12916800),
        new google.maps.LatLng(-33.84310000,151.12874200),
        new google.maps.LatLng(-33.84326400,151.12848400),
        new google.maps.LatLng(-33.84353200,151.12831800),
        new google.maps.LatLng(-33.84379800,151.12823800),
        new google.maps.LatLng(-33.84279000,151.12622000),
        new google.maps.LatLng(-33.84149800,151.12350600),
        new google.maps.LatLng(-33.84009000,151.12075900),
        new google.maps.LatLng(-33.83983100,151.12011000),
        new google.maps.LatLng(-33.83962400,151.11938100),
        new google.maps.LatLng(-33.83957300,151.11890300),
        new google.maps.LatLng(-33.83960200,151.11840700),
        new google.maps.LatLng(-33.83979100,151.11792400),
        new google.maps.LatLng(-33.84039300,151.11719200),
        new google.maps.LatLng(-33.84095400,151.11649700),
        new google.maps.LatLng(-33.83915400,151.11478300),
        new google.maps.LatLng(-33.83788000,151.11318500),
        new google.maps.LatLng(-33.83696200,151.11145700),
        new google.maps.LatLng(-33.83626700,151.10895800),
        new google.maps.LatLng(-33.83537600,151.10695100),
        new google.maps.LatLng(-33.83377100,151.10490200),
        new google.maps.LatLng(-33.83172200,151.10198400),
        new google.maps.LatLng(-33.83066100,151.10004200),
        new google.maps.LatLng(-33.82916400,151.09843300),
        new google.maps.LatLng(-33.82732800,151.09698400),
        new google.maps.LatLng(-33.82520700,151.09589000),
        new google.maps.LatLng(-33.82342400,151.09444100),
        new google.maps.LatLng(-33.82216700,151.09215600),
        new google.maps.LatLng(-33.82131200,151.08988200),
        new google.maps.LatLng(-33.82125800,151.08656600),
        new google.maps.LatLng(-33.82119600,151.08318700),
        new google.maps.LatLng(-33.82131200,151.08140600),
        new google.maps.LatLng(-33.82160600,151.08014000),
        new google.maps.LatLng(-33.82221700,151.07909800),
        new google.maps.LatLng(-33.82156900,151.07778700),
        new google.maps.LatLng(-33.82073500,151.07625200),
        new google.maps.LatLng(-33.82007100,151.07463200),
        new google.maps.LatLng(-33.81966100,151.07349000),
        new google.maps.LatLng(-33.81964800,151.07270700),
        new google.maps.LatLng(-33.81994600,151.07166600),
        new google.maps.LatLng(-33.82038300,151.07059800),
        new google.maps.LatLng(-33.82212300,151.06813400),
        new google.maps.LatLng(-33.82383400,151.06521600),
        new google.maps.LatLng(-33.82431500,151.06357500),
        new google.maps.LatLng(-33.82437800,151.06168600),
        new google.maps.LatLng(-33.82403900,151.05894000),
        new google.maps.LatLng(-33.82401200,151.05646100),
        new google.maps.LatLng(-33.82416400,151.05336100),
        new google.maps.LatLng(-33.82404800,151.05101100),
        new google.maps.LatLng(-33.82377200,151.04940200),
        new google.maps.LatLng(-33.82339700,151.04827500),
        new google.maps.LatLng(-33.82215800,151.04709500),
        new google.maps.LatLng(-33.82061600,151.04580800),
        new google.maps.LatLng(-33.81906500,151.04452000),
        new google.maps.LatLng(-33.81799400,151.04375200),
        new google.maps.LatLng(-33.81795300,151.04266000),
        new google.maps.LatLng(-33.81787800,151.04078300),
        new google.maps.LatLng(-33.81795900,151.03985500),
        new google.maps.LatLng(-33.81808300,151.03903900),
        new google.maps.LatLng(-33.81828400,151.03859400),
        new google.maps.LatLng(-33.81854200,151.03809000),
        new google.maps.LatLng(-33.81887200,151.03737100),
        new google.maps.LatLng(-33.81911700,151.03633000),
        new google.maps.LatLng(-33.81903700,151.03529000),
        new google.maps.LatLng(-33.81852500,151.03298800),
        new google.maps.LatLng(-33.81793200,151.02995200),
        new google.maps.LatLng(-33.81746400,151.02725900),
        new google.maps.LatLng(-33.81723200,151.02670100),
        new google.maps.LatLng(-33.81691600,151.02634700),
        new google.maps.LatLng(-33.81652800,151.02619200),
        new google.maps.LatLng(-33.81567700,151.02623500),
        new google.maps.LatLng(-33.81506200,151.02618600),
        new google.maps.LatLng(-33.81483900,151.02604200),
        new google.maps.LatLng(-33.81466100,151.02573000),
        new google.maps.LatLng(-33.81449100,151.02514600),
        new google.maps.LatLng(-33.81430800,151.02391700),
        new google.maps.LatLng(-33.81424600,151.02268300),
        new google.maps.LatLng(-33.81428200,151.02208300),
        new google.maps.LatLng(-33.81448200,151.02133200),
        new google.maps.LatLng(-33.81505300,151.02030200),
        new google.maps.LatLng(-33.81551600,151.01914300),
        new google.maps.LatLng(-33.81592200,151.01791400),
        new google.maps.LatLng(-33.81605600,151.01663200),
        new google.maps.LatLng(-33.81599300,151.01531800),
        new google.maps.LatLng(-33.81558300,151.01344000),
        new google.maps.LatLng(-33.81531100,151.01254500),
        new google.maps.LatLng(-33.81471400,151.01147700),
        new google.maps.LatLng(-33.81423300,151.01096700),
        new google.maps.LatLng(-33.81392000,151.01057400)
    ];


    var darlingTripCoords = [
        new google.maps.LatLng(-33.86047800,151.21151000),
        new google.maps.LatLng(-33.85985100,151.21107500),
        new google.maps.LatLng(-33.85815100,151.21125700),
        new google.maps.LatLng(-33.85589700,151.21136400),
        new google.maps.LatLng(-33.85324800,151.21152300),
        new google.maps.LatLng(-33.85288900,151.21156300),
        new google.maps.LatLng(-33.85285100,151.21156500),
        new google.maps.LatLng(-33.85281800,151.21156500),
        new google.maps.LatLng(-33.85248400,151.21153500),
        new google.maps.LatLng(-33.85242900,151.21152900),
        new google.maps.LatLng(-33.85240600,151.21152900),
        new google.maps.LatLng(-33.85236900,151.21150100),
        new google.maps.LatLng(-33.85225500,151.21139900),
        new google.maps.LatLng(-33.85132800,151.21065100),
        new google.maps.LatLng(-33.85077300,151.21023700),
        new google.maps.LatLng(-33.85070100,151.21018600),
        new google.maps.LatLng(-33.85064800,151.21014300),
        new google.maps.LatLng(-33.85058900,151.21011900),
        new google.maps.LatLng(-33.85041700,151.21005100),
        new google.maps.LatLng(-33.85039000,151.21004100),
        new google.maps.LatLng(-33.85036800,151.21004500),
        new google.maps.LatLng(-33.85026000,151.21005700),
        new google.maps.LatLng(-33.85017200,151.21006700),
        new google.maps.LatLng(-33.85010200,151.21007100),
        new google.maps.LatLng(-33.85006800,151.21010000),
        new google.maps.LatLng(-33.84997000,151.21018100),
        new google.maps.LatLng(-33.84943400,151.21065800),
        new google.maps.LatLng(-33.84930700,151.20997100),
        new google.maps.LatLng(-33.84910800,151.20885100),
        new google.maps.LatLng(-33.84897500,151.20809600),
        new google.maps.LatLng(-33.84886900,151.20750000),
        new google.maps.LatLng(-33.84877800,151.20694100),
        new google.maps.LatLng(-33.84869700,151.20619600),
        new google.maps.LatLng(-33.84929500,151.20654200),
        new google.maps.LatLng(-33.84946600,151.20657400),
        new google.maps.LatLng(-33.84983600,151.20659300),
        new google.maps.LatLng(-33.85012300,151.20658500),
        new google.maps.LatLng(-33.85025900,151.20655000),
        new google.maps.LatLng(-33.85036800,151.20650400),
        new google.maps.LatLng(-33.85045700,151.20641000),
        new google.maps.LatLng(-33.85063400,151.20616300),
        new google.maps.LatLng(-33.85114700,151.20514900),
        new google.maps.LatLng(-33.85208700,151.20331900),
        new google.maps.LatLng(-33.85250100,151.20248300),
        new google.maps.LatLng(-33.85339600,151.20101800),
        new google.maps.LatLng(-33.85471500,151.19898500),
        new google.maps.LatLng(-33.85540500,151.19804600),
        new google.maps.LatLng(-33.85605600,151.19717700),
        new google.maps.LatLng(-33.85701100,151.19544800),
        new google.maps.LatLng(-33.85728500,151.19654000),
        new google.maps.LatLng(-33.85765200,151.19722900),
        new google.maps.LatLng(-33.85784200,151.19757500),
        new google.maps.LatLng(-33.85802200,151.19781100),
        new google.maps.LatLng(-33.85827400,151.19810900),
        new google.maps.LatLng(-33.85838700,151.19826700),
        new google.maps.LatLng(-33.85852500,151.19836100),
        new google.maps.LatLng(-33.85905100,151.19857800),
        new google.maps.LatLng(-33.85934900,151.19869600),
        new google.maps.LatLng(-33.85957400,151.19877100),
        new google.maps.LatLng(-33.86043000,151.19891300),
        new google.maps.LatLng(-33.86226000,151.19923300),
        new google.maps.LatLng(-33.86405600,151.19954400),
        new google.maps.LatLng(-33.86441900,151.19960500),
        new google.maps.LatLng(-33.86467300,151.19963500),
        new google.maps.LatLng(-33.86543000,151.19961600),
        new google.maps.LatLng(-33.86587500,151.19960500),
        new google.maps.LatLng(-33.86617600,151.19959200),
        new google.maps.LatLng(-33.86646100,151.19950400),
        new google.maps.LatLng(-33.86855100,151.19873300),
        new google.maps.LatLng(-33.86689100,151.20082500),
        new google.maps.LatLng(-33.86687300,151.20040700),
        new google.maps.LatLng(-33.86681500,151.20030600),
        new google.maps.LatLng(-33.86662600,151.20016600),
        new google.maps.LatLng(-33.86648100,151.20011200),
        new google.maps.LatLng(-33.86613600,151.20002700),
        new google.maps.LatLng(-33.86526100,151.19976600),
        new google.maps.LatLng(-33.86440800,151.19960500),
        new google.maps.LatLng(-33.86293300,151.19937500),
        new google.maps.LatLng(-33.86226000,151.19923300),
        new google.maps.LatLng(-33.86043000,151.19891300),
        new google.maps.LatLng(-33.85957400,151.19877100),
        new google.maps.LatLng(-33.85934900,151.19869600),
        new google.maps.LatLng(-33.85905100,151.19857800),
        new google.maps.LatLng(-33.85852500,151.19836100),
        new google.maps.LatLng(-33.85838700,151.19826700),
        new google.maps.LatLng(-33.85827400,151.19810900),
        new google.maps.LatLng(-33.85802200,151.19781100),
        new google.maps.LatLng(-33.85784200,151.19757500),
        new google.maps.LatLng(-33.85765200,151.19722900),
        new google.maps.LatLng(-33.85728500,151.19654000),
        new google.maps.LatLng(-33.85701100,151.19544800),
        new google.maps.LatLng(-33.85605600,151.19717700),
        new google.maps.LatLng(-33.85540500,151.19804600),
        new google.maps.LatLng(-33.85471500,151.19898500),
        new google.maps.LatLng(-33.85339600,151.20101800),
        new google.maps.LatLng(-33.85250100,151.20248300),
        new google.maps.LatLng(-33.85208700,151.20331900),
        new google.maps.LatLng(-33.85114700,151.20514900),
        new google.maps.LatLng(-33.85063400,151.20616300),
        new google.maps.LatLng(-33.85045700,151.20641000),
        new google.maps.LatLng(-33.85036800,151.20650400),
        new google.maps.LatLng(-33.85025900,151.20655000),
        new google.maps.LatLng(-33.85012300,151.20658500),
        new google.maps.LatLng(-33.84983600,151.20659300),
        new google.maps.LatLng(-33.84946600,151.20657400),
        new google.maps.LatLng(-33.84929500,151.20654200),
        new google.maps.LatLng(-33.84869700,151.20619600),
        new google.maps.LatLng(-33.84877800,151.20694100),
        new google.maps.LatLng(-33.84886900,151.20750000),
        new google.maps.LatLng(-33.84897500,151.20809600),
        new google.maps.LatLng(-33.84910800,151.20885100),
        new google.maps.LatLng(-33.84930700,151.20997100),
        new google.maps.LatLng(-33.84943400,151.21065800),
        new google.maps.LatLng(-33.84997000,151.21018100),
        new google.maps.LatLng(-33.85006800,151.21010000),
        new google.maps.LatLng(-33.85010200,151.21007100),
        new google.maps.LatLng(-33.85017200,151.21006700),
        new google.maps.LatLng(-33.85026000,151.21005700),
        new google.maps.LatLng(-33.85036800,151.21004500),
        new google.maps.LatLng(-33.85039000,151.21004100),
        new google.maps.LatLng(-33.85041700,151.21005100),
        new google.maps.LatLng(-33.85058900,151.21011900),
        new google.maps.LatLng(-33.85064800,151.21014300),
        new google.maps.LatLng(-33.85070100,151.21018600),
        new google.maps.LatLng(-33.85077300,151.21023700),
        new google.maps.LatLng(-33.85132800,151.21065100),
        new google.maps.LatLng(-33.85225500,151.21139900),
        new google.maps.LatLng(-33.85236900,151.21150100),
        new google.maps.LatLng(-33.85240600,151.21152900),
        new google.maps.LatLng(-33.85242900,151.21152900),
        new google.maps.LatLng(-33.85248400,151.21153500),
        new google.maps.LatLng(-33.85281800,151.21156500),
        new google.maps.LatLng(-33.85285100,151.21156500),
        new google.maps.LatLng(-33.85288900,151.21156300),
        new google.maps.LatLng(-33.85324800,151.21152300),
        new google.maps.LatLng(-33.85589700,151.21136400),
        new google.maps.LatLng(-33.85815100,151.21125700),
        new google.maps.LatLng(-33.85985100,151.21107500),
        new google.maps.LatLng(-33.86047800,151.21151000)
    ];


    var neutralTripCoords = [
        new google.maps.LatLng(-33.86047800,151.21151000),
        new google.maps.LatLng(-33.85578400,151.21142000),
        new google.maps.LatLng(-33.85535600,151.21153200),
        new google.maps.LatLng(-33.85521400,151.21166600),
        new google.maps.LatLng(-33.85508900,151.21187600),
        new google.maps.LatLng(-33.85502200,151.21202600),
        new google.maps.LatLng(-33.85484400,151.21267000),
        new google.maps.LatLng(-33.85460400,151.21392000),
        new google.maps.LatLng(-33.85440300,151.21529800),
        new google.maps.LatLng(-33.85359200,151.22136500),
        new google.maps.LatLng(-33.85347200,151.22212700),
        new google.maps.LatLng(-33.85328900,151.22254600),
        new google.maps.LatLng(-33.85303100,151.22281900),
        new google.maps.LatLng(-33.85275900,151.22298500),
        new google.maps.LatLng(-33.85237200,151.22311900),
        new google.maps.LatLng(-33.85186400,151.22320000),
        new google.maps.LatLng(-33.85121800,151.22309800),
        new google.maps.LatLng(-33.85068800,151.22295300),
        new google.maps.LatLng(-33.85021500,151.22261000),
        new google.maps.LatLng(-33.84993900,151.22230400),
        new google.maps.LatLng(-33.84981400,151.22207300),
        new google.maps.LatLng(-33.84963600,151.22132800),
        new google.maps.LatLng(-33.84936200,151.22020100),
        new google.maps.LatLng(-33.84897200,151.22060700),
        new google.maps.LatLng(-33.84894300,151.22062100),
        new google.maps.LatLng(-33.84886400,151.22065900),
        new google.maps.LatLng(-33.84863000,151.22076900),
        new google.maps.LatLng(-33.84761900,151.22123100),
        new google.maps.LatLng(-33.84757700,151.22124400),
        new google.maps.LatLng(-33.84750900,151.22125300),
        new google.maps.LatLng(-33.84687400,151.22126300),
        new google.maps.LatLng(-33.84684400,151.22125800),
        new google.maps.LatLng(-33.84680400,151.22125000),
        new google.maps.LatLng(-33.84675500,151.22123700),
        new google.maps.LatLng(-33.84667600,151.22120900),
        new google.maps.LatLng(-33.84571600,151.22087000),
        new google.maps.LatLng(-33.84562400,151.22083300),
        new google.maps.LatLng(-33.84555900,151.22080600),
        new google.maps.LatLng(-33.84543900,151.22072400),
        new google.maps.LatLng(-33.84536100,151.22066300),
        new google.maps.LatLng(-33.84529500,151.22060000),
        new google.maps.LatLng(-33.84526200,151.22056200),
        new google.maps.LatLng(-33.84513300,151.22032900),
        new google.maps.LatLng(-33.84507400,151.22021100),
        new google.maps.LatLng(-33.84506100,151.22016000),
        new google.maps.LatLng(-33.84503500,151.21998800),
        new google.maps.LatLng(-33.84498800,151.21971900),
        new google.maps.LatLng(-33.84483500,151.21870100),
        new google.maps.LatLng(-33.84431400,151.21885300),
        new google.maps.LatLng(-33.84384100,151.21900100),
        new google.maps.LatLng(-33.84335800,151.21911000),
        new google.maps.LatLng(-33.84277400,151.21919900),
        new google.maps.LatLng(-33.84230900,151.21928200),
        new google.maps.LatLng(-33.84257900,151.21982000),
        new google.maps.LatLng(-33.84282000,151.22043700),
        new google.maps.LatLng(-33.84318000,151.22131200),
        new google.maps.LatLng(-33.84343900,151.22177300),
        new google.maps.LatLng(-33.84381300,151.22156400),
        new google.maps.LatLng(-33.84405400,151.22143000),
        new google.maps.LatLng(-33.84411200,151.22142400),
        new google.maps.LatLng(-33.84415300,151.22142200),
        new google.maps.LatLng(-33.84426000,151.22143000),
        new google.maps.LatLng(-33.84438600,151.22144000),
        new google.maps.LatLng(-33.84452700,151.22147300),
        new google.maps.LatLng(-33.84473500,151.22153200),
        new google.maps.LatLng(-33.84496700,151.22160000),
        new google.maps.LatLng(-33.84521100,151.22166700),
        new google.maps.LatLng(-33.84555700,151.22176200),
        new google.maps.LatLng(-33.84620100,151.22190700),
        new google.maps.LatLng(-33.84736000,151.22212700),
        new google.maps.LatLng(-33.84765800,151.22217100),
        new google.maps.LatLng(-33.84772900,151.22217100),
        new google.maps.LatLng(-33.84778500,151.22216900),
        new google.maps.LatLng(-33.84785000,151.22215700),
        new google.maps.LatLng(-33.84790800,151.22214600),
        new google.maps.LatLng(-33.84795900,151.22213500),
        new google.maps.LatLng(-33.84804000,151.22210200),
        new google.maps.LatLng(-33.84813700,151.22203100),
        new google.maps.LatLng(-33.84825700,151.22194500),
        new google.maps.LatLng(-33.84835500,151.22185600),
        new google.maps.LatLng(-33.84846200,151.22174700),
        new google.maps.LatLng(-33.84864900,151.22150300),
        new google.maps.LatLng(-33.84886500,151.22121900),
        new google.maps.LatLng(-33.84911600,151.22084100),
        new google.maps.LatLng(-33.84936200,151.22020100),
        new google.maps.LatLng(-33.84963600,151.22132800),
        new google.maps.LatLng(-33.84981400,151.22207300),
        new google.maps.LatLng(-33.84993900,151.22230400),
        new google.maps.LatLng(-33.85021500,151.22261000),
        new google.maps.LatLng(-33.85068800,151.22295300),
        new google.maps.LatLng(-33.85121800,151.22309800),
        new google.maps.LatLng(-33.85186400,151.22320000),
        new google.maps.LatLng(-33.85237200,151.22311900),
        new google.maps.LatLng(-33.85275900,151.22298500),
        new google.maps.LatLng(-33.85303100,151.22281900),
        new google.maps.LatLng(-33.85328900,151.22254600),
        new google.maps.LatLng(-33.85347200,151.22212700),
        new google.maps.LatLng(-33.85359200,151.22136500),
        new google.maps.LatLng(-33.85440300,151.21529800),
        new google.maps.LatLng(-33.85460400,151.21392000),
        new google.maps.LatLng(-33.85484400,151.21267000),
        new google.maps.LatLng(-33.85502200,151.21202600),
        new google.maps.LatLng(-33.85508900,151.21187600),
        new google.maps.LatLng(-33.85521400,151.21166600),
        new google.maps.LatLng(-33.85535600,151.21153200),
        new google.maps.LatLng(-33.85578400,151.21142000),
        new google.maps.LatLng(-33.86047800,151.21151000)
    ];


    var mosmanTripCoords = [
        new google.maps.LatLng(-33.86047800,151.21151000),
        new google.maps.LatLng(-33.86023400,151.21110100),
        new google.maps.LatLng(-33.85679200,151.21146900),
        new google.maps.LatLng(-33.85633400,151.21153200),
        new google.maps.LatLng(-33.85604500,151.21159500),
        new google.maps.LatLng(-33.85573600,151.21167500),
        new google.maps.LatLng(-33.85554000,151.21172300),
        new google.maps.LatLng(-33.85542800,151.21177000),
        new google.maps.LatLng(-33.85534400,151.21182600),
        new google.maps.LatLng(-33.85529600,151.21187800),
        new google.maps.LatLng(-33.85523600,151.21197600),
        new google.maps.LatLng(-33.85520500,151.21207400),
        new google.maps.LatLng(-33.85517400,151.21224000),
        new google.maps.LatLng(-33.85499100,151.21308800),
        new google.maps.LatLng(-33.85474600,151.21426800),
        new google.maps.LatLng(-33.85455500,151.21581900),
        new google.maps.LatLng(-33.85432000,151.21778000),
        new google.maps.LatLng(-33.85364300,151.22479700),
        new google.maps.LatLng(-33.85337600,151.22691000),
        new google.maps.LatLng(-33.85317100,151.22789700),
        new google.maps.LatLng(-33.85294800,151.22853000),
        new google.maps.LatLng(-33.85273400,151.22885200),
        new google.maps.LatLng(-33.85250200,151.22905600),
        new google.maps.LatLng(-33.85213700,151.22928100),
        new google.maps.LatLng(-33.85119300,151.22965700),
        new google.maps.LatLng(-33.84871500,151.23054700),
        new google.maps.LatLng(-33.84760700,151.23097400),
        new google.maps.LatLng(-33.84863800,151.23113200),
        new google.maps.LatLng(-33.84981400,151.23150800),
        new google.maps.LatLng(-33.85013400,151.23167700),
        new google.maps.LatLng(-33.85045500,151.23187800),
        new google.maps.LatLng(-33.85061600,151.23201200),
        new google.maps.LatLng(-33.85071600,151.23215700),
        new google.maps.LatLng(-33.85091000,151.23248900),
        new google.maps.LatLng(-33.85095000,151.23283000),
        new google.maps.LatLng(-33.85093900,151.23329400),
        new google.maps.LatLng(-33.85084500,151.23370200),
        new google.maps.LatLng(-33.85045100,151.23435300),
        new google.maps.LatLng(-33.85006800,151.23489000),
        new google.maps.LatLng(-33.84991200,151.23495200),
        new google.maps.LatLng(-33.84963500,151.23510200),
        new google.maps.LatLng(-33.84932600,151.23519600),
        new google.maps.LatLng(-33.84902700,151.23524900),
        new google.maps.LatLng(-33.84880200,151.23526500),
        new google.maps.LatLng(-33.84858900,151.23528700),
        new google.maps.LatLng(-33.84833500,151.23524900),
        new google.maps.LatLng(-33.84812500,151.23516400),
        new google.maps.LatLng(-33.84782000,151.23502100),
        new google.maps.LatLng(-33.84740300,151.23472900),
        new google.maps.LatLng(-33.84639400,151.23396200),
        new google.maps.LatLng(-33.84602700,151.23368600),
        new google.maps.LatLng(-33.84567700,151.23343100),
        new google.maps.LatLng(-33.84524700,151.23314600),
        new google.maps.LatLng(-33.84492800,151.23293500),
        new google.maps.LatLng(-33.84466300,151.23276600),
        new google.maps.LatLng(-33.84445600,151.23264800),
        new google.maps.LatLng(-33.84425300,151.23257500),
        new google.maps.LatLng(-33.84402000,151.23254300),
        new google.maps.LatLng(-33.84371900,151.23255400),
        new google.maps.LatLng(-33.84327800,151.23260000),
        new google.maps.LatLng(-33.84295000,151.23229600),
        new google.maps.LatLng(-33.84246000,151.23189900),
        new google.maps.LatLng(-33.84174900,151.23130600),
        new google.maps.LatLng(-33.84132300,151.23089800),
        new google.maps.LatLng(-33.84108600,151.23064600),
        new google.maps.LatLng(-33.84091700,151.23047900),
        new google.maps.LatLng(-33.84050300,151.23052200),
        new google.maps.LatLng(-33.83960300,151.23061400),
        new google.maps.LatLng(-33.83927300,151.23070500),
        new google.maps.LatLng(-33.83905500,151.23079600),
        new google.maps.LatLng(-33.83893000,151.23088200),
        new google.maps.LatLng(-33.83879600,151.23105900),
        new google.maps.LatLng(-33.83868000,151.23130600),
        new google.maps.LatLng(-33.83857800,151.23170300),
        new google.maps.LatLng(-33.83848400,151.23231900)
    ];


    var easternTripCoords = [
        new google.maps.LatLng(-33.86047800,151.21151000),
        new google.maps.LatLng(-33.85976400,151.21116000),
        new google.maps.LatLng(-33.85735400,151.21149800),
        new google.maps.LatLng(-33.85628200,151.21165700),
        new google.maps.LatLng(-33.85582800,151.21174800),
        new google.maps.LatLng(-33.85558500,151.21181800),
        new google.maps.LatLng(-33.85543600,151.21188700),
        new google.maps.LatLng(-33.85530200,151.21200000),
        new google.maps.LatLng(-33.85519500,151.21219600),
        new google.maps.LatLng(-33.85511700,151.21263300),
        new google.maps.LatLng(-33.85505900,151.21366800),
        new google.maps.LatLng(-33.85506200,151.21467700),
        new google.maps.LatLng(-33.85513100,151.21550000),
        new google.maps.LatLng(-33.85517800,151.21615500),
        new google.maps.LatLng(-33.85522400,151.21688200),
        new google.maps.LatLng(-33.85527100,151.21764100),
        new google.maps.LatLng(-33.85530000,151.21816400),
        new google.maps.LatLng(-33.85542300,151.22058200),
        new google.maps.LatLng(-33.85554800,151.22213800),
        new google.maps.LatLng(-33.85573100,151.22432100),
        new google.maps.LatLng(-33.85581100,151.22522800),
        new google.maps.LatLng(-33.85587800,151.22581200),
        new google.maps.LatLng(-33.85605600,151.22656900),
        new google.maps.LatLng(-33.85625200,151.22722300),
        new google.maps.LatLng(-33.85654600,151.22782900),
        new google.maps.LatLng(-33.85687600,151.22848400),
        new google.maps.LatLng(-33.85725000,151.22894500),
        new google.maps.LatLng(-33.85796700,151.22976100),
        new google.maps.LatLng(-33.85814200,151.22996500),
        new google.maps.LatLng(-33.85828300,151.23062400),
        new google.maps.LatLng(-33.85843500,151.23138100),
        new google.maps.LatLng(-33.85854200,151.23191200),
        new google.maps.LatLng(-33.85877300,151.23260900),
        new google.maps.LatLng(-33.85919200,151.23339800),
        new google.maps.LatLng(-33.85960200,151.23409500),
        new google.maps.LatLng(-33.86019900,151.23480300),
        new google.maps.LatLng(-33.86110800,151.23558100),
        new google.maps.LatLng(-33.86193600,151.23633200),
        new google.maps.LatLng(-33.86258600,151.23678300),
        new google.maps.LatLng(-33.86373600,151.23758700),
        new google.maps.LatLng(-33.86480000,151.23822000),
        new google.maps.LatLng(-33.86570000,151.23888000),
        new google.maps.LatLng(-33.86645300,151.23948800),
        new google.maps.LatLng(-33.86608800,151.23977100),
        new google.maps.LatLng(-33.86570000,151.24009800),
        new google.maps.LatLng(-33.86550000,151.24037700),
        new google.maps.LatLng(-33.86536600,151.24073100),
        new google.maps.LatLng(-33.86534400,151.24125700),
        new google.maps.LatLng(-33.86547700,151.24185700),
        new google.maps.LatLng(-33.86581100,151.24238300),
        new google.maps.LatLng(-33.86652900,151.24292500),
        new google.maps.LatLng(-33.86728100,151.24314000),
        new google.maps.LatLng(-33.86794500,151.24326300),
        new google.maps.LatLng(-33.86876000,151.24326800),
        new google.maps.LatLng(-33.86985600,151.24319300),
        new google.maps.LatLng(-33.87073800,151.24304300),
        new google.maps.LatLng(-33.87136600,151.24292500),
        new google.maps.LatLng(-33.87313000,151.24256000),
        new google.maps.LatLng(-33.87195400,151.24293600),
        new google.maps.LatLng(-33.87084500,151.24331700),
        new google.maps.LatLng(-33.86906300,151.24393300),
        new google.maps.LatLng(-33.86721900,151.24460900),
        new google.maps.LatLng(-33.86555300,151.24523700),
        new google.maps.LatLng(-33.86421200,151.24566100),
        new google.maps.LatLng(-33.86287100,151.24636900),
        new google.maps.LatLng(-33.86203900,151.24687900),
        new google.maps.LatLng(-33.86124100,151.24758100),
        new google.maps.LatLng(-33.86034600,151.24874500),
        new google.maps.LatLng(-33.86030700,151.25121100),
        new google.maps.LatLng(-33.86036800,151.25346600),
        new google.maps.LatLng(-33.86052400,151.25554700),
        new google.maps.LatLng(-33.86095600,151.25698000),
        new google.maps.LatLng(-33.86158400,151.25800400),
        new google.maps.LatLng(-33.86263100,151.25907200),
        new google.maps.LatLng(-33.86350400,151.25968900),
        new google.maps.LatLng(-33.86453300,151.26012900),
        new google.maps.LatLng(-33.86531700,151.26048300),
        new google.maps.LatLng(-33.86596700,151.26081500),
        new google.maps.LatLng(-33.86652400,151.26098200),
        new google.maps.LatLng(-33.86830100,151.26132000),
        new google.maps.LatLng(-33.86979800,151.26178100),
        new google.maps.LatLng(-33.87032800,151.26199500),
        new google.maps.LatLng(-33.87072400,151.26219900),
        new google.maps.LatLng(-33.87023900,151.26215100),
        new google.maps.LatLng(-33.86852800,151.26202800),
        new google.maps.LatLng(-33.86577600,151.26179700),
        new google.maps.LatLng(-33.86375300,151.26159300),
        new google.maps.LatLng(-33.86227900,151.26148600),
        new google.maps.LatLng(-33.86057300,151.26120700),
        new google.maps.LatLng(-33.85655900,151.26066000),
        new google.maps.LatLng(-33.85276800,151.26023600),
        new google.maps.LatLng(-33.85158800,151.26020900),
        new google.maps.LatLng(-33.85044300,151.26025200),
        new google.maps.LatLng(-33.84939100,151.26046700),
        new google.maps.LatLng(-33.84834000,151.26070300),
        new google.maps.LatLng(-33.84729700,151.26135200),
        new google.maps.LatLng(-33.84630400,151.26228000),
        new google.maps.LatLng(-33.84557300,151.26368500),
        new google.maps.LatLng(-33.84409100,151.26691800),
        new google.maps.LatLng(-33.84348500,151.27142400),
        new google.maps.LatLng(-33.84347900,151.27568000),
        new google.maps.LatLng(-33.84346100,151.27915600),
        new google.maps.LatLng(-33.84345400,151.28097800)
    ];

    var manlyTrip = new google.maps.Polyline({
        path: manlyTripCoords,
        geodesic: true,
        strokeColor: "#bf5757",
        strokeOpacity: 1,
        strokeWeight: 3
    });

    var tarongaTrip = new google.maps.Polyline({
        path: tarongaTripCoords,
        geodesic: true,
        strokeColor: "#30bda1",
        strokeOpacity: 1,
        strokeWeight: 3
    });

    var parramattaTrip = new google.maps.Polyline({
        path: parramattaTripCoords,
        geodesic: true,
        strokeColor: "#e2b076",
        strokeOpacity: 1,
        strokeWeight: 3
    });

    var darlingTrip = new google.maps.Polyline({
        path: darlingTripCoords,
        geodesic: true,
        strokeColor: "#59acb3",
        strokeOpacity: 1,
        strokeWeight: 3
    });

    var neutralTrip = new google.maps.Polyline({
        path: neutralTripCoords,
        geodesic: true,
        strokeColor: "#798fa7",
        strokeOpacity: 1,
        strokeWeight: 3
    });

    var mosmanTrip = new google.maps.Polyline({
        path: mosmanTripCoords,
        geodesic: true,
        strokeColor: "#c98abf",
        strokeOpacity: 1,
        strokeWeight: 3
    });

    var easternTrip = new google.maps.Polyline({
        path: easternTripCoords,
        geodesic: true,
        strokeColor: "#eee8c0",
        strokeOpacity: 1,
        strokeWeight: 3
    });

    var infoBubble;google.maps.event.addListener(manlyTrip, 'click', function(event) {
        var latLng = new google.maps.LatLng(event.latLng.lat(),event.latLng.lng());
        if(infoBubble)
        {
            infoBubble.close(map);
            infoBubble.setMap(null);
        }
        infoBubble = new InfoBubble({
            map: map,
            content: '<div class="infoBubble routes manly"><h5>Manly</h5><a href="<?=$baseURL?>/route/manly" class="directive">Go to route</a></div>',
            position: latLng,
            shadowStyle: 1,
            padding: 0,
            backgroundColor: '#bf5757',
            borderRadius: 0,
            arrowSize: 10,
            borderWidth: 1,
            borderColor: '#bf5757',
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

    google.maps.event.addListener(tarongaTrip, 'click', function(event) {
        var latLng = new google.maps.LatLng(event.latLng.lat(),event.latLng.lng());
        if(infoBubble)
        {
            infoBubble.close(map);
            infoBubble.setMap(null);
        }
        infoBubble = new InfoBubble({
            map: map,
            content: '<div class="infoBubble routes taronga"><h5>Taronga Zoo</h5><a href="<?=$baseURL?>/route/taronga-zoo" class="directive">Go to route</a></div>',
            position: latLng,
            shadowStyle: 1,
            padding: 0,
            backgroundColor: '#30bda1',
            borderRadius: 0,
            arrowSize: 10,
            borderWidth: 1,
            borderColor: '#30bda1',
            disableAutoPan: true,
            hideCloseButton: false,
            arrowPosition: 25,
            backgroundClassName: 'infoBubbleWrapper',
            arrowStyle: 0,
            disableAutoPan: true,
            minWidth: 200,
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
            content: '<div class="infoBubble routes parramatta"><h5>Parramatta River</h5><a href="<?=$baseURL?>/route/parramatta-river" class="directive">Go to route</a></div>',
            position: latLng,
            shadowStyle: 1,
            padding: 0,
            backgroundColor: '#e2b076',
            borderRadius: 0,
            arrowSize: 10,
            borderWidth: 1,
            borderColor: '#e2b076',
            disableAutoPan: true,
            hideCloseButton: false,
            arrowPosition: 25,
            backgroundClassName: 'infoBubbleWrapper',
            arrowStyle: 0,
            disableAutoPan: true,
            minWidth: 240,
            minHeight: 70
        });
        infoBubble.setPosition(latLng);
        infoBubble.open(map);
    });

    google.maps.event.addListener(darlingTrip, 'click', function(event) {
        var latLng = new google.maps.LatLng(event.latLng.lat(),event.latLng.lng());
        if(infoBubble)
        {
            infoBubble.close(map);
            infoBubble.setMap(null);
        }
        infoBubble = new InfoBubble({
            map: map,
            content: '<div class="infoBubble routes darling"><h5>Darling Harbour</h5><a href="<?=$baseURL?>/route/darling-harbour" class="directive">Go to route</a></div>',
            position: latLng,
            shadowStyle: 1,
            padding: 0,
            backgroundColor: '#59acb3',
            borderRadius: 0,
            arrowSize: 10,
            borderWidth: 1,
            borderColor: '#59acb3',
            disableAutoPan: true,
            hideCloseButton: false,
            arrowPosition: 25,
            backgroundClassName: 'infoBubbleWrapper',
            arrowStyle: 0,
            disableAutoPan: true,
            minWidth: 240,
            minHeight: 70
        });
        infoBubble.setPosition(latLng);
        infoBubble.open(map);
    });

    google.maps.event.addListener(neutralTrip, 'click', function(event) {
        var latLng = new google.maps.LatLng(event.latLng.lat(),event.latLng.lng());
        if(infoBubble)
        {
            infoBubble.close(map);
            infoBubble.setMap(null);
        }
        infoBubble = new InfoBubble({
            map: map,
            content: '<div class="infoBubble routes neutral"><h5>Neutral Bay</h5><a href="<?=$baseURL?>/route/neutral-bay" class="directive">Go to route</a></div>',
            position: latLng,
            shadowStyle: 1,
            padding: 0,
            backgroundColor: '#798fa7',
            borderRadius: 0,
            arrowSize: 10,
            borderWidth: 1,
            borderColor: '#798fa7',
            disableAutoPan: true,
            hideCloseButton: false,
            arrowPosition: 25,
            backgroundClassName: 'infoBubbleWrapper',
            arrowStyle: 0,
            disableAutoPan: true,
            minWidth: 200,
            minHeight: 70
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
            content: '<div class="infoBubble routes mosman"><h5>Mosman Bay</h5><a href="<?=$baseURL?>/route/mosman-bay" class="directive">Go to route</a></div>',
            position: latLng,
            shadowStyle: 1,
            padding: 0,
            backgroundColor: '#c98abf',
            borderRadius: 0,
            arrowSize: 10,
            borderWidth: 1,
            borderColor: '#c98abf',
            disableAutoPan: true,
            hideCloseButton: false,
            arrowPosition: 25,
            backgroundClassName: 'infoBubbleWrapper',
            arrowStyle: 0,
            disableAutoPan: true,
            minWidth: 210,
            minHeight: 70
        });
        infoBubble.setPosition(latLng);
        infoBubble.open(map);
    });

    google.maps.event.addListener(easternTrip, 'click', function(event) {
        var latLng = new google.maps.LatLng(event.latLng.lat(),event.latLng.lng());
        if(infoBubble)
        {
            infoBubble.close(map);
            infoBubble.setMap(null);
        }
        infoBubble = new InfoBubble({
            map: map,
            content: '<div class="infoBubble routes eastern"><h5>Eastern Suburbs</h5><a href="<?=$baseURL?>/route/eastern-suburbs" class="directive">Go to route</a></div>',
            position: latLng,
            shadowStyle: 1,
            padding: 0,
            backgroundColor: '#eee8c0',
            borderRadius: 0,
            arrowSize: 10,
            borderWidth: 1,
            borderColor: '#eee8c0',
            disableAutoPan: true,
            hideCloseButton: false,
            arrowPosition: 25,
            backgroundClassName: 'infoBubbleWrapper',
            arrowStyle: 0,
            disableAutoPan: true,
            minWidth: 300,
            minHeight: 70
        });
        infoBubble.setPosition(latLng);
        infoBubble.open(map);
    });

    manlyTrip.setMap(map);
    tarongaTrip.setMap(map);
    parramattaTrip.setMap(map);
    darlingTrip.setMap(map);
    neutralTrip.setMap(map);
    mosmanTrip.setMap(map);
    easternTrip.setMap(map);
    var iconBase = '<?=$baseURL?>/img/';
    var thmbBase = '<?=$baseURL?>/img/locations/thumbnails/';
    var markerLocations = [
        {
            routeFrom: "Circular Quay",
            routeTo: "Eastern Suburbs",
            lat: -33.856959,
            lng: 151.220294,
            icon: iconBase + 'lightCameraMarker.png',
            height: 260,
            content: '<p>Stand at the front of the boat : contrast of the Eastern side of the Opera House in darkness with the illuminated Harbour Bridge and MCA in the background.</p>'
        },
        {
            routeFrom: "Manly",
            routeTo: "Circular Quay",
            lat: -33.852992,
            lng: 151.251783,
            icon: iconBase + 'lightCameraMarker.png',
            height: 220,
            content: '<p>Stand on the front outer deck, your line of sight will be as high as the images on the Opera House.</p>'
        },
        {
            routeFrom: "Circular Quay",
            routeTo: "Manly",
            lat: -33.860644,
            lng: 151.21081,
            icon: iconBase + 'lightCameraMarker.png',
            height: 300,
            content: '<p>Go to the back of the boat. As the ferry pulls away from the wharf, try to capture both the MCA to your right, the Opera House on your left and the illuminated First Fleet Ferries at Circular Quay in the one photo.</p>'
        },
        {
            routeFrom: "Circular Quay",
            routeTo: "Taronga",
            lat: -33.84809,
            lng: 151.237578,
            height: 320,
            icon: iconBase + 'lightCameraMarker.png',
            content: '<p>One of the least busiest ferry routes during Vivid, take the 40 minute round trip in the early evening with the local commuters to get a great overview of Harbour Lights on the Ferries to the east of Circular Quay.</p>'
        },
        {
            routeFrom: "Circular Quay",
            routeTo: "Mosman",
            lat: -33.842743,
            lng: 151.231399,
            icon: iconBase + 'lightCameraMarker.png',
            height: 273,
            content: '<p>If you want to get away from the crowds but still see the lights, the  return trip to Mosman Bay will allow you to relax on a ferry with a full view of the Opera House, Bridge and MCA.</p>'
        },
        {
            routeFrom: "Circular Quay",
            routeTo: "Darling Harbour",
            lat: -33.861775,
            lng: 151.199384,
            icon: iconBase + 'lightCameraMarker.png',
            height: 260,
            content: '<p>Take a seat at the front of the top deck of the Ferry for the best view of Aquatic Lights on the sails of the Australian National Maritime Museum.</p>'
        },
        {
            routeFrom: "Darling Harbour",
            routeTo: "Circular Quay",
            lat: -33.854648,
            lng: 151.201186,
            icon: iconBase + 'lightCameraMarker.png',
            height: 373,
            content: '<p>Berthing at McMahons and Milsons Point provides unrivalled views of the western side of the Bridge and Harbour Lights vessels on Parramatta River. If you can line up the angle correctly from the front of the ferry, see if you can capture the Opera House sails under the Harbour Bridge.</p>'
        },
        {
            routeFrom: "Circular Quay",
            routeTo: "Parramatta",
            lat: -33.849801,
            lng: 151.199641,
            icon: iconBase + 'lightCameraMarker.png',
            height: 260,
            content: '<p>Stand on the front outside deck, you\'ll be barely above the water level, for the beat reflections of the Harbour Bridge on Sydney Harbour.</p>'
        },
        {
            routeFrom: "Parramatta",
            routeTo: "Circular Quay",
            lat: -33.845096,
            lng: 151.166167,
            icon: iconBase + 'lightCameraMarker.png',
            height: 280,
            content: '<p>On approach from the west, capture the wonderful contrast of the stillness of Cockatoo Island and Goat Island in the foreground as the Harbour Bridge lights up the night sky beyond.</p>'
        },
        {
            routeFrom: "Circular Quay",
            routeTo: "Neutral Bay",
            lat: -33.843785,
            lng: 151.219103,
            icon: iconBase + 'lightCameraMarker.png',
            height: 360,
            content: '<p>Another great way to escape the crowds but still be entralled by the lights around Circular Quay. Try to capture the Harbour Lights vessels on their way to Circualr Quay, or capture the lights from the Opera Hosue reflecting off the rocks in front of Admiralty House.</p>'
        },
        {
            routeFrom: "Cockatoo Island",
            routeTo: "Circular Quay",
            lat: -33.845096,
            lng: 151.166167,
            icon: iconBase + 'lightCameraMarker.png',
            height: 300,
            content: '<p>This is the panoroamic way to see Harbour Lights. You might only get a glimpse of Darling Harbour, but you will get brilliant views of the Bridge standing behind the Balls Head, McMahons Point and Birchgrove.</p>'
        }

    ];



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

    /*$('.mapFilter').on('click', function(e){
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
    });*/

    function showLocations(locations)
    {
        for (var i=0; i<locations.length;i++)
        {
            (function(location){
                var latLng = new google.maps.LatLng(location.lat,location.lng);
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
                locationContent += '<div class="contentHolder">';
                locationContent += '<div class="closeBg"></div>';
                locationContent += location.content;
                locationContent += '</div>';
                locationContent += '<div class="textHolder">';
                locationContent += '<span>'+location.routeFrom+' to:</span>';
                locationContent += '<h5>'+location.routeTo+'</h5>';
                locationContent += '</div>';

                var locationBubble = new InfoBubble({
                    map: map,
                    content: locationContent,
                    position: latLng,
                    shadowStyle: 1,
                    padding: 0,
                    backgroundColor: orange,
                    borderRadius: 0,
                    arrowSize: 10,
                    borderWidth: 0,
                    borderColor: orange,
                    disableAutoPan: false,
                    hideCloseButton: false,
                    arrowPosition: 25,
                    backgroundClassName: 'locationBubbleWrapper photoSpots',
                    arrowStyle: 0,
                    disableAutoPan: true,
                    maxWidth: 260,
                    minHeight: location.height,
                    maxHeight: 1000
                });

                google.maps.event.addListener(marker, 'click', function(){
                    locationBubble.open(map, marker);
                });

                google.maps.event.addListener(locationBubble,'domready', function(){
                    $('.panelFlyoutTrigger').on('click', function(e) {
                        e.preventDefault();
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
            var toggleTargetIn = (mapCanvasWidth - controlPanelWidth) - toggleMapControlPanelWidth + variant;
            var toggleTargetOut = (mapCanvasWidth - toggleMapControlPanelWidth) + variant;

            //console.log('['+$('#mapControlPanelHolder').is(':visible')+']');

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

<script src="../js/foundation/foundation.orbit.js"></script>

<script>


$(function() {

    $('#photoTipsHolder').foundation('orbit');

    $('#photoTipsHolder').on('after-slide-change.fndtn.orbit', function(event, orbit) {
        $('#photoTipsNav ul li.active').removeClass('active');
        $('#photoTipsNav ul li:eq('+orbit.slide_number+')').addClass('active');
    });

});
</script>

<?php
include '../includes/analytics.php';
?>
</body>
</html>
