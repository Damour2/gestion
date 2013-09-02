<?php /* Smarty version Smarty-3.1.11, created on 2012-12-24 20:53:22
         compiled from ".\templates\preguntar-que-sigue.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2581950b412c8881023-73182843%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '26f6fa4bc808bfbd02a1b1afcc28e4e5d62dfcaf' => 
    array (
      0 => '.\\templates\\preguntar-que-sigue.tpl',
      1 => 1353978936,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2581950b412c8881023-73182843',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50b412c88ec7e7_60155502',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50b412c88ec7e7_60155502')) {function content_50b412c88ec7e7_60155502($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>


  
<p class='titulo_recuadro'>Este pago ha sido guardado.</h3>
<h3>Que desea hacer a continuación?</h3>

<p> 
	<a onclick='nuevoMovimiento()' class='boton azul'>Cargar nuevo movimiento</a>
	<a onclick='cuentaCorriente()' class='boton azul'>Ir a cuenta corriente</a>
	<a href='index.php' class='boton rojo'>Ir al menu principal</a>	
</p>

<?php }} ?>