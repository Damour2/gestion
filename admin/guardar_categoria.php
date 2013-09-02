<?php

include "../library/conexion.php";

foreach ($_POST as $key => $value) {
	$campos[] = "$key = '$value'";

}

$campos = join(", ", $campos);



if ($_POST[id_cat] == 0)
	{
	mysql_query("INSERT INTO categorias SET $campos");

	$lid = mysql_query("SELECT LAST_INSERT_ID() AS lid");
	$rlid = mysql_fetch_assoc($lid); //busca el ultimo id cambiado en mysql
	echo $rlid[lid];
	}
else 
	mysql_query("UPDATE categorias SET $campos WHERE id_cat = $_POST[id_cat]");


?>