<?php /* Smarty version Smarty-3.1.11, created on 2012-09-25 11:07:34
         compiled from "./templates/proveedor-editar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:495942142503e81a065afd6-12319216%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aae5f65d71f751b03e49c1595a96749548ff3ffd' => 
    array (
      0 => './templates/proveedor-editar.tpl',
      1 => 1348368628,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '495942142503e81a065afd6-12319216',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_503e81a06d55d0_35100271',
  'variables' => 
  array (
    'r' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_503e81a06d55d0_35100271')) {function content_503e81a06d55d0_35100271($_smarty_tpl) {?>   	
   
     
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
        
        <a class="boton rojo" onClick="cerrar_ventana()">Descartar</a> 
        <a class="boton azul" onClick="guardar()">Guardar</a><img class="loader" src="img/loader.gif"><?php }} ?>