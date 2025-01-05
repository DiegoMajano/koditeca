<?php

require_once(__DIR__ . '/Interfaces/IAdministrador.php');

class Administrador implements IAdministrador {
    private string $nombre;
    private int $idAdmin;
    private string $usuario;
    private string $clave;

    public function __construct(string $nombre, int $idAdmin, string $usuario, string $clave) {
        $this->nombre = $nombre;
        $this->idAdmin = $idAdmin;
        $this->usuario = $usuario;
        $this->clave = $clave;
    }

    public function agregarLibro(Biblioteca $biblioteca, Libro $libro): bool {
        return $biblioteca->agregarLibro($libro);
    }

    public function eliminarLibro(Biblioteca $biblioteca, Libro $libro): bool {
        return $biblioteca->eliminarLibro($libro);
    }

    public function registrarUsuario(Biblioteca $biblioteca, Usuario $usuario): bool {
        return $biblioteca->registrarUsuario($usuario);
    }

    public function eliminarUsuario(Biblioteca $biblioteca, Usuario $usuario): bool {
        return $biblioteca->eliminarUsuario($usuario);
    }

    public function buscarLibro(Biblioteca $biblioteca, string $titulo): ?Libro {
        return $biblioteca->buscarLibro($titulo);
    }

    public function buscarUsuario(Biblioteca $biblioteca, string $nombre): ?Usuario {
        return $biblioteca->buscarUsuario($nombre);
    }

    // Getters y setters
    public function getNombre(): string {
        return $this->nombre;
    }

    public function getIdAdmin(): int {
        return $this->idAdmin;
    }

    public function getUsuario(): string {
        return $this->usuario;
    }

    public function getClave(): string {
        return $this->clave;
    }

    public function setClave(string $clave): void {
        $this->clave = $clave;
    }
}
?>
