<?php 
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php"); // Redirigir al login si no está autenticado
    exit;
}

include_once '../header.php'; 
?>

<div class="container">
    <h1 class="my-4">Agregar Libro</h1>
    <form action="../../app/controllers/adminController.php?action=agregarLibro" method="POST">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título:</label>
            <input type="text" id="titulo" name="titulo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="autor" class="form-label">Autor:</label>
            <input type="text" id="autor" name="autor" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN:</label>
            <input type="text" id="isbn" name="isbn" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="anioPublicacion" class="form-label">Año de Publicación:</label>
            <input type="number" id="anioPublicacion" name="anioPublicacion" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría:</label>
            <input type="text" id="categoria" name="categoria" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Agregar Libro</button>
    </form>
</div>

<?php include_once '../footer.php'; ?>
