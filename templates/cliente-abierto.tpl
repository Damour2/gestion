{config_load file="test.conf" section="setup"}

<h3 class="azul" id="id_cli" data-id_cli="{$cliente.id_cli}">{$cliente.tipo|capitalize}> {$cliente.nombre}</h3>

{foreach from=$cliente key=k item=v }
	{if $v != '' && $v != '0000-00-00' && $v != '0000-00-00 00:00:00' && $k != 'id_cli' && $k != 'nombre'}
		<p class='{$k}'>{$k}: <b>{$v}</b></p>
	{/if}

{/foreach}

