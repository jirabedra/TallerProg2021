<?php

require_once 'datos.php';
//ini_set('display_errors', 1);

# crear instancia de smarty
$mySmarty = getSmarty();


$catId = 1;
if (isset($_COOKIE["ultimaCategoria"])) {
    $catId = $_COOKIE["ultimaCategoria"];
}

if (isset($_GET["catId"])) {
    $catId = $_GET["catId"];
}

$pag = 1;
if (isset($_GET["pag"])) {
    $pag = $_GET["pag"];
}

$categoria = getGeneroPorId($catId);
if (isset($categoria)) {
    setcookie("ultimaCategoria", $catId, time() + (60 * 60 * 24), "/");
}

# setear variables
$mySmarty->assign("categoria", $categoria);
$mySmarty->assign("peliculas", getProductosDeCategoria($catId, $pag, $_GET['busqueda']));
$mySmarty->assign("pagina", $pag);
$mySmarty->assign("paginas", cantidadPaginasCategoria($catId, $_GET['busqueda']));

# mostrar el template
$mySmarty->display('productos_paginados.tpl');

