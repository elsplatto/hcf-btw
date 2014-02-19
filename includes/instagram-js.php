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