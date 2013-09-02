// JavaScript Document

function igualarAltos(donde) {
	var maximo = 0;
	$(donde).each(function() {

		maximo = (maximo > $(this).height()) ? maximo : $(this).height();
	}).height(maximo);
}



function createImageViewer() { ////////////////CREA EL FONDO NEGRO Y LA TABLE PARA VER FULLSCREEN
	$("body").append('<div id="fondo_total" style="position:fixed; width:100%; height:100%; background: #000; top:0; left:0;display:none; z-index:1000000;" ></div><table id="table_pantalla" style="position:fixed; width:100%; height:100%; z-index:1000001; display:none; left:0; top:0" ><tr valign="middle"><td align="center"></td></tr></table>');
	$("#table_pantalla").find("td").html("<img src='img/loader.gif'>");
	fotosDefault = null;
}




function fullScreen(obj) {
	ultimoItemFull = obj;
	$("#fondo_total").fadeTo(400, 0.7);
	$("#table_pantalla").fadeIn(400).find("img").attr('src', 'img/loader.gif');
	
	document.onkeydown = detectar_tecla; 
	var ancho = $(window).width();
	var alto = $(window).height();
	var image = new Image();
		if ($(obj).attr('imagen')) {
			var url = $(obj).attr('imagen');
			var path = ( url.substr(0,7) == "http://" ) ? "" : "img/uploads/";
			image.src = "image_resizer.php?image="+path+$(obj).attr('imagen')+"&width="+ancho+"&height="+alto;

					
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
		else if ($(obj).attr('video')) {
			ponerVideo($(obj).attr('video'));
			
		}
	
}
	
	

function ponerVideo(id) {
	var parts = id.split("?");
	id = parts[0];


if (parts.length > 1) { // si hay tiempo
		
		var times = parts[1].split("m"); //separa por minutos y segundos
		var last = times.length - 1; // el ultimo
		times[0] = times[0].substr(2); // al primero le saca t=
		times[last] = times[last].substr(0, times[last].length -1) // al ultim le saca la s de seconds
		
		var start = 0; 
		if (times.length > 1) { //si hay minutos y segundos
			start = (parseInt(times[0]) * 60 + parseInt(times[1]));	
		}
		else start = parseInt(times[0]); // si hay solo segundos
	}
	
	$("table#table_pantalla td").html('<object style="height: 344px; width: 425px"><param name="movie" value="agrandarYT(this, "http://www.youtube.com/v/'+id+'?f=videos&app=youtube_gdata&autoplay=1&start='+start+'")"><param name="allowFullScreen" value="true"><param name="allowScriptAccess" value="always"><embed src="http://www.youtube.com/v/'+id+'?f=videos&app=youtube_gdata&start='+start+'&autoplay=1")" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="425" height="344"></object>');
	ponerBotones();
}


function ponerImagen(img) {
	$("#table_pantalla td img").hide().attr('src', img.src).fadeIn(300).bind('click', function() {cerrarFullScreen()});
	ponerBotones();
}


function ponerBotones() {
		$("#table_pantalla td p").remove();
		obj = $(ultimoItemFull);
		var botoncerrar = "<a class='boton fullscreen cerrar' onclick='cerrarFullScreen()'>X</a>";
		var botonnext = "";
		var botonprev = "";

		if (obj.prevAll(".imagen").length ||  obj.prevAll(".videos").length)
			botonprev = "<a class='boton fullscreen prev' onclick='prevFullScreen()'><</a>";
		if (obj.nextAll(".imagen").length ||  obj.nextAll(".videos").length)	
			botonnext = "<a class='boton fullscreen next' onclick='nextFullScreen()'>></a>";
		
		
		$("#table_pantalla td").append("<div class='botones'><p>"+botonprev+botoncerrar+botonnext+"</p></div>");
}


function nextFullScreen() {
		obj = $(ultimoItemFull);
		if (obj.nextAll(".imagen").length)
			obj.nextAll(".imagen:first").trigger("click");
		else
			obj.nextAll(".videos:first").trigger("click");
}			


function prevFullScreen() {
		obj = $(ultimoItemFull);
		if (obj.prevAll(".imagen").length)
			obj.prevAll(".imagen:first").trigger("click");
		else
			obj.prevAll(".videos:first").trigger("click");
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
	
	$("#fondo_total, #table_pantalla").fadeOut(400, function() {$(this).find("td img").attr('src', 'img/loader.gif');})
	document.onkeydown = null; 
}




function cleverInputs(donde) {
	var nativePlaceholderSupport = (function(){
    var i = document.createElement('input');
    return ('placeholder' in i);
	})();
	
	if(nativePlaceholderSupport){
		return false;
	}
	$(donde).each(function() 
						{ 
						$(this).data("default", $(this).attr('placeholder')).
							css("color", "#999").
							bind("focus", function() {
											if ($(this).val() == $(this).data('default')) 
													$(this).val('').css("color", "#000");
												}).
							bind("blur", function() {
											if ($(this).val() == '') 
													 $(this).val($(this).data('default')).css("color", "#999");
												});
							});
}



function getTopLeft(elm)
{

var x, y = 0;
//set x to elm’s offsetLeft
x = elm.offsetLeft;
//set y to elm’s offsetTop
y = elm.offsetTop;
//set elm to its offsetParent
var sc = $(elm).closest(".scroll").scrollTop(); //scroll del scrooll
y -= sc; // a la coordenada top le resta el scroll

elm = elm.offsetParent;
//use while loop to check if elm is null
// if not then add current elm’s offsetLeft to x
//offsetTop to y and set elm to its offsetParent 
while(elm != null)
{
x = parseInt(x) + parseInt(elm.offsetLeft);
y = parseInt(y) + parseInt(elm.offsetTop);
elm = elm.offsetParent;
}
//here is interesting thing
//it return Object with two properties
//Top and Left 
return {Top:y, Left: x}; 

}



function agrandarYT (obj, id) {

		
			obj = obj.parentNode.getElementsByTagName('img')[0];
			var titulo = $(obj).attr('title'); 
			

			var poner = '<object style="height: 344px; width: 425px"><param name="movie" value="agrandarYT(this, "http://www.youtube.com/v/'+id+'?f=videos&app=youtube_gdata")"><param name="allowFullScreen" value="true"><param name="allowScriptAccess" value="always"><embed src="http://www.youtube.com/v/'+id+'?f=videos&app=youtube_gdata")" type="application/x-shockwave-flash" allowfullscreen="true" allowScriptAccess="always" width="425" height="344"></object>'
			poner += "<p>"+titulo+"</p>";
			poner += "<p class='minimo blanco'>Esta imagen puede tener copyright.</p>";
			poner += "<a href='yt.php?link="+id+"' target='_blank'><img src='img/zoom.gif' alt='Ver video en pantalla completa en otra ventana' title='Ver video en pantalla completa en otra ventana'/></a>";
			poner += "<img onclick='cerrarfondonegro()' src='img/cerrar.gif' alt='Cerrar' title='Cerrar' />";
			
			
			$("#fondonegro").empty();
			

			
			
			
			var h = 384;
			var w = 425;
		//	var l = Math.floor(($(window).width() - w) / 2);
			//var t = Math.floor(($(window).height() - h - 20) / 2) + $(window).scrollTop();
			
			abrirmodal(obj, h, w, "#000000", poner, "Video by YouTube", true);
		
			
}




function urlencode (str) {
    // http://kevin.vanzonneveld.net
    // +   original by: Philip Peterson
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +      input by: AJ
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +      input by: travc
    // +      input by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Lars Fischer
    // +      input by: Ratheous
    // +      reimplemented by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Joris
    // +      reimplemented by: Brett Zamir (http://brett-zamir.me)
    // %          note 1: This reflects PHP 5.3/6.0+ behavior
    // %        note 2: Please be aware that this function expects to encode into UTF-8 encoded strings, as found on
    // %        note 2: pages served as UTF-8
    // *     example 1: urlencode('Kevin van Zonneveld!');
    // *     returns 1: 'Kevin+van+Zonneveld%21'
    // *     example 2: urlencode('http://kevin.vanzonneveld.net/');
    // *     returns 2: 'http%3A%2F%2Fkevin.vanzonneveld.net%2F'
    // *     example 3: urlencode('http://www.google.nl/search?q=php.js&ie=utf-8&oe=utf-8&aq=t&rls=com.ubuntu:en-US:unofficial&client=firefox-a');
    // *     returns 3: 'http%3A%2F%2Fwww.google.nl%2Fsearch%3Fq%3Dphp.js%26ie%3Dutf-8%26oe%3Dutf-8%26aq%3Dt%26rls%3Dcom.ubuntu%3Aen-US%3Aunofficial%26client%3Dfirefox-a'
    str = (str + '').toString();

    // Tilde should be allowed unescaped in future versions of PHP (as reflected below), but if you want to reflect current
    // PHP behavior, you would need to add ".replace(/~/g, '%7E');" to the following.
    return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').
    replace(/\)/g, '%29').replace(/\*/g, '%2A').replace(/%20/g, '+');
}



		
		
function thumb(imagen, id, w, h, related, path, contenedor, crop, openvideo, title) {
	var r = 't';
	$.ajax({
		url: path+'library/thumb.php', 
		async: false,
		data: {imagen: imagen, id:id , w:w, h:h, related: related, path: path, contenedor: contenedor, crop: crop, openvideo: openvideo, title: title}, 
		success: function (poner) {
						r= poner;
				}
	});
	return r;
}




function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}


function roundNumber(num, dec) {
	dec = (!dec) ? 2 : dec; 
	var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
	return result;
}




function actualizarImpares(donde, elemento) {
			if (!donde) donde = "div.resultados";
			if (!elemento) elemento = "div.linea";
			$(donde).find(elemento).removeClass("par").filter(":odd").addClass("par");
		}
		
		
		
		function arriba(obj) {
			obj = $(obj).closest("div.linea");
			var previo = $(obj).prev('.linea');
			if (previo.length) previo.before(obj);
			actualizarImpares(obj.parent());
		}
		
		
		function abajo(obj) {
			obj = $(obj).closest("div.linea");
			var previo = $(obj).next('div.linea');
			if (previo.length) previo.after(obj);
			actualizarImpares(obj.parent());
		}
		
		function borrar(obj) {
		$(obj).closest(".linea").fadeOut(400, function() { $(this).remove() });;
	}
	
	
	function getParametersMinusOne(excluir) {//quita un paraetro get dela url
		var parts = window.location.href.split('?');
		
		if (parts[1].indexOf(excluir) != -1)
			{
				var index = parts[1].split(excluir);
				return (index[1].indexOf('&') == -1) ? index[0].substr(0, index[0].length-1) : index[0] + index[1].substr( index[1].indexOf('&')+1);
				
			}
		else return parts[1].substr(0, parts[1].length);
	}
	
	
	
	function eliminarUsuario(obj) {
		if (confirm("Seguro que desea eliminar este usuario"))
			{
				obj = $(obj).closest('.linea');
				
				$(obj).fadeOut(400, function() {
					$.post('api_articulos.php', { accion: 'eliminarUsuario', id: obj.attr('id') });
				
				});
						
			}
	}
	
	
	
	
	function cargarAjax(file, title, w, h) {
		w = typeof w !== 'undefined' ? w : 400;
		h = typeof h !== 'undefined' ? h : 250;
		
		abrir_ventana(w, h, title);	
		
		$("#ventana").css('background-image', 'url(img/loader.gif)')
			.find('#contenido').empty()
			.load(file, function(response) {
					
					//////////////////////////HACK POR SI HAY ERROR EN EL LOAD
					if (response && !$(this).children().length)
						$(this).html(response);
					/////////////////////////////////////////NO DEBERIA HACER FALTA PERO EN ALGUN CASO HIZO FALTA
					$(this).fadeIn(300);
					quitar_loader();
					});	
	}
	
	
	function alertar(texto, title, w, h) {
		w = typeof w !== 'undefined' ? w : 400;
		h = typeof h !== 'undefined' ? h : 250;
		
		abrir_ventana(w, h, title);	
		
		$("#ventana").css('background', '#fff').find('#contenido').fadeIn(200).html(texto);
	}



	function validateEmail(email) { 
	    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
} 
