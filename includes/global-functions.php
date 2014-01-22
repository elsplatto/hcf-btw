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

function numberRounder($num)
{

}
?>