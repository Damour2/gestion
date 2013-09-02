<?php /* Smarty version Smarty-3.1.11, created on 2012-08-04 05:59:59
         compiled from ".\templates\materia_prima-admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14153501c95faad2429-80226197%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f9ea5e1de4f9fb4b35f319aff3402caf8fb39ac3' => 
    array (
      0 => '.\\templates\\materia_prima-admin.tpl',
      1 => 1344052781,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14153501c95faad2429-80226197',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_501c95fac72cd0_71477736',
  'variables' => 
  array (
    'datos' => 0,
    'r' => 0,
    'proveedores' => 0,
    'unidades' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_501c95fac72cd0_71477736')) {function content_501c95fac72cd0_71477736($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'C:\\maxi\\stock\\smarty\\libs\\plugins\\function.html_options.php';
?><?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>

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
  </div>
  
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

    <span class="proveedor">
    	<?php echo smarty_function_html_options(array('name'=>'proveed','options'=>$_smarty_tpl->tpl_vars['proveedores']->value,'selected'=>$_smarty_tpl->tpl_vars['r']->value['id_cli']),$_smarty_tpl);?>

	</span>
    <span class="unidad">
    	<?php echo smarty_function_html_options(array('name'=>'unidad','values'=>$_smarty_tpl->tpl_vars['unidades']->value,'output'=>$_smarty_tpl->tpl_vars['unidades']->value,'selected'=>$_smarty_tpl->tpl_vars['r']->value['unidad']),$_smarty_tpl);?>

	</span>
    <span class="valor">
    	<input type="text" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['valor'];?>
" />
	</span>
    
  </div>
<?php } ?>

<?php }} ?>