<!DOCTYPE html>
<?php
require_once 'datos.php';
ini_set('display_errors', 1);
error_reporting(E_ERROR);
session_start();
?>
<html>
    <head>
        <meta charset="utf-8" lang="es">
        <link rel="stylesheet" href="./css/productoDestacado.css" type="text/css">
    </head>
    <body>
        <?php
        $comentarios = getTodosLosComentarios();
        $idJuegoConMasComentarios = 0;
        $cantidadDeComentariosActuales = 0;
        $cantidaDeComentarios = 0;

        $juegos = getTodosLosJuegos();

        foreach ($juegos as $juego) {
            $cantidaDeComentarios = cantidadDeComentarios($juego['id']);
            if ($cantidadDeComentariosActuales <= $cantidaDeComentarios['count(*)']) {
                $cantidadDeComentariosActuales = $cantidaDeComentarios['count(*)'];
                $idJuegoConMasComentarios = $juego['id'];
            }
        }

        $prod = getJuegoPorId($idJuegoConMasComentarios);

        $categorias = getGeneros();
        
        $mySmarty = getSmarty();
        $mySmarty->assign("categorias", $categorias);
        $mySmarty->assign("prod", $prod);
        $mySmarty->display("productoDestacado.tpl");
        ?>
    </body>
</html>
