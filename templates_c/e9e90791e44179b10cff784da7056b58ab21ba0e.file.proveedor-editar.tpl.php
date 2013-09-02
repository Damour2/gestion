<?php /* Smarty version Smarty-3.1.11, created on 2012-12-08 21:05:45
         compiled from ".\templates\proveedor-editar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2767750278446839539-98375285%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e9e90791e44179b10cff784da7056b58ab21ba0e' => 
    array (
      0 => '.\\templates\\proveedor-editar.tpl',
      1 => 1354997129,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2767750278446839539-98375285',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_502784468ecc79_73664607',
  'variables' => 
  array (
    'r' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_502784468ecc79_73664607')) {function content_502784468ecc79_73664607($_smarty_tpl) {?>   	
   
     
       <input type="hidden" id="id" name="id" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['id_cli'];?>
" />
		<p><label>Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['nombre'];?>
" /></p>
        <p><label>Contacto:</label>
        <input type="text" id="contacto" name="contacto" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['contacto'];?>
"/></p>
        <p><label>Dirección:</label>
        <input type="text" id="direccion" name="direccion" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['direccion'];?>
"/></p>
        <p><label>Telefono:</label>
        <input type="text" id="telefono" name="telefono" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['telefono'];?>
"/></p>
        <p><label>Mail:</label>
        <input type="text" id="mail" name="mail" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['mail'];?>
"/></p>
        <p><label>CUIT / DNI:</label>
        <input type="text" id="dni_cuit" name="dni_cuit" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['dni_cuit'];?>
"/></p>
        <p><label>CBU:</label>
        <input type="text" id="cbu" name="cbu" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['cbu'];?>
"/></p>
        <p>
        <label>Banco:</label>
        <input type="text" id="banco" name="banco" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['banco'];?>
"/></p>
        <p>
        <label>Situación IVA:</label>
        <input type="text" id="iva" name="iva" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['iva'];?>
"/></p>
        <p>
        	
        <a class="boton rojo" onClick="cerrar_ventana()">Descartar</a> 
        <a class="boton azul" onClick="guardar()">Guardar</a>
        <img class="loader" src="img/loader.gif">
        </p><?php }} ?>