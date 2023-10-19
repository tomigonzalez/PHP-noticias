<?php session_start();?>

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

   
    <?php require '../noticias/noticias.php'?>
    <footer>
      <div class="footerdiv">
        <a href="https://portafoliov3-tan.vercel.app/" target="_blank">TMGC</a><p>© Todos los derechos reservados.</p>
      </div>
    </footer>
  </body>
</html>
