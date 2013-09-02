<? $tipoUsuario = ($_GET[status] == 'cliente') ? "cliente" : "proveedor"; 
	if (isset($_GET[id_cli])) {
		$db = new DB();
		$db->select('clientes', 'nombre, id_cli', "id_cli = $_GET[id_cli]");
		$cliente = count($db->results) ? $db->results[0] : array(); 
	}
?>

<div class="recuadro azul ancho" id="tipoComprobante">
	<h3>Condiciones del comprobante para <?=($_GET[status] == 'cliente') ? "cliente" : "proveedore" ?>s - TIPO 
    	<select id='tipo' name="tipo">
        	<option value="compra">Compra</option>
            <option value="nota de credito">Nota de crédito</option>
            <option value="nota de debito">Nota de débito</option>
        </select>
            
    </h3>
    <label><?=ucfirst($tipoUsuario)?></label><input type="text" id="proveedor" name="proveedor" />
    <a class="boton insertar">Crear nuevo <?=$tipoUsuario?></a>
    <label>Fecha</label><input type="text" id="fecha" name="fecha" />
    <label>IVA</label>
    <select id="iva_movimiento" name="iva_movimiento">
    	<option value="0">No aplica</option>
    	<? if ($_GET[status] == 'cliente') { ?>
        <option value="1">Incluido</option>
        <? } ?>
        <option value="2">Discriminado</option>
     </select>
     <br />
     <label>Factura</label><input type="text" id="factura" name="factura" />
     <label>Remito</label><input type="text" id="remito" name="remito" />
     
     
</div>

<div class="recuadro azul ancho">
	<h3><?=($_GET[status] != 'cliente') ? "Materias compradas" : "Productos vendidos"?></h3>
    <label>Cantidad</label><input type="text" id="cantidad" name="cantidad" />
    <label>Articulo</label><input type="text" id="articulo" name="articulo" />
    <? if ($_GET[status] == "cliente") { ?>
    	<label>Variante</label>
    	<select id='variante' name='variante'>
    		<option value='0'>Seleccione una variante</option>
    	</select>
    	<br />
    <? } ?>
	<label>Precio unitario<input type="text" id="precio_unitario" name="precio_unitario" />    
    <a class="boton rojo agregar">Agregar</a>
</div>


<div class="resultados" id="productos">
	<h2><?=($_GET[status] != 'cliente') ? "Materias" : "Productos"?></h2>
    <h3 class="rojo">
    	<span class="cantidad">Cantidad</span>
        <span class="nombre">Producto</span>
        <span class="valor">Valor unitario</span>
        <span class="valor_mayor">Importe</span>
        
    </h3>
</div>


<div class="resultados">
	<div class="recuadro" id="subtotal">
    	SUBTOTAL: $ <span>0.00</span>
    </div>
	 <label>Descuento</label><input type="text" id="descuento" />
     <label>Retenciones</label><input type="text" id="recargo" name="recargo" />
     <label>IVA</label><input type="text" id="iva_aplicado" name="iva_aplicado" />
    <div class="recuadro" id="totales">
    	TOTAL: $ <span>0.00</span>
    </div>
</div>

<div id="botones">
    <a class="boton borrar">BORRAR</a>
    <a class="boton rojo guardar">GUARDAR</a>
</div>

 
 <script src="library/json2.js"></script>
 <script type="text/javascript">
 
 function cargarMovimiento(mov) {
	var aCargar = [ 'tipo', 'fecha', 'descuento', 'factura', 'fecha', 'remito', 'iva_movimiento','pago', 'recargo' ];
	
	
	for (var i in aCargar)
	{
		console.log(i + ': '+ aCargar[i] + '    : mov   ' + mov[aCargar[i]] );	
		$('#'+aCargar[i]).val(mov[aCargar[i]]);
	}
	
	$('#proveedor').val(mov.cliente).data('id_cli', mov.id_cli).attr('disabled', 'disabled').next('boton').hide();
	sesion.id_cli = mov.id_cli;
 }
 
 $(document).ready(function() {
 	sesion = { id : <?=(empty($_GET[id])) ? "0" : $_GET[id] ?>, 
				nombre : "", 
				status : "<?=$tipoUsuario?>", 
				id_cli : <?=!empty($cliente[id_cli]) ? $cliente[id_cli] : 0 ?>, 
				proveedor :   "<?=!empty($cliente[nombre]) ? $cliente[nombre] : '' ?>",
			};
	mensajes = {
		usuarioCreado : "El nuevo <?=$tipoUsuario?> ha sido creado.",
		titulo : "Operaciones con <?=($_GET[status] == 'cliente') ? "cliente" : "proveedore" ?>s"
	}
	
	$('h1').html(mensajes.titulo);
	$('#fecha').datepicker({
		altFormat: "dd-mm-yy",
		dateFormat: "dd-mm-yy", 
		onSelect: function() {
			$('#iva_movimiento').focus();
		}
	});
	
	if (sesion.id_cli != 0) predeterminarCliente();
	
	if (sesion.id != 0) {
		$.get("api.php", { accion: "cargar", que: "movimiento", id : sesion.id }, function(d) {
			if (d.status == "ok") {
				console.log(d);
				cargarMovimiento(d.movimiento);
				for (var i in d.results)
					agregarItem(d.results[i], true);
				sesion.nombre = d.nombre;	
				sesion.tipo = d.tipo;
				//$("#elegirSesion").val(sesion.id);
				calcularTotal();
				
			}
		}, 'json');
	}			
	
	$("#elegirSesion").change(function() {
		window.location = "?accion=inversion&id="+$(this).val();
	});
	
	$('#proveedor').autocomplete({
				source: "api.php?que=<?=$tipoUsuario?>&accion=search",
				minLength: 2,
				select: function( event, ui ) {
					cargarProveedor(this, ui.item);
					event.stopImmediatePropagation();
					return false;
				}
			});
	
	
	$('#articulo').autocomplete({
				source: "api.php?que=<?=($_GET[status] == 'cliente') ? "producto" : "materia" ?>&accion=search",
				minLength: 2,
				select: function( event, ui ) {
					cargarItem(this, ui.item);
					event.stopImmediatePropagation();
					return false;
				}
	});
			
	
	
	$("#cantidad").keypress(function(event) {
		if (event.keyCode == 13) {
			$('#articulo').focus();
		}
	});
	
	$("a.eliminar").live('click', function() {
		eliminar(this);
	});
	
	
	$(".guardar").click(function() {
		console.log('se');
		
	er = $('#proveedor').data('id_cli');
	if (!$('#proveedor').data('id_cli')) {
		alert('No ha especificado el cliente/proveedor de esta operacion!');
		return;
	} 
		$('#loader').show();
		datos = prepararDatos(false);
		$.post("api.php", 
				{ accion : "guardar", value : prepararDatos(true), que: 'movimiento' }, 					
			function(d) {
				if (d.status == "ok") {
					sesion.id = d.id;
					preguntarPorPago();
				}
				else {alert("Ha ocurrido un error.") ; }
		}, 'json');
		 // $('#botones a').hide();
	});
	
	$(".borrar").click(function() {
		if (confirm("Desea eliminar todos los registros de esta sesion?")) {
			
			if (sesion.id) $.post("api.php", { accion: "eliminarInversion", que: "producto", id: sesion.id}, function() {
				window.location = "?accion=inversion";
			});
			else 
			{ $("div.linea").remove(); } 
			
		}
								  
	});


	


	$('#iva_aplicado, #descuento, #recargo, #iva_movimiento').change(function(e) {
		actualizarIva();
        calcularTotal();
    });

	
	$(".imprimir").click(function() {
		window.print();
	});
	
	 $("a.boton.insertar").live('click', function() {
		editar(this);
	});

	$('a.agregar').click(function(e) {
        agregarItem();
    });
	
	
	
	$('#precio_unitario').keypress(function(e) {
        if (e.keyCode == 13)
			$('a.agregar').click();
    });

    $('#variante').keypress(function(e) {
        if (e.keyCode == 13)
			$('#precio_unitario').focus().select();
    });
	
	createImageViewer();
 });
 
 
 function predeterminarCliente() {
	$('#proveedor').val(sesion.proveedor).data('id_cli', sesion.id_cli);
	$('#fecha').focus().datepicker('show');
 }
 
 function cargarProveedor(obj, item) {
 	sesion.id_cli = item.id;
	$('#proveedor').data('id_cli', item.id);
	$('#fecha').focus();
 }
 
 
 function cargarItem(obj, item, noActualizar) {
 	console.log(item);
	$('#articulo').data('id_mat', item.id);
	$('#precio_unitario').val(item.valor);
	if (sesion.status == 'cliente') {
		$.get('api.php', {accion: 'variantes', id: item.id, que : 'producto'}, function(data) {
			data.unshift({ id_var : 0, variante : 'Seleccione una variante'});
			var html = '';
			for (var i in data) {
				html += "<option value='"+data[i].id_var+"'>"+data[i].variante+"</option>";
			}
			$('#variante').html(html).val('0').focus();
		}, 'json');
	}
	else {
		$('#precio_unitario').focus().select();
	}
 }
 
 function agregarItem(item, noActualizar) {
	if (!item && ($("#cantidad").val() == '' || $("#articulo").val() == '' || $("#precio_unitario").val() == ''))
	 	return false;
 	var cantidad = (item) ? item.cantidad : parseFloat($("#cantidad").val()) ;
    var id_mat = (item) ? item.id : $('#articulo').data('id_mat');
    var id_var = (item) ? item.id_var :  $('#variante').val(); 
	var valor = (item) ? item.valor : parseFloat($('#precio_unitario').val());
	var nombre = (item) ? item.value : $('#articulo').val();

	if ($('#variante').length && $('#variante').val() != 0) {
		nombre += " ["+$('#variante option:selected').text()+"]";
	}

	$('#articulo').data('id_mat', 0);
	
	var templateLinea = "<div class='linea' id='"+id_mat+"' id_var='"+id_var+"'>\
							<span class='cantidad'>"+cantidad+"</span><span class='nombre'>"+nombre+"</span> \
							<span class='valor'><em>"+roundNumber(valor, 2)+"</em></span><span class='valor_mayor importe'><em>"+roundNumber((cantidad * valor), 2)+"</em></span><a class='boton azul eliminar'></a></div>"
	
 	$("#productos").append(templateLinea);
	
	$("#articulo, #cantidad, #precio_unitario").val('');
	$('#variante option:gt(0)').remove().val('0');
	$("#cantidad").focus();
	actualizarImpares('#productos');
	actualizarIva('last', noActualizar);
	if (!noActualizar) calcularTotal();
 }
 
 function actualizarIva(donde, noActualizar) {
 	 
 		
 	var obj = (donde == 'last') ? $('#productos .linea:last')
 							  : $('#productos .linea');
 	if (donde != 'last' && $('#iva_movimiento').val() != 1) {
 			$(".valor, .importe").removeClass('conIva').find('span').remove();
 	}
 	else if ($('#iva_movimiento').val() == 1) {
 		obj.each(function() {
 			$(this).find('.valor').append('<span>(<b>'+    roundNumber((parseFloat($(this).find('.valor em').text()) * 1.21), 2)      +'</b>)</span>').addClass('conIva');
 			$(this).find('.importe').append('<span>(<b>'+    roundNumber((parseFloat($(this).find('.importe em').text()) * 1.21), 2)      +'</b>)</span>').addClass('conIva');
 			})	
 	}
 	if (!noActualizar) calcularTotal();
 			
 								  
 }
 
 function eliminar(obj) {
	if (confirm("Seguro que desea eliminar este item?")) {
		obj = $(obj).closest('div.linea');
		obj.fadeOut(400, function() {
			$(this).remove();
			calcularTotal();
		});
	}
}
 
 
 function prepararDatos(comoJson) {
 	var datos = {
				status: "<?=$tipoUsuario?>",
				tipo : $('#tipo').val(),
				id : sesion.id,
				total : sesion.total,
				id_cli: $('#proveedor').data('id_cli'),
				fecha: $('#fecha').val(),
				iva_movimiento: $('#iva_movimiento').val(),
				pago: $('#pago').val(),
				remito: $('#remito').val(),
				factura: $('#factura').val(),
				descuento: $('#descuento').val(),
				recargo: $('#recargo').val(),
				subtotal: $('#subtotal span').text(),
				detalle: []
		};
	
 	$("#productos").find('.linea').each(function() {
		
 		  datos.detalle.push( { id_art : this.id , 
 		  				id_var : $(this).attr('id_var') == "undefined" ? 0 : $(this).attr('id_var'),
						cantidad : $(this).find('.cantidad').text(), 
						nombre:  $(this).find('.nombre').text(),
						valor_unitario:  $(this).find('.valor em').text(),
						importe:  $(this).find('.importe em').text(),
					} );
		
	});
	
	return (comoJson) ? JSON.stringify(datos) : datos;
	
 }
 
 

 function calcularTotal() {
	var total = 0;
 	
 	
 	$('#productos').find('div.linea').each(function() {
 		var obj = !$('.importe span', this).length ? $(this).find('.importe em')
													: $(this).find('.importe span b');
		var monto = parseFloat(obj.text());
		if (isNumber(monto)) total += monto;
	});
	
	var modificadores = {
		descuento : -parseFloat($('#descuento').val()) || 0,
		recargo : parseFloat($('#recargo').val()) || 0
	};
	
	//Si es un cliente la retencion es negativa
	if (sesion.status == 'cliente') {
		modificadores.recargo = -modificadores.recargo;
	}

	$("#subtotal").find('span').html(total);
	if ($('#iva_movimiento').val() == 2)
		$('#iva_aplicado').val(roundNumber(((total + modificadores.descuento) * 0.21), 2));
	else
		$('#iva_aplicado').val('0');
	
	
	
	modificadores.iva_aplicado = parseFloat($('#iva_aplicado').val()) || 0;
	
	for (var i in modificadores) {
		if (isNumber(modificadores[i]))
			total += modificadores[i];
	}
	sesion.total = isNumber(total) ? total : 0;	
	$("#totales").find('span').html(roundNumber(total, 2));
	
 }
 
 //Cambia el precio de las cosas seleccionadas
 //no se usa en compras
 function cambiar(obj) {
		alert('si')
		var obj = $(obj);
		
		obj.addClass('activo');
		var datos = {};
		datos.id = obj.closest('div.linea').attr('id');

		datos.accion = "update";
		datos.que = "materia"; 
		datos.campo = obj.closest('span').attr('class');
		datos.value = obj.val();
		$.post('api.php', datos, function(d) {
			console.log(d);
			obj.removeClass('activo');
		});
	}
 
 
 
	




function editar(obj) {
	
	
		cargarAjax("api.php?que=<?=$tipoUsuario?>&accion=editar&id=0", "Editar <?=($_GET[status] == 'cliente') ? "cliente" : "proveedor" ?>", 400, 394);
			
}

function guardar() {
	console.log('openModal');
	var datosUsuario = $('#ventana').find('input, select').serialize();
	console.log(datosUsuario);
	$('#ventana').find('#loader, .loader').show();
	$.post('api.php?accion=insert&que=<?=$tipoUsuario?>', datosUsuario, function(d) {
		alert(mensajes.usuarioCreado);	
		console.log(d);
		$('#proveedor').data('id', $(d).attr('id')).val($('#ventana #nombre').val());
		cerrar_ventana();
		$('#fecha').focus();
	});
}

function editarPago(id) {                               //parent es el cliente, compraID es el movimineot asociado
	cargarAjax("api.php?que=pago&accion=editar&id=0&parent="+sesion.id_cli+ "&compraId="+sesion.id, "Editar Pago", 800, 250);
}

function preguntarPorPago() {
	cargarAjax("api.php?que=pago&accion=preguntarPorPago", 'Datos guardados', 600, 150);
}

function postPago(notPay) {
	cargarAjax("api.php?accion=preguntarQueSigue&que=pago", "Pago guardado", 600, 150);

}

function nuevoMovimiento() {
	window.location = "?accion=compras&status=<?=$_GET[status]?>";
}

function cuentaCorriente() {
	window.location = "?accion=cc&tipo=<?=$_GET[status]?>&id="+sesion.id_cli;
}
 
 </script>