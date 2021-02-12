<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Nueva categoria</title>
    </head>
    <body>
        <form method="POST" action="doGuardarCategoria.php">
            <label>Nombre</label>
            <input type="hidden" name="id" value="{$id}" />
            <input type="text" name="nombre" value="{$nombre}" />
            <br>
            <br>
            {if (isset($err))}
                <label>{$err}</label>
            {/if}
            <br>
            <input type="submit" value="Guardar" />
        </form>
    </body>
</html>