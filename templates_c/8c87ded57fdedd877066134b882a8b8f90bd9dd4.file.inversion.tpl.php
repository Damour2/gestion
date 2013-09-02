<?php /* Smarty version Smarty-3.1.11, created on 2012-11-05 03:19:15
         compiled from ".\templates\inversion.tpl" */ ?>
<?php /*%%SmartyHeaderCode:680550972223504340-62802303%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c87ded57fdedd877066134b882a8b8f90bd9dd4' => 
    array (
      0 => '.\\templates\\inversion.tpl',
      1 => 1351647131,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '680550972223504340-62802303',
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
  'unifunc' => 'content_5097222395d033_96995239',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5097222395d033_96995239')) {function content_5097222395d033_96995239($_smarty_tpl) {?>

<?php  $_smarty_tpl->tpl_vars['r'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['r']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['datos']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['r']->key => $_smarty_tpl->tpl_vars['r']->value){
$_smarty_tpl->tpl_vars['r']->_loop = true;
?>
	<div class="linea" id="<?php echo $_smarty_tpl->tpl_vars['r']->value['id_mat'];?>
">
    	<span class="nombre"><?php echo $_smarty_tpl->tpl_vars['r']->value['nombre'];?>
</span>
        <span class="valor"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['valor'];?>
" /></span>
        <span class="unidad"><?php echo $_smarty_tpl->tpl_vars['r']->value['unidad'];?>
</span>
        <span class="requerida"><?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['r']->value['requerida']);?>
</span>
        <span class="stock"><input type="text" value="<?php echo $_smarty_tpl->tpl_vars['r']->value['stock'];?>
" /></span>
        <span class="a_comprar"><?php if ($_smarty_tpl->tpl_vars['r']->value['a_comprar']>0){?> 
        							<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['r']->value['a_comprar']);?>

                                 <?php }else{ ?> 0 <?php }?></span>
        <span class="costo"><?php if ($_smarty_tpl->tpl_vars['r']->value['costo']>0){?> 
        							<?php echo sprintf("%.2f",$_smarty_tpl->tpl_vars['r']->value['costo']);?>

                                 <?php }else{ ?> 0 <?php }?></span>
	</div>
<?php } ?><?php }} ?>