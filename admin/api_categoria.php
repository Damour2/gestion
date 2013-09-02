<?php
//to see changes
include "../library/conexion.php";
$idi = $_GET[id];
$q = mysql_query("SELECT * FROM categorias WHERE id_cat = $idi LIMIT 1");
$r = mysql_fetch_assoc($q);

echo json_encode($r);
?>