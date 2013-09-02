<?php /* Smarty version Smarty-3.1.11, created on 2012-11-07 10:13:24
         compiled from ".\templates\categoria-admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14704502814da8a9b88-02414332%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fda85f0b23c66eb502a30acc8b1300fcfa6f1f71' => 
    array (
      0 => '.\\templates\\categoria-admin.tpl',
      1 => 1351647133,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14704502814da8a9b88-02414332',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_502814da981c20_45270914',
  'variables' => 
  array (
    'datos' => 0,
    'r' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_502814da981c20_45270914')) {function content_502814da981c20_45270914($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>


  
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