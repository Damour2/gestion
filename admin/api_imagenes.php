<?php

require "../library/conexion.php";
require "../library/auxiliares.php";
require "../library/idioma-$lang.php";


$ordenarpor = cargar('ordenarpor', 'id_img');
$accion = cargar('accion', "listar");
$texto = cargar('texto', "");
$tipo = cargar('tipo', "");
$file = cargar('file', "");
$offset = cargar('offset', 0);
$id = cargar('id', 0);
$campo = cargar('campo', "");
$valor = cargar('valor', "");
$paraeditar = cargar('paraeditar', 0);
$tipodefault = cargar('tipodefault', '');


$maximo = 40;

if ($accion == 'listar') {
	
	if (empty($texto) and empty($file) and empty($tipo))
		$consulta = "SELECT SQL_CALC_FOUND_ROWS id_img, tipo, imagen, descripcion FROM imagenes ORDER BY $ordenarpor desc LIMIT $offset, $maximo";
	elseif (!empty($texto) or !empty($tipo))
		$consulta = "SELECT SQL_CALC_FOUND_ROWS id_img, tipo, imagen, descripcion FROM imagenes WHERE (imagen LIKE '%$texto%' OR descripcion LIKE '%$texto%') AND tipo LIKE '%$tipo%'  LIMIT $offset, $maximo";
	elseif (!empty($file))
		{
		if ($tipodefault != '') mysql_query("UPDATE imagenes SET tipo = '$tipodefault' WHERE imagen = '$file'");
		$consulta = "SELECT id_img, tipo, imagen, descripcion FROM imagenes WHERE imagen = '$file' ORDER BY id_img DESC LIMIT 1";
		}
	
	$q = mysql_query($consulta) or die(mysql_error());
	
	if (!mysql_num_rows($q)) die ("<p>No hay items para esa selección</p>");
	
	$querycantidad=mysql_query("Select FOUND_ROWS()"); 
	$rowcantidad=mysql_fetch_array($querycantidad); 
	$resultadosposibles=$rowcantidad["FOUND_ROWS()"]; //saca la cantidad de resultados si no hubiera limitacion 	 
	
	$num = 0;
	while($r = mysql_fetch_object($q)) {
		$num++;
		$par = $num%2 == 0 ? "par" : "";
		
		
		
		
		echo "<div class='linea $par' id='$r->id_img' image='$r->imagen'>";
		
			thumb($r->imagen, $r->id_img, 50, 50, '', '../');	
			
				
				echo"<span>$r->imagen</span>
					<input type='text' value='$r->descripcion' onchange='cambiaLinea(this)'>";
			
			
			echo "<select class='tipo_imagen' onchange='cambiaLinea(this)'>";
				
				foreach ($TIPOS_IMAGEN as $key=>$value)	{
					if (!is_numeric($key))
						{
						$selected = ($key == $r->tipo) ? "selected='selected'" : '';
						
						echo "<option value='$key' $selected>".ucfirst($traducir[$key])."</option>";
						}
						
				}  
				echo "</select>";
				if ($paraeditar)  echo "<a class='boton' onclick='borrarImagen(this)'>$traducir[borrar]</a>";
			 	echo "</div>";
	
	}
	
	navegacion($resultadosposibles, $maximo, $offset);
	exit; //listar	
		
}

if ($accion == 'editar') {

	mysql_query("UPDATE imagenes SET $campo = '$valor' WHERE id_img = $id") or die(mysql_error());
	die("ok");
}


if ($accion == 'borrar') {
	mysql_query("DELETE FROM imagenes WHERE id_img = $id") or die(mysql_error());
	die("ok");
}

if ($accion == 'agregar_video') {
	$parts = explode("/", $file);
	
	$id = $parts[count($parts)-1];
	if(!empty($id))
		{
		mysql_query("INSERT INTO imagenes (imagen, tipo) VALUES ('$id', 'video')") or die(mysql_error());
		die($id);
		}
	else die("error");

}


if ($accion == 'agregar_color') {
	
	if(!empty($file) and !empty($file))
		{
		mysql_query("INSERT INTO imagenes (descripcion, imagen, tipo) VALUES ('$texto', '$file', 'color')") or die(mysql_error());
		die($id);
		}
	else die($file."error ".$texto);

}


?>