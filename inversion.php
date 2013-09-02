<div class="recuadro azul">
	<h3>Articulos a fabricar</h3>
    <label>Cantidad</label><input type="text" id="cantidad" name="cantidad" />
    <label>Articulo</label><input type="text" id="articulo" name="articulo" />
    
</div>
<div class="recuadro azul">
	<h3>Cargar sesiones anteriores</h3>
    <select id="elegirSesion">
    	<option value="0">Nueva sesión de inversión</option>
    	<?	$temp = new DB();
			$temp->select("movimientos", "id_ses, total, descripcion", "tipo = 'inversion'", "descripcion ASC", 0, 0, true);
			foreach ($temp->results as $e)
				echo "<option value='$e[id_ses]'>$e[descripcion] ($ $e[total])</option>";  
		?>
    </select>
</div>

<div class="resultados" id="productos">
	<h2>Articulos</h2>
    <h3 class="rojo">
    	<span class="cantidad">Cantidad</span>
        <span class="nombre">Producto</span>
        <span class="valor">Valor unitario</span>
        <span class="valor_mayor">Valor mayorista</span>
        
    </h3>
</div>


<div class="resultados" id="materias">
	<h2>Materias</h2>
    <h3 class="rojo">
        <span class="nombre">Materia</span>
        <span class="valor">Valor unitario</span>
        <span class="unidad">Unidad</span>
        <span class="requerida">Cant. Requerida</span>
        <span class="stock">Stock actual</span>
        <span class="a_comprar">A comprar</span>
        <span class="costo">Costo</span>
    </h3>
    
    <div class="recuadro" id="totales">
    	TOTAL INVERSION: $ <span>0.00</span>
    </div>
</div>

<div id="botones">
    <a class="boton borrar">BORRAR</a>
    <a class="boton azul imprimir">IMPRIMIR</a>
    <a class="boton rojo guardar">GUARDAR</a>
</div>

 
 <script src="library/json2.js"></script>
 <script type="text/javascript">
 
 $(document).ready(function() {
 	
	sesion = { id : <?=(empty($_GET[id])) ? "0" : $_GET[id] ?>, nombre : "" };
	if (sesion.id != 0) {
		$.get("api.php", { accion: "cargarInversion", que: "producto", id : sesion.id }, function(d) {
			if (d.status == "ok") {
				for (var i in d.results)
					cargarItem(null, d.results[i], true);
				sesion.nombre = d.nombre;	
				$("#elegirSesion").val(sesion.id);
				traerMaterias();
			}
		}, 'json');
	}			
	
	$("#elegirSesion").change(function() {
		window.location = "?accion=inversion&id="+$(this).val();
	});
	
	$('#articulo').autocomplete({
				source: "api.php?que=producto&accion=search",
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
		var nombre = prompt("Con que nombre desea guardar esta lista de inversion?", sesion.nombre);
		openModal();
		$.post("api.php", 
				{ accion : "guardarInversion", value : prepararDatos(true), que: 'producto', nombre: nombre, id : sesion.id, total : sesion.total }, 					
			function(d) {
				closeModal();
				if (d.status == "ok") {
					
					alert("Los datos han sido guardados");
					sesion.id = d.id;
					sesion.nombre = d.nombre;
				}
				else {alert("Ha ocurrido un error.") ; }
		}, 'json'); 
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


	$("div.linea input").live('change', function() {
		
		cambiar(this);
	});


	
	$(".imprimir").click(function() {
		window.print();
	});
	
 });
 
 function cargarItem(obj, item, noActualizar) {
 	console.log(item);
 	var cantidad = item.cantidad ? item.cantidad : $("#cantidad").val() ;
 
 	$("#productos").append("<div class='linea' id='"+item.id+"'><span class='cantidad'>"+cantidad+"</span><span class='nombre'>"+item.value+"</span><span class='valor'>"+roundNumber(item.valor, 2)+"</span><span class='valor_mayor'>"+roundNumber(item.valor_mayor, 2)+"</span><a class='boton azul eliminar'></a></div>");
	
	$("#articulo, #cantidad").val('');
	$("#cantidad").focus();
	actualizarImpares('#productos');
	if (!noActualizar) traerMaterias();
	
 }
 
 
 function eliminar(obj) {
	if (confirm("Seguro que desea eliminar este item?")) {
		obj = $(obj).closest('div.linea');
		obj.fadeOut(400, function() {
			$(this).remove();
			traerMaterias();
			calcularTotal();
		});
	}
}
 
 
 function prepararDatos(completo) {
 	var datos = [];
	
 	$("#productos").find('.linea').each(function() {
		if (completo)
 		  datos.push( { id_art : this.id , 
						cantidad : $(this).find('.cantidad').text(), 
						nombre:  $(this).find('.nombre').text(),
						valor:  $(this).find('.valor').text(),
						valor_unitario:  $(this).find('.valor_mayor').text()
					} );
		else
		  datos.push( { id_art : this.id , cantidad : $(this).find('.cantidad').text() } );
	});
	return JSON.stringify(datos);
 }
 
 
 function traerMaterias() {
 	

	
	var datosJson = prepararDatos();
	$.post('api.php',  { accion : "calcularInversion", que : "producto", value: datosJson }, function(d) {
		$("#materias").find(".linea").remove().end().find("h3").after(d);
		actualizarImpares('#materias');
		calcularTotal();
	});
 }
 
 function calcularTotal() {
 	var total = 0;
 	$('#materias').find('div.linea').each(function() {
		var monto = parseFloat($(this).find('span.costo').text());
		if (isNumber(monto)) total += monto;
	});
	
	sesion.total = isNumber(total) ? total : 0;
	$("#totales").find('span').html(total);
	
 }
 
 
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
 
 </script>