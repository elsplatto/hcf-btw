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
    $mysqli->close();

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
    $mysqli->close();
    return $results;
}

//$navPages = getTopNav($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
//$routeNavPages = getRouteNav($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
?>
<!--off canvas opening divs closing divs in footer-->
<div class="off-canvas-wrap">
    <div class="inner-wrap">



            <aside class="left-off-canvas-menu">
                <ul class="off-canvas-list section-nav">
                    <!--li><label>Foundation</label></li-->
                    <li><a href="<?=$baseURL?>/page/explore-our-harbour">Explore Our Harbour</a></li>
                    <li><a href="<?=$baseURL?>/events">Events</a></li>
                    <li><a href="<?=$baseURL?>/gallery">Gallery</a></li>
                    <li><a href="<?=$baseURL?>/page/local-insights">Local Insights</a></li>
                    <li><a href="<?=$baseURL?>/vivid" class="vivid">Vivid</a></li>
                </ul>
            </aside>


        <aside class="right-off-canvas-menu">
            <ul class="off-canvas-list routes">
                <li><label>Routes</label></li>

                <li><a href="<?=$baseURL?>/route/manly" class="manly">Manly</a></li>
                <li><a href="<?=$baseURL?>/route/taronga-zoo" class="taronga">Taronga Zoo</a></li>
                <li><a href="<?=$baseURL?>/route/parramatta-river" class="parramatta">Parramatta River</a></li>
                <li><a href="<?=$baseURL?>/route/darling-harbour" class="darling">Darling Harbour</a></li>
                <li><a href="<?=$baseURL?>/route/neutral-bay" class="neutral">Neutral Bay</a></li>
                <li><a href="<?=$baseURL?>/route/mosman-bay" class="mosman">Mosman Bay</a></li>
                <li><a href="<?=$baseURL?>/route/eastern-suburbs" class="eastern">Eastern Suburbs</a></li>
            </ul>
        </aside>






        <section id="navHolder" class="navHolder">
            <div class="row">

                <nav class="tab-bar">
                    <section class="left-small">
                        <a herf="#" class="to-top left-off-canvas-toggle menu-icon"><span>Menu</span></a>
                    </section>
                    <section class="middle tab-bar-section text-center"><a href="<?=$baseURL?>">Back to homepage</a></section>
                    <section class="right-small">
                        <a herf="#" class="to-top right-off-canvas-toggle menu-icon"><span>Routes</span></a>
                    </section>
                </nav>

                <div class="large-12 medium-12 small-12 columns">


                    <nav class="top-bar" data-topbar="">
                        <ul class="title-area">
                            <li class="name">
                                <h1><a href="<?=$baseURL?>/">Beyond the Wharf</a></h1>
                            </li>
                        </ul>

                        <section class="top-bar-section first">
                            <!-- Right Nav Section -->
                            <ul class="right">
                                <li>
                                    <form id="frmSearch" action="#" method="POST">
                                        <label for="txtSearch">Search</label>
                                        <input type="search" name="txtSearch" id="txtSearch" placeholder="Enter keywords">
                                        <button type="submit" id="searchSubmit" name="searchSubmit">Submit</button>
                                    </form>
                                </li>
                            </ul>

                            <!-- Left Nav Section -->
                            <ul class="left">
                                <li><a href="<?=$baseURL?>/page/explore-our-harbour">Explore Our Harbour</a></li>
                                <li><a href="<?=$baseURL?>/events">Events</a></li>
                                <li><a href="<?=$baseURL?>/gallery">Gallery</a></li>
                                <li><a href="<?=$baseURL?>/page/local-insights">Local Insights</a></li>
                                <li><a href="<?=$baseURL?>/vivid" class="vivid">Vivid</a></li>
                            </ul>


                        </section>

                        <section class="top-bar-section second">
                            <ul class="routes">
                                <li>Routes:</li>
                                <li><a href="<?=$baseURL?>/route/manly" class="manly">Manly</a></li>
                                <li><a href="<?=$baseURL?>/route/taronga-zoo" class="taronga">Taronga Zoo</a></li>
                                <li><a href="<?=$baseURL?>/route/parramatta-river" class="parramatta">Parramatta River</a></li>
                                <li><a href="<?=$baseURL?>/route/darling-harbour" class="darling">Darling Harbour</a></li>
                                <li><a href="<?=$baseURL?>/route/neutral-bay" class="neutral">Neutral Bay</a></li>
                                <li><a href="<?=$baseURL?>/route/mosman-bay" class="mosman">Mosman Bay</a></li>
                                <li><a href="<?=$baseURL?>/route/eastern-suburbs" class="eastern">Eastern Suburbs</a></li>
                            </ul>
                        </section>

                    </nav>
                </div>
            </div>
        </section>