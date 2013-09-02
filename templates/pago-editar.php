<div id="pago-in">
	

	<p class="titulo_recuadro">Formas de pago<img class="loader" src="img/loader.gif"></p>
    	
   		<p><label>Fecha</label>
   			<input type="text" id="fecha_pago" value='{$fecha}'>
   		</p>
   		
       <input type="hidden" id="id_cli" name="id_cli" value="{$mov.id_cli}" />
       <input type="hidden" id="id" name="id" value="{$mov.id_ses}" />
		{if $detalles}
		{foreach from=$detalles item=r}
		<div class="linea {if $r.nombre == "transferencia"} transferencia {/if} {if $r.nombre == "cheque propio" || $r.nombre == "cheque de terceros"} cheque {/if}">
			<label>Tipo de pago:</label>
			<select class='nombre'>
				{foreach item=fp from=$formas_pago}
					<option value="{$fp.nombre}" {if $fp.nombre == $r.nombre} selected="selected" {/if}>{$fp.nombre}</option>
				{/foreach}
			</select>
	        <label>Monto:</label>
	        <input type="text" class="importe" value="{$r.importe}" />
	        <a class='boton rojo eliminar'></a>
	        <div class='info transferencia'>
	        	<p>
	        		<span>Cuenta/Banco origen</span><input type='text' class='banco_origen' value="{$r.banco_origen}" />
	        		<span>Cuenta/Banco destino</span><input type='text' class='banco_destino' value="{$r.banco_destino}"/>
	        	</p>
	        </div>
	        <div class='info cheque'>
	        	<p>
	        		<span>Banco origen</span><input type='text' class='banco_origen' value="{$r.banco_origen}"/>
	        		<span>Numero</span><input type='text' class='id_var' value="{$r.id_var}"/>
	        	</p>
	        	<p>
	        		<span>Fecha emision</span><input type='text' class='fecha_emision' value="{$r.fecha_emision}"/>
	        		<span>Fecha cobro</span><input type='text' class='fecha_cobro' value="{$r.fecha_cobro}"/>
	        	</p>
	        </div>
        </div>
        {/foreach}
        {/if}
        <div class="linea clonar">
			<label>Tipo de pago:</label>
	        <select class='nombre'>
				{foreach item=fp from=$formas_pago}
					<option value="{$fp.nombre}">{$fp.nombre}</option>
				{/foreach}
			</select>
	        <label>Monto:</label>
	        <input type="text" class="importe" value="" />
	        <a class='boton rojo eliminar'></a>
	        <div class='info transferencia'>
	        	<p>
	        		<span>Cuenta/Banco origen</span><input type='text' class='banco_origen' />
	        		<span>Cuenta/Banco destino</span><input type='text' class='banco_destino' />
	        	</p>
	        </div>
	        <div class='info cheque'>
	        	<p>
	        		<span>Banco origen</span><input type='text' class='banco_origen' />
	        		<span>Numero</span><input type='text' class='id_var' />
	        	</p>
	        	<p>
	        		<span>Fecha emision</span><input type='text' class='fecha_emision' />
	        		<span>Fecha cobro</span><input type='text' class='fecha_cobro' />
	        	</p>
	        </div>
        </div>
        
        <p class="total"><b>Total: $ <span>0.00</span></b></p>
        <p class='resta'><b>Resta pagar: $ <span></span></b></p>
        <p><a class='boton insertar nuevo_pago'>Insertar nuevo medio de pago</a></p>
        
        <a class="boton rojo" onClick="descartarPago()">Descartar</a> 
        <a class="boton azul guardar">Guardar</a>
</div>


<script>
	console.log("ojj");

	function ponerDatepicker(obj) {
		obj.datepicker({
			altFormat: "dd-mm-yy",
			dateFormat: "dd-mm-yy", 
		});
	}

	var $pagos = $('#pago-in');
	pasar = true;
	calcularTotalPagos();
	
	itemPagosHtml = $('.linea.clonar').clone();

	
	$('.nombre', $pagos).live('change', function() {
		var tipo = $(this).val();
		if (tipo == 'cheque propio' || tipo == 'cheque de terceros') tipo = 'cheque';
		$(this).closest('.linea').attr('class', 'linea '+ tipo);
	});

	$('.eliminar', $pagos).live('click', function() {
		if ($('#pago-in .linea').length > 1) {
			$(this).closest('.linea').fadeOut(400, function() {
				$(this).remove();
			})
		}
	});
	$('.insertar', $pagos).click(function(e) {
		e.stopImmediatePropagation();
		var insert = itemPagosHtml.clone();
		insert.insertBefore($pagos.find('.total'));
		ponerDatepicker(insert.find('.fecha_cobro, .fecha_emision'));
	});
	
	$('.importe', $pagos).live('change', function() {
		calcularTotalPagos();
	})
		.live('keydown', function(event) {
			if (event.keyCode == 13) {
				if (!$(this).closest('.linea').next('.linea').length) 
					$pagos.find('.insertar').click();
					$(this).change();
					$(this).closest('.linea').next('.linea').find('.nombre').focus();
			}
		});
	
	
	$pagos.find('.guardar').click(function() {
		$('.loader', $pagos).show();
		datos = {
			tipo: 'pago',
			total : $pagos.find('.total span').text(),
			id : $pagos.find('#id').val(),
			id_cli : $pagos.find('#id_cli').val(),
			fecha: $('#fecha_pago', $pagos).val(),
			pago: (window.sesion) ? sesion.id : 0, //guarda el numero de movimiento asociado al pago
			detalle : []			
		}
		$('.linea', $pagos).each(function() {
			var nombre = $(this).find('.nombre').val();
			var importe = $(this).find('.importe').val();
			if (nombre != "" && importe != '') {
				var item = {
					nombre: nombre, 
					importe: importe,
					banco_origen : '',
					banco_destino : '',
					id_var : 0,
					fecha_emision : '',
					fecha_cobro : ''
					};
					if ($(this).hasClass('cheque')) {
						item.banco_origen = $(this).find('.cheque .banco_origen').val();
						item.id_var = $(this).find('.cheque .id_var').val();
						item.fecha_emision = $(this).find('.cheque .fecha_emision').val();
						item.fecha_cobro = $(this).find('.cheque .fecha_cobro').val();
					}
					else if ($(this).hasClass('transferencia')) {
						item.banco_origen = $(this).find('.transferencia .banco_origen').val();
						item.banco_destino = $(this).find('.transferencia .banco_destino').val();
					}
				datos.detalle.push(item);
			}
		});
		$.post('api.php?accion=guardar&que=movimiento', {
														value : JSON.stringify(datos) 
														}, function() {
			$('.loader').hide();
			postPago();
		});
	});
	
	$('#fecha_pago', $pagos).focus().datepicker({
		altFormat: "dd-mm-yy",
		dateFormat: "dd-mm-yy", 
		onSelect: function() {
			if ($(this).nextAll('input').length) {
				$(this).nextAll('input:first').focus();
			}
			else if (this.id == 'fecha_pago') {
				$('.linea:first .nombre', $pagos).focus();
			}
		}
	});

	ponerDatepicker($('.fecha_emision, .fecha_cobro', $pagos));

	
	
	if ($('#productos').length) // es de compras
	{
		
	}
	else { //es de cuenta corriente
		$('.resta', $pagos).hide();
	}
	
	
	if (!$('#fecha').length || $('#fecha').val() == '') {
			$('#fecha_pago', $pagos).datepicker('show');
	}
	else {
		$('#fecha_pago', $pagos).val($('#fecha').val());		
		$('.linea:first .nombre', $pagos).focus();
	}
		
		
	$('.nombre', $pagos).live('keydown', function(event) {
		if (event.keyCode == 13) {
			if (pasar) {
				var obj = $(this).nextAll('.importe');
				console.log('poner resta');
					obj.val($('.resta span').text());
				obj.focus().select();
			}
			else
			pasar = true;
		}
	});
	
	function calcularTotalPagos() {
		var total = 0;
		$pagos.find('.linea').each(function() {
			var este = parseFloat($('.importe', this).val());
			total = isNumber(este) ? total + este : total;
		});		
		$pagos.find('.total span').html(total);
		
		if ($('#productos').length) // es de compras
		{
			console.log('compra');
			var totCompra = parseFloat($('#totales span').text());
			var resta = roundNumber(totCompra - total, 2);
			console.log(total);
			$('.resta span', $pagos).html(resta);
		}
	}
	
	
	function autoCompletar(obj) {
		obj.autocomplete({
				source: "api.php?que=pago&accion=search",
				minLength: 2,
				select: function(event) {
					pasar = false;
				}
			});
	}

	function descartarPago() {
		if (typeof preguntarPorPago == "function")
			preguntarPorPago();
		else 
			cerrar_ventana();
	}
</script>