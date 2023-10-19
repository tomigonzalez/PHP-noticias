
<?php
    require '../login/database.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $query = $conn->prepare("INSERT INTO users (email, password) VALUES (:email, :password)");
        $query->bindParam(':email', $email);
        $query->bindParam(':password', $password);

        if ($query->execute()) {
            // El usuario se ha agregado exitosamente
            echo "Usuario agregado exitosamente.";
            header("Location: /phpAregntina/php_login/login/account.php");
        } else {
            // Hubo un error al agregar el usuario
            echo "Error al agregar el usuario.";
        }
    }
    ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Agregar Usuario</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php require 'back.php' ?>

    <h1>Add user</h1>
    
   

    <form action="" method="POST">
        <label for="email">Email:</label>
        <input type="text" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Agregar Usuario">
    </form>
</body>
</html>