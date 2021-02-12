<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Nuevo genero</title>
    </head>
    <body>
        <h1>Mantenimiento de categorias</h1>
        <a href="editarCategoria.php">Crear Nueva</a>
        <table>
            <tr>
                <td>Nombre</td>
                <td></td>
                <td></td>
            </tr>
            {foreach from=$categorias item=cat}
                <tr>
                    <td>{$cat.nombre}</td>
                    <td>
                        <a href="editarCategoria.php?id={$cat.id}">editar</a>
                    </td>
                    <td>
                        <a href="doEliminarCategoria.php?id={$cat.id}">eliminar</a>
                    </td>
                </tr>
            {/foreach}
        </table>
    </body>
</html>