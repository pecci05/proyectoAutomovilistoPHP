<?php
require_once "modelo/AlquilerMovilidad.php"; // No incluimos nada más
//require_once __DIR__ . '/../Autoload.php';
require_once "excepciones/AlquilerMovilidadException.php";

use Dwes\AlquilerMovilidad\Util\AlquilerMovilidadException;
use Dwes\AlquilerMovilidad\Util\VehiculoNoEncontradoException;
use Dwes\AlquilerMovilidad\Util\ClienteNoEncontradoException;
use Dwes\AlquilerMovilidad\Util\VehiculoYaAlquiladoException;

use modelo\AlquilerMovilidad as AlquilerMovilidad;

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

try{
    $am->alquilarClienteVehiculo(1,2)->alquilarClienteVehiculo(1,3)
        ->alquilarClienteVehiculo(1,2)->alquilarClienteVehiculo(1,6);
}catch(AlquilerMovilidadException $e){
    echo "<p>".$e."</p>";
}

//listo los socios
$am->listarClientes();




echo "<h2>--- PRUEBAS DE ALQUILER Y DEVOLUCIÓN MÚLTIPLE ---</h2>";

// 1. Caso de ÉXITO: Pablo Picasso (cliente 2) alquila varios vehículos disponibles (por ejemplo: 1, 4 y 5)
echo "<h3>1. Alquiler múltiple con éxito</h3>";
try {
    $am->alquilarClienteVehiculos(2, [1, 4, 5]);
    echo "<p style='color:green'>Vehículos 1, 4 y 5 alquilados con éxito a Pablo Picasso.</p>";
} catch (Exception $e) {
    echo "<p style='color:red'>Error: " . $e->getMessage() . "</p>";
}

// Comprobamos el estado actual
$am->listarClientes();
$am->listarVehiculos();

// 2. Caso de ERROR: Intentar alquilar vehículos donde al menos uno YA está ocupado
// El vehículo 1 ya lo tiene Pablo Picasso, por lo que este lote debe fallar al completo
echo "<h3>2. Intento de alquilar lote con vehículo ocupado (debe fallar)</h3>";
try {
    $am->alquilarClienteVehiculos(1, [1, 5]); // El 1 ya está ocupado
    echo "<p style='color:green'>Alquiler completado (no debería llegar aquí).</p>";
} catch (Exception $e) {
    echo "<p style='color:orange'>Excepción esperada capturada: " . $e->getMessage() . "</p>";
}

// 3. Caso de ÉXITO: Devolución múltiple
// Pablo Picasso devuelve el 4 y el 5 (se queda solo con el 1)
echo "<h3>3. Devolución múltiple con éxito</h3>";
try {
    $am->devolverClienteVehiculos(2, [4, 5]);
    echo "<p style='color:green'>Vehículos 4 y 5 devueltos correctamente por Pablo Picasso.</p>";
} catch (Exception $e) {
    echo "<p style='color:red'>Error al devolver: " . $e->getMessage() . "</p>";
}

// 4. Caso de ERROR: Devolver vehículos que el cliente NO tiene alquilados
echo "<h3>4. Intento de devolver vehículo que no le pertenece (debe fallar)</h3>";
try {
    // El cliente 2 intenta devolver el 2 (que lo tiene Amancio) y el 6
    $am->devolverClienteVehiculos(2, [2, 6]);
    echo "<p style='color:green'>Devolución completada (no debería llegar aquí).</p>";
} catch (Exception $e) {
    echo "<p style='color:orange'>Excepción esperada capturada: " . $e->getMessage() . "</p>";
}

// Estado final de la flota y clientes
echo "<h3>--- ESTADO FINAL TRAS LAS OPERACIONES ---</h3>";
$am->listarClientes();
$am->listarVehiculos();