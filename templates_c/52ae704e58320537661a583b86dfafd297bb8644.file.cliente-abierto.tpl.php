<?php /* Smarty version Smarty-3.1.11, created on 2013-07-06 19:30:45
         compiled from ".\templates\cliente-abierto.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2159550b12b8a00fe40-33402393%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '52ae704e58320537661a583b86dfafd297bb8644' => 
    array (
      0 => '.\\templates\\cliente-abierto.tpl',
      1 => 1373131843,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2159550b12b8a00fe40-33402393',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.11',
  'unifunc' => 'content_50b12b8a082085_44797616',
  'variables' => 
  array (
    'cliente' => 0,
    'v' => 0,
    'k' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50b12b8a082085_44797616')) {function content_50b12b8a082085_44797616($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include 'C:\\maxi\\libo\\gestion\\smarty\\libs\\plugins\\modifier.capitalize.php';
?><?php  $_config = new Smarty_Internal_Config("test.conf", $_smarty_tpl->smarty, $_smarty_tpl);$_config->loadConfigVars("setup", 'local'); ?>

<h3 class="azul" id="id_cli" data-id_cli="<?php echo $_smarty_tpl->tpl_vars['cliente']->value['id_cli'];?>
"><?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['cliente']->value['tipo']);?>
> <?php echo $_smarty_tpl->tpl_vars['cliente']->value['nombre'];?>
</h3>

<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cliente']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
	<?php if ($_smarty_tpl->tpl_vars['v']->value!=''&&$_smarty_tpl->tpl_vars['v']->value!='0000-00-00'&&$_smarty_tpl->tpl_vars['v']->value!='0000-00-00 00:00:00'&&$_smarty_tpl->tpl_vars['k']->value!='id_cli'&&$_smarty_tpl->tpl_vars['k']->value!='nombre'){?>
		<p class='<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
'><?php echo $_smarty_tpl->tpl_vars['k']->value;?>
: <b><?php echo $_smarty_tpl->tpl_vars['v']->value;?>
</b></p>
	<?php }?>

<?php } ?>

<?php }} ?>