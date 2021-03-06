<!DOCTYPE html>
<?php
ini_set('display_errors', 1);
error_reporting(E_ERROR);
require_once 'datos.php';
?>
<html>
    <head>
        <meta charset="utf-8" lang="es">
        <title>Guia de juegos</title>
        <link rel="stylesheet" href="./css/producto.css" type="text/css">
    </head>
    <body>
        <?php
        $prodId = 1;

        if (isset($_GET["prodId"])) {
            $prodId = $_GET["prodId"];
        }

        $vistasActuales = getVistasJuego($prodId);
        $vistasActuales['visualizaciones']++;
        AgregarVisitaJuego($prodId, $vistasActuales['visualizaciones']);
        $producto = getJuegoPorId($prodId);

        $mySmarty = getSmarty();
        $mySmarty->assign("producto", $producto);
        $mySmarty->display("producto.tpl");
        ?>
    </body>
</html>

