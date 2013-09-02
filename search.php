<?
include "../../library/conexion.php";

$que = $_REQUEST[que];
$codigo = $_REQUEST[codigo];
if (empty($que)) exit;

$terms = explode(" ", $_REQUEST[term]);
foreach ($terms as $e) {
	$wheres[] = "nombre LIKE '%$e%'";
}

$abierto = 0;

if ($que == "materias_primas") {
		$consulta = "SELECT nombre, id_mat, medida FROM $que WHERE ".join(" AND ", $wheres);
		
	}
else if ($que == "articulo") {
		if (is_numeric($_REQUEST[term]))
			$consulta = "SELECT nombre, a.id_art, valor, unidades FROM $que a LEFT JOIN datos_producto b USING (id_art) WHERE id_art LIKE '%$_REQUEST[term]%' ORDER BY popularidad DESC LIMIT 10";
		else
		{ $consulta = "SELECT nombre, a.id_art, valor, unidades FROM $que a LEFT JOIN datos_producto b USING (id_art) WHERE ".join(" AND ", $wheres)." ORDER BY popularidad DESC LIMIT 10";
		
		}
		
	}
else if ($que == 'articuloxnumero') {
	if (substr($codigo, 0, 5) == '00000') $codigo = substr($codigo, 0, 11);
	$consulta = "SELECT nombre, id_art, valor, unidades FROM articulo a LEFT JOIN datos_producto b USING (id_art) WHERE id_art = '$codigo' OR b.codigo_barras = '$codigo' ORDER BY popularidad DESC LIMIT 1";
	$abierto = 1;
}

//echo $consulta;
$q = mysql_query($consulta) or die($consulta . '      '.mysql_error());
		while ($r = mysql_fetch_assoc($q))
			$mandar[] = array("id" => $r[id_art], "valor" => $r[valor], 'value' => "$r[id_art]: ".ucfirst($r[nombre])." x ".floatval($r[unidades]), 'abierto' => $abierto);

echo json_encode($mandar);

?>