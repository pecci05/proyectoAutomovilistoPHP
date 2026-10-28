<?php

require_once "modelo/vehiculos/Vehiculo.php";
require_once "interfaz/Resumible.php";

class Cliente implements Resumible{
    public function __construct(
        private string $nombre,
        private int $numero,
        private int $maxAlquilerConcurrente = 3,
        private int $numVehiculosAlquilados = 0,
        private array $vehiculosAlquilados = []
    ){}

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): void
    {
        $this->numero = $numero;
    }

    public function getNumVehiculosAlquilados(): int
    {
        return $this->numVehiculosAlquilados;
    }

    public function tieneAlquilado(Vehiculo $v) : bool {
//        foreach($this->vehiculosAlquilados as $vehiculo){
//            if($v == $vehiculo) return true;
//        }
//        return false;

        return in_array($v, $this->vehiculosAlquilados, true);
    }

    public function alquilar(Vehiculo $v): bool {
        if ($this->tieneAlquilado($v)) {
            echo "El cliente ya tiene alquilado el vehículo " . $v->titulo . "<br>";
            return false;
        }

        if ($this->getNumVehiculosAlquilados() >= $this->maxAlquilerConcurrente) {
            echo "Este cliente tiene " . $this->maxAlquilerConcurrente . " elementos alquilados. No puede alquilar más en este sistema de movilidad hasta que no devuelva algo<br>";
            return false;
        }

        $this->numVehiculosAlquilados++;
        $this->vehiculosAlquilados[] = $v;

        echo "Alquilado vehículo a: " . $this->nombre . "<br>";
        $v->muestraResumen();

        return true;
    }

    public function devolver(int $numVehiculo) :bool{
        foreach($this->vehiculosAlquilados as $indice => $vehiculo){
            if($vehiculo->getNumero() == $numVehiculo) {
                echo "<p>El vehículo " . $vehiculo->titulo . " estaba alquilado y ha sido devuelto</p>";
                $this->numVehiculosAlquilados--;
                array_splice($this->vehiculosAlquilados, $indice, 1);
                return true;
            }
        }
        echo "<p>El vehículo con número ". $numVehiculo ." no estaba alquilado por lo que no se puede devolver</p>";
        return false;
    }

    public function listaAlquileres(): void{
        echo "<p>El cliente tiene ". $this->numVehiculosAlquilados ." vehículos alquilados:</p>";
        foreach($this->vehiculosAlquilados as $vehiculo){
            echo "<li>";
            $vehiculo->muestraResumen(); // Imprime el texto directamente
            echo "</li>";
        }
    }

    public function muestraResumen():void{
        echo $this->nombre . " -- Nº Alquileres: " . count($this->vehiculosAlquilados);
    }
}