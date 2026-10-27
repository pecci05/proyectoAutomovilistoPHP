<?php

class CocheElectrico extends Vehiculo
{
    public function __construct(string $titulo
        , int                          $numero
        , float                        $precio
        , private string               $marcaModelo
        , private int                  $plazasMin
        , private int                  $plazasMax)
    {
        parent::__construct($titulo, $numero, $precio);
    }

    public function muestraInfoPlazas()
    {
        if ($this->plazasMax == 1) {
            return "El vehículo es solo para un pasajero";
        } elseif ($this->plazasMax == $this->plazasMin){
            return "Para {$this->plazasMin} pasajeros";
        }else {
            return "Para {$this->plazasMin} a {$this->plazasMax} pasajeros";
        }
    }

    public function muestraResumen(): void
    {
        echo $this->marcaModelo;
        echo $this->plazasMin;
        echo $this->plazasMax;
        parent::muestraResumen();
    }

}
