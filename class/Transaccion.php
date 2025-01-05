<?php

enum TipoTransaccion: string
{
    case Prestamo = 'Préstamo';
    case Devolucion = 'Devolución';
}

class Transaccion
{
    private Usuario $usuario;
    private Libro $libro;
    private TipoTransaccion $tipoTransaccion;
    private DateTime $fecha;

    public function __construct(Usuario $usuario, Libro $libro, TipoTransaccion $tipoTransaccion, DateTime $fecha)
    {
        $this->usuario = $usuario;
        $this->libro = $libro;
        $this->tipoTransaccion = $tipoTransaccion;
        $this->fecha = $fecha;
    }

    // Métodos Getters
    public function getUsuario(): Usuario
    {
        return $this->usuario;
    }

    public function getLibro(): Libro
    {
        return $this->libro;
    }

    public function getTipoTransaccion(): TipoTransaccion
    {
        return $this->tipoTransaccion;
    }

    public function getFecha(): DateTime
    {
        return $this->fecha;
    }

    // Método realizarTransaccion
    public function realizarTransaccion(): bool
    {
        if ($this->tipoTransaccion === TipoTransaccion::Prestamo) {
            return $this->usuario->prestarLibro($this->libro);
        } elseif ($this->tipoTransaccion === TipoTransaccion::Devolucion) {
            return $this->usuario->devolverLibro($this->libro);
        }

        return false;
    }
}
