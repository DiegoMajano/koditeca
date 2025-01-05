<?php

interface ILibro
{
    public function getTitulo(): string;
    public function setTitulo(string $titulo): void;

    public function getAutor(): string;
    public function setAutor(string $autor): void;

    public function getAnioPublicacion(): int;
    public function setAnioPublicacion(int $anioPublicacion): void;

    public function isDisponible(): bool;
    public function setDisponible(bool $disponible): void;

    public function getCategoria(): string;
    public function setCategoria(string $categoria): void;

    public function getUsuarioPrestamo(): Usuario;
    public function setUsuarioPrestamo(Usuario $usuarioPrestamo): void;

    public function toArray(): array;
}
