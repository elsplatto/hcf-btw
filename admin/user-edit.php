<?php
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin(['super','publisher','author']);

if (isset($_GET['id']))
{
    $userId = $_GET['id'];
}
else
{
    header('Location: user-list.php');
}

function getTypes($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT id, title FROM types WHERE is_valid = 1');
    $stmt->execute();
    $stmt->bind_result($id, $title);

    $results = array();
    $i = 0;
    while($stmt->fetch())
    {
        $results[$i]['id'] = $id;
        $results[$i]['title'] = $title;
        $i++;
    }

    $stmt->close();
    $mysqli->close();
    return $results;
}

function getCategories($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT c.id, c.title, c.type_id, t.title AS type_title FROM categories c, types t WHERE c.is_valid = 1 AND t.id = c.type_id ORDER BY c.type_id');
    $stmt->execute();
    $stmt->bind_result($id, $title, $type_id, $type_title);

    $results = array();
    $i = 0;
    while($stmt->fetch())
    {
        $results[$i]['id'] = $id;
        $results[$i]['title'] = $title;
        $results[$i]['type_id'] = $type_id;
        $results[$i]['type_title'] = $type_title;
        $i++;
    }

    $stmt->close();
    $mysqli->close();
    return $results;
}

function getUserDetails($id, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE)
{
    $mysqli = new mysqli($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
    $stmt = $mysqli->prepare('SELECT firstname, lastname, username, password, role, email, is_valid FROM admin_users WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($firstname, $lastname, $username, $password, $role, $email, $is_valid);

    $results = array();
    while($stmt->fetch())
    {
        $results['firstname'] = $firstname;
        $results['lastname'] = $lastname;
        $results['username'] = $username;
        $results['password'] = $password;
        $results['role'] = $role;
        $results['email'] = $email;
        $results['is_valid'] = $is_valid;
    }

    $stmt->close();
    $mysqli->close();
    return $results;
}


$types = getTypes($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

$categories = getCategories($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

$userDetails = getUserDetails($userId, $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

$typesCount = count($types);
$categoriesCount = count($categories);
?>
<html>
<head>
    <title>Edit User - <?=$userDetails['firstname'] . ' '. $userDetails['lastname'] ?></title>
    <?php
    include 'includes/head.php';
    ?>
</head>
<body>
<section>
    <div class="row">
        <div class="large-12 columns">
            <a href="dashboard.php">Dashboard</a>
            <h1>User</h1>
            <a href="user-list.php">< Back to User List</a>

        </div>
    </div>
</section>

<section>
    <form id="frmUser" name="frmUser" action="user-process.php" method="post" data-abide>
        <div class="row">
            <div class="large-12 columns">
                <input type="hidden" id="userId" name="userId" value="<?=$userId?>" />
                <label for="txtFirstname">First Name:
                    <input type="text" id="txtFirstname" name="txtFirstname" value="<?=$userDetails['firstname']?>" required />
                </label>
                <small class="error">Please enter users first name</small>



                <label for="txtLastname">Last Name:
                    <input type="text" id="txtLastname" name="txtLastname" value="<?=$userDetails['lastname']?>" required />
                </label>
                <small class="error">Please enter users last name</small>

                <!--TODO: Check to make sure username is unique-->

                <label for="txtUsername">Username:
                    <input type="text" id="txtUsername" name="txtUsername" value="<?=$userDetails['username']?>" required />
                    <span class="ajaxCheck"></span>
                </label>
                <small class="error">Please enter a username</small>


                <label for="selRole">Role:
                    <select id="selRole" name="selRole" required>
                        <option value="">Select role</option>
                        <option value="super" <?=strtolower($userDetails['role']) == 'super' ? 'selected="selected"' : '' ?>>Super User</option>
                        <option value="publisher" <?=strtolower($userDetails['role']) == 'publisher' ? 'selected="selected"' : '' ?>>Publisher</option>
                        <option value="author" <?=strtolower($userDetails['role']) == 'author' ? 'selected="selected"' : "" ?>>Author</option>
                        <option value="restricted" <?=strtolower($userDetails['role']) == 'restricted' ? 'selected="selected"' : '' ?>>Restricted</option>
                    </select>
                </label>
                <small class="error">Please select user's role</small>


                <label for="txtEmail">Email:
                    <input type="email" id="txtEmail" name="txtEmail" value="<?=$userDetails['email']?>" required />
                </label>
                <small class="error">Please enter a valid email</small>

                <label for="chkValid">Valid:</label>
                <input type="checkbox" id="chkValid" name="chkValid" value="1" <?=$userDetails['is_valid'] == 1 ? 'checked="checked"' : '' ?>/>

                <input class="button" type="submit" value="Submit" />
            </div>
        </div>
    </form>
</section>

<?php
include 'includes/footer.php';
?>
<script src="../js/foundation/foundation.abide.js"></script>
<script>
$('#frmUser').foundation('abide');

$(function() {
    $('#txtUsername').blur(function(e)
    {
        var el = $(this);
        var username = el.val();
        var id = $('#userId').val();
        var indicator = el.next('.ajaxCheck');
        if (username !== '')
        {
            indicator.css({
                top: $(this).parent('label').height() / 2,
                left: $(this).outerWidth() + 10
            });
            indicator.text('checking...');

            $.ajax({
                type: 'POST',
                url: 'services/unique-username.php',
                dataType: 'json',
                data: {
                    username: username,
                    postedId: id
                },
                beforeSend: function()
                {
                    //beforeLikeSendHandler(el);
                },
                success: function(data)
                {
                    successUniqueCheckHandler(data, el, indicator)
                }
            });
        }
   });

    function successUniqueCheckHandler(data,el,indicator)
    {
        var obj = JSON.parse(data);
        console.dir(obj);

        if (obj.success)
        {
            if (obj.unique)
            {
                indicator.text('unique');
                el.removeAttr('data-invalid');
            }
            else
            {
                indicator.text('duplicate');
                el.attr('data-invalid','');
            }
        }
    }
});
</script>
</body>
</html>