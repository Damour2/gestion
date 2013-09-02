
	<?php 
	$que = 'categoria';
	?>
    
    <div class="grupo">
    	<? $q = new Categoria(); 
			$q->listar(array('parent = 0'), 0, 1000);
		?>
        <div class="boton" onclick="editar(this)"><?=$traducir[nuevaprincipal]?></div>
    </div>
    <div class="grupo">
    	
    </div>
    <div class="grupo">
    	
    </div>
    
    
	
    
	






	<script type="text/javascript">
	
		$(document).ready(function(e) {
			
			queEditamos = 'categoria';
			
            $('div.categoria').live('click', function(e) {
				e.stopImmediatePropagation();	
				abrirCategoria(this);
				return false;
				
			})
			
			$("a.boton.editar").live("click", function(e) { e.stopImmediatePropagation(); editar(this); return  false; });
		$("a.boton.eliminar").live("click", function(e) {e.stopImmediatePropagation(); eliminar(this); return false; });
        });
	
	
	
	
	
	



function abrirCategoria(obj) {
	var idi = $(obj).closest('div.categoria').attr('id');
	
	$(obj).closest('div.categoria').addClass('activo').siblings().removeClass('activo');
	obj = $(obj).closest('div.grupo');
	if (obj.next('div.grupo').length)
	{	
		$.get('api.php', {accion : 'listar', que : 'categoria', parent : idi}, function (d) {
				obj.next('div.grupo').html(d)
					.append("<div class='boton nueva_categoria' onclick='editar(this)'><?=$traducir[agregarsub]?></div>")
					.nextAll('div.grupo').empty();
		});
	}
		
}




	

	
	
	
	
	function editar(obj) {
	
	lastLinea = $(obj).closest('div.linea');
	var idi = (lastLinea.length) ? lastLinea.attr('id') : 0;
	
	var grupo = $(obj).closest('div.grupo').prev('div.grupo');
	var parent = (grupo.length) ? grupo.find('div.activo').attr('id') : 0;
	lastGrupo = $(obj).closest('div.grupo');
	
	
	cargarAjax("api.php?que="+queEditamos+"&accion=editar&id="+idi+"&parent="+parent, "Editar "+queEditamos, 400, 300);
			
	
	}
	
		
	
		
	function guardar() {
		var datos = $('#ventana input, #ventana select').serialize();	
		console.log(datos);
		var idi = $('#ventana #id').val();
		var accion = ( idi == 0 || !isNumber(idi)) ? "insert" : "update";  
		$.post('api.php?accion='+accion+'&que='+queEditamos, datos, function(d) {
			console.log(d);
			if (accion == "insert") lastGrupo.prepend(d);
			else lastLinea.find('span').html($('#ventana #nombre').val());
			cerrar_ventana();
		});
	
	}
		
		
	function eliminar(obj) {
	if (confirm("Seguro que desea eliminar este item y sus categorias subalternas?")) {
		obj = $(obj).closest('div.linea');
		$.post('api.php', {accion: 'delete', que: "<?=$que?>", id: obj.attr('id') });
		obj.fadeOut(400, function() {
			if ($(this).hasClass('activo')) {
				$(this).closest('div.grupo').nextAll('div.grupo').empty();	
			}
			$(this).remove();
			
		});
	}
}

		
	</script>
