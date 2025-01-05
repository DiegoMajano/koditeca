<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link rel="stylesheet" href="/public/css/styles.css">
    <!-- Incluir Bootstrap desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<header class="bg-primary text-white p-3 mb-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>Bienvenido a la Biblioteca</h1>
            <?php  
                if (isset($_SESSION['usuario_nombre'])) {
                    $user = $_SESSION['usuario_nombre']; 
            ?>
                <div class="d-flex align-items-center">
                    <span class="me-3">Bienvenido, <?php echo $user; ?></span>
                    <a href="../dashboard.php" class="btn btn-light me-2">Inicio</a>
                    <a href="../views/logout.php" class="btn btn-danger">Cerrar Sesión</a>
                </div>
            <?php } ?>
        </div>
    </div>
</header>
<main>
