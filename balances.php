<div class='recuadro azul' id='buscar_cheques'>
	<h2>Buscar retenciones</h2>
	<form id='datos'>
		<label>IVA Compras: </label>
		<select id='fuente' name='fuente'>
			<option value='2'>Con IVA discriminado</option>
			<option value='0'>No oplica</option>
			<option value='-1'>Todos</option>
		</select>
		<label>IVA Ventas: </label>
		<select id='venta' name='venta'>
			<option value='3'>Con IVA discriminado e incluido (A y B)</option>
			<option value='2'>Con IVA discriminado (A)</option>
			<option value='1'>Con IVA incluido (B)</option>
			<option value='0'>Sin IVA</option>
			<option value='-1'>Todos</option>
		</select>
		<br>
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


		$('a.buscar').click(function(e) {
			e.stopImmediatePropagation();
			var datos = 'accion=listados&que=movimiento&' + $('#datos input, #datos select').serialize();
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