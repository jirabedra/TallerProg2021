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
        <form action="doAltaJuego.php" method="POST" enctype="multipart/form-data">
            Nombre: <input required type="text" name="nombre" /><br>
            Genero: <select name="genero">
                <?php
                $categorias = $_SESSION['categorias'];
                foreach ($categorias as $cat) {
                    echo '<option value="' . $cat["nombre"] . '">' . $cat["nombre"] . '</option>';
                }
                ?>
            </select><br>

            Consolas: 
            <select multiple name="consolas[]">
                <?php
                $consolas = $_SESSION['consolas'];
                foreach ($consolas as $con) {
                    echo '<option value="' . $con["nombre"] . '">' . $con["nombre"] . '</option>';
                }
                ?>
            </select><br>

            Poster: <input type="file" accept=".jpg,.png" name="poster" /><br> 
            Fecha de lanzamiento: <input type="date" name="fecha" /><br>
            Resumen: <input type="text" name="resumen" /><br>
            Empresa: <input type="text" name="empresa" /><br>
            Link a youtube: <input type="text" name="link" /><br>
            <!-- AGREGAR CONSOLAS DISPONIBLES -->
            <input type="submit" value="Ingresar" />
            <?php
            if (isset($_GET["err"]) && $_GET["err"] == 1) {
                echo('<label>Juego ya existente.</label>');
                echo($_GET["err"]);
            }
            ?>
        </form>
    </body>
</html>
