<?php

require_once(__DIR__ . '/Interfaces/IUsuario.php');

require_once(__DIR__ . '/Libro.php'); 

enum EstadoUser : string {
    case Activo = "Activo";
    case Inactivo = "Inactivo";
}

class Usuario implements IUsuario
{
    private string $nombre;
    private int $idUsuario;
    private string $usuario;
    private string $clave;
    private string $rol;  // Nuevo atributo para el rol
    private array $librosPrestados;
    private EstadoUser $estado;

    // Constructor
    public function __construct(string $nombre, int $idUsuario, string $usuario, string $clave, string $rol)
    {
        $this->nombre = $nombre;
        $this->idUsuario = $idUsuario;
        $this->usuario = $usuario;
        $this->clave = $clave;
        $this->rol = $rol;  // Asignar el rol al usuario
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

    public function getRol(): string
    {
        return $this->rol;
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

    // Guardar los usuarios en un archivo JSON
    public static function guardarUsuarios(array $usuarios): void
    {
        file_put_contents(__DIR__ . './../../data/usuarios.json', json_encode($usuarios, JSON_PRETTY_PRINT));
    }

    // Cargar los usuarios desde un archivo JSON
    public static function cargarUsuarios(): array
    {
        if (file_exists(__DIR__ . '/../../data/usuarios.json')) {
            
            return json_decode(file_get_contents(__DIR__ . '/../../data/usuarios.json'), true);
        }
        return [];
    }

    // Método de login
    public static function login(string $usuario, string $clave): ?Usuario
    {
        $usuarios = self::cargarUsuarios();

        foreach ($usuarios as $userData) {
            if ($userData['usuario'] === $usuario && $clave == $userData['clave']) {
                return new Usuario($userData['nombre'], $userData['idUsuario'], $userData['usuario'], $userData['clave'], $userData['rol']);
            }
        }
        return null; // Usuario o contraseña incorrectos
    }

}
?>
