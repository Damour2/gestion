<link rel="stylesheet" href="../plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css" type="text/css" media="screen" />
<link rel="stylesheet" href="color/css/colorpicker.css" type="text/css" />

<link rel="stylesheet" media="screen" type="text/css" href="color/css/layout.css" />

<script type="text/javascript" src="../plupload/js/plupload.js"></script>
<script type="text/javascript" src="../plupload/js/plupload.gears.js"></script>
<script type="text/javascript" src="../plupload/js/plupload.html4.js"></script>
<script type="text/javascript" src="../plupload/js/plupload.flash.js"></script>
<script type="text/javascript" src="../plupload/js/plupload.html5.js"></script>
<script type="text/javascript" src="../plupload/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>

<script type="text/javascript">


function cerrar_subir_archivo() {
	$("#subir_fotos").hide();
}


$(window).load(function() { 
	cerrar_subir_archivo(); 
	$("#subir_fotos").css("margin", "-170px 0 0 -350px");
	});
$(function() {


/*
////////////////////////////////////////////ITALIANO
plupload.addI18n({
'Select files' : 'Selezionare file',
'Add files to the upload queue and click the start button.' : 'Aggiungi file in coda e fai clic sul pulsante inizio',
'Filename' : 'Nome del file',
'Status' : 'Stato',
'Size' : 'Misura',
'Add files' : 'Aggiungi file',
'Stop current upload' : 'Bloccare questa carica',
'Start uploading queue' : 'Iniziare caricamento in coda',
'Uploaded %d/%d files': 'Files caricati',
'N/A' : 'Non disponibile',
'Drag files here.' : 'Trascinare i files qui',
'File extension error.': 'errore di estensione file',
'File size error.': 'Errore dimensione file',
'Init error.': 'Errore di inizializzazione',
'HTTP Error.': 'Errore di HTTP',
'Security error.': 'Errore di sicurezza',
'Generic error.': 'Errore generico',
'IO error.': 'Errore di entrata/uscita',
'Stop Upload': 'Bloccare carica',
'Add Files': 'Aggiungere file',
'Start upload': 'Iniziare a caricare',
'%d files queued': '%d Files in attesa'
    });

*/


//////////////////////////////////////ESPANOL

plupload.addI18n({
'Select files' : 'Cargar imágenes para subir al sitio',
'Add files to the upload queue and click the start button.' : 'Agregue archivos a la cola y cliquee the el boton de inicio',
'Filename' : 'Nombre del archivo',
'Status' : 'Status',
'Size' : 'Tamaño',
'Add files' : 'Agregar archivo',
'Stop current upload' : 'Detener la subida de archivos',
'Start uploading queue' : 'Comenzar a subir la cola',
'Uploaded %d/%d files': 'Subidas %d de %d archivos',
'N/A' : 'No disponible',
'Drag files here.' : 'Arrastre archivos aquí',
'File extension error.': 'Error en la extensión del archivo',
'File size error.': 'Error en el tamaño del archivo',
'Init error.': 'Error de inicialización',
'HTTP Error.': 'Error HTTP',
'Security error.': 'Error de seguridad',
'Generic error.': 'Error generico',
'IO error.': 'Error de traspaso de datos',
'Stop Upload': 'Detener subida',
'Add Files': 'Agregar archivos',
'Start upload': 'Iniciar la subida',
'%d files queued': '%d archivos en cola'
    });




var uploader = $("#upload").pluploadQueue({

		// General settings

		runtimes : 'html5,gears,html4,flash',

		url : 'upload.php',

		max_file_size : '10mb',
		unique_names : false,
		chunk_size : '1mb',

		filters : [
			{title : "Imagenes", extensions : "jpg"},
			{title : "Imagenes/gif", extensions : "gif"},
			{title : "Imagenes/png", extensions : "png"},
			{title : "archivos HTML", extensions : "htm"},
			{title : "archivo PDF ", extensions : "pdf"}, 
		],
		
					
		
		init : {
				FileUploaded : function(uploader, file, response) { 
								
								var er = eval('(' + response.response + ')');  
//								alert(er.id);
								traerimagenes("", "", er.id, '', 0, true, true)
								},
				
				UploadComplete : function(uploader, files) {
											$(".plupload_buttons").show(); 
								},
				
				},

	});

});



function agregar_video() {
	$("#loader_videos").show();
	var idi = $("#id_videos").val();
	if (idi != '')
	$.post("api_imagenes.php", {accion: "agregar_video", file: idi}, 
				function(data) {
							$("#loader_videos").hide();
							if (data != 'error')
								traerimagenes("", "", data, '', 0, true, false);
							});
}


function agregar_color() {
	$("#loader_color").show();
	var idi = $("#id_color").val();
	var nombre = $("#nombre_color").val();
	if (idi != '' && nombre != '')
	$.post("api_imagenes.php", {accion: "agregar_color", texto: nombre, file: idi}, 
				function(data) {
							$("#loader_color").hide();
							if (data != 'error')
								traerimagenes("", "", data, '', 0, true, false);
							});
	else
		alert('<?=_e('Debe elegir el color y darle el nombre para guardarlo')?>');
}

</script>
	
    <div class="recuadro central-fixed" id='subir_fotos'>
    <div class="boton" onclick="cerrar_subir_archivo()" id='cerrar'><?=_e('Cerrar')?></div>
    <div id="subir_colores" class="subir_opciones">
    	<form action="javascript:agregar_color()">
        	<span><?=_e('Agregar colores')?>:</span>
            
            <input type="text" id="nombre_color" placeholder="<?=_e('Nombre del color')?>" />
            
        	<input type="hidden" id="id_color" />
            <div id="colorSelector">
                <div></div>
            </div>
            <input type="submit" value="<?=_e('Agregar')?>" />
            <img src="../img/loader.gif" id="loader_color" class="loader"/>
        </form>
    </div>   
    <div id="subir_videos" class="subir_opciones">
    	<form action="javascript:agregar_video()">
        	<span><?=$traducir[agregarvideos]?>:</span>
        	<input type="text" id="id_videos" placeholder="<?=_e('youtu.be/XXXXXXX')?>" />
            <input type="submit" value="<?=_e('Agregar')?>" />
            <img src="../img/loader.gif" id="loader_videos" class="loader"/>
        </form>
    </div>   
	<div style="background:#ccc">    
        <div id="upload" style=" height: 330px; background:#999"><?=$traducir[navegador]?>
        
        </div>
            <div class="subir_opciones" id="tipopordefecto">
            <span><?=$traducir[tipopordefecto]?></span>
            <select id="tipopredeterminado">
                 <?
                    foreach($TIPOS_IMAGEN as $key=>$value)
                        if (!is_numeric($value))
                            echo "<option value='$value'>".ucfirst($value)."</option>";
                    ?>
            </select>
            </div>
      </div>
	</div>
    
    
    
      <script type="text/javascript" src="color/js/colorpicker.js"></script>

    <script type="text/javascript" src="color/js/eye.js"></script>

    <script type="text/javascript" src="color/js/utils.js"></script>

    <script type="text/javascript" src="color/js/layout.js?ver=1.0.2"></script>
    
    
    <script type="text/javascript">
	
	$(document).ready(function(e) {
        $('.colorSelector').ColorPicker({
			
				onChange: function (hsb, hex, rgb) {
					//var donde = $("#colordeque").val();
					
					/*switch (donde) {
						case 'fondo': $("#articulo").css("background", "#" + hex); break;
					}*/
					alert("maxi");
					
				}
			});
    });
	
	
	function aplicarPropiedad(hex) {
			//alert(hex);
					$('.colorSelector div').css('backgroundColor', '#' + hex);
					$('#id_color').val('#' + hex);
		}
	
	</script>