<?php
require_once "modelo/AlquilerMovilidad.php"; // No incluimos nada más

use Model\Vehiculos\BicicletaElectrica as BicicletaElectrica;
use Model\Vehiculos\CocheElectrico as CocheElectrico;
use Model\Vehiculos\Patinete as Patinete;
use Model\Vehiculos\Vehiculo as Vehiculo;
use Model\Cliente as Cliente;
use Model\AlquilerMovilidad as AlquilerMovilidad;

$am = new AlquilerMovilidad("Severo 8A");

//voy a incluir unos cuantos vehículos de prueba
$am->incluirCocheElectrico("Tesla Model 3", 19.99, "Tesla Model 3", 5, 5);
$am->incluirCocheElectrico("Nissan Leaf", 49.99, "Nissan Leaf", 5, 5);
$am->incluirBicicletaElectrica("Orbea Vibe", 4.5, 3, "Urbana");
$am->incluirBicicletaElectrica("Specialized Turbo", 4.5, 7, "Mixta");
$am->incluirPatinete("Ninebot Max", 3, 65);
$am->incluirPatinete("Xiaomi Pro 2", 3.5, 45);

//listo los vehículos
$am->listarVehiculos();

//voy a crear algunos socios
$am->incluirCliente("Amancio Ortega");
$am->incluirCliente("Pablo Picasso", 2);

$am->alquilarClienteVehiculo(1,2)->alquilarClienteVehiculo(1,3)
    ->alquilarClienteVehiculo(1,2)->alquilarClienteVehiculo(1,6);

//listo los socios
$am->listarClientes();