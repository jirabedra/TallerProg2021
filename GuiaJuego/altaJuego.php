<!DOCTYPE html>
<?php 
    require_once 'datos.php';
?>
<html>
	<head>
		<meta charset="utf-8" lang="es">
		<title>Tu tienda Online</title>
		<link rel="stylesheet" href="./css/ventas.css" type="text/css">
	</head>
	<body>
            <form action="doAltaJuego.php" method="POST">
                Nombre: <input type="text" name="nombre" /><br>
                Genero: <select name="generos">
                    <option>aaaaa</option>
                    </select>/><br>
                Poster: <input type="file" accept=".jpg,.png" name="poster" /><br> 
                Fecha de lanzamiento: <input type="date" name="fecha" /><br>
                Resumen: <input type="text" name="resumen" /><br>
                Empresa: <input type="text" name="empresa" /><br>
                Link a youtube: <input type="text" name="link" /><br>
                <!-- AGREGAR CONSOLAS DISPONIBLES -->
                <input type="submit" value="Ingresar" />
                <?php 
                    if(isset($_GET["err"]) && $_GET["err"]==1) {
                        echo('<label>Juego ya existente.</label>');
                        echo($_GET["err"]);
                    }
                    if(isset($_GET["err"]) && $_GET["err"]==2) {
                        echo('<label>La contraseña debe tener 8 caracteres o más.</label>');
                    }
                ?>
            </form>
	</body>
</html>
