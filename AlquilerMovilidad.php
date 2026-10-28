<?php
require_once "Vehiculo.php";
require_once "Cliente.php";

class AlquilerMovilidad{
    public function __construct(
        private string $direccion,
        /** @var Vehiculo[] */
        private array $vehiculos = [],
        /** @var Cliente[] */
        private array $socios = []
    ){}


    public function incluirPatinete(string $titulo, float $precio, int $autonomiaKm) : void{

    }

    public function incluirBicicleta(string $titulo, float $precio, int $marchas, string $tipo) : void{

    }

    public function incluirCocheElectrico(string $titulo, float $precio, int $plazasMax) : void{

    }

    public function incluirVehiculo(Vehiculo $v):void{
        $this->vehiculos[] = $v;
        echo "Vehículo ". $v->titulo . " incluido correctamente";
    }

    public function listarVehiculos():void{
        foreach($this->vehiculos as $vehiculo){
            echo "<li>";
            $vehiculo->muestraResumen();
            echo "</li>";
        }
    }

    public function incluirSocio(string $nombre, int $maxAlquilerConcurrente = 3):void{
        $numCliente = count($this->socios)+1;
        $nuevoCliente = new Cliente($nombre, $numCliente, $maxAlquilerConcurrente);

        $this->socios[] = $nuevoCliente;
        echo "Cliente ". $nombre . " incluido correctamente";

    }

    public function listarSocios():void{
        foreach($this->socios as $socio){
            echo "<li>";
            $socio->muestraResumen();
            echo "</li>";
        }
    }

    public function alquilarClienteVehiculo(int $numCliente, int $numVehiculo) : AlquilerMovilidad{

        return $this;
    }

    public function buscaCliente(int $numCliente) : Cliente|null {
        foreach($this->socios as $socio){
            if($socio->getNumero() == $numCliente){
                return $socio;
            }
        }
        return null;
    }

}