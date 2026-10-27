<?php


class CocheElectrico extends Vehiculo
{
    public function __construct(
        public string  $titulo,
        private int    $numero,
        private float  $precio,
        private string $marcaModelo,
        private int $plazasMin,
        private int $plazasMax
    )
    {
        parent::__construct($titulo, $numero, $precio);
    }


    public function muestraInfoPlazas(){
        $plazas = $this->plazasMax;
        $resultado = match($plazas){
            $plazas == 1 => "Para un pasajero",

        }
    }


    public function muestraResumen(): void
    {
        echo parent::muestraResumen() . " || Marca y modelo: " . $this->marcaModelo .
            " || Tipo de bicicleta:  " . $this->tipo;
    }
}