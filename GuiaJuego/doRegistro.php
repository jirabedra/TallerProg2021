<?php

require_once 'datos.php';
ini_set('display_errors', 1);

$usuario = $_POST["usuario"];
$clave = $_POST["clave"];
$alias = $_POST["alias"];



registrarUsuario($usuario, $clave, $alias);

//VER CALCULO DE SEGURIDAD
/*
 * ---------------------------------------------------------------------------
 */
function registrarUsuario($usuario, $clave, $alias) {
    if (strlen($clave) < 8) {
        header('location:registro.php?err=2');
    } else {
        $pudeRegistrar = guardarUsuario($usuario, $clave, $alias);
        if ($pudeRegistrar == true) {
            header('location:index.php');
        } else {
            header('location:registro.php?err=1');
        }
    }
}
