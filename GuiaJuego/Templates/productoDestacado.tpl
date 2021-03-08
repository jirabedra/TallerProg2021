<head>
    <meta charset="utf-8" lang="es">
    <link rel="stylesheet" href="./css/tarjeta_producto.css" type="text/css">
</head>
<a href="producto.php?prodId={$prod.id}&cantidadVistas={$prod.visualizaciones}" >
    <div class="producto" style="border-style: solid; border-color: red;">
        <img src="./img_productos/{$prod.poster}" alt="Poster de este juego">
        <p></p>
        <span class="nombre-producto">{$prod.nombre}</span>
        {$idCat = $prod.id_genero - 1}
        <p></p>
        <span class="genero-producto">Genero: {$categorias[$idCat]["nombre"]}</span>
        <p></p>
        <span class="puntuacion-producto">Puntuación: {$prod.puntuacion}</span>
    </div>
</a>