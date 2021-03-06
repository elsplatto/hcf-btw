<?php
include 'includes/admin-settings.php';
include '../includes/db.php';
include 'includes/global-admin-functions.php';
assessLogin($securityArrAuthor);


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


$types = getTypes($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

$categories = getCategories($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);

$typesCount = count($types);
$categoriesCount = count($categories);
?>
<html>
<head>
    <title>Add User</title>
    <?php
    include 'includes/head.php';
    ?>
</head>
<body>
<section>
    <div class="row">
        <div class="large-12 columns">
            <a href="dashboard.php">Home</a>
            <h1>User</h1>
            <a href="user-list.php">< Back to User List</a>

        </div>
    </div>
</section>

<section>
    <form id="frmUser" name="frmUser" action="user-process.php" method="post" data-abide>
        <div class="row">
            <div class="large-12 columns">

                <label for="txtFirstname">First Name:
                    <input type="text" id="txtFirstname" name="txtFirstname" required />
                    <small class="error">Please enter users first name</small>
                </label>

                <label for="txtLastname">Last Name:
                    <input type="text" id="txtLastname" name="txtLastname" required />
                    <small class="error">Please enter users last name</small>
                </label>

                <label for="txtUsername">Username:
                    <span class="ajaxCheck"></span>
                    <input type="text" id="txtUsername" name="txtUsername" required />
                    <small class="error">Please enter a username</small>
                </label>


                <label for="selRole">Role:
                    <select id="selRole" name="selRole" required>
                        <option value="">Select role</option>
                        <option value="super">Super User</option>
                        <option value="publisher">Publisher</option>
                        <option value="author">Author</option>
                        <option value="restricted">Restricted</option>
                    </select>
                    <small class="error">Please select user's role</small>
                </label>


                <label for="txtEmail">Email:
                    <input type="email" id="txtEmail" name="txtEmail" required />
                    <small class="error">Please enter a valid email</small>
                </label>

                <label for="txtPassword">Password:
                    <input type="password" id="txtPassword" name="txtPassword" required pattern="password" />
                    <small class="error">Please enter a valid password</small>
                </label>


                <label for="txtConfirmPassword">Confirm Password:
                    <input type="password" id="txtConfirmPassword" name="txtConfirmPassword" required pattern="password" data-equalto="txtPassword" />
                    <small class="error">The passwords don't match</small>
                </label>

                <label for="chkValid">Valid:
                    <input type="checkbox" id="chkValid" name="chkValid" value="1" />
                </label>

                <input type="submit" value="Submit" class="button" />&nbsp;<a href="user-list.php" class="cancel">Cancel</a>
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
            var id = 0;
            var indicator = el.siblings('.ajaxCheck');
            if (username !== '')
            {
                indicator.css({
                    top: $(this).parent('label').height() / 2,
                    left: $(this).outerWidth() + 10
                });
                //indicator.text('checking...');

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
                        beforeUniqueCheckHandler(el);
                    },
                    success: function(data)
                    {
                        successUniqueCheckHandler(data, el, indicator)
                    }
                });
            }
            else
            {
                el.siblings('small').text('Please enter a username');
            }
        });

        function beforeUniqueCheckHandler(el) {
            el.siblings('.ajaxCheck').addClass('preloader');
        }

        function successUniqueCheckHandler(data,el,indicator)
        {
            var obj = JSON.parse(data);

            el.siblings('.ajaxCheck').removeClass('preloader');

            if (obj.success)
            {
                if (obj.unique)
                {
                    //indicator.text('unique');
                    el.siblings('.ajaxCheck').addClass('okay');
                    el.siblings('.ajaxCheck').removeClass('problem');
                    el.removeAttr('data-invalid');
                    el.parent('label').removeClass('error');
                    el.siblings('small').text('Please enter a username');
                }
                else
                {
                    //indicator.text('duplicate');
                    el.siblings('.ajaxCheck').addClass('problem');
                    el.siblings('.ajaxCheck').removeClass('okay');
                    el.attr('data-invalid','');
                    el.parent('label').addClass('error');
                    el.siblings('small').text('Your username is not unique');
                }
            }
        }
    });
</script>
</body>
</html>