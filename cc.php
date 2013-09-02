<div class="recuadro">
	<? 
	$el = ($_GET[tipo] == cliente) ? new Cliente() : new Proveedor();
	$el->abrir($id);
	?>
	<p><a class="boton insertar" href="?accion=compras&id_cli=<?=$_GET[id]?>&status=<?=$_GET[tipo]?>">Nuevo Movimiento</a>
		<a class="boton insertar pago" data-id_cli="<?=$_GET[id]?>">Nuevo PAGO</a>
		<a class="boton rojo fltrgt enviarMail">Enviar cuenta por email</a>
	</p>
</div>


<div class="resultados">
	<?
	
	$elem = new Movimiento();
	//$elem->actualizarSaldo($id);
	$elem->listar($id, '', $offset);
	?>
</div>



<div id='enviarMail' class='central-fixed'>
	<h2>Enviar mail</h2>
	<input type='hidden' value='<?=$_GET[id]?>' name='id_cli' id='id_cli' />
	<p>
		<label>Mail: </label><input type='text' id='recipiente' name='recipiente' />
	</p>
	<p>
		<label>Asunto: </label><input type='text' id='asunto' name='asunto' />
	</p>
	<p><label>Mensaje: </label><textarea id='mensaje' name='mensaje'></textarea><p>
	<p>Debajo de este mensaje aparecerá el resumen de la cuenta corriente</p>
	<p>
		<a class='boton rojo enviarMailAhora'>Enviar</a>
		<a class='boton azul cancelarMail'>Cancelar</a>
	</p>
</div>




<script type="text/javascript">

$(document).ready(function() {
	
	//buscar(0);
	$('h1').html('Cuenta Corriente');
		
	actualizarImpares();	
		
	
	$('a.boton.eliminar:not(#pago-in a)').live('click', function() {
		eliminar(this);
	});
	$("a.boton.insertar.pago").live('click', function() {
		editarPago(0);
	});
	$(".pago a.boton.editar").live('click', function() {
		editarPago($(this).closest('.linea').attr('id'));
		return false;
	});	
	
	$('a.boton.enviarMail').click(function() {
		var value = $('.recuadro .mail b').text();
		$('#enviarMail').fadeIn(400).find('#recipiente').val(value);
	});

	$('#enviarMail')
		.find('.cancelarMail').click(function() {
			$('#enviarMail').fadeOut(400);
		}).end()
		.find('.enviarMailAhora').click(function() {
			//envia mail
			if (!validateEmail($('#recipiente').val())) {
				alert("Inserte una direccion de email valida.");
				return;
			}
			var datos = $('#enviarMail input, #enviarMail textarea').serialize(); 
			var post = $('.resultados').clone()
								.find('.boton').remove().end()
								.find('span').css({'margin-right' : '20px', width : '100px', float : 'left'}).end()
								.find('div.linea').css({'clear' : 'both', width : '100%'}).end()
								.find('.credito .importe, .pago .importe').each(function() {
									$(this).html("-" + $(this).text());
								}).end()
								.find('.linea:not(.rojo) .monto').remove().end()
								.html();
			console.log(datos);
			$('#enviarMail').fadeOut(400);
			$.post('formularios.php?' + datos, {datos : post}, function(d) {
				alert(d);
			});
		});

	
});



function eliminar(obj) {
	if (confirm("Seguro que desea eliminar este item?")) {
		obj = $(obj).closest('div.linea');
		obj.html("Eliminando...");
		$.post('api.php', {accion: 'eliminar', que: "movimiento", id: obj.attr('id'), cliente: <?=$id?> }
						, function() {
							window.location.reload();
						});
	}
}



function editarPago(id) {
	cargarAjax("api.php?que=pago&accion=editar&id="+id+"&parent=<?=$_GET[id]?>", "Editar Pago", 800, 250);
}

function postPago() {
	alert('El pago ha sido guardado!');
	window.location.reload();
}

function iraOffset(num) {
	window.location = "?accion=cc&id=<?=$id?>&tipo=<?=$_GET[tipo]?>&offset="+num;
}

</script>