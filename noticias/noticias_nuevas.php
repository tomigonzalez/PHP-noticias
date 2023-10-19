<?php
session_start();

require '../login/database.php';

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    // Si no ha iniciado sesión, redirige al usuario al inicio de sesión
    header("Location: /phpAregntina/php_login/login/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén el ID del usuario actualmente autenticado
    $user_id = $_SESSION['user_id'];

    // Recopila los detalles de la noticia desde el formulario
    $titulo = $_POST['titulo'];
    $fecha = date("Y-m-d H:i:s"); // Obtiene la fecha y hora actual
    $copete = $_POST['copete'];
    $cuerpo = $_POST['cuerpo'];
    $imagen_principal = $_POST['imagen_principal'];
    $galeria_imagenes = $_POST['galeria_imagenes'];

    // Inserta los datos en la tabla noticias
    $query = $conn->prepare("INSERT INTO noticias (user_id, titulo, fecha, copete, cuerpo, imagen_principal, galeria_imagenes) VALUES (:user_id, :titulo, :fecha, :copete, :cuerpo, :imagen_principal, :galeria_imagenes)");
    $query->bindParam(':user_id', $user_id);
    $query->bindParam(':titulo', $titulo);
    $query->bindParam(':fecha', $fecha);
    $query->bindParam(':copete', $copete);
    $query->bindParam(':cuerpo', $cuerpo);
    $query->bindParam(':imagen_principal', $imagen_principal);
    $query->bindParam(':galeria_imagenes', $galeria_imagenes);

    if ($query->execute()) {
        // La noticia se agregó con éxito, redirigir al usuario a la página de noticias
        header("Location: /phpAregntina/php_login/login/index.php");
        exit;
    } else {
        // Hubo un error al agregar la noticia, muestra un mensaje de error
        echo "Error al agregar la noticia.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Nueva Noticia</title>
</head>
<body>
<?php require 'back.php'?>
    <h1>Nueva Noticia</h1>
    <form action="noticias_nuevas.php" method="POST">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" required><br>

        <section class="positioninfo">
        <label for="copete">Copete:</label>
        <textarea name="copete" required class="custom-textarea"></textarea><br>
        </section>

        <section class="positioninfo">
        <label for="cuerpo">Cuerpo:</label>
        <textarea name="cuerpo" required class="custom-textarea"></textarea><br>
        </section>

        <label for="imagen_principal">Imagen Principal (URL):</label>
        <input type="text" name="imagen_principal" required><br>

        <input type="submit" value="Agregar Noticia">
    </form>
</body>
</html>
