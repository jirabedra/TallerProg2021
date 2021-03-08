<?php

require_once 'datos.php';
ini_set('display_errors', 1);
error_reporting(E_ERROR);
$mySmarty = getSmarty();

$catId = 1;
if (isset($_GET["catId"])) {
    $catId = $_GET["catId"];
}
$categoria = getGeneroPorId($catId);

$pag = 0;
if (isset($_GET["pag"])) {
    $pag = $_GET["pag"];
}

$consola = 1;
if (isset($_GET["consola"])) {
    $consola = $_GET["consola"];
}

$texto = "";
if (isset($_GET["texto"])) {
    $texto = $_GET["texto"];
}

$criterioOrden = 1;
if (isset($_GET["criterioOrden"])) {
    $criterioOrden = $_GET["criterioOrden"];
}

$categorias = getGeneros();
$consolas = getConsolas();


$_SESSION['consolas'] = $consolas; //Todos los nombres de las consolas
$_SESSION['categorias'] = $categorias; //Todos los géneros cargados
$productos = NULL;
switch ($criterioOrden) {
    case 1:
        $productos = getJuegosOrdenadosPorFechaLanzamientoAsc($categoria, $pag, $texto, $consola);
        break;
    case 2:
        $productos = getJuegosOrdenadosPorFechaLanzamientoDesc($categoria, $pag, $texto, $consola);
        break;
    case 3:
        $productos = getJuegosOrdenadosPorPuntuacionPorAsc($categoria, $pag, $texto, $consola);
        break;
    case 4:
        $productos = getJuegosOrdenadosPorPuntuacionDesc($categoria, $pag, $texto, $consola);
        break;
    case 5:
        $productos = getJuegosOrdenadosPorVisualizacionesAsc($categoria, $pag, $texto, $consola);
        break;
    case 6:
        $productos = getJuegosOrdenadosPorVisualizacionesDesc($categoria, $pag, $texto, $consola);
        break;
    default:
        break;
}
//$productos = getJuegos($categoria, $pag, $texto, $consola);
$ultimaPagina = ultimaPaginaDeJuegos($categoria, $texto);

# setear variables
$mySmarty->assign("pagina", $pag);
$mySmarty->assign("ultimaPagina", $ultimaPagina);
$mySmarty->assign("categoria", $categoria);
$mySmarty->assign("productos", $productos);
$mySmarty->assign("categorias", $categorias);
$mySmarty->display('productos_paginados.tpl');
