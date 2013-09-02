<?
	require_once "conexion.php";
	require_once "auxiliares.php";


	/*function buscarAgregado($container_categoria, $categorias_pedida, $id_actual) {
		if ($container_categoria == "checkbox")
			{
			$selected = (strpos($categorias_pedida, "*".$id_actual."*") === false) ? "" : "checked='checked'";
			return "<input type='checkbox' id='$id_actual' $selected />";
			}
	
	}*/



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
		
		
		echo "<li id='a$rk->id' class='categoria super'><span class='cufon' id='$rk->id'>$rk->nombre</span>";


			if ( count($k[childs]) )
				
				{
					echo "<ul>";	
					foreach ($k[childs] as $sub)
					{
						echo "<li class='sub categoria' id='$sub->id'>$sub->nombre"; 
						echo "</li>";
					}
					echo "</ul>";		
				}
			
	
		echo "</li>";
	
		
	
	}
	
	?>