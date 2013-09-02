<?php /* Smarty version Smarty-3.1.11, created on 2013-07-03 04:51:32
         compiled from ".\templates\retenciones.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1656151d39056c4b880-47255392%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c799921d9b1397641315b7d7a10ef84e9ce20d62' => 
    array (
      0 => '.\\templates\\retenciones.tpl',
      1 => 1372819874,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1656151d39056c4b880-47255392',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_51d39056d03553_88980448',
  'variables' => 
  array (
    'datos' => 0,
    'r' => 0,
    'params' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d39056d03553_88980448')) {function content_51d39056d03553_88980448($_smarty_tpl) {?>
<div class='linea header'>
		<span class='nombre_cli'>Nombre</span>
    	<span class='nombre'>Tipo</span>
    	<span class='importe'>Importe</span>
    	<span class='retencion'>Retención</span>
    	<span class='fecha_cobro'>Fecha</span>
</div>

<?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['datos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value){
$_smarty_tpl->tpl_vars['r']->_loop = true;
?>
    <div class='linea' id='<?php echo $_smarty_tpl->tpl_vars['r']->value['id_ses'];?>
'>
    	<span class='nombre_cli' title='<?php echo $_smarty_tpl->tpl_vars['r']->value['nombre_cli'];?>
'><a href='?accion=cc&tipo=<?php echo $_smarty_tpl->tpl_vars['params']->value['fuente'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['r']->value['id_cli'];?>
'><?php echo $_smarty_tpl->tpl_vars['r']->value['nombre_cli'];?>
</a></span>
    	<span class='nombre'><?php echo $_smarty_tpl->tpl_vars['r']->value['tipo_cli'];?>
</span>
    	<span class='importe'><?php echo $_smarty_tpl->tpl_vars['r']->value['total'];?>
</span>
    	<span class='retencion'><?php echo $_smarty_tpl->tpl_vars['r']->value['recargo'];?>
</span>
    	<span class='fecha_cobro'><?php echo $_smarty_tpl->tpl_vars['r']->value['fecha'];?>
</span>
    </div>
<?php } ?><?php }} ?>