

{foreach item=r from=$datos}
	<div class="linea" id="{$r.id_mat}">
    	<span class="nombre">{$r.nombre}</span>
        <span class="valor"><input type="text" value="{$r.valor}" /></span>
        <span class="unidad">{$r.unidad}</span>
        <span class="requerida">{$r.requerida|string_format:"%.2f"}</span>
        <span class="stock"><input type="text" value="{$r.stock}" /></span>
        <span class="a_comprar">{if $r.a_comprar > 0} 
        							{$r.a_comprar|string_format:"%.2f"}
                                 {else} 0 {/if}</span>
        <span class="costo">{if $r.costo > 0} 
        							{$r.costo|string_format:"%.2f"}
                                 {else} 0 {/if}</span>
	</div>
{/foreach}