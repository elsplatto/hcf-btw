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
<section class="featureImgHolder marginBottomStandard"> <?php
    if (!$device->isMobile())
    {
    ?>
    <ul id="featureImageCarousel" data-orbit data-options="animation: slide;timer_speed: 10000; swipe: true;
                    pause_on_hover: false;
                    animation_speed: 500;
                    navigation_arrows: true;
                    bullets: false;
                    slide_number: false">
        <li>
            <img src="img/featureImages/sunset.jpg" />
        </li>
        <li>
            <img src="img/featureImages/ferries.jpg" />
        </li>
        <li>
            <img src="img/featureImages/manlyAerial.jpg" />
        </li>
        <li>
            <img src="img/featureImages/bridgeSunset.jpg" />
        </li>

    </ul>
    <?php
    }
    ?>
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
            <div class="large-12 small-12">
                <div class="large-3 small-3 tweetSlider">
                    <ul id="tweetList" data-orbit data-options="animation: slide; timer_speed: 10000;
                    pause_on_hover: false;
                    animation_speed: 500;
                    navigation_arrows: false;
                    bullets: false;
                    slide_number: false">
                    <?php
                    $tweetCount = 0;
                    $tweetMax = 3;
                    foreach ($twitterResults as $tweet)
                    {
                    $tweetText = $tweet->text;
                    ?>
                    <li class="large-3 small-3 columns">
                        <div class="tile">


                            <div class="tweetText">
                                <?=$tweetText?>
                            </div>
                            <div class="tweetCred">
                                <a href="http://twitter.com/<?=$tweet->user->name?>" target="_blank" rel="nofollow">@<?=$tweet->user->name?></a>

                                <a href="https://twitter.com/share?url=<?=$baseURL?>/&text=Living like a local&hashtag=beyondthewharf&count=none" class="twitter-share-button right marginTop3" data-lang="en">Tweet</a>
                                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
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

                <div class="large-3 small-3 columns">
                    <div class="imgHolder">
                        <a href="#"><img src="img/promoImages/promo1.jpg" alt="Image of fireworks over Sydney Opera House on New Years Eve" /></a>
                    </div>
                    <div class="textHolder">
                        <span>Events</span>
                        <h5><a href="<?=$baseURL?>/events">Vivid</a></h5>
                    </div>
                </div>

                <div class="large-3 small-3 columns">
                    <div class="imgHolder">
                        <a href="#"><img src="img/promoImages/promo2.jpg" alt="Image of Musicians" /></a>
                    </div>
                    <div class="textHolder">
                       <span>Attraction</span>
                        <h5><a href="#">Cockatoo Island</a></h5>
                    </div>
                </div>

                <div class="large-3 small-3 columns">
                    <div class="imgHolder">
                        <a href="#"><img src="img/promoImages/promo3.jpg" alt="" /></a>
                    </div>
                    <div class="textHolder">
                       <span>Itinerary</span>
                        <h5><a href="<?=$baseURL?>/itineraries">Sunday - Family Day</a></h5>
                    </div>
                </div>


            </div>
        </div>
    </section>
</section>

<section class="themeFeature">
    <div class="row marginBottomStandard">
        <h3 class="text-center">Explore our harbour through the eyes of locals</h3>
        <div class="large-12 small-12 columns">

            <div class="large-6 small-6 themedPromoText standardDarkGrey left">
                <span>The Child at Heart</span>
                <h3 class="block">Family Fun on Sydney Harbour</h3>
                <p>
                    Ferries reveal all those family-friendly places around Sydney that you don’t find in a <br />guide book.
                </p>
                <img src="img/themedPromos/profile.jpg" class="profile" alt="Picture of man and child." />
                <p>Mark Champley</p>
                <span class="purple">Customer Experience Manager &amp; father of nine</span>
            </div>
            <div class="large-6 small-6 themedPromoImage">
                <img src="img/themedPromos/mark_c.jpg" alt="Picture of family." />
                <div class="large-6 small-6 themedPromoOverlay">
                    <!--a href="#" class="button red play tungsten small">Watch the video</a-->
                    <a href="<?=$baseURL?>/page/child-at-heart" class="button wire white">Hear Mark's Story</a>
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


$(function() {

    $(document).foundation('orbit');
    //loadHomeImages();

    function loadHomeImages()
    {
        var imgHTML = '';
        imgHTML += '<li>';
        imgHTML += '<img src="img/featureImages/sunset.jpg" />';
        imgHTML += '</li>';
        imgHTML += '<li>';
        imgHTML += '<img src="img/featureImages/manlyAerial.jpg" />';
        imgHTML += '</li>';
        imgHTML += '<li>';
        imgHTML += '<img src="img/featureImages/ferries.jpg" />';
        imgHTML += '</li>';

        $(imgHTML).appendTo('#featureImageCarousel');

        $(document).foundation('orbit');
    }


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
