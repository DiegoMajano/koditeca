<?php 

session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php"); // Redirigir al login si no está autenticado
    exit;
}

include_once '../header.php'; 
?>

<div class="container my-4">
    <h1 class="mb-4">Multas</h1>
    
    <?php if (empty($multas)): ?>
        <p>No tienes multas pendientes.</p>
    <?php else: ?>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Libro</th>
                    <th>Fecha de Devolución</th>
                    <th>Multa</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($multas as $multa): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($multa['libro']); ?></td>
                        <td><?php echo htmlspecialchars($multa['fechaDevolucion']); ?></td>
                        <td><?php echo "\${$multa['monto']}"; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include_once '../footer.php'; ?>
