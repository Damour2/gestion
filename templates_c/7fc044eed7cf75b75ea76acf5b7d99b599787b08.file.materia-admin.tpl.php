<?php /* Smarty version Smarty-3.1.11, created on 2012-11-07 10:13:15
         compiled from ".\templates\materia-admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22177502468e0d5bf44-29009690%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7fc044eed7cf75b75ea76acf5b7d99b599787b08' => 
    array (
      0 => '.\\templates\\materia-admin.tpl',
      1 => 1351647130,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22177502468e0d5bf44-29009690',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_502468e117f8e1_95902270',
  'variables' => 
  array (
    'encabezado' => 0,
    'datos' => 0,
    'r' => 0,
    'proveedores' => 0,
    'unidades' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_502468e117f8e1_95902270')) {function content_502468e117f8e1_95902270($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'C:\\maxi\\libo\\gestion\\smarty\\libs\\plugins\\function.html_options.php';
?><?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>

<?php if ($_smarty_tpl->tpl_vars['encabezado']->value==true){?>
<div class="linea rojo">
  	<span class="proveedor">
    	Proveedor
	</span>
    <span class="unidad">
    	Unidad
	</span>
    <span class="valor">
    	Valor x unidad
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
  
  <div class="linea producto" id="<?php echo $_smarty_tpl->tpl_vars['r']->value['id_mat'];?>
">
  	<a class="boton azul editar" title="Editar"></a>
    <a class="boton rojo eliminar" title="Eliminar"></a>
    <?php echo $_smarty_tpl->tpl_vars['r']->value['nombre'];?>

    <span class="proveedor">
    	<?php echo smarty_function_html_options(array('name'=>'proveedores','options'=>$_smarty_tpl->tpl_vars['proveedores']->value,'selected'=>$_smarty_tpl->tpl_vars['r']->value['id_cli']),$_smarty_tpl);?>

	</span>
    <span class="unidad">
    	<?php echo smarty_function_html_options(array('name'=>'unidad','values'=>$_smarty_tpl->tpl_vars['unidades']->value,'output'=>$_smarty_tpl->tpl_vars['unidades']->value,'selected'=>$_smarty_tpl->tpl_vars['r']->value['unidad']),$_smarty_tpl);?>

	</span>
    <span class="valor">
    	<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['valor'];?>
" />
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