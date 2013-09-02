
     
       <input type="hidden" id="id" name="id" value="{$r.id_cli}" />
        <p><input type="hidden" id="tipo" name="tipo" value="cliente" />
		<label>Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="{$r.nombre}" /></p>
        <p>
        <label>Contacto:</label>
        <input type="text" id="contacto" name="contacto" value="{$r.contacto}"/></p>
        <p>
        <label>Dirección:</label>
        <input type="text" id="direccion" name="direccion" value="{$r.direccion}"/></p>
        <p>
        <label>Telefono:</label>
        <input type="text" id="telefono" name="telefono" value="{$r.telefono}"/></p>
        <p>
        <label>Mail:</label>
        <input type="text" id="mail" name="mail" value="{$r.mail}"/></p>
        <p>
        <label>CUIT / DNI:</label>
        <input type="text" id="dni_cuit" name="dni_cuit" value="{$r.dni_cuit}"/></p>
        <p>
        <label>Entrega en:</label>
        <input type="text" id="domicilio_entrega" name="domicilio_entrega" value="{$r.domicilio_entrega}"/></p>
        <p>
        <label>Expreso:</label>
        <input type="text" id="expreso" name="expreso" value="{$r.expreso}"/></p>
        <p>
        <label>Situación IVA:</label>
        <input type="text" id="iva" name="iva" value="{$r.iva}"/></p>
     	<p>
        <label>Vendedor:</label>
        <input type="text" id="vendedor" name="vendedor" value="{$r.vendedor}"/></p>
     
        <p>
        <a class="boton rojo" onClick="cerrar_ventana()">Descartar</a> 
        <a class="boton azul" onClick="guardar()">Guardar</a>
        <img class="loader" src="img/loader.gif">
        </p>
   