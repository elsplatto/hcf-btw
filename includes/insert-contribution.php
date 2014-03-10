<?php
date_default_timezone_set('Australia/NSW');
include 'db.php';

if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['story']))
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $story = $_POST['story'];
    $created_date = time();

    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('INSERT INTO user_contributions (firstname, lastname, email, contribution, date_created) VALUES (?,?,?,?,?)');
    $stmt->bind_param('ssssi', $firstname, $lastname, $email, $story, $created_date);
    $stmt->execute();
    $stmt->close();
    $mysqli->close();

    $json = '{"success": true, "msg": "Thank you for submitting your story."}';
}
else
{
    $json = '{"success": false, "msg": "Something went wrong - please email <a href=\"mailto:admin@beyondthewharf.com.au\">admin@beyondthewharf.com.au</a> with your story"}';
}

echo json_encode($json);
?>