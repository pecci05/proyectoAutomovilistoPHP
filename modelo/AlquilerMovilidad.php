<?php
require_once "modelo/vehiculos/Vehiculo.php";
require_once "modelo/Cliente.php";
require_once "modelo/vehiculos/CocheElectrico.php";
require_once "modelo/vehiculos/BicicletaElectrica.php";
require_once "modelo/vehiculos/Patinete.php";

class AlquilerMovilidad{
    public function __construct(
        private string $direccion,
        /** @var Vehiculo[] */
        private array $vehiculos = [],
        /** @var Cliente[] */
        private array $socios = []
    ){}


    public function incluirPatinete(string $titulo, float $precio, int $autonomiaKm): void {
        $numero = count($this->vehiculos) + 1;
        $patinete = new Patinete($titulo, $numero, $precio, $autonomiaKm);
        $this->vehiculos[] = $patinete;
    }

    public function incluirBicicletaElectrica(string $titulo, float $precio, int $marchas, string $tipo): void {
        $numero = count($this->vehiculos) + 1;
        $bicicleta = new BicicletaElectrica($titulo, $numero, $precio, $marchas, $tipo);
        $this->vehiculos[] = $bicicleta;
    }

    public function incluirCocheElectrico(string $titulo, float $precio, string $marcaModelo, int $plazasMin, int $plazasMax): void {
        $numero = count($this->vehiculos) + 1;
        $coche = new CocheElectrico($titulo, $numero, $precio, $marcaModelo, $plazasMin, $plazasMax);
        $this->vehiculos[] = $coche;
    }

    public function incluirVehiculo(Vehiculo $v):void{
        $this->vehiculos[] = $v;
        echo "Incluido vehículo " . count($this->vehiculos) . "<br>";
    }

    public function listarVehiculos():void{
        echo "Listado de los " . count($this->vehiculos) . " vehículos disponibles:<br>";
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
        echo "Incluido socio " . count($this->socios) . "<br>";

    }

    public function listarSocios():void{
        echo "Listado de " . count($this->socios) . " socios del videoclub:<br>";
        foreach($this->socios as $socio){
            echo "<li>";
            $socio->muestraResumen();
            echo "</li>";
        }
    }

    public function alquilarClienteVehiculo(int $numCliente, int $numVehiculo) : AlquilerMovilidad{
        $cliente = $this->buscaCliente($numCliente);
        $vehiculo = $this->buscaVehiculo($numVehiculo);

        if ($cliente === null || $vehiculo === null) {
            echo "<p>Error: Cliente o vehículo no encontrado</p>";
            return $this;
        }

        $cliente->alquilar($vehiculo);

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

    public function buscaVehiculo(int $numVehiculo) : Vehiculo|null {
        foreach($this->vehiculos as $vehiculo){
            if($vehiculo->getNumero() == $numVehiculo){
                return $vehiculo;
            }
        }
        return null;
    }

}