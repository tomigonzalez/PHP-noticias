<?php
require '../login/database.php';

// Verifica si el usuario ha iniciado sesión
session_start();
if (!isset($_SESSION['user_id'])) {
    // Si no ha iniciado sesión redirige al usuario al inicio de sesión
    header("Location: /phpAregntina/php_login/login/login.php");
    exit;
}

// Recupera el ID de la noticia a editar desde la URL
if (isset($_GET['noticia_id']) && is_numeric($_GET['noticia_id'])) {
    $noticia_id = $_GET['noticia_id'];

    // Consulta la noticia que corresponde a ese ID
    $query = $conn->prepare("SELECT * FROM noticias WHERE id = :id");
    $query->bindParam(':id', $noticia_id);
    $query->execute();
    $noticia = $query->fetch(PDO::FETCH_ASSOC);

    if (!$noticia) {
        // Si no se encuentra la noticia, mostrar un mensaje de error o redirigir a una página de error.
        echo "No se encontró la noticia.";
        exit;
    }
} else {
    // Si no se proporcionó un ID válido, muestra un mensaje de error o redirige a una página de error.
    echo "ID de noticia no válido.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    $titulo = $_POST['titulo'];
    $copete = $_POST['copete'];
   
    
    // Realiza la actualización de la noticia en la base de datos
    $updateQuery = $conn->prepare("UPDATE noticias SET titulo = :titulo, copete = :copete WHERE id = :id");
    $updateQuery->bindParam(':titulo', $titulo);
    $updateQuery->bindParam(':copete', $copete);
    $updateQuery->bindParam(':id', $noticia_id);

    if ($updateQuery->execute()) {
        // redirigir al usuario a la página de noticias
        header("Location: /phpAregntina/php_login/login/index.php");
        exit;
    } else {
        // muestra un mensaje de error
        echo "Error al actualizar la noticia.";
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
    <title>Editar Noticia</title>
</head>

<body>
    <?php require 'back.php'?>
    <h1>Editar Noticia</h1>
    <form action="noticias_admin.php?noticia_id=<?php echo $noticia_id; ?>" method="POST">
        <label for="titulo">Título:</label>
        <input type="text" name="titulo" value="<?php echo $noticia['titulo']; ?>"><br>
        <section class="positioninfo">
        <label for="copete">Copete:</label>
        <textarea name="copete" class="custom-textarea"><?php echo $noticia['copete']; ?></textarea><br>
        </section>


        <input type="submit" value="Guardar Cambios">
    </form>
</body>

</html>