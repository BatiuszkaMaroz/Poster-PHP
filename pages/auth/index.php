<!DOCTYPE html>
<html lang="en">

<?php
$title = "Poster - Auth";
require('../../includes/head.php');
?>

<body>
  <?php
  require("../../utils/middlewares.php");
  require('../../includes/nav.php');

  $errors = [];
  $username = empty($_POST['username']) ? false : $_POST['username'];
  $password = empty($_POST['password']) ? false : $_POST['password'];
  $mode = empty($_POST['mode']) ? "login" : $_POST['mode'];

  if ($mode === "login") {
    $altMode = "signup";
  } else {
    $altMode = 'login';
  }

  if (!$db) {
    $errors[] = 'Database Connection Error';
    goto end;
  }

  if (!$username || !$password) {
    goto end;
  }

  if ($mode === "login") {
    $user = User::findOne("username = '$username'");

    if (!$user) {
      $errors[] = 'User Not Found';
      goto end;
    }

    if ($user->verifyPassword($password)) {
      $_SESSION['user'] = $user;
      header("Location: /poster/");
    } else {
      $errors[] = 'Invalid Password';
    }
  } else if ($mode === 'signup') {
    $user = User::insert($username, $password);
    if ($user) {
      $_SESSION['user'] = $user;
      header("Location: /poster/");
    } else {
      $errors[] = 'User Creation Error';
    }
  }

  end:
  ?>

  <div class="container center">
    <h4 class="teal-text">Authentication - <?php echo ucwords($mode); ?></h4>
    <div class="row">
      <form class="col s12" action="/poster/pages/auth/" method="POST">
        <input type="hidden" name="mode" value="<?php echo "$mode"; ?>">
        <div class="row">
          <div class="input-field col s12 m8 l6 xl4 offset-m2 offset-l3 offset-xl4">
            <input required name="username" id="username" type="text" class="validate">
            <label for="username">Username</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12 m8 l6 xl4 offset-m2 offset-l3 offset-xl4">
            <input required name="password" id="password" type="password" class="validate">
            <label for="password">Password</label>
          </div>
        </div>
        <button class="waves-effect waves-light btn">Submit</button>
      </form>
    </div>
    <div class="row">
      <form class="col s12" action="/poster/pages/auth/" method="POST">
        <input type="hidden" name="mode" value="<?php echo "$altMode"; ?>">
        <button class="waves-effect waves-light btn">Change To <?php echo "$altMode"; ?></button>
      </form>
    </div>

    <?php
    function renderChip($content) {
      echo "
      <div class='chip'>
        $content
      </div>
    ";
    }

    foreach ($errors as $error) {
      renderChip($error);
    }
    ?>
  </div>

</body>

</html>