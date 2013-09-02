<?

include "conexion.php";

$accion = cargar('accion', 'listar');
$offset = cargar('offset', 0);
$nombre = cargar('nombre', '');
$estado = cargar('estado', 'pendiente');



if ($accion == 'listar')
{

	if ($estado != 'todos')
		$consulta = "SELECT SQL_CALC_FOUND_ROWS id, facebook_id, name, description FROM mtv_gm WHERE estado = '$estado' AND nombre LIKE '%nombre%' ORDER BY id DESC LIMIT $offset, 20";
	else
		$consulta = "SELECT SQL_CALC_FOUND_ROWS id, facebook_id, name, description FROM mtv_gm WHERE nombre LIKE '%nombre%' ORDER BY id DESC LIMIT $offset, 20";
		
		
	$q = mysql_query($consulta) or die(mysql_error());
	
	
	if (!mysql_num_rows($q)) die ("<p>No hay items para esa selección</p>");
		
		$querycantidad=mysql_query("Select FOUND_ROWS()"); 
		$rowcantidad=mysql_fetch_array($querycantidad); 
		$resultadosposibles=$rowcantidad["FOUND_ROWS()"]; //saca la cantidad de resultados si no hubiera limitacion 	
		
		
		while ($r= mysql_fetch_object($q)) {
			
			echo "<div class='linea'>
					<div class='usuario'>";
					if (!(empty($r->facebook_id))) echo "<img src='http://graph.facebook.com/$r->facebook_id/picture'>";
					echo "<p>$r->name</p></div>";
					echo "<div class='comentario'>$r->description</div>";	
			echo "</div>";
		}
	}

?>