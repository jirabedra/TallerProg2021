<!doctype html>
<html>
    <head>
        <meta charset="utf-8" lang="es">
        <title>{$producto.nombre}</title>
        <link rel="stylesheet" href="./css/producto.css" type="text/css">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script type="text/javascript" src="./js/producto.js"></script>
    </head>
    <body>
        <a href="./index.php">Página principal</a>
        {include file="encabezado.tpl"}
        {if isset($producto)}
            <h1>{$producto.nombre}</h1>
            <img src="./img_productos/{$producto.poster}" alt="Poster de este juego">
            <p>{$producto.descripcion}</p>
            <label> Fecha de lanzamiento: {$producto.fecha_lanzamiento}</label>
            <p></p>
            <label> Descripcion: {$producto.resumen}</label>
            <p></p>
            <label> Empresa: {$producto.empresa}</label>
            <p></p>
            <label> Cantidad de visitas: {$producto.visualizaciones}</label> 
            <p></p>
            <p>Este juego se puede jugar en:</p>
            {foreach from=$consolasDelJuego item=$con}
                <p>{$con.nombre}</p>
            {/foreach}
            <p></p>
            {assign var="linkUtil" value="v="|explode:$producto.url_video} <!--Esto es un split .-. -->
            {if ({$linkUtil|@count} == 2)} <!-- Usa un contador de php (por eso el @) y se fija si hizo el split (si no se hizo el largo es 0) -->
                <h4>Trailer de youtube</h4> <!-- Aca agarra la ultima parte del link de youtube (que es lo unico que sirve) y lo pone en el formato de youtube -->
                <div><iframe width="560" height="315" src="https://www.youtube.com/embed/{$linkUtil[1]}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                    {/if}

            <form action="doRegistroComentario.php" method="POST">    
                <label for="ingresarComentario">Ingresa tu comentario: </label>
                <input required type="text" id = "texto" name="texto">
                <p>Puntuacion</p>
                <select class="puntuacionJuego" id="puntuacionJuego" name="puntuacionJuego">
                    <option value=1>1</option>
                    <option value=2>2</option>
                    <option value=3>3</option>
                    <option value=4>4</option>
                    <option value=5>5</option>
                </select>

                <input type="hidden" name="prodId" value={$producto.id} />

                <input type="submit" value="Ingresar" />
            </form>

            <select class="productoId" id="productoId" name="productoId">
                <option value={$producto.id}>{$producto.id}</option>
            </select>

            <div id="comentarios">

            </div>

        {else}
            <h1>Juego Inexistente</h1>
        {/if}
    </body>
</html>
