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
            <form action="doLogin.php" method="POST">
                Usuario: <input type="text" name="usuario" /><br>
                Clave: <input type="password" name="clave" /><br>
                <input type="submit" value="Ingresar" />
                <?php 
                    if(isset($_GET["err"])) {
                        echo('<label>Usuario o clave incorrecto.</label>');
                    }
                ?>
            </form>
	</body>
</html>