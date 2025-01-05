<?php
session_start();

require_once 'Libro.php';
require_once 'Usuario.php';

class LibroController
{
    // Función para agregar un libro
    public function agregarLibro($titulo, $autor, $isbn, $anioPublicacion, $categoria)
    {
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['usuario_id'])) {
            echo "Inicie sesión primero";
            return;
        }

        // Crear el nuevo libro
        $libro = new Libro($titulo, $autor, $isbn, $anioPublicacion, true, $categoria);

        // Guardar el libro
        $libros = Libro::cargarLibros();
        $libros[] = $libro;
        Libro::guardarLibros($libros);

        echo "Libro agregado exitosamente";
    }

    // Función para eliminar un libro
    public function eliminarLibro($isbn)
    {
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['usuario_id'])) {
            echo "Inicie sesión primero";
            return;
        }

        // Eliminar el libro
        $libros = Libro::cargarLibros();
        foreach ($libros as $index => $libro) {
            if ($libro['isbn'] == $isbn) {
                unset($libros[$index]);
                Libro::guardarLibros($libros);
                echo "Libro eliminado";
                return;
            }
        }

        echo "Libro no encontrado";
    }

    // Función para editar un libro
    public function editarLibro($isbn, $nuevoTitulo, $nuevoAutor, $nuevoAnio, $nuevaCategoria)
    {
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['usuario_id'])) {
            echo "Inicie sesión primero";
            return;
        }

        // Editar el libro
        $libros = Libro::cargarLibros();
        foreach ($libros as $index => $libro) {
            if ($libro['isbn'] == $isbn) {
                $libros[$index]['titulo'] = $nuevoTitulo;
                $libros[$index]['autor'] = $nuevoAutor;
                $libros[$index]['anioPublicacion'] = $nuevoAnio;
                $libros[$index]['categoria'] = $nuevaCategoria;
                Libro::guardarLibros($libros);
                echo "Libro actualizado";
                return;
            }
        }

        echo "Libro no encontrado";
    }

    // Función para ver los detalles de un libro
    public function verLibro($isbn)
    {
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['usuario_id'])) {
            echo "Inicie sesión primero";
            return;
        }

        // Buscar el libro
        $libros = Libro::cargarLibros();
        foreach ($libros as $libro) {
            if ($libro['isbn'] == $isbn) {
                echo "Título: " . $libro['titulo'] . "<br>";
                echo "Autor: " . $libro['autor'] . "<br>";
                echo "Año de Publicación: " . $libro['anioPublicacion'] . "<br>";
                echo "Categoría: " . $libro['categoria'] . "<br>";
                return;
            }
        }

        echo "Libro no encontrado";
    }
}
?>
