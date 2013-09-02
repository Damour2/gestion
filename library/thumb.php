<? 
include 'auxiliares.php';

$imagen = cargar('imagen', '');
$id = cargar('id', 0);
$w = cargar('w',0);
$h = cargar('h',0); 
$path = cargar('path', '');
$related = cargar('related', '');
$contenedor = cargar('contenedor', 'div');
$openvideo = cargar('openvideo', 0);
$crop = cargar('crop', 1);
$extraclasses = cargar('extraclasses', '');
$title = cargar('title', '');
echo  thumb ($imagen, $id, $w, $h, $related, $path, $contenedor, $crop, $openvideo, $extraclasses, $title);

?>