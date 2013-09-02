<? 

	
	
	class Imagen {
		var $descripcion;
		var $id_img;
		var $imagen;
		var $img_related;
		var $related_src;
		var $related_desc;
		var $texto;
		
		
		function Imagen($id, $img, $desc, $img_rel, $rel_src, $rel_desc, $text) {
			$this->id_img = $id;
			$this->imagen = $img;
			$this->descripcion = $desc;
			$this->img_related = $img_rel;
			$this->related_src = $rel_src;
			$this->related_desc = $rel_desc;
			$this->texto = $text;

		}
	
	}
	
	

$PROVINCIAS = array('Buenos Aires', 'Buenos Aires-GBA', 'Capital Federal', 
'Catamarca',
'Chaco',
'Chubut',
'Córdoba',
'Corrientes',
'Entre Ríos',
'Formosa',
'Jujuy',
'La Pampa',
'La Rioja',
'Mendoza',
'Misiones',
'Neuquén',
'Río Negro',
'Salta',
'San Juan',
'San Luis',
'Santa Cruz',
'Santa Fe',
'Santiago del Estero',
'Tierra del Fuego',
'Tucumán');



$TIPOS_NOTICIA = array("tecnologia", "noticiasimpleinstitucional", "bannerheaderinstitucional", "bannerdowninstitucional", "noticiasimpletienda", "bannerheadertienda", "bannerdowntienda", "paginaestaticainstitucional", "paginaestaticatienda");

$TIPOS_PRODUCTO = array('ambos sitios', 'tienda', 'institucional');
	

$ESCALAS = array( 0=> 'talles', 1=> 'dimensiones', 2=> 'numeros', 3=>'largos');

	
$CATEGORIAS = array(	0 => 'genero', 'genero' => 0, 
				1=> 'producto', 'producto' => 1,
				2 => 'marca', 'marca' => 2,
				3=> 'actividad', 'actividad' => 3
			  );
	
	
$TIPOS_IMAGEN = array(	0 => 'no especificado', 'no especificado' => 0, 
				1=> 'foto', 'foto' => 1,
				2 => 'color', 'color' => 2,
				3=> 'logo', 'logo' => 3,
				4=> 'tecnologia', 'tecnologia' => 4,
				5=> 'video', 'video' => 5,
				6=> 'encabezado', 'encabezado' => 6
			  );
	

function levantar_archivo_externo($archivo, $validez_cache=10800){

	if( $archivo_cache_file = 'cache/'.md5($archivo).'.txt' 

	and is_file($archivo_cache_file)

	and filemtime($archivo_cache_file) > date('U')-$validez_cache ){

		return unserialize( file_get_contents($archivo_cache_file) );

	}else{

		if(ini_get('allow_url_fopen')){

			$contenido = file_get_contents($archivo);

		}else{

			$ch = curl_init ($archivo) ;

			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1) ;

			$contenido = curl_exec ($ch) ;

			curl_close ($ch) ;

		}

		file_put_contents($archivo_cache_file, serialize($contenido));

		chmod($archivo_cache_file, 0777);

		return $contenido;

	}

}











function cargar($formname, $else='', $maxchars=0){

	$var = '';

	if(is_numeric($else)){

		$var = (isset($_REQUEST[$formname]) and is_numeric($_REQUEST[$formname])) ? floatval($_REQUEST[$formname]) : $else;

	}else{

		$var = !empty($_REQUEST[$formname])? $_REQUEST[$formname] : $else;

	}

	if( $maxchars > 0 ) $var = substr(strval($var),0,$maxchars);

	return $var;

}
function sinAcentos($cadena){
   $tofind = "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ· ";
   $replac = "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn-_";
   return(strtr($cadena,$tofind,$replac));
}




function navegacion($cantidad, $limitederesults, $offset) {

		if ($cantidad > $limitederesults) {
		
			$limitescroll = 5;
			$maximo = false; // si hay que agreagr que sigue para adelante
			$minimo = false; // si hay que agreagr que sigue para atras
			$actual = ($offset / $limitederesults) + 1;
			
			$scroll = ceil($cantidad / $limitederesults);
			$response = "<div id='navegacion'>";
			for ($r = 1; $r <= $scroll; $r++) {
				$offset = ($r-1) * $limitederesults;
						
				if ($r == $actual) {
					$response .= "<span>$r</span>";
				}
				else if (($r - $actual <= $limitescroll) && ($r - $actual >= -$limitescroll)) {
					$response .= "<a href='javascript:iraOffset($offset)'>$r</a>";
				}
				
				else if ($r - $actual > $limitescroll) {
					$maximo = true;
					}
				else if ($r - $actual < -$limitescroll) {
						if (!$minimo) {
						$minimo = true;
						$response .= "<span><</span>";
						}
					}	
				
			}
			
			if ($maximo) $response .= "<span>></span>";
			$response.="</div>";
			echo $response;
		}


}



function render_articulo($r, $num, $cuantos, $deacuantos = 3) {
	if ($num % $deacuantos == 0) 
		{
		$sinmargin = "sinmargin";
		$cierre = "</div>";
		}
	else if ($num % $deacuantos == 1 or $num == 1) 
		echo "<div class='linea'>";
	
	if ($num == $cuantos) {
	
		$cierre = "</div>";
		}
	if (!empty($r[marca])) $r[nombre] = "<b>$r[marca]</b> $r[nombre]";
	echo "<div class='articulo $sinmargin' id='$r[id_art]' vistas='$r[vistas]'>
				<div class='img' style='background-image: url(image_resizer.php?image=img/uploads/$r[imagen]&width=160&height=160)' imagen='$r[imagen]'></div>
	<a href='in.php?accion=producto&id=$r[id_art]' class='nombre'>$r[nombre]</a>
	";
	
	/*$tachado = (!empty($r[valor_descuento])) ? "tachado" : "";
	if (!empty($r[valor])) echo "<p class='valor $tachado'>Prezzo: € <span>$r[valor]</span></p>";
	if (!empty($r[valor_descuento]))  {
		$floatvalor = $r[valor] - $r[valor_descuento];
		echo "<p class='rebaja'>(Risparmi: € <span>".$floatvalor ."</span>)</p>";
		
		echo "<p class='valor_descuento'>Scontato: € <span>$r[valor_descuento]</span></p>";
		}
	
	echo "<div class='agregar_carro' onclick='agregar_carro(this)'></div>";*/
	
	echo "</div>";
	echo $cierre;
	
}








function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}


function _e($text) {
	
	echo (!empty($traducir[strtolower($text)])) ? $traducir[$text] : $text;	
}



function thumb ($imagen, $id, $w, $h, $related = '', $path = '', $contenedor = 'div', $crop = 1, $openvideo = 0, $extraclasses = '', $title = '') {
	if (empty($related)) $related = $imagen;
	$title = (empty($title)) ? '' : "title='$title' alt='$title'";
	$video ='';
	$extension = strtolower(substr($imagen, -4));
	
	$crop = ($crop) ? "cropratio=$w:$h" : '';
	
	if (substr($imagen, 0, 1) == '#') 
		{
			$back = "background-color: $imagen";
			$tipo = 'color';
			$attr = "imagen='$related'";
		}
	elseif ($extension == '.jpg' or $extension == '.png' or $extension == '.gif' or $extension == 'jpeg')
	{
		$back = "background-image: url(".$path."image_resizer.php?image=img/uploads/$imagen&width=$w&height=$h&$crop)";
		$tipo = 'foto';
		$attr = "imagen='$related'";
	}
	else 
		{	
			if (!$openvideo) {
			$back = "background-image: url(".$path."image_resizer.php?image=http://i.ytimg.com/vi/$imagen/2.jpg&width=$w&height=$h&$crop)";
			$attr = "video='$related'";
			}
			else
			$video = "<object width='$w' height='$h'><param name='movie' value='http://www.youtube.com/v/$imagen?version=3&amp;hl=en_US&amp;rel=0'></param><param name='allowFullScreen' value='true'></param><param name='allowscriptaccess' value='always'></param><param name='wmode' value='transparent'></param><embed src='http://www.youtube.com/v/$imagen?version=3&amp;hl=en_US&amp;rel=0' type='application/x-shockwave-flash' width='$w' height='$h' allowscriptaccess='always' allowfullscreen='true' wmode='transparent'></embed></object>";
			
			$tipo = 'video';
		}
		
	echo ($video != '') ? $video : "<$contenedor id='$id' class='imagen $tipo $extraclasses' style='$back; width:".$w."px; height: ".$h."px' $attr $title></$contenedor>";
}


function listarCategoriasMenu($opciones) {
	$op = array(where => '1 = 1', container => 'li', prefijoSubs => '', order => "parent ASC, nombre ASC");
	$op = array_merge($op, $opciones); 
	if ($op[where] != '') $op[where] = 'WHERE '.$op[where];
	
	$q = mysql_query("SELECT id_cat, nombre, parent FROM categorias $op[where] ORDER BY $op[order]");
	while ($r = mysql_fetch_assoc($q)) {
		if ($r[parent] == 0)
		$lista[$r[id_cat]][elemento] = "<$op[container] id='cat$r[id_cat]'><a href='in.php?accion=categoria&id=$r[id_cat]&nombre=".urlencode($r[nombre])."'> $r[nombre]</a>";	
		else 
		{
		
		if (isset($lista[$r[parent]]))	$lista[$r[parent]][subs][] = "<$op[container] class='subcategoria'><a href='in.php?accion=categoria&id=$r[id_cat]&nombre=".urlencode($r[nombre])."'>$r[nombre]</a></$op[container]>"; // si esta el mayor
		
		}
	}
	
	foreach ($lista as $e) {
			echo $e[elemento];
			if ($e[subs]) {
				echo "<ul>";
				foreach ($e[subs] as $i)
					echo $i;	
				echo "</ul>\r\n";
			}
			echo "</$op[container]>\r\n";
		}
}

function listarCategorias($opciones) {
	$op = array( 'offset'=> 0, 'limit' => 10000, 'order' => 'nombre ASC', 'where' => "tipo != 2", extraClasses => '', tipo=> 'todas', container => 'div', seleccionados => array());
		
		$op = array_merge($op, $opciones);
		if ($op[where] != '') $where[] = $op[where];
		if ($op[tipo] == "principales") $where[] = "parent = 0";
		if ($op[tipo] == 'secundarias') $where[] = "parent = $op[parent]";
		$where = "WHERE ".implode(' AND ', $where);
		$consulta = "SELECT id_cat, nombre, parent FROM categorias $where ORDER BY $op[order] LIMIT $op[offset], $op[limit]";
		//echo $consulta;
		$q = mysql_query($consulta) or die(mysql_error().$consulta);
		$parent = 0;
		while ($r = mysql_fetch_assoc($q))
		{	
			
			if ($op[container] == 'option') { 
				if (in_array($r[id_cat], $op[seleccionados])) {
					$selected =  "selected='selected'";
					$parent = $r[id_cat];
				}
				else $selected = '';
				echo "<option value='$r[id_cat]' $selected>".ucfirst($r[nombre])."</option>";
			}
			else {
				if ($op[container] != '') echo "<$op[container] class='$op[extraClasses]' id='$r[id_cat]'>";
				//if ($op[tipo] == 'principales') 
						echo "<a href='in.php?accion=categoria&id=$r[id_cat]&nombre=".urlencode($r[nombre])."'>".ucfirst($r[nombre])."</a>";
				if ($op[container] != '') echo "</$op[container]>";
			}
		}
		return $parent;
}







function dmy2ymd($val) {
	$val = str_replace('/', '-', $val);
	$fecha = explode('-', $val);
	if (!$fecha[2]) $fecha[2] = '2012';
	return "$fecha[2]-$fecha[1]-$fecha[0]";
	
}




function lastInsert() {
	$q = mysql_fetch_assoc(mysql_query('SELECT LAST_INSERT_ID() as lid'));
	return $q[lid];
		
}


function getItems($opciones) {
				
		if (!empty($opciones[where])) $opciones[where] = " AND ".$opciones[where];	
		$op = array( 'offset'=> 0, 'limit' => 4, 'order' => 'articulo.id_art DESC', 'where' => "", width => 180, height => 180, cuantos => 3, porlineas => true, tipo => 'producto', show => 'imagen, titulo', maximoBajada => 80, imprime => true, crop => 0, extra => '', extraClasses => '', navegacion => false, orderby => '');
		
		$op = array_merge($op, $opciones);
		
		
		if (preg_match("/colores/", $op[show])) {
			$groupColores = ", GROUP_CONCAT(DISTINCT g.imagen) as colores";
			$joinColores = "LEFT JOIN (SELECT dd.id_art, ee.imagen FROM imagenes_articulo dd LEFT JOIN imagenes ee USING (id_img) WHERE dd.relacion = 'color') AS g ON g.id_art = articulo.id_art";
		}
		
		/*$consulta = "SELECT articulo.id_art, articulo.nombre, articulo.bajada, d.imagen, f.nombre As marca $groupColores FROM articulo  
LEFT JOIN (SELECT id_img, id_art FROM imagenes_articulo WHERE (relacion = 'foto' OR relacion = 'no especificado') ORDER BY id ) AS c ON articulo.id_art = c.id_art 
LEFT JOIN imagenes d ON c.id_img = d.id_img 
LEFT JOIN (SELECT aa.id_art, bb.nombre FROM categorias_articulo aa LEFT JOIN categorias bb USING (id_cat) WHERE bb.tipo = 'marca') AS f ON f.id_art = articulo.id_art
$joinColores
WHERE articulo.tipo = '$op[tipo]' $op[where]
GROUP BY articulo.id_art ORDER BY $op[order] LIMIT $op[offset], $op[limit]";*/
		if ($op[orderby] !='') $op[orderby] = "ORDER BY ".$op[orderby];
		
		
		$consulta = "SELECT SQL_CALC_FOUND_ROWS a.*, b.*, c.*, e.id_img, e.imagen FROM categorias_articulo a 
		LEFT JOIN categorias USING (id_cat)
LEFT JOIN articulo b USING (id_art) 
LEFT JOIN datos_producto c USING (id_art) 
LEFT JOIN (SELECT id_img, id_art FROM imagenes_articulo ORDER BY id ) AS d ON a.id_art = d.id_art 
LEFT JOIN imagenes e ON d.id_img = e.id_img 
WHERE b.tipo = '$op[tipo]' $op[where] GROUP BY a.id_art $op[orderby] LIMIT $op[offset], $op[limit]";
	
		//echo $consulta;
		
		$qp = mysql_query($consulta) or die(mysql_error().'   ==>>  '.$consulta);

	  $num = 0;
	  $temp = array(); //se usa si no es  una opcion print
	  while ($r = mysql_fetch_assoc($qp)) {
		  if ($op[imprime]) {
			  if ($num % $op[cuantos] == 0 and $op[porlineas]) echo "<div class='linea' id='$num'>";
			 
			  printItem($r, $op);
			  
			  if (($num + 1) % $op[cuantos] == 0 and $op[porlineas]) echo "</div>";
			  $num++;
		  } else
		  	$temp[] =$r;
	  }
	  	if (!$op[imprime]) return $temp;
		if ($op[porlineas] and $num % $op[cuantos] != 0) echo "</div>"; //si no se cerro el linea

		if ($op[navegacion]) {
			$found = mysql_fetch_assoc(mysql_query("SELECT FOUND_ROWS() as rows"));
			
			navegacion($found[rows], $op[limit], $op[offset]);
		}

}



function printItem($r, $op) {
	 echo "<div class='linea articulo' id='$r[id_art]' imagen='$r[imagen]' style='background-image: url(../image_resizer.php?image=img/uploads/$r[imagen]&width=220&height=220)'>
									
									<div class='negro'>
										<div class='titulo'>
										<a class='cufon' href='in.php?accion=producto&id=$r[id_art]'>$r[nombre]</a>
										<p class='valor'>$ <span>$r[valor]</span></p>
										</div>
										
									</div>
									<div class='botonesproducto'>
											<a onclick='agregar_carro(this)'>Comprar ahora</a>
											<a href='in.php?accion=producto&id=$r[id_art]&nombre=$r[nombre]'>Ver más</a>
										</div>
								</div>";
}





?>
