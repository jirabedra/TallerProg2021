<h3>Comentarios</h3>
{foreach from=$comentarios item=$com}
    <p>{$com.texto}</p>
{/foreach}

<div id="paginacion">
    <button id="anterior" {if ($pagina<=0)}disabled{/if}>Anterior</button>
    Pagina {$pagina} de {$ultimaPagina}
    <button id="siguiente" {if ($pagina>=$ultimaPagina)}disabled{/if}>Siguiente</button>
</div>