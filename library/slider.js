function slide(donde, deacuantos, continuo, vertical, circulos) {
	
	slideObj = Array();
	slideObj.vertical = vertical;
	slideObj.id = donde;
	slideObj.cuantos = Math.ceil($(slideObj.id).find("li").length / deacuantos);
	$(donde).css({"position": "relative", "textAlign": "left", "overflow": "hidden"}).find("ul").css("position", "absolute").width($(donde).width() * slideObj.cuantos).find("li").css('margin', 0);  //pone ancho al ul
	if (!vertical) $(donde).find("li").css({"float":"left"});
	slideObj.width = $(donde).width();
	slideObj.height = $(donde).height();
	if (slideObj.cuantos > 1) 
	{	
		if (continuo) slideObj.interval = setInterval("llamaSlide(-10)", 7000);
		$(donde).parent().find("#next").bind("click", function() {pasarSlider(1); }); //pone listeners
		$(donde).parent().find("#prev").bind("click", function() {pasarSlider(-1); });
		
		
		if (circulos) {// si hay que poner ciruclitos {

			
			var poner = "";
			for (var i = 0; i<slideObj.cuantos; i++)
				poner += "<div class='circ' id='circ"+i+"'></div>";
				
			$(slideObj.id).append("<div id='circulos'>"+poner+ "</div>");
			
			$(slideObj.id).find("div#circulos .circ").bind("click", function() {
				llamaSlide(parseInt($(this).attr('id').substr(4)));
			}).filter(":first").addClass("activo");
		}
		
		
		slideObj.actual = 0;
	}
	else {
	$(donde).find("#boton_proximo").remove();
	$(donde).find("#boton_anterior").remove();
	}
	
	
}

function llamaSlide(num) {
	
	var slideviejo = slideObj.actual;
	
	if (num == -10) slideObj.actual++;
	else { slideObj.actual = num;  
	clearInterval(slideObj.interval);}
	
	
	if (slideObj.actual >= slideObj.cuantos) { slideObj.actual = 0;  }
	else if (slideObj.actual < 0) slideObj.actual = slideObj.cuantos - 1;

	if (slideObj.actual < 0) slideObj.actual = 0;
	
	if (slideObj.actual != slideviejo)
	{
		if (slideObj.vertical) {
			var top = -slideObj.height * slideObj.actual;
		$(slideObj.id).find("ul").animate({top: top}, 400);
		}
		else {
		var left = -slideObj.width * slideObj.actual;
		$(slideObj.id).find("ul").animate({left: left}, 400);
		}

		//$(slideObj.id).parent().find("p#nombre").html(titulos[num])
		//		.end().find("p#descripcion").html(bajadas[num])
		$(slideObj.id).find("div#circulos div#circ"+slideObj.actual).addClass("activo").siblings().removeClass("activo");
		
	}
}

function pasarSlider(masomenos) {

	clearInterval(slideObj.interval);
	llamaSlide(slideObj.actual + masomenos);
	
}


function pararSlider() {
	clearInterval(slideObj.interval);
}