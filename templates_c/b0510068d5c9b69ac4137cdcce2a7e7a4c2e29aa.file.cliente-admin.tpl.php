<?php /* Smarty version Smarty-3.1.11, created on 2012-11-26 22:18:33
         compiled from ".\templates\cliente-admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2137750280d968c3be7-28703948%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b0510068d5c9b69ac4137cdcce2a7e7a4c2e29aa' => 
    array (
      0 => '.\\templates\\cliente-admin.tpl',
      1 => 1353964707,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2137750280d968c3be7-28703948',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50280d969da638_25973681',
  'variables' => 
  array (
    'datos' => 0,
    'r' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50280d969da638_25973681')) {function content_50280d969da638_25973681($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>


  
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

    <a class="boton rojo comprobante" href="?accion=compras&status=cliente&id_cli=<?php echo $_smarty_tpl->tpl_vars['r']->value['id_cli'];?>
" title="Nuevo movimiento"></a>
    <a class="boton azul cc" title="Ver cuenta corriente" href="?accion=cc&tipo=cliente&id=<?php echo $_smarty_tpl->tpl_vars['r']->value['id_cli'];?>
"></a>
   
    
  </div>
<?php } ?>

<?php }} ?>