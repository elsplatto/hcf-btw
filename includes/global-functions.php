<?php
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


function buildLikesString($likesCount, $blnUserLiked = false, $objImgLikes, $creatorUsername, $userInstagramId, $limit = 3)
{
    $whoLikesString = '';

    if ($blnUserLiked)
    {
        $whoLikesString .= '<a class="youText" href="http://instagram.com/'.$creatorUsername.'" target="_blank" rel="nofollow">You</a>';

        if ($likesCount > 2)
        {
            $whoLikesString .= ', ';
        }
        else if ($likesCount == 1)
        {
            $whoLikesString .= ' like this.';
        }
        $i = 2;
    }
    else
    {
        $i = 1;
    }

    foreach ($objImgLikes->data as $likes)
    {
        //echo '$userInstagramId['.$userInstagramId.']$likes->id['.$likes->id.']';
        if ($userInstagramId !== $likes->id)
        {
            if ($i > $limit)
            {
                break;
            }

            if ($limit > $likesCount && ($limit - $i) === 1)
            {
                $whoLikesString .= ' and ';
            }

            if ($i <= $limit)
            {
                $whoLikesString .= ' <a href="http://instagram.com/'.$likes->username.'" target="_blank" rel="nofollow">'.$likes->username.'</a>';
            }

            if ($i < $limit && $likesCount > $limit)
            {
                $whoLikesString .= ', ';
            }

            if (($likesCount - $i) > 0 && $i === $limit)
            {
                $whoLikesString .= ' and <span class="likeCounter">' . number_format(($likesCount - ($i))) . '</span>';

                if (($likesCount - $i) === 1)
                {
                    $whoLikesString .= ' other';
                }
                else {
                    $whoLikesString .= ' others';
                }

            }

            if ($i === $limit || $i === $likesCount)
            {
                $whoLikesString .= ' like this.';
                break;
            }
            //$whoLikesString .= '$i['.$i.']$limit['.$limit.']['.$likesCount.']';
            $i++;
        }
    }

    return $whoLikesString;
}

function likeNumberFormatter($num)
{
    if ($num > 999 && $num <= 999999)
    {
        $handled = floor($num/1000);
        $suffix = 'K';
    }
    else if ($num > 999999)
    {
        $handled = floor($num/1000000);
        $suffix = 'M';
    }
    else
    {
        $handled = $num;
        $suffix = '';
    }
    return $handled . $suffix;
}

function numberRounder($num)
{

}
?>