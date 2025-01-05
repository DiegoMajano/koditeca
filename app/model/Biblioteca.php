<?php

require_once(__DIR__ . '/Interfaces/IGestionLibros.php');
require_once(__DIR__ . '/Interfaces/IGestionUsuarios.php');

class Biblioteca implements IGestionLibros, IGestionUsuarios {
    private $librosDisponibles = [];
    private $usuarios = [];

    public function agregarLibro(Libro $libro): bool {
        $this->librosDisponibles[] = $libro;
        return true;
    }

    public function eliminarLibro(Libro $libro): bool {
        foreach ($this->librosDisponibles as $key => $libroDisponible) {
            if ($libroDisponible === $libro) {
                unset($this->librosDisponibles[$key]);
                return true;
            }
        }
        return false;
    }

    public function buscarLibro(string $titulo): ?Libro {
        foreach ($this->librosDisponibles as $libro) {
            if (stripos($libro->getTitulo(), $titulo) !== false) {
                return $libro;
            }
        }
        return null;
    }

    public function registrarUsuario(Usuario $usuario): bool {
        $this->usuarios[] = $usuario;
        return true;
    }

    public function eliminarUsuario(Usuario $usuario): bool {
        foreach ($this->usuarios as $key => $usuarioRegistrado) {
            if ($usuarioRegistrado === $usuario) {
                $usuarioRegistrado->setEstado(EstadoUser::Inactivo);
                return true;
            }
        }
        return false;
    }

    public function buscarUsuario(string $nombre): ?Usuario {
        foreach ($this->usuarios as $usuario) {
            if (stripos($usuario->getNombre(), $nombre) !== false) {
                return $usuario;
            }
        }
        return null;
    }
}
?>
