<?php


enum EstadoUser : string {
    case Activo = "Activo";
    case Inactivo = "Inactivo";
}

require_once './Interfaces/IUsuario.php';
require_once 'Libro.php'; 

class Usuario implements IUsuario
{
    private string $nombre;
    private int $idUsuario;
    private string $usuario;
    private string $clave;
    private array $librosPrestados;
    private EstadoUser $estado;

    // Constructor
    public function __construct(string $nombre, int $idUsuario, string $usuario, string $clave)
    {
        $this->nombre = $nombre;
        $this->idUsuario = $idUsuario;
        $this->usuario = $usuario;
        $this->clave = $clave;
        $this->librosPrestados = [];
        $this->estado = EstadoUser::Activo;
    }

    // Métodos de la interfaz
    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getIdUsuario(): int
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(int $idUsuario): void
    {
        $this->idUsuario = $idUsuario;
    }

    public function getUsuario(): string
    {
        return $this->usuario;
    }

    public function setUsuario(string $usuario): void
    {
        $this->usuario = $usuario;
    }

    public function getClave(): string
    {
        return $this->clave;
    }

    public function setClave(string $clave): void
    {
        $this->clave = $clave;
    }

    public function getLibrosPrestados(): array
    {
        return $this->librosPrestados;
    }

    public function getEstado(): EstadoUser{
        return $this->estado;
    }

    public function setEstado(EstadoUser $estado): void{
        $this->estado = $estado;
    }

    public function prestarLibro(Libro $libro): bool
    {
        if ($libro->isDisponible()) {
            $this->librosPrestados[] = $libro;
            $libro->setDisponible(false);
            return true;
        }
        return false; // Si el libro no está disponible.
    }

    public function devolverLibro(Libro $libro): bool
    {
        foreach ($this->librosPrestados as $index => $prestado) {
            if ($prestado === $libro) {
                unset($this->librosPrestados[$index]);
                $libro->setDisponible(true);
                return true;
            }
        }
        return false; // Si el libro no está entre los prestados.
    }

    public function verLibrosPrestados(): array
    {
        return $this->librosPrestados;
    }
}
