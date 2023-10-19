<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT user_id, email, password FROM users WHERE user_id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();

    if ($records->rowCount() > 0) {

      $user = $records->fetch(PDO::FETCH_ASSOC);

  } else {
      $user = null;
  }
    
  }
?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to you WebApp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
  </head>
  <body>
    <?php require '../partials/header.php' ?>

    <?php if(!empty($user)): ?>
      <br> Welcome. <?= $user['email']; ?><br/>
      
      
      <a href="logout.php">Logout</a>

      
      <br>
      <br> <b>ADMINS</b> </br>
      <?php require '../admins/admins.php'?>
    <?php else: ?>
      
    <?php endif; ?>
  </body>
</html>
