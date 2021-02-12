<!doctype html>
<html>
    <head>
		<meta charset="utf-8" lang="es">
                <title>Guia de videojuegos </title>
		<link rel="stylesheet" href="./css/index.css" type="text/css">
    </head>
    <body>
        {include file="encabezado.tpl"}
        <div id="menu">
			<a href="#">Página principal</a>
                        {if isset($usuarioLogueado)}
                            Hola, {$usuarioLogueado.nombre} <a href="./doLogout.php">Logout</a>
                            <a href="./nuevaCategoria.php">Nueva Categoría</a>
                        {else}
                             <a href="./login.php">Inicio de sesión</a>
                        {/if}
			<a href="./contacto.html">Contacto</a>
		</div>
                       

		
		</div>
                <div id="buscador">
                    
                    <label class="consolas-filtro-label" for="texto-filtro">Consolas:</label>

			<select class="consolas-filtro" id="cars">
                            {foreach from=$consolas item=con}
				<option value={$con.nombre}>{$con.nombre}</option>
                            {/foreach}
			</select>
                        
                        <label class="genero-filtro-label" for="texto-filtro">Generos:</label>

			<select class="genero-filtro">
				<option value="Todos">Todos</option>
				<option value="Infantiles">Infantiles</option>
				<option value="Suspenso">Suspenso</option>
				<option value="Acción">Acción</option>
  				<option value="Indie">Indie</option>
  				<option value="Terror">Terror</option>
			</select>
                        
			<label for="buscar">Ingresa tu búsqueda: </label>
			<input type="text">
			<input type="button" value="Buscar">
		</div>      
                        <div id="productos">
                                {if $categoria}
                                    <h3>{$categoria.nombre}</h3>
                                    {foreach from=$productos item=prod}
                                        {include file="tarjeta_producto.tpl" prod=$prod}
                                    {/foreach}
                                {else}
                                     <h3>Categoría Inexistente</h3>
                                {/if}
                            
                        </div>
    </body>
</html>   