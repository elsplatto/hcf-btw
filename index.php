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
            <img src="img/featureImages/vivid-sydney-cityscape.jpg" data-url="#" data-linkType="internal" data-location="136" data-directive="View more" data-latlng="33 50 47.67 S, 151 13 47.0856 E" data-place="Cremorne" data-route="Mosman Bay" data-class="mosman" data-credit="Andy Richards" />
            <div class="headerText">
                <div class="inner text-left">
                    <h2 class="sub">Vivid Sydney</h2><br />
                    <h2>Beyond the Wharf</h2><br />
                    <h3>Discover. Share. Experience.</h3><br />
                    <a href="<?=$baseURL?>/vivid/" class="button block med verboten">Read More</a>
                </div>
            </div>
        </li>

    </ul>
    <?php
    }
    else
    {
        ?>
        <ul id="featureImageCarousel" data-orbit data-options="animation: slide;timer_speed: 15000; swipe: true; timer: false;
                    pause_on_hover: false;
                    animation_speed: 500;
                    navigation_arrows: true;
                    bullets: false;
                    slide_number: false;">
        <li>
            <img src="img/featureImages/phone/vivid-sydney-cityscape.jpg" data-url="<?=$baseURL?>/vivid/gallery-pro" data-directive="View more" data-latlng="33 50 47.67 S, 151 13 47.0856 E" data-place="Cremorne" data-route="Mosman Bay" data-class="mosman" data-credit="Andy Richards" />
            <div class="headerText">
                <div class="inner text-center">
                    <h2 class="sub">Secrets</h2><br />
                    <h2>Beyond the Wharf</h2><br />
                    <h3>Discover. Share. Experience.</h3><br />
                    <a href="<?=$baseURL?>/vivid/" class="button block med verboten">Read More</a>
                </div>
            </div>
        </li>

    </ul>
    <?php
    }
    ?>
    <!--div class="headerHolder">



        <h2 class="sub">Secrets</h2>
        <h2>Beyond the Wharf</h2>
        <hr />
        <h3>Discover. Share. Experience.</h3>
    </div-->
    <a href="#" id="creditToggle" data-target="featureCreditPanel" class="triggerContainer" title="Click here for photo credits">
        <div class="flip-container">
            <div class="flipper">
                <div class="cameraIcon"></div>
                <div class="closeIcon"></div>
            </div>
        </div>
    </a>
    <div id="featureCreditPanel" class="creditPanel">
        <span class="latLng">33 50 47.67 S, 151 13 47.0856 E</span>
        <span class="location">Cremorne Point</span>
        <span class="routes mosman">Mosman Bay</span>
        <span class="credit">Photo by Andy Richards - Understand Down Under</span>
        <span><a href="#" class="panelFlyoutTrigger" data-location="136" data-target="mapContainer" onclick="trackInternalLink('Photo credit panel - click', 'After dark tours'); return false;">View details</a></span>
    </div>
    <section class="promoHolder">
        <div class="row">

            <?php
            if ($deviceType == 'phone')
            {
            ?>

                <div class="large-3 medium-3 small-12 promoTile columns<?=$deviceClass?>">
                    <div class="imgHolder">
                        <img src="img/promoImages/<?=$folder?>sm-shelly.jpg" alt="WIN THE NEW CANON EOS 1200D SINGLE KIT WITH EF-S 18-55MM F/3.5-5.6 III LENS RRP $649" />
                    </div>
                    <div class="textHolder">
                        <span>Photo Competition</span>
                        <a href="<?=$baseURL?>/<?=$competitionURL?>&mode=competition&step=2&call_page=<?=$baseURL?>/?competitionId=2&competitionId=2" id="competitionPromo" class="reveal-init button verboten" data-size="small" onClick="trackInternalLink('Homepage promo panel - mobile click', 'Competition 2 - Win the new CANON EOS 1200D'); return false;">Win a CANON EOS 1200D</a>
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
                    <img src="img/promoImages/vivid-sydney-competition.jpg" alt="WIN THE NEW CANON EOS 1200D SINGLE KIT WITH EF-S 18-55MM F/3.5-5.6 III LENS RRP $649" />
                </div>
                <div class="textHolder">
                    <span>Vivid Sydney Photo Competition</span>
                    <a href="<?=$baseURL?>/<?=$competitionURL?>&mode=competition&step=2&call_page=<?=$baseURL?>/?competitionId=2&competitionId=2" id="competitionPromo" class="reveal-init button verboten" data-size="small" onClick="trackInternalLink('Homepage promo panel - click', 'Competition 2 - Win the new CANON EOS 1200D'); return false;">Win a CANON EOS 1200D</a>
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
                    <img src="img/promoImages/vivid-sydney-light-waves.jpg" alt="Vivid Sydney - Light waves." />
                </div>
                <div class="textHolder">
                    <span>Events</span>
                    <h5><a href="<?=$baseURL?>/vivid">Vivid Sydney 2014</a></h5>
                </div>
            </div>



            <!--div class="large-3 medium-3 small-12 columns hide-for-small-only">
                <div class="imgHolder">
                    <img src="img/promoImages/promo3.jpg" alt="Image of Sydney Harbour from Watsons Bay" />
                </div>
                <div class="textHolder">
                   <span>Itinerary</span>
                    <h5><a href="<?=$baseURL?>/docs/beyondthewharf-family.pdf" target="_blank">Sunday - Family Day</a></h5>
                </div>
            </div-->

            <div class="large-3 medium-3 small-12 columns hide-for-small-only">
                <div class="imgHolder">
                    <img src="img/promoImages/after-dark-tours.jpg" alt="After Dark Tours." />
                </div>
                <div class="textHolder">
                    <span>Experiences</span>
                    <h5><a href="#" class="panelFlyoutTrigger" data-location="136" data-target="mapContainer" onclick="trackInternalLink('Photo credit panel - click', 'After dark tours'); return false;">After Dark Tours</a></h5>
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
                <span>The Ancestral Spirit</span>
                <h3 class="block">Discover Sydney’s Aboriginal Culture</h3>
                <p>
                    Australia's Aboriginal culture dates back 60,000 years. Sydney Harbour played a large part and continues to do so today.
                </p>
                <a href="<?=$baseURL?>/page/child-at-heart" class="button wire white hide-for-large">Hear Tracey's Story</a>
                <img src="img/themedPromos/profile-2.jpg" class="profile" alt="Picture of Tracey." />
                <p>Tracey Keys</p>
                <span class="purple">Harbour City Ferries - Crew Member</span>
            </div>
            <div class="large-6 hide-for-medium hide-for-small themedPromoImage">
                <img src="img/themedPromos/crossing.jpg" alt="Picture of North Head - Sydney." />
                <div class="large-6 medium-6 small-6 themedPromoOverlay">
                    <!--a href="#" class="button red play tungsten small">Watch the video</a-->
                    <a href="<?=$baseURL?>/page/aboriginal-harbour-journeys" class="button wire white">Hear Tracey's Story</a>
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

    /*$('#featureImageCarousel li').click(function(e) {
        loadHomeImages();
    });*/

    $("#featureImageCarousel").on("after-slide-change.fndtn.orbit", function(event, orbit) {

        var target = $('#featureImageCarousel li.active img');
        var latlng = target.attr('data-latlng');
        var place =  target.attr('data-place');
        var route = target.attr('data-route');
        var routeClass = target.attr('data-class');
        var credit = target.attr('data-credit');
        var creditURL = target.attr('data-url');
        var dataLocationID = target.attr('data-location');
        var dataTarget = target.attr('data-target');
        var dataLinkType = target.attr('data-linkType');
        var creditDirective = target.attr('data-directive');

        var creditHTML = '';
        creditHTML += '<span class="latLng">'+latlng+'</span>';
        creditHTML += '<span class="location">'+place+'</span>';
        creditHTML += '<span class="routes '+routeClass+'">'+route+'</span>';
        creditHTML += '<span class="credit">Photo by '+credit+'</span>';
        if (dataLinkType == 'internal')
        {
            creditHTML += '<span><a href="'+creditURL+'" class="panelFlyoutTrigger" data-target="'+dataTarget+'" data-location="'+dataLocationID+'">'+creditDirective+'</a></span>';
        }
        else
        {
            creditHTML += '<span><a href="'+creditURL+'">'+creditDirective+'</a></span>';
        }


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
        imgHTML += '<img src="img/featureImages/'+folder+'vivid-sydney-light-play2.jpg" data-url="#" data-linkType="internal" data-location="136" data-target="mapContainer" data-directive="View details" data-latlng="33 48 2.3652 S, 151 17 54.1998 E" data-place="Shelly Beach" data-route="Manly" data-class="manly" data-credit="Andy Richards, Understand Down Under" />';
        imgHTML += '<div class="headerText">';
        imgHTML += '<div class="inner text-left">';
        imgHTML += '<h2 class="sub">Secrets of Sydney Harbour</h2><br />';
        imgHTML += '<h2>Beyond the Wharf</h2><br />';
        //imgHTML += '<hr />';
        imgHTML += '<h3>Discover. Share. Experience.</h3>';
        imgHTML += '</div>';
        imgHTML += '</div>';
        imgHTML += '</li>';
        imgHTML += '<li>';
        imgHTML += '<img src="img/featureImages/'+folder+'vivid-sydney-boats.jpg"  data-url="#" data-linkType="internal" data-location="136" data-directive="View more" data-latlng="33 50 47.67 S, 151 13 47.0856 E" data-place="Cremorne" data-route="Mosman Bay" data-class="mosman" data-credit="Andy Richards, Understand Down Under" />';
        imgHTML += '<div class="headerText">';
        imgHTML += '<div class="inner text-left">';
        imgHTML += '<h2 class="sub">Vivid Sydney</h2><br />';
        imgHTML += '<h2>Beyond the Wharf</h2><br />';
        //imgHTML += '<hr />';
        imgHTML += '<h3>Discover. Share. Experience.</h3><br />';
        imgHTML += '<a href="<?=$baseURL?>/vivid/" class="button block med verboten">Read More</a>';
        imgHTML += '</div>';
        imgHTML += '</div>';
        imgHTML += '</li>';
        imgHTML += '<li>';
        imgHTML += '<div class="headerText">';
        imgHTML += '<div class="inner text-left">';
        imgHTML += '<h2 class="sub">Unique Experiences</h2><br />';
        imgHTML += '<h2>Beyond the Wharf</h2><br />';
        //imgHTML += '<hr />';
        imgHTML += '<h3>After Dark Tours</h3><br />';
        imgHTML += '<a href="#" class="panelFlyoutTrigger button block med verboten" data-location="136" data-target="mapContainer" onclick="trackInternalLink(\'Photo credit panel - click\', \'After dark tours\'); return false;">Find out more</a>';
        imgHTML += '</div>';
        imgHTML += '</div>';
        imgHTML += '<img src="img/featureImages/'+folder+'vivid-sydney-light-play.jpg" data-url="#" data-linkType="internal" data-location="136" data-target="mapContainer" data-directive="View details" data-latlng="33 48 2.3652 S, 151 17 54.1998 E" data-place="Shelly Beach" data-route="Manly" data-class="manly" data-credit="Andy Richards - Understand Down Under" />';
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
