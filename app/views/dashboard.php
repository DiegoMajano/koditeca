<?php 

session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php"); // Redirigir al login si no está autenticado
    exit;
}

// Obtener el rol del usuario desde la sesión
$rol = $_SESSION['usuario_rol'];

include_once 'header.php'; 

?>

<div class="container mt-4">
    <h1 class="text-center">Opciones</h1>

    <?php if ($rol === 'admin'): ?>
        <div class="card">
            <div class="card-header">
                <h2>Panel de Administrador</h2>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="./admin/verUsuarios.php" class="btn btn-primary btn-sm">Ver usuarios</a></li>
                <li class="list-group-item"><a href="./admin/agregarLibro.php" class="btn btn-success btn-sm">Agregar libro</a></li>
                <li class="list-group-item"><a href="./admin/verLibros.php" class="btn btn-info btn-sm">Ver Libros</a></li>
            </ul>
        </div>
    <?php else: ?>
        <div class="card">
            <div class="card-header">
                <h2>Panel de Usuario</h2>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="./user/buscarLibro.php" class="btn btn-primary btn-sm">Buscar libros</a></li>
                <li class="list-group-item"><a href="./user/librosPrestados.php" class="btn btn-warning btn-sm">Mis libros prestados</a></li>
                <li class="list-group-item"><a href="./user/multas.php" class="btn btn-danger btn-sm">Mis multas</a></li>
            </ul>
        </div>
    <?php endif; ?>

</div>

<?php include_once 'footer.php'; ?>
