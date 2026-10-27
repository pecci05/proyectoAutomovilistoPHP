<?php

class BicicletaElectrica extends Vehiculo
{
    public function __construct(
        public string $titulo,
        private int $numero,
        private float $precio,
        private int $marchas,
        private string $tipo
    )
    {
        parent::__construct($titulo, $numero, $precio);
    }


    public function muestraResumen(): void
    {
        echo parent::muestraResumen() . " || Nº de marchas: " . $this->marchas .
            " || Tipo de bicicleta:  " . $this->tipo;
    }
}