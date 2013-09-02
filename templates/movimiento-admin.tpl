{config_load file="test.conf" section="setup"}

{if $encabezado == true}
<div class="linea rojo">
    <span class="fecha">
    	Fecha
	</span>
  	<span class="nombre">
    	Descripcion
	</span>
     <span class="monto">
    	Importe
	</span>
     <span class="saldo">
    	Saldo
	</span>
  </div>
 {/if} 
  
{foreach item=r from=$datos}
  
  <div class="linea movimiento {$r.tipo}" id="{$r.id_ses}">
  	<a class="boton azul editar" title="Editar" href="?accion=compras&status={$smarty.get.tipo}&id={$r.id_ses}"></a>
    <a class="boton rojo eliminar" title="Eliminar"></a>
    <span class='fecha'>
    {$r.fecha|date_format:"%d-%m-%y"}
  </span>
    <span class='nombre'> 
    	{$r.tipo}
    	{if $r.descripcion}
    		{$r.descripcion}
    	{else if $r.factura}
    		Factura Nº {$r.factura}
    	{else if $r.remito}
    		Remito Nº {$r.remito}
    	{/if}
    </span>
    <span class='monto'>{$r.total}</span>
    <span class='importe'>{$r.total}</span>
    <span class='saldo {if $r.saldo < 0} negativo {/if}'> 
    	{$r.saldo} 
    </span>
    
  </div>
{/foreach}

