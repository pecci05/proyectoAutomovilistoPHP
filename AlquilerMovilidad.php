<?php
require_once "Vehiculo.php";
require_once "Cliente.php";

class AlquilerMovilidad{
    public function __construct(
        private string $direccion,
        private array $vehiculos,
        private array $socios
    ){}


    public function incluirPatinete(string $titulo, float $precio, int $autonomiaKm) : void{

    }

    public function incluirBicicleta(string $titulo, float $precio, int $marchas, string $tipo) : void{

    }

    public function incluirCocheElectrico(string $titulo, float $precio, int $plazasMax) : void{

    }

    public function incluirVehiculo(Vehiculo $v):void{

    }

    public function listarVehiculos():void{
        foreach($this->vehiculos as $vehiculo){
            echo "<li>";
            $vehiculo->muestraResumen();
            echo "</li>";
        }
    }

    public function incluirSocio(string $nombre, int $maxAlquilerConcurrente = 3):void{

    }

    public function listarSocios():void{
        foreach($this->socios as $socio){
            echo "<li>";
            $socio->muestraResumen();
            echo "</li>";
        }
    }

    public function alquilarClienteVehiculo(int $numCliente, int $numVehiculo) : void{

    }
}