<?php
require '../login/database.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    // Si el usuario no está logueado, redirige al inicio de sesión
    header('Location: /phpAregntina/php_login/login/login.php');


    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['noticia_id'])) {
    $noticiaId = $_POST['noticia_id'];

    // Si el usuario tiene permiso, eliminar la noticia
    $query = $conn->prepare("DELETE FROM noticias WHERE id = :noticia_id");
    $query->bindParam(':noticia_id', $noticiaId);

    if ($query->execute()) {
        // La noticia se eliminó con éxito
        http_response_code(200); // Establece el código de respuesta HTTP a 200 (Éxito)
    } else {
        // Error al eliminar la noticia
        http_response_code(500); // Establece el código de respuesta HTTP a 500 (Error interno del servidor)
    }
} else {
    http_response_code(400); // Establece el código de respuesta HTTP a 400 (Solicitud incorrecta)
}
?>
