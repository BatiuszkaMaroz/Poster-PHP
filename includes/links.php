<li><a href='/poster/'>Home</a></li>
<?php
if (!empty($_SESSION['user'])) {
  echo "
  <li>
    <a href='/poster/pages/create/'>
      Create Post
    </a>
  </li>
  <li>
    <form action='/poster/'>
      <a class='waves-effect waves-light btn' href='/poster?logout=true'>
      Logout
      </a>
    </form>
  </li>
  ";
} else {
  echo "
  <li>
    <a class='waves-effect waves-light btn' href='/poster/pages/auth/'>
      Auth
    </a>
  </li>
  ";
}
?>