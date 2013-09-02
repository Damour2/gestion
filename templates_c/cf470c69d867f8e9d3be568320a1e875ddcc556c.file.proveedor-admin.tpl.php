<?php /* Smarty version Smarty-3.1.11, created on 2012-08-29 17:54:27
         compiled from "./templates/proveedor-admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1036602312503e818389aee1-47766793%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cf470c69d867f8e9d3be568320a1e875ddcc556c' => 
    array (
      0 => './templates/proveedor-admin.tpl',
      1 => 1346181898,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1036602312503e818389aee1-47766793',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'datos' => 0,
    'r' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_503e81839a95b7_11629573',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_503e81839a95b7_11629573')) {function content_503e81839a95b7_11629573($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>


  
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

    <a class="boton rojo comprobante" title="Nuevo movimiento"></a>
    <a class="boton azul cc" title="Ver cuenta corriente"></a>
    <a class="boton azul subir" title="Aumentar precios de materias primas"></a>
   
    
  </div>
<?php } ?>

<?php }} ?>