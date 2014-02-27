<script>
$(function() {
    $('body').on('click','a.userLikes', function(e)
    {
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

    $('body').on('click','.insta-follow', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var el = $(this);
        $.ajax({
            type: 'POST',
            url: url,
            beforeSend: function()
            {
                beforeFollowHandler(el);
            },
            success: function(data)
            {
                followSuccessHandler(data, el);
            }
        });
    });

    $('body').on('click','.insta-unfollow', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
        var el = $(this);
        $.ajax({
            type: 'POST',
            url: url,
            beforeSend: function()
            {
                beforeFollowHandler(el);
            },
            success: function(data)
            {
                unfollowSuccessHandler(data, el);
            }
        });
    });

    function beforeFollowHandler(el)
    {
        //console.log('here');
        el.html('<div id="followLoader"></div>');
        var cl = new CanvasLoader('followLoader');
        cl.setColor('#ffffff');
        cl.setShape('square'); // default is 'oval'
        cl.setDiameter(25); // default is 40
        cl.setDensity(90); // default is 40
        cl.setRange(1); // default is 1.3
        cl.setSpeed(3); // default is 2
        cl.setFPS(24); // default is 24
        cl.show(); // Hidden by default
    }

    function followSuccessHandler(data, el)
    {
        var obj = JSON.parse(data);

        if (obj.hasOwnProperty('meta'))
        {
            if (obj.meta.code === 200)
            {
                //console.log('follow server response successful');
                //console.dir(obj);
                el.removeClass('insta-follow stdDarkGrey');
                el.addClass('insta-unfollow stdGreen');
                el.attr('href','<?=$baseURL?>/services/instagram-unfollow-btw.php');
                el.html('<span class="social instagram small"></span> Following');
            }
            else
            {

                //console.log('follow server response error');
                //console.dir(obj);
            }
        }
    }

    function unfollowSuccessHandler(data, el)
    {
        var obj = JSON.parse(data);

        if (obj.hasOwnProperty('meta'))
        {
            if (obj.meta.code === 200)
            {
                //console.log('unfollow server response successful');
                //console.dir(obj);
                el.removeClass('insta-unfollow stdGreen');
                el.addClass('insta-follow stdDarkGrey');
                el.attr('href','<?=$baseURL?>/services/instagram-follow-btw.php');
                el.html('Follow Us On <span class="social instagram small"></span> Instagram');
            }
            else
            {
                //console.log('unfollow server response error');
                //console.dir(obj);
            }
        }
    }



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