<?php
include_once "Dwes/AlquilerMovilidad/Patinete.php";
include_once "Dwes/AlquilerMovilidad/BicicletaElectrica.php";
include_once "Dwes/AlquilerMovilidad/CocheElectrico.php";
include_once "Dwes/AlquilerMovilidad/Cliente.php";

use Dwes\AlquilerMovilidad\Patinete as Patinete;
use Dwes\AlquilerMovilidad\BicicletaElectrica as BicicletaElectrica;
use Dwes\AlquilerMovilidad\CocheElectrico as CocheElectrico;
use Dwes\AlquilerMovilidad\Cliente as Cliente;


//instanciamos un par de objetos cliente
$cliente1 = new Cliente("Bruce Wayne", 23);
$cliente2 = new Cliente("Clark Kent", 33);

//mostramos el número de cada cliente creado
echo "<br>El identificador del cliente 1 es: " . $cliente1->getNumero();
echo "<br>El identificador del cliente 2 es: " . $cliente2->getNumero();

//instancio algunos vehículos
$v1 = new Patinete("Patinete Xiaomi Pro 2", 23, 3.5, 45);
$v2 = new CocheElectrico("Tesla Model 3", 26, 49.99, "Tesla Model 3 SR", 5, 5);
$v3 = new BicicletaElectrica("Orbea Vibe", 24, 15, 3, "Urbana");
$v4 = new Patinete("Ninebot Max", 4, 3, 65);

//alquilo algunos vehículos
$cliente1->alquilar($v1);
$cliente1->alquilar($v2);
$cliente1->alquilar($v3);

//voy a intentar alquilar de nuevo un vehículo que ya tiene alquilado
$cliente1->alquilar($v1);
//el cliente tiene 3 vehículos en alquiler como máximo
//este vehículo no lo va a poder alquilar
$cliente1->alquilar($v4);
//este vehículo no lo tiene alquilado
$cliente1->devolver(4);
//devuelvo un vehículo que sí que tiene alquilado
$cliente1->devolver(2);
//alquilo otro vehículo
$cliente1->alquilar($v4);
//listo los elementos alquilados
$cliente1->listaAlquileres();
//este cliente no tiene alquileres
$cliente2->devolver(2);

?>