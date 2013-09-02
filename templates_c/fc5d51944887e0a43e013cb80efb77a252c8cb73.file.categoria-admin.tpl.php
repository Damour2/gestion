<?php /* Smarty version Smarty-3.1.11, created on 2012-09-14 18:39:30
         compiled from "./templates/categoria-admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19963050825053a412c63b01-17105463%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fc5d51944887e0a43e013cb80efb77a252c8cb73' => 
    array (
      0 => './templates/categoria-admin.tpl',
      1 => 1346181895,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19963050825053a412c63b01-17105463',
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
  'unifunc' => 'content_5053a412dcd3e7_32634325',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5053a412dcd3e7_32634325')) {function content_5053a412dcd3e7_32634325($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>


  
<?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['datos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value){
$_smarty_tpl->tpl_vars['r']->_loop = true;
?>
  
  <div class="linea categoria" id="<?php echo $_smarty_tpl->tpl_vars['r']->value['id_cat'];?>
">
  	<a class="boton azul editar" title="Editar"></a>
    <a class="boton rojo eliminar" title="Eliminar"></a>
    <span><?php echo $_smarty_tpl->tpl_vars['r']->value['nombre'];?>
</span>
   
   
    
  </div>
<?php } ?>

<?php }} ?>