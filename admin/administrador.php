

<div class="recuadro">
	 <? /*
     <div class="fltrgt" id="categorias">
     <? 
	 $categorias_container = "checkbox";
		$categorias_pedida = "*";
		include "../library/listar_categorias.php";
	?>
    </div>
	*/?>
    <p><span><?=$traducir[buscarpornombre]?>: </span><input type="text" id="nombre" /></p>
    <p><span><?=$traducir[buscarportipo]?>: </span>
    <select id="tipo" onChange="cambiarTipo(this)">
    	<option value="producto"><?=$traducir[producto]?></option>
       <!-- <option value="sucursal">Sucursales</option>-->
        <option value="noticia"><?=$traducir[noticia]?></option>
        <option value="sucursal"><?=_e('Sucursal');?></option>
     </select>
     
     <span><?=$traducir[porestado]?>: </span>
     <select id="activo">
     	<option value="-1"><?=$traducir[todos]?></option>
        <option value="1" selected="selected"><?=$traducir[activo]?></option>
        <option value="0"><?=$traducir[inactivo]?></option>
     </select>
     <input type="button" value="<?=$traducir[buscar]?>" onClick="buscar(0)">
     <img src="../img/loader2.gif" id="loader" >
     </p>
    
</div>


<div class="resultados">
</div>



<script type="text/javascript">

$(document).ready(function() {
	botones = "<span class='boton' onclick='editar(this)'><?=$traducir[editar]?></span><span class='boton' onclick='borrar(this)'><?=$traducir[borrar]?></span>";
	buscar(0);
	botonampliar = "<span class='boton' onclick='ampliar(this)'>+</span>";
		$(".super").append(botonampliar);
		$(".supercategoria").find("ul").hide();
});


function ampliar(obj) {
		$(obj).closest(".supercategoria").siblings().find("ul").slideUp().end().end().find("ul").slideDown();
	}




function marcar(obj) {
	
		var valor = $(obj).attr("checked") ? 1 : 0;
		var idi = $(obj).closest(".linea").attr('id');
		$.post("api_articulos.php", {accion: "marcar", id: idi, valor: valor});
	}

function marcarDestacado(obj) {
	
		var valor = $(obj).attr("checked") ? 1 : 0;
		var idi = $(obj).closest(".linea").attr('id');
		$.post("api_articulos.php", {accion: "marcarDestacado", id: idi, valor: valor});
	}


function borrar(obj) {
	if (confirm("<?=$traducir[seguro]?>")) {
		var idi = $(obj).closest(".linea").attr('id');
		$(obj).closest(".linea").fadeOut(400, function() {$(this).remove(); });
		$.post("api_articulos.php", {accion: "borrar", id: idi});
	}
}

function cambiarTipo(obj) {
	if ($(obj).val() == "sucursal") 
		{
		$("#categorias").css({ opacity: 0.5 }).find("select").attr('disabled', 'disabled');
		}
	else
		{
		$("#categorias").css({ opacity: 1 }).find("select").attr('disabled', '');
		}
}	


function buscar(offset) {
	var cats = new Array();
	$("#categorias").find("input:checked").each(function() {
		var res = $(this).closest("li").attr('id');
		if (res != '') cats.push(res);
	});
	cats = cats.join(",");
	console.log(cats);
	
	$("#loader").show();

	$.get("listar_articulos.php", {que: "titulo", nombre: $("#nombre").val(), tipo: $("#tipo").val(), categorias: cats, offset: offset, activo: $("#activo").val()}, 
			function(data) {
			$(".resultados").html(data).find(".linea").each(function(){
				$(this).prepend(botones);
			});
			verpares();
			$("#loader").hide();
			});
	

}


function verpares() {
	$(".resultados .linea").removeClass("par").filter(":even").addClass("par");
}

function iraOffset(num) {
	buscar(num);
}


function editar(obj) {
	var id = $(obj).closest(".linea").attr('id');
	window.location = "in.php?accion=articulo&id="+id;
}

</script>