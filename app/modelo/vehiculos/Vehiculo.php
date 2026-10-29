<?php
namespace modelo\vehiculos;

require_once "interfaz/Resumible.php";
use \interfaz\Resumible;
abstract class Vehiculo implements Resumible{
    const IVA = 0.21;
    public function __construct(
        public string $titulo,
        private int $numero,
        private float $precio,
        private bool $alquilado = false
    ){}

    public function getNumero(): int{
        return $this->numero;
    }

    public function getPrecio(): float{
        return $this->precio;
    }

    public function isAlquilado(): bool
    {
        return $this->alquilado;
    }

    public function setAlquilado(bool $alquilado): void
    {
        $this->alquilado = $alquilado;
    }




    public function getPrecioConIva():float{
        return round($this->precio += $this->precio * self::IVA, 2) ;
    }

    public function muestraResumen():void{
        echo $this->titulo. " ( ".$this->numero." ) || Precio: ". $this->precio ." €";

    }
}