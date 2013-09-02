{config_load file="test.conf" section="setup"}

{if $encabezado == true}
<div class="linea rojo">
  	<span class="proveedor">
    	Proveedor
	</span>
    <span class="unidad">
    	Unidad
	</span>
    <span class="valor">
    	Valor x unidad
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
  
  <div class="linea producto" id="{$r.id_mat}">
  	<a class="boton azul editar" title="Editar"></a>
    <a class="boton rojo eliminar" title="Eliminar"></a>
    {$r.nombre}
    <span class="proveedor">
    	{html_options name=proveedores options=$proveedores selected=$r.id_cli}
	</span>
    <span class="unidad">
    	{html_options name=unidad values=$unidades output=$unidades selected=$r.unidad}
	</span>
    <span class="valor">
    	<input type="text" value="{$r.valor}" />
	</span>
     <span class="stock">
    	<input type="text" value="{$r.stock}" />
	</span>
     <span class="stock_minimo">
    	<input type="text" value="{$r.stock_minimo}" />
	</span>
  </div>
{/foreach}

