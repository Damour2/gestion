<?php /* Smarty version Smarty-3.1.11, created on 2013-03-24 21:37:48
         compiled from ".\templates\subir-porcentaje.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31199502b260ae15ba1-75481731%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd606ff47d821698db0d4a4e57516947d868393f1' => 
    array (
      0 => '.\\templates\\subir-porcentaje.tpl',
      1 => 1351647126,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31199502b260ae15ba1-75481731',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_502b260aeb81a5_28061752',
  'variables' => 
  array (
    'nombre' => 0,
    'id' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_502b260aeb81a5_28061752')) {function content_502b260aeb81a5_28061752($_smarty_tpl) {?>
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