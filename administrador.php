

<div class="recuadro" id="filtros">
	 <h2>Buscar por:</h2>
     <? switch ($que) {
		 	case "cliente" :
				$comps = array(new Component(array('nombre' => 'nombre', label => true, 'class' => 'nombre')), 
								new Component(array('nombre' => 'Buscar', type => 'boton', 'class' =>'rojo buscar')),
								new Component(array(type => 'boton', 'class' => 'fltrgt insertar', nombre => "Insertar nuevo cliente"))
								);
				
				break;
			
			case "proveedor" : 
				$comps = array(new Component(array('nombre' => 'nombre', label => true, 'class' => 'nombre')), 
								new Component(array('nombre' => 'Buscar', type => 'boton', 'class' =>'rojo buscar')),
								new Component(array(type => 'boton', 'class' => 'fltrgt insertar', nombre => "Insertar nuevo proveedor"))
								);
				
				break;
			
			case "materia" : 
				
				$provs = $DB->select('clientes', 'id_cli, nombre', "tipo = 'proveedor'");
				$proveedores = $DB->DBtoLinearArray($provs->results);
				array_unshift($proveedores, 0, 'Todos');
				
				$proveedoresSmarty = $DB->DBtoAssocArray($provs->results);
				$inicial = array(0=> 'Seleccione proveedor'); //agregae l x defecto	
				$proveedoresSmarty = $inicial + $proveedoresSmarty;
				
				
				$comps = array(new Component(array('nombre' => 'nombre', label => true, 'class' => 'nombre')), 
								new Component(array(type => 'select', nombre => 'proveedor', values => $proveedores, subtype => 'key_value', 'class' => 'proveedor')),
								new Component(array('nombre' => 'Buscar', type => 'boton', 'class' =>'rojo buscar')),
								new Component(array(type => 'boton', 'class' => 'fltrgt insertar', nombre => "Insertar nueva MATERIA"))
								);
				
				break;
				
			case "producto" :
				$cats = $DB->select('categorias', 'id_cat, nombre', "parent = 0");
				$categorias = $DB::DBtoLinearArray($cats->results);
				array_unshift($categorias, 0, 'Seleccione'); //agregae l x defecto
				$otrosSelects = array(0, 'Seleccione');
				$comps = array(new Component(array('nombre' => 'nombre', label => true, 'class' => 'nombre')),
								new Component(array('nombre' => 'Buscar', type => 'boton', 'class' =>'rojo buscar')),
								new Component(array('type' => 'boton', 'class' => 'fltrgt insertar', nombre => 'Insertar nuevo producto')),
								new Component(array(type => 'select', values => $categorias, 'nombre' => 'Categorias', subtype =>'key_value', label => true, 'class' => 'categoria')),
								new Component(array(type => 'select', values => $otrosSelects, subtype =>'key_value', 'class' => 'categoria')),
								new Component(array(type => 'select', values => $otrosSelects, subtype =>'key_value', 'class' => 'categoria'))
								);
								
			
							     
	 }
	
     $form = new Form(array(action => 'javascript:buscar()', components => $comps));
	 $form->display();
	 
	 ?>
    
    
</div>


<div class="resultados">
</div>



	




<script type="text/javascript">

$(document).ready(function() {
	
	buscar(0);
	
	queEditamos = "<?=$que?>";	
		
		
		
	$('select.categoria').each(function() { // categorias disabled

		if ($(this).find('option').length < 2) $(this).attr('disabled', 'disabled');
	});
	
	$('select.categoria').change(function() { // cambia las categorias de los subs
		var obj = this;
		if ($(this).next('select').length)
			if ($(this).val() != 0)
				$.get("library/subs_categorias.php", { seleccionada : $(this).val(), container : 'option' }, function(d) {
							if (d.length) // si hay cambios
								$(obj).next('select').attr('disabled', '').removeAttr('disabled').find('option:not(:first)').remove().end().append(d);
							else
								$(obj).nextAll('select').attr('disabled', 'disabled').find('option:not(:first)').remove();
				});
			else
				$(this).nextAll('select').attr('disabled', 'disabled');
	});	
	
	$('a.boton.buscar').click(function() { buscar(0); }); // boton buscar
		
		
	
		
		
		
		
		
		
	// update un campo 	
	$('div.linea input, div.linea select').live('change', function(e) {
		cambiar(this);
		
    });	
	
	
	$('a.boton.eliminar').live('click', function() {
		eliminar(this);
	});
	
	$("a.boton.editar").live('click', function() {
		editar(this);
	});
	$("a.boton.insertar").live('click', function() {
		editar(this);
	});
	$("a.boton.subir").live('click', function() {
		subirPorcentaje(this);
	});
	
	
	
});



function editar(obj) {
	
	var obj = $(obj).closest('div.linea');
	var idi = obj.attr('id');
	if (!isNumber(idi)) idi = 0;
	if (queEditamos == 'producto')	window.location = "?accion=articulo&id="+idi;
	else {
		cargarAjax("api.php?que="+queEditamos+"&accion=editar&id="+idi, "Editar "+queEditamos, 400, 394);
			
	}
}



function subirPorcentaje(obj) {
	var obj = $(obj).closest('div.linea');
	var idi = obj.attr('id');
	
	var nombre = obj.text();
	nombre = encodeURIComponent($.trim(nombre));
	console.log(nombre);
	if (!isNumber(idi)) return false;
	//cargarAjax("api.php?que="+queEditamos+"&accion=editar&id="+idi, "Editar "+queEditamos, 400, 250);
	cargarAjax("api.php?que="+queEditamos+"&accion=subirPorcentaje&id="+idi+"&nombre="+nombre, "Subir", 400, 250);
			
	
}


function subirAhora() {
	var porc = $('#porcentaje').val();	
	var id_prov = $('#porcentaje').attr('id_prov');
	if (!isNumber(id_prov) || !isNumber(porc)) { alert("No se han ingresado datos validos."); return false; }
	$("#ventana").css('background-image', 'url(img/loader.gif)')
			.find('#contenido').fadeOut(200);
		$.post('api.php', {accion: 'subirAhora', que : 'proveedor', id : id_prov, value : porc } , function(d) {
			console.log(d);
			cerrar_ventana();
		});
}


function trim (myString)
{
return myString.replace(/^\s+/g,'').replace(/\s+$/g,'')
}

function cambiar(obj) {
	
		var obj = $(obj);
		
		obj.addClass('activo');
		var datos = {};
		datos.id = obj.closest('div.linea').attr('id');

		datos.accion = "update";
		datos.que = "<?=$que?>"; 
		datos.campo = obj.closest('span').attr('class');
		datos.value = obj.val();
		$.post('api.php', datos, function(d) {
			console.log(d);
			obj.removeClass('activo');
		});
	}



function eliminar(obj) {
	if (confirm("Seguro que desea eliminar este item?")) {
		obj = $(obj).closest('div.linea');
		$.post('api.php', {accion: 'delete', que: "<?=$que?>", id: obj.attr('id') });
		obj.fadeOut(400, function() {
			$(this).remove();
		});
	}
}




function buscar(offset) {
	var datos = new Object();
	
	$('#filtros input').each(function() {
		if ($(this).val()) datos[$(this).attr('name')] = $(this).val();	
	});
	
	$('#filtros select:enabled').each(function() {
		if ($(this).val() != 0) datos[$(this).attr('class')] = $(this).val();
	});
	
	datos.que = "<?=$que?>";
	datos.offset = offset;
	datos.accion = "listar";
	console.log(datos);
	
	$("#loader").show();
	
	
	$.post("api.php", datos, 
			function(data) {
			$(".resultados").html(data);
			/*.find(".linea").each(function(){
				$(this).prepend(botones);
			});*/
			verpares();
			$("#loader").hide();
			});
	

}


function verpares() {
	$(".resultados .linea").removeClass("par").filter(":even").addClass("par");
}

function iraOffset(num) {
	buscar(num);
}


function guardar() {
	var datos = $('#ventana input, #ventana select').serialize();	
	console.log(datos);
	var idi = $('#ventana #id').val();
	var accion = ( idi == 0 || !isNumber(idi)) ? "insert" : "update";  
	$.post('api.php?accion='+accion+'&que='+queEditamos, datos, function(d) {
		console.log(d);
		if (accion == "insert") {
			if ($('div.resultados div.linea.rojo').length) $('div.resultados div.linea.rojo').after(d);
			else $('div.resultados').prepend(d);
		}
		verpares();
		cerrar_ventana();
		buscar(0);
	});
	
}

</script>