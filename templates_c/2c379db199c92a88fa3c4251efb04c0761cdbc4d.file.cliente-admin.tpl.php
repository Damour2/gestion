<?php /* Smarty version Smarty-3.1.11, created on 2012-09-10 17:10:04
         compiled from "./templates/cliente-admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:340196328504e491c4db419-25184840%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2c379db199c92a88fa3c4251efb04c0761cdbc4d' => 
    array (
      0 => './templates/cliente-admin.tpl',
      1 => 1346181895,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '340196328504e491c4db419-25184840',
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
  'unifunc' => 'content_504e491c606066_88490722',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_504e491c606066_88490722')) {function content_504e491c606066_88490722($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>


  
<?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['datos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value){
$_smarty_tpl->tpl_vars['r']->_loop = true;
?>
  
  <div class="linea producto" id="<?php echo $_smarty_tpl->tpl_vars['r']->value['id_cli'];?>
">
  	<a class="boton azul editar" title="Editar"></a>
    <a class="boton rojo eliminar" title="Eliminar"></a>
    <?php echo $_smarty_tpl->tpl_vars['r']->value['nombre'];?>

    <a class="boton rojo comprobante" title="Nuevo movimiento"></a>
    <a class="boton azul cc" title="Ver cuenta corriente"></a>
   
    
  </div>
<?php } ?>

<?php }} ?>