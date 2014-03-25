<?php
include '../includes/site-settings.php';
include '../includes/db.php';

?>
<div id="contributeStoryModal" class="white">
    <h3>Give us your story</h3>
    <form id="frmStory" method="post" action="<?=$baseURL?>/includes/insert-contribution.php" data-abide="ajax">
        <span><sup class="red">*</sup>Denotes mandatory fields</span><br /><br />
        <label for="txtFirstName">First Name:<sup class="red">*</sup>
            <input type="text" name="txtFirstName" id="txtFirstName" required />
            <small class="error">Please enter your first name.</small>
        </label>

        <label for="txtLastName">Last Name:<sup class="red">*</sup>
        <input type="text" name="txtLastName" id="txtLastName" required />
        <small class="error">Please enter your last name.</small>
        </label>

        <label for="txtEmail">Your Email Address:<sup class="red">*</sup><span>We will need to contact you to verify the story.</span>
        <input type="email" name="txtEmail" id="txtEmail" required />
        <small class="error">Please enter your email address.</small>
        </label>


        <label for="txtStory">Your Story:<sup class="red">*</sup>
        <textarea name="txtStory" id="txtStory" required></textarea>
        <small class="error">Please tell us your story.</small>
        </label>

        <input type="submit" id="btnSubmitStory" class="button" />&nbsp;&nbsp;&nbsp;<a href="#" class="reveal-close cancel">Cancel</a>

    </form>
</div>
<a class="close-reveal-modal reveal-close">Close this overlay</a>
<script src="<?=$baseURL?>/js/foundation/foundation.abide.js"></script>
<script>

$(function() {

    $('#frmStory').foundation('abide');



    $('#frmStory').submit(function(e) {
        e.preventDefault();
        if ($('[data-invalid]').length == 0)
        {
            var el = $(this);
            var url = $(this).attr('action');
            var firstname, lastname, email, story;
            firstname = $('#txtFirstName').val();
            lastname = $('#txtLastName').val();
            email = $('#txtEmail').val();
            story = $('#txtStory').val();

            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    firstname: firstname,
                    lastname: lastname,
                    email: email,
                    story: story
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
                    completePostHandler(data, el);
                }
            });
        }
    });

    function beforePostHandler(el)
    {
        el.hide();
        el.parent('div').append('<div id="postContributionLoader"></div>');
        var cl = new CanvasLoader('postContributionLoader');
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
        //console.log('success');
        console.dir(obj);

        $('#postContributionLoader').remove();
        el.parent('div').children('h3').text('Got it!');
        el.parent('div').append('<div><p>'+obj.msg+'</p></div>');
    }

    function errorPostHandler(data,el)
    {
        $('#postContributionLoader').remove();
        //var obj = JSON.parse(data);
        el.parent('div').children('h3').text('Oh-oh.');
        el.parent('div').append('<div><p>Something went wrong - please email <a href="mailto:admin@beyondthewharf.com.au">admin@beyondthewharf.com.au</a> with your story</p></div>');
    }

    function completePostHandler(data, el)
    {

    }


});
</script>
