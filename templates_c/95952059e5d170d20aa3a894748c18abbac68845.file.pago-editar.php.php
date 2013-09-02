<?php /* Smarty version Smarty-3.1.11, created on 2013-06-12 04:34:23
         compiled from ".\templates\pago-editar.php" */ ?>
<?php /*%%SmartyHeaderCode:3150050b3e32dc61d17-73562205%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '95952059e5d170d20aa3a894748c18abbac68845' => 
    array (
      0 => '.\\templates\\pago-editar.php',
      1 => 1371004457,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3150050b3e32dc61d17-73562205',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50b3e32dd122d0_20366225',
  'variables' => 
  array (
    'fecha' => 0,
    'mov' => 0,
    'detalles' => 0,
    'r' => 0,
    'formas_pago' => 0,
    'fp' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50b3e32dd122d0_20366225')) {function content_50b3e32dd122d0_20366225($_smarty_tpl) {?><div id="pago-in">
	

	<p class="titulo_recuadro">Formas de pago<img class="loader" src="img/loader.gif"></p>
    	
   		<p><label>Fecha</label>
   			<input type="text" id="fecha_pago" value='<?php echo $_smarty_tpl->tpl_vars['fecha']->value;?>
'>
   		</p>
   		
       <input type="hidden" id="id_cli" name="id_cli" value="<?php echo $_smarty_tpl->tpl_vars['mov']->value['id_cli'];?>
" />
       <input type="hidden" id="id" name="id" value="<?php echo $_smarty_tpl->tpl_vars['mov']->value['id_ses'];?>
" />
		<?php if ($_smarty_tpl->tpl_vars['detalles']->value){?>
		<?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['detalles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value){
$_smarty_tpl->tpl_vars['r']->_loop = true;
?>
		<div class="linea <?php if ($_smarty_tpl->tpl_vars['r']->value['nombre']=="transferencia"){?> transferencia <?php }?> <?php if ($_smarty_tpl->tpl_vars['r']->value['nombre']=="cheque propio"||$_smarty_tpl->tpl_vars['r']->value['nombre']=="cheque de terceros"){?> cheque <?php }?>">
			<label>Tipo de pago:</label>
			<select class='nombre'>
				<?php  $_smarty_tpl->tpl_vars['fp'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['fp']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['formas_pago']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['fp']->key => $_smarty_tpl->tpl_vars['fp']->value){
$_smarty_tpl->tpl_vars['fp']->_loop = true;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['fp']->value['nombre'];?>
" <?php if ($_smarty_tpl->tpl_vars['fp']->value['nombre']==$_smarty_tpl->tpl_vars['r']->value['nombre']){?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['fp']->value['nombre'];?>
</option>
				<?php } ?>
			</select>
	        <label>Monto:</label>
	        <input type="text" class="importe" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['importe'];?>
" />
	        <a class='boton rojo eliminar'></a>
	        <div class='info transferencia'>
	        	<p>
	        		<span>Cuenta/Banco origen</span><input type='text' class='banco_origen' value="<?php echo $_smarty_tpl->tpl_vars['r']->value['banco_origen'];?>
" />
	        		<span>Cuenta/Banco destino</span><input type='text' class='banco_destino' value="<?php echo $_smarty_tpl->tpl_vars['r']->value['banco_destino'];?>
"/>
	        	</p>
	        </div>
	        <div class='info cheque'>
	        	<p>
	        		<span>Banco origen</span><input type='text' class='banco_origen' value="<?php echo $_smarty_tpl->tpl_vars['r']->value['banco_origen'];?>
"/>
	        		<span>Numero</span><input type='text' class='id_var' value="<?php echo $_smarty_tpl->tpl_vars['r']->value['id_var'];?>
"/>
	        	</p>
	        	<p>
	        		<span>Fecha emision</span><input type='text' class='fecha_emision' value="<?php echo $_smarty_tpl->tpl_vars['r']->value['fecha_emision'];?>
"/>
	        		<span>Fecha cobro</span><input type='text' class='fecha_cobro' value="<?php echo $_smarty_tpl->tpl_vars['r']->value['fecha_cobro'];?>
"/>
	        	</p>
	        </div>
        </div>
        <?php } ?>
        <?php }?>
        <div class="linea clonar">
			<label>Tipo de pago:</label>
	        <select class='nombre'>
				<?php  $_smarty_tpl->tpl_vars['fp'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['fp']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['formas_pago']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['fp']->key => $_smarty_tpl->tpl_vars['fp']->value){
$_smarty_tpl->tpl_vars['fp']->_loop = true;
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['fp']->value['nombre'];?>
"><?php echo $_smarty_tpl->tpl_vars['fp']->value['nombre'];?>
</option>
				<?php } ?>
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
</script><?php }} ?>