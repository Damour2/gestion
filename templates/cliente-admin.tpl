{config_load file="test.conf" section="setup"}


  
{foreach item=r from=$datos}
  
  <div class="linea producto" id="{$r.id_cli}">
  	<a class="boton azul editar" title="Editar"></a>
    <a class="boton rojo eliminar" title="Eliminar"></a>
    {$r.nombre}
    <a class="boton rojo comprobante" href="?accion=compras&status=cliente&id_cli={$r.id_cli}" title="Nuevo movimiento"></a>
    <a class="boton azul cc" title="Ver cuenta corriente" href="?accion=cc&tipo=cliente&id={$r.id_cli}"></a>
   
    
  </div>
{/foreach}

