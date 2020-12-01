<?php
$user = empty($_SESSION['user']) ? false : $_SESSION['user'];

if (!$user) {
  return header("Location: /poster/pages/auth/");
}
