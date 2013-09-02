{config_load file="test.conf" section="setup"}


  
{foreach item=r from=$datos}
  
  <div class="linea proveedor" id="{$r.id_cli}">
  	<a class="boton azul editar" title="Editar"></a>
    <a class="boton rojo eliminar" title="Eliminar"></a>
    {$r.nombre}
    <a class="boton rojo comprobante" href="?accion=compras&status=proveedor&id_cli={$r.id_cli}" title="Nuevo movimiento"></a>
    <a class="boton azul cc" href="?accion=cc&tipo=proveedor&id={$r.id_cli}" title="Ver cuenta corriente"></a>
    <a class="boton azul subir" title="Aumentar precios de materias primas"></a>
   
    
  </div>
{/foreach}

