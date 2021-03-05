<!DOCTYPE html>
<?php
require_once 'datos.php';
session_start();
error_reporting(E_ERROR);
?>
<html>
    <head>
        <meta charset="utf-8" lang="es">
        <title>Tu tienda Online</title>
        <link rel="stylesheet" href="./css/ventas.css" type="text/css">
    </head>
    <body>
        <form action="doAgregarConsolaAJuego.php" method="POST" enctype="multipart/form-data">
            Consola:
            <select name="idConsola">
                <?php
                $consolas = $_SESSION['consolas'];
                foreach ($consolas as $con) {
                    echo '<option value="' . $con["id"] . '">' . $con["nombre"] . '</option>';
                }
                ?>
            </select><br>
            Juego:
           <select name="idJuego">
                <?php
                $todosLosJuegos = $_SESSION['todosLosJuegos'];
                foreach ($todosLosJuegos as $todosJuegos) {
                    echo '<option value="' . $todosJuegos["id"] . '">' . $todosJuegos["nombre"] . '</option>';
                }
                ?>
            </select><br>
            
            <input type="submit" value="Ingresar" />
            
            <?php
            if (isset($_GET["err"]) && $_GET["err"] == 1) {
                echo('<label>Seleccione un juego o consola diferente.</label>');
                echo($_GET["err"]);
            }
            ?>
        </form>
    </body>
</html>