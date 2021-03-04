<h3>{$categoria["nombre"]}</h3>
{foreach from=$productos item=prod}
    {include file="tarjeta_producto.tpl" prod=$prod categorias=$categorias}
{/foreach}

<div id="paginacion">
    <button id="anterior" {if ($pagina<=0)}disabled{/if}>Anterior</button>
    Pagina {$pagina} de {$ultimaPagina}
    <button id="siguiente" {if ($pagina>=$ultimaPagina)}disabled{/if}>Siguiente</button>
</div>