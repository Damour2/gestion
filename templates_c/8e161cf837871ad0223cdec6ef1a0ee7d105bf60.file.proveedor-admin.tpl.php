<?php /* Smarty version Smarty-3.1.11, created on 2012-11-26 21:26:07
         compiled from ".\templates\proveedor-admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1273501c9e12e148f2-01780098%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8e161cf837871ad0223cdec6ef1a0ee7d105bf60' => 
    array (
      0 => '.\\templates\\proveedor-admin.tpl',
      1 => 1353960408,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1273501c9e12e148f2-01780098',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_501c9e12f00864_93099202',
  'variables' => 
  array (
    'datos' => 0,
    'r' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_501c9e12f00864_93099202')) {function content_501c9e12f00864_93099202($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>


  
<?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['datos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value){
$_smarty_tpl->tpl_vars['r']->_loop = true;
?>
  
  <div class="linea proveedor" id="<?php echo $_smarty_tpl->tpl_vars['r']->value['id_cli'];?>
">
  	<a class="boton azul editar" title="Editar"></a>
    <a class="boton rojo eliminar" title="Eliminar"></a>
    <?php echo $_smarty_tpl->tpl_vars['r']->value['nombre'];?>

    <a class="boton rojo comprobante" href="?accion=compras&status=proveedor&id_cli=<?php echo $_smarty_tpl->tpl_vars['r']->value['id_cli'];?>
" title="Nuevo movimiento"></a>
    <a class="boton azul cc" href="?accion=cc&tipo=proveedor&id=<?php echo $_smarty_tpl->tpl_vars['r']->value['id_cli'];?>
" title="Ver cuenta corriente"></a>
    <a class="boton azul subir" title="Aumentar precios de materias primas"></a>
   
    
  </div>
<?php } ?>

<?php }} ?>