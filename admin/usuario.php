<?

include "funciones-ventas.php";

$id = cargar('id', '');
$usuario = cargar('usuario', 0);

$where = array();
$usuario = $id;
//if ($estado != '') $where[] = "a.status = '$estado'";



$consulta = "SELECT ingreso, nombre,usuario, direccion, ciudad, codigo_postal, provincia, mail, telefono, avatar FROM usuarios WHERE id_cli = $id";
$q = mysql_query($consulta) or die(mysql_error());
$r = mysql_fetch_assoc($q);

thumb($r[avatar], 0, 50, 50, '', '../', 'div', 1,0,'fltlft','');
echo "<h2>$r[usuario]</h2><br>";
foreach ($r as $k => $v)
	if ($k != 'avatar' and $k != 'usuario') echo "<p>".ucfirst($k).": <b>$v</b></p>";



$nombre = $r[usuario];








$where = (count($where)) ? "WHERE ".implode(' AND ', $where) : '';

echo $where;

$q = mysql_query("SELECT id_ses, a.tipo, a.fecha, a.status, total, b.nombre, COUNT(*)-1 as cuantos, DATE(a.fecha) as cuando, d.imagen, e.usuario, e.id_cli
							FROM movimientos a 
							LEFT JOIN movimientos_detalle b USING (id_ses) 
							LEFT JOIN (SELECT id_art, id_img FROM imagenes_articulo WHERE relacion ='foto' OR relacion = 'no especificado') c ON b.id_art = c.id_art
							LEFT JOIN imagenes d USING (id_img)
							LEFT JOIN usuarios e ON e.id_cli = a.usuario
							WHERE a.usuario = $id GROUP BY id_ses ORDER BY a.status DESC, a.fecha DESC") or die(mysql_error());
			
	while ($r = mysql_fetch_assoc($q)) {
			//$status = $r[status] == 'pendiente' ? 'pendiente' : 'otras';
			$items[$r[status]][] = $r;	
		}
		//print_r($items);
		if (!mysql_num_rows($q)) echo "<h2>No has realizado ninguna compra aún.</h2>";
		
		if (count($items[pendiente])) {
			echo "<h2>Compras pendientes de confirmación de $nombre</h2>";
			echo "<div class='resultados'>";
			foreach ($items[pendiente] as $e) 
				listarItem($e);
			echo "</div>";
		}
		
		if (count($items[confirmada])) {
			echo "<h2>Compras ya concretadas de $nombre</h2>";
			echo "<div class='resultados'>";
			foreach ($items[confirmada] as $e) 
				listarItem($e);
			echo "</div>";
		}
		
		if (count($items[cancelada])) {
			echo "<h2>Compras canceladas de $nombre</h2>";
			echo "<div class='resultados'>";
			foreach ($items[cancelada] as $e) 
				listarItem($e);
			echo "</div>";
		}
		
		
		
?>