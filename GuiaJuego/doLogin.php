<?php

require_once 'datos.php';
ini_set('display_errors',1);

$usuario = $_POST["usuario"];
$clave = $_POST["clave"];


$usuarioLogueado = login($usuario, $clave)["alias"];
//print_r($usuarioLogueado);


if (isset($usuarioLogueado) && strlen($usuarioLogueado) > 0) {
    session_start();
    $_SESSION["usuarioLogueado"] = $usuarioLogueado;
    header('location:index.php');
} else {
    header('location:login.php?err=1');
}
