<!DOCTYPE html>
<html lang="en">

<?php
$title = "Poster - Home";
require('./includes/head.php');
?>

<body>
  <?php
  require('./utils/middlewares.php');
  require('./includes/nav.php');

  if (!empty($_SESSION['user'])) {
    require('./pages/home/index.php');
  } else {
    require('./pages/home/unauth.php');
  }
  ?>
</body>

</html>