<?php /* Smarty version Smarty-3.1.11, created on 2012-11-27 02:09:09
         compiled from ".\templates\preguntar-por-pago.tpl" */ ?>
<?php /*%%SmartyHeaderCode:354150b405d38f5092-92307138%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '43ea9e2628ed7659dd3f6a73aa5d1544eb9b3ce4' => 
    array (
      0 => '.\\templates\\preguntar-por-pago.tpl',
      1 => 1353977983,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '354150b405d38f5092-92307138',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50b405d3959648_49636054',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50b405d3959648_49636054')) {function content_50b405d3959648_49636054($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>


  
<p class='titulo_recuadro'>Este movimiento ha sido guardado.</h3>
<h3>Desea ingresar el pago para esta compra?</h3>

<p> 
	<a onclick='nuevoMovimiento()' class='boton azul'>No, cargar nuevo movimiento</a>
	<a onclick='cuentaCorriente()' class='boton azul'>No, ir a cuenta corriente</a>
	<a onclick="editarPago()" class='boton rojo'>Si, ingresar el pago ahora</a>	
</p>

<?php }} ?>