<?php
include '../includes/db.php';
include '../includes/Mobile_Detect.php';
require '../includes/instagram.class.php';
require '../includes/instagram.config.php';

$device = new Mobile_Detect;

$media_id = $_GET['media_id'];
$instagramJSONFilename = 'json/results.json';
$instagramResults = json_decode(file_get_contents('../'.$instagramJSONFilename, true));



foreach ($instagramResults->data as $post) {
    if ($media_id == $post->id)
    {
        $instagramImage = $post->images->standard_resolution->url;
        $caption = $post->caption->text;
        $captionCreated = $post->caption->created_time;
        $creatorUsername = $post->user->username;
        $creatorProfilePic = $post->user->profile_picture;
        $captionDateGap = getGap($captionCreated);
        $imageCreated = $post->created_time;
        $imageDateGap = getGap($imageCreated);
        $locationName = $post->location->name;
    }
}

//echo '$caption['.$caption.']';
//echo '$captionCreated['.$captionCreated.']';
//echo '$creatorUsername['.$creatorUsername.']';
//echo '$creatorProfilePic['.$creatorProfilePic.']';
//echo '$captionDateGap['.$captionDateGap.']';
//echo '$imageCreated['.$imageCreated.']';



//test
//echo '['.getGap((1390298321 - 1390198321)).']';

function getGap($stamp) {
    $currentStamp = time();

    $gap = $currentStamp - $stamp;
    //echo 'stamp['.$stamp.']<br />';
    //echo 'currentStamp['.$currentStamp.']<br />';
    //echo 'gap['.$gap.']<br />';

    if ($gap <= 120)
    {
        $gap = 'Just';
        $gapSuffix = 'now';
    }
    else if ($gap > 120 && $gap <= 3600)
    {
        $gap = floor(abs($gap)/60);
        $gapSuffix = 'mins ago';
    }
    else if ($gap > 3600 && $gap <= 86400)
    {
        $gap = floor(abs($currentStamp - $stamp)/60/60);
        if ($gap == 1)
        {
            $gapSuffix = 'hour ago';
        }
        else
        {
            $gapSuffix = 'hours ago';
        }
    }
    else if ($gap > 86400 && $gap <= 2592000)
    {
        $gap = floor(abs($currentStamp - $stamp)/60/60/24);
        if ($gap == 1)
        {
            $gapSuffix = 'day ago';
        }
        else
        {
            $gapSuffix = 'days ago';
        }
    }
    else if ($gap > 2592000 && $gap <= 31536000)
    {
        $gap = floor(abs($currentStamp - $stamp)/60/60/24/30);
        if ($gap == 1)
        {
            $gapSuffix = 'month ago';
        }
        else
        {
            $gapSuffix = 'months ago';
        }
    }
    else if ($gap > 31536000)
    {
        $gap = floor(abs($currentStamp - $stamp)/60/60/24/30/12);
        if ($gap == 1)
        {
            $gapSuffix = 'year ago';
        }
        else
        {
            $gapSuffix = 'years ago';
        }
    }

    return  $gap . ' ' . $gapSuffix;
}

?>
<div id="instagramCommentModal" class="white all-modals">
    <div class="imageArea left">
        <img src="<?=$instagramImage?>" />
    </div>

    <div class="commentsArea right text-left">
        <div class="commentsInner">
            <img src="<?=$creatorProfilePic?>" class="profileThumb" />
            <a href="http://instagram.com/<?=$creatorUsername?>" target="_blank" rel="nofollow"><?=$creatorUsername?></a>
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
        </div>
    </div>


    <a class="close-reveal-modal reveal-close">x</a>
</div>
<script>
    $(function() {
        $('.reveal-modal-bg, .reveal-close').click(function(e){
            e.preventDefault();
            $('.reveal-modal').foundation('reveal','close');
            $('.reveal-modal-bg').hide();
            $('.reveal-modal').remove();
        })
        $(document).keyup(function(e) {

            if (e.keyCode == 27) {
                $('.reveal-modal').foundation('reveal','close');
                $('.reveal-modal-bg').hide();
                $('.reveal-modal').remove();
            }   // esc
        });
    });
</script>