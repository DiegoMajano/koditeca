<?php
interface IGestionLibros {
    public function agregarLibro(Libro $libro): bool;
    public function eliminarLibro(Libro $libro): bool;
    public function buscarLibro(string $titulo): ?Libro;
}
?>
