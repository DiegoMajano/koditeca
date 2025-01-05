<?php
interface IAdministrador {
    public function agregarLibro(Biblioteca $biblioteca, Libro $libro): bool;
    public function eliminarLibro(Biblioteca $biblioteca, Libro $libro): bool;
    public function registrarUsuario(Biblioteca $biblioteca, Usuario $usuario): bool;
    public function eliminarUsuario(Biblioteca $biblioteca, Usuario $usuario): bool;
    public function buscarLibro(Biblioteca $biblioteca, string $titulo): ?Libro;
    public function buscarUsuario(Biblioteca $biblioteca, string $nombre): ?Usuario;
}
?>
