<!DOCTYPE html>
<?php
require_once 'datos.php';
ini_set('display_errors', 1);
error_reporting(E_ERROR);
session_start();
$mySmarty = getSmarty();

$usuarioLogueado = NULL;
if (isset($_SESSION['usuarioLogueado'])) {
    $usuarioLogueado = $_SESSION['usuarioLogueado'];
}

$categorias = getGeneros();

$catId = 1;

if (isset($_GET["catId"])) {
    $catId = $_GET["catId"];
} else if (isset($_COOKIE["ultimaCategoria"])) {
    $catId = $_COOKIE["ultimaCategoria"];
}

$categoria = getGeneroPorId($catId);
if (isset($categoria)) {
    setCookie('ultimaCategoria', $catId, time() + (60 * 60 * 24));
}

$productos = getTodosLosJuegos();
$consolas = getNombreConsolas();

$_SESSION['consolas'] = $consolas;
$_SESSION['categorias'] = $categorias;

$mySmarty->assign("usuarioLogueado", $usuarioLogueado);
$mySmarty->assign("categorias", $categorias); //Categorias es todos los géneros
$mySmarty->assign("categoria", $categoria); // Categoria es la última género que revisó el usuario
$mySmarty->assign("productos", $productos); // Productos son los juegos
$mySmarty->assign("consolas", $consolas);
$mySmarty->display("index.tpl");

?>