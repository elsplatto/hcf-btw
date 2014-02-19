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
        <span class="credit">Photo by Joel Coleman</span>
        <span><a href="<?=$baseURL?>/gallery#featuredPhotographer">View more</a></span>
    </div>
    <section class="promoHolder">
        <div class="row">
            <div class="large-12">
                <div class="large-3 tweetSlider">
                    <ul data-orbit>
                    <?php
                    $tweetCount = 0;
                    $tweetMax = 3;
                    foreach ($twitterResults as $tweet)
                    {
                    $tweetText = $tweet->text;
                    ?>
                    <li class="large-3 columns">
                        <div class="tile">


                            <div class="tweetText">
                                <?=$tweetText?>
                            </div>
                            <div class="tweetCred">
                                <a href="http://twitter.com/<?=$tweet->user->name?>" target="_blank" rel="nofollow">@<?=$tweet->user->name?></a>
                            </div>
                        </div>
                    </li>

                    <?php
                        $tweetCount++;
                        if ($tweetCount >= $tweetMax) {
                            break;
                        }
                    }
                    ?>
                    </ul>
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
                <a href="<?=$baseURL?>/page/sydney-harbour-history" class="button wire white">Read the Article</a>
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

        <div class="large-12" id="map-canvas">
            <div id="map-canvas-loader"></div>
        </div>
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
include 'includes/instagram-shot-of-the-day.php';
include 'includes/footer.php';
?>


<?php
$pageId = 1;
include 'includes/global-js.php';
include 'includes/instagram-js.php';
include 'includes/map-code.php';
?>

<script src="js/foundation/foundation.orbit.js"></script>

<script>
$(document).foundation({
    orbit: {
        animation: 'slide', // Sets the type of animation used for transitioning between slides, can also be 'fade'
        timer_speed: 10000 ,
        pause_on_hover: false,
        animation_speed: 500,
        navigation_arrows: false,
        bullets: false,
        slide_number: false
    }
});

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



});
</script>

<?php
include 'includes/analytics.php';
?>
</body>
</html>
