<?php

require_once 'datos.php';
ini_set('display_errors', 1);
error_reporting(E_ERROR);

$idConsola = $_POST["idConsola"];
$idJuego = $_POST["idJuego"];

print_r($idConsola);
print_r("-");
print_r($idJuego);


$pudeGuardar = agregarConsolaAJuego($idJuego, $idConsola); 


if (!$pudeGuardar) {
    header('location:agregarConsola.php?err=1');
} else {
    header('location:index.php');
}
