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
    $clave="root";
    
    $conexion = new PDO("mysql:host=localhost;dbname=catalogo_juegos", $usuario, $clave);
    
    //$conexion->conectar(); 
    
    return $conexion;
}

function abrirConexion2() {
    $usuario = "root";
    $clave="root";
    
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

function getConsolas(){
    $conexion = abrirConexion2();
    
    $sql = "SELECT * FROM consolas";
    $conexion->consulta($sql);
    
     return $conexion->restantesRegistros();
}

function getCategoria($id){
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
    if($idCategoria == 1) {
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
    } else if($idCategoria == 2) {
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

function getProducto($id){
    $producto = NULL;
    foreach(getCategorias() as $cat) {
        foreach(getProductosDeCategoria($cat["id"]) as $prod) {
            if($prod["id"] == $id) {
                $producto = $prod;
            }
        }
    }
   
    return $producto;
}

function login($usuario, $clave) {
    
    $conexion = abrirConexion();
    $sql = "SELECT * FROM usuarios WHERE email = :usuario AND password = :clave";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam("email", $usuario, PDO::PARAM_INT);
    $sentencia->bindParam("password", $clave, PDO::PARAM_INT);
    $sentencia->execute();
    $usuarioEncontrado = $sentencia->fetch(PDO::FETCH_ASSOC);
    echo($usuarioEncontrado);
    
    if(isset($usuarioEncontrado)){
            return $usuarioEncontrado;
    } else {
        return NULL;
    }
}

function logout() {
    unset($_SESSION['usuarioLogueado']);
    session_destroy();
}

function getSmarty(){
    $mySmarty = new Smarty();
    $mySmarty->template_dir = 'Templates';
    $mySmarty->compile_dir = 'Templates_c';
    $mySmarty->cache_dir = 'Cache';
    $mySmarty->config_dir = 'Config';
    
    return $mySmarty;
}