// JavaScript Document
$(document).ready(function() {
		$("body").append("<div id='ventana'><div id='encabezado'><span></span><a onclick='cerrar_ventana()' title='"+traducir.cerrar+"'></a></div><div id='contenido'></div></div>");
			
		
});


function agregar_carro(obj) {
	obj = $(obj).closest(".articulo");
	var idi = obj.attr('id');
	var imagen = obj.find(".img").attr('imagen');
	var valor = obj.find(".valor span").text();
	var nombre = obj.find(".nombre").text();
	var valor_descuento = obj.find(".valor_descuento span").text();
	var poner = Array();
	poner.push("<div class='articulo'>");
	poner.push("<p class='mensaje'>"+traducir.productoinserto+"</p>");
	poner.push(obj.html());
	poner.push("<a onclick='cerrar_ventana()' class='continua_comprando'>"+traducir.continuacomprando+"</a>");
	poner.push("<a href='in.php?accion=checkout' class='checkout'>"+traducir.checkout+"</a>");
	poner.push("</div>");
	poner = poner.join("");
	
	
	abrir_ventana(400, 300, traducir.agregarproducto, poner);

	
	$.post("api_carro.php", {accion: "agregar_producto", id : idi, valor : valor, valor_descuento: valor_descuento, cantidad: 1, imagen: imagen, nombre: nombre}, function(data) {
			
			
			actualizar_carro();
	
				});
	
}


function actualizar_carro() {
	
	$.get("api_carro.php", {accion: "estadisticas_carro"}, function(data) {
						$("#carrello .productos").html(data.cantidadproductos);																	
						$("#carrello .importe").html("€ " + data.importe);																	
						}, 'json');
	
}


function abrir_ventana(w, h, titulo, poner, scroller) {
	w = (w == null) ? 350 : w;
	h = (h == null) ? 300 : h;
	poner = (poner == null) ? "" : poner;
	var v = $("#ventana");
	v.find("#encabezado span").html(titulo);
	if (!v.filter(":visible").length) {
		v.width(w).css({minHeight: h+"px", marginLeft : (-w/2)+"px", marginTop: (-h/2)+"px"}).fadeIn(400);	
		if (scroller)  v.css({height: h+"px", overflowY: 'scroll'});
		else v.css({overflowY: 'visible', height: 'auto'});
		
	}
	else 
	
		v.find("#contenido").fadeOut(200).end().animate({width : w+"px", minHeight : h+"px", marginLeft : (-w/2)+"px", marginTop: (-h/2)+"px"}, function() {
				if (scroller)  v.css({height: h+"px", overflowY : 'scroll'});
				else v.css({overflowY : 'visible', height: 'auto'});
				}
				);
	
	if (poner == "")
		v.css("backgroundImage", "url(img/loader.gif)");	
	else
		if (poner) v.find("#contenido").html(poner).fadeIn(400);
	
}


function cerrar_ventana() {
	var v = $("#ventana");
	v.fadeOut(200);
}


function vaciar_carro() {
	$.post("api_carro.php", {accion: "vaciar_carro"} ,function () {
															   
								window.location.reload();
															   
															   });
}


function quitar_loader() {
	$("#ventana").css("background-image", "none");	
}


function login_window(obligado)  {
	
	abrir_ventana(400, 300, "Login");	
	var obliga;
	if (obligado) {
		obliga = "?obligado=obligado";
		ir_a_pagar = true;
	}
	else {obliga = ""; ir_a_pagar = false; }
	$("#ventana #contenido").load("login.php"+obliga, function() {quitar_loader();});
	
}


function ingresar() {
			$("#ventana #contenido").prepend("<p align='center' class='loader'><img src='img/loader.gif' /></p>");
			var datos = $("#ventana form input[type=text]").serialize();
			$.get("api_usuario.php?accion=login", datos, function(data) 
																  {
							if (data.status == "error")
								$("#ventana #contenido").find(".mensaje, .loader").remove().end()
												.prepend("<p class='mensaje'>"+data.motivo+"</p>");
							else 
								{
									
									
										cerrar_ventana();
										
										actualizar_usuario(data);
									
								}
																  }, 'json');
			
		}
		
		function olvido_password() {
			abrir_ventana(400, 200, "Login");	
			$("#ventana").css("backgroundImage", "url(img/loader.gif)").find("#contenido").empty().load("olvida_password.php", function() {
																																				
				$("#contenido").fadeIn(200);
				quitar_loader();
										});
		}
		
		
		function actualizar_usuario(data) {
			id_cli = data.id_cli;
			mail_cli = data.mail;
			if (!data.id_cli)
				{
					$("#supertop .login").html("<a href='#' onclick='login_window(false)'>Login / Registrati</a>");
					//$("#sidebar #menuusuario").slideUp(300);
				}
				
			else 
				{
				  $("#supertop .login").html("<a onclick='logout()'>Logout</a>");		
				  if (ir_a_pagar) window.location = 'in.php?accion=pagar';
				  //$("#sidebar #menuusuario").html("<p>"+traducir.cliente+": <b>"+data.mail+"</b></p><p class='mensaje'>"+data.mensaje+"</p>").slideDown(400);
				  
				}
				
			
		}
		
		
		function logout() {
			if (confirm(traducir.segurologout)) {
					$.post("api_usuario.php", {accion:"logout"}, function(data) {
																		  actualizar_usuario(data);
																		  actualizar_carro();
																		  window.location = 'index.php';
																		  }, 'json' );
			}
			
		}
		
		function recuperar_password() {
			var mail = $("#olvida input[type=text]").val();	
			$("#ventana fieldset .mensaje").remove();
			$("#ventana #contenido fieldset").append("<p align='center' class='loader'><img src='img/loader.gif' /></p>");
			$.post("api_usuario.php", { accion : "olvida_password", mail: mail }, 
				   	function(data) {
						$("#ventana fieldset").append("<p class='mensaje'>"+data.mensaje+"</p>").find(".loader").remove();
						if (data.status != "error")
							 setTimeout("cerrar_ventana()",5000);
					}, 'json');
		}
		
		function nuevo_cliente() {
			abrir_ventana(400, 500, "Login", '', true);	
			$("#ventana #contenido").css("backgorundImage", "url(img/loader.gif)").empty().load("nuevo_cliente.php", function() {
																																				
				$(this).fadeIn(200);
				quitar_loader();
										});
		}
		
		function registrar_nuevo_cliente() {
			if ($("#password").val() != $("#confirma_password").val()) {
				alert(traducir.confirmapassworddistinto);
				return false;
			}
			var datos = $("#ventana fieldset input, #ventana fieldset select").serialize();	
			$("#ventana fieldset .mensaje").remove();
			$.post("api_usuario.php?accion=nuevo_cliente", datos, function(data) {
								
								$("#contenido").append("<p class='mensaje'>"+data.mensaje+"/<p>");
								if (data.status != "error")
								{
									actualizar_usuario(data);
									setTimeout("cerrar_ventana()", 3000);
								}
																		   }, 'json');
		}
		
		
		function confirmar_orden() {
			try {
			if (!id_cli) login_window(true);
			else window.location = "in.php?accion=pagar";
			}
			catch(e) {
				login_window(true);	
			}
		}