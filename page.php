<?php
include 'includes/page-head.php';

//$page_id = $_GET['id'];
//echo $page_id
//echo 'here';
//echo $_SERVER['REQUEST_URI'];
//echo substr($_SERVER['REQUEST_URI'],)

if ($isLandingPage > 0)
{
    include 'template/landing-page.php';
}

?>



<?php
include 'includes/analytics.php';
?>
</body>
</html>