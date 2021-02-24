<?php

require_once 'datos.php';
ini_set('display_errors',1);

$usuario = $_POST["usuario"];
$clave = $_POST["clave"];

$usuarioLogueado = login($usuario, $clave)["alias"];
$esAdmin = login($usuario, $clave)["es_admin"];

if($esAdmin == 1){
    setCookie('soyAdmin', $esAdmin, time() + (60*60*24));
} else {
     setCookie('soyAdmin', $esAdmin, time() + (60*60*24));
}

if (isset($usuarioLogueado) && strlen($usuarioLogueado) > 0) {
    session_start();
    $_SESSION["usuarioLogueado"] = $usuarioLogueado;
    header('location:index.php');
} else {
    header('location:login.php?err=1');
}

function dejarDeSerAdmin(){
    setCookie('soyAdmin', null, time());
}
