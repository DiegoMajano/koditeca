<?php

require_once(__DIR__ . '/Interfaces/IAutor.php');
require_once 'Libro.php'; 

class Autor implements IAutor
{
    private string $nombre;
    private DateTime $fechaNacimiento;
    private string $nacionalidad;
    private ?string $biografia;
    private ?string $foto;


    // Constructor
    public function __construct(string $nombre, string $nacionalidad, DateTime $fechaNacimiento, ?string $biografia, ?string $foto)
    {
        $this->nombre = $nombre;
        $this->nacionalidad = $nacionalidad;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->biografia = $biografia;
        $this->foto = $foto;
    }

    // Métodos de la interfaz
    public function getNombre(): string
    {
        return $this->nombre;
    }
    public function getNacionalidad(): string
    {
        return $this->nacionalidad;
    }
    public function getFechaNacimiento(): DateTime{
        return $this->fechaNacimiento;
    }
    public function getBiografia() : string{
        return $this->biografia;
    }

    public function getFotografia() : string {
        return $this->foto;
    }
}
