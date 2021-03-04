<!doctype html>
<html>
    <head>
        <title>{$producto.nombre}</title>
    </head>
    <body>
        <a href="./index.php">Página principal</a>
        {include file="encabezado.tpl"}
        <p>{$producto}</p>
        {if isset($producto)}
            <img src="./img_productos/{$prod.poster}" alt="Poster de este juego">
            <h1>{$producto.nombre}</h1>
            <p>{$producto.descripcion}</p>
            <label> Precio U$S {$producto.precio}</label>
            {assign var="linkUtil" value="v="|explode:$pelicula.youtube_trailer} <!--Esto es un split .-. -->
            {if ({$linkUtil|@count} == 2)} <!-- Usa un contador de php (por eso el @) y se fija si hizo el split (si no se hizo el largo es 0) -->
                <h4>Trailer de youtube</h4> <!-- Aca agarra la ultima parte del link de youtube (que es lo unico que sirve) y lo pone en el formato de youtube -->
                <div><iframe width="560" height="315" src="https://www.youtube.com/embed/{$linkUtil[1]}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                    {/if}
                {else}
            <h1>Juego Inexistente</h1>
        {/if}
    </body>
</html>
