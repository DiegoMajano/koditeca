<?php 

session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php"); // Redirigir al login si no está autenticado
    exit;
}

// Cargar la clase Usuario
require_once(__DIR__ . '/../../model/Usuario.php');

// Cargar el usuario actual desde la sesión
$usuarioId = $_SESSION['usuario_id'];
$usuarios = Usuario::cargarUsuarios(); // Asumiendo que tienes una función para cargar los usuarios desde JSON
$usuario = null;

foreach ($usuarios as $user) {
    if ($user['idUsuario'] === $usuarioId) {
        $usuario = new Usuario($user['nombre'], $user['idUsuario'], $user['usuario'], $user['clave'], $user['rol']);
        break;
    }
}

// Verificar si el usuario existe
if (!$usuario) {
    echo "Usuario no encontrado";
    exit;
}

// Obtener los libros prestados por el usuario
$librosPrestados = $usuario->getLibrosPrestados();

include_once '../header.php';
?>

<div class="container my-4">
    <h1 class="mb-4">Mis Libros Prestados</h1>

    <?php if (empty($librosPrestados)): ?>
        <p>No tienes libros prestados.</p>
    <?php else: ?>
        <ul class="list-group">
            <?php foreach ($librosPrestados as $libro): ?>
                <li class="list-group-item">
                    <strong><?php echo htmlspecialchars($libro['titulo']); ?></strong> - Autor: <?php echo htmlspecialchars($libro['autor']); ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

<?php include_once '../footer.php'; ?>
