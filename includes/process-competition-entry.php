<?php
date_default_timezone_set('Australia/NSW');
require 'site-settings.php';
require 'instagram.class.php';
require 'instagram.config.php';
include 'db.php';

$audit_trail = '';
$user_msg = '';

if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['instagramUsername']))
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $instagram_username = $_POST['instagramUsername'];
    $is_subscribed = $_POST['subscribe'];
    $date_subscribed = time();
    $date_registered = time();
    $competitionId = 1;
    if (!empty($_POST['competitionId']))
    {
        $competitionId = $_POST['competitionId'];
    }

    if (isset($instagramData))
    {
        $instagramID = $instagramData->user->id;
    }

    //echo 'Get is fine<br />';
    $audit_trail .= 'Received values.';
    //is user in member table?
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    if (isset($instagramData))
    {
        $audit_trail .= 'Received instagramID.';
        $stmt = $mysqli->query('SELECT id FROM user_members WHERE instagram_id = "'.$instagramID.'"');

        if ($stmt->num_rows > 0)
        {
            //echo 'Is a member<br />';
            $audit_trail .= 'User is a member.';
            //yes - user is member
            $stmt = $mysqli->prepare('SELECT id FROM user_members WHERE instagram_id = ?');
            $stmt->bind_param('s',$instagramID);
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
                $query = 'INSERT INTO user_members (firstname, lastname, email, instagram_username, instagram_id, date_registered, is_subscribed, date_subscribed) VALUES (?,?,?,?,?,?,?,?)';
            }
            else
            {
                $query = 'INSERT INTO user_members (firstname, lastname, email, instagram_username, instagram_id, date_registered) VALUES (?,?,?,?,?,?)';
            }
            $stmt = $mysqli->prepare($query);
            if ($is_subscribed == 1)
            {
                $stmt->bind_param('sssssiii', $firstname, $lastname, $email, $instagram_username, $instagramID, $date_registered, $is_subscribed, $date_subscribed);
            }
            else
            {
                $stmt->bind_param('sssssi', $firstname, $lastname, $email, $instagram_username, $instagramID, $date_registered);
            }
            $stmt->execute();
            //echo 'latest id: ['.$stmt->insert_id.']';
            $id = $stmt->insert_id;
        }
    }
    else
    {
        $audit_trail .= 'No instagramID.';
        if (isset($instagram_username))
        {
            $stmt = $mysqli->query('SELECT id FROM user_members WHERE instagram_username = "'.$instagram_username.'"');
        }

        if ($stmt->num_rows > 0)
        {
            //echo 'Is a member<br />';
            $audit_trail .= 'User is a member.';
            //yes - user is member
            $stmt = $mysqli->prepare('SELECT id FROM user_members WHERE instagram_username = ?');
            $stmt->bind_param('s',$instagram_username);
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
                $query = 'INSERT INTO user_members (firstname, lastname, email, instagram_username, date_registered, is_subscribed, date_subscribed) VALUES (?,?,?,?,?,?,?)';
            }
            else
            {
                $query = 'INSERT INTO user_members (firstname, lastname, email, instagram_username, date_registered) VALUES (?,?,?,?,?)';
            }
            $stmt = $mysqli->prepare($query);
            if ($is_subscribed == 1)
            {
                $stmt->bind_param('ssssiii', $firstname, $lastname, $email, $instagram_username, $date_registered, $is_subscribed, $date_subscribed);
            }
            else
            {
                $stmt->bind_param('ssssi', $firstname, $lastname, $email, $instagram_username, $date_registered);
            }
            $stmt->execute();
            //echo 'latest id: ['.$stmt->insert_id.']';
            $id = $stmt->insert_id;
        }
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
            else if (!isset($instagramData) && isset($instagram_username))
            {
                $instagramUsername = $instagram_username;
            }
            else
            {
                $instagramUsername = 'Unknown';
            }

            $emailMsg = "Entrant Instagram Name: " . $instagramUsername . "\n";
            $emailMsg .= "Name: " . $firstname . ' ' . $lastname . "\n";
            $emailMsg .= "Email: " . $email;

            $headers = "From: webmaster@beyondthewharf.com.au";

            mail($adminEmailAddress.",jason.taikato@tobiasandtobias.com","Competition ".$competitionId." Entry",$emailMsg,$headers);

        }
    }
    $stmt->close();
    $mysqli->close();

    $json = '{"success": true, "msg": "Thank you for entering.", "developer_msg": "'.$audit_trail.'"}';
}
else
{
    if (empty($_POST['instagramUsername']))
    {
        $audit_trail .= 'Instagram username empty.';
    }
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