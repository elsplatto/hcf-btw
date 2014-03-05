<?php
include '../includes/db.php';
include '../includes/Mobile_Detect.php';

$device = new Mobile_Detect;
?>
<div id="contributeStoryModal" class="white">
    <h3>Give us your story</h3>
    <form id="frmStory">
        <label for="txtName">First Name:</label>
        <input type="text" id="txtFirstName" />


        <label for="txtName">Last Name:</label>
        <input type="text" id="txtLastName" />

        <label for="txtEmail">Your Email Address:</label><span>We will need to contact you to verify the story.</span>
        <input type="email" id="txtEmail" />


        <label for="txtStory">Your Story:</label>
        <textarea id="txtStory"></textarea>

        <input type="submit" class="button" />&nbsp;&nbsp;&nbsp;<a href="#" class="reveal-close">Cancel</a>

    </form>
</div>
<a class="close-reveal-modal reveal-close">Close this overlay</a>
