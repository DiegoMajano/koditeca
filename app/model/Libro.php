<?php

require_once(__DIR__ . '/Interfaces/ILibro.php');
require_once(__DIR__ . '/Usuario.php');

class Libro implements ILibro
{
    private string $titulo;
    private string $autor;
    private string $isbn;
    private int $anioPublicacion;
    private bool $disponible;
    private string $categoria;
    private ?Usuario $usuarioPrestamo = null;

    // Constructor
    public function __construct(
        string $titulo,
        string $autor,
        string $isbn,
        int $anioPublicacion,
        bool $disponible,
        string $categoria
    ) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->isbn = $isbn;
        $this->anioPublicacion = $anioPublicacion;
        $this->disponible = $disponible;
        $this->categoria = $categoria;
    }

    // Implementación de los métodos de la interfaz
    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): void
    {
        $this->titulo = $titulo;
    }

    public function getAutor(): string
    {
        return $this->autor;
    }

    public function setAutor(string $autor): void
    {
        $this->autor = $autor;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function setIsbn(string $isbn): void
    {
        $this->isbn = $isbn;
    }

    public function getAnioPublicacion(): int
    {
        return $this->anioPublicacion;
    }

    public function setAnioPublicacion(int $anioPublicacion): void
    {
        $this->anioPublicacion = $anioPublicacion;
    }

    public function isDisponible(): bool
    {
        return $this->disponible;
    }

    public function setDisponible(bool $disponible): void
    {
        $this->disponible = $disponible;
    }

    public function getCategoria(): string
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria): void
    {
        $this->categoria = $categoria;
    }

    public function getUsuarioPrestamo(): Usuario{
        return $this->usuarioPrestamo;
    }

    public function setUsuarioPrestamo(Usuario $usuarioPrestamo): void{
        $this->usuarioPrestamo = $usuarioPrestamo;
    }


    public function toArray(): array
    {
        return [
            "titulo" => $this->titulo,
            "autor" => $this->autor,
            "isbn" => $this->isbn,
            "anioPublicacion" => $this->anioPublicacion,
            "disponible" => $this->disponible,
            "categoria" => $this->categoria,
            "prestadoA" => $this->usuarioPrestamo ? $this->usuarioPrestamo->getIdUsuario() : null, // Guardamos el ID del usuario si hay préstamo
        ];
    }

    // Guardar los libros en un archivo JSON
    public static function guardarLibros(array $libros): void
    {
        file_put_contents(__DIR__ . '/../../data/libros.json', json_encode($libros, JSON_PRETTY_PRINT));
    }

    // Cargar los libros desde un archivo JSON
    public static function cargarLibros(): array
    {
        if (file_exists(__DIR__ . '/../../data/libros.json')) {
            return json_decode(file_get_contents(__DIR__ . '/../../data/libros.json'), true);
        }
        return [];
    }
}
