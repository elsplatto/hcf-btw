<?php
$pageMetaTitle = "Pro Gallery - Vivid Sydney Pro Gallery.";
$pageSection = "vivid";
$pageMetaDesc = "View great night time photos taken for Vivid Sydney by Understand Down Under photographer Andy Richards..";
$pageMetaKeywords = "Sydney, vivid, 2014, photos, gallery, harbour, experiences";
include '../includes/head.php';
/*global includes in head.php*/

$callbackURL = $baseURL.'/vivid/gallery-pro';

?>
<body>
<?php
include '../includes/nav.php';

?>

<section class="breadcrumbsHolder">
    <div class="row">
        <div class="large-12 columns breadcrumbs">
            <a href="<?=$baseURL?>/">Home</a> <a href="<?=$baseURL?>/vivid/">Vivid</a><span>Pro Gallery</span>
        </div>
    </div>
</section>

<section class="photoSection<?=$galleryHeaderClass?>">

    <div class="row paddingTop20">
        <div class="large-12 columns">
            <h2 class="block clearfix text-left">UDU NIGHT PHOTOGRAPHY</h2>

        </div>
    </div>

</section>


<section class="proGallerySection marginBottomStandard">

    <div class="row">


        <div class="small-12 medium-6 large-6 columns">
            <img src="<?=$baseURL?>/img/gallery/vivid/pro/vivid-sydney-2014.jpg" alt="Vivid!" />
        </div>

        <div class="small-12 medium-6 large-3 columns">
            <img src="<?=$baseURL?>/img/gallery/vivid/pro/vivid-sydney-btw.jpg" alt="Beyond the wharf" />
        </div>

        <div class="small-12 medium-6 large-3 columns">
            <img src="<?=$baseURL?>/img/gallery/vivid/pro/vivid-sydney-light-streams.jpg" alt="Light waves" />
        </div>

        <div class="small-12 medium-6 large-6 right columns">
            <img src="<?=$baseURL?>/img/gallery/vivid/pro/vivid-sydney-angel-family.jpg" alt="Angel wings" />
        </div>

        <div class="small-12 medium-6 large-3 columns">
            <img src="<?=$baseURL?>/img/gallery/vivid/pro/vivid-sydney-light-ferries.jpg" alt="Boats drawn with light" />
        </div>

        <div class="small-12 medium-6 large-3 columns">
            <img src="<?=$baseURL?>/img/gallery/vivid/pro/vivid-sydney-light-ferries02.jpg" alt="Light play on harbour" />
        </div>

    </div>
</section>

<section class="darkPurpleBackground paddingTopBottom20">
    <div class="row marginBottomStandard">
        <h3 class="text-center">Night Photography Course</h3>
        <div class="large-12 columns">
            <div class="large-12 lightPurpleBackground">
                <div class="large-12 padding32 overflow">
                    <div class="large-6 left paddingRight32">
                        <h2 class="block text-left">UDU NIGHT PHOTOGRAPHY CLASS</h2>
                        <span>Make the most of VIVID festival by learning how to master night photography and long exposures. Enjoy the art of playing with light, and create magical images with writing and drawing or sublime studio style portraits... using only a torch!</span>
                        <!--p class="paddingTop10">
                            Lauren had already accumulated close to 345,000 followers, and travels around the world, posting photos on her Instagram account to a huge market audience and getting paid big bucks to do it.
                        </p-->
                        <h4 class="block text-center paddingTopBottom40">Duration: 90 Minutes <br />From AUD $50.00</h4>
                        <p>
                            Sessions are at 6:00pm or 8:00pm, Bookings are accepted through our easy to use online system.
                        </p>
                        <div class="large-12 text-center paddingTop20">
                            <a href="https://udu.rezdy.com/25571/vivid-special-learn-night-photography" class="button orange"  rel="nofollow" onClick="trackOutboundLink('https://udu.rezdy.com/25571/vivid-special-learn-night-photography'); return false;">Book Now</a>
                        </div>
                    </div>
                    <div class="large-6 orangeBackground left padding32 text-center">
                        <img src="<?=$baseURL?>/img/content/beyondthewharf-lights.jpg" alt="Beyond The Wharf spelt out with lights for Vivid Sydney 2014" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="proGallerySection paddingTopBottom40">

    <div class="row">

        <div class="small-12 medium-6 large-6 columns">
            <img src="<?=$baseURL?>/img/gallery/vivid/pro/vivid-sydney-light-streams03.jpg" alt="Light streams" />
        </div>


        <div class="small-12 medium-6 large-6 columns">
            <img src="<?=$baseURL?>/img/gallery/vivid/pro/vivid-sydney-zak.jpg" alt="ZAK" />
        </div>


        <div class="small-12 medium-6 large-6 columns">
            <img src="<?=$baseURL?>/img/gallery/vivid/pro/vivid-sydney-double-family.jpg" alt="Family and City" />
        </div>


        <div class="small-12 medium-6 large-6 columns">
            <img src="<?=$baseURL?>/img/gallery/vivid/pro/vivid-sydney-angels.jpg" alt="Angels" />
        </div>

    </div>
</section>

<section class="lightPurpleBackground paddingTopBottom20">
    <div class="row marginBottom20">
        <div class="large-12 columns">
            <h3 class="text-center galleryTitle">Vivid Sydney Instagram Gallery</h3>
            <?php
            if (isset($instagramData))
            {
                $instagramLogoutURL = '?id=logout';
                $instagramUsername = $instagramData->user->username;
                echo '<h4>Welcome ' . $instagramUsername . '</h4>';
                echo '<a href="'.$instagramLogoutURL.'" class="button">Logout of Instagram</a>';
            }
            /*
            else
            {
                echo '<a href="'.$instagramLoginURL.'" class="button">Log into Instagram</a>';
            }*/
            ?>
        </div>
        <div class="large-12">
            <?php
            $instaMaxCount = 5;
            $instaFeature = true;
            include '../includes/instagram-get-latest.php';
            ?>
        </div>
        <div class="large-12 paddingTop40 columns text-center">

            <a href="<?=$baseURL?>/vivid/gallery" class="button">Go to Gallery</a>

            <h3 class="block">
                Share your experience
            </h3>
            <h4>Tag your instagram photos with <span class="tag">#vividsydney</span></h4>
            <?php
            if ($instagramUserLoggedIn)
            {
                $instagramFollowData = $instagram->getUserRelationship($btwInstagramID);
                $instagramFollowStatus = $instagramFollowData->data->outgoing_status;

                //echo '['.$instagramFollowStatus.']';

                if ($instagramFollowStatus == 'none')
                {
                    echo '<a href="'.$baseURL.'/services/instagram-follow-btw.php" class="button stdDarkGrey insta-follow">Follow us on <span class="social instagram small"></span> Instagram</a>';
                }
                else if ($instagramFollowStatus == 'follows')
                {
                    echo '<a href="'.$baseURL.'/services/instagram-unfollow-btw.php" class="button stdGreen insta-unfollow"><span class="social instagram small"></span> Following</a>';
                }
            }
            else{

                echo '<a href="'.$baseURL.'/overlays/instagram-login.php?call_page='.$callbackURL.'" class="button stdDarkGrey reveal-init">Follow us on <span class="social instagram small"></span> Instagram</a>';
            }
            ?>

        </div>
    </div>
</section>


<section class="proGallerySection paddingTopBottom40">

    <div class="row">

        <div class="small-12 medium-6 large-6 columns">
            <img src="<?=$baseURL?>/img/gallery/vivid/pro/vivid-sydney-light-writing01.jpg" alt="SYDNEY!!" />
        </div>


        <div class="small-12 medium-6 large-6 columns">
            <img src="<?=$baseURL?>/img/gallery/vivid/pro/vivid-sydney-btwvivid.jpg" alt="#BTWVIVID" />
        </div>

    </div>
</section>



<?php
include '../includes/footer.php';
?>


<?php
$pageId = 0;
include '../includes/global-js.php';
include '../includes/instagram-js.php';
?>


<?php
include '../includes/analytics.php';
?>

<script>
$(function(){

    <?if ($competitionId == 1)
    {
    ?>
    $('#competitionPromo').trigger('click');
    <?php
    }
    ?>

    $('body').on( 'click', '#btnLoadMoreInstagram', function(e){
        e.preventDefault();
        var maxId = $(this).attr('data-maxId');
        //console.log('['+maxId+']');
        var url = $(this).attr('href');
        var el = $(this);
        var tag = 'vividsydney';
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                max_id: maxId,
                tag: tag
            },
            dataType: 'json',
            cache: false,
            beforeSend: function()
            {
                beforeLoadMoreHandler(el);
            },
            success: function(data) {
                successLoadMoreHandler(data, el);
            },
            error: function(data) {
                //console.log('failed');
                //console.dir(data);
            },
            complete: function(data)
            {
                completeLoadMoreHandler(data, el);
            }

        });
    });

    function beforeLoadMoreHandler(el)
    {
        el.html('<div id="loadMoreLoader"></div>');
        var cl = new CanvasLoader('loadMoreLoader');
        cl.setColor('#ffffff');
        cl.setShape('square'); // default is 'oval'
        cl.setDiameter(25); // default is 40
        cl.setDensity(90); // default is 40
        cl.setRange(1); // default is 1.3
        cl.setSpeed(3); // default is 2
        cl.setFPS(24); // default is 24
        cl.show(); // Hidden by default
    }

    function successLoadMoreHandler(data, el)
    {
        var dataObj = data.data;
        var paginationObj = data.pagination;
        var loadHTML = '';

        var isUserLoggedIn = el.attr('data-instgramUserLoggedIn');

        var instagramCommentURL = '<?=$baseURL?>/overlays/instagram-login.php?call_page=<?=$callbackURL?>';
        var instagramLikeURL = '<?=$baseURL?>/overlays/instagram-login.php?call_page=<?=$callbackURL?>';
        var likeRevealInitClass = ' reveal-init';

        if (isUserLoggedIn > 0)
        {
            instagramCommentURL = '<?=$baseURL?>/overlays/instagram-comment.php';
            likeRevealInitClass = '';
        }
        var blnUserHasLiked = false;
        var userLikedClass = '';
        var likeText = 'Click to like';

        var altText = '';

        for (var i=0; i<dataObj.length;i++)
        {
            loadHTML += '<div class="small-6 medium-3 large-3 columns">';
            loadHTML += '<div class="small-12 large-12 insta">';
            if (dataObj[i].caption != null)
            {
                if (dataObj[i].caption.text == null)
                {
                    altText = '';
                }
                else
                {
                    altText = dataObj[i].caption.text;
                }
            }
            else
            {
                altText = '';
            }

            if (dataObj[i].type == 'video')
            {
                var videoClass = ' video';
            }
            else
            {
                var videoClass = '';
            }


            loadHTML += '<a href="<?=$instagramPicLink?>?media_id='+dataObj[i].id+'" data-reveal-ajax="true" class="reveal-init'+videoClass+'" data-size="medium" data-mediaId="'+dataObj[i].id+'"><img src="'+dataObj[i].images.low_resolution.url+'" alt="'+ altText +'" /></a>';

            loadHTML += '<a href="'+instagramCommentURL+'?media_id='+dataObj[i].id+'" class="comments reveal-init" data-size="medium" data-mediaId="'+dataObj[i].id+'" role="button"><span>'+dataObj[i].comments.count+'</span></a>';

            if (dataObj[i].hasOwnProperty('user_has_liked'))
            {
                blnUserHasLiked = dataObj[i].user_has_liked;
            }

            if (isUserLoggedIn > 0)
            {
                if (blnUserHasLiked)
                {
                    instagramLikeURL = '<?=$baseURL?>/services/instagram-unlike-media.php?media_id='+dataObj[i].id;
                    userLikedClass = ' userLikes';
                    likeText = 'Click to unlike';

                }
                else if (!blnUserHasLiked)
                {
                    instagramLikeURL = '<?=$baseURL?>/services/instagram-like-media.php?media_id='+dataObj[i].id;
                    userLikedClass = ' userNoLikes';
                    likeText = 'Click to like';
                }
            }

            loadHTML += '<a href="'+instagramLikeURL+'" class="likes'+userLikedClass + likeRevealInitClass+'" title="'+likeText+'" data-mediaId="'+dataObj[i].id+'" role="button">';
            loadHTML += '<span data-mediaId="'+dataObj[i].id+'" data-likesCount="'+dataObj[i].likes.count+'" data-displayCount>'+dataObj[i].likes.count+'</span></a>';

            loadHTML += '<div class="infoContainer">';
            loadHTML += '<div class="inner">';
            if (dataObj[i].hasOwnProperty('location'))
            {
                if (dataObj[i].location == null)
                {
                    loadHTML += '<span class="location">&nbsp;</span>';
                }

                else if (dataObj[i].location.hasOwnProperty('name'))
                {
                    loadHTML += '<span class="location">'+dataObj[i].location.name+'</span>';
                }
                else if (dataObj[i].location.hasOwnProperty('latitude') && dataObj[i].location.hasOwnProperty('longitude'))
                {
                    loadHTML += '<span class="location raw">'+dataObj[i].location.latitude+' ,'+dataObj[i].location.longitude+'</span>';
                }

            }
            else
            {
                loadHTML += '<span class="location">&nbsp;</span>';
            }
            loadHTML += '<span class="credit">'+dataObj[i].user.username+'</span>';
            loadHTML += '<a href="https://twitter.com/share?url=<?=$baseURL?>/gallery/'+dataObj[i].id+'&text=Check this photo out&hashtag=vividsydney&count=none" class="twitter-share-button gallery-tweet" data-lang="en">Tweet</a>';
            loadHTML += '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");<\/script>';

            loadHTML += '</div>';
            loadHTML += '</div>';


            loadHTML += '</div>';
            loadHTML += '</div>';
            $('#photoHolder02').append(loadHTML);
            loadHTML = '';
        }


        //ok - now let's see if we have more images sitting on instagram - adjust the button if we don't
        if (paginationObj.next_max_tag_id != 'undefined' && paginationObj.next_max_tag_id != undefined)
        {
            el.attr('data-maxId',paginationObj.next_max_tag_id);
            el.html('');
            el.text('Load More');
        }
        else
        {
            el.attr('data-maxId','');
            el.attr('disabled','disabled');
            el.removeAttr('href');
            el.html('');
            el.text('All photos have been fetched');
            $('body').off( 'click', '#btnLoadMoreInstagram');
        }
    }

    function completeLoadMoreHandler(data, el)
    {
        //load twitter widgets
        twttr.widgets.load();
    }

    /* TODO get location function working
     $('.location.raw').each(function(i) {
     var latLng = $(this).text().toString();
     //console.log('['+latLng+']');
     latLng = latLng.split(',');
     var lat = latLng[0].toString().trim();
     var lng = latLng[1].toString().trim();
     //console.log('lat: ['+lat + ']lng: [' + lng + ']');

     var latlng = new google.maps.LatLng(lat, lng);
     var geocoder = new google.maps.Geocoder();
     var address = '';

     geocoder.geocode({ 'latLng': latlng }, function (results, status) {
     if (status !== google.maps.GeocoderStatus.OK) {
     //console.log(status);
     address = '';
     }
     // This is checking to see if the Geoeode Status is OK before proceeding
     if (status == google.maps.GeocoderStatus.OK) {
     // console.log('results['+results+']');
     //address = (results[0].formatted_address);
     var suburb = results[0].address_components[2].long_name + ', ';
     var state = results[0].address_components[3].short_name + ' ';
     var postcode = results[0].address_components[5].long_name;
     address = suburb + state + postcode;

     //console.log('address inside['+address+']');
     }

     });

     console.log('address['+address+']')
     });*/


});
</script>
</body>
</html>