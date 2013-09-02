<script src="library/js/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="library/css/ui-lightness/jquery-ui-1.8.16.custom.css" media="screen" />

<?

include "library/auxiliares.php";

if ($id != 0) {
	/*$q = mysql_query("SELECT a.*, b.*, c.*, GROUP_CONCAT(d.id_cat SEPARATOR '*') AS categorias FROM articulo a LEFT JOIN datos_producto AS b USING (id_art) LEFT JOIN datos_sucursal AS c USING (id_art) LEFT JOIN categorias_articulo AS d USING (id_art) WHERE a.id_art = $id GROUP BY a.id_art") or die(mysql_error());
	
	$r = mysql_fetch_assoc($q);

	$que = $r[tipo];*/
	
	$q = new Producto();
	$r = $q->open($id);
	$r = $r[0];
	//print_r($r);
	
	
	
}


?>


	<div class='recuadro'>
    	<label>Codigo</label> <input id="codigo" name="codigo" value="<?=$r[codigo]?>" />
        
        <h3>Precios</h3>
        <label>Costo: $ <span id="costo"><?=(isset($r[valor_costo])) ? $r[valor_costo] : "0.00"?></span></label>
        <fieldset>
        	<legend>Precio al público</legend>
            <p>
            	<label>Margen</label><input type="text" id="margen_recomendado" name="margen_recomendado" value="<?=(isset($r[margen_recomendado])) ? $r[margen_recomendado] : 300 ?>"/>
                
                <label>Automatico SI</label><input type="radio" name="auto_publico" id="auto_publico_si" <?=(!isset($r[auto_publico]) or $r[auto_publico] == 1) ? 'checked="checked"' : '' ?>/>
                
				<input type="radio" name="auto_publico" id="auto_publico_no" <?=(isset($r[auto_publico]) and  $r[auto_publico] != 1) ? 'checked="checked"' : '' ?>/><label>NO</label>
            </p>
            <p><label>Precio al público</label><input type="text" name="valor" id="valor" value="<?=$r[valor]?>" /></p>
         </fieldset> 
         
         <fieldset>
        	<legend>Precio para revendedores</legend>
            <p>
            	<label>Margen</label><input type="text" id="margen_mayor" name="margen_mayor" value="<?=(isset($r[margen_mayor])) ? $r[margen_mayor] : 100?>"/>
                <label>Automatico SI</label><input type="radio" name="auto_mayor" id="auto_mayor_si" <?=(!isset($r[auto_mayor]) or $r[auto_mayor] == 1) ? 'checked="checked"' : '' ?>/>
                <input type="radio" name="auto_mayor" id="auto_mayor_no" <?=(isset($r[auto_mayor]) and  $r[auto_mayor] != 1) ? 'checked="checked"' : '' ?>/><label>NO</label>
            </p>
            <p><label>Precio por mayor</label><input type="text" name="valor_mayor" id="valor_mayor" value="<?=$r[valor_mayor]?>maxi" /></p>
         </fieldset>   	
      
      
      	<h3>Stocks</h3>
        	<p><label>Stock</label><input type="text" id="stock" name="stock" value="<?=$r[stock]?>" /></p>
            <p><label>Stock mínimo</label><input type="text" id="stock_minimo" name="stock_minimo" value="<?=$r[stock_minimo]?>"/></p>
      
	</div>



		
        
       

	<div id="datos_generales">
        <p><label><?=$traducir[nombretitulo]?></label></p>
        <input type="text" id="nombre" name="nombre" value="<?=$r[nombre]?>"/>
        <p><label>Descripcion</label></p>
        <textarea id="bajada" name="bajada"><?=$r[bajada]?></textarea>
        
        
        <div id="materias_div">
        	<h3>MATERIAS PRIMAS </h3>
        	<? 	if ($id) {
					$temp = new DB();
					$materias = $temp->select("materias_producto LEFT JOIN materias_primas USING (id_mat)", 'materias_producto.*, materias_primas.*', "id_art = $id");
					if (count($materias->results))
						foreach( $materias->results as $rm)
							echo "<div class='linea'>
            						<input type='text' class='nombre' value='$rm[nombre]' id_mat='$rm[id_mat]' />
									<label>$rm[unidad] => $ <span class='valor_unitario'>$rm[valor]</span></label>
									<input type='text' class='cantidad' placeholder='Cantidad' value='$rm[cantidad]'/>
									<span class='valor_costo'>$ <em>$rm[valor_costo]</em></span>
    		            			<img src='img/borrar.png' title='Eliminar' onclick='eliminar(this)' />
	              				</div>"; 
				}
				
		    ?>
            <div class="linea">
            	<input type="text" class="nombre" /><label>Unidad => $ <span class="valor_unitario">0.00</span></label><input type="text" class="cantidad" placeholder="Cantidad" /><span class="valor_costo">$ <em>0.00</em></span>
                <img src="img/borrar.png" title="Eliminar" onclick="eliminar(this)" />
              </div>  
              <a class="boton insertar">AGREGAR NUEVA MATERIA</a>
        </div>
        
        
        
        
           <div class="recuadro" id="categorias_art">
            <legend>CATEGORIAS</legend>
            <? $pasar = true;
				$num = 0;
				
				
				$categorias = (empty($r[categorias])) ? array():  explode('*', $r[categorias]);
			while ($pasar or count($categorias))
            {
				
				$num++;
				$pasar = false; // asegura que pase una vez por aca
				?>
            <div class="linea">
            <select name="categoria_primaria" id="categoria_primaria">
                <option value="0">Seleccione</option>
                <? 	
					$categorias = Utils::removeFromArray($parent, $categorias);
                    $parent = listarCategorias(array('tipo' => 'principales', container => 'option', seleccionados => $categorias)); ?>
            </select>
            
            <select name="categoria_secundaria" id="categoria_secundaria">
                <option value="0">Seleccione</option>
                <? 	if ($parent) {
					$categorias = Utils::removeFromArray($parent, $categorias);
					$parent = listarCategorias(array('tipo' => 'secundarias', container => 'option', seleccionados => $categorias, parent => $parent)); 
                    } 
					else array_shift($categorias) ?>
            </select>
            
            <select name="categoria_terciaria" id="categoria_terciaria">
                <option value="0">Seleccione</option>
                <? 	if ($parent) {
					$categorias = Utils::removeFromArray($parent, $categorias);
					$parent = listarCategorias(array('tipo' => 'secundarias', container => 'option', seleccionados => $categorias, parent => $parent)); 
                    }
					 ?>
            </select>
          
            </div>
    		<? } ?>
            <a class="boton" onclick="nuevaCategoria()" id="nueva_categoria">Nueva Categoria</a>
    	</div>
        
        
  
  
	    <a class="boton big azul" onclick="guardar_articulo()" id="guardar">Guardar</a>
        <a class="boton big rojo" onclick="guardar_articulo(true)" id="guardarycontinuar"><?=(empty($id)) ? "Guardar e ingresar nuevo producto" : "Guardar y modificar siguiente"?></a>
    	<img src="../img/loader.gif" class="loader" id="loader" />
  
        
    </div>
   
  
    <? /*/////////////////////////////////////////////////////IMAGENES
    <div class='resultados' id="imagenes_art">
    	<h4><?=$traducir[imagenes]?></h4>
        <?
        	if (!empty($id))
			{
				$qi = mysql_query("SELECT a.id_img, a.relacion as tipo, a.img_related, b.texto, b.imagen, b.descripcion, c.imagen AS related_src FROM imagenes_articulo a LEFT JOIN imagenes b USING (id_img) LEFT JOIN imagenes c ON a.img_related = c.id_img WHERE a.id_art = $id ORDER BY a.id") or die(mysql_error());
				while ($ri = mysql_fetch_object($qi)) {
					
					$url = $ri->tipo == 'video' ? "../image_resizer.php?image=http://i.ytimg.com/vi/$ri->imagen/2.jpg&width=50&height=50" : "../image_resizer.php?image=img/uploads/$ri->imagen&width=50&height=50";
		
				echo "<div class='linea' id='$ri->id_img' image='$ri->imagen'>";
				thumb($ri->imagen, $ri->img, 50, 50, '', '../');
					
					$txt = empty($ri->descripcion) ? $ri->imagen : $ri->descripcion;
					echo"<span>$txt</span>";
					
					echo "<select class='tipo_imagen' onchange='cambiaTipo(this)'>";
				
				foreach ($TIPOS_IMAGEN as $key=>$value)	{
					if (!is_numeric($key))
						{
						$selected = ($key == $ri->tipo) ? "selected='selected'" : '';
						
						echo "<option value='$key' $selected>".ucfirst($traducir[$key])."</option>";
						}
						
				}  
				echo "</select>";
				
				//color
				if ( $ri->tipo == "color" or !empty($ri->img_related)) {
					echo "<span>$traducir[imagenrelacionada]: </span>";	
					thumb($ri->related_src, $ri->img_related, 50, 50, '', '../', 'div', 1,0 , 'imgrelated');				
					
				}
				
				if ($ri->tipo == "tecnologia")
					echo "<textarea>$ri->texto</textarea>";
				
			 	echo "</div>";
					
				}
			}
        ?>
        <div class="lineaespecial">
        	<a class="boton" id="nuevaimagen"><img src="../img/mas.png" align="absbottom" /> <?=$traducir[nuevaimagen]?></a>
        </div>    
    </div>
    
	*/?>
	
	
	
	

	   
	
	   
	   
	   
	  
    
   

	



<?php //include_once "imagenes.php";?>


<script src="library/json2.js"></script>
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>

<script type="text/javascript">
imagenactual = null;
$(document).ready(function() {
	queeditamos = "<?=$que?>";
	
	nuevaMateria = '<div class="linea">            	<input type="text" class="nombre" /><label>Unidad => $ <span class="valor_unitario">0.00</span></label><input type="text" class="cantidad" placeholder="Cantidad" /><span class="valor_costo">$ <em>0.00</em></span>                <img src="img/borrar.png" title="Eliminar" onclick="eliminar(this)" />           </div>';
	
	<? /*///botones = "<div class='botones'><img src='../img/arriba.png' title='<?=$traducir[arriba]?>' onclick='arriba(this)'><img src='../img/abajo.png' title='<?=$traducir[abajo]?>' onclick='abajo(this)'><img src='../img/borrar.png' title='<?=$traducir[borrar]?>' onclick='borrarImgArt(this)'></div>";
	
	//$("#nuevaimagen").click(function() {editarImagen(null); });
	*/ ?>
	
	$('#categorias_art select').live('change', function() {
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
	})
	.filter(':not(:first)').each(function() { //pone los disabled salvo el primero
		
		if ($(this).val() == 0) $(this).attr('disabled', 'disabled');
	});
	
	
	
	
	
	
	/*$("#imagenes_art .imagen").live("click", function() {editarImagen(this); });
	$("#imagenes_art").find(".linea").append(botones);
	actualizarImpares("#imagenes_art");
	
		$('#datos_generales textarea').tinymce({
			script_url : 'tinymce/jscripts/tiny_mce/tiny_mce.js',
			theme : "advanced",
			plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,advlist",
			theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,fontsizeselect,|,cut,copy,paste,pastetext,pasteword",
			theme_advanced_buttons2 : "search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,forecolor,backcolor",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			theme_advanced_statusbar_location : "bottom",
			theme_advanced_resizing : true,
			// Example content CSS (should be your site CSS)
			content_css : "css/content.css",
			// Drop lists for link/image/media/template dialogs
			template_external_list_url : "lists/template_list.js",
			external_link_list_url : "lists/link_list.js",
			external_image_list_url : "lists/image_list.js",
			media_external_list_url : "lists/media_list.js",
		});
		
		
		
		botonampliar = "<span class='boton' onclick='ampliar(this)'>+</span>";
		$(".super").append(botonampliar);
		$(".supercategoria").find("ul").hide();*/
		
		
		
		$('#materias_div .insertar').click(function() {
			$(this).before(nuevaMateria); //agrega una nueva ateria
		});
		
		$('input[type=radio]').change(function() {
			chequearAutomaticos();
		});
		
		chequearAutomaticos();
		
		
		
		
		$("#materias_div .nombre:not(.ui-autocomplete-input)").live("focus", function (event) {
    		$(this).autocomplete({
				source: "api.php?que=materia&accion=search",
				minLength: 2,
				select: function( event, ui ) {
					cargarItem(this, ui.item);
					event.stopImmediatePropagation();
					
				}
			});
		})
		
		$("#materias_div .nombre").live('keydown', function(event) {
			//alert(event.keyCode);
			if ((event.keyCode == 8 ||  event.keyCode == 46 || event.keyCode > 60) && $(this).attr('id_mat')) 
				{
					
				$(this).attr('id_mat', '0').closest('div.linea').find('label:first').html('Unidad => $ 0.00');
				}
		});
			
		$("#materias_div .cantidad").live('change', function() {
			calcularLinea(this);
			
		})
		.live('keydown', function(event) {
			if (event.keyCode == 13) { //ante el enter
				$(this).change();
				linea = $(this).closest('div.linea'); 
				if (linea.next('a.insertar').length) // si es la ultima materia 
					{
						$(linea).after(nuevaMateria); //le agregar otra
						$('#materias_div div.linea:last .nombre').focus(); // y le pone foco
					}
			}
		});
			
		
		$('#materias_div input.cantidad').each(function() {
			calcularLinea(this);
		});
		
});


function calcularLinea(obj) {
	var precio_unitario = parseFloat($(obj).closest('div.linea').find('span.valor_unitario').text());
			var cantidad = parseFloat($(obj).val());
			var valor_costo = (isNumber(precio_unitario) && isNumber(cantidad))  ? (precio_unitario * cantidad) : '0.00';
			$(obj).closest('div.linea').find('span.valor_costo em').html(roundNumber(valor_costo, 2));
			calcularCostoTotal();	
}

function calcularCostoTotal() {
	var costo_tot = 0;
	$("#materias_div span.valor_costo em").each(function() {
		var este_costo = parseFloat($(this).text());
		//alert(este_costo);
		if (isNumber(este_costo)) costo_tot += este_costo;
	});
	costo_tot = roundNumber(costo_tot, 2);
	$('span#costo').text(costo_tot); // poner costo total
	
	if ($('#valor').is(':disabled') && isNumber($('#margen_recomendado').val())) 
	{
		
		var valor_publico = (parseFloat($('#margen_recomendado').val()) / 100 + 1) * costo_tot;
		$('#valor').val(valor_publico);
	}
	
	if ($('#valor_mayor').is(':disabled') && isNumber($('#margen_mayor').val())) {
		var valor_reven = (parseFloat($('#margen_mayor').val()) / 100 + 1) * costo_tot;
		$('#valor_mayor').val(valor_reven);
	}
	 
}


function cargarItem(obj, item) {
	$(obj).attr('id_mat', item.id);
	var linea = $(obj).closest('div.linea');
	linea.find('label:first').html(item.unidad+" => $ <span class='valor_unitario'>"+item.valor+"<span>");
	linea.find('.cantidad').focus();
}



function chequearAutomaticos() {
	if ($('#auto_publico_si:checked').length) $('#valor').attr('disabled', 'disabled').addClass('disabled');
	else $('#valor').attr('disabled', '').removeAttr('disabled').removeClass('disabled');
	if ($('#auto_mayor_si:checked').length) $('#valor_mayor').attr('disabled', 'disabled').addClass('disabled');	
	else $('#valor_mayor').attr('disabled', '').removeAttr('disabled').removeClass('disabled');
	
	calcularCostoTotal();
}





function guardar_articulo(reloadear) {
	
	
	//$("#guardar").attr("onClick", "");
	$("#loader").show();
	datos = { articulo : <?=$id?>,
			  nombre : $('#nombre').val(),
			  bajada : $('#bajada').val(),
			  codigo : $('#codigo').val(),
			  valor_costo : $('span#costo').text(),
			  margen_recomendado : $('#margen_recomendado').val(),
			  valor : $('#valor').val(),
			  margen_mayor : $('#margen_mayor').val(),
			  valor_mayor : $('#valor_mayor').val(),
			  stock : $('#stock').val(),
			  stock_minimo : $('#stock_minimo').val() 
			};
	
	if ($('#auto_publico_si:checked').length) datos.auto_publico = 1;
	else if ($('#auto_publico_no:checked').length) datos.auto_publico = 0;
	
	if ($('#auto_mayor_si:checked').length) datos.auto_mayor = 1;
	else if ($('#auto_mayor_no:checked').length) datos.auto_mayor = 0;
	
	if ($("#categorias_art").length)
	{
		var cats = new Array();
		var cats_hash = new Array();
		
		$("#categorias_art select:enabled").each(function() {
			if ($(this).val() != 0)
			{
			cats.push($(this).find('option:selected').val());
			cats_hash.push($(this).find('option:selected').text());
			}
		});
		//console.log(cats);
		datos.categorias  = cats.join(',');
		datos.hash_categorias = cats_hash.join(" ");
	}

	datos.materias = new Array();
	
	$('#materias_div .linea').each(function() {
		if ($(this).find('input:first').val() != '' && $(this).find('input:first').attr('id_mat') != 0 ) {
			var temp = {
					id_mat : $(this).find('input.nombre').attr('id_mat'),
					nombre : $(this).find('input.nombre').val(),
					cantidad : $(this).find('input.cantidad').val()
					//valor_costo : $(this).find('span.valor_costo em').text()
					};
			datos.materias.push(temp);
						
		}
	});
	
	
	
	//console.log(datos);
	datosJson = JSON.stringify(datos);
	//console.log(datosJson);
	//return false;
	
	r = $.post("guardar_articulo.php", { datos : datosJson }, function(data) 
		{
			console.log(data);
			if (data.status == "ok") 
			{   //er = datos;
				if (reloadear) {
					if (<?=$id?> != 0) window.location = "in.php?accion=articulo&id=<?=($id+1)?>";
					else window.location = "in.php?accion=articulo";
				}
				else window.location = "index.php";
			}
			else 
				{
				alert("Ha habido un problema al guardar. Inténtelo mas tarde. " + data.motivo);
				$("#guardar").attr("onClick", "guardar_articulo()");
				$("#loader").hide();
				}
			}, "json");
			
			
}


function editarImagen(img) {
	imagenactual = img;
	$("#imagenes_central").toggle();
	
}


function usarImagen() {
	
		var seleccionada = $("#imagenes .seleccionado").clone();
		seleccionada.find("select").val($("#imagenes .seleccionado").find("select").val()); 
		//hack para que tome el valor asignado
		if (!imagenactual) // si hay que agregarla
			{
		
			if (seleccionada.find("select").val() == "color" && !seleccionada.find('div.imgrelated').length) 
				{ 
					seleccionada.append("<span class='mensaje'>Imagen relacionada</span><div class='imagen imgrelated'></div>");
				
				}
			else if (seleccionada.find("select").val() == "tecnologia") 
				{
					
					ponerTextarea(seleccionada);
				
				}
				
			
			seleccionada.append(botones);
				seleccionada.find("select").attr('onChange', 'cambiaTipo(this)');
			var desc = seleccionada.find("input[type=text]").val();
			if (desc != "")
				seleccionada.find("span:first").text(desc);
			seleccionada.find("input[type=text]").remove();
			$("#imagenes_art .lineaespecial").before(seleccionada);
			actualizarImpares("#imagenes_art");
			}
		
		
		else if (!$(imagenactual).hasClass('imgrelated')) { //si no hay que ponerle el related
			var parent = $(imagenactual).closest("div.linea");
			var desc = seleccionada.find("input[type=text]").val();
			if (desc != "")
				seleccionada.find("span:first").text(desc);
			
			parent.attr('id', seleccionada.attr('id')).find(".imagen:first, span:first, select:first").remove().end().prepend(seleccionada.find(".imagen:first, span:first, select:first"));
			
			cambiaTipo($(parent).find('select')); //se fija si el tipo asignado correpsonde con lo que tiene
		
		}
		
		
		else { //si hay que cmabiar el related
		
			var url = seleccionada.find(".imagen").css("backgroundImage");
			var idi = seleccionada.attr("id");
			
			$(imagenactual).css('backgroundImage', url).attr('id', idi);
		}
		descartar();
		}


function cambiaTipo(obj) {
	
	er = obj;
	var parent = $(obj).closest(".linea");
	eri = parent;
		
	if ($(obj).val() == "color" && !parent.find(".imgrelated").length) {
		
		parent.append("<span class='mensaje'>Imagen relacionada</span><div class='imagen imgrelated'></div>");
	}
	else if ($(obj).val() != "color" && parent.find(".imgrelated").length) {
		
		parent.find(".mensaje, .imgrelated").remove();
	}
	
	
	if ($(obj).val() == "tecnologia" && !parent.find("textarea").length) {
		ponerTextarea(parent)
		//parent.append("<textarea></textarea>");
	}
	else if ($(obj).val() != "tecnologia" && parent.find("textarea").length) {
		parent.find("textarea").remove();
	}
	
	
}


function ponerTextarea(obj) {
	obj.append("<textarea>Cargando...</textarea>");
					$.get("texto_tecnologia.php", {id: obj.attr('id')}, function (data) {
								obj.find("textarea").html(data);
								});
}



function nuevaCategoria() {
	$.get("selects_cats.php", function(d) {
		$("#nueva_categoria").before(d);
	});
}


function eliminar(obj) {
	$(obj).closest('div.linea').fadeOut(300, function() { $(this).remove(); } );	
}

</script>





<!-- /TinyMCE -->

