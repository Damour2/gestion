
	<?php 
	/*
	$categorias_container = "";
	$categorias_pedida = "*";
	include "../library/listar_categorias.php";
	*/
	?>
    
    <div class="grupo">
    	<? listarCategorias(array(tipo => 'principales', extraClasses => 'categoria', order=> 'tipo ASC, nombre ASC')); ?>
        <div class="boton" onclick="editarCategoria(this, true)"><?=$traducir[nuevaprincipal]?></div>
    </div>
    <div class="grupo">
    </div>
    <div class="grupo">
    </div>
    
    
	
    
	<div class="recuadro central-fixed" id='editar_categoria'>
    	<p class="titulo_recuadro"><?=$traducir[editarcategoria]?><img class="loader" src="../img/loader.gif"></p>
    	<input type="hidden" id="id_cat" value="0" />
        
		<label><?=$traducir[nombre]?></label>
        <input type="text" id="nombre" />
        <label>Aparece en:</label>
        <select id="tipo">
        	<option value="ambos sitios">Ambos sitios</option>
            <option value="tienda">Sólo la tienda</option>
            <option value="institucional">Sólo institucional</option>
        </select>
        <label><?=$traducir[logo]?></label>
        <input type="text" id="logo" /><span class="boton nuevaimgen" onclick="editarImagen(this)">IMG</span>
        <label><?=$traducir[encabezado]?></label>
        <input type="text" id="encabezado" /><span class="boton nuevaimgen" onclick="editarImagen(this)">IMG</span>
        <label><?=$traducir[importancia]?> (1 - 255)</label>
        <input type="text" id="importancia" />
        <input type="button" onclick="guardarCategoria()" value="<?=$traducir[guardar]?>" />
        <input type='button' onclick="descartarCambios()" value="<?=$traducir[descartar]?>" />
	</div>


<?php include_once "imagenes.php";?>



	<script type="text/javascript">
	
		$(document).ready(function(e) {
            $('div.categoria a').live('click', function(e) {
				e.stopImmediatePropagation();	
				abrirCategoria(this);
				return false;
				
			})
        });
	
	
	
	
	
	
		//CATEGORIAS = { 0: 'genero', 'genero': 0, 1 : 'producto', 'producto' : 1, 2 : 'marca', 'marca' : 2, 3 : 'actividad', 'actividad' : 3};
		botones = "<span class='boton editar-categoria' title='<?=$traducir[editarcategoria]?>'>E</span><span class='boton borrar-categoria' title='<?=$traducir[borrarcategoria]?>'>B</span>"
		botonampliar = "<span class='boton' onclick='ampliar(this)' title='<?=$traducir[ampliar]?>'>+</span>";
	
	
	imagenactual = null;



function abrirCategoria(obj) {
	var idi = $(obj).closest('div.categoria').attr('id');
	$(obj).closest('div.categoria').addClass('activo').siblings().removeClass('activo');
	obj = $(obj).closest('div.grupo');
	if (obj.next('div.grupo').length)
	{	
		$.get('../library/subs_categorias.php', {seleccionada : idi}, function (d) {
				obj.next('div.grupo').html(d)
					.append("<div class='boton nueva_categoria' onclick='editarCategoria(this, true)'><?=$traducir[agregarsub]?></div>")
					.nextAll('div.grupo').empty()
					.end().find('div.categoria').each(function() {
						$(this).append(botones);
					});
		});
	}
		
}






function editarImagen(img) {
	imagenactual = $(img).prev();
	$("#imagenes_central").toggle();
	
}
	
	
	function usarImagen() {
		var seleccionada = $("#imagenes .seleccionado").attr('image');
		imagenactual.val(seleccionada);
		descartar();
	}
	
	
		$(document).ready(function() {
		$("#imagenes div.linea .img,#imagenes div.linea span").live("click", function() {seleccionar(this) });
		$("#imagenes_art .img").live("click", function() {editarImagen(this); });
		
		$(".supercategoria").each(function() { 
			if (!$(this).find('ul').length) $(this).append('<ul></ul>');
		});
		
		$(".supercategoria").find("ul").append("<li class='boton nueva_categoria' onclick='editarCategoria(this, true)'><?=$traducir[agregarsub]?></li>").hide();
		
		$(".categoria").append(botones).filter(".super").append(botonampliar);
		
		
		$(".editar-categoria").live("click", function() {editarCategoria(this); });
		$(".borrar-categoria").live("click", function() {borrarCategoria(this); });
		
		});
	
	
	
	function ampliar(obj) {
		$(obj).closest(".supercategoria").siblings().find("ul").slideUp().end().end().find("ul").slideDown();
	}
	
	
		function editarCategoria(obj, nueva) {
			
			var ventana = $("#editar_categoria");
			
			var idi = (nueva) ?  0 : obj.parentNode.id;
			grupo_editado = $(obj).closest('div.grupo');
			categoria_editada = idi; //guarda en cache el id de la categoria que estamos trabajando
			supervieja = (!$(obj).closest("div.grupo").prev('div.grupo').length) ? 0: $(obj).closest("div.grupo").prev('div.grupo').find('div.activo').attr('id') ; //guarda en cache la vieja categroia si esta adentro de una super categoria sino guarda 0 porque es una nueva super

			dondeestamos = obj; //guarda en cache la vieja categroia
			$(ventana).fadeIn(400);
			
			if (idi != 0) {
				$(ventana).find(".loader").show();
				$.get("info_categoria.php", { id: idi}, function(data)
								{
								for (var i in data)
									{
									
									  $(ventana).find("#"+i).val(data[i]);
									  $(ventana).find(".loader").hide();
									}
								 }, "json")
				}
			else {
				//var super = $(obj).closest('supercatgeoria').attr('id');	
				$(ventana).find("input[type=text]").val("").filter("#tipo").val(obj.parentNode.id);
				$(ventana).find("select#tipo").val('ambos sitios');
				//ventana.find("select").val(dondeestamos); // no se usa select
				$(ventana).find("#id_cat").val("0");
			}
			
		
		}
	
		
		function guardarCategoria() {
			var mandar = new Array();
			var ventana = $("#editar_categoria");
			ventana.find("select, input[type=hidden], input[type=text]").each(
				function() {
					mandar.push(this.id + "=" + $(this).val());
					
				});
			mandar.push("parent="+supervieja);
			mandar = mandar.join("&");
			ventana.find(".loader").show();
			$.post("guardar_categoria.php", mandar, function(data) {
				
					var name = ventana.find("#nombre").val(); // es lo que hay que poner
					
					if (categoria_editada != 0)
					   {
					  // var agregar = (!supervieja) ? botonampliar : ""; //si es principal categroia agregar amplirar vbton
					   $("div.categoria", grupo_editado).filter("#"+categoria_editada).html("<a href='#'>"+name+"</a>" + botones);

					   }
					else  // si se agreg una nueva categoria
						{
							
						grupo_editado.find('div.boton').before("<div id='"+data+"' class='categoria'><a href='#'>"+name+"</a>" + botones+"</div>");
						/*if (supervieja != 0 && window.supervieja) // si es una categoria secunadraia
							$(dondeestamos).before("<li class='categoria sub' id='"+data+"'>"+name+botones+"</li>");
						else  //si es una categoria princiapl
							{ 
							$(dondeestamos).before("<div class='supercategoria' id='"+data+"'><li class='categoria super' id='"+data+"'>"+name+botones+botonampliar+"</li><ul><li class='boton nueva_categoria' onclick='editarCategoria(this, true)'><?=$traducir[agregarsub]?></li></ul></div>");	
							}*/
						}
					
					/*var superc = $(ventana).find("#tipo").val();
					obj.html(ventana.find("#nombre").val() + botones);
					
					if (superc != supervieja)
					$("#"+superc).find(".nueva_categoria").before(obj);*/
					
					//alert("Se ha guardado"); 
					ventana.fadeOut(400).find("input[type=hidden], input[type=text]").val('').end().find(".loader").hide();
					});
		
		}
		
		
		function borrarCategoria(obj) {
			var superi = ($(obj).closest("div.grupo").next('div.grupo').find('div.categoria').length) ? true : false; //tiene subs?
			var mensaje = (superi) ? "<?=$traducir[seguroysubs]?>?" : "<?=$traducir[seguroitem]?>?";
			if (confirm(mensaje))		
			{
				if (superi)
					{
						
						$(obj).closest("div.grupo").nextAll('div.grupo').empty();
					}
				
				$(obj).closest("div.categoria").fadeOut(400, function() {$(this).remove(); });
				var mandar = "id="+obj.parentNode.id;
				$.post("borrar_categoria.php", mandar, function(data) {
								/*obj = $(obj).closest('.categoria');
								var remover = (!obj.hasClass('sub')) ? obj.closest('.supercategoria') : obj;
								
								remover.fadeOut(function(){ $(this).remove() });*/
								
							});
			}
		}
		
		
		function descartarCambios() {
		$("#editar_categoria").fadeOut(400).find("select, input[type=text]").val("").end().find("input[type=hidden]").val("0");
		
		}
	</script>
