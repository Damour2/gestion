
    	
       
        <input type="hidden" id="id" name="id" value="{$r.id_mat}" />
		<p><label>Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="{$r.nombre}"/></p>
        <p><label>Proveedor:</label>
        {html_options name=id_cli options=$proveedores selected=$r.id_cli}</p>
        <p><label>Unidad:</label>
        {html_options name=unidad values=$unidades output=$unidades selected=$r.unidad}</p>
        <p><label>Valor unitario:</label>
        <input type="text" name="valor" id="valor" value="{$r.valor}"></p>
        <p><label>Stock:</label>
        <input type="text" name="stock" id="stock" value="{$r.stock}"></p>
        <p><label>Stock Mínimo:</label>
        <input type="text" name="stock_minimo" id="stock_minimo" value="{$r.stock_minimo}"></p>
      
        <a class="boton rojo" onClick="cerrar_ventana()">Descartar</a> 
        <a class="boton azul" onClick="guardar()">Guardar</a><img class="loader" src="img/loader.gif">