<!doctype html>
<html>
    <head>
        <title>{$producto.nombre}</title>
    </head>
    <body>
        {include file="encabezado.tpl"}
        {if isset($producto)}
            <h1>{$producto.nombre}</h1>
            <p>{$producto.descripcion}</p>
            <label> Precio U$S {$producto.precio}</label>
        {else}
            <h1>Producto Inexistente</h1>
        {/if}
    </body>
</html>

