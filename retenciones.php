<div class='recuadro' id='buscar_cheques'>
	<h2>Buscar cheques</h2>
	<form id='datos'>
		<label>Fuente: </label>
		<select id='fuente' name='fuente'>
			<option value=''>De cualquier fuente</option>
			<option value='cliente'>Retenido en compras de clientes</option>
			<option value='proveedor'>Retenido en pagos a proveedores</option>
		</select>
			<label>Desde:</label>
			<input id='de_fecha' name='de_fecha' value='<?=date('d-m-Y', time() - 60 * 60 * 24 * 30)?>'>
			<label>Hasta:</label>
			<input id='hasta_fecha' name='hasta_fecha' value='<?=date('d-m-Y')?>'>
			<a class='boton rojo buscar'>Buscar ahora</a>
	</form>
</div>


<div class='resultados' id='resultados'>

</div>


<script type='text/javascript'>
	$(document).ready(function() {
		$('#de_fecha, #hasta_fecha').datepicker({
		altFormat: "dd-mm-yy",
		dateFormat: "dd-mm-yy", 
		});


		$('a.buscar').click(function() {
			var datos = 'accion=listados&que=retenciones&' + $('#datos input, #datos select').serialize();
			$.get('api.php?' + datos, function(d) {
				$('#resultados').html(d);
			})
		}).trigger('click');


		$('select.activo').live('change', function() {
			var $this = $(this);
			$this.addClass('cargando');
			$.get('api.php', {accion: 'modificar', que : 'cheques', id: $this.closest('.linea').attr('id'), activo : $this.val()}, function() {
				$this.removeClass('cargando');
			})
		})

	})
</script>