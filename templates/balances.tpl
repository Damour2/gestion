<div class='compras media_columna'>
    <h3 class='rojo'>Compras</h3>
    <div class='linea header'>
            <span class='iva'>IVA</span>
            <span class='importe'>Importe</span>
    </div>

    {foreach from=$compras item=r}
        {include file="balance.tpl" title=foo}
    {/foreach}
    <div class='linea header'>
        Totales:<span class='iva'>{$totales['ivaCompras']|string_format:"%.2f"}</span><span class='importe'>{$totales['compras']|string_format:"%.2f"}</span>
    </div>
</div>

<div class='ventas media_columna'>
    <h3>Ventas</h3>
    <div class='linea header'>
            <span class='iva'>IVA</span>
            <span class='importe'>Importe</span>
    </div>

    {foreach from=$ventas item=r}
        {include file="balance.tpl" title=foo}
    {/foreach}
    <div class='linea header'>
    Totales:<span class='iva'>{$totales['ivaVentas']|string_format:"%.2f"}</span><span class='importe'>{$totales['ventas']|string_format:"%.2f"}</span>
    </div>
</div>



