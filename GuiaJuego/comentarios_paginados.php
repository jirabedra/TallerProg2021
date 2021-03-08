<?php

require_once 'datos.php';
ini_set('display_errors', 1);
error_reporting(E_ERROR);
$mySmarty = getSmarty();

$prodId = 1;
if (isset($_GET["prodId"])) {
    $prodId = $_GET["prodId"];
}

$pag = 0;
if (isset($_GET["pag"])) {
    $pag = $_GET["pag"];
}

$comentarios = comentariosDeJuego($prodId, $pag);

$ultimaPagina = ultimaPaginaDeComentario($prodId);

# setear variables
$mySmarty->assign("pagina", $pag);
$mySmarty->assign("comentarios", $comentarios);
$mySmarty->assign("ultimaPagina", $ultimaPagina);
$mySmarty->display('comentarios_paginados.tpl');
