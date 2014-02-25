<script src="<?=$baseURL?>/js/jquery.js"></script>
<script src="<?=$baseURL?>/js/foundation.min.js"></script>
<script src="<?=$baseURL?>/js/foundation/foundation.reveal.js"></script>
<script src="<?=$baseURL?>/js/global-functions.js"></script>
<script src="<?=$baseURL?>/js/vendor/plugins/indie/heartcode-canvasloader-min-0.9.1.js"></script>
<script>
$(function(){

    var hashtag = location.hash;
    //console.log('['+hashtag+']');
    if (hashtag.length > 0)
    {
        if ($(hashtag).length > 0)
        {
            var landScrollHeight = ($(hashtag).offset().top - $('#navHolder').outerHeight());
            $('html').animate({
                scrollTop: landScrollHeight
            },'slow');
        }
    }


    $('body').on('click', '.reveal-init', function(e)
    {

        //e.stopPropagation();
        e.preventDefault();
        var url = $(this).attr('href');
        $('#modalShell').html('<div id="canvasLoader"></div>');
        var cl = new CanvasLoader('canvasLoader');
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


    $('.panelFlyoutTrigger').on('click', function(e) {
        e.preventDefault();
        var target = $('#'+$(this).attr('data-target'));
        var id = $(this).attr('data-location');

        beforeLocationRetrieveHandler(target);
        $('#flyoutPanel').load('<?=$baseURL?>/services/load-location.php?id='+id +'&relPath=<?=$baseURL?>/', function(){
            var scrollHeight = ($('#flyoutPanel').offset().top - $('#navHolder').outerHeight());
            $('html, body').animate({
                scrollTop: scrollHeight
            },'slow');
        });
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
</script>