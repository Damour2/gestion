<?
include "oop/config.php";
$config = new Config();
include "library/auxiliares.php";
include "oop/Utils.php";

 function escapar($t) {
	if (get_magic_quotes_gpc())
		$t = stripslashes($t);
	return mysql_real_escape_string($t);
	
	}


$datos = json_decode($_REQUEST[datos], true);


//$tipo = $_POST[tipo];
$articulo = $datos[articulo];

//$_REQUEST[activo] = ($_POST[activo] == 'on' or $_POST[activo] == 1 or $_POST[activo] == true) ? 1: 0;

$generales = array('nombre', 'bajada', 'hash_categorias');
$producto = array('auto_publico', 'auto_mayor', 'margen_recomendado', 'margen_mayor', 'valor', 'valor_mayor', 'stock', 'stock_minimo', 'codigo', 'valor_costo');



////////////////////generales
foreach ($generales as $campo) {
	$values[] = "$campo = '".escapar($datos[$campo])."'";

}
$values[] = "fecha_alta = NOW()";
$campos = join(", ", $values);

$consulta_general = ($articulo == 0) ? "INSERT INTO articulo SET $campos" : "UPDATE articulo SET $campos WHERE id_art = $datos[articulo]";

mysql_query($consulta_general) or die(json_encode(array("status" => "fail", "motivo" => "Error en la base de datos: $consulta_general =>".mysql_error())));


//si es un articulo nuevo encontramos el id que le pusimos
if ($articulo == 0) { 
	$lid = mysql_query("SELECT LAST_INSERT_ID() AS lid");
	$rlid = mysql_fetch_assoc($lid); //busca el ultimo id cambiado en mysql
	$articulo = $rlid[lid];
}



	$values = array();
	foreach ($producto as $campo) {
		$values[] = "$campo = '".escapar($datos[$campo])."'";
	}
	$campos = join(", ", $values);
	$consulta_general = "INSERT INTO datos_producto SET id_art = $articulo, $campos ON DUPLICATE KEY UPDATE $campos";
	mysql_query($consulta_general) or die(json_encode(array("status" => "fail", "motivo" => "Error en la base de datos: $consulta_general =>".mysql_error())));



/////////////////////categorias
$post_cats = ($datos[categorias] == '') ? array() : explode(',', $datos[categorias]);
if ($articulo != 0) mysql_query("DELETE FROM categorias_articulo WHERE id_art = $articulo");

if (count($post_cats)) {
	$values = array();
	foreach ($post_cats as $e)
		if (!empty($e)) $values[]= "($articulo, $e)";

	
	
	
		
	$campos = implode(", ", $values);

	mysql_query("INSERT INTO categorias_articulo (id_art, id_cat) VALUES $campos") or die(json_encode(array("status" => "fail", "motivo" => "Error en la base de datos categorias".mysql_error()."INSERT INTO categorias_articulo (id_art, id_cat) VALUES $campos")));
}




////////////////////////////////materias primas
if ($articulo != 0) mysql_query("DELETE FROM materias_producto WHERE id_art = $articulo");

if (!empty($datos[materias])) {
	$values = array();
	foreach ($datos[materias] as $e)
		$values[] = "($articulo, $e[id_mat], $e[cantidad])";
		
	$consulta = "INSERT INTO materias_producto (id_art, id_mat, cantidad) VALUES ".implode(', ', $values);
	mysql_query($consulta) or die($consulta.mysql_error());
	//echo $consulta;
}


////////////////////imagenes
if (!empty($_POST[imagenes])) {
	$values = array();
	$cats = explode("*,*,", $_POST[imagenes]);
	if ($_POST[articulo] != 0) mysql_query("DELETE FROM imagenes_articulo WHERE id_art = $articulo");
	
	foreach ($cats as $este )
		{

		$partes = explode("*/*/", $este);
		
				
		if (empty($partes[2])) $partes[2] = "";

		$values[]= 	($partes[1] != 'tecnologia') ? 
					"($articulo, $partes[0], '$partes[1]', '$partes[2]')" :
					"($articulo, $partes[0], '$partes[1]', '')";
			
			if ($partes[1] == 'tecnologia') 
			{ mysql_query("UPDATE imagenes SET texto = '".escapar($partes[2])."' WHERE id_img = $partes[0]") or die(mysql_error());
				//echo "UPDATE imagenes SET texto = '".escapar($partes[2])."' WHERE id_img = $partes[0]";
			}
			
		}
	$campos = implode(", ", $values);
	$consulta = "INSERT INTO imagenes_articulo (id_art, id_img, relacion, img_related) VALUES $campos" ;


	mysql_query($consulta) or die(json_encode(array("status" => "fail", "motivo" => "Error en la base de datos")));
}

die(json_encode(array("status" => "ok", "id" => $articulo)));


?>
