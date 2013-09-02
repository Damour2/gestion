<?php /* Smarty version Smarty-3.1.11, created on 2012-08-08 15:42:42
         compiled from ".\templates\Proveedor-admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2761350226cd2b35541-17529639%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e22fc7a493c7a84d02983561fe8e621d104684d1' => 
    array (
      0 => '.\\templates\\Proveedor-admin.tpl',
      1 => 1344052777,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2761350226cd2b35541-17529639',
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
  'unifunc' => 'content_50226cd2c8f346_94834652',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50226cd2c8f346_94834652')) {function content_50226cd2c8f346_94834652($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>


  
<?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['datos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value){
$_smarty_tpl->tpl_vars['r']->_loop = true;
?>
  
  <div class="linea producto" id="<?php echo $_smarty_tpl->tpl_vars['r']->value['id_art'];?>
">
  	<a class="boton azul editar" title="Editar"></a>
    <a class="boton rojo eliminar" title="Eliminar"></a>
    <?php echo $_smarty_tpl->tpl_vars['r']->value['nombre'];?>

    <a class="boton rojo comprobante" title="Nuevo movimiento"></a>
    <a class="boton azul cc" title="Ver cuenta corriente"></a>
   
    
  </div>
<?php } ?>

<?php }} ?>