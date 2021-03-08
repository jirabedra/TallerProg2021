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
        <title>Guia de juegos</title>
        <link rel="stylesheet" href="./css/producto.css" type="text/css">
    </head>
    <body>
        <?php
        $prodId = 1;

        if (isset($_GET["prodId"])) {
            $prodId = $_GET["prodId"];
        }

        actualizarPuntuacionJuego($prodId);
        
        $texto = "";
        if (isset($_GET["texto"])) {
            $texto = $_GET["texto"];
        }

        $puntuacion = 0;
        if (isset($_GET["puntuacion"])) {
            $puntuacion = $_GET["puntuacion"];
        }
        
        $intencionDeComentar = false;
        if (isset($_GET["intencionDeComentar"])) {
            $intencionDeComentar = $_GET["intencionDeComentar"];
        }
        
        $cantidadVistas = 0;

        if (isset($_GET['cantidadVistas'])) {
            $cantidadVistas = $_GET['cantidadVistas'];
        }

        $vistasActuales = getVistasJuego($prodId);

        if ($cantidadVistas == $vistasActuales['visualizaciones']) {
            $vistasActuales['visualizaciones'] ++;
            AgregarVisitaJuego($prodId, $vistasActuales['visualizaciones']);
        }

        $producto = getJuegoPorId($prodId);
        $consolasDelJuego = getNombreConsolasDelJuego($prodId);

        $usuarioLogueadoId = NULL;
        if (isset($_SESSION['usuarioLogueadoId'])) {
            $usuarioLogueadoId = $_SESSION['usuarioLogueadoId'];
        }

        $comentarios = getTodosLosComentarios();

        $noComento = true;
        foreach ($comentarios as $comentario) {
            if ($comentario['id_usuario'] == $usuarioLogueadoId) {
                $noComento = false;
            }
        }

        if ($usuarioLogueadoId == NULL || $usuarioLogueadoId = '') {
            $noComento = false;
        }

        if ($intencionDeComentar && $noComento) {
            agregarComentarioYPuntuacion($usuarioLogueadoId, $prodId, $texto, $puntuacion);
            actualizarPuntuacionJuego($prodId);
        }

        $mySmarty = getSmarty();
        $mySmarty->assign("producto", $producto);
        $mySmarty->assign("noComento", $noComento);
        $mySmarty->assign("consolasDelJuego", $consolasDelJuego);
        $mySmarty->display("producto.tpl");
        ?>
    </body>
</html>

