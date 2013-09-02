<?
set_include_path('/oop/');
include "seguridad.php";
include "config.php";
include "DB.php";
include "utils.php";
include "conOpciones.php";
include "component.php";
include "form.php";
include "Items.class.php";
include "smarty/libs/Smarty.class.php";
$config = new Config();
include "oop/idioma-$config->lang.php";
$DB = new DB($config->DBCONN);
$smarty = new Smarty();

$UNIDADES = array('mts', 'cm', 'unidad', 'kilo', 'gramo'); 
?>