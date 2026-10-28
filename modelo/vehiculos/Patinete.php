<?php
namespace Model\Vehiculos;
class Patinete extends Vehiculo{
    public function  __construct(
        string $titulo,
        int $numero,
        float $precio,
        private int $autonomiaKM,
        private int $velocidadMaxKMH = 0
    )
    {
        parent::__construct($titulo, $numero, $precio);
    }


    public function muestraResumen(): void{
        echo parent::muestraResumen() . " || Autonomía (Km): " . $this->autonomiaKM .
            " || Velocidad Máxima (KmH) -> " . $this->velocidadMaxKMH;
    }
}