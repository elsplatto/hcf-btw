<?php
function getTopNav($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT id, nav_title, friendly_url FROM pages WHERE parent_id = 0 AND is_nav = 1 AND is_live = 1 ORDER BY pages.order');

    $stmt->execute();

    $stmt->bind_result($id, $nav_title, $friendly_url);
    $results = array();
    $i = 0;
    while($stmt->fetch())
    {
        $results[$i]['id'] = $id;
        $results[$i]['nav_title'] = $nav_title;
        $results[$i]['friendly_url'] = $friendly_url;
        $i++;
    }

    $stmt->close();

    return $results;
}

function getRouteNav($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT id, nav_title, friendly_url, css_class FROM route WHERE is_live = 1 ORDER BY nav_order');

    $stmt->execute();
    $stmt->bind_result($id, $nav_title, $friendly_url, $css_class);

    $results = array();
    $i = 0;
    while($stmt->fetch())
    {
        $results[$i]['id'] = $id;
        $results[$i]['nav_title'] = $nav_title;
        $results[$i]['friendly_url'] = $friendly_url;
        $results[$i]['css_class'] = $css_class;
        $i++;
    }

    $stmt->close();
    return $results;
}

$navPages = getTopNav($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
$routeNavPages = getRouteNav($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
?>
<section id="navHolder" class="navHolder">
    <div class="row">
        <div class="large-12 columns">
            <nav class="top-bar" data-topbar>
                <ul class="title-area">
                    <li class="name">
                        <h1><a href="<?=$baseURL?>/">Beyond the Wharf</a></h1>
                    </li>
                    <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
                </ul>

                <section class="top-bar-section first">
                    <!-- Right Nav Section -->
                    <ul class="right">
                        <li>
                            <form id="frmSearch" action="#" method="POST">
                                <label for="txtSearch">Search</label>
                                <input type="search" name="txtSearch" id="txtSearch" placeholder="Enter keywords" />
                                <button type="submit" id="searchSubmit" name="searchSubmit">Submit</button>
                            </form>
                        </li>
                    </ul>

                    <!-- Left Nav Section -->
                    <ul class="left">
                        <?php
                        foreach($navPages as $navPage)
                        {
                            if ($navPage['friendly_url'] == 'gallery')
                            {
                             ?>
                                <li><a href="<?=$baseURL?>/<?=$navPage['friendly_url']?>"><?=$navPage['nav_title']?></a></li>
                            <?php
                            }
                            else if ($navPage['friendly_url'] == 'events')
                            {
                             ?>
                                <li><a href="<?=$baseURL?>/<?=$navPage['friendly_url']?>"><?=$navPage['nav_title']?></a></li>
                            <?php
                            }
                            else
                            {
                            ?>
                                <li><a href="<?=$baseURL?>/page/<?=$navPage['friendly_url']?>"><?=$navPage['nav_title']?></a></li>
                        <?php
                            }
                        }
                        ?>
                    </ul>


                </section>

                <section class="top-bar-section second">
                    <ul class="routes">
                        <li>Routes:</li>
                        <?php
                        foreach ($routeNavPages as $routeNavPage)
                        {
                        ?>
                            <li><a href="<?=$baseURL?>/route/<?=$routeNavPage['friendly_url']?>" class="<?=$routeNavPage['css_class']?>"><?=$routeNavPage['nav_title']?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </section>

            </nav>
        </div>
    </div>
</section>