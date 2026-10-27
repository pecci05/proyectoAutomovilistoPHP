<?php
class Cliente
{
    private int $numVehiculosAlquilados = 0;
    private array $vehiculosAlguilados = [];
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
    echo count($this->vehiculosAlguilados);
    }
}