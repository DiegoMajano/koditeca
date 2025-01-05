<?php

require_once('./Interfaces/ICategoria.php');

class Categoria implements ICategoria {
    private string $nombre;
    private ?string $descripcion;

    public function __construct(string $nombre, ?string $descripcion = null) {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }

    public function obtenerNombreCategoria(): string {
        return $this->nombre;
    }

    public function obtenerDescripcion(): ?string {
        return $this->descripcion;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setDescripcion(?string $descripcion): void {
        $this->descripcion = $descripcion;
    }
}
?>
