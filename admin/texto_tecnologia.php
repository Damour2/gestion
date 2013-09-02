<? include "../library/conexion.php";

$q = mysql_query("SELECT texto FROM imagenes WHERE id_img = $_GET[id]");
if (mysql_num_rows($q)) {

	$r = mysql_fetch_object($q);
	
	echo $r->texto;
	}
else echo '';

?>