<?php
class Patinete extends Vehiculo{
    public function __construct(string $titulo
        ,int $numero
        ,float $precio
        ,private int $autonomiaKm
        ,private int $velocidadMaxKmH = 0)
    {
        parent::__construct($titulo, $numero, $precio);
    }

    public function muestraResumen(): void
    {
        parent::muestraResumen();
        echo $this->autonomiaKm;
        echo $this->velocidadMaxKmH;
    }

}