<?php
session_start();

require_once 'Usuario.php';

class UserController
{
    // Función para registrar un nuevo usuario
    public function registrarUsuario($nombre, $usuario, $clave)
    {
        // Verificar si el nombre de usuario ya existe
        $usuarios = Usuario::cargarUsuarios();
        foreach ($usuarios as $user) {
            if ($user['usuario'] == $usuario) {
                echo "El nombre de usuario ya está en uso.";
                return;
            }
        }

        // Crear el nuevo usuario
        $idUsuario = rand(1, 1000); // Generar un ID único
        $claveHash = password_hash($clave, PASSWORD_DEFAULT); // Cifrar la contraseña
        $nuevoUsuario = new Usuario($nombre, $idUsuario, $usuario, $claveHash);

        // Guardar el usuario en el archivo JSON
        $usuarios[] = $nuevoUsuario;
        Usuario::guardarUsuarios($usuarios);

        echo "Registro exitoso";
    }

    // Función para iniciar sesión
    public function loginUsuario($usuario, $clave)
    {
        // Intentar hacer login
        $usuarioAutenticado = Usuario::login($usuario, $clave);

        if ($usuarioAutenticado) {
            $_SESSION['usuario_id'] = $usuarioAutenticado->getIdUsuario();
            $_SESSION['usuario_nombre'] = $usuarioAutenticado->getNombre();
            $_SESSION['usuario_estado'] = $usuarioAutenticado->getEstado()->value;

            echo "Bienvenido, " . $usuarioAutenticado->getNombre();
        } else {
            echo "Usuario o contraseña incorrectos";
        }
    }

    // Función para ver el perfil de usuario
    public function verPerfil()
    {
        if (!isset($_SESSION['usuario_id'])) {
            echo "Inicie sesión para ver su perfil";
            return;
        }

        echo "Bienvenido " . $_SESSION['usuario_nombre'] . "<br>";
        echo "Estado: " . $_SESSION['usuario_estado'] . "<br>";
    }

    // Función para cerrar sesión
    public function logoutUsuario()
    {
        session_unset();
        session_destroy();
        echo "Has cerrado sesión correctamente";
    }
}
?>
