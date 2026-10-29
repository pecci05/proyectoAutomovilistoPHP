<?php
namespace Dwes\AlquilerMovilidad;

require_once "Util/CupoSuperadoException.php";
require_once "Util/VehiculoYaAlquiladoException.php";

use Dwes\AlquilerMovilidad\Util\CupoSuperadoException;
use Dwes\AlquilerMovilidad\Util\VehiculoYaAlquiladoException;


class Cliente
{
    private int $numVehiculosAlquilados = 0;
    private array $vehiculosAlquilados = [];

    public function __construct(
        private string $nombre,
        private string $numero,
        private int    $maxAlquilerConcurrente = 3
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
        echo $this->nombre . "<br>";
        foreach ($this->vehiculosAlquilados as $vehiculo){
            echo $vehiculo->muestraResumen(). "<br>";
        }
        echo "<br>";
    }

    function tieneAlquilado(Vehiculo $v): bool
    {
        return in_array($v, $this->vehiculosAlquilados,true);
    }

    public function alquilar(Vehiculo $v): bool
    {
        if (count($this->vehiculosAlquilados) == $this->maxAlquilerConcurrente){
            throw new CupoSuperadoException();
            return false;
        }

        if (in_array($v, $this->vehiculosAlquilados,true)){
            throw new VehiculoYaAlquiladoException();
            return false;
        }

            $this->numVehiculosAlquilados++;
            echo "<p> Se ha sumado 1 a vehiculos alquilados</p>";
            $this->vehiculosAlquilados[] = $v;
            echo "<p> Se ha añadido el vehiculo al array</p>";
            $v->alquilado = true;
            return true;

    }

    public function devolver(int $numVehiculo): ?Vehiculo
    {
        $vehiculo = array_filter($this->vehiculosAlquilados, fn(Vehiculo $v) => $v->getNumero() == $numVehiculo);
        $position = array_search($this->vehiculosAlquilados, $vehiculo);

        if (in_array($vehiculo, $this->vehiculosAlquilados,true)) {
            array_splice($this->vehiculosAlquilados, $position, 1);
            $this->numVehiculosAlquilados--;
            $vehiculo->alquilado = false;
            return $vehiculo;
        } else {
            return null;
        }
    }

    function listaAlquileres(): void
    {
        var_dump($this->vehiculosAlquilados);
    }
}