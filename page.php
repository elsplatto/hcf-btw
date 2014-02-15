<?php
include 'includes/page-head.php';

if ($isLandingPage > 0)
{
    include 'template/landing-page.php';
}
else
{
    include 'template/article-page.php';
}
?>



<?php
include 'includes/analytics.php';
?>
</body>
</html>