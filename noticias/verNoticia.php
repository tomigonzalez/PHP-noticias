
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Document</title>
</head>
<body>

<?php require 'back.php'?>

<div class="continfonoticia">
    <div class="infonoticia">
<?php
require '../login/database.php';

if (isset($_GET['id'])) {
    $noticiaId = $_GET['id'];

    $query = $conn->prepare("SELECT noticias.*, users.email AS autor_email FROM noticias LEFT JOIN users ON noticias.user_id = users.user_id WHERE noticias.id = :noticia_id");
    $query->bindParam(':noticia_id', $noticiaId);
    $query->execute();
    $noticia = $query->fetch(PDO::FETCH_ASSOC);

    if ($noticia) {
        
        echo '<div class="noticiastyle">';
        echo '<h1>' . $noticia['titulo'] . '</h1>';
        echo '<div class="cuerpostyle">';
        echo '<p>' . $noticia['cuerpo'] . '</p>';
        echo '</div>';
        echo '<p>Autor: ' . ($noticia['user_id'] ? $noticia['autor_email'] : 'Anónimo') . '</p>';
        echo '</div>';
    } else {
        echo 'Noticia no encontrada';
    }
} else {
    echo 'ID de noticia no proporcionado';
}
?>
</div>
</div>
<footer>
      <div class="footerdiv">
        <a href="https://portafoliov3-tan.vercel.app/" target="_blank">TMGC</a><p>© Todos los derechos reservados.</p>
      </div>
    </footer>
</body>

</html>

