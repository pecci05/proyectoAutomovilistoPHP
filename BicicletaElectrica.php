<?php
class BicicletaElectrica extends Vehiculo
{
    public function __construct(string $titulo
        ,int $numero
        ,float $precio
        ,private int $marchas
        ,private string $tipo)
    {
        parent::__construct($titulo, $numero, $precio);
    }

    public function muestraResumen(): void
    {
        echo $this->marchas;
        echo $this->tipo;
        parent::muestraResumen();
    }

}


?>