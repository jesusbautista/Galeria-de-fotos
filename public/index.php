<?php
require_once("../includes/database.php");

if(isset($bd))
{
	echo "El objeto ha sido creado con exito";
}
else
{
	echo "No existe tal objeto";
}

echo "<br>";
?>