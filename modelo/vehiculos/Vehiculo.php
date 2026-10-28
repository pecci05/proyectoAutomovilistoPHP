<?php
namespace Model\Vehiculos;

require_once __DIR__ . "/../../interfaz/Resumible.php";
abstract class Vehiculo implements \Resumible{
    const IVA = 0.21;
    public function __construct(
        public string $titulo,
        private int $numero,
        private float $precio
    ){}

    public function getNumero(): int{
        return $this->numero;
    }

    public function getPrecio(): float{
        return $this->precio;
    }

    public function getPrecioConIva():float{
        return round($this->precio += $this->precio * self::IVA, 2) ;
    }

    public function muestraResumen():void{
        echo $this->titulo. " ( ".$this->numero." ) || Precio: ". $this->precio ." €";

    }
}