<?

	$cat = array();
	$cat[genero] = array();
	$cat[producto] = array();
	$cat[marca] = array();
	$cat[actividad] = array();
	
	$qcar = mysql_query("SELECT id_cat, tipo, nombre FROM categorias");
	while($rcat = mysql_fetch_object($qcar)) {
		$cat[$rcat->tipo][] = new Categoria($rcat->nombre, $rcat->id_cat);
	}
	
	
	foreach ($cat as $key => $value) {
	
		echo "<div class='supercategoria' id='$key'>";
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
		echo "</div>";
	
	}
	
	?>