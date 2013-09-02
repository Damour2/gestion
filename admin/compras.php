<?

include "funciones-ventas.php";
$estados = array('pendiente', 'confirmada', 'cancelada');
 $offset = cargar('offset', 0);
 $estado = cargar('estado', '');
$usuario = cargar('usuario', 0); ?>

<div class="recuadro">
	<p>Mostrar operaciones que están
    	<select onChange="cambiarTipo()" id="tipo">
        	<?
			foreach ($estados as $i) {
						$selected = ($i == $estado) ? "selected='selected'" : '';
						echo "<option value='$i' $selected>".ucfirst($i)."s</option>";
					}
			?>
            
        </select>
    </p>
</div>

<?



$where = array();
if ($usuario != 0) $where[] = "a.usuario = $usuario";
if ($estado != '') $where[] = "a.status = '$estado'";

$where = (count($where)) ? "WHERE ".implode(' AND ', $where) : '';

/*echo "SELECT SQL_CALC_FOUND_ROWS id_ses, a.tipo, a.fecha, a.status, total, b.nombre, COUNT(*)-1 as cuantos, DATE(a.fecha) as cuando, d.imagen, e.usuario, e.id_cli
							FROM movimientos a 
							LEFT JOIN movimientos_detalle b USING (id_ses) 
							LEFT JOIN (SELECT id_art, id_img FROM imagenes_articulo WHERE relacion ='foto' OR relacion = 'no especificado') c ON b.id_art = c.id_art
							LEFT JOIN imagenes d USING (id_img)
							LEFT JOIN usuarios e ON e.id_cli = a.usuario
							$where GROUP BY id_ses ORDER BY a.status DESC, a.fecha DESC LIMIT $offset, 20"; */
							
							

$q = mysql_query("SELECT SQL_CALC_FOUND_ROWS id_ses, a.tipo, a.fecha, a.status, total, b.nombre, COUNT(*)-1 as cuantos, DATE(a.fecha) as cuando, d.imagen, e.usuario, e.id_cli
							FROM movimientos a 
							LEFT JOIN movimientos_detalle b USING (id_ses) 
							LEFT JOIN (SELECT id_art, id_img FROM imagenes_articulo WHERE relacion ='foto' OR relacion = 'no especificado') c ON b.id_art = c.id_art
							LEFT JOIN imagenes d USING (id_img)
							LEFT JOIN usuarios e ON e.id_cli = a.usuario
							$where GROUP BY id_ses ORDER BY a.status DESC, a.fecha DESC LIMIT $offset, 20") or die(mysql_error());
			
	while ($r = mysql_fetch_assoc($q)) {
			$status = $r[status] == 'pendiente' ? 'pendiente' : 'otras';
			$items[$status][] = $r;	
		}
		//print_r($items);
		if (!mysql_num_rows($q)) echo "<h2>No has realizado ninguna compra aún.</h2>";
		
		if (count($items[pendiente])) {
			echo "<h2>Compras pendientes de confirmación</h2>";
			echo "<div class='resultados'>";
			foreach ($items[pendiente] as $e) 
				listarItem($e);
			echo "</div>";
		}
		
		if (count($items[otras])) {
			echo "<h2>Compras ya confirmadas</h2>";
			echo "<div class='resultados'>";
			foreach ($items[otras] as $e) 
				listarItem($e);
			echo "</div>";
		}
		
	
	
	
	
	
	
	?>
	
    
    <script>
	function cambiarTipo() {
		var tipo = $('#tipo').val();
		window.location = '?accion=compras&estado='+tipo;	
	}
	</script>