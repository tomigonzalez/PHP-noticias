<?php
  session_start();

  session_unset();

  session_destroy();

  header('Location: /phpAregntina/php_login/login/login.php');

?>
