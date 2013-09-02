<div id="filtros" class="recuadro">
	<h2><a href="?accion=faltantes&que=productos">Productos</a> <---> <a href="?accion=faltantes&que=materias">Materias primas</a></h2>

</div>
<div class="resultados">
<?
$que = Utils::cargar('que', 'productos');

if ($que == 'productos') $DB->select('variantes LEFT JOIN articulo USING (id_art)', "id_art as id, CONCAT(nombre, ' ', variante) as nombre, stock, stock_minimo", 'stock < stock_minimo AND stock_minimo > 0 AND stock_minimo IS NOT NULL AND stock IS NOT NULL');

else  $DB->select('materias_primas', 'id_mat as id, nombre, stock, stock_minimo', 'stock < stock_minimo AND stock_minimo > 0 AND stock_minimo IS NOT NULL AND stock IS NOT NULL');

foreach ($DB->results as $r) {
	echo "<div class='linea' id='$r[id]'>$r[nombre]	<span class='stock'>Stock: $r[stock]</span> <span class='stock_minimo'>Stock Mínimo: $r[stock_minimo]</span></div>";
}

?>
</div>


<script>
	$(document).ready(function() {
		actualizarImpares();
	});

</script>