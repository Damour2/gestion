<?php /* Smarty version Smarty-3.1.11, created on 2013-07-06 20:26:43
         compiled from ".\templates\movimiento-admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2085250b110ddbfccf4-84936556%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3c27236ccf411c3175b28d8c147dee9a93009567' => 
    array (
      0 => '.\\templates\\movimiento-admin.tpl',
      1 => 1373135199,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2085250b110ddbfccf4-84936556',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50b110ddcadfd6_03253670',
  'variables' => 
  array (
    'encabezado' => 0,
    'datos' => 0,
    'r' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50b110ddcadfd6_03253670')) {function content_50b110ddcadfd6_03253670($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\maxi\\libo\\gestion\\smarty\\libs\\plugins\\modifier.date_format.php';
?><?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>

<?php if ($_smarty_tpl->tpl_vars['encabezado']->value==true){?>
<div class="linea rojo">
    <span class="fecha">
    	Fecha
	</span>
  	<span class="nombre">
    	Descripcion
	</span>
     <span class="monto">
    	Importe
	</span>
     <span class="saldo">
    	Saldo
	</span>
  </div>
 <?php }?> 
  
<?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['datos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value){
$_smarty_tpl->tpl_vars['r']->_loop = true;
?>
  
  <div class="linea movimiento <?php echo $_smarty_tpl->tpl_vars['r']->value['tipo'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['r']->value['id_ses'];?>
">
  	<a class="boton azul editar" title="Editar" href="?accion=compras&status=<?php echo $_GET['tipo'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['r']->value['id_ses'];?>
"></a>
    <a class="boton rojo eliminar" title="Eliminar"></a>
    <span class='fecha'>
    <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['r']->value['fecha'],"%d-%m-%y");?>

  </span>
    <span class='nombre'> 
    	<?php echo $_smarty_tpl->tpl_vars['r']->value['tipo'];?>

    	<?php if ($_smarty_tpl->tpl_vars['r']->value['descripcion']){?>
    		<?php echo $_smarty_tpl->tpl_vars['r']->value['descripcion'];?>

    	<?php }elseif($_smarty_tpl->tpl_vars['r']->value['factura']){?>
    		Factura Nº <?php echo $_smarty_tpl->tpl_vars['r']->value['factura'];?>

    	<?php }elseif($_smarty_tpl->tpl_vars['r']->value['remito']){?>
    		Remito Nº <?php echo $_smarty_tpl->tpl_vars['r']->value['remito'];?>

    	<?php }?>
    </span>
    <span class='monto'><?php echo $_smarty_tpl->tpl_vars['r']->value['total'];?>
</span>
    <span class='importe'><?php echo $_smarty_tpl->tpl_vars['r']->value['total'];?>
</span>
    <span class='saldo <?php if ($_smarty_tpl->tpl_vars['r']->value['saldo']<0){?> negativo <?php }?>'> 
    	<?php echo $_smarty_tpl->tpl_vars['r']->value['saldo'];?>
 
    </span>
    
  </div>
<?php } ?>

<?php }} ?>