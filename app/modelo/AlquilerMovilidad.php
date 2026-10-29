<?php
namespace modelo;

use Dwes\AlquilerMovilidad\Util\AlquilerMovilidadException;
use Dwes\AlquilerMovilidad\Util\ClienteNoEncontradoException;
use Dwes\AlquilerMovilidad\Util\VehiculoNoEncontradoException;
use modelo\vehiculos\BicicletaElectrica;
use modelo\vehiculos\CocheElectrico;
use modelo\vehiculos\Patinete;
use modelo\vehiculos\Vehiculo;
use Dwes\AlquilerMovilidad\Util\VehiculoYaAlquiladoException;

require_once "modelo/vehiculos/Vehiculo.php";
require_once "modelo/Cliente.php";
require_once "modelo/vehiculos/CocheElectrico.php";
require_once "modelo/vehiculos/BicicletaElectrica.php";
require_once "modelo/vehiculos/Patinete.php";
require_once "excepciones/AlquilerMovilidadException.php";
require_once "excepciones/VehiculoNoEncontradoException.php";

class AlquilerMovilidad{

    private static $idClientes = 1;
    private static $idVehiculos = 1;
    public function __construct(
        private string $direccion,
        /** @var Vehiculo[] */
        private array $vehiculos = [],
        /** @var Cliente[] */
        private array $clientes = [],
        private int $numVehiculosAlquilados = 0,
        private int $numTotalAlquileres = 0
    ){}

    public static function getIdClientes(): int
    {
        return self::$idClientes;
    }

    public function getNumVehiculosAlquilados(): int
    {
        return $this->numVehiculosAlquilados;
    }

    public function getNumTotalAlquileres(): int
    {
        return $this->numTotalAlquileres;
    }




    public function incluirPatinete(string $titulo, float $precio, int $autonomiaKm): void {
        $numero = self::$idVehiculos++;
        $patinete = new Patinete($titulo, $numero, $precio, $autonomiaKm);
        $this->vehiculos[] = $patinete;
    }

    public function incluirBicicletaElectrica(string $titulo, float $precio, int $marchas, string $tipo): void {
        $numero = self::$idVehiculos++;
        $bicicleta = new BicicletaElectrica($titulo, $numero, $precio, $marchas, $tipo);
        $this->vehiculos[] = $bicicleta;
    }

    public function incluirCocheElectrico(string $titulo, float $precio, string $marcaModelo, int $plazasMin, int $plazasMax): void {
        $numero = self::$idVehiculos++;
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

    public function incluirCliente(string $nombre, int $maxAlquilerConcurrente = 3):void{
        $numCliente = self::$idClientes++;
        $nuevoCliente = new Cliente($nombre, $numCliente, $maxAlquilerConcurrente);

        $this->clientes[] = $nuevoCliente;
        echo "Incluido socio " . count($this->clientes) . "<br>";

    }

    public function listarClientes():void{
        echo "Listado de " . count($this->clientes) . " socios del videoclub:<br>";
        foreach($this->clientes as $socio){
            echo "<li>";
            $socio->muestraResumen();
            echo "</li>";
        }
    }

    public function alquilarClienteVehiculo(int $numCliente, int $numVehiculo) : AlquilerMovilidad{
        $cliente = $this->buscaCliente($numCliente);
        $vehiculo = $this->buscaVehiculo($numVehiculo);

        if ($cliente === null) {
           throw new ClienteNoEncontradoException("Error: Cliente no encontrado") ;

        }
        if ($vehiculo === null) {
            throw new VehiculoNoEncontradoException("Error: Vehículo no encontrado");

        }

        try{
            $cliente->alquilar($vehiculo);
            $vehiculo->setAlquilado(true);
            $this->numTotalAlquileres++;
            $this->numVehiculosAlquilados++;
        }catch(AlquilerMovilidadException $e){
            echo "<p>".$e->getMessage()."</p>";
        }


        return $this;
    }

    public function estanVehiculosDisponibles(array $numerosVehiculos):bool{
        $cantidadDisponible = 0;
        foreach ($this->vehiculos as $v){
            if(in_array($v->getNumero(), $numerosVehiculos, true) && !$v->isAlquilado()){
                $cantidadDisponible++;
            }
        }

        return count($numerosVehiculos) == $cantidadDisponible;
    }

    public function alquilarClienteVehiculos(int $numCliente, array $numerosVehiculos) : AlquilerMovilidad{
        $cliente = $this->buscaCliente($numCliente);
        if ($cliente === null) {
            throw new ClienteNoEncontradoException("Error: Cliente no encontrado") ;

        }

        if(count($numerosVehiculos) == 0){
            throw new VehiculoNoEncontradoException("Error: Vehículos no encontrados");

        }

        if($this->estanVehiculosDisponibles($numerosVehiculos)){
            try{
                foreach ($this->vehiculos as $v){
                    if(in_array($v->getNumero(), $numerosVehiculos, true)){
                        $cliente->alquilar($v);
                        $v->setAlquilado(true);
                        $this->numVehiculosAlquilados ++;
                        $this->numTotalAlquileres ++;
                    }
                }
            }catch(AlquilerMovilidadException $e){
                echo "<p>".$e->getMessage()."</p>";
            }
        }else{
            throw new VehiculoNoEncontradoException("Error: Vehículos no encontrados");

        }

        return $this;
    }




    public function devolverClienteVehiculo(int $numCliente, int $numVehiculo) : AlquilerMovilidad{
        $cliente = $this->buscaCliente($numCliente);
        $vehiculo = $this->buscaVehiculo($numVehiculo);

        if ($cliente === null) {
            throw new ClienteNoEncontradoException("Error: Cliente no encontrado") ;

        }
        if ($vehiculo === null) {
            throw new VehiculoNoEncontradoException("Error: Vehículo no encontrado");

        }
        try{
            $cliente->devolver($vehiculo->getNumero());
            $vehiculo->setAlquilado(false);
            $this->numVehiculosAlquilados--;

        }catch(AlquilerMovilidadException $e){
            echo "<p>".$e->getMessage()."</p>";
        }

        return $this;
    }

    public function estanVehiculosAlquilados(int $numCliente, array $numerosVehiculos):bool{
        $cliente = $this->buscaCliente($numCliente);
        if($cliente == null) throw New ClienteNoEncontradoException("Cliente no encontrado");

        $cantidadAlquilados = 0;

        foreach ($cliente->getVehiculosAlquilados() as $v) {
            if (in_array($v->getNumero(), $numerosVehiculos, true)) {
                $cantidadAlquilados++;
            }
        }

        return count($numerosVehiculos) == $cantidadAlquilados;
    }

    public function devolverClienteVehiculos(int $numCliente, array $numerosVehiculos) : AlquilerMovilidad{
        $cliente = $this->buscaCliente($numCliente);
        if ($cliente === null) {
            throw new ClienteNoEncontradoException("Error: Cliente no encontrado") ;

        }

        if(count($numerosVehiculos) == 0){
            throw new VehiculoNoEncontradoException("Error: Vehículos no encontrados");

        }

        foreach ($this->vehiculos as $v){
            if(in_array($v->getNumero(), $numerosVehiculos, true)){
                $cliente->devolver($v->getNumero());
                $v->setAlquilado(false);
                $this->numVehiculosAlquilados --;
            }
        }

//        try{
//            if($this->estanVehiculosAlquilados($numCliente, $numerosVehiculos)){
//
//            }
//        }catch(AlquilerMovilidadException $e){
//            echo "<p>".$e->getMessage()."</p>";
//        }


        return $this;
    }

    public function buscaCliente(int $numCliente) : Cliente|null {
        foreach($this->clientes as $socio){
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