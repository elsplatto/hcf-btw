<?php
$pageHeading = "Landing Page";
$pageMetaTitle = "Beyond the Wharf - Sydney Harbour, Sydney Activities, Sydney Ferries";
$pageSection = "landing";
$pageMetaDesc = "Looking for great things to do in Sydney? Beyond the Wharf provides local and international insights to Sydney Harbour. ";
$pageMetaKeywords = "Sydney, harbour, experience, activities, events, share, contribute, locals, international, travel";


/*global includes in head.php*/
include 'includes/head.php';

if ($deviceType != 'phone')
{
    $tripplannerOrientation = 'landscape';
}
else
{
    $tripplannerOrientation = 'portrait';
}


?>


<body>
<?php
include 'includes/nav.php';

?>
<section class="landingTileHolder">

    <div class="row">
        <div class="large-12 columns">

            <div class="large-4 medium-6 small-12 white80 left columns marginBottom20 operators hcf">
                <div class="large-12 paddingLeftRight20 paddingTopBottom40">
                    <h2 id="ferryOperators" class="block text-left">Sydney Ferry Operators</h2>
                    <p>
                        Harbour City Ferries, is the operator of Sydney Ferries on the behalf of the NSW Government (Transport for NSW and the NSW Transport Minister)
                    </p>
                    <p>
                        <a href="<?=$baseURL?>/page/about-us">About Us</a><br />
                        <a href="http://harbourcityferries.com.au/careers" target="_blank" rel="nofollow">Careers</a>
                    </p>
                </div>
            </div>

            <div class="large-5 medium-6 small-12 white90 left columns marginBottom20 experiences">
                <div class="large-12 paddingLeftRight20 paddingTopBottom40">
                    <h2 id="ferryExperiences" class="block text-left">Sydney Ferry Experiences</h2>
                    <p>
                        Beyond The Wharf is an experience and activity finder for your journeys in and around the harbour. Bought to your by Harbour City Ferries as a way for you to get the most out of your ferry journeys and enjoyment of Sydney.
                    </p>
                    <h3 class="block text-center">ROUTES, MAPS, ITINERARIES, LOCAL INSIGHTS,  GALLERY AND MORE</h3>
                    <p class="text-center paddingTopBottom20">
                        <a href="<?=$baseURL?>" class="button">GO TO BEYOND THE WHARF</a>
                    </p>
                </div>
            </div>

            <div class="large-3 small-12 columns right marginBottom20">
                <div class="large-12 white80 columns paddingTopBottom40 planner">
                    <h2 id="tripPlannerTile" class="block text-left">Plan your trip</h2>
                    <p class="text-center paddingTopBottom20">
                        <a href="<?=$baseURL?>/overlays/trip-planner-<?=$tripplannerOrientation?>.php" class="reveal-init button">USE THE TRIPPLANNER</a>
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<?php
include 'includes/footer.php';
?>


<?php
$pageId = 0;
include 'includes/global-js.php';


if (!isset($_COOKIE["LandingCookie"]))
{

?>
<script src="js/foundation/foundation.joyride.js"></script>

<script>
    $(function(){
        $(document).foundation();
    });

    $(document).ready(function(){
        $(document).foundation('joyride', 'start');
    });
</script>
<ol class="joyride-list" data-joyride>
    <li data-id="ferryOperators" data-text="Next">
        <p>Hi, we have detected you may be looking for Harbour City Ferries. You can find useful information in this panel.</p>
    </li>
    <li data-id="ferryExperiences" data-text="Next">
        <p>But wait! Perhaps you would like to see some of the fantastic experiences and content we have at Beyond the Wharf!</p>
    </li>
    <li data-id="tripPlannerTile" data-button="END">
        <p>Or maybe you want to plan your trip...</p>
    </li>
</ol>
<?php
}
include 'includes/analytics.php';
?>



</body>
</html>
