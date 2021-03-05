<?php

require_once 'class.Conexion.BD.php';
require_once './libs/Smarty.class.php';

function abrirConexion() {
    $usuario = "root";
    $clave = "root";
    $conexion = new PDO("mysql:host=localhost;dbname=catalogo_juegos", $usuario, $clave);
    return $conexion;
}

function abrirConexion2() {
    $usuario = "root";
    $clave = "root";
    $conexion = new ConexionBD("mysql", "localhost", "catalogo_juegos", $usuario, $clave);
    $conexion->conectar();
    return $conexion;
}

function getGeneros() {
    $conexion = abrirConexion2();
    $sql = "SELECT * FROM generos";
    $conexion->consulta($sql);
    return $conexion->restantesRegistros();
}

function getConsolas() {
    $conexion = abrirConexion2();
    $sql = "SELECT * FROM consolas";
    $conexion->consulta($sql);
    return $conexion->restantesRegistros();
}

function getNombreConsolas() {
    $conexion = abrirConexion();
    $sql = "SELECT nombre FROM consolas";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute();
    $categoria = $sentencia->fetchAll();
    return $categoria;
}

function getGeneroPorId($id) {
    $conexion = abrirConexion();
    $sql = "SELECT * FROM generos WHERE id = :id";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam("id", $id, PDO::PARAM_INT);
    $sentencia->execute();
    $categoria = $sentencia->fetch(PDO::FETCH_ASSOC);
    return $categoria;
}

function getIdConsolaElPorNombre($nombre) {
    $conexion = abrirConexion();
    $sql = "SELECT id FROM consolas WHERE nombre = :nombre";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam("nombre", $nombre, PDO::PARAM_STR);
    $sentencia->execute();
    $categoria = $sentencia->fetch();
    return $categoria;
}

function getProducto($id) {
    $producto = NULL;
    foreach (getGeneros() as $cat) {
        foreach (getProductosDeCategoria($cat["id"]) as $prod) {
            if ($prod["id"] == $id) {
                $producto = $prod;
            }
        }
    }
    return $producto;
}

function getComentariosDeJuego($id) {
    $conexion = abrirConexion();
    $sql = "SELECT * FROM comentarios WHERE id_juego=:id";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam("id_juego", $id, PDO::PARAM_INT);
    $sentencia->execute();
    return $sentencia->fetch(PDO::FETCH_ASSOC);
}

function getJuegos($categoria, $pagina, $texto, $consola) {
    $textoDos = '%' . $texto . '%';
    $size = 5;
    $offset = $pagina * $size;
    $idGenero = $categoria["id"];

    $conexion = abrirConexion();
    $sql = "SELECT *
            FROM juegos_consolas
                INNER JOIN consolas ON ( juegos_consolas.id_consola = consolas.id )
                INNER JOIN juegos ON ( juegos_consolas.id_juego = juegos.id )
            WHERE consolas.id=:id AND id_genero=:idGenero AND juegos.nombre LIKE :texto LIMIT :offset, :size";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam("id", $consola, PDO::PARAM_INT);
    $sentencia->bindParam("idGenero", $idGenero, PDO::PARAM_INT);
    $sentencia->bindParam("texto", $textoDos, PDO::PARAM_STR);
    $sentencia->bindParam("offset", $offset, PDO::PARAM_INT);
    $sentencia->bindParam("size", $size, PDO::PARAM_INT);
    $sentencia->execute();
    return $sentencia->fetchAll(PDO::FETCH_ASSOC);
}

function getJuegoPorId($idJuego) {
    $conexion = abrirConexion();
    $sql = "SELECT * FROM juegos WHERE id=:idJuego";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam("idJuego", $idJuego, PDO::PARAM_INT);
    $sentencia->execute();
    return $sentencia->fetch(PDO::FETCH_ASSOC);
}

function ultimaPaginaDeJuegos($categoria, $texto) {
    $idGenero = $categoria["id"];
    $conexion = abrirConexion2();
    $params = array(
        array("idGenero", $idGenero, "int"),
        array("texto", '%' . $texto . '%', "string")
    );
    $sql = "SELECT count(*) as total FROM juegos WHERE id_genero=:idGenero AND nombre LIKE :texto";
    $conexion->consulta($sql, $params);
    $size = 5;
    $fila = $conexion->siguienteRegistro();
    $paginas = ceil($fila["total"] / $size) - 1;
    return $paginas;

    /* $conexion = abrirConexion();
      $sql = "SELECT count(*) as total FROM juegos WHERE id_genero=:idGenero AND nombre LIKE :texto";
      $sentencia = $conexion->prepare($sql);
      $sentencia->bindParam("id_genero", $idGenero, PDO::PARAM_INT);
      $sentencia->bindParam("texto",'%'.texto.'%', PDO::PARAM_STR);
      $sentencia->execute();
      $fila = $sentencia->fetch(PDO::FETCH_ASSOC);
     */
}

function getTodosLosJuegos() {
    $conexion = abrirConexion();
    $sql = "SELECT * FROM juegos";
    $sentencia = $conexion->prepare($sql);
    $sentencia->execute();
    return $sentencia->fetchAll(PDO::FETCH_ASSOC);
}

function getTodosLosJuegosDeGenero($id) {
    $conexion = abrirConexion();
    $sql = "SELECT * FROM juegos WHERE id_genero=:id";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam("id_juego", $id, PDO::PARAM_INT);
    $sentencia->execute();
    return $sentencia->fetchAll(PDO::FETCH_ASSOC);
}

function getTodosLosProductosDeConsola($id) {
    $conexion = abrirConexion();
    $sql = "SELECT juegos . *
FROM juegos_consolas
INNER JOIN consolas ON ( juegos_consolas.id_consola = consolas.id )
INNER JOIN juegos ON ( juegos_consolas.id_juego = juegos.id )
WHERE consolas.id=:id";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam("id", $id, PDO::PARAM_INT);
    $sentencia->execute();
    return $sentencia->fetch(PDO::FETCH_ASSOC);
}

function getIdGeneroPorNombre($genero) {
    $conexion = abrirConexion();
    $sql = "SELECT * FROM generos WHERE nombre=:genero";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam("genero", $genero, PDO::PARAM_STR);
    $sentencia->execute();
    return $sentencia->fetch(PDO::FETCH_ASSOC);
}

function getSmarty() {
    $mySmarty = new Smarty();
    $mySmarty->template_dir = 'Templates';
    $mySmarty->compile_dir = 'Templates_c';
    $mySmarty->cache_dir = 'Cache';
    $mySmarty->config_dir = 'Config';

    return $mySmarty;
}

function guardarCategoria($nombre) {
    $conexion = abrirConexion();
    $sql = "INSERT INTO categorias(nombre)VALUES(:nombre)";
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam("nombre", $nombre, PDO::PARAM_STR);
    $sentencia->execute();
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

function guardarJuego($nombre, $genero, $poster, $fecha, $resumen, $empresa, $link, $tipoPoster, $consolas) {
    $idGenero = getIdGeneroPorNombre($genero)["id"];
    $conexion = abrirConexion();
    $sql = 'INSERT INTO juegos(nombre, id_genero, fecha_lanzamiento, resumen, empresa, url_video) VALUES (:nombre, :genero, :fecha, :resumen, :empresa, :link)';
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam("nombre", $nombre, PDO::PARAM_STR);
    $sentencia->bindParam("genero", $idGenero, PDO::PARAM_INT);
    $sentencia->bindParam("fecha", $fecha, PDO::PARAM_STR);
    $sentencia->bindParam("resumen", $resumen, PDO::PARAM_STR);
    $sentencia->bindParam("empresa", $empresa, PDO::PARAM_STR);
    $sentencia->bindParam("link", $link, PDO::PARAM_STR);
    $resultado = $sentencia->execute();
    $pattern1 = "/jpeg/i";
    $pattern2 = "/png/i";
    $pattern3 = "/jpg/i";
    if (preg_match($pattern1, $tipoPoster)) {
        $tipoPoster = "jpeg";
    }
    if (preg_match($pattern2, $tipoPoster)) {
        $tipoPoster = "png";
    }
    if (preg_match($pattern3, $tipoPoster)) {
        $tipoPoster = "jpg";
    }
    $id = $conexion->lastInsertId();
    if (is_uploaded_file($poster)) {
        move_uploaded_file($poster, "./img_productos/" . $id . '.' . $tipoPoster);
        $nombrePoster = $id . '.' . $tipoPoster;
        $sql = 'UPDATE juegos SET poster=:nombrePoster WHERE id=:id';
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam("nombrePoster", $nombrePoster, PDO::PARAM_STR);
        $sentencia->bindParam("id", $id, PDO::PARAM_INT);
        $sentencia->execute();
    }

    agregarConsolasAJuego($id, $consolas);

    /*
     * dejar nombres de archivos con algun tipo de estandar. 
     * obtener con $_FILES[nombre]["type"] obtenemos si es .png o png o como sea, y concatenamos al nombre del archivo
     * persistirlas tanto localmente como en bd con este nombre que va a ser el id.tipoArchivo o nombre.tipoArchivo
     * una opcion es, dsp del insert, agregar un update que cambie el nombre del poster.
     */
    if ($resultado) {
        return true;
    } else {
        return false;
    };
}

function agregarConsolasAJuego($idJuego, $consolas) {
    foreach ($consolas as $value) {
        $idConsola = getIdConsolaElPorNombre($value);
        $conexion = abrirConexion();
        $sql = 'INSERT INTO juegos_consolas (id_juego, id_consola) VALUES (:id_juego, :id_consola)';
        $sentencia = $conexion->prepare($sql);
        $sentencia->bindParam("id_juego", $idJuego, PDO::PARAM_INT);
        $sentencia->bindParam("id_consola", $idConsola["id"], PDO::PARAM_INT);
        $pude = $sentencia->execute();
    }
}

function agregarConsolaAJuego($idJuego, $idConsola) {
    $conexion = abrirConexion();
    $sql = 'INSERT INTO juegos_consolas (id_juego, id_consola) VALUES (:id_jueg, :id_consol)';
    $sentencia = $conexion->prepare($sql);
    $sentencia->bindParam("id_jueg", $idJuego, PDO::PARAM_INT);
    $sentencia->bindParam("id_consol", $idConsola, PDO::PARAM_INT);
    $pude = $sentencia->execute();
    return $pude;
}
