   	
   
     
       <input type="hidden" id="id" name="id" value="{$r.id_cli}" />
		<p><label>Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="{$r.nombre}" /></p>
        <p><label>Contacto:</label>
        <input type="text" id="contacto" name="contacto" value="{$r.contacto}"/></p>
        <p><label>Dirección:</label>
        <input type="text" id="direccion" name="direccion" value="{$r.direccion}"/></p>
        <p><label>Telefono:</label>
        <input type="text" id="telefono" name="telefono" value="{$r.telefono}"/></p>
        <p><label>Mail:</label>
        <input type="text" id="mail" name="mail" value="{$r.mail}"/></p>
        <p><label>CUIT / DNI:</label>
        <input type="text" id="dni_cuit" name="dni_cuit" value="{$r.dni_cuit}"/></p>
        <p><label>CBU:</label>
        <input type="text" id="cbu" name="cbu" value="{$r.cbu}"/></p>
        <p>
        <label>Banco:</label>
        <input type="text" id="banco" name="banco" value="{$r.banco}"/></p>
        <p>
        <label>Situación IVA:</label>
        <input type="text" id="iva" name="iva" value="{$r.iva}"/></p>
        <p>
        	
        <a class="boton rojo" onClick="cerrar_ventana()">Descartar</a> 
        <a class="boton azul" onClick="guardar()">Guardar</a>
        <img class="loader" src="img/loader.gif">
        </p>