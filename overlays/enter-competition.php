<?php
include '../includes/site-settings.php';
include '../includes/db.php';
include '../includes/Mobile_Detect.php';
include '../includes/global-functions.php';
require '../includes/instagram.class.php';
require '../includes/instagram.config.php';

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
?>

<div class="brandedBanner grey"><span></span></div>
<div id="competitionModal" class="paddingTop60 white">



<?php

if ($step == 1)
{
?>
<section class="steps">


    <h3 class="block marginBottom20">SHARE YOUR EXPERIENCE OF SYDNEY HARBOUR OR PARRAMATTA RIVER BEFORE THE END OF JUNE ON INSTAGRAM &amp; WIN AN AMAZING SIGNED ARTWORK FROM ACCLAIMED PHOTOGRAPHER JOEL COLEMAN VALUED AT $700.</h3>

    <h3 class="block marginBottom20">HOW TO WIN.</h3>


    <a href="<?=$instagramLoginURL?>" class="button instagram">Log into Instagram &amp; Enter</a>

    <ul class="arrowed show-hide">
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
                <p>If you don’t already have an Instagram account, <a href="http://instagram.com" target="_blank" rel="nofollow">download the free app now</a>.</p>
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
    </ul>

    <a href="<?=$instagramLoginURL?>" class="button instagram">Log into Instagram &amp; Enter</a>
</section>
<?php
}
else if ($step == 2)
{
?>
<section class="steps" id="step2">
    <?php
    if ($userEntered == 0)
    {
    ?>
    <h3>Hello <?=$instagramUsername?>,</h3>
    <p>We just need a few details from you to enter you into the competition.<br /><sup class="red">*</sup>Mandatory Fields.</p>
    <form id="frmCompetition" action="<?=$baseURL?>/includes/process-competition-entry.php" method="post" data-abide="ajax">
        <label for="txtFirstname">First Name:<sup class="red">*</sup>
            <input type="text" name="txtFirstname" id="txtFirstname" value="<?=$userDetails['firstname']?>" required />
            <small class="error">Please enter your first name.</small>
        </label>

        <label for="txtLastname">Surame:<sup class="red">*</sup>
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
        <h3>Beyondthewharf Promotion Terms and Conditions</h3>

        <ol>
            <li>Information on how to enter and prizes form part of these Terms and Conditions. Participation in this promotion is deemed acceptance of these Terms and Conditions.</li>
            <li>Employees (and their immediate families) of the Promoter and agencies associated with this promotion are ineligible to enter. Immediate family means any
                of the following: spouse, ex-spouse, de-facto spouse, child or step-child (whether natural or by adoption), parent, step-parent, grandparent,
                step-grandparent, uncle, aunt, niece, nephew, brother, sister, step-brother, step-sister or 1st cousin.</li>
            <li>Promotion commences at 9:00 am on20/03/2014 and closes at 11:59pm on 20/6/2014, unless extended in the absolute discretion of the Promoter (“Promotional
                Period”). The Promoter reserves the right to extend the Promotional Period until 11.59pm on 20/7/2014. All times throughout the terms and conditions will
                be based on Sydney local time, which will be either AEDST or AEST, depending upon the date.</li>
            <li>To enter, the entrant must first create an image that includes something on or something to do around Sydney harbour.</li>
            <li>To enter, the entrant must complete the following steps:
                <ol style="list-style: lower-alpha;">
                    <li>visit the Website;</li>
                    <li>follow the prompts and register by completing all requested details including, name, and email address</li>
                    <li>Upload a photograph by simply tagging their photo #beyondthewharf;</li>
                    <li>Read and accept the terms and conditions; and</li>
                    <li>Submit their entry.</li>
                </ol>
            </li>
            <li>The Entrants and Content
                <ol style="list-style: lower-alpha;">
                    <li>When an entrant submits any materials via the Promotion including photographs and images (“Content”), the entrant, unless the Promoter advises
                        otherwise, licenses and grants the Promoter, its affiliates and sub-licensees a non-exclusive, royalty-free, perpetual, worldwide, irrevocable, and
                        sub-licensable right to use, reproduce, modify, adapt, publish and display such Content for any purpose in any media, without compensation, restriction on
                        use, or attribution. The entrant agrees not to assert any moral rights in relation to such use. The entrant warrants that they have the full authority to
                        grant these rights.</li>
                    <li>The entrant acknowledges that that the Promoter may use photos or images submitted, or part thereof, in a film recording produced by the Promoter or its
                        affiliates and sub-licensees, and this may appear in any media, without compensation, restriction on use, or attribution.</li>
                    <li>The entrant agrees that they are fully responsible for the Content they submit. The Promoter shall not be liable in any way for such Content to the full
                        extent permitted by law. The Promoter may remove any Content it may display in any media without notice for any reason whatsoever.</li>
                    <li>Entrants warrant and promise that any entries submitted are the sole and original creation of the entrant and have not been copied in whole or in part
                        from any other work.</li>
                    <li>Entries must not advertise or promote third parties' or your own goods or services. Entries must not use third party artistic works, copyrights,
                        trademarks, trade names, logos, similar brand identifying marks, trade secrets or other proprietary rights.</li>
                    <li>Entries must not refer to drinking alcohol or people who are, or appear to be, under the legal drinking age in Australia. Entries must not suggest the
                        Promoter's products or alcohol in general make you more confident, popular or attractive or that it is acceptable, glamorous or generally positive to be
                        intoxicated.</li>
                    <li>Entries must not (1) depict or refer to people conducting themselves in an inappropriate manner, (2) contain any material that would degrade or demean
                        the human form, image or status of women, men or the members of any group based on race, religion, ethnic background, sexual orientation or any other
                        minority status, (3) be offensive towards anyone, or (4) refer any other participant in the promotion.</li>
                    <li>Entries should not show, imply, encourage or refer to aggression or unruly, irresponsible or anti-social, obscene, provocative, sexually overt, lewd or
                        otherwise objectionable content or entries which reflect poorly on the brands of the Promoter and its affiliates will not be considered.</li>
                    <li>Determination of the appropriateness and acceptance of any entry is at the sole discretion of the Promoter, including as a result of breaching of Terms
                        and Conditions herein.</li>
                    <li>Entrants warrant and agree that they will comply with all applicable laws and regulations, including without limitation, those governing copyright,
                        content, defamation, privacy, publicity and the access or use of others' computer or communication systems. Without limiting any other terms herein, the
                        entrant agrees to indemnify the Promoter against any claim that arises as a result of the entrant breaching of these Terms and Conditions.</li>
                </ol>
            </li>
            <li>The Promoter reserves the right, at any time, to verify the validity of entries and entrants (including an entrant's identity, age and place of
                residence) and to disqualify any entrant who submits an entry that is not in accordance with these Terms and Conditions or who tampers with the entry
                process. Errors and omissions will be accepted at the Promoter's discretion. Failure by the Promoter to enforce any of its rights at any stage does not
                constitute a waiver of those rights.</li>
            <li>Incomplete, indecipherable, or illegible entries will be deemed invalid. Multiple entries accepted, subject to: (a) limit fifteen entries per person per
                day based on Sydney Local time; (b) each entry must be submitted separately and in accordance with the terms and conditions; and (c) each entry must be
                substantially unique (i.e. must contain a substantially unique image).</li>
            <li>If there is a dispute as to the identity of an entrant, the Promoter reserves the right, in its sole discretion, to determine the identity of the
                entrant.</li>
            <li>This is a game of skill and chance plays no part in determining the winners. Each entry will be individually judged based on creative merit of the
                photo. The Promoter's decision is final and no correspondence will be entered into. Winners will be notified by email or via our website. The Promoter
                reserves the right to select reserves based on merit and use them in the event the original individuals selected to win a prize are deemed ineligible or do
                not claim their prize by the required time.</li>
            <li>The winners must claim their prize, in accordance with the instructions provided, within 28 days of the date the email notification is sent by
                Promoter, otherwise their right to the prize will be forfeited, and the Promoter, in its absolute discretion, reserves the right to award the unclaimed
                prize to another entrant, but is under no obligation to do so.</li>
            <li>The best valid entry in each Round that has been entered will win a signed poster by acclaimed photographer Joel Coleman. That will be posted to the
                winner.</li>
            <li>If for any reason a winner does not take a prize by the time stipulated by these Terms and Conditions then the winner will be deemed to have forfeited
                such prize and no compensation will be payable by the Promoter</li>
            <li>Prizes are not transferable or exchangeable and cannot be taken as cash, unless otherwise specified.</li>
            <li>Entrants consent to the Promoter using the entrant's name, likeness, image and/or voice in the event they are a winner (including photograph, film
                and/or recording of the same) in any media for an unlimited period without remuneration for the purpose of promoting this competition (including any
                outcome), and promoting any products manufactured, distributed and/or supplied by the Promoter.</li>
            <li>If this promotion is interfered with in any way or is not capable of being conducted as reasonably anticipated due to any reason beyond the reasonable
                control of the Promoter, including but not limited to technical difficulties, unauthorised intervention or fraud, the Promoter reserves the right, in its
                sole discretion, to the fullest extent permitted by law (a) to disqualify any entrant; or (b) to modify, suspend, terminate or cancel the promotion, as
                appropriate.</li>
            <li>Any cost associated with accessing the Website is the entrant's responsibility and is dependent on the Internet service provider used. The use of any
                automated entry software or any other mechanical or electronic means that allows an entrant to automatically enter repeatedly is prohibited and will render
                all entries submitted by that entrant invalid.</li>
            <li>Nothing in these Terms and Conditions limit, exclude or modify or purports to limit, exclude or modify the statutory consumer guarantees as provided
                under the Competition and Consumer Act, as well as any other implied warranties under similar consumer protection laws in the State and Territories of
                Australia (“Non-Excludable Guarantees”). Except for any liability that cannot by law be excluded, including the Non-Excludable Guarantees, the Promoter and
                its advertising agency (including their respective officers, employees and agents) exclude all liability (including negligence), for any personal injury;
                or any loss or damage (including loss of opportunity); whether direct, indirect, special or consequential, arising in any way out of the promotion.</li>
            <li>Except for any liability that cannot by law be excluded, including the Non- Excludable Guarantees, the Promoter and its advertising agency (including
                their respective officers, employees and agents) are not responsible for and exclude all liability (including negligence), for any personal injury; or any
                loss or damage (including loss of opportunity); whether direct, indirect, special or consequential, arising in any way out of: (a) any technical
                difficulties or equipment malfunction (whether or not under the Promoter's control); (b) any theft, unauthorised access or third party interference; (c)
                any entry or prize that is late, lost, altered, damaged or misdirected (whether or not after their receipt by the Promoter) due to any reason beyond the
                reasonable control of the Promoter; (d) any variation in prize value to that stated in these Terms and Conditions; (e) any tax liability incurred by a
                winner or entrant; or (g) use of a prize.</li>
            <li>All entries become the property of the Promoter. The Promoter collects entrants' personal information to enable you to participate in this promotion.
                To facilitate your participation, the Promoter may disclose your personal information to companies it has engaged to assist it in conducting the promotion.
                If you do not provide your personal information, the Promoter will not be able to enter you into this promotion. The Promoter may, for an indefinite
                period, unless otherwise advised, use the information for promotional, marketing, publicity, research and profiling purposes, including sending electronic
                messages or telephoning the entrant. A request to access, update or correct any information should be directed to the Promoter at
                <a href="mailto:privacy@harbourcityferries.com.au">privacy@harbourcityferries.com.au</a>.</li>
            <li>The Promoter is Harbour City Ferries Pty Ltd of Level 19, 9 Hunter Street, Sydney NSW 2000.</li>
        </ol>




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
                var el = $(this);
                var url = $(this).attr('action');
                var firstname, lastname, email, wharf;
                var subscribe = 0;
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
                        subscribe: subscribe
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
            var html = '<h3>Thank you for entering.</h3>';
            html += '<p>Thanks for joining us in our quest to capture the essence of Sydney Harbour. Don\'t forget to tag your photos with #beyondthewharf and promote your images with our social sharing tools.</p>';

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


                    loadHTML += '<a href="https://twitter.com/share?url=<?=$baseURL?>/gallery/'+dataObj[i].id+'&text=Check this photo out&hashtag=beyondthewharf&count=none" class="twitter-share-button gallery-tweet" data-lang="en">Tweet</a>';
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

