{config_load file="test.conf" section="setup"}


{if $encabezado }
<div class="linea rojo">
  	<span class="valor">
    	Valor
	</span>
    <span class="valor_mayor">
    	Valor x mayor
	</span>
    <span class="stock">
    	Stock
	</span>
    <span class="stock_minimo">
    	Stock Mínimo
	</span>
  </div>
{/if}  
{foreach item=r from=$datos}
  
  <div class="linea producto" id="{$r.id_art}">
  	<a class="boton azul editar" title="Editar"></a>
    <a class="boton rojo eliminar" title="Eliminar"></a>
    {$r.nombre}
    <span class="valor">
    	<input type="text" value="{$r.valor}" {if $r.auto_publico } disabled="disabled" {/if} />
	</span>
    <span class="valor_mayor">
    	<input type="text" value="{$r.valor_mayor}" {if $r.auto_mayor } disabled="disabled" {/if}  />
	</span>
    <span class="stock">
    	<input type="text" value="{$r.stock}" />
	</span>
    <span class="stock_minimo">
    	<input type="text" value="{$r.stock_minimo}" />
	</span>
  </div>
{/foreach}

