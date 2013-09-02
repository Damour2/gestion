<?
include "../library/conexion.php";
include "../library/auxiliares.php";

$id = cargar('id', 0);
$accion = cargar('accion', '');
$valor = $_POST['valor'];
if ($accion == "borrar") {
	mysql_query("DELETE FROM articulo WHERE id_art = $id");
	mysql_query("DELETE FROM datos_producto WHERE id_art = $id");
	mysql_query("DELETE FROM datos_sucursal WHERE id_art = $id");
	mysql_query("DELETE FROM imagenes_articulo WHERE id_art = $id");
	mysql_query("DELETE FROM categorias_articulo WHERE id_art = $id");
	die("ok");
}

if ($accion == "marcar" and $valor != '') {
	echo "UPDATE articulo SET activo = $valor WHERE id_art = $id";
	mysql_query("UPDATE articulo SET activo = $valor WHERE id_art = $id") or die(mysql_error());
	die("ok");
}

if ($accion == "marcarDestacado" and $valor != '') {
	echo "UPDATE articulo SET destacado = $valor WHERE id_art = $id";
	mysql_query("UPDATE articulo SET destacado = $valor WHERE id_art = $id") or die(mysql_error());
	die("ok");
}


?>