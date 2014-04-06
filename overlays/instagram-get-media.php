<?php
include '../includes/site-settings.php';
require '../includes/instagram.class.php';
require '../includes/instagram.config.php';
include '../includes/Mobile_Detect.php';
include '../includes/global-functions.php';


$device = new Mobile_Detect;
$deviceType = ($device->isMobile() ? ($device->isTablet() ? 'tablet' : 'phone') : 'computer');

$media_id = $_GET['media_id'];

$instagramMediaResults = $instagram->getMedia($media_id, false);

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

            if ($post->type == 'video')
            {
                $isVideo = true;
                if ($deviceType == 'phone')
                {
                    $instagramVideo = $post->videos->low_resolution->url;
                }
                else
                {
                    $instagramVideo = $post->videos->standard_resolution->url;
                }
            }
            else
            {
                $isVideo = false;
            }

        }
    }
}

?>

<div id="instagramPicModal" class="white large-12">
    <div id="imageArea" class="imageArea large-12 medium-12 small-12 text-center">
        <?php
        if ($isVideo)
        {
        ?>
            <video controls>
                <source src="<?=$instagramVideo?>"
                        type="video/mp4"/>
            </video>
        <?php
        }
        else
        {
        ?>
            <img src="<?=$instagramImg?>" id="mediaFeatureImage" />
        <?php
        }
        ?>
    </div>
</div>

<a class="close-reveal-modal reveal-close">Close this overlay</a>