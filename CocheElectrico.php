<?php


class CocheElectrico extends Vehiculo
{
    public function __construct(
        string  $titulo,
        int    $numero,
        float  $precio,
        private string $marcaModelo,
        private int $plazasMin,
        private int $plazasMax
    )
    {
        parent::__construct($titulo, $numero, $precio);
    }


    public function muestraInfoPlazas(){
        $plazas = $this->plazasMax;
        $resultado = match(true){
            $plazas == 1 => "Para un pasajero",
            $plazas == $this->plazasMin => "Para ".$plazas . " pasajeros",
            $plazas != 1 && $plazas > $this->plazasMin => "DE ".$this->plazasMin . " a " . $plazas . " pasajeros",
            default => "Para un pasajero"
        };
        return $resultado;
    }


    public function muestraResumen(): void
    {
        echo parent::muestraResumen() . " || Marca y modelo: " . $this->marcaModelo .
            " ||  " . $this->muestraInfoPlazas();
    }
}