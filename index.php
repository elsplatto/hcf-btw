<?php
$pageHeading = "Home";
$pageMetaTitle = "Beyond the Wharf - Sydney Harbour, Sydney Activities, Sydney Ferries";
$pageSection = "home";
$pageMetaDesc = "Looking for great things to do in Sydney? Beyond the Wharf provides local and international insights to Sydney Harbour. ";
$pageMetaKeywords = "Sydney, harbour, experience, activities, events, share, contribute, locals, international, travel";

/*global includes in head.php*/
include 'includes/head.php';
?>


<body>
<?php
include 'includes/nav.php';
?>
<section id="featureImgHolder" class="homepage featureImgHolder marginBottomStandard">
    <?php
    if ($deviceType != 'phone')
    {
    ?>
    <ul id="featureImageCarousel" data-orbit data-options="animation: slide;timer_speed: 15000; swipe: true;
                    pause_on_hover: false;
                    animation_speed: 500;
                    navigation_arrows: true;
                    bullets: false;
                    slide_number: false;">
        <li>
            <img src="img/featureImages/sunset.jpg" data-latlng="33 47.877 S, 151 17.365 E" data-place="Manly Beach" data-route="Manly" data-class="manly" data-credit="Joel Coleman" />
        </li>

    </ul>
    <?php
    }
    else
    {
        ?>
        <ul id="featureImageCarousel" data-orbit data-options="animation: slide;timer_speed: 15000; swipe: true; timer: false
                    pause_on_hover: false;
                    animation_speed: 500;
                    navigation_arrows: true;
                    bullets: false;
                    slide_number: false;">
        <li>
            <img src="img/featureImages/phone/sunset.jpg" data-latlng="33 47.877 S, 151 17.365 E" data-place="Manly Beach" data-route="Manly" data-class="manly" data-credit="Joel Coleman" />
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
        <span class="latLng">33 47.877 S, 151 17.365 E</span>
        <span class="location">MANLY BEACH</span>
        <span class="routes manly">Manly</span>
        <span class="credit">Photo by Joel Coleman</span>
        <span><a href="<?=$baseURL?>/gallery#featuredPhotographer">View more</a></span>
    </div>
    <section class="promoHolder">
        <div class="row">

            <?php
            if ($deviceType == 'phone')
            {
            ?>

                <div class="large-3 medium-3 small-12 promoTile columns<?=$deviceClass?>">
                    <div class="imgHolder">
                        <img src="img/promoImages/<?=$folder?>sm-silk.jpg" alt="Saltmotion image of wave - by Joel Coleman" />
                    </div>
                    <div class="textHolder">
                        <span>Photo Competition</span>
                        <a href="<?=$baseURL?>/<?=$competitionURL?>&mode=competition&call_page=<?=$baseURL?>/?competitionId=1" id="competitionPromo" class="reveal-init button verboten" data-size="small" onClick="trackInternalLink('Homepage promo panel - mobile click', 'Competition 1 - Win $700 Art Print'); return false;">Win a $700 Art Print</a>
                    </div>
                </div>

                <div class="large-3 medium-3 small-12 tweetSlider">
                    <ul id="tweetList" data-orbit data-options="animation: slide; timer_speed: 10000;
            pause_on_hover: false;
            animation_speed: 500;
            navigation_arrows: false;
            bullets: false;
            slide_number: false">
                        <li class="preloader"></li>
                    </ul>
                </div>

            <?php
            }
            if ($deviceType != 'phone')
            {
            ?>

            <div class="large-3 medium-3 small-12 tweetSlider">
                <ul id="tweetList" data-orbit data-options="animation: slide; timer_speed: 10000;
            pause_on_hover: false;
            animation_speed: 500;
            navigation_arrows: false;
            bullets: false;
            slide_number: false">
                    <li class="preloader"></li>
                </ul>
            </div>
            <div class="large-3 medium-3 small-12 promoTile columns">
                <div class="imgHolder">
                    <img src="img/promoImages/sm-silk.jpg" alt="Saltmotion image of wave - by Joel Coleman" />
                </div>
                <div class="textHolder">
                    <span>Photo Competition</span>
                    <a href="<?=$baseURL?>/<?=$competitionURL?>&mode=competition&call_page=<?=$baseURL?>/?competitionId=1" id="competitionPromo" class="reveal-init button verboten" data-size="small" onClick="trackInternalLink('Homepage promo panel - click', 'Competition 1 - Win $700 Art Print'); return false;">Win a $700 Art Print</a>
                </div>
            </div>

            <!--div class="large-3 medium-3 small-12 columns hide-for-small-only">
                <div class="imgHolder">
                    <img src="img/promoImages/vivid_feature.jpg" alt="Image of Sydney Opera House during Vivid." />
                </div>
                <div class="textHolder">
                    <span>Events</span>
                    <h5><a href="<?=$baseURL?>/events">Vivid Sydney</a></h5>
                </div>
            </div-->

            <div class="large-3 medium-3 small-12 columns hide-for-small-only">
                <div class="imgHolder">
                    <img src="img/promoImages/Biennale-of-Sydney.jpg" alt="Image of Biennale of Sydney." />
                </div>
                <div class="textHolder">
                    <span>Events</span>
                    <h5><a href="<?=$baseURL?>/events">Biennale of Sydney</a></h5>
                </div>
            </div>



            <div class="large-3 medium-3 small-12 columns hide-for-small-only">
                <div class="imgHolder">
                    <img src="img/promoImages/promo3.jpg" alt="Image of Sydney Harbour from Watsons Bay" />
                </div>
                <div class="textHolder">
                   <span>Itinerary</span>
                    <h5><a href="<?=$baseURL?>/docs/beyondthewharf-family.pdf" target="_blank">Sunday - Family Day</a></h5>
                </div>
            </div>
            <?php
            }
            ?>

        </div>
    </section>
</section>

<?php
if ($deviceType != 'phone')
{
?>
<section class="themeFeature">
    <div class="row marginBottomStandard">

        <div class="large-12 columns homeAddThisHolder">
            <?php
            include 'includes/addthis.php';
            ?>
        </div>

        <h3 class="text-center">Unlock Sydney's best kept local secrets with our iconic ferry service</h3>


        <div class="large-12 columns">





            <div class="large-6 medium-12 small-12 themedPromoText standardDarkGrey left">
                <span>The Child at Heart</span>
                <h3 class="block">Family Fun on Sydney Harbour</h3>
                <p>
                    Ferries reveal all those family-friendly places around Sydney that you don’t find in a <br />guide book.
                </p>
                <a href="<?=$baseURL?>/page/child-at-heart" class="button wire white hide-for-large">Hear Mark's Story</a>
                <img src="img/themedPromos/profile.jpg" class="profile" alt="Picture of man and child." />
                <p>Mark Champley</p>
                <span class="purple">Customer Experience Manager &amp; father of nine</span>
            </div>
            <div class="large-6 hide-for-medium hide-for-small themedPromoImage">
                <img src="img/themedPromos/mark_c.jpg" alt="Picture of family." />
                <div class="large-6 medium-6 small-6 themedPromoOverlay">
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
          <a href="#" id="toggleMapControlPanel" class="toggleControlPanel"></a>

          <div id="mapControlPanelHolder" class="controlPanelHolder medium-6 small-6 large-3">
              <div id="mapControlPanel" class="controlPanel">
                <h6 class="white">FILTER:</h6>

                  <ul>
                  <?php
                  $filters = getFilters(1, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
                  for ($i = 0; $i < count($filters); $i++)
                  {
                    ?><li><a href="#" class="mapFilter" data-category="<?=$filters[$i]?>" data-visible="true"><?=$filters[$i]?></a></li><?php
                  }
                  ?>
                  </ul>
              </div>
          </div>
      </div>
  </div>
</section>
<?php
}
?>

<?php
include 'includes/instagram-shot-of-the-day.php';
include 'includes/footer.php';
?>


<?php
$pageId = 1;
include 'includes/global-js.php';
include 'includes/instagram-js.php';
if ($deviceType != 'phone')
{
    include 'includes/map-code.php';
}
?>

<script src="js/foundation/foundation.orbit.js"></script>

<script>


$(function() {

    <?if ($competitionId == 1)
    {
    ?>
    $('#competitionPromo').trigger('click');
    <?php
    }
    ?>
    loadHomeImages();
    fetchTweets();

    $("#featureImageCarousel").on("after-slide-change.fndtn.orbit", function(event, orbit) {

        var target = $('#featureImageCarousel li.active img');
        var latlng = target.attr('data-latlng');
        var place =  target.attr('data-place');
        var route = target.attr('data-route');
        var routeClass = target.attr('data-class');
        var credit = target.attr('data-credit');

        var creditHTML = '';
        creditHTML += '<span class="latLng">'+latlng+'</span>';
        creditHTML += '<span class="location">'+place+'</span>';
        creditHTML += '<span class="routes '+routeClass+'">'+route+'</span>';
        creditHTML += '<span class="credit">Photo by '+credit+'</span>';
        creditHTML += '<span><a href="<?=$baseURL?>/gallery#featuredPhotographer">View more</a></span>';

        $('#featureCreditPanel').html(creditHTML);
        $('#featureImgHolder').removeAttr('style');

    });

    function loadHomeImages()
    {

        <?php
        if ($deviceType != 'phone')
        {
            echo 'var folder = \'\'';
        }
        else
        {
            echo 'var folder = \'phone/\'';
        }
        ?>

        var imgHTML = '';
        imgHTML += '<li>';
        imgHTML += '<img src="img/featureImages/'+folder+'bridgeSunset.jpg" data-latlng="33 50.682 S, 151 17.365 E" data-place="Watsons Bay" data-route="Eastern Suburbs" data-class="eastern" data-credit="Joel Coleman" />';
        imgHTML += '</li>';
        imgHTML += '<li>';
        imgHTML += '<img src="img/featureImages/'+folder+'manlyAerial.jpg" data-latlng="33 47.877 S, 151 16.990 E" data-place="Manly Wharf" data-route="Manly" data-class="manly" data-credit="Joel Coleman" />';
        imgHTML += '</li>';
        imgHTML += '<li>';
        imgHTML += '<img src="img/featureImages/'+folder+'ferries.jpg" data-latlng="33 50.682 S, 151 16.990 E" data-place="Nth/Sth Head" data-route="Manly" data-class="manly" data-credit="Joel Coleman" />';
        imgHTML += '</li>';

        $(imgHTML).appendTo('#featureImageCarousel');

        $('#featureImageCarousel').foundation('orbit');
    }

    function fetchTweets()
    {
        $('#tweetList').load('services/twitter-fetch-tweets.php', function() {
            $('#tweetList').foundation('orbit');
            twttr.widgets.load();
        });
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
