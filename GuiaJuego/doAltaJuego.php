<?php

require_once 'datos.php';
ini_set('display_errors', 1);
error_reporting(E_ERROR);

$nombre = $_POST["nombre"];
$genero = $_POST["genero"];
$consolas = $_POST["consolas"];
$poster = $_FILES["poster"]["tmp_name"];
$tipoPoster = $_FILES["poster"]["type"];
$fecha = $_POST["fecha"];
$resumen = $_POST["resumen"];
$empresa = $_POST["empresa"];
$link = $_POST["link"];

$pudeGuardar = guardarJuego($nombre, $genero, $poster, $fecha, $resumen, $empresa, $link, $tipoPoster, $consolas);

if (!$pudeGuardar) {
    header('location:altaJuego.php?err=1');
} else {
    header('location:index.php');
}
