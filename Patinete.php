<?php
class Patinete extends Vehiculo{
    public function  __construct(
        public string $titulo,
        private int $numero,
        private float $precio,
        private int $autonomiaKM,
        private int $velocidadMaxKMH
    )
    {
        parent::__construct($titulo, $numero, $precio);
    }


    public function muestraResumen(): void{
        echo parent::muestraResumen() . " || Autonomía (Km): " . $this->autonomiaKM .
            " || Velocidad Máxima (KmH) -> " . $this->velocidadMaxKMH;
    }
}