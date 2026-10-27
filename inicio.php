<?php

require_once "Vehiculo.php";
require_once "Patinete.php";
require_once "BicicletaElectrica.php";

$vehiculo1 = new Vehiculo("Patinete Xiaomi Pro 2", 22, 3);
echo "<strong>" . $vehiculo1->titulo . "</strong>";
echo "<br>Precio: " . $vehiculo1->getPrecio() . " euros";
echo "<br>Precio IVA incluido: " . $vehiculo1->getPrecioConIVA() . " euros</br>";
echo "<br>".$vehiculo1->muestraResumen()."</br>";


echo "<p></p>";

$miPatinete = new Patinete("Patinete Xiaomi Mi Electric Pro 2", 23, 3.5, 45, 120);
echo "<strong>" . $miPatinete->titulo . "</strong>";
echo "<br>Precio: " . $miPatinete->getPrecio() . " euros";
echo "<br>Precio IVA incluido: " . $miPatinete->getPrecioConIva() . " euros</br>";
echo "<br>".$miPatinete->muestraResumen()."</br>";

$miBici = new BicicletaElectrica("Bici Eléctrica Orbea Vibe", 24, 15, 3, "Urbana");
echo "<strong>" . $miBici->titulo . "</strong>";
echo "<br>Precio: " . $miBici->getPrecio() . " euros";
echo "<br>Precio IVA incluido: " . $miBici->getPrecioConIva() . " euros</br>";
echo "<br>".$miBici->muestraResumen()."</br>";



