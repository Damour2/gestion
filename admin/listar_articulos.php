<?
include "../library/conexion.php";
include "../library/auxiliares.php";
include "../library/idioma.php";


$que = cargar('que', '');
$nombre = cargar('nombre', '');
$categorias = cargar('categorias', '');
$tipo = cargar('tipo', '');
$maximo = 20;
$offset = cargar('offset', 0);
$order = cargar('order', 'id_art');
$activo = cargar('activo', -1);
$joins = array();
$conds = array();
$cats = explode(",", $categorias);
$num = 0;

$conds[] = "tipo = '$tipo'";

if ($activo != -1) $conds[] = "activo = $activo";
if (!empty($categorias)) 
	foreach ($cats as $cat) {
		$num++;
		$joins[] = "LEFT JOIN categorias_articulo AS a$num ON a$num.id_art = data.id_art AND a$num.id_cat = $cat";
		$conds[] = "a$num.id IS NOT NULL";
	}

if (!empty($nombre)) {
	$nombre = "+".str_replace(" ", " +", $nombre);
	$conds[] = "MATCH(data.nombre, data.hash_categorias) AGAINST ('$nombre' IN BOOLEAN MODE)";
	}

if ($que == 'titulo') $quepedir = "data.id_art, data.nombre, data.activo, data.destacado";
else $quepedir = "data.*";


if (!count($conds)) $conds[] = "1 = 1";

$consulta = "SELECT SQL_CALC_FOUND_ROWS $quepedir FROM articulo AS data ".join(" ", $joins)." WHERE ".join(" AND ", $conds)." ORDER BY $order DESC LIMIT $offset, $maximo";

//echo $consulta;


$q = mysql_query($consulta);


$querycantidad=mysql_query("Select FOUND_ROWS()"); 
$rowcantidad=mysql_fetch_array($querycantidad); 
$resultadosposibles=$rowcantidad["FOUND_ROWS()"]; //saca la cantidad de resultados si no hubiera limitacion 	 


while ($r= mysql_fetch_assoc($q)) {

	if ($que == 'titulo') 
	{	$cheked = ($r[activo] == 1) ? "checked='checked'" : "";
		$destacado = ($r[destacado] == 1) ? "checked='checked'" : "";
			
		echo "<div class='linea' id='$r[id_art]'><label>".strtoupper($traducir[activo])."</label><input type='checkbox' $cheked onchange='marcar(this)' /><span>$r[nombre]</span><span class='fltrgt'>Destacado: <input type='checkbox' onchange='marcarDestacado(this)' $destacado /></span></div>";
	}
}



navegacion($resultadosposibles, $maximo, $offset);





?>