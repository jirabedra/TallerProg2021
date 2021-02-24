<a href="producto.php?prodId={$prod.id}">
    <div class="producto">
        <img src="./img_productos/{$prod.poster}" alt="Poster de este juego">
        <span class="nombre-producto">{$prod.nombre}</span>
        <p>{$prod.resumen}</p>
        <p> {$categoria["nombre"]} </p>
        <span class="precio-producto">U$S {$prod.precio}</span>
    </div>
</a>