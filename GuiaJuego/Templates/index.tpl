<!doctype html>
<html>
    <head>
        <meta charset="utf-8" lang="es">
        <title>Guia de videojuegos </title>
        <link rel="stylesheet" href="./css/index.css" type="text/css">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="./js/main.js"></script>
    </head>
    <body>
        {include file="encabezado.tpl"}
        <div id="menu">
            <a href="#">Página principal</a>
            {if isset($usuarioLogueado)}
                Hola, {$usuarioLogueado} <a href="./doLogout.php">Logout</a>
                {if ($smarty.cookies.soyAdmin == 1)}
                    <a href="./altaJuego.php">Nuevo juego</a>
                    <a href="./agregarConsola.php">Agregar consola juego</a>
                {/if}
            {else}
                <a href="./login.php">Inicio de sesión</a>
                <a href="./registro.php">Registrarme</a>
            {/if}
            <a href="#">Contacto</a>
        </div>
        <div id="buscador">

            <select class="criterio-orden" id="criterio-orden">
                <option value=1>Fecha de lanzamiento Ascendente</option>
                <option value=2>Fecha de lanzamiento Descendente</option>
                <option value=3>Puntaje Ascendente</option>
                <option value=4>Puntaje Descendente</option>
                <option value=5>Cantidad de visualizaciones Ascendente</option>
                <option value=6>Cantidad de visualizaciones Descendente</option>
            </select>

            <label class="consolas-filtro-label" for="texto-filtro">Consolas:</label>

            <select class="consolas-filtro" id="consolas-filtro">
                {foreach from=$consolas item=con}
                    <option value={$con.id}>{$con.nombre}</option>
                {/foreach}
            </select>

            <label class="genero-filtro-label" for="texto-filtro">Generos:</label>

            <select class="genero-filtro" id = "genero-filtro">
                {foreach from=$categorias item=cat}
                    <option value={$cat.id}>{$cat.nombre}</option>
                {/foreach}
            </select>

            <label for="buscar">Ingresa tu búsqueda: </label>
            <input type="text" id = "texto">
            <input id = "buscar" type="button" value="Buscar">
        </div>                                                                                                                                                                           
        <div id="productos">

        </div>

        <div id="productoDestacado">

        </div>
    </body>
</html>   