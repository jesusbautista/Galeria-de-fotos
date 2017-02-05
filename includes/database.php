<?php
require_once('config.php');

#creando la clase de la base de datos
/**
* 
*/
class MySQLBD
{
	#propiedad privada de la clase
	private $conexion;

	#llamar al constructor para iniciar la funcion conectar
	function construct()
	{
		$this->conectar();
	}

	#funcion conectar
	public function conectar()
	{
		#para acceder a la variable privada se usa this

		$this->$conexion=mysql_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD);
		if(!$this->conexion)
		{
			die("No se ha podido realizar la conexion a la base de datos:".mysql_error());
		}
		else
		{
			$bd_seleccionada=mysql_select_db(DB_NAME,$this->conexion);
			if (!$bd_seleccionada) 
			{
				# error
				die("No se ha podido realizar la conexion a la base de datos:".mysql_error());
			}
		}
	}

	public function consultar($sql)
	{
		# code...
		$resultado=mysql_query($sql,$this->conexion);
		#llamando a verificar consulta
		$this->verificar_consulta($resultado);
		return $resultado;
	}

	public function preparar_consulta($consulta)
	{
		$mq_activado=get_magic_quotes_gpc();
		if (function_exists("mysql_real_escape_string"))
		{
			if ($mq_activado) 
			{
				$consulta=stripslashes($consulta);

			}
			$consulta=mysql_real_escape_string($consulta);
		}
		else
		{
			if (!$mq_activado) 
			{
				$consulta=addslashes($consulta);
			}
		}
		return $consulta;
		
	}

	private function verificar_consulta($consulta)
	{
		# code...
		if (!$consulta) 
		{
			die("No se ha podido realizar la consulta".mysql_error());
		}
	}



	#salir de la base de datos
	public function desconectar()
	{
		if(isset($this->conexion))
		{
			mysql_close($this->conexion);
			#limpia la variable conexion
			unset($this->conexion);
		}
	
	}
	#fin clase
}

#creando una nueva instancia de la clase
$bd = new MySQLBD();

?>

