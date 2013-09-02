
<?php include_once "subir_imagenes.php";



$editables = ($_GET[accion] == "imagenes")? true : false;


if (!$editables) echo "<div class='central-fixed recuadro' id='imagenes_central'>";

?>
    
    
    
    
    
    
	<div class="recuadro" id="busqueda">
    	<form action="javascript:buscarTexto()">
            <label><?=$traducir[buscar]?></label>
            <input type="text" id="texto_buscar" value="" />
            <select id="tipo_buscar">
            	<option value=""><?=$traducir[todos]?></option>
                <?
				foreach($TIPOS_IMAGEN as $key=>$value)
					if (!is_numeric($value))
						echo "<option value='$value'>".ucfirst($traducir[$value])."</option>";
				?>
            </select>
            <input type="submit" value="<?=$traducir[buscar]?>" />
        </form>    
 	</div>   
    <a class="boton big" onclick="$('#subir_fotos').toggle()" id="subir"><?=$traducir[subirmaterial]?></a>
    

	<? if (!$editables) { ?>
	<p style="clear:left; padding:20px 0 0 10px; margin:0; display:block">
    	<input type="button" value="<?=$traducir[usarimagen]?>" onclick="usarImagen()" />
    	<input type="button" value="Descartar" onclick="descartar()" />
	</p>
    <? } ?>

	<div class="resultados" id="imagenes">
    
    </div>


<? if (!$editables) echo "<div id='pantalla'></div></div>"; ?>


	<script type="text/javascript">
	
	
		$(document).ready(function() {
			$("#imagenes div.linea .imagen,#imagenes div.linea span").live("click", function() {seleccionar(this) });
		});
	
	
		paraeditar = <?=($editables)? 1 : 0; ?>;
	
		$(window).load(function() {
		 
		 traerimagenes("fecha", "", "",'', 0, false);
		
		});
	
	
	
		function traerimagenes(ordernarpor, texto, file, tipo, offset, append, tipodefault) {
			ultimabusqueda = texto;
			
			if (tipodefault && $("#tipopredeterminado").val() != 'no especificado') {
				tipodefault = $("#tipopredeterminado").val();
				
				}
			else tipodefault = '';
			
			$.get("api_imagenes.php", {accion: "listar", texto: texto, file: file, tipo: tipo, offset: offset, paraeditar: paraeditar, tipodefault: tipodefault}, 
					function(data) {
						if (append) {
							$("#imagenes").prepend(data);
							actualizarImpares();
						}
						else $("#imagenes").html(data);
						});
						
		}
		
		function cambiaLinea(obj) {
			var campo = $(obj).is("input") ? 'descripcion' : 'tipo';
			var parent = obj.parentNode;
			var id = parent.id;
			var valor = $(obj).val();
			$.post("api_imagenes.php", {accion : "editar", id: id, campo: campo, valor: valor}, function(data) {});
		}
		
		
		function borrarImagen(obj) {
		
		if (confirm("<?=$traducir[seguro];?>")) {
			var parent = obj.parentNode;
			var id = parent.id;
			$(parent).fadeOut(400, function() {$(this).remove(); actualizarImpares();});
			$.post("api_imagenes.php", {accion : 'borrar', id: id});
			}		
		}
	
	
		
		
		function iraOffset(num) {
			traerimagenes("", ultimabusqueda, "", '', num, false);
		}


		function buscarTexto() {
			var texto = $("#texto_buscar").val();
			var tipo = $("#tipo_buscar").val();
			traerimagenes('', texto, '', tipo, 0, false);
			
		}	
		
		function seleccionar(obj) {
			var obj = $(obj).closest(".linea");
			var url = obj.attr('image');
			$("#imagenes").find(".seleccionado").removeClass("seleccionado");
			obj.addClass("seleccionado");
			
			$.get('../library/thumb.php', {related: 'video', imagen:url, w: 295, h: 400, crop: 0, openvideo: 1, path: '../'}, function(e) {
				$('#pantalla').html(e);
			});
		}


		



		function descartar() {
		
		$("#imagenes_central").find(".seleccionado").removeClass("seleccionado").end().hide().find("#pantalla").empty().css('backgroundImage', '');
		}
		
		
		
		function arriba(obj) {
			obj = $(obj).closest("div.linea");
			var previo = $(obj).prev();
			if (previo.length)
				if (previo.hasClass("linea"))
					previo.before(obj);
			actualizarImpares("#imagenes_art");
		}
		
		
		function abajo(obj) {
			obj = $(obj).closest("div.linea");
			var previo = $(obj).next();
			if (previo.length)
				if (previo.hasClass("linea"))
					previo.after(obj);
			actualizarImpares("#imagenes_art");
		}
		
		
		function borrarImgArt(obj) {
			if (confirm("<?=$traducir[seguro]?>"))
			   {
				$(obj).closest("div.linea").fadeOut(400, function() {$(this).remove()});
						actualizarImpares("#imagenes_art");
				}
		}
		
		
		
		
		/*function maxi(theObj){
			   if(theObj.constructor == Array || theObj.constructor == Object){
				  document.write("<ul>")
				  for(var p in theObj){
					 if(theObj [p] .constructor == Array || theObj [p] .constructor == Object){
						document.write("<li> ["+p+"]  => "+typeof(theObj)+"</li>");
						document.write("<ul>")
						print_r(theObj [p] );
						document.write("</ul>")
					 } else {
						document.write("<li> ["+p+"]  => "+theObj [p] +"</li>");
					 }
				  }
				  document.write("</ul>")
			   }
			}*/
		
	</script>
