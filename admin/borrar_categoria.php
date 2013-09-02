<?php

include "../library/conexion.php";
$q = mysql_query("SELECT id_cat FROM categorias WHERE id_cat = '$_POST[id]' OR parent = '$_POST[id]'");
while ($r= mysql_fetch_assoc($q)) {
	$items[] = $r[id_cat];	
}
$items = implode(', ', $items);
mysql_query("DELETE FROM categorias WHERE id_cat = '$_POST[id]' OR parent = '$_POST[id]' or parent IN ($items)");
mysql_query("DELETE FROM categorias_articulo WHERE id_cat IN ($items)")or die(mysql_error());
echo "DELETE FROM categorias_articulo WHERE id_cat IN ($items)";

/*
$q = mysql_query("SELECT id_cat, nombre FROM categorias WHERE tipo = '$_POST[tipo]'");
while($r = mysql_fetch_object($q)) {

		echo "<div id='$r->id_cat' class='categoria'>".ucfirst($r->nombre)."</div>";
		
	}*/

?>