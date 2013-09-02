<?php /* Smarty version Smarty-3.1.11, created on 2013-07-03 04:31:06
         compiled from ".\templates\cheques.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2435751d22175c057a3-60609814%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bb8df21e8f39f97e96cb9dbcf86f86d25442e58d' => 
    array (
      0 => '.\\templates\\cheques.tpl',
      1 => 1372817459,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2435751d22175c057a3-60609814',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_51d22175ea8fa8_04513812',
  'variables' => 
  array (
    'datos' => 0,
    'r' => 0,
    'params' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51d22175ea8fa8_04513812')) {function content_51d22175ea8fa8_04513812($_smarty_tpl) {?>
<div class='linea header'>
		<span class='nombre_cli'>Nombre</span>
    	<span class='nombre'>Tipo</span>
    	<span class='id_var'>Nº cheque</span>
    	<span class='importe'>Importe</span>
    	<span class='banco_origen'>Banco</span>
    	<span class='fecha_emision'>Fecha emision</span>
    	<span class='fecha_cobro'>Fecha cobro</span>
</div>

<?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['datos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value){
$_smarty_tpl->tpl_vars['r']->_loop = true;
?>
    <div class='linea' id='<?php echo $_smarty_tpl->tpl_vars['r']->value['id_mov'];?>
'>
    	<span class='nombre_cli' title='<?php echo $_smarty_tpl->tpl_vars['r']->value['nombre_cli'];?>
'><a href='?accion=cc&tipo=<?php echo $_smarty_tpl->tpl_vars['params']->value['fuente'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['r']->value['id_cli'];?>
'><?php echo $_smarty_tpl->tpl_vars['r']->value['nombre_cli'];?>
</a></span>
    	<span class='nombre'><?php echo $_smarty_tpl->tpl_vars['r']->value['nombre'];?>
</span>
    	<span class='id_var'><?php echo $_smarty_tpl->tpl_vars['r']->value['id_var'];?>
</span>
    	<span class='importe'><?php echo $_smarty_tpl->tpl_vars['r']->value['importe'];?>
</span>
    	<span class='banco_origen' title='<?php echo $_smarty_tpl->tpl_vars['r']->value['banco_origen'];?>
'><?php echo $_smarty_tpl->tpl_vars['r']->value['banco_origen'];?>
</span>
    	<span class='fecha_emision'><?php echo $_smarty_tpl->tpl_vars['r']->value['fecha_emision'];?>
</span>
    	<span class='fecha_cobro'><?php echo $_smarty_tpl->tpl_vars['r']->value['fecha_cobro'];?>
</span>
    	<select class='activo'>
    		<option value='1' <?php if ($_smarty_tpl->tpl_vars['r']->value['activo']==1){?>selected='selected'<?php }?>>Por cobrar</option>
			<option value='2' <?php if ($_smarty_tpl->tpl_vars['r']->value['activo']==2){?>selected='selected'<?php }?>>Cobrado</option>
			<option value='3' <?php if ($_smarty_tpl->tpl_vars['r']->value['activo']==3){?>selected='selected'<?php }?>>Rebotado</option>
    	</select>
    </div>
<?php } ?><?php }} ?>