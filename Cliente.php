<?php
class Cliente
{
    private int $numVehiculosAlquilados = 0;
    private array $vehiculosAlquilados = [];
    public function __construct(
        private string $nombre,
        private string $numero,
        private int $maxAlquilerConcurrente = 3
    )
    {
    }

    function getNumero()
    {
        return $this->numero;
    }

    function setNumero($numero)
    {
        $this->numero = $numero;
    }

    function getNumVehiculosAlquilados()
    {
        return $this->numVehiculosAlquilados;
    }

    function muestraResumen()
    {
    echo $this->nombre;
    echo count($this->vehiculosAlquilados);
    }

    function tieneAlquilado(Vehiculo $v):bool
    {
        return in_array($v,$this->vehiculosAlquilados);
    }

    function alquilar(Vehiculo $v):bool
    {
        if (in_array($v,$this->vehiculosAlquilados) && count($this->vehiculosAlquilados) == $this->maxAlquilerConcurrente) {
            $this->numVehiculosAlquilados++;
            echo "<p> Se ha sumado 1 a vehiculos alquilados</p>";
            $this->vehiculosAlquilados[] = $v;
            echo "<p> Se ha añadido el vehiculo al array</p>";
            return true;
        }else{
            echo "<p> No se puede alquilar el vehiculo </p>";
            return false;
        }
    }
}