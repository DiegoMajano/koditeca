<?php 

session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php"); // Redirigir al login si no está autenticado
    exit;
}

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

include_once '../header.php'; 

?>

<div class="container my-4">
    <h1 class="mb-4">Buscar Libros</h1>
    
    <!-- Formulario de búsqueda -->
    <form action="../../app/controllers/userController.php?action=buscarLibro" method="GET" class="mb-4">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título del libro:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ingresa el título del libro">
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>

    <hr>

    <!-- Resultados de búsqueda -->
    <h2>Resultados</h2>
    <ul class="list-group">
        <?php
        if (empty($resultados)) {
            echo "<li class='list-group-item'>No se encontraron libros.</li>";
        } else {
            foreach ($resultados as $libro) {
                echo "<li class='list-group-item'>
                        {$libro['titulo']} - Autor: {$libro['autor']} - Disponible: " . ($libro['disponible'] ? 'Sí' : 'No') . "
                        ";
                // Mostrar botón de préstamo solo si el libro está disponible
                if ($libro['disponible']) {
                    echo "
                        <a href='../../app/controllers/userController.php?action=prestarLibro&id={$libro['isbn']}' class='btn btn-success btn-sm float-end ms-2'>Prestar</a>
                    ";
                }
                echo "</li>";
            }
        }
        ?>
    </ul>
</div>

<?php include_once '../footer.php'; ?>
