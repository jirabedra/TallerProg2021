<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Nueva pelicula</title>
    </head>
    <body>
        <h3> Creacion de pelicula </h3>
        <form method="POST" action="doGuardarProducto.php"
              enctype="multipart/form-data">
            <label>Titulo</label>
            <input type="text" name="titulo" />
            <br>
            <label>Genero</label>
            <select name="genero">
                {foreach from=$generos item=c}
                    <option value="{$c.id}">{$c.nombre}</option>
                {/foreach}
            </select>
            <br>
            <label>Fecha De Lanzamiento</label>
            <input type="date" name="fecha_lanzamiento" />
            <br>
            <label>Resumen</label>
            <input type="text" name="resumen" />
            <br>
            <label>Director y elenco principal</label>
            <input type="text" name="director" />
            <br>
            <br>
            <label>No es obligatorio poner trailer o puntuacion a las peliculas</label>
            <br>
            <br>
            <label>Trailer de youtube</label>
            <input type="text" name="youtube_trailer" />
            <br>
            <label>Puntuacion</label>
            <input type="number" name="puntuacion" />
            <br>

            {if (isset($err))}
                <label>{$err}</label>
            {/if}
            <br>
            <label>Imagen</label>
            <input type="file" accept=".jpg,.png" name="imagen" />
            <br>
            <br>
            <input type="submit" value="Guardar" />
        </form>
    </body>
</html>