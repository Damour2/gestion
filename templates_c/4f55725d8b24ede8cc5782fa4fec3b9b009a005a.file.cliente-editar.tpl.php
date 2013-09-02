<?php /* Smarty version Smarty-3.1.11, created on 2012-12-08 21:05:50
         compiled from ".\templates\cliente-editar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:311050280fd1ac8064-90762403%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4f55725d8b24ede8cc5782fa4fec3b9b009a005a' => 
    array (
      0 => '.\\templates\\cliente-editar.tpl',
      1 => 1354997111,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '311050280fd1ac8064-90762403',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50280fd1c39907_68284703',
  'variables' => 
  array (
    'r' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50280fd1c39907_68284703')) {function content_50280fd1c39907_68284703($_smarty_tpl) {?>
     
       <input type="hidden" id="id" name="id" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['id_cli'];?>
" />
        <p><input type="hidden" id="tipo" name="tipo" value="cliente" />
		<label>Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['nombre'];?>
" /></p>
        <p>
        <label>Contacto:</label>
        <input type="text" id="contacto" name="contacto" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['contacto'];?>
"/></p>
        <p>
        <label>Dirección:</label>
        <input type="text" id="direccion" name="direccion" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['direccion'];?>
"/></p>
        <p>
        <label>Telefono:</label>
        <input type="text" id="telefono" name="telefono" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['telefono'];?>
"/></p>
        <p>
        <label>Mail:</label>
        <input type="text" id="mail" name="mail" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['mail'];?>
"/></p>
        <p>
        <label>CUIT / DNI:</label>
        <input type="text" id="dni_cuit" name="dni_cuit" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['dni_cuit'];?>
"/></p>
        <p>
        <label>Entrega en:</label>
        <input type="text" id="domicilio_entrega" name="domicilio_entrega" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['domicilio_entrega'];?>
"/></p>
        <p>
        <label>Expreso:</label>
        <input type="text" id="expreso" name="expreso" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['expreso'];?>
"/></p>
        <p>
        <label>Situación IVA:</label>
        <input type="text" id="iva" name="iva" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['iva'];?>
"/></p>
     	<p>
        <label>Vendedor:</label>
        <input type="text" id="vendedor" name="vendedor" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['vendedor'];?>
"/></p>
     
        <p>
        <a class="boton rojo" onClick="cerrar_ventana()">Descartar</a> 
        <a class="boton azul" onClick="guardar()">Guardar</a>
        <img class="loader" src="img/loader.gif">
        </p>
   <?php }} ?>