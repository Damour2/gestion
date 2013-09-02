<?php /* Smarty version Smarty-3.1.11, created on 2012-10-08 23:09:06
         compiled from "./templates/subir-porcentaje.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1612389725503e81afaa4450-94181160%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '413dbec0722f3944b28ca2fcc59bb6d930c525df' => 
    array (
      0 => './templates/subir-porcentaje.tpl',
      1 => 1349748504,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1612389725503e81afaa4450-94181160',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_503e81afaf2139_88070164',
  'variables' => 
  array (
    'nombre' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_503e81afaf2139_88070164')) {function content_503e81afaf2139_88070164($_smarty_tpl) {?>
<div class="aumentar">
<p>Desea aumentar los precios de las materias primas de </p>
<p><b><big><?php echo $_smarty_tpl->tpl_vars['nombre']->value;?>
</b></big>, en un </big>
<p><input type="text" id="porcentaje" placeholder="porcentaje" id_prov='<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
' />por ciento?</p>


        
  <p>      
  		<a class="boton rojo" onClick="cerrar_ventana()">Descartar</a> 
        <a class="boton azul" onClick="subirAhora()">Aumentar ahora!</a><img class="loader" src="img/loader.gif">
        
        </p>
        
        </div><?php }} ?>