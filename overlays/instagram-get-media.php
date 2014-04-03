<?php
include '../includes/site-settings.php';
require '../includes/instagram.class.php';
require '../includes/instagram.config.php';
include '../includes/global-functions.php';

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


        }
    }
}

?>

<div id="instagramPicModal" class="white large-12">
    <div id="imageArea" class="imageArea large-12 medium-12 small-12 text-center">
        <img src="<?=$instagramImg?>" id="mediaFeatureImage" />
    </div>
</div>

<a class="close-reveal-modal reveal-close">Close this overlay</a>