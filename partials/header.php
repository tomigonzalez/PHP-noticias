


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

<header>
  <a href="index.php">Your App Name</a>
  <a href="index.php">Inicio</a>
  <?php
    
    if (isset($_SESSION['user_id'])) {
      // Si el usuario ha iniciado sesión, redirige a la página de inicio de la cuenta
      echo '<a href="account.php">My account</a>';
    } else {
      // Si el usuario no ha iniciado sesión, muestra el enlace de inicio de sesión
      echo '<a href="login.php">Login</a>';
    }
    ?>
  
</header>

</body>
</html>