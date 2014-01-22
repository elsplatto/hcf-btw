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
    if ($media_id == $post->id)
    {
        $instagramImg = $post->images->standard_resolution->url;
        $caption = $post->caption->text;
        $captionCreated = $post->caption->created_time;
        $creatorUsername = $post->user->username;
        $creatorProfilePic = $post->user->profile_picture;
        $captionDateGap = getGap($captionCreated);
        $imageCreated = $post->created_time;
        $imageDateGap = getGap($imageCreated);
        $locationName = $post->location->name;

        $blnUserLiked = $post->user_has_liked;
        $objImgLikes = $post->likes;
        $objImgComments = $instagram->getMediaComments($media_id);
    }
}



if ($blnUserLiked) {
    $userLikedClass = ' userLikes';
}
else
{
    $userLikedClass = ' userNoLikes';
}


echo '<script>';
echo 'console.dir('.json_encode($objImgComments).')';
echo '</script>';



?>

<div id="instagramCommentModal" class="white large-12">
    <div id="imageArea" class="imageArea large-6 left">
        <img src="<?=$instagramImg?>" />
    </div>

    <div id="commentsArea" class="commentsArea large-6 columns">
        <div id="credits" class="credits large-12">
            <div class="profileThumbHolder large-1 left">
                <img src="<?=$creatorProfilePic?>" class="profileThumb" />
            </div>

            <div class="creditHolder large-11 columns">
                <p>
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
                    <span class="likes small<?=$userLikedClass?>"></span>
                </div>
                <div class="large-11 columns">
                    <p>
                    <?php
                    $limit = 3;


                    //@todo: Fix the exception language for likes

                    if ($blnUserLiked) {
                        echo '<a href="http://instagram.com/'.$creatorUsername.'" target="_blank" rel="nofollow">You</a>';

                        if ($likesCount == 2)
                        {
                            echo ' and ';
                        }
                        else if ($likesCount > 2)
                        {
                            echo ', ';
                        }
                        $i = 1;
                        $remainder = 0;
                    }
                    else
                    {
                        $i = 0;
                        $remainder = 1;
                    }

                    foreach ($objImgLikes->data as $likes)
                    {
                        echo '<a href="http://instagram.com/'.$likes->username.'" target="_blank" rel="nofollow">'.$likes->username.'</a>';
                        if (($i+1) === $limit) {

                            if (($likesCount - ($i+1)) > 0)
                            {
                                echo ' and ' . number_format(($likesCount - ($i+1)));
                            }

                            if (($likesCount - ($i+1)) === 1)
                            {
                                echo ' other';
                            }
                            else if (($likesCount - ($i+1)) > 1)
                            {
                                echo ' others';
                            }

                            echo ' like this.';
                            break;
                        }
                        else if ($i === $likesCount)
                        {
                            echo ' like this.';
                        }
                        else if (($likesCount-($i+1)) === 1)
                        {
                            echo ' and ';
                        }
                        else
                        {
                            echo ', ';
                        }
                        $i++;
                    }
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

        <div id="commentBar" class="commentBar" class="large-12">
        here
        </div>

    </div>

    <a class="close-reveal-modal reveal-close">x</a>

</div>
<script>
    $(function() {
        $('body').on('click', '.reveal-modal-bg, .reveal-close',function(e){
            e.preventDefault();
            $('.reveal-modal').foundation('reveal','close');
            $('.reveal-modal-bg').hide();
            $('.reveal-modal').remove();
        })
        $(document).keyup(function(e) {

            if (e.keyCode == 27) {
                //user hit esc key
                $('.reveal-modal').foundation('reveal','close');
                $('.reveal-modal-bg').hide();
                $('.reveal-modal').remove();
            }
        });
        var targetHeight = $('#imageArea').height();
        var likesHeight = $('#likesArea').outerHeight(true);
        var creditsHeight = $('#credits').outerHeight(true);
        var commentBarHeight = $('#commentBar').outerHeight(true);
        var topHeight = (likesHeight + creditsHeight + commentBarHeight);
        $('#comments').height((targetHeight-topHeight));
        /*
        console.log('targetHeight['+targetHeight+']');
        console.log('likesHeight['+likesHeight+']');
        console.log('creditsHeight['+creditsHeight+']');
        console.log('topHeight['+topHeight+']');
         */
    });
</script>

