<div class='recuadro' id='buscar_cheques'>
	<h2>Buscar cheques</h2>
	<form id='datos'>
		<label>Fuente: </label>
		<select id='fuente' name='fuente'>
			<option value='cliente'>Pagos de clientes</option>
			<option value='proveedor'>Entregados a proveedores</option>
		</select>
		<label>Tipo:</label>
		<select id='nombre' name='nombre'>
			<option value=''>Cualquiera</option>
			<option value='Cheque propios'>Cheques propios</option>
			<option value='Cheque de terceros'>Cheques de terceros</option>
		</select>
		<label>Estado:</label>
		<select name='activo' id='activo'>
			<option value='-1'>Cualquiera</option>
			<option value='1'>Por cobrar</option>
			<option value='2'>Cobrado</option>
			<option value='3'>Rebotado</option>
		</select>
		<p>
			<label>Desde:</label>
			<input id='de_fecha' name='de_fecha' value='<?=date('d-m-Y', time() - 60 * 60 * 24 * 30)?>'>
			<label>Hasta:</label>
			<input id='hasta_fecha' name='hasta_fecha' value='<?=date('d-m-Y')?>'>
			<a class='boton rojo buscar'>Buscar ahora</a>
		</p>
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
			var datos = 'accion=listados&que=cheques&' + $('#datos input, #datos select').serialize();
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