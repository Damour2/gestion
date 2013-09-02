<?
	require_once "conexion.php";
	require_once "auxiliares.php";


	function buscarAgregado($container_categoria, $categorias_pedida, $id_actual) {
		if ($container_categoria == "checkbox")
			{
			$selected = (strpos($categorias_pedida, "*".$id_actual."*") === false) ? "" : "checked='checked'";
			return "<input type='checkbox' id='$id_actual' $selected />";
			}
	
	}



	$cat = array();
	
	$qcar = mysql_query("SELECT id_cat, parent, nombre FROM categorias");
	while($rcat = mysql_fetch_object($qcar)) {
		if ($rcat->parent == 0)
			{
			$cat[$rcat->id_cat]['este'] =  new Categoria($rcat->nombre, $rcat->id_cat);
			$cat[$rcat->id_cat]['childs'] = array();
			}
		else 
		$cat[$rcat->parent][childs][] = new Categoria($rcat->nombre, $rcat->id_cat);
	}
	
	/*echo "<pre>";
	print_r($cat);
	echo "</pre>";*/

	
	

	
	foreach ($cat as $k) {
	
		$rk = $k[este];
		
		
		echo "<div class='supercategoria' id='$rk->id'><div id='$rk->id' class='categoria super'><span>$rk->nombre</span>";
		echo buscarAgregado($categorias_container, $categorias_pedida, $rk->id)	;
		echo "</div>";	
		if ( count($k[childs]) )
				{
			echo "<ul>";
			
					
					foreach ($k[childs] as $sub)
					{
						echo "<li class='sub categoria' id='$sub->id'><span>$sub->nombre</span>"; 
						echo buscarAgregado($categorias_container, $categorias_pedida, $sub->id)	;
						echo "</li>";
					}
					
				
			echo "</ul>";
			}
		echo "</div>";
	
		/*echo "<div class='supercategoria' id='$key'>";
		echo "<p class='titulo_seccion'>$key</p>";
		if ($categorias_container == "select") echo "<select id='categorias'><option value=''>Todos</option>";
		
		$num = 0;
		$extendido = false;
		foreach ($cat[$key] as $key=>$value) {
			$num++;
			$selected = "";
			$value->nombre = ucfirst($value->nombre);
			if ($categorias_container == "select") {
				$selected = (strpos($categorias_pedida, "*".$value->id."*") === false) ? "" : "selected='selected'";
				echo "<option value='$value->id' $selected>$value->nombre</option>";
				}
			else if ($categorias_container == "checkbox")
				{ 
				$selected = (strpos($categorias_pedida, "*".$value->id."*") === false) ? "" : "checked='checked'";		
				echo "<div class='categoria' id='$value->id'>
						<input type='checkbox' id='$value->id' $selected /><span>$value->nombre</span></div>";
			}
			else if ($categorias_container == "menu_desplegable") {
				if ($num > $maximo_menu and !$extendido) 
					{
					echo "<div class='categoria extender'>Ver más...<div class='extendido'><div class='categoria' id='$value->id'>$value->nombre</div>"; 
					$extendido = true;
					}
				else
					echo "<div class='categoria' id='$value->id'>$value->nombre</div>"; 	
			}
			else 
			echo "<div class='categoria' id='$value->id'>$value->nombre</div>"; 
		}
		if ($categorias_container == "select") echo "</select>";
		if ($categorias_container == "menu_desplegable" and $num > $maximo_menu) {
			echo "</div></div>\n";
		}
		echo "</div>";*/
	
	}
	
	?>