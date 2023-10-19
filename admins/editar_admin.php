<?php
require '../login/database.php';

if (isset($_GET['user_id']) && is_numeric($_GET['user_id'])) {
    $admin_id = $_GET['user_id'];

    // Obtener los detalles del administrador para editar
    $query = $conn->prepare("SELECT * FROM users WHERE user_id = :id");
    $query->bindParam(':id', $admin_id);
    $query->execute();
    $admin = $query->fetch(PDO::FETCH_ASSOC);

    if (!$admin) {
        // Si no se encontró el administrador muestra un mensaje de error o redirige a una página de error.
        echo "No se encontró el administrador.";
        exit;
    }
} else {
    // Si no se proporcionó un ID válido, muestra un mensaje de error o redirige a una página de error.
    echo "ID de administrador no válido.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    
    $email = $_POST['email'];
    $contrasena = $_POST['password'];

    $contrasena = password_hash($_POST['password'], PASSWORD_DEFAULT);


    // Actualizar el registro del administrador en la base de datos
    $query = $conn->prepare("UPDATE users SET  email = :email, password = :contrasena WHERE user_id = :id");

    $query->bindParam(':email', $email);
    $query->bindParam(':contrasena', $contrasena);
    $query->bindParam(':id', $admin_id);
    $query->execute();

    // Redirige a la página de administración después de editar
    header("Location: ../login/account.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar Administrador</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php require 'back.php'?>

    <h1>Edit Administrators</h1>
    
    <form action="editar_admin.php?user_id=<?php echo $admin_id; ?>" method="POST">

        <label for="email">New email:</label>
        <input type="text" name="email" value="<?php echo $admin['email']; ?>"><br>

        <label for="password">New password:</label>
        <input type="password" name="password" value=""><br>

        <input type="submit" value="Save">
    </form>
</body>
</html>
