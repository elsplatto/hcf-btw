<?php
include '../includes/site-settings.php';
include '../includes/db.php';
include '../includes/Mobile_Detect.php';
include '../includes/global-functions.php';
require '../includes/instagram.class.php';
require '../includes/instagram.config.php';

$device = new Mobile_Detect;

$deviceType = ($device->isMobile() ? ($device->isTablet() ? 'tablet' : 'phone') : 'computer');

function getStepOneData($compId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    //echo '['.$compId.']['.$DB_SERVER.']['.$DB_USERNAME.']['.$DB_PASSWORD.']['.$DB_DATABASE.']';
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

    $stmt = $mysqli->prepare('SELECT intro_text, how_to_win, terms FROM competitions WHERE id= ?');
    $stmt->bind_param('i', $compId);
    $stmt->execute();
    $stmt->bind_result($intro_text, $how_to_win, $terms);
    $results = array();
    $results['intro_text'] = '';
    $results['how_to_win'] = '';
    $results['terms'] = '';
    while($stmt->fetch())
    {
        $results['intro_text'] = $intro_text;
        $results['how_to_win'] = $how_to_win;
        $results['terms'] = $terms;
    }
    $stmt->close();
    $mysqli->close();

    return $results;
}

function getStepTwoData($compId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    //echo '['.$compId.']['.$DB_SERVER.']['.$DB_USERNAME.']['.$DB_PASSWORD.']['.$DB_DATABASE.']';
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

    $stmt = $mysqli->prepare('SELECT terms FROM competitions WHERE id= ?');
    $stmt->bind_param('i', $compId);
    $stmt->execute();
    $stmt->bind_result($terms);
    $results = array();
    $results['terms'] = '';
    while($stmt->fetch())
    {
        $results['terms'] = $terms;
    }
    $stmt->close();
    $mysqli->close();

    return $results;
}


function getUserDetails($instagramId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

    //yes - user is member
    $stmt = $mysqli->prepare('SELECT id, firstname, lastname, email, home_wharf FROM user_members WHERE instagram_id = ?');
    $stmt->bind_param('s', $instagramId);
    $stmt->execute();
    $stmt->bind_result($id, $firstname, $lastname, $email, $wharf);

    $results = array();
    $results['id'] = '';
    $results['firstname'] = '';
    $results['lastname'] = '';
    $results['email'] = '';
    $results['home_wharf'] = '';
    while($stmt->fetch())
    {
        $results['id'] = $id;
        $results['firstname'] = $firstname;
        $results['lastname'] = $lastname;
        $results['email'] = $email;
        $results['home_wharf'] = $wharf;
    }
    $stmt->close();
    $mysqli->close();

    return $results;
}

function userEntered($userId, $competitionId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $userEntered = 0;
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

    $stmt = $mysqli->query('SELECT id FROM user_competition WHERE user_id = ' . $userId .' AND competition_id = ' . $competitionId);
    if ($stmt->num_rows > 0)
    {
        $userEntered = 1;
    }
    $mysqli->close();
    return $userEntered;
}

$competitionId = 1;
$compTag = 'beyondthewharf';
if (isset($_GET['competitionId']))
{
    $competitionId = $_GET['competitionId'];
}

if ($competitionId == 2)
{
    $compTag = 'vividsydney';
}

$wharfs = getFileContents('../json/wharfs.json');
$userEntered = 0;

if (isset($_GET['step']) || isset($instagramData))
{
    if (isset($_GET['step']))
    {
        $step = $_GET['step'];
    }
    else
    {
        $step = 2;

    }
}
else
{
    $step = 1;
}

if (isset($instagramData))
{
    $instagramUsername = $instagramData->user->username;
    $instagramId = $instagramData->user->id;
    $userDetails = getUserDetails($instagramId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

    if ($userDetails['id'] > 0)
    {
        $userEntered = userEntered($userDetails['id'], $competitionId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    }
}
else
{
    $instagramUsername = '';
}

$instagramLoginURL = $instagram->getLoginUrl(array('basic','likes','relationships','comments'));


if ($step == 1)
{
    $stepLabel = "View competition overlay.";
}
else if ($step == 2)
{
    $stepLabel = "View personal details form.";
}

?>

<div class="brandedBanner grey"><span></span></div>
<div id="competitionModal" class="paddingTop60 white">



<?php
if ($step == 1)
{
    $competitionDetails = getStepOneData($competitionId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $compIntroText = '';
    $compHowToWin = '';
    if (isset($competitionDetails))
    {
        $compIntroText = $competitionDetails['intro_text'];
        $compHowToWin = $competitionDetails['how_to_win'];
    }
?>
<section class="steps">

    <?=$compIntroText?>




    <a href="<?=$instagramLoginURL?>" class="button instagram" onClick="trackInternalLink('Competition Overlay - <?=$deviceType?>','Clicked Log into Instgram Button - Step 1 - CompID: <?=$competitionId?>');">Log into Instagram &amp; Enter</a>


    <?=$compHowToWin?>
    <!--ul class="arrowed show-hide">
        <li>
            <h4><a href="#">Capture the Essence of Sydney in a Photograph</a></h4>
            <div class="extra-info">
                <p>Take a great photo of Sydney harbour or the Parramatta river. Capture the people, the places and experiences accessed through our iconic ferry service.</p>
                <p>Jump on a ferry, explore our harbour and capture the essence of Sydney's most authentic experience. </p>
            </div>
        </li>
        <li>
            <h4><a href="#">Sign-up for the competition</a></h4>
            <div class="extra-info">
                <p>Simply sign-in using your Instagram account, provide us with your contact details and start snapping.</p>
                <p>If you don't already have an Instagram account, <a href="http://instagram.com" target="_blank" rel="nofollow">download the free app now</a>.</p>
            </div>
        </li>
        <li>
            <h4><a href="#">Share your photos</a></h4>
            <div class="extra-info">
                <p>Once you've signed up for the competition, share your best photos on Instagram.</p>
                <p>Simply tag each image with #beyondthewharf and encourage your friends to 'like' them. We'll also publish all submitted images
                    on beyondthewharf.com.au and our <a href="http://www.facebook.com/beyondthewharf" target="_blank" rel="nofollow">facebook page</a> for all the world to see.</p>
            </div>
        </li>
        <li>
            <h4><a href="#">Tips on how to win</a></h4>
            <div class="extra-info">
                <p>Our expert panel of judges will select winners based on the creativity and originality of the entries. The judges will be looking for images that present unique
                    perspectives of our awesome harbour and the communities that surround it. Special credit will be given to images that capture local secrets,
                    hidden gems and insight into the best and most authentic experiences on offer.</p>

                <p>Don't forget to visit beyondthewharf.com.au and use our tools to promote your images to your network.</p>
            </div>
        </li>
        <li>
            <h4><a href="#">Monthly winner</a></h4>
            <div class="extra-info">
                <p>The monthly winner will receive an awesome Joel Coleman artwork valued at $700.</p>

                <p>One winner will be selected each month for the duration of the competition. All winners will be announced and featured on beyondthewharf.com.au and our <a href="http://www.facebook.com/beyondthewharf" target="_blank" rel="nofollow">facebook page</a>. All winners will be notified by email.</p>
            </div>
        </li>
        <li>
            <h4><a href="#">Legal stuff</a></h4>
            <div class="extra-info">
                <p>The competition runs between 20/03/2014 to 20/06/2014 to enter the competition you must have taken the image yourself and own all legal rights to submit the image.</p>

                <p>Employees (and their immediate families) of the promoter and agencies associated with this promotion are ineligible to enter the competition.</p>
            </div>
        </li>
    </ul-->

    <a href="<?=$instagramLoginURL?>" class="button instagram" onClick="trackInternalLink('Competition Overlay - <?=$deviceType?>','Clicked Log into Instgram Button - Step 1 - CompID: <?=$competitionId?>');">Log into Instagram &amp; Enter</a>
</section>
<?php
}
else if ($step == 2)
{
    $competitionDetails = getStepTwoData($competitionId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $compTerms = '';
    if (isset($competitionDetails))
    {
        $compTerms = $competitionDetails['terms'];
    }
?>
<section class="steps" id="step2">
    <?php
    if ($userEntered == 0)
    {
    ?>
    <h3>Hello <?=$instagramUsername?>,</h3>
    <p>We just need a few details from you to enter you into the competition.<br /><sup class="red">*</sup>Mandatory Fields.</p>
    <form id="frmCompetition" action="<?=$baseURL?>/includes/process-competition-entry.php" method="post" data-abide="ajax">
        <input type="hidden" id="competitionId" name="competitionId" value="<?=$competitionId?>" />
        <label for="txtFirstname">First Name:<sup class="red">*</sup>
            <input type="text" name="txtFirstname" id="txtFirstname" value="<?=$userDetails['firstname']?>" required />
            <small class="error">Please enter your first name.</small>
        </label>

        <label for="txtLastname">Surname:<sup class="red">*</sup>
            <input type="text" name="txtLastname" id="txtLastname" value="<?=$userDetails['lastname']?>" required />
            <small class="error">Please enter your surname.</small>
        </label>

        <label for="txtEmail">Email Address:<sup class="red">*</sup>
            <input type="email" name="txtEmail" id="txtEmail" value="<?=$userDetails['email']?>" required />
            <small class="error">Please enter your email address.</small>
        </label>

        <label for="txtWharf">Your local wharf:
            <input type="text" name="txtWharf" id="txtWharf" value="<?=$userDetails['home_wharf']?>" />
        </label>

        <label for="chkTerms01">
            <input type="checkbox" name="chkTerms" id="chkTerms01" required />&nbsp;I agree to the <a href="#" id="openTandC" data-target="compTandC">Terms and Conditions</a>.
            <small class="error">Please agree to the terms and conditions.</small>
        </label>

        <label for="chkSubscribe">
            <input type="checkbox" name="chkSubscribe" id="chkSubscribe" value="1" />&nbsp;Yes, I want to receive news and promotions from Beyond The Wharf.</small>
        </label>

        <input type="submit" id="btnSubmitStory" class="button" value="Enter Competition" />&nbsp;&nbsp;&nbsp;<a href="#" class="reveal-close cancel">Cancel</a>

    </form>

    <div class="large-12 hide" id="compTandC">
        <?=$compTerms?>
    </div>

    <?php
    }
    else
    {
    ?>
        <h3>Hello <?=$instagramUsername?>,</h3>
        <p>You have already entered this competition.</p>
    <?php
    }
    ?>
</section>
<?php
}
else if ($step == 3)
{
?>
<section class="steps">
    <h3>Thank you</h3>
</section>
<?php
}
?>
</div>
<a class="close-reveal-modal reveal-close">Close this overlay</a>


<script src="<?=$baseURL?>/js/foundation/foundation.abide.js"></script>
<script src="<?=$baseURL?>/js/vendor/jquery-ui-1.10.4.custom.min.js"></script>
<script>

    $(function() {

        <?php
        if ($userEntered == 1)
        {
            echo 'getUsersRecentMedia($(\'#step2\'));';
        }
        ?>

        var wharfsArray = <?=$wharfs?>;
        $( "#txtWharf" ).autocomplete({
            source: wharfsArray
        });

        $('#openTandC').click(function(e)
        {
            e.preventDefault();
            var target = $('#'+$(this).attr('data-target'));

            if (target.hasClass('hide'))
            {
                target.removeClass('hide');
                var scrollHeight = ($(this).offset().top - $('#navHolder').outerHeight());
                $('html, body').animate({
                    scrollTop: scrollHeight
                },'slow');
            }
            else
            {
                target.addClass('hide');
            }
        });

        $('#frmCompetition').foundation('abide');

        $('#frmCompetition').submit(function(e) {
            e.preventDefault();

            if (!$('#chkTerms01').is(':checked'))
            {
                $('#chkTerms01').attr('data-invalid','');
                $('label[for="chkTerms01"]').addClass('error');
            }

            if ($('[data-invalid]').length == 0)
            {
                trackInternalLink('Competition Overlay - <?=$deviceType?>','Submitted Entry Form - Step 2 - CompID: <?=$competitionId?>');
                var el = $(this);
                var url = $(this).attr('action');
                var firstname, lastname, email, wharf, competitionId;
                var subscribe = 0;
                competitionId = $('#competitionId').val();
                firstname = $('#txtFirstname').val();
                lastname = $('#txtLastname').val();
                email = $('#txtEmail').val();
                wharf = $('#txtWharf').val();
                if ($('#chkSubscribe').is(':checked'))
                {
                    subscribe = 1;
                }
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        firstname: firstname,
                        lastname: lastname,
                        email: email,
                        wharf: wharf,
                        subscribe: subscribe,
                        competitionId: competitionId
                    },
                    dataType: 'json',
                    cache: false,
                    beforeSend: function()
                    {
                        beforePostHandler(el);
                    },
                    success: function(data) {
                        successPostHandler(data, el);
                    },
                    error: function(data) {
                        errorPostHandler(data, el);
                    },
                    complete: function(data)
                    {
                        completePostHandler(data, el.parent('section'));
                    }
                });
            }
        });

        function beforePostHandler(el)
        {
            var section = el.parent('section');
            el.hide();
            section.addClass('complete');
            section.append('<div id="postEntryLoader"></div>');
            var cl = new CanvasLoader('postEntryLoader');
            cl.setColor('#59acb3');
            cl.setShape('square'); // default is 'oval'
            cl.setDiameter(40); // default is 40
            cl.setDensity(90); // default is 40
            cl.setRange(1); // default is 1.3
            cl.setSpeed(3); // default is 2
            cl.setFPS(24); // default is 24
            cl.show(); // Hidden by default
        }

        function successPostHandler(data,el)
        {
            var obj = JSON.parse(data);
            //console.dir(obj);
            //console.log('success');
            //$('#postEntryLoader').remove();
            //el.parent('section').html('');
            var html = '';
            html += '<h3>Thank you for entering.</h3>';
            html += '<p>Thanks for joining us in our quest to capture the essence of Sydney Harbour. Don\'t forget to tag your photos with #<?=$compTag?> and promote your images with our social sharing tools.</p>';
            trackInternalLink('Competition Overlay - <?=$deviceType?>','Entry Successful - Step 3 - CompID: <?=$competitionId?>');
            el.parent('section').html(html);
        }

        function errorPostHandler(data,el)
        {
            $('#postEntryLoader').remove();
            el.parent('section').empty();
            el.parent('section').append('<p>Something went wrong - please try again later.</p>');
        }

        function completePostHandler(data, el)
        {
            //console.log('complete');
            //console.dir(el);
            getUsersRecentMedia($('#step2'));
        }

        function getUsersRecentMedia(targetEl)
        {
            var url = '<?=$baseURL?>/services/instagram-get-users-recent.php';

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    tag: '<?=$compTag?>'
                },
                dataType: 'json',
                cache: false,
                beforeSend: function()
                {
                    beforeGetRecentHandler(targetEl);
                },
                success: function(data) {
                    successGetRecentHandler(data, targetEl);
                },
                error: function(data) {
                    //console.log('failed');
                    //console.dir(data);
                },
                complete: function(data)
                {
                    completeGetRecentHandler(data, targetEl);
                }

            });
        }

        function beforeGetRecentHandler(el)
        {
            el.append('<div id="recentMediaLoader"></div>');
            el.addClass('complete');
            var cl = new CanvasLoader('recentMediaLoader');
            cl.setColor('#59acb3');
            cl.setShape('square'); // default is 'oval'
            cl.setDiameter(40); // default is 40
            cl.setDensity(90); // default is 40
            cl.setRange(1); // default is 1.3
            cl.setSpeed(3); // default is 2
            cl.setFPS(24); // default is 24
            cl.show(); // Hidden by default
        }

        function successGetRecentHandler(data, el)
        {
            $('#recentMediaLoader').remove();
            var dataObj = data;
            var loadHTML = '<h4>Perhaps you would like to promote your photos.</h4>';
            loadHTML += '<p>Click on the twitter button to broadcast your photo via twitter. Encourage your friends to "Like" your photos.</p>';
            var altText = '';
            if (dataObj.length > 0)
            {
                for (var i=0; i<dataObj.length;i++)
                {

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

                    loadHTML += '<div class="small-12 medium-6 large-3 columns">';
                    loadHTML += '<div class="small-12 large-12 insta">';
                    loadHTML += '<img src="'+dataObj[i].images.low_resolution.url+'" alt="'+altText+'" />';
                    loadHTML += '<div class="infoContainer">';
                    loadHTML += '<div class="inner">';


                    loadHTML += '<a href="https://twitter.com/share?url=<?=$baseURL?>/gallery/'+dataObj[i].id+'&text=Check this photo out&hashtag=<?=$compTag?>&count=none" class="twitter-share-button gallery-tweet" data-lang="en">Tweet</a>';
                    loadHTML += '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");<\/script>';

                    loadHTML += '</div>';
                    loadHTML += '</div>';
                    loadHTML += '</div>';
                    loadHTML += '</div>';
                    el.append(loadHTML);
                    loadHTML = '';
                }
            }
            return false;
        }

        function completeGetRecentHandler(data, targetEl)
        {
            twttr.widgets.load();
        }

        $('.show-hide li h4 a').click(function(e){
            e.preventDefault();
            var target = $(this).parent('h4').next('.extra-info');
            var listItem = $(this).closest('li');
            if (listItem.hasClass('active'))
            {
                target.hide();
                listItem.removeClass('active');
            }
            else
            {
                target.show();
                listItem.addClass('active');
            }

        })
    });
</script>

