
<div class='linea header'>
		<span class='nombre_cli'>Nombre</span>
    	<span class='nombre'>Tipo</span>
    	<span class='id_var'>Nº cheque</span>
    	<span class='importe'>Importe</span>
    	<span class='banco_origen'>Banco</span>
    	<span class='fecha_emision'>Fecha emision</span>
    	<span class='fecha_cobro'>Fecha cobro</span>
</div>

{foreach from=$datos item=r}
    <div class='linea' id='{$r.id_mov}'>
    	<span class='nombre_cli' title='{$r.nombre_cli}'><a href='?accion=cc&tipo={$params.fuente}&id={$r.id_cli}'>{$r.nombre_cli}</a></span>
    	<span class='nombre'>{$r.nombre}</span>
    	<span class='id_var'>{$r.id_var}</span>
    	<span class='importe'>{$r.importe}</span>
    	<span class='banco_origen' title='{$r.banco_origen}'>{$r.banco_origen}</span>
    	<span class='fecha_emision'>{$r.fecha_emision}</span>
    	<span class='fecha_cobro'>{$r.fecha_cobro}</span>
    	<select class='activo'>
    		<option value='1' {if $r.activo == 1}selected='selected'{/if}>Por cobrar</option>
			<option value='2' {if $r.activo == 2}selected='selected'{/if}>Cobrado</option>
			<option value='3' {if $r.activo == 3}selected='selected'{/if}>Rebotado</option>
    	</select>
    </div>
{/foreach}