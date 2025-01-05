<?php
session_start();

require_once 'Usuario.php';
require_once 'Libro.php';

class AdminController
{
    // Función para ver todos los usuarios
    public function verUsuarios()
    {
        // Verificar si el usuario tiene privilegios de administrador
        if ($_SESSION['usuario_estado'] !== 'Admin') {
            echo "Acceso denegado";
            return;
        }

        // Cargar los usuarios desde el archivo JSON
        $usuarios = Usuario::cargarUsuarios();
        foreach ($usuarios as $usuario) {
            echo "Usuario: " . $usuario['nombre'] . " (" . $usuario['usuario'] . ")<br>";
        }
    }

    // Función para eliminar un usuario
    public function eliminarUsuario(int $idUsuario)
    {
        // Verificar si el usuario tiene privilegios de administrador
        if ($_SESSION['usuario_estado'] !== 'Admin') {
            echo "Acceso denegado";
            return;
        }

        // Cargar los usuarios y eliminar uno
        $usuarios = Usuario::cargarUsuarios();
        foreach ($usuarios as $index => $usuario) {
            if ($usuario['idUsuario'] == $idUsuario) {
                unset($usuarios[$index]);
                Usuario::guardarUsuarios($usuarios);
                echo "Usuario eliminado";
                return;
            }
        }

        echo "Usuario no encontrado";
    }

    // Función para ver todos los libros
    public function verLibros()
    {
        // Verificar si el usuario tiene privilegios de administrador
        if ($_SESSION['usuario_estado'] !== 'Admin') {
            echo "Acceso denegado";
            return;
        }

        // Mostrar todos los libros
        $libros = Libro::cargarLibros();
        foreach ($libros as $libro) {
            echo "Título: " . $libro['titulo'] . " (" . $libro['isbn'] . ")<br>";
        }
    }
}
?>
