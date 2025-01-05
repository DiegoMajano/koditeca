<?php
class Multa implements IMulta {
    private $fechaRetiro;
    private $fechaDevolucion;

    public function __construct(DateTime $fechaRetiro, DateTime $fechaDevolucion) {
        $this->fechaRetiro = $fechaRetiro;
        $this->fechaDevolucion = $fechaDevolucion;
    }

    public function getFechaRetiro() : DateTime{
        return $this->fechaRetiro;
    }

    public function getFechaDevolucion() : DateTime{
        return $this->fechaDevolucion;
    }

    public function validarMulta(): bool {
        $hoy = new DateTime();
        return $hoy > $this->fechaDevolucion;
    }

    public function calcularMulta(): int {
        if ($this->validarMulta()) {
            $hoy = new DateTime();
            $diasRetraso = $hoy->diff($this->fechaDevolucion)->days;
            return $diasRetraso * 5; // $5 por día de retraso.
        }
        return 0;
    }
}
?>
