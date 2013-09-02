<?php /* Smarty version Smarty-3.1.11, created on 2012-12-08 21:04:16
         compiled from ".\templates\materia-editar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2677950277110d9ba48-42407075%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '330c1fb1fc2316fc9f5dfb58e6a975a9fe4887c3' => 
    array (
      0 => '.\\templates\\materia-editar.tpl',
      1 => 1351647130,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2677950277110d9ba48-42407075',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_502771110b1935_95342800',
  'variables' => 
  array (
    'r' => 0,
    'proveedores' => 0,
    'unidades' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_502771110b1935_95342800')) {function content_502771110b1935_95342800($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include 'C:\\maxi\\libo\\gestion\\smarty\\libs\\plugins\\function.html_options.php';
?>
    	
       
        <input type="hidden" id="id" name="id" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['id_mat'];?>
" />
		<p><label>Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['nombre'];?>
"/></p>
        <p><label>Proveedor:</label>
        <?php echo smarty_function_html_options(array('name'=>'id_cli','options'=>$_smarty_tpl->tpl_vars['proveedores']->value,'selected'=>$_smarty_tpl->tpl_vars['r']->value['id_cli']),$_smarty_tpl);?>
</p>
        <p><label>Unidad:</label>
        <?php echo smarty_function_html_options(array('name'=>'unidad','values'=>$_smarty_tpl->tpl_vars['unidades']->value,'output'=>$_smarty_tpl->tpl_vars['unidades']->value,'selected'=>$_smarty_tpl->tpl_vars['r']->value['unidad']),$_smarty_tpl);?>
</p>
        <p><label>Valor unitario:</label>
        <input type="text" name="valor" id="valor" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['valor'];?>
"></p>
        <p><label>Stock:</label>
        <input type="text" name="stock" id="stock" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['stock'];?>
"></p>
        <p><label>Stock Mínimo:</label>
        <input type="text" name="stock_minimo" id="stock_minimo" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['stock_minimo'];?>
"></p>
      
        <a class="boton rojo" onClick="cerrar_ventana()">Descartar</a> 
        <a class="boton azul" onClick="guardar()">Guardar</a><img class="loader" src="img/loader.gif"><?php }} ?>