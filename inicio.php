<?php
include "Dwes/AlquilerMovilidad/Vehiculo.php";

use Dwes\AlquilerMovilidad\Vehiculo as Vehiculo;

//$vehiculo1 = new Vehiculo("Patinete Xiaomi Pro 2", 22, 3);
//echo "<strong>" . $vehiculo1->titulo . "</strong>";
//echo "<br>Precio: " . $vehiculo1->getPrecio() . " euros";
//echo "<br>Precio IVA incluido: " . $vehiculo1->getPrecioConIVA() . " euros " . "<br>";
//$vehiculo1->muestraResumen();
//echo "<br>";


include "Dwes/AlquilerMovilidad/Patinete.php";
use Dwes\AlquilerMovilidad\Patinete as Patinete;

$miPatinete = new Patinete("Patinete Xiaomi Mi Electric Pro 2", 23, 3.5, 45);
echo "<strong>" . $miPatinete->titulo . "</strong>";
echo "<br>Precio: " . $miPatinete->getPrecio() . " euros";
echo "<br>Precio IVA incluido: " . $miPatinete->getPrecioConIva() . " euros" . "<br>";
$miPatinete->muestraResumen();
echo "<br>";


include "Dwes/AlquilerMovilidad/BicicletaElectrica.php";

use Dwes\AlquilerMovilidad\BicicletaElectrica as BicicletaElectrica;

$miBici = new BicicletaElectrica("Bici Eléctrica Orbea Vibe", 24, 15, 3, "Urbana");
echo "<strong>" . $miBici->titulo . "</strong>";
echo "<br>Precio: " . $miBici->getPrecio() . " euros";
echo "<br>Precio IVA incluido: " . $miBici->getPrecioConIva() . " euros" . "<br>";
$miBici->muestraResumen();
echo "<br>";


include "Dwes/AlquilerMovilidad/CocheElectrico.php";

use Dwes\AlquilerMovilidad\CocheElectrico as CocheElectrico;

$miCoche = new CocheElectrico("Tesla Model 3", 26, 49.99, "Tesla Model 3 Standard Range", 5, 5);
echo "<strong>" . $miCoche->titulo . "</strong>";
echo "<br>Precio: " . $miCoche->getPrecio() . " euros";
echo "<br>Precio IVA incluido: " . $miCoche->getPrecioConIva() . " euros";
$miCoche->muestraResumen();


