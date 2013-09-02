<?

$id = cargar('id', 0);

if ($id != 0) {
	$q = mysql_query("SELECT a.*, b.*, c.*, GROUP_CONCAT(d.id_cat SEPARATOR '*') AS categorias FROM articulo a LEFT JOIN datos_producto AS b USING (id_art) LEFT JOIN datos_sucursal AS c USING (id_art) LEFT JOIN categorias_articulo AS d USING (id_art) WHERE a.id_art = $id GROUP BY a.id_art") or die(mysql_error());
	
	$r = mysql_fetch_assoc($q);

	$que = $r[tipo];
	
}




if (!isset($_GET[que]) and empty($que)) 
	{
	?>
	<div class='recuadro'>
    	<h3><?=$traducir[creararticulo]?></h3>
        <a href="?accion=articulo&que=producto"><?=$traducir[producto]?></a>
        <a href="?accion=articulo&que=noticia"><?=$traducir[noticia]?></a>
        <!--<a href="?accion=articulo&que=sucursal">Sucursal</a>-->
	</div>


<? } else 
	{
	
	?>
		
        <div class="recuadro fltrgt" id="activo_div">
        	<h4><?=$traducir[activo]?></h4>
        	<? 
			$cheked = (isset($r[activo]) and $r[activo] == 0) ? "" : "checked='checked'";
			echo "<label>$traducir[disponible] </label><input id='activo' name='activo' type='checkbox' $cheked />";
		 ?>
        </div>
        
	 	 <? if ($que == 'sucursal') { ?>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript">
			lat = <?=(!empty($r[latitud])) ? $r[latitud] : 0?>;
			long = <?=(!empty($r[longitud])) ? $r[longitud] : 0?>;
			esparadrag = true;
		</script>
		<script type="text/javascript" src="mapas.js"></script>
		
        <div class="recuadro fltrgt" id="datos_sucursal">
			<h4>Datos de la sucursal</h4>
            <label>Indice (0-255, los mayores se mostraran primero)</label>
            <input type="text" id="indice" name="indice" value="<?=$r[indice]?>" />
            
            <label>Dirección</label>
            <input type="text" id="direccion" name="direccion" value="<?=$r[direccion]?>" />
            <label>Provincia</label>
            <input type="text" id="provincia" name="provincia" value="<?=$r[provincia]?>"/>
            <label>Teléfono</label>
            <input type="text" id="telefono" name="telefono" value="<?=$r[telefono]?>"/>
            <label>Mail</label>
            <input type="text" id="mail" name="mail" value="<?=$r[mail]?>"/>
			<div class="mapa" id="mapa_canvas">MAPA</div>
            <input type="button" value="Buscar dirección en el mapa" onclick="codeAddress()" />
            <input type="button" value="Eliminar marcador" onclick="eliminarMarcador()" />
		</div>
	<? 		} //sucusal ?>
   
   
   
    <? if ($que == 'producto') {
			echo "<div class='recuadro fltrgt' id='datos_producto'>";
			echo "<h4>$traducir[datosproducto]</h4>";
			echo "<label>$traducir[valor] <br>$traducir[usepunto]</label>";
			echo "<input type='text' id='valor' name='valor' value='$r[valor]'>";
			echo "<label>$traducir[valordescuento] <br>$traducir[usepunto]</label>";
			echo "<input type='text' id='valor_descuento' name='valor_descuento' value='$r[valor_descuento]'>";
			echo "<label>$traducir[tipopresentacion]</label>";
			echo "<input type='text' id='escala' name='escala' value='$r[escala]'>";

			echo "<label>$traducir[presentacionescomas]</label>";
			echo "<input type='text' id='presentaciones' name='presentaciones' value='$r[presentaciones]'>";
			
			
			
			echo "<label>UBICACION DEL PRODUCTO</label>";
            echo '<select id="subtipo" name="subtipo">';
            	foreach ($TIPOS_PRODUCTO as $e)
					{
					$selected = ($e == $r[subtipo]) ? "selected='selected'": "";
					echo "<option value='$e' $selected>$e</option>";
					}
			echo '</select>';
				
			echo "<label>$traducir[productodestacado]</label>";
			if ($r[destacado]) $selected = "checked='checked'"; else $selected = "";
			echo "<input type='checkbox' id='destacado' name='destacado' $selected>";
			
			
			echo "</div>";
			
		}
	?>
    
    
     <? if ($que == 'noticia') { ?>
     
			<div class='recuadro fltrgt' id='datos_noticia'>
			<h4><?=$traducir[ubicacion]?></h4>
            <select id="subtipo" name="subtipo">
            	<? foreach ($TIPOS_NOTICIA as $e)
					{
					$selected = ($e == $r[subtipo]) ? "selected='selected'": "";
					echo "<option value='$e' $selected>$traducir[$e]</option>";
					}
				?>            	

            </select>
			</div>			
	<?	}
	?>





	<div id="datos_generales">
        <label><?=$traducir[nombretitulo]?></label>
        <input type="text" id="nombre" name="nombre" value="<?=$r[nombre]?>"/>
        <label><?=$traducir[bajada]?></label>
        <textarea id="bajada" name="bajada"><?=$r[bajada]?></textarea>
        <label><?=$traducir[cuerpo]?></label>
        <textarea id="cuerpo" name="cuerpo"><?=$r[cuerpo]?></textarea> 
    </div>
   
  
    
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
    
    <? if ($que == 'producto' or $que == 'noticia') { ?>
	   
	   <div class="recuadro" id="categorias_art">
            <legend>CATEGORIAS</legend>
            <? $pasar = true;
				$num = 0;
				$categorias = (empty($r[categorias])) ? array():  explode('*', $r[categorias]);
			while ($pasar or count($categorias))
            {
				//print_r($categorias);
				$num++;
				$pasar = false; // asegura que pase una vez por aca
				?>
            <div>
            <select name="categoria_primaria" id="categoria_primaria">
                <option value="0">Seleccione</option>
                <? 	
					$categorias = removeFromArray($parent, $categorias);
                    $parent = listarCategorias(array('tipo' => 'principales', container => 'option', seleccionados => $categorias)); ?>
            </select>
            
            <select name="categoria_secundaria" id="categoria_secundaria">
                <option value="0">Seleccione</option>
                <? 	if ($parent) {
					$categorias = removeFromArray($parent, $categorias);
					$parent = listarCategorias(array('tipo' => 'secundarias', container => 'option', seleccionados => $categorias, parent => $parent)); 
                    } 
					else array_shift($categorias) ?>
            </select>
            
            <select name="categoria_terciaria" id="categoria_terciaria">
                <option value="0">Seleccione</option>
                <? 	if ($parent) {
					$categorias = removeFromArray($parent, $categorias);
					$parent = listarCategorias(array('tipo' => 'secundarias', container => 'option', seleccionados => $categorias, parent => $parent)); 
                    }
					 ?>
            </select>
            <img src="../img/borrar.png" title="Borrar" onclick="borrarCat(this)">
            </div>
    		<? } ?>
            <a class="boton" onclick="nuevaCategoria()" id="nueva_categoria">Nueva Categoria</a>
    	</div>
        
	   
	   
	   
	   
		<? }
	   ?>
    
    <div class="clear">
    <div class="center">
	    <a class="boton big" onclick="guardar_articulo()" id="guardar"><?=$traducir[guardar]?></a>
        <a class="boton big" onclick="guardar_articulo(true)" id="guardarycontinuar"><?=$traducir[guardarycontinuar]?></a>
    	<img src="../img/loader.gif" class="loader" id="loader" />
    </div>

	
<?	} //else que esta definido ?>


<?php include_once "imagenes.php";?>


<script src="jquery.json-2.2.js"></script>
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/jquery.tinymce.js"></script>

<script type="text/javascript">
imagenactual = null;
$(document).ready(function() {
	queeditamos = "<?=$que?>";
	botones = "<div class='botones'><img src='../img/arriba.png' title='<?=$traducir[arriba]?>' onclick='arriba(this)'><img src='../img/abajo.png' title='<?=$traducir[abajo]?>' onclick='abajo(this)'><img src='../img/borrar.png' title='<?=$traducir[borrar]?>' onclick='borrarImgArt(this)'></div>";
	
	$("#nuevaimagen").click(function() {editarImagen(null); });
	
	
	$('#categorias_art select').live('change', function() {
		var obj = this;
		if ($(this).next('select').length)
			if ($(this).val() != 0)
				$.get("../library/subs_categorias.php", { seleccionada : $(this).val(), container : 'option' }, function(d) {
							if (d.length) // si hay cambios
								$(obj).next('select').attr('disabled', '').removeAttr('disabled').find('option:not(:first)').remove().end().append(d);
							else
								$(obj).nextAll('select').attr('disabled', 'disabled').find('option:not(:first)').remove();
				});
			else
				$(this).next('select').attr('disabled', 'disabled');
	});
	
	
	
	
	
	
	$("#imagenes_art .imagen").live("click", function() {editarImagen(this); });
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
		$(".supercategoria").find("ul").hide();
});


function ampliar(obj) {
		$(obj).closest(".supercategoria").siblings().find("ul").slideUp().end().end().find("ul").slideDown();
	}


function guardar_articulo(reloadear) {
	
	
	$("#guardar").attr("onClick", "");
	$("#loader").show();
	datos = "articulo=<?=$id?>&tipo=<?=$que?>&";
	datos += $("input[type=text], textarea, select:not(.tipo_imagen):not(#categorias_art select), #activo").serialize();
	
	if ($("#mapa_canvas").length && marker != null) {
		latlong = marker.getPosition();
		datos += "&latitud="+ latlong.lat() + "&longitud=" + latlong.lng();
		
	}
	
	
	
	if ($("#destacado").length) {
		var destacado = ($("#destacado:checked").length) ? 1: 0;
		datos += "&destacado="+destacado;
	}
	
	
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
		datos += "&categorias="+cats.join(',')+"&hash_categorias="+cats_hash.join(" ");
	}
	else {
		datos += "&hash_categorias=" + $("#direccion").val() + " " + $("#provincia").val();
	}
	
	
	
	
	if ($("#imagenes_art").length)
	{
		var imgs = new Array();
		$("#imagenes_art div.linea").each(function() {
			var related = ($(this).find(".imgrelated").length) ? $(this).find(".imgrelated").attr('id') : ''; //color
			if ($(this).find("textarea").length) related = $(this).find("textarea").val(); //tecnologia
			
			var cadena = (related == '') ? this.id + "*/*/" + $(this).find("select").val() : this.id + "*/*/" + $(this).find("select").val()+"*/*/"+ related;
			imgs.push(cadena);
		});
		datos += "&imagenes="+imgs.join("*,*,");
	}
	
	r = $.post("guardar_articulo.php", datos, function(data) 
		{

			if (data.status == "ok") 
			{   //er = datos;
				if (reloadear) window.location = "in.php?accion=articulo&que="+queeditamos;
				else window.location = "in.php?accion=preview&id="+data.id;
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


function borrarCat(obj) {
	$(obj).closest('div').fadeOut(300, function() { $(this).remove(); } );	
}

</script>





<!-- /TinyMCE -->

