<!DOCTYPE html>
<?php 
    ini_set('display_errors', 1);
    require_once 'datos.php';
?>
<html>
	<head>
		<meta charset="utf-8" lang="es">
		<title>Tu Tienda Online</title>
		<link rel="stylesheet" href="./css/ventas.css" type="text/css">
	</head>
	<body>
		<?php 
                    $prodId = 1;
                    
                    if(isset($_GET["prodId"])) {
                        $prodId = $_GET["prodId"];
                    }
                    
                    $producto = getProducto($prodId);
                    
                        $mySmarty = getSmarty();
                        $mySmarty->assign("producto", $producto);
                        $mySmarty->display("producto.tpl");
                                    
                ?>
	</body>
</html>

