<?php

interface IAutor
{
    public function getNombre(): string;
    public function getNacionalidad() : string;

    public function getBiografia(): string;

    public function getFechaNacimiento(): DateTime;

    public function getFotografia(): string;
}
