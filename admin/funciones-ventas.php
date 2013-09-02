<?

function listarItem($e) {
	global $num;
	$estados = array('pendiente', 'confirmada', 'cancelada');
	$num++;
	$par = ($num % 2 == 0) ? 'par' : 'impar';
	 $nombre =  ($e[cuantos] > 1) ? $e[nombre]." y $e[cuantos] artículos más" : $e[nombre];
				echo "<div class='linea $e[status] $par' id='$e[id_ses]'>";
					thumb($e[imagen], 0, 100, 80, '', '../', 'div', 0,0, '', '');
					echo "<a onclick='detalles(this)'>$nombre ... $ $e[total]</a>";
					echo "<a class='usuario' href='in.php?accion=usuario&id=$e[id_cli]'>(USUARIO: $e[usuario])</a>";
					echo "<div class='valor'></div>";
					echo "<div class='status'>Estado:
							<select>";
					foreach ($estados as $i) {
						$selected = ($i == $e[status]) ? "selected='selected'" : '';
						echo "<option value='$i' $selected>".ucfirst($i)."</option>";
					}
					echo "</select></div>";
					echo "<div class='fecha'>".date('d-m-Y', time($e[fecha]))."</div>";
					echo "<div class='detalles'></div>";
				echo "</div>";			
}



?>



<script type='text/javascript'>
	
	function detalles(obj) {
		
		obj = $(obj).closest('.linea');
		if (obj.find('div.detalles p').length)
			obj.find('div.detalles').slideToggle();
		else
		{
			var idi = obj.attr('id');
		
			$.get('../tienda/library/usuario/api_carro.php', {accion: 'detalles', id: idi}, function(d) {
					obj.find('div.detalles').html(d).hide().slideDown(400);
			});
		}
	}
	
	
	$(document).ready(function() {
		$("div.linea select").change(function() {
			$.post('../tienda/library/usuario/api_carro.php', {accion: 'datoCompras', id: $(this).closest('div.linea').attr('id'), campo : 'status', valor : $(this).val() });
				
		});
	});
</script>