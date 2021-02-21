<?php

require_once 'datos.php';
ini_set('display_errors', 1);

$nombre = $_POST["nombre"];
//$genero = $_POST["genero"];
$poster = $_FILES["poster"]["tmp_name"];
$fecha = $_POST["fecha"];
$resumen = $_POST["resumen"];
$empresa = $_POST["empresa"];
$link = $_POST["link"];



$pudeGuardar = guardarJuego($nombre, $poster, $fecha, $resumen, $empresa, $link);
if(!$pudeGuardar){
    header('location:altaJuego.php?err=1');
} else{
    header('location:index.php');
}

