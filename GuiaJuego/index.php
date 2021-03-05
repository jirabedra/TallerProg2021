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
$consolas = getConsolas();
$todosLosJuegos = getTodosLosJuegos();


$_SESSION['consolas'] = $consolas; //Todos los nombres de las consolas
$_SESSION['categorias'] = $categorias; //Todos los géneros cargados
$_SESSION['todosLosJuegos'] = $todosLosJuegos;

$mySmarty->assign("usuarioLogueado", $usuarioLogueado);
$mySmarty->assign("categorias", $categorias); //Categorias es todos los géneros
$mySmarty->assign("consolas", $consolas);
$mySmarty->display("index.tpl");

?>