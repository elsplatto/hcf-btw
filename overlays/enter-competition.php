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

    $stmt = $mysqli->prepare('SELECT intro_text, how_to_win, terms, success_message FROM competitions WHERE id= ?');
    $stmt->bind_param('i', $compId);
    $stmt->execute();
    $stmt->bind_result($intro_text, $how_to_win, $terms, $success_message);
    $results = array();
    $results['intro_text'] = '';
    $results['how_to_win'] = '';
    $results['terms'] = '';
    $results['success_message'] = '';
    while($stmt->fetch())
    {
        $results['intro_text'] = $intro_text;
        $results['how_to_win'] = $how_to_win;
        $results['terms'] = $terms;
        $results['success_message'] = $success_message;
    }
    $stmt->close();
    $mysqli->close();

    return $results;
}

function getStepTwoData($compId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    //echo '['.$compId.']['.$DB_SERVER.']['.$DB_USERNAME.']['.$DB_PASSWORD.']['.$DB_DATABASE.']';
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

    $stmt = $mysqli->prepare('SELECT terms, success_message FROM competitions WHERE id= ?');
    $stmt->bind_param('i', $compId);
    $stmt->execute();
    $stmt->bind_result($terms, $success_message);
    $results = array();
    $results['terms'] = '';
    $results['success_message'] = '';
    while($stmt->fetch())
    {
        $results['terms'] = $terms;
        $results['success_message'] = $success_message;
    }
    $stmt->close();
    $mysqli->close();

    return $results;
}


function getUserDetails($instagramId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

    //yes - user is member
    $stmt = $mysqli->prepare('SELECT id, firstname, lastname, email, home_wharf, instagram_username FROM user_members WHERE instagram_id = ?');
    $stmt->bind_param('s', $instagramId);
    $stmt->execute();
    $stmt->bind_result($id, $firstname, $lastname, $email, $wharf, $instagram_username);

    $results = array();
    $results['id'] = '';
    $results['firstname'] = '';
    $results['lastname'] = '';
    $results['email'] = '';
    $results['home_wharf'] = '';
    $results['instagram_username'] = '';
    while($stmt->fetch())
    {
        $results['id'] = $id;
        $results['firstname'] = $firstname;
        $results['lastname'] = $lastname;
        $results['email'] = $email;
        $results['home_wharf'] = $wharf;
        $results['instagram_username'] = $instagram_username;
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
$competitionDetails = getStepOneData($competitionId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
$compIntroText = '';
$compHowToWin = '';
$successMsg = '';
if (isset($competitionDetails))
{
    $compIntroText = $competitionDetails['intro_text'];
    $compHowToWin = $competitionDetails['how_to_win'];
    $successMsg = $competitionDetails['success_message'];
}

if ($step == 1)
{

?>
<section class="steps">

    <?=$compIntroText?>

    <a href="<?=$instagramLoginURL?>" class="button instagram" onClick="trackInternalLink('Competition Overlay - <?=$deviceType?>','Clicked Log into Instgram Button - Step 1 - CompID: <?=$competitionId?>');">Log into Instagram &amp; Enter</a>


    <?=$compHowToWin?>


    <a href="<?=$instagramLoginURL?>" class="button instagram" onClick="trackInternalLink('Competition Overlay - <?=$deviceType?>','Clicked Log into Instgram Button - Step 1 - CompID: <?=$competitionId?>');">Log into Instagram &amp; Enter</a>
</section>
<?php
}
else if ($step == 2)
{
    $competitionDetails = getStepTwoData($competitionId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $compTerms = '';
    $successMsg = '';
    if (isset($competitionDetails))
    {
        $compTerms = $competitionDetails['terms'];
        $successMsg = $competitionDetails['success_message'];
    }
    $userFirstname = '';
    $userLastname = '';
    $userEmail = '';
    $userHomewharf = '';
    $userInstagramName = '';

    if (isset($userDetails))
    {
        $userFirstname = $userDetails['firstname'];
        $userLastname = $userDetails['lastname'];
        $userEmail = $userDetails['email'];
        $userHomewharf = $userDetails['home_wharf'];
        $userInstagramName = $userDetails['home_wharf'];
    }

    if (isset($instagramUsername) && strlen($instagramUsername) > 0)
    {
        $userInstagramName = $instagramUsername;
    }
?>
<section class="steps" id="step2">
    <?php
    if ($userEntered == 0)
    {
    ?>
    <?=$compIntroText?>
    <!--h3>Hello <?=$instagramUsername?>,</h3-->
    <p>We just need a few details from you to enter you into the competition.<br /><sup class="red">*</sup>Mandatory Fields.</p>
    <form id="frmCompetition" action="<?=$baseURL?>/includes/process-competition-entry.php" method="post" data-abide="ajax">
        <input type="hidden" id="competitionId" name="competitionId" value="<?=$competitionId?>" />

        <label for="txtInstagramUsername">Instagram Userame:<sup class="red">*</sup>
            <input type="text" name="txtInstagramUsername" id="txtInstagramUsername" value="<?=$userInstagramName?>" required />
            <small class="error">Please enter your Instagram username.</small>
        </label>

        <label for="txtFirstname">First Name:<sup class="red">*</sup>
            <input type="text" name="txtFirstname" id="txtFirstname" value="<?=$userFirstname?>" required />
            <small class="error">Please enter your first name.</small>
        </label>

        <label for="txtLastname">Surname:<sup class="red">*</sup>
            <input type="text" name="txtLastname" id="txtLastname" value="<?=$userLastname?>" required />
            <small class="error">Please enter your surname.</small>
        </label>

        <label for="txtEmail">Email Address:<!--sup class="red">*</sup-->
            <input type="email" name="txtEmail" id="txtEmail" value="<?=$userEmail?>" />
            <!--small class="error">Please enter your email address.</small-->
        </label>

        <!--label for="txtWharf">Your local wharf:
            <input type="text" name="txtWharf" id="txtWharf" value="<?=$userHomewharf?>" />
        </label-->

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
            var firstname, lastname, email, instagramUsername, competitionId;
            var subscribe = 0;
            competitionId = $('#competitionId').val();
            firstname = $('#txtFirstname').val();
            lastname = $('#txtLastname').val();
            email = $('#txtEmail').val();
            instagramUsername = $('#txtInstagramUsername').val();
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
                    instagramUsername: instagramUsername,
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
        <?php
        if (isset($competitionDetails))
        {
            $successMsg = $snip = str_replace(array("\n", "\t", "\r"), '', $successMsg);
        ?>

            html += '<?=addslashes($successMsg)?>';
        <?php
        }
        else
        {
        ?>
            html += '<h3>Thank you for entering.</h3>';
            html += '<p>Thanks for joining us in our quest to capture the essence of Sydney Harbour. Don\'t forget to tag your photos with #beyondthewharf and promote your images with our social sharing tools.</p>';
        <?php
        }
        ?>
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
        <?php
        if (isset($instagramData))
        {
        ?>
            getUsersRecentMedia($('#step2'));
        <?php
        }
        ?>
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

