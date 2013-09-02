
<div class='linea header'>
		<span class='nombre_cli'>Nombre</span>
    	<span class='nombre'>Tipo</span>
    	<span class='importe'>Importe</span>
    	<span class='retencion'>Retención</span>
    	<span class='fecha_cobro'>Fecha</span>
</div>

{foreach from=$datos item=r}
    <div class='linea' id='{$r.id_ses}'>
    	<span class='nombre_cli' title='{$r.nombre_cli}'><a href='?accion=cc&tipo={$params.fuente}&id={$r.id_cli}'>{$r.nombre_cli}</a></span>
    	<span class='nombre'>{$r.tipo_cli}</span>
    	<span class='importe'>{$r.total}</span>
    	<span class='retencion'>{$r.recargo}</span>
    	<span class='fecha_cobro'>{$r.fecha}</span>
    </div>
{/foreach}