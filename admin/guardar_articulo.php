<?
include "../library/conexion.php";
include "../library/auxiliares.php";

if (!isset($_POST[articulo]) or !isset($_POST[tipo])) die ("error");

$tipo = $_POST[tipo];
$articulo = $_POST[articulo];

$_REQUEST[activo] = ($_POST[activo] == 'on' or $_POST[activo] == 1 or $_POST[activo] == true) ? 1: 0;

$generales = array('nombre', 'bajada', 'cuerpo', 'tipo', 'subtipo', 'hash_categorias', 'activo');
$sucursal = array('direccion', 'provincia', 'telefono', 'mail', 'latitud', 'longitud', 'indice');
$producto = array('escala', 'presentaciones', 'valor', 'valor_descuento', 'destacado');


////////////////////generales
foreach ($generales as $campo) {
	$values[] = "$campo = '".escapar($_REQUEST[$campo])."'";

}
$values[] = "fecha = NOW()";
$campos = join(", ", $values);

$consulta_general = ($articulo == 0) ? "INSERT INTO articulo SET $campos" : "UPDATE articulo SET $campos WHERE id_art = $_REQUEST[articulo]";

mysql_query($consulta_general) or die(json_encode(array("status" => "fail", "motivo" => "Error en la base de datos")));


//si es un articulo nuevo encontramos el id que le pusimos
if ($articulo == 0) { 
	$lid = mysql_query("SELECT LAST_INSERT_ID() AS lid");
	$rlid = mysql_fetch_assoc($lid); //busca el ultimo id cambiado en mysql
	$articulo = $rlid[lid];
}

////////////////////sucursal
if ($tipo == "sucursal") 
{	$values = array();
	foreach ($sucursal as $campo) {
		$values[] = "$campo = '".escapar($_POST[$campo])."'";
	}
	$campos = join(", ", $values);
	$consulta_general = "INSERT INTO datos_sucursal SET id_art = $articulo, $campos ON DUPLICATE KEY UPDATE $campos" ;
	mysql_query($consulta_general) or die(json_encode(array("status" => "fail", "motivo" => "Error en la base de datos".mysql_error())));
}

////////////////////////producto
if ($tipo == "producto") 
{	$values = array();
	foreach ($producto as $campo) {
		$values[] = "$campo = '".escapar($_POST[$campo])."'";
	}
	$campos = join(", ", $values);
	$consulta_general = "INSERT INTO datos_producto SET id_art = $articulo, $campos ON DUPLICATE KEY UPDATE $campos";
	mysql_query($consulta_general) or die(json_encode(array("status" => "fail", "motivo" => "Error en la base de datos")));
}


/////////////////////categorias
$post_cats = ($_REQUEST[categorias] == '') ? array() : explode(',', $_REQUEST[categorias]);
if ($_REQUEST[articulo] != 0) mysql_query("DELETE FROM categorias_articulo WHERE id_art = $articulo");

if (count($post_cats)) {
	$values = array();
	foreach ($post_cats as $e)
		if (!empty($e)) $values[]= "($articulo, $e)";

	
	
	
		
	$campos = implode(", ", $values);

	mysql_query("INSERT INTO categorias_articulo (id_art, id_cat) VALUES $campos") or die(json_encode(array("status" => "fail", "motivo" => "Error en la base de datos categorias".mysql_error()."INSERT INTO categorias_articulo (id_art, id_cat) VALUES $campos")));
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
