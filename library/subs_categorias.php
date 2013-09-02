<?
include "../oop/config.php";
include "auxiliares.php";
$config = new Config();
$container = cargar('container', 'div');

listarCategorias(array(tipo => 'secundarias', parent => $_GET[seleccionada], where => '', container => $container, extraClasses => 'categoria'));

?>