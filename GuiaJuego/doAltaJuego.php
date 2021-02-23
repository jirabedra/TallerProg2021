<?php

require_once 'datos.php';
ini_set('display_errors', 1);
error_reporting(E_ERROR);

$nombre = $_POST["nombre"];
$genero = $_POST["genero"];
/*if (isset($_POST['poster'])) {
    $name = $_FILES['poster']['name'];
    $temp_name = $_FILES['poster']['tmp_name'];
    if (isset($name) and!empty($name)) {
        $location = 'img_productos/';
        if (move_uploaded_file($temp_name, $location . $name)) {
            echo 'File uploaded successfully';
        }
    } else {
        echo 'You should select a file to upload !!';
    }
}*/
$poster = $_FILES["poster"]["tmp_name"];
$tipoPoster = $_FILES["poster"]["type"];
$fecha = $_POST["fecha"];
$resumen = $_POST["resumen"];
$empresa = $_POST["empresa"];
$link = $_POST["link"];



$pudeGuardar = guardarJuego($nombre, $genero, $poster, $fecha, $resumen, $empresa, $link, $tipoPoster);
if (!$pudeGuardar) {
    header('location:altaJuego.php?err=1');
} else {
    header('location:index.php');
}

