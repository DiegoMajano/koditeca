<?php
interface ITransaccion {
    public function prestarLibro(Usuario $usuario, Libro $libro): bool;
    public function devolverLibro(Usuario $usuario, Libro $libro): bool;
}
?>
