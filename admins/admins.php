<?php
require '../login/database.php';

// Consulta para seleccionar administradores
$query = $conn->prepare("SELECT * FROM users ");
$query->execute();
$administradores = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<table>
    <tr>
        <th>Email</th>
        <th>Password</th>
        <th>Acciones</th>
        <!-- Agregar más columnas según sea necesario -->
    </tr>
    <?php foreach ($administradores as $admin) : ?>
        <tr>
            <td><?php echo $admin['email']; ?></td>
            <td class="password-column"><?php echo $admin['password']; ?></td>
            <td>
    <a href="../admins/editar_admin.php?user_id=<?php echo $admin['user_id']; ?>">Editar</a>
   
    <button onclick="eliminarAdministrador(<?php echo $admin['user_id']; ?>)">Eliminar</button>
</td>

        </tr>

    <?php endforeach; ?>
</table>
<br></br>

<a href="../admins/agregar_admin.php">Add Admin</a>


<script>
    function eliminarAdministrador(id) {
        
        if (confirm('¿Estás seguro de que deseas eliminar a este administrador?')) {
            // Si el usuario confirma realiza la solicitud AJAX para eliminar al administrador
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../admins/eliminar_admin.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Maneja la respuesta del servidor
                    const response = JSON.parse(xhr.responseText);
                    alert(response.message);
                    
                    // Recarga la página para reflejar los cambios
                    location.reload();
                }
            };
            xhr.send('id=' + id);
        }
    }
</script>