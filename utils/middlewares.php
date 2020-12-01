<?php
$db = mysqli_connect("localhost", "root", "", "poster");

require(dirname(__FILE__) . '/../models/Model.php');
require(dirname(__FILE__) . '/../models/User.php');
require(dirname(__FILE__) . '/../models/Post.php');

User::$db = $db;
Post::$db = $db;

session_start();

if (!empty($_GET['logout']) && $_GET['logout'] === 'true') {
  session_destroy();
  return header("Location: /poster/");
}

$user = empty($_SESSION['user']) ? false : $_SESSION['user'];
if ($user) {
  $id = $user->getId();
  $inDatabase = User::findOne("id = $id");
  if (!$inDatabase) {
    $_SESSION['user'] = null;
  }
}
