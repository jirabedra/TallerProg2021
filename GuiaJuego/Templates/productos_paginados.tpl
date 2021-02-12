
<h3>{$categoria.nombre}</h3>

{foreach from=$peliculas item=pelicula}
    {include file="tarjeta_producto.tpl" pelicula=$pelicula}
{/foreach}
<div id="paginacion">
    <button id="anterior" {if ($pagina<=1)}disabled{/if}>Anterior</button>
    Pagina {$pagina} de {$paginas}
    <button id="siguiente" {if ($pagina>=$paginas)}disabled{/if}>Siguiente</button>
</div>
