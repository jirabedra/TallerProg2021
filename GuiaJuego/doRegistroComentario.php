<?php

require_once 'datos.php';
ini_set('display_errors', 1);
error_reporting(E_ERROR);
session_start();

$usuarioLogueadoId = NULL;
if (isset($_SESSION['usuarioLogueadoId'])) {
    $usuarioLogueadoId = $_SESSION['usuarioLogueadoId'];
}


$texto = $_POST["texto"];
$puntuacionJuego = $_POST["puntuacionJuego"];
$prodId = $_POST["prodId"];
$puntuacion = $puntuacionJuego;

agregarComentarioYPuntuacion($usuarioLogueadoId, $prodId, $texto, $puntuacion);
actualizarPuntuacionJuego($prodId);

header('location:index.php');
