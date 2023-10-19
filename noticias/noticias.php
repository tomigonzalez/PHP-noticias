<?php
require '../login/database.php';

$query = $conn->prepare("SELECT noticias.*, users.email AS autor_email FROM noticias LEFT JOIN users ON noticias.user_id = users.user_id ORDER BY fecha DESC LIMIT 10");
$query->execute();
$noticias = $query->fetchAll(PDO::FETCH_ASSOC);
?>



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
    <section class="addcont">
        <div class="botonAdd tag-blue">
            <a href="../noticias/noticias_nuevas.php" >Agregar Noticia</a>
        </div>
</section>
<section class="noticias">
    

    
    <?php
    foreach ($noticias as $noticia) {
        // Imprime cada noticia
        // echo '<article>';
        // echo '<h2>' . $noticia['titulo'] . '</h2>';
        // echo '<p>' . $noticia['copete'] . '</p>';
        // echo '<p>Fecha: ' . $noticia['fecha'] . '</p>';
        // echo '<p>Autor: ' . ($noticia['user_id'] ? $noticia['autor_email'] . ' (ID: ' . $noticia['user_id'] . ')' : 'Anónimo') . '</p>';
    //     echo '</article>';

   
    echo'<div class="card">';
    echo '<div class="card__header">';
    echo  '<img src="' . $noticia['imagen_principal'] . '" alt="card__image" class="card__image" width="600" height="200">';
    echo '</div>';
    echo '<div class="card__body">';
    echo  '<span class="tag tag-blue">news</span>';
    echo  '<h4>'. $noticia['titulo'] .'</h4>';
    echo  '<p>' . $noticia['copete'] . '</p>';
    echo '</div>';
    echo '<div class="card__footer">';
    echo  '<div class="user">';
    echo    '<img src="https://avatars.mds.yandex.net/i?id=9b426810a7a3e64f3f29e6302272c7fca687d831-7755608-images-thumbs&n=13" alt="user__image" class="user__image">';
    echo    '<div class="user__info">' . ($noticia['user_id'] ? $noticia['autor_email'] . ' ' : 'Anónimo') . '</div>';
    echo  '</div>';
    echo '</div>';
    echo '<div class="position">';
    echo '<a href="/phpAregntina/php_login/noticias/noticias_admin.php?noticia_id=' . $noticia['id'] . '" class="botonesadmin tag-blue">Editar</a>';
    echo '<a href="#" class="eliminar-noticia botonesadmin tag-blue" data-noticia-id="' . $noticia['id'] . '">Eliminar</a>';
    echo '</div>';
    echo '</div>';

    // Imprime el

   }
    ?>
</section>
</body>
</html>


<script>
// Agrega un evento de clic a todos los elementos con la clase "eliminar-noticia"
const eliminarButtons = document.querySelectorAll('.eliminar-noticia');
eliminarButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        const noticiaId = this.getAttribute('data-noticia-id');
        // Verifica si el usuario está logueado
        const userLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
        if (!userLoggedIn) {
            // Redirige al usuario a la página de inicio de sesión
            window.location.href = '../login/login.php';
            return;
        }
        
        if (confirm('¿Estás seguro de que deseas eliminar esta noticia?')) {
            eliminarNoticia(noticiaId);
        }
    });
});

// Función para eliminar la noticia mediante Fetch
function eliminarNoticia(noticiaId) {
    // Realiza una solicitud Fetch para eliminar la noticia con noticiaId
    fetch('../noticias/eliminar_noticia.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'noticia_id=' + noticiaId,
    })
    .then(response => {
        if (response.ok) {
            // La noticia se eliminó con éxito
            alert('Noticia eliminada con éxito.');
            // Recarga la página para mostrar la lista actualizada de noticias
            location.reload();
        } else {
            // Error al eliminar la noticia
            alert('Error al eliminar la noticia.');
        }
    })
    .catch(error => {
        console.error('Error en la solicitud Fetch:', error);
    });
}

</script>
