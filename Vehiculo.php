<?php

abstract class Vehiculo
{
    const float IVA = 0.21;

    public function __construct(
        public string $titulo,
        private int   $numero,
        private float $precio
    )
    {
    }

    public function getNumero():int
    {
        return $this->numero;
    }

    public function getPrecio():float
    {
        return $this->precio;
    }

    public function getPrecioConIVA():float
    {
        return ($this->precio + ($this->precio*self::IVA));
    }

    public function muestraResumen():void
    {
        echo $this->titulo;
        echo $this->numero;
        echo $this->precio;
    }


}

?>