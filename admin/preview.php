<?

$id = cargar('id', 0);

if ($id != 0) {
	$q = mysql_query("SELECT a.*, b.*, c.*, GROUP_CONCAT(d.id_cat SEPARATOR '*') AS categorias FROM articulo a LEFT JOIN datos_producto AS b USING (id_art) LEFT JOIN datos_sucursal AS c USING (id_art) LEFT JOIN categorias_articulo AS d USING (id_art)  WHERE a.id_art = $id GROUP BY a.id_art") or die(mysql_error());
	
	$r = mysql_fetch_assoc($q);

	$que = $r[tipo];
	
}
else echo "<p> $traducir[nosehaencontrado] <a href='index.php'>$traducir[menu]</a></p>";



	
	?>
		
        
       
        
        <div class="recuadro fltrgt" id="activo_div">
        	<? 
			$cheked = (isset($r[activo]) and $r[activo] == 0) ? $traducir[no] : "";
			echo "<label>$traducir[estearticulo] $cheked $traducir[estaactivo]</label>";
			
		 ?>
        </div>
        
	 	 <? if ($que == 'sucursal') { ?>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript">
			lat = <?=(!empty($r[latitud])) ? $r[latitud] : 0?>;
			long = <?=(!empty($r[longitud])) ? $r[longitud] : 0?>;
			esparadrag = false;
		</script>
		<script type="text/javascript" src="mapas.js"></script>
		
        <div class="recuadro fltrgt" id="datos_sucursal">
			<h4>Datos de la sucursal</h4>
            <p><label>Dirección:</label><?=$r[direccion]?></p>
            <p><label>Provincia</label><?=$r[provincia]?></p>
            <p><label>Teléfono</label><?=$r[telefono]?></p>
            <p><label>Mail</label><?=$r[mail]?></p>
			<div class="mapa" id="mapa_canvas">MAPA</div>
        </div>
	<? 		} //sucusal ?>
   
   
   
    <? if ($que == 'producto') {
			echo "<div class='recuadro fltrgt' id='datos_producto'>";
			echo "<h4>$traducir[datosdelproducto]</h4>";
			echo "<label>$traducir[presentaciones]:</label>";
			$presentaciones = explode(",", $r[presentaciones]);
			echo "<table><tr><th colspan='".count($presentaciones)."'>$r[escala]</th></tr><tr>";
			foreach ($presentaciones as $este) 
				echo "<td>$este</td>";
			echo "</tr></table>";
			
			
			
			
			echo "</div>";
			
			
		}
	?>





	<div id="datos_generales">
    	<p class="aviso"><?=$traducir[guardadoexito]?></p>
        <p class="titular"><?=$r[nombre]?></p>
        <h5><?=$traducir[bajada]?></h5>
        <div class="bajada"><?=$r[bajada]?></div>
        <h5><?=$traducir[cuerpo]?></h5>
        <div class="cuerpo"><?=$r[cuerpo]?></div>
    </div>
   
  
    
   
    	<h4><?=ucfirst($traducir[imagenes])?></h4>
        <?
        	
			
			
			
			if (!empty($id))
			{
				$qi = mysql_query("SELECT a.id_img, a.relacion as tipo, a.img_related, b.texto, b.imagen, b.descripcion, c.imagen AS related_src, c.descripcion AS related_desc FROM imagenes_articulo a LEFT JOIN imagenes b USING (id_img) LEFT JOIN imagenes c ON a.img_related = c.id_img WHERE a.id_art = $id ORDER BY a.id") or die(mysql_error());
				while ($ri = mysql_fetch_object($qi)) {
					
					if ($ri->tipo == "no especificado" or $ri->tipo == "video" ) $ri->tipo = "foto";
					
					$images[$ri->tipo][] = new Imagen($ri->id_img, $ri->imagen, $ri->descripcion, $ri->img_related, $ri->related_src, $ri->related_desc, $ri->texto); 
					
					
		
				} //while
				
			} //if id
			
        ?>
      	<div class='slide_container'>
            <div id="fotos_slider" class="slide">
            	
                <ul>
                    <?
                    if (count($images[foto])) 
					foreach ($images[foto] as $este)
                        {
                            
							thumb($este->imagen, $este->id_img, 350, 350, $este->related_src, '../', 'li', 0, 1); 
							
                        }

                    ?>
                </ul>
            </div>
        </div>	
      
    
    	<? if (count($images[color])) { ?>
      <div id="colores">
      		<h5>Colores</h5>
                   	<?
					
					foreach ($images[color] as $este) {
						
						thumb($este->imagen, $este->id_img, 22, 22, $este->related_src, '../', 'div', 1, 0, '', $este->descripcion);
						
					}
					?>
              
            <a href="javascript:volverImagenesDefault()" class="oculto"><< VER PREVIAS</a>
      </div>
      
	  <? } ?>
	  		
		
		
		<? if (count($images[sello])) { ?>
	  			<h5><?=$traducir[sellos]?></h5>
                <div id="tecnologias">
					<table>
                    	<tr valign="middle">
					<?
					foreach ($images[sello] as $este) {

						echo "<td align='center'><img src='../image_resizer.php?image=img/uploads/$este->imagen&width=60&height=51' title='".addslashes($este->descripcion)."' id='$este->id_img' onclick='abrir_tecnologia(this)'></td>";
					}
					
					?>
                    	</tr>
                    </table>
    			</div>
                <!--<div id="tecnologias_desc">
	                < ? foreach ($images[tecnologia] as $este) {
						echo "<div id='$este->id_img' class='tecnologia_desc'><p class='titular'>$este->descripcion</p><div class='cuerpo'>$este->texto</div></div>";
					}
					?>
                </div>-->
    	<? } ?>
    
   
    <? 	if ($que == 'producto' or $que == 'noticia') {
	    echo "<p>$traducir[categorias]: $r[hash_categorias]</p>";
		}
	   ?>
        
    <div style="clear:left; margin-top:20px;">
	    <a class="boton big" href="in.php?accion=articulo&id=<?=$_GET[id]?>"><?=$traducir[volveraeditar]?></a>
         <a class="boton big" href="index.php" style="margin-left:10px">Menu principal</a>
    	<img src="../img/loader.gif" class="loader" id="loader" />
    </div>
    
    <div class="clear"></div>


</div>	

<script type="text/javascript" src="../slide.js"></script>
<script type="text/javascript">

$(document).ready(function() {
	//iniciarSlide("#fotos_slider", 1, 7);
	accionesImagenes();
	createImageViewer();
});



function createImageViewer() {
	$("body").append('<div id="fondo_total" style="position:fixed; width:100%; height:100%; background: #000; top:0; left:0;display:none; z-index:1000000;" ></div><table id="table_pantalla" style="position:fixed; width:100%; height:100%; z-index:1000001; display:none; left:0; top:0" ><tr valign="middle"><td align="center"></td></tr></table>');
	$("#table_pantalla").find("td").html("<img src='../img/loader.gif'>");
	fotosDefault = null;
}



function accionesImagenes() {
	/*$("#fotos_slider li").live("click", function() {fullScreen(this); });
	$("#fotos_slider li").live("mouseover", function() {$("#hint_slider").dequeue().fadeTo(400, 0.6); });
	$("#fotos_slider li").live("mouseout", function() {$("#hint_slider").fadeOut(400); });*/
	
	$("div.color").live("click", function() { agrandar(this); });
	
	
	
}
function agrandar(obj) {
	var src = $(obj).attr('imagen');
	var idi = obj.id;
	$.get('../library/thumb.php', {imagen: src, id: idi, w: 350, h: 350, path: '../', crop: 0, openvideo: 1}, function(e) {
		$('#fotos_slider').html(e);
	});
}


function fullScreen(obj) {

	$("#fondo_total").fadeTo(400, 0.6);
	$("#table_pantalla").fadeIn(400).find("img").attr('src', '../img/loader.gif');
	
	document.onkeydown = detectar_tecla; 
	var image = new Image();
			image.src = "../image_resizer.php?image=img/uploads/"+$(obj).attr('imagen')+"&width=700&height=700";
  					
					// si la imagen esta en el cache IEfix
					if ((image.complete) || (this.readyState == 'complete')) 
							{
							ponerImagen(image);
							
							}
					else  // si no
							{
							 $(image).load(function () { 
							 ponerImagen(image); });
					}	
					
	
}


function ponerImagen(img) {
	$("#table_pantalla td img").hide().attr('src', img.src).fadeIn(300).bind('click', function() {cerrarFullScreen()});
}


	function detectar_tecla(e){ 
	var evt=(e)?e:(window.event)?window.event:null;
	with (evt){ 
		if (keyCode==27) {
			cerrarFullScreen();
		} 
	} 
	}
	
	
	
function cerrarFullScreen() {
	
	$("#fondo_total, #table_pantalla").fadeOut(400, function() {$(this).find("td img").attr('src', '../img/loader.gif');})
	document.onkeydown = null; 
}

function volverImagenesDefault() {
	if (fotosDefault)
		 $("#fotos_slider").html(fotosDefault).siblings(".order_button").css('height', '20px');
     $("#colores a").hide();
}


function abrir_tecnologia(obj) {
	$("#tecnologias_desc").find(".tecnologia_desc:visible").slideUp(200).end().find("#"+obj.id).dequeue().slideDown(400);
}

</script>




