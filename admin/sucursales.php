<?
include "library/conexion.php";
include "library/auxiliares.php";


$texto = cargar('texto', '');

if (empty($texto)) die ( json_encode(array("status"=> "fail")) );
else die ( json_encode(array("status"=> "ok")) );



?>