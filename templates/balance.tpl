        <div class='linea' id='{$r.id_ses}'>
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
            <span class='importe'>{$r.total|string_format:"%.2f"}</span>
        	<span class='iva'>{$r.iva|string_format:"%.2f"}</span>
            <span class='nombre_cli' title='{$r.nombre_cli}'><a href='?accion=cc&tipo={$params.fuente}&id={$r.id_cli}'>{$r.nombre_cli}</a></span>
        </div>