<?php 
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php"); // Redirigir al login si no está autenticado
    exit;
}

// Cargar los usuarios usando la clase Usuario
require_once(__DIR__ .'/../../model/Usuario.php');
$usuarios = Usuario::cargarUsuarios(); // Obtener todos los usuarios

include_once '../header.php'; 
?>
<div class="container">
    <h1 class="my-4">Lista de Usuarios</h1>

    <!-- Tabla de usuarios -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>ID Usuario</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($usuarios as $usuario) {
                echo "<tr>
                        <td>" . htmlspecialchars($usuario['nombre']) . "</td>
                        <td>" . htmlspecialchars($usuario['idUsuario']) . "</td>
                        <td>" . htmlspecialchars($usuario['estado']) . "</td>
                        <td>
                            <a href='editarUsuario.php?id=" . htmlspecialchars($usuario['idUsuario']) . "' class='btn btn-warning btn-sm'>Editar</a>
                            <a href='../../app/controllers/adminController.php?action=eliminarUsuario&id=" . htmlspecialchars($usuario['idUsuario']) . "' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Seguro que deseas eliminar este usuario?\")'>Eliminar</a>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include_once '../footer.php'; ?>
