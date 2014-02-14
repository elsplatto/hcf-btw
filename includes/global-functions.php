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

function getJsonConents($pathToFile) {
    $string = file_get_contents($pathToFile);
    $json=json_decode($string,true);
    //$json = file_get_contents($pathToFile);
    return $json;
}

function getMapMarkers($pageId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE) {

    $query = '';
    $query .= 'SELECT tiles.id, tiles.title, tiles.lat, tiles.lng, tiles.image_thumb, ';
    $query .= 'tiles.alt, types.title AS type_title, categories.id AS category_id, categories.title AS category_title , ';
    $query .= 'categories.map_icon ';
    $query .= 'FROM (tiles, types, categories) ';
    $query .= 'INNER JOIN map_tile ON (tiles.id = map_tile.tile_id) ';
    $query .= 'INNER JOIN pages ON (map_tile.page_id = pages.id) ';
    $query .= 'WHERE types.id = tiles.type_id AND tiles.category_id = categories.id AND map_tile.page_id = ? ORDER BY categories.order';
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $pageId);
    $stmt->execute();
    $stmt->bind_result($id, $title, $lat, $lng, $image_thumb, $alt, $type_title, $category_id, $category_title, $map_icon);

    $results = array();
    $i = 0;
    while($stmt->fetch())
    {
        $results[$i]['id'] = $id;
        $results[$i]['title'] = $title;
        $results[$i]['lat'] = $lat;
        $results[$i]['lng'] = $lng;
        $results[$i]['image_thumb'] = $image_thumb;
        $results[$i]['alt'] = $alt;
        $results[$i]['type_title'] = $type_title;
        $results[$i]['category_id'] = $category_id;
        $results[$i]['category_title'] = $category_title;
        $results[$i]['map_icon'] = $map_icon;
        $i++;
    }

    $mysqli->close();
    return $results;
}

function getFilters($pageId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $filterArray = array();
    $categories = getMapMarkers($pageId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    foreach($categories as $category)
    {
        if (!in_array($category['category_title'], $filterArray))
        {
            array_push($filterArray, $category['category_title']);
        }
    }

    return $filterArray;
}

function getPagesSelectedTiles($id,$DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $query = 'SELECT tiles.title, types.title as type_title, categories.title AS category_title, ';
    $query .= 'tiles.image_thumb, tiles.image_thumb_med, tiles.tile_size, tiles.alt, tile_id FROM page_tile ';
    $query .= 'JOIN tiles ON (tiles.id = page_tile.tile_id) ';
    $query .= 'JOIN types ON (tiles.type_id = types.id) ';
    $query .= 'LEFT OUTER JOIN categories ON (tiles.category_id = categories.id) ';
    $query .= 'WHERE page_id = ? ORDER BY page_tile.order';
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $stmt->bind_result($title, $type_title, $category_title, $image_thumb, $image_thumb_med, $tile_size, $alt, $tile_id);

    $results = array();
    $i = 0;
    while($stmt->fetch())
    {
        $results[$i]['title'] = $title;
        $results[$i]['type_title'] = $type_title;
        $results[$i]['category_title'] = $category_title;
        $results[$i]['image_thumb'] = $image_thumb;
        $results[$i]['image_thumb_med'] = $image_thumb_med;
        $results[$i]['tile_size'] = $tile_size;
        $results[$i]['alt'] = $alt;
        $results[$i]['tile_id'] = $tile_id;
        $i++;
    }
    return $results;
}

?>