<?php /* Smarty version Smarty-3.1.11, created on 2013-09-02 03:39:12
         compiled from ".\templates\balances.tpl" */ ?>
<?php /*%%SmartyHeaderCode:204585223e25b74e146-11451460%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2979b1ba1975ede28774e437f57c1ede6fc974e0' => 
    array (
      0 => '.\\templates\\balances.tpl',
      1 => 1378085951,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '204585223e25b74e146-11451460',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_5223e25b834c47_76063492',
  'variables' => 
  array (
    'compras' => 0,
    'totales' => 0,
    'ventas' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5223e25b834c47_76063492')) {function content_5223e25b834c47_76063492($_smarty_tpl) {?><div class='compras media_columna'>
    <h3 class='rojo'>Compras</h3>
    <div class='linea header'>
            <span class='iva'>IVA</span>
            <span class='importe'>Importe</span>
    </div>

    <?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['compras']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value){
$_smarty_tpl->tpl_vars['r']->_loop = true;
?>
        <?php echo $_smarty_tpl->getSubTemplate ("balance.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'foo'), 0);?>

    <?php } ?>
    <div class='linea header'>
        Totales:<span class='iva'><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['totales']->value['ivaCompras']);?>
</span><span class='importe'><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['totales']->value['compras']);?>
</span>
    </div>
</div>

<div class='ventas media_columna'>
    <h3>Ventas</h3>
    <div class='linea header'>
            <span class='iva'>IVA</span>
            <span class='importe'>Importe</span>
    </div>

    <?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ventas']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value){
$_smarty_tpl->tpl_vars['r']->_loop = true;
?>
        <?php echo $_smarty_tpl->getSubTemplate ("balance.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>'foo'), 0);?>

    <?php } ?>
    <div class='linea header'>
    Totales:<span class='iva'><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['totales']->value['ivaVentas']);?>
</span><span class='importe'><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['totales']->value['ventas']);?>
</span>
    </div>
</div>



<?php }} ?>