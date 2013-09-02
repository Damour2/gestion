<?php /* Smarty version Smarty-3.1.11, created on 2012-11-04 22:09:51
         compiled from ".\templates\producto-admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:15376501c6faa780986-98732947%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '19a050ac8efe5ccd7c0f47cf83388c8982254383' => 
    array (
      0 => '.\\templates\\producto-admin.tpl',
      1 => 1351647128,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15376501c6faa780986-98732947',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_501c6faa8b26d5_21346765',
  'variables' => 
  array (
    'encabezado' => 0,
    'datos' => 0,
    'r' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_501c6faa8b26d5_21346765')) {function content_501c6faa8b26d5_21346765($_smarty_tpl) {?><?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>


<?php if ($_smarty_tpl->tpl_vars['encabezado']->value){?>
<div class="linea rojo">
  	<span class="valor">
    	Valor
	</span>
    <span class="valor_mayor">
    	Valor x mayor
	</span>
    <span class="stock">
    	Stock
	</span>
    <span class="stock_minimo">
    	Stock Mínimo
	</span>
  </div>
<?php }?>  
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

    <span class="valor">
    	<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['valor'];?>
" <?php if ($_smarty_tpl->tpl_vars['r']->value['auto_publico']){?> disabled="disabled" <?php }?> />
	</span>
    <span class="valor_mayor">
    	<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['valor_mayor'];?>
" <?php if ($_smarty_tpl->tpl_vars['r']->value['auto_mayor']){?> disabled="disabled" <?php }?>  />
	</span>
    <span class="stock">
    	<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['stock'];?>
" />
	</span>
    <span class="stock_minimo">
    	<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['stock_minimo'];?>
" />
	</span>
  </div>
<?php } ?>

<?php }} ?>