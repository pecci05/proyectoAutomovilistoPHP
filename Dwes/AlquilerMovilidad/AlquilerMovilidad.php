<?php
namespace Dwes\AlquilerMovilidad;
require_once "Dwes/AlquilerMovilidad/Vehiculo.php";
require_once "Cliente.php";
require_once "Vehiculo.php";
require_once "CocheElectrico.php";
require_once "BicicletaElectrica.php";
require_once "Patinete.php";
    class AlquilerMovilidad
    {

        public function __construct(
            private string $direccion,
            private array $vehiculos = [],
            private array $socios = [],
            private int $numVehiculosAlquilados = 0,
            private int $numTotalAlquileres = 0
        )
        {
        }

        private function incluirVehiculo(Vehiculo $vehiculo)
        {
            $this->vehiculos[] = $vehiculo;
        }

        function incluirCocheElectrico(string $titulo,float $precio,string $marcaModelo,int $plazasMin,int $plazasMax)
        {
            $this->incluirVehiculo(new CocheElectrico($titulo,count($this->vehiculos),$precio,$marcaModelo,$plazasMin,$plazasMax));
        }

        function incluirBicicletaElectrica(string $titulo,float $precio,int $marchas,string $tipo)
        {
            $this->incluirVehiculo(new BicicletaElectrica($titulo,count($this->vehiculos),$precio,$marchas,$tipo));
        }

        function incluirPatinete(string $titulo,float $precio,int $autonomiaKm,int $velocidadMax = 0)
        {
            $this->incluirVehiculo(new Patinete($titulo,count($this->vehiculos),$precio,$autonomiaKm,$velocidadMax));
        }

        function listarVehiculos()
        {
            foreach ($this->vehiculos as $vehiculo){
                echo $vehiculo->muestraResumen() . "<br>";
            }
        }

        function incluirCliente(string $nombre, int $numMax = 3)
        {
            $this->socios[] = new Cliente($nombre,count($this->socios),$numMax);
        }
        function alquilarClienteVehiculo(int $numCliente, int $numVehiculo)
        {
            $vehiculo = array_values(array_filter($this->vehiculos,fn(Vehiculo $v) => $v->getNumero() == $numVehiculo));
            $cliente = array_values(array_filter($this->socios,fn(Cliente $c) => $c->getNumero() == $numCliente));

//            echo "HOLA <p>" . count($cliente) . "</p>";

            if (count($vehiculo) != 0 && count($cliente) != 0){
                $this->numVehiculosAlquilados++;
                $this->numTotalAlquileres++;

                $cliente[0]->alquilar($vehiculo[0]);
                return $this;
            }else{
                echo "<p>No se puede identificar al cliente/vehiculo</p>";
                return $this;
            }
        }

        function listarClientes()
        {
            foreach ($this->socios as $socio){
                echo $socio->muestraResumen();
            }
        }
    }




?>