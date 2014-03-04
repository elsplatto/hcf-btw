<?php
include '../includes/db.php';
include '../includes/Mobile_Detect.php';
require '../includes/instagram.class.php';
require '../includes/instagram.config.php';
include '../includes/global-functions.php';

$device = new Mobile_Detect;

session_start();
$userData=$_SESSION['userdetails'];
$userInstagramId = $userData->user->id;

$media_id = $_GET['media_id'];

$instagram->setAccessToken($userData);

$token = $instagram->getAccessToken();

if (isset($token))
{
    $tokenSet = true;
}
else
{
    $tokenSet = false;
}

$instagramMediaResults = $instagram->getMedia($media_id, $tokenSet);


foreach ($instagramMediaResults as $post) {
    if (isset($post->id))
    {
        if ($media_id == $post->id)
        {
            $instagramImg = $post->images->standard_resolution->url;
            $imgWidth = $post->images->standard_resolution->width;
            $imgHeight = $post->images->standard_resolution->height;
            $caption = $post->caption->text;
            $captionCreated = $post->caption->created_time;
            $creatorUsername = $post->user->username;
            $creatorProfilePic = $post->user->profile_picture;
            $captionDateGap = getGap($captionCreated);
            $imageCreated = $post->created_time;
            $imageDateGap = getGap($imageCreated);
            if (isset($post->location->name))
            {
                $locationName = $post->location->name;
            }

            $blnUserLiked = $post->user_has_liked;
            $objImgLikes = $post->likes;
            $objImgComments = $instagram->getMediaComments($media_id);
        }
    }
}

if ($blnUserLiked) {
    $userLikedClass = ' userLikes';
}
else
{
    $userLikedClass = ' userNoLikes';
}


//echo '<script>';
//echo 'console.log('.$blnUserLiked.')';
//echo 'console.dir('.json_encode($objImgLikes).')';
//echo 'console.dir('.json_encode($objImgComments).')';
//echo 'console.dir('.json_encode($instagramMediaResults).')';
//echo '</script>';

//var_dump(json_encode($instagramMediaResults));
?>

<div id="instagramCommentModal" class="white large-12">
    <div id="imageArea" class="imageArea large-6 left">
        <img src="<?=$instagramImg?>" id="mediaFeatureImage" />
    </div>

    <div id="commentsArea" class="commentsArea large-6 columns">
        <div id="credits" class="credits large-12">
            <div class="profileThumbHolder large-1 left">
                <img src="<?=$creatorProfilePic?>" class="profileThumb" />
            </div>

            <div class="creditHolder large-11 columns">
                <p class="credit">
                    <a href="http://instagram.com/<?=$creatorUsername?>" target="_blank" rel="nofollow"><?=$creatorUsername?></a>
                </p>

                <p>
                    <span><?=$imageDateGap?></span>
                    <?php
                    if (isset($locationName))
                    {
                    ?>
                     . <span><?=$locationName?></span>
                    <?php
                    }
                    ?>
                </p>
                <p><?=$caption?></p>
            </div>
        </div>
        <?php
        $likesCount = $objImgLikes->count;
        if (isset($likesCount))
        {
        ?>
            <div id="likesArea" class="likesArea large-12">
                <div class="large-1 left text-center">
                    <span class="likes small"></span>
                </div>
                <div class="large-11 columns">
                    <p class="commentsShoutout">
                    <?php
                    echo buildLikesString($likesCount, $blnUserLiked, $objImgLikes, $creatorUsername,$userInstagramId, 3);
                    ?>
                    </p>
                </div>
            </div>
        <?php
        }
        ?>

        <div id="comments" class="comments">
        <?php
        foreach ($objImgComments->data as $comment)
        {
            $commentHTML = '<div class="commentContainer large-12">';
            $commentHTML .= '<div class="large-1 left"><img src="'.$comment->from->profile_picture.'" class="profileThumb" /></div>';
            $commentHTML .= '<div class="large-11 columns">';
            $commentHTML .= '<p><a href="http://instagram.com/'.$comment->from->username.'" target="_blank" rel="nofollow">'.$comment->from->username.'</a></p>';
            $commentHTML .= '<p>'.$comment->text.'</p>';
            $commentHTML .= '</div>';
            $commentHTML .= '</div>';
            echo $commentHTML;
        }
        ?>
        </div>
        <?php
        if (isset($blnUserLiked)) {
            $likeURL = $mediaLikeURL.'?media_id='.$media_id;
            $unLikeURL = $mediaUnLikeURL.'?media_id='.$media_id;
            if ($blnUserLiked)
            {
                $heartURL = $unLikeURL;
                $likeText = 'You like this media - click to unlike.';
            }
            else
            {
                $heartURL = $likeURL;
                $likeText = 'Click to like.';
            }
        }
        ?>
        <div id="commentBar" class="commentBar" class="large-12">
            <form id="frmInstagramComment" method="POST" action="services/instagram-post-comment.php">
            <div class="large-12 left">
                <a href="#" data-url="<?=$heartURL?>" data-likesCount="<?=$likesCount?>" data-mediaId="<?=$media_id?>" class="left likes<?=$userLikedClass?>" title="<?=$likeText?>"></a>

                <input type="text" class="left" id="txtInstagramComment" placeholder="Leave a comment..." />

                <input type="submit" id="btnSubmitComment" class="button left" value="Go" disabled="disabled" data-mediaId="<?=$media_id?>" />
            </div>
            </form>
        </div>

    </div>

</div>

<a class="close-reveal-modal reveal-close">Close this overlay</a>
<script>

$(function() {

    var targetHeight = $('#instagramCommentModal').outerHeight();
    var likesHeight = $('#likesArea').outerHeight(true);
    var creditsHeight = $('#credits').outerHeight(true);
    var commentBarHeight = $('#commentBar').outerHeight(true);
    var topHeight = (likesHeight + creditsHeight + commentBarHeight);
    $('#comments').height((targetHeight-topHeight));

    $('body').on('submit', '#frmInstagramComment', function(e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var submitBtn = $(e.target).find('input[type="submit"]');
        var mediaId = submitBtn.attr('data-mediaId');
        var commentInput = $(e.target).find('input[type="text"]');
        var comment = commentInput.val();
        //console.log('['+mediaId+']['+comment+']');
        $.ajax({
            type: 'POST',
            url: url + '?media_id=' + mediaId + '&comment=' + comment,
            beforeSend: function()
            {
                beforeCommentSendHandler();
            },
            success: function(data)
            {
                commentSuccessHandler(data,submitBtn,commentInput);
            },
            error: function(data)
            {
                commentErrorHandler(data,submitBtn,commentInput)
            }
        });
    });

    function beforeCommentSendHandler()
    {

    }

    function commentSuccessHandler(data,btn,input) {
        console.log(data);

        if (data != 'null')
        {
            var obj = JSON.parse(data);

            if (obj.hasOwnProperty('meta'))
            {
                if (obj.meta.code === 200)
                {
                    //console.log('post comment server response successful');
                }
                else
                {

                    //console.log('post comment server response error');
                    //console.dir(obj);
                }
            }
            else
            {
                //console.log('data problems');
            }
        }
        else
        {
            //console.log('data is null');
        }
    }

    function commentErrorHandler(data,btn,input)
    {
        //console.log('error handler called');
    }


    $('body').on('keyup', '#txtInstagramComment', function(e){
        e.preventDefault();
        var submitButton = $('#btnSubmitComment');
        var btnIsDisabled;
        submitButton.attr('disabled') === 'disabled'?btnIsDisabled=true:btnIsDisabled=false;
        if ($(this).val() === '')
        {
            if (!btnIsDisabled)
            {
                submitButton.attr('disabled','disabled');
            }
        }
        else
        {
            if (btnIsDisabled)
            {
                submitButton.removeAttr('disabled');
            }
        }
    });

    /*
    $('body').on('click', '.reveal-modal-bg, .reveal-close',function(e){
        e.preventDefault();
        $('.reveal-modal').foundation('reveal','close');
        $('.reveal-modal-bg').hide();
        $('.reveal-modal').remove();
    });

    $(document).keyup(function(e) {

        if (e.keyCode == 27) {
            //user hit esc key
            $('.reveal-modal').foundation('reveal','close');
            $('.reveal-modal-bg').hide();
            $('.reveal-modal').remove();
        }
    });
    */
    /*
    console.log('targetHeight['+targetHeight+']');
    console.log('img['+$('#mediaFeatureImage').height()+']');
    console.log('likesHeight['+likesHeight+']');
    console.log('creditsHeight['+creditsHeight+']');
    console.log('topHeight['+topHeight+']');
    console.log('make comment height['+(targetHeight-topHeight)+']');
    */
});
</script>

