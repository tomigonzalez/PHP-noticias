<?php

require '../login/database.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $admin_id = $_POST['id'];

    // Verificar si el administrador está tratando de eliminarse a sí mismo
    if ($admin_id == $_SESSION['user_id']) {
        echo json_encode(['message' => 'No puedes eliminarte a ti mismo.']);
    } else {
        // Comenzar una transacción para garantizar la consistencia de los datos
        $conn->beginTransaction();

        try {
            // Actualizar las noticias relacionadas para establecer user_id y autor en NULL
            $updateNewsQuery = $conn->prepare("UPDATE noticias SET user_id = NULL, autor = NULL WHERE user_id = :admin_id");
            $updateNewsQuery->bindParam(':admin_id', $admin_id);
            $updateNewsQuery->execute();

            // Eliminar el usuario de la tabla 'users'
            $deleteUserQuery = $conn->prepare("DELETE FROM users WHERE user_id = :admin_id");
            $deleteUserQuery->bindParam(':admin_id', $admin_id);
            $deleteUserQuery->execute();

            // Confirma la transacción
            $conn->commit();

            echo json_encode(['message' => 'El administrador ha sido eliminado con éxito.']);
        } catch (PDOException $e) {
            // En caso de error, deshacer la transacción y mostrar un mensaje de error
            $conn->rollback();
            echo json_encode(['message' => 'Error al eliminar el administrador: ' . $e->getMessage()]);
        }
    }
} else {
    echo "Solicitud no válida.";
}


?>
