<?php /* Smarty version Smarty-3.1.11, created on 2013-09-02 03:20:49
         compiled from ".\templates\balance.tpl" */ ?>
<?php /*%%SmartyHeaderCode:160155223e37259e280-49295507%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '184c6c530fd812bf3d7d440d2a59d422000772df' => 
    array (
      0 => '.\\templates\\balance.tpl',
      1 => 1378084846,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '160155223e37259e280-49295507',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5223e37261d2b6_17995692',
  'variables' => 
  array (
    'r' => 0,
    'params' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5223e37261d2b6_17995692')) {function content_5223e37261d2b6_17995692($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'C:\\maxi\\libo\\gestion\\smarty\\libs\\plugins\\modifier.date_format.php';
?>        <div class='linea' id='<?php echo $_smarty_tpl->tpl_vars['r']->value['id_ses'];?>
'>
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
            <span class='importe'><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['r']->value['total']);?>
</span>
        	<span class='iva'><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['r']->value['iva']);?>
</span>
            <span class='nombre_cli' title='<?php echo $_smarty_tpl->tpl_vars['r']->value['nombre_cli'];?>
'><a href='?accion=cc&tipo=<?php echo $_smarty_tpl->tpl_vars['params']->value['fuente'];?>
&id=<?php echo $_smarty_tpl->tpl_vars['r']->value['id_cli'];?>
'><?php echo $_smarty_tpl->tpl_vars['r']->value['nombre_cli'];?>
</a></span>
        </div><?php }} ?>