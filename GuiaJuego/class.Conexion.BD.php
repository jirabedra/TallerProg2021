<?php

class ConexionBD
{
	var $dsn;
	var $usuario;
	var $clave;
	var $conexion;
	var $sentencia;
	var $ultimoError;
	var $debugMode;
	
	/*
	 *	Constructor de la clase
	 */
	function __construct($motor, $servidor, $db, $usuario, $clave, $debug=false){
		//lista de servidores de datos soportados, agrear aquí para nuevos motores los DSN correspondientes.
		switch (strtolower($motor)){
			case "mysql":
				$this->dsn = "mysql:dbname=" . $db . ";host=" . $servidor;
				break;
		}
		$this->usuario = $usuario;
		$this->clave = $clave;
		$this->debugMode = $debug;
	}

	/*
	 *	Método que establece la conexión con los datos pasados al constructor
	 */
	function conectar(){
 		try{ 
			$this->conexion = new PDO($this->dsn, $this->usuario, $this->clave);
			//determino si los errores son por warnings a pantalla o por excepciones
			if ($this->debugMode){
				$this->conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
			}
			else{
				$this->conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			}
			$retorno = true;
		}
		catch (PDOException $e){
			//guardo el error generado
			$this->conexion = null;
			$this->ultimoError = "{" . date("d/m/Y H:i:s") . "} " . $e->getMessage();
			$retorno = false;
		}
		return $retorno;
	}
	
	/*
	 *	Método que elimina la conexión establecida
	 */
	function desconectar(){
		unset($this->conexion);
	}
	
	/*
	 *	Método que retorna el último error generado
	 */
	function ultimoError(){
		return $this->ultimoError;
	}
	
	/*
	 *	Método que ejecuta una SQL contra la conexión establecida
	 *		La sql tiene que tener parametrizado los valores a utilizar en ella como :variable	
	 *              Ej: SELECT * FROM CLIENTES WHERE id = :id
	 *		La lista de parámetros es un array con los los valores que deben venir en el siguiente formato {parametro, valor, tipo_de_datos, largo}
	 *		Los tipos posibles: bool, int, string
	 */
	function consulta($sql,$parametros = array()){
		try{
			$this->sentencia = $this->conexion->prepare($sql,array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			//tipos posibles de datos recibidos para los argumentos
			foreach ($parametros as $parametro){
				switch ($parametro[2]){
					case "bool":
						$tipo = PDO::PARAM_BOOL;
						break;
					case "int":
						$tipo = PDO::PARAM_INT;
						break;
					case "string":
						$tipo = PDO::PARAM_STR;
						break;
					
				}
				//paso los parámetros para que sean filtrados antes de incluirlos en la SQL
				$this->sentencia->bindParam($parametro[0], $parametro[1], $tipo, $parametro[3]);
			}
			$this->sentencia->execute();
			$retorno = true;
		}
		catch (PDOException $e){
			//guardo el error generado
			$this->sentencia = null;
			$this->ultimoError = "{" . date("d/m/Y H:i:s") . "} " . $e->getMessage();
			$retorno = false;
		}
		return $retorno;
	}
	/*
	 *	Método que retorna el ultimo id ingresado
	 */
	function ultimoIdInsert(){
		try{
			$retorno = $this->conexion->lastInsertId();
		}
		catch (PDOException $e){
			//guardo el error generado
			$this->ultimoError = "{" . date("d/m/Y H:i:s") . "} " . $e->getMessage();
			$retorno = false;
		}
		return $retorno;
	}
	/*
	 *	Método que retorna el siguiente registro como un array o falso si no hay registro para retornar
	 */
	function siguienteRegistro(){
		try{
			$retorno = $this->sentencia->fetch(PDO::FETCH_ASSOC);
		}
		catch (PDOException $e){
			//guardo el error generado
			$this->ultimoError = "{" . date("d/m/Y H:i:s") . "} " . $e->getMessage();
			$retorno = false;
		}
		return $retorno;
	}
	
	/*
	 *	Método que retorna los registros restantes como un array de arrays o falso si no hay registro para retornar
	 */
	function restantesRegistros(){
		try{
			$retorno = $this->sentencia->fetchAll();
		}
		catch (PDOException $e){
			$this->ultimoError = "{" . date("d/m/Y H:i:s") . "} " . $e->getMessage();
			$retorno = false;
		}
		return $retorno;
	}
	
	/*
	 *	Método que retorna la cantidad de columnas de la consulta ejecutada
	 */	
	function cantidadColumnas(){
		return $this->sentencia->columnCount();
	}

	/*
	 *	Método que retorna la cantidad de filas de la consulta ejecutada
	 */	
	function cantidadRegistros(){
		return $this->sentencia->rowCount();
	}
}

?>
