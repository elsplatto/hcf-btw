<?php
include 'includes/admin-settings.php';
include '../includes/site-settings.php';
include '../includes/db.php';
include '../includes/global-functions.php';
require '../includes/instagram.class.php';
require '../includes/instagram.config.php';
include 'includes/global-admin-functions.php';
assessLogin($securityArr);

function getShotOfTheDay($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

    $query = 'SELECT potd.id, potd.instagram_media_id, potd.date_live, potd.admin_user_id, au.firstname, au.lastname FROM pic_of_the_day potd ';
    $query .= 'INNER JOIN admin_users au ON potd.admin_user_id = au.id WHERE potd.is_valid = 1';
    $stmt = $mysqli->prepare($query);

    $stmt->execute();
    $stmt->bind_result($id, $instagram_media_id, $date_live, $admin_user_id, $firstname, $lastname);

    $results = array();
    while($stmt->fetch())
    {
        $results['id'] = $id;
        $results['instagram_media_id'] = $instagram_media_id;
        $results['date_live'] = $date_live;
        $results['admin_user_id'] = $admin_user_id;
        $results['firstname'] = $firstname;
        $results['lastname'] = $lastname;
    }
    $stmt->close();
    $mysqli->close();
    return $results;
}

function getPreviousShotsOfTheDay($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

    $query = 'SELECT potd.id, potd.instagram_media_id, potd.date_live, potd.date_remove, potd.admin_user_id, au.firstname, au.lastname FROM pic_of_the_day potd ';
    $query .= 'INNER JOIN admin_users au ON potd.admin_user_id = au.id ORDER BY potd.id ASC';
    $stmt = $mysqli->prepare($query);

    $stmt->execute();
    $stmt->bind_result($id, $instagram_media_id, $date_live, $date_remove, $admin_user_id, $firstname, $lastname);

    $results = array();
    $i = 0;
    while($stmt->fetch())
    {
        $results[$i]['id'] = $id;
        $results[$i]['instagram_media_id'] = $instagram_media_id;
        $results[$i]['date_live'] = $date_live;
        $results[$i]['date_remove'] = $date_remove;
        $results[$i]['admin_user_id'] = $admin_user_id;
        $results[$i]['firstname'] = $firstname;
        $results[$i]['lastname'] = $lastname;
        $i++;
    }
    $stmt->close();
    $mysqli->close();
    return $results;
}

$shotOfTheDay = getShotOfTheDay($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
$previousShotsOfTheDay = getPreviousShotsOfTheDay($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

$previousMediaIDs = array();

for ($j = 0; $j < count($previousShotsOfTheDay); $j++) {
    array_push($previousMediaIDs, $previousShotsOfTheDay[$j]['instagram_media_id']);
}


$instagramSingleMediaResults = $instagram->getMedia($shotOfTheDay['instagram_media_id'], false);

//$instagramResults = $instagram->getTagMedia('beyondthewharf',false);

foreach ($instagramSingleMediaResults as $post) {
    if (isset($post->id))
    {
        if ($shotOfTheDay['instagram_media_id'] == $post->id)
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
                $instagramVideo = $post->videos->standard_resolution->url;
            }
            else
            {
                $isVideo = false;
            }

        }
    }
}

?>
<html>
<head>
    <?php
    include 'includes/head.php';
    ?>
</head>
<body>

<?php
include 'includes/header.php';
?>
<section>
    <div class="row">
        <div class="large-12 columns">
            <a href="dashboard.php">Home</a>
            <h1>
                Shot of the day
            </h1>

            <input type="text" id="txtFilter" placeholder="Type the user names of people you want to see" />
        </div>
    </div>
</section>

<section>
    <div class="row">
        <div class="large-12 columns">
            <form action="shot-of-the-day-process.php" name="frmShotOfTheDay" id="frmShotOfTheDay" method="post">
                <label for="mediaId">Media ID:
                    <input type="text" id="txtMediaId" name="txtMediaId" value="<?=$shotOfTheDay['instagram_media_id']?>" readonly />
                    <input type="hidden" id="compareMediaId" name="compareMediaId" value="<?=$shotOfTheDay['instagram_media_id']?>" />
                </label>
                <input type="submit" name="sbmtPic" id="sbmtPic" class="button" value="Submit" disabled />
            </form>
        </div>
    </div>
</section>


<section>
    <div class="row" id="galleryHolder">
        <div class="large-6 columns left marginBottom20">
            <img src="<?=$instagramImg?>" id="todaysPic" />
            <span class="button green photo-of-the-day">Photo of the day</span>
        </div>
    </div>

    <div class="row marginTop40">
        <div class="large-12 text-center" id="loadMoreholder">

        </div>
    </div>
</section>
<?php
include 'includes/footer.php';
?>
<script src="../js/vendor/plugins/indie/heartcode-canvasloader-min-0.9.1.js"></script>

<script>
$(function() {
    var previousShots = [];
    <?php
    foreach ($previousShotsOfTheDay as $shot)
    {
    ?>
    previousShots.push('<?=$shot['instagram_media_id']?>');
    <?php
    }
    ?>
    $.ajax({
        type: 'POST',
        url: '../services/instagram-fetch-media-by-tag.php',
        data: {
            tag: 'beyondthewharf'
        },
        dataType: 'json',
        cache: false,
        success: function(data) {
            successFetchMedia(data);
        }
    });

    $('#txtFilter').keyup(function(e){
        var filterVal = $(this).val();

        if (filterVal.length > 2)
        {
            $('#galleryHolder').children('.instaImg').hide();
            $('#galleryHolder').children('.instaImg').each(function(i) {
                var arr = filterVal.split(',');
                //console.log('length: ' + arr.length);
                for (var j=0; j<arr.length; j++)
                {
                    if ($(this).attr('data-username') == arr[j].trim())
                    {
                        $(this).show();
                    }
                }
            });
        }
        else
        {
            $('#galleryHolder').children('.instaImg').show();
        }

    });

    function successFetchMedia(data) {
        var mediaHTML = '';
        var previousFlag = false;
        var dataObj = data.data;
        for (var i=0; i<dataObj.length;i++)
        {
            previousFlag = false;
            if (previousShots.indexOf(dataObj[i].id) > 0)
            {
                previousFlag = true;
            }
            mediaHTML = '<div class="small-6 medium-3 large-3 columns marginBottom40 instaImg" data-username="'+ dataObj[i].user.username +'">';
            if (!previousFlag)
            {
                mediaHTML += '<a href="#" class="setPicOfTheDay" data-standardURL="'+dataObj[i].images.standard_resolution.url+'" data-mediaId="'+dataObj[i].id+'">';
            }
            mediaHTML += '<img src="'+dataObj[i].images.low_resolution.url+'" class="feedImg" />';
            if (!previousFlag)
            {
                mediaHTML += '</a>';
            }
            else
            {
                mediaHTML += '<div class="ribbon-wrapper"><div class="ribbon red">Used</div></div>';
            }
            mediaHTML += '<a href="http://instagram.com/'+dataObj[i].user.username+'" target="_blank" rel="nofollow" class="instaUser">'+dataObj[i].user.username+'</a>';
            mediaHTML += '</div>';
            $('#galleryHolder').append(mediaHTML);
            mediaHTML = '';
        }
        /*
         var lastImg = $('#galleryHolder').last('.instaImg').find('img');
         lastImg.css({
         'outline': '1px solid red'
         });
         var rgb = getAverageRGB(lastImg);
         console.log('rgb('+rgb.r+','+rgb.b+','+rgb.g+')');
         */
        $('#loadMoreholder').html('<a href="../services/instagram-load-more.php" id="btnLoadMoreInstagram" class="button" data-maxId="'+data.pagination.next_max_id+'" data-instgramUserLoggedIn="false>">Load More</a>');
    }




    $('body').on( 'click', '#btnLoadMoreInstagram', function(e){
        e.preventDefault();
        var maxId = $(this).attr('data-maxId');
        var url = $(this).attr('href');
        var el = $(this);
        $.ajax({
            type: 'POST',
            url: url,
            data: {
                max_id: maxId
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
                //completeLoadMoreHandler(data, el);
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
        var mediaHTML = '';
        var previousFlag = false;

        for (var i=0; i<dataObj.length;i++)
        {
            previousFlag = false;
            if (previousShots.indexOf(dataObj[i].id) > 0)
            {
                previousFlag = true;
            }
            mediaHTML = '<div class="small-6 medium-3 large-3 columns marginBottom40 instaImg" data-username="'+ dataObj[i].user.username +'">';
            if (!previousFlag)
            {
                mediaHTML += '<a href="#" class="setPicOfTheDay" data-standardURL="'+dataObj[i].images.standard_resolution.url+'" data-mediaId="'+dataObj[i].id+'">';
            }
            mediaHTML += '<img src="'+dataObj[i].images.low_resolution.url+'" class="feedImg" />';
            if (!previousFlag)
            {
                mediaHTML += '</a>';
            }
            else
            {
                mediaHTML += '<div class="ribbon-wrapper"><div class="ribbon red">Used</div></div>';
            }
            mediaHTML += '<a href="http://instagram.com/'+dataObj[i].user.username+'" target="_blank" rel="nofollow" class="instaUser">'+dataObj[i].user.username+'</a>';
            mediaHTML += '</div>';
            $('#galleryHolder').append(mediaHTML);
            mediaHTML = '';
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

    $('body').on( 'click', '.setPicOfTheDay', function(e){
        e.preventDefault();
        var imgURL = $(this).attr('data-standardURL');
        var imgMediaId = $(this).attr('data-mediaId');
        $('#todaysPic').attr('src',imgURL);
        $('#txtMediaId').val(imgMediaId);
        if ($('#txtMediaId').val() !== $('#compareMediaId').val())
        {
            $('#sbmtPic').removeAttr('disabled');
        }
    })


    //var rgb = getAverageRGB(document.getElementById('i'));
    //document.body.style.backgroundColor = 'rgb('+rgb.r+','+rgb.b+','+rgb.g+')';

    function getAverageRGB(imgEl) {

        var blockSize = 5, // only visit every 5 pixels
            defaultRGB = {r:0,g:0,b:0}, // for non-supporting envs
            canvas = document.createElement('canvas'),
            context = canvas.getContext && canvas.getContext('2d'),
            data, width, height,
            i = -4,
            length,
            rgb = {r:0,g:0,b:0},
            count = 0;

        if (!context) {
            return defaultRGB;
        }

        height = canvas.height = imgEl.naturalHeight || imgEl.offsetHeight || imgEl.height;
        width = canvas.width = imgEl.naturalWidth || imgEl.offsetWidth || imgEl.width;

        /*Start cds work around*/

        var img = document.createElement("img");
        img.src = imgEl.attr('src');

        var ctx = canvas.getContext("2d");
        ctx.drawImage(img,0,0);

        var dataStr = canvas.toDataURL("image/png");
        window.location=dataStr;


        console.log(dataStr);


        context.drawImage(imgEl, 0, 0);

        try {
            data = context.getImageData(0, 0, width, height);
        } catch(e) {
            /* security error, img on diff domain */alert('x');
            return defaultRGB;
        }

        length = data.data.length;

        while ( (i += blockSize * 4) < length ) {
            ++count;
            rgb.r += data.data[i];
            rgb.g += data.data[i+1];
            rgb.b += data.data[i+2];
        }

        // ~~ used to floor values
        rgb.r = ~~(rgb.r/count);
        rgb.g = ~~(rgb.g/count);
        rgb.b = ~~(rgb.b/count);

        return rgb;

    }


});
</script>

</body>
</html>