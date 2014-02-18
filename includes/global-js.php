<script src="<?=$baseURL?>/js/jquery.js"></script>
<script src="<?=$baseURL?>/js/foundation.min.js"></script>
<script src="<?=$baseURL?>/js/foundation/foundation.reveal.js"></script>
<script src="<?=$baseURL?>/js/global-functions.js"></script>
<script src="<?=$baseURL?>/js/vendor/plugins/indie/heartcode-canvasloader-min-0.9.1.js"></script>
<script>
$(function(){
    $('body').on('click', '.reveal-init', function(e)
    {
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
            $('html').animate({
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


    $('body').on('click','a.userLikes', function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        var el = $(this);
        $.ajax({
            type: 'POST',
            url: url,
            beforeSend: function()
            {
                beforeLikeSendHandler(el);
            },
            success: function(data)
            {
                unLikeSuccessHandler(data);
            }
        });
    });

    $('body').on('click','a.userNoLikes', function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        var el = $(this);
        $.ajax({
            type: 'POST',
            url: url,
            beforeSend: function()
            {
                beforeLikeSendHandler(el);
            },
            success: function(data)
            {
                likeSuccessHandler(data);
            }
        });
    });

    function beforeLikeSendHandler(el) {
        var mediaId = el.attr('data-mediaId');
        var triggerLikesCount = el.attr('data-likesCount');

        if (el.hasClass('userNoLikes'))
        {
            //console.log('you clicked to like');
            //switch urls
            el.attr('data-url','<?=$mediaUnLikeURL?>?media_id='+mediaId);

            //change classes on heart icon
            $('.userNoLikes[data-mediaId="'+mediaId+'"]').each(function(i){
                $(this).removeClass('userNoLikes').addClass('userLikes');
            });

            //update count data and text
            $('[data-mediaId="'+mediaId+'"][data-likesCount]').each(function(i){
                var newCount = parseInt('0'+$(this).attr('data-likesCount'))+1;
                var newCountText = likeNumberFormatter(newCount);

                $(this).attr('data-likesCount',newCount);

                var hasAttr = $(this).attr('data-displayCount');

                if (typeof hasAttr !== 'undefined' && hasAttr !== false)
                {
                    $(this).text(newCountText);
                }
            });

            $('p.commentsShoutout').each(function(i) {
                var existingHTML = $(this).html();
                if ($(this).text().toLowerCase().trim() == '')
                {
                    $(this).html('<a href="http://instagram.com/<?=$instagramUsername?>" target="_blank">You</a> like this.');
                }
                else if (parseInt('0'+triggerLikesCount) == 1)
                {
                    $(this).html('<a href="http://instagram.com/<?=$instagramUsername?>" target="_blank">You</a> and '+ existingHTML);
                }
                else if (parseInt('0'+triggerLikesCount) > 1)
                {
                    $(this).html('<a href="http://instagram.com/<?=$instagramUsername?>" target="_blank">You</a>, '+ existingHTML);
                }

            });

        }
        else
        {
            //console.log('you clicked to unlike');
            //switch urls
            el.attr('data-url','<?=$mediaLikeURL?>?media_id='+mediaId);

            $('.userLikes[data-mediaId="'+mediaId+'"]').each(function(i){
                $(this).removeClass('userLikes').addClass('userNoLikes');
            });
            $('[data-mediaId="'+mediaId+'"][data-likesCount]').each(function(i){
                var newCount = parseInt('0'+$(this).attr('data-likesCount'))-1;
                var newCountText = likeNumberFormatter(newCount);

                $(this).attr('data-likesCount',newCount);

                var hasAttr = $(this).attr('data-displayCount');

                if (typeof hasAttr !== 'undefined' && hasAttr !== false)
                {
                    $(this).text(newCountText);
                }
            });

            //@TODO: fix you text removal
            $('p.commentsShoutout').each(function(i) {
                //console.log('['+$(this).text().toLowerCase().trim()+']');
                var existingHTML = $(this).html();
                $(this).css({
                    outline: '1px solid red'
                });
                $(this).remove('.youText');
            });
        }
    }

    function unLikeSuccessHandler(data){
        var obj = JSON.parse(data);

        if (obj.hasOwnProperty('meta'))
        {
            if (obj.meta.code === 200)
            {
                //console.log('unlike server response successful');
            }
            else
            {

                //console.log('unlike server response error');
                //console.dir(obj);
            }
        }
    }

    function likeSuccessHandler(data){
        var obj = JSON.parse(data);

        if (obj.hasOwnProperty('meta'))
        {
            if (obj.meta.code === 200)
            {
                //console.log('like server response successful');
            }
            else
            {
                //console.log('like server response error');
                //console.dir(obj);
            }
        }
    }

    function isJson(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }

});
</script>