<?php /* Smarty version Smarty-3.1.11, created on 2012-12-08 21:06:18
         compiled from ".\templates\categoria-editar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:24275028224e7e1f94-20997091%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4c49fad98599af36d8ee990a9f4b5a73077564ab' => 
    array (
      0 => '.\\templates\\categoria-editar.tpl',
      1 => 1354997174,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '24275028224e7e1f94-20997091',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5028224e8f9d46_65095459',
  'variables' => 
  array (
    'r' => 0,
    'parent' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5028224e8f9d46_65095459')) {function content_5028224e8f9d46_65095459($_smarty_tpl) {?>
    	
   
     
       <input type="hidden" id="id" name="id" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['id_cat'];?>
" />
       <input type="hidden" id="parent" name="parent" value="<?php echo $_smarty_tpl->tpl_vars['parent']->value;?>
" />

		<label>Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['nombre'];?>
" />
     
        <p>
        	
        <a class="boton rojo" onClick="cerrar_ventana()">Descartar</a> 
        <a class="boton azul" onClick="guardar()">Guardar</a>
        <img class="loader" src="img/loader.gif">
        </p><?php }} ?>