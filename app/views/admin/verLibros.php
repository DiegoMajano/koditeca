<?php 
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php"); // Redirigir al login si no está autenticado
    exit;
}

$rol = $_SESSION["usuario_rol"];

include_once '../header.php';

// Cargar los libros usando la clase Libro
require_once(__DIR__ .'/../../model/Libro.php');
$libros = Libro::cargarLibros(); // Obtener todos los libros

// Buscar libros por título si se especifica en el formulario
$tituloBuscado = isset($_GET['titulo']) ? $_GET['titulo'] : ''; 

if ($tituloBuscado) {
    $resultados = array_filter($libros, function($libro) use ($tituloBuscado) {
        return stripos($libro['titulo'], $tituloBuscado) !== false; // Comparar sin distinguir mayúsculas/minúsculas
    });
} else {
    $resultados = $libros; // Si no se buscó por título, mostrar todos los libros
}

?>

<div class="container">
    <h1 class="my-4">Lista de Libros</h1>

    <!-- Formulario de búsqueda -->
    <form class="mb-3" method="GET" action="">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Buscar por título" name="titulo" value="<?php echo htmlspecialchars($tituloBuscado); ?>">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <!-- Tabla de resultados -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>ISBN</th>
                <th>Año</th>
                <th>Categoría</th>
                <th>Disponible</th>
                <?php if ($rol === 'admin') { ?>
                    <th>Acciones</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($resultados as $libro) {
                echo '<tr>
                        <td>' . htmlspecialchars($libro["titulo"]) . '</td>
                        <td>' . htmlspecialchars($libro["autor"]) . '</td>
                        <td>' . htmlspecialchars($libro["isbn"]) . '</td>
                        <td>' . htmlspecialchars($libro["anioPublicacion"]) . '</td>
                        <td>' . htmlspecialchars($libro["categoria"]) . '</td>
                        <td>' . ($libro["disponible"] ? "Sí" : "No") . '</td>';

                // Si el rol es admin, mostrar opciones de editar y eliminar
                if ($rol === "admin") {
                    echo '<td>
                            <a href="editarLibro.php?id=' . htmlspecialchars($libro['isbn']) . '" class="btn btn-warning btn-sm">Editar</a>
                            <a href="../../app/controllers/adminController.php?action=eliminarLibro&id=' . htmlspecialchars($libro['isbn']) . '" class="btn btn-danger btn-sm" onclick="return confirm(\'¿Seguro que quieres eliminar este libro?\')">Eliminar</a>
                          </td>';
                }

                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<?php include_once '../footer.php'; ?>
