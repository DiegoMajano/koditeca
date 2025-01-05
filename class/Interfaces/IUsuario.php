<?php

interface IUsuario
{
    public function getNombre(): string;
    public function setNombre(string $nombre): void;

    public function getIdUsuario(): int;
    public function setIdUsuario(int $idUsuario): void;

    public function getUsuario(): string;
    public function setUsuario(string $usuario): void;

    public function getClave(): string;
    public function setClave(string $clave): void;

    public function getLibrosPrestados(): array;
    public function prestarLibro(Libro $libro): bool;
    public function devolverLibro(Libro $libro): bool;
    public function verLibrosPrestados(): array;
}
