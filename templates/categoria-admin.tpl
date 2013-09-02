{config_load file="test.conf" section="setup"}


  
{foreach item=r from=$datos}
  
  <div class="linea categoria" id="{$r.id_cat}">
  	<a class="boton azul editar" title="Editar"></a>
    <a class="boton rojo eliminar" title="Eliminar"></a>
    <span>{$r.nombre}</span>
   
   
    
  </div>
{/foreach}

