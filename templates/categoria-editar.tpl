
    	
   
     
       <input type="hidden" id="id" name="id" value="{$r.id_cat}" />
       <input type="hidden" id="parent" name="parent" value="{$parent}" />

		<label>Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="{$r.nombre}" />
     
        <p>
        	
        <a class="boton rojo" onClick="cerrar_ventana()">Descartar</a> 
        <a class="boton azul" onClick="guardar()">Guardar</a>
        <img class="loader" src="img/loader.gif">
        </p>