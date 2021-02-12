<!DOCTYPE html>
<?php 
    require_once 'datos.php';
    ini_set('display_errors', 1);
    session_start();
    $mySmarty = getSmarty();
    
    $usuarioLogueado = NULL;
    if(isset($_SESSION['usuarioLogueado'])) {
        $usuarioLogueado = $_SESSION['usuarioLogueado'];
    }
    
    $categorias = getCategorias();
    
    $catId = 1;
                        
    if(isset($_GET["catId"])) {
        $catId = $_GET["catId"];
    } else if(isset($_COOKIE["ultimaCategoria"])) {
        $catId = $_COOKIE["ultimaCategoria"];
    }

    $categoria = getCategoria($catId);
    if(isset($categoria)){
        setCookie('ultimaCategoria', $catId, time() + (60*60*24));
    }
    
    $productos = getProductosDeCategoria($catId);
    $consolas = getConsolas();
    
    $mySmarty->assign("usuarioLogueado", $usuarioLogueado);
    $mySmarty->assign("categorias", $categorias);
    $mySmarty->assign("categoria", $categoria);
    $mySmarty->assign("productos", $productos);
    $mySmarty->assign("consolas", $consolas);
    $mySmarty->display("index.tpl");
?>