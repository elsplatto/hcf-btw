<?php
date_default_timezone_set('Australia/NSW');
require 'site-settings.php';
require 'instagram.class.php';
require 'instagram.config.php';
include 'db.php';

$audit_trail = '';
$user_msg = '';

if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']))
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $wharf = $_POST['wharf'];
    $is_subscribed = $_POST['subscribe'];
    $date_subscribed = time();
    $date_registered = time();
    $competitionId = 1;

    if (isset($instagramData))
    {
        $instagramID = $instagramData->user->id;
    }
    else
    {
        $instagramID = '';
    }

    //echo 'Get is fine<br />';
    $audit_trail .= 'Received values.';
    //is user in member table?
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->query('SELECT id FROM user_members WHERE email = "'.$email.'" AND instagram_id = "'.$instagramID.'"');


    if ($stmt->num_rows > 0)
    {
        //echo 'Is a member<br />';
        $audit_trail .= 'User is a member.';
        //yes - user is member
        $stmt = $mysqli->prepare('SELECT id FROM user_members WHERE email = ? AND instagram_id = ?');
        $stmt->bind_param('ss',$email, $instagramID);
        $stmt->execute();
        $stmt->bind_result($member_id);
        while($stmt->fetch())
        {
            $id = $member_id;
        }
    }
    else
    {
        //echo 'Is not a member<br />';
        $audit_trail .= 'User is NOT a member.';
        //no - user is NOT member - insert user into member table
        if ($is_subscribed == 1)
        {
            $query = 'INSERT INTO user_members (firstname, lastname, email, home_wharf, instagram_id, date_registered, is_subscribed, date_subscribed) VALUES (?,?,?,?,?,?,?,?)';
        }
        else
        {
            $query = 'INSERT INTO user_members (firstname, lastname, email, home_wharf, instagram_id, date_registered) VALUES (?,?,?,?,?,?)';
        }
        $stmt = $mysqli->prepare($query);
        if ($is_subscribed == 1)
        {
            $stmt->bind_param('sssssiii', $firstname, $lastname, $email, $wharf, $instagramID, $date_registered, $is_subscribed, $date_subscribed);
        }
        else
        {
            $stmt->bind_param('sssssi', $firstname, $lastname, $email, $wharf, $instagramID, $date_registered);
        }
        $stmt->execute();
        //echo 'latest id: ['.$stmt->insert_id.']';
        $id = $stmt->insert_id;
    }

    //echo 'ID = ['.$id.']<br />';
    if ($id > 0)
    {
        //echo 'Finding out if member is entered...<br />';
        $audit_trail .= 'Finding out if member is entered...';
        //is member entered into this competition?
        $stmt = $mysqli->query('SELECT id FROM user_competition WHERE user_id = '.$id.' AND competition_id = '.$competitionId);
        if ($stmt->num_rows > 0)
        {
            $audit_trail .= 'User already entered - no entry made.';
        }
        else
        {
            $stmt = $mysqli->prepare('INSERT INTO user_competition (user_id, competition_id, date_entered) VALUES (?,?,?)');
            $stmt->bind_param('iii', $id, $competitionId, $date_registered);
            $stmt->execute();
            $audit_trail .= 'User not entered - entry made.';

            /*
            $msg = "First line of text\nSecond line of text";

            // use wordwrap() if lines are longer than 70 characters
                        $msg = wordwrap($msg,70);

            // send email
            mail("someone@example.com","My subject",$msg);*/

            if (isset($instagramData))
            {
                $instagramUsername = $instagramData->user->username;
            }
            else
            {
                $instagramUsername = 'Unknown';
            }

            $emailMsg = "Entrant Instagram Name: " . $instagramUsername . "\n";
            $emailMsg .= "Name: " . $firstname . ' ' . $lastname . "\n";
            $emailMsg .= "Email: " . $email;

            $headers = "From: webmaster@beyondthewharf.com.au";

            mail($adminEmailAddress,"Competition ".$competitionId." Entry",$emailMsg,$headers);

        }
    }
    $stmt->close();
    $mysqli->close();

    $json = '{"success": true, "msg": "Thank you for entering.", "developer_msg": "'.$audit_trail.'"}';
}
else
{
    if (empty($_POST['firstname']))
    {
        $audit_trail .= 'First name empty.';
    }
    else if (empty($_POST['lastname']))
    {
        $audit_trail .= 'Last name empty.';
    }
    else if (empty($_POST['email']))
    {
        $audit_trail .= 'Email empty.';
    }
    else
    {
        $audit_trail .= 'Not sure what went wrong.';
    }

    $user_msg = 'Something went wrong - try again soon.';

    $json = '{"success": false, "msg": '.$user_msg.', "developer_msg": "'.$audit_trail.'"}';
    //$json = '{"success": false}';
}

echo json_encode($json);
?>