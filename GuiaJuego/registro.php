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
            <form action="doRegistro.php" method="POST">
                Email: <input type="text" name="usuario" /><br>
                Clave: <input type="password" name="clave" /><br>
                Alias: <input type="text" name="alias" /><br>
                <input type="submit" value="Ingresar" />
                <?php 
                    if(isset($_GET["err"]) && $_GET["err"]==1) {
                        echo('<label>Usuario ya existente.</label>');
                    }
                    if(isset($_GET["err"]) && $_GET["err"]==2) {
                        echo('<label>La contraseña debe tener 8 caracteres o más.</label>');
                    }
                ?>
            </form>
	</body>
</html>
