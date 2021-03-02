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

$texto = "";
if (isset($_GET["texto"])) {
    $texto = $_GET["texto"];
}

if(isset($categoria)){
    setCookie('ultimaCategoria', $catId, time() + (60*60*24));
}

$categorias = getGeneros();
$consolas = getNombreConsolas();

$_SESSION['consolas'] = $consolas; //Todos los nombres de las consolas
$_SESSION['categorias'] = $categorias; //Todos los géneros cargados

$productos = getTodosLosJuegos();
$ultimaPagina = ultimaPaginaDeJuegos($categoria, $texto);
/*
foreach ($categorias as $cat) {
    print_r($cat);
    print_r("   ");
}
*/
# setear variables
$mySmarty->assign("pagina", $pag);
$mySmarty->assign("ultimaPagina", $ultimaPagina);
$mySmarty->assign("categoria", $categoria);
$mySmarty->assign("productos", $productos);
$mySmarty->assign("categorias", $categorias);
$mySmarty->display('productos_paginados.tpl');
