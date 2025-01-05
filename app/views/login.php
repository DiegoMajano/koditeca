<?php
session_start();

require_once(__DIR__ . '/../model/Usuario.php');  

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    // Intentar hacer login
    $usuarioAutenticado = Usuario::login($usuario, $clave);

    if ($usuarioAutenticado) {
        // Guardar los datos del usuario en la sesión
        $_SESSION['usuario_id'] = $usuarioAutenticado->getIdUsuario();
        $_SESSION['usuario_nombre'] = $usuarioAutenticado->getNombre();
        $_SESSION['usuario_estado'] = $usuarioAutenticado->getEstado()->value;
        $_SESSION['usuario_rol'] = $usuarioAutenticado->getRol(); // Guardar el rol en la sesión

        header("Location: dashboard.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Usuario o contraseña incorrectos!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Biblioteca</title>
    <!-- Incluir Bootstrap desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h3>Iniciar Sesión</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="login.php">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuario:</label>
                                <input type="text" name="usuario" id="usuario" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="clave" class="form-label">Contraseña:</label>
                                <input type="password" name="clave" id="clave" class="form-control" required>
                            </div>
                            <button type="submit" name="login" class="btn btn-primary w-100">Iniciar sesión</button>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Incluir JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
