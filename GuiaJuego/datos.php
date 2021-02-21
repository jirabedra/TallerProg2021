<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'class.Conexion.BD.php';
require_once './libs/Smarty.class.php';

function abrirConexion() {
    $usuario = "root";
    $clave = "root";

    $conexion = new PDO("mysql:host=localhost;dbname=catalogo_juegos", $usuario, $clave);

    //$conexion->conectar(); 

    return $conexion;
}

function abrirConexion2() {
    $usuario = "root";
    $clave = "root";

    $conexion = new ConexionBD("mysql", "localhost", "catalogo_juegos", $usuario, $clave);

    $conexion->conectar();

    return $conexion;
}

function getCategorias() {
    $conexion = abrirConexion2();

    $sql = "SELECT * FROM consolas";
    $conexion->consulta($sql);

    return $conexion->restantesRegistros();
    //return $categorias;
}

function getConsolas() {
    $conexion = abrirConexion2();

    $sql = "SELECT * FROM consolas";
    $conexion->consulta($sql);

    return $conexion->restantesRegistros();
}

function getCategoria($id) {
    $conexion = abrirConexion();
    $sql = "SELECT * FROM categorias WHERE id = :id";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam("id", $id, PDO::PARAM_INT);
    $sentencia->execute();
    $categoria = $sentencia->fetch(PDO::FETCH_ASSOC);

    return $categoria;
}

function guardarCategoria($nombre) {
    $conexion = abrirConexion();
    $sql = "INSERT INTO categorias(nombre)VALUES(:nombre)";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam("nombre", $nombre, PDO::PARAM_STR);
    $sentencia->execute();
}

function getProductosDeCategoria($idCategoria) {
    $productos = array();
    if ($idCategoria == 1) {
        $productos[] = array("id" => 1,
            "nombre" => "Pentium III",
            "descripcion" => "procesador muy lento y viejo",
            "precio" => 10,
            "imagen" => "logo.png");
        $productos[] = array("id" => 2,
            "nombre" => "Pentium IV",
            "descripcion" => "procesador lento y viejo",
            "precio" => 15,
            "imagen" => "logo.png");
        $productos[] = array("id" => 3,
            "nombre" => "i3",
            "descripcion" => "procesador lento y moderno",
            "precio" => 20,
            "imagen" => "logo.png");
    } else if ($idCategoria == 2) {
        $productos[] = array("id" => 4,
            "nombre" => "4GB DDR 2",
            "descripcion" => "poca memoria y lenta",
            "precio" => 50,
            "imagen" => "logo.png");
        $productos[] = array("id" => 5,
            "nombre" => "8 GB DDR 3",
            "descripcion" => "bastante memoria y velocidad normal",
            "precio" => 120,
            "imagen" => "logo.png");
        $productos[] = array("id" => 6,
            "nombre" => "16 GB DDR5",
            "descripcion" => "mucha memoria y super rapida",
            "precio" => 195,
            "imagen" => "logo.png");
    }
    return $productos;
}

function getProducto($id) {
    $producto = NULL;
    foreach (getCategorias() as $cat) {
        foreach (getProductosDeCategoria($cat["id"]) as $prod) {
            if ($prod["id"] == $id) {
                $producto = $prod;
            }
        }
    }

    return $producto;
}

function login($usuario, $clave) {

    $conexion = abrirConexion();
    $sql = "SELECT * FROM usuarios WHERE email=:usuario AND password=:clave";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam("clave", $clave, PDO::PARAM_STR);
    $sentencia->bindParam("usuario", $usuario, PDO::PARAM_STR);
    $sentencia->execute();
    return $sentencia->fetch(PDO::FETCH_ASSOC);
}

function logout() {
    unset($_SESSION['usuarioLogueado']);
    setCookie("esAdmin", null, time());
    session_destroy();
}

function getSmarty() {
    $mySmarty = new Smarty();
    $mySmarty->template_dir = 'Templates';
    $mySmarty->compile_dir = 'Templates_c';
    $mySmarty->cache_dir = 'Cache';
    $mySmarty->config_dir = 'Config';

    return $mySmarty;
}

function guardarUsuario($usuario, $clave, $alias) {
    $conexion = abrirConexion();
    $sql = 'INSERT INTO usuarios(email, password, alias) VALUES (:usuario, :clave, :alias)';
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam("usuario", $usuario, PDO::PARAM_STR);
    $sentencia->bindParam("clave", $clave, PDO::PARAM_STR);
    $sentencia->bindParam("alias", $alias, PDO::PARAM_STR);
    $resultado = $sentencia->execute();
    if ($resultado) {
        return true;
    } else {
        return false;
    };
}

function guardarJuego($nombre,  $poster, $fecha, $resumen, $empresa, $link) {
    $conexion = abrirConexion();
    $sql = 'INSERT INTO juegos(nombre, id_genero, fecha_lanzamiento, resumen, empresa, url_video) VALUES (:nombre, 1, :fecha, :resumen, :empresa, :link)';
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam("nombre", $nombre, PDO::PARAM_STR);
    $sentencia->bindParam("fecha", $fecha, PDO::PARAM_STR);
    $sentencia->bindParam("resumen", $resumen, PDO::PARAM_STR);
    $sentencia->bindParam("empresa", $empresa, PDO::PARAM_STR);
    $sentencia->bindParam("link", $link, PDO::PARAM_STR);
    $resultado = $sentencia->execute();
    /*$id = $conexion->ultimoIdInsert();
    if (is_uploaded_file($poster)) {
        move_uploaded_file($poster, "./img_productos/" . $id);
    }*/
    if ($resultado) {
        return true;
    } else {
        return false;
    };
}
